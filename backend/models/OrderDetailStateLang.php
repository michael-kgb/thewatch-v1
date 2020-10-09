<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_detail_state_lang".
 *
 * @property integer $order_detail_state_lang_id
 * @property string $apps_language_id
 * @property string $name
 * @property string $template
 * @property string $text
 */
class OrderDetailStateLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_detail_state_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['apps_language_id', 'name', 'template', 'text'], 'required'],
//            [['apps_language_id'], 'integer'],
//            [['text'], 'string'],
//            [['name', 'template'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_detail_state_lang_id' => 'Order Detail State Lang ID',
            'apps_language_id' => 'Apps Language ID',
            'name' => 'Name',
            'template' => 'Template',
            'text' => 'Text',
        ];
    }
}
