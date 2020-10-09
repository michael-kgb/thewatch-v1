<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property string $id_currency
 * @property string $name
 * @property string $iso_code
 * @property string $iso_code_num
 * @property string $sign
 * @property integer $blank
 * @property integer $format
 * @property integer $decimals
 * @property string $conversion_rate
 * @property integer $deleted
 * @property integer $active
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sign', 'conversion_rate'], 'required'],
            [['blank', 'format', 'decimals', 'deleted', 'active'], 'integer'],
            [['conversion_rate'], 'number'],
            [['name'], 'string', 'max' => 32],
            [['iso_code', 'iso_code_num'], 'string', 'max' => 3],
            [['sign'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_currency' => 'Id Currency',
            'name' => 'Name',
            'iso_code' => 'Iso Code',
            'iso_code_num' => 'Iso Code Num',
            'sign' => 'Sign',
            'blank' => 'Blank',
            'format' => 'Format',
            'decimals' => 'Decimals',
            'conversion_rate' => 'Conversion Rate',
            'deleted' => 'Deleted',
            'active' => 'Active',
        ];
    }
}
