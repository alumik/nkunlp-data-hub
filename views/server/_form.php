<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var app\models\ServerMgmt $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="server-mgmt-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'server')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'device')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'task')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]); ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
