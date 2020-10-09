<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "seo_pages".
 *
 * @property integer $seo_pages_id
 * @property string $seo_pages_name
 * @property string $seo_pages_description
 * @property integer $seo_pages_status
 */
class SeoPages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['seo_pages_name', 'seo_pages_description', 'seo_pages_status'], 'required'],
//            [['seo_pages_description'], 'string'],
//            [['seo_pages_status'], 'integer'],
//            [['seo_pages_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'seo_pages_id' => 'Seo Pages ID',
            'seo_pages_name' => 'Seo Pages Name',
            'seo_pages_description' => 'Seo Pages Description',
            'seo_pages_status' => 'Seo Pages Status',
        ];
    }
}
