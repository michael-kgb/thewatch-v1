<?php

namespace frontend\models;

use Yii;
/**
 * This is the model class for table "collab_events".
 *
 * @property string $event_id
 * @property string $event_alias
 * @property string $event_name
 * @property string $event_quota
 * @property string $event_start_date
 * @property string $event_end_date
 * @property string $created_at
 * @property string $updated_at
 * @property string $is_active
 */
class CollabEvents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'collab_events';
    }

    /**
     * @inheritdoc
     */
	 

 
    public function rules()
    {
        return [
			[['event_alias', 'event_name', 'event_start_date', 'event_end_date'], 'required'],
			[['event_alias'], 'unique', 'message' => 'event alias has already exist.'],
            [['event_quota','is_active'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'event_id' => 'Event ID',
            'event_alias' => 'Event Alias',
            'event_name' => 'Event Name',
            'event_quota' => 'Event Quota',
            'event_start_date' => 'Event Start Date',
            'event_end_date' => 'Event End Date',
            'created_at' => 'Created Date',
            'updated_at' => 'Updated Date',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * Finds events by
     *
     * @param string $username
     * @return static|null
     */
	public static function getRunningEvents($events)
	{
		$sortby = 'collab_events.event_start_date ASC';
		$query = self::find()
					->select('*')
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
	public static function getEventQuota($events)
	{
		$quota = 0;
		$query = self::find()
					->select('collab_events.event_quota')
					->where(['collab_events.event_alias' => $events]);
		$result = $query->one();
		$quota = (int) $result->event_quota;
		return $quota;
	}
}