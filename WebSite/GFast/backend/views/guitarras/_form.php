<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Marcas;
use common\models\Subcategoriaguitarra;

/* @var $this yii\web\View */
/* @var $model common\models\Guitarras */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guitarras-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'gui_nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gui_idsubcategoria')->dropDownList(ArrayHelper::map(Subcategoriaguitarra::find()->all(), 'sub_id','sub_nome'), ['prompt'=>'Seleciona uma SubCategoria']); ?>

    <?= $form->field($model, 'gui_idmarca')->dropDownList(ArrayHelper::map(Marcas::find()->all(), 'mar_id','mar_nome'), ['prompt'=>'Seleciona uma Marca']); ?>

    <?= $form->field($model, 'gui_idreferencia')->textInput() ?>

    <?= $form->field($model, 'gui_descricao')->textarea(array('rows'=>5)) ?>

    <?= $form->field($model, 'gui_preco')->textInput() ?>

    <?= $form->field($model, 'gui_iva')->textInput() ?>

    <?= $form->field( $model, 'gui_fotopath')->fileInput(['accept' => 'image/*']) ?>

    <?= Html::img('@web/../../common/fotos/'.$model->gui_fotopath, ['alt' => 'My logo', 'class' => 'imagesize']) ?>



    <?= $form->field($model, 'gui_inativo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
