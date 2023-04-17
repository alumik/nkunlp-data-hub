<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Drive */

$this->title = '新建存储设备';
$this->params['breadcrumbs'][] = ['label' => '存储设备', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drive-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
