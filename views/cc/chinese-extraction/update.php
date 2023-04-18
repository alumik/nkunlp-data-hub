<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CcChineseExtraction */

$this->title = 'Update Cc Chinese Extraction: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cc Chinese Extractions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cc-chinese-extraction-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
