<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Brands;

/**
 * BrandsSearch represents the model behind the search form about `backend\models\Brands`.
 */
class BrandsSearch extends Brands
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_id', 'brand_sequence'], 'integer'],
            [['brand_name', 'brand_logo', 'brand_created_date', 'brand_status'], 'safe'],
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
        $query = Brands::find();

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
            'brand_id' => $this->brand_id,
            'brand_created_date' => $this->brand_created_date,
            'brand_sequence' => $this->brand_sequence,
        ]);

        $query->andFilterWhere(['like', 'brand_name', $this->brand_name])
            ->andFilterWhere(['like', 'brand_logo', $this->brand_logo])
            ->andFilterWhere(['like', 'brand_status', $this->brand_status]);

        return $dataProvider;
    }
}
