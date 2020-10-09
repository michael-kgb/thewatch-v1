<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cart_rule_flash_sale_periode".
 *
 * @property integer $cart_rule_flash_sale_periode_id
 * @property integer $cart_rule_id
 * @property string $date_from
 * @property string $date_to
 */
class CartRuleFlashSalePeriode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart_rule_flash_sale_periode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['cart_rule_id', 'date_from', 'date_to'], 'required'],
//            [['cart_rule_id'], 'integer'],
//            [['date_from', 'date_to'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cart_rule_flash_sale_periode_id' => 'Cart Rule Flash Sale Periode ID',
            'cart_rule_id' => 'Cart Rule ID',
            'date_from' => 'Date From',
            'date_to' => 'Date To',
        ];
    }
}
