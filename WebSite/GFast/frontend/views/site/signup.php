<?php

use frontend\models\SignupForm;
use frontend\models\User;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model User */


?>

<?= $this->render('..\layouts\header') ?>

<div class="container">
    <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto" id="positionLogin">
            <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                <div class="left_img">
                </div>
                <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title text-center mb-5 fw-light fs-5">REGISTO</h5>
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    <hr>
                    <div class="form-floating mb-3">
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                    </div>

                    <div class="form-floating mb-3">
                        <?= $form->field($model, 'email') ?>
                    </div>

                    <div class="form-floating mb-3">
                        <?= $form->field($model, 'us_nome') ?>
                    </div>

                    <div class="form-floating mb-3">
                        <?= $form->field($model, 'us_apelido') ?>
                    </div>

                    <div class="form-floating mb-3">
                        <?= $form->field($model, 'us_cidade') ?>
                    </div>

                    <div class="form-floating mb-3">
                        <?= $form->field($model, 'us_telemovel') ?>
                    </div>

                    <div class="form-floating mb-3">
                        <?= $form->field($model, 'us_contribuinte') ?>
                    </div>

                    <div class="form-floating mb-3">
                        <?= $form->field($model, 'password')->passwordInput() ?>
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>

                    <?= Html::a('Já tens conta? Faz login',['site/login'], ['class' => 'd-block text-center mt-2 small']) ?>




                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->render('..\layouts\footer') ?>











