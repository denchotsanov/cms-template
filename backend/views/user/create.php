<?php

use common\models\User;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = Yii::t('backend', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
    <div class="modal-header">
        <h3 class="modal-title" id="modal-title">I'm a modal!</h3>
    </div>
    <div class="modal-body" id="modal-body">

        <?php $form = ActiveForm::begin(); ?>

        <?php echo $form->field($model, 'email')->textInput(['ng-model'=>'userForm.email']); ?>
        <?php echo $form->field($model, 'password')->passwordInput(['ng-model'=>'userForm.password']); ?>
        <?php echo $form->field($model, 'status')->dropDownList((new User())->getStatusList(),['ng-model'=>'userForm.status']); ?>

        <?php ActiveForm::end(); ?>

    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" type="button" ng-click="ok()">OK</button>
        <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
    </div>
</div>