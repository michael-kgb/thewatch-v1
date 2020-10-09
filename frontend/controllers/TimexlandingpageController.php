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

class TimexlandingpageController extends controller\FrontendController {
    
    public $breadcrumb = ["About"];
    public $title = "";

    
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

    public function beforeAction($action)
 {
    $this->layout = 'main_timex'; //your layout name
    return parent::beforeAction($action);
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
    
    public function actionIndex()
    {
        // $this->layout = "main_timex";
        return $this->render('index');
    }

    public function actionDeni()
    {
        $this->layout = "mainShop";
        return $this->render('deny');
    }
    public function actionMulie()
    {
        $this->layout = "mainShop";
        return $this->render('mulie');
    }
    public function actionThesigit()
    {
        $this->layout = "mainShop";
        return $this->render('thesigit');
    }
    public function actionAlinka()
    {
        $this->layout = "mainShop";
        return $this->render('alinka');
    }
    public function actionMalik()
    {
        $this->layout = "mainShop";
        return $this->render('malik');
    }
    public function actionReservation()
    {
        if($_POST){
            $model = new \backend\models\TimexReservation();
            $model->timex_reservation_name = $_POST['reservation']['name'];
            $model->timex_reservation_phone = $_POST['reservation']['phone'];
            $model->timex_reservation_email = $_POST['reservation']['email'];
            $model->timex_reservation_date = date("Y-m-d H:i:s");
            
          
            try {
                        \common\components\Helpers::sendEmailMandrillUrlAPI(
                                $this->renderFile('@app/views/template/mail/timextaketime.php', array(
                  
                                )), 'Timex Take Time Party E-Ticket', \Yii::$app->params['adminEmail'], $_POST['reservation']['email'], ''
                        );
                        $model->timex_reservation_sended = 'Email Sended';
                    } catch (Exception $ex) {
                        $model->timex_reservation_sended = 'Email not Sended';
                        $model->save();
                        return false;
                    }

                    $model->save();
            return true;
        }else{
            return false;
        }
    }
    
}
