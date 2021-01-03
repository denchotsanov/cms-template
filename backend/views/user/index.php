<?php
/*
 * @author Dencho Tsanov <dencho@tsanov.eu>
 * @licence MIT License
 * @copyright Copyright (c) 2021. Dencho Tsanov. All rights reserved.
 */

use backend\assets\AjaxFormSubmissionAsset;
use common\models\User;
use yii\bootstrap4\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $model \backend\models\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

AjaxFormSubmissionAsset::register($this);

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-9">
                <div class="card card-outline card-primary">
                    <div class="card-body table-responsive no-padding">
                        <div class="dataTables_wrapper dt-bootstrap4">
                            <?php Pjax::begin(['id' => 'id-index-items']); ?>
                            <?php echo GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'layout' => "\n{items}\n{summary}\n{pager}",
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                        'attribute' => 'username',
                                        'filter' => true,
                                        'format' => 'raw',
                                        'value' => function ($model) {
                                            if (isset($model->userProfile)) {
                                                return $model->username . ' ( ' . $model->userProfile->fullname . ' )';
                                            }
                                            return '<b>' . Html::a($model->username, false,
                                                    [
                                                        'title' => Yii::t('backend', 'Edit User'),
                                                        'data' => [
                                                            'url-submission' => Url::to([
                                                                'update',
                                                                'id' => $model->id
                                                            ], true)
                                                        ],
                                                        'class' => 'showModalButton',
                                                        'style' => 'cursor:pointer;'
                                                    ]).'</b>';
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
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{update}{delete}',
                                        'buttons' => [
                                            'update' => function ($url, $model, $key) {
                                                return Html::a('Update', $url);
                                            },
                                            'delete' => function ($url, $model, $key) {
                                                return Html::a('Delete', $url);
                                            }
                                        ],

                                    ],
                                ],
                            ]); ?>
                            <?php Pjax::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card card-outline card-secondary">
                    <div class="card-body">
                        <?php echo Html::a('<i class="fa fa-plus"></i> Create', false, [
                            'data' => [
                                'url-submission' => Url::to(['user/create'])
                            ],
                            'title' => 'Creating New User',
                            'class' => 'showModalButton btn btn-app btn-flat'
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
