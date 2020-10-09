<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brands_collection".
 *
 * @property integer $brands_collection_id
 * @property integer $brands_brand_id
 * @property string $brands_collection_name
 * @property integer $brands_collection_status
 */
class BrandsCollection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brands_collection';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brands_brand_id', 'brands_collection_name'], 'required'],
            [['brands_brand_id', 'brands_collection_status'], 'integer'],
            [['brands_collection_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'brands_collection_id' => 'Brands Collection ID',
            'brands_brand_id' => 'Brands Brand ID',
            'brands_collection_name' => 'Brands Collection Name',
            'brands_collection_status' => 'Brands Collection Status',
        ];
    }
    
    public function getBrands()
    {
        return $this->hasOne(Brands::className(), ['brands_brand_id' => 'brands_brand_id']);
    }
    
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['brands_collection_id' => 'brands_collection_id']);
    }
}
