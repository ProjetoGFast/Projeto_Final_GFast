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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Guitarras', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'gui_id',
            'gui_nome',
            'gui_idsubcategoria',
            'gui_idmarca',
            'gui_idvenda',
            //'gui_idreferencia',
            //'gui_descricao',
            //'gui_preco',
            //'gui_iva',
            //'gui_inativo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
