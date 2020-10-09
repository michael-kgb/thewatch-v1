<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "module".
 *
 * @property integer $id
 * @property integer $module_group_id
 * @property string $module_controller
 * @property string $module_name
 * @property integer $show_number
 */
class Module extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_group_id', 'module_controller', 'module_name', 'show_number'], 'required'],
            [['module_group_id', 'show_number'], 'integer'],
            [['module_controller', 'module_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'module_group_id' => 'Module Group ID',
            'module_controller' => 'Module Controller',
            'module_name' => 'Module Name',
            'show_number' => 'Show Number',
        ];
    }
	
	public function getModuleGroup()
    {
        return $this->hasOne(ModuleGroup::className(), ['module_group_id' => 'module_group_id']);
    }
}
