<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "warranty_type".
 *
 * @property integer $warranty_type_id
 * @property string $warranty_type_name
 * @property integer $warranty_type_status
 */
class WarrantyType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warranty_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['warranty_type_name', 'warranty_type_status'], 'required'],
            // [['warranty_type_status'], 'integer'],
            // [['warranty_type_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'warranty_type_id' => 'Warranty Type ID',
            'warranty_type_name' => 'Warranty Type Name',
            'warranty_type_status' => 'Warranty Type Status',
        ];
    }
}
