<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "seo_pages_content_brands".
 *
 * @property integer $seo_pages_content_brands_id
 * @property integer $seo_pages_content_id
 * @property integer $brand_id
 */
class SeoPagesContentBrands extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_pages_content_brands';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seo_pages_content_id', 'brand_id'], 'required'],
            [['seo_pages_content_id', 'brand_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'seo_pages_content_brands_id' => 'Seo Pages Content Brands ID',
            'seo_pages_content_id' => 'Seo Pages Content ID',
            'brand_id' => 'Brand ID',
        ];
    }
	
	public function getBrands() {
        return $this->hasOne(Brands::className(), ['brand_id' => 'brand_id']);
    }
	
	public function getSeoPagesContent() {
        return $this->hasOne(SeoPagesContent::className(), ['seo_pages_content_id' => 'seo_pages_content_id']);
    }
}
