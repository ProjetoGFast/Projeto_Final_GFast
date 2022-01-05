<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

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
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;
    const SCENARIO_UPDATE = 'update';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'us_nome', 'us_apelido', 'us_cidade', 'us_telemovel', 'us_contribuinte', 'us_pontos', 'us_inativo'], 'required'],
            [['status', 'created_at', 'updated_at', 'us_contribuinte', 'us_pontos', 'us_inativo'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],

            ['us_contribuinte', 'string', 'max' => 9, 'min' => 9],
            [['us_nome', 'us_apelido', 'us_cidade'], 'string', 'max' => 20],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],


            ['username', 'trim'],
            ['username', 'required'],

           /* ['username', 'unique', 'on' => 'create', 'when' => function ($model) {
                return $model->isAttributeChanged('username');
            }, 'targetClass' => '\common\models\User', 'message' => 'Este username já está a ser utilizado'],*/
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
            ['us_contribuinte', 'string', 'max' => 9, 'min' => 9],
            ['us_contribuinte', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Número de contribuinte já registado'],


        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token)
    {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
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
     * Gets query for [[Avaliacoes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacoes()
    {
        return $this->hasMany(Avaliacoes::className(), ['ava_iduser' => 'id']);
    }

    /**
     * Gets query for [[Bilhetes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBilhetes()
    {
        return $this->hasMany(Bilhetes::className(), ['bil_iduser' => 'id']);
    }

    /**
     * Gets query for [[Carrinhos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrinhos()
    {
        return $this->hasMany(Carrinho::className(), ['car_iduser' => 'id']);
    }

    /**
     * Gets query for [[Enderecos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnderecos()
    {
        return $this->hasMany(Enderecos::className(), ['end_iduser' => 'id']);
    }

    /**
     * create user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {


        $user = new \common\models\User();


        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password_hash);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->us_nome = $this->us_nome;
        $user->us_contribuinte = $this->us_contribuinte;
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


        return true;


    }

    /**
     * create user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signupTest()
    {

        $user = new \common\models\User();


        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password_hash);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->us_nome = $this->us_nome;
        $user->us_contribuinte = $this->us_contribuinte;
        $user->us_apelido = $this->us_apelido;
        $user->us_telemovel = $this->us_telemovel;
        $user->us_cidade = $this->us_cidade;
        $user->us_pontos = 0;
        $user->us_inativo = 0;

        $user->save(false);


        return true;


    }


    public function eliminaUser()
    {
        $id = Yii::$app->user->getId();
        $model = User::findOne($id);

        $model->us_inativo = 1;

        $model->save(false);

        return $model;


    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param string $auth_key
     */
    public function setAuthKey($auth_key)
    {
        $this->auth_key = $auth_key;
    }

    /**
     * @param string $password_hash
     */
    public function setPasswordHash($password_hash)
    {
        $this->password_hash = $password_hash;
    }

    /**
     * @param string|null $password_reset_token
     */
    public function setPasswordResetToken($password_reset_token)
    {
        $this->password_reset_token = $password_reset_token;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param int $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @param int $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @param string|null $verification_token
     */
    public function setVerificationToken($verification_token)
    {
        $this->verification_token = $verification_token;
    }

    /**
     * @param string $us_nome
     */
    public function setUsNome($us_nome)
    {
        $this->us_nome = $us_nome;
    }

    /**
     * @param string $us_apelido
     */
    public function setUsApelido($us_apelido)
    {
        $this->us_apelido = $us_apelido;
    }

    /**
     * @param string $us_cidade
     */
    public function setUsCidade($us_cidade)
    {
        $this->us_cidade = $us_cidade;
    }

    /**
     * @param int $us_telemovel
     */
    public function setUsTelemovel($us_telemovel)
    {
        $this->us_telemovel = $us_telemovel;
    }

    /**
     * @param int $us_contribuinte
     */
    public function setUsContribuinte($us_contribuinte)
    {
        $this->us_contribuinte = $us_contribuinte;
    }

    /**
     * @param int $us_pontos
     */
    public function setUsPontos($us_pontos)
    {
        $this->us_pontos = $us_pontos;
    }

    /**
     * @param int $us_inativo
     */
    public function setUsInativo($us_inativo)
    {
        $this->us_inativo = $us_inativo;
    }


}