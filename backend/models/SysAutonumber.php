<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_autonumber".
 *
 * @property integer $sys_autonumber_id
 * @property string $sys_autonumber_prefix
 * @property integer $sys_autonumber_char
 * @property integer $sys_autonumber_value
 * @property string $sys_autonumber_model
 * @property string $sys_autonumber_description
 */
class SysAutonumber extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_autonumber';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['sys_autonumber_prefix', 'sys_autonumber_char', 'sys_autonumber_value', 'sys_autonumber_description'], 'required'],
            //[['sys_autonumber_prefix', 'sys_autonumber_model', 'sys_autonumber_description'], 'string'],
            //[['sys_autonumber_char', 'sys_autonumber_value'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sys_autonumber_id' => 'Sys Autonumber ID',
            'sys_autonumber_prefix' => 'Sys Autonumber Prefix',
            'sys_autonumber_char' => 'Sys Autonumber Char',
            'sys_autonumber_value' => 'Sys Autonumber Value',
            'sys_autonumber_model' => 'Sys Autonumber Model',
            'sys_autonumber_description' => 'Sys Autonumber Description',
        ];
    }
}
