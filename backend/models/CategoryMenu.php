<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category_menu".
 *
 * @property integer $category_menu_id
 * @property string $category_menu_name
 * @property integer $product_category_id
 */
class CategoryMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_menu_name', 'product_category_id'], 'required'],
            [['product_category_id'], 'integer'],
            [['category_menu_name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_menu_id' => 'Category Menu ID',
            'category_menu_name' => 'Category Menu Name',
            'product_category_id' => 'Product Category ID',
        ];
    }
}
