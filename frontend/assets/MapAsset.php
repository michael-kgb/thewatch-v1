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
class MapAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/jquery.qtip.css',
    ];
    public $js = [
        '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js',
        'js/raphael-min.js',
        'js/jquery.mapael.js',
        'js/indonesia.js',
        'js/jquery.qtip.js',
        'js/map.init.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
