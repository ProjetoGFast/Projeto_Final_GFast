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


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->gui_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->gui_id], [
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
            [

                'attribute'=>'gui_idmarca',

                'value'=>$model->guiIdmarca->mar_nome,

            ],
            'gui_nome',
            [

                'attribute'=>'gui_idsubcategoria',

                'value'=>$model->guiIdsubcategoria->sub_nome,

            ],
            'gui_idreferencia',
            'gui_descricao',
            'gui_preco',
            'gui_iva',
            'gui_inativo',

        ],
    ]) ?>

</div>
