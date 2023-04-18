<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CcDownload */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '中文提取', 'url' => ['/cc-chinese-extraction']];
$this->params['breadcrumbs'][] = ['label' => '任务列表', 'url' => ['/cc-chinese-extraction/task']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="cc-chinese-extraction-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_cc_download',
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
