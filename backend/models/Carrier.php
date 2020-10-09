<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "carrier".
 *
 * @property string $carrier_id
 * @property string $name
 * @property string $url
 * @property integer $active
 * @property integer $deleted
 * @property integer $shipping_handling
 * @property integer $is_free
 * @property integer $shipping_method
 * @property integer $max_width
 * @property integer $max_height
 * @property integer $max_depth
 * @property string $max_weight
 * @property integer $grade
 */
class Carrier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carrier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['active', 'deleted', 'shipping_handling', 'is_free', 'shipping_method', 'max_width', 'max_height', 'max_depth', 'grade'], 'integer'],
            [['max_weight'], 'number'],
            [['name'], 'string', 'max' => 64],
            [['url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'carrier_id' => 'Carrier ID',
            'name' => 'Name',
            'url' => 'Url',
            'active' => 'Active',
            'deleted' => 'Deleted',
            'shipping_handling' => 'Shipping Handling',
            'is_free' => 'Is Free',
            'shipping_method' => 'Shipping Method',
            'max_width' => 'Max Width',
            'max_height' => 'Max Height',
            'max_depth' => 'Max Depth',
            'max_weight' => 'Max Weight',
            'grade' => 'Grade',
        ];
    }
    
    public function getCarrierCost()
    {
        return $this->hasOne(CarrierCost::className(), ['carrier_id' => 'carrier_id']);
    }
}
