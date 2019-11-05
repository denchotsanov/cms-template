<?php

/* @var $this \yii\web\View */

use common\models\Language;
use yii\bootstrap4\ActiveForm;

/* @var $model \backend\models\LanguageForm */

$this->title = Yii::t('backend', 'Add new language');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Language'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="new-language">
    <div class="modal-header">
        <h3 class="modal-title" id="modal-title"></h3>
    </div>
    <div class="modal-body" id="modal-body">
        <?php $form = ActiveForm::begin(); ?>

        <?php echo $form->field($model, 'code')->textInput(['ng-model'=>'languageForm.code']); ?>
        <?php echo $form->field($model, 'name')->textInput(['ng-model'=>'languageForm.name']); ?>

        <?php echo $form->field($model, 'status')->dropDownList((new Language())->getStatusList(),['ng-model'=>'languageForm.status']); ?>

        <?php ActiveForm::end(); ?>

    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" type="button" ng-click="ok()">OK</button>
        <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
    </div>
</div>
