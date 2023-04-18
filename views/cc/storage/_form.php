<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CcStorage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cc-storage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_drive')->textInput() ?>

    <?= $form->field($model, 'id_year_month')->textInput() ?>

    <?= $form->field($model, 'prefix')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
