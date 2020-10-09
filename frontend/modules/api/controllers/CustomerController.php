<?php

namespace app\modules\api\controllers;

use Yii;
use frontend\core\controller\FrontendController;
// use yii\rest\ActiveController;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Session;
use yii\web\Request;
use DrewM\MailChimp\MailChimp;
use common\components\Helpers;
use yii\helpers\Url;
use backend\models\Customer;
use backend\models\CartRule;
use backend\models\CartRuleLang;
use backend\models\NewsletterSignup;
use frontend\models\CustomerForm;

class CustomerController extends FrontendController
{	
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
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

    public function actionTestAct()
    {
        $response = Yii::$app->runAction('go-api/user/test-call', ['name' => 'El Capone', 'gender' => 'Men']);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
    }

    /**
     * this function used only for newsletter sign up popup
     */
    private function setSubscribeNewsletter($email, $fname, $gender)
    {
        $baseUrl = Yii::$app->params['frontendUrl'];
        $current_date = date('Y-m-d H:i:s');
        $next_week = date('Y-m-d', strtotime("+7 day"));
        $result = array();
        $voucherCode = "";

        $exist_newsletter = NewsletterSignup::findOne(['newsletter_signup_email' => $email]);

        if($exist_newsletter == NULL){
            $newsletter = new NewsletterSignup();
            $newsletter->newsletter_signup_firstname = $fname;
            $newsletter->newsletter_signup_email = $email;
            $newsletter->newsletter_signup_gender = $gender;
            $newsletter->newsletter_signup_date_add = $current_date;
            $newsletter->save();
        }

        try {
            $gen_voucherCode = Helpers::generateVoucherCode();
            $exist_code = CartRule::findOne(['code'=>$gen_voucherCode]);

            $voucherCode = $exist_code ? $gen_voucherCode : Helpers::generateVoucherCode();
        
            $cartrule = new CartRule();

            $cartrule->customer_id = 0;
            $cartrule->date_from = $current_date;
            $cartrule->date_to = $next_week;
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
            $cartrule->date_add = $current_date;
            $cartrule->date_upd = '0000-00-00 00:00:00';
            $cartrule->save();

            $cartrulelang = new CartRuleLang();
            $cartrulelang->cart_rule_id = $cartrule->cart_rule_id;
            $cartrulelang->apps_language_id = 1;
            $cartrulelang->name = 'Subscribe Newsletter';
            $cartrulelang->save();

            // send email with voucher code gift
            Helpers::sendEmailMandrillUrlAPI(
                $this->renderFile('@app/views/template/mail/subscribe_voucher.php', array(
                    "baseUrl" => $baseUrl,
                    "voucherCode" => $voucherCode,
                    "firstname" => $fname
                )), 
                'Welcome To The Watch Co - Enjoy welcome gift from us!', 
                Yii::$app->params['adminEmail'], 
                $email, 
                ''
            );

            $MailChimp = new MailChimp('35efbb4f1931d665b03f052efc24900f-us13');

            $data = array(
                "email_address"=>$email, 
                "status"=>"subscribed",
                "merge_fields"=>array(
                    "FNAME"=>$fname,
                    "LNAME"=>""
                    )
                );
			if (YII_ENV === "prod") {
				$post = $MailChimp->post('lists/f00f21267a/members', $data);
			}
            $message = $voucherCode;
            $result = array('status'=>TRUE, 'message'=>$message);
        } catch (Exception $ex) {
            $message = "Failed to send Mandrill Message!";
            $result = array('status'=>FALSE, 'message'=>$message);
        }
		return $result;
    }

    /**
     * action for customer quick sign up
     */
    public function actionQuickSignUp()
    {
        session_start();
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params = Yii::$app->request->post();
        $state = FALSE;
        $message = "";
        $current_date = date('Y-m-d H:i:s');
        $next_week = date('Y-m-d', strtotime("+7 day"));
        $response = array();
        $customerInfo = $session['customerInfo'];
        $voucherCode = "";

        if (!empty($customerInfo)){
            $state = FALSE;
            $message = "You already logged in.";
        }else{
            $exist_customer = Customer::findOne(['email' => $params['customerInfo']['email']]);

            if(!$exist_customer){
                $rancode = Helpers::generateRandomCode();
                $gen_pass = md5($rancode);

                $customer = new Customer();
                $customer->email = $params['customerInfo']['email'];
                $customer->firstname = $params['customerInfo']['fname'];
                $customer->passwd = $gen_pass;
                $customer->apps_language_id = 1;
                $customer->active = 1;
                $customer->newsletter = 1;

                try {
                    $customer->save();
					
					Helpers::sendEmailMandrillUrlAPI(
							$this->renderFile('@app/views/template/mail/signup.php', array(
								"username" => $params['customerInfo']['email'],
								"password" => $rancode
							)), \Yii::$app->params['signupSubjectEmail'], \Yii::$app->params['adminEmail'], $params['customerInfo']['email'], ''
					);
                    
                    if(isset($_COOKIE['voucher_name'])){
                        if($_COOKIE['voucher_name'] == 'chinese_new_year' && isset($_COOKIE['voucher_id'])){
                            $cart_rule = CartRule::findOne(['cart_rule_id'=>$_COOKIE['voucher_id']]);
                            $cart_rule->customer_id = $customer->customer_id;
                            $cart_rule->save();
                        }
                    }

                    $subscribed = $this->setSubscribeNewsletter($params['customerInfo']['email'], $params['customerInfo']['fname'], 'Men');

                    if($subscribed['status']){
                        // $message = $subscribed['message']."\n"; // hide voucher code from message
                    }
                    
                    $session_cust = new CustomerForm();
                    $params['customerInfo']['customer_id'] = $customer->customer_id;
                    $session_cust->create($params);
                    
					if (YII_ENV === "prod") {
						// register new customer in mailchimp
						Helpers::registerCustomerMailchimp($customer->customer_id);
					}
                    $state = TRUE;
                    $message .= "Your account is already created.";
                } catch (Exception $ex) {
                    $state = FALSE;
                    $message .= "Registration failed!";
                }

            }else{
                $state = FALSE;
                $message = "Your account is already exist!";
            }
        }

        $response = array(
            "status" => $state,
            "message" => $message,
            // "voucher_code" => $voucherCode
        );
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
    }

    /**
     * action for customer sign up
     */
    public function actionSignUp()
    {
        session_start();
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params = Yii::$app->request->post();
        $state = FALSE;
        $message = "";
        $current_date = date('Y-m-d H:i:s');
        $response = array();
        $customerInfo = $session['customerInfo'];
        $voucherCode = "";

        if (!empty($customerInfo)){
            $state = FALSE;
            $message = "You already logged in.";
        }else{
            $exist_customer = Customer::findOne(['email' => $params['customerInfo']['email']]);

            if(is_null($exist_customer)){
                // get password value by confirmed password value
                $pass = $params['customerInfo']['password'];
                $gen_pass = md5($pass);
				$first_name = 

				$email = $params['customerInfo']['email'];
				$firstname = $params['customerInfo']['fname'];
				$lastname = $params['customerInfo']['lname'];
				$phone_number = empty($params['customerInfo']['phone']) ? '-' : $params['customerInfo']['phone'];
				$gender = $params['customerInfo']['gender'];
                $birthday = $params['customerInfo']['birthday'];
				
				$email = htmlspecialchars(stripslashes(trim($email)));
				$firstname = htmlspecialchars(stripslashes(trim($firstname)));
				$lastname = htmlspecialchars(stripslashes(trim($lastname)));
				$phone_number = htmlspecialchars(stripslashes(trim($phone_number)));
				$gender = htmlspecialchars(stripslashes(trim($gender)));
				$birthday = htmlspecialchars(stripslashes(trim($birthday)));

                $customer = new Customer();
				
                $customer->email = $email;
                $customer->firstname = $firstname;
                $customer->lastname = $lastname;
                $customer->phone_number = $phone_number;
				$customer->gender_id = $gender;
				$customer->birthday = $birthday;
                $customer->passwd = $gen_pass;
                $customer->apps_language_id = 1;
                $customer->active = 1;
                // $customer->newsletter = 1;

                try {
                    $customer->save();
                    Helpers::sendEmailMandrillUrlAPI(
                            $this->renderFile('@app/views/template/mail/signup.php', array(
                                "username" => $params['customerInfo']['email'],
                                "password" => $pass
                            )), \Yii::$app->params['signupSubjectEmail'], \Yii::$app->params['adminEmail'], $params['customerInfo']['email'], ''
                    );
                    
                    $session_cust = new CustomerForm();
                    $params['customerInfo']['customer_id'] = $customer->customer_id;
                    $session_cust->create($params);
                    
					if (YII_ENV === "prod") {
						// register new customer in mailchimp
						Helpers::registerCustomerMailchimp($customer->customer_id);
					}

                    $state = TRUE;
                    $message .= "Your account is already created.";
                } catch (Exception $ex) {
                    $state = FALSE;
                    $message .= "Registration failed!";
                }

            }else{
                $state = FALSE;
                $message = "Your account is already exist!";
            }
        }

        $response = array(
            "status" => $state,
            "message" => $message,
            // "voucher_code" => $voucherCode
        );
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
    }

    public function actionForgotPassword()
    {
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params = Yii::$app->request->post();
        $state = FALSE;
        $message = "";
        $response = array();

        if(isset($params['_csrf']) && isset($params['email'])){
            $customer = Customer::findOne(['email' => $params['email']]);
            
            if($customer != NULL){
                $token = md5(uniqid(rand(), true));
                
                $customer->forgot_password_token = $token;
                
                try {
                    $customer->save();
                    
                    Helpers::sendEmailMandrillUrlAPI(
                        $this->renderFile('@app/views/template/mail/reset_password.php', array(
                            "token" => $token,
                            "baseUrl" => $baseUrl
                        )), 
                        'The Watch Co - Reset Password', 
                        Yii::$app->params['adminEmail'], 
                        $params['email'], 
                        ''
                    );
                } catch (Exception $ex) {
                    $state = FALSE;
                    $message = "Failed to send email!";
                }
                
                $state = TRUE;
                $message = "An email confirmation has been sent to your email.";
            }else{
                $state = FALSE;
                // fake success message
                $message = "An email confirmation has been sent to your email.";
            }
        }
        $response = array(
            "status" => $state,
            "message" => $message,
        );
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
    }

	// not used
    public function actionResetPassword(){
        $params_get = Yii::$app->request->get();
        $params_post = Yii::$app->request->post();
        $state = FALSE;
        $message = "";
        $response = array();

        $token = $params_get['token'];
        $new_pass = $params_post['new_password'];
        $new_gen_pass = md5($new_pass);
        
        if(!empty($token)){  
            if(isset($new_pass)){
                $customer = Customer::findOne(['forgot_password_token' => $token]);
                
                if($customer != NULL){
                    $customer->passwd = $new_gen_pass;
                    $customer->save();
                    
                    return $this->render('reset-password-response', array('response' => 'Your password has been successfully reset.'));
                }
                
                return $this->render('reset-password-response', array('response' => 'Your password has failed to reset.'));
                
            } else {
                return $this->render('reset-password');
            }
            
        }
    }
}