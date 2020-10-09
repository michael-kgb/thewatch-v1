<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_detail".
 *
 * @property string $order_detail_id
 * @property string $orders_id
 * @property integer $order_invoice_id
 * @property string $warehouse_id
 * @property string $product_id
 * @property string $product_attribute_id
 * @property string $product_name
 * @property string $product_quantity
 * @property integer $product_price
 * @property string $product_upc
 * @property string $product_reference
 * @property string $product_supplier_reference
 * @property integer $product_weight
 * @property integer $original_product_price
 * @property integer $original_wholesale_price
 */
class OrderDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
////            [['orders_id', 'product_id', 'product_name', 'product_price', 'product_weight', 'original_product_price', 'original_wholesale_price'], 'required'],
//            [['orders_id', 'order_invoice_id', 'warehouse_id', 'product_id', 'product_attribute_id', 'product_quantity', 'product_price', 'product_weight', 'original_product_price', 'original_wholesale_price'], 'integer'],
//            [['product_name'], 'string', 'max' => 255],
//            [['product_upc'], 'string', 'max' => 12],
//            [['product_reference', 'product_supplier_reference'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_detail_id' => 'Order Detail ID',
            'orders_id' => 'Orders ID',
            'order_invoice_id' => 'Order Invoice ID',
            'warehouse_id' => 'Warehouse ID',
            'product_id' => 'Product ID',
            'product_attribute_id' => 'Product Attribute ID',
            'product_name' => 'Product Name',
            'product_quantity' => 'Product Quantity',
            'product_price' => 'Product Price',
            'product_upc' => 'Product Upc',
            'product_reference' => 'Product Reference',
            'product_supplier_reference' => 'Product Supplier Reference',
            'product_weight' => 'Product Weight',
            'original_product_price' => 'Original Product Price',
            'original_wholesale_price' => 'Original Wholesale Price',
        ];
    }
    
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }
    
    public function getProductAttributeCombination()
    {
        return $this->hasOne(ProductAttributeCombination::className(), ['product_attribute_id' => 'product_attribute_id']);
    }
	
	public function getOrders()
	{
		return $this->hasOne(Orders::className(), ['orders_id' => 'orders_id']);
	}
	
	public function getOrderDetailWarranty()
	{
		return $this->hasOne(OrderDetailWarranty::className(), ['order_detail_id' => 'order_detail_id']);
	}
}
