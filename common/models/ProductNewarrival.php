<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_newarrival".
 *
 * @property integer $product_newarrival_id
 * @property integer $product_id
 * @property string $product_newarrival_start_date
 * @property string $product_newarrival_end_date
 */
class ProductNewArrival extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_newarrival';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'product_newarrival_start_date', 'product_newarrival_end_date'], 'required'],
            [['product_id'], 'integer'],
            [['product_newarrival_start_date', 'product_newarrival_end_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_newarrival_id' => 'Product Newarrival ID',
            'product_id' => 'Product ID',
            'product_newarrival_start_date' => 'Product Newarrival Start Date',
            'product_newarrival_end_date' => 'Product Newarrival End Date',
        ];
    }
    
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }
}