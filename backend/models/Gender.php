<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gender".
 *
 * @property string $gender_id
 * @property string $apps_language_id
 * @property string $name
 */
class Gender extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gender';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gender_id', 'apps_language_id', 'name'], 'required'],
            [['gender_id', 'apps_language_id'], 'integer'],
            [['name'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gender_id' => 'Gender ID',
            'apps_language_id' => 'Apps Language ID',
            'name' => 'Name',
        ];
    }
    
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['gender_id' => 'gender_id']);
    }
}
