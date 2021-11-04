<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'us_nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'us_apelido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'us_cidade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'us_telemovel')->textInput() ?>

    <?= $form->field($model, 'us_contribuinte')->textInput() ?>

    <?= $form->field($model, 'us_pontos')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
