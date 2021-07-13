<?php

use yii\bootstrap\Progress;
use yii\helpers\Html;

/** @var array $progress */

$this->title = '各项任务进度';
$this->params['breadcrumbs'][] = '信息查询';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="info">

    <h1><?= Html::encode($this->title); ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">数据下载</h3>
                </div>
                <div class="panel-body">
                    <p>
                        <strong>进度：</strong><?= $progress['dataDownload']['finished'] . '/' . $progress['dataDownload']['all'] . ' (' . number_format($progress['dataDownload']['finished'] / $progress['dataDownload']['all'] * 100, 2) . '%).'; ?>
                    </p>
                    <p>
                        <?= Progress::widget([
                            'percent' => $progress['dataDownload']['finished'] / $progress['dataDownload']['all'] * 100,
                        ]); ?>
                    </p>
                    <p>
                        <?= Html::a('任务列表 &raquo;', ['/data-download/index'], ['class' => 'btn btn-default']); ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">中文提取</h3>
                </div>
                <div class="panel-body">
                    <p>
                        <strong>进度：</strong><?= $progress['chineseExtraction']['finished'] . '/' . $progress['chineseExtraction']['all'] . ' (' . number_format($progress['chineseExtraction']['finished'] / $progress['chineseExtraction']['all'] * 100, 2) . '%).'; ?>
                    </p>
                    <p>
                        <?= Progress::widget([
                            'percent' => $progress['chineseExtraction']['finished'] / $progress['chineseExtraction']['all'] * 100,
                        ]); ?>
                    </p>
                    <p>
                        <?= Html::a('任务列表 &raquo;', ['/chinese-extraction/index'], ['class' => 'btn btn-default']); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
