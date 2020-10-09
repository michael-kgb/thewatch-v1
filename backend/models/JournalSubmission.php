<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "journal_submission".
 *
 * @property integer $journal_submission_id
 * @property string $journal_submission_name
 * @property string $journal_submission_email
 * @property string $journal_submission_phone
 * @property integer $journal_submission_category
 * @property string $journal_submission_material
 */
class JournalSubmission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'journal_submission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['journal_submission_name', 'journal_submission_email', 'journal_submission_phone', 'journal_submission_category', 'journal_submission_material'], 'required'],
//            [['journal_submission_phone'], 'string'],
//            [['journal_submission_category'], 'integer'],
//            [['journal_submission_name', 'journal_submission_email', 'journal_submission_material'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'journal_submission_id' => 'Journal Submission ID',
            'journal_submission_name' => 'Journal Submission Name',
            'journal_submission_email' => 'Journal Submission Email',
            'journal_submission_phone' => 'Journal Submission Phone',
            'journal_submission_category' => 'Journal Submission Category',
            'journal_submission_material' => 'Journal Submission Material',
        ];
    }
    
    public function getJournalCategory()
    {
        return $this->hasOne(JournalCategory::className(), ['journal_category_id' => 'journal_submission_category']);
    }
}
