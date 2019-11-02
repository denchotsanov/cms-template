<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
use backend\assets\AppAsset;


AppAsset::register($this);

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" ng-app="backend">
<head>
    <script>paceOptions = {ajax: {trackMethods: ['GET', 'POST']}};</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/red/pace-theme-minimal.css" rel="stylesheet" />

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script type="text/javascript">
        var webroot = <?php echo json_encode( Yii::$app->request->baseUrl) ?>;
        var fullroot = <?php echo json_encode( Yii::$app->request->baseUrl) ?>;
    </script>
</head>
<body class="hold-transition sidebar-mini layout-fixed" ng-controller="MainController">
<?php $this->beginBody() ?>

<div class="wrapper">
    <?php echo $this->render('_header'); ?>
    <?php echo $this->render('_sidebar' ); ?>
    <?= $this->render('_content', ['content'=>$content]); ?>

    <?= $this->render('_contentFooter'); ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
