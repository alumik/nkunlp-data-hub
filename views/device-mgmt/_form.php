<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $model app\models\DeviceMgmt
 * @var $form yii\widgets\ActiveForm
 */
?>

<div class="device-mgmt-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'archive')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'cc_code')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]); ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
