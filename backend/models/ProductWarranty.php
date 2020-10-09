<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_warranty".
 *
 * @property integer $product_warranty_id
 * @property integer $product_id
 * @property integer $warranty_id
 */
class ProductWarranty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_warranty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['product_id', 'warranty_id'], 'required'],
//            [['product_id', 'warranty_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_warranty_id' => 'Product Warranty ID',
            'product_id' => 'Product ID',
            'warranty_type_id' => 'Warranty ID',
        ];
    }
    
    public function getProduct(){
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }
    
    public function getWarrantyType(){
        return $this->hasOne(WarrantyType::className(), ['warranty_type_id' => 'warranty_type_id']);
    }
}
