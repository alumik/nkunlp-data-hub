<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var app\models\DriveMgmt $model */

$this->title = '硬盘信息: ' . $model->name;
$this->params['breadcrumbs'][] = '信息管理';
$this->params['breadcrumbs'][] = ['label' => '硬盘管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="drive-mgmt">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定要删除此项吗？',
                'method' => 'post',
            ],
        ]); ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'quantity',
            'location:ntext',
            'notes:ntext',
            'updated_at',
        ],
    ]); ?>

</div>
