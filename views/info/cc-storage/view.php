<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CcStorage */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '信息中心', 'url' => ['/info']];
$this->params['breadcrumbs'][] = ['label' => '本地文件列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="cc-storage-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_drive',
            'driveName',
            'id_year_month',
            'yearMonthStr',
            'prefix',
            'path',
            'size',
        ],
    ]) ?>

</div>
