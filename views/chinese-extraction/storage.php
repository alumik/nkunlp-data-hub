<?php

use yii\data\SqlDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;

/** @var SqlDataProvider $dataProvider */

$this->title = '存储情况';
$this->params['breadcrumbs'][] = ['label' => '中文提取', 'url' => 'index'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="chinese-extraction">

    <h1><?= Html::encode($this->title); ?></h1>

    <?php
    $searchModel = [
        'deviceName' => Yii::$app->request->getQueryParam('deviceName', ''),
        'archive' => Yii::$app->request->getQueryParam('archive', ''),
    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'deviceName',
                'label' => '存储设备',
                'filter' => Html::input('text', 'deviceName', $searchModel['deviceName'], ['class' => 'form-control']),
            ],
            [
                'attribute' => 'archive',
                'label' => '归档月份',
                'filter' => Html::input('text', 'archive', $searchModel['archive'], ['class' => 'form-control']),
            ],
            [
                'attribute' => 'totalCount',
                'label' => '总文件数量',
            ],
            [
                'attribute' => 'totalSize',
                'label' => '总存储大小',
            ],
            [
                'attribute' => 'unprocessedCount',
                'label' => '待正则清洗数量',
            ],
            [
                'attribute' => 'unprocessedSize',
                'label' => '待正则清洗大小',
            ],
            [
                'attribute' => 'processedCount',
                'label' => '已正则清洗数量',
            ],
            [
                'attribute' => 'processedSize',
                'label' => '已正则清洗大小',
            ],
        ],
    ]); ?>

</div>
