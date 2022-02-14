<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "encomenda_user".
 *
 * @property int $id
 * @property int $enc_id
 * @property int $iduser
 */
class EncomendaUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'encomenda_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'iduser'], 'required'],
            [['enc_id', 'iduser'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'enc_id' => 'Enc ID',
            'iduser' => 'Iduser',
        ];
    }
}
