<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "marketing_campaign_bulkhead".
 *
 * @property integer $marketing_campaign_bulkhead_id
 * @property integer $marketing_campaign_id
 * @property integer $marketing_bulkhead_id
 */
class MarketingCampaignBulkhead extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marketing_campaign_bulkhead';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['marketing_campaign_id', 'marketing_bulkhead_id'], 'required'],
            [['marketing_campaign_id', 'marketing_bulkhead_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'marketing_campaign_bulkhead_id' => 'Marketing Campaign Bulkhead ID',
            'marketing_campaign_id' => 'Marketing Campaign ID',
            'marketing_bulkhead_id' => 'Marketing Bulkhead ID',
        ];
    }
    public function getMarketingCampaign(){
            return $this->hasOne(MarketingCampaign::className(), ['marketing_campaign_id' => 'marketing_campaign_id']);
    }
    public function getMarketingBulkhead(){
            return $this->hasOne(MarketingBulkhead::className(), ['marketing_bulkhead_id' => 'marketing_bulkhead_id']);
    }
}
