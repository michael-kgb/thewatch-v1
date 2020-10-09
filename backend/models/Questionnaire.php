<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "questionnaire".
 *
 * @property integer $questionnaire_id
 * @property string $questionnaire_title
 * @property string $questionnaire_name
 * @property string $questionnaire_date
 * @property integer $questionnaire_status
 */
class Questionnaire extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questionnaire';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['questionnaire_title', 'questionnaire_name', 'questionnaire_date', 'questionnaire_status'], 'required'],
            [['questionnaire_title'], 'string'],
            [['questionnaire_date'], 'safe'],
            [['questionnaire_status'], 'integer'],
            [['questionnaire_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'questionnaire_id' => 'Questionnaire ID',
            'questionnaire_title' => 'Questionnaire Title',
            'questionnaire_name' => 'Questionnaire Name',
            'questionnaire_date' => 'Questionnaire Date',
            'questionnaire_status' => 'Questionnaire Status',
        ];
    }
}
