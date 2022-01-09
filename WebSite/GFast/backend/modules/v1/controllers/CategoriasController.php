<?php

namespace backend\modules\v1\controllers;

use common\models\Guitarras;
use common\models\Subcategoriaguitarra;
use yii\rest\ActiveController;
use yii\web\Controller;

/**
 * Default controller for the `v1` module
 */
class CategoriasController extends ActiveController
{
  public $modelClass = 'common\models\Categoriaguitarra';

    public function actionSubcategorias($id)
    {
        $categorias = Subcategoriaguitarra::findAll(['sub_idcat'=>$id]);
        if ($categorias!=null){
            return [
            'sub_idcat'=>$id,
                'categorias'=>$categorias
            ];
        }
        return ['sub_idcat'=>$id, 'categorias'=>'Não possui subcategorias!'];
    }



}
