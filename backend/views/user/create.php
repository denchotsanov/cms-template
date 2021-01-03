<?php
/*
 * @author Dencho Tsanov <dencho@tsanov.eu>
 * @licence MIT License
 * @copyright Copyright (c) 2021. Dencho Tsanov. All rights reserved.
 */

use common\models\User;
use yii\bootstrap\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = Yii::t('backend', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([
    'action' => 'create',
    'enableClientValidation' => true,    // no AJAX required
    'enableAjaxValidation' => true,    // server-side validation required
    'validationUrl' => Url::toRoute('ajax-create'),  // AJAX validation URL
    'options' => [
        'id' => 'id-item-form',
    ]
]); ?>
<div class="modal-body" id="modal-body">
    <div class="error-summary"></div>
    <?php echo $form->field($model, 'email')->textInput(); ?>
    <?php echo $form->field($model, 'password')->passwordInput(); ?>
    <?php echo $form->field($model, 'status')->dropDownList(User::getStatusList()); ?>
</div>
<?php if (Yii::$app->request->isAjax): ?>
    <div class="modal-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), [
            'id' => 'btnModalSave',
            'class' => 'btn btn-success',
            //'data-dismiss' => 'modal'
        ]) ?>
        <?= Html::button(Yii::t('app', 'Cancel'), [
            'id' => 'btnModalCancel',
            'class' => 'btn btn-default',
            'data-dismiss' => 'modal'
        ]) ?>
    </div>
<?php else: ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['index'],
            ['class' => 'btn btn-default']
        ) ?>
    </div>
<?php endif; ?>
<?php ActiveForm::end(); ?>
