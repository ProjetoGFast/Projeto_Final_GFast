<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SubcategoriaGuitarra */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subcategoria-guitarra-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sub_nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_idcat')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
