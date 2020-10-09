<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_attribute".
 *
 * @property string $product_attribute_id
 * @property string $product_id
 */
class ProductAttribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_attribute';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id'], 'integer'],
            //[['product_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_attribute_id' => 'Product Attribute ID',
            'product_id' => 'Product ID',
        ];
    }
    
    public function getProductAttributeCombination()
    {
        return $this->hasOne(ProductAttributeCombination::className(), ['product_attribute_id' => 'product_attribute_id']);
    }
	
	public function getProductStock()
    {
        return $this->hasOne(ProductStock::className(), ['product_attribute_id' => 'product_attribute_id']);
    }
}
