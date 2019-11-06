<?php
namespace backend\assets;

use yii\web\AssetBundle;

class AngularAsset extends AssetBundle
{
    public $sourcePath = '@bower';
    public $css = [
        'angular/angular-csp.css',
        'angular-material/angular-material.css',
    ];
    public $js =[
        'angular/angular.js',
        'angular-material/angular-material.js',
        'angular-animate/angular-animate.js',
        'angular-aria/angular-aria.js',
        'angular-messages/angular-messages.js',
        'angular-sanitize/angular-sanitize.js',
    ];
    public $depends = [];

}