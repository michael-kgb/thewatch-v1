<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cart_rule_product_rule_group".
 *
 * @property integer $cart_rule_product_rule_group_id
 * @property integer $cart_rule_id
 * @property integer $quantity
 */
class CartRuleProductRuleGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart_rule_product_rule_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cart_rule_id', 'quantity'], 'required'],
            [['cart_rule_id', 'quantity'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cart_rule_product_rule_group_id' => 'Cart Rule Product Rule Group ID',
            'cart_rule_id' => 'Cart Rule ID',
            'quantity' => 'Quantity',
        ];
    }
}
