<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategoriaGuitarraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categoria Guitarras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-guitarra-index">

    <div class="row">
        <div class="col-md-6 col-6 col-6 leftalign">
            <p class="alignbtn">
            <h1><?= Html::encode($this->title) ?></h1>
            </p>
        </div>

        <div class="col-md-6 col-6 col-6 rightalign">
            <p>
                <?= Html::a('Criar Categoria', ['create'], ['class' => 'btncreate']) ?>
            </p>
        </div>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [

                'attribute' => 'cat_id',
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['style' => 'width:5%'];
                },
            ],
            [

                'attribute' => 'cat_nome',
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['style' => 'width:80%'];
                },
            ],
            [

                'attribute' => 'cat_inativo',


                'value' => function ($model, $key, $index, $column) {

                    return $model->cat_inativo == 0 ? 'Ativo' : 'Inativo';
                },
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['style' => 'width:10%; text-align:center; background-color:'
                        . ($model->cat_inativo == 0 ? 'green' : 'red')];
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
