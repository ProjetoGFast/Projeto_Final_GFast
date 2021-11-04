<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vendas".
 *
 * @property int $ven_id
 * @property int $ven_iduser
 * @property int $ven_idloja
 * @property int $ven_idsaldo
 * @property int $ven_idproduto
 * @property int $ven_total
 * @property int $ven_estado
 * @property int $ven_iva
 *
 * @property Encomendas[] $encomendas
 * @property Guitarras[] $guitarras
 * @property Lojas $venIdloja
 */
class Vendas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ven_iduser', 'ven_idloja', 'ven_idsaldo', 'ven_idproduto', 'ven_total', 'ven_estado', 'ven_iva'], 'required'],
            [['ven_iduser', 'ven_idloja', 'ven_idsaldo', 'ven_idproduto', 'ven_total', 'ven_estado', 'ven_iva'], 'integer'],
            [['ven_idloja'], 'exist', 'skipOnError' => true, 'targetClass' => Lojas::className(), 'targetAttribute' => ['ven_idloja' => 'loj_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ven_id' => 'Ven ID',
            'ven_iduser' => 'Ven Iduser',
            'ven_idloja' => 'Ven Idloja',
            'ven_idsaldo' => 'Ven Idsaldo',
            'ven_idproduto' => 'Ven Idproduto',
            'ven_total' => 'Ven Total',
            'ven_estado' => 'Ven Estado',
            'ven_iva' => 'Ven Iva',
        ];
    }

    /**
     * Gets query for [[Encomendas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEncomendas()
    {
        return $this->hasMany(Encomendas::className(), ['enc_idvenda' => 'ven_id']);
    }

    /**
     * Gets query for [[Guitarras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGuitarras()
    {
        return $this->hasMany(Guitarras::className(), ['gui_idvenda' => 'ven_id']);
    }

    /**
     * Gets query for [[VenIdloja]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVenIdloja()
    {
        return $this->hasOne(Lojas::className(), ['loj_id' => 'ven_idloja']);
    }
}
