<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_state_lang".
 *
 * @property string $order_state_id
 * @property string $apps_language_id
 * @property string $name
 * @property string $template
 */
class OrderStateLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_state_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_state_id', 'apps_language_id', 'name', 'template'], 'required'],
            [['order_state_id', 'apps_language_id'], 'integer'],
            [['name', 'template'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_state_id' => 'Order State ID',
            'apps_language_id' => 'Apps Language ID',
            'name' => 'Name',
            'template' => 'Template',
        ];
    }
    
//    public function getOrderHistory()
//    {
//        return $this->hasOne(OrderHistory::className(), ['order_state_id' => 'order_state_id']);
//    }
    
    public function getOrderState()
    {
        return $this->hasOne(OrderState::className(), ['order_state_id' => 'order_state_id']);
    }
}
