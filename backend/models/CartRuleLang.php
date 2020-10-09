<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cart_rule_lang".
 *
 * @property string $cart_rule_id
 * @property string $apps_language_id
 * @property string $name
 */
class CartRuleLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart_rule_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['cart_rule_id', 'apps_language_id', 'name'], 'required'],
//            [['cart_rule_id', 'apps_language_id'], 'integer'],
//            [['name'], 'string', 'max' => 254]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cart_rule_id' => 'Cart Rule ID',
            'apps_language_id' => 'Apps Language ID',
            'name' => 'Name',
        ];
    }
}
