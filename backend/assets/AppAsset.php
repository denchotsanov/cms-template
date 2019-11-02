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
        '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700',
        '//fonts.googleapis.com/css?family=Ubuntu:300,400,400i,700',
    ];
    public $js = [
        'js/app.js',
        'js/controllers/Main.js',
        'js/controllers/Users.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'backend\assets\AngularAsset',
        'backend\assets\AngularUIAsset',
    ];
}
