<?php

namespace backend\controllers;

use Yii;
use common\models\Permissions;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\SignupForm;

/**
 * PermissionsController implements the CRUD actions for Permissions model.
 */
class PermissionsController extends Controller {

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
     * Lists all Permissions models.
     * @return mixed
     */
    public function actionIndex() {
        $data = \backend\models\Permissions::find()->all();

        $model = new \backend\models\Permissions();
        
        
        return $this->render('index', [
                    'data' => $data
        ]);
    }

    public function actionIndex2() {
        $group = \backend\models\Group::find()->all();
        $module = \backend\models\Module::find()->all();

        
        foreach ($group as $row) {
            foreach ($module as $roww) {
                $group_id = $row->id;
                $module_id = $roww->id;
                
                $permissions = \backend\models\Permissions::find()->where(['group_id' => $group_id, 'module_id' => $module_id])->one();

                $permissions->view_access = $_POST['group'.$group_id.'module'.$module_id.'view'];
                $permissions->add_access = $_POST['group'.$group_id.'module'.$module_id.'add'];
                $permissions->update_access = $_POST['group'.$group_id.'module'.$module_id.'update'];
                $permissions->delete_access = $_POST['group'.$group_id.'module'.$module_id.'delete'];

                $permissions->update();
            }
        }
        
        return $this->redirect(['index']);
    }
}
