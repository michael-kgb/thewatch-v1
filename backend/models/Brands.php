<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brands".
 *
 * @property integer $brand_id
 * @property string $brand_name
 * @property string $brand_description
 * @property string $brand_country
 * @property string $brand_logo
 * @property string $brand_logo_hover
 * @property string $brand_created_date
 * @property string $brand_status
 * @property integer $brand_sequence
 * @property integer $brand_featured
 */
class Brands extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brands';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['brand_name', 'brand_description', 'brand_logo', 'brand_created_date', 'brand_status', 'brand_sequence'], 'required'],
            //[['brand_description', 'brand_logo', 'brand_logo_hover', 'brand_status'], 'string'],
            //[['brand_created_date'], 'safe'],
            //[['brand_sequence', 'brand_featured'], 'integer'],
            //[['brand_name', 'brand_country'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'brand_id' => 'Brand ID',
            'brand_name' => 'Brand Name',
            'brand_description' => 'Brand Description',
            'brand_country' => 'Brand Country',
            'brand_logo' => 'Brand Logo',
            'brand_logo_hover' => 'Brand Logo Hover',
            'brand_created_date' => 'Brand Created Date',
            'brand_status' => 'Brand Status',
            'brand_sequence' => 'Brand Sequence',
            'brand_featured' => 'Brands Logo Viewed',
            'brand_homepage'=>'Featured Brand',
            'brand_homepage_jewelry'=>'Featured Brand Jewelry'
        ];
    }
    
    public function getBrandsBannerDetail()
    {
        return $this->hasOne(BrandsBannerDetail::className(), ['brand_id' => 'brands_brand_id']);
    }
    
    public static function getBrandDetail($params = []){
        return self::find()->where($params)->one();
    }
    
    public function getProduct(){
        return $this->hasOne(Product::className(), ['brand_id' => 'brands_brand_id']);
    }
    
    public function getBrandsCollection()
    {
        return $this->hasOne(BrandsCollection::className(), ['brands_brand_id' => 'brands_brand_id']);
    }
}
