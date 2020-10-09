<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "attribute_value_combination".
 *
 * @property integer $attribute_value_combination_id
 * @property integer $attribute_id
 * @property integer $attribute_value_id
 */
class AttributeValueCombination extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attribute_value_combination';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attribute_id', 'attribute_value_id'], 'required'],
            [['attribute_id', 'attribute_value_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'attribute_value_combination_id' => 'Attribute Value Combination ID',
            'attribute_id' => 'Attribute ID',
            'attribute_value_id' => 'Attribute Value ID',
        ];
    }
    
    public function getAttributes()
    {
        return $this->hasOne(Attributes::className(), ['attribute_id' => 'attribute_id']);
    }
    
    public function getAttributeValue()
    {
        return $this->hasOne(AttributeValue::className(), ['attribute_value_id' => 'attribute_value_id']);
    }
}
