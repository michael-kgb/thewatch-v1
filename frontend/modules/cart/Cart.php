<?php

namespace app\modules\cart;

class Cart extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\cart\controllers';
    public $defaultRoute = "/checkout";
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
