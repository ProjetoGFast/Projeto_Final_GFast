<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Marcas;

/**
 * MarcasSearch represents the model behind the search form of `common\models\Marcas`.
 */
class MarcasSearch extends Marcas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mar_id', 'mar_inativo'], 'integer'],
            [['mar_nome'], 'safe'],
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
        $query = Marcas::find();

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
            'mar_id' => $this->mar_id,
            'mar_inativo' => $this->mar_inativo,
        ]);

        $query->andFilterWhere(['like', 'mar_nome', $this->mar_nome]);

        return $dataProvider;
    }
}
