<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_confirmation".
 *
 * @property integer $order_confirmation_id
 * @property integer $orders_id
 * @property string $account_name
 * @property string $account_number
 * @property string $bank_anda
 * @property integer $amount
 * @property string $transfer_to
 * @property string $transfer_method
 * @property string $comments
 * @property string $date_add
 */
class OrderConfirmation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_confirmation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['orders_id', 'account_name', 'account_number', 'amount', 'transfer_to', 'transfer_method', 'comments', 'date_add'], 'required'],
            //[['orders_id', 'amount'], 'integer'],
            //[['comments'], 'string'],
            //[['date_add'], 'safe'],
            //[['account_name', 'account_number', 'transfer_to', 'transfer_method'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_confirmation_id' => 'Order Confirmation ID',
            'orders_id' => 'Orders ID',
            'account_name' => 'Account Name',
            'account_number' => 'Account Number',
			'bank_anda' => 'Bank Anda',
            'amount' => 'Amount',
            'transfer_to' => 'Transfer To',
            'transfer_method' => 'Transfer Method',
            'comments' => 'Comments',
            'date_add' => 'Date Add',
        ];
    }
}
