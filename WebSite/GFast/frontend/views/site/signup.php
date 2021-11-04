<?php

use frontend\models\SignupForm;
use frontend\models\User;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model User */



$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>
    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
    <div class="row">
        <div class="col-lg-5">


                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'us_nome') ?>

                <?= $form->field($model, 'us_apelido') ?>

                <?= $form->field($model, 'us_cidade') ?>

                <?= $form->field($model, 'us_telemovel') ?>

                <?= $form->field($model, 'us_contribuinte') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
