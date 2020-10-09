<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "valentine_product".
 *
 * @property string $valentine_product_id
 * @property string $product_id
 */
class ValentineProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'valentine_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['gender_id', 'apps_language_id', 'name'], 'required'],
            //[['gender_id', 'apps_language_id'], 'integer'],
            //[['name'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'valentine_product_id' => 'Valentine Product ID',
            'product_id' => 'Product ID',
        ];
    }
    
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }
}
