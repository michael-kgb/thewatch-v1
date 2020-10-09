<?php
use cinghie\mailchimp\components\Mailchimp as MailchimpComponent;
use cinghie\mailchimp\Mailchimp;

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$home_url = $_SERVER['HTTP_HOST'] === 'localhost' ? '/thewatch-v1' : '/';
$base_url = $_SERVER['HTTP_HOST'] === 'localhost' ? '/thewatch-v1' : '';

return [
    'id' => 'app-frontend',
    'name' => 'The Watch Co.',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Asia/Jakarta',
    'controllerNamespace' => 'frontend\controllers',
    'homeUrl' => $home_url, // hosted home url
    'modules' => [
        // 'digicarts' => [
        //     'class' => 'app\components\digishop\DigiCarts',
        // ],
        // 'digicoupons' => [
        //     'class' => 'app\components\digishop\DigiCoupons',
        // ],
        'go-api' => [
            'class' => 'app\modules\api\Api'
        ],
        'cart' => [
            'class' => 'app\modules\cart\Cart',
        ],
        'journal' => [
            'class' => 'app\modules\journal\Journal',
        ],
		// 'mailchimp' => [
        //     'class' => 'cinghie\mailchimp\Mailchimp',
        //     'apiKey' => '35efbb4f1931d665b03f052efc24900f-us13',
        //     'showFirstname' => true,
        //     'showLastname' => true
        // ]
        'mailchimp' => [
            'class' => Mailchimp::class,
            'showFirstname' => true,
            'showLastname' => true
        ]
    ],
    'components' => [
        'mailchimp' => [
            'class' => MailchimpComponent::class,
            'apiKey' => '35efbb4f1931d665b03f052efc24900f-us13'
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            // 'identityClass' => 'common\models\LoginForm',
            'enableAutoLogin' => true,
            'enableSession' => true,
            'identityCookie' => [
                // 'name' => '_frontendUser', // unique for frontend
                'name' => '_frontendIdentity', // unique for frontend
                'path' => '/frontend/web/', // correct path for frontend app.
                'httpOnly' => true,
                'secure' => true,
            ]
        ],
        'session' => [
            // 'class' => 'yii\web\Session',
            'name' => 'PHPFRONTSESSID',
            'savePath' => __DIR__ . '/../runtime/sessions',
            // 'savePath' => sys_get_temp_dir(),
            'cookieParams' => [
                'httpOnly' => true,
                'secure' => true
            ]
        ],
        'mailer' => [
            'class' => 'nickcv\mandrill\Mailer',
            'apikey' => 'VeBgR01y5I46DFnYUNMwFw',
        ],
        'kredivo' => [
            'class' => 'common\components\Kredivo'
        ],
		'kredivoinput' => [
            'class' => 'common\components\KredivoInput'
        ],
		'kredivorequest' => [
            'class' => 'common\components\KredivoRequest'
        ],
		'akulaku' => [
            'class' => 'common\components\Akulaku'
        ],
		'helpers' => [
            'class' => 'common\components\Helpers'
        ],
        'request' => [
            'baseUrl'=>$base_url, // hosted base url
			'class' => 'common\components\Request',
			'web'=> '/frontend/web'
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //'independence-giveaway' => 'campaign/giveaway',
				//'giveaway/thankyou-page' => 'campaign/result',
                'shop-social' => 'shopsocial',
				//'hari-pelanggan-nasional' => 'campaign/hpn',
                //'hari-pelanggan-nasional/thankyou-page' => 'campaign/hpnthank',
				
				'campaign/product/<productName:.*>' => 'campaign/product',
				'secretdeal' =>'campaign/secretdeal',
				'mychristmaswish' => 'campaign/mychristmaswish',
				'MyChristmasWish' => 'campaign/mychristmaswish',
				'MYCHRISTMASWISH' => 'campaign/mychristmaswish',
                
                'brand/<brandName:.*>' => 'brands/detail',
				'stock-opname' => 'landing/so',
                'brands/<category:.*>' => 'brands/category',
                'product/<productName:.*>' => 'product/detail',
				'user/wishlist/<idWishlist:.*>' => 'user/wishlist',
                'user/wishlist' => 'user/wishlist',
                'flash/<productName:.*>' => 'product/flash',
				'harbolnas/<productName:.*>' => 'product/harbolnas',
                'flash-go/<productName:.*>' => 'product/flash-go',
                'po/<productName:.*>' => 'product/preorder',
                'product-heritage/<productName:.*>' => 'product/detailevent',
                'customer/notify' => 'customer/notify',
                
                'watches/brand/<brandName:.*>' => 'brands/watches',
                'straps/brand/<brandName:.*>' => 'brands/straps',
                'accessories/brand/<brandName:.*>' => 'brands/accessories',
                'jewelry/brand/<brandName:.*>' => 'brands/jewelry',
                
                'watches/<actionName:.*>' => 'category/watches',
                'straps/<actionName:.*>' => 'category/straps',
                'accessories/<actionName:.*>' => 'category/accessories',
                'jewelry/<actionName:.*>' => 'category/jewelry',
                
                'stock/quantity' => 'product/stock',
                'stock/price' => 'product/price',
                'stock/quantitycolor' => 'product/stockcolor',
                'stock/quantitysize' => 'product/stocksize',
                'stock/viewsize' => 'product/viewsize',
                
                'cart/checkout/step/<action:.*>' => 'cart/checkout/step',
                'cart/checkout/editaddress/<id:.*>' => 'cart/checkout/editaddress',
                'cart/checkout/deleteaddress/<id:.*>' => 'cart/checkout/deleteaddress',
                'cart/payment/get-payment-list/<id:.*>' => 'cart/payment/get-payment-list',
                
                'api/product' => 'api/prism',
                'api/shipment/area' => 'api/area',
                'api/shipment/cost' => 'api/shippingcost',
                'api/order/invoice' => 'api/prismaddtocart',
                'warranty/get-product-list/<id:.*>' => 'warranty/get-product-list',
                'warranty/get-store/<id:.*>' => 'warranty/get-store',
                'warranty/claim/<id:.*>' => 'warranty/claim',
                'warranty/details/<id:.*>' => 'warranty/details',
                'warranty/download/<id:.*>' => 'warranty/download',
                'warranty/ketentuan/<id:.*>' => 'warranty/ketentuan',
                'warranty/cancel/<id:.*>' => 'warranty/cancel',
                'warranty/payment/<id:.*>' => 'warranty/payment',
                'warranty/mail/<id:.*>' => 'warranty/mail',
                'warranty/receive/<id:.*>' => 'warranty/receive',
                'warranty/surveiservice/<id:.*>' => 'warranty/surveiservice',
                
                'journal/detail/<title:.*>' => 'journal/default/detail',
                'journal/preview/<title:.*>' => 'journal/default/preview',
                'journal/author/detail/<username:.*>' => 'journal/author/detail',
                // 'journal/author/contributor' => 'journal/author/index',
                'journal/category/<categoryName:.*>' => 'journal/category',
                
                'user/shipping/<action:.*>/<id:.*>' => 'user/shipping',
                'user/order/<action:.*>/<id:.*>' => 'user/order',
                'user/confirm/<action:.*>/<id:.*>' => 'user/confirm',
                'user/payment/<id:.*>' => 'user/payment',
                'shipping-information' => 'shippinginfo/index',
                'status/cancel/<action:.*>/<id:.*>' => 'status/cancel',
                'status/agree/<action:.*>/<id:.*>' => 'status/agree',
                'status/cancelproduct/<action:.*>/<id:.*>/<product_id:.*>' => 'status/cancelproduct',
                'status/agreeproduct/<action:.*>/<id:.*>/<product_id:.*>' => 'status/agreeproduct',
                'status/acceptproduct/<action:.*>/<id:.*>' => 'status/acceptproduct',
                'sale-detail' => 'promo/sale-detail',
                'liunicxtwc' => 'promo/liunic',
                'pesta-belanja-1111' => 'promo/harbolnas11',
                'pesta-belanja-1111-detail' => 'promo/harbolnas11detail',
                'pesta-belanja-1212-detail' => 'promo/harbolnas11detail',
				'valentine' => 'promo/valentine',
				'twcvalentine' => 'promo/valentinebundle',
				'forthefans' => 'promo/forthefans',
				'valentine/forher' =>'promo/valentineforher',
				'valentine/forhim' =>'promo/valentineforhim',
				'sweet-deal' => 'promo/beemine',
                // 'sale' => 'promo/sale',
                'sale' => 'promo/sale-page',
                'upto40' => 'promo/endsale',
                //'sale' => 'promo/allproductsale',
				'ramadhan' => 'promo/salee',
                'watchsale'=>'promo/allwatchessale',
                'accessoriesale'=>'promo/allaccessoriesale',
                'hgbundling' => 'promo/hgbundling',
                'hgstraps' => 'promo/hgstraps',
                'dwsummer' => 'promo/dwlanding',
				'twcxrsd' => 'promo/twcxrsd',
				'weekdays-remedy' => 'promo/weekdaysremedy',
				'pilgub' => 'promo/pilkadatwc',
				'ramadhantimex' => 'promo/ramadhantimex',
				'ramadhangrace' => 'promo/lastcallgrace',
				'ramadhanhgstraps' => 'promo/lastcallhgstraps',
				'ramadhanhg' => 'promo/lastcallhgsignature',
				'promo-aark' => 'promo/lastcallaark', 
				'ramadhanlima' => 'promo/ramadhanlima',
				'clearance-sale' => 'promo/clearancesale',
				'ramadhansale-dwclassy' => 'promo/ramadhansaleclassy',
				'accessories-sale' => 'promo/ramadhanaccessories',
				'thehackney' => 'promo/ramadhanob',
				'lastseasontimex' => 'promo/lastseasontimex',
				'cyber-sale-10-10' => 'promo/cyber',
				'tick-or-treat' => 'promo/halloween',
				
				'kontes-seo' => 'promo/kontesseo', 
				'pengumuman-kontes-seo' => 'promo/pemenangseo',
				'kontes-seo/daftar'=>'promo/kontesseodaftar',
				'pemenang-blog-competition' => 'landing/pemenangblog',
				
				'blog-competition' => 'promo/blogcompetition',
				'blog-competition/daftar'=>'promo/blogcompetitiondaftar',
				'blog-competition/daftar/thankyou'=>'promo/blogcompetitionthankyou',
				
				'flash-sale-ob' => 'promo/flash-sale-ob',
				
                'flash-dev' => 'promo/flash-dev',
                'flash-des' => 'promo/flash-des',
                // 'flash-exp' => 'promo/flash',
                'flash-go' => 'promo/flash-go',
				'harbolnas' => 'promo/flash-okt',
				'flash-sale' => 'promo/flash-sep',
				'summer-sale' => 'landing/summersale',
				'williaml-summersale' => 'promo/summersalewilliaml',
				'promo-merdeka-17-agustus' => 'promo/agustus',
				'weekend-style' => 'promo/weekendstyle',
				'surprise-sale' => 'promo/surprisesale',
				'taketime-sale' => 'promo/taketimetimex',
				'timex-sale' => 'promo/taketimetimex',
				'eastpak-sale' => 'promo/eastpaksale',
				'endyear-sale' => 'promo/endyearsale',
				'furtherreduction' => 'promo/furtherreduction',
				'weekendsale' => 'promo/weeksale',
				'limasale' => 'promo/limasale',
				'shopback' => 'promo/shopback',
				'promo-april' => 'promo/awesomeapril',
				'permata-bank' => 'promo/permata',
				'promo-mandiri' => 'promo/mandiri',
				'promo-asian-games-2018' => 'promo/asiangames',
				'oliviaburtonxhouzcall' => 'landing/obxhouz',
				'timexmakna' => 'landing/makna',
				'ob-floralwrap' => 'landing/obvalentine',
				'd1-fathersday' => 'landing/d1fathersday', 
				'backtowork' => 'landing/backtowork', 
				'payday' => 'landing/payday', 
				'timexbeams' => 'landing/beams2',
                'qtimex' => 'landing/qtimex',
                'timexraffle' => 'landing/raffle',
                'timexraffle/verifikator' => 'landing/raffleverifikator',
                'timexraffle/verifikator/login' => 'landing/raffleverifikatorlogin',
				'ob-deals' => 'landing/ob-deals',
				'sweetdeals' => 'landing/sweet-deals',
				'akulaku' => 'landing/akulaku',
				'promogopay' => 'promo/gopay',
				'fall-winter' => 'promo/fallwinter',
				'mayday-madness-2018' => 'landing/mayday',
				'preorderd1milano' => 'landing/preorder',
				'corporateorder' => 'landing/corporate',
				//'dwpetite' => 'promo/dwpetite',
				//'harbolnas' => 'promo/harbolnas',
				//'harbolnas-detail' => 'promo/harbolnasdetail',
				'heritage' => 'promo/eventall',
				'promo-vospay' => 'promo/vospay',
				'september-special' => 'promo/september',
				
				'hari-ayah' => 'campaign/hari-ayah',
				'anz'=>'campaign/anz',
				
                'dwsummer/<variant:.*>' => 'promo/dwsummer',
                'dwsummer/<variant:.*>' => 'promo/dwsummer',
                'dwsummer/<variant:.*>' => 'promo/dwsummer',
                'dwsummer/<variant:.*>' => 'promo/dwsummer',
                'dwsummer/<variant:.*>' => 'promo/dwsummer',
                
                'timextaketime' => 'timexlandingpage',
                'timextaketime/deni-tx' => 'timexlandingpage/deni',
                'timextaketime/thesigit' => 'timexlandingpage/thesigit',
                'timextaketime/mulie-addlecoat' => 'timexlandingpage/mulie',
                'timextaketime/alinka' => 'timexlandingpage/alinka',
                'timextaketime/krishna-malik' => 'timexlandingpage/malik',
				'api/payment/notification' => 'api/payment',
				'api/checkout/<action:.*>' => 'api/checkout',
				'api/orders/<action:.*>' => 'api/orders',
				'redefinetime' => 'landing/twccampaign',
				'promo-bank' => 'landing/promo-bank',
				'experiment' => 'experiment/brand',
            ],
			
        ],
        'assetManager' => [
            'linkAssets' => true,
            'appendTimestamp' => true,
            // 'bundles' => [
            //     'yii\web\JqueryAsset' => [
            //         'jsOptions' => [
            //             'async' => 'async'
            //         ],
            //     ],
            // ],
        ],
    ],
    'params' => $params,
    
];