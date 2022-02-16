<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "encomendas".
 *
 * @property int $enc_id
 * @property string|null $enc_nome
 * @property string|null $enc_morada
 * @property int $enc_estado
 * @property int $enc_iduser
 *
 * @property Estados $encEstado
 * @property User $encIduser
 *
 */
class Encomendas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'encomendas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_estado', 'enc_iduser'], 'required'],
            [['enc_estado', 'enc_iduser'], 'integer'],
            [['enc_nome'], 'string', 'max' => 20],
            [['enc_morada'], 'string', 'max' => 40],
            [['enc_estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['enc_estado' => 'est_id']],
            [['enc_iduser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['enc_iduser' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'enc_id' => 'ID',
            'enc_nome' => 'Notas',
            'enc_morada' => 'Morada',
            'enc_estado' => 'Estado',
            'enc_iduser' => 'Iduser',
        ];
    }

    /**
     * Gets query for [[EncEstado]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEncEstado()
    {
        return $this->hasOne(Estados::className(), ['est_id' => 'enc_estado']);
    }

    /**
     * Gets query for [[EncIduser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEncIduser()
    {
        return $this->hasOne(User::className(), ['id' => 'enc_iduser']);
    }

    /**
     * Gets query for [[EncomendaGuitarras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEncomendaGuitarras()
    {
        //return $this->hasMany(EncomendaGuitarra::className(), ['enc_id' => 'enc_id']);
    }
}
