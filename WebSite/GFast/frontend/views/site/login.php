<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;



?>

<?= $this->render('..\layouts\header') ?>



    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto" id="positionLogin">
                <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                    <div class="left_img">
                    </div>
                        <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5 fw-light fs-5">LOGIN</h5>
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        <hr>
                        <div class="form-floating mb-3">
                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                        </div>

                        <div class="form-floating mb-3">
                            <?= $form->field($model, 'password')->passwordInput() ?>
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>

                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                            <?= Html::a('Não tens conta? Faz Registo',['site/signup'], ['class' => 'd-block text-center mt-2 small']) ?>

                            <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?= $this->render('..\layouts\footer') ?>






