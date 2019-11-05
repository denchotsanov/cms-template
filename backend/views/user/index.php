<?php

use common\models\User;
use yii\bootstrap4\Html;
use yii\grid\GridView;
use yii\helpers\Url;
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
                                        return $model->profile->name . ' ( ' . $model->email . ' )';
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
                                'template' => '{update}{delete}',
                                'buttons' => [
                                    'update' => function ($url, $model, $key) {
                                        return Html::a('<span class="fas fa-pen"></span> ' . Yii::t('admin', 'Edit'),
                                            $url, ['class' => 'btn btn-info btn-sm']);
                                    },
                                    'delete' => function ($url, $model, $key) {
                                        return Html::a('<span class="fas fa-trash"></span> ' . Yii::t('admin',
                                                'Delete'), $url, ['class' => 'btn btn-danger btn-sm']);
                                    },
                                ]
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
                        <?= Html::button('<i class="fas fa-plus"></i>Create',
                            [
                                'value' => Url::to(['user/create']),
                                'title' => 'Create New User',
                                'class' => 'showModalButton btn btn-app'
                            ]); ?>
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>