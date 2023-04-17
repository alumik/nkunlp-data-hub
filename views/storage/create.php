<?php

use yii\helpers\Html;

/** @var app\models\DeviceMgmt $model */

$this->title = '新增数据存储信息';
$this->params['breadcrumbs'][] = '信息管理';
$this->params['breadcrumbs'][] = ['label' => 'Common Crawl 存储管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="device-mgmt">

    <h1><?= Html::encode($this->title); ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
