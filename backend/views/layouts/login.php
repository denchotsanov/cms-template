<?php
/**
 * Created by PhpStorm.
 * User: DTSHOME
 * Date: 7/2/2019
 * Time: 08:02 ч.
 */

use denchotsanov\assets\AdminAsset;
use backend\assets\AppAsset;
use yii\helpers\Html;

AdminAsset::register($this);
AppAsset::register($this);

$this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" ng-app="app">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="login-page">

    <?php $this->beginBody() ?>

    <?php echo $content ?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>