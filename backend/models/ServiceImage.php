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
class ServiceImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_image';
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
            'service_image_id' => 'Service Image ID',
            'order_detail_warranty_id' => 'Order Detail Warranty ID',
            'service_image_depan' => 'Service Image Depan',
            'service_image_samping' => 'Service Image Samping',
            'service_image_atas' => 'Service Image Atas',
            'service_image_bawah' => 'Service Image Bawah',
            'service_image_belakang' => 'Service Image Belakang',
            'service_image_detail' => 'Service Image Detail',
        ];
    }
}
