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
class VueAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js',
        'https://unpkg.com/vue@2.6.10/dist/vue.js',
        'https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.js',
        'js/vuejs-datatable/vuejs-datatable.js',
        'js/vue-brand-index.js',
        'js/vue-raffle-index.js',
        'js/vue-raffle-verifikator.js'
    ];

    public $css=[

        'https://cdnjs.cloudflare.com/ajax/libs/TableExport/3.3.13/css/tableexport.css'
 
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
