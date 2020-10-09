<?php

namespace frontend\models;

use Yii;
/**
 * This is the model class for table "collab_event_users".
 *
 * @property string $user_id
 * @property string $user_fullname
 * @property string $user_key
 * @property string $user_email
 * @property string $user_phone
 * @property string $reg_date
 * @property string $created_at
 * @property string $is_deleted
 */
class CollabUsers extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'collab_event_users';
    }

    /**
     * @inheritdoc
     */
	 

 
    public function rules()
    {
        return [
			[['user_fullname', 'user_email', 'user_phone'], 'required'],
            [['user_fullname'], 'string'],
			[['user_email'], 'unique', 'message' => 'email has already exist.'],
            [['is_deleted'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_fullname' => 'User Full Name',
            'user_key' => 'User Key',
            'user_email' => 'User Email',
            'user_phone' => 'User Phone',
            'reg_date' => 'User Reg Date',
        ];
    }

    /**
     * Finds by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUserkey($userkey)
    {
        return static::findOne(['user_key' => $userkey, 'is_deleted' => self::STATUS_DELETED]);
    }
    
    /**
     * Finds draws by user key
     *
     * @param string $userkey
     * @return static|null
     */
    public function getDraws()
    {
        return $this->hasMany(CollabUsers::className(), ['user_key' => 'user_key']);
    }
}