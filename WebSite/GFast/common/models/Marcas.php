<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "marcas".
 *
 * @property int $mar_id
 * @property string $mar_nome
 * @property int $mar_inativo
 *
 * @property Guitarras[] $guitarras
 */
class Marcas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marcas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mar_nome', 'mar_inativo'], 'required'],
            [['mar_inativo'], 'integer'],
            [['mar_nome'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mar_id' => 'ID',
            'mar_nome' => 'Marca',
            'mar_inativo' => 'Inativo',
        ];
    }

    /**
     * Gets query for [[Guitarras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGuitarras()
    {
        return $this->hasMany(Guitarras::className(), ['gui_idmarca' => 'mar_id']);
    }
}
