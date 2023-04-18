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
                    ['label' => '主页', 'url' => '/info'],
                    '<li class="divider"></li>',
                    '<li class="dropdown-header">信息查询</li>',
                    ['label' => '各阶段进度', 'url' => '/info/progress'],
                    ['label' => 'Common Crawl 文件列表', 'url' => '/info/cc-data'],
                    ['label' => '本地文件列表', 'url' => '/info/cc-storage'],
                    '<li class="divider"></li>',
                    '<li class="dropdown-header">信息管理</li>',
                    ['label' => '归档月份编码', 'url' => '/info/year-month'],
                    ['label' => '存储设备', 'url' => '/info/drive'],
                ],
                'visible' => !Yii::$app->user->isGuest,
            ],
            [
                'label' => '数据下载',
                'items' => [
                    ['label' => '主页', 'url' => '/cc-download'],
                    '<li class="divider"></li>',
                    '<li class="dropdown-header">任务</li>',
                    ['label' => '任务列表', 'url' => '/cc-download/task'],
                    '<li class="divider"></li>',
                    '<li class="dropdown-header">进度</li>',
                    ['label' => '存储情况', 'url' => '/cc-download/storage'],
                    ['label' => '每日下载进度', 'url' => '/cc-download/daily-progress'],
                    ['label' => '各归档月份下载进度', 'url' => '/cc-download/year-month-progress'],
                ],
                'visible' => !Yii::$app->user->isGuest,
            ],
            [
                'label' => '中文提取',
                'items' => [
                    ['label' => '主页', 'url' => '/cc-chinese-extraction'],
                    '<li class="divider"></li>',
                    '<li class="dropdown-header">任务</li>',
                    ['label' => '任务列表', 'url' => '/cc-chinese-extraction/task'],
                    '<li class="divider"></li>',
                    '<li class="dropdown-header">进度</li>',
                    ['label' => '存储情况', 'url' => '/cc-chinese-extraction/storage'],
                ],
                'visible' => !Yii::$app->user->isGuest,
            ],
            [
                'label' => '正则清洗',
                'items' => [
                    ['label' => '主页', 'url' => '/cc-filtering'],
                    '<li class="divider"></li>',
                    '<li class="dropdown-header">任务</li>',
                    ['label' => '任务列表', 'url' => '/cc-filtering/task'],
                    '<li class="divider"></li>',
                    '<li class="dropdown-header">进度</li>',
                    ['label' => '存储情况', 'url' => '/cc-filtering/storage'],
                    '<li class="divider"></li>',
                    '<li class="dropdown-header">设置</li>',
                    ['label' => '过滤规则', 'url' => '/cc-filtering/filter'],
                ],
                'visible' => !Yii::$app->user->isGuest,
            ],
//            [
//                'label' => '数据去重',
//                'items' => [
//                    ['label' => '主页', 'url' => '/'],
//                    '<li class="divider"></li>',
//                    '<li class="dropdown-header">任务</li>',
//                    ['label' => '任务列表', 'url' => '/'],
//                    '<li class="divider"></li>',
//                    '<li class="dropdown-header">进度</li>',
//                    ['label' => '存储情况', 'url' => '/'],
//                ],
//                'visible' => !Yii::$app->user->isGuest,
//            ],
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
        <p class="pull-left">&copy; <?= Yii::$app->name . date(' Y'); ?></p>
    </div>
</footer>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
