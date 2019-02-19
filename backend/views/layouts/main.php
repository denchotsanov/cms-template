<?php

/* @var $this \yii\web\View */
/* @var $content string */


use denchotsanov\assets\AdminAsset;
use yii\helpers\Html;

use backend\assets\AppAsset;
use backend\assets\AngularUIAsset;

AppAsset::register($this);
AdminAsset::register($this);
AngularUIAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" ng-app="app">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini" ng-controller="MainController">
<script>
    window.user = <?php echo Yii::$app->user->identity->getUserInfo(true); ?>;
</script>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php echo $this->render('_header'); ?>

    <?= $this->render('_sidebar' ); ?>

    <?= $this->render('_content', ['content'=>$content]); ?>

    <?= $this->render('_contentFooter'); ?>

    <?= $this->render('_controlSidebar'); ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
