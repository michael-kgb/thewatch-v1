<?php

namespace backend\controllers;

use Yii;
use backend\models\Stores;
use backend\models\StoresSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\db\Exception;

/**
 * StoresController implements the CRUD actions for Stores model.
 */
class StorelocationController extends Controller
{
    
    public $layout = "dashboard";

    public function behaviors()
    {
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
     * Lists all Stores models.
     * @return mixed
     */
    public function actionIndex()
    {
        $data = Stores::find()->all();

        return $this->render('index', [
            'data' => $data,
        ]);
    }

    /**
     * Displays a single Stores model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Stores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Stores();
        
        if (isset($_POST['Store'])) {
            
            $data = $_POST['Store'];
            
            $store = new Stores();
            $store->store_name = $data['store_name'];
            $store->store_type = 'retail';
            $store->store_location = $data['store_location'];
            $store->store_address = $data['store_address'];
            $store->store_contact_number = $data['store_contact_number'];
            $store->store_status = $data['store_status'];
            
            $store->store_marketplace = 'offline';
            $store->store_separator = '-';
            $store->store_thumbnail = '-';
            $store->store_contact_person = '-';
            $store->store_sequence = '1';
            
            $store->save();
            
//            print_r($store->getErrors());
//            die();
            
            return $this->redirect(['index']);
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Stores model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (isset($_POST['Store'])) {
            
            $data = $_POST['Store'];
            
            $store = Stores::findOne($id);
            $store->store_name = $data['store_name'];
            $store->store_type = 'retail';
            $store->store_location = $data['store_location'];
            $store->store_address = $data['store_address'];
            $store->store_contact_number = $data['store_contact_number'];
            $store->store_status = $data['store_status'];
            $store->save();
            
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Stores model.
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
     * Finds the Stores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stores::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }
}
