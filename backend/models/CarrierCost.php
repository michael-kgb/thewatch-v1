<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "carrier_cost".
 *
 * @property integer $carrier_cost_id
 * @property integer $district_id
 * @property integer $carrier_id
 * @property string $price
 * @property string $day
 * @property integer $carrier_package_detail_id
 * @property string $date_created
 * @property string $date_modified
 * @property integer $active
 */
class CarrierCost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carrier_cost';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['district_id', 'carrier_id', 'price', 'day', 'carrier_package_detail_id'], 'required'],
            [['district_id', 'carrier_id', 'carrier_package_detail_id', 'active'], 'integer'],
            [['date_created', 'date_modified'], 'safe'],
            [['price'], 'string', 'max' => 20],
            [['day'], 'string', 'max' => 12],
            [['district_id', 'carrier_id', 'carrier_package_detail_id'], 'unique', 'targetAttribute' => ['district_id', 'carrier_id', 'carrier_package_detail_id'], 'message' => 'The combination of District ID, Carrier ID and Carrier Package Detail ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'carrier_cost_id' => 'Carrier Cost ID',
            'district_id' => 'District ID',
            'carrier_id' => 'Carrier ID',
            'price' => 'Price',
            'day' => 'Day',
            'carrier_package_detail_id' => 'Carrier Package Detail ID',
            'date_created' => 'Date Created',
            'date_modified' => 'Date Modified',
            'active' => 'Active',
        ];
    }
    
    public function getCarrier()
    {
        return $this->hasOne(Carrier::className(), ['carrier_id' => 'carrier_id']);
    }
    
    public function getCarrierPackageDetail()
    {
        return $this->hasOne(CarrierPackageDetail::className(), ['carrier_package_detail_id' => 'carrier_package_detail_id']);
    }
    
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['district_id' => 'district_id']);
    }
}
