<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property string $orders_id
 * @property string $reference
 * @property string $carrier_id
 * @property string $apps_language_id
 * @property string $customer_id
 * @property string $currency_id
 * @property string $customer_address_id
 * @property string $secure_key
 * @property integer $payment_method_detail_id
 * @property integer $gift
 * @property string $gift_message
 * @property string $shipping_number
 * @property integer $total_discounts
 * @property integer $total_paid
 * @property integer $total_paid_real
 * @property integer $total_cart_item
 * @property integer $total_cart_item_quantity
 * @property integer $total_product_price
 * @property integer $total_shipping
 * @property integer $carrier_tax_rate
 * @property integer $total_wrapping
 * @property string $invoice_number
 * @property string $delivery_number
 * @property string $invoice_date
 * @property string $delivery_date
 * @property string $valid
 * @property string $date_add
 * @property string $date_upd
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['carrier_cost_id', 'apps_language_id', 'customer_id', 'currency_id', 'customer_address_id', 'secure_key', 'payment_method_detail_id', 'total_discounts', 'total_paid', 'total_paid_real', 'total_cart_item', 'total_cart_item_quantity', 'total_product_price', 'total_shipping', 'carrier_tax_rate', 'total_wrapping', 'invoice_date', 'delivery_date', 'date_add', 'date_upd'], 'required'],
//            [['carrier_cost_id', 'apps_language_id', 'customer_id', 'currency_id', 'customer_address_id', 'payment_method_detail_id', 'gift', 'total_discounts', 'total_paid', 'total_paid_real', 'total_cart_item', 'total_cart_item_quantity', 'total_product_price', 'total_shipping', 'carrier_tax_rate', 'total_wrapping', 'invoice_number', 'delivery_number', 'valid'], 'integer'],
//            [['secure_key', 'gift_message'], 'string'],
//            [['invoice_date', 'delivery_date', 'date_add', 'date_upd'], 'safe'],
//            [['reference'], 'string', 'max' => 9],
//            [['shipping_number'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orders_id' => 'Orders ID',
            'reference' => 'Reference',
            'carrier_cost_id' => 'Carrier ID',
            'apps_language_id' => 'Apps Language ID',
            'customer_id' => 'Customer ID',
            'currency_id' => 'Currency ID',
            'customer_address_id' => 'Customer Address ID',
            'secure_key' => 'Secure Key',
            'payment_method_detail_id' => 'Payment Method Detail ID',
            'gift' => 'Gift',
            'gift_message' => 'Gift Message',
            'shipping_number' => 'Shipping Number',
            'total_discounts' => 'Total Discounts',
            'total_paid' => 'Total Paid',
            'total_paid_real' => 'Total Paid Real',
            'total_cart_item' => 'Total Cart Item',
            'total_cart_item_quantity' => 'Total Cart Item Quantity',
            'total_product_price' => 'Total Product Price',
            'total_shipping' => 'Total Shipping',
            'carrier_tax_rate' => 'Carrier Tax Rate',
            'total_wrapping' => 'Total Wrapping',
            'invoice_number' => 'Invoice Number',
            'delivery_number' => 'Delivery Number',
            'invoice_date' => 'Invoice Date',
            'delivery_date' => 'Delivery Date',
            'valid' => 'Valid',
            'date_add' => 'Date Add',
            'date_upd' => 'Date Upd',
        ];
    }
    
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['customer_id' => 'customer_id']);
    }
    
    public function getCustomeraddress()
    {
        return $this->hasOne(CustomerAddress::className(), ['customer_address_id' => 'customer_address_id']);
    }
    
    public function getPaymentmethoddetail()
    {
        return $this->hasOne(PaymentMethodDetail::className(), ['payment_method_detail_id' => 'payment_method_detail_id']);
    }
    
    public function getPaymentmethodinstallmentdetail()
    {
        return $this->hasOne(PaymentMethodInstallmentDetail::className(), ['payment_method_installment_detail_id' => 'payment_method_installment_detail_id']);
    }
    
    public function getCarriercost()
    {
        return $this->hasOne(CarrierCost::className(), ['carrier_cost_id' => 'carrier_cost_id']);
    }
    
    public function getOrderCartRule(){
        return $this->hasOne(OrderCartRule::className(), ['orders_id' => 'orders_id']);
    }
	
	public function getOrderhistory(){
        return $this->hasOne(OrderHistory::className(), ['orders_id' => 'orders_id'])->orderBy(['order_history_id' => SORT_DESC]);
    }
	
	public function getStores(){
        return $this->hasOne(Stores::className(), ['store_id' => 'store_id']);
    }
    
    public function getSpecialPromo(){
        return $this->hasOne(SpecialPromo::className(), ['special_promo_id' => 'special_promo_id']);
    }
    
    public function getOrderComplain(){
        return $this->hasOne(OrderComplain::className(), ['orders_id' => 'orders_id']);
    }

}
