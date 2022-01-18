<?php

namespace backend\modules\v1\controllers;

use common\models\Carrinho;
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

            if ($model->login()) {
                return $modelUser;
            } else {
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


        if ($modelUser->verification_token == $model->verification_token) {
            return $modelUser;
        } else {
            throw new \yii\web\NotFoundHttpException("Ocorreu um Erro");
        }


    }


    public function actionRegisto()
    {

        $user = new User();
        $username = \Yii::$app->request->post('username');
        $email = \Yii::$app->request->post('email');
        $password = \Yii::$app->request->post('password');
        $nome = \Yii::$app->request->post('nome');
        $apelido = \Yii::$app->request->post('apelido');
        $contribuinte = \Yii::$app->request->post('contribuinte');
        $telemovel = \Yii::$app->request->post('telemovel');
        $cidade = \Yii::$app->request->post('cidade');


        $user->username = $username;
        $user->email = $email;
        $user->setPassword($password);

        // Não mexe //
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        // Não mexe //

        $user->us_nome = $nome;
        $user->us_apelido = $apelido;
        $user->us_contribuinte = $contribuinte;
        $user->us_telemovel = $telemovel;
        $user->us_cidade = $cidade;
        $user->us_pontos = 0;
        $user->us_inativo = 0;

        $user->save(false);


        //Não mexe //
        $auth = \Yii::$app->authManager;
        $authorRole = $auth->getRole('cliente');
        $auth->assign($authorRole, $user->getId());
        //Não mexe //

    }

}
