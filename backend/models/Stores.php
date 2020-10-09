<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "stores".
 *
 * @property integer $store_id
 * @property string $store_name
 * @property string $store_type
 * @property string $store_marketplace
 * @property string $store_separator
 * @property string $store_location
 * @property string $store_address
 * @property string $store_thumbnail
 * @property string $store_contact_person
 * @property string $store_contact_number
 * @property integer $store_sequence
 * @property string $store_created_date
 * @property string $store_status
 */
class Stores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['store_name', 'store_type', 'store_marketplace', 'store_separator', 'store_location', 'store_address', 'store_thumbnail', 'store_contact_person', 'store_contact_number', 'store_sequence', 'store_status'], 'required'],
            [['store_type', 'store_marketplace', 'store_address', 'store_thumbnail', 'store_contact_number', 'store_status'], 'string'],
            [['store_sequence'], 'integer'],
            [['store_created_date'], 'safe'],
            //[['store_name', 'store_contact_person'], 'string', 'max' => 50],
            //[['store_separator'], 'string', 'max' => 1],
            //[['store_location'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'store_id' => 'Store ID',
            'store_name' => 'Store Name',
            'store_type' => 'Store Type',
            'store_marketplace' => 'Store Marketplace',
            'store_separator' => 'Store Separator',
            'store_location' => 'Store Location',
            'store_address' => 'Store Address',
            'store_thumbnail' => 'Store Thumbnail',
            'store_contact_person' => 'Store Contact Person',
            'store_contact_number' => 'Store Contact Number',
            'store_sequence' => 'Store Sequence',
            'store_created_date' => 'Store Created Date',
            'store_status' => 'Store Status',
        ];
    }
}
