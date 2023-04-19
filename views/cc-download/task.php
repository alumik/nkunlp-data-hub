<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CcDownloadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '任务列表';
$this->params['breadcrumbs'][] = ['label' => '数据下载', 'url' => ['/cc-download']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cc-download-task">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'id_cc_data',
            [
                'attribute' => 'driveName',
                'value' => 'storage.drive.name',
            ],
            'prefixAndPath',
            'size',
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
