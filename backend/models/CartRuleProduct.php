<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cart_rule_brand".
 *
 * @property integer $cart_rule_brand_id
 * @property integer $cart_rule_id
 * @property integer $brand_id
 */
class CartRuleProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart_rule_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['cart_rule_product_id', 'product_id'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cart_rule_brand_id' => 'Cart Rule Product ID',
            'cart_rule_id' => 'Cart Rule ID',
            'product_id' => 'Product ID',
        ];
    }
}
