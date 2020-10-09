<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "service_state_lang".
 *
 * @property integer $service_state_lang_id
 * @property string $apps_language_id
 * @property string $name
 * @property string $template
 * @property string $text
 * @property string $action_text
 */
class ServiceStateLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_state_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['apps_language_id', 'name', 'template', 'text', 'action_text'], 'required'],
            //[['apps_language_id'], 'integer'],
            //[['name', 'text', 'action_text'], 'string'],
            //[['template'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_state_lang_id' => 'Service State Lang ID',
            'apps_language_id' => 'Apps Language ID',
            'name' => 'Name',
            'template' => 'Template',
            'text' => 'Text',
            'action_text' => 'Action Text',
        ];
    }
}
