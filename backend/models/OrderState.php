<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_state".
 *
 * @property string $order_state_id
 * @property integer $invoice
 * @property integer $send_email
 * @property string $module_name
 * @property string $color
 * @property integer $unremovable
 * @property integer $hidden
 * @property integer $logable
 * @property integer $delivery
 * @property integer $shipped
 * @property integer $paid
 * @property integer $pdf_invoice
 * @property integer $pdf_delivery
 * @property integer $deleted
 */
class OrderState extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_state';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['invoice', 'send_email', 'unremovable', 'hidden', 'logable', 'delivery', 'shipped', 'paid', 'pdf_invoice', 'pdf_delivery', 'deleted'], 'integer'],
//            [['unremovable'], 'required'],
//            [['module_name'], 'string', 'max' => 255],
//            [['color'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_state_id' => 'Order State ID',
            'invoice' => 'Invoice',
            'send_email' => 'Send Email',
            'module_name' => 'Module Name',
            'color' => 'Color',
            'unremovable' => 'Unremovable',
            'hidden' => 'Hidden',
            'logable' => 'Logable',
            'delivery' => 'Delivery',
            'shipped' => 'Shipped',
            'paid' => 'Paid',
            'pdf_invoice' => 'Pdf Invoice',
            'pdf_delivery' => 'Pdf Delivery',
            'deleted' => 'Deleted',
        ];
    }
    
//    public function getOrderStateLang()
//    {
//        return $this->hasOne(OrderStateLang::className(), ['order_state_lang_id' => 'order_state_lang_id']);
//    }
    
    public function getOrderHistory()
    {
        return $this->hasOne(OrderHistory::className(), ['order_state_id' => 'order_state_id']);
    }
}
