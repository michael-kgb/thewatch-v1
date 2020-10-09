<?php

namespace app\modules\api\controllers;

use Yii;
use frontend\core\controller\FrontendController;
// use yii\rest\ActiveController;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Request;
use common\components\Helpers;
use yii\helpers\Url;
use frontend\models\CollabAccounts;
use frontend\models\CollabUsers;
use frontend\models\CollabEvents;
use frontend\models\CollabDraws;
use common\models\User;
use yii\web\Session;

class CollaborateVerificatorController extends FrontendController
{
    /**
     * action for sign in
     */
    public function actionSignIn()
    {
        session_start();
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params = Yii::$app->request->post();
        $state = FALSE;
        $message = "";
        $response = array();
		
		$username = filter_var($params['username'], FILTER_SANITIZE_STRING);
		$password = filter_var($params['password'], FILTER_SANITIZE_STRING);
		$accounts = CollabAccounts::findByUsername($username);
		if ( $accounts !== NULL ) {
			$hash = Yii::$app->getSecurity()->generatePasswordHash($password);
			if (Yii::$app->getSecurity()->validatePassword($password, $hash)) {
				// all good, logging user in
				$state = TRUE;
				$message .= "Login success.";
				
				$_SESSION['verificator']['fullname'] = $accounts->account_fullname;
				$_SESSION['verificator']['email'] = $accounts->account_email;
				$_SESSION['verificator']['username'] = $accounts->account_username;
				$accounts->last_login = date('Y-m-d H:i:s');
				$accounts->save();
			} else {
				// wrong password
				$message .= "Login failed.";
			}
		} else {
			// wrong password
			$message .= "Login failed.";
		}

        $response = array(
            "status" => $state,
            "message" => $message,
        );
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
	}

    public function actionDigiSession()
    {
        session_start();
        $session = Yii::$app->session;
        $verificator = $session['verificator'];
		
        if (!isset($verificator)){
            $response = array("message" => "You haven't Sign In yet.");
        }else{
            $response = array(
                "verificator" => $verificator,
            );
        }
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
        exit();
    }
	
	/**
     * action for list registrants
     */
	public function actionGetRegistrants()
    {
        session_start();
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params = Yii::$app->request->get();
        $state = FALSE;
        $message = "";
        $results = array();
        $response = array();
        $verificator = $session['verificator'];
		
		$event_a = filter_var($params['events'], FILTER_SANITIZE_STRING);
        if (!isset($verificator)){
			$message .= "You haven't Sign In yet.";
        }else{	
			$current_date = date('Y-m-d H:i:s');
			if ( empty($event_a) ) {
				$message .= "There is no event yet.";
			} else {
				$event_names = array();
				if( strpos($event_a, ',') !== false ) {
					$event_names = explode(',', $event_a);
				} else {
					$event_names = array($event_a);
				}
				
				$events = CollabEvents::getRunningEvents($event_names); //get Running Events by Alias
				
				if (!empty($events)) {
					$state = TRUE;
					$message .= "Data retrieved";
					
					$draws = CollabDraws::getRunningEvents($event_names); //get Running Events by Alias
					// die(var_dump($draws));
					$arr_draws = array();
					foreach($draws as $draw){
						$arr_draws['events']['alias'] = $draw->collabEvents->event_alias;
						$arr_draws['events']['name'] = $draw->collabEvents->event_name;
						$arr_draws['events']['reg_email'] = $draw->collabUsers->user_email;
						$arr_draws['events']['reg_name'] = $draw->collabUsers->user_fullname;
						$arr_draws['events']['reg_phone'] = $draw->collabUsers->user_phone;
						$arr_draws['events']['code'] = $draw->draw_code;
						$arr_draws['events']['status'] = $draw->draw_status;
						array_push($results, $arr_draws);
					}

				} else {
					$message .= "There is no event yet.";
				}				
			}
		}

        $response = array(
            "status" => $state,
            "message" => $message,
            "results" => $results,
        );
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
        exit();
	}
	
	/**
     * action Verify
     */
	public function actionVerifyCode()
    {
        session_start();
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params = Yii::$app->request->get();
        $state = FALSE;
        $message = "";
		$arr_data = array();
        $response = array();
        $verificator = $session['verificator'];
		
        if (!isset($verificator)){
			$message .= "You haven't Sign In yet.";
        }else{
			$collab_draws = CollabDraws::findByUnusedCode($params['code']); // check if voucher code exists
			
			if ( $collab_draws ) {
				$collab_events = CollabEvents::findOne(array('event_alias' => $collab_draws->event_alias));
				$collab_user = CollabUsers::findOne(array('user_key' => $collab_draws->user_key));
				$event_start_date = explode(' ', $collab_events->event_start_date); // convert start date
				$timestamp1 = strtotime($event_start_date[0]);
				$start_date = date('d F Y', $timestamp1 );
				$event_end_date = explode(' ', $collab_events->event_end_date); // convert end date
				$timestamp2 = strtotime($event_end_date[0]);
				$end_date = date('d F Y', $timestamp2 );
				
				$collab_draws->account_username = $verificator['username'];
				$collab_draws->draw_status = 1;
				$collab_draws->updated_at = date('Y-m-d H:i:s');
				
				try {
					$collab_draws->save();
							
					Helpers::sendEmailMandrillUrlAPI( // Send email to user email using Mandrill
							$this->renderFile('@app/views/template/mail/collaborate_event_verified.php', array(
								"event_name" => $collab_events->event_name,
								"event_date" => $start_date.' - '.$end_date
							)), 'THE WATCH CO. : OTP Code Verification', \Yii::$app->params['adminEmail'], $collab_user->user_email, ''
					);
				} catch (Exception $ex) {
					$message .= "There is an error while sending email.";
				}
				
				$state = TRUE;
				$message .= "This code is verified.";
			} else {
				$message .= "This code is already used.";
			}
		}

        $response = array(
            "status" => $state,
            "message" => $message,
        );
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
        exit();
	}
	
	/**
     * action User Detail
     */
    public function actionUserDetail()
    {
        session_start();
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params = Yii::$app->request->get();
        $state = FALSE;
        $message = "";
		$arr_data = array();
        $response = array();
        $verificator = $session['verificator'];
		
        if (!isset($verificator)){
			$message .= "You haven't Sign In yet.";
        }else{
			$code = filter_var($params['code'], FILTER_SANITIZE_STRING);
			
			$collab_draws = CollabDraws::findOne(array('draw_code' => $code));
			if ( $collab_draws ) {
				$collab_user = CollabUsers::findOne(array('user_key' => $collab_draws->user_key));
				$arr_data = array(
					'ac_fullname' => $collab_user->user_fullname,
					'ac_email' => $collab_user->user_email,
					'ac_phone' => $collab_user->user_phone,
					'ac_regdate' => date('d-m-Y H:i:s', strtotime($collab_user->reg_date)),
				);
				
				$state = TRUE;
				$message .= "Success retrieve data.";
			}
			
		}

        $response = array(
            "status" => $state,
            "message" => $message,
            "results" => $arr_data,
        );
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
	}
}