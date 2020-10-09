<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property integer $file_id
 * @property string $file_name
 * @property string $file_type
 * @property string $file_created_date
 * @property string $file_status
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_name', 'file_type', 'file_status'], 'required'],
            [['file_name', 'file_status'], 'string'],
            [['file_created_date'], 'safe'],
            [['file_type'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file_id' => 'File ID',
            'file_name' => 'File Name',
            'file_type' => 'File Type',
            'file_created_date' => 'File Created Date',
            'file_status' => 'File Status',
        ];
    }
}
