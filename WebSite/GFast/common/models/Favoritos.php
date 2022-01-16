<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "favoritos".
 *
 * @property int $fav_id
 * @property int $fav_idguitarras
 * @property int $fav_iduser
 * @property int|null $fav_idsaldo
 *
 * @property Guitarras $favIdguitarras
 * @property User $favIduser
 */
class Favoritos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favoritos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fav_idguitarras', 'fav_iduser'], 'required'],
            [['fav_idguitarras', 'fav_iduser', 'fav_idsaldo'], 'integer'],
            [['fav_idguitarras'], 'exist', 'skipOnError' => true, 'targetClass' => Guitarras::className(), 'targetAttribute' => ['fav_idguitarras' => 'gui_id']],
            [['fav_iduser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fav_iduser' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fav_id' => 'Fav ID',
            'fav_idguitarras' => 'Fav Idguitarras',
            'fav_iduser' => 'Fav Iduser',
            'fav_idsaldo' => 'Fav Idsaldo',
        ];
    }

    /**
     * Gets query for [[FavIdguitarras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavIdguitarras()
    {
        return $this->hasOne(Guitarras::className(), ['gui_id' => 'fav_idguitarras']);
    }

    /**
     * Gets query for [[FavIduser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavIduser()
    {
        return $this->hasOne(User::className(), ['id' => 'fav_iduser']);
    }
}
