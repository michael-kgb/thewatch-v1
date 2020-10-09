<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use common\models\User;
use backend\models\Departements;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }

    public function actionIndex()
    {
		
		if(!Yii::$app->session->get('userInfo')){
			// return $this->redirect(Yii::$app->params['backendLoginUrl']);
			return $this->redirect(Yii::$app->request->baseUrl);
		}
		
        return $this->render('login');
    }

    public function actionLogin()
    {

        $model = new LoginForm();
            
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // die(var_dump(Yii::$app->request->post()));
        
            $user = User::findByUsername($_POST['LoginForm']['username']);
            $departement = Departements::findOne($user->departements_departement_id);
            $session = Yii::$app->session;
            $session['userInfo'] = array(
				'user_id' => $user->id,
                'fullname' => $user->fullname,
                'departement' => $departement->departement_name,
                'group_id' => $user->group_id,
                'type' => $_POST['LoginForm']['type'],
				'store_id' => $user->store_id,
				'logged_in' => TRUE
            );
			
			if($departement->departement_name == "Store Staff" && $user->group_id == 5){
				return $this->redirect(Yii::$app->urlManager->getBaseUrl() . "/orders/index");
			}
			elseif($departement->departement_name == "Store Staff" && $user->group_id == 4){
				return $this->redirect(Yii::$app->urlManager->getBaseUrl() . "/dashboard/index");
			}			
			return $this->redirect(Yii::$app->urlManager->getBaseUrl() . "/dashboard/index");
			
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return Yii::$app->homeUrl;
        // return $this->goHome();
    }
    
}
