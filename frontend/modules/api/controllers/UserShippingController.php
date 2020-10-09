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
use yii\web\Session;
use yii\web\Request;
use DrewM\MailChimp\MailChimp;
use common\components\Helpers;
use yii\helpers\Url;
use backend\models\Customer;
use backend\models\CustomerAddress;
use frontend\models\CustomerForm;

class UserShippingController extends FrontendController
{
    /**
     * fungsi untuk generate list shipping bagi user yang telah sign in
     */
    public function actionShippingList() 
    {
        session_start();
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params_post = Yii::$app->request->post();
        $state = TRUE;
        $message = "";

        $customerInfo = $session['customerInfo'];
        if (empty($customerInfo)){
            $state = FALSE;
            $message = "You haven't Sign In yet.";
        }else{
            $shippingInformation = CustomerAddress::findAll(["customer_id" => $customerInfo['customer_id'],"deleted"=>0]);
            $message = "Generate Shipping List";
            $results = $shippingInformation;
        }
        $response = array(
            "status" => $state,
			"message" => $message,
			"results" => $results,
		);
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
    }

    /**
     * fungsi untuk create address bagi user yang telah sign in
     */
    public function actionCreateAddress() 
    {
        session_start();
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params_post = Yii::$app->request->post();
        $state = TRUE;
        $message = "";

        $customerInfo = $session['customerInfo'];
        if (empty($customerInfo)){
            $state = FALSE;
            $message = "You haven't Sign In yet.";
        }else{
            $customer_address = new CustomerAddress();
            $customer_address->customer_id = $customerInfo['customer_id'];
            $customer_address->country_id = 111;
            $customer_address->firstname = $params_post['firstname'];
            $customer_address->lastname = $params_post['lastname'];
            $customer_address->phone = $params_post['phone'];
            $customer_address->address1 = $params_post['address1'];
            $customer_address->postcode = $params_post['postcode'];
            $customer_address->province_id = $params_post['province_id'];
            $customer_address->state_id = $params_post['state_id'];
            $customer_address->district_id = $params_post['district_id'];
            $customer_address->address_label = $params_post['label'];
            $customer_address->active = 1;
            $customer_address->save();

            $total_address = count($_SESSION['customerInfo']['shippingInformation']);

            $_SESSION['customerInfo']['shippingInformation'][$total_address]['customer_address_id'] = $customer_address->customer_address_id;
            $_SESSION['customerInfo']['shippingInformation'][$total_address]['fname'] = $params_post['firstname'];
            $_SESSION['customerInfo']['shippingInformation'][$total_address]['lname'] = $params_post['lastname'];
            $_SESSION['customerInfo']['shippingInformation'][$total_address]['email'] =  $params_post['customerInfo']['email'];
            $_SESSION['customerInfo']['shippingInformation'][$total_address]['address'] = $params_post['address1'];
            $_SESSION['customerInfo']['shippingInformation'][$total_address]['other_address'] = '';
            $_SESSION['customerInfo']['shippingInformation'][$total_address]['phone'] = $params_post['phone'];
            $_SESSION['customerInfo']['shippingInformation'][$total_address]['phone_mobile'] = '';
            $_SESSION['customerInfo']['shippingInformation'][$total_address]['postcode'] = $params_post['postcode'];
            $_SESSION['customerInfo']['shippingInformation'][$total_address]['province_id'] = $params_post['province_id'];
            $_SESSION['customerInfo']['shippingInformation'][$total_address]['state_id'] = $params_post['state_id'];
            $_SESSION['customerInfo']['shippingInformation'][$total_address]['district_id'] = $params_post['district_id'];
            $_SESSION['customerInfo']['shippingInformation'][$total_address]['country_id'] = 111;
            $_SESSION['customerInfo']['shippingInformation'][$total_address]['label'] = $params_post['label'];
            $message = "You have successfully added an address.";
        }
        $response = array(
            "status" => $state,
			"message" => $message,
		);
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
    }

    /**
     * fungsi untuk edit address bagi user yang telah sign in
     */
    public function actionUpdateAddress() 
    {
        session_start();
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params_post = Yii::$app->request->post();
        $state = TRUE;
        $message = "";

        $customerInfo = $session['customerInfo'];
        if (empty($customerInfo)){
            $state = FALSE;
            $message = "You haven't Sign In yet.";
        }else{
            $id = $params_post['id'];
            $customer_address = CustomerAddress::findOne($id);
            if (!empty($customer_address)) {
                $customer_address->firstname = $params_post['firstname'];
                $customer_address->lastname = $params_post['lastname'];
                $customer_address->phone = $params_post['phone'];
                $customer_address->address1 = $params_post['address1'];
                $customer_address->postcode = $params_post['postcode'];
                $customer_address->province_id = $params_post['province_id'];
                $customer_address->state_id = $params_post['state_id'];
                $customer_address->district_id = $params_post['district_id'];
                $customer_address->address_label = $params_post['label'];
                $customer_address->save();

                for ($i = 0; $i < count($_SESSION['customerInfo']['shippingInformation']); $i++) {
                    if ($_SESSION['customerInfo']['shippingInformation'][$i]['customer_address_id'] == $id) {
                        $_SESSION['customerInfo']['shippingInformation'][$i]['customer_address_id'] = $id;
                        $_SESSION['customerInfo']['shippingInformation'][$i]['fname'] = $params_post['firstname'];
                        $_SESSION['customerInfo']['shippingInformation'][$i]['lname'] = $params_post['lastname'];
                        $_SESSION['customerInfo']['shippingInformation'][$i]['address'] = $params_post['address1'];
                        $_SESSION['customerInfo']['shippingInformation'][$i]['phone'] = $params_post['phone'];
                        $_SESSION['customerInfo']['shippingInformation'][$i]['postcode'] = $params_post['postcode'];
                        $_SESSION['customerInfo']['shippingInformation'][$i]['province_id'] = $params_post['province_id'];
                        $_SESSION['customerInfo']['shippingInformation'][$i]['state_id'] = $params_post['state_id'];
                        $_SESSION['customerInfo']['shippingInformation'][$i]['district_id'] = $params_post['district_id'];
                        $_SESSION['customerInfo']['shippingInformation'][$total_address]['label'] = $params_post['label'];
                        break;
                    }
                }
                $message = "You have successfully update an address.";
            }
        }
        $response = array(
            "status" => $state,
			"message" => $message,
		);
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
    }

    /**
     * fungsi untuk delete address bagi user yang telah sign in
     */
    public function actionDeleteAddress() 
    {
        session_start();
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params_post = Yii::$app->request->post();
        $state = TRUE;
        $message = "";

        $customerInfo = $session['customerInfo'];
        if (empty($customerInfo)){
            $state = FALSE;
            $message = "You haven't Sign In yet.";
        }else{
            $id = $params_post['id'];
            $customer_address = CustomerAddress::findOne($id);
            if(!empty($customer_address)){
                $customer_address->deleted = 1;
                $customer_address->save();
                
                for ($i = 0; $i < count($_SESSION['customerInfo']['shippingInformation']); $i++) {
                    if ($_SESSION['customerInfo']['shippingInformation'][$i]['customer_address_id'] == $id) {
                        unset($_SESSION['customerInfo']['shippingInformation'][$i]);
                        break;
                    }
                }
                $_SESSION['customerInfo']['shippingInformation'] = array_values($_SESSION['customerInfo']['shippingInformation']);
            }
            $message = "You have successfully delete an address.";
        }
        $response = array(
            "status" => $state,
			"message" => $message,
		);
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
    }

    /**
     * fungsi untuk set shipping address bagi user yang telah sign in
     */
    public function actionSetShipping() 
    {
        session_start();
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params_post = Yii::$app->request->post();
        $state = TRUE;
        $message = "";

        $customerInfo = $session['customerInfo'];
        if (empty($customerInfo)){
            $state = FALSE;
            $message = "You haven't Sign In yet.";
        }else{
            CustomerAddress::updateAll(['set_as_default' => 0], 'customer_id ='.$params_post['customer_id']);
            $customer = CustomerAddress::findOne($params_post['customer_address_id']);
            $customer->set_as_default = 1;
            $customer->save();
            $message = "You have successfully set an address as default shipping.";
        }
        $response = array(
            "status" => $state,
			"message" => $message,
		);
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
    }
}