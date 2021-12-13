<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "avaliacoes".
 *
 * @property int $ava_id
 * @property string $ava_avaliacao
 * @property int $ava_idguitarra
 * @property int $ava_iduser
 *
 * @property Guitarras $avaIdguitarra
 * @property User $avaIduser
 */
class Avaliacoes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'avaliacoes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ava_avaliacao', 'ava_idguitarra', 'ava_iduser'], 'required'],
            [['ava_idguitarra', 'ava_iduser'], 'integer'],
            [['ava_avaliacao'], 'string'],
            [['ava_idguitarra'], 'exist', 'skipOnError' => true, 'targetClass' => Guitarras::className(), 'targetAttribute' => ['ava_idguitarra' => 'gui_id']],
            [['ava_iduser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['ava_iduser' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ava_id' => 'ID',
            'ava_avaliacao' => 'Avaliação',
            'ava_idguitarra' => 'Guitarra',
            'ava_iduser' => 'Utilizador',
        ];
    }

    /**
     * Gets query for [[AvaIdguitarra]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvaIdguitarra()
    {
        return $this->hasOne(Guitarras::className(), ['gui_id' => 'ava_idguitarra']);
    }

    /**
     * Gets query for [[AvaIduser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvaIduser()
    {
        return $this->hasOne(User::className(), ['id' => 'ava_iduser']);
    }
}
