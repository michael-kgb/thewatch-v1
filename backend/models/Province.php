<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "province".
 *
 * @property string $province_id
 * @property string $country_id
 * @property string $zone_id
 * @property string $name
 * @property integer $active
 */
class Province extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'zone_id', 'name'], 'required'],
            [['country_id', 'zone_id', 'active'], 'integer'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'province_id' => 'Province ID',
            'country_id' => 'Country ID',
            'zone_id' => 'Zone ID',
            'name' => 'Name',
            'active' => 'Active',
        ];
    }
    
    public function getCountry(){
        return $this->hasOne(Country::className(), ['country_id' => 'country_id']);
    }
}
