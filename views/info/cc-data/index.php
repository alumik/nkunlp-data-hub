<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CcDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Common Crawl 文件列表';
$this->params['breadcrumbs'][] = ['label' => '信息中心', 'url' => ['/info']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cc-data-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'uri',
            'yearMonthStr',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
