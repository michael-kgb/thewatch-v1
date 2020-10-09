<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "timex_ig".
 *
 * @property integer $timex_ig_id
 * @property string $timex_ig_img
 * @property string $timex_ig_link
 * @property integer $timex_ig_status
 */
class TimexIg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'timex_ig';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['timex_ig_img', 'timex_ig_link'], 'required'],
            [['timex_ig_img', 'timex_ig_link'], 'string'],
            [['timex_ig_status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'timex_ig_id' => 'Timex Ig ID',
            'timex_ig_img' => 'Timex Ig Img',
            'timex_ig_link' => 'Timex Ig Link',
            'timex_ig_status' => 'Timex Ig Status',
        ];
    }
}
