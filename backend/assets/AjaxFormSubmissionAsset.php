<?php
/*
 * @author Dencho Tsanov <dencho@tsanov.eu>
 * @licence MIT License
 * @copyright Copyright (c) 2021. Dencho Tsanov. All rights reserved.
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Class AjaxFormSubmissionAsset
 * @package backend\assets
 */
class AjaxFormSubmissionAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [
        'js/ajax-modal-popup.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
