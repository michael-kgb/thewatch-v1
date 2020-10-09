<?php

namespace backend\controllers;

use Yii;
use common\models\group;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Warranty;

/**
 * groupController implements the CRUD actions for group model.
 */
class WarrantyController extends Controller {

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
    
	public function actionGetallwarranty($draw) {
		$connection = Yii::$app->getDb();
		
		$departement = Yii::$app->session->get('userInfo')['departement'];
		
		$orderDateFrom = $_GET['columns'][7]['search']['value'];
		$orderDateTo = $_GET['columns'][8]['search']['value'];
		$warrantyStatus = $_GET['columns'][4]['search']['value'];
		
		//$orderDate = "(orders.date_add BETWEEN '".date('d-m-Y')." 00:00:00 ' AND '".date('d-m-Y')." 23:59:00 ')";
		
		if($orderDateFrom != '' && $orderDateTo != ''){
			
			$orderDateFrom = $_GET['columns'][7]['search']['value'];
			$orderDateTo = $_GET['columns'][8]['search']['value'];
			
		} else {
			
			$orderDateFrom = date('Y-m-d');
			$orderDateTo = date('Y-m-d');
			
		}
		
		$orderDate = "(warranty.warranty_date_add BETWEEN '".$orderDateFrom." 00:00:00 ' AND '".$orderDateTo." 23:59:00 ')";
		
		//echo $orderDate; die();
		
		
		$command = $connection->createCommand("SELECT COUNT(*) AS total FROM warranty WHERE ".$orderDate."");
		
		if($warrantyStatus != '' && $warrantyStatus != 'ALL'){
		    $command = $connection->createCommand("SELECT COUNT(*) AS total FROM warranty WHERE ".$orderDate." AND warranty.warranty_status='".$warrantyStatus."'");
		}
		
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		
		if($departement == "Store Staff"){
			
			$command = $connection->createCommand("SELECT COUNT(*) AS total FROM warranty WHERE ".$orderDate."");
			
			if($warrantyStatus != '' && $warrantyStatus != 'ALL'){
		        $command = $connection->createCommand("SELECT COUNT(*) AS total FROM warranty WHERE ".$orderDate." AND warranty.warranty_status='".$warrantyStatus."'");
    		}
		}
		
		$data = $command->queryAll();
		
		foreach($data as $row){
			$total_orders = $row['total'];
		}
		
		// 
		
        //$total_orders = \backend\models\Orders::find()->count();
        
        // $queryTotalFind = \backend\models\Orders::find()
        //         ->joinWith([
        //             "customer",
        //             "customeraddress",
        //             "paymentmethoddetail"
        //         ]);
        
        $userFilter = FALSE;
        $userSearch = $_GET['search']['value'];
        
        $filtercode = $_GET['columns'][1]['search']['value'];
        $filterParams = array();
        $searchParams = array();
        
        $queryOrder = \backend\models\Warranty::find();

        //$table = array('product_id', 'product_id', 'product_detail.name', 'brands.brand_name', 'brands_collection.brands_collection_name', 'product_category.product_category_name', 'price', 'product_id', 'active', 'product_id');
        //$order = $table[$_GET['order'][0]['column']] . ' ' . $_GET['order'][0]['dir'];
        
        if($filtercode != ''){
            $userFilter = TRUE;
            $filterParams[] = ['LIKE', 'warranty.warranty_code', $filterreference];
        }

        if($userFilter){
            
            foreach($filterParams as $filter){
                $queryOrder
                    ->andFilterWhere($filter);
            }
            
            if($userSearch != ''){
                $queryOrder
                    ->orWhere(['like', 'warranty.warranty_code', $_GET['search']['value']]);
            }
                
        } else {
            
            if($userSearch != ''){
                $queryOrder
                    ->orWhere(['like', 'warranty.warranty_code', $_GET['search']['value']]);
            }
            
        }
		
		$queryOrder->andFilterWhere(['between','warranty.warranty_date_add', $orderDateFrom . ' 00:00:00 ', $orderDateTo . ' 23:59:00']);
		if($warrantyStatus != '' && $warrantyStatus != 'ALL'){
		    $queryOrder->andFilterWhere(['warranty_status'=> $warrantyStatus]);
		}
        
        $total_find = $queryOrder->all();
        $warranty = $queryOrder
                ->orderBy('warranty.warranty_id desc')
                ->offset($_GET['start'])
                ->limit($_GET['length'])
                ->all();

        $columns = array();
        $numbering = $_GET['start'];

        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();


		$data = '{
            "draw": ' . $_GET['draw'] . ',
            "recordsTotal": ' . $total_orders . ',
            "recordsFiltered": ' . count($total_find) . ',
            "data": ';


        if (!empty($warranty)) {
            foreach ($warranty as $row) {


                $button = "";

                $numbering++;
                $button = '<div class="btn-group"><a href="' . \yii\helpers\Url::base() . '/warranty/view/' . $row->warranty_id . '" class="btn btn-default" ><i class="fa fa-fw fa-eye"></i> View</a>';

              
                $button = $button . '</ul></div>'; 

                $product_array = array(
                    "No" => $numbering, 
                    "warranty_code" => $row->warranty_code, 
					"warranty_number" => $row->warranty_number,
					"warranty_type" => $row->warrantyType->warranty_type_name,
					"warranty_status" => $row->warranty_status,
                    "date" => date_format(date_create($row->warranty_date_add), 'j F Y g:i A'), 
                    "action" => $button,
					"warranty_date_from" => '',
					"warranty_date_to" => ''
                );
                array_push($columns, $product_array);
            }
        }

        $data = $data . json_encode($columns) . '}';
        return $data;
    }

	private function RenderWarranty(){
		
		return $this->render('../warranty/index');
		
	}
	
	public function actionGenerate(){
		$departement = Yii::$app->session->get('userInfo')['departement'];
		
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		
		if($departement == "Store Staff" || "Customer Service & After Sales"){
			
			$this->layout = "storeadmin/dashboard_storeadmin";
			
			return $this->render('../warranty/generate');
		}
	}
	
	public function actionView($id){
		
		$departement = Yii::$app->session->get('userInfo')['departement'];
		
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		$warranty = $this->findModel($id);
		$order_detail = \backend\models\OrderDetailWarranty::find()->where(['warranty_id'=>$warranty->warranty_id])->one();
		if($order_detail != null){
		    $order = \backend\models\OrderDetail::find()->where(['order_detail_id'=>$order_detail->order_detail_id])->one();
		    $model = \backend\models\Orders::find()->where(['orders_id'=>$order->orders_id])->one();
		}else{
		    $model = [];
		}
		if($departement == "Store Staff" || "Customer Service & After Sales"){
			
			$this->layout = "storeadmin/dashboard_storeadmin";
			
			return $this->render('../warranty/view',['warranty'=>$warranty,'model'=>$model]);
		}
	}
	
	public function actionCreate(){
		
		$departement = Yii::$app->session->get('userInfo')['departement'];
		
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		
		if(Yii::$app->request->post()){
			
			$storeId = $_POST['store_id'];
			$warrantyTotal = $_POST['total_warranty'];
			
			for($i = 1; $i <= $warrantyTotal; $i++){
			    $warrantyModel = $this->insertWarranty($_POST['warranty_type_id']);
			    
			}
			
			
			
			return $this->redirect(Yii::$app->urlManager->getBaseUrl() . '/warranty/generate?bulkname=' . $warrantyModel->warranty_description);
		}
		
		if($departement == "Store Staff" || "Customer Service & After Sales"){
			$this->layout = "storeadmin/dashboard_storeadmin";
			
			return $this->render('../warranty/create');
		}
	}
	
	public function actionExport($data){
	    \common\components\PHPExcel_Helper::generateWarranty('Excel',$data);
	}

    /**
     * Lists all group models.
     * @return mixed
     */
    public function actionIndex() {
		
		$departement = Yii::$app->session->get('userInfo')['departement'];
		
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		
		if($departement == "Store Staff" || $departement == "Customer Service & After Sales"){
			$this->layout = "storeadmin/dashboard_storeadmin";
			
			return $this->RenderWarranty();
		}
    }
	
	private function generateRandomString($length = 10) {
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	private function insertWarranty($type){
	    try {
			        
    				$warrantyModel = new Warranty();
    				$warrantyModel->warranty_code = $this->generateRandomString(8);
    				$warrantyModel->warranty_date_add = date('Y-m-d H:i:s');
    				$warrantyModel->warranty_date_upd = date('Y-m-d H:i:s');
    				$warrantyModel->warranty_status = 'AVAILABLE';
    				$warrantyModel->warranty_type_id = $type;
    				$warrantyModel->warranty_description = 'Warranty Generated ' . $warrantyModel->warranty_date_add;
    				//$warrantyModel->store_id = $storeId;
    				$warrantyModel->save();
			    }
    			catch(\yii\db\IntegrityException $e) {
    			    $this->insertWarranty($type);
    			}
    	return $warrantyModel;
	}

    /**
     * Finds the group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = \backend\models\Warranty::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
