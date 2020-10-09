<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/full-slider.css',
        'css/agency.css',
        'css/timexmakna.css',
        'css/thewatchco-style24.css',
        'css/thewatchco-style-mobile13.css',
        'css/thewatchco-style-ipad06.css',
        'css/font-awesome/css/font-awesome.min.css',
        'css/checkbox.css',
        'css/slider.css',
        'css/slippry.css',
        'css/swiper2.min.css',
        'css/owl.carousel.css',
        'css/owl.theme.css',
        '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',
        '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css',
        // 'css/jq-timeTo/timeTo.css',
        'css/countdown/jquery.countdown.css',
		'css/custom.css',
		'css/wishlist.css'
    ];
    public $js = [
		
        '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js',
		//'https://unpkg.com/vue@2.6.10/dist/vue.js',
        //'https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.js',
        //'js/vuejs-datatable/vuejs-datatable.js',
        //'js/vue-brand-index.js',
        //'js/vue-raffle-index.js',
        //'js/vue-raffle-verifikator.js',
        // '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js',
		// 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js',
        // 'js/jquery-2.1.4.min.js',
        // '//code.jquery.com/ui/1.12.0-rc.2/jquery-ui.min.js',
        'js/jquery-ui.min.js',
        'js/jquery.mobile.custom.js',
//        'js/jquery-2.2.0.min.js',
        // '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js',
        'https://unpkg.com/@babel/standalone/babel.min.js',
        'js/bootstrap.min.js',
        'js/bootstrap-slider.js',
        'js/menu3.js',
        'js/ga_functions.js',
        'js/slippry.min.js',
// 		'//cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js',
        'js/select2.min.js',
        'js/bootstrap-datepicker.js',
        'js/jquery.snow.js',
        'js/swiper2.min.js',
        'js/swiper.init.js',
        'js/jquery.rotate.js',
        '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
        'js/customers/go_functions.js',
		'js/functions21.js',
        'js/yii.js',
        'js/yii.activeForm.js',
		'js/jquery.plugin.js',
        // 'js/jquery.countdown.js',
        'js/jquery.elevatezoom.js',
        'js/owl.carousel.js',
        'js/jquery.jcarousellite.js',
        'js/owl.init.js',
        // 'js/jq-timeTo/jquery.time-to.js',
        //'http://code.jquery.com/jquery-1.7.1.min.js',
        'js/countdown/jquery.countdown.js',
		'https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.0/jquery.nicescroll.min.js',
        'js/wishlist.js',
        'js/payment/payment.js'
    ];
    public $depends = [
//        'yii\web\YiiAsset',
    ];
    public $jsOptions = [
        // 'async' => 'async',
    ];
}
