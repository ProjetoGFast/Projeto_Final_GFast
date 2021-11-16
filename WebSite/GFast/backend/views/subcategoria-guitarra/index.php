<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SubcategoriaGuitarraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subcategoria Guitarras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategoria-guitarra-index">



    <p>
        <?= Html::a('Criar Subcategoria ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sub_id',
            'sub_nome',
          //  'sub_idcat',
            [

                'attribute'=>'sub_idcat',

                'value'=>function ($model, $key, $index, $column) {

                   return $model->subIdcat->cat_nome;
                },

            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
