<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model ContactForm */

use frontend\models\ContactForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;


?>

<?= $this->render('..\layouts\header') ?>

<div class="site-contact">

    <h1>
      Contata-nos
    </h1>

    <div class="row">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>



                <div class="form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>

        <div class="col-lg-6 pb-4">
            <div id='map' ></div>
        </div>
    </div>

</div>

<?= $this->render('..\layouts\footer') ?>