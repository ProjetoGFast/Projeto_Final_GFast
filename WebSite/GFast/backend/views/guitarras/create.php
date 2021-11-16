<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Guitarras */

$this->title = 'Create Guitarras';
$this->params['breadcrumbs'][] = ['label' => 'Guitarras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guitarras-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
