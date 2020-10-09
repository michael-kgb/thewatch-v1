<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "corporate_order".
 *
 * @property integer $corporate_order_id
 * @property string $fullname
 * @property string $company_name
 * @property string $phone_number
 * @property string $email
 * @property string $message
 * @property string $created_at
 * @property string $update_at
 */
class CorporateOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'corporate_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['fullname', 'company_name', 'phone_number', 'email', 'message'], 'required'],
            //[['message'], 'string'],
            //[['created_at', 'update_at'], 'safe'],
            //[['fullname'], 'string', 'max' => 200],
            //[['company_name', 'email'], 'string', 'max' => 50],
            //[['phone_number'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'corporate_order_id' => 'Corporate Order ID',
            'fullname' => 'Fullname',
            'company_name' => 'Company Name',
            'phone_number' => 'Phone Number',
            'email' => 'Email',
            'message' => 'Message',
            'created_at' => 'Created At',
            'update_at' => 'Update At',
        ];
    }
}
