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
class VeritransAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/jquery.fancybox.css',
    ];
    public $js = [
        '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js',
//        'https://api.sandbox.veritrans.co.id/v2/assets/js/veritrans.min.js',
        'https://api.veritrans.co.id/v2/assets/js/veritrans.min.js',
        'js/jquery.fancybox.pack.js',
		'https://cdn.vospay.id/sdk/v1/vospay-sdk.js'
    ];
    public $depends = [
//        'yii\web\YiiAsset',
    ];
}
