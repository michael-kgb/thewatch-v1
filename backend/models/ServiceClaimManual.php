<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "service_claim_manual".
 *
 * @property integer $service_claim_manual_id
 * @property integer $brand_id
 * @property integer $product_id
 * @property string $warranty_code
 * @property string $reference
 * @property string $reference_img
 * @property string $service_claim_manual_status
 */
class ServiceClaimManual extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_claim_manual';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['brand_id', 'product_id', 'warranty_code', 'reference', 'reference_img'], 'required'],
            //[['brand_id', 'product_id'], 'integer'],
            //[['warranty_code', 'reference_img', 'service_claim_manual_status'], 'string'],
            //[['reference'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_claim_manual_id' => 'Service Claim Manual ID',
            'brand_id' => 'Brand ID',
            'product_id' => 'Product ID',
            'warranty_code' => 'Warranty Code',
            'reference' => 'Reference',
            'reference_img' => 'Reference Img',
            'service_claim_manual_status' => 'Service Claim Manual Status',
        ];
    }
	
	public function getCustomer(){
        return $this->hasOne(Customer::className(), ['customer_id' => 'customer_id']);
    }
	
	public function getBrands(){
        return $this->hasOne(Brands::className(), ['brand_id' => 'brand_id']);
    }
	
	public function getProduct(){
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }
	
	public function getProductAttribute(){
        return $this->hasOne(ProductAttribute::className(), ['product_attribute_id' => 'product_attribute_id']);
    }
	
	public function getStores(){
		return $this->hasOne(Stores::className(), ['store_id' => 'store_id']);
	}
}
