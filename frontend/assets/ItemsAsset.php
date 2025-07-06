<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class ItemsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        
        'css/lsdb.css',	
        'css/search.css',
        'css/card.css',
        'css/graph.css',
        'css/carousel.css',
        'css/dropdown.css',
        'css/nouislider.min.css'
    ];
    public $js = [
        'js/lsdb.js',
        'js/highlight.js',
        'js/card.js',
        'js/echarts.common.min.js',
        'js/graph.js',
        'js/inf_baffle.js',
        'js/dropdown.js',
        'js/nouislider.min.js',
        'js/search.js',
        
        
        
        //'js/dropdown.js',
        
        
        
        //"vendor/bootstrap-progressbar/bootstrap-progressbar.min.js",
        //<!-- iCheck -->
        //"vendor/iCheck/icheck.min.js",
        //"build/js/custom.js",
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\web\JqueryAsset',
        //'yii\bootstrap4\BootstrapAsset',
        //'yii\bootstrap4\BootstrapPluginAsset',
    ];
    public $jsOptions = [ 'position' => \yii\web\View::POS_END ];
}