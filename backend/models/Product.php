<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $product_id
 * @property integer $suppliers_supplier_id
 * @property integer $brands_brand_id
 * @property integer $quantity
 * @property integer $minimal_quantity
 * @property string $price
 * @property string $width
 * @property string $height
 * @property string $depth
 * @property string $weight
 * @property integer $active
 * @property integer $available_for_order
 * @property string $available_date
 * @property string $product_condition
 * @property integer $show_price
 * @property string $visibility
 * @property string $date_created
 * @property string $date_updated
 * @property integer $disable_click
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brands_brand_id', 'product_category_id','brands_collection_id', 'price', 'width', 'height', 'weight'], 'required'],
            [['suppliers_supplier_id', 'brands_brand_id', 'product_sub_category_id', 'quantity', 'minimal_quantity', 'active', 'available_for_order', 'show_price', 'disable_click'], 'integer'],
            [['price', 'width', 'height', 'depth', 'weight'], 'number'],
            [['available_date', 'date_created', 'date_updated'], 'safe'],
            [['product_condition', 'visibility'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'suppliers_supplier_id' => 'Suppliers Supplier ID',
            'brands_brand_id' => 'Brands Brand ID',
            'quantity' => 'Quantity',
            'minimal_quantity' => 'Minimal Quantity',
            'price' => 'Price',
            'width' => 'Width',
            'height' => 'Height',
            'depth' => 'Depth',
            'weight' => 'Weight',
            'active' => 'Active',
            'available_for_order' => 'Available For Order',
            'available_date' => 'Available Date',
            'product_condition' => 'Product Condition',
            'show_price' => 'Show Price',
            'visibility' => 'Visibility',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'disable_click' => 'Disable Click'
        ];
    }
    
    public static function getTotalProductBestByFilterFeature($feature = array(), $brands = array(), $category, $price = array(), $prod = array(),$sub){
      $now = date('Y-m-d H:i:s');
      if(sizeof($brands == 0)){
        return self::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "productFeature",
                "productNewArrival",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
          //  ->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['product.product_id'=>$prod])
           // ->andWhere(['IN', 'product_feature.feature_value_id', $feature, false])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->andWhere(['<=', 'product_newarrival.product_newarrival_start_date',$now])
           ->andWhere(['>=', 'product_newarrival.product_newarrival_end_date',$now])
            ->orderBy('brands.brand_name ASC')
            ->all();
      }else{
        return self::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "productFeature",
                "productNewArrival",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
           ->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['product.product_id'=>$prod])
           // ->andWhere(['IN', 'product_feature.feature_value_id', $feature, false])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->andWhere(['<=', 'product_newarrival.product_newarrival_start_date',$now])
           ->andWhere(['>=', 'product_newarrival.product_newarrival_end_date',$now])
            ->orderBy('brands.brand_name ASC')
            ->all();
      }

    }
    
    public static function getTotalProductNewArrivalByFilterFeature($feature = array(), $brands = array(), $category, $price = array(), $prod = array(),$sub){
      $now = date('Y-m-d H:i:s');
      if(sizeof($brands == 0)){
        return self::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "productFeature",
                "productNewArrival",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
          //  ->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['product.product_id'=>$prod])
           // ->andWhere(['IN', 'product_feature.feature_value_id', $feature, false])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->andWhere(['<=', 'product_newarrival.product_newarrival_start_date',$now])
           ->andWhere(['>=', 'product_newarrival.product_newarrival_end_date',$now])
            ->orderBy('brands.brand_name ASC')
            ->all();
      }else{
        return self::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "productFeature",
                "productNewArrival",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
           ->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['product.product_id'=>$prod])
           // ->andWhere(['IN', 'product_feature.feature_value_id', $feature, false])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->andWhere(['<=', 'product_newarrival.product_newarrival_start_date',$now])
           ->andWhere(['>=', 'product_newarrival.product_newarrival_end_date',$now])
            ->orderBy('brands.brand_name ASC')
            ->all();
      }

    }
    
    public static function getTotalProductSaleByFilterFeature($feature = array(), $brands = array(), $category, $price = array(), $prod = array(),$sub){
        $now = date("Y-m-d H:i:s");
        if(sizeof($brands) != 0){
          return self::find()
       
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "productFeature",
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_id'=>$prod])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            //->andWhere(['IN', 'product_feature.feature_value_id', $feature])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->andWhere('product.product_id = specific_price.product_id')
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->orderBy('brands.brand_name ASC')
            ->all();
          }else{
            return self::find()
           
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "productFeature",
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            //->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_id'=>$prod])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            //->andWhere(['IN', 'product_feature.feature_value_id', $feature])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->andWhere('product.product_id = specific_price.product_id')
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->orderBy('brands.brand_name ASC')
            ->all();
          }
    }
    
    public static function getTotalProductByFilterFeature($feature = array(), $brands = array(), $category, $price = array(),$prod = array(),$sub){
      if(sizeof($brands)==0){
        return self::find()
            // ->offset($start)
            // ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "productFeature",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
          //  ->where(["in", "brands.link_rewrite", $brands])
            ->where(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['product.product_id'=>$prod])
            //->andWhere(['product_feature.feature_value_id'=> $feature])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->orderBy('brands.brand_name ASC')
            ->all();
      }else{
        return self::find()
            // ->offset($start)
            // ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "productFeature",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])

            ->where(['brands.link_rewrite'=> $brands])
            ->andWhere(['product.product_id'=>$prod])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            //->andWhere(['product_feature.feature_value_id'=> $feature])
            //->andWhere(['product_feature.feature_value_id'=> 12,'product_feature.feature_value_id'=> 7,'product_feature.feature_value_id'=> 13])//->andWhere(['product_feature.feature_value_id'=> 7])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            //->groupBy('product_feature.product_id')
            ->orderBy('brands.brand_name ASC')
            ->all();
      }
    }
    
   public static function getProductSaleByFilterFeature($feature = array(), $brands = array(), $category, $start, $limit, $price = array(),$prod = array(),$sort,$sub){
       $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
        $now = date("Y-m-d H:i:s");
        if(sizeof($brands) != 0){
          return self::find()
            ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
               
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['<>','brands.brand_id',48])
            ->andWhere(['product.product_id'=>$prod])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            //->andWhere(['IN', 'product_feature.feature_value_id', $feature])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->andWhere('product.product_id = specific_price.product_id')
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->orderBy($sortby)
            ->all();
          }else{
            return self::find()
            ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            //->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_id'=>$prod])
            ->andWhere(['<>','brands.brand_id',48])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            //->andWhere(['IN', 'product_feature.feature_value_id', $feature])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->andWhere('product.product_id = specific_price.product_id')
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->orderBy($sortby)
            ->all();
          }
        
    }
    
    public static function getProductBestByFilterFeature($feature = array(), $brands = array(), $category, $start, $limit, $price = array(), $prod = array(),$sort,$sub){
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
      $now = date('Y-m-d H:i:s');
      if(sizeof($brands) ==0){
        return self::find()
            ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
               "specificPrice",
                "productBestSeller",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            //->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['product.product_id'=>$prod])
           // ->andWhere(['IN', 'product_feature.feature_value_id', $feature])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->andWhere('product_bestseller.product_bestseller_start_date <= "'. $now . '"')
            ->andWhere('product_bestseller.product_bestseller_end_date > "'. $now . '"')
            ->orderBy($sortby)
            ->all();
      }else{
        return self::find()
            ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
               "specificPrice",
                "productBestSeller",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['product.product_id'=>$prod])
           // ->andWhere(['IN', 'product_feature.feature_value_id', $feature])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->andWhere('product_bestseller.product_bestseller_start_date <= "'. $now . '"')
            ->andWhere('product_bestseller.product_bestseller_end_date > "'. $now . '"')
            ->orderBy($sortby)
            ->all();
      }

    }
    
    public static function getProductNewArrivalByFilterFeature($feature = array(), $brands = array(), $category, $start, $limit, $price = array(), $prod = array(),$sort,$sub){
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
      $now = date('Y-m-d H:i:s');
      if(sizeof($brands) ==0){
        return self::find()
            ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
               "specificPrice",
                "productNewArrival",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            //->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['product.product_id'=>$prod])
           // ->andWhere(['IN', 'product_feature.feature_value_id', $feature])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->andWhere(['<=', 'product_newarrival.product_newarrival_start_date',$now])
           ->andWhere(['>=', 'product_newarrival.product_newarrival_end_date',$now])
            ->orderBy($sortby)
            ->all();
      }else{
        return self::find()
            ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
               "specificPrice",
                "productNewArrival",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['product.product_id'=>$prod])
           // ->andWhere(['IN', 'product_feature.feature_value_id', $feature])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->andWhere(['<=', 'product_newarrival.product_newarrival_start_date',$now])
           ->andWhere(['>=', 'product_newarrival.product_newarrival_end_date',$now])
            ->orderBy($sortby)
            ->all();
      }

    }

    public static function getProductByFilterFeature($feature = array(), $brands = array(), $category, $start, $limit, $price = array(),$prod = array(),$sort,$sub){
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
        $now = date("Y-m-d H:i:s");
        // echo $sortby;die();
        if($brands == []){
          return self::find()
              ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
              ->offset($start)
              ->limit($limit)
              ->joinWith([
                  "brands",
                  "productDetail",
                  "brandsCollection",
                  "specificPrice",
                  "productImage" => function ($query) {
                      $query->andWhere(['cover' => 1]);
                  }
              ])
            //  ->where(["in", "brands.link_rewrite", $brands])
              ->where(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
              ->andWhere(['product.product_id'=>$prod])
              //->andWhere(['product_feature.feature_value_id'=> $feature])
              ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
              ->orderBy($sortby)
              ->all();
        }else{
          return self::find()
              ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
              ->offset($start)
              ->limit($limit)
              ->joinWith([
                  "brands",
                  "productDetail",
                  "brandsCollection",
                  "specificPrice",
                  "productImage" => function ($query) {
                      $query->andWhere(['cover' => 1]);
                  }
              ])

              ->where(['brands.link_rewrite'=> $brands])
              ->andWhere(['product.product_id'=>$prod])
              ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
              //->andWhere(['product_feature.feature_value_id'=> $feature])
              //->andWhere(['product_feature.feature_value_id'=> 12,'product_feature.feature_value_id'=> 7,'product_feature.feature_value_id'=> 13])//->andWhere(['product_feature.feature_value_id'=> 7])
              ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
              //->groupBy('product_feature.product_id')
              ->orderBy($sortby)
              ->all();
        }

    }

    public static function getTotalProductBestByFilterBrands($brands = array(), $category, $price = array(),$now,$sub){
      if($brands == []){

            return self::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "productFeature",
                "productBestSeller",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            //->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            //->andWhere(['in', 'product_feature.feature_value_id', $size])
            ->andWhere('product_bestseller.product_bestseller_start_date <= "'. $now . '"')
            ->andWhere('product_bestseller.product_bestseller_end_date > "'. $now . '"')
            ->orderBy('brands.brand_name ASC')
            ->all();
        } else {
            return self::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "productBestSeller",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->andWhere('product_bestseller.product_bestseller_start_date <= "'. $now . '"')
            ->andWhere('product_bestseller.product_bestseller_end_date > "'. $now . '"')
            ->orderBy('brands.brand_name ASC')
            ->all();
        }


    }
    
    public static function getTotalProductNewArrivalByFilterBrands($brands = array(), $category, $price = array(),$now,$sub){
      if($brands == []){

            return self::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "productFeature",
                "productNewArrival",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            //->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            //->andWhere(['in', 'product_feature.feature_value_id', $size])
            ->andWhere(['<=', 'product_newarrival.product_newarrival_start_date',$now])
           ->andWhere(['>=', 'product_newarrival.product_newarrival_end_date',$now])
            ->orderBy('brands.brand_name ASC')
            ->all();
        } else {
            return self::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "productNewArrival",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->andWhere(['<=', 'product_newarrival.product_newarrival_start_date',$now])
           ->andWhere(['>=', 'product_newarrival.product_newarrival_end_date',$now])
            ->orderBy('brands.brand_name ASC')
            ->all();
        }


    }

    public static function getTotalProductSaleByFilterBrands($brands = array(), $category, $price = array(), $size = array(),$sub){
        $now = date("Y-m-d H:i:s");
        if($brands == []){
          if(count($size) > 0){

            return self::find()
         
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                "productFeature",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
           // ->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
           // ->andWhere(['in', 'product_feature.feature_value_id', $size])
            ->andWhere('product.product_id = specific_price.product_id')
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->orderBy('brands.brand_name ASC')
            ->all();
        } else {
            return self::find()
           
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            //->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->andWhere('product.product_id = specific_price.product_id')
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->orderBy('brands.brand_name ASC')
            ->all();
        }

        }else{

          if(count($size) > 0){

            return self::find()
            
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                "productFeature",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
           // ->andWhere(['in', 'product_feature.feature_value_id', $size])
            ->andWhere('product.product_id = specific_price.product_id')
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->orderBy('brands.brand_name ASC')
            ->all();
        } else {
            return self::find()
            
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->andWhere('product.product_id = specific_price.product_id')
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->orderBy('brands.brand_name ASC')
            ->all();
        }
      }
    }

     public static function getTotalProductByFilterBrands($brands = array(), $category, $price = array(),$sub){
      if($category == ''){
      $now = date("Y-m-d H:i:s");
          return self::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
        "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
      ->where('product.product_id = specific_price.product_id')
            ->andWhere(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => [5, 6, 7], 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
      ->andWhere('specific_price.from <= "'. $now . '"')
      ->andWhere('specific_price.to > "'. $now . '"')
            ->orderBy('brands.brand_name ASC')
            ->all();
        }else {
            return self::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->orderBy('brands.brand_name ASC')
            ->all();
        }
    }
    
    public static function getProductBestByFilterBrands($brands = array(), $category, $start, $limit, $price = array(), $sort,$sub){
        $sortby = 'brands.brand_name ASC';
      if($sort == 'price-high-to-low'){
        $sortby = 'priority DESC';
      }if($sort == 'price-low-to-high'){
        $sortby = 'priority ASC';
      }if($sort == 'none'){
        $sortby = 'brands.brand_name ASC';
      }
        $now = date("Y-m-d H:i:s");
        if($brands == []){

            return self::find()
             ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "productBestSeller",
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            //->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere('product_bestseller.product_bestseller_start_date <= "'. $now . '"')
            ->andWhere('product_bestseller.product_bestseller_end_date > "'. $now . '"')
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])

            ->orderBy($sortby)
            ->groupBy(['product_bestseller.product_id'])
            ->all();


        }else{



            return self::find()
             ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "productBestSeller",
                "brandsCollection",
                "specificPrice",

                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere('product_bestseller.product_bestseller_start_date <= "'. $now . '"')
            ->andWhere('product_bestseller.product_bestseller_end_date > "'. $now . '"')
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->orderBy($sortby)
            ->groupBy(['product_bestseller.product_id'])
            ->all();

      }
    }

    
    public static function getProductNewArrivalByFilterBrands($brands = array(), $category, $start, $limit, $price = array(), $now, $sort,$sub){
        $sortby = 'brands.brand_name ASC';
      if($sort == 'price-high-to-low'){
        $sortby = 'priority DESC';
      }if($sort == 'price-low-to-high'){
        $sortby = 'priority ASC';
      }if($sort == 'none'){
        $sortby = 'brands.brand_name ASC';
      }
        if(sizeof($brands) != 0){
            return self::find()
            ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                
                "productNewArrival",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            //->andWhere(['in', 'product_feature.feature_value_id', $size])
            ->andWhere(['<=', 'product_newarrival.product_newarrival_start_date',$now])
           ->andWhere(['>=', 'product_newarrival.product_newarrival_end_date',$now])
            ->orderBy($sortby)
            ->all();
        } else {
            return self::find()
            ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                "productNewArrival",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            //->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->andWhere(['<=', 'product_newarrival.product_newarrival_start_date',$now])
           ->andWhere(['>=', 'product_newarrival.product_newarrival_end_date',$now])
            ->orderBy($sortby)
            ->all();
        }
    }

    public static function getProductSaleByFilterBrands($brands = array(), $category, $start, $limit, $price = array(), $sort,$sub){
        $sortby = 'brands.brand_name ASC';
      if($sort == 'price-high-to-low'){
        $sortby = 'priority DESC';
      }if($sort == 'price-low-to-high'){
        $sortby = 'priority ASC';
      }if($sort == 'none'){
        $sortby = 'brands.brand_name ASC';
      }
        $now = date("Y-m-d H:i:s");
        if($brands == []){

            return self::find()
             ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            //->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['<>','brands.brand_id',48])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            // ->andWhere('product.product_id = specific_price.product_id')
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->orderBy($sortby)
            ->all();


        }else{


            return self::find()
             ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['<>','brands.brand_id',48])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            // ->andWhere('product.product_id = specific_price.product_id')
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->orderBy($sortby)
            ->all();

      }
    }

    public static function getProductByFilterBrands($brands = array(), $category, $start, $limit, $price = array(), $sort,$sub){
      $sortby = 'brands.brand_name ASC';
      if($sort == 'price-high-to-low'){
        $sortby = 'priority DESC';
      }if($sort == 'price-low-to-high'){
        $sortby = 'priority ASC';
      }if($sort == 'none'){
        $sortby = 'brands.brand_name ASC';
      }
      // echo $sortby;die();
      if($brands == []){
        if($category == ''){
      $now = date("Y-m-d H:i:s");
          return self::find()
            ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
      ->where('product.product_id = specific_price.product_id')
            //->andWhere(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => [5, 6, 7], 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
      ->andWhere('specific_price.from <= "'. $now . '"')
      ->andWhere('specific_price.to > "'. $now . '"')
            ->orderBy($sortby)
            ->all();
        } else {
          $now = date("Y-m-d H:i:s");
            return self::find()
            ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            //->where(["in", "brands.link_rewrite", $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->orderBy($sortby)
            ->all();
        }
      }
      else {
        if($category == ''){
      $now = date("Y-m-d H:i:s");
          return self::find()
            ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
      ->where('product.product_id = specific_price.product_id')
            ->andWhere(['brands.link_rewrite'=> $brands])
            ->andWhere(['product.product_category_id' => [5, 6, 7], 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
      ->andWhere('specific_price.from <= "'. $now . '"')
      ->andWhere('specific_price.to > "'. $now . '"')
            ->orderBy($sortby)
            ->all();
        } else {
          $now = date("Y-m-d H:i:s");
          // IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", product.price - (specific_price.reduction / 100) * product.price , (product.price)) as priority
            return self::find()
            ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(['brands.link_rewrite'=> $brands])
            ->andWhere(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['between', 'price', str_replace('.', '', $price[0]), str_replace('.', '', $price[1])])
            ->orderBy($sortby)
            ->all();
        }
      }
    }
    
    public static function getProductBestByFilter($category, $start, $limit,$sort,$sub){
    $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
        $now = date("Y-m-d H:i:s");
        return self::find()
            ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                "productBestSeller",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere('product_bestseller.product_bestseller_start_date <= "'. $now . '"')
            ->andWhere('product_bestseller.product_bestseller_end_date > "'. $now . '"')
            //->andWhere(['<>', 'product_newarrival.product_newarrival_start_date', ''])
            //->andWhere(['<>', 'product_newarrival.product_newarrival_end_date', ''])
            ->orderBy($sortby)
            ->groupBy(['product_bestseller.product_id'])
            ->all();
  }
  
  public static function getAllProductBestSeller($category, $start, $limit,$sub){
    $now = date("Y-m-d H:i:s");
    return self::find()
    ->offset($start)
    ->limit($limit)
    ->joinWith([
      "brands",
      "productDetail",
    //   "brandsCollection",
    //   "specificPrice",
      "productBestSeller",
      "productImage" => function ($query) {
        $query->andWhere(['cover' => 1]);
      }
    ])
    ->where(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
    ->andWhere('product_bestseller.product_bestseller_start_date <= "'. $now . '"')
    ->andWhere('product_bestseller.product_bestseller_end_date > "'. $now . '"')
    ->orderBy('product.product_id DESC')
    ->all();
  }
    
    public static function getProductNewArrivalByFilter($category, $start, $limit,$sort,$sub){
    $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
        $now = date("Y-m-d H:i:s");
        return self::find()
            ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                "productNewArrival",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
                  ->andWhere(['<=', 'product_newarrival.product_newarrival_start_date',$now])
           ->andWhere(['>=', 'product_newarrival.product_newarrival_end_date',$now])
            //->andWhere(['<>', 'product_newarrival.product_newarrival_start_date', ''])
            //->andWhere(['<>', 'product_newarrival.product_newarrival_end_date', ''])
            ->orderBy($sortby)
            ->all();
    }
	
	
	public static function getProductSaleAll($start, $limit,$sort,$sub){
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
        $now = date("Y-m-d H:i:s");
        return self::find()
            ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(['product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->andWhere('product.product_id = specific_price.product_id')
            ->orderBy($sortby)->all();
		
		
    }
	
	
public static function getCountProductSaleAll($start, $limit,$sort,$sub){
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
        $now = date("Y-m-d H:i:s");
        return self::find()
            ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(['product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->andWhere('product.product_id = specific_price.product_id')
            ->orderBy($sortby)->count();
		
		
    }

    public static function getProductSaleByFilter($category, $start, $limit,$sort,$sub){
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
        $now = date("Y-m-d H:i:s");
        return self::find()
            ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere(['<>','brands.brand_id',48])
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->andWhere('product.product_id = specific_price.product_id')
            ->orderBy($sortby)->all();
    }

    public static function getProductByFilter($category, $start, $limit,$sort,$sub){
        $sortby = 'product.date_updated DESC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'product_newarrival.product_newarrival_id DESC';
        }
		
        $now = date("Y-m-d H:i:s");
        return self::find()
            ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
				"productNewArrival",
                "brandsCollection",
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->orderBy($sortby)
            ->all();
    }

    public static function getTotalProductNewArrivalByFilter($category,$sub){
    $now = date("Y-m-d H:i:s");
        return self::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "productNewArrival",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
              ->andWhere(['<=', 'product_newarrival.product_newarrival_start_date',$now])
                 ->andWhere(['>=', 'product_newarrival.product_newarrival_end_date',$now])
            //->andWhere(['<>', 'product_newarrival.product_newarrival_start_date', ''])
            //->andWhere(['<>', 'product_newarrival.product_newarrival_end_date', ''])
            ->orderBy('product.product_id DESC')
            ->all();
    }
    
    public static function getTotalProductBestByFilter($category,$sub){
        $now = date("Y-m-d H:i:s");
        return self::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "productBestSeller",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere('product_bestseller.product_bestseller_start_date <= "'. $now . '"')
            ->andWhere('product_bestseller.product_bestseller_end_date > "'. $now . '"')
            ->orderBy('product.product_id DESC')
            ->all();
    }

    public static function getTotalProductSaleByFilter($category,$sub){
        $now = date("Y-m-d H:i:s");
        return self::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->andWhere('product.product_id = specific_price.product_id')
            ->orderBy('product.product_id DESC')
            ->all();
    }

    public static function getTotalProductByFilter($category,$sub){
        return self::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(['product.product_category_id' => $category->product_category_id, 'product.product_sub_category_id' => $sub, 'product.active' => 1])
            ->orderBy('product.product_id DESC')
            ->all();
    }
    
    public static function getAllProducts(){
        return self::find()
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "productImage",
                    "productCategory"
                ])
        ->where(['active' => 1])
                ->all();
    }

    public static function getProductsDetails($params = []){
        return self::find()
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    },
                ])
                ->where($params)
                ->orderBy('brands_collection.brands_sequence')
                ->all();
    }
    
    public static function getProductDetails($params = []){
        return self::find()
                ->with([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    },
                    "productCategory"
                ])
                ->where($params)
                ->one();
    }
    
    public static function getProductByCategory($params = [],$limit,$start,$sort){
    $now = date("Y-m-d H:i:s");
    $sortby = 'priority DESC';
      if($sort == 'price-high-to-low'){
        $sortby = 'priority DESC';
      }if($sort == 'price-low-to-high'){
        $sortby = 'priority ASC';
      }if($sort == 'none'){
        $sortby = 'priority DESC';
      }

      if($sort == 'none'){
        return self::find()
                ->select('*, IF(specfic_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", (product.product_sort * 2) , IF(product_newarrival.product_newarrival_start_date <= "'. $now . '" && product_newarrival.product_newarrival_end_date > "'. $now . '" , (product.product_sort * 3) , (product.product_sort))) as priority')
                ->joinWith([
                    "brands",
                    "productDetail",
                    "productNewArrival",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->offset($start)
                ->limit($limit)
                ->where($params)
                ->orderBy([
                          'priority' => SORT_DESC,
                          'brands_collection.brands_sequence'=>SORT_ASC])
                ->all();
        }else{
            return self::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->offset($start)
                ->limit($limit)
                ->where($params)
                ->orderBy($sortby)
                ->all();
        }
    }

    public static function getProductByCategorySort($params = [],$limit,$start,$sort){

      $now = date("Y-m-d H:i:s");
      $sortby = 'priority DESC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'product_newarrival.product_newarrival_end_date DESC';
        }

        $sortName = explode(" ", $sortby)[0];
      $sortOrder = explode(" ", $sortby)[1] === 'ASC' ? SORT_ASC : SORT_DESC;

      return self::find()
              ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
              ->joinWith([
                  "brands",
                  "productDetail",
                  "productNewArrival",
                  "brandsCollection",
                  "specificPrice",
                  "productImage" => function ($query) {
                      $query->andWhere(['cover' => 1]);
                  }
              ])
              ->offset($start)
              ->limit($limit)
              ->where($params)
              ->orderBy([
                $sortName => $sortOrder
                ])
              ->all();
         
      }

    public static function getProductByCategoryPrice($params = [],$bellow_price,$above_price,$limit,$start,$sort){
        $now = date("Y-m-d H:i:s");
        $sortby = 'brands_collection.brands_sequence ASC';
      if($sort == 'price-high-to-low'){
        $sortby = 'priority DESC';
      }if($sort == 'price-low-to-high'){
        $sortby = 'priority ASC';
      }if($sort == 'none'){
        $sortby = 'brands_collection.brands_sequence ASC';
      }
        return self::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->offset($start)
                ->limit($limit)
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where($params)
                ->andWhere(['between', 'price', str_replace('.', '', $bellow_price), str_replace('.', '', $above_price)])
                ->orderBy($sortby)
                ->all();
    }

    public static function getProductByCategoryPriceSort($params = [],$bellow_price,$above_price,$limit,$start,$sort){
      $now = date("Y-m-d H:i:s");
      $sortby = 'brands_collection.brands_sequence ASC';
    if($sort == 'price-high-to-low'){
      $sortby = 'priority DESC';
    }if($sort == 'price-low-to-high'){
      $sortby = 'priority ASC';
    }if($sort == 'none'){
      $sortby = 'brands_collection.brands_sequence ASC';
    }

      $sortName = explode(" ", $sortby)[0];
      $sortOrder = explode(" ", $sortby)[1] === 'ASC' ? SORT_ASC : SORT_DESC;

      return self::find()
              ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
              ->offset($start)
              ->limit($limit)
              ->joinWith([
                  "brands",
                  "productDetail",
                  "brandsCollection",
                  "specificPrice",
                  "productNewArrival",
                  "productImage" => function ($query) {
                      $query->andWhere(['cover' => 1]);
                  }
              ])
              ->where($params)
              ->andWhere(['between', 'price', str_replace('.', '', $bellow_price), str_replace('.', '', $above_price)])
              ->orderBy([
                $sortName => $sortOrder,
                'product_newarrival.product_newarrival_end_date' => SORT_DESC
                ])
              ->all();
        

  }


    public static function getProductByCategoryTotal($params = []){
        return self::find()
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where($params)
                ->orderBy('brands_collection.brands_sequence')
                ->all();
    }

    public static function getProductByCategoryPriceTotal($params = [],$bellow_price,$above_price){
        $now = date("Y-m-d H:i:s");
        return self::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where($params)
                ->andWhere(['between', 'price', str_replace('.', '', $bellow_price), str_replace('.', '', $above_price)])
                ->orderBy('brands_collection.brands_sequence')
                ->all();
    }
    
    
    public static function getProductByCategoryPromo($params = []){
 
        $now = date("Y-m-d H:i:s");
        return self::find()
              
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where($params)
                // ->andWhere('specific_price.from <= "'. $now . '"')
                // ->andWhere('specific_price.to > "'. $now . '"')
                ->orderBy($sortby)
                ->all();
    }

    public static function getProductByCategoryPricePromo($params = [],$bellow_price,$above_price){
  

        $now = date("Y-m-d H:i:s");
        return self::find()
                    ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where($params)
                ->andWhere(['between', 'price', str_replace('.', '', $bellow_price), str_replace('.', '', $above_price)])
                // ->andWhere('specific_price.from <= "'. $now . '"')
                // ->andWhere('specific_price.to > "'. $now . '"')
                ->orderBy($sortby)
                ->all();
    }

    public static function getProductByCategoryPromoPageSort($params = [],$page,$limit,$sort){
      $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'product.product_sort ASC';
        }if($sort == 'product_sort'){
          $sortby = 'product.product_sort ASC';
        }
		
		

      $now = date("Y-m-d H:i:s");
      $sortName = explode(" ", $sortby)[0];
      $sortOrder = explode(" ", $sortby)[1] === 'ASC' ? SORT_ASC : SORT_DESC;

      return self::find()
              ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
              ->offset($page)
              ->limit($limit)
              ->joinWith([
                  "brands",
                  "productDetail",
                  "brandsCollection",
                  "specificPrice",
                  "productNewArrival",
                  "productImage" => function ($query) {
                      $query->andWhere(['cover' => 1]);
                  }
              ])
              ->where($params)
              // ->andWhere('specific_price.from <= "'. $now . '"')
              // ->andWhere('specific_price.to > "'. $now . '"')
              ->orderBy([
                $sortName => $sortOrder,
                'product_newarrival.product_newarrival_end_date' => SORT_DESC
                ])
              ->all();
  }

    public static function getProductByCategoryPromoPage($params = [],$page,$limit,$sort){
        $sortby = 'brands.brand_sequence ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_sequence ASC';
        }
		
		
		
		
        $now = date("Y-m-d H:i:s");
        return self::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where($params)
                // ->andWhere('specific_price.from <= "'. $now . '"')
                // ->andWhere('specific_price.to > "'. $now . '"')
                ->orderBy($sortby)
                ->all();
    }

    public static function getProductByCategoryPricePromoPage($params = [],$bellow_price,$above_price,$page,$limit,$sort){
        // $sortby = 'brands.brand_name ASC';
        // if($sort == 'price-high-to-low'){
          // $sortby = 'priority DESC';
        // }if($sort == 'price-low-to-high'){
          // $sortby = 'priority ASC';
        // }if($sort == 'none'){
          // $sortby = 'priority ASC';
        // }if($sort == 'product_sort'){
          // $sortby = 'product_sort ASC';
        // }
		
		$sortby = 'product.product_sort ASC, product_stock.quantity DESC';
		if($sort == 'price-high-to-low'){
			$sortby = 'priority DESC, product_stock.quantity DESC';
		}if($sort == 'price-low-to-high'){
			$sortby = 'priority ASC, product_stock.quantity DESC';
		}if($sort == 'none'){
			$sortby = 'product.product_sort ASC, product_stock.quantity DESC';
		}if($sort == 'product_sort'){
			// $sortby = 'product.product_sort ASC';
			// $sortby = 'product.product_sort ASC, product_stock.quantity DESC';
			$sortby = 'priority DESC, product_stock.quantity DESC';
		}

        $now = date("Y-m-d H:i:s");
        return self::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productStock",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where($params)
                ->andWhere(['between', 'price', str_replace('.', '', $bellow_price), str_replace('.', '', $above_price)])
                // ->andWhere('specific_price.from <= "'. $now . '"')
                // ->andWhere('specific_price.to > "'. $now . '"')
                ->orderBy($sortby)
                ->all();
    }

    public static function getProductByCategoryPricePromoPageSort($params = [],$bellow_price,$above_price,$page,$limit,$sort)
	{
      $sortby = 'product.product_sort ASC, product_stock.quantity DESC';
      if($sort == 'price-high-to-low'){
        $sortby = 'priority DESC, product_stock.quantity DESC';
      }if($sort == 'price-low-to-high'){
        $sortby = 'priority ASC, product_stock.quantity DESC';
      }if($sort == 'none'){
        $sortby = 'product.product_sort ASC, product_stock.quantity DESC';
      }if($sort == 'product_sort'){
        // $sortby = 'product.product_sort ASC';
        $sortby = 'product.product_sort ASC, product_stock.quantity DESC';
      }

      $now = date("Y-m-d H:i:s");
      $data = self::find()
      ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
      ->offset($page)
      ->joinWith([
          "brands",
          "productDetail",
          "brandsCollection",
          "specificPrice",
          "productNewArrival",
          "productStock",
          "productImage" => function ($query) {
              $query->andWhere(['cover' => 1]);
          }
      ])
      ->where($params)
      ->andWhere(['between', 'price', str_replace('.', '', $bellow_price), str_replace('.', '', $above_price)])
      // ->andWhere('specific_price.from <= "'. $now . '"')
      // ->andWhere('specific_price.to > "'. $now . '"')
      ->orderBy($sortby)
      ->all();

      return $data;
  }

  public static function getProductByCategoryPricePromoPageSortLimit($params = [],$bellow_price,$above_price,$page,$limit,$sort){
      
	$sortby = 'product.product_sort ASC, product_stock.quantity DESC';
	if($sort == 'price-high-to-low'){
		$sortby = 'priority DESC, product_stock.quantity DESC';
	}if($sort == 'price-low-to-high'){
		$sortby = 'priority ASC, product_stock.quantity DESC';
	}if($sort == 'none'){
		$sortby = 'product.product_sort ASC, product_stock.quantity DESC';
	}if($sort == 'product_sort'){
		// $sortby = 'product.product_sort ASC';
		$sortby = 'product.product_sort ASC, product_stock.quantity DESC';
	}
	
    $now = date("Y-m-d H:i:s");
    $data = self::find()
    ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
    ->offset($page)
    ->limit($limit)
    ->joinWith([
        "brands",
        "productDetail",
        "brandsCollection",
        "specificPrice",
        "productNewArrival",
        "productImage" => function ($query) {
            $query->andWhere(['cover' => 1]);
        }
    ])
    ->where($params)
    ->andWhere(['between', 'price', str_replace('.', '', $bellow_price), str_replace('.', '', $above_price)])
    // ->andWhere('specific_price.from <= "'. $now . '"')
    // ->andWhere('specific_price.to > "'. $now . '"')
    ->orderBy($sortby)
    ->all();

    return $data;
}
    
    public static function getProductByCategoryPromoPageNoSpecPrice($params = [],$page,$limit,$sort){
        $sortby = 'brands.brand_promo_sequence DESC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          // $sortby = 'brands.brand_name ASC';
          $sortby = 'product.product_sort ASC, product_stock.quantity DESC';
          // $sortby = 'brands.brand_name RAND()';
        }
        $now = date("Y-m-d H:i:s");
        return self::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                    "brands",
                    "productDetail",
                    "productStock",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where($params)

                ->orderBy($sortby)
                ->all();
    }

    public static function getProductByCategoryPricePromoPageNoSpecPrice($params = [],$bellow_price,$above_price,$page,$limit,$sort){
        $sortby = 'brands.brand_promo_sequence DESC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          // $sortby = 'brands.brand_name ASC';
          $sortby = 'product.product_sort ASC, product_stock.quantity DESC';
          // $sortby = 'brands.brand_name RAND()';
        }

        $now = date("Y-m-d H:i:s");
        return self::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                    "brands",
                    "productDetail",
                    "productStock",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where($params)
                ->andWhere(['between', 'price', str_replace('.', '', $bellow_price), str_replace('.', '', $above_price)])
                
                ->orderBy($sortby)
                ->all();
    }
	
	/*Hafiizh Eko M*/	
	public static function getProductCustomForFlashSale($params = [],$page,$limit,$sort){
        $sortby = 'brands.brand_promo_sequence DESC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          // $sortby = 'brands.brand_name ASC';
          $sortby = 'product.product_sort ASC, product_stock.quantity DESC';
          // $sortby = 'brands.brand_name RAND()';
        }

        $now = date("Y-m-d H:i:s");
        return self::find()
                ->select('*, IF(specific_price.from <= "2019-11-11 00:00:00" && specific_price.to > "2019-11-13 59:59:00", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                    "brands",
                    "productDetail",
                    "productStock",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where($params)
                ->orderBy('specific_price.to ASC')
                ->all();
    }
	
	/*Hafiizh Eko M*/	
	public static function getProductForFlashSale($params = [],$page,$limit,$sort){
        $sortby = 'brands.brand_promo_sequence DESC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          // $sortby = 'brands.brand_name ASC';
          $sortby = 'specific_price.from ASC';
          // $sortby = 'brands.brand_name RAND()';
        }

        $now = date("Y-m-d H:i:s");
        return self::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                    "brands",
                    "productDetail",
                    "productStock",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where($params)
                ->orderBy($sortby)
                ->all();
    }
	
	/*Hafiizh Eko M*/	
	public static function getProductForFlashSaleQuery($params = [],$page,$limit,$sort){
        $sortby = 'brands.brand_promo_sequence DESC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          // $sortby = 'brands.brand_name ASC';
          $sortby = 'specific_price.from ASC';
          // $sortby = 'brands.brand_name RAND()';
        }

        $now = date("Y-m-d H:i:s");
        $query = self::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                    "brands",
                    "productDetail",
                    "productStock",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where($params)
                ->orderBy($sortby);
		return $query->createCommand()->getRawSql();
		
    }

    public static function getProductByCategoryPromoNoSpecPrice($params = []){
        $sortby = 'brands.brand_promo_sequence DESC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_promo_sequence DESC';
        }
        $now = date("Y-m-d H:i:s");
        return self::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where($params)

                ->orderBy($sortby)
                ->all();
    }

    public static function getProductByCategoryPricePromoNoSpecPrice($params = [],$bellow_price,$above_price){
        $sortby = 'brands.brand_promo_sequence DESC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_promo_sequence DESC';
        }

        $now = date("Y-m-d H:i:s");
        return self::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where($params)
                ->andWhere(['between', 'price', str_replace('.', '', $bellow_price), str_replace('.', '', $above_price)])
                
                ->orderBy($sortby)
                ->all();
    }
	
	public static function getProductSale($brands = array(), $category = array(), $start_date, $end_date, $product = array(), $limit, $sortby){
		if(empty($sortby)){
			$sort = "RAND()";
		}
		
		
		
		$query = self::find()
					->select('*')
					// ->offset($start)
					->limit($limit)
					->joinWith([
						"productCategory",
						"brands",
						"productDetail",
						"brandsCollection",
						"specificPrice",
						"productImage" => function ($query) {
							$query->andWhere(['cover' => 1]);
						}
					])
					->where('specific_price.from BETWEEN "'. $start_date . '" AND "'. $end_date . '"')
					->andWhere('specific_price.to BETWEEN "'. $start_date . '" AND "'. $end_date . '"');
					// ->orWhere('NOW() BETWEEN specific_price.from AND specific_price.to');
		
        if(sizeof($brands) != 0){
			$query->andWhere(["in", "brands.link_rewrite", $brands]);
		}
		if(sizeof($category) != 0){
			$query->andWhere(["in", "product_category.product_category_name", $category]);
		}
		if(sizeof($product) != 0){
			$query->andWhere(["in", "product.product_id", $product]);
		}
		$query->orderBy($sort);
		$result = $query->all();
		#echo $query->createCommand()->getRawSql(); exit();
		#var_dump($result);exit();
		return $result;
	}
	
	public static function getCountProductSale($brands = array(), $category = array(), $curr_date, $product = array()){
		// $query = self::find()
					// ->joinWith([
						// "productCategory",
						// "brands",
						// "productDetail",
						// "brandsCollection",
						// "specificPrice",
						// "productImage" => function ($query) {
							// $query->andWhere(['cover' => 1]);
						// }
					// ])
					// ->where('specific_price.from <= "'. $curr_date . '"')
					// ->andWhere('specific_price.to > "'. $curr_date . '"');
					
		$query = self::find()
					->joinWith([
						"specificPrice"
					])
					->where('specific_price.from <= "'. $curr_date . '"')
					->andWhere('specific_price.to > "'. $curr_date . '"');
		
        // if(sizeof($brands) != 0){
			// $query->andWhere(["in", "brands.link_rewrite", $brands]);
		// }
		// elseif(sizeof($category) != 0){
			// $query->andWhere(["in", "product_category.product_category_name", $category]);
		// }
		// elseif(sizeof($product) != 0){
			// $query->andWhere(["in", "product.product_id", $product]);
		// }
		$result = $query->count();
		return $result;
	}
	
	public static function getProductFlashSale($brands = array(), $category = array(), $current_date, $product = array(), $start, $limit, $sortby){
		if(empty($sortby)){
			// $sort = "RAND()";
			$sort = "brands.brand_name ASC, specific_price.flash_sale_qty DESC";
		}
		$query = self::find()
					->select('*, IF(specific_price.from <= "'. $current_date . '" && specific_price.to > "'. $current_date . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
					->offset($start)
					->limit($limit)
					->joinWith([
						"productCategory",
						"brands",
						"productDetail",
						"brandsCollection",
						"specificPrice",
						"productImage" => function ($query) {
							$query->andWhere(['cover' => 1]);
						}
					])
					->where(['specific_price.is_flash_sale'=>1])
					->andWhere('product.active = 1');
					// ->where(['specific_price.is_flash_sale'=>0]); //for testing query
		
        if(sizeof($brands) != 0){
			$query->andWhere(["in", "brands.link_rewrite", $brands]);
		}
		if(sizeof($category) != 0){
			$query->andWhere(["in", "product_category.product_category_name", $category]);
		}
		if(sizeof($product) != 0){
			$query->andWhere(["in", "product.product_id", $product]);
		}
		$query->orderBy($sort);
		$result = $query->all();
		return $result;
    }

    public static function getProductFlashSaleBefore($brands = array(), $category = array(), $start_date, $end_date, $product = array(), $start, $limit, $sortby){
		if(empty($sortby)){
			// $sort = "RAND()";
			$sort = "brands.brand_name ASC, specific_price.flash_sale_qty DESC";
		}
		$query = self::find()
					->select('*')
					->offset($start)
					->limit($limit)
					->joinWith([
						"productCategory",
						"brands",
						"productDetail",
						"brandsCollection",
						"specificPrice",
						"productImage" => function ($query) {
							$query->andWhere(['cover' => 1]);
						}
					])
					->where(['specific_price.is_flash_sale'=>1])
					->andWhere('product.active = 1')
					->andWhere('specific_price.from BETWEEN "'.$start_date.'" AND "'.$end_date.'" ')
					->andWhere('specific_price.to BETWEEN "'.$start_date.'" AND "'.$end_date.'" ');
					// ->where(['specific_price.is_flash_sale'=>0]); //for testing query
		
        if(sizeof($brands) != 0){
			$query->andWhere(["in", "brands.link_rewrite", $brands]);
		}
		if(sizeof($category) != 0){
			$query->andWhere(["in", "product_category.product_category_name", $category]);
		}
		if(sizeof($product) != 0){
			$query->andWhere(["in", "product.product_id", $product]);
		}
		$query->orderBy($sort);
		$result = $query->all();
		return $result;
    }
    
    public static function getProductFlashSaleCurrent($brands = array(), $category = array(), $current_date, $product = array(), $start, $limit, $sortby){
		if(empty($sortby)){
			// $sort = "RAND()";
			$sort = "specific_price.from ASC";
		}
		$query = self::find()
					->select('*')
					->offset($start)
					->limit($limit)
					->joinWith([
						"productCategory",
						"brands",
						"productDetail",
						"brandsCollection",
						"specificPrice",
						"productImage" => function ($query) {
							$query->andWhere(['cover' => 1]);
						}
					])
					->where(['specific_price.is_flash_sale'=>1])
					->andWhere('product.active = 1')
					->andWhere('specific_price.from >= "2019-01-25 11:00:00"')
					->andWhere('specific_price.to < "2019-01-25 14:00:00"');
					// ->where(['specific_price.is_flash_sale'=>0]); //for testing query
		
        if(sizeof($brands) != 0){
			$query->andWhere(["in", "brands.link_rewrite", $brands]);
		}
		if(sizeof($category) != 0){
			$query->andWhere(["in", "product_category.product_category_name", $category]);
		}
		if(sizeof($product) != 0){
			$query->andWhere(["in", "product.product_id", $product]);
		}
		$query->orderBy($sort);
		$result = $query->all();
		return $result;
    }
    
    public static function getProductFlashSaleNew($brands = array(), $category = array(), $start_date, $end_date, $product = array(), $start, $limit, $sort){

		if(empty($sort)){
			// $sort = "RAND()";
			// $sort = "brands.brand_name ASC, specific_price.flash_sale_qty DESC";
			// $sortby = "brands.brand_name ASC, specific_price.flash_sale_qty DESC";
			$sortby = "priority ASC";
		}else{
            if($sort == 'price-high-to-low'){
                $sortby = 'priority DESC';
            }if($sort == 'price-low-to-high'){
                $sortby = 'priority ASC';
            }if($sort == 'none'){
                // $sortby = 'product.product_category_id ASC';
                $sortby = 'brands.brand_sequence, priority ASC';
            }
        }
		$query = self::find()
					->select('*, IF(specific_price.from <= CURDATE() && specific_price.to > CURDATE(), IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
					->offset($start)
					->limit($limit)
					->joinWith([
						"productCategory",
						"brands",
						"productDetail",
						// "brandsCollection",
						"specificPrice",
						"productImage" => function ($query) {
							$query->andWhere(['cover' => 1]);
						}
					])
					->where(['specific_price.is_flash_sale'=>1])
					// ->where(['specific_price.is_flash_sale'=>0]) //for testing query
                    
                     ->andWhere('specific_price.from BETWEEN "'.$start_date.'" AND "'.$end_date.'"')
                     ->andWhere('specific_price.to BETWEEN "'.$start_date.'" AND "'.$end_date.'"')
					 ->andWhere('product.active = 1');
                    // ->andWhere('NOW() BETWEEN specific_price.from AND specific_price.to');
                    if(sizeof($brands) != 0){
                        $query->andWhere(["in", "brands.link_rewrite", $brands]);
                    }
                    if(sizeof($category) != 0){
                        $query->andWhere(["in", "product_category.product_category_name", $category]);
                    }
                    if(sizeof($product) != 0){
                        $query->andWhere(["in", "product.product_id", $product]);
                    }
		$query->orderBy($sortby);
		$result = $query->all();
		return $result;
	}
	
	public static function getCountProductFlashSale($brands = array(), $category = array(), $start_date, $end_date, $product = array()){
		$query = self::find()
                    ->joinWith([
                        "productCategory",
                        "brands",
                        "productDetail",
                        // "brandsCollection",
                        "specificPrice",
                        "productImage" => function ($query) {
                            $query->andWhere(['cover' => 1]);
                        }
                    ])
                    ->where(['specific_price.is_flash_sale'=>1])
                    // ->where(['specific_price.is_flash_sale'=>0]) //for testing query
                    ->andWhere('product.active = 1')
                    ->andWhere('specific_price.from BETWEEN "'.$start_date.'" AND "'.$end_date.'"')
                    ->andWhere('specific_price.to BETWEEN "'.$start_date.'" AND "'.$end_date.'"');
                    if(sizeof($brands) != 0){
                        $query->andWhere(["in", "brands.link_rewrite", $brands]);
                    }
                    if(sizeof($category) != 0){
                        $query->andWhere(["in", "product_category.product_category_name", $category]);
                    }
                    if(sizeof($product) != 0){
                        $query->andWhere(["in", "product.product_id", $product]);
                    }
		$result = $query->count();
		return $result;
  }

  public function getProductLists2($brands = array())
  {
      // if($sort == 'price-high-to-low'){
      //   $sortby = 'priority DESC';
      // }elseif($sort == 'price-low-to-high'){
      //   $sortby = 'priority ASC';
      // }elseif($sort == 'product_sort'){
      //   $sortby = 'product.product_sort ASC';
      // }else{
      //   $sortby = 'product.product_sort ASC';
      // }

      $query = self::find()
          ->alias('p')
          ->select('*')
          // ->joinWith('product_detail pd', true, 'INNER JOIN')
          // ->joinWith('product_category pc', true, 'INNER JOIN')
          ->joinWith('brands b', true, 'INNER JOIN')
          // ->joinWith('product_newarrival pna', true, 'LEFT JOIN')
          // ->joinWith('specific_price sp', true, 'LEFT JOIN')
					// ->offset($page)
					// ->limit($limit)
					// ->joinWith([
					// 	"productDetail pd",
					// 	"productCategory pc",
					// 	"brands b",
					// 	"productNewArrival pna",
					// 	"specificPrice sp"
					// ])
          ->where('p.active = 1');
        
        if(sizeof($brands) !== 0){
          $query->andWhere(["in", "b.link_rewrite", $brands]);
        }
        // if(sizeof($categories) !== 0){
        //   $query->andWhere(["in", "pc.product_category_name", $categories]);
        // }
        // if(sizeof($products) !== 0){
        //   $query->andWhere(["in", "product.product_id", $products]);
        // }
        // if($is_discount !== 0){
        //   $query->andWhere('sp.from <= "'. $current_date . '"');
        //   $query->andWhere('sp.to > "'. $current_date . '"');
        // }
        // if($is_new_arrival !== 0){
        //   $query->andWhere('pna.product_newarrival_start_date <= "'. $current_date . '"');
        //   $query->andWhere('pna.product_newarrival_end_date > "'. $current_date . '"');
        // }
        // $query->andWhere(['sp.is_flash_sale' => $is_flash_sale]);
        // $query->orderBy($sortby);
        $result = $query->all();

        var_dump($result);exit();

        // return $result;
    }
  
    public function getProductLists($brands = array(), $categories = array(), $products = array(), $is_discount, $is_new_arrival, $is_flash_sale, $current_date, $page, $limit, $sort)
    {
      if($sort == 'price-high-to-low'){
        $sortby = 'priority DESC';
      }elseif($sort == 'price-low-to-high'){
        $sortby = 'priority ASC';
      }elseif($sort == 'product_sort'){
        $sortby = 'product.product_sort ASC';
      }else{
        $sortby = 'product.product_sort ASC';
      }

      $query = self::find()
          // ->alias('p')
          // ->select('*')
          // ->joinWith('product_detail pd', true, 'INNER JOIN')
          // ->joinWith('product_category pc', true, 'INNER JOIN')
          // ->joinWith('brands b', true, 'INNER JOIN')
          // ->joinWith('product_newarrival pna', true, 'LEFT JOIN')
          // ->joinWith('specific_price sp', true, 'LEFT JOIN')
					// ->offset($page)
					// ->limit($limit)
					// ->joinWith([
					// 	"productDetail pd",
					// 	"productCategory pc",
					// 	"brands b",
					// 	"productNewArrival pna",
					// 	"specificPrice sp"
					// ])
          ->where('product.active = 1');
        
        // if(sizeof($brands) !== 0){
        //   $query->andWhere(["in", "b.link_rewrite", $brands]);
        // }
        // if(sizeof($categories) !== 0){
        //   $query->andWhere(["in", "pc.product_category_name", $categories]);
        // }
        // if(sizeof($products) !== 0){
        //   $query->andWhere(["in", "product.product_id", $products]);
        // }
        // if($is_discount !== 0){
        //   $query->andWhere('sp.from <= "'. $current_date . '"');
        //   $query->andWhere('sp.to > "'. $current_date . '"');
        // }
        // if($is_new_arrival !== 0){
        //   $query->andWhere('pna.product_newarrival_start_date <= "'. $current_date . '"');
        //   $query->andWhere('pna.product_newarrival_end_date > "'. $current_date . '"');
        // }
        // $query->andWhere(['sp.is_flash_sale' => $is_flash_sale]);
        // $query->orderBy($sortby);
        $result = $query->all();

        var_dump($result);exit();

        // return $result;
    }

    public function getProductListsCount($brands = array(), $categories = array(), $products = array(), $current_date, $page, $limit)
    {
      $query = self::find()
          ->alias('p')
          ->select('p.*, pd.*, IF(specific_price.from <= "'. $current_date . '" && specific_price.to > "'. $current_date . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority, b.brand_name, pc.product_category_name, ps.quantity AS stock_qty, 
          CASE WHEN pna.product_id IS NOT NULL THEN 1 ELSE 0 END AS is_new_arrival, pna.product_newarrival_start_date AS new_arrival_start_date, pna.product_newarrival_end_date AS new_arrival_end_date, CASE WHEN sp.product_id IS NOT NULL THEN 1 ELSE 0 END AS is_discount, sp.from AS discount_from, sp.to AS discount_to, CASE WHEN sp.is_flash_sale IS NOT NULL THEN 1 ELSE 0 END AS is_flash_sale')
					->offset($page)
					->limit($limit)
					->joinWith([
						"productDetail pd",
						"productCategory pc",
						"brands b",
						"productStock ps",
						"ProductNewArrival pna",
						"specificPrice sp"
					])
          ->where('p.active = 1');
        
        if(sizeof($brands) != 0){
          $query->andWhere(["in", "b.link_rewrite", $brands]);
        }
        if(sizeof($categories) != 0){
          $query->andWhere(["in", "pc.product_category_name", $categories]);
        }
        if(sizeof($products) != 0){
          $query->andWhere(["in", "p.product_id", $products]);
        }
        $result = $query->count();
		    return $result;
    }
    
    public function getBrands()
    {
        return $this->hasOne(Brands::className(), ['brand_id' => 'brands_brand_id']);
    }
    
    public function getProductDetail(){
        return $this->hasOne(ProductDetail::className(), ['product_id' => 'product_id']);
    }
    
    public function getProductImage(){
        return $this->hasOne(ProductImage::className(), ['product_id' => 'product_id']);
    }
    
    public function getBrandsCollection()
    {
        return $this->hasOne(BrandsCollection::className(), ['brands_collection_id' => 'brands_collection_id']);
    }
    
    public function getProductCategoryBrands(){
        return $this->hasOne(ProductCategoryBrands::className(), ['brands_brand_id' => 'brands_brand_id']);
    }
    
    public function getProductCategory(){
        return $this->hasOne(ProductCategory::className(), ['product_category_id' => 'product_category_id']);
    }
    
    public function getProductRelated(){
        return $this->hasOne(ProductRelated::className(), ['product_id' => 'product_id']);
    }
    
    public function getProductTag(){
        return $this->hasOne(ProductTag::className(), ['product_id' => 'product_id']);
    }
    
    public function getProductNewArrival(){
        return $this->hasOne(ProductNewarrival::className(), ['product_id' => 'product_id']);
    }
    
    public function getProductBestSeller(){
        return $this->hasOne(ProductBestseller::className(), ['product_id' => 'product_id']);
    }
    
    public function getSpecificPrice(){
        return $this->hasOne(SpecificPrice::className(), ['product_id' => 'product_id']);
    }
	
	public function getProductPreOrder(){
        return $this->hasOne(ProductPreOrder::className(), ['product_id' => 'product_id']);
    }
    
    public function getProductStock(){
        return $this->hasOne(ProductStock::className(), ['product_id' => 'product_id']);
    }
    
    public function getProductFeature(){
        return $this->hasOne(ProductFeature::className(), ['product_id' => 'product_id']);
    }
	
	public function getProductWarranty(){
        return $this->hasOne(ProductWarranty::className(), ['product_id' => 'product_id']);
    }
	
	
    public function getCategory(){
      return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
  }
    
}
