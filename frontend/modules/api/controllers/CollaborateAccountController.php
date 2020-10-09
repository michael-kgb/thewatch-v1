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
use common\models\User;
use yii\web\Session;

class CollaborateAccountController extends FrontendController
{
	/**
     * action Create
     */
    public function actionCreate()
    {
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params = Yii::$app->request->post();
        $state = FALSE;
        $message = "";
        $response = array();
		
		$exist_email = CollabAccounts::findOne(array('account_email' => $params['email']));
		$exist_username = CollabAccounts::findOne(array('account_username' => $params['username']));
		
		if ( $exist_email ) {
			$message .= "This email is already exist, please use another email";
		} elseif ( $exist_username ) {
			$message .= "This username is already exist, please use another username";
		} else {
			$collab_accounts = new CollabAccounts(); // call model
			$collab_accounts->account_fullname = filter_var($params['name'], FILTER_SANITIZE_STRING);
			$collab_accounts->account_email = filter_var($params['email'], FILTER_SANITIZE_EMAIL);
			$collab_accounts->account_avatar = filter_var($params['avatar'], FILTER_SANITIZE_STRING);
			$collab_accounts->account_username = filter_var($params['username'], FILTER_SANITIZE_STRING);
			$collab_accounts->account_password = Yii::$app->security->generatePasswordHash($params['password']);
			$collab_accounts->account_key = Yii::$app->security->generateRandomString();
			$collab_accounts->account_reset_token = '';
			$collab_accounts->store_id = (int)$params['store'];
			$collab_accounts->save(); // save data
			
			$state = TRUE;
			$message .= "Data created successfully.";
		}

        $response = array(
            "status" => $state,
            "message" => $message,
        );
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
    }
	
	/**
     * action Update
     */
    public function actionUpdate()
    {
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params = Yii::$app->request->post();
        $state = FALSE;
        $message = "";
        $response = array();
		
		$username = filter_var($params['username'], FILTER_SANITIZE_STRING);
		$collab_accounts = CollabAccounts::findByUsername($username);
		// $collab_accounts = CollabAccounts::findOne(array('account_username' => $username));
		
		if ( $collab_accounts !== NULL ) {
			$collab_accounts->account_fullname = filter_var($params['name'], FILTER_SANITIZE_STRING);
			$collab_accounts->account_email = filter_var($params['email'], FILTER_SANITIZE_EMAIL);
			$collab_accounts->account_avatar = filter_var($params['avatar'], FILTER_SANITIZE_STRING);
			if (!empty($params['password'])) {
				$collab_accounts->account_password = Yii::$app->security->generatePasswordHash($params['password']);
				$collab_accounts->account_key = Yii::$app->security->generateRandomString();
			}
			$collab_accounts->account_reset_token = '';
			$collab_accounts->store_id = (int)$params['store'];
			$collab_accounts->save(); // save data
			
			$state = TRUE;
			$message .= "Data updated successfully.";
		} else {
			$message .= "Data not found!";
		}

        $response = array(
            "status" => $state,
            "message" => $message,
        );
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
    }
	
	/**
     * action Delete
     */
    public function actionDelete()
    {
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params = Yii::$app->request->get();
        $state = FALSE;
        $message = "";
        $response = array();
		
		$username = filter_var($params['username'], FILTER_SANITIZE_STRING);
		$deleted = CollabAccounts::deleteAll(['account_username' => $username]);
		
		if ( $deleted > 0 ) {
			$state = TRUE;
			$message .= "Data deleted successfully.";
		} else {
			$message .= "Failed to delete data!";
		}

        $response = array(
            "status" => $state,
            "message" => $message,
        );
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
    }
}