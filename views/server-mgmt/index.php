<?php

use app\models\Device;
use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var app\models\ServerMgmtSearch$searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = '服务器管理';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="server-mgmt">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('新增服务器管理信息', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'server',
            [
                'attribute' => 'id_device',
                'value' => 'device.device_name',
                'filter' => Device::AllDevices(),
            ],
            'task',
            'notes:ntext',
            'modified_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
