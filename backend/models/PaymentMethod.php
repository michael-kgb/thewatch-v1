<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "payment_method".
 *
 * @property integer $payment_method_id
 * @property string $payment_method_name
 * @property string $payment_method_alias
 * @property integer $currency_id
 * @property integer $active
 */
class PaymentMethod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_method';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_method_name', 'payment_method_alias', 'currency_id'], 'required'],
            [['currency_id', 'active'], 'integer'],
            [['payment_method_name'], 'string', 'max' => 50],
            [['payment_method_alias'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'payment_method_id' => 'Payment Method ID',
            'payment_method_name' => 'Payment Method Name',
            'payment_method_alias' => 'Payment Method Alias',
            'currency_id' => 'Currency ID',
            'active' => 'Active',
        ];
    }
}
