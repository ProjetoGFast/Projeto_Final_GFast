<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Encomendas;

/**
 * EncomendasSearch represents the model behind the search form of `common\models\Encomendas`.
 */
class EncomendasSearch extends Encomendas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'enc_estado', 'enc_iduser'], 'integer'],
            [['enc_nome', 'enc_morada'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Encomendas::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'enc_id' => $this->enc_id,
            'enc_estado' => $this->enc_estado,
            'enc_iduser' => $this->enc_iduser,
        ]);

        $query->andFilterWhere(['like', 'enc_nome', $this->enc_nome])
            ->andFilterWhere(['like', 'enc_morada', $this->enc_morada]);

        return $dataProvider;
    }
}
