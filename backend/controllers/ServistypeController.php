<?php

namespace backend\controllers;

use Yii;
use common\models\group;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ServiceType;
use backend\models\ServiceTypeStore;

/**
 * groupController implements the CRUD actions for group model.
 */
class ServistypeController extends Controller {

    public $layout = "dashboard";
	
	public function beforeAction($action)
	{            
		//if ($action->id == 'my-method') {
			$this->enableCsrfValidation = false;
		//}

		return parent::beforeAction($action);
	}

    public function behaviors() {

        if(!Yii::$app->session->get('userInfo')){
			return $this->redirect(Yii::$app->params['backendLoginUrl']);
		}
		
		$module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        if ($permissions['view_access'] != '1') {
            return $this->redirect(Yii::$app->params['backendPermissionDeniedUrl']);
        }

        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    
	public function actionGetallservicetype($draw) {
		$connection = Yii::$app->getDb();
		
		$command = $connection->createCommand("SELECT COUNT(*) AS total FROM service_type");
		
		$data = $command->queryAll();
		
		foreach($data as $row){
			$total_orders = $row['total'];
		}
        
        $userFilter = FALSE;
        $userSearch = $_GET['search']['value'];
        
        $filterreference = $_GET['columns'][1]['search']['value'];
        $filterParams = array();
        $searchParams = array();
        
        $queryOrder = ServiceType::find();

        $table = array('product_id', 'product_id', 'product_detail.name', 'brands.brand_name', 'brands_collection.brands_collection_name', 'product_category.product_category_name', 'price', 'product_id', 'active', 'product_id');
        $order = $table[$_GET['order'][0]['column']] . ' ' . $_GET['order'][0]['dir'];
        
        if($filterreference != ''){
            $userFilter = TRUE;
            $filterParams[] = ['LIKE', 'service_type.service_type_name', $filterreference];
        }

        if($userFilter){
            
            foreach($filterParams as $filter){
                $queryOrder
                    ->andFilterWhere($filter);
            }
            
            if($userSearch != ''){
                $queryOrder
                    ->orWhere(['like', 'service_type.service_type_name', $_GET['search']['value']]);
            }
                
        } else {
            
            if($userSearch != ''){
                $queryOrder
                    ->orWhere(['like', 'service_type.service_type_name', $_GET['search']['value']]);
            }
            
        }
		
        $total_find = $queryOrder->all();
        $orders = $queryOrder
                ->orderBy('service_type.service_type_id ASC')
                ->offset($_GET['start'])
                ->limit($_GET['length'])
                ->all();

        $columns = array();
        $numbering = $_GET['start'];
		
		$data = '{
            "draw": ' . $_GET['draw'] . ',
            "recordsTotal": ' . $total_orders . ',
            "recordsFiltered": ' . count($total_find) . ',
            "data": ';


        if (!empty($orders)) {
            foreach ($orders as $row) {

                $button = "";

                $numbering++;
                $button = '<div class="btn-group"><a href="' . \yii\helpers\Url::base() . '/servistype/view/' . $row->service_type_id . '" class="btn btn-default" ><i class="fa fa-fw fa-eye"></i> View</a>';
				
				$serviceAvailability = "";
				
				$serviceTypeStore = ServiceTypeStore::findAll(["service_type_id" => $row->service_type_id]);
				
				$serviceAvailability = 'Available In ' . count($serviceTypeStore) . ' Store';
				
                $button = $button . '</ul></div>';

                $product_array = array(
                    "No" => $numbering, 
                    "service_type_name" => $row->service_type_name, 
					"service_availability" => $serviceAvailability,
					"service_type_status" => $row->service_type_status == 1 ? "Active" : "Inactive",
                    "action" => $button
                );
                array_push($columns, $product_array);
            }
        }

        $data = $data . json_encode($columns) . '}';
        return $data;
    }

	private function RenderService(){
		
		return $this->render('../servistype/index');
		
	}
	
	public function actionView($id){
		
		$data = $this->findModel($id);
		$storeList = ServiceTypeStore::findAll(["service_type_id" => $id]);
		
		if(Yii::$app->request->post()){
			
			if(count($_POST['store_id']) > 0){
				$storesId = $_POST['store_id'];
				
				//$serviceTypeStoreModel = ServiceTypeStore::deleteAll('service_type_id = '.$id);
				
				foreach($storesId as $row){
					
					$serviceTypeStoreModel = ServiceTypeStore::findOne(["store_id" => $row, "service_type_id" => $id]);
					
					if($serviceTypeStoreModel == NULL){					
						$serviceTypeStore = new ServiceTypeStore();
						$serviceTypeStore->service_type_id = $id;
						$serviceTypeStore->store_id = $row;
						$serviceTypeStore->save();
					}
				}
				
				$this->redirect(Yii::$app->urlManager->getBaseUrl() . '/servistype/view/'.$id);
			}
			
		}
		
		$this->layout = "storeadmin/dashboard_storeadmin";
		
		return $this->render('../servistype/view', array("data" => $data, "storeList" => $storeList));
	}
	

    /**
     * Lists all group models.
     * @return mixed
     */
    public function actionIndex() {
		
		$departement = Yii::$app->session->get('userInfo')['departement'];
		
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		
		if($departement == "Customer Service & After Sales"){
			$this->layout = "storeadmin/dashboard_storeadmin";
			
			return $this->RenderService();
		}
    }
	
	private function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

    /**
     * Finds the group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ServiceType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
