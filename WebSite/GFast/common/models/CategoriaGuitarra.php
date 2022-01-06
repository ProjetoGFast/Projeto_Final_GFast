<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categoriaguitarra".
 *
 * @property int $cat_id
 * @property string $cat_nome
 * @property int $cat_inativo
 *
 * @property SubcategoriaGuitarra[] $subcategoriaGuitarras
 */
class Categoriaguitarra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoriaguitarra';
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
            'cat_id' => 'ID',
            'cat_nome' => 'Categoria',
            'cat_inativo' => 'Inativo',
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


    public static function findByCategoriasname($categoria)
    {
        return static::findOne(['cat_nome' => $categoria]);
    }

    /**
     * @param string $cat_nome
     */
    public function setCatNome($cat_nome)
    {
        $this->cat_nome = $cat_nome;
    }

    /**
     * @param int $cat_inativo
     */
    public function setCatInativo($cat_inativo)
    {
        $this->cat_inativo = $cat_inativo;
    }

    public function createCategoria()
    {
        $categoria = new CategoriaGuitarra();

        $categoria->cat_nome = $this->cat_nome;
        $categoria->cat_inativo = $this->cat_inativo;

        $categoria->save(false);


        return true;

    }

}
