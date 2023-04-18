<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CcStorageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '本地文件列表';
$this->params['breadcrumbs'][] = ['label' => '信息中心', 'url' => ['/info']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cc-storage-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'driveName',
                'value' => 'drive.name',
            ],
            'yearMonthStr',
            'prefix',
            'path',
            'size',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>

</div>
