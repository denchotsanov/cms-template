<?php

use common\models\User;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $model \common\models\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index box box-primary" ng-controller="UsersController">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <a href="#" class="btn btn-success btn-flat" ng-click="openPopup()">Create user</a>

    </div>
    <div class="box-body table-responsive no-padding">
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
    </div>
    <?php Pjax::end(); ?>
</div>