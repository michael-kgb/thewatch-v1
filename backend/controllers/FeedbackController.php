<?php

namespace backend\controllers;

use Yii;
use common\models\group;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Warranty;
use backend\models\Service;
use backend\models\ServiceDetail;
use backend\models\ServiceHistory;
use backend\models\ServiceTypeStore;
use backend\models\Orders;
use backend\models\OrderDetail;
use backend\models\SpecificPrice;
use backend\models\OrderDetailWarranty;
use backend\models\SysAutonumberBrands;
use common\components\Helpers;
use backend\models\SysAutonumber;
use backend\models\Product;
use backend\models\Customer;
use backend\models\Log;
use common\components\PHPExcel_Helper;

/**
 * groupController implements the CRUD actions for group model.
 */
class FeedbackController extends Controller {

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
        //$permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        //if ($permissions['view_access'] != '1') {
            //return $this->redirect(Yii::$app->params['backendPermissionDeniedUrl']);
        //}

        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    
	public function actionGetall($draw) {
		$connection = Yii::$app->getDb();
		
		$departement = Yii::$app->session->get('userInfo')['departement'];
		
		$orderDateFrom = $_GET['columns'][9]['search']['value'];
		$orderDateTo = $_GET['columns'][10]['search']['value'];
		
// 		$serviceStatus = $_GET['columns'][8]['search']['value'];
		
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		
		if($orderDateFrom != '' && $orderDateTo != ''){
			
			$orderDateFrom = $_GET['columns'][9]['search']['value'];
			$orderDateTo = $_GET['columns'][10]['search']['value'];
			
		} else {
			
			$orderDateFrom = date('Y-m-d');
			$orderDateTo = date('Y-m-d');
			
		}
		
		$orderDate = "(answer.answer_date BETWEEN '".$orderDateFrom." 00:00:00 ' AND '".$orderDateTo." 23:59:00 ')";
		
		//echo $orderDate; die();
		
		$command = $connection->createCommand("SELECT COUNT(*) AS total FROM questionnaire_respondent,answer WHERE ".$orderDate." AND answer.questionnaire_respondent_id = questionnaire_respondent.questionnaire_respondent_id AND questionnaire_respondent.questionnaire_id = 2");
		
		$data = $command->queryAll();
		
		
		foreach($data as $row){
			$total_orders = $row['total'];
		}
		

        $userFilter = FALSE;
        $userSearch = $_GET['search']['value'];
        
        $filterreference = $_GET['columns'][1]['search']['value'];
        $filtercustomer = $_GET['columns'][2]['search']['value'];

        $filterParams = array();
        $searchParams = array();
		
		$queryOrder = Service::find()
			->leftJoin("questionnaire_respondent", "questionnaire_respondent.questionnaire_respondent_id=service.questionnaire_respondent_id")
			->leftJoin("customer", "customer.customer_id=questionnaire_respondent.customer_id");
// 			->leftJoin("answer", "answer.questionnaire_respondent_id=questionnaire_respondent.questionnaire_respondent_id");
        
		
        $table = array('product_id', 'product_id', 'product_detail.name', 'brands.brand_name', 'brands_collection.brands_collection_name', 'product_category.product_category_name', 'price', 'product_id', 'active', 'product_id');
        $order = $table[$_GET['order'][0]['column']] . ' ' . $_GET['order'][0]['dir'];
        
        if($filterreference != ''){
            $userFilter = TRUE;
            $filterParams[] = ['LIKE', 'service.service_code', $filterreference];
        }
        if($filtercustomer != ''){
            $userFilter = TRUE;
            $filterParams[] = ['LIKE', 'customer.firstname', $filtercustomer];
        }
		
        // if($filterpayment != ''){
        //     $userFilter = TRUE;
        //     $filterParams[] = ['LIKE', 'orders.payment_method_detail_id', $filterpayment];
        // }

        if($userFilter){
            
            foreach($filterParams as $filter){
                // $queryTotalFind
                //     ->andFilterWhere($filter);
                
                $queryOrder
                    ->andFilterWhere($filter);
            }
            
            if($userSearch != ''){
                // $queryTotalFind
                //     ->where(['like', 'orders.reference', $_GET['search']['value']])
                //     ->orWhere(['like', 'customer.firstname', $_GET['search']['value']]);
                   
                $queryOrder
                    ->orWhere(['like', 'service.service_code', $_GET['search']['value']])
                    ->orWhere(['like', 'customer.firstname', $_GET['search']['value']]);
            }
                
        } else {
            
            if($userSearch != ''){
                
                // $queryTotalFind
                //     ->where(['like', 'orders.reference', $_GET['search']['value']])
                //     ->orWhere(['like', 'customer.firstname', $_GET['search']['value']]);
                $queryOrder
                    ->orWhere(['like', 'service.service_code', $_GET['search']['value']])
                    ->orWhere(['like', 'customer.firstname', $_GET['search']['value']]);
            }
            
        }
		
        $queryOrder->andFilterWhere(['questionnaire_respondent.questionnaire_id'=>2]);
		
// 		$queryOrder->andFilterWhere(['between','service.service_date_add', $orderDateFrom . ' 00:00:00 ', $orderDateTo . ' 23:59:00']);
        
        $total_find = $queryOrder->all();
        $orders = $queryOrder
                ->orderBy('service.service_id desc')
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


        if (!empty($orders)) {
            foreach ($orders as $row) {
                $kecepatan = 0;$kerapihan = 0;$kemudahan = 0;$lain = '';
                foreach($row->questionnaireRespondent->answer as $ans){
        		    if($ans->question_id == 4){
        		        $kecepatan = $ans->answer_text;
        		    }
        		    if($ans->question_id == 5){
        		        $kerapihan = $ans->answer_text;
        		    }
        		    if($ans->question_id == 6){
        		        $kemudahan = $ans->answer_text;
        		    }
        		    if($ans->question_id == 7){
        		        $lain = $ans->answer_text;
        		    }
        		}
        		
                $button = "";

                $numbering++;
                $button = '<div class="btn-group"><a href="' . \yii\helpers\Url::base() . '/servis/view/' . $row->service_id . '" class="btn btn-default" ><i class="fa fa-fw fa-eye"></i> View</a>';

                $button = $button . '</ul></div>';     
				
                $product_array = array(
                    "No" => $numbering, 
                    "service_code" => $row->service_code, 
                    "customer" => $row->questionnaireRespondent->customer->firstname . ' ' . $row->orders->customer->lastname,
                    "kecepatan" => '('.$kecepatan.'/5)',
                    "kerapihan" => '('.$kerapihan.'/5)',
                    "kemudahan" => '('.$kemudahan.'/5)',
                    "lainnya" => $lain,
                    "date" => date_format(date_create($row->service_date_add), 'j F Y g:i A'), 
                    "action" => $button,
					"service_date_from" => '',
					"service_date_to" => '',
					"service_state_lang_id" => '',
					"service_detail_drop_store_id" => ''
                );
                array_push($columns, $product_array);
            }
        }

        $data = $data . json_encode($columns) . '}';
        return $data;
    }
    
	public function actionView($id){
		
		$this->layout = "storeadmin/dashboard_storeadmin";
		
		$data = Service::findOne($id);
		
		if(Yii::$app->request->post()){
			
			$data->service_fee = $_POST['service_fee'];
			$data->service_fee_unique_code = $this->generateUniqueCode(2);
			$data->sc_notes = $_POST['sc_notes'];
			$data->save();
			
			// insert new service history
			$serviceHistoryModel = new ServiceHistory();
			$serviceHistoryModel->service_id = $id;
			$serviceHistoryModel->service_state_lang_id = 32;
			$serviceHistoryModel->date_add = date("Y-m-d H:i:s");
			$serviceHistoryModel->save();
			
			$data->service_history_id = $serviceHistoryModel->service_history_id;
			$data->save();
			
			$logModel = new Log();
			$logModel->fullname = Yii::$app->session->get('userInfo')['fullname'];
			$logModel->module = Yii::$app->controller->id;
			$logModel->action = "update";
			$logModel->action_text = "user " . Yii::$app->session->get('userInfo')['fullname'] . " update status to " . $serviceHistoryModel->serviceStateLang->name . "";
			$logModel->id_onChanged = $data->service_id;
			$logModel->date_time = date('Y-m-d H:i:s');
			$logModel->save();
			
			if($data->paymentMethodDetail->paymentMethod->payment_method_id != 7){
    			// send email notification for only spesific service status
    			Helpers::sendEmailMandrillUrlAPI(
    				$this->renderFile('@app/views/template/mail/warranty_payment.php', array(
    					"data" => $data
    				)), 'Biaya Perbaikan Service Anda', 'notification@thewatch.co', $data->orders->customer->email, ''
    			);
			
			}else{
			    Helpers::sendEmailMandrillUrlAPI(
    				$this->renderFile('@app/views/template/mail/warranty_payment_store.php', array(
    					"data" => $data
    				)), 'Biaya Perbaikan Service Anda', 'notification@thewatch.co', $data->orders->customer->email, ''
    			);
			}
			
			$this->redirect(Yii::$app->urlManager->getBaseUrl() . '/servis/view/' . $id);
			
		}
		
		return $this->render('../servis/view', array(
			"data" => $data
		));
	}

    /**
     * Lists all group models.
     * @return mixed
     */
    public function actionIndex() {
		
		$departement = Yii::$app->session->get('userInfo')['departement'];
		
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		
		if(isset($_GET['export'])){
			
			$exportTo = $_GET['export'];
			$fromDate = $_GET['serviceDateFrom'];
			$toDate = $_GET['serviceDateTo'];
			$serviceStatus = $_GET['serviceStatus'];
			$serviceDetailDropStoreId = $_GET['serviceDetailDropStoreId'];
			
			$queryOrder = Service::find()
				->leftJoin("orders", "orders.orders_id=service.orders_id")
				->leftJoin("service_history", "service_history.service_history_id=service.service_history_id")
				->leftJoin("service_state_lang", "service_state_lang.service_state_lang_id=service_history.service_state_lang_id");
			
			if($serviceDetailDropStoreId != 0 || $store_id != 149){
				
				$queryOrder = Service::find()
					->leftJoin("orders", "orders.orders_id=service.orders_id")
					->leftJoin("service_history", "service_history.service_history_id=service.service_history_id")
					->leftJoin("service_state_lang", "service_state_lang.service_state_lang_id=service_history.service_state_lang_id")
					->leftJoin("service_detail", "service_detail.service_id=service.service_id")
					->leftJoin("stores", "stores.store_id=service_detail.service_detail_drop_store_id");
			}
			
			if($store_id != 149){
				$queryOrder->andFilterWhere(['=','service_detail.service_detail_drop_store_id', $store_id]);
			}
			
			if($serviceDetailDropStoreId != 0){
				$queryOrder->andFilterWhere(['=','service_detail.service_detail_drop_store_id', $serviceDetailDropStoreId]);
			}
			
			if($serviceStatus != 0){
				$queryOrder->andFilterWhere(['=','service_history.service_state_lang_id', $serviceStatus]);
			}
			
			$queryOrder->andFilterWhere(['between','service.service_date_add', $fromDate . ' 00:00:00 ', $toDate . ' 23:59:00']);
			
			$data = $queryOrder
                ->orderBy('service.service_id desc')
                ->all();
			
			return PHPExcel_Helper::generateExportService($exportTo, $fromDate, $toDate, $data);
		}
		
		$this->layout = "storeadmin/dashboard_storeadmin";
		
// 		$answer = \backend\models\Service::findOne(9);
// 		foreach($answer->questionnaireRespondent->answer as $ans){
// 		    echo $ans->answer_text.'<br>';
// 		}
// 		die();
        $queryOrder = Service::find()
			->leftJoin("questionnaire_respondent", "questionnaire_respondent.questionnaire_respondent_id=service.questionnaire_respondent_id")
			->leftJoin("customer", "customer.customer_id=questionnaire_respondent.customer_id");
		 $orders = $queryOrder
                ->orderBy('service.service_id desc')
                ->all();	
                
        $count_kecepatan = 0;$kecepatan = 0;$count_kerapihan = 0;$kerapihan = 0;$count_kemudahan = 0;$kemudahan = 0;
        foreach($orders as $row){
            foreach($row->questionnaireRespondent->answer as $ans){
        		    if($ans->question_id == 4){
        		        $kecepatan = $kecepatan + $ans->answer_text;
        		        $count_kecepatan = $count_kecepatan + 1;
        		    }
        		    if($ans->question_id == 5){
        		        $kerapihan = $kerapihan + $ans->answer_text;
        		        $count_kerapihan = $count_kerapihan + 1;
        		    }
        		    if($ans->question_id == 6){
        		        $kemudahan = $kemudahan + $ans->answer_text;
        		        $count_kemudahan = $count_kemudahan + 1;
        		    }
        		    
        		}
            
        }
        $avg_kecepatan = ($kecepatan / $count_kecepatan) / 5 * 100;
        $avg_kerapihan = ($kerapihan / $count_kerapihan) / 5 * 100;
        $avg_kemudahan = ($kemudahan / $count_kemudahan) / 5 * 100;
		return $this->render('index',['avg_kecepatan'=>$avg_kecepatan,'avg_kerapihan'=>$avg_kerapihan,'avg_kemudahan'=>$avg_kemudahan]);
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
