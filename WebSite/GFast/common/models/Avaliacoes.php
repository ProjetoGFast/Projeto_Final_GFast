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

    /**
     * @param string $ava_avaliacao
     */
    public function setAvaAvaliacao($ava_avaliacao)
    {
        $this->ava_avaliacao = $ava_avaliacao;
    }

    /**
     * @param int $ava_idguitarra
     */
    public function setAvaIdguitarra($ava_idguitarra)
    {
        $this->ava_idguitarra = $ava_idguitarra;
    }

    /**
     * @param int $ava_iduser
     */
    public function setAvaIduser($ava_iduser)
    {
        $this->ava_iduser = $ava_iduser;
    }
    public static function findByTitulo($titulo)
    {
        return static::findOne(['ava_avaliacao' => $titulo]);
    }
    /**
     * @param int $ava_iduser
     */
    public function createAva()
    {
        $ava = new \common\models\Avaliacoes();

        $ava->ava_iduser = $this->ava_iduser;
        $ava->ava_avaliacao = $this->ava_avaliacao;
        $ava->ava_idguitarra = $this->ava_idguitarra;

        $ava->save(false);


        return true;
    }
}
