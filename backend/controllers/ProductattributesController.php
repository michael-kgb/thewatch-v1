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
class ProductattributesController extends Controller {

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
     * Lists all tags models.
     * @return mixed
     */
    public function actionIndex() {
        $data = \backend\models\Attributes::find()->all();

        return $this->render('index', [
                    'data' => $data
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
            $model->attributes = $_POST['Attributes'];
            $model->save();

            $attributeValue = new \backend\models\AttributeValue();
            $attributeValue->apps_language_id = 1;
            $attributeValue->value = $_POST['AttributesValue'];
            $attributeValue->save();

            $attributeCombination = new \backend\models\AttributeValueCombination();
            $attributeCombination->attribute_id = $id;
            $attributeCombination->attribute_value_id = $attributeValue->attribute_value_id;
            $attributeCombination->save();

            $log = new \backend\models\Log();
            $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
            $log->module = Yii::$app->controller->id;
            $log->action = 'update';

            $log->id_onChanged = $id;

            $log->save();

            return $this->redirect('../index');
        } else {
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
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        //update all user if tags $id to 0
        $user = \backend\models\User::find()->where(['tags_id' => $id])->all();

        foreach ($user as $row) {
            $user_update = \backend\models\User::findOne($row->id);
            $user_update->tags_id = 0;
            $user_update->update();
        }

        //remove all permissions if tags $id
        $permissions = \backend\models\Permissions::find()->where(['tags_id' => $id])->all();
        $permissions->deleteAll();

        $log = new \backend\models\Log();
        $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
        $log->module = Yii::$app->controller->id;
        $log->action = 'delete';

        $log->id_onChanged = $id;

        $log->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the tags model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return tags the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = \backend\models\Attributes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddattributevalue($id) {
        $model = new \backend\models\AttributeValue();

        if ($model->load(Yii::$app->request->post())) {
            $model->attributes = $_POST['AttributeValue'];
            $model->apps_language_id = 1;

            try {
                $model->save();
                
                $attribute_value_combination = new \backend\models\AttributeValueCombination();
                $attribute_value_combination->attribute_id = $id;
                $attribute_value_combination->attribute_value_id = $model->attribute_value_id;
                $attribute_value_combination->save();
                
                $log = new \backend\models\Log();
                $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
                $log->module = Yii::$app->controller->id;
                $log->action = 'add value';

                $log->id_onChanged = $id;

                $log->save();

                return $this->redirect('../index');
            } catch (Exception $ex) {
                print_r($model->getErrors());
                die();
            }
        } else {
            return $this->render('add_value', [
                        'model' => $model,
            ]);
        }
    }
    
    public function actionUpdateattributevalue($id) {
        $model = \backend\models\AttributeValue::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $log = new \backend\models\Log();
            $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
            $log->module = Yii::$app->controller->id;
            $log->action = 'edit value';

            $log->id_onChanged = $id;

            $log->save();

            return $this->redirect('../index');
        } else {
            return $this->render('add_value', [
                        'model' => $model,
            ]);
        }
    }
    
    public function actionDeleteattributevalue($id) {
        $attribute_value = \backend\models\AttributeValue::findOne($id);
        $attribute_value->delete();
        
        $attribute_combination = \backend\models\AttributeValueCombination::deleteAll(['attribute_value_id' => $id]);

        $log = new \backend\models\Log();
        $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
        $log->module = Yii::$app->controller->id;
        $log->action = 'del. value';

        $log->id_onChanged = $id;

        $log->save();

        return $this->redirect('../index');
    }

}
