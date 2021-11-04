<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SubcategoriaGuitarra */

$this->title = 'Create Subcategoria Guitarra';
$this->params['breadcrumbs'][] = ['label' => 'Subcategoria Guitarras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategoria-guitarra-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
