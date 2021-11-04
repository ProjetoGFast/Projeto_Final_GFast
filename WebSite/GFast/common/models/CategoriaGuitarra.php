<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categoria_guitarra".
 *
 * @property int $cat_id
 * @property string $cat_nome
 * @property int $cat_inativo
 *
 * @property SubcategoriaGuitarra[] $subcategoriaGuitarras
 */
class CategoriaGuitarra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria_guitarra';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_nome', 'cat_inativo'], 'required'],
            [['cat_inativo'], 'integer'],
            [['cat_nome'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => 'Cat ID',
            'cat_nome' => 'Cat Nome',
            'cat_inativo' => 'Cat Inativo',
        ];
    }

    /**
     * Gets query for [[SubcategoriaGuitarras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategoriaGuitarras()
    {
        return $this->hasMany(SubcategoriaGuitarra::className(), ['sub_idcat' => 'cat_id']);
    }
}
