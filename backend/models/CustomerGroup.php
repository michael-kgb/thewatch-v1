<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customer_group".
 *
 * @property string $customer_group_id
 * @property string $apps_language_id
 * @property string $name
 */
class CustomerGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_group_id', 'apps_language_id', 'name'], 'required'],
            [['customer_group_id', 'apps_language_id'], 'integer'],
            [['name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_group_id' => 'Customer Group ID',
            'apps_language_id' => 'Apps Language ID',
            'name' => 'Name',
        ];
    }
    
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['customer_group_id' => 'customer_group_id']);
    }
    
}
