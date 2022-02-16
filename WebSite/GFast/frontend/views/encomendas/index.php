<?php

use common\models\Encomendas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Encomendas */


?>
<?= $this->render('..\layouts\header') ?>
    <div class="encomendas-index">


        <h2 class="title text-center">Encomendas</h2>
        <?php if ($model != null) { ?>
            <table>
                <tr>
                    <th>Número de Encomenda</th>
                    <th>Utilizador</th>
                    <th>Estado de Encomenda</th>
                </tr>
                <?php
                foreach ($model as $encomenda) {
                    $user = \common\models\User::find()->where(['id' => $encomenda->enc_iduser])->one();
                    $estado = \common\models\Estados::find()->where(['est_id' => $encomenda->enc_estado])->one();
                    ?>
                    <tr>
                        <td><?= $encomenda->enc_id ?></td>
                        <td><?= $user->us_nome . " " . $user->us_apelido ?></td>
                        <td><?=$estado->Estado?></td>
                    </tr>
                    <?php
                }

                ?>
            </table>
        <?php } else
        {
            ?><h4>Sem Encomendas</h4><?php
        }


        ?>
    </div>
<?= $this->render('..\layouts\footer') ?>