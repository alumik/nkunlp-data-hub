<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CcFiltering */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '正则清洗', 'url' => ['/cc-filtering']];
$this->params['breadcrumbs'][] = ['label' => '任务列表', 'url' => ['/cc-filtering/task']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="cc-filtering-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_cc_chinese_extraction',
            'id_storage',
            [
                'attribute' => 'driveName',
                'value' => $model->storage->drive->name ?? null,
            ],
            'prefixAndPath',
            [
                'attribute' => 'size',
                'value' => $model->storage->size ?? null,
            ],
            [
                'attribute' => 'status',
                'value' => ['未开始', '进行中', '已完成'][$model->status],
            ],
            'startedAtFormatted',
            'finishedAtFormatted',
        ],
    ]) ?>

</div>
