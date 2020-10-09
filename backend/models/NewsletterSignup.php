<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "newsletter_signup".
 *
 * @property integer $newsletter_signup_id
 * @property string $newsletter_signup_firstname
 * @property string $newsletter_signup_date_add
 */
class NewsletterSignup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'newsletter_signup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['newsletter_signup_firstname', 'newsletter_signup_date_add'], 'required'],
//            [['newsletter_signup_firstname'], 'string'],
//            [['newsletter_signup_date_add'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'newsletter_signup_id' => 'Newsletter Signup ID',
            'newsletter_signup_firstname' => 'Newsletter Signup Firstname',
            'newsletter_signup_date_add' => 'Newsletter Signup Date Add',
        ];
    }
}
