<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "carrinho".
 *
 * @property int $id
 * @property int|null $enc_id
 * @property int $gui_id
 * @property int $iduser
 * @property int $inativo
 *
 * @property Encomendas $enc
 * @property Guitarras $gui
 * @property User $iduser0
 */
class Carrinho extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carrinho';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'gui_id', 'iduser', 'inativo'], 'integer'],
            [['gui_id', 'iduser', 'inativo'], 'required'],
            [['iduser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['iduser' => 'id']],
            [['gui_id'], 'exist', 'skipOnError' => true, 'targetClass' => Guitarras::className(), 'targetAttribute' => ['gui_id' => 'gui_id']],
            [['enc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Encomendas::className(), 'targetAttribute' => ['enc_id' => 'enc_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'enc_id' => 'Enc ID',
            'gui_id' => 'Gui ID',
            'iduser' => 'Iduser',
            'inativo' => 'Inativo',
        ];
    }

    /**
     * Gets query for [[Enc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnc()
    {
        return $this->hasOne(Encomendas::className(), ['enc_id' => 'enc_id']);
    }

    /**
     * Gets query for [[Gui]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGui()
    {
        return $this->hasOne(Guitarras::className(), ['gui_id' => 'gui_id']);
    }

    /**
     * Gets query for [[Iduser0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIduser0()
    {
        return $this->hasOne(User::className(), ['id' => 'iduser']);
    }
}
