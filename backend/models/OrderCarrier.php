<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_carrier".
 *
 * @property integer $order_carrier_id
 * @property string $orders_id
 * @property string $carrier_id
 * @property string $order_invoice_id
 * @property string $weight
 * @property string $tracking_number
 * @property string $date_add
 */
class OrderCarrier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_carrier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orders_id', 'carrier_id', 'date_add'], 'required'],
            [['orders_id', 'carrier_id', 'order_invoice_id'], 'integer'],
            [['weight'], 'number'],
            [['date_add'], 'safe'],
            [['tracking_number'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_carrier_id' => 'Order Carrier ID',
            'orders_id' => 'Orders ID',
            'carrier_id' => 'Carrier ID',
            'order_invoice_id' => 'Order Invoice ID',
            'weight' => 'Weight',
            'tracking_number' => 'Tracking Number',
            'date_add' => 'Date Add',
        ];
    }
}
