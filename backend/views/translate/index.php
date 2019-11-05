<?php
/* @var $this \yii\web\View */
/* @var $searchModel \backend\models\LanguageSearch */

/* @var $dataProvider \yii\data\ActiveDataProvider */

use yii\bootstrap4\Html;
use yii\grid\GridView;
use yii\widgets\Pjax; ?>
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
                                'attribute' => 'flag',
                                'label' => Yii::t('admin','Flag'),
                                'format' => 'html',
                                'value' => function($model){
                                    return '<span class="flag-icon flag-icon-'.$model->flag.'"></span>';
                                }
                            ],
                            'name',
                            [
                                'attribute' => 'name',
                                'label' => Yii::t('admin', 'Progress'),
                                'format' => 'raw',
                                'value' => function () {
                                    return '<div class="progress progress-xs"><div class="progress-bar bg-warning" style="width: 75%"></div></div><span class="badge bg-warning">75%</span>';
                                }
                            ],
//                            [],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{view}',
                                'buttons' => [
                                    'view' => function ($url, $model, $key) {
                                        return Html::a('<span class="fas fa-pen"></span> ' . Yii::t('admin', 'View'),
                                            $url, ['class' => 'btn btn-info btn-sm']);
                                    }
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
                        <a href="#" class="btn btn-app">
                            <i class="fas fa-plus"></i>
                            <?php echo Yii::t('admin', 'Language') ?>
                        </a>
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>