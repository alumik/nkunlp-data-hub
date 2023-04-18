<?php

use yii\bootstrap\Html;

$this->title = Yii::$app->name;
?>

<div class="site-index">

    <div class="jumbotron">
        <?= Html::img('@web/nankai-logo.svg', ['alt' => '南开大学', 'style' => 'height: 108px;']); ?>
        <h1>南开软院语料管理平台</h1>
        <p class="lead" id="hitokoto-text"></p>
        <hr/>
        <p id="hitokoto"></p>
    </div>

    <div class="body-content">

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
                hitokoto.innerText = '不经一番寒彻骨，怎得梅花扑鼻香。'
            }
        }
    }
    xhr.send();
</script>
