<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "carrier_cost_flat_price".
 *
 * @property integer $carrier_cost_flat_price_id
 * @property integer $province_id
 * @property integer $carrier_package_id
 * @property string $price
 * @property integer $active
 */
class CarrierCostFlatPrice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carrier_cost_flat_price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['province_id', 'carrier_package_id', 'price', 'active'], 'required'],
//            [['province_id', 'carrier_package_id', 'active'], 'integer'],
//            [['price'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'carrier_cost_flat_price_id' => 'Carrier Cost Flat Price ID',
            'province_id' => 'Province ID',
            'carrier_package_id' => 'Carrier Package ID',
            'price' => 'Price',
            'active' => 'Active',
        ];
    }
}
