<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var app\models\DeviceMgmtSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = '数据存储管理';
$this->params['breadcrumbs'][] = '信息管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-mgmt">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('新增数据存储信息', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'archive',
            'cc_code',
            'notes:ntext',
            'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

</div>
