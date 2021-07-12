<?php

use yii\helpers\Html;

/** @var $model app\models\DeviceMgmt */

$this->title = '新增存储设备';
$this->params['breadcrumbs'][] = '信息管理';
$this->params['breadcrumbs'][] = ['label' => '存储设备管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="device-mgmt">

    <h1><?= Html::encode($this->title); ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
