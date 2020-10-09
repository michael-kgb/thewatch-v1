<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "va_log".
 *
 * @property integer $va_id
 * @property string $va_bank
 * @property integer $va_number
 * @property string $transaction_time
 * @property string $transaction_status
 * @property string $payment_type
 * @property string $order_id
 * @property integer $gross_amount
 * @property string $payment_amounts_paid_at
 * @property integer $payment_amounts_amount
 */
class VaLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'va_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['va_bank', 'va_number', 'transaction_time', 'transaction_status', 'payment_type', 'order_id', 'gross_amount', 'payment_amounts_paid_at', 'payment_amounts_amount'], 'required'],
            //[['va_number', 'gross_amount', 'payment_amounts_amount'], 'integer'],
            //[['transaction_time', 'payment_amounts_paid_at'], 'safe'],
            //[['va_bank', 'transaction_status', 'payment_type'], 'string', 'max' => 25],
            //[['order_id'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'va_id' => 'Va ID',
            'va_bank' => 'Va Bank',
            'va_number' => 'Va Number',
            'transaction_time' => 'Transaction Time',
            'transaction_status' => 'Transaction Status',
            'payment_type' => 'Payment Type',
            'order_id' => 'Order ID',
            'gross_amount' => 'Gross Amount',
            'payment_amounts_paid_at' => 'Payment Amounts Paid At',
            'payment_amounts_amount' => 'Payment Amounts Amount',
        ];
    }
}
