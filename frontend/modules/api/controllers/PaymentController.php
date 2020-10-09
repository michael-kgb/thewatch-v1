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
use yii\web\Request;
use DrewM\MailChimp\MailChimp;
use common\components\Helpers;
use yii\helpers\Url;
use backend\models\Customer;
use backend\models\CustomerAddress;
use backend\models\CartRule;
use backend\models\CartRuleLang;
use frontend\models\CustomerForm;
use yii\web\Session;
use veritrans\Veritrans;

class PaymentController extends FrontendController
{
    public $title = "";
    
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

    public function actionDigiSession2()
    {
        session_start();
        $session = Yii::$app->session;
        $customerInfo = $session['customerInfo'];
        $shippingMethod = $customerInfo['shippingMethod'];
        $voucherInfo = $session->get('voucherInfo');

        $customerInfo = $session["customerInfo"];
        if (!isset($customerInfo)){
            $response = array("message" => "You haven't Sign In yet.");
        }else{
            $response = array(
                "customerInfo" => $customerInfo,
                "shippingMethod" => $shippingMethod,
                "voucherInfo" => $voucherInfo,
            );
        }
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
        exit();
    }

    public function actionTest()
    {
        \Veritrans_Config::$isProduction = Yii::$app->params['vtrans_conf']['is_production'];
        \Veritrans_Config::$serverKey = Yii::$app->params['vtrans_conf']['svr_key'];
        \Veritrans_Config::$clientKey = Yii::$app->params['vtrans_conf']['clnt_key'];
        $url = Yii::$app->params['vtrans_conf']['api_url'];

        $response = array(
            'server_name' => $_SERVER['SERVER_NAME'],
            'env' => APPLICATION_ENV,
            'is_production' => \Veritrans_Config::$isProduction,
            'url' => $url,
            'client_key' => \Veritrans_Config::$clientKey,
            'server_key' => \Veritrans_Config::$serverKey,
        );
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
        exit();
    }
}