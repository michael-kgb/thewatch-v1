<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "state".
 *
 * @property string $state_id
 * @property string $country_id
 * @property string $zone_id
 * @property string $reference
 * @property string $name
 * @property string $iso_code
 * @property integer $tax_behavior
 * @property integer $active
 */
class State extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'state';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'zone_id', 'reference', 'name', 'iso_code'], 'required'],
            [['country_id', 'zone_id', 'tax_behavior', 'active'], 'integer'],
            [['reference'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 64],
            [['iso_code'], 'string', 'max' => 7]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'state_id' => 'State ID',
            'country_id' => 'Country ID',
            'zone_id' => 'Zone ID',
            'reference' => 'Reference',
            'name' => 'Name',
            'iso_code' => 'Iso Code',
            'tax_behavior' => 'Tax Behavior',
            'active' => 'Active',
        ];
    }
    
    public function getProvince(){
        return $this->hasOne(Province::className(), ['province_id' => 'province_id']);
    }
    
    public function getCountry(){
        return $this->hasOne(Country::className(), ['country_id' => 'country_id']);
    }
}
