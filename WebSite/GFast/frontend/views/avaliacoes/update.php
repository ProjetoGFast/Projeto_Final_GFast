<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Avaliacoes */


    $this->title = 'Editar Avaliação: ' . $model->ava_id;
    ?>
    <div class="avaliacoes-update">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
