<?php

use yii\data\SqlDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;

/** @var SqlDataProvider $dataProvider */

$this->title = '每日下载进度';
$this->params['breadcrumbs'][] = '数据下载';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="data-download">

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
                'label' => '任务数量',
            ],
            [
                'attribute' => 'traffic',
                'label' => '下载流量',
            ],
            [
                'attribute' => 'avgSpeed',
                'label' => '平均下载速率',
            ],
        ],
    ]); ?>

</div>
