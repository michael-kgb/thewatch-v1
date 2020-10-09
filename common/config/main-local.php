<?php
$db = "";
$u_db = "";
$p_db = "";

// set the array for testing the local environment
$whitelist = array( '127.0.0.1', '::1' );
// check if the server is in the array
if ( in_array( $_SERVER['REMOTE_ADDR'], $whitelist ) ) {
	$db = "thewatch_dbtwcnew";
	$u_db = "root";
	$p_db = "1234";
} else {
	$db = "thewatch_dbtwcnew";
	$u_db = "thewatch_dbbaru";
	$p_db = "OaW%xMsMNb-D";
}
		
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname='.$db,
            'username' => $u_db,
            'password' => $p_db,
            // 'dsn' => 'mysql:host=thewatchco.cluster-ctrvdtjq8oxo.ap-southeast-1.rds.amazonaws.com;dbname=thewatch_dbtwcnew',
            // 'username' => 'admin',
            // 'password' => 'wi8yFzygAUOXOvhhtpLH',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
