<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\SignupForm;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public $layout = "userLayout";
	
	public function beforeAction($action)
	{            
		//if ($action->id == 'my-method') {
			$this->enableCsrfValidation = false;
		//}

		return parent::beforeAction($action);
	}
    
    public function behaviors()
    {
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();
        
        //if($permissions['view_access'] != '1'){
            //return $this->redirect('../permissionscheck');
        //}
        
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
	
	public function actionAccount(){
		
		$departement = Yii::$app->session->get('userInfo')['departement'];
		
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		
		if(Yii::$app->request->post()){
			$model = $this->findModel($_POST['user_id']);
			
			if($model != NULL){
				$model->fullname = $_POST['fullname'];
				$model->email = $_POST['email'];
				$model->save();
			}
		}
		
		if($departement == "Store Staff" || $departement == "Customer Service & After Sales"){
			$this->layout = "storeadmin/dashboard_storeadmin";
			
			return $this->render('account');
		}
	}
	
	public function actionProfile($username){
        
        $profile = \backend\models\User::findOne(['username' => $username]);
        
        return $this->render('profile', array('profile' => $profile));
    }
	
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $data = User::find()->all();

        return $this->render('index', [
            'data' => $data
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SignupForm();
         
        if ($model->load(Yii::$app->request->post())) {
            
//            $file_name = 'coba';
//            $file_tmp =$_FILES['image']['tmp_name'];
//            
//            move_uploaded_file($file_tmp,"uploads/images/user/".$file_name);
//            
            if ($model->signup()) {
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
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
     * Reset password an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionReset($id)
    {
        $model = new SignupForm();
//            
            if ($model->reset($id)) {
                return $this->redirect(['index']);
            }
         else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
