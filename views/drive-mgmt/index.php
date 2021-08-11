<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\DriveMgmt;

/**
 * @var app\models\DriveMgmtSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = '硬盘管理';
$this->params['breadcrumbs'][] = '信息管理';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="drive-mgmt">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('新增硬盘信息', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showFooter' => true,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'footer' => '合计'
            ],

            'name',
            [
                'attribute' => 'quantity',
                'footer' => DriveMgmt::getTotal($dataProvider->models, 'quantity'),
            ],
            'location:ntext',
            'notes:ntext',
            'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
