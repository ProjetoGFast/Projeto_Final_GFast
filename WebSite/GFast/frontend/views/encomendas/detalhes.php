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
/* @var $encomenda common\models\Encomendas */
/* @var $carrinhos common\models\Carrinho */
$total = 0;
\yii\web\YiiAsset::register($this);
$backend = BackendAsset::register($this);
?>

<?= $this->render('..\layouts\header') ?>

    <div class="features_items"><!--features_items-->
    <h2 class="title text-center">Encomenda</h2>

    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <?php
                $carrinhos = \common\models\Carrinho::find()->where(['enc_id' => $encomenda->enc_id, 'inativo' => 1])->all();
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
                    <p><strong>Morada:</strong>&nbsp;<?=$encomenda->enc_morada?></p>
                    <p><b>Notas:</b>&nbsp;<?=$encomenda->enc_nome?></p>
                    <p><b>Estado da Encomenda:</b>&nbsp;<?=$encomenda->encEstado->Estado?></p>
                </div>


            </div>

        </div>
    </div>




<?= $this->render('..\layouts\footer') ?>