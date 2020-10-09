<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "question_choice".
 *
 * @property integer $question_choice_id
 * @property integer $question_id
 * @property string $question_text
 * @property integer $question_order
 */
class QuestionChoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question_choice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_id', 'question_text', 'question_order'], 'required'],
            [['question_id', 'question_order'], 'integer'],
            [['question_text'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'question_choice_id' => 'Question Choice ID',
            'question_id' => 'Question ID',
            'question_text' => 'Question Text',
            'question_order' => 'Question Order',
        ];
    }
}
