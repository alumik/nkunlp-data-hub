<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\YearMonth */

$this->title = '新建月份编码';
$this->params['breadcrumbs'][] = ['label' => '月份编码', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="year-month-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
