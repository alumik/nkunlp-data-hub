<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CcDeduplicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cc Deduplications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cc-deduplication-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cc Deduplication', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_cc_filtering',
            'id_storage',
            'started_at',
            'finished_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
