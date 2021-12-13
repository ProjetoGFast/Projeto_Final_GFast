<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CategoriaGuitarra */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-guitarra-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cat_nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cat_inativo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'name' => 'submitbtn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
