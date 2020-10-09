<?php

namespace app\modules\api\controllers;

use Yii;
use frontend\core\controller\FrontendController;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Request;
use common\components\Helpers;
use yii\helpers\Url;
use frontend\models\CustomerForm;
use yii\web\Session;

class TestController extends FrontendController
{

    public function actionCallComponent()
    { 
        $response = array();

        // $digi_msg = Yii::$app->digicarts->display('Congrats! This is your custom Component.');
        // $digi_msg = Yii::$app->digicarts->display();
        $digi_msg = Yii::$app->digicarts->total();
        // $digi_msg = Yii::$app->digicarts->contents();

        $response = array(
            'result' => TRUE,
            'message' => $digi_msg,
        );
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
        exit();
    }
}