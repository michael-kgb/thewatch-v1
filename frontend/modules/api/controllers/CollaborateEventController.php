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
use frontend\models\CollabEvents;
use yii\web\Session;

class CollaborateEventController extends FrontendController
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
		
		$exist_event = CollabEvents::findOne(['event_alias' => $params['alias']]);
		
		if ( $exist_event ) {
			$message .= "This event alias is already exist.";
		} else {
			$collab_event = new CollabEvents(); // call model
			$collab_event->event_alias = $params['alias'];
			$collab_event->event_name = $params['name'];
			$collab_event->event_quota = $params['quota'];
			$collab_event->event_start_date = $params['start_date'];
			$collab_event->event_end_date = $params['end_date'];
			$collab_event->save(); // save data
			
			// try {
				// $collab_event->save(); // save data
				// Helpers::sendEmailMandrillUrlAPI(
						// $this->renderFile('@app/views/template/mail/signup.php', array(
							// "fullname" => $params['name'],
							// "email" => $params['email'],
							// "phone" => $params['phone'],
							// "code" => $rancode
						// )), 'The Watch Co - '. $collab_event->event_name .' Registration Information', \Yii::$app->params['adminEmail'], $params['email'], ''
				// );
			// } catch (Exception $ex) {
				// $message .= "There is an error while sending email.";
			// }
			
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
		
		$collab_event = CollabEvents::findOne(array('event_alias' => $params['alias']));
		
		if( $collab_event != NULL ){
			$collab_event->event_alias = $params['alias'];
			$collab_event->event_name = $params['name'];
			$collab_event->event_quota = $params['quota'];
			$collab_event->event_start_date = $params['start_date'];
			$collab_event->event_end_date = $params['end_date'];
			$collab_event->save(); // save data
			
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
		
		$deleted = CollabEvents::deleteAll(['event_alias' => $params['alias']]);
		
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