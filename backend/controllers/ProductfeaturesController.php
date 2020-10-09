<?php

namespace backend\controllers;

use Yii;
use common\models\ProductFeatures;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\SignupForm;

/**
 * ProductFeaturesController implements the CRUD actions for ProductFeatures model.
 */
class ProductfeaturesController extends Controller {

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
//                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProductFeatures models.
     * @return mixed
     */
    public function actionIndex() {
        $data = \backend\models\Feature::find()->all();
        
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        return $this->render('index', [
                    'data' => $data, 'add_access' => $permissions['add_access'], 'update_access' => $permissions['update_access'], 'delete_access' => $permissions['delete_access']
        ]);
    }

    /**
     * Displays a single ProductFeatures model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        return $this->render('view', [
                    'model' => $this->findModel($id), 'add_access' => $permissions['add_access'], 'update_access' => $permissions['update_access'], 'delete_access' => $permissions['delete_access']
        ]);
    }

    /**
     * Creates a new ProductFeatures model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new \backend\models\Feature();

        if ($model->load(Yii::$app->request->post())) {
            $model->attributes = $_POST['Feature'];

            try {
                $model->save();

                $log = new \backend\models\Log();
                $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
                $log->module = Yii::$app->controller->id;
                $log->action = 'create';

                $log->id_onChanged = $model->feature_id;

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
     * Updates an existing ProductFeatures model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $log = new \backend\models\Log();
            $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
            $log->module = Yii::$app->controller->id;
            $log->action = 'update';

            $log->id_onChanged = $id;

            $log->save();

            return $this->redirect(['index']);
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
     * Deletes an existing ProductFeatures model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $feature = \backend\models\Feature::findOne($id);

        if (!empty($feature)) {
            $feature->delete();
            $product_feature = \backend\models\ProductFeature::deleteAll(['feature_id' => $id]);
            $product_feature_value = \backend\models\ProductFeatureValue::find()->where(['feature_id' => $id])->all();

            $log = new \backend\models\Log();
            $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
            $log->module = Yii::$app->controller->id;
            $log->action = 'delete';

            $log->id_onChanged = $id;

            $log->save();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductFeatures model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductFeatures the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = \backend\models\Feature::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddfeaturevalue($id) {
        $model = new \backend\models\ProductFeatureValue();

        if ($model->load(Yii::$app->request->post())) {
            $model->attributes = $_POST['ProductFeatureValue'];
            $model->feature_id = $id;

            try {
                $model->save();

                $log = new \backend\models\Log();
                $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
                $log->module = Yii::$app->controller->id;
                $log->action = 'add value';

                $log->id_onChanged = $model->feature_value_id;

                $log->save();

                return $this->redirect('../index');
            } catch (Exception $ex) {
                print_r($model->getErrors());
                die();
            }
        } else {
            
            $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
            $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();
            
            if ($permissions['add_access'] != '1') {
                return $this->redirect('../../permissionscheck');
            }
            
            return $this->render('add_value', [
                        'model' => $model,
            ]);
        }
    }

    public function actionDeletefeaturevalue($id) {
        $featurevalue = \backend\models\ProductFeatureValue::findOne($id);
        $featurevalue->delete();

        $log = new \backend\models\Log();
        $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
        $log->module = Yii::$app->controller->id;
        $log->action = 'del. value';

        $log->id_onChanged = $id;

        $log->save();

        return $this->redirect('../index');
    }

    public function actionUpdatefeaturevalue($id) {
        $model = \backend\models\ProductFeatureValue::findOne($id);

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

}
