<?php

namespace backend\modules\v1\controllers;

use common\models\LoginForm;
use common\models\User;
use yii\rest\ActiveController;
use yii\web\Controller;

/**
 * Default controller for the `v1` module
 */
class UserController extends ActiveController
{
  public $modelClass = 'common\models\User';

    public function actionLogin()
    {
        $model = new LoginForm();

        $model->username = \Yii::$app->request->post('username');
        $model->password = \Yii::$app->request->post('password');
        $modelUser = User::find()->where(['username' => $model->username])->one();

        if ($modelUser->status != 10) {
            throw new \yii\web\NotFoundHttpException("Username ou Password Incorretos!");

        } else {

            if($model->login())
            {
                return $modelUser;
            }else
            {
                throw new \yii\web\NotFoundHttpException("Username ou Password Incorretos!");
            }


        }
    }

    public function actionCheckuser()
    {
        $model = new User();

        $model->username = \Yii::$app->request->post('username');
        $model->verification_token = \Yii::$app->request->post('verification_token');
        $modelUser = User::find()->where(['username' => $model->username])->one();


            if($modelUser->verification_token ==  $model->verification_token)
            {
                return $modelUser;
            }else
            {
                throw new \yii\web\NotFoundHttpException("Ocorreu um Erro");
            }


        }


}
