<?php
/*
 * @author Dencho Tsanov <dencho@tsanov.eu>
 * @licence MIT License
 * @copyright Copyright (c) 2021. Dencho Tsanov. All rights reserved.
 */

use backend\models\UpdateProfileForm;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

/** @var UpdateProfileForm $model */

$form = ActiveForm::begin([
    'action' => 'update-profile',
    'enableClientValidation' => true,    // no AJAX required
    'enableAjaxValidation' => true,    // server-side validation required
    'validationUrl' => Url::toRoute('update-profile'),  // AJAX validation URL
    'options' => [
        'id' => 'id-item-form',
    ]
]);


echo $form->field($model, 'username')->textInput(); ?>
<?php ActiveForm::end(); ?>
