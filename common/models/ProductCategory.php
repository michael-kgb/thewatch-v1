<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_category".
 *
 * @property integer $product_category_id
 * @property string $product_category_name
 * @property string $product_category_images
 * @property string $product_category_description
 * @property string $product_category_created_date
 * @property string $product_category_status
 * @property integer $product_category_sequence
 * @property integer $product_category_featured
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_category';
    }

    /**
     * @inheritdoc
     */
       public function rules()
    {
        return [
            [['product_category_name', 'product_category_images','product_category_images_mobile', 'product_category_description', 'product_category_status', 'product_category_sequence', 'product_category_featured'], 'required'],
            [['product_category_images', 'product_category_description', 'product_category_status'], 'string'],
            [['product_category_created_date'], 'safe'],
            [['product_category_sequence', 'product_category_featured'], 'integer'],
            [['product_category_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_category_id' => 'Product Category ID',
            'product_category_name' => 'Product Category Name',
            'product_category_images' => 'Product Category Images',
            'product_category_images_mobile' => 'Product Category Images Mobile',
            'product_category_description' => 'Product Category Description',
            'product_category_created_date' => 'Product Category Created Date',
            'product_category_status' => 'Product Category Status',
            'product_category_sequence' => 'Product Category Sequence',
            'product_category_featured' => 'Product Category Featured',
        ];
    }
    
    public function getProducts()
    {
        return $this->hasOne(Product::className(), ['product_category_id' => 'product_category_id']);
    }
}
