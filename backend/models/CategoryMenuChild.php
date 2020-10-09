<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category_menu_child".
 *
 * @property integer $category_menu_child_id
 * @property string $category_menu_child_name
 * @property string $category_menu_child_link
 */
class CategoryMenuChild extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_menu_child';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_menu_child_name', 'category_menu_child_link'], 'required'],
            [['category_menu_child_link'], 'url', 'defaultScheme' => ''],
            [['category_menu_child_name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_menu_child_id' => 'Category Menu Child ID',
            'category_menu_child_name' => 'Category Menu Child Name',
            'category_menu_child_link' => 'Category Menu Child URL',
        ];
    }
}
