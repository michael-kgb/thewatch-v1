<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'frontendUrl' => 'https://www.thewatch.co',
    'dev_api_url'=>'https://gostaging.thewatch.co',
    'prod_api_url'=>'https://www.thewatch.co',
    'vtrans_conf' => array(
                        'is_production' => YII_ENV === 'prod' ? true : false,
                        'mrchnt_key' => YII_ENV === 'prod' ? 'M065670' : 'M065670',
                        'svr_key' => YII_ENV === 'prod' ? 'VT-server-Nj6-jo8mSfy6IOwGBBUGa3LA' : 'SB-Mid-server-elZOfIh7jhuy8tEPzktoobHX',
                        'clnt_key' => YII_ENV === 'prod' ? 'VT-client-_rz55Hanv0PtThrX' : 'SB-Mid-client-LSvyYwViI686Czso',
                        'api_url' => YII_ENV === 'prod' ? 'https://api.veritrans.co.id/v2' : 'https://api.sandbox.veritrans.co.id/v2',
                    ),
    'midtrans_conf' => array(
                        'is_production' => YII_ENV === 'prod' ? true : false,
                        'mrchnt_key' => YII_ENV === 'prod' ? 'M065670' : 'M065670',
                        'svr_key' => YII_ENV === 'prod' ? 'VT-server-Nj6-jo8mSfy6IOwGBBUGa3LA' : 'SB-Mid-server-elZOfIh7jhuy8tEPzktoobHX',
                        'clnt_key' => YII_ENV === 'prod' ? 'VT-client-_rz55Hanv0PtThrX' : 'SB-Mid-client-LSvyYwViI686Czso',
                        'api_url' => YII_ENV === 'prod' ? 'https://api.veritrans.co.id/v2' : 'https://api.sandbox.veritrans.co.id/v2',
                    ),
    'ipay_conf' => array(
                        'is_production' => YII_ENV === 'prod' ? true : false,
                        'api_url' => YII_ENV === 'prod' ? 'https://payment.ipay88.co.id/epayment/entry.asp' : 'https://sandbox.ipay88.co.id/epayment/entry.asp',
                    ),
    'kredivo_conf' => array(
                        'is_production' => YII_ENV === 'prod' ? true : false,
                        'svr_key' => YII_ENV === 'prod' ? 'HMRFFg6e3WU5CjpNYqYN4ZygCyTa78' : 'HMRFFg6e3WU5CjpNYqYN4ZygCyTa78',
                    ),
    'vospay_conf' => array(
                        'is_production' => YII_ENV === 'prod' ? true : false,
                        'environment' => YII_ENV === 'prod' ? 'production' : 'staging',
                        'mrchnt_key' => YII_ENV === 'prod' ? 'd9a16f7e5731b79230e35f27a4faab4d' : 'fd79f79bbb53987e356b2c0c456c559f',
                    ),
];
