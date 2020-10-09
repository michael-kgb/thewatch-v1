<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "permissions".
 *
 * @property integer $id
 * @property integer $group_id
 * @property integer $module_id
 * @property integer $view_access
 * @property integer $add_access
 * @property integer $update_access
 * @property integer $delete_access
 */
class ProductRating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['group_id', 'module_id', 'view_access', 'add_access', 'update_access', 'delete_access'], 'required'],
            //[['group_id', 'module_id', 'view_access', 'add_access', 'update_access', 'delete_access'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Group ID',
            'module_id' => 'Module ID',
            'view_access' => 'View Access',
            'add_access' => 'Add Access',
            'update_access' => 'Update Access',
            'delete_access' => 'Delete Access',
        ];
    }
	
    public function getQuestionnaireRespondent()
    {
        return $this->hasOne(QuestionnaireRespondent::className(), ['questionnaire_respondent_id' => 'questionnaire_respondent_id']);
    }
    
    public function getCustomeraddress()
    {
        return $this->hasOne(CustomerAddress::className(), ['customer_address_id' => 'customer_address_id']);
    }

}
