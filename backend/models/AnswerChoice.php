<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "answer_choice".
 *
 * @property integer $answer_choice_id
 * @property integer $answer_id
 * @property integer $question_choice_id
 */
class AnswerChoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answer_choice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        // return [
        //     [['answer_choice_id', 'answer_id', 'question_choice_id'], 'required'],
        //     [['answer_choice_id', 'answer_id', 'question_choice_id'], 'integer'],
        // ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'answer_choice_id' => 'Answer Choice ID',
            'answer_id' => 'Answer ID',
            'question_choice_id' => 'Question Choice ID',
        ];
    }
}
