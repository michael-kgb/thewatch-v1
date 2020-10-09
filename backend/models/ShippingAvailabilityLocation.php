<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shipping_availability_location".
 *
 * @property integer $shipping_availability_location_id
 * @property string $shipping_availability_location_name
 * @property string $shipping_availability_location_status_description
 * @property integer $shipping_availability_location_status
 */
class ShippingAvailabilityLocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipping_availability_location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shipping_availability_location_name', 'shipping_availability_location_status_description'], 'required'],
            [['shipping_availability_location_status_description'], 'string'],
            [['shipping_availability_location_status'], 'integer'],
            [['shipping_availability_location_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'shipping_availability_location_id' => 'Shipping Availability Location ID',
            'shipping_availability_location_name' => 'Shipping Availability Location Name',
            'shipping_availability_location_status_description' => 'Shipping Availability Location Status Description',
            'shipping_availability_location_status' => 'Shipping Availability Location Status',
        ];
    }
}
