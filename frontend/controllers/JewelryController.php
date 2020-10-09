<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\core\controller;
use backend\models\BrandsBanner;
use backend\models\BrandsBannerDetail;

class JewelryController extends controller\FrontendController {

    public $breadcrumb = ["Contact"];
    public $title = "";

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

    public function actionIndex() {

        $this->layout = 'mainShop';
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => "Jual jewelry berkualitas Indonesia: ✓ Cicilan 0% ✓ Gratis Ongkir ✓ Jaminan 100% ogirinal. Beli perhiasan cincin, kalung, gelang, & anting online hanya di sini!"]);
// 			\Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $seo->seoPagesContent->seo_pages_meta_keywords]);
			\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => "Jual Jewelry Online Indonesia – The Watch Co."]);
		
		// \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Customer Kami Siap Membantu Anda Hubungi Kami Sekarang!']);
		
        return $this->render('index');
    }

    // public function actionSendinquiries() {
    //     try {
    //         \common\components\Helpers::sendEmailMandrillUrlInquiriesAPI(
    //                 $this->renderFile('@app/views/template/mail/inquiries.php', array(
    //                     "name" => $_POST['name'],
    //                     "email" => $_POST['email'],
    //                     "subject" => $_POST['subject'],
    //                     "message" => $_POST['message'],
    //                     )),
    //                 $_POST['subject'], $_POST['email'], $_POST['name'], 'cs@thewatch.co', ''
    //         );
    //     } catch (Exception $ex) {
            
    //     }
        
    //     return $this->render('success');
    // }

}
