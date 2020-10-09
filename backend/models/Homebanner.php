<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "homebanner".
 *
 * @property integer $homebanner_id
 * @property string $homebanner_name
 * @property resource $homebanner_images
 * @property string $homebanner_description
 * @property string $homebanner_created_date
 * @property string $homebanner_status
 * @property integer $homebanner_sequence
 * @property integer $homebanner_has_link
 */
class Homebanner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'homebanner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['homebanner_name', 'homebanner_description', 'homebanner_status', 'homebanner_sequence','homebanner_has_link'], 'required'],
            [['homebanner_description', 'homebanner_status'], 'string'],
            [['homebanner_images','homebanner_images_mobile'], 'file', 'checkExtensionByMimeType'=>false, 'extensions' => ['gif', 'jpg', 'png', 'jpeg', 'JPG', 'JPEG', 'PNG', 'GIF']],
            [['homebanner_created_date'], 'safe'],
            [['homebanner_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'homebanner_id' => 'Homebanner ID',
            'homebanner_name' => 'Homebanner Name',
            'homebanner_images' => 'Homebanner Images (1140 x 575 pixels)',
            'homebanner_images_mobile' => 'Homebanner Images Mobile (600 x 720 pixels)',
            'homebanner_description' => 'Homebanner Landing Page',
            'homebanner_created_date' => 'Homebanner Created Date',
            'homebanner_status' => 'Homebanner Status',
            'homebanner_sequence' => 'Homebanner_Sequence',
            'homebanner_has_link' => 'Homebanner Has Link',
        ];
    }
    
}
