<?php

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $guitarras common\models\Guitarras */
/* @var $form yii\widgets\ActiveForm */

use frontend\assets\BackendAsset;
use yii\helpers\Html;


$backend = BackendAsset::register($this);

?>
<div class="row">
    <!-- Product Description -->
    <div class="product-description">

        <h3>RECOMENDADOS</h3>
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
                                    <?= Html::img($backend->baseUrl . "/" . $guitarra->gui_fotopath) ?>
                                </div>
                                <p class="detail"><?= $guitarra->gui_nome ?> </p>
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
