<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "instagram_hashtag".
 *
 * @property integer $instagram_hashtag_id
 * @property integer $user_id
 * @property string $user_photo
 * @property string $username
 * @property string $fullname
 * @property integer $like_count
 * @property integer $comment_count
 */
class InstagramHashtag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'instagram_hashtag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['instagram_hashtag_id', 'user_id', 'user_photo', 'username', 'fullname', 'like_count', 'comment_count'], 'required'],
//            [['instagram_hashtag_id', 'user_id', 'like_count', 'comment_count'], 'integer'],
//            [['user_photo'], 'string'],
//            [['username', 'fullname'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'instagram_hashtag_id' => 'Instagram Hashtag ID',
            'user_id' => 'User ID',
            'user_photo' => 'User Photo',
            'username' => 'Username',
            'fullname' => 'Fullname',
            'like_count' => 'Like Count',
            'comment_count' => 'Comment Count',
        ];
    }
}
