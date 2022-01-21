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
header('Content-Type: application/json');
class FavoritosController extends ActiveController
{
    public $modelClass = 'common\models\Favoritos';


    public function actionFavoritos($id)
    {


        $modelFavoritos = Favoritos::find()->where(['fav_iduser' => $id])->all();


        if ($modelFavoritos != null) {
            return $modelFavoritos;
        } else {
           // throw new \yii\web\NotFoundHttpException("Ocorreu um Erro");
        }


    }

    public function actionAdicionar()
    {

        $model = new Favoritos();

        $iduser = \Yii::$app->request->post('fav_iduser');
        $idguitarras = \Yii::$app->request->post('fav_idguitarras');




        $model->fav_iduser = $iduser;
        $model->fav_idguitarras = $idguitarras;


        $model->save(false);


        return $model;


    }



}
