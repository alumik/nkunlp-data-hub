<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $model array */

$this->title = '正则清洗';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cc-filtering-index">

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
                'label' => '未完成数据大小',
                'value' => function ($model) {
                    return Yii::$app->formatter->asShortSize($model['pending_size'], 2);
                },
            ],
            [
                'attribute' => 'finished_jobs',
                'label' => '已完成任务数量',
            ],
            [
                'label' => '已处理源数据大小',
                'value' => function ($model) {
                    return Yii::$app->formatter->asShortSize($model['finished_in_size'], 2);
                },
            ],
            [
                'label' => '已存储数据大小',
                'value' => function ($model) {
                    return Yii::$app->formatter->asShortSize($model['finished_out_size'], 2);
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
                        查看进行中和已完成的正则清洗任务。
                    </p>
                    <p>
                        <?= Html::a(
                            '前往 &raquo;',
                            ['/cc-filtering/task'],
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
                        查看正则清洗文件存储的相关统计。
                    </p>
                    <p>
                        <?= Html::a(
                            '前往 &raquo;',
                            ['/cc-filtering/storage'],
                            ['class' => 'btn btn-default']
                        ); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <h2>设置</h2>

    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">过滤规则</h3>
                </div>
                <div class="panel-body">
                    <p>
                        查看并管理正则清洗文件存储的相关统计。
                    </p>
                    <p>
                        <?= Html::a(
                            '前往 &raquo;',
                            ['/cc-filtering/filter'],
                            ['class' => 'btn btn-default']
                        ); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
