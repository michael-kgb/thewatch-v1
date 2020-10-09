<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "specific_price".
 *
 * @property string $specific_price_id
 * @property string $product_id
 * @property string $currency_id
 * @property string $customer_id
 * @property string $product_attribute_id
 * @property integer $price
 * @property string $from_quantity
 * @property integer $reduction
 * @property string $reduction_type
 * @property string $from
 * @property string $to
 */
class SpecificPrice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'specific_price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['product_id', 'currency_id', 'customer_id', 'product_attribute_id', 'price', 'from_quantity', 'reduction', 'reduction_type', 'from', 'to'], 'required'],
//            [['product_id', 'currency_id', 'customer_id', 'product_attribute_id', 'price', 'from_quantity', 'reduction'], 'integer'],
//            [['reduction_type'], 'string'],
//            [['from', 'to'], 'safe'],
//            [['product_id', 'product_attribute_id', 'customer_id', 'from', 'to', 'currency_id', 'from_quantity'], 'unique', 'targetAttribute' => ['product_id', 'product_attribute_id', 'customer_id', 'from', 'to', 'currency_id', 'from_quantity'], 'message' => 'The combination of Product ID, Currency ID, Customer ID, Product Attribute ID, From Quantity, From and To has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'specific_price_id' => 'Specific Price ID',
            'product_id' => 'Product ID',
            'currency_id' => 'Currency ID',
            'customer_id' => 'Customer ID',
            'product_attribute_id' => 'Product Attribute ID',
            'price' => 'Price',
            'from_quantity' => 'From Quantity',
            'reduction' => 'Reduction',
            'reduction_type' => 'Reduction Type',
            'from' => 'From',
            'to' => 'To',
        ];
    }
    
    public function getProduct(){
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }
}
