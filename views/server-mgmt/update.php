<?php

use yii\helpers\Html;

/** @var app\models\ServerMgmt $model */

$this->title = '服务器管理: ' . $model->server;
$this->params['breadcrumbs'][] = ['label' => '服务器管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>

<div class="server-mgmt">

    <h1><?= Html::encode($this->title); ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
