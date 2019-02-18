<?php

/**
 * Created by PhpStorm.
 * User: DTSHOME
 * Date: 8/2/2019
 * Time: 01:23 ч.
 */

/* @var $this \yii\web\View */

use denchotsanov\widgets\Menu;

$menuItems = [
    [
        'label' => 'Users',
        'icon' => 'user',
        'items' => [
            [
                'label' => 'Users',
                'url' => ['/user'],
                'icon' => 'user',
            ],
            [
                'label' => 'Role',
                'url' => ['/rbac'],
                'icon' => 'link',
            ],
        ]
    ],
    [
        'label' => 'Sing out',
        'url' => ['/logout'],
        'visible' => !Yii::$app->user->isGuest,
        'icon' => 'sign-out'],
    [
        'label' => 'Menu Yii2',
        'options' => ['class' => 'header'],
        'visible' => YII_ENV_DEV,
    ],
    [
        'label' => 'Gii',
        'url' => ['/gii'],
        'icon' => 'gavel',
        'visible' => YII_ENV_DEV,
        'pjax' => true],
    [
        'label' => 'Debug',
        'url' => ['/debug'],
        'visible' => YII_ENV_DEV,
        'icon' => 'bug'],
];

?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{user.avatar}}" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>{{user.username}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <?php try {
            echo Menu::widget([
                'items' => $menuItems]);
        } catch (Exception $e) {

        } ?>
    </section>
    <!-- /.sidebar -->
</aside>