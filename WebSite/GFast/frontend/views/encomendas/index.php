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
                    <th>Morada</th>
                    <th>Utilizador</th>
                    <th>Estado de Encomenda</th>
                </tr>
                <?php
                foreach ($model as $encomenda) {
                    $user = \common\models\User::find()->where(['id' => $encomenda->enc_iduser])->one();
                    $estado = \common\models\Estados::find()->where(['est_id' => $encomenda->enc_estado])->one();

                    ?>

                    <tr>
                        <td><?= Html::a($encomenda->enc_id, ['detalhes', 'id' => $encomenda->enc_id ], ['class' => 'row-link']) ?></td>
                        <td><?= Html::a($encomenda->enc_morada, ['detalhes', 'id' => $encomenda->enc_id ], ['class' => 'row-link']) ?></td>
                        <td><?= Html::a( $user->us_nome . " " . $user->us_apelido, ['detalhes', 'id' => $encomenda->enc_id ], ['class' => 'row-link']) ?></td>
                        <td><?= Html::a( $estado->Estado, ['detalhes', 'id' => $encomenda->enc_id ], ['class' => 'row-link']) ?></td>


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