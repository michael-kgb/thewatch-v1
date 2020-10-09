<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cart_rule_product_rule_value".
 *
 * @property integer $product_rule_id
 * @property integer $product_id
 */
class CartRuleProductRuleValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart_rule_product_rule_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_rule_id', 'product_id'], 'required'],
            [['product_rule_id', 'product_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_rule_id' => 'Product Rule ID',
            'product_id' => 'Product ID',
        ];
    }
    
    public function getProduct(){
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }
    
    public function getAttributeValueCombination(){
        return $this->hasOne(AttributeValueCombination::className(), ['attribute_value_combination_id' => 'product_id']);
    }
    
    public function getProductFeatureValue(){
        return $this->hasOne(ProductFeatureValue::className(), ['feature_value_id' => 'product_id']);
    }
    
    public function getBrands(){
        return $this->hasOne(Brands::className(), ['brand_id' => 'product_id']);
    }
}
