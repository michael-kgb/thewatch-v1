<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "service_type".
 *
 * @property integer $service_type_id
 * @property string $service_type_name
 * @property integer $service_type_status
 */
class ServiceType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['service_type_name', 'service_type_status'], 'required'],
            //[['service_type_name'], 'string'],
            //[['service_type_status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_type_id' => 'Service Type ID',
            'service_type_name' => 'Service Type Name',
            'service_type_status' => 'Service Type Status',
        ];
    }
}
