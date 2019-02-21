<?php
/**
 * Created by PhpStorm.
 * User: DTSHOME
 * Date: 17/2/2019
 * Time: 11:23 ч.
 */

namespace backend\assets;


use yii\web\View;
use yii\web\AssetBundle;

class AngularAsset extends AssetBundle
{
    public $sourcePath = '@vendor/../node_modules';
    public $js = [
        'angular/angular.js',
        'angular-route/angular-route.js',
        'angular-aria/angular-aria.js',
        'angular-material/angular-material.js',
        'angular-animate/angular-animate.js',
        'angular-touch/angular-touch.js',
        'angular-sanitize/angular-sanitize.js',
        'angular-messages/angular-messages.js',

    ];
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
}