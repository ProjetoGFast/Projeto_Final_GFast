<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CategoriaGuitarra */

$this->title = 'Update Categoria Guitarra: ' . $model->cat_id;
$this->params['breadcrumbs'][] = ['label' => 'Categoria Guitarras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cat_id, 'url' => ['view', 'cat_id' => $model->cat_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="categoria-guitarra-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
