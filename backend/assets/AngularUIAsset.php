<?php
/**
 * Created by PhpStorm.
 * User: DTSHOME
 * Date: 19/2/2019
 * Time: 08:44 ч.
 */

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class AngularUIAsset extends AssetBundle
{
    public $sourcePath = '@vendor/npm-asset';
    public $js = [
        'ui-bootstrap4/dist/ui-bootstrap.js',
        'ui-bootstrap4/dist/ui-bootstrap-tpls.js',
        ];
    public $css = [
        'ui-bootstrap4/dist/ui-bootstrap-csp.css',
    ];

}