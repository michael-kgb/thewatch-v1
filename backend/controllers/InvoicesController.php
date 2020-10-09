<?php

namespace backend\controllers;

use Yii;
use common\models\group;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Orders;

/**
 * groupController implements the CRUD actions for group model.
 */
class InvoicesController extends Controller {

    public $layout = "dashboard";
	
	public function beforeAction($action)
	{            
		//if ($action->id == 'my-method') {
			$this->enableCsrfValidation = false;
		//}

		return parent::beforeAction($action);
	}

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
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    
    /**
     * Lists all group models.
     * @return mixed
     */
    public function actionIndex() {
		return $this->render('index', array(
			
		));
    }

    /**
     * Finds the group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = \backend\models\Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionDownload(){
		
		$startDate = $_POST['FromDateInvoice'];
		$endDate = $_POST['ToDateInvoice'];
		
		$ordersModel = Orders::find()
			->andFilterWhere(['between','orders.date_add', $startDate . ' 00:00:00 ', $endDate . ' 23:59:00'])
			->all();
		
		$this->createZip($ordersModel, $startDate, $endDate);
		
		$path = \Yii::getAlias("@backend" . '/web/dist/archive/invoice/Invoice & Delivery Slip ' . $startDate . ' - ' . $endDate . '.zip');
		
        if(file_exists($path)){
			\Yii::$app->response->sendFile($path)->send();
			unlink($path);
        } else {
            return $this->redirect(['invoices/index']);
        }
	}
	
	private function createZip($files, $startDate, $endDate){
		
		//$files = Yii::$app->request->post('img_src');

        $zip = new \ZipArchive();

        $tmp_file = \Yii::getAlias("@backend" . '/web/dist/archive/invoice/Invoice & Delivery Slip ' . $startDate . ' - ' . $endDate . '.zip');

        if(file_exists($tmp_file)){
            $zip->open($tmp_file, \ZipArchive::OVERWRITE);
        } else {
            $zip->open($tmp_file, \ZipArchive::CREATE);
        }
		
		if(count($files) > 0){
			foreach ($files as $file) {
				
				$filename = \Yii::getAlias("@backend" . '/web/dist/invoice/' . $file->reference . '/invoice ' . $file->reference . ' ' . $file->customer->firstname . ' ' . $file->customer->lastname . '.xls');
			
				$zip->addFile($filename, 'invoice/' . $file->reference . '/invoice ' . $file->reference . ' ' . $file->customer->firstname . ' ' . $file->customer->lastname . '.xls');
				
				$filename = \Yii::getAlias("@backend" . '/web/dist/delivery_slip/' . $file->reference . '/sticker ' . $file->reference . ' ' . $file->customer->firstname . ' ' . $file->customer->lastname . '.docx');
			
				$zip->addFile($filename, 'sticker/' . $file->reference . '/sticker ' . $file->reference . ' ' . $file->customer->firstname . ' ' . $file->customer->lastname . '.docx');
				
			}
		}

        $zip->close();
	}

}
