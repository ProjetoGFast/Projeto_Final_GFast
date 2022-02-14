<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Encomendas */
/* @var $form yii\widgets\ActiveForm */
/* @var $total */
?>

<div class="encomendas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'enc_nome')->textarea() ?>

    <?= $form->field($model, 'enc_morada')->textarea() ?>
    <div class="row pb-5" style="text-align: end;">
        <div class="col-sm-8">
            <label class="labelcarrinho">Total no Carrinho: <?= $total ?> € </label>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <?= Html::submitButton('Continuar Compra', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>



    <?php ActiveForm::end(); ?>

</div>
