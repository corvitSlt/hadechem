<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
		'css/subbootstrap.css',
		'css/ionicons.min.css',
		'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.css',
		'plugins/select2/css/select2.css',
		'plugins/datatables-bs4/css/dataTables.bootstrap4.css',
		'plugins/icheck-bootstrap/icheck-bootstrap.min.css',
		'plugins/jqvmap/jqvmap.min.css',
		'dist/css/adminlte.css',
		'plugins/overlayScrollbars/css/OverlayScrollbars.css',
		'plugins/daterangepicker/daterangepicker.css',
		'plugins/summernote/summernote-bs4.css',
		'css/fonts.css',
		'css/corvicon.css',
		'css/all.css',
		'css/site.css',
		'css/fileinput.css',
		'css/transaction.css',
    ];
    public $js = [
		'plugins/jquery-ui/jquery-ui.min.js',
		'plugins/bootstrap/js/bootstrap.bundle.js',
		'plugins/select2/js/select2.js',
		'plugins/bootstrap/js/bootstrap-select.js',
		'plugins/chart.js/Chart.min.js',
		'plugins/sparklines/sparkline.js',
		'plugins/jqvmap/jquery.vmap.min.js',
		'plugins/jqvmap/maps/jquery.vmap.usa.js',
		'plugins/jquery-knob/jquery.knob.min.js',
		'plugins/moment/moment.min.js',
		'plugins/moment/locale/id.js',
		'plugins/inputmask/jquery.inputmask.bundle.js',
		'plugins/daterangepicker/daterangepicker.js',
		'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js',
		'plugins/summernote/summernote-bs4.min.js',
		'plugins/datatables/jquery.dataTables.js',
		'plugins/datatables-bs4/js/dataTables.bootstrap4.js',
		'plugins/overlayScrollbars/js/jquery.overlayScrollbars.js',
		'dist/js/adminlte.js',
		'dist/js/pages/dashboard.js',
		'dist/js/sidbar-setting.js',
		'js/site.js',
		'js/transaction.js',
		'js/fileinput.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
