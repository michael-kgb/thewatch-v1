<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_delivery_slip".
 *
 * @property string $order_slip_id
 * @property string $customer_id
 * @property string $orders_id
 * @property string $shipping_cost_amount
 * @property integer $user_sender_id
 * @property integer $partial
 * @property string $date_add
 * @property string $date_upd
 */
class OrderDeliverySlip extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_delivery_slip';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['customer_id', 'orders_id', 'shipping_cost_amount', 'user_sender_id', 'partial', 'date_add', 'date_upd'], 'required'],
            //[['customer_id', 'orders_id', 'user_sender_id', 'partial'], 'integer'],
            //[['shipping_cost_amount'], 'number'],
            //[['date_add', 'date_upd'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_slip_id' => 'Order Slip ID',
            'customer_id' => 'Customer ID',
            'orders_id' => 'Orders ID',
            'shipping_cost_amount' => 'Shipping Cost Amount',
            'user_sender_id' => 'User Sender ID',
            'partial' => 'Partial',
            'date_add' => 'Date Add',
            'date_upd' => 'Date Upd',
        ];
    }
}
