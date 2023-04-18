<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DriveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '存储设备';
$this->params['breadcrumbs'][] = ['label' => '信息中心', 'url' => ['/info']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drive-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('新建存储设备', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            'location',
            'description',
            'updatedAtFormatted',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
