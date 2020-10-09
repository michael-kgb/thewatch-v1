<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "invoice_reminder".
 *
 * @property integer $invoice_reminder_id
 * @property string $invoice_reminder_name
 * @property integer $invoice_reminder_day_to_send
 * @property string $invoice_reminder_subject
 * @property string $invoice_reminder_status
 */
class InvoiceReminder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_reminder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['invoice_reminder_name', 'invoice_reminder_day_to_send', 'invoice_reminder_subject'], 'required'],
            //[['invoice_reminder_day_to_send'], 'integer'],
            //[['invoice_reminder_subject', 'invoice_reminder_status'], 'string'],
            //[['invoice_reminder_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'invoice_reminder_id' => 'Invoice Reminder ID',
            'invoice_reminder_name' => 'Invoice Reminder Name',
            'invoice_reminder_day_to_send' => 'Invoice Reminder Day To Send',
            'invoice_reminder_subject' => 'Invoice Reminder Subject',
            'invoice_reminder_status' => 'Invoice Reminder Status',
        ];
    }
}
