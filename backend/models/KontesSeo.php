<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kontes_seo".
 *
 * @property integer $kontes_seo_id
 * @property string $kontes_seo_name
 * @property string $kontes_seo_hp
 * @property string $kontes_seo_email
 * @property string $kontes_seo_address
 * @property string $kontes_seo_url
 * @property string $kontes_seo_fb
 * @property string $kontes_seo_ig
 */
class KontesSeo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kontes_seo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kontes_seo_name', 'kontes_seo_hp', 'kontes_seo_email', 'kontes_seo_address', 'kontes_seo_url', 'kontes_seo_fb', 'kontes_seo_ig'], 'required'],
            [['kontes_seo_address', 'kontes_seo_url', 'kontes_seo_fb', 'kontes_seo_ig'], 'string'],
            [['kontes_seo_name', 'kontes_seo_email'], 'string', 'max' => 50],
            [['kontes_seo_hp'], 'string', 'max' => 30],
            [['kontes_seo_status'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kontes_seo_id' => 'Kontes Seo ID',
            'kontes_seo_name' => 'Kontes Seo Name',
            'kontes_seo_hp' => 'Kontes Seo Hp',
            'kontes_seo_email' => 'Kontes Seo Email',
            'kontes_seo_address' => 'Kontes Seo Address',
            'kontes_seo_url' => 'Kontes Seo Url',
            'kontes_seo_fb' => 'Kontes Seo Fb',
            'kontes_seo_ig' => 'Kontes Seo Ig',
        ];
    }
}
