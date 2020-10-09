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
class CartRuleBrand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart_rule_brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cart_rule_id', 'brand_id'], 'required'],
            [['cart_rule_id', 'brand_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cart_rule_brand_id' => 'Cart Rule Brand ID',
            'cart_rule_id' => 'Cart Rule ID',
            'brand_id' => 'Brand ID',
        ];
    }
}
