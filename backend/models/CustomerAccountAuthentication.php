<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customer_account_authentication".
 *
 * @property integer $customer_account_authentication_id
 * @property string $customer_account_authentication_provider
 * @property integer $customer_account_authentication_oauth_uid
 * @property string $email
 * @property string $birthday
 * @property string $first_name
 * @property string $last_name
 * @property string $phone_number
 * @property integer $age
 * @property string $gender
 */
class CustomerAccountAuthentication extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_account_authentication';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['customer_account_authentication_provider', 'customer_account_authentication_oauth_uid', 'email', 'birthday', 'first_name', 'last_name', 'phone_number', 'age', 'gender'], 'required'],
//            [['customer_account_authentication_provider', 'birthday', 'phone_number'], 'string'],
//            [['customer_account_authentication_oauth_uid', 'age'], 'integer'],
//            [['email', 'first_name', 'last_name'], 'string', 'max' => 50],
//            [['gender'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_account_authentication_id' => 'Customer Account Authentication ID',
            'customer_account_authentication_provider' => 'Customer Account Authentication Provider',
            'customer_account_authentication_oauth_uid' => 'Customer Account Authentication Oauth Uid',
            'email' => 'Email',
            'birthday' => 'Birthday',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'phone_number' => 'Phone Number',
            'age' => 'Age',
            'gender' => 'Gender',
        ];
    }
}
