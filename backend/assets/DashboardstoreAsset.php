<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DashboardstoreAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
	
		'themes/abstack/plugins/datatables/dataTables.bootstrap4.min.css',
		'themes/abstack/plugins/datatables/buttons.bootstrap4.min.css',
		'themes/abstack/plugins/datatables/responsive.bootstrap4.min.css',
		
		'themes/abstack/plugins/bootstrap-select/css/bootstrap-select.min.css',
		'themes/abstack/plugins/select2/css/select2.min.css',
		
        'themes/abstack/css/bootstrap.min.css',
        'themes/abstack/css/icons.css',
		'themes/abstack/css/metismenu.min.css',
		'themes/abstack/css/style.css',
		'themes/abstack/plugins/jquery-toastr/jquery.toast.min.css',
    ];
    
    public $js = [
        'themes/abstack/js/modernizr.min.js',
		'themes/abstack/js/jquery.min.js',
		'themes/abstack/js/popper.min.js',
		'themes/abstack/js/bootstrap.min.js',
		'themes/abstack/js/metisMenu.min.js',
		'themes/abstack/js/waves.js',
		'themes/abstack/js/jquery.slimscroll.js',
		'themes/abstack/plugins/jquery-toastr/jquery.toast.min.js',
		
		'themes/abstack/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js',
		
		'themes/abstack/plugins/select2/js/select2.min.js',
		'themes/abstack/plugins/bootstrap-select/js/bootstrap-select.js',
		
		'themes/abstack/plugins/datatables/jquery.dataTables.min.js',
		'themes/abstack/plugins/datatables/dataTables.bootstrap4.min.js',
		
		'themes/abstack/plugins/datatables/dataTables.buttons.min.js',
		'themes/abstack/plugins/datatables/buttons.bootstrap4.min.js',
		'themes/abstack/plugins/datatables/jszip.min.js',
		'themes/abstack/plugins/datatables/pdfmake.min.js',
		'themes/abstack/plugins/datatables/vfs_fonts.js',
		'themes/abstack/plugins/datatables/buttons.html5.min.js',
		'themes/abstack/plugins/datatables/buttons.print.min.js',
		'themes/abstack/plugins/datatables/dataTables.responsive.min.js',
		'themes/abstack/plugins/datatables/responsive.bootstrap4.min.js',
		
		'themes/abstack/plugins/waypoints/lib/jquery.waypoints.min.js',
		'themes/abstack/plugins/counterup/jquery.counterup.min.js',
		'themes/abstack/js/jquery.core.js',
		'themes/abstack/js/jquery.app.js',
		
		'themes/abstack/js/datatable.init.js',
    ];
    
    public $depends = [
        //'yii\web\YiiAsset'
    ];
}
