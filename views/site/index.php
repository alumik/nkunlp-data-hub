<?php

use yii\grid\GridView;
use yii\helpers\Html;

/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::$app->name;
?>

<div class="site-index">

    <div class="jumbotron">
        <?= Html::img('@web/nankai-logo.svg', ['alt' => '南开大学', 'style' => 'height: 108px;']); ?>

        <h1>软件学院 NLP 数据管理中心</h1>

        <p class="lead">NLP Data Management Center of College of Software, Nankai University.</p>
    </div>

    <div class="body-content">
        <?= GridView::widget([
            'summary' => false,
            'dataProvider' => $dataProvider,
            'columns' => [
                'server',
                'device',
                'task',
                'notes:ntext',
                'updated_at',
            ],
        ]); ?>
    </div>

</div>
