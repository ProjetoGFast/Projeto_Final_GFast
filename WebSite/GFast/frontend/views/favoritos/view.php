<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Favoritos */



\yii\web\YiiAsset::register($this);
?>
<div class="favoritos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'fav_id' => $model->fav_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'fav_id' => $model->fav_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fav_id',
            'fav_idguitarras',
            'fav_iduser',
            'fav_idsaldo',
        ],
    ]) ?>

</div>
