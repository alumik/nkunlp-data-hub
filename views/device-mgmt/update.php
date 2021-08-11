<?php

use yii\helpers\Html;

/** @var app\models\DeviceMgmt $model */

$this->title = '修改数据存储信息: ' . $model->name;
$this->params['breadcrumbs'][] = '信息管理';
$this->params['breadcrumbs'][] = ['label' => '数据存储管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
$this->params['breadcrumbs'][] = '修改';
?>

<div class="device-mgmt">

    <h1><?= Html::encode($this->title); ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
