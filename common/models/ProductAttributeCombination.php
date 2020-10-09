<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_attribute_combination".
 *
 * @property integer $product_attribute_combination_id
 * @property integer $attribute_id
 * @property integer $attribute_value_id
 * @property integer $product_attribute_id
 */
class ProductAttributeCombination extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_attribute_combination';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attribute_id', 'attribute_value_id', 'product_attribute_id'], 'required'],
            [['attribute_id', 'attribute_value_id', 'product_attribute_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_attribute_combination_id' => 'Product Attribute Combination ID',
            'attribute_id' => 'Attribute ID',
            'attribute_value_id' => 'Attribute Value ID',
            'product_attribute_id' => 'Product Attribute ID',
        ];
    }
    
    public function getProductAttribute()
    {
        return $this->hasOne(ProductAttribute::className(), ['product_attribute_id' => 'product_attribute_id']);
    }
    
    public function getAttributes($names = null, $except = [])
    {
        return $this->hasOne(Attributes::className(), ['attribute_id' => 'attribute_id']);
    }
    
    public function getAttributeValue()
    {
        return $this->hasOne(AttributeValue::className(), ['attribute_value_id' => 'attribute_value_id']);
    }
    
    public function getAttributes2()
    {
        return $this->hasOne(Attributes::className(), ['attribute_id' => 'attribute_id_2']);
    }
    
    public function getAttributeValue2()
    {
        return $this->hasOne(AttributeValue::className(), ['attribute_value_id' => 'attribute_value_id_2']);
    }
    
    public function getProductStock()
    {
        return $this->hasOne(ProductStock::className(), ['product_attribute_id' => 'product_attribute_id']);
    }
    
    public function getProductAttributeImage()
    {
        return $this->hasOne(ProductAttributeImage::className(), ['id_product_attribute' => 'product_attribute_id']);
    }
}
