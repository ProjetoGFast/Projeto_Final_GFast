<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Marcas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marcas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mar_nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mar_inativo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
