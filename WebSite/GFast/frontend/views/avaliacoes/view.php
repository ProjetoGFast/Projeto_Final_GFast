<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Avaliacoes */

$this->title = $model->ava_id;
$this->params['breadcrumbs'][] = ['label' => 'Avaliacoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="avaliacoes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ava_id' => $model->ava_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ava_id' => $model->ava_id], [
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
            'ava_id',
            'ava_avaliacao:ntext',
            'ava_idguitarra',
            'ava_iduser',
        ],
    ]) ?>

</div>
