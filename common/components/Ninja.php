<?php

namespace common\components;

use Yii;
use yii\base\Component;

class Ninja extends Component {
    
    private $client_id;
    private $client_secret;
    private $environment = 'development';
    private $country_id;
    private $alamat_gudang;
    private $from_name;
    private $from_telp;
    private $from_email;
    private $postcode;
    private $timezone;
    private $token;
    private $url;
    private $options = [];

    CONST DEV_URL = 'https://api-sandbox.ninjavan.co';
    CONST PROD_URL = 'https://api.ninjavan.co';
    CONST ALAMAT_GUDANG = 'Jalan Radio 3';
    CONST POSTCODE = '12130';
    CONST COUNTRY_ID_DEV = 'sg';
    CONST COUNTRY_ID_PROD = 'id';
    CONST NAME = 'PT Kami Gawi Berjaya';
    CONST TELP = '0989089823';
    CONST EMAIL = 'info@kgbgroup.co.id';
    CONST TIMEZONE = 'Asia/Jakarta';

    public function __construct()
    {
        $this->url = self::DEV_URL;
        $this->country_id = self::COUNTRY_ID_DEV;
        $this->alamat_gudang = self::ALAMAT_GUDANG;
        $this->postcode = self::POSTCODE;
        $this->from_name = self::NAME;
        $this->from_telp = self::TELP;
        $this->from_email = self::EMAIL;
        $this->timezone = self::TIMEZONE;

        $access_token = \backend\models\AccessToken::find()->where(['partner_name'=>'ninja'])->andWhere(['type'=>$this->environment])->one();
        $this->token = $access_token->token_number;
    }

    public function setCredentials($client_id, $client_secret)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        return $this;
    }

    public function setToken($token){
        $this->token = $token;

        $access_token = \backend\models\AccessToken::find()->where(['partner_name'=>'ninja'])->andWhere(['type'=>$this->environment])->one();
        $access_token->token_number = $token;
        $access_token->update();

    }

    public function setEnvironment($environment)
    {
        if ($environment == 'production') {
            $this->environment = $environment;
            $this->url = self::PROD_URL;
            $this->country_id = self::COUNTRY_ID_PROD;
        } else {
            $this->options = [
                'verify' => FALSE
            ];
        }

        return $this;
    }

    private function _sign($content)
    {
        $string = $this->id . $this->key . $content;
        $string = base64_encode(hash('sha512', $string, TRUE));
        return str_replace(['+', '/', '='], ['-', '_', ''], $string);
    }

    public function verify_webhook($data, $hmac_header){
        $calculated_hmac = base64_encode(hash_hmac('sha256', $data, $this->client_secret, true));
        return ($hmac_header == $calculated_hmac);
    } 

    public function generateToken(){
        $data['client_id'] = $this->client_id;
        $data['client_secret'] = $this->client_secret;
        $data['grant_type'] = 'client_credentials';

        $data = json_encode($data);
       
        $response = self::makeRequest($this->url . '/'.$this->country_id.'/2.0/oauth/access_token', 'POST', $data);

        $access_token = \backend\models\AccessToken::find()->where(['partner_name'=>'ninja'])->andWhere(['type'=>$this->environment])->one();
        $access_token->token_number = $response->access_token;
        $access_token->update();

        $this->token = $response->access_token;
        
        return $response;      

    }

    // generate order
    public function generateStandard($params)
    {
        // echo $this->client_id;
        // echo $this->environment;
        // print_r($params);die();
        // $orders = \backend\models\Orders::find()->where(['reference'=>$params['reference']])->one();

        $reference['merchant_order_number'] = $this->cleanstring($params['reference']);

        $address_from['address1'] = $this->alamat_gudang;
        $address_from['address2'] = '';
        $address_from['country'] = 'ID';
        $address_from['postcode'] = $this->postcode;

        $from['name'] = $this->from_name;
        $from['phone_number'] = $this->from_telp;
        $from['email'] = $this->from_email;
        $from['address'] = $address_from;

        $address_to['address1'] = $this->cleanstring($params['address']);
        $address_to['address2'] = '';
        $address_to['country'] = 'ID';
        $address_to['postcode'] = $this->cleanstring($params['postcode']);

        $to['name'] = $this->cleanstring($params['name']);
        $to['phone_number'] = $this->cleanstring($params['telp']);
        $to['email'] = $this->cleanstring($params['email']);
        $to['address'] = $address_to;

        $delivery_timeslot['start_time'] = $this->cleanstring($params['start_time']);
        $delivery_timeslot['end_time'] = $this->cleanstring($params['end_time']);
        $delivery_timeslot['timezone'] = $this->timezone;

        $dimensions['weight'] = 1.0;
        $dimensions['size'] = "S";

        $parcel_job['is_pickup_required'] = false;
        $parcel_job['delivery_start_date'] = $this->cleanstring($params['date_pick']);;
        $parcel_job['delivery_timeslot'] = $delivery_timeslot;
        $parcel_job['delivery_instructions'] = "Tolong Hati-hati";
        $parcel_job['dimensions'] = $dimensions;


        $data['service_type'] =  'Parcel';
        $data['service_level'] =  'Standard';
        $data['requested_tracking_number'] =  $this->cleanstring($params['req_tacking']);
        $data['from'] =  $from;
        $data['to'] =  $to;
        $data['parcel_job'] = $parcel_job;

        $data = json_encode($data);
       
        $response = self::makeRequest($this->url . '/'.$this->country_id.'/4.1/orders', 'POST', $data);

        return $response;
    }

    private function makeRequest($url, $http_verb, $args = array())
    {
        if (!function_exists('curl_init') || !function_exists('curl_setopt')) {
            throw new \Exception("cURL support is required, but can't be found.");
        }

        $response = array(
            'headers'     => null, // array of details from curl_getinfo()
            'httpHeaders' => null, // array of HTTP headers
            'body'        => null // content of the response
        );

		if( $http_verb == 'GET' )
            $url .= '?' . http_build_query($args);
		
        $ch = curl_init();
        $headers = array(
               'Content-Type: application/json',
               'Accept: application/json',
               'Authorization: Bearer '. $this->token
        );
		
        curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_USERAGENT, 'DrewM/MailChimp-API/3.0 (github.com/drewm/mailchimp-api)');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // do not echo the result, write it into variable
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $http_verb); // POST/GET/PATCH/PUT/DELETE
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    //	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // certificate verification for TLS/SSL connection
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_VERBOSE, true);

        if( $http_verb != 'GET' ) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $args); 
        }

        $responseContent = curl_exec($ch);

// 		print_r($responseContent); die();

        if (curl_error($ch)) {
            throw new Exception('CURL Error: ' . curl_error($ch), curl_errno($ch));
        }

        $info = curl_getinfo($ch);
        curl_close($ch);

        if ($info['http_code'] == 200 || $info['http_code'] == 401) {
            $response = json_decode($responseContent);
            return $response;
        }

    }

    // payment entry
    public function paymentEntry($refNo)
    {
        return ($this->environment == 'production' ? self::PROD_PAYMENT_URL : self::DEV_PAYMENT_URL) . '?appId=' . $this->id . '&refNo=' . $refNo . '&sign=' . $this->_sign($refNo) . '&lang=id';
    }

    // inquiry status
    public function inquiryStatus($refNo)
    {
		$response = self::makeRequest(
			$this->url . '/api/json/public/openpay/status.do?appId=' . $this->id . '&refNo=' . $refNo . '&sign=' . $this->_sign($refNo),
			'GET'
		);
        
        return $response;
    }

    public function verifyCallbackPage($params)
    {
        if ($params['sign'] == $this->_sign($params['refNo'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function verifyCallbackAPI($params)
    {
        if ($params['sign'] == $this->_sign($params['refNo'] . $params['status'] . $params['period'] . $params['monthlyInstallmentPayment'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function cancelSKU($params)
    {
        $params['appId'] = $this->id;
        $params['sign'] = $this->_sign($params['refNo'] . $params['skuId'] . $params['skuQty']);
        $response = Requests::post($this->url . '/api/json/public/openpay/cancel.do', [], $params, $this->options);

        return $response;
    }

    public function cancelPayment($refNo)
    {
        $params = array(
			'appId' => '626809194',
			'refNo' => $refNo,
			'sign' => $this->_sign($refNo)
		);
		
        $response = self::makeRequest(
			$this->url . '/api/json/public/openpay/payment/cancel.do',
			'POST',
			$params
		);
        
        return $response;
    }

    public function confirmReceipt($refNo)
    {
		$params = array(
			'appId' => '626809194',
			'refNo' => $refNo,
			'sign' => $this->_sign($refNo)
		);
		
        $response = self::makeRequest(
			$this->url . '/api/json/public/openpay/order/receipt.do',
			'POST',
			$params
		);
        
        return $response;
    }

    public function getPaymentStatus($status)
    {
        switch ($status) {
            case 1 : return 'Pending';
                break;
            case 90 : return 'Failed';
                break;
            case 91 : return 'Refund';
                break;
            case 92 : return 'Cancelled';
                break;
            case 100 : return 'Success';
                break;
            case 101 : return 'Receipted';
                break;
            default : return 'Unknown';
                break;
        }
    }

    public function getErrorCode($code)
    {
        switch ($code) {
            Case 'SYSTEM.0001' : return "Unknow error.";
                break;
            Case 'SYSTEM.0002' : return "Illegal parameter(s).";
                break;
            Case 'openpay.0001' : return "invalid signature.";
                break;
            Case 'openpay.0002' : return "order exists.";
                break;
            Case 'openpay.0003' : return "error app id.";
                break;
            Case 'openpay.0004' : return "order not exists.";
                break;
            Case 'openpay.0006' : return "can’t refund, order has refunded.";
                break;
            Case 'openpay.0007' : return "can’t refund, order has not successful.";
                break;
            Case 'openpay.0008' : return "can't cancel, order has successful.";
                break;
            Case 'openpay.0009' : return "order has not paid.";
                break;
        }
    }
    
    public function cleanstring($string){
        $total_char = strlen($string);
        if(substr($string, $total_char - 1) == ' '){
            $string = substr($string, 0, $total_char - 1);
        }
        return $string;
    }
}