<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Guitarras;

/**
 * GuitarrasSearch represents the model behind the search form of `common\models\Guitarras`.
 */
class GuitarrasSearch extends Guitarras
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gui_id', 'gui_idsubcategoria', 'gui_idmarca', 'gui_idvenda', 'gui_idreferencia', 'gui_iva', 'gui_inativo'], 'integer'],
            [['gui_nome', 'gui_descricao'], 'safe'],
            [['gui_preco'], 'number'],
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
        $query = Guitarras::find();

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
            'gui_id' => $this->gui_id,
            'gui_idsubcategoria' => $this->gui_idsubcategoria,
            'gui_idmarca' => $this->gui_idmarca,
            'gui_idvenda' => $this->gui_idvenda,
            'gui_idreferencia' => $this->gui_idreferencia,
            'gui_preco' => $this->gui_preco,
            'gui_iva' => $this->gui_iva,
            'gui_inativo' => $this->gui_inativo,
        ]);

        $query->andFilterWhere(['like', 'gui_nome', $this->gui_nome])
            ->andFilterWhere(['like', 'gui_descricao', $this->gui_descricao]);

        return $dataProvider;
    }
}
