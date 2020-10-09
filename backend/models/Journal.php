<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "journal".
 *
 * @property integer $journal_id
 * @property integer $journal_category_id
 * @property integer $journal_author_id
 * @property string $journal_created_date
 * @property string $journal_modified_date
 * @property integer $journal_status
 */
class Journal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'journal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['journal_category_id', 'journal_author_id', 'journal_created_date', 'journal_modified_date', 'journal_status'], 'required'],
            [['journal_category_id', 'journal_author_id', 'journal_status'], 'integer'],
            [['journal_created_date', 'journal_modified_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'journal_id' => 'Journal ID',
            'journal_category_id' => 'Journal Category ID',
            'journal_author_id' => 'Journal Author ID',
            'journal_created_date' => 'Journal Created Date',
            'journal_modified_date' => 'Journal Modified Date',
            'journal_status' => 'Journal Status',
        ];
    }
    
    public function getJournalDetail()
    {
        return $this->hasOne(JournalDetail::className(), ['journal_id' => 'journal_id']);
    }
    
    public function getJournalAuthor()
    {
        return $this->hasOne(JournalAuthor::className(), ['journal_author_id' => 'journal_author_id']);
    }
    
    public function getJournalCategory()
    {
        return $this->hasOne(JournalCategory::className(), ['journal_category_id' => 'journal_category_id']);
    }
    
    public function getJournalImage()
    {
        return $this->hasOne(JournalImage::className(), ['journal_id' => 'journal_id']);
    }
    
    public function getJournalRelated()
    {
        return $this->hasOne(JournalRelated::className(), ['journal_id' => 'journal_id']);
    }
}
