<?php
/**
 * User: dencho
 */

namespace backend\assets;


use yii\web\AssetBundle;

class FlagsAsset extends AssetBundle
{
    public $sourcePath = '@bower/flag-icon-css';
    public $css = [
        'css/flag-icon.css'
    ];

}