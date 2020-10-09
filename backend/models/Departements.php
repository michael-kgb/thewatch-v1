<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "departements".
 *
 * @property integer $departement_id
 * @property string $departement_name
 * @property integer $branches_branch_id
 * @property integer $companies_company_id
 * @property string $departement_created_date
 * @property string $departement_status
 */
class Departements extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departements';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['departement_name', 'branches_branch_id', 'companies_company_id', 'departement_status'], 'required'],
            [['branches_branch_id', 'companies_company_id'], 'integer'],
            [['departement_created_date'], 'safe'],
            [['departement_status'], 'string'],
            [['departement_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'departement_id' => 'Departement ID',
            'departement_name' => 'Departement Name',
            'branches_branch_id' => 'Branches Branch ID',
            'companies_company_id' => 'Companies Company ID',
            'departement_created_date' => 'Departement Created Date',
            'departement_status' => 'Departement Status',
        ];
    }
}
