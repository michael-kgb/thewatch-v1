<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "payment_method_installment".
 *
 * @property integer $payment_method_installment_id
 * @property string $payment_method_installment_name
 * @property string $payment_method_installment_alias
 * @property string $payment_method_installment_code
 */
class PaymentMethodInstallment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_method_installment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_method_installment_name', 'payment_method_installment_alias', 'payment_method_installment_code'], 'required'],
            [['payment_method_installment_name'], 'string', 'max' => 50],
            [['payment_method_installment_alias', 'payment_method_installment_code'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'payment_method_installment_id' => 'Payment Method Installment ID',
            'payment_method_installment_name' => 'Payment Method Installment Name',
            'payment_method_installment_alias' => 'Payment Method Installment Alias',
            'payment_method_installment_code' => 'Payment Method Installment Code',
        ];
    }
}
