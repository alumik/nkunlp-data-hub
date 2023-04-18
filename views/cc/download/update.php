<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CcDownload */

$this->title = 'Update Cc Download: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cc Downloads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cc-download-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
