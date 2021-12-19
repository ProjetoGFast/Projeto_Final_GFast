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
        <div class="row">


            <?php
            foreach ($marcas as $marca) { ?>

                <div class="col-sm-4">
                    <div class="marcas-box">
                        <div class="single-products">
                            <div class=" text-center">
                                <div>
                                    <?=  Html::a(Html::img("@web/images/marcas/$marca->mar_nome.png", ['class' => 'marca']) , ['view', 'id' => $marca->mar_id])?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>


<?= $this->render('..\layouts\footer') ?>