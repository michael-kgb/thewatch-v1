<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "instagram_related_hashtag".
 *
 * @property integer $instagram_related_hashtag_id
 * @property string $hashtag_name
 * @property integer $post_count
 * @property integer $interaction_count
 * @property integer $like_count
 */
class InstagramRelatedHashtag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'instagram_related_hashtag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hashtag_name', 'post_count', 'interaction_count', 'like_count'], 'required'],
            [['post_count', 'interaction_count', 'like_count'], 'integer'],
            [['hashtag_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'instagram_related_hashtag_id' => 'Instagram Related Hashtag ID',
            'hashtag_name' => 'Hashtag Name',
            'post_count' => 'Post Count',
            'interaction_count' => 'Interaction Count',
            'like_count' => 'Like Count',
        ];
    }
}
