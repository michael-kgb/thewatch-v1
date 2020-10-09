<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "marketing_campaign_product".
 *
 * @property integer $marketing_campaign_product_id
 * @property integer $marketing_campaign_id
 * @property integer $product_id
 */
class MarketingCampaignProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marketing_campaign_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['marketing_campaign_id', 'product_id'], 'required'],
            [['marketing_campaign_id', 'product_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'marketing_campaign_product_id' => 'Marketing Campaign Product ID',
            'marketing_campaign_id' => 'Marketing Campaign ID',
            'product_id' => 'Product ID',
        ];
    }
}
