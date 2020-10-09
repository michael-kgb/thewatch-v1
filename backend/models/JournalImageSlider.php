<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "journal_image_slider".
 *
 * @property integer $journal_image_slider_id
 * @property string $journal_image_slider_image
 * @property integer $journal_image_slider_active
 * @property integer $journal_id
 */
class JournalImageSlider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'journal_image_slider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['journal_image_slider_image', 'journal_image_slider_active', 'journal_id'], 'required'],
            [['journal_image_slider_image'], 'string'],
            [['journal_image_slider_active', 'journal_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'journal_image_slider_id' => 'Journal Image Slider ID',
            'journal_image_slider_image' => 'Journal Image Slider Image',
            'journal_image_slider_active' => 'Journal Image Slider Active',
            'journal_id' => 'Journal ID',
        ];
    }
}
