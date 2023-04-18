<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\YearMonthSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '归档月份编码';
$this->params['breadcrumbs'][] = ['label' => '信息中心', 'url' => ['/info']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="year-month-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('新建归档月份编码', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'year',
            'month',
            'cc_code',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
