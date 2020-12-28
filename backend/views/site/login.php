<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';
$fieldOptions1 = [
    'options' => ['class' => 'input-group mb-3 has-feedback'],
    'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>'
];
$fieldOptions2 = [
    'enableAjaxValidation'=>false,
    'options' => ['class' => 'input-group mb-3 has-feedback'],
    'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>'
];

$checkBoxOptions = [
    'template' => '<div class="icheck-primary">{input}{label}{error}{hint}</div>'
];

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="#" class="h1"><b>AD</b>min</a>
        </div>
        <div class="card-body">
            <!-- /.login-logo -->
            <p class="login-box-msg">Login to continue</p>
            <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'enableAjaxValidation' => true,
            ]); ?>
            <?php echo $form->field($model, 'email', $fieldOptions1)->textInput([
                'autofocus' => true,
                'placeholder' => $model->getAttributeLabel('email')
            ])->label(false) ?>
            <?php echo $form->field($model, 'password',
                $fieldOptions2)->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>



            <div class="row">
                <div class="col-8">
                    <?php echo $form->field($model, 'rememberMe', $checkBoxOptions)->input('checkbox') ?>

                </div>

                <div class="col-4">
                    <?php echo Html::submitButton('Sign in',
                        ['class' => 'btn btn-primary btn-block ', 'name' => 'login-button']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <div class="row">
                <div class="col-12">
                    <a href="<?php echo Url::to(['site/password-reset']) ?>">I forgot my password</a><br>
                </div>
            </div>
        </div>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
