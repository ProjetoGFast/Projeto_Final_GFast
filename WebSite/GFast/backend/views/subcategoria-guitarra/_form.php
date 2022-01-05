<?php


use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Categoriaguitarra;

/* @var $this yii\web\View */
/* @var $model common\models\SubcategoriaGuitarra */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subcategoria-guitarra-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sub_nome')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'sub_idcat')->dropDownList(ArrayHelper::map(Categoriaguitarra::find()->all(), 'cat_id','cat_nome'), ['prompt'=>'Seleciona uma Marca']); ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'name' => 'submitbtn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
