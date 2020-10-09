<?php

namespace app\modules\journal;

class Journal extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\journal\controllers';
    public $defaultRoute = "/default";

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
