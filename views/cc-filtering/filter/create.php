<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CcFilter */

$this->title = '新建过滤规则';
$this->params['breadcrumbs'][] = ['label' => '正则清洗', 'url' => ['/cc-filtering']];
$this->params['breadcrumbs'][] = ['label' => '过滤规则', 'url' => ['/cc-filtering/filter/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cc-filter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
