<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_sub_category".
 *
 * @property integer $product_sub_category_id
 * @property integer $product_category_id
 * @property string $product_sub_category_image
 * @property string $product_sub_category_image_mobile
 * @property string $product_sub_category_name
 * @property string $product_sub_category_link
 * @property string $product_sub_category_status
 */
class ProductSubCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_sub_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_category_id', 'product_sub_category_image', 'product_sub_category_image_mobile', 'product_sub_category_name', 'product_sub_category_link', 'product_sub_category_status'], 'required'],
            [['product_category_id'], 'integer'],
            [['product_sub_category_image', 'product_sub_category_image_mobile', 'product_sub_category_link'], 'string'],
            [['product_sub_category_name'], 'string', 'max' => 50],
            [['product_sub_category_status'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_sub_category_id' => 'Product Sub Category ID',
            'product_category_id' => 'Product Category ID',
            'product_sub_category_image' => 'Product Sub Category Image',
            'product_sub_category_image_mobile' => 'Product Sub Category Image Mobile',
            'product_sub_category_name' => 'Product Sub Category Name',
            'product_sub_category_link' => 'Product Sub Category Link',
            'product_sub_category_status' => 'Product Sub Category Status',
        ];
    }
}
