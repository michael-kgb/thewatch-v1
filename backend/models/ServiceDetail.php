<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "service_detail".
 *
 * @property integer $service_detail_id
 * @property integer $service_id
 * @property integer $order_detail_warranty_id
 * @property integer $service_type_store_id
 */
class ServiceDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['service_id', 'order_detail_warranty_id', 'service_type_store_id'], 'required'],
            //[['service_id', 'order_detail_warranty_id', 'service_type_store_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_detail_id' => 'Service Detail ID',
            'service_id' => 'Service ID',
            'order_detail_warranty_id' => 'Order Detail Warranty ID',
            'service_type_store_id' => 'Service Type Store ID',
        ];
    }
	
	public function getOrderDetailWarranty(){
		return $this->hasOne(OrderDetailWarranty::className(), ['order_detail_warranty_id' => 'order_detail_warranty_id']);
	}
	
	public function getServiceTypeStore(){
        return $this->hasOne(ServiceTypeStore::className(), ['service_type_store_id' => 'service_type_store_id']);
    }
	
	public function getServiceDropStore(){
		return $this->hasOne(Stores::className(), ['store_id' => 'service_detail_drop_store_id']);
	}
	
	public function getServiceImage(){
		return $this->hasOne(ServiceImage::className(), ['service_detail_id' => 'service_detail_id']);
	}
}
