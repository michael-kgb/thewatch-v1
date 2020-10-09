<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class ShippingController extends Controller
{
    public $layout = "main";
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

    public function beforeAction($action)
    {            
       
            $this->enableCsrfValidation = false;
        
        return parent::beforeAction($action);
    }


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {		
        return $this->render('index');
    }
	
    public function actionGenerateState(){
        $states = \backend\models\State::findAll(['active' => 1, "country_id" => 111, "zone_id" => 3, "province_id" => $_POST['province_id']]);
        return $this->renderFile('@app/views/shipping/states.php', array("states" => $states));
    }
    
    public function actionGenerateStateProfile(){
        $states = \backend\models\State::findAll(['active' => 1, "country_id" => 111, "zone_id" => 3, "province_id" => $_POST['province_id']]);
        return $this->renderFile('@app/views/user/shipping/states.php', array("states" => $states));
    }
    
    public function actionGenerateDistrict(){
        $district = \backend\models\District::findAll(['active' => 1, "country_id" => 111, "zone_id" => 3, "state_id" => $_POST['state_id']]);
        return $this->renderFile('@app/views/shipping/district.php', array("districts" => $district));
    }
    
    public function actionGenerateDistrictProfile(){
        $district = \backend\models\District::findAll(['active' => 1, "country_id" => 111, "zone_id" => 3, "state_id" => $_POST['state_id']]);
        return $this->renderFile('@app/views/user/shipping/district.php', array("districts" => $district));
    }
    
    public function actionGenerateShippingMethod(){
        
        if(isset($_POST['customer_address_id'])){
            $district = \backend\models\CustomerAddress::findOne(['customer_address_id' => $_POST['customer_address_id']]);
            $carrier = \backend\models\CarrierCost::findAll(['active' => 1, "district_id" => $district->district_id]);
            return $this->renderFile('@app/views/shipping/shipping-method.php', array("carriers" => $carrier, 'customerAddressId' => $_POST['customer_address_id']));
        } elseif (isset($_POST['district_id'])) {
            $carrier = \backend\models\CarrierCost::findAll(['active' => 1, "district_id" => $_POST['district_id']]);
            return $this->renderFile('@app/views/shipping/shipping-method.php', array("carriers" => $carrier));
        }
        
    }
    public function actionGenerateAddress(){
        
        if(isset($_POST['id'])){
            $customer_address = \backend\models\CustomerAddress::findOne(['customer_address_id' => $_POST['id']]);
            
            // $customer_all = \backend\models\CustomerAddress::find()->where(['customer_id' => $customer_address->customer_id])->all();
           
                $connection = Yii::$app->db;
                $connection->createCommand()->update('customer_address', ['set_as_default' => 0], 'customer_id='.$customer_address->customer_id)->execute();
            
            $connection = Yii::$app->db;
                $connection->createCommand()->update('customer_address', ['set_as_default' => 1], 'customer_address_id='.$_POST['id'])->execute();
            

            $carrier = \backend\models\CarrierCost::findAll(['active' => 1, "district_id" => $customer_address->district_id]);
            $data[0] = $this->renderFile('@app/views/shipping/address-selected.php', array("customer_address" => $customer_address));
            $data[1] = $this->renderFile('@app/views/shipping/shipping-method.php', array("carriers" => $carrier, 'customerAddressId' => $_POST['id']));
            $data[2] = $_POST['id'];
            return json_encode($data);
        } 
        
    }
}
