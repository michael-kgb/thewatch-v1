<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "questionnaire_respondent".
 *
 * @property integer $questionnaire_respondent_id
 * @property integer $questionnaire_id
 * @property integer $user_id
 */
class QuestionnaireRespondent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questionnaire_respondent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        // return [
        //     [['questionnaire_id', 'user_id'], 'required'],
        //     [['questionnaire_id', 'user_id'], 'integer'],
        // ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'questionnaire_respondent_id' => 'Questionnaire Respondent ID',
            'questionnaire_id' => 'Questionnaire ID',
            'customer_id' => 'User ID',
        ];
    }
    public function getCustomer(){
        return $this->hasOne(Customer::className(), ['customer_id' => 'customer_id']);
    }
    
    public function getAnswer()
    {
        return $this->hasMany(Answer::className(), ['questionnaire_respondent_id' => 'questionnaire_respondent_id']);
    }
    public function getAnswerOne()
    {
        return $this->hasOne(Answer::className(), ['questionnaire_respondent_id' => 'questionnaire_respondent_id']);
    }
}
