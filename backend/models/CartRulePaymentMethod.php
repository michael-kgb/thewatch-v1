<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cart_rule_payment_method".
 *
 * @property integer $cart_rule_payment_method_id
 * @property integer $cart_rule_id
 * @property integer $payment_method_id
 */
class CartRulePaymentMethod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart_rule_payment_method';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['cart_rule_id', 'payment_method_id'], 'required'],
            //[['cart_rule_id', 'payment_method_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cart_rule_payment_method_id' => 'Cart Rule Payment Method ID',
            'cart_rule_id' => 'Cart Rule ID',
            'payment_method_id' => 'Payment Method ID',
        ];
    }
}
