<?php

namespace common\models;

use backend\mosquitto\phpMQTT;
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
            'gui_fotopath' => 'Foto',
            'gui_qrcodepath' => 'qr',
        ];
    }

    public function fields()
    {
        return [
            'gui_fotopath' => function () {
                return $this->imageUrl();
            },
            'gui_nome' => function () {
                return $this->gui_nome;
            },
            'gui_idmarca' => function () {
                return $this->guiIdmarca->mar_nome;
            },
            'gui_id' => function () {
                return $this->gui_id;
            },

            'gui_idsubcategoria' => function () {
                return $this->gui_idsubcategoria;
            },

            'gui_idreferencia' => function () {
                return $this->gui_idreferencia;
            },

            'gui_descricao' => function () {
                return $this->gui_descricao;
            },

            'gui_preco' => function () {
                return $this->gui_preco;
            },

            'gui_iva' => function () {
                return $this->gui_iva;
            },

            'gui_qrcodepath' => function () {
                return $this->gui_qrcodepath;
            },

            'gui_inativo' => function () {
                return $this->gui_inativo;
            },


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

    public function imageUrl()
    {
        return Url::to('@web/fotos/' . $this->gui_fotopath);
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


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        //Obter dados do registo em causa
        $id = $this->gui_id;
        $marca = $this->gui_idmarca;
        $subcategoria = $this->gui_idsubcategoria;
        $idreferencia = $this->gui_idreferencia;
        $descricao = $this->gui_descricao;
        $nome = $this->gui_nome;
        $preco = $this->gui_preco;
        $iva = $this->gui_iva;
        $inativo = $this->gui_inativo;
        $fotopath = $this->gui_fotopath;
        $qrcodepath = $this->gui_qrcodepath;

        $myObj=new \stdClass();
        $myObj->id=$id;
        $myObj->subcategoria=$subcategoria;
        $myObj->marca=$marca;
        $myObj->iva=$iva;
        $myObj->preco=$preco;
        $myObj->nome=$nome;
        $myObj->idreferencia=$idreferencia;
        $myObj->descricao=$descricao;
        $myObj->fotopath=$fotopath;
        $myObj->qrcodepath=$qrcodepath;
        $myObj->inativo=$inativo;


        $myJSON = json_encode($myObj);
        if($insert)
            $this->FazPublishNoMosquitto("INSERT",$myJSON);
        else
            $this->FazPublishNoMosquitto("UPDATE",$myJSON);
    }
    public function afterDelete()
    {
        parent::afterDelete();
        $prod_id= $this->id;
        $myObj=new \stdClass();
        $myObj->id=$prod_id;
        $myJSON = json_encode($myObj);
        $this->FazPublishNoMosquitto("DELETE",$myJSON);
    }
    public function FazPublishNoMosquitto($canal,$msg)
    {
        $server = "broker.emqx.io";
        $port = 1883;
        $username = ""; // set your username
        $password = ""; // set your password
        $client_id = "PHP"; // unique!
        $mqtt = new phpMQTT($server, $port, $client_id);
        if ($mqtt->connect(true, NULL, $username, $password))
        {
            $mqtt->publish($canal, $msg, 1);
            $mqtt->close();
        }
        else { file_put_contents('debug.output',"Time out!"); }
    }


}
