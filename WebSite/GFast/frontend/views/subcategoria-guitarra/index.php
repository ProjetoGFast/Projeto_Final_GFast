<?php

use common\models\Subcategoriaguitarra;
use yii\helpers\Html;
use frontend\assets\BackendAsset;

/* @var $this yii\web\View */
/* @var $sub common\models\Subcategoriaguitarra */
/* @var $form yii\widgets\ActiveForm */

$backend = BackendAsset::register($this);

?>

<?= $this->render('..\layouts\header') ?>

<div class="features_items"><!--features_items-->
    <div class="row">


        <?php
        foreach ($sub as $subcategoria) {
        ?>

            <div class="col-sm-4">
                <div class="marcas-box">
                    <div class="single-products">
                        <div class=" text-center">
                            <div>
                                <?=  Html::a($subcategoria->sub_nome , ['view', 'id' => $subcategoria->sub_id])?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>
</div>


<?= $this->render('..\layouts\footer') ?>
