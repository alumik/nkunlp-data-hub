<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\YearMonth */

$this->title = '新建归档月份编码';
$this->params['breadcrumbs'][] = ['label' => '信息中心', 'url' => ['/info']];
$this->params['breadcrumbs'][] = ['label' => '归档月份编码', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="year-month-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
