<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';
$fieldOptions1 = [
    'options' => ['class' => 'input-group mb-3'],
    'inputTemplate' => '{input}<div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>'
];
$fieldOptions2 = [
    'options' => ['class' => 'input-group mb-3'],
    'inputTemplate' => '{input}<div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>'
];

$checkboxOptions = [
    'options'=> ['class'=>'icheck-primary'],
    'checkTemplate' =>'{input}{label}'
];

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>AD</b>min</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Login to continue</p>
            <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>
            <?php echo $form->field($model, 'email',$fieldOptions1)
                ->textInput([
                    'autofocus' => true,
                    'placeholder' => $model->getAttributeLabel('username')
                ])
                ->label(false); ?>
            <?php echo $form->field($model, 'password',$fieldOptions2)->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>
            <div class="row">
                <div class="col-8">
                    <?php echo $form->field($model, 'rememberMe')->checkbox() ?>
                </div>
                <div class="col-4">
                    <?php echo Html::submitButton('Sign in', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
<!--            <div class="social-auth-links text-center mb-3">-->
<!--                <p>- OR -</p>-->
<!--                <a href="#" class="btn btn-block btn-primary">-->
<!--                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook-->
<!--                </a>-->
<!--                <a href="#" class="btn btn-block btn-danger">-->
<!--                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+-->
<!--                </a>-->
<!--            </div>-->

            <p class="mb-1">
                <?php echo Html::a(
                    Yii::t('admin','I forgot my password'),
                    Url::to(['site/request-password-reset']),
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
</div><!-- /.login-box -->


