<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Session;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $layout = "main";
    
    public $enableCsrfValidation = false;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
	
	public function beforeAction($action)
	{
        $this->enableCsrfValidation = TRUE;
        $current_date = date('Y-m-d H:i:s');
        if ( $current_date >= '2019-07-05 00:00:00' && $current_date <= '2019-07-06 00:00:00' ) {
            session_start();
            //remove PHPSESSID from browser
            if ( isset( $_COOKIE[session_name()] ))
            setcookie(session_name(), "", time() - 3600, "/");
            //clear session from globals
            //$_SESSION = array();
            //clear session from disk
            //session_destroy();
        } 

		$check_stock = $this->checkStock();
		if (!parent::beforeAction($action)) {
			return false;
		}
		return true;
	}
	
	public function checkStock() {
        $data = array();
        $sessionOrder = new Session();
        $sessionOrder->open();

        $cart = $sessionOrder->get("cart");
        $items = isset($cart['items']) ? $cart['items'] : array();
		// check product quantity if equal zero
		// no longer can be order if product has reach zero quantity
		if (count($items) > 0) {
			$i = 0;
			foreach ($items as $item) {
                $product_active = (int)\backend\models\Product::findOne(["product_id" => $item['id']])->active;
                if ( $product_active === 0 ) { 
                    // $_SESSION['cart']['items'][$i]['item_inactive'] = 1;
                    // $_SESSION['cart']['items'][$i]['cart_msg'] = 'This item is Inactive';
                    // unset($_SESSION['cart']['items'][$i]); 
                    // $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);   
                    // array_splice($items, $i);
                    unset($items[$i]);
                } else {
                    $stock = (int)\backend\models\ProductStock::findOne(["product_id" => $item['id'], "product_attribute_id" => $item['product_attribute_id']])->quantity;
                    
                    if($stock === 0){
                        // $_SESSION['cart']['items'][$i]['out_of_stock'] = 1;
                        // $_SESSION['cart']['items'][$i]['cart_msg'] = 'This item is Out of Stock';
                        // array_splice($_SESSION['cart']['items'], $i);
                        // $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);
                        unset($items[$i]);
                    }
                }
				$i++;
            }
            $_SESSION['cart']['items'] = array();
            $_SESSION['cart']['items'] = array_values($items);
		}
		return true;
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
		$seoPagesContent = \backend\models\SeoPagesContent::findOne(['seo_pages_id' => 1]);
       
        $homebanner = \backend\models\Homebanner::find()->where(['homebanner_sequence'=>1])->one();
		
		/** HTML Meta Tags **/
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $seoPagesContent->seo_pages_meta_description]);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $seoPagesContent->seo_pages_meta_keywords]);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => $seoPagesContent->seo_pages_meta_title]);
		
		/** Google / Search Engine Tags **/
		\Yii::$app->view->registerMetaTag(['itemprop' => 'name', 'content' => $seoPagesContent->seo_pages_meta_title]);
		\Yii::$app->view->registerMetaTag(['itemprop' => 'description', 'content' => $seoPagesContent->seo_pages_meta_description]);
		\Yii::$app->view->registerMetaTag(['itemprop' => 'image', 'content' => 'https://www.thewatch.co/img/homebanner/'.$homebanner->homebanner_images_mobile.'jpg']);
		
		/** Facebook Meta Tags **/
		\Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/' ]);
		\Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'website' ]);
		\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => $seoPagesContent->seo_pages_meta_title ]);
		\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => $seoPagesContent->seo_pages_meta_description ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/homebanner/'.$homebanner->homebanner_images_mobile.'jpg' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image:width', 'content' => '300' ]);
		\Yii::$app->view->registerMetaTag(['property' => 'og:image:height', 'content' => '300' ]);
		
		/** Twitter Meta Tags **/
		\Yii::$app->view->registerMetaTag(['twitter' => 'card', 'content' => 'https://www.thewatch.co/img/homebanner/'.$homebanner->homebanner_images_mobile.'jpg']);
		\Yii::$app->view->registerMetaTag(['twitter' => 'title', 'content' => $seoPagesContent->seo_pages_meta_title]);
		\Yii::$app->view->registerMetaTag(['twitter' => 'description', 'content' => $seoPagesContent->seo_pages_meta_description]);
        \Yii::$app->view->registerMetaTag(['twitter' => 'image', 'content' => 'https://www.thewatch.co/img/homebanner/'.$homebanner->homebanner_images_mobile.'jpg' ]);		
        
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
