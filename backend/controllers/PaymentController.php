<?php

namespace backend\controllers;

use Yii;
use backend\models\Product;
use backend\models\BrandsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\components\Helpers;

/**
 * BrandsController implements the CRUD actions for Brands model.
 */
class PaymentController extends \backend\core\controller\BackendController {

    public function behaviors() {
		
		if(!Yii::$app->session->get('userInfo')){
			return $this->redirect(Yii::$app->params['backendLoginUrl']);
		}
		
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        if ($permissions['view_access'] != '1') {
            return $this->redirect(Yii::$app->params['backendPermissionDeniedUrl']);
        }

        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'create' => ['post'],
                    'delete' => ['post'],
                ],
            ],
        ];
    }
	
	public function actionReminder(){
		
		$module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();
		$data = \backend\models\InvoiceReminder::find()->all();
		
		if($_POST){
			
			$reminder = new \backend\models\InvoiceReminder();
			$reminder->invoice_reminder_name = $_POST['invoice_reminder_name'];
			$reminder->invoice_reminder_day_to_send = $_POST['day'];
			$reminder->invoice_reminder_subject = $_POST['subject'];
			$reminder->invoice_reminder_status = $_POST['status'];
			$reminder->save();
			
			return $this->render('reminder', [
				'data' => $data, 'add_access' => $permissions['add_access'], 'update_access' => $permissions['update_access'], 'delete_access' => $permissions['delete_access']
			]);
		}
		
		return $this->render('reminder', [
			'data' => $data, 'add_access' => $permissions['add_access'], 'update_access' => $permissions['update_access'], 'delete_access' => $permissions['delete_access']
        ]);
	}

    public function actionIndex() {
        $data = \backend\models\PaymentMethodDetail::find()->orderBy([
           'payment_method_id'=>SORT_ASC,
        ])->all();

        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        return $this->render('index', [
			'data' => $data, 'add_access' => $permissions['add_access'], 'update_access' => $permissions['update_access'], 'delete_access' => $permissions['delete_access']
        ]);
    }
	

}
