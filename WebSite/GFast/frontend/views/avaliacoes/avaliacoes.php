<?php

/* @var $this yii\web\View */

/* @var $id */


use common\models\Avaliacoes;
use common\models\User;
use frontend\assets\BackendAsset;
use yii\helpers\Html;

$avaliacoes = Avaliacoes::find()->where(['ava_idguitarra' => $id])->all();

if ($avaliacoes != null) {
    ?>

    <section id="testimonials">
        <!--heading--->
        <div class="product-description">
            <h3>Avaliações</h3>
        </div>
        <?php

        if (!Yii::$app->user->isGuest) {

            echo Html::a('<i class="fa fa-plus" aria-hidden="true"></i>', ['/avaliacoes/create', 'id' => $id], ['class' => 'btn btn-primary','id'=>'ava','name'=>'createava']);

        }

        foreach ($avaliacoes

        as $avalicao) {
        $user = User::find()->where(['id' => $avalicao->ava_iduser])->one();
        ?>
        <div class="testimonial-box-container">
            <div class="testimonial-box">
                <div class="box-top">
                    <div class="profile">

                        <div class="name-user">
                            <strong><?= $user->us_nome ?></strong>
                        </div>
                    </div>
                </div>
                <div class="client-comment">
                    <p><?= $avalicao->ava_avaliacao ?></p>
                </div>

                <?php
                if (\Yii::$app->user->can('crudOwnAvaliacao', ['post' => $avalicao])) {

                    echo Html::a('<i class="fa fa-pencil" aria-hidden="true"></i>', ['/avaliacoes/update', 'id' => $avalicao->ava_id], ['class' => 'btn btn-primary']);
                    echo Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['/avaliacoes/delete', 'id' => $avalicao->ava_id], [
                        'class' => 'btn btn-primary',
                        'data' => [
                            'confirm' => 'Tem a certeza que pretende eliminar este comentário?',
                            'method' => 'post',
                        ],
                    ]);
                }
                ?>

            </div> <?php
            }
            ?>


        </div>
    </section>
    <?php
} else {
    ?>
    <section id="testimonials">
        <!--heading--->
        <div class="product-description">
            <h3>Avaliações</h3>
        </div>
        <h6>Sem Avaliações</h6>
        <?php
        if (!Yii::$app->user->isGuest) {

            echo Html::a('<i class="fa fa-plus" aria-hidden="true"></i>', ['/avaliacoes/create','id' => $id], ['class' => 'btn btn-primary', 'id'=>'ava','name'=>'createava']);

        }
        ?>
    </section>
    <?php
}
?>