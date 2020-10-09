<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_carrier".
 *
 * @property string $product_id
 * @property string $carrier_id
 */
class ProductCarrier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_carrier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'carrier_id'], 'required'],
            [['product_id', 'carrier_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'carrier_id' => 'Carrier ID',
        ];
    }
}
