<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "stores_brands".
 *
 * @property integer $stores_brands_id
 * @property integer $stores_store_id
 * @property integer $brands_brand_id
 */
class StoresBrands extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stores_brands';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stores_store_id', 'brands_brand_id'], 'required'],
            [['stores_store_id', 'brands_brand_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'stores_brands_id' => 'Stores Brands ID',
            'stores_store_id' => 'Stores Store ID',
            'brands_brand_id' => 'Brands Brand ID',
        ];
    }
}
