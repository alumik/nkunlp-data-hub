<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CcDownload */

$this->title = 'Create Cc Download';
$this->params['breadcrumbs'][] = ['label' => 'Cc Downloads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cc-download-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
