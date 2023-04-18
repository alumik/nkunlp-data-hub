<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Drive */

$this->title = '更新存储设备：' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '信息中心', 'url' => ['/info']];
$this->params['breadcrumbs'][] = ['label' => '存储设备', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="drive-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
