<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\News;

/**
 * NewsSearch represents the model behind the search form about `backend\models\News`.
 */
class NewsSearch extends News
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_id'], 'integer'],
            [['news_caption', 'news_description', 'news_thumbnail', 'news_video_url', 'news_created_date', 'news_status'], 'safe'],
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
        $query = News::find();

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
            'news_id' => $this->news_id,
            'news_created_date' => $this->news_created_date,
        ]);

        $query->andFilterWhere(['like', 'news_caption', $this->news_caption])
            ->andFilterWhere(['like', 'news_description', $this->news_description])
            ->andFilterWhere(['like', 'news_thumbnail', $this->news_thumbnail])
            ->andFilterWhere(['like', 'news_video_url', $this->news_video_url])
            ->andFilterWhere(['like', 'news_status', $this->news_status]);

        return $dataProvider;
    }
}
