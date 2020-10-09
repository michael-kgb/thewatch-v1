<?php

namespace backend\models;

use Yii;
use \yii\db\Query;

/**
 * This is the model class for table "product_feature".
 *
 * @property integer $feature_id
 * @property integer $product_id
 * @property integer $feature_value_id
 */
class ProductFeature extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_feature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['feature_id', 'product_id', 'feature_value_id'], 'required'],
            [['feature_id', 'product_id', 'feature_value_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'feature_id' => 'Feature ID',
            'product_id' => 'Product ID',
            'feature_value_id' => 'Feature Value ID',
        ];
    }
    
    public function getProductFeatureValue(){
        return $this->hasOne(ProductFeatureValue::className(), ['feature_value_id' => 'feature_value_id']);
    }

    // public function getProductFeatureBy($product_id = 0)
    // {
    //     $query = new \yii\db\Query();
    //     if ( $product_id > 0 ) {
    //         $query->select(['f.feature_id', 'f.feature_name','pf.product_feature_id','pf.product_id','pd.name','pfv.feature_value_name'])
    //         //   ->alias('pf')
    //           ->from('product_feature as pf')
    //           ->innerJoin('product_detail as pd', 'pf.product_id = pd.product_id')
    //           ->innerJoin('feature as f', 'pf.feature_id = f.feature_id')
    //           ->innerJoin('product_feature_value as pfv', 'pf.feature_value_id = pfv.feature_value_id')
    //           ->innerJoin(['pf.product_id' => $product_id]);          
    //         $result = $query->all();
    //     } else {
    //         $result = array();
    //     }
    //     return $result;
    // }

    public function getProductFeatureBy($product_id)
    {
        if ( $product_id > 0 ) {
            $query = new Query;
            $query	->select(['feature.feature_id','feature.feature_name','product_feature.product_id',
                                'product_detail.name','product_feature_value.feature_value_name',
                                'product_feature_value.feature_value_value'])  
                    ->from('product_feature')
                    ->distinct()
                    ->innerJoin('product_detail', 'product_feature.product_id = product_detail.product_id') // we could choose whether using join or innerJoin
                    // ->leftJoin('product_detail', 'product_feature.product_id = product_detail.product_id')
                    ->join('INNER JOIN', 
                        'feature',
                        'product_feature.feature_id = feature.feature_id'
                    )
                    ->join('INNER JOIN', 
                        'product_feature_value',
                        'product_feature.feature_value_id = product_feature_value.feature_value_id'
                    )
                    // ->where(['product_feature.product_id' => (int) $product_id]);
                    ->where('product_feature.product_id=:id')->addParams([ // add bind param for more secure query
                        ':id' =>(int) $product_id
                    ]);
            $command = $query->createCommand();
            $result = $command->queryAll();
        } else {
            $result = array();
        }
        return $result;
    }
}
