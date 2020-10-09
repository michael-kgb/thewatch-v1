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
class PromoAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/owl.carousel.css',
        'css/owl.theme.css',
        'http://vjs.zencdn.net/6.8.0/video-js.css',
    ];
    public $js = [
		'web/js/clipboard.min.js',
		'web/js/clipboard.js',
        '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js',
        'js/owl.carousel.js',
        'js/jquery.jcarousellite.js',
        'js/promo/owl.init.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
