<?php

namespace common\components;

use Yii;
use yii\base\Component;

/**
 * @Author: gaghan
 * @Date:   2016-06-25 12:37:25
 * @Last Modified by:   gaghan
 * @Last Modified time: 2016-07-14 09:45:08
 */

class Kredivo_Input extends Component
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
