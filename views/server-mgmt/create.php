<?php

use yii\helpers\Html;

/** @var app\models\ServerMgmt $model */

$this->title = '新增服务器信息';
$this->params['breadcrumbs'][] = '信息管理';
$this->params['breadcrumbs'][] = ['label' => '服务器管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="server-mgmt">

    <h1><?= Html::encode($this->title); ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
