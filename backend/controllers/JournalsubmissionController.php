<?php

namespace backend\controllers;

use Yii;
use common\models\group;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * groupController implements the CRUD actions for group model.
 */
class JournalsubmissionController extends Controller {

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
        $data = \backend\models\JournalSubmission::find()->all();
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();
        return $this->render('index', [
                    'data' => $data, 'add_access' => $permissions['add_access'], 'update_access' => $permissions['update_access'], 'delete_access' => $permissions['delete_access']
        ]);
    }

    /**
     * Displays a single group model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $data = \backend\models\Journal::find()->joinWith(['journalDetail', 'journalAuthor', 'journalCategory'])->all();
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new group model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new \backend\models\Journal();

        if (isset($_POST['Journal'])) {
            try {

                $journal = new \backend\models\Journal();
                $journal->journal_category_id = 1;
                $journal->journal_author_id = $_POST['Journal']['journal_author_id'];
                $journal->journal_created_date = date("Y-m-d H:i:S");
                $journal->journal_modified_date = "0000-00-00 00:00:00";
                $journal->journal_status = 1;
                $journal->save();

                $journal_detail = new \backend\models\JournalDetail();
                $journal_detail->journal_id = $journal->journal_id;
                $journal_detail->journal_detail_title = $_POST['JournalDetail']['journal_detail_title'];
                $journal_detail->journal_detail_description = $_POST['JournalDetail']['journal_detail_description'];
                $journal_detail->journal_detail_content1 = $_POST['JournalDetail']['journal_detail_content1'];
                $journal_detail->journal_detail_content2 = "-";
                $journal_detail->link_rewrite = str_replace(" ", "-", $_POST['JournalDetail']['journal_detail_title']);
                $journal_detail->save();

                for ($i = 0; $i < count($_POST['Journal']['journal_category_id']); $i++) {
                    $checkavailable = \backend\models\JournalDetailCategory::find()->where(['journal_category_id' => $_POST['Journal']['journal_category_id'][$i], 'journal_detail_id' => $journal_detail->journal_detail_id])->one();
                    if (empty($checkavailable)) {
                        $journal_detail_category = new \backend\models\JournalDetailCategory();
                        $journal_detail_category->journal_category_id = $_POST['Journal']['journal_category_id'][$i];
                        $journal_detail_category->journal_detail_id = $journal_detail->journal_detail_id;
                        $journal_detail_category->save();
                    }
                }

                $journal_image_big_cover = new \backend\models\JournalImage();
                $journal_image_big_cover->journal_id = $journal->journal_id;
                $journal_image_big_cover->orientation = 'L';
                $journal_image_big_cover->position = 0;
                $journal_image_big_cover->small_cover = null;
                $journal_image_big_cover->big_cover = 1;
                $journal_image_big_cover->save();

                $image_big_cover = $_FILES['JournalImageBigCover']['tmp_name'];
                $extension = explode(".", $_FILES["JournalImageBigCover"]["name"]);
                $filename = 'big_cover_' . $journal_image_big_cover->journal_image_id . '.' . 'jpg';
                $imagePath = \Yii::getAlias("@frontend" . '/web/img/journal/' . $journal->journal_id);
                mkdir($imagePath);
                move_uploaded_file($image_big_cover, $imagePath . '/' . $filename);

                $journal_image_small_cover = new \backend\models\JournalImage();
                $journal_image_small_cover->journal_id = $journal->journal_id;
                $journal_image_small_cover->orientation = 'L';
                $journal_image_small_cover->position = 0;
                $journal_image_small_cover->small_cover = 1;
                $journal_image_small_cover->big_cover = 0;
                $journal_image_small_cover->save();

                $image_small_cover = $_FILES['JournalImageSmallCover']['tmp_name'];
                $extension = explode(".", $_FILES["JournalImageSmallCover"]["name"]);
                $filename = 'small_cover_' . $journal_image_big_cover->journal_image_id . '.' . 'jpg';
                move_uploaded_file($image_small_cover, $imagePath . '/' . $filename);

                if (!empty($_FILES['JournalImageLandscapeImage']['name'][0])) {
                    for ($i = 0; $i < count($_FILES['JournalImageLandscapeImage']['name']); $i++) {
                        $journal_image_landscape = new \backend\models\JournalImage();
                        $journal_image_landscape->journal_id = $journal->journal_id;
                        $journal_image_landscape->orientation = 'L';
                        $journal_image_landscape->position = $i + 1;
                        $journal_image_landscape->small_cover = null;
                        $journal_image_landscape->big_cover = 0;
                        $journal_image_landscape->save();

                        $image_landscape = $_FILES['JournalImageLandscapeImage']['tmp_name'][$i];
                        $extension = explode(".", $_FILES["JournalImageLandscapeImage"]["name"][$i]);
                        $filename = $journal_image_landscape->journal_image_id . '.' . 'jpg';
                        move_uploaded_file($image_landscape, $imagePath . '/' . $filename);
                    }
                }

                if (!empty($_FILES['JournalImagePortraitImage']['name'][0])) {
                    for ($i = 0; $i < count($_FILES['JournalImagePortraitImage']['name']); $i++) {
                        $journal_image_landscape = new \backend\models\JournalImage();
                        $journal_image_landscape->journal_id = $journal->journal_id;
                        $journal_image_landscape->orientation = 'P';
                        $journal_image_landscape->position = $i + 1;
                        $journal_image_landscape->small_cover = null;
                        $journal_image_landscape->big_cover = 0;
                        $journal_image_landscape->save();

                        $image_landscape = $_FILES['JournalImagePortraitImage']['tmp_name'][$i];
                        $extension = explode(".", $_FILES["JournalImagePortraitImage"]["name"][$i]);
                        $filename = $journal_image_landscape->journal_image_id . '.' . 'jpg';
                        move_uploaded_file($image_landscape, $imagePath . '/' . $filename);
                    }
                }

                return $this->redirect('index');
            } catch (Exception $ex) {
                print_r($model->getErrors());
                die();
            }
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
     * Updates an existing group model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        if ($permissions['update_access'] != '1') {
            return $this->redirect('../../permissionscheck');
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing group model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete() {

        $journal = \backend\models\Journal::findOne($_POST['id']);
        $journal_detail = \backend\models\JournalDetail::find()->where(['journal_id' => $_POST['id']])->one();
        $journal_image = \backend\models\JournalImage::find()->where(['journal_id' => $_POST['id']])->all();

        $imagePath = \Yii::getAlias("@frontend" . '/web/img/journal/' . $_POST['id']);
        $valid = 0;
        foreach ($journal_image as $row) {
            if ($row->big_cover == 1 && $valid == 0) {
                unlink($imagePath . '/small_cover_' . $row->journal_image_id . '.jpg');
                unlink($imagePath . '/big_cover_' . $row->journal_image_id . '.jpg');
                $valid = 1;
            } else if ($row->small_cover == 1) {
                
            } else {
                unlink($imagePath . '/' . $row->journal_image_id . '.jpg');
            }
            $row->delete();
        }
        rmdir($imagePath);
        
        $category = \backend\models\JournalDetailCategory::deleteAll(['journal_detail_id' => $journal_detail->journal_detail_id]);
        
        $journal->delete();
        $journal_detail->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = \backend\models\Journal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpdatecontent() {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $category = $_POST['category'];
        $writer = $_POST['writer'];
        $status = $_POST['status'];
        $description = $_POST['description'];
        $content = $_POST['content'];

        $journal = \backend\models\Journal::findOne($id);
        $journal->journal_category_id = $category;
        $journal->journal_author_id = $writer;
        $journal->journal_modified_date = date('Y-m-d h:i:s');
        $journal->journal_status = $status;
        $journal->save();

        $journaldetail = \backend\models\JournalDetail::find()->where(['journal_id' => $id])->one();
        $journaldetail->journal_detail_title = $title;
        $journaldetail->journal_detail_description = $description;
        $journaldetail->journal_detail_content1 = $content;
        $journaldetail->journal_detail_content2 = '-';
        $journaldetail->link_rewrite = str_replace(" ", "-", $title);
        $journaldetail->save();
    }

    public function actionUploadsmallcover() {
        $journalimage = \backend\models\JournalImage::find()->where(['big_cover' => 1, 'journal_id' => $_POST['journal_id']])->one();
        $imagePath = \Yii::getAlias("@frontend" . '/web/img/journal/' . $_POST['journal_id']);
        unlink($imagePath . '/small_cover_' . $journalimage->journal_image_id . '.jpg');

        $small_cover = $_FILES['image']['tmp_name'];
        $extension = explode(".", $_FILES["image"]["name"]);
        $filename = 'small_cover_' . $journalimage->journal_image_id . '.' . 'jpg';
        move_uploaded_file($small_cover, $imagePath . '/' . $filename);

        return json_encode('<img src="../../../../frontend/web/img/journal/' . $_POST['journal_id'] . '/small_cover_' . $journalimage->journal_image_id . '.jpg" class="img-responsive"/>');
    }

    public function actionUploadbigcover() {
        $journalimage = \backend\models\JournalImage::find()->where(['big_cover' => 1, 'journal_id' => $_POST['journal_id']])->one();
        $imagePath = \Yii::getAlias("@frontend" . '/web/img/journal/' . $_POST['journal_id']);
        unlink($imagePath . '/big_cover_' . $journalimage->journal_image_id . '.jpg');

        $small_cover = $_FILES['image']['tmp_name'];
        $extension = explode(".", $_FILES["image"]["name"]);
        $filename = 'big_cover_' . $journalimage->journal_image_id . '.' . 'jpg';
        move_uploaded_file($small_cover, $imagePath . '/' . $filename);

        return json_encode('<img src="../../../../frontend/web/img/journal/' . $_POST['journal_id'] . '/big_cover_' . $journalimage->journal_image_id . '.jpg" class="img-responsive"/>');
    }

    public function actionDeleteimage() {
        $image_id = $_POST['id'];

        $journal_image = \backend\models\JournalImage::findOne($image_id);
        $journal_id = $journal_image->journal_id;
        $journal_image->delete();

        $imagePath = \Yii::getAlias("@frontend" . '/web/img/journal/' . $journal_id);
        unlink($imagePath . '/' . $image_id . '.jpg');
    }

    public function actionUploadlandscapeimage() {
        $total_image = $_POST['total_image'];
        $journal_image = \backend\models\JournalImage::find()->where(['journal_id' => $_POST['journal_id']])->orderBy('position DESC')->one();
        $position = $journal_image->position;

        for ($i = 0; $i < $total_image; $i++) {
            $position++;
            $journal_image_landscape = new \backend\models\JournalImage();
            $journal_image_landscape->journal_id = $_POST['journal_id'];
            $journal_image_landscape->orientation = 'L';
            $journal_image_landscape->position = $position;
            $journal_image_landscape->small_cover = null;
            $journal_image_landscape->big_cover = 0;
            $journal_image_landscape->save();

            $small_cover = $_FILES['image_upload' . $i]['tmp_name'];
            $extension = explode(".", $_FILES['image_upload' . $i]["name"]);
            $filename = $journal_image_landscape->journal_image_id . '.jpg';
            $imagePath = \Yii::getAlias("@frontend" . '/web/img/journal/' . $_POST['journal_id']);
            move_uploaded_file($small_cover, $imagePath . '/' . $filename);
        }

        return json_encode("true");
    }

    public function actionUploadportraitimage() {
        $total_image = $_POST['total_image'];
        $journal_image = \backend\models\JournalImage::find()->where(['journal_id' => $_POST['journal_id']])->orderBy('position DESC')->one();
        $position = $journal_image->position;

        for ($i = 0; $i < $total_image; $i++) {
            $position++;
            $journal_image_landscape = new \backend\models\JournalImage();
            $journal_image_landscape->journal_id = $_POST['journal_id'];
            $journal_image_landscape->orientation = 'P';
            $journal_image_landscape->position = $position;
            $journal_image_landscape->small_cover = null;
            $journal_image_landscape->big_cover = 0;
            $journal_image_landscape->save();

            $small_cover = $_FILES['image_upload' . $i]['tmp_name'];
            $extension = explode(".", $_FILES['image_upload' . $i]["name"]);
            $filename = $journal_image_landscape->journal_image_id . '.jpg';
            $imagePath = \Yii::getAlias("@frontend" . '/web/img/journal/' . $_POST['journal_id']);
            move_uploaded_file($small_cover, $imagePath . '/' . $filename);
        }
        return json_encode("true");
    }

    public function actionUpdatedetailcategory() {
        $detail_id = $_POST['id'];
        $detail_category_id = $_POST['detail_category_id'];

        $checkavailable = \backend\models\JournalDetailCategory::find()->where(['journal_detail_id' => $detail_id, 'journal_category_id' => $detail_category_id])->one();
        if (empty($checkavailable)) {
            $journal_detail_category = new \backend\models\JournalDetailCategory();
            $journal_detail_category->journal_detail_id = $detail_id;
            $journal_detail_category->journal_category_id = $detail_category_id;
            $journal_detail_category->save();
        }

        $detail_category_list = \backend\models\JournalDetailCategory::find()->where(['journal_detail_id' => $detail_id])->all();
        $text = "";

        foreach ($detail_category_list as $row) {
            $text = $text . '<tr><td>' . $row->journalCategory->journal_category_name . '</td><td><button class="btn btn-default" onclick="delete_journal_category(' . $row->journal_detail_category_id . ')"><i class="fa fa-close"></i> Delete</button></td></tr>';
        }

        return $text;
    }

    public function actionDeletedetailcategory() {
        $detail_category_id = $_POST['id'];

        $journal_detail_category = \backend\models\JournalDetailCategory::findOne($detail_category_id);
        $journal_detail_id = $journal_detail_category->journal_detail_id;
        $journal_detail_category->delete();

        $detail_category_list = \backend\models\JournalDetailCategory::find()->where(['journal_detail_id' => $journal_detail_id])->all();
        $text = "";

        foreach ($detail_category_list as $row) {
            $text = $text . '<tr><td>' . $row->journalCategory->journal_category_name . '</td><td><button class="btn btn-default" onclick="delete_journal_category(' . $row->journal_detail_category_id . ')"><i class="fa fa-close"></i> Delete</button></td></tr>';
        }

        return $text;
    }

}
