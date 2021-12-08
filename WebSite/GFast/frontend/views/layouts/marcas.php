<?php
/* @var $this \yii\web\View */

/* @var $marcas common\models\Marcas */


use yii\helpers\Html;

?>

<div class="brands_products"><!--brands_products-->
    <h2>Marcas</h2>
    <div class="brands-name">
        <ul class="nav nav-pills nav-stacked">
            <?php
            foreach($marcas as $marca){
                ?><li>
                    <a ><?= $marca->mar_nome?></a>
                </li><?php
            }

            ?>
        </ul>
    </div>
</div>
