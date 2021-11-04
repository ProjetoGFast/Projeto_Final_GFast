<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "carrinho".
 *
 * @property int $car_id
 * @property int $car_idguitarras
 * @property int $car_iduser
 * @property int $car_idsaldo
 *
 * @property Guitarras $carIduser
 * @property User $carIduser0
 */
class Carrinho extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carrinho';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_idguitarras', 'car_iduser', 'car_idsaldo'], 'required'],
            [['car_idguitarras', 'car_iduser', 'car_idsaldo'], 'integer'],
            [['car_iduser'], 'exist', 'skipOnError' => true, 'targetClass' => Guitarras::className(), 'targetAttribute' => ['car_iduser' => 'gui_id']],
            [['car_iduser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['car_iduser' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'car_id' => 'Car ID',
            'car_idguitarras' => 'Car Idguitarras',
            'car_iduser' => 'Car Iduser',
            'car_idsaldo' => 'Car Idsaldo',
        ];
    }

    /**
     * Gets query for [[CarIduser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarIduser()
    {
        return $this->hasOne(Guitarras::className(), ['gui_id' => 'car_iduser']);
    }

    /**
     * Gets query for [[CarIduser0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarIduser0()
    {
        return $this->hasOne(User::className(), ['id' => 'car_iduser']);
    }
}
