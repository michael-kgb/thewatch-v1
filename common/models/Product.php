<?php

namespace common\models;

use Yii;
/**
 * This is the model class for table "product".
 *
 * @property integer $product_id
 * @property integer $product_category_id
 * @property integer $product_sub_category_id
 * @property integer $suppliers_supplier_id
 * @property integer $category_id
 * @property integer $brands_brand_id
 * @property integer $brands_collection_id
 * @property integer $quantity
 * @property integer $minimal_quantity
 * @property string $price
 * @property string $price_usd
 * @property string $width
 * @property string $height
 * @property string $depth
 * @property string $weight
 * @property integer $active
 * @property integer $available_for_order
 * @property string $available_date
 * @property string $product_condition
 * @property integer $show_price
 * @property string $visibility
 * @property string $product_sort
 * @property string $date_created
 * @property string $date_updated
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brands_brand_id', 'product_category_id','brands_collection_id', 'price', 'width', 'height', 'weight'], 'required'],
            [['suppliers_supplier_id', 'brands_brand_id', 'product_sub_category_id', 'quantity', 'minimal_quantity', 'active', 'available_for_order', 'show_price'], 'integer'],
            [['price', 'width', 'height', 'depth', 'weight'], 'number'],
            [['available_date', 'date_created', 'date_updated'], 'safe'],
            [['product_condition', 'visibility'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'product_category_id' => 'Product Category ID',
            'product_sub_category_id' => 'Product Sub Category ID',
            'suppliers_supplier_id' => 'Suppliers Supplier ID',
            'category_id' => 'Category ID',
            'brands_brand_id' => 'Brands Brand ID',
            'brands_collection_id' => 'Brands Collections ID',
            'quantity' => 'Quantity',
            'minimal_quantity' => 'Minimal Quantity',
            'price' => 'Price',
            'width' => 'Width',
            'height' => 'Height',
            'depth' => 'Depth',
            'weight' => 'Weight',
            'active' => 'Active',
            'available_for_order' => 'Available For Order',
            'available_date' => 'Available Date',
            'product_condition' => 'Product Condition',
            'show_price' => 'Show Price',
            'visibility' => 'Visibility',
            'product_sort' => 'Product Sort',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }

    /**
     * @return Image[]
     */
    public function getImages()
    {
        return $this->hasMany(ProductImage::className(), ['product_id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['product_category_id' => 'product_category_id']);
    }

    /**
     * @inheritdoc
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->product_id;
    }
}