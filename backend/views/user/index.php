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
<div class="user-index">
    <div class="row">
        <div class="col-9">
            <div class="card card-orange card-outline card-tabs">
                <div class="card-header with-border"></div>
                <div class="card-body table-responsive no-padding">
                    <?php Pjax::begin(); ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'layout' => "{items}\n{summary}\n{pager}",
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => 'email',
                                'filter' => true,
                                'format' => 'raw',
                                'value' => function ($model) {
                                    if ($model->profile) {
                                        return  $model->profile->name . ' ( ' .   $model->email. ' )';
                                    } else {
                                        return $model->email;
                                    }

                                },
                            ],
                            [
                                'attribute' => 'status',
                                'filter' => User::getStatusList(),
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return $model->htmlStatusLabel;
                                },
                            ],
                            'created_at:date',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{update}{delete}'
                            ],
                        ],

                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card card-lime card-outline card-tabs">
                <div class="card-body">
                    <div class="row">
                        <a href="#" class="btn btn-app">
                            <i class="fas fa-plus"></i>Create
                        </a>
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>