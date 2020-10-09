<?php

namespace backend\controllers;

use Yii;
use backend\models\Product;
use backend\models\BrandsSearch;
use backend\models\TimexReservation;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\components\Helpers;

/**
 * BrandsController implements the CRUD actions for Brands model.
 */
class TimextaketimeController extends \backend\core\controller\BackendController {

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

    /**
     * Lists all Brands models.
     * @return mixed
     */
     public function actionSend($id,$email){
        $model = \backend\models\TimexReservation::find()->where(['timex_reservation_id'=>$id])->one();

            try {
                        \common\components\Helpers::sendEmailMandrillUrlAPI(
                                $this->renderFile('@app/views/template/mail/timextaketime.php', array(
                  
                                )), 'Timex Take Time Party E-Ticket', \Yii::$app->params['adminEmail'], $email, ''
                        );
                        $model->timex_reservation_sended = 'Email Sended';
                    } catch (Exception $ex) {
                        $model->timex_reservation_sended = 'Email not Sended';
                        $model->update();
                       
                    }

        $model->update();
        
        return $this->redirect(['reservation']);
    }
    public function actionIndex() {
        $data = \backend\models\TimexIg::find()->orderBy([
           'timex_ig_id'=>SORT_DESC,
          
        ])->all();

        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        return $this->render('index', [
                    'data' => $data, 'add_access' => $permissions['add_access'], 'update_access' => $permissions['update_access'], 'delete_access' => $permissions['delete_access']
        ]);
    }
     /**
     * Lists all Brands models.
     * @return mixed
     */
    public function actionReservation() {
        $data = \backend\models\TimexReservation::find()->orderBy([
           'timex_reservation_id'=>SORT_DESC,
          
        ])->all();

        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        return $this->render('indexreservation', [
                    'data' => $data, 'add_access' => $permissions['add_access'], 'update_access' => $permissions['update_access'], 'delete_access' => $permissions['delete_access']
        ]);
    }
     /**
     * Creates a new tags model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateig() {
        $model = new \backend\models\TimexIg();
        // $model2 = new \backend\models\MarketingBulkhead();
        
        if ($model->load(Yii::$app->request->post())) {

            $image = UploadedFile::getInstance($model, 'timex_ig_img');
            

            $filename = round(microtime(true)) . '.' . $image->extension;
            $model->timex_ig_img = $filename;
            $model->timex_ig_link = $_POST['TimexIg']['timex_ig_link'];
            $model->timex_ig_status = $_POST['TimexIg']['timex_ig_status'];
            
            
            // print_r($product_id);die();
            $model->save();

            

            $this->upload($image, $filename);

            $log = new \backend\models\Log();
                $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
                $log->module = Yii::$app->controller->id;
                $log->action = 'create campaign';

                $log->id_onChanged = $model->marketing_campaign_id;

                $log->save();

            return $this->render('index', [
                        'data' => $model,
                      
            ]);
        }else {
            $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
            $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

            if ($permissions['add_access'] != '1') {
                return $this->redirect('../permissionscheck');
            }
            
            return $this->render('createig', [
                        'model' => $model,
                      
            ]);
        }
    }
    private function uploadig($image, $filename) {
        
        $image->saveAs('../../frontend/web/img/timex/ig/' . $filename);
    }
    private function deleteFileig($filename) {
        unlink('../../frontend/web/img/timex/ig/' . $filename);
    }

}
