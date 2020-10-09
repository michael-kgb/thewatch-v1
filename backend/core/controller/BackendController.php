<?php

namespace backend\core\controller;

use yii\web\Controller;

class BackendController extends Controller {
    
    /**
     * @var array the parameters bound to the current url.
     */
    public $breadcrumb = [];
    
    /**
     * @var string the layout template parameter to be used.
     */
    public $layout = "dashboard";
    
    public $enableCsrfValidation = false;
}
