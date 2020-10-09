<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $news_id
 * @property string $news_caption
 * @property string $news_short_description
 * @property string $news_long_description
 * @property string $news_thumbnail
 * @property string $news_video_url
 * @property string $news_publish_date
 * @property string $news_periode_start_date
 * @property string $news_periode_end_date
 * @property string $news_created_date
 * @property string $news_status
 * @property string $news_featured
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_caption', 'news_description', 'news_thumbnail', 'news_video_url', 'news_publish_date', 'news_periode_start_date', 'news_periode_end_date', 'news_status', 'news_featured'], 'required'],
            [['news_description', 'news_thumbnail', 'news_status', 'news_featured'], 'string'],
            [['news_publish_date', 'news_periode_start_date', 'news_periode_end_date', 'news_created_date'], 'safe'],
            [['news_caption', 'news_video_url'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'news_id' => 'News ID',
            'news_caption' => 'News Caption',
            'news_description' => 'News Description',
            'news_thumbnail' => 'News Thumbnail',
            'news_video_url' => 'News Video Url',
            'news_publish_date' => 'News Publish Date',
            'news_periode_start_date' => 'News Periode Start Date',
            'news_periode_end_date' => 'News Periode End Date',
            'news_created_date' => 'News Created Date',
            'news_status' => 'News Status',
            'news_featured' => 'News Featured',
        ];
    }
}
