<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Favoritos;

/**
 * FavoritosSearch represents the model behind the search form of `common\models\Favoritos`.
 */
class FavoritosSearch extends Favoritos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fav_id', 'fav_idguitarras', 'fav_iduser'], 'integer'],
            [['fav_idsaldo'], 'safe'],
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
        $query = Favoritos::find();

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
            'fav_id' => $this->fav_id,
            'fav_idguitarras' => $this->fav_idguitarras,
            'fav_iduser' => $this->fav_iduser,
        ]);

        $query->andFilterWhere(['like', 'fav_idsaldo', $this->fav_idsaldo]);

        return $dataProvider;
    }
}
