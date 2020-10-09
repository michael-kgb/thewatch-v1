<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "journal_image".
 *
 * @property string $journal_image_id
 * @property string $journal_id
 * @property string $orientation
 * @property integer $position
 * @property integer $small_cover
 * @property integer $big_cover
 */
class JournalImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'journal_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['journal_id', 'orientation', 'big_cover'], 'required'],
            [['journal_id', 'position', 'small_cover', 'big_cover'], 'integer'],
            [['orientation'], 'string'],
            //[['journal_id', 'small_cover'], 'unique', 'targetAttribute' => ['journal_id', 'small_cover'], 'message' => 'The combination of Journal ID and Small Cover has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'journal_image_id' => 'Journal Image ID',
            'journal_id' => 'Journal ID',
            'orientation' => 'Orientation',
            'position' => 'Position',
            'small_cover' => 'Small Cover',
            'big_cover' => 'Big Cover',
        ];
    }
    
    public function getJournal()
    {
        return $this->hasOne(Journal::className(), ['journal_id' => 'journal_id']);
    }
}
