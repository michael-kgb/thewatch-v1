<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customer_address".
 *
 * @property string $customer_address_id
 * @property string $country_id
 * @property integer $province_id
 * @property string $state_id
 * @property integer $district_id
 * @property string $customer_id
 * @property string $alias
 * @property string $company
 * @property string $lastname
 * @property string $firstname
 * @property string $address1
 * @property string $address2
 * @property string $postcode
 * @property string $other
 * @property string $phone
 * @property string $phone_mobile
 * @property string $date_add
 * @property string $date_upd
 * @property integer $active
 * @property integer $deleted
 */
class CustomerAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['country_id', 'province_id', 'district_id', 'lastname', 'firstname', 'address1', 'date_add', 'date_upd'], 'required'],
            [['country_id', 'province_id', 'state_id', 'district_id', 'customer_id', 'active', 'deleted'], 'integer'],
            [['other'], 'string'],
            [['date_add', 'date_upd'], 'safe'],
            [['alias', 'lastname', 'firstname', 'phone', 'phone_mobile'], 'string', 'max' => 32],
            [['company'], 'string', 'max' => 64],
            [['address1', 'address2'], 'string'],
            [['postcode'], 'string', 'max' => 12]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_address_id' => 'Customer Address ID',
            'country_id' => 'Country ID',
            'province_id' => 'Province ID',
            'state_id' => 'State ID',
            'district_id' => 'District ID',
            'customer_id' => 'Customer ID',
            'alias' => 'Alias',
            'company' => 'Company',
            'lastname' => 'Lastname',
            'firstname' => 'Firstname',
            'address1' => 'Address1',
            'address2' => 'Address2',
            'postcode' => 'Postcode',
            'other' => 'Other',
            'phone' => 'Phone',
            'phone_mobile' => 'Phone Mobile',
            'date_add' => 'Date Add',
            'date_upd' => 'Date Upd',
            'active' => 'Active',
            'deleted' => 'Deleted',
        ];
    }
    
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['country_id' => 'country_id']);
    }
    
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['province_id' => 'province_id']);
    }
    
    public function getState()
    {
        return $this->hasOne(State::className(), ['state_id' => 'state_id']);
    }
    
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['district_id' => 'district_id']);
    }
}
