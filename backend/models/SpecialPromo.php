<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "special_promo".
 *
 * @property int $special_promo_id
 * @property string $promo_name
 * @property int $payment_method_detail_id
 * @property int $promo_amount
 * @property string $date_from
 * @property string $date_to
 */
class SpecialPromo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'special_promo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        // return [
        //     [['promo_name', 'payment_method_detail_id', 'promo_amount', 'date_from', 'date_to'], 'required'],
        //     [['promo_name'], 'string'],
        //     [['payment_method_detail_id', 'promo_amount'], 'integer'],
        //     [['date_from', 'date_to'], 'safe'],
        // ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'special_promo_id' => 'Special Promo ID',
            'promo_name' => 'Promo Name',
            'payment_method_detail_id' => 'Payment Method Detail ID',
            'promo_amount' => 'Promo Amount',
            'date_from' => 'Date From',
            'date_to' => 'Date To',
        ];
    }
}
