<?php

use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $model \common\models\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]);

        ?>

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
                       //if(!$model->userProfile)
                            return $model->username;
                        //return $model->username.' ( '.$model->userProfile->fullname.' )';
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
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>