<?php
use common\models\Guitarras;
use yii\helpers\Html;
use frontend\assets\BackendAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Guitarras */
/* @var $form yii\widgets\ActiveForm */

$backend = BackendAsset::register($this);

$guitarras = Guitarras::find()
    ->all();
?>
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Guitarras</h2>


    <?php
    foreach ($guitarras as $guitarra) { ?>



    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <?= Html::img($backend->baseUrl."/".$guitarra->gui_fotopath, ['alt' => '']) ?>
                    <h2><?=$guitarra->gui_preco?>€</h2>
                    <p><?=$guitarra->gui_nome?> </p>
                </div>
                <div class="product-overlay">
                    <div class="overlay-content">
                        <h2><?=$guitarra->gui_preco?>€</h2>
                        <p><?=$guitarra->gui_nome?> </p>
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

    <?php } ?>

</div>
