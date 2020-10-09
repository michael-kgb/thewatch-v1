<?php

namespace backend\controllers;

use Yii;
use backend\models\KontesSeoContent;
use backend\models\BlogCompetition;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KontesController implements the CRUD actions for KontesSeoContent model.
 */
class BlogcompetitionController extends Controller
{
    /**
     * @inheritdoc
     */
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
        
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        $model = BlogCompetition::find()->orderBy([
           'kontes_seo_id'=>SORT_DESC,
          
        ])->all();

        
            return $this->render('index', [
                'data' => $model,
            ]);
       
    }

    /**
     * Displays a single KontesSeoContent model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => BlogCompetition::findOne($id),
        ]);
    }

    /**
     * Creates a new KontesSeoContent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = $this->findModel(2);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionExport()
    {
       
            \common\components\PHPExcel_Helper::generateBlogCompetition(
                'Excel'
            );
    }

    /**
     * Creates a new KontesSeoContent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionContent()
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

     /**
     * Creates a new KontesSeoContent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionPending($id)
    {
        $model = BlogCompetition::find()->where(['kontes_seo_id'=>$id])->one();
        $model->kontes_seo_status = 'pending';
        $model->save();
        return $this->redirect(['index']);
    }
    public function actionApproved($id)
    {

        $model = BlogCompetition::find()->where(['kontes_seo_id'=>$id])->one();
        $model->kontes_seo_status = 'approved';
        $model->save();
        return $this->redirect(['index']);
    }
    public function actionDisapproved($id)
    {
        $model = BlogCompetition::find()->where(['kontes_seo_id'=>$id])->one();
        $model->kontes_seo_status = 'disapproved';
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Updates an existing KontesSeoContent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing KontesSeoContent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the KontesSeoContent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KontesSeoContent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KontesSeoContent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
