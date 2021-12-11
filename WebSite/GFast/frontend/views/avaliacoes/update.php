<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Avaliacoes */

if (\Yii::$app->user->can('crudOwnAvaliacao', ['post' => $model])) {
    $this->title = 'Editar Avaliação: ' . $model->ava_id;
    ?>
    <div class="avaliacoes-update">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
<?php } else {

    return $this->render('error', ['name' => 'Not Allowed', 'message' => 'Não tem Autorizacão Para Aceder']);
}

?>