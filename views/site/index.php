<?php

use yii\grid\GridView;

/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::$app->name;
?>

<div class="site-index">

    <div class="jumbotron">
        <h1>南开大学软件学院<br/>NLP 数据管理中心</h1>

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
