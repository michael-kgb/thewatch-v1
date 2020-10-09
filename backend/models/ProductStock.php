<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_stock".
 *
 * @property string $product_stock_id
 * @property string $product_id
 * @property string $product_attribute_id
 * @property integer $quantity
 */
class ProductStock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'product_attribute_id'], 'required'],
            [['product_id', 'product_attribute_id', 'quantity'], 'integer'],
//            [['product_id', 'product_attribute_id'], 'unique', 'targetAttribute' => ['product_id', 'product_attribute_id'], 'message' => 'The combination of Product ID and Product Attribute ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_stock_id' => 'Product Stock ID',
            'product_id' => 'Product ID',
            'product_attribute_id' => 'Product Attribute ID',
            'quantity' => 'Quantity',
        ];
    }
    
    public function getProductStock()
    {
        return $this->hasOne(ProductAttributeCombination::className(), ['product_attribute_id' => 'product_attribute_id']);
    }
    
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }
}
