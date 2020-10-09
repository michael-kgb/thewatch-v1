<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_event".
 *
 * @property integer $order_event_id
 * @property string $order_event_name
 * @property string $order_event_gender
 * @property integer $order_event_phone
 * @property string $order_event_birth
 * @property string $order_event_email
 * @property integer $order_event_product_id
 * @property integer $order_event_product_attribute_id
 * @property string $order_event_product_name
 * @property string $order_event_product_attribute
 * @property integer $order_event_quantity
 * @property integer $order_event_price
 * @property integer $order_event_original_price
 * @property string $order_event_create_date
 * @property string $order_event_address
 */
class OrderEvent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['order_event_name', 'order_event_gender', 'order_event_phone', 'order_event_birth', 'order_event_email', 'order_event_product_id', 'order_event_quantity', 'order_event_price', 'order_event_original_price', 'order_event_create_date', 'order_event_address'], 'required'],
            // [['order_event_phone', 'order_event_product_id', 'order_event_product_attribute_id', 'order_event_quantity', 'order_event_price', 'order_event_original_price'], 'integer'],
            // [['order_event_birth', 'order_event_create_date'], 'safe'],
            // [['order_event_address'], 'string'],
            // [['order_event_name', 'order_event_email', 'order_event_product_name', 'order_event_product_attribute'], 'string', 'max' => 100],
            // [['order_event_gender'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_event_id' => 'Order Event ID',
            'order_event_name' => 'Order Event Name',
            'order_event_gender' => 'Order Event Gender',
            'order_event_phone' => 'Order Event Phone',
            'order_event_birth' => 'Order Event Birth',
            'order_event_email' => 'Order Event Email',
            'order_event_product_id' => 'Order Event Product ID',
            'order_event_product_attribute_id' => 'Order Event Product Attribute ID',
            'order_event_product_name' => 'Order Event Product Name',
            'order_event_product_attribute' => 'Order Event Product Attribute',
            'order_event_quantity' => 'Order Event Quantity',
            'order_event_price' => 'Order Event Price',
            'order_event_original_price' => 'Order Event Original Price',
            'order_event_create_date' => 'Order Event Create Date',
            'order_event_address' => 'Order Event Address',
        ];
    }
}
