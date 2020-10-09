<?php

namespace frontend\models;

use Yii;
/**
 * This is the model class for table "collab_event_draws".
 *
 * @property string $draw_id
 * @property string $event_alias
 * @property string $user_key
 * @property string $account_username
 * @property string $draw_code
 * @property string $draw_status
 * @property string $created_at
 * @property string $updated_at
 */
class CollabDraws extends \yii\db\ActiveRecord
{
    const STATUS_NOT_USED = 0;
    const STATUS_USED = 1;
    const STATUS_UNVERIFYED = 2;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'collab_event_draws';
    }

    /**
     * @inheritdoc
     */
	 

 
    public function rules()
    {
        return [
			[['event_alias', 'user_key', 'account_username', 'draw_code'], 'required'],
            [['event_alias', 'user_key', 'account_username', 'draw_code'], 'string'],
			[['draw_code'], 'unique', 'message' => 'code has already exist.'],
            [['draw_status'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            // 'draw_id' => 'Draw ID',
        ];
    }

    /**
     * Finds by unused code
     *
     * @param string $code
     * @return static|null
     */
    public static function findByUnusedCode($code)
    {
        return static::findOne(['draw_code' => $code, 'draw_status' => self::STATUS_NOT_USED]);
    }

    /**
     * Finds by used code
     *
     * @param string $code
     * @return static|null
     */
    public static function findByUsedCode($code)
    {
        return static::findOne(['draw_code' => $code, 'draw_status' => self::STATUS_USED]);
    }
    
    /**
     * Finds event by event alias
     *
     * @param string $event
     * @return static|null
     */
    public function getCollabEvents()
    {
        return $this->hasOne(CollabEvents::className(), ['event_alias' => 'event_alias']);
    }
    
    /**
     * Finds user by user key
     *
     * @param string $userkey
     * @return static|null
     */
    public function getCollabUsers()
    {
        return $this->hasOne(CollabUsers::className(), ['user_key' => 'user_key']);
    }
    
    /**
     * Finds account by account username
     *
     * @param string $account_username
     * @return static|null
     */
    public function getCollabAccounts()
    {
        return $this->hasOne(CollabAccounts::className(), ['account_username' => 'account_username']);
    }

    /**
     * Finds draws by
     *
     * @param string $events
     * @return static|null
     */
	public static function getRunningEvents($events)
	{
		$sortby = 'collab_events.event_start_date ASC';
		$query = self::find()
					->select('*')
					->joinWith([
						"collabEvents",
						"collabUsers",
						"collabAccounts"
					])
					->where(['collab_events.is_active' => 1])
                    ->andWhere('NOW() BETWEEN collab_events.event_start_date AND collab_events.event_end_date');
                    if(sizeof($events) != 0){
                        $query->andWhere(["in", "collab_events.event_alias", $events]);
                    }
		$query->orderBy($sortby);
		$result = $query->all();
		return $result;
		
		// $query = new Query;
		// $query	->select(['ce.event_alias', 'ce.event_name', 'ce.event_quota'])  
				// ->from('collab_events as ce')
				// ->leftJoin('collab_event_users as ceu', 'tbl_category.createdby = tbl_user.userid')
				// ->limit(2); 
				
		// $command = $query->createCommand();
		// $data = $command->queryAll();
	}

    /**
     * Finds events quota by
     *
     * @param string $events
     * @return static|null
     */
	public static function getEventTotal($events)
	{
		$quota = 0;
		$query = self::find()
					->where(['collab_event_draws.event_alias' => $events]);
		$result = $query->count();
		$quota = (int) $result;
		return $quota;
	}
}