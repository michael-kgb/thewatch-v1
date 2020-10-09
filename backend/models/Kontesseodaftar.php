<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kontes_seo".

 */
class Kontesseodaftar extends \yii\db\ActiveRecord
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
            //[['kontes_seo_name', 'kontes_seo_hp', 'kontes_seo_email', 'kontes_seo_address', 'kontes_seo_url', 'kontes_seo_fb', 'kontes_seo_ig'], 'required'],
            //[['kontes_seo_hp'], 'integer'],
			//[['kontes_seo_email'], 'email'],
            //[['kontes_seo_name', 'kontes_seo_email', 'kontes_seo_address', 'kontes_seo_url', 'kontes_seo_fb', 'kontes_seo_ig'],'string', 'min' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kontes_seo_id' => 'Kontesseo ID',
            'kontes_seo_name' => 'Kontesseo Name',
            'kontes_seo_hp' => 'Kontesseo Hp',
            'kontes_seo_email' => 'Kontesseo Email',
            'kontes_seo_address' => 'Kontesseo Address',
			'kontes_seo_url' => 'Kontesseo Url',
			'kontes_seo_fb' => 'Kontesseo FB',
			'kontes_seo_ig' => 'Kontesseo IG',
        ];
    }
}
