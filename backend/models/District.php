<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property string $district_id
 * @property string $country_id
 * @property string $zone_id
 * @property string $reference
 * @property string $name
 * @property integer $tax_behavior
 * @property integer $active
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'zone_id', 'reference', 'name'], 'required'],
            [['country_id', 'zone_id', 'tax_behavior', 'active'], 'integer'],
            [['reference'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'district_id' => 'District ID',
            'country_id' => 'Country ID',
            'zone_id' => 'Zone ID',
            'reference' => 'Reference',
            'name' => 'Name',
            'tax_behavior' => 'Tax Behavior',
            'active' => 'Active',
        ];
    }
    
    public function getCountry(){
        return $this->hasOne(Country::className(), ['country_id' => 'country_id']);
    }
    
    public function getState(){
        return $this->hasOne(State::className(), ['state_id' => 'state_id']);
    }
}
