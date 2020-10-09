<?php

namespace backend\controllers;

use Yii;
use backend\models\HomebannerJewelry;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * HomebannerController implements the CRUD actions for Homebanner model.
 */
class HomebannerjewelryController extends Controller
{
    public $layout = "dashboard";
    
    public function behaviors()
    {
        if(!Yii::$app->session->get('userInfo')){
            return $this->redirect(Yii::$app->urlManagerBackEnd->baseUrl . '/site/login');
        }
        
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        if ($permissions['view_access'] != '1') {
            return $this->redirect(Yii::$app->urlManagerBackEnd->baseUrl . '/permissionscheck');
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
    
    public function actionReorderingHomebanner(){
        $items = $_POST['item'];
        foreach ($items as $key => $value) {
            $key += 1;
            $homebanner = \backend\models\HomebannerJewelry::findOne(['homebanner_id' => $value]);
            $homebanner->homebanner_sequence = $key;
            $homebanner->save();
        }
    }
    
    public function actionSequence(){
        $data = HomebannerJewelry::find()->orderBy('homebanner_sequence ASC')->where(['homebanner_status' => 'active'])->all();
        
        return $this->render('sequence', array(
            'data' => $data
        ));
    }

    /**
     * Lists all Homebanner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $data = HomebannerJewelry::find()->orderBy('homebanner_sequence ASC')->all();

        return $this->render('index', [
            'data' => $data,
        ]);
    }

    /**
     * Displays a single Homebanner model.
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
     * Creates a new Homebanner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HomebannerJewelry();
        
        if ($model->load(Yii::$app->request->post())) {
            
            $model->attributes = $_POST['Homebanner'];
            
            $image = UploadedFile::getInstance($model, 'homebanner_images');
            $image_mobile = UploadedFile::getInstance($model, 'homebanner_images_mobile');
            
            $filename = date('Ymd') . '_' . md5($image . microtime()) . '.' . $image->extension;
            $filename_mobile = date('Ymd') . '_' . md5($image . microtime()) . 'm.' . $image_mobile->extension;
            $homebannerSequence = HomebannerJewelry::find()->orderBy('homebanner_sequence DESC')->one();
            if($homebannerSequence != NULL){
                $lastSequence = $homebannerSequence->homebanner_sequence;
            }
            
            $lastSequence += 1;
            
            $model->homebanner_sequence = $lastSequence;
            $model->homebanner_images = $filename;
            $model->homebanner_images_mobile = $filename_mobile;
            
            if($model->save()){
                $this->upload($image, $filename);
                $this->upload($image_mobile, $filename_mobile);
            }
            
            return $this->redirect(['view', 'id' => $model->homebanner_id]);
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Homebanner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            $model->attributes = $_POST['Homebanner'];
            
            $image = UploadedFile::getInstance($model, 'homebanner_images');
            $image_mobile = UploadedFile::getInstance($model, 'homebanner_images_mobile');
            
            // $model = $this->findModel($id);
            // replace image if user choose new images
            if($image != NULL){
                
                $filename = $model->homebanner_images;
                
                $this->deleteFile($filename);
                
                $newFilename = date('Ymd') . '_' . md5($image . microtime()) . '.' . $image->extension;
                
                $this->upload($image, $newFilename);
                
                $model->homebanner_images = $newFilename;
                
                // $model->save();
            } if($image == NULL) {
                
                $keepImages = $this->findModel($id);
                
                $model->homebanner_images = $keepImages->homebanner_images;
                
                // $model->save();
            }
            
            if($image_mobile != NULL){
            
                $filename = $model->homebanner_images_mobile;
                
                $this->deleteFile($filename);
                
                $newFilename = date('Ymd') . '_' . md5($image_mobile . microtime()) . 'm.' . $image_mobile->extension;
                
                $this->upload($image_mobile, $newFilename);
                
                $model->homebanner_images_mobile = $newFilename;
                
                // $model->save();
            } if($image_mobile == NULL) {
                
                $keepImages = $this->findModel($id);
                
                $model->homebanner_images_mobile = $keepImages->homebanner_images_mobile;
                
                // $model->save();
            }
            // echo $model->homebanner_status;die();
            $model->save();

            return $this->redirect(['view', 'id' => $model->homebanner_id]);
            
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Homebanner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (isset($_POST)) {
            try {
                $model = $this->findModel($id);
                $filename = $model->homebanner_images;
                
                if($model->delete()){
                    $this->deleteFile($filename);
                }
                
                $homebanner = HomebannerJewelry::find()->all();
                
                $html = '';
                $no = 1;
                foreach ($homebanner as $row){
                    $html .= '<tr>'
                            . '<td>'.$no.'</td>'
                            . '<td>'.$row->homebanner_name.'</td>'
                            . '<td>'.$row->homebanner_description.'</td>'
                            . '<td>'.$row->homebanner_status.'</td>'
                            . '<td>'
                            . '<div class="btn-group">
                               <button onclick="viewRecord('.$row->homebanner_id.', homebanner)" type="button" class="btn btn-default">
                               <i class="fa fa-search"></i></button></div>'
                            . '<div class="btn-group">
                               <button onclick="updateRecord('.$row->homebanner_id.', homebanner)" type="button" class="btn btn-default">
                               <i class="fa fa-edit"></i></button></div>'
                            . '<div class="btn-group">
                               <button type="button" class="btn btn-default" onclick="deleteRecordss('.$row->homebanner_id.', homebanner);">
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
     * Finds the Homebanner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Homebanner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HomebannerJewelry::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    private function upload($image, $filename){
        $image->saveAs('../../frontend/web/img/homebanner/' . $filename);
    }
    
    private function deleteFile($filename){
        unlink('../../frontend/web/img/homebanner/' . $id . '/' . $filename);
    }
}
