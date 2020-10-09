<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "marketing_campaign".
 *
 * @property integer $marketing_campaign_id
 * @property string $marketing_campaign_name
 * @property string $marketing_campaign_description
 * @property string $marketing_campaign_date_from
 * @property string $marketing_campaign_date_to
 * @property integer $marketing_campaign_status
 */
class MarketingCampaign extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $marketing_campaign_product;
    public static function tableName()
    {
        return 'marketing_campaign';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['marketing_campaign_name', 'marketing_campaign_description', 'marketing_campaign_date_from', 'marketing_campaign_date_to', 'marketing_campaign_status', 'marketing_campaign_banner', 'marketing_campaign_link'], 'required'],
            [['marketing_campaign_description', 'marketing_campaign_banner', 'marketing_campaign_banner_detail', 'marketing_campaign_link'], 'string'],
            [['marketing_campaign_date_from', 'marketing_campaign_date_to'], 'safe'],
            [['marketing_campaign_status', 'marketing_campaign_discount_only', 'marketing_campaign_non_discount', 'marketing_campaign_all_price', 'marketing_campaign_type_id', 'marketing_campaign_sequence', 'marketing_campaign_show_header'], 'integer'],
            [['marketing_campaign_name'], 'string', 'max' => 100],
            [['marketing_campaign_title'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'marketing_campaign_id' => 'Marketing Campaign ID',
            'marketing_campaign_name' => 'Marketing Campaign Name',
            'marketing_campaign_title' => 'Marketing Campaign Title',
            'marketing_campaign_description' => 'Marketing Campaign Description',
            'marketing_campaign_date_from' => 'Marketing Campaign Date From',
            'marketing_campaign_date_to' => 'Marketing Campaign Date To',
            'marketing_campaign_status' => 'Marketing Campaign Status',
            'marketing_campaign_banner' => 'Marketing Campaign Banner',
            'marketing_campaign_banner_detail' => 'Marketing Campaign Banner Detail',
            'marketing_campaign_link' => 'Marketing Campaign Link',
            'marketing_campaign_discount_only' => 'Marketing Campaign Discount Only',
            'marketing_campaign_non_discount' => 'Marketing Campaign Non Discount',
            'marketing_campaign_all_price' => 'Marketing Campaign All Price',
            'marketing_campaign_type_id' => 'Marketing Campaign Type ID',
            'marketing_campaign_sequence' => 'Marketing Campaign Sequence',
            'marketing_campaign_show_header' => 'Marketing Campaign Show Header',
        ];
    }

    public function getMarketingCampaignBulkhead(){
        return $this->hasOne(MarketingCampaignBulkhead::className(), ['marketing_campaign_id' => 'marketing_campaign_id']);
    }
    public function getMarketingCampaignType(){
        return $this->hasOne(MarketingCampaignType::className(), ['marketing_campaign_type_id' => 'marketing_campaign_type_id']);
    }
}
