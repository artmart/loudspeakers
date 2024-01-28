<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class PublicAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        //'vendor/font-awesome/css/font-awesome.min.css',
        //'vendor/iCheck/skins/flat/green.css',	
        //'build/css/custom.css',
         
    ];
    public $js = [
        //"vendor/bootstrap-progressbar/bootstrap-progressbar.min.js",
        //<!-- iCheck -->
        //"vendor/iCheck/icheck.min.js",
        //"build/js/custom.js",

        "js/jquery.validate.min.js",
        "js/gauge.min.js",  
        //"js/popper.min.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap5\BootstrapAsset',
        'yii\bootstrap5\BootstrapPluginAsset',
    ];
    public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD ];
}