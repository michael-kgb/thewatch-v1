<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_bestseller".
 *
 * @property integer $product_pre_order_id
 * @property integer $product_id
 * @property string $product_pre_order_start_date
 * @property string $product_pre_order_end_date
 */
class ProductPreOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_pre_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['product_id', 'product_pre_order_start_date', 'product_pre_order_end_date'], 'required'],
//            [['product_id'], 'integer'],
//            [['product_pre_order_start_date', 'product_pre_order_end_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_pre_order_id' => 'Product PreOrder ID',
            'product_id' => 'Product ID',
            'product_pre_order_start_date' => 'Product PreOrder Start Date',
            'product_pre_order_end_date' => 'Product PreOrder End Date',
        ];
    }
    
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }
}
