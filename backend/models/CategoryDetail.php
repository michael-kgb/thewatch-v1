<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category_detail".
 *
 * @property string $category_id
 * @property string $apps_language_id
 * @property string $name
 * @property string $description
 * @property string $link_rewrite
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 */
class CategoryDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'apps_language_id', 'name', 'link_rewrite'], 'required'],
            [['category_id', 'apps_language_id'], 'integer'],
            [['description'], 'string'],
            [['name', 'link_rewrite', 'meta_title'], 'string', 'max' => 128],
            [['meta_keywords', 'meta_description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'apps_language_id' => 'Apps Language ID',
            'name' => 'Name',
            'description' => 'Description',
            'link_rewrite' => 'Link Rewrite',
            'meta_title' => 'Meta Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
        ];
    }
}
