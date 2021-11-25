<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Guitarras */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guitarras-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gui_nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gui_idsubcategoria')->textInput() ?>

    <?= $form->field($model, 'gui_idmarca')->textInput() ?>

    <?= $form->field($model, 'gui_idreferencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gui_descricao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'gui_preco')->textInput() ?>

    <?= $form->field($model, 'gui_iva')->textInput() ?>

    <?= $form->field($model, 'gui_fotopath')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gui_qrcodepath')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gui_inativo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
