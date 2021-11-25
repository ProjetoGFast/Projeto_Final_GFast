<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GuitarrasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guitarras-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'gui_id') ?>

    <?= $form->field($model, 'gui_nome') ?>

    <?= $form->field($model, 'gui_idsubcategoria') ?>

    <?= $form->field($model, 'gui_idmarca') ?>

    <?= $form->field($model, 'gui_idreferencia') ?>

    <?php // echo $form->field($model, 'gui_descricao') ?>

    <?php // echo $form->field($model, 'gui_preco') ?>

    <?php // echo $form->field($model, 'gui_iva') ?>

    <?php // echo $form->field($model, 'gui_fotopath') ?>

    <?php // echo $form->field($model, 'gui_qrcodepath') ?>

    <?php // echo $form->field($model, 'gui_inativo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
