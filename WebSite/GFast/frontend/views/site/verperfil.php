<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

\yii\web\YiiAsset::register($this);
?>
<?= $this->render('..\layouts\header') ?>

<div class="user-view">

    <p>
        <?= Html::a('<i class="fa fa-pencil" aria-hidden="true"></i>', ['editar-perfil', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i> Desativar Perfil', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-primary',
            'data' => [
                'confirm' => 'Tem a certeza que pretende eliminar o seu perfil?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            //'status',
            // 'created_at',
            // 'updated_at',
            //'verification_token',
            'us_nome',
            'us_apelido',
            'us_cidade',
            'us_telemovel',
            'us_contribuinte',

        ],
    ]) ?>

</div>

<?= $this->render('..\layouts\footer') ?>
