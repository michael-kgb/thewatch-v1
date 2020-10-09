<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_image".
 *
 * @property string $product_id
 * @property string $product_image_id
 * @property integer $cover
 */
class ProductImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id', 'product_image_id', 'cover'], 'integer'],
//            [['product_id', 'cover'], 'unique', 'targetAttribute' => ['product_id', 'cover'], 'message' => 'The combination of Product ID and Cover has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'product_image_id' => 'Product Image ID',
            'cover' => 'Cover',
        ];
    }
    
    public function getProduct(){
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }
    
    public function getProductRelated(){
        return $this->hasOne(ProductRelated::className(), ['product_id' => 'product_id']);
    }
}
