<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Encomendas */

$this->title = 'Update Encomendas: ' . $model->enc_id;
$this->params['breadcrumbs'][] = ['label' => 'Encomendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->enc_id, 'url' => ['view', 'enc_id' => $model->enc_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="encomendas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
