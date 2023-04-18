<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CcDeduplication */

$this->title = 'Create Cc Deduplication';
$this->params['breadcrumbs'][] = ['label' => 'Cc Deduplications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cc-deduplication-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
