<?php
/**
 * Created by PhpStorm.
 * User: DTSHOME
 * Date: 7/2/2019
 * Time: 23:13 ч.
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;


$this->title = 'Sign up';
$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];
$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];
$fieldOptions3 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
$fieldOptions4 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-log-in form-control-feedback'></span>"
];
$fieldOptions5 = [

];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="register-box">
    <div class="register-logo">
        <a href="#"><b>AD</b>min</a>
    </div>
    <!-- /.login-logo -->
    <div class="register-box-body">
        <p class="register-box-msg"></p>
        <?php
        $form = ActiveForm::begin(['id' => 'register-form', 'enableClientValidation' => true, 'action' => '']);

        echo $form
            ->field($model, 'fullname',$fieldOptions1)
            ->textInput([
                'autofocus' => true,
                'placeholder' => $model->getAttributeLabel('fullname')
            ])
            ->label(false);
        echo $form
            ->field($model, 'email',$fieldOptions2)
            ->label(false)
            ->textInput([
                'autofocus' => true,
                'placeholder' => $model->getAttributeLabel('email')
            ]);
        echo $form
            ->field($model, 'password',$fieldOptions3)
            ->label(false)
            ->passwordInput([
                'placeholder' => $model->getAttributeLabel('password')
            ]);
        echo $form
            ->field($model, 'confirmPassword',$fieldOptions4)
            ->label(false)
            ->passwordInput([
                'placeholder' => $model->getAttributeLabel('confirmPassword')
            ]);
        ?>
       <div class="row">
            <div class="col-xs-8">

            </div>
            <div class="col-xs-4">
                <?php echo Html::submitButton('Sign up', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'register-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
                Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
                Google+</a>
        </div>
        <a href="<?php echo Url::to(['login']); ?>" class="text-center">I already have a membership</a>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
