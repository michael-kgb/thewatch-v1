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
use frontend\models\CollabUsers;
use frontend\models\CollabDraws;
use frontend\models\CollabEvents;
use common\models\User;
use yii\web\Session;

class CollaborateUserController extends FrontendController
{

    /**
     * function save Drawings
     */
    private function setDrawings($data)
    {
        $baseUrl = Yii::$app->params['frontendUrl'];
        $result = array();
        $voucherCode = "";
		
		$event_alias = $data['event'];
		$userkey = $data['userkey'];
		$account = $data['account'];
		$code = $data['code'];
		$status = $data['status'];
		$regdate = $data['regdate'];

        // $exist_code = CollabDraws::findOne(array('event_alias' => $event_alias, 'user_key' => $userkey, 'draw_code' => $code)); // check if voucher code already exists

        // if ( $exist_code == NULL ) {
            $collab_draws = new CollabDraws();
            $collab_draws->event_alias = $event_alias;
            $collab_draws->user_key = $userkey;
            $collab_draws->account_username = $account;
            $collab_draws->draw_code = $code;
            $collab_draws->created_at = $regdate;
            $collab_draws->save();
			
            $message = 'Data draws saved successfully';
            $result = array('status'=>TRUE, 'message'=>$message);
        // } else {
            // $message = "Data draws already exists";
            // $result = array('status'=>FALSE, 'message'=>$message);
		// }
		return $result;
    }
	
	/**
     * action SignUp
     */
    public function actionSignUp()
    {
        session_start();
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params = Yii::$app->request->post();
        $state = FALSE;
        $message = "";
		$arr_data = array();
        $response = array();
        $verificator = $session['verificator'];
		
		// $userkey = Helpers::generateDynCode(filter_var($params['name'], FILTER_SANITIZE_STRING));
		
		$fevent = filter_var($params['event'], FILTER_SANITIZE_STRING);
		$fname = filter_var($params['name'], FILTER_SANITIZE_STRING);
		$fkey = filter_var($params['key'], FILTER_SANITIZE_STRING);
		$femail = filter_var($params['email'], FILTER_SANITIZE_EMAIL);
		$fphone = filter_var($params['phone'], FILTER_SANITIZE_STRING);
		$fregdate = filter_var($params['regdate'], FILTER_SANITIZE_STRING);
		
		$quota = CollabEvents::getEventQuota($fevent);
		$reg_total = CollabDraws::getEventTotal($fevent);
		
		if ( $reg_total >= $quota ) {
			$message .= "Registration quota has exceeded the limit.";
		} else {
			$exist_key = CollabUsers::findOne(array('user_key' => $fkey));
			$exist_email = CollabUsers::findOne(array('user_email' => $femail));
			$has_event_account = CollabDraws::findOne(array('event_alias' => $fevent, 'user_key' => $fkey));
			
			// if ( !$has_event_account ) { // set Lottery code data for member
				/*
				$gen_code = Helpers::generateLotCode();
				// $gen_code = 'IHFNJ0';
				$exist_code = CollabDraws::findOne(array('event_alias' => $fevent, 'user_key' => $fkey, 'draw_code' => $gen_code)); // check if voucher code already exists
				
				if ( $exist_code ) {
					$gen_code = Helpers::generateLotCode();
				} else {
					$gen_code = Helpers::generateLotCode();
				}

				$arr_data = array(
					'event' => $fevent,
					'userkey' => $fkey,
					'account' => $verificator['username'],
					// 'account' => 'wisnusi',
					'code' => $gen_code,
					'status' => 0,
				);
				
				$this->setDrawings($arr_data); // save drawings / lottery
				$state = TRUE;
				$message .= "Data created successfully.";
				*/
			// } else {
				if ( $exist_key ) {
					$message .= "This user is already exist";
				} elseif ( $exist_email ) {
					$message .= "This email is already exist, please use another email";
				} else {
					$collab_users = new CollabUsers(); // call model
					$collab_users->user_fullname = $fname;
					$collab_users->user_key = $fkey;
					$collab_users->user_email = $femail;
					$collab_users->user_phone = $fphone;
					$collab_users->reg_date = $fregdate;
					$collab_users->created_at = $fregdate;
					
					try {
						$collab_users->save(); // save data
						if ( $collab_users->save() ) {

							$gen_code = Helpers::generateLotCode();
							// $gen_code = 'IHFNJ0';
							$exist_code = CollabDraws::findOne(array('event_alias' => $fevent, 'user_key' => $fkey, 'draw_code' => $gen_code)); // check if voucher code already exists
							
							if ( $exist_code ) {
								$gen_code = Helpers::generateLotCode();
							} else {
								$gen_code = Helpers::generateLotCode();
							}
				
							$arr_data = array(
								'event' => $fevent,
								'userkey' => $fkey,
								// 'account' => $verificator['username'],
								'account' => '_blank', // let it blank on sign up
								'code' => $gen_code,
								'status' => 0,
								'regdate' => $fregdate,
							);
							
							$this->setDrawings($arr_data); // save drawings / lottery
							
							$collab_events = CollabEvents::findOne(array('event_alias' => $fevent));
							
							Helpers::sendEmailMandrillUrlAPI( // Send email to user email using Mandrill
									$this->renderFile('@app/views/template/mail/collaborate_event_signup.php', array(
										"fullname" => $fname,
										"email" => $femail,
										"phone" => $fphone,
										"code" => $gen_code
									)), 'THE WATCH CO. : '. strtoupper($collab_events->event_name) .' Email Confirmation', \Yii::$app->params['adminEmail'], $femail, ''
							);
						}
					} catch (Exception $ex) {
						$message .= "There is an error while sending email.";
					}
					
					$state = TRUE;
					$message .= "Data created successfully.";
				}
			// }
			
		}

        $response = array(
            "status" => $state,
            "message" => $message,
        );
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
    }
	
	public function actionTestCode()
	{
		$gen_code = Helpers::generateLotCode();

        $response = array(
            "code" => $gen_code,
        );
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
	}
}