<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "guitarras".
 *
 * @property int $gui_id
 * @property string $gui_nome
 * @property int $gui_idsubcategoria
 * @property int $gui_idmarca
 * @property int $gui_idvenda
 * @property int $gui_idreferencia
 * @property string $gui_descricao
 * @property float $gui_preco
 * @property int $gui_iva
 * @property int $gui_inativo
 *
 * @property Avaliacoes[] $avaliacoes
 * @property Carrinho[] $carrinhos
 * @property Fotos[] $fotos
 * @property Marcas $guiIdmarca
 * @property SubcategoriaGuitarra $guiIdsubcategoria
 * @property Vendas $guiIdvenda
 */
class Guitarras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'guitarras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gui_nome', 'gui_idsubcategoria', 'gui_idmarca', 'gui_idvenda', 'gui_idreferencia', 'gui_descricao', 'gui_preco', 'gui_iva', 'gui_inativo'], 'required'],
            [['gui_idsubcategoria', 'gui_idmarca', 'gui_idvenda', 'gui_idreferencia', 'gui_iva', 'gui_inativo'], 'integer'],
            [['gui_preco'], 'number'],
            [['gui_nome'], 'string', 'max' => 20],
            [['gui_descricao'], 'string', 'max' => 50],
            [['gui_idsubcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => SubcategoriaGuitarra::className(), 'targetAttribute' => ['gui_idsubcategoria' => 'sub_id']],
            [['gui_idmarca'], 'exist', 'skipOnError' => true, 'targetClass' => Marcas::className(), 'targetAttribute' => ['gui_idmarca' => 'mar_id']],
            [['gui_idvenda'], 'exist', 'skipOnError' => true, 'targetClass' => Vendas::className(), 'targetAttribute' => ['gui_idvenda' => 'ven_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gui_id' => 'Gui ID',
            'gui_nome' => 'Gui Nome',
            'gui_idsubcategoria' => 'Gui Idsubcategoria',
            'gui_idmarca' => 'Gui Idmarca',
            'gui_idvenda' => 'Gui Idvenda',
            'gui_idreferencia' => 'Gui Idreferencia',
            'gui_descricao' => 'Gui Descricao',
            'gui_preco' => 'Gui Preco',
            'gui_iva' => 'Gui Iva',
            'gui_inativo' => 'Gui Inativo',
        ];
    }

    /**
     * Gets query for [[Avaliacoes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacoes()
    {
        return $this->hasMany(Avaliacoes::className(), ['ava_idguitarra' => 'gui_id']);
    }

    /**
     * Gets query for [[Carrinhos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrinhos()
    {
        return $this->hasMany(Carrinho::className(), ['car_iduser' => 'gui_id']);
    }

    /**
     * Gets query for [[Fotos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFotos()
    {
        return $this->hasMany(Fotos::className(), ['fot_idguitarra' => 'gui_id']);
    }

    /**
     * Gets query for [[GuiIdmarca]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGuiIdmarca()
    {
        return $this->hasOne(Marcas::className(), ['mar_id' => 'gui_idmarca']);
    }

    /**
     * Gets query for [[GuiIdsubcategoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGuiIdsubcategoria()
    {
        return $this->hasOne(SubcategoriaGuitarra::className(), ['sub_id' => 'gui_idsubcategoria']);
    }

    /**
     * Gets query for [[GuiIdvenda]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGuiIdvenda()
    {
        return $this->hasOne(Vendas::className(), ['ven_id' => 'gui_idvenda']);
    }
}
