<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "directors".
 *
 * @property integer $director_id
 * @property string $director_name
 * @property string $director_photo1
 * @property string $director_photo2
 * @property string $director_short_description
 * @property string $director_long_description
 * @property string $director_status
 * @property integer $director_sequence
 */
class Directors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'directors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['director_name', 'director_photo1', 'director_photo2', 'director_short_description', 'director_long_description', 'director_status', 'director_sequence'], 'required'],
            [['director_photo1', 'director_photo2', 'director_short_description', 'director_long_description', 'director_status'], 'string'],
            [['director_sequence'], 'integer'],
            [['director_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'director_id' => 'Director ID',
            'director_name' => 'Director Name',
            'director_photo1' => 'Director Photo1',
            'director_photo2' => 'Director Photo2',
            'director_short_description' => 'Director Short Description',
            'director_long_description' => 'Director Long Description',
            'director_status' => 'Director Status',
            'director_sequence' => 'Director Sequence',
        ];
    }
}
