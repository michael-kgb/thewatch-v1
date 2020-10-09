<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "newsletter".
 *
 * @property integer $newsletter_id
 * @property string $newsletter_subject
 * @property string $newsletter_banner
 * @property string $newsletter_send_add
 * @property integer $active
 */
class Newsletter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'newsletter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['newsletter_subject', 'newsletter_banner'], 'required'],
            // [['newsletter_send_add'], 'safe'],
            // [['active'], 'integer'],
            // [['newsletter_subject', 'newsletter_banner'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'newsletter_id' => 'Newsletter ID',
            'newsletter_subject' => 'Newsletter Subject',
            'newsletter_banner' => 'Newsletter Banner',
            'newsletter_send_add' => 'Newsletter Send Add',
            'active' => 'Active',
        ];
    }
}
