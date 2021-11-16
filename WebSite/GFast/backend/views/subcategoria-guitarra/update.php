<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SubcategoriaGuitarra */

$this->title = 'Update Subcategoria Guitarra: ' . $model->sub_id;
$this->params['breadcrumbs'][] = ['label' => 'Subcategoria Guitarras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sub_id, 'url' => ['view', 'sub_id' => $model->sub_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subcategoria-guitarra-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
