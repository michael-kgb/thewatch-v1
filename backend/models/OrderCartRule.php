<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_cart_rule".
 *
 * @property string $order_cart_rule_id
 * @property string $orders_id
 * @property string $cart_rule_id
 * @property string $order_invoice_id
 * @property string $name
 * @property string $value
 * @property integer $free_shipping
 */
class OrderCartRule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_cart_rule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['orders_id', 'cart_rule_id', 'name'], 'required'],
//            [['orders_id', 'cart_rule_id', 'order_invoice_id', 'free_shipping'], 'integer'],
//            [['value'], 'number'],
//            [['name'], 'string', 'max' => 254]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_cart_rule_id' => 'Order Cart Rule ID',
            'orders_id' => 'Orders ID',
            'cart_rule_id' => 'Cart Rule ID',
            'order_invoice_id' => 'Order Invoice ID',
            'name' => 'Name',
            'value' => 'Value',
            'free_shipping' => 'Free Shipping',
        ];
    }
}
