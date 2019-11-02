<?php

/* @var $this \yii\web\View */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;
$fieldOptions1 = [
    'options' => ['class' => 'input-group mb-3'],
    'inputTemplate' => '{input}<div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>'
];
/* @var $model \common\models\PasswordResetRequestForm */
?>
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>AD</b>min</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                <?php echo Yii::t('admin','You forgot your password? Here you can easily retrieve a new password.')?></p>

            <?php $form = ActiveForm::begin(['id' => 'request-form', 'enableClientValidation' => false]); ?>
            <?php echo $form->field($model, 'email',$fieldOptions1)
                ->textInput([
                    'autofocus' => true,
                    'placeholder' => $model->getAttributeLabel('username')
                ])
                ->label(false); ?>
                <div class="row">
                    <div class="col-12">
                        <?php echo Html::submitButton(
                                Yii::t('admin','Request new password') ,
                                ['class' => 'btn btn-primary btn-block']); ?>
                    </div>
                    <!-- /.col -->
                </div>

                <?php ActiveForm::end(); ?>

            <p class="mt-3 mb-1">
                <?php echo Html::a(
                    Yii::t('admin','Login'),
                    Url::to(['site/login']),
                    ['class'=>'text-center']
                ); ?>
            </p>
            <p class="mb-0">
                <?php echo Html::a(
                    Yii::t('admin','Register a new membership'),
                    Url::to(['site/signup']),
                    ['class'=>'text-center']
                ); ?>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>