<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category_menu_picture".
 *
 * @property integer $category_menu_picture_id
 * @property string $category_menu_picture_image
 * @property string $category_menu_picture_name
 * @property string $category_menu_picture_text
 * @property string $category_menu_picture_link
 * @property integer $category_menu_picture_type
 * @property integer $category_menu_picture_status
 */
class CategoryMenuPicture extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_menu_picture';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_menu_picture_image', 'category_menu_picture_link', 'category_menu_picture_type', 'category_menu_picture_status'], 'required'],
            [['category_menu_picture_image'], 'string'],
            [['category_menu_picture_link'], 'url', 'defaultScheme' => ''],
            [['category_menu_picture_type', 'category_menu_picture_status', 'product_category_id'], 'integer'],
            [['category_menu_picture_name'], 'string', 'max' => 20],
            [['category_menu_picture_text'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_menu_picture_id' => 'Category Menu Picture ID',
            'category_menu_picture_image' => 'Category Menu Picture Image (1356 X 1427)',
            'category_menu_picture_name' => 'Category Menu Picture Name',
            'category_menu_picture_text' => 'Category Menu Picture Text',
            'category_menu_picture_link' => 'Category Menu Picture URL',
            'category_menu_picture_type' => 'Category Menu Picture Type',
            'category_menu_picture_status' => 'Category Menu Picture Status',
        ];
    }
}
