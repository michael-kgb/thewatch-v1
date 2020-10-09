<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "our_people_product".
 *
 * @property integer $our_people_product_id
 * @property integer $our_people_id
 * @property integer $product_id
 */
class OurPeopleProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'our_people_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['our_people_id', 'product_id'], 'required'],
//            [['our_people_id', 'product_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'our_people_product_id' => 'Our People Product ID',
            'our_people_id' => 'Our People ID',
            'product_id' => 'Product ID',
        ];
    }
    
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }
    
    public function getOurPeople()
    {
        return $this->hasOne(OurPeople::className(), ['our_people_id' => 'our_people_id']);
    }
}
