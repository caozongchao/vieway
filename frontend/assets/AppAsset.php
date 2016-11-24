<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/default';
    public $css = [
        'css/animate.css',
        'css/icomoon.css',
        // 'css/bootstrap.css',
        'css/owl.carousel.min.css',
        'css/owl.theme.default.min.css',
        'css/style.css',
    ];
    public $js = [
        'js/modernizr-2.6.2.min.js',
        'js/jquery.easing.1.3.js',
        'js/owl.carousel.min.js',
        'js/jquery.stellar.min.js',
        'js/jquery.waypoints.min.js',
        'js/jquery.countTo.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
