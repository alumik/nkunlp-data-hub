<?php

use yii\helpers\Html;

/** @var $model app\models\DeviceMgmt */

$this->title = '修改存储设备: ' . $model->name;
$this->params['breadcrumbs'][] = '信息管理';
$this->params['breadcrumbs'][] = ['label' => '存储设备管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
$this->params['breadcrumbs'][] = '修改';
?>

<div class="device-mgmt">

    <h1><?= Html::encode($this->title); ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
