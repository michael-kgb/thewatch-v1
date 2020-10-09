<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brands_banner".
 *
 * @property integer $brand_banner_id
 * @property integer $brands_brand_id
 * @property string $brand_banner_small_banner
 * @property string $brand_banner_filename
 * @property string $brand_banner_status
 */
class BrandsBanner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brands_banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['brands_brand_id', 'brand_banner_filename', 'brand_banner_status'], 'required'],
            [['brands_brand_id'], 'integer'],
            [['brand_banner_small_banner', 'brand_banner_filename', 'brand_banner_status'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'brand_banner_id' => 'Brand Banner ID',
            'brands_brand_id' => 'Brands Brand ID',
            'brand_banner_small_banner' => 'Brand Banner Small Banner',
            'brand_banner_filename' => 'Brand Banner Filename',
            'brand_banner_status' => 'Brand Banner Status',
        ];
    }
    
    public function getBrands(){
        return $this->hasOne(Brands::className(), ['brand_id' => 'brands_brand_id']);
    }
}
