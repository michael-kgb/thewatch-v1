<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "payment_method_detail".
 *
 * @property integer $payment_method_detail_id
 * @property integer $payment_method_id
 * @property integer $payment_id
 */
class PaymentMethodDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_method_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_method_id', 'payment_id'], 'required'],
            [['payment_method_id', 'payment_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'payment_method_detail_id' => 'Payment Method Detail ID',
            'payment_method_id' => 'Payment Method ID',
            'payment_id' => 'Payment ID',
        ];
    }
    
    public function getPayment()
    {
        return $this->hasOne(Payment::className(), ['payment_id' => 'payment_id']);
    }
    
    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethod::className(), ['payment_method_id' => 'payment_method_id']);
    }
}
