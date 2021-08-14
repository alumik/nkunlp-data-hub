<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var app\models\DriveMgmt $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="drive-mgmt-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'location')->textarea(['rows' => 6]); ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]); ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
