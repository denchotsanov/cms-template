<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        '//fonts.googleapis.com/css?family=Ubuntu:300,400,400i,700',
    ];
    public $js = [
        'js/app.js',
        'controllers/Users,js',
        'controllers/Main,js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'backend\assets\FlagsAsset',
        'backend\assets\AngularAsset',
        'denchotsanov\assets\assets\AdminAsset'
    ];
}
