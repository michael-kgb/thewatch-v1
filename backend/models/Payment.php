<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property integer $payment_id
 * @property string $name_bank
 * @property string $name_person
 * @property string $account_number
 * @property string $description
 * @property string $filename
 * @property string $date_created
 * @property string $date_modified
 * @property integer $active
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_bank', 'name_person', 'filename'], 'required'],
            [['description'], 'string'],
            [['date_created', 'date_modified'], 'safe'],
            [['active'], 'integer'],
            [['name_bank', 'name_person', 'account_number'], 'string', 'max' => 60],
            [['filename'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'payment_id' => 'Payment ID',
            'name_bank' => 'Name Bank',
            'name_person' => 'Name Person',
            'account_number' => 'Account Number',
            'description' => 'Description',
            'filename' => 'Filename',
            'date_created' => 'Date Created',
            'date_modified' => 'Date Modified',
            'active' => 'Active',
        ];
    }
}
