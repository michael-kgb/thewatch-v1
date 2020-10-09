<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Description of DashboardController
 *
 * @author user
 */
class DashboardController extends Controller {

    public $layout = "dashboard";

    /**
     * @inheritdoc
     */
    public function behaviors() {
        if(!Yii::$app->session->get('userInfo')){
			return $this->redirect(Yii::$app->request->baseUrl);
        }
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {
        $type = Yii::$app->session->get('userInfo')['type'];
		$departement = Yii::$app->session->get('userInfo')['departement'];
		
		if($departement == "Store Staff"){
			$this->layout = "storeadmin/dashboard_storeadmin";
			
			return $this->render('index_storeorder');
		}
		
		if($departement == "Customer Service & After Sales"){
			$this->layout = "storeadmin/dashboard_storeadmin";
			
			return $this->render('index_aftersales');
		}
		
        //$newUsers = \common\components\GoogleAnalytics::getNewUsers($type);
        //$pageviews = \common\components\GoogleAnalytics::getPageviews($type);
        //$bounceRate = number_format(\common\components\GoogleAnalytics::getBounceRate($type), 2, ',', ' ');
        //$myResults = \common\components\GoogleAnalytics::getSessionIsoCode(date("Y-m-d"), date("Y-m-d"));
		$newUsers = '';
		$pageviews = '';
		$bounceRate = '';
		$myResults = array();
        $country = "";
        
		if (count($myResults) > 0) {
			foreach ($myResults as $result) {
				$country = $country . '"' . $result->getCountryIsoCode() . '": ' . $result->getSessions() . ',';
			}
		}
        
        return $this->render('index', ['new_users' => $newUsers, 'page_views' => $pageviews, 'bounce_rate' => $bounceRate, 'visitorsData' => $country]);
    }

    public function actionSignout() {
        Yii::$app->user->logout();
        return $this->redirect(Yii::$app->request->baseUrl);
    }
    
    public function actionGetstart(){
        $startdate = $_POST['startdate'];
        $enddate   = $_POST['enddate'];
        
        $myResults = \common\components\GoogleAnalytics::getSessionIsoCode($startdate, $enddate);
        $i = 0;
        
        foreach ($myResults as $result) {
            $country[$i][0] = $result->getCountryIsoCode();
            $country[$i][1] = $result->getSessions();
            $i++;
        }
        
        echo json_encode($country);
    }

}
