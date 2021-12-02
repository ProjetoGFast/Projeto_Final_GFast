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


    <div class="row">
        <div class="col-md-6 col-6 col-6 leftalign">
            <p class="alignbtn">
            <h1><?= Html::encode($this->title) ?></h1>
            </p>
        </div>

        <div class="col-md-6 col-6 col-6 rightalign">
            <p>
                <?= Html::a('Criar Subcategoria', ['create'], ['class' => 'btncreate']) ?>
            </p>
        </div>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [

                'attribute' => 'sub_id',
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['style' => 'width:5%'];
                },
            ],
            [

                'attribute' => 'sub_nome',
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['style' => 'width:45%'];
                },
            ],
            [

                'attribute' => 'sub_idcat',
                'value' => 'subIdcat.cat_nome',
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['style' => 'width:45%'];
                },

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
