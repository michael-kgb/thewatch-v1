<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "akulaku_log".
 *
 * @property integer $akulaku_log_id
 * @property string $akulaku_log_refno
 * @property string $akulaku_log_status
 * @property string $akulaku_log_periods
 * @property string $akulaku_log_sign
 */
class AkulakuLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akulaku_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['akulaku_log_refno', 'akulaku_log_status', 'akulaku_log_periods', 'akulaku_log_sign'], 'required'],
            //[['akulaku_log_refno', 'akulaku_log_status', 'akulaku_log_periods', 'akulaku_log_sign'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'akulaku_log_id' => 'Akulaku Log ID',
            'akulaku_log_refno' => 'Akulaku Log Refno',
            'akulaku_log_status' => 'Akulaku Log Status',
            'akulaku_log_periods' => 'Akulaku Log Periods',
            'akulaku_log_sign' => 'Akulaku Log Sign',
        ];
    }
}
