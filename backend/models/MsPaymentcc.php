<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ms_paymentcc".
 *
 * @property integer $id
 * @property string $merchantCode
 * @property integer $paymentId
 * @property string $refNo
 * @property string $transId
 * @property integer $amount
 * @property string $resp_amount
 * @property string $currency
 * @property string $prodDesc
 * @property string $userName
 * @property string $userContact
 * @property string $remark
 * @property string $signature
 * @property string $signature_respon_a
 * @property string $resp_signature
 * @property string $status
 * @property string $resp_status
 * @property string $resp_authCode
 * @property string $resp_desc
 * @property integer $sales_header_id
 * @property string $date_created
 * @property string $date_modified
 * @property string $status_auth_capture
 * @property string $signature_auth_capture
 * @property string $error_desc_capture
 */
class MsPaymentcc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ms_paymentcc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['merchantCode', 'paymentId', 'refNo', 'transId', 'amount', 'resp_amount', 'currency', 'prodDesc', 'userName', 'userContact', 'remark', 'signature', 'signature_respon_a', 'resp_signature', 'resp_status', 'resp_authCode', 'resp_desc', 'sales_header_id', 'date_modified', 'status_auth_capture', 'signature_auth_capture', 'error_desc_capture'], 'required'],
            // [['paymentId', 'amount', 'sales_header_id'], 'integer'],
            // [['date_created', 'date_modified'], 'safe'],
            // [['merchantCode', 'refNo', 'userContact', 'resp_authCode'], 'string', 'max' => 20],
            // [['transId', 'resp_amount', 'prodDesc', 'userName', 'remark', 'signature', 'signature_respon_a', 'resp_signature', 'resp_desc', 'signature_auth_capture', 'error_desc_capture'], 'string', 'max' => 100],
            // [['currency'], 'string', 'max' => 5],
            // [['status', 'resp_status', 'status_auth_capture'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'merchantCode' => 'Merchant Code',
            'paymentId' => 'Payment ID',
            'refNo' => 'Ref No',
            'transId' => 'Trans ID',
            'amount' => 'Amount',
            'resp_amount' => 'Resp Amount',
            'currency' => 'Currency',
            'prodDesc' => 'Prod Desc',
            'userName' => 'User Name',
            'userContact' => 'User Contact',
            'remark' => 'Remark',
            'signature' => 'Signature',
            'signature_respon_a' => 'Signature Respon A',
            'resp_signature' => 'Resp Signature',
            'status' => 'Status',
            'resp_status' => 'Resp Status',
            'resp_authCode' => 'Resp Auth Code',
            'resp_desc' => 'Resp Desc',
            'sales_header_id' => 'Sales Header ID',
            'date_created' => 'Date Created',
            'date_modified' => 'Date Modified',
            'status_auth_capture' => 'Status Auth Capture',
            'signature_auth_capture' => 'Signature Auth Capture',
            'error_desc_capture' => 'Error Desc Capture',
        ];
    }
}
