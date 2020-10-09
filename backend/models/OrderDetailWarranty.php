<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_detail_warranty".
 *
 * @property integer $order_detail_warranty_id
 * @property integer $order_detail_id
 * @property integer $warranty_id
 */
class OrderDetailWarranty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_detail_warranty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['order_detail_id', 'warranty_id'], 'required'],
            //[['order_detail_id', 'warranty_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_detail_warranty_id' => 'Order Detail Warranty ID',
            'order_detail_id' => 'Order Detail ID',
            'warranty_id' => 'Warranty ID',
        ];
    }
	
	public function getOrderDetail()
	{
		return $this->hasOne(OrderDetail::className(), ['order_detail_id' => 'order_detail_id']);
	}
	
	public function getWarranty()
	{
		return $this->hasOne(Warranty::className(), ['warranty_id' => 'warranty_id']);
	}
}
