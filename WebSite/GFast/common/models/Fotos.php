<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "fotos".
 *
 * @property int $fot_id
 * @property string $fot_nome
 * @property int $fot_idguitarra
 * @property int $fot_idref
 * @property string $fot_tipofoto
 * @property string $fot_principal
 * @property int $fot_inativo
 *
 * @property Guitarras $fotIdguitarra
 */
class Fotos extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fotos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fot_nome', 'fot_idguitarra', 'fot_idref', 'fot_tipofoto', 'fot_principal', 'fot_inativo'], 'required'],
            [['fot_idguitarra', 'fot_idref', 'fot_inativo'], 'integer'],
            [['fot_nome', 'fot_tipofoto', 'fot_principal'], 'string', 'max' => 20],
            [['fot_idguitarra'], 'exist', 'skipOnError' => true, 'targetClass' => Guitarras::className(), 'targetAttribute' => ['fot_idguitarra' => 'gui_id']],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fot_id' => 'Fot ID',
            'fot_nome' => 'Fot Nome',
            'fot_idguitarra' => 'Fot Idguitarra',
            'fot_idref' => 'Fot Idref',
            'fot_tipofoto' => 'Fot Tipofoto',
            'fot_principal' => 'Fot Principal',
            'fot_inativo' => 'Fot Inativo',
        ];
    }

    /**
     * Gets query for [[FotIdguitarra]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFotIdguitarra()
    {
        return $this->hasOne(Guitarras::className(), ['gui_id' => 'fot_idguitarra']);
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
