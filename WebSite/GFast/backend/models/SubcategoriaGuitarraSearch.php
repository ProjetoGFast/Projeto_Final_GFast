<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SubcategoriaGuitarra;

/**
 * SubcategoriaGuitarraSearch represents the model behind the search form of `common\models\SubcategoriaGuitarra`.
 */
class SubcategoriaGuitarraSearch extends SubcategoriaGuitarra
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sub_id'], 'integer'],
            [['sub_nome', 'sub_idcat'], 'safe'],
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
        $query = SubcategoriaGuitarra::find()->joinWith(['subIdcat']);

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
            'sub_id' => $this->sub_id,
            //'sub_idcat' => $this->sub_idcat,
        ]);

        $query->andFilterWhere(['like', 'sub_nome', $this->sub_nome])
            ->andFilterWhere(['like', 'cat_nome', $this->sub_idcat]);

        return $dataProvider;
    }
}
