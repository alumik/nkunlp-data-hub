<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $model array */

$this->title = '数据下载';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cc-download-index">

    <h1><?= Html::encode($this->title); ?></h1>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'pending_jobs',
                'label' => '未完成任务数量',
            ],
            [
                'attribute' => 'finished_jobs',
                'label' => '已完成任务数量',
            ],
            [
                'label' => '已下载数据大小',
                'value' => function ($model) {
                    return Yii::$app->formatter->asShortSize($model['finished_download_size'], 2);
                },
            ],
            [
                'label' => '已存储数据大小',
                'value' => function ($model) {
                    return Yii::$app->formatter->asShortSize($model['finished_storage_size'], 2);
                },
            ],
        ],
    ]); ?>

    <h2>任务</h2>

    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">任务列表</h3>
                </div>
                <div class="panel-body">
                    <p>
                        查看进行中和已完成的数据下载任务。
                    </p>
                    <p>
                        <?= Html::a(
                            '前往 &raquo;',
                            ['/cc-download/task'],
                            ['class' => 'btn btn-default']
                        ); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <h2>进度</h2>

    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">存储情况</h3>
                </div>
                <div class="panel-body">
                    <p>
                        查看数据下载下载文件存储的相关统计。
                    </p>
                    <p>
                        <?= Html::a(
                            '前往 &raquo;',
                            ['/cc-download/storage'],
                            ['class' => 'btn btn-default']
                        ); ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">每日下载进度</h3>
                </div>
                <div class="panel-body">
                    <p>
                        查看每日的下载进度。
                    </p>
                    <p>
                        <?= Html::a(
                            '前往 &raquo;',
                            ['/cc-download/daily-progress'],
                            ['class' => 'btn btn-default']
                        ); ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">各归档月份下载进度</h3>
                </div>
                <div class="panel-body">
                    <p>
                        查看各个 Common Crawl 归档月份的下载进度。
                    </p>
                    <p>
                        <?= Html::a(
                            '前往 &raquo;',
                            ['/cc-download/year-month-progress'],
                            ['class' => 'btn btn-default']
                        ); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
