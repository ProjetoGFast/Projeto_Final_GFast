<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use common\models\Categoriaguitarra;
use common\models\Subcategoriaguitarra;


$categorias = Categoriaguitarra::find()->all();

?>

<h2>Categorias</h2>
<div class="panel-group category-products" id="accordian">
    <?php
   /* foreach ($categorias as $categoria)
    {

        $subcategorias = Subcategoriaguitarra::find()
            ->where(['sub_idcat' => $categoria->cat_id])
            ->all();
*/
        ?>
        <!--category-productsr-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                        <?php // $categoria->cat_nome?>
                    </a>
                </h4>
            </div>
            <div id="sportswear" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
                        <?php
                        /*foreach ($subcategorias as $subcategoria) { ?>
                            <li><a href="#"><?= $subcategoria->sub_nome?> </a></li>
                        <?php }*/ ?>

                    </ul>
                </div>

            </div>
        </div>
        <?php
    //}
    ?>

</div>

