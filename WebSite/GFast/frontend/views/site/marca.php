<?php

use common\models\Marcas;
use yii\helpers\Html;
use frontend\assets\BackendAsset;

/* @var $this yii\web\View */
/* @var $marcas common\models\Marcas */
/* @var $form yii\widgets\ActiveForm */

$backend = BackendAsset::register($this);

?>

<?= $this->render('..\layouts\header') ?>

    <div class="features_items"><!--features_items-->

        <p>Marcas</p>
        <br>

    <?php
    foreach ($marcas as $marca) { ?>

        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <p><?=$marca->mar_nome?> </p>
                        <div class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>
                            <?= Html::a('Ver', ['##', 'id' => $marca->mar_id]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="##" alt="" />
                        <p>Marca1</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>

                    <div class="product-overlay">
                        <div class="overlay-content">
                            <p>Marca1</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="##" alt="" />
                        <p>Marca1</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="##" alt="" />
                        <p>Marca1</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                    <img src="images/home/new.png" class="new" alt="" />
                </div>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="##" alt="" />
                        <p>Marca1</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                    <img src="images/home/sale.png" class="new" alt="" />
                </div>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="##" alt="" />
                        <p>Marca1</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>

    </div>




<?= $this->render('..\layouts\footer') ?>