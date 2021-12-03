<?php

use common\models\Subcategoriaguitarra;
use yii\helpers\Html;


$id = $_GET['id'];


$subcategorias = Subcategoriaguitarra::find()
    ->where(['sub_idcat' => $id])
    ->all();

?>


<div id="swiper_content">
<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <?php
        foreach ($subcategorias as $subcategoria) { ?>
        <div class="swiper-slide">
            <div class="slider-box">
                <div class="img-box">
                    <img src="../web/images/home/product1.png">
                </div>
                <p class="detail"><?=$subcategoria->sub_nome?> </p>
                <div class="cart">
                    <a href="#">Abrir</a>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>
</div>
</div>

