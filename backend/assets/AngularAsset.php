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
    public $sourcePath = '@bower';
    public $js = [
        'angular/angular.js',
        'angular-route/angular-route.js',
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
}