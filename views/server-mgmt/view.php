<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var $model app\models\ServerMgmt */

$this->title = $model->server;
$this->params['breadcrumbs'][] = ['label' => '服务器管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="server-mgmt">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要删除该项吗？',
                'method' => 'post',
            ],
        ]); ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'server',
            [
                'attribute' => 'mounted',
                'value' => function ($model) {
                    return [0 => '否', 1 => '是'][$model->mounted];
                }
            ],
            [
                'attribute' => 'id_device',
                'value' => $model->device == null ? '(未设置)' : $model->device->device_name,
                'contentOptions' => ['class' => 'not-set'],
            ],
            'task',
            'notes:ntext',
            'modified_at',
        ],
    ]); ?>

</div>
