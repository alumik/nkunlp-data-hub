<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var array $result
 */

$this->title = '任务状态';
$this->params['breadcrumbs'][] = ['label' => '正则清洗', 'url' => 'index'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="filter">

    <h1><?= Html::encode($this->title); ?></h1>

    <?=
    DetailView::widget([
        'model' => $result,
        'attributes' => [
            [
                'attribute' => 'unprocessedCount',
                'label' => '待完成任务数量',
            ],
            [
                'attribute' => 'unprocessedSize',
                'label' => '待完成任务大小',
            ],
            [
                'attribute' => 'processedCount',
                'label' => '已完成任务数量',
            ],
            [
                'attribute' => 'processedSize',
                'label' => '已完成任务大小',
            ],
        ],
    ]); ?>

</div>
