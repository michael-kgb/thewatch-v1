<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "journal_author".
 *
 * @property integer $journal_author_id
 * @property string $journal_author_name
 * @property string $journal_author_website
 * @property string $journal_author_phone
 * @property string $journal_author_country
 * @property string $journal_author_photo
 * @property string $journal_author_description
 * @property integer $journal_author_age
 * @property string $journal_author_job
 * @property string $journal_author_created_date
 * @property string $journal_author_modified_date
 * @property integer $journal_author_status
 */
class JournalAuthor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'journal_author';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['journal_author_name', 'journal_author_website', 'journal_author_phone', 'journal_author_country', 'journal_author_photo', 'journal_author_description', 'journal_author_age', 'journal_author_job', 'journal_author_created_date', 'journal_author_modified_date', 'journal_author_status'], 'required'],
//            [['journal_author_phone', 'journal_author_photo', 'journal_author_description', 'journal_author_job'], 'string'],
//            [['journal_author_age', 'journal_author_status'], 'integer'],
//            [['journal_author_created_date', 'journal_author_modified_date'], 'safe'],
//            [['journal_author_name', 'journal_author_website', 'journal_author_country'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'journal_author_id' => 'Journal Author ID',
            'journal_author_name' => 'Journal Author Name',
            'journal_author_website' => 'Journal Author Website',
            'journal_author_phone' => 'Journal Author Phone',
            'journal_author_country' => 'Journal Author Country',
            'journal_author_photo' => 'Journal Author Photo',
            'journal_author_description' => 'Journal Author Description',
            'journal_author_age' => 'Journal Author Age',
            'journal_author_job' => 'Journal Author Job',
            'journal_author_created_date' => 'Journal Author Created Date',
            'journal_author_modified_date' => 'Journal Author Modified Date',
            'journal_author_status' => 'Journal Author Status',
        ];
    }
    
    public function getJournal()
    {
        return $this->hasOne(Journal::className(), ['journal_author_id' => 'journal_author_id']);
    }
}
