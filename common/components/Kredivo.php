<?php

namespace common\components;

use Yii;
use yii\base\Component;

class Kredivo extends Component {
    
    private static $kredivoSandboxUri = 'http://dev.kredivo.com/kredivo/v2/';
    private static $kredivoLiveUri = 'http://api.kredivo.com/kredivo/v2/';

    public static function checkout_url($params)
    {

        if (!isset($params['server_key'])) {
            $params['server_key'] = Kredivo_Config::$server_key;
        }
        Kredivo_Config::$is_production = $params['is_production'];
        $result = Kredivo_Request::post(
            Kredivo_Config::get_api_endpoint() . '/checkout_url',
            $params
        );

        return $result->redirect_url;
    }

    public static function confirm_order($params)
    {
        $result = Kredivo_Request::get(
            Kredivo_Config::get_api_endpoint() . '/update?' . http_build_query($params)
        );
		
		return $result;
    }

    public static function response($data = array())
    {
        header('Content-Type: application/json; charset=utf-8');

        $default = array(
            "status"  => "OK",
            "message" => "Notification has been received",
        );
        $data = array_merge($default, $data);

        return json_encode($data);
    }

    public static function close_connection($response)
    {
        ignore_user_abort(true);
        set_time_limit(0);
        ob_start();

        echo $response;

        // DON'T USE CONTENT-LENGTH or IT WILL BREAK THE CODE
        header("Content-Encoding: none");
        header("Connection: close");
        ob_end_flush();
        ob_flush();
        flush();
    }
}

/**
 * @Author: gaghan
 * @Date:   2016-06-25 12:37:25
 * @Last Modified by:   gaghan
 * @Last Modified time: 2016-07-14 09:45:08
 */

class Kredivo_Input
{

    private $response;

    public function __construct($raw_body = "php://input")
    {
        $raw_body = file_get_contents($raw_body);
        if ($this->is_json($raw_body)) {
            $this->response = json_decode($raw_body, false);
        } elseif (is_array($raw_body)) {
            $this->response = json_decode(json_encode($raw_body), false);
        } else {
            $this->response = $raw_body;
        }
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->response)) {
            return $this->response->$name;
        }
    }

    public function __toString()
    {
        return $this->get_json();
    }

    public function get_json() {
        return json_encode($this->response);
    }

    private function is_json($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}


/**
 * @Author: gaghan
 * @Date:   2016-06-25 12:37:25
 * @Last Modified by:   gaghan
 * @Last Modified time: 2016-06-25 13:05:57
 */

class Kredivo_Request
{

    public static function get($url)
    {
        return self::request($url, array(), false);
    }

    public static function post($url, $request)
    {
        return self::request($url, $request, true);
    }

    public static function request($url, $request = array(), $post = true)
    {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL            => $url,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_TIMEOUT        => 13,
            CURLOPT_USERAGENT      => "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36",
            // CURLOPT_HEADER         => true,
            // CURLINFO_HEADER_OUT    => true,
            CURLOPT_CUSTOMREQUEST  => $post ? 'POST' : 'GET',
            CURLOPT_POST           => $post,
            CURLOPT_POSTFIELDS     => json_encode($request),
            CURLOPT_HTTPHEADER     => array(
                'Content-Type: application/json; charset=UTF-8',
                // 'Content-Length: ' . strlen(json_encode($request)),
            ),
        ));

        $response = curl_exec($ch);

        if (curl_error($ch)) {
            throw new Exception('CURL Error: ' . curl_error($ch), curl_errno($ch));
        }

        if (empty($response)) {
            throw new Exception('Kredivo Error: Empty response.');
        }

        $info = curl_getinfo($ch);
        curl_close($ch);

        if ($info['http_code'] == 200) {
            $response = json_decode($response);
            if (strtolower($response->status) != 'ok') {
                throw new Exception($response->message, $response->code);
            } else {
                return $response;
            }
        }

    }
}

/**
 * @Author: gaghan
 * @Date:   2016-06-25 12:37:25
 * @Last Modified by:   gaghan
 * @Last Modified time: 2016-07-15 13:34:55
 */

class Kredivo_Config
{
    public static $server_key;
    public static $api_version   = 'v2';
    public static $is_production = true;
    // public static $is_production;

    // const SANDBOX_ENDPOINT    = 'http://dev.kredivo.com/kredivo';
    const SANDBOX_ENDPOINT    = 'http://sandbox.kredivo.com/kredivo';
    const PRODUCTION_ENDPOINT = 'https://api.kredivo.com/kredivo';

    public static function get_api_endpoint()
    {
        $sandbox    = Kredivo_Config::SANDBOX_ENDPOINT . '/' . Kredivo_Config::$api_version;
        $production = Kredivo_Config::PRODUCTION_ENDPOINT . '/' . Kredivo_Config::$api_version;
        return Kredivo_Config::$is_production ? $production : $sandbox;
    }
}