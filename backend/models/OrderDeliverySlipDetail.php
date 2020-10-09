<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_delivery_slip_detail".
 *
 * @property string $order_slip_id
 * @property string $order_detail_id
 * @property string $product_quantity
 */
class OrderDeliverySlipDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_delivery_slip_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['order_slip_id', 'order_detail_id'], 'required'],
            //[['order_slip_id', 'order_detail_id', 'product_quantity'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_slip_id' => 'Order Slip ID',
            'order_detail_id' => 'Order Detail ID',
            'product_quantity' => 'Product Quantity',
        ];
    }
}
