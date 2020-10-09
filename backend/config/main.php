<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$home_url = $_SERVER['HTTP_HOST'] === 'localhost' ? '/thewatch-v1/webadmin' : '/';
$base_url = $_SERVER['HTTP_HOST'] === 'localhost' ? '/thewatch-v1/webadmin' : '/webadmin';
$front_url = $_SERVER['HTTP_HOST'] === 'localhost' ? '/thewatch-v1' : '/';

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'timeZone' => 'Asia/Jakarta',
    'modules' => [],
	'homeUrl' => $home_url, // hosted home url
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                // 'name' => '_backendUser', // unique for backend
                'name' => '_backendIdentity', // unique for backend
                'path'=>'/backend/web',  // correct path for the backend app.
                // 'httpOnly' => true,
                // 'secure' => true,
            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request' => [
            'baseUrl' => $base_url, // hosted base url
			'class' => 'common\components\Request',
			'web'=> '/backend/web'
        ],
        'session' => [
            'name' => 'PHPBACKSESSID',
            'savePath' => __DIR__ . '/../runtime/sessions',
            // 'savePath' => sys_get_temp_dir(),
            // 'cookieParams' => [
            //     'httpOnly' => true,
            //     'secure' => true
            // ] 
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'user/profile/<username:.*>' => 'user/profile',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
        'urlManagerFrontEnd' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => $front_url,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'urlManagerBackEnd' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/backend/web',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'assetManager' => [
            'linkAssets' => true,
            'appendTimestamp' => true,
        ],
    ],
    'params' => $params,
];