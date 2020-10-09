<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_detail".
 *
 * @property string $product_id
 * @property string $apps_language_id
 * @property string $description
 * @property string $spesification
 * @property string $link_rewrite
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $meta_title
 * @property string $name
 * @property string $available_now
 * @property string $available_later
 */
class ProductDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['product_id', 'link_rewrite', 'name'], 'required'],
//            [['product_id', 'apps_language_id'], 'integer'],
            [['description', 'spesification'], 'string'],
            [['link_rewrite', 'meta_title', 'name'], 'string', 'max' => 128],
            [['meta_description', 'meta_keywords', 'available_now', 'available_later'], 'string', 'max' => 155]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'apps_language_id' => 'Apps Language ID',
            'description' => 'Description',
            'spesification' => 'spesification',
            'link_rewrite' => 'Link Rewrite',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'meta_title' => 'Meta Title',
            'name' => 'Name',
            'available_now' => 'Available Now',
            'available_later' => 'Available Later',
        ];
    }
    
    public function getProduct(){
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }
    
    public function getProductRelated(){
        return $this->hasOne(ProductRelated::className(), ['product_id' => 'product_id']);
    }
    
    public function getProductTag(){
        return $this->hasOne(ProductTag::className(), ['product_id' => 'product_id']);
    }
	
	public function getShippingAvailabilityLocation(){
        return $this->hasOne(ShippingAvailabilityLocation::className(), ['shipping_availability_location_id' => 'shipping_availability_location_id']);
    }
    
}
