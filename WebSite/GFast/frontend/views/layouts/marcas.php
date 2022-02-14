<?php
/* @var $this \yii\web\View */

/* @var $marcas common\models\Marcas */

/* @var $employees app\models\EmployeesSearch */


use yii\helpers\Html;

?>

<div class="brands_products"><!--brands_products-->
    <h2>Marcas</h2>
    <div class="brands-name">
        <ul class="navbarorientation nav-pills nav-stacked">

            <?php foreach ($marcas as $marca) { ?>
                <li>     <?= Html::a($marca->mar_nome, ['marcas/view', 'id' => $marca->mar_id]) ?></li><?php
            } ?>

        </ul>
    </div>
</div>

