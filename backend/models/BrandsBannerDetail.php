<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brands_banner_detail".
 *
 * @property integer $brands_banner_detail_id
 * @property integer $brands_brand_id
 * @property string $brands_banner_detail_slide_image
 */
class BrandsBannerDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brands_banner_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brands_brand_id', 'brands_banner_detail_slide_image'], 'required'],
            [['brands_brand_id'], 'integer'],
            [['brands_banner_detail_slide_image'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'brands_banner_detail_id' => 'Brands Banner Detail ID',
            'brands_brand_id' => 'Brands Brand ID',
            'brands_banner_detail_slide_image' => 'Brands Banner Detail Slide Image',
        ];
    }
    
    public function getBrands()
    {
        return $this->hasOne(Brands::className(), ['brand_id' => 'brands_brand_id']);
    }
}
