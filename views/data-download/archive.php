<?php

use yii\data\SqlDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;

/** @var SqlDataProvider $dataProvider */

$this->title = '各归档月份下载进度';
$this->params['breadcrumbs'][] = '数据下载';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="data-download">

    <h1><?= Html::encode($this->title); ?></h1>

    <?php
    $searchModel = [
        'archive' => Yii::$app->request->getQueryParam('archive', ''),
    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'archive',
                'label' => '归档月份',
                'filter' => Html::input('text', 'archive', $searchModel['archive'], ['class' => 'form-control']),
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
