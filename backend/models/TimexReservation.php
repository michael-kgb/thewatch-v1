<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "timex_reservation".
 *
 * @property integer $timex_reservation_id
 * @property string $timex_reservation_name
 * @property string $timex_reservation_phone
 * @property string $timex_reservation_email
 * @property string $timex_reservation_date
 */
class TimexReservation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'timex_reservation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['timex_reservation_name', 'timex_reservation_phone', 'timex_reservation_email', 'timex_reservation_date'], 'required'],
            [['timex_reservation_phone', 'timex_reservation_email'], 'string'],
            [['timex_reservation_date'], 'safe'],
            [['timex_reservation_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'timex_reservation_id' => 'Timex Reservation ID',
            'timex_reservation_name' => 'Timex Reservation Name',
            'timex_reservation_phone' => 'Timex Reservation Phone',
            'timex_reservation_email' => 'Timex Reservation Email',
            'timex_reservation_date' => 'Timex Reservation Date',
        ];
    }
}
