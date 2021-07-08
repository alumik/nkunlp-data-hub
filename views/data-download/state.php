<?php

use app\models\CommonCrawlData;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;

/** @var ArrayDataProvider $dataProvider */

$this->title = '任务状态';
$this->params['breadcrumbs'][] = '数据下载';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="data-download">

    <h1><?= Html::encode($this->title); ?></h1>

    <?= GridView::widget([
        'summary' => false,
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'downloadState',
                'label' => '任务状态',
                'value' => function ($model) {
                    return CommonCrawlData::$downloadStateDict[strval($model['downloadState'])];
                },
            ],
            [
                'attribute' => 'finishedJobs',
                'label' => '任务数量',
            ],
            [
                'attribute' => 'traffic',
                'label' => '任务大小',
                'value' => function ($model) {
                    if (trim($model['traffic']) == '0 bytes') {
                        return '未知';
                    }
                    return $model['traffic'];
                },
            ],
        ],
    ]); ?>

</div>
