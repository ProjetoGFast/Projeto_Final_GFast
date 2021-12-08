<?php

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $guitarras common\models\Guitarras */
/* @var $form yii\widgets\ActiveForm */

use frontend\assets\BackendAsset;
use yii\helpers\Html;


$backend = BackendAsset::register($this);

?>
<?= $this->render('..\layouts\header') ?>
    <main class="container">
    <div class="row">
        <!-- Left Column / Headphones Image -->
        <div class="col-sm-6">

            <?= Html::img($backend->baseUrl."/".$model->gui_fotopath, ['class' => 'activeproduto']) ?>
        </div>


        <!-- Right Column -->
        <div class="col-sm-6">

            <!-- Product Description -->
            <div class="product-description">
                <h1> <?=  $model->gui_nome ?></h1>
            </div>
            <!-- Product Pricing -->
            <div class="product-price">
                <span><?=  $model->gui_preco ?>€</span>
                <a href="#" class="cart-btn"><i class="fa fa-shopping-cart"></i>Adicionar ao Carrinho</a>
            </div>
            <div class="product-description">
                <h3>Descrição</h3>
            </div>
            <p><?=  $model->gui_descricao ?></p>
        </div>
    </div>

        <div class="row">
            <!-- Product Description -->
            <div class="product-description">

                <h3>Outros Produtos</h3>
            </div>
            <div class="col-sm-12">
        <div id="swiper_content">
            <div class="swiper mySwiper">

                <div class="swiper-wrapper">
                    <?php
                    foreach ($guitarras as $guitarra) { ?>
                        <div class="swiper-slide">
                            <div class="slider-box">
                                <div class="img-box">
                                    <?= Html::img($backend->baseUrl."/".$guitarra->gui_fotopath) ?>
                                </div>
                                <p class="detail"><?=$guitarra->gui_nome?> </p>
                                <div class="cart">
                                    <?= Html::a('Ver', ['produto', 'id' => $guitarra->gui_id]) ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
        </div>
        </div>

    </main>



<?= $this->render('..\layouts\footer') ?>