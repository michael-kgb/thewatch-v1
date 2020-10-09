<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property integer $location_id
 * @property string $location_name
 * @property string $location_type
 * @property double $location_x
 * @property double $location_y
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['location_id', 'location_name', 'location_type', 'location_x', 'location_y'], 'required'],
            [['location_id'], 'integer'],
            [['location_type'], 'string'],
            [['location_x', 'location_y'], 'number'],
            [['location_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'location_id' => 'Location ID',
            'location_name' => 'Location Name',
            'location_type' => 'Location Type',
            'location_x' => 'Location X',
            'location_y' => 'Location Y',
        ];
    }
}
