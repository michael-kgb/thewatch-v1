<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "instagram_detail".
 *
 * @property integer $instagram_detail_id
 * @property integer $instagram_id
 * @property integer $product_id
 */
class InstagramDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'instagram_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['instagram_id', 'product_id'], 'required'],
            [['instagram_id', 'product_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'instagram_detail_id' => 'Instagram Detail ID',
            'instagram_id' => 'Instagram ID',
            'product_id' => 'Product ID',
        ];
    }
    
    public function getProductDetail(){
        return $this->hasOne(ProductDetail::className(), ['product_id' => 'product_id']);
    }
    
    public function getProduct(){
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }
    
    public function getProductImage(){
        return $this->hasOne(ProductImage::className(), ['product_id' => 'product_id']);
    }
    
}
