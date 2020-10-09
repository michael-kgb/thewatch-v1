<?php

namespace frontend\models;

use Yii;
/**
 * This is the model class for table "collab_event_accounts".
 *
 * @property string $account_id
 * @property string $account_fullname
 * @property string $account_email
 * @property string $account_avatar
 * @property string $account_username
 * @property string $account_password
 * @property string $account_key
 * @property string $account_reset_token
 * @property string $store_id
 * @property string $account_status
 * @property string $created_at
 * @property string $updated_at
 * @property string $last_login
 */
class CollabAccounts extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'collab_event_accounts';
    }

    /**
     * @inheritdoc
     */
	 

 
    public function rules()
    {
        return [
			[['account_fullname', 'account_email', 'account_username', 'account_password'], 'required'],
            [['account_avatar'], 'string'],
			[['account_email'], 'unique', 'message' => 'email has already exist.'],
			[['account_username'], 'unique', 'message' => 'username has already exist.'],
            [['store_id','account_status'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'account_id' => 'Account ID',
            'account_fullname' => 'Account Full Name',
            'account_email' => 'Account Email',
            'account_avatar' => 'Account Avatar',
            'account_username' => 'Account Username',
            'account_password' => 'Account Password',
            'account_key' => 'Account Key',
            'account_reset_token' => 'Account Reset Token',
            'store_id' => 'Store ID',
            'account_status' => 'Account Status',
            'last_login' => 'Last Login',
        ];
    }

    /**
     * Finds by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['account_username' => $username, 'account_status' => self::STATUS_ACTIVE]);
    }
}