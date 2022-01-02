<?php

use frontend\assets\BackendAsset;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $guitarras common\models\Guitarras */
/* @var $subcat common\models\Subcategoriaguitarra */

\yii\web\YiiAsset::register($this);
$backend = BackendAsset::register($this);
?>
<?= $this->render('..\layouts\header') ?>


<div class="features_items"><!--features_items-->
    <h2 class="title text-center"><?= $subcat->sub_nome ?></h2>


    <?php
    if ($guitarras != null){


        foreach ($guitarras as $guitarra) { ?>

            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <?= Html::img($backend->baseUrl . "/" . $guitarra->gui_fotopath, ['alt' => '']) ?>
                            <h2><?= $guitarra->gui_preco ?>€</h2>
                            <p><?= $guitarra->gui_nome ?> </p>
                        </div>
                        <div class="product-overlay">
                            <div class="overlay-content">
                                <h2><?= $guitarra->gui_preco ?>€</h2>
                                <p><?= $guitarra->gui_nome ?> </p>
                                <div class="btn btn-default add-to-cart"><i class="fa fa-plus"></i>
                                    <?= Html::a('Ver Mais', ['produto', 'id' => $guitarra->gui_id]) ?>
                                </div>
                                <div class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>
                                    <?= Html::a('Adicionar', ['produto', 'id' => $guitarra->gui_id]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php }
    }
    else
    {
    ?>

    <div class="col-sm-12">
    <h4>Sem Modelos a Apresentar </h4>
        <?= Html::a('Voltar atrás', ['index'], ['class' => 'btn btn-primary']) ?>
    </div>
  <?php }

    ?>


</div>

<?= $this->render('..\layouts\footer') ?>



