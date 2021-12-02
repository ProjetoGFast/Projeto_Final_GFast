<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GuitarrasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Guitarras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guitarras-index">
    <div class="row">
        <div class="col-md-6 col-6 col-6 leftalign">
            <p class="alignbtn">
            <h1><?= Html::encode($this->title) ?></h1>
            </p>
        </div>

        <div class="col-md-6 col-6 col-6 rightalign">
            <p>
                <?= Html::a('Criar Guitarra', ['create'], ['class' => 'btncreate']) ?>
            </p>
        </div>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [

                'attribute' => 'gui_id',
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['style' => 'width:5%'];
                },
            ],
            [

                'attribute' => 'gui_idmarca',
                'value' => 'guiIdmarca.mar_nome',


            ],
            'gui_nome',
            [

                'attribute' => 'gui_idsubcategoria',
                'value' => 'guiIdsubcategoria.sub_nome',


            ],


            'gui_preco',

            [

                'attribute' => 'gui_inativo',


                'value' => function ($model, $key, $index, $column) {

                    return $model->gui_inativo == 0 ? 'Ativo' : 'Inativo';
                },
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['style' => 'width:10%; text-align:center; background-color:'
                        . ($model->gui_inativo == 0 ? 'green' : 'red')];
                },
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);

    ?>

</div>
