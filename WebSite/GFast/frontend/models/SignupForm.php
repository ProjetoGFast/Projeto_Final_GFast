<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $us_nome;
    public $us_apelido;
    public $us_cidade;
    public $us_telemovel;
    public $us_contribuinte;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['us_nome', 'trim'],
            ['us_nome', 'required'],

            ['us_nome', 'string', 'max' => 255],

            ['us_apelido', 'trim'],
            ['us_apelido', 'required'],

            ['us_apelido', 'string', 'max' => 255],

            ['us_cidade', 'trim'],
            ['us_cidade', 'required'],

            ['us_cidade', 'string', 'max' => 255],

            ['us_telemovel', 'trim'],
           ['us_telemovel', 'required'],


           ['us_contribuinte', 'trim'],
           ['us_contribuinte', 'required'],





            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
            'us_nome' => 'Nome',
            'us_apelido' => 'Apelido',
            'us_cidade' => 'Cidade',
            'us_telemovel' => 'Telemovel',
            'us_contribuinte' => 'Contribuinte',
            'us_pontos' => 'Pontos',
            'us_inativo' => 'Inativo',
        ];
    }
    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if ($this->validate()) {

            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
            $user->us_nome = $this->us_nome;
            $user->us_contribuinte =$this->us_contribuinte;
            $user->us_apelido = $this->us_apelido;
            $user->us_telemovel = $this->us_telemovel;
            $user->us_cidade = $this->us_cidade;
            $user->us_pontos = 0;
            $user->us_inativo = 0;
            $user->save(false);
            // the following three lines were added:
            $auth = \Yii::$app->authManager;
            $authorRole = $auth->getRole('cliente');
            $auth->assign($authorRole, $user->getId());


            return $user;
        }

        return null;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
