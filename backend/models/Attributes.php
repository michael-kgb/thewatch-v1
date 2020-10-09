<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "attributes".
 *
 * @property integer $attribute_id
 * @property string $apps_language_id
 * @property string $name
 */
class Attributes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attributes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apps_language_id'], 'required'],
            [['apps_language_id'], 'integer'],
            [['name'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'attribute_id' => 'Attribute ID',
            'apps_language_id' => 'Apps Language ID',
            'name' => 'Name',
        ];
    }
    
    public function getProductAttributeCombination()
    {
        return $this->hasOne(ProductAttributeCombination::className(), ['attribute_id' => 'attribute_id']);
    }
    
    public function getAttributeValueCombination()
    {
        return $this->hasOne(AttributeValueCombination::className(), ['attribute_id' => 'attribute_id']);
    }
}
