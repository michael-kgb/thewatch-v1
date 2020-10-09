<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "carrier_package_detail".
 *
 * @property integer $carrier_package_detail_id
 * @property integer $carrier_id
 * @property integer $carrier_package_id
 */
class CarrierPackageDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carrier_package_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['carrier_id', 'carrier_package_id'], 'required'],
            [['carrier_id', 'carrier_package_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'carrier_package_detail_id' => 'Carrier Package Detail ID',
            'carrier_id' => 'Carrier ID',
            'carrier_package_id' => 'Carrier Package ID',
        ];
    }
    
    public function getCarrierPackage()
    {
        return $this->hasOne(CarrierPackage::className(), ['carrier_package_id' => 'carrier_package_id']);
    }
    
    public function getCarrierCost()
    {
        return $this->hasOne(CarrierCost::className(), ['carrier_package_detail_id' => 'carrier_package_detail_id']);
    }
    
    public function getCarrier()
    {
        return $this->hasOne(Carrier::className(), ['carrier_id' => 'carrier_id']);
    }
}
