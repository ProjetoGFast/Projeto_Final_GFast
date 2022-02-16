<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "estados".
 *
 * @property int $est_id
 * @property string $Estado
 *
 * @property Encomendas[] $encomendas
 */
class Estados extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Estado'], 'required'],
            [['Estado'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'est_id' => 'Est ID',
            'Estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Encomendas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEncomendas()
    {
        return $this->hasMany(Encomendas::className(), ['enc_estado' => 'est_id']);
    }
}
