<?php

/* @var $this yii\web\View */
/* @var $model common\models\Guitarras */
/* @var $guitarras common\models\Guitarras */
/* @var $favorito common\models\Favoritos */

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

                <?= Html::img($backend->baseUrl . "/" . $model->gui_fotopath, ['class' => 'activeproduto']) ?>
            </div>


            <!-- Right Column -->
            <div class="col-sm-6">

                <!-- Product Description -->
                <div class="product-description">
                    <h1> <?= $model->gui_nome ?></h1>
                </div>
                <!-- Product Pricing -->
                <div class="product-price">
                    <span><?= $model->gui_preco ?>€</span>
                    <?php
                    if (!Yii::$app->user->isGuest) {

                        ?>
                        <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbspAdicionar ao Carrinho', ['/site/index'], ['class' => 'cart-btn']) ?>
                        <?php
                        $icone = "fa fa-heart-o";
                        if ($favorito !== null) {

                            $icone = "fa fa-heart";
                        }
                    }
                    ?>
                    <?= Html::a('<i class="' . $icone . '"></i>', ['favoritos/update', 'fav_idguitarras' => $model->gui_id], ['class' => 'cart-btn']) ?>
                </div>
                <div class="product-description">
                    <h3>Descrição</h3>
                </div>
                <p><?= $model->gui_descricao ?></p>
            </div>
        </div>
        <?= $this->render('../avaliacoes/avaliacoes', ['id' => $model->gui_id]); ?>


        <?= $this->render('recomendados', ['guitarras' => $guitarras,]); ?>


    </main>


<?= $this->render('..\layouts\footer') ?>