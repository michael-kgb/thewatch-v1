<?php

namespace backend\controllers;

use Yii;
use common\models\group;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Orders;
use common\components\Helpers;

/**
 * groupController implements the CRUD actions for group model.
 */
class FlashsaleController extends Controller {

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
	
    /**
     * Lists all group models.
     * @return mixed
     */
    public function actionIndex() {
		
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		
        $data = \backend\models\Orders::find()
			->joinWith([
				"customer",
				"customeraddress",
				"paymentmethoddetail"
			])
			->orderBy('orders.orders_id desc')
			->where(['orders.store_id' => $store_id])
			->andWhere(['orders.flash_sale' => 1])
			->limit(500)
			->all();
				
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();
        return $this->render('index', [
			'data' => $data, 'add_access' => $permissions['add_access'], 'update_access' => $permissions['update_access'], 'delete_access' => $permissions['delete_access']
        ]);
    }

    /**
     * Finds the group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = \backend\models\Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionStatusFlashSale(){
		$status = $_GET['status'];
		$orderId = $_GET['orderId'];
		
		if($status == '' || $orderId == ''){
			return;
		}
		
		switch($status){
			
			case "PENDING":
			
				$ordersModel = Orders::findOne($orderId);
				
				if($ordersModel != NULL){
					$ordersModel->flash_sale_approved = $status;
					$ordersModel->save();
				}
			
			break;
			
			case "APPROVED":
			
				$ordersModel = Orders::findOne($orderId);
				
				if($ordersModel != NULL){
					$ordersModel->flash_sale_approved = $status;
					$ordersModel->save();
				}
				
				if($ordersModel->paymentmethoddetail->paymentMethod->payment_method_alias == "va"){
					$this->sendChargeRequest($ordersModel);
				}
				
				if($ordersModel->paymentmethoddetail->paymentMethod->payment_method_alias == "ew"){
					$this->sendChargeRequest($ordersModel);
				}
				
				
				$customerInfo = array(
					"fname" => $ordersModel->customer->firstname,
					"payment_method_alias" => $ordersModel->paymentmethoddetail->paymentMethod->payment_method_alias,
					"orderid" => $orderId,
					"paymentid" => $ordersModel->paymentmethoddetail->payment_id,
					"customer_address_id" => $ordersModel->customer_address_id,
					"email" => $ordersModel->customer->email,
					"ordernumber" => $ordersModel->reference,
					"shippingMethod" => $ordersModel->carrier_cost_id,
					"unique_code" => $ordersModel->unique_code,
					"total_shipping" => $ordersModel->total_shipping,
					"total_shipping_insurance" => $ordersModel->total_shipping_insurance,
					"total_special_promo" => $ordersModel->total_special_promo,
					"special_promo_id" => $ordersModel->special_promo_id
				);
				
				Helpers::sendEmailMandrillUrlAPI(
					$this->renderFile('@app/views/template/mail/order_placed_flash_sale.php', array(
						"customerInfo" => $customerInfo,
					)), \Yii::$app->params['orderPlacedSubjectEmail'], \Yii::$app->params['adminEmail'], $customerInfo["email"], ''
				);
				
			break;
			
			case "DISAPPROVED":
			
				$ordersModel = Orders::findOne($orderId);
				
				if($ordersModel != NULL){
					$ordersModel->flash_sale_approved = $status;
					$ordersModel->save();
				}
			
			break;
			
		}
		
		return $this->redirect(['index']);
	}
	
	private function sendChargeRequest($orders)
	{
		$items = \backend\models\OrderDetail::find()->where(['orders_id' => $orders->orders_id])->all();
		$itemsDetail = array();
		
		$totalShipping = 0;
		$grandtotal = 0;
		$voucherAmount = 0;
		
		// product order
		if(count($items) > 0){
			foreach($items as $item){
				$itemsDetail[] = array(
					"id" => $item->product_id . "",
					"name" => $item->product_name . "",
					"price" => $item->original_product_price,
					"quantity" => $item->product_quantity
				);	
			}
		}
		
		// voucher code 
		$orderCartRule = \backend\models\OrderCartRule::findOne(['orders_id' => $orders->orders_id]);
		
		if($orderCartRule != NULL){
			$itemsDetail[] = array(
				"id" => $orderCartRule->cart_rule_id,
				"price" => -round($orderCartRule->value),
				"quantity" => 1,
				"name" => 'discount voucher'
			);
			
			$voucherAmount = $orderCartRule->value;
		}
		
		// special promo
		if($orders->total_special_promo != 0){
			$itemsDetail[] = array(
				"id" => "0",
				"price" => -round($orders->total_special_promo),
				"quantity" => 1,
				"name" => 'Special Promo '.$orders->specialPromo->promo_name
			);
		   
		}
		
		
		if($orders->total_shipping_insurance != 0){
			// shipping + insurance
			$itemsDetail[] = array(
				"id" => "0",
				"name" => "SHIPPING + INSURANCE",
				"price" => $orders->total_shipping + $orders->total_shipping_insurance,
				"quantity" => 1
			);
			
			$totalShipping = $orders->total_shipping + $orders->total_shipping_insurance;
			
		} else {
			// shipping
			$itemsDetail[] = array(
				"id" => "0",
				"name" => "SHIPPING",
				"price" => $orders->total_shipping,
				"quantity" => 1
			);
			
			$totalShipping = $orders->total_shipping;
		}
		
		$grandtotal += $orders->total_product_price;
		$grandtotal += $totalShipping;
		$grandtotal -= $voucherAmount;
		$grandtotal -= $orders->total_special_promo;
		
		$transaction_details = array(
			'order_id' => $orders->reference,
			'gross_amount' => round($grandtotal) 
		);
		
		$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
		
		$customer = \backend\models\Customer::findOne(["customer_id" => $orders->customer_id]);
		$customerAddress = \backend\models\CustomerAddress::findOne(["customer_address_id" => $orders->customer_address_id]);
		
		$billing_address = array(
			'first_name' => $customer->firstname,
			'last_name' => $customer->lastname,
			'address' => \backend\models\CustomerAddress::findOne(["customer_id" => $customer->customer_id])->address1,
			'city' => \backend\models\State::findOne(["state_id" => $customerAddress->state_id])->name,
			'postal_code' => $customerAddress->postcode,
			'phone' => $customerAddress->phone,
			'country_code' => 'IDN'
		);

		$shipping_address = array(
			'first_name' => $customer->firstname,
			'last_name' => $customer->lastname,
			'address' => \backend\models\CustomerAddress::findOne(["customer_id" => $customer->customer_id])->address1,
			'city' => \backend\models\State::findOne(["state_id" => $customerAddress->state_id])->name,
			'postal_code' => $customerAddress->postcode,
			'phone' => $customerAddress->phone,
			'country_code' => 'IDN'
		);

		// Populate customer's info
		$customer_details = array(
			'first_name' => $customer->firstname,
			'last_name' => $customer->lastname,
			'email' => $customer->email,
			'phone' => $customerAddress->phone,
			'billing_address' => $billing_address,
			'shipping_address' => $shipping_address
		);
		
		if(strtolower($bankName[0]) == "mandiri"){
			$transaction_data = array(
				'payment_type' => 'echannel',
				'echannel' => array(
					'bill_info1' => 'Payment For:',
					'bill_info2' => 'The Watch Co.'
				),
				'transaction_details' => $transaction_details,
				'item_details' => $itemsDetail,
				'customer_details' => $customer_details
			);
		
		} elseif(strtolower($bankName[0]) == "go-pay") {
			$transaction_data = array(
				'payment_type' => 'gopay',
				'transaction_details' => $transaction_details,
				'item_details' => $itemsDetail,
				'customer_details' => $customer_details
			);
		
		} elseif(strtolower($bankName[0]) == "bca") {
			$transaction_data = array(
				'payment_type' => 'bank_transfer',
				'bank_transfer' => array(
					'bank' => strtolower($bankName[0]),
					'va_number' => ''
				),
				'transaction_details' => $transaction_details,
				'item_details' => $itemsDetail,
				'customer_details' => $customer_details
			);
		} else {
			$transaction_data = array(
				'payment_type' => 'bank_transfer',
				'bank_transfer' => array(
					'bank' => strtolower($bankName[0])
				),
				'transaction_details' => $transaction_details,
				'item_details' => $itemsDetail,
				'customer_details' => $customer_details
			);
		}
		 
		require_once \Yii::$app->getBasePath() . '/include/Veritrans.php';
		
		\Veritrans_Config::$serverKey = 'VT-server-Nj6-jo8mSfy6IOwGBBUGa3LA';

		\Veritrans_Config::$isProduction = true;
		
		try {
			$response = \Veritrans_VtDirect::charge($transaction_data);
		} catch (Exception $e) {
			echo $e->getMessage();
			die();
			//$this->redirect(\yii\helpers\Url::base());
		}
		
		$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
			
		if(strtolower($bankName[0]) == "go-pay") {
			
			// save transaction log from midtrans
			$valog = new \backend\models\VaLog();
			
			$valog->va_number = "";
			$valog->va_bank = $bankName[0];
			$valog->transaction_time = $response->transaction_time;
			$valog->transaction_status = $response->transaction_status;
			$valog->payment_type = $response->payment_type;
			$valog->order_id = $response->order_id;
			$valog->gross_amount = $response->gross_amount;
			$valog->payment_amounts_paid_at = '';
			$valog->payment_amounts_amount = '';
			$valog->action_qr_code_url = $response->actions[0]->url;
			$valog->action_deeplink_redirect = $response->actions[1]->url;
			$valog->action_get_status = $response->actions[2]->url;
			$valog->action_cancel = $response->actions[3]->url;
			$valog->save();
		}
	}
}
