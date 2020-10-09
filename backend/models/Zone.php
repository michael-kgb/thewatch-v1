<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "zone".
 *
 * @property string $id_zone
 * @property string $name
 * @property integer $active
 */
class Zone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_zone' => 'Id Zone',
            'name' => 'Name',
            'active' => 'Active',
        ];
    }
}
