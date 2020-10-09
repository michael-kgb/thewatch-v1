<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "service_image".
 *
 * @property integer $service_image_id
 * @property integer $order_detail_warranty_id
 * @property integer $service_image_depan
 * @property integer $service_image_samping
 * @property integer $service_image_atas
 * @property integer $service_image_bawah
 * @property integer $service_image_belakang
 * @property integer $service_image_detail
 */
class ServiceReminder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_reminder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['order_detail_warranty_id', 'service_image_depan', 'service_image_samping', 'service_image_atas', 'service_image_bawah', 'service_image_belakang', 'service_image_detail'], 'required'],
            //[['order_detail_warranty_id', 'service_image_depan', 'service_image_samping', 'service_image_atas', 'service_image_bawah', 'service_image_belakang', 'service_image_detail'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_reminder_id' => 'Service Image ID',
            'service_id' => 'Order Detail Warranty ID',
            'service_reminder_date' => 'Service Image Depan',
            'service_reminder_status' => 'Service Image Samping',
            'service_reminder_sent_date' => 'Service Image Atas',
            'service_received_date' => 'Service Image Bawah',
            'service_received_status' => 'Service Image Belakang',
         
        ];
    }
}
