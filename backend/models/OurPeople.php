<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "our_people".
 *
 * @property integer $our_people_id
 * @property string $our_people_name
 * @property string $our_people_profile_picture
 * @property string $our_people_short_description
 * @property integer $our_people_status
 */
class OurPeople extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'our_people';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['our_people_name', 'our_people_profile_picture', 'our_people_short_description', 'our_people_status'], 'required'],
//            [['our_people_profile_picture', 'our_people_short_description'], 'string'],
//            [['our_people_status'], 'integer'],
//            [['our_people_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'our_people_id' => 'Our People ID',
            'our_people_name' => 'Our People Name',
            'our_people_profile_picture' => 'Our People Profile Picture',
            'our_people_short_description' => 'Our People Short Description',
            'our_people_status' => 'Our People Status',
        ];
    }
}
