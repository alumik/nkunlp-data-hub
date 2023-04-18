<?php

use yii\bootstrap\Progress;
use yii\helpers\Html;

/** @var array $progress */

$this->title = '各阶段进度';
$this->params['breadcrumbs'][] = ['label' => '信息中心', 'url' => ['/info']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="info">

    <h1><?= Html::encode($this->title); ?></h1>

    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">数据下载</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if ($progress['cc_data'] != 0) {
                        $cc_progress = $progress['cc_download'] / $progress['cc_data'] * 100;
                    } else {
                        $cc_progress = 0;
                    }
                    ?>
                    <p>
                        <strong>进度：</strong>
                        <?= $progress['cc_download'] . '/' . $progress['cc_data']; ?>
                    </p>
                    <p>
                        <?= Progress::widget([
                            'percent' => $cc_progress,
                            'label' => number_format($cc_progress, 2) . '%',
                        ]); ?>
                    </p>
                    <p>
                        <?= Html::a(
                            '任务列表 &raquo;',
                            ['/cc-download'],
                            ['class' => 'btn btn-default']
                        ); ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">中文提取</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if ($progress['cc_download'] != 0) {
                        $cc_progress = $progress['cc_chinese_extraction'] / $progress['cc_download'] * 100;
                    } else {
                        $cc_progress = 0;
                    }
                    ?>
                    <p>
                        <strong>进度：</strong>
                        <?= $progress['cc_chinese_extraction'] . '/' . $progress['cc_download']; ?>
                    </p>
                    <p>
                        <?= Progress::widget([
                            'percent' => $cc_progress,
                            'label' => number_format($cc_progress, 2) . '%',
                        ]); ?>
                    </p>
                    <p>
                        <?= Html::a(
                            '任务列表 &raquo;',
                            ['/cc-chinese-extraction'],
                            ['class' => 'btn btn-default']
                        ); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">正则清洗</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if ($progress['cc_chinese_extraction'] != 0) {
                        $cc_progress = $progress['cc_filtering'] / $progress['cc_chinese_extraction'] * 100;
                    } else {
                        $cc_progress = 0;
                    }
                    ?>
                    <p>
                        <strong>进度：</strong>
                        <?= $progress['cc_filtering'] . '/' . $progress['cc_chinese_extraction']; ?>
                    </p>
                    <p>
                        <?= Progress::widget([
                            'percent' => $cc_progress,
                            'label' => number_format($cc_progress, 2) . '%',
                        ]); ?>
                    </p>
                    <p>
                        <?= Html::a(
                            '任务列表 &raquo;',
                            ['/cc-filtering'],
                            ['class' => 'btn btn-default']
                        ); ?>
                    </p>
                </div>
            </div>
        </div>
<!--        <div class="col-sm-6">-->
<!--            <div class="panel panel-default">-->
<!--                <div class="panel-heading">-->
<!--                    <h3 class="panel-title">数据去重</h3>-->
<!--                </div>-->
<!--                <div class="panel-body">-->
<!--                    --><?php
//                    if ($progress['cc_filtering'] != 0) {
//                        $cc_progress = $progress['cc_deduplication'] / $progress['cc_filtering'] * 100;
//                    } else {
//                        $cc_progress = 0;
//                    }
//                    ?>
<!--                    <p>-->
<!--                        <strong>进度：</strong>-->
<!--                        --><?php //= $progress['cc_deduplication'] . '/' . $progress['cc_filtering']; ?>
<!--                    </p>-->
<!--                    <p>-->
<!--                        --><?php //= Progress::widget([
//                            'percent' => $cc_progress,
//                            'label' => number_format($cc_progress, 2) . '%',
//                        ]); ?>
<!--                    </p>-->
<!--                    <p>-->
<!--                        --><?php //= Html::a(
//                            '任务列表 &raquo;',
//                            ['/cc-deduplication'],
//                            ['class' => 'btn btn-default']
//                        ); ?>
<!--                    </p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>

</div>
