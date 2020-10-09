<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_category_brands".
 *
 * @property integer $product_category_brands_id
 * @property integer $product_category_category_id
 * @property integer $brands_brand_id
 */
class ProductCategoryBrands extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_category_brands';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_category_category_id', 'brands_brand_id'], 'required'],
            [['product_category_category_id', 'brands_brand_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_category_brands_id' => 'Product Category Brands ID',
            'product_category_category_id' => 'Product Category Category ID',
            'brands_brand_id' => 'Brands Brand ID',
        ];
    }
    
    public function getProduct(){
        return $this->hasOne(Product::className(), ['brands_brand_id' => 'brands_brand_id']);
    }
    
    
    public function getBrands()
    {
        return $this->hasOne(Brands::className(), ['brand_id' => 'brands_brand_id']);
    }
}
