<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "service_type_store".
 *
 * @property integer $service_type_store_id
 * @property integer $service_type_id
 * @property integer $store_id
 */
class ServiceTypeStore extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_type_store';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['service_type_id', 'store_id'], 'required'],
            //[['service_type_id', 'store_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_type_store_id' => 'Service Type Store ID',
            'service_type_id' => 'Service Type ID',
            'store_id' => 'Store ID',
        ];
    }
	
	public function getServiceType(){
        return $this->hasOne(ServiceType::className(), ['service_type_id' => 'service_type_id']);
    }
	
	public function getStores(){
        return $this->hasOne(Stores::className(), ['store_id' => 'store_id']);
    }
}
