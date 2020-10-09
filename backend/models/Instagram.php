<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "instagram".
 *
 * @property integer $instagram_id
 * @property string $post_date
 * @property integer $brand_id
 * @property string $image_id
 * @property string $image_file
 * @property string $image_caption
 * @property integer $image_like_count
 * @property integer $image_comment_count
 * @property integer $active
 */
class Instagram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'instagram';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_date', 'brand_id', 'image_id', 'image_file', 'image_caption', 'image_like_count', 'image_comment_count', 'active'], 'required'],
            [['post_date'], 'safe'],
            [['brand_id', 'image_like_count', 'image_comment_count', 'active'], 'integer'],
            [['image_id', 'image_file', 'image_caption'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'instagram_id' => 'Instagram ID',
            'post_date' => 'Post Date',
            'brand_id' => 'Brand ID',
            'image_id' => 'Image ID',
            'image_file' => 'Image File',
            'image_caption' => 'Image Caption',
            'image_like_count' => 'Image Like Count',
            'image_comment_count' => 'Image Comment Count',
            'active' => 'Active',
        ];
    }
    
    public function getBrand()
    {
        return $this->hasOne(Brands::className(), ['brand_id' => 'brand_id']);
    }
}
