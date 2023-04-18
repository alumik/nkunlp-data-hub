<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CcChineseExtraction */

$this->title = 'Create Cc Chinese Extraction';
$this->params['breadcrumbs'][] = ['label' => 'Cc Chinese Extractions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cc-chinese-extraction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
