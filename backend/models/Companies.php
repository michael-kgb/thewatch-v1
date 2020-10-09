<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "companies".
 *
 * @property integer $company_id
 * @property string $company_name
 * @property string $company_email
 * @property string $company_address
 * @property string $company_about
 * @property string $company_profile
 * @property string $company_phone
 * @property string $company_logo
 * @property string $company_created_date
 * @property string $company_status
 */
class Companies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_name', 'company_email', 'company_address', 'company_about', 'company_profile', 'company_phone', 'company_logo', 'company_status'], 'required'],
            [['company_address', 'company_about', 'company_profile', 'company_logo', 'company_status'], 'string'],
            [['company_created_date'], 'safe'],
            [['company_name', 'company_email'], 'string', 'max' => 50],
            [['company_phone'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'company_id' => 'Company ID',
            'company_name' => 'Company Name',
            'company_email' => 'Company Email',
            'company_address' => 'Company Address',
            'company_about' => 'Company About',
            'company_profile' => 'Company Profile',
            'company_phone' => 'Company Phone',
            'company_logo' => 'Company Logo',
            'company_created_date' => 'Company Created Date',
            'company_status' => 'Company Status',
        ];
    }
}
