<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var array $result
 */

$this->title = '任务状态';
$this->params['breadcrumbs'][] = '中文提取';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="chinese-extraction">

    <h1><?= Html::encode($this->title); ?></h1>

    <?=
    DetailView::widget([
        'model' => $result,
        'attributes' => [
            [
                'attribute' => 'finishedJobs',
                'label' => '完成任务数量',
            ],
            [
                'attribute' => 'readableSize',
                'label' => '完成任务大小',
            ],
        ],
    ]); ?>

</div>
