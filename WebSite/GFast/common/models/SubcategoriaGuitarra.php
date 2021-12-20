<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subcategoria-guitarra".
 *
 * @property int $sub_id
 * @property string $sub_nome
 * @property int $sub_idcat
 *
 * @property Guitarras[] $guitarras
 * @property Categoriaguitarra $subIdcat
 */
class Subcategoriaguitarra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subcategoria-guitarra';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sub_nome', 'sub_idcat'], 'required'],
            [['sub_idcat'], 'integer'],
            [['sub_nome'], 'string', 'max' => 20],
            [['sub_idcat'], 'exist', 'skipOnError' => true, 'targetClass' => Categoriaguitarra::className(), 'targetAttribute' => ['sub_idcat' => 'cat_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sub_id' => 'ID',
            'sub_nome' => 'SubCategoria',
            'sub_idcat' => 'Categoria Pai',
        ];
    }

    /**
     * Gets query for [[Guitarras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGuitarras()
    {
        return $this->hasMany(Guitarras::className(), ['gui_idsubcategoria' => 'sub_id']);
    }

    /**
     * Gets query for [[SubIdcat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubIdcat()
    {
        return $this->hasOne(Categoriaguitarra::className(), ['cat_id' => 'sub_idcat']);
    }

}
