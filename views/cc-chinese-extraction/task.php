<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CcChineseExtractionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '任务列表';
$this->params['breadcrumbs'][] = ['label' => '中文提取', 'url' => ['/cc-chinese-extraction']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cc-chinese-extraction-task">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'id_cc_download',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->id_cc_download, ['/cc-download/view', 'id' => $model->id_cc_download]);
                },
            ],
            [
                'attribute' => 'driveName',
                'value' => 'storage.drive.name',
            ],
            'prefixAndPath',
            [
                'attribute' => 'size',
                'value' => 'storage.size',
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return ['未开始', '进行中', '已完成'][$model->status];
                },
                'filter' => ['未开始', '进行中', '已完成'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>

</div>
