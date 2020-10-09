<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "attribute_value".
 *
 * @property integer $attribute_value_id
 * @property string $apps_language_id
 * @property string $value
 */
class AttributeValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attribute_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apps_language_id'], 'required'],
            [['apps_language_id'], 'integer'],
            [['value'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'attribute_value_id' => 'Attribute Value ID',
            'apps_language_id' => 'Apps Language ID',
            'value' => 'Value',
        ];
    }
    
    public function getProductAttributeCombination()
    {
        return $this->hasOne(ProductAttributeCombination::className(), ['attribute_value_id' => 'attribute_value_id']);
    }
    
    public function getAttributeValueCombination()
    {
        return $this->hasOne(AttributeValueCombination::className(), ['attribute_value_id' => 'attribute_value_id']);
    }
}
