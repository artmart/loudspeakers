<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/site.css',
        'css/nouislider.min.css',
        'vendor/font-awesome/css/font-awesome.min.css',
        'vendor/iCheck/skins/flat/green.css',	
        'build/css/custom.css',
        'vendor/bootstrap-select/dist/css/bootstrap-select.min.css' 
    ];
    public $js = [
        "vendor/bootstrap-progressbar/bootstrap-progressbar.min.js",
        //<!-- iCheck -->
        "vendor/iCheck/icheck.min.js",
        "build/js/custom.js",
        'vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
        'js/nouislider.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
    ];
    public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD ];
}