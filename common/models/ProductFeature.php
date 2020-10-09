<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_feature".
 *
 * @property integer $feature_id
 * @property integer $product_id
 * @property integer $feature_value_id
 */
class ProductFeature extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_feature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['feature_id', 'product_id', 'feature_value_id'], 'required'],
            [['feature_id', 'product_id', 'feature_value_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'feature_id' => 'Feature ID',
            'product_id' => 'Product ID',
            'feature_value_id' => 'Feature Value ID',
        ];
    }
    
    public function getProductFeatureValue(){
        return $this->hasOne(ProductFeatureValue::className(), ['feature_value_id' => 'feature_value_id']);
    }
}
