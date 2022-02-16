<?php

use common\models\Encomendas;
use common\models\Guitarras;
use frontend\assets\BackendAsset;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $guitarras common\models\Guitarras */
/* @var $model common\models\Encomendas */
/* @var $carrinhos common\models\Carrinho */
$total = 0;
\yii\web\YiiAsset::register($this);
$backend = BackendAsset::register($this);
?>

<?= $this->render('..\layouts\header') ?>

    <div class="features_items"><!--features_items-->
    <h2 class="title text-center">Compra</h2>

    <div class="container">
    <div class="row">
        <div class="col-sm-6">
            <?php

            foreach ($carrinhos as $carrinho) {
                $guitarra = Guitarras::find()->where(['gui_id' => $carrinho->gui_id])->one();

                $total = $total + $guitarra->gui_preco;

                ?>

                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <div class="col-sm-4">
                                <?= Html::img($backend->baseUrl . "/" . $guitarra->gui_fotopath, ['alt' => '']) ?>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="alignright">
                                <h2><?= $guitarra->gui_preco ?>€</h2>
                                <p><?= $guitarra->gui_nome ?> </p>

                                <div class="botoescarrinho">

                                    <?= Html::a('<i class="fa fa-plus"></i>&nbsp Ver Mais', ['site/produto', 'id' => $guitarra->gui_id], ['class' => 'btn btn-primary btncar']) ?>

                                </div>


                            </div>
                        </div>

                    </div>
                </div>
                <?php
            } ?>


        </div>
        <div class="col-sm-6">

            <div class="encomendas-form">
                <?php $encomendaform = new Encomendas(); ?>
                <?= $this->render('_form', [
                    'model' => $encomendaform, 'total' => $total
                ]) ?>

            </div>


        </div>

    </div>
    </div>




<?= $this->render('..\layouts\footer') ?>