<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Guitarras */

$this->title = $model->gui_id;
$this->params['breadcrumbs'][] = ['label' => 'Guitarras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="guitarras-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'gui_id' => $model->gui_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'gui_id' => $model->gui_id], [
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
            'gui_id',
            'gui_nome',
            'gui_idsubcategoria',
            'gui_idmarca',
            'gui_idvenda',
            'gui_idreferencia',
            'gui_descricao',
            'gui_preco',
            'gui_iva',
            'gui_inativo',
        ],
    ]) ?>

</div>
