<?php

namespace backend\controllers;

use Yii;
use backend\models\News;
use backend\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
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
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $data = News::find()->all();

        return $this->render('index', [
            'data' => $data,
        ]);
    }

    /**
     * Displays a single News model.
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
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->attributes = $_POST['News'];
            
            $image = UploadedFile::getInstance($model, 'news_thumbnail');
            
            $filename = date('Ymd') . '_' . md5($image . microtime()) . '.' . $image->extension;
            
            $model->news_thumbnail = $filename;
            
            if($model->save()){
                $this->upload($image, $filename);
            } else {
                throw new \yii\db\Exception;
            }
            
            return $this->redirect(['view', 'id' => $model->news_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            $model->attributes = $_POST['News'];
            
            $image = UploadedFile::getInstance($model, 'news_thumbnail');
            
            // replace image if user choose new images
            if($image != NULL){
                $model = $this->findModel($id);
                $filename = $model->news_thumbnail;
                
                $this->deleteFile($filename);
                
                $newFilename = date('Ymd') . '_' . md5($image . microtime()) . '.' . $image->extension;
                
                $this->upload($image, $newFilename);
                
                $model->news_thumbnail = $newFilename;
                
                if(!$model->save()) 
                    :throw new Exception;
                endif;
                
            } else {
                
                $keepImages = $this->findModel($id);
                
                $model->news_thumbnail = $keepImages->news_thumbnail;
                
                if(!$model->save()) 
                    :throw new Exception;
                endif;
            }
            
            return $this->redirect(['view', 'id' => $model->news_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (isset($_POST)) {
            try {
                $model = $this->findModel($id);
                $filename = $model->news_thumbnail;
                
                if($model->delete()){
                    $this->deleteFile($filename);
                }
                
                $thumbnail = News::find()->all();
                
                $html = '';
                $no = 1;
                foreach ($thumbnail as $row){
                    $html .= '<tr>'
                            . '<td>'.$no.'</td>'
                            . '<td>'.$row->news_caption.'</td>'
                            . '<td>'.$row->news_status.'</td>'
                            . '<td>'.$row->news_featured.'</td>'
                            . '<td>'.$row->news_publish_date.'</td>'
                            . '<td>'
                            . '<div class="btn-group">
                               <button onclick="viewRecord('.$row->news_id.', news)" type="button" class="btn btn-default">
                               <i class="fa fa-search"></i></button></div>'
                            . '<div class="btn-group">
                               <button onclick="updateRecord('.$row->news_id.', news)" type="button" class="btn btn-default">
                               <i class="fa fa-edit"></i></button></div>'
                            . '<div class="btn-group">
                               <button type="button" class="btn btn-default" onclick="deleteRecord('.$row->news_id.', news);">
                               <i class="fa fa-trash"></i></button></div>'
                            . '</td>'
                            . '</tr>';
                    $no++;
                }
                
                return json_encode(array( "data" => $html ));
            } catch (Exception $ex) {
                echo $ex;
                die();
            }
        }
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    private function upload($image, $filename){
        $image->saveAs('uploads/images/news/' . $filename);
    }
    
    private function deleteFile($filename){
        unlink(getcwd() . \Yii::$app->params['newsAsset'] . $filename);
    }
}
