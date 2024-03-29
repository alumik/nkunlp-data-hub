<?php

use yii\helpers\Html;

$this->title = '信息中心';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="info-index">

    <h1><?= Html::encode($this->title); ?></h1>

    <h2>信息查询</h2>

    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">各阶段进度</h3>
                </div>
                <div class="panel-body">
                    <p>
                        查看 Common Crawl 数据处理各阶段的完成进度。
                    </p>
                    <p>
                        <?= Html::a(
                            '前往 &raquo;',
                            ['/info/progress'],
                            ['class' => 'btn btn-default']
                        ); ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Common Crawl 文件列表</h3>
                </div>
                <div class="panel-body">
                    <p>
                        查看所有待处理 Common Crawl 数据列表。
                    </p>
                    <p>
                        <?= Html::a(
                            '前往 &raquo;',
                            ['/info/cc-data'],
                            ['class' => 'btn btn-default']
                        ); ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">本地文件列表</h3>
                </div>
                <div class="panel-body">
                    <p>
                        查看存储在本地设备中的文件列表。
                    </p>
                    <p>
                        <?= Html::a(
                            '前往 &raquo;',
                            ['/info/cc-storage'],
                            ['class' => 'btn btn-default']
                        ); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <h2>信息管理</h2>

    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">归档月份编码</h3>
                </div>
                <div class="panel-body">
                    <p>
                        查看并管理归档月份与 Common Crawl 编码。
                    </p>
                    <p>
                        <?= Html::a(
                            '前往 &raquo;',
                            ['/info/year-month'],
                            ['class' => 'btn btn-default']
                        ); ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">存储设备</h3>
                </div>
                <div class="panel-body">
                    <p>
                        查看并管理存储设备信息。
                    </p>
                    <p>
                        <?= Html::a(
                            '前往 &raquo;',
                            ['/info/drive'],
                            ['class' => 'btn btn-default']
                        ); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
