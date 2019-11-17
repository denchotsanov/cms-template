<?php

use denchotsanov\assets\widgets\Menu;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$menuItems = Yii::$app->params['menuList'];
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= Yii::$app->homeUrl; ?>" class="brand-link">
        <?php echo Html::img('@web/img/cms.png',
            [
                'class' => 'brand-image elevation-3',
                'alt' => 'CMS Logo',
                'style' => 'opacity: .8;border-radius: 10%;background: #ffffff85;'
            ]); ?>
        <span class="brand-text font-weight-light">
            <?php echo Html::encode(Yii::$app->name); ?>
        </span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo Yii::$app->user->identity->userAvatarUrl; ?>" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="<?php echo Url::to(['/user/update/' . Yii::$app->user->id]); ?>"
                   class="d-block"><?php echo Yii::$app->user->identity->email; ?></a>
            </div>

        </div>
        <nav class="mt-2">
            <?php
            echo Menu::widget([
                'items' => $menuItems
            ]);
            ?>
        </nav>
        <div class="mt-1">
            <?php
            echo Menu::widget([
                'items' => [
                    [
                        'options' => ['class' => 'nav-header'],
                    ],
                    [
                        'label' => 'Sing out',
                        'url' => ['/logout'],
                        'visible' => !Yii::$app->user->isGuest,
                        'icon' => 'fas fa-sign-out-alt'
                    ],
                ]
            ]);
            ?>
        </div>
    </div>
</aside>