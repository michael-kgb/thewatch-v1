<?php

namespace backend\controllers;

use Yii;
use common\models\branches;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * branchesController implements the CRUD actions for branches model.
 */
class BranchesController extends Controller {

    public $layout = "dashboard";

    public function behaviors() {
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();
        
        if($permissions['view_access'] != '1'){
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
     * Lists all branches models.
     * @return mixed
     */
    public function actionIndex() {
        $data = \backend\models\Branches::find()->all();
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        return $this->render('index', [
            'data' => $data, 'add_access' => $permissions['add_access'], 'update_access' => $permissions['update_access'], 'delete_access' => $permissions['delete_access']
        ]);
    }

    /**
     * Displays a single branches model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new branches model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new \backend\models\Branches();

        if ($model->load(Yii::$app->request->post())) {
            $model->attributes = $_POST['Branches'];
            
            try {
                $model->save();

                $log = new \backend\models\Log();
                $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
                $log->module = Yii::$app->controller->id;
                $log->action = 'create';

                $log->id_onChanged = $model->branch_id;

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
     * Updates an existing branches model.
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

            $log->id_onChanged = $model->branch_id;

            $log->save();

            return $this->redirect(['view', 'id' => $model->branch_id]);
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
     * Deletes an existing branches model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        //update all user if branches $id to 0
        $user = \backend\models\User::find()->where(['branches_id' => $id])->all();
  
        foreach ($user as $row) {
            $user_update = \backend\models\User::findOne($row->id);
            $user_update->branches_id = 0;
            $user_update->update();
        }
        
        //remove all permissions if branches $id
        $permissions = \backend\models\Permissions::find()->where(['branches_id' => $id])->all();
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
     * Finds the branches model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return branches the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = \backend\models\Branches::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
