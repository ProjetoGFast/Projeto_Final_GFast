<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SubcategoriaGuitarra */

$this->title = $model->sub_id;
$this->params['breadcrumbs'][] = ['label' => 'Subcategoria Guitarras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="subcategoria-guitarra-view">



    <p>
        <?= Html::a('Update', ['update', 'sub_id' => $model->sub_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'sub_id' => $model->sub_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);

        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sub_id',
            'sub_nome',
           // 'sub_idcat',
            //'Categoria'=>$model->sub_idcat,
            [

                'attribute'=>'sub_idcat',

              'value'=>$model->subIdcat->cat_nome,

            ],
        ],
    ]) ?>

</div>
