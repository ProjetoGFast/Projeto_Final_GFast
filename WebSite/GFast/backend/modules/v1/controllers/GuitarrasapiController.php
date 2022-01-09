<?php

namespace backend\modules\v1\controllers;

use common\models\Guitarras;
use yii\rest\ActiveController;
use yii\web\Controller;

/**
 * Default controller for the `v1` module
 */
class GuitarrasapiController extends ActiveController
{
  public $modelClass = 'common\models\Guitarras';



}
