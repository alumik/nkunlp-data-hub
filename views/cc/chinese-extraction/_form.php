<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CcChineseExtraction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cc-chinese-extraction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_cc_download')->textInput() ?>

    <?= $form->field($model, 'id_storage')->textInput() ?>

    <?= $form->field($model, 'started_at')->textInput() ?>

    <?= $form->field($model, 'finished_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
