<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "orders_reminder".
 *
 * @property integer $orders_reminder_id
 * @property integer $orders_id
 * @property string $orders_reminder_date
 * @property string $orders_reminder_sent_date
 * @property integer $orders_reminder_status
 */
class OrdersReminder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders_reminder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['orders_id', 'orders_reminder_date', 'orders_reminder_sent_date', 'orders_reminder_status'], 'required'],
            //[['orders_id', 'orders_reminder_status'], 'integer'],
            //[['orders_reminder_date', 'orders_reminder_sent_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orders_reminder_id' => 'Orders Reminder ID',
            'orders_id' => 'Orders ID',
            'orders_reminder_date' => 'Orders Reminder Date',
            'orders_reminder_sent_date' => 'Orders Reminder Sent Date',
            'orders_reminder_status' => 'Orders Reminder Status',
        ];
    }
	
	public function getOrders()
    {
        return $this->hasOne(Orders::className(), ['orders_id' => 'orders_id']);
    }
}
