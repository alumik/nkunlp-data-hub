<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CcStorageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cc Storages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cc-storage-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cc Storage', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_drive',
            'id_year_month',
            'prefix',
            'path',
            //'size',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
