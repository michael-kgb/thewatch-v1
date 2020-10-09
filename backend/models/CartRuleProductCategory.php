<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cart_rule_product_category".
 *
 * @property integer $cart_rule_product_category_id
 * @property integer $product_category_id
 */
class CartRuleProductCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart_rule_product_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_category_id'], 'required'],
            [['product_category_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cart_rule_product_category_id' => 'Cart Rule Product Category ID',
            'product_category_id' => 'Product Category ID',
        ];
    }
	
	public function getProductCategory() {
        return $this->hasOne(ProductCategory::className(), ['product_category_id' => 'product_category_id']);
    }
}
