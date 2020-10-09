<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_invoice".
 *
 * @property string $order_invoice_id
 * @property integer $orders_id
 * @property string $reference
 * @property string $total_products
 * @property string $note
 * @property string $date_add
 */
class OrderInvoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['orders_id', 'total_products', 'date_add'], 'required'],
            //[['orders_id', 'total_products'], 'integer'],
            //[['note'], 'string'],
            //[['date_add'], 'safe'],
            //[['reference'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_invoice_id' => 'Order Invoice ID',
            'orders_id' => 'Orders ID',
            'reference' => 'Reference',
            'total_products' => 'Total Products',
            'note' => 'Note',
            'date_add' => 'Date Add',
        ];
    }
	
	public function getOrders()
    {
        return $this->hasOne(Orders::className(), ['orders_id' => 'orders_id']);
    }
}
