<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for view "vwu_orders_history".
 *
 * @property string $order_history_id
 * @property string $orders_id
 * @property string $order_state_id
 * @property string $date_add
 */
class VOrderHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vwu_orders_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['orders_id', 'order_state_id', 'date_add'], 'required'],
//            [['orders_id', 'order_state_id'], 'integer'],
//            [['date_add'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_history_id' => 'Order History ID',
            'orders_id' => 'Orders ID',
            'order_state_id' => 'Order State ID',
            'date_add' => 'Date Add',
        ];
    }
    
    public function getOrderState()
    {
        return $this->hasOne(OrderState::className(), ['order_state_id' => 'order_state_id']);
    }
    
    public function getOrderStateLang()
    {
        return $this->hasOne(OrderStateLang::className(), ['order_state_lang_id' => 'order_state_lang_id']);
    }
    
    public function getOrders()
    {
        return $this->hasOne(Orders::className(), ['orders_id' => 'orders_id']);
    }
}