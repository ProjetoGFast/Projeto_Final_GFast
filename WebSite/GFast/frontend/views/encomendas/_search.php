<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\EncomendasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="encomendas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'enc_id') ?>

    <?= $form->field($model, 'enc_nome') ?>

    <?= $form->field($model, 'enc_morada') ?>

    <?= $form->field($model, 'enc_estado') ?>

    <?= $form->field($model, 'enc_iduser') ?>

    <?php // echo $form->field($model, 'enc_idguitarra') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
