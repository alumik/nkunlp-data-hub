<?php

use yii\grid\GridView;
use yii\helpers\Html;

/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::$app->name;
?>

<div class="site-index">

    <div class="jumbotron">
        <?= Html::img('@web/nankai-logo.svg', ['alt' => '南开大学', 'style' => 'height: 108px;']); ?>
        <h1>南开大学 NLP 数据管理中心</h1>
        <p class="lead" id="hitokoto-text"></p>
        <hr/>
        <p id="hitokoto"></p>
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

<script>
    var xhr = new XMLHttpRequest();
    xhr.open('get', 'https://v1.hitokoto.cn?c=d&c=h&c=i&c=k');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            var data = JSON.parse(xhr.responseText);
            var hitokoto = document.getElementById('hitokoto');
            if (data.hitokoto !== undefined) {
                hitokoto.innerText = data.hitokoto;
            } else {
                hitokoto.innerText = '只是，想要做些什么而已。 觉得不做些什么就会死掉而已。'
            }
        }
    }
    xhr.send();
</script>
