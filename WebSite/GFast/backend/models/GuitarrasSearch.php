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
            [['gui_id','gui_iva', 'gui_inativo'], 'integer'],
            [['gui_nome', 'gui_idreferencia', 'gui_descricao', 'gui_fotopath', 'gui_qrcodepath','gui_idmarca', 'gui_idsubcategoria'], 'safe'],
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
        $query = Guitarras::find()->joinWith(['guiIdmarca', 'guiIdsubcategoria']);

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
          //  'sub_nome' => $this->gui_idsubcategoria,
           // 'mar_nome' => $this->gui_idmarca,
            'gui_preco' => $this->gui_preco,
            'gui_iva' => $this->gui_iva,
            'gui_inativo' => $this->gui_inativo,
        ]);

        $query->andFilterWhere(['like', 'gui_nome', $this->gui_nome])
            ->andFilterWhere(['like', 'mar_nome', $this->gui_idmarca])
            ->andFilterWhere(['like', 'sub_nome', $this->gui_idsubcategoria])

            ->andFilterWhere(['like', 'gui_descricao', $this->gui_descricao])
            ->andFilterWhere(['like', 'gui_fotopath', $this->gui_fotopath])
            ->andFilterWhere(['like', 'gui_qrcodepath', $this->gui_qrcodepath]);

        return $dataProvider;
    }
}
