<?php
/**
 * Created by PhpStorm.
 * User: DTSHOME
 * Date: 8/2/2019
 * Time: 01:23 ч.
 */

use denchotsanov\assets\widgets\Menu;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this \yii\web\View */

$temp = [
    [
        'label' => 'Dashboard',
        'icon' => 'fas fa-tachometer-alt',
        'url' => ['/site/index'],
    ],
    [
        'label' => 'Users',
        'icon' => 'fas fa-users',
        'items' => [
            [
                'label' => 'Users',
                'url' => ['/user'],
                'icon' => 'far fa-circle',
            ],
            [
                'label' => 'Role',
                'url' => ['/rbac/role'],
                'icon' => 'far fa-circle',
            ],
            [
                'label' => 'Route',
                'url' => ['/rbac/route'],
                'icon' => 'far fa-circle',
            ],
            [
                'label' => 'Permission',
                'url' => ['/rbac/permission'],
                'icon' => 'far fa-circle',
            ],
            [
                'label' => 'Rule',
                'url' => ['/rbac/rule'],
                'icon' => 'far fa-circle',
            ],
        ]
    ],
    [
        'label'=>'Translate',
        'icon' => 'fas fa-language',
        'url' => ['/translate'],
    ],
    [
        'label' => 'Sing out',
        'url' => ['/logout'],
        'visible' => !Yii::$app->user->isGuest,
        'icon' => 'fas fa-sign-out-alt'
    ],
];
$menuItems = ArrayHelper::merge($temp, Yii::$app->params['menuList']);

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
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
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo Yii::$app->user->identity->userAvatarUrl; ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?php echo Url::to(['/user/update/'.Yii::$app->user->id]); ?>" class="d-block"><?php echo Yii::$app->user->identity->email; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php try {
                echo Menu::widget([
                    'items' => $menuItems
                ]);
            } catch (Exception $e) {

            } ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>