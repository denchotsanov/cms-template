<?php
/*
 * @author Dencho Tsanov <dencho@tsanov.eu>
 * @licence MIT License
 * @copyright Copyright (c) 2021. Dencho Tsanov. All rights reserved.
 */

/* @var $this View */

/* @var $content string */

use yii\bootstrap4\Modal;
use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\web\View;

AppAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <script>paceOptions = {ajax: {trackMethods: ['GET', 'POST']}};</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/red/pace-theme-minimal.css" rel="stylesheet"/>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head(); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed dark-mode layout-footer-fixed">
<?php $this->beginBody() ?>
<div class="wrapper">
    <?= $this->render('_header'); ?>
    <?= $this->render('_sidebar'); ?>
    <?= $this->render('_content', ['content' => $content]); ?>
    <?= $this->render('_contentFooter'); ?>
    <?= $this->render('_controlSidebar'); ?>
</div>
<?php Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modal',
    'size' => 'modal-lg',
    'clientOptions' => [
        'backdrop' => 'static',
        'keyboard' => true
    ]
]);
echo "<div id='modal-content-details'>";
echo "    <div style='text-align:center'>";
echo "        <i class='fa fa-refresh fa-spin fa-1x fa-fw'></i>" . Yii::t('app',
        'Loading Data...');
echo "    </div>";
echo "</div>";
Modal::end();
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
