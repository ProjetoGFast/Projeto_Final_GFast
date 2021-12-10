<?php

namespace api\modules\v1\controllers;

use common\models\User;
use common\models\LoginForm;
use yii\rest\ActiveController;



class UserProfileController extends ActiveController {


    public function actionApagaruser($token)
    {
        $statusBan = 1;

        $user = User::findOne(['verification_token' => $token]);

        if ($user != null) {
            $user->status = $statusBan;
            $user->save(false);
        } else {
            throw new \yii\web\NotFoundHttpException("Utilizador não encontrado");
        }
    }

    public function actionLogin()
    {
        $model = new LoginForm();

        $model->email = \Yii::$app->request->post('email');
        $model->password = \Yii::$app->request->post('password');
        $modelUser = User::find()->where(['email' => $model->email])->one();

        if ($modelUser->status != 10) {
            throw new \yii\web\NotFoundHttpException("Esta conta não possui os requisitos para que possa ser acedida!");

        } else {
            $model->login();
            return $modelUser;

        }
    }

}
