<?php

use app\models\CommonCrawlData;
use app\models\CommonCrawlWorker;
use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var app\models\CommonCrawlDataSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = '任务列表';
$this->params['breadcrumbs'][] = '数据下载';
?>

<div class="data-download">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('清理逾期下载任务', ['reset-overdue-jobs'], ['class' => 'btn btn-danger']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'uri',
            [
                'attribute' => 'size',
                'filter' => false,
            ],
            [
                'attribute' => 'started_at',
                'filter' => false,
            ],
            [
                'attribute' => 'finished_at',
                'filter' => false,
            ],
            [
                'attribute' => 'process_state',
                'value' => function ($model) {
                    return $model->processStateText();
                },
                'filter' => CommonCrawlData::$processStateDict,
            ],
            [
                'attribute' => 'download_state',
                'value' => function ($model) {
                    return $model->downloadStateText();
                },
                'filter' => CommonCrawlData::$downloadStateDict,
            ],
            [
                'attribute' => 'id_worker',
                'value' => 'worker.name',
                'filter' => CommonCrawlWorker::allWorkers(),
            ],
            'archive',
        ],
    ]); ?>

</div>
