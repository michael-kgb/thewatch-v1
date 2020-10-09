<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "service_confirmation".
 *
 * @property integer $service_confirmation_id
 * @property integer $service_id
 * @property string $account_name
 * @property string $account_number
 * @property string $bank_account
 * @property integer $amount
 * @property string $transfer_to
 * @property string $transfer_method
 * @property string $comments
 * @property string $date_add
 */
class ServiceConfirmation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_confirmation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['service_id', 'account_name', 'account_number', 'bank_account', 'amount', 'transfer_to', 'transfer_method', 'comments', 'date_add'], 'required'],
            //[['service_id', 'amount'], 'integer'],
            //[['comments'], 'string'],
            //[['date_add'], 'safe'],
            //[['account_name', 'account_number', 'bank_account', 'transfer_to', 'transfer_method'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_confirmation_id' => 'Service Confirmation ID',
            'service_id' => 'Service ID',
            'account_name' => 'Account Name',
            'account_number' => 'Account Number',
            'bank_account' => 'Bank Account',
            'amount' => 'Amount',
            'transfer_to' => 'Transfer To',
            'transfer_method' => 'Transfer Method',
            'comments' => 'Comments',
            'date_add' => 'Date Add',
        ];
    }
}
