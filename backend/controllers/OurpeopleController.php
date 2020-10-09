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
class OurpeopleController extends Controller
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
        $data = \backend\models\OurPeople::find()->all();

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
        
        if ($model->load(Yii::$app->request->post())) {
            
            $model->attributes = $_POST['Seosetting'];
            
            if($model->save()){
                $this->upload($image, $filename);
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

        if ($_POST) {
			
			$image = UploadedFile::getInstance($model, 'our_people_profile_picture');
            
            $model->attributes = $_POST['OurPeople'];
            
            $model->our_people_name = $_POST['OurPeople']['our_people_name'];
            $model->our_people_short_description = $_POST['OurPeople']['our_people_short_description'];
            $model->our_people_profile_picture = $_POST['OurPeople']['our_people_profile_picture'];
            
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->our_people_id]);
            
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    private function deleteFile($filename) {
        unlink('../../frontend/web/img/ourpeople/' . $filename);
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
                $filename = $model->our_people_profile_picture;
                
                if($model->delete()){
                    $this->deleteFile($filename);
                }
                
                $ourPeople = \backend\models\OurPeople::find()->all();
                
                $html = '';
                $no = 1;
                foreach ($ourPeople as $row){
                    $products = '';
                    $productList = \backend\models\OurPeopleProduct::findAll(['our_people_id' => $row->our_people_id]);
                    if(count($productList) > 0){
                        $i = 1;
                        foreach($productList as $product){
                            if($i != 1){
                                $products .= ' , ';
                            }
                            $products .= $product->product->productDetail->name;
                            $i++;
                        }
                    }
                    $html .= '<tr>'
                            . '<td>'.$no.'</td>'
                            . '<td><img width="200" src="/frontend/web/img/ourpeople/'.$row->our_people_profile_picture.'"></td>'
                            . '<td>'.$row->our_people_name.'</td>'
                            . '<td>'.$products.'</td>'
                            . '<td>'
                            . '<div class="btn-group">
                               <button onclick="viewRecord('.$row->our_people_id.', homebanner)" type="button" class="btn btn-default">
                               <i class="fa fa-search"></i></button></div>'
                            . '<div class="btn-group">
                               <button onclick="updateRecord('.$row->our_people_id.', homebanner)" type="button" class="btn btn-default">
                               <i class="fa fa-edit"></i></button></div>'
                            . '<div class="btn-group">
                               <button type="button" class="btn btn-default" onclick="deleteRecordss('.$row->our_people_id.', homebanner);">
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
        if (($model = \backend\models\OurPeople::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
