<?php

use yii\data\SqlDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;

/** @var SqlDataProvider $dataProvider */

$this->title = '各终端下载进度';
$this->params['breadcrumbs'][] = ['label' => '数据下载', 'url' => 'index'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="data-download">

    <h1><?= Html::encode($this->title); ?></h1>

    <?php
    $searchModel = [
        'worker' => Yii::$app->request->getQueryParam('worker', ''),
    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'name',
                'label' => '终端标识',
                'filter' => Html::input('text', 'worker', $searchModel['worker'], ['class' => 'form-control']),
            ],
            [
                'attribute' => 'finishedJobs',
                'label' => '任务数量',
            ],
            [
                'attribute' => 'traffic',
                'label' => '下载流量',
            ],
        ],
    ]); ?>

</div>
