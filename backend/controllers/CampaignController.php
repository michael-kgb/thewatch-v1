<?php

namespace backend\controllers;

use Yii;
use common\models\tags;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * tagsController implements the CRUD actions for tags model.
 */
class CampaignController extends Controller {

    public $layout = "dashboard";

    public function behaviors() {
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        if ($permissions['view_access'] != '1') {
            return $this->redirect('../permissionscheck');
        }

        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                //'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all tags models.
     * @return mixed
     */
    public function actionIndex() {
        $data = \backend\models\MarketingCampaign::find()->orderBy('marketing_campaign_id DESC')->all();
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        return $this->render('index', [
                    'data' => $data, 'add_access' => $permissions['add_access'], 'update_access' => $permissions['update_access'], 'delete_access' => $permissions['delete_access']
        ]);
    }

    /**
     * Displays a single tags model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'data'=> $this->findModelBulkhead($id),
        ]);
    }

    /**
     * Creates a new tags model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new \backend\models\MarketingCampaign();
        $model2 = new \backend\models\MarketingBulkhead();
        
        if ($model->load(Yii::$app->request->post())) {

            $image = UploadedFile::getInstance($model, 'marketing_campaign_banner');
            

            $filename = round(microtime(true)) . '.' . $image->extension;
            $model->marketing_campaign_banner = $filename;
            
            if(isset($_POST['marketing_campaign_product'])){
                $product_id = $_POST['marketing_campaign_product'];
                // \backend\models\MarketingCampaignProduct::deleteAll(['product_parent_id' => $id]);

                    
            }else{
                $model->marketing_campaign_product = '';
            }
            
            // print_r($product_id);die();
            $model->save();

            if(count($product_id) > 0){
                foreach ($product_id as $item) {
                        $relatedItems = new \backend\models\MarketingCampaignProduct();
                        $relatedItems->marketing_campaign_id = $model->marketing_campaign_id;
                        $relatedItems->product_id = $item;
                        $relatedItems->save();
                    }
            }

            $this->upload($image, $filename,$model->marketing_campaign_id);

            $log = new \backend\models\Log();
                $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
                $log->module = Yii::$app->controller->id;
                $log->action = 'create campaign';

                $log->id_onChanged = $model->marketing_campaign_id;

                $log->save();

            return $this->render('create2', [
                        'model' => $model,
                        'model2'=> $model2,
            ]);
        }else {
            $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
            $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

            if ($permissions['add_access'] != '1') {
                return $this->redirect('../permissionscheck');
            }
            
            return $this->render('create', [
                        'model' => $model,
                        'model2'=> $model2,
            ]);
        }
    }

    /**
     * Creates a new tags model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate2() {
        $model2 = new \backend\models\MarketingBulkhead();
        $model3 = new \backend\models\MarketingCampaignBulkhead();

        if ($model2->load(Yii::$app->request->post())) {
            $marketing_campaign_id = $model2['related_campaign'];
            $model2->marketing_bulkhead_name = $model2['marketing_bulkhead_name'];
            $model2->marketing_bulkhead_text = $model2['marketing_bulkhead_text'];
            $model2->marketing_bulkhead_date_from = $model2['marketing_bulkhead_date_from'];
            $model2->marketing_bulkhead_date_to = $model2['marketing_bulkhead_date_to'];
            $model2->marketing_bulkhead_status = $model2['marketing_bulkhead_status'];
            $model2->marketing_bulkhead_type = $model2['marketing_bulkhead_type'];
            $model2->save();


            
            $model3->marketing_campaign_id = $marketing_campaign_id;
            $model3->marketing_bulkhead_id = $model2->marketing_bulkhead_id;

        
            $model3->save();

            $log = new \backend\models\Log();
                $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
                $log->module = Yii::$app->controller->id;
                $log->action = 'create bulkhead';

                $log->id_onChanged = $model2->marketing_bulkhead_id;

                $log->save();

            return $this->redirect(['index']);

        } else {
            $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
            $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

            if ($permissions['add_access'] != '1') {
                return $this->redirect('../permissionscheck');
            }
            
            return $this->render('create', [
                        'model' => $model2,
                        
            ]);
        }
    }

    /**
     * Creates a new tags model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate3($id) {
        $model = $this->findModel($id);
        $model2 = new \backend\models\MarketingBulkhead();
        $model3 = new \backend\models\MarketingCampaignBulkhead();

        if ($model2->load(Yii::$app->request->post())) {
            $marketing_campaign_id = $model2['related_campaign'];
            $model2->marketing_bulkhead_name = $model2['marketing_bulkhead_name'];
            $model2->marketing_bulkhead_text = $model2['marketing_bulkhead_text'];
            $model2->marketing_bulkhead_date_from = $model2['marketing_bulkhead_date_from'];
            $model2->marketing_bulkhead_date_to = $model2['marketing_bulkhead_date_to'];
            $model2->marketing_bulkhead_status = $model2['marketing_bulkhead_status'];
            $model2->marketing_bulkhead_type = $model2['marketing_bulkhead_type'];
            $model2->save();


            
            $model3->marketing_campaign_id = $marketing_campaign_id;
            $model3->marketing_bulkhead_id = $model2->marketing_bulkhead_id;

        
            $model3->save();

            $log = new \backend\models\Log();
                $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
                $log->module = Yii::$app->controller->id;
                $log->action = 'create bulkhead';

                $log->id_onChanged = $model2->marketing_bulkhead_id;

                $log->save();

            return $this->redirect(['index']);

        } else {
            $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
            $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

            if ($permissions['add_access'] != '1') {
                return $this->redirect('../permissionscheck');
            }
            
            return $this->render('create2', [
                        'model' => $model,
                        'model2' => $model2,
            ]);
        }
    }

    /**
     * Updates an existing tags model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model2 = \backend\models\MarketingCampaignProduct::find()->where(['marketing_campaign_id' => $id])->all();
        if ($model->load(Yii::$app->request->post())) {

            $image = UploadedFile::getInstance($model, 'marketing_campaign_banner');
           

            // replace image if user choose new images
            if ($image != NULL) {
                $model2 = $this->findModel($id);
                $filename = $model2->marketing_campaign_banner;

                $this->deleteFile($filename,$id);

                $newFilename = round(microtime(true)) . '.' . $image->extension;

                $this->upload($image, $newFilename,$id);

                $model->marketing_campaign_banner = $newFilename;
                
                $model->save();
            } else {

                $keepImages = $this->findModel($id);

                $model->marketing_campaign_banner = $keepImages->marketing_campaign_banner;

                $model->save();
            }

           if(isset($_POST['marketing_campaign_product'])){
                $product_id = $_POST['marketing_campaign_product'];
                

                    
            }else{
                $model->marketing_campaign_product = '';
            }
            
            // print_r($product_id);die();
            $model->save();

            if(count($product_id) > 0){
                \backend\models\MarketingCampaignProduct::deleteAll(['marketing_campaign_id' => $model->marketing_campaign_id]);
                foreach ($product_id as $item) {
                        $relatedItems = new \backend\models\MarketingCampaignProduct();
                        $relatedItems->marketing_campaign_id = $model->marketing_campaign_id;
                        $relatedItems->product_id = $item;
                        $relatedItems->save();
                    }
            }


            $log = new \backend\models\Log();
            $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
            $log->module = Yii::$app->controller->id;
            $log->action = 'update campaign';

            $log->id_onChanged = $model->marketing_campaign_id;

            $log->save();

            return $this->redirect('../index');
        } else {
            $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
            $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

            if ($permissions['update_access'] != '1') {
                return $this->redirect('../../permissionscheck');
            }

            return $this->render('update', [
                        'model' => $model, 'model2' => $model2,
            ]);
        }
    }

    /**
     * Updates an existing tags model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate2($id) {
        $model = $this->findModelBulkheadId($id);
        $idcampaign = \backend\models\MarketingCampaignBulkhead::find()->where(['marketing_bulkhead_id'=>$id])->one();
        if ($model->load(Yii::$app->request->post())) {

            $marketing_campaign_id = $model['related_campaign'];
            //$model->marketing_bulkhead_id = $id;
            $model->marketing_bulkhead_name = $model['marketing_bulkhead_name'];
            $model->marketing_bulkhead_text = $model['marketing_bulkhead_text'];
            $model->marketing_bulkhead_date_from = $model['marketing_bulkhead_date_from'];
            $model->marketing_bulkhead_date_to = $model['marketing_bulkhead_date_to'];
            $model->marketing_bulkhead_status = $model['marketing_bulkhead_status'];
            $model->marketing_bulkhead_type = $model['marketing_bulkhead_type'];

            $connection = Yii::$app->getDb();
            $command = $connection  ->createCommand()
            ->update('marketing_bulkhead', ['marketing_bulkhead_name' => $model->marketing_bulkhead_name ,
                'marketing_bulkhead_text' => $model->marketing_bulkhead_text ,
                'marketing_bulkhead_date_from' => $model->marketing_bulkhead_date_from ,
                'marketing_bulkhead_date_to' => $model->marketing_bulkhead_date_to ,
                'marketing_bulkhead_status' => $model->marketing_bulkhead_status ,
                'marketing_bulkhead_type' => $model->marketing_bulkhead_type ], 'marketing_bulkhead_id = '. $id.'')
            ->execute();
            

            $log = new \backend\models\Log();
            $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
            $log->module = Yii::$app->controller->id;
            $log->action = 'update bulkhead';

            $log->id_onChanged = $model->marketing_bulkhead_id;

            $log->save();

            return $this->redirect('../view/'. $idcampaign->marketing_campaign_id);
        } else {
            $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
            $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

            if ($permissions['update_access'] != '1') {
                return $this->redirect('../../permissionscheck');
            }

            return $this->render('update2', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing tags model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {

       

        //$campaign = $this->findModel($id);
        $campaignbulkhead = \backend\models\MarketingCampaignBulkhead::find()->where(['marketing_campaign_id'=>$id])->all();
        $marketing_bulkhead_id = array();
            foreach ($model as $models) {
                $marketing_bulkhead_id = $campaignbulkhead['marketing_bulkhead_id'];
            }
                $bulkhead = \backend\models\MarketingBulkhead::find()->where(['marketing_bulkhead_id'=>$marketing_bulkhead_id])->all();
                 $this->findModel($id)->delete();
                 // \backend\models\MarketingCampaignBulkhead::find()->where(['marketing_campaign_id'=>$id])->delete();
                 // \backend\models\MarketingBulkhead::find()->where(['marketing_bulkhead_id'=>$marketing_bulkhead_id])->delete();
        
        $log = new \backend\models\Log();
        $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
        $log->module = Yii::$app->controller->id;
        $log->action = 'delete';

        $log->id_onChanged = $id;

        $log->save();

        return $this->redirect('../index');
    }

    /**
     * Deletes an existing tags model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete2($id) {

       

        $this->findModelBulkheadId($id)->delete();
        
        
        $log = new \backend\models\Log();
        $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
        $log->module = Yii::$app->controller->id;
        $log->action = 'delete bulkhead';

        $log->id_onChanged = $id;

        $log->save();

        return $this->redirect('../index');
    }
    private function upload($image, $filename,$id) {
        
        if (!is_dir('../../frontend/web/img/campaign/' . $id)) {
            mkdir('../../frontend/web/img/campaign/' . $id);
        }
        $image->saveAs('../../frontend/web/img/campaign/'.$id.'/' . $filename);
    }
    private function deleteFile($filename,$id) {
        unlink('../../frontend/web/img/campaign/black/'.$id.'/' . $filename);
    }

    /**
     * Finds the tags model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return tags the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = \backend\models\MarketingCampaign::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the tags model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return tags the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelBulkheadId($id) {
        if (($model = \backend\models\MarketingBulkhead::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelBulkhead($id) {
        if (($model = \backend\models\MarketingCampaignBulkhead::find()->where(['marketing_campaign_id'=>$id])->all()) !== null) {
            
            $marketing_bulkhead_id = array();
            $j = 0;
            foreach ($model as $models) {
                $marketing_bulkhead_id[$j] = $models['marketing_bulkhead_id'];
                $j++;
            }
            
                return \backend\models\MarketingBulkhead::find()->where(['marketing_bulkhead_id'=>$marketing_bulkhead_id])->all();
            
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionFindcustomer() {

        $customer = \backend\models\Customer::find()->where(['like', 'email', $_GET['email']])->orWhere(['like', 'firstname', $_GET['email']])->limit(10)->all();

        $dataa = array();
        $i = 0;
        foreach ($customer as $row) {
            $dataa[$i] = $row->email;
            $i++;
        }

        return json_encode($dataa);
    }

}
