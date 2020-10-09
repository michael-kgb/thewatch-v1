<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kontes_seo_content".
 *
 * @property integer $id
 * @property string $syarat_ketentuan
 * @property string $sistem_penilaian
 * @property string $kebutuhan
 * @property string $jadwal
 * @property string $juara1
 * @property string $juara2
 * @property string $juara3
 * @property string $juara4
 * @property string $juara11
 */
class KontesSeoContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kontes_seo_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'syarat_ketentuan', 'jadwal', 'sistem_penilaian', 'kebutuhan', 'juara1', 'juara2', 'juara3', 'juara4', 'juara11'], 'required'],
            [['id'], 'integer'],
            [['syarat_ketentuan', 'sistem_penilaian', 'kebutuhan', 'jadwal', 'juara1', 'juara2', 'juara3', 'juara4', 'juara11'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'syarat_ketentuan' => 'Syarat Ketentuan',
            'sistem_penilaian' => 'Sistem Penilaian',
			'jadwal' => 'jadwal',
            'kebutuhan' => 'Kebutuhan',
            'juara1' => 'Juara1',
            'juara2' => 'Juara2',
            'juara3' => 'Juara3',
            'juara4' => 'Juara4',
            'juara11' => 'Juara11',
        ];
    }
}
