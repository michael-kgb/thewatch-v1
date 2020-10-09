<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cart_rule_product_rule".
 *
 * @property integer $cart_rule_product_rule_id
 * @property integer $cart_rule_product_rule_group
 * @property string $type
 */
class CartRuleProductRule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart_rule_product_rule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cart_rule_product_rule_group', 'type'], 'required'],
            [['cart_rule_product_rule_group'], 'integer'],
            [['type'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cart_rule_product_rule_id' => 'Cart Rule Product Rule ID',
            'cart_rule_product_rule_group' => 'Cart Rule Product Rule Group',
            'type' => 'Type',
        ];
    }
}
