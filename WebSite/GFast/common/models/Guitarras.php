<?php

namespace common\models;

use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "guitarras".
 *
 * @property int $gui_id
 * @property string $gui_nome
 * @property int $gui_idsubcategoria
 * @property int $gui_idmarca
 * @property int $gui_idreferencia
 * @property string $gui_descricao
 * @property float $gui_preco
 * @property int $gui_iva
 * @property string $gui_fotopath
 * @property string $gui_qrcodepath
 *
 * @property int $gui_inativo
 *
 * @property Avaliacoes[] $avaliacoes
 * @property Carrinho[] $carrinhos
 * @property Fotos[] $fotos
 * @property Marcas $guiIdmarca
 * @property SubcategoriaGuitarra $guiIdsubcategoria
 * @property VendasGuitarras[] $vendasGuitarras
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
            [['gui_nome', 'gui_idsubcategoria', 'gui_idmarca', 'gui_idreferencia', 'gui_descricao', 'gui_preco', 'gui_iva', 'gui_inativo'], 'required'],
            [['gui_idsubcategoria', 'gui_iva', 'gui_inativo'], 'integer'],
            [['gui_preco'], 'number'],
            [['gui_nome'], 'string', 'max' => 20],
            [['gui_descricao', 'gui_fotopath', 'gui_qrcodepath'], 'string'],
            [['gui_idsubcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => SubcategoriaGuitarra::className(), 'targetAttribute' => ['gui_idsubcategoria' => 'sub_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gui_id' => 'ID',
            'gui_idmarca' => 'Marca',
            'gui_nome' => 'Modelo Guitarra',
            'gui_idsubcategoria' => 'Subcategoria',
            'gui_idreferencia' => 'Referencia',
            'gui_descricao' => 'Descrição',
            'gui_preco' => 'Preço',
            'gui_iva' => 'Iva',
            'gui_inativo' => 'Inativo',
            'gui_fotopath'=>'Foto',
            'gui_qrcodepath'=>'qr',
        ];
    }

    //public function fields()
   // {
       /* return ['gui_fotopath'=>function(){
            return $this->imageUrl();
        }, 'gui_idmarca'=>function(){
            return $this->guiIdmarca->mar_nome;
        }];*/
   // }

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

    public function imageUrl(){
        return Url::to('@web/fotos/'.$this->gui_fotopath);
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
     * Gets query for [[VendasGuitarras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVendasGuitarras()
    {
        return $this->hasMany(VendasGuitarras::className(), ['idguitarra' => 'gui_id']);
    }


}
