<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kredivo_notify".
 *
 * @property integer $kredivo_notify_id
 * @property string $kredivo_status
 * @property string $kredivo_message
 * @property string $kredivo_payment_type
 * @property string $kredivo_transaction_status
 * @property string $kredivo_transaction_time
 * @property string $kredivo_order_id
 * @property integer $kredivo_amount
 * @property string $kredivo_signature_key
 */
class KredivoNotify extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kredivo_notify';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['kredivo_status', 'kredivo_message', 'kredivo_payment_type', 'kredivo_transaction_status', 'kredivo_transaction_time', 'kredivo_order_id', 'kredivo_amount', 'kredivo_signature_key'], 'required'],
            //[['kredivo_message', 'kredivo_signature_key'], 'string'],
            //[['kredivo_amount'], 'integer'],
            //[['kredivo_status', 'kredivo_payment_type'], 'string', 'max' => 10],
            //[['kredivo_transaction_status', 'kredivo_transaction_time', 'kredivo_order_id'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kredivo_notify_id' => 'Kredivo Notify ID',
            'kredivo_status' => 'Kredivo Status',
            'kredivo_message' => 'Kredivo Message',
            'kredivo_payment_type' => 'Kredivo Payment Type',
            'kredivo_transaction_status' => 'Kredivo Transaction Status',
            'kredivo_transaction_time' => 'Kredivo Transaction Time',
            'kredivo_order_id' => 'Kredivo Order ID',
            'kredivo_amount' => 'Kredivo Amount',
            'kredivo_signature_key' => 'Kredivo Signature Key',
        ];
    }
}
