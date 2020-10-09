<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "answer".
 *
 * @property integer $answer_id
 * @property integer $questionnaire_respondent_id
 * @property integer $question_id
 * @property string $answer_text
 * @property integer $answer_choice_id
 * @property string $answer_date
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        // return [
        //     [['questionnaire_respondent_id', 'question_id', 'answer_text', 'answer_choice_id', 'answer_date'], 'required'],
        //     [['questionnaire_respondent_id', 'question_id', 'answer_choice_id'], 'integer'],
        //     [['answer_text'], 'string'],
        //     [['answer_date'], 'safe'],
        // ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'answer_id' => 'Answer ID',
            'questionnaire_respondent_id' => 'Questionnaire Respondent ID',
            'question_id' => 'Question ID',
            'answer_text' => 'Answer Text',
            'answer_choice_id' => 'Answer Choice ID',
            'answer_date' => 'Answer Date',
        ];
    }
    
    public function getQuestion(){
        return $this->hasOne(Question::className(), ['question_id' => 'question_id']);
    }
    
    public function getQuestionnaireRespondent(){
        return $this->hasOne(QuestionnaireRespondent::className(), ['questionnaire_respondent_id' => 'questionnaire_respondent_id']);
    }
}
