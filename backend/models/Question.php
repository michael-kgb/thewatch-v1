<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $question_id
 * @property integer $questionnaire_section_id
 * @property string $question_text
 * @property string $question_type
 * @property string $question_required
 * @property string $question_status
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_id', 'questionnaire_section_id', 'question_text', 'question_type', 'question_required', 'question_status'], 'required'],
            [['question_id', 'questionnaire_section_id'], 'integer'],
            [['question_text', 'question_type', 'question_required', 'question_status'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'question_id' => 'Question ID',
            'questionnaire_section_id' => 'Questionnaire Section ID',
            'question_text' => 'Question Text',
            'question_type' => 'Question Type',
            'question_required' => 'Question Required',
            'question_status' => 'Question Status',
        ];
    }
    
    public function getQuestionnaire()
    {
        return $this->hasOne(Questionnaire::className(), ['questionnaire_id' => 'questionnaire_id']);
    }
}
