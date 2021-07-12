<?php

use yii\data\SqlDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;

/** @var SqlDataProvider $dataProvider */

$this->title = '任务列表';
$this->params['breadcrumbs'][] = '中文提取';
?>

<div class="chinese-extraction">

    <h1><?= Html::encode($this->title); ?></h1>

    <?php
    $searchModel = [
        'URI' => Yii::$app->request->getQueryParam('URI', ''),
        'deviceName' => Yii::$app->request->getQueryParam('deviceName', ''),
        'archive' => Yii::$app->request->getQueryParam('archive', ''),
    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'ID',
                'label' => 'ID',
            ],
            [
                'attribute' => 'URI',
                'label' => 'URI',
                'filter' => Html::input('text', 'URI', $searchModel['URI'], ['class' => 'form-control']),
            ],
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
        ],
    ]); ?>

</div>
