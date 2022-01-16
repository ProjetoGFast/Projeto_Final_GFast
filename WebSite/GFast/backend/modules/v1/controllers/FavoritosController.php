<?php

namespace backend\modules\v1\controllers;

use common\models\Carrinho;
use common\models\Favoritos;
use common\models\LoginForm;
use common\models\User;
use yii\rest\ActiveController;
use yii\web\Controller;

/**
 * Default controller for the `v1` module
 */
class FavoritosController extends ActiveController
{
    public $modelClass = 'common\models\Favoritos';


    public function actionFavoritos()
    {
        $model = new Favoritos();

        $model->fav_iduser = \Yii::$app->request->post('fav_iduser');

        $modelFavoritos = Favoritos::find()->where(['fav_iduser' => $model->fav_iduser])->all();


        if ($modelFavoritos != null) {
            return $modelFavoritos;
        } else {
           // throw new \yii\web\NotFoundHttpException("Ocorreu um Erro");
        }


    }

}
