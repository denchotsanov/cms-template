<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model backend\models\PasswordResetRequestForm */


//$this->context->layout = '@vendor/denchotsanov/yii2-admin-assets/views/layouts/login';
$this->title = 'Forgot Password';
$fieldOptions1 = [
    'options' => ['class' => 'input-group mb-3 '],
    'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>'
];
?>

<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="#" class="h1"><b>AD</b>min</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'enableAjaxValidation' => true,
            ]); ?>
            <?php echo $form->field($model, 'email', $fieldOptions1)->textInput([
                'autofocus' => true,
                'placeholder' => $model->getAttributeLabel('email')
            ])->label(false) ?>

            <div class="row">
                <div class="col-12">
                    <?php echo Html::submitButton('Request new password',
                        ['class' => 'btn btn-primary btn-block ', 'name' => 'request-button']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <p class="mt-3 mb-1">
                <a href="<?= Url::to(['site/login']) ?>">Login</a>
            </p>
        </div>
    </div>
</div>
