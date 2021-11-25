<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Guitarras */

$this->title = 'Update Guitarras: ' . $model->gui_id;
$this->params['breadcrumbs'][] = ['label' => 'Guitarras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->gui_id, 'url' => ['view', 'gui_id' => $model->gui_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="guitarras-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
