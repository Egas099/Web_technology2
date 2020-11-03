<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Img */

$this->title = 'Update Image: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "$model->name (Update)"];
?>
<div class="img-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::img("../web/upload/{$modelImg->path}", ['height' => '400px', 'class' => 'img']) ?>

    <?= $this->render('_form', [
        'modelImg' => $modelImg,
        'modelUploadImg' => $modelUploadImg,
    ]) ?>

</div>
