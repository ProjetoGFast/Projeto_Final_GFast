<?php

namespace backend\modules\v1\controllers;

use common\models\Guitarras;
use yii\rest\ActiveController;
use yii\web\Controller;

/**
 * Default controller for the `v1` module
 */
class SubcategoriasController extends ActiveController
{
  public $modelClass = 'common\models\Subcategoriaguitarra';

    public function actionGuitarra($id)
    {
        $guitarras = Guitarras::findAll(['gui_idsubcategoria'=>$id]);
        if ($guitarras!=null){
            return [
            'id_subcategoria'=>$id,
                'guitarras'=>$guitarras
            ];
        }
        return ['id_subcategoria'=>$id, 'guitarras'=>'Não possui guitarras!'];
    }



}
