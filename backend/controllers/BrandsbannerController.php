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
class BrandsbannerController extends Controller {

    public $layout = "dashboard";
	public $enableCsrfValidation = false;

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
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Brands models.
     * @return mixed
     */
    public function actionIndex() {
        $data = \backend\models\Brands::find()->all();
        
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

    public function actionDelete($id) {
        if (isset($_POST)) {
            try {
                $model = $this->findModel($id);
                $filename = $model->brand_logo;

                if ($model->delete()) {
                    $this->deleteFile($filename);
                }

                $homebanner = Brands::find()->all();

                $html = '';
                $no = 1;
                foreach ($homebanner as $row) {
                    $html .= '<tr>'
                            . '<td>' . $no . '</td>'
                            . '<td>' . $row->brand_name . '</td>'
                            . '<td>' . $row->brand_status . '</td>'
                            . '<td>'
                            . '<div class="btn-group">
                               <button onclick="viewRecord(' . $row->brand_id . ', brands)" type="button" class="btn btn-default">
                               <i class="fa fa-search"></i></button></div>'
                            . '<div class="btn-group">
                               <button onclick="updateRecord(' . $row->brand_id . ', brands)" type="button" class="btn btn-default">
                               <i class="fa fa-edit"></i></button></div>'
                            . '<div class="btn-group">
                               <button type="button" class="btn btn-default" onclick="deleteRecord(' . $row->brand_id . ', brands);">
                               <i class="fa fa-trash"></i></button></div>'
                            . '</td>'
                            . '</tr>';
                    $no++;
                }

                return json_encode(array("data" => $html));
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
	
	public function actionUpdatekategoribrandbannerdetail() {
        $brandbannerdetail = \backend\models\BrandsBannerDetail::find()->where(['brands_banner_detail_id' => $_POST['bannerdetailid']])->one();
        if($brandbannerdetail->brands_banner_featured_jewelry == 1){
            $brandbannerdetail->brands_banner_featured_jewelry = 0;
        }else{
            $brandbannerdetail->brands_banner_featured_jewelry = 1;
        }
        
        $brandbannerdetail->save();
        $text = "";
        $brandbannerdetail = \backend\models\BrandsBannerDetail::find()->where(['brands_brand_id' => $_POST['brandsbrandid']])->all();
        foreach ($brandbannerdetail as $row) {
            $text = $text . '<div class="col-sm-4" style="padding-bottom: 30px; padding-left: 0px;">'
                    . '<img class="img-responsive" height="150px" src="/twcnew/img/brand_banner/' . $row->brands_brand_id . '/' . $row->brands_banner_detail_slide_image . '">'
                    . '<br><div class="text-center"><a onclick="deleteBrandbannerdetail(' . $row->brands_banner_detail_id . ',' . $row->brands_brand_id . ')" class="btn btn-default"><i class="fa fa-trash"></i> Delete</a></div></div>';
        }

        return $text;
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

    public function actionUpload() {

        if (!is_dir('../../frontend/web/img/brand_banner/' . $_POST['brands_brand_id'])) {
            mkdir('../../frontend/web/img/brand_banner/' . $_POST['brands_brand_id']);
        }

        for ($i = 0; $i < $_POST['total_image']; $i++) {

            $temp = explode(".", $_FILES["image_upload" . $i]["name"]);
            $newFilename = round(microtime(true)) . $i . '.' . end($temp);
            $image = $_FILES["image_upload" . $i]['tmp_name'];

            $target = '../../frontend/web/img/brand_banner/' . $_POST['brands_brand_id'] . '/' . $newFilename;
            move_uploaded_file($image, $target);

            $brandbannerdetail = new \backend\models\BrandsBannerDetail();
            $brandbannerdetail->brands_brand_id = $_POST['brands_brand_id'];
            $brandbannerdetail->brands_banner_detail_slide_image = $newFilename;
            $brandbannerdetail->save();
        }

        $text = "";
        $brandbannerdetail = \backend\models\BrandsBannerDetail::find()->where(['brands_brand_id' => $_POST['brands_brand_id']])->all();
        foreach ($brandbannerdetail as $row) {
            $text = $text . '<div class="col-sm-4" style="padding-bottom: 30px; padding-left: 0px;">'
                    . '<img class="img-responsive" height="150px" src="/twcnew/img/brand_banner/' . $row->brands_brand_id . '/' . $row->brands_banner_detail_slide_image . '">'
                    . '<br><div class="text-center"><a onclick="deleteBrandbannerdetail(' . $row->brands_banner_detail_id . ',' . $row->brands_brand_id . ')" class="btn btn-default"><i class="fa fa-trash"></i> Delete</a></div></div>';
        }

        return $text;
    }
    
    public function actionUploadfeatured() {

        if (!is_dir('../../frontend/web/img/brand_banner/' . $_POST['brands_brand_id'])) {
            mkdir('../../frontend/web/img/brand_banner/' . $_POST['brands_brand_id']);
        }

        for ($i = 0; $i < $_POST['total_image']; $i++) {

            $temp = explode(".", $_FILES["image_upload" . $i]["name"]);
            $newFilename = round(microtime(true)) . $i . '.' . end($temp);
            $image = $_FILES["image_upload" . $i]['tmp_name'];

            $target = '../../frontend/web/img/brand_banner/' . $_POST['brands_brand_id'] . '/' . $newFilename;
            move_uploaded_file($image, $target);

            $brandbannerdetail = new \backend\models\BrandsBannerDetail();
            $brandbannerdetail->brands_brand_id = $_POST['brands_brand_id'];
            $brandbannerdetail->brands_banner_detail_slide_image = $newFilename;
            $brandbannerdetail->brands_banner_featured_brand = 1;
            $brandbannerdetail->save();
        }

        $text = "";
        $brandbannerdetail = \backend\models\BrandsBannerDetail::find()->where(['brands_brand_id' => $_POST['brands_brand_id']])->all();
        foreach ($brandbannerdetail as $row) {
            $text = $text . '<div class="col-sm-4" style="padding-bottom: 30px; padding-left: 0px;">'
                    . '<img class="img-responsive" height="150px" src="/twcnew/img/brand_banner/' . $row->brands_brand_id . '/' . $row->brands_banner_detail_slide_image . '">'
                    . '<br><div class="text-center"><a onclick="deleteBrandbannerdetail(' . $row->brands_banner_detail_id . ',' . $row->brands_brand_id . ')" class="btn btn-default"><i class="fa fa-trash"></i> Delete</a></div></div>';
        }

        return $text;
    }
    
    public function actionUploadfeaturedmobile() {

        if (!is_dir('../../frontend/web/img/brand_banner/' . $_POST['brands_brand_id'])) {
            mkdir('../../frontend/web/img/brand_banner/' . $_POST['brands_brand_id']);
        }

        for ($i = 0; $i < $_POST['total_image']; $i++) {

            $temp = explode(".", $_FILES["image_upload" . $i]["name"]);
            $newFilename = round(microtime(true)) . $i . '.' . end($temp);
            $image = $_FILES["image_upload" . $i]['tmp_name'];

            $target = '../../frontend/web/img/brand_banner/' . $_POST['brands_brand_id'] . '/' . $newFilename;
            move_uploaded_file($image, $target);

            $brandbannerdetail = new \backend\models\BrandsBannerDetail();
            $brandbannerdetail->brands_brand_id = $_POST['brands_brand_id'];
            $brandbannerdetail->brands_banner_detail_slide_image = $newFilename;
            $brandbannerdetail->brands_banner_featured_mobile = 1;
            $brandbannerdetail->save();
        }

        $text = "";
        $brandbannerdetail = \backend\models\BrandsBannerDetail::find()->where(['brands_brand_id' => $_POST['brands_brand_id']])->all();
        foreach ($brandbannerdetail as $row) {
            $text = $text . '<div class="col-sm-4" style="padding-bottom: 30px; padding-left: 0px;">'
                    . '<img class="img-responsive" height="150px" src="/twcnew/img/brand_banner/' . $row->brands_brand_id . '/' . $row->brands_banner_detail_slide_image . '">'
                    . '<br><div class="text-center"><a onclick="deleteBrandbannerdetail(' . $row->brands_banner_detail_id . ',' . $row->brands_brand_id . ')" class="btn btn-default"><i class="fa fa-trash"></i> Delete</a></div></div>';
        }

        return $text;
    }

}
