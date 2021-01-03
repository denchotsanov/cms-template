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
                <div class="box box-primary">
                    <div class="box-header with-border"></div>
                    <div class="box-body table-responsive no-padding">
                        <?php Pjax::begin(['id'=>'id-index-items']); ?>
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
                                        if (isset($model->userProfile)) {
                                            return $model->username . ' ( ' . $model->userProfile->fullname . ' )';
                                        }

                                        return $model->username;
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
            <div class="col-sm-3">
                <div class="box box-default">
                    <div class="box-body">
                        <?php echo Html::a('<i class="fa fa-plus"></i> Create', false, [
                            'data'  => [
                                'url-submission' => Url::to(['user/create'])
                            ],
                            'title' => 'Creating New User',
                            'class' => 'showModalButton btn btn-app btn-flat']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
