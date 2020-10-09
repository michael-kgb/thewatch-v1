<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "journal_related".
 *
 * @property integer $journal_related_id
 * @property integer $journal_parent_id
 * @property integer $journal_id
 */
class JournalRelated extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'journal_related';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['journal_parent_id', 'journal_id'], 'required'],
            [['journal_parent_id', 'journal_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'journal_related_id' => 'Journal Related ID',
            'journal_parent_id' => 'Journal Parent ID',
            'journal_id' => 'Journal ID',
        ];
    }
    
    public function getJournal()
    {
        return $this->hasOne(Journal::className(), ['journal_id' => 'journal_id']);
    }
}
