<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FavoritosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="favoritos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fav_id') ?>

    <?= $form->field($model, 'fav_idguitarras') ?>

    <?= $form->field($model, 'fav_iduser') ?>

    <?= $form->field($model, 'fav_idsaldo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
