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
}
