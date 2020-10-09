<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "instagram_tags".
 *
 * @property integer $instagram_tags_id
 * @property string $instagram_id
 * @property string $tags_name
 * @property integer $status
 */
class InstagramTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public $total;
    
    public static function tableName()
    {
        return 'instagram_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['instagram_id', 'tags_name', 'status'], 'required'],
//            [['instagram_id'], 'integer'],
//            [['status'], 'integer'],
//            [['tags_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'instagram_tags_id' => 'Instagram Tags ID',
            'instagram_id' => 'Instagram ID',
            'tags_name' => 'Tags Name',
            'status' => 'Status',
        ];
    }
}
