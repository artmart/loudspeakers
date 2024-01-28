<?php
namespace backend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/site.css',
        'vendor/font-awesome/css/font-awesome.min.css',
        'vendor/iCheck/skins/flat/green.css',	
        'build/css/custom.css',
    ];
    public $js = [
        "vendor/bootstrap-progressbar/bootstrap-progressbar.min.js",
        //<!-- iCheck -->
        "vendor/iCheck/icheck.min.js",
        "build/js/custom.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap5\BootstrapAsset',
        'yii\bootstrap5\BootstrapPluginAsset',
    ];
    public $jsOptions = [ 'position' => \yii\web\View::POS_END ];
}