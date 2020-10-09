<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customer_wishlist_detail".
 *
 * @property integer $customer_wishlist_detail_id
 * @property string $customer_id
 * @property integer $created_at
 * @property integer $update_at
 */
class CustomerWishlistDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_wishlist_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['warranty_name', 'warranty_year', 'warranty_status'], 'required'],
//            [['warranty_year', 'warranty_status'], 'integer'],
//            [['warranty_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_wishlist_detail_id' => 'Customer Wishlist Detail ID',
            'product_id' => 'Product ID',
			'product_attribute_id' => 'Product Attribute ID',
            'customer_wishlist_id' => 'Customer Wishlist ID',
            'created_at' => 'Created At'

        ];
    }
	
	public function getProduct(){
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }
	
	public function getCustomerWishlist(){
		return $this->hasOne(CustomerWishlist::className(), ['customer_wishlist_id' => 'customer_wishlist_id']);
	}
}
