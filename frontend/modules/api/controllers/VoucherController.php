<?php

namespace app\modules\api\controllers;

use Yii;
use frontend\core\controller\FrontendController;
// use yii\rest\ActiveController;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Session;
use yii\web\Request;
use DrewM\MailChimp\MailChimp;
use common\components\Helpers;
use backend\models\Customer;
use backend\models\NewsletterSignup;
use backend\models\CartRule;
use backend\models\CartRuleLang;

class VoucherController extends FrontendController
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

    public function actionGetSubscribe()
    {
        $response = Yii::$app->runAction('go-api/newsletter/set-subscribe', ['email' => 'mymaildumpp@gmail.com','fname' => 'Wisnu Khazefa', 'gender' => 'Men']);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		// return $response['message'];
		return $response;
    }

    public function actionSubscribeNewsletter()
    {
        $params = Yii::$app->request->post();

        $email = $params['email'];
        $fname = $params['fname'];
        $gender = $params['gender'];
        $baseUrl = \yii\helpers\Url::base();
        $state = FALSE;
        $message = "";
        $current_date = date('Y-m-d H:i:s');
        $next_week = date('Y-m-d', strtotime("+7 day"));
        $response = array();
        $voucherCode = "";
        
        $exist_customer = Customer::findOne(['email' => $email]);
        $exist_newsletter = NewsletterSignup::findOne(['newsletter_signup_email' => $email]);
        
        if($exist_customer != NULL){
            
            if($exist_newsletter == NULL){
                $newsletter = new NewsletterSignup();
                $newsletter->newsletter_signup_firstname = $fname;
                $newsletter->newsletter_signup_email = $email;
                $newsletter->newsletter_signup_gender = $gender;
                $newsletter->newsletter_signup_date_add = $current_date;
                $newsletter->save();

                $exist_customer->newsletter = 1;
                $exist_customer->save();
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
                $post = $MailChimp->post('lists/f00f21267a/members', $data);
                $state = TRUE;
                $message = "Enjoy welcome gift from us!";
            } catch (Exception $ex) {
                $state = FALSE;
                $message = "Failed to send Mandrill Message!";
            }
            
        } else {
            $state = FALSE;
            $message = "Your account is not available.";
        }

        $response = array(
            "status" => $state,
            "message" => $message,
            // "voucher_code" => $voucherCode
        );
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
    }
}