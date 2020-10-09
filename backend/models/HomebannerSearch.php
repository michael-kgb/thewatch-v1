<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Homebanner;

/**
 * HomebannerSearch represents the model behind the search form about `backend\models\Homebanner`.
 */
class HomebannerSearch extends Homebanner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['homebanner_id'], 'integer'],
            [['homebanner_name', 'homebanner_images', 'homebanner_created_date', 'homebanner_status'], 'safe'],
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
        $query = Homebanner::find();

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
            'homebanner_id' => $this->homebanner_id,
            'homebanner_created_date' => $this->homebanner_created_date,
        ]);

        $query->andFilterWhere(['like', 'homebanner_name', $this->homebanner_name])
            ->andFilterWhere(['like', 'homebanner_images', $this->homebanner_images])
            ->andFilterWhere(['like', 'homebanner_status', $this->homebanner_status]);

        return $dataProvider;
    }
}
