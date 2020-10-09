<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brands_featured_jewelry".
 *
 * @property integer $brands_featured_jewelry_id
 * @property integer $brands_brand_id
 * @property string $brand_featured_jewelry_1
 * @property string $brand_featured_jewelry_2
 */
class BrandsFeaturedJewelry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brands_featured_jewelry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brands_brand_id', 'brand_featured_jewelry_1', 'brand_featured_jewelry_2'], 'required'],
            [['brands_brand_id'], 'integer'],
            [['brand_featured_jewelry_1', 'brand_featured_jewelry_2'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'brands_featured_jewelry_id' => 'Brands Featured Jewelry ID',
            'brands_brand_id' => 'Brands Brand ID',
            'brand_featured_jewelry_1' => 'Brand Featured Jewelry 1',
            'brand_featured_jewelry_2' => 'Brand Featured Jewelry 2',
        ];
    }
}
