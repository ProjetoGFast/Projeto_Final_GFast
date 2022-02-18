<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Avaliacoes */


?>
<div class="avaliacoes-create">

    <h3>Criar Avaliação</h3>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
