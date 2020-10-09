<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_related".
 *
 * @property integer $product_related_id
 * @property integer $product_id
 * @property integer $product_parent_id
 */
class ProductRelated extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_related';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'product_parent_id'], 'required'],
            [['product_id', 'product_parent_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_related_id' => 'Product Related ID',
            'product_id' => 'Product ID',
            'product_parent_id' => 'Product Parent ID',
        ];
    }
    
    public function getProduct(){
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }
    
    public function getProductDetail(){
        return $this->hasOne(ProductDetail::className(), ['product_id' => 'product_id']);
    }
    
    public function getProductImage(){
        return $this->hasOne(ProductImage::className(), ['product_id' => 'product_id']);
    }
}
