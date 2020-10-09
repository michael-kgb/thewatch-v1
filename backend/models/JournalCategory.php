<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "journal_category".
 *
 * @property integer $journal_category_id
 * @property string $journal_category_name
 * @property integer $journal_category_status
 * @property string $journal_category_date_created
 * @property string $journal_category_date_modified
 */
class JournalCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'journal_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['journal_category_name', 'journal_category_status'], 'required'],
            [['journal_category_status'], 'integer'],
            [['journal_category_date_created', 'journal_category_date_modified'], 'safe'],
            [['journal_category_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'journal_category_id' => 'Journal Category ID',
            'journal_category_name' => 'Journal Category Name',
            'journal_category_status' => 'Journal Category Status',
            'journal_category_date_created' => 'Journal Category Date Created',
            'journal_category_date_modified' => 'Journal Category Date Modified',
        ];
    }
    
    public function getJournal()
    {
        return $this->hasOne(Journal::className(), ['journal_category_id' => 'journal_category_id']);
    }
}
