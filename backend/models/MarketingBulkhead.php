<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "marketing_bulkhead".
 *
 * @property integer $marketing_bulkhead_id
 * @property string $marketing_bulkhead_name
 * @property string $marketing_bulkhead_text
 * @property string $marketing_bulkhead_date_from
 * @property string $marketing_bulkhead_date_to
 * @property integer $marketing_bulkhead_status
 */
class MarketingBulkhead extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $related_campaign;

    public static function tableName()
    {
        return 'marketing_bulkhead';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['marketing_bulkhead_name', 'marketing_bulkhead_text', 'marketing_bulkhead_type', 'marketing_bulkhead_date_from', 'marketing_bulkhead_date_to', 'marketing_bulkhead_status','related_campaign'], 'required'],
            [['marketing_bulkhead_text'], 'string'],
            [['marketing_bulkhead_date_from', 'marketing_bulkhead_date_to'], 'safe'],
            [['marketing_bulkhead_status'], 'integer'],
            [['marketing_bulkhead_name'], 'string', 'max' => 100],
            [['marketing_bulkhead_type'], 'string', 'max' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'marketing_bulkhead_id' => 'Marketing Bulkhead ID',
            'marketing_bulkhead_name' => 'Marketing Bulkhead Name',
            'marketing_bulkhead_text' => 'Marketing Bulkhead Text',
            'marketing_bulkhead_date_from' => 'Marketing Bulkhead Date From',
            'marketing_bulkhead_date_to' => 'Marketing Bulkhead Date To',
            'marketing_bulkhead_status' => 'Marketing Bulkhead Status',
            'marketing_bulkhead_type' => 'Marketing Bulkhead Type',
            'related_campaign' => 'Related Campaign',
        ];
    }
    public function getMarketingBulkhead(){
            return $this->hasOne(MarketingBulkhead::className(), ['marketing_bulkhead_id' => 'marketing_bulkhead_id']);
    }
}
