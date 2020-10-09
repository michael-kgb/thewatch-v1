<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Stores;

/**
 * StoresSearch represents the model behind the search form about `backend\models\Stores`.
 */
class StoresSearch extends Stores
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'store_sequence'], 'integer'],
            [['store_name', 'store_separator', 'store_location', 'store_address', 'store_thumbnail', 'store_contact_person', 'store_contact_number', 'store_created_date', 'store_status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Stores::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'store_id' => $this->store_id,
            'store_sequence' => $this->store_sequence,
            'store_created_date' => $this->store_created_date,
        ]);

        $query->andFilterWhere(['like', 'store_name', $this->store_name])
            ->andFilterWhere(['like', 'store_separator', $this->store_separator])
            ->andFilterWhere(['like', 'store_location', $this->store_location])
            ->andFilterWhere(['like', 'store_address', $this->store_address])
            ->andFilterWhere(['like', 'store_thumbnail', $this->store_thumbnail])
            ->andFilterWhere(['like', 'store_contact_person', $this->store_contact_person])
            ->andFilterWhere(['like', 'store_contact_number', $this->store_contact_number])
            ->andFilterWhere(['like', 'store_status', $this->store_status]);

        return $dataProvider;
    }
}
