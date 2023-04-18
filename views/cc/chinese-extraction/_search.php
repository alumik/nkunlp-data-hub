<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CcChineseExtractionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cc-chinese-extraction-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_cc_download') ?>

    <?= $form->field($model, 'id_storage') ?>

    <?= $form->field($model, 'started_at') ?>

    <?= $form->field($model, 'finished_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>