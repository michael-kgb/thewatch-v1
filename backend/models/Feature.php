<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "feature".
 *
 * @property integer $feature_id
 * @property string $feature_name
 */
class Feature extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['feature_name'], 'required'],
            [['feature_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'feature_id' => 'Feature ID',
            'feature_name' => 'Feature Name',
        ];
    }
    
    public function getProductFeature()
    {
        return $this->hasOne(ProductFeature::className(), ['feature_id' => 'feature_id']);
    }
    
    public function getProductFeatureValue()
    {
        return $this->hasOne(ProductFeatureValue::className(), ['feature_id' => 'feature_id']);
    }
}
