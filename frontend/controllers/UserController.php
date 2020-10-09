<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\CustomerForm;
use yii\web\Session;

use yii\base\Event;
use yii\base\View;
use yii\base\ViewEvent;
use yii\debug\Panel;

/**
 * Site controller
 */
class UserController extends \frontend\core\controller\FrontendController {

    public $breadcrumb = ["Brands"];
    public $title = "";
	
	private $_viewFiles = [];

    public function init()
    {
        parent::init();
        Event::on(View::className(), View::EVENT_BEFORE_RENDER, function (ViewEvent $event) {
            $this->_viewFiles[] = $event->sender->getViewFile();
        });
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionEditProfile() {
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');

        $this->title = 'Edit Profile';
        return $this->render('edit-profile');
    }
    
    public function actionChangePassword() {
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');

        $this->title = 'Change Password';
        return $this->render('change-password');
    }

    public function actionChangeEmail() {
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');

        $this->title = 'Change Email';
        return $this->render('change-email');
    }

    public function actionProfile() {

        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');

        $this->title = 'My Profile';
        return $this->render('profile');
    }

    public function actionShipping($action = NULL, $id = 0) {

        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');

        switch ($action) {
            case "create":

                $this->title = 'Add Shipping Adress';
                return $this->render('shipping/shippingformcreate');

                break;

            case "edit":

                $shipping = \backend\models\CustomerAddress::findOne(["customer_address_id" => $id]);

                $this->title = 'Edit Shipping Adress';
                return $this->render('shipping/shippingform', array("shipping" => $shipping));

                break;

            case "detail":

                break;

            case "delete":

                $customer_address = \backend\models\CustomerAddress::findOne($id);
                if(!empty($customer_address)){
                    $customer_address->deleted = 1;
                    $customer_address->save();
                    
                    for ($i = 0; $i < count($_SESSION['customerInfo']['shippingInformation']); $i++) {
                        if ($_SESSION['customerInfo']['shippingInformation'][$i]['customer_address_id'] == $id) {
                            unset($_SESSION['customerInfo']['shippingInformation'][$i]);
                            break;
                        }
                    }
                    $_SESSION['customerInfo']['shippingInformation'] = array_values($_SESSION['customerInfo']['shippingInformation']);
                }
                return $this->redirect('../../shipping');

            case "update":
                $customer_address = \backend\models\CustomerAddress::findOne($id);
                if (!empty($customer_address)) {
                    $customer_address->firstname = htmlspecialchars(stripslashes(trim($_POST['firstname'])));
                    $customer_address->lastname = htmlspecialchars(stripslashes(trim($_POST['lastname'])));
                    $customer_address->phone = htmlspecialchars(stripslashes(trim($_POST['phone'])));
                    $customer_address->address1 = htmlspecialchars(stripslashes(trim($_POST['address1'])));
                    $customer_address->address_label = htmlspecialchars(stripslashes(trim($_POST['address_label'])));
                    $customer_address->postcode = htmlspecialchars(stripslashes(trim($_POST['postcode'])));
                    $customer_address->province_id = $_POST['province_id'];
                    $customer_address->state_id = $_POST['state_id'];
                    $customer_address->district_id = $_POST['district_id'];
                    $customer_address->save();

                    for ($i = 0; $i < count($_SESSION['customerInfo']['shippingInformation']); $i++) {
                        if ($_SESSION['customerInfo']['shippingInformation'][$i]['customer_address_id'] == $id) {
                            $_SESSION['customerInfo']['shippingInformation'][$i]['customer_address_id'] = $id;
                            $_SESSION['customerInfo']['shippingInformation'][$i]['fname'] = $_POST['firstname'];
                            $_SESSION['customerInfo']['shippingInformation'][$i]['lname'] = $_POST['lastname'];
                            $_SESSION['customerInfo']['shippingInformation'][$i]['address'] = $_POST['address1'];
                            $_SESSION['customerInfo']['shippingInformation'][$i]['address_label'] = $_POST['address_label'];
                            $_SESSION['customerInfo']['shippingInformation'][$i]['phone'] = $_POST['phone'];
                            $_SESSION['customerInfo']['shippingInformation'][$i]['postcode'] = $_POST['postcode'];
                            $_SESSION['customerInfo']['shippingInformation'][$i]['province_id'] = $_POST['province_id'];
                            $_SESSION['customerInfo']['shippingInformation'][$i]['state_id'] = $_POST['state_id'];
                            $_SESSION['customerInfo']['shippingInformation'][$i]['district_id'] = $_POST['district_id'];
                            break;
                        }
                    }
                }

                return $this->redirect('../../shipping');

            case "createaddress":
                $customer_address = new \backend\models\CustomerAddress();
                $customer_address->customer_id = $customerInfo['customer_id'];
                $customer_address->country_id = 111;
                $customer_address->firstname = htmlspecialchars(stripslashes(trim($_POST['firstname'])));
                $customer_address->lastname = htmlspecialchars(stripslashes(trim($_POST['lastname'])));
                $customer_address->phone = htmlspecialchars(stripslashes(trim($_POST['phone'])));
                $customer_address->address1 = htmlspecialchars(stripslashes(trim($_POST['address1'])));
                $customer_address->address_label = htmlspecialchars(stripslashes(trim($_POST['address_label'])));
                $customer_address->postcode = htmlspecialchars(stripslashes(trim($_POST['postcode'])));
                $customer_address->province_id = $_POST['province_id'];
                $customer_address->state_id = $_POST['state_id'];
                $customer_address->district_id = $_POST['district_id'];
                $customer_address->active = 1;
                $customer_address->save();

                $total_address = count($_SESSION['customerInfo']['shippingInformation']);

                $_SESSION['customerInfo']['shippingIfnformation'][$total_address]['customer_address_id'] = $customer_address->customer_address_id;
                $_SESSION['customerInfo']['shippingInformation'][$total_address]['fname'] = $_POST['firstname'];
                $_SESSION['customerInfo']['shippingInformation'][$total_address]['lname'] = $_POST['lastname'];
                $_SESSION['customerInfo']['shippingInformation'][$total_address]['email'] =  $_SESSION['customerInfo']['email'];
                $_SESSION['customerInfo']['shippingInformation'][$total_address]['address'] = $_POST['address1'];
                $_SESSION['customerInfo']['shippingInformation'][$total_address]['other_address'] = '';
                $_SESSION['customerInfo']['shippingInformation'][$total_address]['phone'] = $_POST['phone'];
                $_SESSION['customerInfo']['shippingInformation'][$total_address]['address_label'] = $_POST['address_label'];
                $_SESSION['customerInfo']['shippingInformation'][$total_address]['phone_mobile'] = '';
                $_SESSION['customerInfo']['shippingInformation'][$total_address]['postcode'] = $_POST['postcode'];
                $_SESSION['customerInfo']['shippingInformation'][$total_address]['province_id'] = $_POST['province_id'];
                $_SESSION['customerInfo']['shippingInformation'][$total_address]['state_id'] = $_POST['state_id'];
                $_SESSION['customerInfo']['shippingInformation'][$total_address]['district_id'] = $_POST['district_id'];
                $_SESSION['customerInfo']['shippingInformation'][$total_address]['country_id'] = 111;

                return $this->redirect('../../shipping');

            default :

                $this->title = 'Shipping Address List';
                return $this->render('shipping/shippinglist');

                break;
        }
    }

    public function actionOrder($action, $id) {
        switch ($action) {

            case "confirmation":
				
				$data = $_POST;

			
                if ($data['orders_id'] && $data['account_name'] && $data['account_number'] && $data['bank_anda'] && $data['amount'] && $data['comments']) {
                    $orderConfirmation = new \backend\models\OrderConfirmation();
					
                    $orderConfirmation->orders_id = $data['orders_id'];
                    $orderConfirmation->account_name = htmlspecialchars(stripslashes(trim($data['account_name'])));
                    $orderConfirmation->account_number = htmlspecialchars(stripslashes(trim($data['account_number'])));
                    $orderConfirmation->bank_anda = htmlspecialchars(stripslashes(trim($data['bank_anda'])));
                    $orderConfirmation->amount = htmlspecialchars(stripslashes(trim($data['amount'])));
                    //$orderConfirmation->transfer_to = $data['transfer_to'];
                    //$orderConfirmation->transfer_method = $data['transfer_method'];
                    $orderConfirmation->comments = htmlspecialchars(stripslashes(trim($data['comments'])));
                    $orderConfirmation->date_add = date("Y-m-d H:i:s");

					$orderConfirmation->save();
					
					
                    // insert into orders history user payment confirmation
					$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "user_payment_confirmation", "apps_language_id" => 1])->order_state_lang_id;
					
                    $orderHistory = new \backend\models\OrderHistory();

                    $orderHistory->orders_id = $data['orders_id'];
                    $orderHistory->order_state_id = \backend\models\OrderHistory::findOne(["orders_id" => $data['orders_id']])->order_state_id;
                    $orderHistory->order_state_lang_id = $orderStateLangId;
                    $orderHistory->date_add = date("Y-m-d H:i:s");

                    $orderHistory->save();
					
					sleep(3);
					
					// insert into orders history to PAYMENT CONFIRMED
					$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "payment_confirmed", "apps_language_id" => 1, "payment_method_id" => 1])->order_state_lang_id;
					
                    $orderHistory = new \backend\models\OrderHistory();

                    $orderHistory->orders_id = $data['orders_id'];
                    $orderHistory->order_state_id = \backend\models\OrderHistory::findOne(["orders_id" => $data['orders_id']])->order_state_id;
                    $orderHistory->order_state_lang_id = $orderStateLangId;
                    $orderHistory->date_add = date("Y-m-d H:i:s");

                    $orderHistory->save();
					
					$orderDetail = \backend\models\OrderDetail::find()->where(['orders_id' => $data['orders_id']])->all();
				
					foreach($orderDetail as $detail){
						
						// update order detail history status
						$orderDetailHistory = new \backend\models\OrderDetailHistory();
						$orderDetailHistory->orders_id = $data['orders_id'];
						$orderDetailHistory->order_detail_id = $detail->order_detail_id;
						$orderDetailHistory->order_state_lang_id = $orderStateLangId;
						$orderDetailHistory->date_add = date("Y-m-d H:i:s");
						$orderDetailHistory->order_detail_state_lang_id = 1;
						$orderDetailHistory->save();
					}
					
					$ordersReminder = \backend\models\OrdersReminder::findOne(['orders_id' => $data['orders_id']]);
			
					// update order reminder status
					if($ordersReminder != NULL){
						$ordersReminder->orders_reminder_status = 0;
						$ordersReminder->orders_canceled_status = 0;
						$ordersReminder->save();
					}
					
					session_start();
					$_SESSION['_flash'] = 'success';
					return TRUE;
					
                } else {

                    $orders = \backend\models\Orders::findOne(["orders_id" => $id]);

                    return $this->render('order/confirmation', array(
						"order" => $orders
                    ));
                }

                break;

            case "detail":

                $orders = \backend\models\Orders::findOne(["orders_id" => $id]);
                $order_details = \backend\models\OrderDetail::find()->where(['orders_id'=>$orders->orders_id])->all();

                $order_cart_rule = \backend\models\OrderCartRule::find()->where(['orders_id'=>$id])->one();

                $diskon = 0;
                if($order_cart_rule != null){
                    $diskon = $order_cart_rule->value;
                }
                $sub_total = 0;
                foreach ($order_details as $order_detail) {
                    $sub_total += $order_detail->original_product_price;
                }

                $order_histories = \backend\models\OrderHistory::find()->where(['orders_id'=>$id])->all();
                $last_history = \backend\models\OrderHistory::find()->where(['orders_id'=>$id])->orderBy('order_history_id DESC')->one();

                $step_date_1 = '';
                $step_date_2 = '';
                $step_date_3 = '';
                $step_date_3b = '';
                $step_date_4 = '';
                $step_date_5 = '';
                $step_date_6 = '';
                $step_date_7 = '';
                $step_date_8 = '';
                $order_cancel_date = '';
                $refund_date = '';
                $customer_cancel_date = '';
                $not_pass_date = '';
                $payment_failed_date = '';

                foreach ($order_histories as $order_history) {

                    if($order_history->orderStateLang->template == 'awaiting'){
                        $step_date_1 = $order_history->date_add;
                        $step_date_2 = $order_history->date_add;
                    }
                    if($order_history->orderStateLang->template == 'payment_accepted'){
                        $step_date_3 = $order_history->date_add;
                    }
                    if($order_history->orderStateLang->template == 'payment_success' || $order_history->orderStateLang->template == 'user_payment_confirmation'){
                        $step_date_3b = $order_history->date_add;
                    }
                    if($order_history->orderStateLang->template == 'goods_in_quality_check'){
                        $step_date_4 = $order_history->date_add;
                    }
                    if($order_history->orderStateLang->template == 'goods_pass_quality_check_and_ready_to_packing'){
                        $step_date_5 = $order_history->date_add;
                    }
                    if($order_history->orderStateLang->template == 'packing_order'){
                        $step_date_6 = $order_history->date_add;
                    }
                    if($order_history->orderStateLang->template == 'shipped'){
                        $step_date_7 = $order_history->date_add;
                    }
                    if($order_history->orderStateLang->template == 'customer_confirm_receipt_of_goods'){
                        $step_date_8 = $order_history->date_add;
                    }

                    if($order_history->orderStateLang->template == 'order_canceled'){
                        $order_cancel_date = $order_history->date_add;
                    }
                    if($order_history->orderStateLang->template == 'customer_cancel'){
                        $customer_cancel_date = $order_history->date_add;
                    }
                    if($order_history->orderStateLang->template == 'goods_not_pass_quality_check'){
                        $not_pass_date = $order_history->date_add;
                    }
                    if($order_history->orderStateLang->template == 'payment_failed'){
                        $payment_failed_date = $order_history->date_add;
                    }
                    if($order_history->orderStateLang->template == 'refund'){
                        $refund_date = $order_history->date_add;
                    }
                }

                $this->title = 'Detail Order '.$orders->reference;
                return $this->render('order/detail', array(
                            "orders" => $orders,
                            "order_details" => $order_details,
                            "sub_total" => $sub_total,
                            "diskon" => $diskon,
                            "step_date_1" => $step_date_1,
                            "step_date_2" => $step_date_2,
                            "step_date_3" => $step_date_3,
                            "step_date_3b" => $step_date_3b,
                            "step_date_4" => $step_date_4,
                            "step_date_5" => $step_date_5,
                            "step_date_6" => $step_date_6,
                            "step_date_7" => $step_date_7,
                            "step_date_8" => $step_date_8,
                            "order_cancel_date" => $order_cancel_date,
                            "refund_date" => $refund_date,
                            "customer_cancel_date" => $customer_cancel_date,
                            "not_pass_date" => $not_pass_date,
                            "payment_failed_date" => $payment_failed_date,
                            "last_history" => $last_history,
                ));

                break;

            case "print":



                break;
        }
    }
    
     public function actionConfirm($id) {

        if($_POST){
            $orderConfirmation = new \backend\models\OrderConfirmation();

                    $orderConfirmation->orders_id = $_POST['orders_id'];
                    $orderConfirmation->account_name = $_POST['account_name'];
                    $orderConfirmation->account_number = $_POST['account_number'];
                    $orderConfirmation->bank_anda = $_POST['bank_anda'];
                    $orderConfirmation->amount = $_POST['amount'];
                    //$orderConfirmation->transfer_to = $_POST['transfer_to'];
                    //$orderConfirmation->transfer_method = $_POST['transfer_method'];
                    $orderConfirmation->comments = $_POST['comments'];
                    $orderConfirmation->date_add = date("Y-m-d H:i:s");

                    $orderConfirmation->save();
                    return $this->render("confirm-form", array("id" => $id));
                }else{
                    return $this->render("confirm-form", array("id" => $id));
            }
                    

    }
    
    public function actionOrderss() {
	

        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');

        $start = 0;
        $limit = 10;
        $date_from = date('2011-01-01');
        $date_to = date('Y-m-d');
        $tr = '';

        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
        if(isset($_GET['page'])) {

            $page = $_GET['page'];

            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
        }
        if(isset($_GET['date_from'])){
            $date_from = $_GET['date_from'];
        }
        if(isset($_GET['date_to'])){
            $date_to = $_GET['date_to'];
        }
        if(isset($_GET['tr'])){
            $tr = $_GET['tr'];
        }

        $params = '';
        $sortby = 'ada';
        $breadcrumbs[0] = 'user';
        $breadcrumbs[2] = 'orders';


        $orders = \backend\models\Orders::find()
                // ->select('*, IF(order_history.order_state_lang_id = 19 , ("ada") , ("kaga") ) as cok')
                ->joinWith('orderhistory')
                ->offset($start)
                ->limit($limit)
                ->orderBy("orders.date_add DESC")->where(["orders.customer_id" => $customerInfo['customer_id']])
                ->andWhere(['between','orders.date_add', $date_from . ' 00:00:00 ', $date_to . ' 23:59:00'])
                ->andWhere(['like','orders.reference', $tr])
                // ->andWhere(['order_history.order_state_lang_id'=>19])
                // ->groupBy(['orders.orders_id'])
                ->all();
                // print_r($orders);die();
        $orders_all = \backend\models\Orders::find()
                ->joinWith('orderhistory')
                ->orderBy("orders.date_add DESC")->where(["orders.customer_id" => $customerInfo['customer_id']])
                ->andFilterWhere(['between','orders.date_add', $date_from . ' 00:00:00 ', $date_to . ' 23:59:00'])
                // ->groupBy(['orders.orders_id'])
                // ->andFilterWhere(['order_history.order_state_lang_id'=>19])
                ->andFilterWhere(['like','orders.reference', $tr])->all();

        $this->title = 'My Order History';
		
        return $this->render("orderhistory2", array("orders" => $orders,"params" => $params,"breadcrumbs" => $breadcrumbs, "sortby" => $sortby, "count" => count($orders_all), "limit"=>$limit));
    }
    
    public function actionOrders2() {
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');

        $start = 0;
        $limit = 10;
        $date_from = date('2011-01-01');
        $date_to = date('Y-m-d');
        $tr = '';

        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
        if(isset($_GET['page'])) {

            $page = $_GET['page'];

            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
        }
        if(isset($_GET['date_from'])){
            $date_from = $_GET['date_from'];
        }
        if(isset($_GET['date_to'])){
            $date_to = $_GET['date_to'];
        }
        if(isset($_GET['tr'])){
            $tr = $_GET['tr'];
        }

        $params = '';
        $sortby = 'ada';
        $breadcrumbs[0] = 'user';
        $breadcrumbs[2] = 'orders';


        $orders = \backend\models\Orders::find()
                // ->select('*, IF(order_history.order_state_lang_id = 19 , ("ada") , ("kaga") ) as cok')
                ->joinWith('orderhistory')
                ->offset($start)
                ->limit($limit)
                ->orderBy("orders.date_add DESC")->where(["orders.customer_id" => $customerInfo['customer_id']])
                ->andWhere(['between','orders.date_add', $date_from . ' 00:00:00 ', $date_to . ' 23:59:00'])
                ->andWhere(['like','orders.reference', $tr])
                // ->andWhere(['order_history.order_state_lang_id'=>19])
                ->groupBy(['orders.orders_id'])
                ->all();
                // print_r($orders);die();
        $orders_all = \backend\models\Orders::find()
                ->joinWith('orderhistory')
                ->orderBy("orders.date_add DESC")->where(["orders.customer_id" => $customerInfo['customer_id']])
                ->andFilterWhere(['between','orders.date_add', $date_from . ' 00:00:00 ', $date_to . ' 23:59:00'])
                ->groupBy(['orders.orders_id'])
                // ->andFilterWhere(['order_history.order_state_lang_id'=>19])
                ->andFilterWhere(['like','orders.reference', $tr])->all();

        return $this->render("orderhistory2", array("orders" => $orders,"params" => $params,"breadcrumbs" => $breadcrumbs, "sortby" => $sortby, "count" => count($orders_all), "limit"=>$limit));
    }

    public function actionSignOut() {
        $sessionOrder = new Session();
        $sessionOrder->open();

        unset($_SESSION['customerInfo']);
        return $this->redirect(\yii\helpers\Url::base(true));
    }

    public function actionUpdateprofile() {
        session_start();

        $customerInfo = $_SESSION['customerInfo'];

        $customer_id = $customerInfo['customer_id'];

        $customer = \backend\models\Customer::findOne(array('customer_id' => $customer_id));
		if($customer != NULL){
			$customer->firstname = $_POST['fname'];
			$customer->lastname = $_POST['lname'];
			$customer->birthday = $_POST['birth'];
			$customer->phone_number = $_POST['phone'];
			$customer->gender_id = $_POST['gender'];
			$customer->save();
		}

        $_SESSION['customerInfo']['fname'] = $_POST['fname'];
        $_SESSION['customerInfo']['lname'] = $_POST['lname'];
        $_SESSION['customerInfo']['birthday'] = $_POST['birth'];
        $_SESSION['customerInfo']['phone'] = $_POST['phone'];
        if($_POST['gender'] == 1){
            $_SESSION['customerInfo']['gender'] = 'MEN';
        }
        elseif($_POST['gender'] == 2){
            $_SESSION['customerInfo']['gender'] = 'WOMEN';
        }
        else{
            $_SESSION['customerInfo']['gender'] =$_POST['gender'];
        }
    }
    
    public function actionUpdatepassword() {
        session_start();

        $customerInfo = $_SESSION['customerInfo'];

        $customer_id = $customerInfo['customer_id'];

        $customer = \backend\models\Customer::findOne($customer_id);
        if($_POST['npassword'] != $_POST['cpassword']){
            // \Yii::$app->getSession()->setFlash('pass1', 'new password and confirm password not match');
            $_SESSION['_flash'] = 'pass1';
            return;
        }
        if($customer->passwd != md5($_POST['opassword'])){
            $_SESSION['_flash'] = 'pass2';
            return;
        }
        $customer->passwd = md5($_POST['npassword']);
        
        $customer->save();
        $_SESSION['_flash'] = 'success';
    }

    public function actionUpdateemail() {
        session_start();

        $customerInfo = $_SESSION['customerInfo'];

        $customer_id = $customerInfo['customer_id'];

        $customer = \backend\models\Customer::findOne($customer_id);
        if(\backend\models\Customer::find()->where(['email'=>$_POST['email']])->one() !== NULL){
            // \Yii::$app->getSession()->setFlash('pass1', 'new password and confirm password not match');
            $_SESSION['_flash'] = 'pass1';
            return;
        }
        if($customer->passwd != md5($_POST['cpassword'])){
            $_SESSION['_flash'] = 'pass2';
            return;
        }
        $customer->email = $_POST['email'];
        
        $customer->save();
        $_SESSION['_flash'] = 'success';
        $_SESSION['customerInfo']['email'] = $_POST['email'];
    }

    public function actionUpdateshipping() {
        // session_start();

        // $customerInfo = $_SESSION['customerInfo'];

        // $shipping_info = $customerInfo['shippingInformation'];

        // $i = 0;
        // foreach ($shipping_info as $address) {
        //     if($address )
        // }
        
        \backend\models\CustomerAddress::updateAll(['set_as_default' => 0], 'customer_id ='.$_POST['customer_id']);
        $customer = \backend\models\CustomerAddress::findOne($_POST['customer_address_id']);

        $customer->set_as_default = 1;
        
        $customer->save();
      
    }
    
    public function actionPayment($id) {
        session_start();
        $orders = \backend\models\Orders::find()->where(['orders_id'=>$id])->one();
        
        if($orders->customer_id != $_SESSION['customerInfo']['customer_id']){
            return $this->redirect('/');
        }
        $status = \backend\models\OrderHistory::find()
                                        ->orderBy("order_history_id DESC")
                                        ->where(["orders_id" => $orders->orders_id])
                                        ->one();
        if($status->orderStateLang->template != 'awaiting' && $status->orderStateLang->template != 'payment_failed'){
            return $this->redirect('/');
        }
        
        if($orders->flash_sale == 0){
            return $this->redirect('/');
        }
        $payment_method_id = $orders->paymentmethoddetail->paymentMethod->payment_method_id;
        return $this->render('payment',['orders'=>$orders,"payment_method_id"=>$payment_method_id]);
                    

    }
    
    public function actionPaymentComplete() {

  
        return $this->render('payment-complete');
                    

    }
    
    public function actionChangename() {
        $data = $_POST;
        
        $customer_address = \backend\models\CustomerAddress::find()->where(['customer_address_id'=>$data['customer_address_id']])->one();
        $customer_address->firstname = htmlspecialchars(stripslashes(trim($data['nama'])));
        $customer_address->phone = htmlspecialchars(stripslashes(trim($data['telp'])));
        $customer_address->update();
        return $this->redirect('orders');
                    

    }
    public function actionSelesai() {
        $data = $_POST;
        
        $orders = \backend\models\Orders::find()->where(['orders_id'=>$data['id']])->one();
        $order_state_lang_id = \backend\models\OrderStateLang::find()->where(['payment_method_id'=>$orders->paymentmethoddetail->payment_method_id])->andWhere(['template'=>'customer_confirm_receipt_of_goods'])->andWhere(['apps_language_id'=>2])->one();

        $order_history = new \backend\models\OrderHistory();
            $order_history->orders_id = $data['id'];
            $order_history->order_state_id = \backend\models\OrderHistory::findOne(["orders_id" => $data['id']])->order_state_id;
            $order_history->order_state_lang_id = $order_state_lang_id->order_state_lang_id;
            $order_history->date_add = date("Y-m-d H:i:s");
            $order_history->save();
            
            // create activity log for current order status
            $log = new \backend\models\Log();
            $log->fullname = substr($orders->customer->email, 0, 20);
            $log->module = Yii::$app->controller->id;
            $log->action = 'update';
            $log->action_text = 'user '. $log->fullname . ' update order status to ' . $order_state_lang_id->name;
            $log->date_time = date("Y-m-d H:i:s");
            $log->id_onChanged = $data['id'];
            $log->save();

        return json_encode($data);
                    

    }
    public function actionComplain() {
        $data = $_POST;
        
        $complain = new \backend\models\OrderComplain();
        $complain->orders_id = $data['orders_id'];
        $complain->complain = $data['complain'];
        $complain->date_add = date("Y-m-d H:i:s");
        $complain->save();

        Yii::$app->session->setFlash('success', "Ulasan Anda Pada Order ".$data['orders_id']." Berhasil Disimpan"); 

        return $this->redirect('orders');
                    

    }

    public function actionRating() {
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');

        if(isset($_POST['survei'])){


            $data = $_POST['survei'];
            $product = $_POST['product'];
        
                $questionnaire_respondent = new \backend\models\QuestionnaireRespondent();
                $questionnaire_respondent->customer_id = $customerInfo['customer_id'];
                $questionnaire_respondent->questionnaire_id = 3;
                $questionnaire_respondent->save();
            
            foreach($data as $key => $value){

                $str = explode("+",$key);
                $product_rating = new \backend\models\ProductRating();
                $product_rating->orders_id = $_POST['orders_id'];
                $product_rating->product_id = $str[0];
                $product_rating->product_attribute_id = $str[1];
                $product_rating->questionnaire_respondent_id = $questionnaire_respondent->questionnaire_respondent_id;
                $product_rating->rating = $value;
                $product_rating->date_add = date("Y-m-d H:i:s");
                $product_rating->save();
               
            }

            Yii::$app->session->setFlash('success', "Rating Anda Pada Order ".$_POST['orders_id']." Berhasil Disimpan"); 

        }

        return $this->redirect('orders');
    }

	private function checkSpecificPrice($productID, $productAttributeID){

        $now = date('Y-m-d H:i:s');
        
        $product_M = \backend\models\Product::find()->where(['product_id'=>$productID]);
        $productSpecificPrice_M = \backend\models\SpecificPrice::find()->where(['product_id'=>$productID])->andWhere(['product_attribute_id'=>$productAttributeID]);

        $product_R = $product_M->asArray()->all();
        $productSpecificPrice_R = $productSpecificPrice_M->asArray()->all();

        //MULAI HITUNG REDUCTION AWAL
        $_calculationResult = $product_R[0]['price'];
        $_calculationReduction = 0;
        $_calculationReductionExtra = 0;
        $_calculationReductionPlusExtra = 0;
        $_labelDisc = 0;

       /*SPECIFIC PRICE CALCULATION*/
       if(!empty($productSpecificPrice_R)){
            
        
           
           $productSpecificPriceReduction = $productSpecificPrice_R[0]['reduction'];
           $productSpecificPriceReductionType = $productSpecificPrice_R[0]['reduction_type'];
           $productSpecificPriceReductionFrom = $productSpecificPrice_R[0]['from'];
           $productSpecificPriceReductionTo = $productSpecificPrice_R[0]['to'];
           $productSpecificPriceReductionIsFlashSale = $productSpecificPrice_R[0]['is_flash_sale'];
           $productSpecificPriceReductionFlashSaleQty = $productSpecificPrice_R[0]['flash_sale_qty'];
           $productSpecificPriceReductionReductionExtra = $productSpecificPrice_R[0]['reduction_extra'];
           $productSpecificPriceReductionReductionPlusExtra = $productSpecificPrice_R[0]['reduction_plus_extra'];

           
           //CEK FLASH SALE GA SIH?
           if($productSpecificPriceReductionIsFlashSale==1){
            
               //KALO FLASH SALE, CEK LAGI JUMLAH PRODUK YANG FLASH SALENYA MASIH ADA GA SIH?
               if($productSpecificPriceReductionFlashSaleQty>0){


                   //TERNYATA PRODUKNYA MASIH ADA, CEK LAGI TANGGAL DISKON MEMENUHI GA SIH?
                   if ($productSpecificPriceReductionFrom <= $now && $productSpecificPriceReductionTo > $now) {
                        //IS_DISKON=1
                        $productIsDiscount = 1;

                       //TERNYATA MEMENUHI, DISKONNYA PERCENT ATAU AMOUNT?
                       if($productSpecificPriceReductionType == "percent"){
                           
                            //LABEL DISKONNYA
                            $_labelDisc = ($productSpecificPriceReduction)."%";

                           //DISKON PERCENT. MULAI PERHITUNGAN DISKON
                           $_calculationReduction = $_calculationResult*($productSpecificPriceReduction/100);
                           $_calculationResult = $_calculationResult - $_calculationReduction;
                           
                           //MULAI PERHITUNGAN DISKON EXTRA
                           if($productSpecificPriceReductionReductionExtra!=0){
                               $_calculationReductionExtra = $_calculationResult*($productSpecificPriceReductionReductionExtra/100);
                               $_calculationResult = $_calculationResult - $_calculationReductionExtra;
                           }

                           //MULAI PERHITUNGAN DISKON PLUS EXTRA
                           if($productSpecificPriceReductionReductionPlusExtra!=0){
                               $_calculationReductionPlusExtra = $_calculationResult*($productSpecificPriceReductionReductionPlusExtra/100);
                               $_calculationResult = $_calculationResult - $_calculationReductionPlusExtra;
                           }

                           
                       }elseif($productSpecificPriceReductionType == "amount"){

                            //LABEL DISKONNYA
                            $_labelDisc = round($productSpecificPriceReduction/1000, 2)."k";


                           //DISKON AMOUNT. MULAI PERHITUNGAN DISKON
                           $_calculationReduction = ($productSpecificPriceReduction);
                           $_calculationResult = $_calculationResult - $_calculationReduction;

                           //MULAI PERHITUNGAN DISKON EXTRA
                           if($productSpecificPriceReductionReductionExtra!=0){
                               $_calculationReductionExtra =($productSpecificPriceReductionReductionExtra);
                               $_calculationResult = $_calculationResult - $_calculationReductionExtra;
                           }

                           //MULAI PERHITUNGAN DISKON PLUS EXTRA
                           if($productSpecificPriceReductionReductionPlusExtra!=0){
                               $_calculationReductionPlusExtra = ($productSpecificPriceReductionReductionPlusExtra);
                               $_calculationResult = $_calculationResult - $_calculationReductionPlusExtra;
                           }

                           
                       }
                   }


               }
           }else{            

               //TERNYATA PRODUKNYA MASIH ADA, CEK LAGI TANGGAL DISKON MEMENUHI GA SIH?
               if ($productSpecificPriceReductionFrom <= $now && $productSpecificPriceReductionTo > $now) {

                    //IS_DISKON=1
                    $productIsDiscount = 1;
                
                   //TERNYATA MEMENUHI, DISKONNYA PERCENT ATAU AMOUNT?
                   if($productSpecificPriceReductionType == "percent"){
                       

                        //LABEL DISKONNYA
                        $_labelDisc = ($productSpecificPriceReduction)."%";
                       

                       //DISKON PERCENT. MULAI PERHITUNGAN DISKON
                       $_calculationReduction = $_calculationResult*($productSpecificPriceReduction/100);
                       $_calculationResult = $_calculationResult - $_calculationReduction;
                       
                       //MULAI PERHITUNGAN DISKON EXTRA
                       if($productSpecificPriceReductionReductionExtra!=0){
                           $_calculationReductionExtra = $_calculationResult*($productSpecificPriceReductionReductionExtra/100);
                           $_calculationResult = $_calculationResult - $_calculationReductionExtra;
                       }

                       //MULAI PERHITUNGAN DISKON PLUS EXTRA
                       if($productSpecificPriceReductionReductionPlusExtra!=0){
                           $_calculationReductionPlusExtra = $_calculationResult*($productSpecificPriceReductionReductionPlusExtra/100);
                           $_calculationResult = $_calculationResult - $_calculationReductionPlusExtra;
                       }   

                       
                   }elseif($productSpecificPriceReductionType == "amount"){

                       //LABEL DISKONNYA
                       $_labelDisc = round($productSpecificPriceReduction/1000, 2)."k";


                       //DISKON AMOUNT. MULAI PERHITUNGAN DISKON
                       $_calculationReduction = ($productSpecificPriceReduction);
                       $_calculationResult = $_calculationResult - $_calculationReduction;

                       //MULAI PERHITUNGAN DISKON EXTRA
                       if($productSpecificPriceReductionReductionExtra!=0){
                           $_calculationReductionExtra =($productSpecificPriceReductionReductionExtra);
                           $_calculationResult = $_calculationResult - $_calculationReductionExtra;
                       }

                       //MULAI PERHITUNGAN DISKON PLUS EXTRA
                       if($productSpecificPriceReductionReductionPlusExtra!=0){
                           $_calculationReductionPlusExtra = ($productSpecificPriceReductionReductionPlusExtra);
                           $_calculationResult = $_calculationResult - $_calculationReductionPlusExtra;
                       }

                       
                   }
               }

               
           }
        
       }
       
       $productOriginalUnitPrice = (empty($product_R)) ? "" : $product_R[0]['price'];
       $productUnitPrice = $_calculationResult;
       $productFlashSale = (!isset($productSpecificPriceReductionIsFlashSale)) ? 0 : $productSpecificPriceReductionIsFlashSale;
       $productIsDiscount = (!isset($productIsDiscount)) ? 0 : $productIsDiscount;
       $productLabelDisc = $_labelDisc;

       
            
       return array(
           "original_unit_price"=>$productOriginalUnitPrice,
           "unit_price"=>$productUnitPrice,
           "flash_sale"=>intval($productFlashSale),
           "is_discount"=>$productIsDiscount,
           "reduction_extra"=>$_calculationReductionExtra,
           "reduction_plus_extra"=>$_calculationReductionPlusExtra,
           "label_disc"=>$productLabelDisc
       );
    }

    

    private function addDefaultCategoryWishlist($customer_id){
        $wishlist = \backend\models\CustomerWishlist::find()->where(['customer_id'=>$customer_id])->andWhere(['isdefault'=>1])->one();

        if(!$wishlist){
            $wishlist = new \backend\models\CustomerWishlist();
            $wishlist->customer_id = $customer_id;
            $wishlist->name_wishlist = "My Wishlist";
            $wishlist->created_at = date("Y-m-d H:i", time());
            $wishlist->update_at = date("Y-m-d H:i", time());
            $wishlist->isdefault = 1;

            if($wishlist->save()){
                return true;
            }
             
        }

        return false;

    }

      public function actionWishlist($idWishlist=FALSE){
		
        
        $sessionOrder = new Session();
        $sessionOrder->open();
        $customerInfo = $sessionOrder->get("customerInfo");
		
		

        isset($customerInfo) ? '' : $this->redirect('/');

        $this->title = 'Wishlist';
		
		

        //CHECKING DEFAULT WISHLIST
        $this->addDefaultCategoryWishlist($customerInfo['customer_id']);
		

        //LIST WISHLIST CATEGORY
        $wishlistAll = \backend\models\CustomerWishlist::find()->where(['customer_id'=>$customerInfo['customer_id']])->orderBy(['customer_wishlist_id' => SORT_ASC])->with('customerWishlistDetail.product.productDetail')->asArray()->all();
        foreach($wishlistAll as $key=>$item ){
            $wishlistIDForListCategory[$key]=$item['customer_wishlist_id'];
            $wishlistNameForListCategory[$key]=$item['name_wishlist'];
        }

        
        if($idWishlist!=FALSE){
            $wishlist = \backend\models\CustomerWishlist::find()->where(['customer_wishlist_id'=>$idWishlist])->andWhere(['customer_id'=>$customerInfo['customer_id']])->with('customerWishlistDetail.product.productDetail')->orderBy(['customer_wishlist_id' => SORT_ASC,])->asArray()->all();
            
            if(count($wishlist)!=0){
                $wishlistDetail=[];
                foreach($wishlist as $key=>$item ){
                    $wishlistID[$key]=$item['customer_wishlist_id'];
                    $wishlistName[$key]=$item['name_wishlist'];
                    $wishlistIsDefault[$key]=$item['isdefault'];
                    
                    foreach($item['customerWishlistDetail'] as $keyDetail => $itemDetail){
                        $brandID = $itemDetail['product']['brands_brand_id'];
                        $productID = $itemDetail['product']['product_id'];
                        $productAttributeID = $itemDetail['product_attribute_id'];
                        
                        //Memanggil Brand untuk mendapatkan brand_name
                        $brand = \backend\models\Brands::find()->where(['brand_id'=>$brandID])->asArray()->one();

                        //Memanggil Product Image untuk mendapatkan product_image
                        $image = \backend\models\ProductImage::find()->where(['product_id'=>$productID])->asArray()->one();

                        //Memanggil Product Stock untuk mendapatkan product)_stock
                        $stock = \backend\models\ProductStock::find()->where(['product_id'=>$productID, 'product_attribute_id'=>$productAttributeID])->asArray()->one();
                        
                        //Memasukan brand_name pada wishlist_detail
                        $itemDetail['product']['brand_name'] = $brand['brand_name'];

                         //Memasukan brand_id pada wishlist_detail
                         $itemDetail['product']['brand_id'] = $brand['brand_id'];

                        //Memasukan product_image pada wishlist_detail
                        $itemDetail['product']['product_image'] = $image['product_image_id'];

                        //Memasukan product_image pada wishlist_detail
                        $itemDetail['product']['product_stock'] = $stock['quantity'];

                        //MemasukaN specific price pada wishlist detail
                        $itemDetail['product']['specific_price'] = $this->checkSpecificPrice($productID, $productAttributeID);  

                        //Memasukan product_attribute pada wishlist_detail
                        if($productAttributeID!=0){
                            //Memanggil Product Attribute Combination untuk mendapatkan product_attribute_combination
                            $attributecombination = \backend\models\ProductAttributeCombination::find()->where(['product_attribute_id'=>$productAttributeID]);
                            $attributeCombinationAttributes = $attributecombination->with('attributes')->asArray()->one();
                            $attributeCombinationAttributes2 = $attributecombination->with('attributes2')->asArray()->one();
                            $attributeCombinationAttributeValue = $attributecombination->with('attributeValue')->asArray()->one();
                            $attributeCombinationAttributeValue2 = $attributecombination->with('attributeValue2')->asArray()->one();
                            $itemDetail['product']['attribute'][0]['name'] = $attributeCombinationAttributes['attributes']['name'];
                            $itemDetail['product']['attribute'][1]['name'] = $attributeCombinationAttributes2['attributes2']['name'];
                            $itemDetail['product']['attribute'][0]['value'] = $attributeCombinationAttributeValue['attributeValue']['value'];
                            $itemDetail['product']['attribute'][1]['value'] = $attributeCombinationAttributeValue2['attributeValue2']['value'];
                        }else{
                            $itemDetail['product']['attribute'] = array();
                        }



                        
                        $wishlistDetail[$key][$keyDetail]=$itemDetail;
                    }

                    if($item['isdefault']==0){
                        $wishlistNamewithoutDefault[$key]=$item['name_wishlist'];
                    }
                }
            }else{
                $wishlistID=[];
                $wishlistName=[];
                $wishlistIsDefault=[];
                $wishlistDetail=[];
                //$wishlistDetailDefault=[];
            }

            $data = [
                        "wishlist_id"=>$wishlistID,
                        "wishlist_name"=>$wishlistName,
                        "wishlist_is_default"=>$wishlistIsDefault,
                        "wishlist_id_for_listcategory" => $wishlistIDForListCategory,
                        "wishlist_name_for_listcategory"=>$wishlistNameForListCategory,
                        "wishlist_detail"=>$wishlistDetail,
                        "wishlist_current" => $idWishlist
                    ];
        }else{            
            $wishlist = \backend\models\CustomerWishlist::find()->where(['customer_id'=>$customerInfo['customer_id']])->with('customerWishlistDetail.product.productDetail')->orderBy(['customer_wishlist_id' => SORT_ASC,])->asArray()->all();
            

            if(count($wishlist)!=0){
                $wishlistDetail=[];
                foreach($wishlist as $key=>$item ){
                    $wishlistID[$key]=$item['customer_wishlist_id'];
                    $wishlistName[$key]=$item['name_wishlist'];
                    $wishlistIsDefault[$key]=$item['isdefault'];
                    foreach($item['customerWishlistDetail'] as $keyDetail => $itemDetail){
                        $brandID = $itemDetail['product']['brands_brand_id'];
                        $productID = $itemDetail['product']['product_id'];
                        $productAttributeID = $itemDetail['product_attribute_id'];
                        
                        //Memanggil Brand untuk mendapatkan brand_name
                        $brand = \backend\models\Brands::find()->where(['brand_id'=>$brandID])->asArray()->one();

                        //Memanggil Product Image untuk mendapatkan product_image
                        $image = \backend\models\ProductImage::find()->where(['product_id'=>$productID])->asArray()->one();

                        //Memanggil Product Stock untuk mendapatkan product)_stock
                        $stock = \backend\models\ProductStock::find()->where(['product_id'=>$productID, 'product_attribute_id'=>$productAttributeID])->asArray()->one();
                        
                        //Memasukan brand_name pada wishlist_detail
                        $itemDetail['product']['brand_name'] = $brand['brand_name'];

                        //Memasukan brand_id pada wishlist_detail
                        $itemDetail['product']['brand_id'] = $brand['brand_id'];

                        //Memasukan product_image pada wishlist_detail
                        $itemDetail['product']['product_image'] = $image['product_image_id'];

                        //Memasukan product_image pada wishlist_detail
                        $itemDetail['product']['product_stock'] = $stock['quantity'];

                        //MemasukaN specific price pada wishlist detail
                        $itemDetail['product']['specific_price'] = $this->checkSpecificPrice($productID, $productAttributeID); 

                        //Memasukan product_attribute pada wishlist_detail
                        if($productAttributeID!=0){
                            //Memanggil Product Attribute Combination untuk mendapatkan product_attribute_combination
                            $attributecombination = \backend\models\ProductAttributeCombination::find()->where(['product_attribute_id'=>$productAttributeID]);
                            $attributeCombinationAttributes = $attributecombination->with('attributes')->asArray()->one();
                            $attributeCombinationAttributes2 = $attributecombination->with('attributes2')->asArray()->one();
                            $attributeCombinationAttributeValue = $attributecombination->with('attributeValue')->asArray()->one();
                            $attributeCombinationAttributeValue2 = $attributecombination->with('attributeValue2')->asArray()->one();
                            $itemDetail['product']['attribute'][0]['name'] = $attributeCombinationAttributes['attributes']['name'];
                            $itemDetail['product']['attribute'][1]['name'] = $attributeCombinationAttributes2['attributes2']['name'];
                            $itemDetail['product']['attribute'][0]['value'] = $attributeCombinationAttributeValue['attributeValue']['value'];
                            $itemDetail['product']['attribute'][1]['value'] = $attributeCombinationAttributeValue2['attributeValue2']['value'];
                        }else{
                            $itemDetail['product']['attribute'] = array();
                        }



                        
                        $wishlistDetail[$key][$keyDetail]=$itemDetail;
                        
                    }

                
                  
                    if($item['isdefault']==0){
                        $wishlistNamewithoutDefault[$key]=$item['name_wishlist'];
                    }
                    
                }
                
            }else{
                $wishlistID=[];
                $wishlistName=[];
                $wishlistIsDefault=[];
                $wishlistDetail=[];
                //$wishlistDetailDefault=[];
            }

            

            $data = [
                        "wishlist_id"=>$wishlistID,
                        "wishlist_name"=>$wishlistName,
                        "wishlist_is_default"=>$wishlistIsDefault,
                        "wishlist_id_for_listcategory" => $wishlistIDForListCategory,
                        "wishlist_name_for_listcategory"=>$wishlistNameForListCategory,
                        "wishlist_detail"=>$wishlistDetail,
                        "wishlist_current" => 0
                    ];
        }



        return $this->render('wishlist', $data);
    }
    

}
