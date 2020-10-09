<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "warranty".
 *
 * @property integer $warranty_id
 * @property string $warranty_name
 * @property integer $warranty_year
 * @property integer $warranty_status
 */
class Warranty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warranty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['warranty_name', 'warranty_year', 'warranty_status'], 'required'],
//            [['warranty_year', 'warranty_status'], 'integer'],
//            [['warranty_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'warranty_id' => 'Warranty ID',
            'warranty_name' => 'Warranty Name',
            'warranty_year' => 'Warranty Year',
            'warranty_status' => 'Warranty Status',
        ];
    }
	
	public function getWarrantyType(){
        return $this->hasOne(WarrantyType::className(), ['warranty_type_id' => 'warranty_type_id']);
    }
	
	public function getOrderDetailWarranty(){
		return $this->hasOne(OrderDetailWarranty::className(), ['warranty_id' => 'warranty_id']);
	}
}
