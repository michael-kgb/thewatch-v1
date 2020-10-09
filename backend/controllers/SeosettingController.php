<?php

namespace backend\controllers;

use Yii;
use backend\models\Homebanner;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * HomebannerController implements the CRUD actions for Homebanner model.
 */
class SeosettingController extends Controller
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

    /**
     * Lists all Homebanner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $data = \backend\models\SeoPagesContent::find()->all();

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
        $model = new \backend\models\SeoPagesContent();
        
        if ($_POST) {
            
            //$model->attributes = $_POST['Seosetting'];
			$model->attributes = $_POST['Seosetting'];						
			$model->seo_pages_id = $_POST['Seosetting']['seo_pages_id'];            
			$model->seo_pages_meta_description = $_POST['Seosetting']['seo_pages_meta_description'];            
			$model->seo_pages_meta_keywords = $_POST['Seosetting']['seo_pages_meta_keywords'];            
			$model->seo_pages_meta_title = $_POST['Seosetting']['seo_pages_meta_title'];
			$model->seo_footer_description_left = $_POST['Seosetting']['seo_footer_description_left'];
			$model->seo_footer_description_right = $_POST['Seosetting']['seo_footer_description_right'];
            $model->save();
			
            if($model->save()){
				
				if($_POST['Seosetting']['seo_pages_id'] == 2){
					
					$brand = new \backend\models\SeoPagesContentBrands();
					
					$brand->brand_id = $_POST['SeoPagesContentBrands']['brand_id'];
					$brand->seo_pages_content_id = $model->seo_pages_content_id;
					$brand->save();
				}
				
            }
            
            return $this->redirect(['view', 'id' => $model->seo_pages_content_id]);
            
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

        if ($_POST) {
            $model->attributes = $_POST['Seosetting'];						
			$model->seo_pages_id = $_POST['Seosetting']['seo_pages_id'];            
			$model->seo_pages_meta_description = $_POST['Seosetting']['seo_pages_meta_description'];            
			$model->seo_pages_meta_keywords = $_POST['Seosetting']['seo_pages_meta_keywords'];            
			$model->seo_pages_meta_title = $_POST['Seosetting']['seo_pages_meta_title'];
			$model->seo_footer_description_left = $_POST['Seosetting']['seo_footer_description_left'];
			$model->seo_footer_description_right = $_POST['Seosetting']['seo_footer_description_right'];
            $model->save();
			
			if($_POST['Seosetting']['seo_pages_id'] == 2){
					
				$brand = \backend\models\SeoPagesContentBrands::findOne(['seo_pages_content_id' => $model->seo_pages_content_id]);
				
				$brand->brand_id = $_POST['SeoPagesContentBrands']['brand_id'];
				$brand->seo_pages_content_id = $model->seo_pages_content_id;
				$brand->save();
			}
			
            return $this->redirect(['view', 'id' => $model->seo_pages_content_id]);
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
                
                $homebanner = Homebanner::find()->all();
                
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
        if (($model = \backend\models\SeoPagesContent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
