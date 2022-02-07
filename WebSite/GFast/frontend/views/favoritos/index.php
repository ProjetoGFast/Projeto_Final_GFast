<?php

use common\models\Favoritos;
use frontend\assets\BackendAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $guitarras common\models\Guitarras */
/* @var $model common\models\Favoritos */


\yii\web\YiiAsset::register($this);
$backend = BackendAsset::register($this);
?>


<?= $this->render('..\layouts\header') ?>

<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Guitarras Favoritas</h2>


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
                                    <?= Html::a('Ver Mais', ['site/produto', 'id' => $guitarra->gui_id]) ?>
                                </div>
                                <div class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>
                                    <?= Html::a('Eliminar dos Favoritos', ['delete', 'idguitarra' => $guitarra->gui_id], [

                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this item?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>

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

            <?= Html::a('Voltar atrás', ['/subcategoria-guitarra/index' , 'id'=>$subcat->sub_idcat], ['class' => 'btn btn-primary']) ?>

        </div>
    <?php }

    ?>


</div>
<?= $this->render('..\layouts\footer') ?>
