<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property string $category_id
 * @property string $id_parent
 * @property integer $level_depth
 * @property integer $active
 * @property string $date_created
 * @property string $date_updated
 * @property string $position
 * @property integer $is_root_category
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_parent', 'date_created', 'date_updated'], 'required'],
            [['id_parent', 'level_depth', 'active', 'position', 'is_root_category'], 'integer'],
            [['date_created', 'date_updated'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'id_parent' => 'Id Parent',
            'level_depth' => 'Level Depth',
            'active' => 'Active',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'position' => 'Position',
            'is_root_category' => 'Is Root Category',
        ];
    }
}
