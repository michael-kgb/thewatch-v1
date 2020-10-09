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
class JournalcategoryController extends Controller {

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
        $data = \backend\models\JournalCategory::find()->all();
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
        $model = new \backend\models\JournalCategory();

        if (isset($_POST['JournalCategory'])) {

            $journalcat = $_POST['JournalCategory'];

            try {
                $journalCategory = new \backend\models\JournalCategory();
                $journalCategory->journal_category_name = $journalcat['journal_category_name'];
                $journalCategory->journal_category_status = $journalcat['journal_category_status'];
                $journalCategory->journal_category_date_created = date("Y-m-d h:i:s");
                $journalCategory->save();

                $log = new \backend\models\Log();
                $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
                $log->module = Yii::$app->controller->id;
                $log->action = 'create';
                $log->id_onChanged = $journalCategory->journal_category_id;
                $log->save();

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

        if (isset($_POST['JournalCategory'])) {

            $journalcat = $_POST['JournalCategory'];

            try {
                $journalcategory = \backend\models\JournalCategory::findOne(['journal_category_id' => $id]);
                $journalcategory->journal_category_name = $journalcat['journal_category_name'];
                $journalcategory->journal_category_status = $journalcat['journal_category_status'];
                $journalcategory->journal_category_date_modified = date("Y-m-d h:i:s");
                $journalcategory->save();
                $log = new \backend\models\Log();
                $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
                $log->module = Yii::$app->controller->id;
                $log->action = 'update';
                $log->id_onChanged = $journalcategory->journal_category_id;
                $log->save();

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

    public function actionDelete() {

        $journalCategory = \backend\models\JournalCategory::findOne($_POST['id']);
        $journalCategoryId = $journalCategory->journal_category_id;
        
        \backend\models\JournalDetailCategory::deleteAll(['journal_category_id' => $journalCategoryId]);

        $journalCategory->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = \backend\models\JournalCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
