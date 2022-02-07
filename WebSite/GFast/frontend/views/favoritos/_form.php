<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Favoritos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="favoritos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fav_idguitarras')->textInput() ?>

    <?= $form->field($model, 'fav_iduser')->textInput() ?>

    <?= $form->field($model, 'fav_idsaldo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
