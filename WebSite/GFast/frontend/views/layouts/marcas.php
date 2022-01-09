<?php
/* @var $this \yii\web\View */

/* @var $marcas common\models\Marcas */
/* @var $employees app\models\EmployeesSearch */


use yii\helpers\Html;

?>

<div class="brands_products"><!--brands_products-->
    <h2>Marcas</h2>
    <div class="brands-name">
        <ul class="nav nav-pills nav-stacked">

            <?php foreach($marcas as $marca) { ?>
                <li><a ><?= $marca->mar_nome?></a></li><?php
            } ?>

        </ul>
    </div>
</div>

<div class="brands_products"><!--brands_products-->
    <h2>Marcas</h2>
    <div class="brands-name">
        <ul class="nav nav-pills nav-stacked">

            <?php foreach($employees as $employee) {?>

                <li><a ><?= $employee->emp_nome?></a></li>
                <li><a ><?= $employee->emp_design?></a></li>
                <li><a ><?= $employee->emp_contact?></a></li>
                <li><a ><?= $employee->emp_email?></a></li>

            <?php  } ?>

        </ul>
    </div>
</div>
