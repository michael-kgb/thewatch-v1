<?php

namespace backend\controllers;

use Yii;
use common\models\group;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Warranty;
use backend\models\ServiceClaimManual;
use backend\models\ServiceHistory;
use backend\models\Service;
use backend\models\Orders;
use backend\models\OrderDetail;
use common\components\Helpers;
use backend\models\SysAutonumberBrands;
use backend\models\SpecificPrice;
use backend\models\OrderDetailWarranty;
use backend\models\SysAutonumber;

/**
 * groupController implements the CRUD actions for group model.
 */
class ServismanualController extends Controller {

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
	
	public function actionGetallservice($draw) {
		$connection = Yii::$app->getDb();
		
		$orderDateFrom = $_GET['columns'][6]['search']['value'];
		$orderDateTo = $_GET['columns'][7]['search']['value'];
		
		$serviceStatus = $_GET['columns'][3]['search']['value'];
		
		if($orderDateFrom != '' && $orderDateTo != ''){
			
			$orderDateFrom = $_GET['columns'][6]['search']['value'];
			$orderDateTo = $_GET['columns'][7]['search']['value'];
			
		} else {
			
			$orderDateFrom = date('Y-m-d');
			$orderDateTo = date('Y-m-d');
			
		}
		
		$orderDate = "(service_claim_manual.service_claim_manual_date_add BETWEEN '".$orderDateFrom." 00:00:00 ' AND '".$orderDateTo." 23:59:00 ')";
		
		$command = $connection->createCommand("SELECT COUNT(*) AS total FROM service_claim_manual WHERE ".$orderDate."");
		
		$data = $command->queryAll();
		
		foreach($data as $row){
			$total_orders = $row['total'];
		}
        
        $userFilter = FALSE;
        $userSearch = $_GET['search']['value'];
        
        $filterreference = $_GET['columns'][1]['search']['value'];
		
        $filterParams = array();
        $searchParams = array();
        
        $queryOrder = ServiceClaimManual::find()
			->leftJoin("customer", "customer.customer_id=service_claim_manual.customer_id");

        $table = array('product_id', 'product_id', 'product_detail.name', 'brands.brand_name', 'brands_collection.brands_collection_name', 'product_category.product_category_name', 'price', 'product_id', 'active', 'product_id');
        $order = $table[$_GET['order'][0]['column']] . ' ' . $_GET['order'][0]['dir'];
        
        if($filterreference != ''){
            $userFilter = TRUE;
            $filterParams[] = ['LIKE', 'service_claim_manual.reference', $filterreference];
        }

        if($userFilter){
            
            foreach($filterParams as $filter){
                $queryOrder
                    ->andFilterWhere($filter);
            }
            
            if($userSearch != ''){
                $queryOrder
                    ->orWhere(['like', 'service_claim_manual.reference', $_GET['search']['value']]);
            }
                
        } else {
            
            if($userSearch != ''){
                $queryOrder
                    ->orWhere(['like', 'service_claim_manual.reference', $_GET['search']['value']]);
            }
            
        }
		
		if($serviceStatus != 0){
			$queryOrder->andFilterWhere(['=','service_claim_manual.service_claim_manual_status', $serviceStatus]);
		}
		
		$queryOrder->andFilterWhere(['between','service_claim_manual.service_claim_manual_date_add', $orderDateFrom . ' 00:00:00 ', $orderDateTo . ' 23:59:00']);
		
        $total_find = $queryOrder->all();
        $orders = $queryOrder
                ->orderBy('service_claim_manual.service_claim_manual_id ASC')
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
                $button = '<div class="btn-group"><a href="' . \yii\helpers\Url::base() . '/servismanual/view/' . $row->service_claim_manual_id . '" class="btn btn-default" ><i class="fa fa-fw fa-eye"></i> View</a>';

              
                $button = $button . '</ul></div>';

                $product_array = array(
                    "No" => $numbering, 
                    "reference" => $row->reference, 
					"customer" => $row->customer->firstname . ' ' . $row->customer->lastname,
					"status" => $row->service_claim_manual_status,
					"date" => date_format(date_create($row->service_claim_manual_date_add), 'j F Y g:i A'), 
                    "action" => $button,
					"claim_service_manual_date_from" => "",
					"claim_service_manual_date_to" => ""
                );
                array_push($columns, $product_array);
            }
        }

        $data = $data . json_encode($columns) . '}';
        return $data;
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
			
			return $this->render('../servismanual/index');
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
	
	public function actionView($id){
		
		$data = ServiceClaimManual::findOne($id);
		
		if(Yii::$app->request->post()){
			
			// if status already valid
			if($data->service_claim_manual_status == "Valid"){
				$data->store_id = $_POST['store_id'];
				$data->other_store = $_POST['other_store'];
				$data->save();
				
				$warrantyModel = Warranty::findOne(["warranty_code" => $data->warranty_code, "warranty_status" => "USED"]);
				if($warrantyModel != NULL){
				    $warrantyModel->warranty_activated_date = date("Y-m-d H:i:s", strtotime($_POST['active_date']));
					$warrantyModel->warranty_expired_date = date("Y-m-d H:i:s", strtotime('+'.$data->product->productWarranty->product_warranty_year. ' years',strtotime($_POST['active_date'])));
					$warrantyModel->save();
				}
			}
			
			if($_POST['service_claim_manual_status'] == "Valid"){
				
				$ordersModel = Orders::findOne(['reference' => $data->reference]);
				if($ordersModel == NULL){
					$ordersModel = new Orders();
					$ordersModel->reference = $data->reference;
					$ordersModel->apps_language_id = 2;
					$ordersModel->customer_id = $data->customer_id;
					$ordersModel->secure_key = $this->generateRandomString(20);
					$ordersModel->payment_method_detail_id = 0;
					$ordersModel->total_cart_item = count($data->product_id);
					$ordersModel->total_cart_item_quantity = 1;
					$ordersModel->total_product_price = $data->product->price;
					$ordersModel->total_shipping = 0;
					$ordersModel->total_shipping_insurance = 0;
					$ordersModel->invoice_date = date('Y-m-d H:i:s');
					$ordersModel->valid = 1;
					$ordersModel->date_add = date('Y-m-d H:i:s');
					$ordersModel->store_id = $_POST['store_id'];
					$ordersModel->save();
					
					// create order detail
					$orderDetailModel = new OrderDetail();
					$orderDetailModel->orders_id = $ordersModel->orders_id;
					$orderDetailModel->product_id = $data->product_id;
					$orderDetailModel->product_attribute_id = $data->product_attribute_id;
					$orderDetailModel->product_name = $data->product->productDetail->name;
					$orderDetailModel->product_quantity = 1;
					
					$specificPrice = SpecificPrice::findOne(['product_id' => $data->product_id]);
					if($specificPrice != NULL){
						$type = $specificPrice->reduction_type;
						
						if($type == 'percent'){
							$orderDetailModel->reduction_percent = $specificPrice->reduction;
						} elseif($type == 'amount'){
							$orderDetailModel->reduction_amount = $specificPrice->reduction;
						}
						
						$orderDetailModel->product_price = $data->product->price;
					} else {
						$orderDetailModel->product_price = $data->product->price;
					}
					
					$orderDetailModel->original_product_price = $data->product->price;
					$orderDetailModel->product_weight = $data->product->weight;
					$orderDetailModel->save();
					
					if($data->product->productWarranty->product_warranty_year != '' || $data->product->productWarranty->product_warranty_year != 0){
						
						$warrantyModel = Warranty::findOne(["warranty_code" => $data->warranty_code, "warranty_status" => "AVAILABLE"]);
						
						if($warrantyModel != NULL){
							// insert order detail warranty
							$orderDetailWarrantyModel = new OrderDetailWarranty();
							$orderDetailWarrantyModel->order_detail_id = $orderDetailModel->order_detail_id;
							$orderDetailWarrantyModel->warranty_id = $warrantyModel->warranty_id;
							$orderDetailWarrantyModel->save();
							
							$sysAutonumberBrandsModel = SysAutonumberBrands::findOne(["brand_id" => $data->brand_id]);
							
							// update warranty number and activate it
							if($sysAutonumberBrandsModel != NULL){
								$warrantyModel->warranty_number = Helpers::generateWarrantyNumber(
									$sysAutonumberBrandsModel->sysAutonumber->sys_autonumber_prefix, 
									$sysAutonumberBrandsModel->sysAutonumber->sys_autonumber_char, 
									$sysAutonumberBrandsModel->sysAutonumber->sys_autonumber_value
								);
							}
							
							
							$warrantyModel->warranty_activated_date = date("Y-m-d H:i:s", strtotime($_POST['active_date']));
							$warrantyModel->warranty_expired_date = date("Y-m-d H:i:s", strtotime('+'.$data->product->productWarranty->product_warranty_year. ' years',strtotime($_POST['active_date'])));
							$warrantyModel->warranty_status = 'USED';
							$warrantyModel->save();
							
							// update autonumber brand
							$sysAutonumberModel = SysAutonumber::findOne($sysAutonumberBrandsModel->sys_autonumber_id);
							$sysAutonumberModel->sys_autonumber_value = ($sysAutonumberModel->sys_autonumber_value + 1);
							$sysAutonumberModel->save();
						}
						
					}
					
					$data->service_claim_manual_status = "Valid";
					$data->store_id = $_POST['store_id'];
					$data->other_store = $_POST['other_store'];
					$data->save();
					
					$model = array(
						"warrantyNumber" => $warrantyModel->warranty_number,
						"claimServiceManual" => $data
					);
					
					// send email notification for only spesific service status
					Helpers::sendEmailMandrillUrlAPI(
						$this->renderFile('@app/views/template/mail/warranty_active.php', array(
							"data" => $model,
						)), 'Garansi Digital Anda Telah Aktif', 'notification@thewatch.co', $data->customer->email, ''
					);
				}
			}
			
			if($_POST['service_claim_manual_status'] == "Invalid"){
				$data->service_claim_manual_status = "Invalid";
				$data->save();
				
				$warrantyModel = Warranty::findOne(["warranty_code" => $data->warranty_code, "warranty_status" => "USED"]);
				if($warrantyModel != NULL){
				    $warrantyModel->warranty_status = 'AVAILABLE';
					$warrantyModel->save();
				}
				
				$model = [];
				// send email notification for only spesific service status
					Helpers::sendEmailMandrillUrlAPI(
						$this->renderFile('@app/views/template/mail/warranty_invalid.php', array(
							"data" => $model,
						)), 'Data Garansi Anda Tidak Valid', 'notification@thewatch.co', $data->customer->email, ''
					);
			}
			
			return $this->redirect(Yii::$app->urlManager->getBaseUrl() . '/servismanual/view/' . $id);
			
		}
		
		$departement = Yii::$app->session->get('userInfo')['departement'];
		
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		
		if($departement == "Customer Service & After Sales"){
			$this->layout = "storeadmin/dashboard_storeadmin";
		}
		
		return $this->render('../servismanual/view', array(
			"data" => $data
		));
	}

    /**
     * Finds the group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Service::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
