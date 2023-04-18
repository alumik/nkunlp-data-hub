<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CcFiltering */

$this->title = 'Create Cc Filtering';
$this->params['breadcrumbs'][] = ['label' => 'Cc Filterings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cc-filtering-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
