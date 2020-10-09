<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category_menu_mapping".
 *
 * @property integer $category_menu_mapping_id
 * @property integer $category_menu_id
 * @property integer $category_menu_child_id
 */
class CategoryMenuMapping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_menu_mapping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_menu_id', 'category_menu_child_id'], 'required'],
            [['category_menu_id', 'category_menu_child_id'], 'integer'],
            // [['category_menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryMenu::className(), 'targetAttribute' => ['category_menu_id' => 'category_menu_id']],
            // [['category_menu_child_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryMenuChild::className(), 'targetAttribute' => ['category_menu_child_id' => 'category_menu_child_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_menu_mapping_id' => 'Category Menu Mapping ID',
            'category_menu_id' => 'Category Menu ID',
            'category_menu_child_id' => 'Category Menu Child ID',
        ];
    }
}
