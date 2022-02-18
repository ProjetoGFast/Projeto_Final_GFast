<?php

use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Estados;

/* @var $this yii\web\View */
/* @var $model common\models\Encomendas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="encomendas-form">

    <?php $form = ActiveForm::begin(); ?>




    <?= $form->field($model, 'enc_estado')->dropDownList(ArrayHelper::map(Estados::find()->all(), 'est_id','Estado'), ['prompt'=>'Seleciona um Estado']); ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
