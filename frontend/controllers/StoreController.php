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

class StoreController extends controller\FrontendController {

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
		
		\Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Kami Hadir di Seluruh Indonesia Cek Toko Terdekat Anda Sekarang!']);
		
        return $this->render('index');
    }

    public function actionGetalllocation() {
        $location = \backend\models\Stores::find()->groupBy('store_location')->all();
        $i = 1;

        foreach ($location as $row) {
            $coordinates = \backend\models\Location::find()->where(['location_name' => $row->store_location, 'location_type' => 'retail'])->one();
            $item[$i] = array('id' => $row->store_id, 'type' => 'image', 'x' => $coordinates['location_x'], 'y' => $coordinates['location_y'], 'hoverText' => strtoupper($row->store_location), 'value' => '1', 'storeType' => 'retail');
            $i++;
        }

        $all = $item;
        return json_encode($all);
    }

}
