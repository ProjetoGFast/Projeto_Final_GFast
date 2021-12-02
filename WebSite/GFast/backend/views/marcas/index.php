<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MarcasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marcas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marcas-index">
    <div class="row">
        <div class="col-md-6 col-6 col-6 centeralign">
            <p class="alignbtn">
            <h1><?= Html::encode($this->title) ?></h1>
            </p>
        </div>

        <div class="col-md-6 col-6 col-6" style="text-align: right;">
            <p>
                <?= Html::a('Criar Marca', ['create'], ['class' => 'btncreate']) ?>
            </p>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [

                'attribute' => 'mar_id',
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['style' => 'width:5%'];
                },
            ],
            [

                'attribute' => 'mar_nome',
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['style' => 'width:80%'];
                },
            ],
            [

                'attribute' => 'mar_inativo',


                'value' => function ($model, $key, $index, $column) {

                    return $model->mar_inativo == 0 ? 'Ativo' : 'Inativo';
                },
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['style' => 'width:100px; text-align:center; background-color:'
                        . ($model->mar_inativo == 0 ? 'green' : 'red')];
                },
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);


   ?>


</div>
