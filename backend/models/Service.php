<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property integer $service_id
 * @property integer $orders_id
 * @property string $service_code
 * @property string $service_date_add
 * @property string $shipping_number
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['orders_id', 'service_code', 'service_date_add', 'shipping_number'], 'required'],
            //[['orders_id'], 'integer'],
            //[['service_code', 'shipping_number'], 'string'],
            //[['service_date_add'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_id' => 'Service ID',
            'orders_id' => 'Orders ID',
            'service_code' => 'Service Code',
            'service_date_add' => 'Service Date Add',
            'shipping_number' => 'Shipping Number',
        ];
    }
	
	public function getOrders(){
        return $this->hasOne(Orders::className(), ['orders_id' => 'orders_id']);
    }
	
	public function getServiceHistory(){
		return $this->hasOne(ServiceHistory::className(), ['service_history_id' => 'service_history_id']);
	}
	
	public function getServiceDetail(){
		return $this->hasOne(ServiceDetail::className(), ['service_id' => 'service_id']);
	}
	
	public function getServiceImage(){
		return $this->hasOne(ServiceImage::className(), ['service_id' => 'service_id']);
	}
	
	public function getPaymentMethodDetail()
    {
        return $this->hasOne(PaymentMethodDetail::className(), ['payment_method_detail_id' => 'payment_method_detail_id']);
    }
	
	public function getServiceDropStore(){
		return $this->hasOne(Stores::className(), ['store_id' => 'sc_drop_store_id']);
	}
	
	public function getQuestionnaireRespondent(){
        return $this->hasOne(QuestionnaireRespondent::className(), ['questionnaire_respondent_id' => 'questionnaire_respondent_id']);
    }
    

    
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['province_id' => 'sc_drop_province_id']);
    }
    
    public function getState()
    {
        return $this->hasOne(State::className(), ['state_id' => 'sc_drop_state_id']);
    }
    
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['district_id' => 'sc_drop_district_id']);
    }
}
