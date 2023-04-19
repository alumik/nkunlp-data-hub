<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CcFilterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '过滤规则';
$this->params['breadcrumbs'][] = ['label' => '正则清洗', 'url' => ['/cc-filtering']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cc-filter-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('新建过滤规则', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'parameters',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
