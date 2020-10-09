<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "payment_method_installment_detail".
 *
 * @property integer $payment_method_installment_detail_id
 * @property integer $payment_id
 * @property integer $payment_method_installment_id
 */
class PaymentMethodInstallmentDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_method_installment_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_id', 'payment_method_installment_id'], 'required'],
            [['payment_id', 'payment_method_installment_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'payment_method_installment_detail_id' => 'Payment Method Installment Detail ID',
            'payment_id' => 'Payment ID',
            'payment_method_installment_id' => 'Payment Method Installment ID',
        ];
    }
    
    public function getPayment()
    {
        return $this->hasOne(Payment::className(), ['payment_id' => 'payment_id']);
    }
    
    public function getPaymentMethodInstallment()
    {
        return $this->hasOne(PaymentMethodInstallment::className(), ['payment_method_installment_id' => 'payment_method_installment_id']);
    }
    
}
