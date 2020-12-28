<?php

/**
 * Created by PhpStorm.
 * User: DTSHOME
 * Date: 8/2/2019
 * Time: 01:23 ч.
 */

/* @var $this \yii\web\View */

use denchotsanov\assets\widgets\Menu;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$menuItems = Yii::$app->params['menuItems'];
$items = ArrayHelper::merge(
    [
        [
            'label' => Yii::t('backend', 'Dashboard'),
            'url' => Url::to(['site/index']),
            'icon' => 'fas fa-tachometer-alt'
        ]
    ],
    $menuItems,
    [
        [
            'label' => Yii::t('backend', 'Sing out'),
            'url' => ['/logout'],
            'visible' => !Yii::$app->user->isGuest,
            'icon' => 'fas fa-sign-out-alt'
        ]
    ],
    !YII_ENV_DEV ? [] : [
        [
            'label' => 'Menu Yii2',
            'options' => ['class' => 'nav-header'],
            'visible' => YII_ENV_DEV,
        ],
        [
            'label' => 'Gii',
            'url' => ['/gii'],
            'icon' => 'fas fa-gavel',
            'visible' => YII_ENV_DEV,
            'pjax' => true
        ],
        [
            'label' => 'Debug',
            'url' => ['/debug'],
            'visible' => YII_ENV_DEV,
            'icon' => 'fas fa-bug'
        ]
    ]
);
$user = Yii::$app->user->identity->getUserInfo();
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <?= Html::a(
        Html::img('@web/img/AdminLTELogo.png',
            ['alt' => 'Admin Logo', 'class' => 'brand-image img-circle elevation-3', 'style' => 'opacity:0.8;']) .
        '<span class="brand-text font-weight-light">ADmign</span>',
        Url::home(),
        ['class' => 'brand-link']
    ); ?>
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel  mt-3 pb-3 mb-3 d-flex">
            <div class="pull-left image">
                <?= Html::img($user['avatar'], [
                    'class' => 'img-circle elevation-2',
                    'alt' => Yii::t('backend', 'User Image')
                ]); ?>
            </div>
            <div class="pull-left info">
                <?= Html::a(
                    $user['username'],
                    '#',
                    ['class' => 'd-block']
                ); ?>
            </div>
        </div>
        <nav class="mt-2">
            <?= Menu::widget(['items' => $items]); ?>
        </nav>
    </section>
    <!-- /.sidebar -->
</aside>
