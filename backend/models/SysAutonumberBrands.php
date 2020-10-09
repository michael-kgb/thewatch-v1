<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_autonumber_brands".
 *
 * @property integer $sys_autonumber_brands_id
 * @property integer $brand_id
 * @property integer $sys_autonumber_id
 */
class SysAutonumberBrands extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_autonumber_brands';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['brand_id', 'sys_autonumber_id'], 'required'],
            //[['brand_id', 'sys_autonumber_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sys_autonumber_brands_id' => 'Sys Autonumber Brands ID',
            'brand_id' => 'Brand ID',
            'sys_autonumber_id' => 'Sys Autonumber ID',
        ];
    }
	
	public function getSysAutonumber()
    {
        return $this->hasOne(SysAutonumber::className(), ['sys_autonumber_id' => 'sys_autonumber_id']);
    }
}
