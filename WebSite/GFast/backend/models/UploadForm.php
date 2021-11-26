<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $gui_fotopath;
    public $gui_qrcodepath;


    public function rules()
    {
        return [
            [['gui_fotopath'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function uploadphoto()
    {
        //var_dump($this->gui_fotopath);
        // die();
        if ($this->gui_fotopath != null) {

            $caminho = $this->gui_fotopath->baseName . '.' . $this->gui_fotopath->extension;

            if ($this->validate()) {

                $this->gui_fotopath->saveAs('../../common/fotos/' . $caminho);
                return $caminho;
            } else {

                return null;
            }
        } else {
            return null;
        }

    }
}