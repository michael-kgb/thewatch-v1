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
use DrewM\MailChimp\MailChimp;
use yii\helpers\Url;
/**
 * Site controller
 */
class CustomerController extends Controller
{   
    public $title = "";
    public $layout = "mainShop";
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
    public function actions()
    {
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
	
	public function beforeAction($action)
{            
    //if ($action->id == 'my-method') {
        $this->enableCsrfValidation = false;
    //}

    return parent::beforeAction($action);
}
    
    public function actionSignUp(){
        $data = $_POST;

        if($data){
            
            $customer = \backend\models\Customer::findOne(['email' => $data['customerInfo']['email']]);
                    
            // if email already exist
            if($customer != NULL){
                $data['true'] = 'FALSE';
                return json_encode($data['true']);
            }
            
            $signup = new \backend\models\Customer();
            $signup->email = $data['customerInfo']['email'];
            $signup->firstname = $data['customerInfo']['fname'];
			if(isset($data['customerInfo']['phone'])){
                $signup->phone_number = $data['customerInfo']['phone'];
            }
            $signup->passwd = md5($data['customerInfo']['password']);
            $signup->apps_language_id = 1;
            $signup->active = 1;
            $signup->newsletter = 1;
           
            try {
                
                $signup->save();
				
				$data['customerInfo']['customer_id'] = $signup->customer_id;
                
                \common\components\Helpers::sendEmailMandrillUrlAPI(
                    $this->renderFile('@app/views/template/mail/signup.php', array(
                        "username" => $data['customerInfo']['email'], 
                        "password" => $data['customerInfo']['password']
                    )), 
                    'Welcome To The Watch Co', 
                    Yii::$app->params['adminEmail'], 
                    $data['customerInfo']['email'], 
                    ''
                );
                
//                return 'TRUE';
                
            } catch (Exception $ex) {
               
//                return 'FALSE';
            }
            if(isset($_COOKIE['voucher_name'])){
                if($_COOKIE['voucher_name'] == 'chinese_new_year' && isset($_COOKIE['voucher_id'])){
                    // Yii::$app->db->createCommand()
                    //  ->update('cart_rule', ['code' => $_COOKIE['voucher_code']], 'customer_id =')
                    //  ->execute();

                    $cart_rule = \backend\models\CartRule::findOne(['cart_rule_id'=>$_COOKIE['voucher_id']]);
                    $cart_rule->customer_id = $signup->customer_id;
                    $cart_rule->save();
                }
            }
            
            if($data['customerInfo']['newsletter'] == 1){
                
                $newsletter = \backend\models\NewsletterSignup::findOne(['newsletter_signup_email' => $data['customerInfo']['email']]);
                
                // insert new if email not exist
                if($newsletter == NULL){
                    $newsletter = new \backend\models\NewsletterSignup();
                    $newsletter->newsletter_signup_email = $data['customerInfo']['email'];
                    $newsletter->newsletter_signup_date_add = date("Y-m-d H:i:s");
                    // $newsletter->active = 1;
                    $newsletter->save();

                    $baseUrl = \yii\helpers\Url::base();
                    $voucherCode = \common\components\Helpers::generateVoucherCode();
                
                    $cartrule = new \backend\models\CartRule();

                    $cartrule->customer_id = 0;
                    $cartrule->date_from = date('Y-m-d H:i:s');
                    $cartrule->date_to = date('Y-m-d', strtotime("+7 day"));
                    $cartrule->description = 'subscribe newsletter';
                    $cartrule->quantity = 1;
                    $cartrule->quantity_per_user = 1;
                    $cartrule->priority = 1;
                    $cartrule->partial_use = 1;
                    $cartrule->code = $voucherCode;
                    $cartrule->minimum_amount = 1000000;
                    $cartrule->minimum_amount_currency = 1;

                    $cartrule->product_restriction = 0;

                    $cartrule->free_shipping = 0;
                    $cartrule->reduction_percent = 0;
                    $cartrule->reduction_amount = 100000;
                    $cartrule->reduction_currency = 1;
                    $cartrule->highlight = 1;
                    $cartrule->active = 1;
                    $cartrule->date_add = date('Y-m-d H:i:s');
                    $cartrule->date_upd = '0000-00-00 00:00:00';
                    $cartrule->save();

                    $cartrulelang = new \backend\models\CartRuleLang;
                    $cartrulelang->cart_rule_id = $cartrule->cart_rule_id;
                    $cartrulelang->apps_language_id = 1;
                    $cartrulelang->name = 'Subscribe Newsletter';
                    $cartrulelang->save();

                    // send email with voucher code gift
                    \common\components\Helpers::sendEmailMandrillUrlAPI(
                        $this->renderFile('@app/views/template/mail/subscribe_voucher.php', array(
                            "baseUrl" => $baseUrl,
                            "voucherCode" => $voucherCode,
                            "firstname" => $data['customerInfo']['fname']
                        )), 
                        'Welcome To The Watch Co - Enjoy welcome gift from us!', 
                        Yii::$app->params['adminEmail'], 
                        $data['customerInfo']['email'], 
                        ''
                    );

                    $MailChimp = new MailChimp('35efbb4f1931d665b03f052efc24900f-us13');

                    $data = array(
                        "email_address"=>$data['customerInfo']['email'], 
                        "status"=>"subscribed",
                        "merge_fields"=>array(
                            "FNAME"=>$data['customerInfo']['fname'],
                            "LNAME"=>""
                            )
                        );
                    $post = $MailChimp->post('lists/f00f21267a/members', $data);
                }
            }
            
           
            $order = new CustomerForm();
            $order->create($data);
			
			// register new customer in mailchimp
			\common\components\Helpers::registerCustomerMailchimp($signup->customer_id);
            
            return json_encode($data['true']);
            
            
        } else {
            
            return $this->render('signin');
            
        }
    }
    
    public function actionNotify(){
        if($_POST){
            
            $exist = \backend\models\CustomerProductNotify::findOne([
                'email' => $_POST['email'],
                'product_id' => $_POST['product_id'],
                'product_attribute_id' => $_POST['product_attribute_id']
            ]);
            
            if($exist == NULL){
            
                $notify = new \backend\models\CustomerProductNotify();
                $notify->fullname = $_POST['fullname'];
                $notify->email = $_POST['email'];
                $notify->product_id = $_POST['product_id'];
                $notify->product_attribute_id = $_POST['product_attribute_id'];

                try {
                    $notify->save();
                    return 'TRUE';
                } catch (Exception $ex) {
    //                return 'FALSE';
                }
            } else {
                return 'TRUE';
            }
            
        }
    }
    
    public function actionSignIn(){
        $data = $_POST;
        
        if($data){
            // session_destroy();
            session_start();
            $sessionOrder = new Session();
            $sessionOrder->open();

            $email = strip_tags(trim($data['email']));
            $pass = strip_tags(trim($data['password']));
            
            $customer = \backend\models\Customer::find()
                    ->joinWith(["gender", "customerGroup"])
                    ->where(["email" => $email, 'passwd' => md5($pass), 'active'=>1])
                    ->one();
            
            if(!$customer) {
                $data['true'] = 'FALSE';
                return json_encode($data['true']);
            }
            
            $orders = \backend\models\Orders::find()->orderBy("date_add DESC")->where(["customer_id" => $customer->customer_id])->all();
            
            // if(isset($_COOKIE['voucher_name'])){
            //     if($_COOKIE['voucher_name'] == 'chinese_new_year' && isset($_COOKIE['voucher_id'])){
            //         // Yii::$app->db->createCommand()
            //         //  ->update('cart_rule', ['code' => $_COOKIE['voucher_code']], 'customer_id =')
            //         //  ->execute();

            //         $cart_rule = \backend\models\CartRule::findOne(['cart_rule_id'=>$_COOKIE['voucher_id']]);
            //         $cart_rule->customer_id = $customer->customer_id;
            //         $cart_rule->save();
            //     }
            // }
            
            // create new customer info session
            $_SESSION['customerInfo']['customer_id'] = $customer->customer_id;
            $_SESSION['customerInfo']['fname'] = $customer->firstname;
            $_SESSION['customerInfo']['lname'] = $customer->lastname;
            $_SESSION['customerInfo']['email'] = $customer->email;
            $_SESSION['customerInfo']['birthday'] = $customer->birthday;
            $_SESSION['customerInfo']['phone'] = $customer->phone_number;
            $_SESSION['customerInfo']['gender'] = $customer->gender_id === 0 ? 0 : $customer->gender->name;
            $_SESSION['customerInfo']['group'] = $customer->customerGroup->name;
            $_SESSION['customerInfo']['subscribe_newsletter'] = $customer->newsletter;
            $_SESSION['customerInfo']['total_orders'] = count($orders);
            
            $shippingInformation = \backend\models\CustomerAddress::find()
                    ->where(["customer_id" => $customer->customer_id])
                    ->all();
            
            $i = 0;
            // create new customer shipping information session
            if(count($shippingInformation) > 0){
                foreach($shippingInformation as $shipping){
                    $_SESSION['customerInfo']['shippingInformation'][$i]['customer_address_id'] = $shipping->customer_address_id;
                    $_SESSION['customerInfo']['shippingInformation'][$i]['fname'] = $shipping->firstname;
                    $_SESSION['customerInfo']['shippingInformation'][$i]['lname'] = $shipping->lastname;
                    $_SESSION['customerInfo']['shippingInformation'][$i]['email'] = $customer->email;
                    $_SESSION['customerInfo']['shippingInformation'][$i]['address'] = $shipping->address1;
                    $_SESSION['customerInfo']['shippingInformation'][$i]['other_address'] = $shipping->address2;
                    $_SESSION['customerInfo']['shippingInformation'][$i]['phone'] = $shipping->phone;
                    $_SESSION['customerInfo']['shippingInformation'][$i]['phone_mobile'] = $shipping->phone_mobile;
                    $_SESSION['customerInfo']['shippingInformation'][$i]['postcode'] = $shipping->postcode;
                    
                    $_SESSION['customerInfo']['shippingInformation'][$i]['province_id'] = $shipping->province_id;
                    $_SESSION['customerInfo']['shippingInformation'][$i]['state_id'] = $shipping->state_id;
                    $_SESSION['customerInfo']['shippingInformation'][$i]['district_id'] = $shipping->district_id;
                    
                    $_SESSION['customerInfo']['shippingInformation'][$i]['country_id'] = $shipping->country_id; 
                    
                    $i++;
                }
            }
			
			$existingCartsMC = \common\components\Helpers::getMailchimpExistingCarts();
            $carts = $existingCartsMC->carts;
            $cartMC = array();
            
            if(count($carts) > 0){
                foreach($carts as $cart){
                    if($cart->customer->email_address == $_SESSION['customerInfo']['email']){
                        // unset existing cart
                        unset($_SESSION['cart']);
                        
                        $cartMC = $cart->lines;
                    }
                }
                
                // write existing cart session in mailchimp
                \common\components\Helpers::createCartSession($_SESSION['customerInfo']['customer_id'], $cartMC);
            }
           return json_encode($data['true']); 
        }
    }
    
    public function actionResetPassword(){
        $token = $_GET['token'];
        
        if(!empty($token)){
            
            if(isset($_POST['new_password'])){
                
                $customer = \backend\models\Customer::findOne(['forgot_password_token' => $token]);
                
                if($customer != NULL){
                    $customer->passwd = md5($_POST['new_password']);
                    $customer->save();
                    
                    return $this->render('reset-password-response', array('response' => 'RESET PASSWORD SUCCESSFULY'));
                }
                
                return $this->render('reset-password-response', array('response' => 'RESET PASSWORD FAILED'));
                
            } else {
                return $this->render('reset-password');
            }
            
        }
    }
    
    public function actionForgotPassword(){
        if(isset($_POST['_csrf']) && isset($_POST['email'])){
            $customer = \backend\models\Customer::findOne(['email' => $_POST['email']]);
            
            if($customer != NULL){
                
                $baseUrl = Url::base(true);
                $token = md5(uniqid(rand(), true));
                
                $customer->forgot_password_token = $token;
                
                try {
                
                    $customer->save();
                    
                    \common\components\Helpers::sendEmailMandrillUrlAPI(
                        $this->renderFile('@app/views/template/mail/reset_password.php', array(
                            "token" => $token,
                            "baseUrl" => $baseUrl
                        )), 
                        'The Watch Co - Reset Password', 
                        Yii::$app->params['adminEmail'], 
                        $_POST['email'], 
                        ''
                    );
                } catch (Exception $ex) {
                    return 'FALSE';
                }
                
                return 'TRUE';
            }
            
            return 'FALSE';
        }
    }
    
    public function actionSubscribe(){
        if(isset($_POST['_csrf'])) {
            
            $exist = \backend\models\Customer::findOne(['email' => $_POST['email']]);
			
			$existNewsletter = \backend\models\NewsletterSignup::findOne(['newsletter_signup_email' => $_POST['email']]);
            
            $baseUrl = \yii\helpers\Url::base();
            
            if($exist == NULL && $existNewsletter == NULL){
                
                $newsletter = new \backend\models\NewsletterSignup();
                $newsletter->newsletter_signup_firstname = htmlspecialchars(stripslashes(trim($_POST['firstname'])));
                $newsletter->newsletter_signup_email = htmlspecialchars(stripslashes(trim($_POST['email'])));
                $newsletter->newsletter_signup_gender = htmlspecialchars(stripslashes(trim($_POST['gender'])));
                $newsletter->newsletter_signup_date_add = date("Y-m-d H:i:s");

                try {
                    $newsletter->save();
                    
                    $voucherCode = \common\components\Helpers::generateVoucherCode();
                
                    $cartrule = new \backend\models\CartRule();

                    $cartrule->customer_id = 0;
                    $cartrule->date_from = date('Y-m-d H:i:s');
                    $cartrule->date_to = date('Y-m-d', strtotime("+7 day"));
                    $cartrule->description = 'subscribe newsletter';
                    $cartrule->quantity = 1;
                    $cartrule->quantity_per_user = 1;
                    $cartrule->priority = 1;
                    $cartrule->partial_use = 1;
                    $cartrule->code = $voucherCode;
                    $cartrule->minimum_amount = 1000000;
                    $cartrule->minimum_amount_currency = 1;

                    $cartrule->product_restriction = 0;

                    $cartrule->free_shipping = 0;
                    $cartrule->reduction_percent = 0;
                    $cartrule->reduction_amount = 100000;
                    $cartrule->reduction_currency = 1;
                    $cartrule->highlight = 1;
                    $cartrule->active = 1;
                    $cartrule->date_add = date('Y-m-d H:i:s');
                    $cartrule->date_upd = '0000-00-00 00:00:00';
                    $cartrule->save();

                    $cartrulelang = new \backend\models\CartRuleLang;
                    $cartrulelang->cart_rule_id = $cartrule->cart_rule_id;
                    $cartrulelang->apps_language_id = 1;
                    $cartrulelang->name = 'Subscribe Newsletter';
                    $cartrulelang->save();

                    // send email with voucher code gift
                    \common\components\Helpers::sendEmailMandrillUrlAPI(
                        $this->renderFile('@app/views/template/mail/subscribe_voucher.php', array(
                            "baseUrl" => $baseUrl,
                            "voucherCode" => $voucherCode,
							"firstname" => $_POST['firstname']
                        )), 
                        'Welcome To The Watch Co - Enjoy welcome gift from us!', 
                        Yii::$app->params['adminEmail'], 
                        $_POST['email'], 
                        ''
                    );

                    $MailChimp = new MailChimp('35efbb4f1931d665b03f052efc24900f-us13');

                    $data = array(
                        "email_address"=>$_POST['email'], 
                        "status"=>"subscribed",
                        "merge_fields"=>array(
                            "FNAME"=>$_POST['firstname'],
                            "LNAME"=>""
                            )
                        );
                    $post = $MailChimp->post('lists/f00f21267a/members', $data);



                    return 'TRUE';
                    
                } catch (Exception $ex) {
                    return 'FALSE';
                }
                
            } else {
                if($exist != null){
                    $exist->newsletter = 1;
                    $exist->save();
                }
                
                
                return 'TRUE';
            }
        }
    }
	
	public function actionUnsubscribe(){
        
        $email = $_GET['email'];
        
        if($email != ''){
            $newsletter = \backend\models\NewsletterSignup::findOne(['newsletter_signup_email' => $email]);
            
            if($newsletter != NULL){
                $newsletter->delete();
                
                return $this->render('unsubscribe', array('message' => 'You have unsubscribed from our newsletter list'));
            } else {
				$this->redirect('https://thewatch.co');
			}
			
        } else {
            $this->redirect('https://thewatch.co');
        }
    }
    
}
