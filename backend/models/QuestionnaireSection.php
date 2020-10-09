<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "questionnaire_section".
 *
 * @property integer $questionnaire_section_id
 * @property string $questionnaire_section_title
 * @property string $questionnaire_section_description
 */
class QuestionnaireSection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questionnaire_section';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['questionnaire_section_title', 'questionnaire_section_description'], 'required'],
            [['questionnaire_section_description'], 'string'],
            [['questionnaire_section_title'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'questionnaire_section_id' => 'Questionnaire Section ID',
            'questionnaire_section_title' => 'Questionnaire Section Title',
            'questionnaire_section_description' => 'Questionnaire Section Description',
        ];
    }
}
