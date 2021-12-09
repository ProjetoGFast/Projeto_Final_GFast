<?php

/* @var $this yii\web\View */

/* @var $id */


use common\models\Avaliacoes;
use common\models\User;
use frontend\assets\BackendAsset;
use yii\helpers\Html;

$avaliacoes = Avaliacoes::find()->where(['ava_idguitarra' => $id])->all();
?>

<section id="testimonials">
    <!--heading--->
    <div class="product-description">
        <h3>Avaliações</h3>
    </div>
    <?php

    foreach ($avaliacoes

    as $avalicao){
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

                echo Html::a('Editar', ['/avaliacoes/update', 'id' => $avalicao->ava_id]);
                echo Html::a('Eliminar', ['index']);
           }
            ?>

        </div> <?php
        }
        ?>


    </div>
</section>