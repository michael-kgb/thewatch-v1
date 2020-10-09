<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brands_feature_value".
 *
 * @property integer $brands_feature_value_id
 * @property integer $brands_brand_id
 * @property integer $feature_value_id
 */
class BrandsFeatureValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brands_feature_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['brands_brand_id', 'feature_value_id'], 'required'],
//            [['brands_brand_id', 'feature_value_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'brands_feature_value_id' => 'Brands Feature Value ID',
            'brands_brand_id' => 'Brands Brand ID',
            'feature_value_id' => 'Feature Value ID',
        ];
    }
}
