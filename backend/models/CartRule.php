<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cart_rule".
 *
 * @property string $cart_rule_id
 * @property string $customer_id
 * @property string $date_from
 * @property string $date_to
 * @property string $description
 * @property string $quantity
 * @property string $quantity_per_user
 * @property string $priority
 * @property integer $partial_use
 * @property string $code
 * @property string $minimum_amount
 * @property integer $minimum_amount_tax
 * @property string $minimum_amount_currency
 * @property integer $minimum_amount_shipping
 * @property integer $country_restriction
 * @property integer $carrier_restriction
 * @property integer $group_restriction
 * @property integer $cart_rule_restriction
 * @property integer $product_restriction
 * @property integer $shop_restriction
 * @property integer $free_shipping
 * @property string $reduction_percent
 * @property string $reduction_amount
 * @property integer $reduction_tax
 * @property string $reduction_currency
 * @property integer $reduction_product
 * @property string $gift_product
 * @property string $gift_product_attribute
 * @property integer $highlight
 * @property integer $active
 * @property string $date_add
 * @property string $date_upd
 */
class CartRule extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'cart_rule';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
//            [['customer_id', 'quantity', 'quantity_per_user', 'priority', 'partial_use', 'minimum_amount_tax', 'minimum_amount_currency', 'minimum_amount_shipping', 'country_restriction', 'carrier_restriction', 'group_restriction', 'cart_rule_restriction', 'product_restriction', 'shop_restriction', 'free_shipping', 'reduction_tax', 'reduction_currency', 'reduction_product', 'gift_product', 'gift_product_attribute', 'highlight', 'active'], 'integer'],
//            [['date_from', 'date_to', 'code', 'date_add', 'date_upd'], 'required'],
//            [['date_from', 'date_to', 'date_add', 'date_upd'], 'safe'],
//            [['description'], 'string'],
//            [['minimum_amount', 'reduction_percent', 'reduction_amount'], 'number'],
//            [['code'], 'string', 'max' => 254]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'cart_rule_id' => 'Cart Rule ID',
            'customer_id' => 'Customer ID',
            'date_from' => 'Date From',
            'date_to' => 'Date To',
            'description' => 'Description',
            'quantity' => 'Quantity',
            'quantity_per_user' => 'Quantity Per User',
            'priority' => 'Priority',
            'partial_use' => 'Partial Use',
            'code' => 'Code',
            'minimum_amount' => 'Minimum Amount',
            'minimum_amount_tax' => 'Minimum Amount Tax',
            'minimum_amount_currency' => 'Minimum Amount Currency',
            'minimum_amount_shipping' => 'Minimum Amount Shipping',
            'country_restriction' => 'Country Restriction',
            'carrier_restriction' => 'Carrier Restriction',
            'group_restriction' => 'Group Restriction',
            'cart_rule_restriction' => 'Cart Rule Restriction',
            'product_restriction' => 'Product Restriction',
            'shop_restriction' => 'Shop Restriction',
            'free_shipping' => 'Free Shipping',
            'reduction_percent' => 'Reduction Percent',
            'reduction_amount' => 'Reduction Amount',
            'reduction_tax' => 'Reduction Tax',
            'reduction_currency' => 'Reduction Currency',
            'reduction_product' => 'Reduction Product',
            'gift_product' => 'Gift Product',
            'gift_product_attribute' => 'Gift Product Attribute',
            'highlight' => 'Highlight',
            'active' => 'Active',
            'date_add' => 'Date Add',
            'date_upd' => 'Date Upd',
        ];
    }

    public function getCartRuleLang() {
        return $this->hasOne(CartRuleLang::className(), ['cart_rule_id' => 'cart_rule_id']);
    }
    
    public function getCustomer() {
        return $this->hasOne(Customer::className(), ['customer_id' => 'customer_id']);
    }

}
