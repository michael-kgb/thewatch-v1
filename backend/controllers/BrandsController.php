<?php

namespace backend\controllers;

use Yii;
use backend\models\Brands;
use backend\models\BrandsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BrandsController implements the CRUD actions for Brands model.
 */
class BrandsController extends Controller {

    public $layout = "dashboard";

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
                ],
            ],
        ];
    }
	
	Public $enableCsrfValidation = false;

    /**
     * Lists all Brands models.
     * @return mixed
     */
    public function actionIndex() {
        $data = Brands::find()->all();
        
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        return $this->render('index', [
                    'data' => $data, 'add_access' => $permissions['add_access'], 'update_access' => $permissions['update_access'], 'delete_access' => $permissions['delete_access']
        ]);
    }

    /**
     * Displays a single Brands model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Brands model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Brands();

        if ($model->load(Yii::$app->request->post())) {

            $model->attributes = $_POST['Brands'];
			
			$model->brand_name = $_POST['Brands']['brand_name'];
			$model->brand_description = $_POST['Brands']['brand_description'];
			$model->brand_country = $_POST['Brands']['brand_country'];
			
			$model->meta_description = $_POST['Brands']['meta_description'];
            $model->meta_keywords = $_POST['Brands']['meta_keywords'];

            $image = UploadedFile::getInstance($model, 'brand_logo');
            $image_banner = UploadedFile::getInstance($model, 'brand_banner');
            $image_banner_detail = UploadedFile::getInstance($model, 'brand_banner_detail');
            
            $model->brands_menu_type = $_POST['Brands']['brands_menu_type'];

            $filename = round(microtime(true)) . '.' . $image->extension;
            $filename_banner = round(microtime(true)) . '.' . $image_banner->extension;
            $filename_banner_detail = round(microtime(true)) . '.' . $image_banner_detail->extension;

            $model->brand_logo = $filename;

            $this->upload($image, $filename);
            
            $model->brand_created_date = date("Y-m-d H:i:s");
            $model->brand_sequence = 1;
            $model->save();
            
            $this->upload_brand_banner($image_banner, $filename_banner, $model->brand_id , "create");
            $this->upload_brand_banner_detail($image_banner_detail, $filename_banner_detail, $model->brand_id);

            return $this->redirect(['view', 'id' => $model->brand_id]);
        } else {
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

    /**
     * Updates an existing Brands model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->attributes = $_POST['Brands'];
            $model->brand_name = $_POST['Brands']['brand_name'];
			$model->brand_description = $_POST['Brands']['brand_description'];
			$model->brand_country = $_POST['Brands']['brand_country'];
			$model->meta_description = $_POST['Brands']['meta_description'];
            $model->meta_keywords = $_POST['Brands']['meta_keywords'];
            $model->brand_homepage = $_POST['Brands']['brand_homepage'];						$model->brand_status = $_POST['Brands']['brand_status'];
            $model->brand_homepage_jewelry = $_POST['Brands']['brand_homepage_jewelry'];
            $model->brand_new_arrival = $_POST['Brands']['brand_new_arrival'];
            
            $brand_menu_type = $_POST['Brands']['brands_menu_type'];
            $brand_menu_type2 = '';
            if($_POST['Brands']['brands_menu_type'] != ''){
                if(isset($_POST['icon'])){
                   
                    if(isset($_POST['icon']['watches'])){
                        $brand_menu_type2 = $brand_menu_type2.'+'.$_POST['icon']['watches'];
                    }
                    if(isset($_POST['icon']['straps'])){
                        $brand_menu_type2 = $brand_menu_type2.'+'.$_POST['icon']['straps'];
                    }
                    if(isset($_POST['icon']['accessories'])){
                        $brand_menu_type2 = $brand_menu_type2.'+'.$_POST['icon']['accessories'];
                    }
                    if(isset($_POST['icon']['jewelry'])){
                        $brand_menu_type2 = $brand_menu_type2.'+'.$_POST['icon']['jewelry'];
                    }

                $brand_menu_type2 = substr($brand_menu_type2, 1);
                $brand_menu_type = $brand_menu_type.'-'.$brand_menu_type2;
                }
                
            }

             $model->brands_menu_type = $brand_menu_type;

                        if($model->brand_homepage == 1){
                $connection = Yii::$app->getDb();
                $connection ->createCommand()
                ->update('brands', ['brand_homepage'=> 0], 'brand_homepage = 1')
                ->execute();
                
            }
            
            if($model->brand_homepage_jewelry == 1){
                $connection = Yii::$app->getDb();
                $connection ->createCommand()
                ->update('brands', ['brand_homepage_jewelry'=> 0], 'brand_homepage_jewelry = 1')
                ->execute();
                
            }
            if($model->brand_new_arrival == 1){
                $connection = Yii::$app->getDb();
                $connection ->createCommand()
                ->update('brands', ['brand_new_arrival'=> 0], 'brand_new_arrival = 1')
                ->execute();
                
            }
            
            if($_POST['Brands']['brand_new_arrival_start'] == ''){
                $model->brand_new_arrival_start = '0000-00-00 00:00:00';
            }else{
                $model->brand_new_arrival_start = $_POST['Brands']['brand_new_arrival_start'];
            }
            if($_POST['Brands']['brand_new_arrival_end'] == ''){
                $model->brand_new_arrival_end = '0000-00-00 00:00:00';
            }else{
                $model->brand_new_arrival_end = $_POST['Brands']['brand_new_arrival_end'];
            }
			
            $image = UploadedFile::getInstance($model, 'brand_logo');
            $brand_banner = UploadedFile::getInstance($model, 'brand_banner');

            // replace image if user choose new images
            if ($image != NULL) {
                $model = $this->findModel($id);
                $filename = $model->brand_logo;

                $this->deleteFile($filename);

                $newFilename = round(microtime(true)) . '.' . $image->extension;

                $this->upload($image, $newFilename);

                $model->brand_logo = $newFilename;
                
                $model->save();
            } else {

                $keepImages = $this->findModel($id);

                $model->brand_logo = $keepImages->brand_logo;

                $model->save();
            }

            if ($brand_banner != NULL) {
                $brandbanner = \backend\models\BrandsBanner::find()->where(['brands_brand_id' => $id])->one();

                $filename = $brandbanner->brand_banner_small_banner;

                $this->deleteFileBanner($filename);

                $newFilename = round(microtime(true)) . '.' . $brand_banner->extension;

                $this->upload_brand_banner($brand_banner, $newFilename, $id, "update");

                $brandbanner->brand_banner_small_banner = $newFilename;

                $brandbanner->update();
            }
            
            return $this->redirect(['view', 'id' => $model->brand_id]);
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

    public function actionDelete() {
        if (isset($_POST)) {
            try {
                $id = $_POST['brandsbrandid'];
                $model = $this->findModel($id);
                $filename = $model->brand_logo;

                if ($model->delete()) {
                    $this->deleteFile($filename);

                    $brandbanner = \backend\models\BrandsBanner::find()->where(['brands_brand_id' => $id])->one();
                    $this->deleteFileBanner($brandbanner['brand_banner_small_banner']);
                    $brandbanner->delete();

                    $brandbannerdetail = \backend\models\BrandsBannerDetail::find()->where(['brands_brand_id' => $id])->all();

                    foreach ($brandbannerdetail as $row) {
                        $this->deleteFileBannerDetail($row->brands_banner_detail_slide_image, $id);
                        $row->delete();
                    }
                    rmdir('../../frontend/web/img/brand_banner/' . $id);
                }
            } catch (Exception $ex) {
                echo $ex;
                die();
            }
        }
    }

    protected function findModel($id) {
        if (($model = Brands::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function upload($image, $filename) {
        $image->saveAs('../../frontend/web/img/brands/black/' . $filename);
    }

    private function upload_brand_banner($image, $filename, $brand_id, $action) {
        $image->saveAs('../../frontend/web/img/brand_identity/' . $filename);

        if ($action != "update") {
            $brandbanner = new \backend\models\BrandsBanner();
            $brandbanner->brands_brand_id = $brand_id;
            $brandbanner->brand_banner_small_banner = $filename;
            $brandbanner->brand_banner_status = 'Active';
            $brandbanner->save();
        }
    }

    private function upload_brand_banner_detail($image, $filename, $brand_id) {
        if (!is_dir('../../frontend/web/img/brand_banner/' . $brand_id)) {
            mkdir('../../frontend/web/img/brand_banner/' . $brand_id);
        }
        $image->saveAs('../../frontend/web/img/brand_banner/' . $brand_id . '/' . $filename);

        $brandbannerdetail = new \backend\models\BrandsBannerDetail();
        $brandbannerdetail->brands_brand_id = $brand_id;
        $brandbannerdetail->brands_banner_detail_slide_image = $filename;
        $brandbannerdetail->save();
    }

    private function deleteFile($filename) {
        unlink('../../frontend/web/img/brands/black/' . $filename);
    }

    private function deleteFileBanner($filename) {
        unlink('../../frontend/web/img/brand_identity/' . $filename);
    }

    private function deleteFileBannerDetail($filename, $id) {
        unlink('../../frontend/web/img/brand_banner/' . $id . '/' . $filename);
    }

    public function actionDeletebrandbannerdetail() {
        $brandbannerdetail = \backend\models\BrandsBannerDetail::find()->where(['brands_banner_detail_id' => $_POST['bannerdetailid']])->one();
        unlink('../../frontend/web/img/brand_banner/' . $brandbannerdetail->brands_brand_id . '/' . $brandbannerdetail->brands_banner_detail_slide_image);
        $brandbannerdetail->delete();
        $text = "";
        $brandbannerdetail = \backend\models\BrandsBannerDetail::find()->where(['brands_brand_id' => $_POST['brandsbrandid']])->all();
        foreach ($brandbannerdetail as $row) {
            $text = $text . '<div class="col-sm-4" style="padding-bottom: 30px; padding-left: 0px;">'
                    . '<img class="img-responsive" height="150px" src="/twcnew/img/brand_banner/' . $row->brands_brand_id . '/' . $row->brands_banner_detail_slide_image . '">'
                    . '<br><div class="text-center"><a onclick="deleteBrandbannerdetail(' . $row->brands_banner_detail_id . ',' . $row->brands_brand_id . ')" class="btn btn-default"><i class="fa fa-trash"></i> Delete</a></div></div>';
        }

        return $text;
    }

}
