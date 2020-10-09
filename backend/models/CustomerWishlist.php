<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customer_wishlist".
 *
 * @property integer $customer_wishlist_id
 * @property string $customer_id 
 * @property integer $created_at
 * @property integer $update_at
 */
class CustomerWishlist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_wishlist';
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
            'customer_wishlist_id' => 'Customer Wishlist ID',
            'customer_id' => 'Customer ID',
            'name_wishlist' => 'Name Wishlist',
			'created_at' => 'Created At',
            'update_at' => 'Update At',
            'is_default' => 'Is Default'
        ];
    }

    public static function checkProductinWishlist($product_id, $product_attrubute_id, $customer_id)
    {
      $query = self::find()
          ->select('*')
                    ->join('INNER JOIN', 'customer_wishlist_detail', 'customer_wishlist.customer_wishlist_id = customer_wishlist_detail.customer_wishlist_id')
                    ->join('INNER JOIN', 'product', 'product.product_id = customer_wishlist_detail.product_id')
          ->where(['customer_wishlist_detail.product_attribute_id' => $product_attrubute_id])
          ->andWhere(['customer_wishlist_detail.product_id'=>$product_id])
          ->andWhere(['customer_wishlist.customer_id'=>$customer_id]);
        
        $result = $query->count();
        return $result;
    }
	
	public function getCustomer(){
        return $this->hasOne(Customer::className(), ['customer_id' => 'customer_id']);
    }
	
	public function getCustomerWishlistDetail(){
		return $this->hasMany(CustomerWishlistDetail::className(), ['customer_wishlist_id' => 'customer_wishlist_id']);
	}
}
