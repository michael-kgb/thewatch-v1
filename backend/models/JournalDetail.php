<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "journal_detail".
 *
 * @property integer $journal_detail_id
 * @property integer $journal_id
 * @property string $journal_detail_title
 * @property string $journal_detail_description
 * @property string $journal_detail_content1
 * @property string $journal_detail_content2
 */
class JournalDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'journal_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['journal_id', 'journal_detail_title', 'journal_detail_description', 'journal_detail_content1', 'journal_detail_content2'], 'required'],
//            [['journal_id'], 'integer'],
//            [['journal_detail_description', 'journal_detail_content1', 'journal_detail_content2'], 'string'],
//            [['journal_detail_title'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'journal_detail_id' => 'Journal Detail ID',
            'journal_id' => 'Journal ID',
            'journal_detail_title' => 'Journal Detail Title',
            'link_rewrite' => 'Journal Detail Link SEO',
            'journal_detail_description' => 'Journal Detail Description',
            'journal_detail_content1' => 'Journal Detail Content1',
            'journal_detail_content2' => 'Journal Detail Content2',
        ];
    }
    
    public function getJournal()
    {
        return $this->hasOne(Journal::className(), ['journal_id' => 'journal_id']);
    }
	
	public function getJournalDetailCategory()
    {
        return $this->hasOne(JournalDetailCategory::className(), ['journal_detail_id' => 'journal_detail_id']);
    }
}
