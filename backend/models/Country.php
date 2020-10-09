<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property string $country_id
 * @property string $zone_id
 * @property string $currency_id
 * @property string $iso_code
 * @property integer $call_prefix
 * @property integer $active
 * @property integer $contains_provinces
 * @property integer $contains_states
 * @property integer $contains_districts
 * @property integer $need_identification_number
 * @property integer $need_zip_code
 * @property string $zip_code_format
 * @property integer $display_tax_label
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zone_id', 'iso_code', 'display_tax_label'], 'required'],
            [['zone_id', 'currency_id', 'call_prefix', 'active', 'contains_provinces', 'contains_states', 'contains_districts', 'need_identification_number', 'need_zip_code', 'display_tax_label'], 'integer'],
            [['iso_code'], 'string', 'max' => 3],
            [['zip_code_format'], 'string', 'max' => 12]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'country_id' => 'Country ID',
            'zone_id' => 'Zone ID',
            'currency_id' => 'Currency ID',
            'iso_code' => 'Iso Code',
            'call_prefix' => 'Call Prefix',
            'active' => 'Active',
            'contains_provinces' => 'Contains Provinces',
            'contains_states' => 'Contains States',
            'contains_districts' => 'Contains Districts',
            'need_identification_number' => 'Need Identification Number',
            'need_zip_code' => 'Need Zip Code',
            'zip_code_format' => 'Zip Code Format',
            'display_tax_label' => 'Display Tax Label',
        ];
    }
    
    public function getZone(){
        return $this->hasOne(Zone::className(), ['id_zone' => 'zone_id']);
    }
}
