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
class BrandscategoryController extends Controller {

    public $layout = "dashboard";

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
    }

    /**
     * Lists all Brands models.
     * @return mixed
     */
    public function actionIndex() {
        $data = \backend\models\ProductCategory::find()->where(['product_category_id' => 5])->orWhere(['product_category_id' => 6])->orWhere(['product_category_id' => 7])->orWhere(['product_category_id' => 12])->all();

        return $this->render('index', [
                    'data' => $data,
        ]);
    }
    
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate($id) {
        $model = new \backend\models\CategoryMenu();
        
        if ($model->load(Yii::$app->request->post())) {

            // print_r($_POST['category_menu_child_name']);die();
            $model->product_category_id = $id;

            $model->save();

            if(isset($_POST['category_related'])){
                $rel = $_POST['category_related'];
                // print_r($_POST['category_related']);die();
                foreach ($rel as $row) {
                
                    Yii::$app->db->createCommand()->insert('category_menu_mapping',[
                        'category_menu_id' => $model->category_menu_id ,
                        'category_menu_child_id' => $row])->execute();
                }
               
            }

            
            
            return $this->redirect(['update', 'id' => $id]);
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

     public function actionCreate2($id) {
        $model = new \backend\models\CategoryMenuChild();
        
        if ($model->load(Yii::$app->request->post())) {

            // print_r($_POST['category_menu_child_name']);die();
            $model->save();

            if(isset($_POST['category_related'])){
                $rel = $_POST['category_related'];
                // print_r($_POST['category_related']);die();
                foreach ($rel as $row) {
                
                    Yii::$app->db->createCommand()->insert('category_menu_mapping',[
                        'category_menu_id' => $row ,
                        'category_menu_child_id' => $model->category_menu_child_id ])->execute();
                }
               
            }
            
            
            return $this->redirect(['update', 'id' => $id]);
        } else {
            $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
            $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

            if ($permissions['add_access'] != '1') {
                return $this->redirect('../permissionscheck');
            }
            
            return $this->render('create2', [
                        'model' => $model,
            ]);
        }
    }

    public function actionCreate3($id) {
        $model = new \backend\models\CategoryMenuPicture();
        
        if ($model->load(Yii::$app->request->post())) {

            $image = UploadedFile::getInstance($model, 'category_menu_picture_image');
            

            $filename = round(microtime(true)) . '.' . $image->extension;
            $model->category_menu_picture_image = $filename;
            $model->category_menu_picture_type = 1;
            $model->category_menu_picture_status = $model['category_menu_picture_status'];
            $this->upload($image, $filename);

            $model->product_category_id = $id;
            $model->save();

            
            
            return $this->redirect(['update', 'id' => $id]);
        } else {
            $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
            $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

            if ($permissions['add_access'] != '1') {
                return $this->redirect('../permissionscheck');
            }
            
            return $this->render('create3', [
                        'model' => $model,
                        'ide' => $id,
            ]);
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model2 = \backend\models\CategoryMenu::find()->where(['product_category_id'=>$id])->all();

        $model3 = \backend\models\CategoryMenuPicture::find()->where(['product_category_id'=>$id])->all();

        $model4 = \backend\models\CategoryMenuChild::find()->all();

        if (isset($_POST['brandCategory'])) {
            
            for($i = 0; $i < count($_POST['brandCategory']); $i++){
                $checkbrandcategory = \backend\models\ProductCategoryBrands::find()->where(['brands_brand_id' => $_POST['brandCategory'][$i], 'product_category_category_id' => $id])->one();
                if(empty($checkbrandcategory)){
                    $productbrandcategory = new \backend\models\ProductCategoryBrands();
                    $productbrandcategory->product_category_category_id = $id;
                    $productbrandcategory->brands_brand_id = $_POST['brandCategory'][$i];
                    $productbrandcategory->save();
                }
            }
            
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'data' => $model2,
                        'model3' => $model3,
                        'model4' => $model4,
            ]);
        }
    }

    public function actionPicture($id) {
        $model4 = \backend\models\CategoryMenuPicture::find()->where(['product_category_id'=>$id])->all();
        if ($model4->load(Yii::$app->request->post())) {

            
            $model4->save();


           
            // print_r($_POST['category_menu_child_name']);die();
            
            return $this->redirect(['update', 'id' => $id]);
        } else {
            $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
            $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

            if ($permissions['add_access'] != '1') {
                return $this->redirect('../permissionscheck');
            }
            
            return $this->render('create2', [
                        'model' => $model,
                        
            ]);
        }
    }
    public function actionUpdate2($id) {
        $model = \backend\models\CategoryMenu::find()->where(['category_menu_id'=>$id])->one();
        // $model3 = \backend\models\CategoryMenuMapping::find()->where(['category_menu_id'=>$id])->one();

        // print_r($model3);die();
       if ($model->load(Yii::$app->request->post())) {

            $model->save();

            Yii::$app->db->createCommand()->delete('category_menu_mapping',[
                        'category_menu_id' => $id ])->execute();

            if(isset($_POST['category_related'])){
                $rel = $_POST['category_related'];
                // print_r($_POST['category_related']);die();
                foreach ($rel as $row) {
                
                    Yii::$app->db->createCommand()->insert('category_menu_mapping',[
                        'category_menu_id' => $model->category_menu_id ,
                        'category_menu_child_id' => $row])->execute();
                }
               
            }
            
            return $this->redirect(['index']);
        } else {
            return $this->render('update2', [
                        'model' => $model,
                        
            ]);
        }
    }

    public function actionUpdate3($id) {
        $model = \backend\models\CategoryMenuChild::find()->where(['category_menu_child_id'=>$id])->one();
        // $model3 = \backend\models\CategoryMenuMapping::find()->where(['category_menu_id'=>$id])->one();

        // print_r($model3);die();
       if ($model->load(Yii::$app->request->post())) {

            $model->save();
            
            Yii::$app->db->createCommand()->delete('category_menu_mapping',[
                        'category_menu_child_id' => $id ])->execute();

            if(isset($_POST['category_related'])){
                $rel = $_POST['category_related'];
                // print_r($_POST['category_related']);die();
                foreach ($rel as $row) {
                
                    Yii::$app->db->createCommand()->insert('category_menu_mapping',[
                        'category_menu_id' => $row ,
                        'category_menu_child_id' => $model->category_menu_child_id])->execute();
                }
               
            }

            return $this->redirect(['index']);
        } else {
            return $this->render('update3', [
                        'model' => $model,
                        
            ]);
        }
    }

    public function actionUpdate4($id) {
        $arr_id = explode("-",$id);
        $id = $arr_id[0];
         $ide = $arr_id[1];
        $model = \backend\models\CategoryMenuPicture::find()->where(['category_menu_picture_id'=>$id])->one();
        // $model3 = \backend\models\CategoryMenuMapping::find()->where(['category_menu_id'=>$id])->one();

        // print_r($model3);die();
       if ($model->load(Yii::$app->request->post())) {

            $image = UploadedFile::getInstance($model, 'category_menu_picture_image');
            
            if ($image != NULL) {
                $model2 = \backend\models\CategoryMenuPicture::find()->where(['category_menu_picture_id'=>$id])->one();
                $filename = $model2->category_menu_picture_image;

                $this->deleteFile($filename,$id);

                $newFilename = round(microtime(true)) . '.' . $image->extension;

                $this->upload($image, $newFilename);

                $model->category_menu_picture_image = $newFilename;
                 $model->category_menu_picture_type = 1;
                $model->category_menu_picture_status = $model['category_menu_picture_status'];

                $model->save();
            } else {

                $keepImages = \backend\models\CategoryMenuPicture::find()->where(['category_menu_picture_id'=>$id])->one();

                $model->category_menu_picture_image = $keepImages->category_menu_picture_image;

                 $model->category_menu_picture_type = 1;
                $model->category_menu_picture_status = $model['category_menu_picture_status'];
                $model->save();
            }

          

            
            return $this->redirect(['index']);
        } else {
            $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
            $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

            if ($permissions['add_access'] != '1') {
                return $this->redirect('../permissionscheck');
            }
            
            return $this->render('create3', [
                        'model' => $model,
            ]);
        }
    }


    public function actionDelete($id) {
       $model = \backend\models\CategoryMenu::findOne($id);
       $prod_id = $model->product_category_id;
       Yii::$app->db->createCommand()->delete('category_menu_mapping',[
                        'category_menu_id' => $id ])->execute();
       $model->delete();
       return $this->redirect(['update','id'=>$prod_id]);
    }

    public function actionDelete2($id) {
       $model = \backend\models\CategoryMenuChild::findOne($id);
        Yii::$app->db->createCommand()->delete('category_menu_mapping',[
                        'category_menu_child_id' => $id ])->execute();
       $model->delete();
       return $this->redirect(['index']);
    }

    public function actionDelete3($id) {
        $arr_id = explode("+",$id);
        $id = $arr_id[0];
         $ide = $arr_id[1];
       $model = \backend\models\CategoryMenuPicture::findOne($id);
        $this->deleteFile($model->category_menu_picture_image,$id);
       $model->delete();
       return $this->redirect(['update','id'=>$ide]);
    }

    protected function findModel($id) {
        if (($model = \backend\models\ProductCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function upload($image, $filename) {
        
        
        $image->saveAs('../../frontend/web/img/header/'. $filename);
    }
    private function deleteFile($filename,$id) {
        unlink('../../frontend/web/img/header/' . $filename);
    }

   
}
