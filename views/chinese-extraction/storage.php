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
                'attribute' => 'fileCount',
                'label' => '文件数量',
            ],
            [
                'attribute' => 'readableSize',
                'label' => '存储大小',
            ],
        ],
    ]); ?>

</div>
