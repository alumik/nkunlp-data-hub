<?php

use yii\data\SqlDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;

/** @var SqlDataProvider $dataProvider */

$this->title = '存储情况';
$this->params['breadcrumbs'][] = ['label' => '中文提取', 'url' => ['/cc-chinese-extraction']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cc-chinese-extraction-storage">

    <h1><?= Html::encode($this->title); ?></h1>

    <?php
    $searchModel = [
        'driveName' => Yii::$app->request->getQueryParam('driveName', ''),
    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'driveName',
                'label' => '存储设备',
                'filter' => Html::input('text', 'driveName', $searchModel['driveName'], ['class' => 'form-control']),
            ],
            [
                'attribute' => 'finishedJobs',
                'label' => '已完成任务数量',
            ],
            [
                'attribute' => 'finishedOutSize',
                'label' => '已存储数据大小',
                'value' => function ($model) {
                    return Yii::$app->formatter->asShortSize($model['finishedOutSize'], 2);
                },
            ],
        ],
    ]); ?>

</div>
