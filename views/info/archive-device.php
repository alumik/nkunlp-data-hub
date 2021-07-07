<?php

use yii\data\SqlDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;

/** @var SqlDataProvider $dataProvider */

$this->title = '归档月份和磁盘对照表';
$this->params['breadcrumbs'][] = '信息查询';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="info">

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
        ],
    ]); ?>

</div>
