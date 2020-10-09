<?php

header('Expires: Wed 11 Jan 1984 05:00:00 GMT');
// header('Last-Modified: 'date('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-stor, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0');
header('Pragma: no-cache');



if(!defined('APPLICATION_ENV')) {
    if(FALSE === stripos($_SERVER['SERVER_NAME'], 'gostaging.thewatch.co') && FALSE === stripos($_SERVER['SERVER_NAME'], 'localhost')) {
        define('APPLICATION_ENV', 'production');
        defined('YII_ENV') or define('YII_ENV', 'prod');
        defined('YII_DEBUG') or define('YII_DEBUG', FALSE);
		error_reporting(0);
		ini_set('display_errors', false);
    }else{
        define('APPLICATION_ENV', 'development');
        defined('YII_ENV') or define('YII_ENV', 'dev');
        defined('YII_DEBUG') or define('YII_DEBUG', TRUE);
		error_reporting(0);
        ini_set('display_errors', true);
    }
}




//in case for debugging, uncomment this toggle comment an comment out the above scripts

// defined('YII_DEBUG') or define('YII_DEBUG', FALSE);
// error_reporting(0);
// ini_set('display_errors', false);

// defined('YII_DEBUG') or define('YII_DEBUG', TRUE);
// error_reporting(-1);
// ini_set('display_errors', true);
 
require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../common/config/main-local.php'),
    require(__DIR__ . '/../config/main.php'),
    require(__DIR__ . '/../config/main-local.php')
);

$application = new yii\web\Application($config);
$application->on(yii\web\Application::EVENT_BEFORE_REQUEST, function(yii\base\Event $event){
    $event->sender->response->on(yii\web\Response::EVENT_BEFORE_SEND, function($e){
        ob_start("ob_gzhandler");
    });
    $event->sender->response->on(yii\web\Response::EVENT_AFTER_SEND, function($e){
        ob_end_flush();
    });
});
$application->run();
