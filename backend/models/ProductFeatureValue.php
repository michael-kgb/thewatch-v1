<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_feature_value".
 *
 * @property integer $feature_value_id
 * @property integer $feature_id
 * @property string $feature_value_name
 * @property string $feature_value_value
 */
class ProductFeatureValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_feature_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['feature_id', 'feature_value_name', 'feature_value_value'], 'required'],
            [['feature_id'], 'integer'],
            [['feature_value_name', 'feature_value_value'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'feature_value_id' => 'Feature Value ID',
            'feature_id' => 'Feature ID',
            'feature_value_name' => 'Feature Value Name',
            'feature_value_value' => 'Feature Value Value',
        ];
    }
    
    public function getFeature(){
        return $this->hasOne(Feature::className(), ['feature_id' => 'feature_id']);
    }
}
