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
class ServisController extends Controller {

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
    
	public function actionGetallservice($draw) {
		$connection = Yii::$app->getDb();
		
		$departement = Yii::$app->session->get('userInfo')['departement'];
		
		$orderDateFrom = $_GET['columns'][6]['search']['value'];
		$orderDateTo = $_GET['columns'][7]['search']['value'];
		
		$serviceStatus = $_GET['columns'][8]['search']['value'];
		
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		
		if($orderDateFrom != '' && $orderDateTo != ''){
			
			$orderDateFrom = $_GET['columns'][6]['search']['value'];
			$orderDateTo = $_GET['columns'][7]['search']['value'];
			
		} else {
			
			$orderDateFrom = date('Y-m-d');
			$orderDateTo = date('Y-m-d');
			
		}
		
		$orderDate = "(service.service_date_update BETWEEN '".$orderDateFrom." 00:00:00 ' AND '".$orderDateTo." 23:59:00 ')";
		
		//echo $orderDate; die();
		
		$command = $connection->createCommand("SELECT COUNT(*) AS total FROM service WHERE ".$orderDate."");
		
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
        
        $filterreference = $_GET['columns'][1]['search']['value'];
		$storeid = $_GET['columns'][9]['search']['value'];
        $filterParams = array();
        $searchParams = array();
		
		$queryOrder = Service::find()
			->leftJoin("orders", "orders.orders_id=service.orders_id")
			->leftJoin("service_history", "service_history.service_history_id=service.service_history_id")
			->leftJoin("service_state_lang", "service_state_lang.service_state_lang_id=service_history.service_state_lang_id");
        
		if($store_id != 149 || $storeid != ""){
			$queryOrder = Service::find()
				->leftJoin("orders", "orders.orders_id=service.orders_id")
				->leftJoin("service_detail", "service_detail.service_id=service.service_id")
				->leftJoin("stores", "stores.store_id=service_detail.service_detail_drop_store_id")
				->leftJoin("service_history", "service_history.service_history_id=service.service_history_id")
				->leftJoin("service_state_lang", "service_state_lang.service_state_lang_id=service_history.service_state_lang_id");
		}
		
        $table = array('product_id', 'product_id', 'product_detail.name', 'brands.brand_name', 'brands_collection.brands_collection_name', 'product_category.product_category_name', 'price', 'product_id', 'active', 'product_id');
        $order = $table[$_GET['order'][0]['column']] . ' ' . $_GET['order'][0]['dir'];
        
        if($filterreference != ''){
            $userFilter = TRUE;
            $filterParams[] = ['LIKE', 'service.service_code', $filterreference];
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
                    ->orWhere(['like', 'service.service_code', $_GET['search']['value']]);
            }
                
        } else {
            
            if($userSearch != ''){
                
                // $queryTotalFind
                //     ->where(['like', 'orders.reference', $_GET['search']['value']])
                //     ->orWhere(['like', 'customer.firstname', $_GET['search']['value']]);
                $queryOrder
                    ->orWhere(['like', 'service.service_code', $_GET['search']['value']]);
            }
            
        }
		
// 		if($store_id != 149){
// 			$queryOrder->andFilterWhere(['=','service_detail.service_detail_drop_store_id', $store_id]);
// // 			$queryOrder->orFilterWhere(['=','service.sc_drop_store_id', $store_id]);
// 		}
		
		if($storeid != ""){
			$queryOrder->andFilterWhere(['=','service_detail.service_detail_drop_store_id', $storeid]);
// 			$queryOrder->orFilterWhere(['=','service.sc_drop_store_id', $storeid]);
		}
		
		if($serviceStatus != ""){
			$queryOrder->andFilterWhere(['=','service_history.service_state_lang_id', $serviceStatus]);
		}
		
		$queryOrder->andFilterWhere(['between','service.service_date_update', $orderDateFrom . ' 00:00:00 ', $orderDateTo . ' 23:59:00']);
        
        $total_find = $queryOrder->all();
        $orders = $queryOrder
                ->orderBy('service.service_id desc')
                ->offset($_GET['start'])
                ->limit($_GET['length'])
                ->all();

        // $products = $queryProduct
        //         ->orderBy($order)->offset($_GET['start'])
        //         ->limit($_GET['length'])
        //         ->all();
        


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


                $button = "";

                $numbering++;
                $button = '<div class="btn-group"><a href="' . \yii\helpers\Url::base() . '/servis/view/' . $row->service_id . '" class="btn btn-default" ><i class="fa fa-fw fa-eye"></i> View</a>';

                $button = $button . '</ul></div>';     
				
				if($row->serviceDropStore == 0){
				    $drop_name = 'Ke Alamat Customer';
				}else{
				    $drop_name = $row->serviceDropStore->store_name . ' ' . $row->serviceDropStore->store_slug;
				}
				
                $product_array = array(
                    "No" => $numbering, 
                    "service_code" => $row->service_code, 
                    "customer" => $row->orders->customer->firstname . ' ' . $row->orders->customer->lastname,
                    "pic" => $row->pic_name,
                    "drop" => $row->serviceDetail->serviceDropStore->store_name . ' ' . $row->serviceDetail->serviceDropStore->store_slug,
                    "return" => $drop_name,
                    "service_status" => $row->serviceHistory->serviceStateLang->text,
                    "date" => date_format(date_create($row->service_date_update), 'j F Y g:i A'), 
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
    
    public function actionGetallservicereturn($draw) {
		$connection = Yii::$app->getDb();
		
		$departement = Yii::$app->session->get('userInfo')['departement'];
		
		$orderDateFrom = $_GET['columns'][6]['search']['value'];
		$orderDateTo = $_GET['columns'][7]['search']['value'];
		
		$serviceStatus = $_GET['columns'][8]['search']['value'];
		
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		
		if($orderDateFrom != '' && $orderDateTo != ''){
			
			$orderDateFrom = $_GET['columns'][6]['search']['value'];
			$orderDateTo = $_GET['columns'][7]['search']['value'];
			
		} else {
			
			$orderDateFrom = date('Y-m-d');
			$orderDateTo = date('Y-m-d');
			
		}
		
		$orderDate = "(service.service_date_add BETWEEN '".$orderDateFrom." 00:00:00 ' AND '".$orderDateTo." 23:59:00 ')";
		
		//echo $orderDate; die();
		
		$command = $connection->createCommand("SELECT COUNT(*) AS total FROM service WHERE ".$orderDate."");
		
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
        
        $filterreference = $_GET['columns'][1]['search']['value'];
		$storeid = $_GET['columns'][9]['search']['value'];
        $filterParams = array();
        $searchParams = array();
		
		$queryOrder = Service::find()
			->leftJoin("orders", "orders.orders_id=service.orders_id")
			->leftJoin("service_history", "service_history.service_history_id=service.service_history_id")
			->leftJoin("service_state_lang", "service_state_lang.service_state_lang_id=service_history.service_state_lang_id");
        
		if($store_id != 149 || $storeid != ""){
			$queryOrder = Service::find()
				->leftJoin("orders", "orders.orders_id=service.orders_id")
				->leftJoin("service_detail", "service_detail.service_id=service.service_id")
				->leftJoin("stores", "stores.store_id=service_detail.service_detail_drop_store_id")
				->leftJoin("service_history", "service_history.service_history_id=service.service_history_id")
				->leftJoin("service_state_lang", "service_state_lang.service_state_lang_id=service_history.service_state_lang_id");
		}
		
        $table = array('product_id', 'product_id', 'product_detail.name', 'brands.brand_name', 'brands_collection.brands_collection_name', 'product_category.product_category_name', 'price', 'product_id', 'active', 'product_id');
        $order = $table[$_GET['order'][0]['column']] . ' ' . $_GET['order'][0]['dir'];
        
        if($filterreference != ''){
            $userFilter = TRUE;
            $filterParams[] = ['LIKE', 'service.service_code', $filterreference];
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
                    ->orWhere(['like', 'service.service_code', $_GET['search']['value']]);
            }
                
        } else {
            
            if($userSearch != ''){
                
                // $queryTotalFind
                //     ->where(['like', 'orders.reference', $_GET['search']['value']])
                //     ->orWhere(['like', 'customer.firstname', $_GET['search']['value']]);
                $queryOrder
                    ->orWhere(['like', 'service.service_code', $_GET['search']['value']]);
            }
            
        }
		
		if($store_id != 149){
		
			$queryOrder->andFilterWhere(['=','service.sc_drop_store_id', $store_id]);
		}
		
		if($storeid != ""){
	
			$queryOrder->andFilterWhere(['=','service.sc_drop_store_id', $storeid]);
		}
		
		if($serviceStatus != ""){
			$queryOrder->andFilterWhere(['=','service_history.service_state_lang_id', $serviceStatus]);
		}
		
		$queryOrder->andFilterWhere(['between','service.service_date_add', $orderDateFrom . ' 00:00:00 ', $orderDateTo . ' 23:59:00']);
        
        $total_find = $queryOrder->all();
        $orders = $queryOrder
                ->orderBy('service.service_id desc')
                ->offset($_GET['start'])
                ->limit($_GET['length'])
                ->all();

        // $products = $queryProduct
        //         ->orderBy($order)->offset($_GET['start'])
        //         ->limit($_GET['length'])
        //         ->all();
        


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


                $button = "";

                $numbering++;
                $button = '<div class="btn-group"><a href="' . \yii\helpers\Url::base() . '/servis/view/' . $row->service_id . '" class="btn btn-default" ><i class="fa fa-fw fa-eye"></i> View</a>';

                $button = $button . '</ul></div>';     
				
                $product_array = array(
                    "No" => $numbering, 
                    "service_code" => $row->service_code, 
                    "customer" => $row->orders->customer->firstname . ' ' . $row->orders->customer->lastname,
                    "service_status" => $row->serviceHistory->serviceStateLang->text,
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

	private function RenderService(){
		
		return $this->render('../servis/index');
		
	}
	
	public function actionUpdateresiservice($id){
		$data = Service::findOne($id);
		
		if(Yii::$app->request->post()){
			if($_POST['sc_shipping_carrier'] != "" && $_POST['sc_shipping_carrier'] != "GOJEK"){
				$data->sc_shipping_carrier = $_POST['sc_shipping_carrier'];
				$data->sc_shipping_type = $_POST['sc_shipping_type'];
				$data->sc_tracking_number = $_POST['sc_tracking_number'];
				$data->save();
				
				// send email notification for only spesific service status
				Helpers::sendEmailMandrillUrlAPI(
					$this->renderFile('@app/views/template/mail/warranty_return.php', array(
						"data" => $data
					)), 'Produk dalam Proses Pengembalian', 'notification@thewatch.co', $data->orders->customer->email, ''
				);
				
				if($data->serviceHistory->serviceStateLang->template == 'shipped_by_service_center_direct_to_customer'){
    				Helpers::sendEmailMandrillUrlAPI(
    						$this->renderFile('@app/views/template/mail/warranty_customer_receive.php', array(
    							"data" => $data
    						)), 'Informasi Pengiriman Produk Anda', 'notification@thewatch.co', $data->orders->customer->email, ''
    					);
				}
			}
			
			if($_POST['sc_shipping_carrier'] != "" && $_POST['sc_shipping_carrier'] == "GOJEK"){
				$data->sc_shipping_carrier = $_POST['sc_shipping_carrier'];
				$data->sc_driver_name = $_POST['sc_driver_name'];
				$data->sc_driver_number = $_POST['sc_driver_number'];
				$data->save();
				
				// send email notification for only spesific service status
				Helpers::sendEmailMandrillUrlAPI(
					$this->renderFile('@app/views/template/mail/warranty_return.php', array(
						"data" => $data
					)), 'Produk dalam Proses Pengembalian', 'notification@thewatch.co', $data->orders->customer->email, ''
				);
				
				if($data->serviceHistory->serviceStateLang->template == 'shipped_by_service_center_direct_to_customer'){
				    Helpers::sendEmailMandrillUrlAPI(
						$this->renderFile('@app/views/template/mail/warranty_customer_receive.php', array(
							"data" => $data
						)), 'Informasi Pengiriman Produk Anda', 'notification@thewatch.co', $data->orders->customer->email, ''
					);
				}
			}
			
			if($data->serviceHistory->serviceStateLang->template == 'shipped_by_service_center_direct_to_customer'){
			    
    			$startDate = time();
    			
    			$service_reminder = new \backend\models\ServiceReminder();
    			$service_reminder->service_id = $id;
    			if($_POST['sc_shipping_type'] == 'REG'){
    			    $service_reminder->service_reminder_date = date('Y-m-d H:i:s', strtotime('+2 day', $startDate));
    			}else{
    			    $service_reminder->service_reminder_date = date('Y-m-d H:i:s', strtotime('+1 day', $startDate));
    			}
    			$service_reminder->service_reminder_status = 1;
    			$service_reminder->service_received_status = 0;
    			$service_reminder->service_sent_date = date('Y-m-d H:i:s');
    			$service_reminder->save();
			}
		}
		
		$this->redirect(Yii::$app->urlManager->getBaseUrl() . '/servis/view/' . $id);
	}
	
	public function actionUpdatestatusservice($id){
		
		$data = Service::findOne($id);
		
		if(Yii::$app->request->post()){
			if($_POST['service_state_lang_id'] != 0){
				
				// insert new service history
				$serviceHistoryModel = new ServiceHistory();
				$serviceHistoryModel->service_id = $id;
				$serviceHistoryModel->service_state_lang_id = $_POST['service_state_lang_id'];
				$serviceHistoryModel->date_add = date("Y-m-d H:i:s");
				$serviceHistoryModel->save();
				
				$data->service_history_id = $serviceHistoryModel->service_history_id;
				$data->service_date_update = date("Y-m-d H:i:s");
				$data->save();
				
				$logModel = new Log();
				$logModel->fullname = Yii::$app->session->get('userInfo')['fullname'];
				$logModel->module = Yii::$app->controller->id;
				$logModel->action = "update";
				$logModel->action_text = "user " . Yii::$app->session->get('userInfo')['fullname'] . " update status to " . $serviceHistoryModel->serviceStateLang->name . "";
				$logModel->id_onChanged = $data->service_id;
				$logModel->date_time = date('Y-m-d H:i:s');
				$logModel->save();
				
				if($_POST['service_state_lang_id'] == 13 || $_POST['service_state_lang_id'] == 14){
					// send email notification for only spesific service status
					Helpers::sendEmailMandrillUrlAPI(
						$this->renderFile('@app/views/template/mail/warranty_processed.php', array(
							"data" => $data
						)), 'Perbaikan Sedang Dalam Proses', 'notification@thewatch.co', $data->orders->customer->email, ''
					);
				}
				
				if($_POST['service_state_lang_id'] == 9 || $_POST['service_state_lang_id'] == 10){
					// send email notification for only spesific service status
					Helpers::sendEmailMandrillUrlAPI(
						$this->renderFile('@app/views/template/mail/front/warranty_input.php', array(
							"data" => $data
						)), 'Data Service Anda Berhasil Terinput', 'notification@thewatch.co', $data->orders->customer->email, ''
					);
				}
				
				if($_POST['service_state_lang_id'] == 29 || $_POST['service_state_lang_id'] == 30){
					// send email notification for only spesific service status
					Helpers::sendEmailMandrillUrlAPI(
						$this->renderFile('@app/views/template/mail/warranty_payment_received.php', array(
							"data" => $data
						)), 'Pembayaran Anda Sudah Diterima', 'notification@thewatch.co', $data->orders->customer->email, ''
					);
				}
				
				if($_POST['service_state_lang_id'] == 3 || $_POST['service_state_lang_id'] == 4){
					// send email notification for only spesific service status
					Helpers::sendEmailMandrillUrlAPI(
						$this->renderFile('@app/views/template/mail/warranty_service_center_receive.php', array(
							"data" => $data
						)), 'Produk Anda Telah Sampai di Service Center', 'notification@thewatch.co', $data->orders->customer->email, ''
					);
				}
				
				if($_POST['service_state_lang_id'] == 23 || $_POST['service_state_lang_id'] == 24){
					// send email notification for only spesific service status
					Helpers::sendEmailMandrillUrlAPI(
						$this->renderFile('@app/views/template/mail/warranty_return_store.php', array(
							"data" => $data
						)), 'Ambil Produk Anda di Toko', 'notification@thewatch.co', $data->orders->customer->email, ''
					);
				}
				
				if($_POST['service_state_lang_id'] == 21 || $_POST['service_state_lang_id'] == 22){
					// send email notification for only spesific service status
				// 	Helpers::sendEmailMandrillUrlAPI(
				// 		$this->renderFile('@app/views/template/mail/warranty_customer_receive.php', array(
				// 			"data" => $data
				// 		)), 'Product Service Information', 'notification@thewatch.co', $data->orders->customer->email, ''
				// 	);
				}
			}
		}
		
		$this->redirect(Yii::$app->urlManager->getBaseUrl() . '/servis/view/' . $id);
		
	}
	
	public function actionCreate(){
		
		$this->layout = "storeadmin/dashboard_storeadmin";
		
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		
		if(Yii::$app->request->post()){
			
			$customerEmail = $_POST['customer_email'];
			$invoiceNumber = $_POST['order_reference'];
			
			// if customer first time service
			if($customerEmail != "" && $invoiceNumber != ""){
				
				$customerModel = Customer::findOne(['email' => $_POST['customer_email']]);
				// check if customer not already exist
				if($customerModel == NULL){
					
					$customerPasswd = $this->generateRandomString(8);
					
					// register customer
					$customerModel = new Customer();
					$customerModel->firstname = $_POST['customer_name'];
					$customerModel->email = $_POST['customer_email'];
					$customerModel->phone_number = $_POST['phone_number'];
					$customerModel->passwd = md5($customerPasswd);
					$customerModel->active = 1;
					$customerModel->store_id = $store_id;
					$customerModel->date_add = date('Y-m-d H:i:s');
					$customerModel->save();
					
					// send welcome email
					
					try {
						Helpers::sendEmailMandrillUrlAPI(
							$this->renderFile('@app/views/template/mail/signup.php', array(
								"username" => $customerModel->email, 
								"password" => $customerPasswd
							)), 
							'Welcome To The Watch Co', 
							Yii::$app->params['adminEmail'], 
							$customerModel->email, 
							''
						);
					} catch (Exception $ex) {
						echo $ex->message;
						die();
					}
					
				}
				
				$ordersModel = Orders::findOne(['reference' => $invoiceNumber]);
				if($ordersModel == NULL){
					
					$productModel = Product::findOne($_POST['product_id']);
					
					$ordersModel = new Orders();
					$ordersModel->reference = $invoiceNumber;
					$ordersModel->apps_language_id = 2;
					$ordersModel->customer_id = $customerModel->customer_id;
					$ordersModel->secure_key = $this->generateRandomString(20);
					$ordersModel->payment_method_detail_id = 0;
					$ordersModel->total_cart_item = count($_POST['product_id']);
					$ordersModel->total_cart_item_quantity = 1;
					$ordersModel->total_product_price = $productModel->price;
					$ordersModel->total_shipping = 0;
					$ordersModel->total_shipping_insurance = 0;
					$ordersModel->invoice_date = date('Y-m-d H:i:s');
					$ordersModel->valid = 1;
					$ordersModel->date_add = date('Y-m-d H:i:s');
					$ordersModel->store_id = $store_id;
					$ordersModel->save();
					
					// create order detail
					$orderDetailModel = new OrderDetail();
					$orderDetailModel->orders_id = $ordersModel->orders_id;
					$orderDetailModel->product_id = $_POST['product_id'];
					$orderDetailModel->product_attribute_id = $_POST['product_attribute_id'];
					$orderDetailModel->product_name = $productModel->productDetail->name;
					$orderDetailModel->product_quantity = 1;
					
					$specificPrice = SpecificPrice::findOne(['product_id' => $_POST['product_id']]);
					if($specificPrice != NULL){
						$type = $specificPrice->reduction_type;
						
						if($type == 'percent'){
							$orderDetailModel->reduction_percent = $specificPrice->reduction;
						} elseif($type == 'amount'){
							$orderDetailModel->reduction_amount = $specificPrice->reduction;
						}
						
						$orderDetailModel->product_price = $productModel->price;
					} else {
						$orderDetailModel->product_price = $productModel->price;
					}
					
					$orderDetailModel->original_product_price = $productModel->price;
					$orderDetailModel->product_weight = $productModel->weight;
					$orderDetailModel->save();
					
					if($productModel->productWarranty->product_warranty_year != '' || $productModel->productWarranty->product_warranty_year != 0){
						
						$warrantyModel = Warranty::findOne($_POST['warranty_id']);
						
						if($warrantyModel != NULL){
							// insert order detail warranty
							$orderDetailWarrantyModel = new OrderDetailWarranty();
							$orderDetailWarrantyModel->order_detail_id = $orderDetailModel->order_detail_id;
							$orderDetailWarrantyModel->warranty_id = $warrantyModel->warranty_id;
							$orderDetailWarrantyModel->save();
							
							$sysAutonumberBrandsModel = SysAutonumberBrands::findOne(["brand_id" => $productModel->brands_brand_id]);
							
							// update warranty number and activate it
							if($sysAutonumberBrandsModel != NULL){
								$warrantyModel->warranty_number = Helpers::generateWarrantyNumber(
									$sysAutonumberBrandsModel->sysAutonumber->sys_autonumber_prefix, 
									$sysAutonumberBrandsModel->sysAutonumber->sys_autonumber_char, 
									$sysAutonumberBrandsModel->sysAutonumber->sys_autonumber_value
								);
							}
							
							$warrantyModel->warranty_activated_date = date("Y-m-d H:i:s");
							$warrantyModel->warranty_expired_date = date("Y-m-d H:i:s", strtotime('+'.$productModel->productWarranty->product_warranty_year. ' years'));
							$warrantyModel->warranty_status = 'USED';
							$warrantyModel->save();
							
							// update autonumber brand
							$sysAutonumberModel = SysAutonumber::findOne($sysAutonumberBrandsModel->sys_autonumber_id);
							$sysAutonumberModel->sys_autonumber_value = ($sysAutonumberModel->sys_autonumber_value + 1);
							$sysAutonumberModel->save();
						}
						
					}
					
				}
				
				//$this->redirect(Yii::$app->urlManager->getBaseUrl() . '/servis/create');
			}
			
			$warrantyId = $_POST['warranty_id'];
			$warrantyModel = Warranty::findOne($warrantyId);
			
			if($warrantyModel != NULL){
				
				$serviceModel = new Service();
				$serviceModel->orders_id = $warrantyModel->orderDetailWarranty->orderDetail->orders_id;
				$serviceModel->service_date_add = date('Y-m-d H:i:s');
				
				$sysAutonumberModel = SysAutonumber::findOne(["sys_autonumber_model" => "Service"]);
				
				$serviceModel->service_code = Helpers::generateWarrantyNumber(
					$sysAutonumberModel->sys_autonumber_prefix, 
					$sysAutonumberModel->sys_autonumber_char, 
					$sysAutonumberModel->sys_autonumber_value
				);
				
				$sysAutonumberModel->sys_autonumber_value = ($sysAutonumberModel->sys_autonumber_value + 1);
				$sysAutonumberModel->save();
				
				$serviceModel->sc_shipping_carrier = "";
				$serviceModel->sc_tracking_number = "";
				$serviceModel->customer_shipping_number = "";
				$serviceModel->customer_shipping_number_image = "";
				$serviceModel->service_fee = 0;
				$serviceModel->save();
				
				$logModel = new Log();
				$logModel->fullname = Yii::$app->session->get('userInfo')['fullname'];
				$logModel->module = Yii::$app->controller->id;
				$logModel->action = "create";
				$logModel->action_text = "user " . Yii::$app->session->get('userInfo')['fullname'] . " create " . Yii::$app->controller->id;
				$logModel->id_onChanged = $serviceModel->service_id;
				$logModel->date_time = date('Y-m-d H:i:s');
				$logModel->save();
				
				$serviceList = $_POST['service_list'];
				foreach($serviceList as $key => $value){
					
					if($key == 1 || $key == 2 || $key == 3){
						$serviceTypeStoreModel = ServiceTypeStore::findOne(["store_id" => $store_id, "service_type_id" => $key]);
					} else {
						$serviceTypeStoreModel = ServiceTypeStore::findOne(["service_type_id" => $key]);
					}
					
					//if($serviceTypeStoreModel != NULL){
						$serviceDetailModel = new ServiceDetail();
						$serviceDetailModel->service_id = $serviceModel->service_id;
						$serviceDetailModel->order_detail_warranty_id = $warrantyModel->orderDetailWarranty->order_detail_warranty_id;
						$serviceDetailModel->service_type_store_id = $serviceTypeStoreModel->service_type_store_id;
						$serviceDetailModel->service_detail_drop_store_id = $store_id;
						$serviceDetailModel->service_other_text = $_POST['service_other_text'];
						$serviceDetailModel->save();
					//}
				}
				
				// drop by customer to store
				$serviceHistoryModel = new ServiceHistory();
				$serviceHistoryModel->service_id = $serviceModel->service_id;
				$serviceHistoryModel->service_state_lang_id = 6;
				$serviceHistoryModel->date_add = date('Y-m-d H:i:s');
				$serviceHistoryModel->save();
				
				$logModel = new Log();
				$logModel->fullname = Yii::$app->session->get('userInfo')['fullname'];
				$logModel->module = Yii::$app->controller->id;
				$logModel->action = "update";
				$logModel->action_text = "user " . Yii::$app->session->get('userInfo')['fullname'] . " update " . Yii::$app->controller->id . " status to " . $serviceHistoryModel->serviceStateLang->name;
				$logModel->id_onChanged = $serviceModel->service_id;
				$logModel->date_time = date('Y-m-d H:i:s');
				$logModel->save();
				
				sleep(2);
				
				// received by store staff
				$serviceHistoryModel = new ServiceHistory();
				$serviceHistoryModel->service_id = $serviceModel->service_id;
				$serviceHistoryModel->service_state_lang_id = 8;
				$serviceHistoryModel->date_add = date('Y-m-d H:i:s');
				$serviceHistoryModel->save();
				
				$logModel = new Log();
				$logModel->fullname = Yii::$app->session->get('userInfo')['fullname'];
				$logModel->module = Yii::$app->controller->id;
				$logModel->action = "update";
				$logModel->action_text = "user " . Yii::$app->session->get('userInfo')['fullname'] . " update " . Yii::$app->controller->id . " status to " . $serviceHistoryModel->serviceStateLang->name;
				$logModel->id_onChanged = $serviceModel->service_id;
				$logModel->date_time = date('Y-m-d H:i:s');
				$logModel->save();
				
				$serviceModel = Service::findOne($serviceHistoryModel->service_id);
				$serviceModel->service_history_id = $serviceHistoryModel->service_history_id;
				$serviceModel->product_condition_notes = $_POST['product_condition_notes'];
				$serviceModel->save();
			}
			
			$this->redirect(Yii::$app->urlManager->getBaseUrl() . '/servis/index');
		}
		
		return $this->render('../servis/create');
	}
	
	public function actionSetdroplocation($id){
		if(Yii::$app->request->post()){
			$data = Service::findOne($id);
			$data->sc_drop_store_id = $_POST['store_id'];
			$data->save();
			
			$this->redirect(Yii::$app->urlManager->getBaseUrl() . '/servis/view/' . $id);
		}
	}
	public function actionUpdatereturnmethod($id){
		if(Yii::$app->request->post()){
		    $data = Service::findOne($id);
		    if($data->sc_drop_store_id != 0){
		        $before = 'drop store';
		    }else{
		        $before = 'direct to customer';
		    }
		    
		    if($_POST['drop_location'] == 'store'){
    			
    			$data->sc_drop_store_id = $_POST['store_id'];
    			$data->sc_drop_address = '';
    			$data->sc_drop_telp = '';
    			$data->sc_drop_name = '';
    			$data->save();
    			
    			$after = 'drop store';
		    }else{
		       
    			$data->sc_drop_store_id = 0;
    			$data->sc_drop_address = $_POST['sc_drop_address'];
    			$data->sc_drop_telp = $_POST['sc_drop_telp'];
    			$data->sc_drop_name = $_POST['sc_drop_name'];
    			$data->save();
    			
    			$after = 'direct to customer';
		    }
		    
		    $logModel = new Log();
				$logModel->fullname = Yii::$app->session->get('userInfo')['fullname'];
				$logModel->module = Yii::$app->controller->id;
				$logModel->action = "update";
				$logModel->action_text = "user " . Yii::$app->session->get('userInfo')['fullname'] . " update return method from [". $before."] to [" . $after . "]";
				$logModel->id_onChanged = $id;
				$logModel->date_time = date('Y-m-d H:i:s');
				$logModel->save();
				
			$this->redirect(Yii::$app->urlManager->getBaseUrl() . '/servis/view/' . $id);
		}
	}
	
	public function actionUpdatestore($id){
		if(Yii::$app->request->post()){
			$service_details = \backend\models\ServiceDetail::find()->where(['service_id'=>$id])->all();
		    foreach($service_details as $service_detail){
		        $old_store_id = \backend\models\Stores::find()->where(['store_id'=>$service_detail->service_detail_drop_store_id])->one();
		        $new_store_id = \backend\models\Stores::find()->where(['store_id'=>$_POST['store_drop_id']])->one();
		        
		        $service_detail_update = \backend\models\ServiceDetail::find()->where(['service_detail_id'=>$service_detail->service_detail_id])->one();
		        $service_detail_update->service_detail_drop_store_id = $_POST['store_drop_id'];
		        $service_detail_update->update();
		        
		        $logModel = new Log();
				$logModel->fullname = Yii::$app->session->get('userInfo')['fullname'];
				$logModel->module = Yii::$app->controller->id;
				$logModel->action = "update";
				$logModel->action_text = "user " . Yii::$app->session->get('userInfo')['fullname'] . " update drop store from ". $old_store_id->store_name." ".$old_store_id->store_slug ." to " . $new_store_id->store_name." ".$new_store_id->store_slug . "";
				$logModel->id_onChanged = $id;
				$logModel->date_time = date('Y-m-d H:i:s');
				$logModel->save();
		    }
			
			$this->redirect(Yii::$app->urlManager->getBaseUrl() . '/servis/view/' . $id);
		}
	}
	
	public function actionPicname($id){
		if(Yii::$app->request->post()){
			$data = Service::findOne($id);
			$data->pic_name = $_POST['pic_name'];
			$data->save();
			
			$this->redirect(Yii::$app->urlManager->getBaseUrl() . '/servis/view/' . $id);
		}
	}
	
	public function actionPicnamelang($id){
		if(Yii::$app->request->post()){
			$data = Service::findOne($id);
			
			// insert new service history
				$serviceHistoryModel = new ServiceHistory();
				$serviceHistoryModel->service_id = $id;
				$serviceHistoryModel->service_state_lang_id = $_POST['pic_state_lang_id'];
				$serviceHistoryModel->date_add = date("Y-m-d H:i:s");
				$serviceHistoryModel->save();
				
				$data->service_history_id = $serviceHistoryModel->service_history_id;
				$data->service_date_update = date("Y-m-d H:i:s");
				$data->pic_name = $_POST['pic_name'];
				$data->save();
				
				$logModel = new Log();
				$logModel->fullname = Yii::$app->session->get('userInfo')['fullname'];
				$logModel->module = Yii::$app->controller->id;
				$logModel->action = "update";
				$logModel->action_text = "user " . Yii::$app->session->get('userInfo')['fullname'] . " update status to " . $serviceHistoryModel->serviceStateLang->name . "";
				$logModel->id_onChanged = $data->service_id;
				$logModel->date_time = date('Y-m-d H:i:s');
				$logModel->save();
				
			$this->redirect(Yii::$app->urlManager->getBaseUrl() . '/servis/view/' . $id);
		}
	}
	
	public function actionStoredroplocation($id){
		if(Yii::$app->request->post()){
			$data = Service::findOne($id);
			$data->store_shipping_carrier = $_POST['store_shipping_carrier'];
			$data->store_shipping_number = $_POST['store_shipping_number'];
			$data->store_driver_name = $_POST['store_driver_name'];
			$data->store_driver_number = $_POST['store_driver_number'];
			$data->save();
			
			$this->redirect(Yii::$app->urlManager->getBaseUrl() . '/servis/view/' . $id);
		}
	}
	
	private function generateUniqueCode($digits){
        
        $format = str_pad(rand(0, 99), $digits, '0', STR_PAD_LEFT);
     
        return $format;
	}
	
	public function actionView($id){
		
		$this->layout = "storeadmin/dashboard_storeadmin";
		
		$data = Service::findOne($id);
		$service_details = \backend\models\ServiceDetail::find()->where(['service_id'=>$id])->all();
		$service_detail_one = \backend\models\ServiceDetail::find()->where(['service_id' => $id])->orderBy('service_id ASC')->one();
		
		if(Yii::$app->request->post()){
			
			$data->service_fee = $_POST['service_fee'];
			$data->service_fee_unique_code = $this->generateUniqueCode(2);
			$data->sc_notes = $_POST['sc_notes'];
			$data->save();
			
			// insert new service history
			$serviceHistoryModel = new ServiceHistory();
			$serviceHistoryModel->service_id = $id;
			$serviceHistoryModel->service_state_lang_id = 31;
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
    				)), 'Informasi Biaya Perbaikan Service', 'notification@thewatch.co', $data->orders->customer->email, ''
    			);
			
			}else{
			    Helpers::sendEmailMandrillUrlAPI(
    				$this->renderFile('@app/views/template/mail/warranty_payment_store.php', array(
    					"data" => $data
    				)), 'Informasi Biaya Perbaikan Service', 'notification@thewatch.co', $data->orders->customer->email, ''
    			);
			}
			
			$this->redirect(Yii::$app->urlManager->getBaseUrl() . '/servis/view/' . $id);
			
		}
		
		return $this->render('../servis/view', array(
			"data" => $data,
			"service_details"=>$service_details,
			"service_detail_one"=>$service_detail_one
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
		
		return $this->RenderService();
    }
    
    /**
     * Lists all group models.
     * @return mixed
     */
    public function actionReturn() {
		
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
				$queryOrder->andFilterWhere(['=','service.sc_drop_store_id', $store_id]);
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
		
		return $this->render('../servis/return');
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
        if (($model = \backend\models\Warranty::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
