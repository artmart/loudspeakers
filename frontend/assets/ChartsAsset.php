<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class ChartsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
   /* public $css = [
        //'css/site.css',
        'vendor/font-awesome/css/font-awesome.min.css',
        'vendor/iCheck/skins/flat/green.css',	
        'build/css/custom.css',
    ];*/
    public $js = [
        //"vendor/chart.js/dist/Chart.bundle.min.js",
        "vendor/highcharts/highcharts.js",
        "vendor/highcharts/exporting.js",
        "vendor/highcharts/export-data.js",
    ];
   /* public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
    ];*/
    public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD ];
}