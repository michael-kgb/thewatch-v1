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
class JournalwriterController extends Controller {

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
        $data = \backend\models\JournalAuthor::find()->all();
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
        $model = new \backend\models\JournalAuthor();

        if (isset($_POST['JournalWriter'])) {

            $journalWriter = $_POST['JournalWriter'];

            try {

                $image = $_FILES["photo"]['tmp_name'];
                $name = date('YmdHis') . '.jpg';
                $target = '../../frontend/web/img/journal/author/' . $name;
                move_uploaded_file($image, $target);

                $journalAuthor = new \backend\models\JournalAuthor();
                $journalAuthor->journal_author_name = $journalWriter['journal_author_name'];
                $journalAuthor->link_rewrite = str_replace(' ', '-', strtolower($journalWriter['journal_author_name']));
                $journalAuthor->journal_author_website = $journalWriter['journal_author_website'];
                $journalAuthor->journal_author_phone = $journalWriter['journal_author_phone'];
                $journalAuthor->journal_author_country = $journalWriter['journal_author_country'];
                $journalAuthor->journal_author_description = $journalWriter['journal_author_description'];
                $journalAuthor->journal_author_age = $journalWriter['journal_author_age'];
                $journalAuthor->journal_author_job = $journalWriter['journal_author_job'];
                $journalAuthor->journal_author_status = $_POST['JournalAuthor']['journal_author_status'];
                $journalAuthor->journal_author_created_date = date('Y-m-d h:i:s');
                $journalAuthor->journal_author_photo = $name;

                $journalAuthor->save();

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
        if (!empty($model->journal_author_photo)) {
            $previous_photo = $model->journal_author_photo;
        } else {
            $previous_photo = "";
        }

        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        if ($permissions['update_access'] != '1') {
            return $this->redirect('../../permissionscheck');
        }

        if (isset($_POST['JournalWriter'])) {

            $journalWriter = $_POST['JournalWriter'];

            if (!empty($_FILES['photo']['tmp_name'])) {
                if (!empty($previous_photo)) {
                    unlink('../../frontend/web/img/journal/author/' . $previous_photo);
                }
                $image = $_FILES["photo"]['tmp_name'];
                $name = date('YmdHis') . '.jpg';
                $target = '../../frontend/web/img/journal/author/' . $name;
                move_uploaded_file($image, $target);
            } else {
                $name = $previous_photo;
            }

            $journalAuthor = \backend\models\JournalAuthor::findOne(['journal_author_id' => $id]);

            $journalAuthor->journal_author_name = $journalWriter['journal_author_name'];
            $journalAuthor->journal_author_phone = $journalWriter['journal_author_phone'];
            $journalAuthor->journal_author_website = $journalWriter['journal_author_website'];
            $journalAuthor->journal_author_description = $journalWriter['journal_author_description'];
            $journalAuthor->journal_author_country = $journalWriter['journal_author_country'];
            $journalAuthor->journal_author_job = $journalWriter['journal_author_job'];
            $journalAuthor->journal_author_age = $journalWriter['journal_author_age'];
            $journalAuthor->journal_author_modified_date = date('Y-m-d h:i:s');
            $journalAuthor->journal_author_status = $_POST['JournalAuthor']['journal_author_status'];
            $journalAuthor->journal_author_photo = $name;

            try {
                $journalAuthor->save();
                return $this->redirect('../index');
            } catch (Exception $ex) {
                print_r($model->getErrors());
                die();
            }
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

        $journalAuthor = \backend\models\JournalAuthor::findOne($_POST['id']);
        $journal_author_image = $journalAuthor->journal_author_photo;

        $journalAuthor->delete();

        unlink('../../frontend/web/img/journal/author/' . $journal_author_image);

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
        if (($model = \backend\models\JournalAuthor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
