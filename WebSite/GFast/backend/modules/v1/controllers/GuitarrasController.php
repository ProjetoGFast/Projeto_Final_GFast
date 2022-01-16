<?php

namespace backend\modules\v1\controllers;

use common\models\Guitarras;
use yii\rest\ActiveController;
use yii\web\Controller;

/**
 * Default controller for the `v1` module
 */
class GuitarrasController extends ActiveController
{
  public $modelClass = 'common\models\Guitarras';

    public function actionGuitarras()
    {
        $guitarras = Guitarras::find()-> all();
        return ['gui_id'=> count($guitarras)];
    }



}
