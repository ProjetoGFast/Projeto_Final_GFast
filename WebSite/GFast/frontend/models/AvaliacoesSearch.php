<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Avaliacoes;

/**
 * AvaliacoesSearch represents the model behind the search form of `common\models\Avaliacoes`.
 */
class AvaliacoesSearch extends Avaliacoes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ava_id', 'ava_idguitarra', 'ava_iduser'], 'integer'],
            [['ava_avaliacao'], 'safe'],
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
        $query = Avaliacoes::find();

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
            'ava_id' => $this->ava_id,
            'ava_idguitarra' => $this->ava_idguitarra,
            'ava_iduser' => $this->ava_iduser,
        ]);

        $query->andFilterWhere(['like', 'ava_avaliacao', $this->ava_avaliacao]);

        return $dataProvider;
    }
}
