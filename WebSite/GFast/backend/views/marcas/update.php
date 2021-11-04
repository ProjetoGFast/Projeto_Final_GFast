<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Marcas */

$this->title = 'Update Marcas: ' . $model->mar_id;
$this->params['breadcrumbs'][] = ['label' => 'Marcas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->mar_id, 'url' => ['view', 'mar_id' => $model->mar_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="marcas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
