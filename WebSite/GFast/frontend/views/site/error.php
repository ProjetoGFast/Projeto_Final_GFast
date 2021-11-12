<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Ocorreu um erro enquanto o servidor processava o seu pedido.
    </p>
    <p>
        Por favor contacte a administração do GFast.
        <?= Html::a('geral@gfast.pt',['mailto:geral@gfast']) ?>
    </p>


</div>
