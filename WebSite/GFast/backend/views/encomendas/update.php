<?php

use common\models\Carrinho;
use frontend\assets\BackendAsset;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Encomendas */

$this->title = 'Update Encomendas: ' . $model->enc_id;
$this->params['breadcrumbs'][] = ['label' => 'Encomendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->enc_id, 'url' => ['view', 'enc_id' => $model->enc_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="encomendas-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <div class="row">

    <?php
    \yii\web\YiiAsset::register($this);
    $backend = BackendAsset::register($this);
    $carrinhos = Carrinho::find()->where(['enc_id' => $model->enc_id, 'inativo' => 1])->all();
    foreach ($carrinhos as $carrinho) {

    $guitarra =\common\models\Guitarras::find()->where(['gui_id' => $carrinho->gui_id])->one();

    ?>



        <div class="col-sm-3">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <?= Html::img($backend->baseUrl . "/" . $guitarra->gui_fotopath, ['alt' => '']) ?>
                        <h2><?= $guitarra->gui_preco ?>€</h2>
                        <p><?= $guitarra->gui_nome ?> </p>
                    </div>
                </div>
            </div>
        </div>

        <?php


    }
    ?>

</div>
</div>
