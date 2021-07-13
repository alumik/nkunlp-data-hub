<?php

use yii\data\SqlDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;

/** @var SqlDataProvider $dataProvider */

$this->title = '归档月份和数据编码对照表';
$this->params['breadcrumbs'][] = '信息查询';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="info">

    <h1><?= Html::encode($this->title); ?></h1>

    <?php
    $searchModel = [
        'ccCode' => Yii::$app->request->getQueryParam('ccCode', ''),
        'archive' => Yii::$app->request->getQueryParam('archive', ''),
    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'archive0',
                'label' => '归档月份',
                'filter' => Html::input('text', 'archive', $searchModel['archive'], ['class' => 'form-control']),
            ],
            [
                'attribute' => 'ccCode',
                'label' => '数据编码',
                'filter' => Html::input('text', 'ccCode', $searchModel['ccCode'], ['class' => 'form-control']),
            ],
        ],
    ]); ?>

</div>
