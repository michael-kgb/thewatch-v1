<?php

namespace common\components;

use Yii;
use yii\base\Component;

class Akulaku extends Component {
    
    private $id;
    private $key;
    private $environment = 'development';
    private $url;
    private $options = [];

    CONST DEV_URL = 'http://test.app.akulaku.com';
    CONST PROD_URL = 'http://app.akulaku.com';
    CONST DEV_PAYMENT_URL = 'http://test.mall.akulaku.com/v2/openPay.html';
    CONST PROD_PAYMENT_URL = 'http://mall.akulaku.com/v2/openPay.html';

    public function __construct()
    {
        $this->url = self::DEV_URL;
    }

    public function setCredentials($id, $key)
    {
        $this->id = $id;
        $this->key = $key;
        return $this;
    }

    public function setEnvironment($environment)
    {
        if ($environment == 'production') {
            $this->environment = $environment;
            $this->url = self::PROD_URL;
        } else {
            $this->options = [
                'verify' => FALSE
            ];
        }
    }

    private function _sign($content)
    {
        $string = $this->id . $this->key . $content;
        $string = base64_encode(hash('sha512', $string, TRUE));
        return str_replace(['+', '/', '='], ['-', '_', ''], $string);
    }

    // generate order
    public function generateOrder($params)
    {
        // print_r($params);
        $params['userAccount'] =  $this->cleanstring($params['userAccount']);
        $params['receiverName'] =  $this->cleanstring($params['receiverName']);
        $params['street'] =  $this->cleanstring($params['street']);
        $params['receiverPhone'] =  $this->cleanstring($params['receiverPhone']);
        $params['postcode'] =  $this->cleanstring($params['postcode']);
        
        $params['appId'] = $this->id;
        $params['details'] = json_encode($params['details']);
        $params['sign'] = $this->_sign($params['refNo'] . $params['userAccount'] . $params['receiverName'] . $params['receiverPhone'] . $params['province'] .
                          $params['city'] . $params['street'] . $params['postcode'] . $params['callbackPageUrl'] . $params['details']);
						  
		$akulaku = new \backend\models\AkulakuLog();
		$akulaku->akulaku_log_refno = $params['refNo'];
		$akulaku->akulaku_log_status = 'Pending';
		$akulaku->akulaku_log_periods = '';
		$akulaku->akulaku_log_sign = $params['sign'];
		$akulaku->save();

        $response = self::makeRequest($this->url . '/api/json/public/openpay/new.do', 'POST', $params);

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
    //            'Content-Type: application/x-www-form-urlencoded'
        );
		
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'DrewM/MailChimp-API/3.0 (github.com/drewm/mailchimp-api)');
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

        if ($info['http_code'] == 200) {
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