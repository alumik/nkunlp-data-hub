<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/** @var string $content */

AppAsset::register($this);
?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>">
<head>
    <meta charset="<?= Yii::$app->charset; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags(); ?>
    <title><?= Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
                'label' => '信息管理',
                'items' => [
                    ['label' => '服务器管理', 'url' => '/server-mgmt'],
                    ['label' => '存储设备管理', 'url' => '/device-mgmt'],
                ],
            ],
            [
                'label' => '数据下载',
                'items' => [
                    '<li class="dropdown-header">任务</li>',
                    ['label' => '任务列表', 'url' => '/data-download/index'],
                    ['label' => '任务状态', 'url' => '/data-download/state'],
                    '<li class="divider"></li>',
                    '<li class="dropdown-header">下载进度</li>',
                    ['label' => '每日下载进度', 'url' => '/data-download/daily'],
                    ['label' => '各终端下载进度', 'url' => '/data-download/worker'],
                    ['label' => '各归档月份下载进度', 'url' => '/data-download/archive'],
                ],
            ],
            [
                'label' => '中文提取',
                'items' => [
                    '<li class="dropdown-header">任务</li>',
                    ['label' => '任务列表', 'url' => '/chinese-extraction/index'],
                    ['label' => '任务状态', 'url' => '/chinese-extraction/state'],
                    '<li class="divider"></li>',
                    '<li class="dropdown-header">处理进度</li>',
                    ['label' => '存储情况', 'url' => '/chinese-extraction/storage'],
                ],
            ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]); ?>
        <?= Alert::widget(); ?>
        <?= $content; ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::a(Yii::$app->name . date(' Y'), ['/site/about']); ?></p>
    </div>
</footer>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
