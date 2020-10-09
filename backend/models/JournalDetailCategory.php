<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "journal_detail_category".
 *
 * @property integer $journal_detail_category_id
 * @property integer $journal_category_id
 * @property integer $journal_detail_id
 */
class JournalDetailCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'journal_detail_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['journal_category_id', 'journal_detail_id'], 'required'],
            [['journal_category_id', 'journal_detail_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'journal_detail_category_id' => 'Journal Detail Category ID',
            'journal_category_id' => 'Journal Category ID',
            'journal_detail_id' => 'Journal Detail ID',
        ];
    }
    
    public function getJournalCategory()
    {
        return $this->hasOne(JournalCategory::className(), ['journal_category_id' => 'journal_category_id']);
    }
    
    public function getJournalDetail()
    {
        return $this->hasOne(JournalDetail::className(), ['journal_detail_id' => 'journal_detail_id']);
    }
}
