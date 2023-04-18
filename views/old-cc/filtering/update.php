<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CcFiltering */

$this->title = 'Update Cc Filtering: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cc Filterings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cc-filtering-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
