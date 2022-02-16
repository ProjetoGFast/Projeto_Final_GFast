<?php

use common\models\Encomendas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EncomendasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Encomendas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encomendas-index">

    <div class="row">
        <div class="col-md-6 col-6 col-6 leftalign">
            <p class="alignbtn">
            <h1><?= Html::encode($this->title) ?></h1>
            </p>
        </div>

        <div class="col-md-6 col-6 col-6 rightalign">
            <p>

            </p>
        </div>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [


            'enc_id',
            'enc_nome',
            'enc_morada',
            [

                'attribute'=>'enc_estado',

                'value'=> 'encEstado.Estado',

            ],
            [

                'attribute'=>'enc_iduser',

                'value'=> 'encIduser.username',

            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Encomendas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'enc_id' => $model->enc_id]);
                 }
            ],

        ],
    ]); ?>


</div>
