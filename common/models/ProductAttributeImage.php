<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_attribute_image".
 *
 * @property string $id_product_attribute
 * @property integer $product_image_id
 */
class ProductAttributeImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_attribute_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_product_attribute', 'product_image_id'], 'required'],
            [['id_product_attribute', 'product_image_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_product_attribute' => 'Id Product Attribute',
            'product_image_id' => 'Product Image ID',
        ];
    }
    
    public function getProductAttributeCombination()
    {
        return $this->hasOne(ProductAttributeCombination::className(), ['product_attribute_id' => 'id_product_attribute']);
    }
}
