<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Utilizadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="row">
        <div class="col-md-6 col-6 col-6 leftalign">
            <p class="alignbtn">
            <h1><?= Html::encode($this->title) ?></h1>
            </p>
        </div>

        <div class="col-md-6 col-6 col-6 rightalign">
            <p>
                <?= Html::a('Criar utilizador', ['create'], ['class' => 'btncreate']) ?>
            </p>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'username',
            'email:email',
            'us_nome',
            'us_apelido',
            'us_cidade',
            'us_telemovel',
            'us_contribuinte',
            'us_pontos',
            //'us_inativo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
