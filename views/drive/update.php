<?php

use yii\helpers\Html;

/** @var app\models\DriveMgmt $model */

$this->title = '修改: ' . $model->name;
$this->params['breadcrumbs'][] = '信息中心';
$this->params['breadcrumbs'][] = ['label' => '硬盘管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>

<div class="drive-mgmt">

    <h1><?= Html::encode($this->title); ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
