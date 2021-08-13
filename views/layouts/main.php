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

    $greeting = '你好';
    $hour = date('G');
    if ($hour < 5) {
        $greeting = '夜深了';
    } else if ($hour >= 5 && $hour <= 11) {
        $greeting = '早上好';
    } else if ($hour >= 12 && $hour <= 18) {
        $greeting = '下午好';
    } else if ($hour >= 19) {
        $greeting = '晚上好';
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
                'label' => '信息中心',
                'items' => [
                    '<li class="dropdown-header">信息查询</li>',
                    ['label' => '各项任务进度', 'url' => '/info/progress'],
                    ['label' => '归档月份和数据编码对照表', 'url' => '/info/archive-cc-code'],
                    '<li class="divider"></li>',
                    '<li class="dropdown-header">信息管理</li>',
                    ['label' => '服务器管理', 'url' => '/server-mgmt'],
                    ['label' => '硬盘管理', 'url' => '/drive-mgmt'],
                    ['label' => '数据存储管理', 'url' => '/device-mgmt'],
                ],
                'visible' => !Yii::$app->user->isGuest,
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
                'visible' => !Yii::$app->user->isGuest,
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
                'visible' => !Yii::$app->user->isGuest,
            ],
            [
                'label' => '正则清洗',
                'items' => [
                    '<li class="dropdown-header">任务</li>',
                    ['label' => '任务状态', 'url' => '/filter/state'],
                ],
                'visible' => !Yii::$app->user->isGuest,
            ],
            Yii::$app->user->isGuest ? (
            ['label' => '登录', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    $greeting . '，' . Yii::$app->user->identity->nickname . ' (注销)',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
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
