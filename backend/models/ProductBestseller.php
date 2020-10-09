<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_bestseller".
 *
 * @property integer $product_bestseller_id
 * @property integer $product_id
 * @property string $product_bestseller_start_date
 * @property string $product_bestseller_end_date
 */
class ProductBestseller extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_bestseller';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['product_id', 'product_bestseller_start_date', 'product_bestseller_end_date'], 'required'],
//            [['product_id'], 'integer'],
//            [['product_bestseller_start_date', 'product_bestseller_end_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_bestseller_id' => 'Product Bestseller ID',
            'product_id' => 'Product ID',
            'product_bestseller_start_date' => 'Product Bestseller Start Date',
            'product_bestseller_end_date' => 'Product Bestseller End Date',
            'product_bestseller_sequence' => 'Product Bestseller Sequence',
        ];
    }
    
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }
}
