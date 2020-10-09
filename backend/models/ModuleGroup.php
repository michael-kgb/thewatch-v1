<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "module_group".
 *
 * @property integer $module_group_id
 * @property string $module_group_name
 * @property integer $show_number
 * @property string $glyphicon
 */
class ModuleGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_group_name', 'show_number', 'glyphicon'], 'required'],
            [['show_number'], 'integer'],
            [['module_group_name', 'glyphicon'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'module_group_id' => 'Module Group ID',
            'module_group_name' => 'Module Group Name',
            'show_number' => 'Show Number',
            'glyphicon' => 'Glyphicon',
        ];
    }
}
