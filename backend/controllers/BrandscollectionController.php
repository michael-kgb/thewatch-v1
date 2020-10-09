<?php

namespace backend\controllers;

use Yii;
use common\models\brandscollection;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * brandscollectionController implements the CRUD actions for brandscollection model.
 */
class BrandscollectionController extends Controller {

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
                ],
            ],
        ];
    }
	
	public function actionReorderingCollections(){
        $items = $_POST['item'];
        foreach ($items as $key => $value) {
            $brandCollection = \backend\models\BrandsCollection::findOne(['brands_collection_id' => $value]);
            $brandCollection->brands_sequence = $key;
            $brandCollection->save();
        }
    }

    /**
     * Lists all brandscollection models.
     * @return mixed
     */
    public function actionIndex() {
        $data = \backend\models\BrandsCollection::find()->all();
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        return $this->render('index', [
                    'data' => $data, 'add_access' => $permissions['add_access'], 'update_access' => $permissions['update_access'], 'delete_access' => $permissions['delete_access']
        ]);
    }

    /**
     * Displays a single brandscollection model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new brandscollection model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new \backend\models\BrandsCollection();

        if ($model->load(Yii::$app->request->post())) {
            $model->attributes = $_POST['BrandsCollection'];

            try {
                $model->save();

                $log = new \backend\models\Log();
                $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
                $log->module = Yii::$app->controller->id;
                $log->action = 'create';

                $log->id_onChanged = $model->brands_collection_id;

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
     * Updates an existing brandscollection model.
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

            return $this->redirect(['view', 'id' => $id]);
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
     * Deletes an existing brandscollection model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete() {
        $id = $_POST['brand_collection_id'];

        $product = \backend\models\Product::find()->where(['brands_collection_id' => $id])->one();

        if (empty($product)) {
            $this->findModel($id)->delete();
            $log = new \backend\models\Log();
            $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
            $log->module = Yii::$app->controller->id;
            $log->action = 'delete';

            $log->id_onChanged = $id;

            $log->save();
            return 1;
        } else {
            return 0;
        }
    }

    protected function findModel($id) {
        if (($model = \backend\models\BrandsCollection::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
