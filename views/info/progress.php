<?php

use yii\bootstrap\Progress;
use yii\helpers\Html;

/** @var array $progress */

$this->title = '各阶段进度';
$this->params['breadcrumbs'][] = '信息中心';
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
                    <?php $dataDownloadProgress =
                        $progress['dataDownload']['finished'] / $progress['dataDownload']['all'] * 100; ?>
                    <p>
                        <strong>进度：</strong>
                        <?= $progress['dataDownload']['finished'] . '/' . $progress['dataDownload']['all']; ?>
                    </p>
                    <p>
                        <?= Progress::widget([
                            'percent' => $dataDownloadProgress,
                            'label' => number_format($dataDownloadProgress, 2) . '%',
                        ]); ?>
                    </p>
                    <p>
                        <?= Html::a(
                            '任务列表 &raquo;',
                            ['/data-download/index'],
                            ['class' => 'btn btn-default']
                        ); ?>
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
                    <?php $chineseExtractionProgress =
                        $progress['chineseExtraction']['finished'] / $progress['chineseExtraction']['all'] * 100; ?>
                    <p>
                        <strong>进度：</strong>
                        <?= $progress['chineseExtraction']['finished'] . '/' . $progress['chineseExtraction']['all']; ?>
                    </p>
                    <p>
                        <?= Progress::widget([
                            'bars' => [
                                [
                                    'percent' => $chineseExtractionProgress,
                                    'label' => number_format($chineseExtractionProgress, 2) . '%',
                                ],
                                [
                                    'percent' => $dataDownloadProgress - $chineseExtractionProgress,
                                    'options' => ['class' => 'progress-bar-warning']
                                ],
                            ],
                        ]); ?>
                    </p>
                    <p>
                        <?= Html::a(
                            '任务列表 &raquo;',
                            ['/chinese-extraction/index'],
                            ['class' => 'btn btn-default']
                        ); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">正则清洗</h3>
                </div>
                <div class="panel-body">
                    <?php $filterProgress =
                        $progress['filter']['finished'] / $progress['filter']['all'] * 100; ?>
                    <p>
                        <strong>进度：</strong>
                        <?= $progress['filter']['finished'] . '/' . $progress['filter']['all']; ?>
                    </p>
                    <p>
                        <?= Progress::widget([
                            'bars' => [
                                [
                                    'percent' => $filterProgress,
                                    'label' => number_format($filterProgress, 2) . '%',
                                ],
                                [
                                    'percent' => $chineseExtractionProgress - $filterProgress,
                                    'options' => ['class' => 'progress-bar-warning']
                                ],
                            ],
                        ]); ?>
                    </p>
                    <p>
                        <?= Html::a(
                            '任务状态 &raquo;',
                            ['/filter/state'],
                            ['class' => 'btn btn-default']
                        ); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
