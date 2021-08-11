<?php

use yii\helpers\Html;

/** @var app\models\DriveMgmt $model */

$this->title = '新增硬盘信息';
$this->params['breadcrumbs'][] = '信息管理';
$this->params['breadcrumbs'][] = ['label' => '硬盘管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="drive-mgmt">

    <h1><?= Html::encode($this->title); ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
