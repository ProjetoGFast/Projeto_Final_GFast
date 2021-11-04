<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subcategoria_guitarra".
 *
 * @property int $sub_id
 * @property string $sub_nome
 * @property int $sub_idcat
 *
 * @property Guitarras[] $guitarras
 * @property CategoriaGuitarra $subIdcat
 */
class SubcategoriaGuitarra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subcategoria_guitarra';
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
            [['sub_idcat'], 'exist', 'skipOnError' => true, 'targetClass' => CategoriaGuitarra::className(), 'targetAttribute' => ['sub_idcat' => 'cat_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sub_id' => 'Sub ID',
            'sub_nome' => 'Sub Nome',
            'sub_idcat' => 'Sub Idcat',
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
        return $this->hasOne(CategoriaGuitarra::className(), ['cat_id' => 'sub_idcat']);
    }
}
