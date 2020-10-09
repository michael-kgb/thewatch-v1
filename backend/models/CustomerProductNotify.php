<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customer_product_notify".
 *
 * @property integer $customer_product_notify_id
 * @property integer $product_id
 * @property integer $product_attribute_id
 * @property string $fullname
 * @property string $email
 * @property integer $notify_count
 */
class CustomerProductNotify extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_product_notify';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['product_id', 'product_attribute_id', 'fullname', 'email', 'notify_count'], 'required'],
//            [['product_id', 'product_attribute_id', 'notify_count'], 'integer'],
//            [['email'], 'string'],
//            [['fullname'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_product_notify_id' => 'Customer Product Notify ID',
            'product_id' => 'Product ID',
            'product_attribute_id' => 'Product Attribute ID',
            'fullname' => 'Fullname',
            'email' => 'Email',
            'notify_count' => 'Notify Count',
        ];
    }
    
    public function getProductdetail()
    {
        return $this->hasOne(ProductDetail::className(), ['product_id' => 'product_id']);
    }
    
    public function getProductattributecombination()
    {
        return $this->hasOne(ProductAttributeCombination::className(), ['product_attribute_id' => 'product_attribute_id']);
    }
}
