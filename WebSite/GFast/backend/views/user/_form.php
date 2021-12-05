<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form" style="left:50%">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 col-6">
            <?= $form->field($model, 'us_nome')->textInput(['maxlength' => true]) ?>


        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-6">
            <?= $form->field($model, 'us_apelido')->textInput(['maxlength' => true]) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <?= $form->field($model, 'password_hash')->passwordInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <?= $form->field($model, 'us_cidade')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 col-6">
            <?= $form->field($model, 'us_telemovel')->textInput() ?>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-6">
            <?= $form->field($model, 'us_contribuinte')->textInput() ?>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-4">
            <?= $form->field($model, 'us_pontos')->textInput() ?>
        </div>
    </div>






                <div class="form-group">
                    <?= Html::submitButton('Save', ['name'=>'submitbtn','class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

</div>
