<?php

namespace backend\controllers;

use Yii;
use common\models\group;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\SignupForm;

/**
 * groupController implements the CRUD actions for group model.
 */
class PermissionscheckController extends Controller {

    public $layout = "dashboard";

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $data = \backend\models\Group::find()->all();
        
        $departement = Yii::$app->session->get('userInfo')['departement'];
		
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		
		if($departement == "Store Staff"){
			$this->layout = "storeadmin/dashboard_storeadmin";

		}

        return $this->render('/layouts/block_user');
    }

}
