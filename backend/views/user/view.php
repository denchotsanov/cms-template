<?php
/*
 * @author Dencho Tsanov <dencho@tsanov.eu>
 * @licence MIT License
 * @copyright Copyright (c) 2021. Dencho Tsanov. All rights reserved.
 */

use yii\bootstrap4\Html;
use yii\bootstrap4\Tabs;
use yii\helpers\Url;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $user array */
/* @var $profile common\models\UserProfile */

$this->title = 'User profile: ' . $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->email;
$directoryAsset = Url::to('@web');

$profile = $model;
$this->registerJs(<<<JS
$('#tabs').on('click','.nav-link',function (e) {
    e.preventDefault();
    var url = $(this).attr("data-url");
    if (typeof url !== "undefined") {
        var pane = $(this), href = this.hash;
        $(href).load(url,function(result){      
            pane.tab('show');
        });
    } else {
        $(this).tab('show');
    }
});
$(document).ready(function() {
   $('#tabs .nav-link.active').trigger('click');
});

JS
,View::POS_END);
?>

<section>
    <div class="row">
        <div class="col-sm-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <?php echo Html::img($user['avatar'],
                            ['class' => 'profile-user-img img-fluid img-circle', 'alt' => 'User profile picture']) ?>
                    </div>
                    <?php echo Html::tag('h3', $user['email'], ['class' => 'profile-username text-center']); ?>
                    <?php echo Html::tag('p', $user['username'], ['class' => 'text-muted text-center']); ?>
                    <!--                    TODO: тук да се добави статисктиа за потребител. -->
                    <!--                    <ul class="list-group list-group-unbordered">-->
                    <!--                        <li class="list-group-item">-->
                    <!--                            <b>Followers</b> -->
                    <!--                            <a class="pull-right">0</a>-->
                    <!--                        </li>-->
                    <!--                    </ul>-->

                    <a href="#" class="btn btn-danger btn-block btn-flat"><b>Block User</b></a>
                    <a href="#" class="btn btn-primary btn-block btn-flat"><b>Reset Password</b></a>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="card card-primary card-outline card-outline-tabs">
                <?php echo Tabs::widget([
                    'items' => [
                        [
                            'label' => Yii::t('backend','Settings'),
                            'content' => '',
                            'active' => true,
                            'linkOptions' => ['data'=>['url'=>Url::to(['user/update-profile'])]],
                        ],
                        [
                            'label' => Yii::t('backend','Avatar'),
                            'content' => '',
                            'linkOptions' => ['data'=>['url'=>Url::to(['user/update-avatar'])]],
                        ],

                    ],
                    'options' => [
                            'id'=>'tabs',
                            'class' => 'card-header p-0 border-bottom-0'
                    ],
                    'headerOptions' => ['class' => ''],
                    'tabContentOptions' => ['class' => 'card-body'],


                ]); ?>
            </div>
        </div>
    </div>
</section>
