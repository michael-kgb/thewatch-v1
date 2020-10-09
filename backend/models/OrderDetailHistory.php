<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_detail_history".
 *
 * @property integer $order_detail_history_id
 * @property integer $orders_id
 * @property integer $order_detail_id
 * @property integer $order_state_lang_id
 * @property integer $order_detail_state_lang_id
 * @property string $date_add
 */
class OrderDetailHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_detail_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['orders_id', 'order_detail_id', 'order_state_lang_id', 'order_detail_state_lang_id', 'date_add'], 'required'],
//            [['orders_id', 'order_detail_id', 'order_state_lang_id', 'order_detail_state_lang_id'], 'integer'],
//            [['date_add'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_detail_history_id' => 'Order Detail History ID',
            'orders_id' => 'Orders ID',
            'order_detail_id' => 'Order Detail ID',
            'order_state_lang_id' => 'Order State Lang ID',
            'order_detail_state_lang_id' => 'Order Detail State Lang ID',
            'date_add' => 'Date Add',
        ];
    }
	
	public function getOrders()
    {
        return $this->hasOne(Orders::className(), ['orders_id' => 'orders_id']);
    }
	
	public function getOrderDetail()
    {
        return $this->hasOne(OrderDetail::className(), ['order_detail_id' => 'order_detail_id']);
    }
	
	public function getOrderStateLang()
    {
        return $this->hasOne(OrderStateLang::className(), ['order_state_lang_id' => 'order_state_lang_id']);
    }
	
	public function getOrderDetailStateLang()
    {
        return $this->hasOne(OrderDetailStateLang::className(), ['order_detail_state_lang_id' => 'order_detail_state_lang_id']);
    }
}
