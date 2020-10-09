<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_tag".
 *
 * @property integer $product_id
 * @property integer $tag_id
 * @property integer $apps_language_id
 */
class ProductTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'tag_id', 'apps_language_id'], 'required'],
            [['product_id', 'tag_id', 'apps_language_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'tag_id' => 'Tag ID',
            'apps_language_id' => 'Apps Language ID',
        ];
    }
    
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }
    
    public function getTags()
    {
        return $this->hasOne(Tags::className(), ['tag_id' => 'tag_id']);
    }
}
