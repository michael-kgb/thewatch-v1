<?php

namespace backend\controllers;

use Yii;
use backend\models\ProductCategory;
// use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * ProductcategoryController implements the CRUD actions for ProductCategory model.
 */
class ProductcategoryController extends Controller
{
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
        $data = \backend\models\ProductCategory::find()->orderBy('product_category_id DESC')->all();
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
                   
        ]);
    }

    /**
     * Creates a new tags model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new \backend\models\ProductCategory();
        
        if ($model->load(Yii::$app->request->post())) {

            $image = UploadedFile::getInstance($model, 'product_category_images');
            $image_mobile = UploadedFile::getInstance($model, 'product_category_images_mobile');
            

            $filename = round(microtime(true)) . '.' . $image->extension;
            $filename_mobile = round(microtime(true)) . '.' . $image_mobile->extension;
            $model->product_category_images = $filename;
            
            $model->product_category_sequence = count(\backend\models\ProductCategory::find()->all())+1;
            $model->has_child = 0;
            $model->product_category_featured = 1;

            $model->product_category_created_date = date("Y-m-d h:i:sa");
            
            $model->save();
            $this->upload($image, $filename);
            $this->upload($image_mobile, $filename_mobile);

            $log = new \backend\models\Log();
                $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
                $log->module = Yii::$app->controller->id;
                $log->action = 'create';

                $log->id_onChanged = $model->product_category_id;

                $log->save();

            return $this->render('index', [
                        'model' => $model,
                        
            ]);
        }else {
            $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
            $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

            if ($permissions['add_access'] != '1') {
                return $this->redirect('../permissionscheck');
            }
            
            return $this->render('create', [
                        'model' => $model,
                    
            ]);
        }
    }
    public function actionSequence(){
        $data = ProductCategory::find()->orderBy('product_category_sequence ASC')->where(['product_category_status' => 'active'])->all();
        
        return $this->render('sequence', array(
            'data' => $data
        ));
    }
    
    public function actionReordering(){
        $items = $_POST['item'];
        foreach ($items as $key => $value) {
            $key += 1;
            $homebanner = \backend\models\ProductCategory::findOne(['product_category_id' => $value]);
            $homebanner->product_category_sequence = $key;
            $homebanner->save();
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

        if ($model->load(Yii::$app->request->post())) {

            $image = UploadedFile::getInstance($model, 'product_category_images');
            $image_mobile = UploadedFile::getInstance($model, 'product_category_images_mobile');
           

            // replace image if user choose new images
            if ($image != NULL) {
                $model2 = $this->findModel($id);
                $filename = $model2->product_category_images;

                $this->deleteFile($filename);

                $newFilename = round(microtime(true)) . '.' . $image->extension;

                $this->upload($image, $newFilename);

                $model->product_category_images = $newFilename;
                
                // $model->save();
            } if($image == NULL) {

                $keepImages = $this->findModel($id);

                $model->product_category_images = $keepImages->product_category_images;

                // $model->save();
            }

            if ($image_mobile != NULL) {
                $model2 = $this->findModel($id);
                $filename_mobile = $model2->product_category_images_mobile;

                $this->deleteFile($filename);

                $newFilename_mobile = round(microtime(true)) . 'm.' . $image_mobile->extension;

                $this->upload($image_mobile, $newFilename_mobile);

                $model->product_category_images_mobile = $newFilename_mobile;
                
                // $model->save();
            } if ($image_mobile == NULL) {

                $keepImages = $this->findModel($id);

                $model->product_category_images_mobile = $keepImages->product_category_images_mobile;

                // $model->save();
            }

            $model->save();

            $log = new \backend\models\Log();
            $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
            $log->module = Yii::$app->controller->id;
            $log->action = 'update';

            $log->id_onChanged = $model->product_category_id;

            $log->save();

            return $this->redirect('../index');
        } else {
            $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
            $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

            if ($permissions['update_access'] != '1') {
                return $this->redirect('../../permissionscheck');
            }

            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing tags model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    
    /**
     * Deletes an existing tags model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {

       

        //$campaign = $this->findModel($id);
       
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

   
    private function upload($image, $filename) {
        
        
        $image->saveAs('../../frontend/web/img/category/'. $filename);
    }
    private function deleteFile($filename) {
        unlink('../../frontend/web/img/category/'. $filename);
    }

    /**
     * Finds the tags model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return tags the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = \backend\models\ProductCategory::findOne($id)) !== null) {
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
