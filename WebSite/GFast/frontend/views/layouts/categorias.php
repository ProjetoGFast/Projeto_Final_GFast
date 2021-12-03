<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use common\models\Categoriaguitarra;



$categoria = Categoriaguitarra::find()->all();


?>


<h2>Categorias</h2>
<div class="panel-group category-products" id="accordian">
<?php
foreach ($categoria as $categorias)
{

?>

    <!--category-productsr-->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                    <?= $categorias->cat_nome?>
                </a>
            </h4>
        </div>
        <div id="sportswear" class="panel-collapse collapse">
            <div class="panel-body">
                <ul>
                    <li><a href="#">Modelo Dreadnought </a></li>
                    <li><a href="#">Modelo Folk </a></li>
                    <li><a href="#">Modelo Jumbo </a></li>
                    <li><a href="#">Modelo Roundback </a></li>
                    <li><a href="#">Modelo Esquerdinos </a></li>
                </ul>
            </div>
        </div>
    </div>
<?php
}
?>

</div>
