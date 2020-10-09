<?php
// $config['discount_multiple_items'] = '2';
// $config['discount_multi_percent'] = '15';
// $config['hst_tax'] = '7';
// $config['flat_shipping'] = true;
// $config['flat_shipping_price'] = '15.00';

return [
    'adminEmail' => 'notification@thewatch.co',
    'infoEmail'=>'notification@thewatch.co',  
    'orderPlacedSubjectEmail' => 'The Watch Co - Order Information',
    'signupSubjectEmail' => 'The Watch Co - Account Information',
    'webName'=>'The Watch Co',
    
    'mandUName'=>'thewatchindonesia@gmail.com',
    'mandPwd'=>'VeBgR01y5I46DFnYUNMwFw',
//    'cloudfrontDev' => 'http://localhost/twcnew/'
    //'cloudfrontDev' => 'http://d8n5mdmsycnle.cloudfront.net/'
	'cloudfrontDev' => 'https://d3vq5glb73pll6.cloudfront.net/',
    'imgixUrl' => '//thewatch.imgix.net/',
    'digishop.rules' => array(
        'is_decimal_price' => false,
        'flash_sale_time' => array(
            'date_from' => '2019-08-01 00:00:00',
            'date_to' => '2019-08-02 00:00:00'
        ),
    )
];
