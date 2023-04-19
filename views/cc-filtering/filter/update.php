<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CcFilter */

$this->title = '更新过滤规则：' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '正则清洗', 'url' => ['/cc-filtering']];
$this->params['breadcrumbs'][] = ['label' => '过滤规则', 'url' => ['/cc-filtering/filter/index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="cc-filter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
