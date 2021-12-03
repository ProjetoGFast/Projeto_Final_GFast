<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 * @property string $us_nome
 * @property string $us_apelido
 * @property string $us_cidade
 * @property int $us_telemovel
 * @property int $us_contribuinte
 * @property int $us_pontos
 * @property int $us_inativo
 *
 * @property Avaliacoes[] $avaliacoes
 * @property Bilhetes[] $bilhetes
 * @property Carrinho[] $carrinhos
 * @property Enderecos[] $enderecos
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['username', 'email','us_nome', 'us_apelido', 'us_cidade', 'us_telemovel', 'us_contribuinte', 'us_pontos', 'us_inativo'], 'required'],
            [['status', 'created_at', 'updated_at', 'us_telemovel', 'us_contribuinte', 'us_pontos', 'us_inativo'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['us_nome', 'us_apelido', 'us_cidade'], 'string', 'max' => 20],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['us_telemovel'], 'unique'],
            [['us_contribuinte'], 'unique'],
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\frontend\models\User', 'message' => 'Este username já está a ser utilizado'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este Email já está a ser utilizado'],

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
            ['us_telemovel', 'string', 'max' => 9, 'min' => 9],
            ['us_telemovel', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Número de telemóvel já registado'],

            ['us_contribuinte', 'trim'],
            ['us_contribuinte', 'required'],
            ['us_contribuinte', 'string', 'max' => 9, 'min' =>9],
            ['us_contribuinte', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Número de contribuinte já registado'],


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
            'password_hash' => 'Password',
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
     * Gets query for [[Avaliacoes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacoes()
    {
       // return $this->hasMany(Avaliacoes::className(), ['ava_iduser' => 'id']);
    }

    /**
     * Gets query for [[Bilhetes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBilhetes()
    {
       // return $this->hasMany(Bilhetes::className(), ['bil_iduser' => 'id']);
    }

    /**
     * Gets query for [[Carrinhos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrinhos()
    {
       // return $this->hasMany(Carrinho::className(), ['car_iduser' => 'id']);
    }

    /**
     * Gets query for [[Enderecos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnderecos()
    {
        //return $this->hasMany(Enderecos::className(), ['end_iduser' => 'id']);
    }
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * create user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if ($this->validate()) {

            $user = new \common\models\User();


            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password_hash);
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

}
