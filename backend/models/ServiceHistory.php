<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "service_history".
 *
 * @property string $service_history_id
 * @property string $service_id
 * @property integer $service_state_lang_id
 * @property string $date_add
 */
class ServiceHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['service_id', 'service_state_lang_id', 'date_add'], 'required'],
            //[['service_id', 'service_state_lang_id'], 'integer'],
            //[['date_add'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_history_id' => 'Service History ID',
            'service_id' => 'Service ID',
            'service_state_lang_id' => 'Service State Lang ID',
            'date_add' => 'Date Add',
        ];
    }
	
	public function getServiceStateLang(){
		return $this->hasOne(ServiceStateLang::className(), ['service_state_lang_id' => 'service_state_lang_id']);
	}
}
