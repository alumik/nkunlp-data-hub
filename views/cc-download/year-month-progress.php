<?php

use yii\data\SqlDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;

/** @var SqlDataProvider $dataProvider */

$this->title = '各归档月份下载进度';
$this->params['breadcrumbs'][] = ['label' => '数据下载', 'url' => '/cc-download'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cc-download-year-month-progress">

    <h1><?= Html::encode($this->title); ?></h1>

    <?php
    $searchModel = [
        'yearMonth' => Yii::$app->request->getQueryParam('yearMonth', ''),
    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'yearMonth',
                'label' => '归档月份',
                'filter' => Html::input('text', 'yearMonth', $searchModel['yearMonth'], ['class' => 'form-control']),
            ],
            [
                'attribute' => 'pendingJobs',
                'label' => '未完成任务数量',
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
        ],
    ]); ?>

</div>
