<?php

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */

use frontend\assets\BackendAsset;
use yii\helpers\Html;

$backend = BackendAsset::register($this);

?>
<?= $this->render('..\layouts\header') ?>
<main class="container">

    <!-- Left Column / Headphones Image -->
    <div class="col-sm-6">
        <img data-image="black" src="images/black.png" alt="">
        <img data-image="blue" src="images/blue.png" alt="">
        <img data-image="red" class="active" src="images/red.png" alt="">
        <?= Html::img($backend->baseUrl."/ESP_E_II_M_II_NT_BTB.jpg", ['class' => 'active']) ?>
    </div>


    <!-- Right Column -->
    <div class="col-sm-6">

        <!-- Product Description -->
        <div class="product-description">
            <span>Headphones</span>
            <h1>Beats EP</h1>
            <p>The preferred choice of a vast range of acclaimed DJs. Punchy, bass-focused sound and high isolation. Sturdy headband and on-ear cushions suitable for live performance</p>
        </div>

        <!-- Product Configuration -->
        <div class="product-configuration">

            <!-- Product Color -->
            <div class="product-color">
                <span>Color</span>

                <div class="color-choose">
                    <div>
                        <input data-image="red" type="radio" id="red" name="color" value="red" checked>
                        <label for="red"><span></span></label>
                    </div>
                    <div>
                        <input data-image="blue" type="radio" id="blue" name="color" value="blue">
                        <label for="blue"><span></span></label>
                    </div>
                    <div>
                        <input data-image="black" type="radio" id="black" name="color" value="black">
                        <label for="black"><span></span></label>
                    </div>
                </div>

            </div>

            <!-- Cable Configuration -->
            <div class="cable-config">
                <span>Cable configuration</span>

                <div class="cable-choose">
                    <button>Straight</button>
                    <button>Coiled</button>
                    <button>Long-coiled</button>
                </div>

                <a href="#">How to configurate your headphones</a>
            </div>
        </div>

        <!-- Product Pricing -->
        <div class="product-price">
            <span>148$</span>
            <a href="#" class="cart-btn">Add to cart</a>
        </div>
    </div>
</main>

<?= $this->render('..\layouts\footer') ?>