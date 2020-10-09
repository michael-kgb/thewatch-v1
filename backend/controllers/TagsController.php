<?php

namespace backend\controllers;

use Yii;
use common\models\tags;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * tagsController implements the CRUD actions for tags model.
 */
class TagsController extends Controller {

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
        $data = \backend\models\Tags::find()->all();
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
        $model = new \backend\models\Tags();

        if ($model->load(Yii::$app->request->post())) {

            $check_tag = \backend\models\Tags::find()->where(['tag_name' => $_POST['Tags']['tag_name']])->one();

            if (count($check_tag) == 0) {
                $tags = new \backend\models\Tags();
                $tags->tag_name = $_POST['Tags']['tag_name'];
                $tags->apps_language_id = 1;
                $tags->save();
                
                $tag_id = $tags->tag_id;
            } else {
                $tag_id = $check_tag->tag_id;
            }



            if (isset($_POST['productTags'])) {
                if (count($_POST['productTags']) > 0) {

                    foreach ($_POST['productTags'] as $item) {
                        $productTags = new \backend\models\ProductTag();
                        $productTags->product_id = $item;
                        $productTags->tag_id = $tag_id;
                        $productTags->apps_language_id = 1;
                        $productTags->save();
                    }
                }
            }

            $log = new \backend\models\Log();
            $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
            $log->module = Yii::$app->controller->id;
            $log->action = 'create';

            $log->id_onChanged = $tags->tag_id;

            $log->save();

            return $this->redirect('index');
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
     * Updates an existing tags model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if (isset($_POST['productTags'])) {
                if (count($_POST['productTags']) > 0) {

                    // delete all tag product
                    \backend\models\ProductTag::deleteAll('tag_id = :tag_id', [":tag_id" => $id]);

                    foreach ($_POST['productTags'] as $item) {
                        $productTags = new \backend\models\ProductTag();
                        $productTags->product_id = $item;
                        $productTags->tag_id = $id;
                        $productTags->apps_language_id = 1;
                        $productTags->save();
                    }
                }
            } else {
                // delete all tag product
                \backend\models\ProductTag::deleteAll('tag_id = :tag_id', [":tag_id" => $id]);
            }

            $log = new \backend\models\Log();
            $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
            $log->module = Yii::$app->controller->id;
            $log->action = 'update';

            $log->id_onChanged = $id;

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
     * Deletes an existing tags model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete() {
        
        $id = $_POST['tag_id'];
        
        $product_tag = \backend\models\ProductTag::deleteAll(['tag_id' => $id]);
        $this->findModel($id)->delete();
        
        $log = new \backend\models\Log();
        $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
        $log->module = Yii::$app->controller->id;
        $log->action = 'delete';

        $log->id_onChanged = $id;

        $log->save();

        return 1;
    }

    /**
     * Finds the tags model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return tags the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = \backend\models\Tags::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
