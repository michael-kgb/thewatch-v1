<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property integer $id
 * @property string $fullname
 * @property string $module
 * @property string $action
 * @property integer $id_onChanged
 * @property string $date_time
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fullname', 'module', 'action', 'id_onChanged'], 'required'],
            [['id_onChanged'], 'integer'],
            [['date_time'], 'safe'],
            [['fullname', 'module'], 'string', 'max' => 20],
            [['action'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'Fullname',
            'module' => 'Module',
            'action' => 'Action',
            'id_onChanged' => 'Id On Changed',
            'date_time' => 'Date Time',
        ];
    }
}
