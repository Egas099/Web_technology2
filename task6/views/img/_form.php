<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Img */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="img-form">

    <?php $form = ActiveForm::begin([
        'id' => 'img-form']) ?>

    <?= $form->field($modelImg, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelImg, 'caption')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelUploadImg, 'imageFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>