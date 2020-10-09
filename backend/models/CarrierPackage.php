<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "carrier_package".
 *
 * @property integer $carrier_package_id
 * @property string $carrier_package_name
 * @property integer $active
 */
class CarrierPackage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carrier_package';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['carrier_package_name'], 'required'],
            [['active'], 'integer'],
            [['carrier_package_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'carrier_package_id' => 'Carrier Package ID',
            'carrier_package_name' => 'Carrier Package Name',
            'active' => 'Active',
        ];
    }
    
    public function getCarrierPackageDetail()
    {
        return $this->hasOne(CarrierPackageDetail::className(), ['carrier_package_id' => 'carrier_package_id']);
    }
}
