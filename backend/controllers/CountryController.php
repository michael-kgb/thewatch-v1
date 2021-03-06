<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use backend\models\Companies;
use yii\web\UploadedFile;

class CountryController extends Controller {

    public $layout = "dashboard";

    public function behaviors() {
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        if ($permissions['view_access'] != '1') {
            return $this->redirect('../permissionscheck');
        }

        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['signout', 'index', 'create', 'delete', 'view', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {
        $data = \backend\models\Country::find()
                        ->joinWith([
                            "zone",])
                        ->orderby('iso_code ASC')->all();
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        return $this->render('index', array(
                    'data' => $data, 'add_access' => $permissions['add_access'], 'update_access' => $permissions['update_access'], 'delete_access' => $permissions['delete_access']
        ));
    }

    public function actionView($id) {
        return $this->render('view', array(
                    'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate() {

        $model = new \backend\models\Country();

        if ($model->load(Yii::$app->request->post())) {

            $model->attributes = $_POST['Country'];
            $model->currency_id = 0;
            $model->call_prefix = 0;
            $model->contains_provinces = 0;
            $model->contains_states = 0;
            $model->contains_districts = 0;
            $model->need_identification_number = 0;
            $model->need_zip_code = 1;
            $model->zip_code_format = "";
            $model->display_tax_label = 0;

            if ($model->save()) {

                $log = new \backend\models\Log();
                $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
                $log->module = Yii::$app->controller->id;
                $log->action = 'create';

                $log->id_onChanged = $model->country_id;

                $log->save();
            }

            return $this->redirect(['view', 'id' => $model->country_id]);
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

    public function actionDelete($id) {
        if (isset($_POST)) {
            try {
                $model = $this->loadModel($id);
                $filename = $model->company_logo;

                if ($model->delete()) {
                    $this->deleteFile($filename);
                }

                $company = Companies::find()->all();

                $html = '';
                $no = 1;
                foreach ($company as $row) {
                    $html .= '<tr>'
                            . '<td>' . $no . '</td>'
                            . '<td>' . $row->company_name . '</td>'
                            . '<td>' . $row->company_email . '</td>'
                            . '<td>' . $row->company_phone . '</td>'
                            . '<td>' . $row->company_status . '</td>'
                            . '<td>'
                            . '<div class="btn-group">
                               <button onclick="viewRecord(' . $row->company_id . ', company)" type="button" class="btn btn-default">
                               <i class="fa fa-search"></i></button></div>'
                            . '<div class="btn-group">
                               <button onclick="updateRecord(' . $row->company_id . ', company)" type="button" class="btn btn-default">
                               <i class="fa fa-edit"></i></button></div>'
                            . '<div class="btn-group">
                               <button type="button" class="btn btn-default" onclick="deleteRecord(' . $row->company_id . ', company);">
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

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->attributes = $_POST['Country'];
            $model->save();

            $log = new \backend\models\Log();
            $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
            $log->module = Yii::$app->controller->id;
            $log->action = 'update';

            $log->id_onChanged = $model->country_id;

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
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = \backend\models\Country::findOne($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
