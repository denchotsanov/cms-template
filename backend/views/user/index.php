<?php

use common\models\User;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $model \backend\models\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index" ng-controller="UsersController">
    <div class="col-sm-9">
        <div class="box box-primary">

            <div class="box-header with-border"> </div>
            <div class="box-body table-responsive no-padding">
                <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'layout' => "{items}\n{summary}\n{pager}",
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'username',
                            'filter' => true,
                            'format' => 'raw',
                            'value' => function ($model) {
//                       if(!$model->userProfile)
                                return $model->username;
//                        return $model->username.' ( '.$model->userProfile->fullname.' )';
                            },
                        ],
                        'email:email',
                        [
                            'attribute' => 'status',
                            'filter' => User::getStatusList(),
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->htmlStatusLabel;
                            },
                        ],
                        'created_at:date',
                        'updated_at:date',
                        ['class' => 'yii\grid\ActionColumn',
                            'template' => '{update}{delete}'],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="box box-default">
            <div class="box-body">
                <a href="#" class="btn btn-app btn-flat" ng-click="openPopup()">
                    <i class="fa fa-plus"></i>
                    Create
                </a>
            </div>
        </div>
    </div>
</div>