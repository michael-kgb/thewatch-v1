<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "seo_pages_content".
 *
 * @property integer $seo_pages_content_id
 * @property integer $seo_pages_id
 * @property string $seo_pages_meta_title
 * @property string $seo_pages_meta_description
 * @property string $seo_pages_meta_keywords
 */
class SeoPagesContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_pages_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['seo_pages_id', 'seo_pages_meta_title', 'seo_pages_meta_description', 'seo_pages_meta_keywords'], 'required'],
//            [['seo_pages_id'], 'integer'],
//            [['seo_pages_meta_title', 'seo_pages_meta_description', 'seo_pages_meta_keywords'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'seo_pages_content_id' => 'Seo Pages Content ID',
            'seo_pages_id' => 'Seo Pages ID',
            'seo_pages_meta_title' => 'Seo Pages Meta Title',
            'seo_pages_meta_description' => 'Seo Pages Meta Description',
            'seo_pages_meta_keywords' => 'Seo Pages Meta Keywords',
        ];
    }
    
    public function getSeoPages() {
        return $this->hasOne(SeoPages::className(), ['seo_pages_id' => 'seo_pages_id']);
    }
}
