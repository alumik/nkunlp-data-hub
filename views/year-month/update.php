<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\YearMonth */

$this->title = '更新月份编码：' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '月份编码', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="year-month-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
