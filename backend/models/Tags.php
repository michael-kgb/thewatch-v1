<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property integer $tag_id
 * @property string $tag_name
 * @property integer $apps_language_id
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_name', 'apps_language_id'], 'required'],
            [['apps_language_id'], 'integer'],
            [['tag_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tag_id' => 'Tag ID',
            'tag_name' => 'Tag Name',
            'apps_language_id' => 'Apps Language ID',
        ];
    }
    
    public function getProductTag()
    {
        return $this->hasOne(ProductTag::className(), ['tag_id' => 'tag_id']);
    }
}
