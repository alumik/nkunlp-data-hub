<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CcFilteringSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cc Filterings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cc-filtering-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cc Filtering', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_cc_chinese_extraction',
            'id_storage',
            'started_at',
            'finished_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
