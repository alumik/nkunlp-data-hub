<?php

use yii\data\SqlDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;

/** @var SqlDataProvider $dataProvider */

$this->title = '每日下载进度';
$this->params['breadcrumbs'][] = ['label' => '数据下载', 'url' => '/cc-download'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cc-download-daily-progress">

    <h1><?= Html::encode($this->title); ?></h1>

    <?php
    $searchModel = [
        'date' => Yii::$app->request->getQueryParam('date', ''),
    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'date0',
                'label' => '日期',
                'filter' => Html::input('text', 'date', $searchModel['date'], ['class' => 'form-control']),
            ],
            [
                'attribute' => 'finishedJobs',
                'label' => '已完成任务数量',
            ],
            [
                'attribute' => 'finishedDownloadSize',
                'label' => '已下载数据大小',
                'value' => function ($model) {
                    return Yii::$app->formatter->asShortSize($model['finishedDownloadSize'], 2);
                },
            ],
            [
                'attribute' => 'averageDownloadSpeed',
                'label' => '平均下载速率',
                'value' => function ($model) {
                    return Yii::$app->formatter->asShortSize($model['averageDownloadSpeed'], 2) . '/s';
                },
            ],
        ],
    ]); ?>

</div>
