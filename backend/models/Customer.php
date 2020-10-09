<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property string $customer_id
 * @property string $gender_id
 * @property string $customer_group_id
 * @property string $apps_language_id
 * @property string $company_id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $passwd
 * @property string $last_passwd_gen
 * @property string $birthday
 * @property integer $newsletter
 * @property string $ip_registration_newsletter
 * @property string $newsletter_date_add
 * @property string $website
 * @property string $max_payment_days
 * @property string $secure_key
 * @property string $note
 * @property integer $active
 * @property integer $is_guest
 * @property integer $deleted
 * @property string $date_add
 * @property string $date_upd
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['gender_id', 'firstname', 'lastname', 'email', 'passwd', 'date_add', 'date_upd'], 'required'],
//            [['gender_id', 'customer_group_id', 'apps_language_id', 'newsletter', 'max_payment_days', 'active', 'is_guest', 'deleted'], 'integer'],
//            [['last_passwd_gen', 'birthday', 'newsletter_date_add', 'date_add', 'date_upd'], 'safe'],
//            [['note'], 'string'],
//            [['company_id'], 'string', 'max' => 64],
//            [['firstname', 'lastname', 'passwd', 'secure_key'], 'string', 'max' => 32],
//            [['email', 'website'], 'string', 'max' => 128],
//            [['ip_registration_newsletter'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'gender_id' => 'Gender ID',
            'customer_group_id' => 'Customer Group ID',
            'apps_language_id' => 'Apps Language ID',
            'company_id' => 'Company ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'passwd' => 'Passwd',
            'last_passwd_gen' => 'Last Passwd Gen',
            'birthday' => 'Birthday',
            'newsletter' => 'Newsletter',
            'ip_registration_newsletter' => 'Ip Registration Newsletter',
            'newsletter_date_add' => 'Newsletter Date Add',
            'website' => 'Website',
            'max_payment_days' => 'Max Payment Days',
            'secure_key' => 'Secure Key',
            'note' => 'Note',
            'active' => 'Active',
            'is_guest' => 'Is Guest',
            'deleted' => 'Deleted',
            'date_add' => 'Date Add',
            'date_upd' => 'Date Upd',
        ];
    }
    
    public function getGender()
    {
        return $this->hasOne(Gender::className(), ['gender_id' => 'gender_id']);
    }
    
    public function getCustomerGroup()
    {
        return $this->hasOne(CustomerGroup::className(), ['customer_group_id' => 'customer_group_id']);
    }
	
	public function getCustomerAddress()
    {
        return $this->hasOne(CustomerAddress::className(), ['customer_id' => 'customer_id']);
    }
}
