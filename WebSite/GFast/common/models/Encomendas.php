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
 * @property int $enc_idguitarra
 *
 * @property Guitarras $encIdguitarra
 * @property User $encIduser
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
            [['enc_estado', 'enc_iduser', 'enc_idguitarra'], 'required'],
            [['enc_estado', 'enc_iduser', 'enc_idguitarra'], 'integer'],
            [['enc_nome'], 'string', 'max' => 20],
            [['enc_morada'], 'string', 'max' => 40],
            [['enc_idguitarra'], 'exist', 'skipOnError' => true, 'targetClass' => Guitarras::className(), 'targetAttribute' => ['enc_idguitarra' => 'gui_id']],
            [['enc_iduser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['enc_iduser' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'enc_id' => 'Enc ID',
            'enc_nome' => 'Notas',
            'enc_morada' => 'Morada',
            'enc_estado' => 'Enc Estado',
            'enc_iduser' => 'Enc Iduser',
            'enc_idguitarra' => 'Enc Idguitarra',
        ];
    }

    /**
     * Gets query for [[EncIdguitarra]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEncIdguitarra()
    {
        return $this->hasOne(Guitarras::className(), ['gui_id' => 'enc_idguitarra']);
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
}
