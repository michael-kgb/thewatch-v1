<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use frontend\core\controller;
use backend\models\BrandsBanner;
use backend\models\BrandsBannerDetail;

class CategoryController extends controller\FrontendController {
    
    public $title = "";
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function actionAccessories($actionName)
    {
		
		$this->title = 'Accessories';
		
        $start = 0;
        $limit = 20;
            
        $this->breadcrumb[] = "accessories";
        $this->breadcrumb[] = "explore";
        $this->breadcrumb[] = $actionName;
        
        $category = \backend\models\ProductCategory::find()
                    ->where(["product_category_name" => "accessories"])
                    ->one();
        
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
        
        if(isset($_GET['page'])) {
            
            $page = $_GET['page'];
            
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
            
            if($actionName == 'new-arrival'){
                $products = \backend\models\Product::find()
                    ->offset($start)
                    ->limit($limit)
                    ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection",
                        "productNewArrival",
                        "specificPrice",
                        "productImage" => function ($query) {
                            $query->andWhere(['cover' => 1]);
                        }
                    ])
                    ->where([
                        'product.product_category_id' => $category->product_category_id, 
                        'product.active' => 1
                    ])
                    ->andWhere(['<>', 'product_newarrival.product_newarrival_start_date', ''])
                    ->andWhere(['<>', 'product_newarrival.product_newarrival_end_date', ''])
                    ->orderBy('product.product_id DESC')
                    ->all();
                
            } 
            elseif($actionName == 'all-product'){
                $products = \backend\models\Product::find()
                    ->offset($start)
                    ->limit($limit)
                    ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection",
                        "specificPrice",
//                        "productStock",
                        "productImage" => function ($query) {
                            $query->andWhere(['cover' => 1]);
                        }
                    ])
                    ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                    ->orderBy('brands.brand_name ASC')
                    ->all();
                    
            } 
            elseif($actionName == 'sale') {
                $products = \backend\models\Product::find()
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
                    ->where([
                        'product.product_category_id' => $category->product_category_id, 
                        'product.active' => 1
                    ])
                    ->andWhere('product.product_id = specific_price.product_id')
                    ->orderBy('product.product_id DESC')
                    ->all();
            }
            elseif($actionName == 'best-seller') {
                $products = \backend\models\Product::find()
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
                    ->where([
                        'product.product_category_id' => $category->product_category_id, 
                        'product.active' => 1
                    ])
                    ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                    ->andWhere(['<>', 'product_bestseller.product_bestseller_start_date', ''])
                    ->andWhere(['<>', 'product_bestseller.product_bestseller_end_date', ''])
                    ->orderBy('product.product_id DESC')
                    ->all();
            }
            
        } else {
            
            if($actionName == 'new-arrival'){
                $products = \backend\models\Product::find()
                ->offset($start)
                ->limit($limit)
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "productNewArrival",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                ->andWhere(['<>', 'product_newarrival.product_newarrival_start_date', ''])
                ->andWhere(['<>', 'product_newarrival.product_newarrival_end_date', ''])
                ->orderBy('product.product_id DESC')
                ->all();
                
            } 
            elseif($actionName == 'all-product'){
                $products = \backend\models\Product::find()
                ->offset($start)
                ->limit($limit)
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                ->orderBy('brands.brand_name ASC')
                ->all();
            } 
            elseif($actionName == 'sale'){
                $now = date("Y-m-d H:i:s");
                $products = \backend\models\Product::find()
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
                ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                ->andWhere('product.product_id = specific_price.product_id')
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->orderBy('product.product_id DESC')
                ->all();
            }
            elseif($actionName == 'best-seller'){
                $now = date("Y-m-d H:i:s");
                $products = \backend\models\Product::find()
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
                ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                ->andWhere(['<>', 'product_bestseller.product_bestseller_start_date', ''])
                ->andWhere(['<>', 'product_bestseller.product_bestseller_end_date', ''])
                ->orderBy('product.product_id DESC')
                ->all();
            }
        }
        
        switch ($actionName){
            
            case "all-product":
                
                // if customer filter per brand
                if(isset($_GET['brands'])){

                    $brandsName = explode('--', $_GET['brands']);

                    $page = $_GET['page'];

                    $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;

                    // if customer filter per gender
                    if(isset($_GET['gender'])){

                        // if customer filter per watches type
                        if(isset($_GET['type'])){

                            $data = array();

                            $genders = explode('--', $_GET['gender']);
                            $types = explode('--', $_GET['type']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;
                            foreach($genders as $gender){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $gender])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            foreach($types as $type){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $type])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

    //                        print_r($data); die();

                            $products = \backend\models\Product::getProductByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterFeature($data, $brandsName, $category, $prices);

                        } 
                        else {

                            $data = array();

                            $genders = explode('--', $_GET['gender']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;
                            foreach($genders as $gender){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $gender])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterFeature($data, $brandsName, $category, $prices);

                        }

                    } 

                    else {
                    
                        // if customer filter per watches type
                        if(isset($_GET['type'])){

                            $data = array();

                            $types = explode('--', $_GET['type']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($types as $type){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $type])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['movement'])) {

                            $data = array();

                            $movements = explode('--', $_GET['movement']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($movements as $movement){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $movement])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['water'])){

                            $data = array();

                            $waters = explode('--', $_GET['water']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($waters as $water){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_name' => str_replace("-", " ", strtoupper($water))])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['bandwidth'])){

                            $data = array();

                            $bandwidths = explode('--', $_GET['bandwidth']);

                            $j = 0;

                            foreach($bandwidths as $bandwidth){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_name' => $bandwidth])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterFeature($data, $brandsName, $category, $prices);
                        }
                        else if(isset($_GET['size'])){

                            $data = array();

                            $sizes = explode('--', $_GET['size']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            $featureValue = \backend\models\ProductFeatureValue::find()
                                    ->where(['feature_id' => 5])
                                    ->andWhere(['between', 'feature_value_value', $sizes[0], $sizes[1]])
                                    ->all();

                            foreach($featureValue as $feature){
                                $data[$j] = $feature->feature_value_id;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductByFilterBrands($brandsName, $category, $start, $limit, $prices, $data);

                            $count = \backend\models\Product::getTotalProductByFilterBrands($brandsName, $category, $prices, $data);

                        }
                        else {

                            $prices = explode('--', $_GET['price']);

                            $products = \backend\models\Product::getProductByFilterBrands($brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterBrands($brandsName, $category, $prices);

                        }
                        
                    }

                } 
                else {

                    $page = $_GET['page'];

                    $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;

                    $products = \backend\models\Product::getProductByFilter($category, $start, $limit);

                    $count = \backend\models\Product::getTotalProductByFilter($category);
                }
                
                $product_count = count($count);  
				
				/*
				\Yii::$app->view->registerJs('var scr = document.createElement("script");
				scr.type = "text/javascript";
				scr.async = true;
				scr.src =  "//ssp.adskom.com/tags/third-party-async/NzNhZjA0YjYtMzg3ZS00N2I0LThiMDMtYzNkNTJmMzM3NjUx";
				document.body.appendChild(scr);');
                */
				
				\Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Barang-Barang Lucu dan Unik Siap Melengkapi Aktifitas Kamu. Cek Sekarang!']);
				
                return $this->render('index', array("category" => "accessories", "products" => $products, "count" => $product_count, "limit" => $limit));
                
                break;
            
            case "new-arrival":
                
                // if customer filter per brand
                if(isset($_GET['brands'])){

                    $brandsName = explode('--', $_GET['brands']);

                    $page = $_GET['page'];

                    $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;

                    // if customer filter per gender
                    if(isset($_GET['gender'])){

                        // if customer filter per watches type
                        if(isset($_GET['type'])){

                            $data = array();

                            $genders = explode('--', $_GET['gender']);
                            $types = explode('--', $_GET['type']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;
                            foreach($genders as $gender){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $gender])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            foreach($types as $type){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $type])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterFeature($data, $brandsName, $category, $prices);

                        } 
                        else {

                            $data = array();

                            $genders = explode('--', $_GET['gender']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;
                            foreach($genders as $gender){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $gender])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterFeature($data, $brandsName, $category, $prices);

                        }

                    } 

                    else {
                    
                        // if customer filter per watches type
                        if(isset($_GET['type'])){

                            $data = array();

                            $types = explode('--', $_GET['type']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($types as $type){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $type])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['movement'])) {

                            $data = array();

                            $movements = explode('--', $_GET['movement']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($movements as $movement){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $movement])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['water'])){

                            $data = array();

                            $waters = explode('--', $_GET['water']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($waters as $water){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_name' => str_replace("-", " ", strtoupper($water))])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['bandwidth'])){

                            $data = array();

                            $bandwidths = explode('--', $_GET['bandwidth']);

                            $j = 0;

                            foreach($bandwidths as $bandwidth){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_name' => $bandwidth])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterFeature($data, $brandsName, $category, $prices);
                        }
                        else if(isset($_GET['size'])){

                            $data = array();

                            $sizes = explode('--', $_GET['size']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            $featureValue = \backend\models\ProductFeatureValue::find()
                                    ->where(['feature_id' => 5])
                                    ->andWhere(['between', 'feature_value_value', $sizes[0], $sizes[1]])
                                    ->all();

                            foreach($featureValue as $feature){
                                $data[$j] = $feature->feature_value_id;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterBrands($brandsName, $category, $start, $limit, $prices, $data);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterBrands($brandsName, $category, $prices, $data);

                        }
                        else {

                            $prices = explode('--', $_GET['price']);

                            $products = \backend\models\Product::getProductNewArrivalByFilterBrands($brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterBrands($brandsName, $category, $prices);

                        }
                        
                    }

                } 
                else {

                    $page = $_GET['page'];

                    $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;

                    $products = \backend\models\Product::getProductNewArrivalByFilter($category, $start, $limit);

                    $count = \backend\models\Product::getTotalProductNewArrivalByFilter($category);
                }
                
                $product_count = count($count); 
				
				/*
				\Yii::$app->view->registerJs('var scr = document.createElement("script");
				scr.type = "text/javascript";
				scr.async = true;
				scr.src =  "//ssp.adskom.com/tags/third-party-async/MTYzMzU5ZGQtNzllNi00M2Y5LThkMjctOWI2MWJmNTA2MTNl";
				document.body.appendChild(scr);');
                */
				
                return $this->render('new-arrival', array("category" => "accessories", "products" => $products, "count" => $product_count, "limit" => $limit));
                
                break;
            
            case "sale":
                
                // if customer filter per brand
                if(isset($_GET['brands'])){

                    $brandsName = explode('--', $_GET['brands']);

                    $page = $_GET['page'];

                    $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;

                    // if customer filter per gender
                    if(isset($_GET['gender'])){

                        // if customer filter per watches type
                        if(isset($_GET['type'])){

                            $data = array();

                            $genders = explode('--', $_GET['gender']);
                            $types = explode('--', $_GET['type']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;
                            foreach($genders as $gender){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $gender])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            foreach($types as $type){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $type])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

    //                        print_r($data); die();

                            $products = \backend\models\Product::getProductSaleByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterFeature($data, $brandsName, $category, $prices);

                        } 
                        else {

                            $data = array();

                            $genders = explode('--', $_GET['gender']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;
                            foreach($genders as $gender){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $gender])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductSaleByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterFeature($data, $brandsName, $category, $prices);

                        }

                    } 

                    else {
                    
                        // if customer filter per watches type
                        if(isset($_GET['type'])){

                            $data = array();

                            $types = explode('--', $_GET['type']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($types as $type){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $type])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductSaleByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['movement'])) {

                            $data = array();

                            $movements = explode('--', $_GET['movement']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($movements as $movement){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $movement])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductSaleByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['water'])){

                            $data = array();

                            $waters = explode('--', $_GET['water']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($waters as $water){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_name' => str_replace("-", " ", strtoupper($water))])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductSaleByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['bandwidth'])){

                            $data = array();

                            $bandwidths = explode('--', $_GET['bandwidth']);

                            $j = 0;

                            foreach($bandwidths as $bandwidth){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_name' => $bandwidth])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductSaleByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterFeature($data, $brandsName, $category, $prices);
                        }
                        else if(isset($_GET['size'])){

                            $data = array();

                            $sizes = explode('--', $_GET['size']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            $featureValue = \backend\models\ProductFeatureValue::find()
                                    ->where(['feature_id' => 5])
                                    ->andWhere(['between', 'feature_value_value', $sizes[0], $sizes[1]])
                                    ->all();

                            foreach($featureValue as $feature){
                                $data[$j] = $feature->feature_value_id;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductSaleByFilterBrands($brandsName, $category, $start, $limit, $prices, $data);

                            $count = \backend\models\Product::getTotalProductSaleByFilterBrands($brandsName, $category, $prices, $data);

                        }
                        else {

                            $prices = explode('--', $_GET['price']);

                            $products = \backend\models\Product::getProductSaleByFilterBrands($brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterBrands($brandsName, $category, $prices);

                        }
                        
                    }

                } 
                else {

                    $page = $_GET['page'];

                    $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;

                    $products = \backend\models\Product::getProductSaleByFilter($category, $start, $limit);

                    $count = \backend\models\Product::getTotalProductSaleByFilter($category);
                    
                }
                
                $product_count = count($count);  
				
				/*
				\Yii::$app->view->registerJs('var scr = document.createElement("script");
				scr.type = "text/javascript";
				scr.async = true;
				scr.src =  "//ssp.adskom.com/tags/third-party-async/NTM4NDI0NWUtZjNmYS00MGZhLTg0ZGEtODUxMzY0ODJjNWUz";
				document.body.appendChild(scr);');
                */
				
                return $this->render('sale', array("category" => "accessories", "products" => $products, "count" => $product_count, "limit" => $limit));
                
                break;
            
            case "best-seller":
                
                $count = \backend\models\Product::find()
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
                ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                ->andWhere(['<>', 'product_bestseller.product_bestseller_start_date', ''])
                ->andWhere(['<>', 'product_bestseller.product_bestseller_end_date', ''])
                ->orderBy('product.product_id DESC')
                ->all();
                
                $product_count = count($count);
				
				/*
				\Yii::$app->view->registerJs('var scr = document.createElement("script");
				scr.type = "text/javascript";
				scr.async = true;
				scr.src =  "//ssp.adskom.com/tags/third-party-async/YmI0YmE2NjQtZjAzYi00NGEyLWIwMjItZWRmN2NhYTM2Mzc0";
				document.body.appendChild(scr);');
                */
				
                return $this->render('sale', array("category" => "accessories", "products" => $products, "count" => $product_count, "limit" => $limit));
                
                break;
        }
        
    }
    
    public function actionWatches($actionName)
    {
		
		$this->title = 'Watches';
		
        $start = 0;
        $limit = 20;
		
		$now = date("Y-m-d H:i:s");
            
        $this->breadcrumb[] = "watches";
        $this->breadcrumb[] = "explore";
        $this->breadcrumb[] = $actionName;
        
        $category = \backend\models\ProductCategory::find()
                    ->where(["product_category_name" => "watches"])
                    ->one();
        
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
        
        if(isset($_GET['page'])) {
            
            $page = $_GET['page'];
            
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
            
            if($actionName == 'new-arrival'){
                $products = \backend\models\Product::find()
                    ->offset($start)
                    ->limit($limit)
                    ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection",
                        "productNewArrival",
                        "specificPrice",
                        "productImage" => function ($query) {
                            $query->andWhere(['cover' => 1]);
                        }
                    ])
                    ->where([
                        'product.product_category_id' => $category->product_category_id, 
                        'product.active' => 1
                    ])
					->andWhere('product_newarrival.product_newarrival_start_date <= "'. $now . '"')
					->andWhere('product_newarrival.product_newarrival_end_date > "'. $now . '"')
                    //->andWhere(['<>', 'product_newarrival.product_newarrival_start_date', ''])
                    //->andWhere(['<>', 'product_newarrival.product_newarrival_end_date', ''])
                    ->orderBy('product_newarrival.product_newarrival_id DESC')
                    ->all();
                
            } 
            elseif($actionName == 'all-product'){
                $products = \backend\models\Product::find()
                    ->offset($start)
                    ->limit($limit)
                    ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection",
                        "specificPrice",
//                        "productStock",
                        "productImage" => function ($query) {
                            $query->andWhere(['cover' => 1]);
                        }
                    ])
                    ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                    ->orderBy('brands.brand_name ASC')
                    ->all();
                    
            } 
            elseif($actionName == 'sale') {
                $products = \backend\models\Product::find()
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
                    ->where([
                        'product.product_category_id' => $category->product_category_id, 
                        'product.active' => 1
                    ])
                    ->andWhere('product.product_id = specific_price.product_id')
                    ->orderBy('product.product_id DESC')
                    ->all();
            }
            elseif($actionName == 'best-seller') {
                $products = \backend\models\Product::find()
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
                    ->where([
                        'product.product_category_id' => $category->product_category_id, 
                        'product.active' => 1
                    ])
                    ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
					->andWhere('product_bestseller.product_bestseller_start_date <= "'. $now . '"')
					->andWhere('product_bestseller.product_bestseller_end_date > "'. $now . '"')
                    //->andWhere(['<>', 'product_bestseller.product_bestseller_start_date', ''])
                    //->andWhere(['<>', 'product_bestseller.product_bestseller_end_date', ''])
                    ->orderBy('product.product_id DESC')
                    ->all();
            }
            
        } else {
            
            if($actionName == 'new-arrival'){
				$now = date("Y-m-d H:i:s");
                $products = \backend\models\Product::find()
                ->offset($start)
                ->limit($limit)
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "productNewArrival",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
				->andWhere('product_newarrival.product_newarrival_start_date <= "'. $now . '"')
				->andWhere('product_newarrival.product_newarrival_end_date > "'. $now . '"')
                //->andWhere(['<>', 'product_newarrival.product_newarrival_start_date', ''])
                //->andWhere(['<>', 'product_newarrival.product_newarrival_end_date', ''])
                ->orderBy('product_newarrival.product_newarrival_id DESC')
                ->all();
                
            } 
            elseif($actionName == 'all-product'){
                $products = \backend\models\Product::find()
                ->offset($start)
                ->limit($limit)
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                ->orderBy('brands.brand_name ASC')
                ->all();
            } 
            elseif($actionName == 'sale'){
                $now = date("Y-m-d H:i:s");
                $products = \backend\models\Product::find()
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
                ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                ->andWhere('product.product_id = specific_price.product_id')
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->orderBy('product.product_id DESC')
                ->all();
            }
            elseif($actionName == 'best-seller'){
                $now = date("Y-m-d H:i:s");
                $products = \backend\models\Product::find()
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
                ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
				->andWhere('product_bestseller.product_bestseller_start_date <= "'. $now . '"')
				->andWhere('product_bestseller.product_bestseller_end_date > "'. $now . '"')
                //->andWhere(['<>', 'product_bestseller.product_bestseller_start_date', ''])
                //->andWhere(['<>', 'product_bestseller.product_bestseller_end_date', ''])
                ->orderBy('product.product_id DESC')
                ->all();
            }
        }
        
        switch ($actionName){
            
            case "all-product":
                
                // if customer filter per brand
                if(isset($_GET['brands'])){

                    $brandsName = explode('--', $_GET['brands']);

                    $page = $_GET['page'];

                    $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;

                    // if customer filter per gender
                    if(isset($_GET['gender'])){

                        // if customer filter per watches type
                        if(isset($_GET['type'])){

                            $data = array();

                            $genders = explode('--', $_GET['gender']);
                            $types = explode('--', $_GET['type']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;
                            foreach($genders as $gender){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $gender])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            foreach($types as $type){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $type])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

    //                        print_r($data); die();

                            $products = \backend\models\Product::getProductByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterFeature($data, $brandsName, $category, $prices);

                        } 
                        else {

                            $data = array();

                            $genders = explode('--', $_GET['gender']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;
                            foreach($genders as $gender){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $gender])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterFeature($data, $brandsName, $category, $prices);

                        }

                    } 

                    else {
                    
                        // if customer filter per watches type
                        if(isset($_GET['type'])){

                            $data = array();

                            $types = explode('--', $_GET['type']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($types as $type){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $type])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['movement'])) {

                            $data = array();

                            $movements = explode('--', $_GET['movement']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($movements as $movement){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $movement])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['water'])){

                            $data = array();

                            $waters = explode('--', $_GET['water']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($waters as $water){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_name' => str_replace("-", " ", strtoupper($water))])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['bandwidth'])){

                            $data = array();

                            $bandwidths = explode('--', $_GET['bandwidth']);

                            $j = 0;

                            foreach($bandwidths as $bandwidth){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_name' => $bandwidth])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterFeature($data, $brandsName, $category, $prices);
                        }
                        else if(isset($_GET['size'])){

                            $data = array();

                            $sizes = explode('--', $_GET['size']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            $featureValue = \backend\models\ProductFeatureValue::find()
                                    ->where(['feature_id' => 5])
                                    ->andWhere(['between', 'feature_value_value', $sizes[0], $sizes[1]])
                                    ->all();

                            foreach($featureValue as $feature){
                                $data[$j] = $feature->feature_value_id;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductByFilterBrands($brandsName, $category, $start, $limit, $prices, $data);

                            $count = \backend\models\Product::getTotalProductByFilterBrands($brandsName, $category, $prices, $data);

                        }
                        else {

                            $prices = explode('--', $_GET['price']);

                            $products = \backend\models\Product::getProductByFilterBrands($brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterBrands($brandsName, $category, $prices);

                        }
                        
                    }

                } 
                else {

                    $page = $_GET['page'];

                    $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;

                    $products = \backend\models\Product::getProductByFilter($category, $start, $limit);

                    $count = \backend\models\Product::getTotalProductByFilter($category);
                }
                
                $product_count = count($count);  
				
				/*
				\Yii::$app->view->registerJs('var scr = document.createElement("script");
				scr.type = "text/javascript";
				scr.async = true;
				scr.src =  "//ssp.adskom.com/tags/third-party-async/MTE5NmViMzItMTNkMy00OGUxLTg1MGYtYmY5OGQxNjlmYmU3";
				document.body.appendChild(scr);');
                */
				
				\Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Jual Jam Tangan Branded Untuk Wanita dan Pria Original & Bergaransi']);
				
                return $this->render('index', array("category" => "watches", "products" => $products, "count" => $product_count, "limit" => $limit));
                
                break;
            
            case "new-arrival":
                
                // if customer filter per brand
                if(isset($_GET['brands'])){

                    $brandsName = explode('--', $_GET['brands']);

                    $page = $_GET['page'];

                    $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;

                    // if customer filter per gender
                    if(isset($_GET['gender'])){

                        // if customer filter per watches type
                        if(isset($_GET['type'])){

                            $data = array();

                            $genders = explode('--', $_GET['gender']);
                            $types = explode('--', $_GET['type']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;
                            foreach($genders as $gender){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $gender])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            foreach($types as $type){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $type])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterFeature($data, $brandsName, $category, $prices);

                        } 
                        else {

                            $data = array();

                            $genders = explode('--', $_GET['gender']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;
                            foreach($genders as $gender){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $gender])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterFeature($data, $brandsName, $category, $prices);

                        }

                    } 

                    else {
                    
                        // if customer filter per watches type
                        if(isset($_GET['type'])){

                            $data = array();

                            $types = explode('--', $_GET['type']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($types as $type){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $type])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['movement'])) {

                            $data = array();

                            $movements = explode('--', $_GET['movement']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($movements as $movement){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $movement])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['water'])){

                            $data = array();

                            $waters = explode('--', $_GET['water']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($waters as $water){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_name' => str_replace("-", " ", strtoupper($water))])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['bandwidth'])){

                            $data = array();

                            $bandwidths = explode('--', $_GET['bandwidth']);

                            $j = 0;

                            foreach($bandwidths as $bandwidth){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_name' => $bandwidth])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterFeature($data, $brandsName, $category, $prices);
                        }
                        else if(isset($_GET['size'])){

                            $data = array();

                            $sizes = explode('--', $_GET['size']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            $featureValue = \backend\models\ProductFeatureValue::find()
                                    ->where(['feature_id' => 5])
                                    ->andWhere(['between', 'feature_value_value', $sizes[0], $sizes[1]])
                                    ->all();

                            foreach($featureValue as $feature){
                                $data[$j] = $feature->feature_value_id;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterBrands($brandsName, $category, $start, $limit, $prices, $data);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterBrands($brandsName, $category, $prices, $data);

                        }
                        else {

                            $prices = explode('--', $_GET['price']);

                            $products = \backend\models\Product::getProductNewArrivalByFilterBrands($brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterBrands($brandsName, $category, $prices);

                        }
                        
                    }

                } 
                else {

                    $page = $_GET['page'];

                    $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;

                    $products = \backend\models\Product::getProductNewArrivalByFilter($category, $start, $limit);

                    $count = \backend\models\Product::getTotalProductNewArrivalByFilter($category);
                }
                
                $product_count = count($count); 
				
				/*
				\Yii::$app->view->registerJs('var scr = document.createElement("script");
				scr.type = "text/javascript";
				scr.async = true;
				scr.src =  "//ssp.adskom.com/tags/third-party-async/NTljNDI0ZWItM2M5MS00MGIzLWI3OGUtZjFhZjFmZjZhYzcx";
				document.body.appendChild(scr);');
                */
				
                return $this->render('new-arrival', array("category" => "watches", "products" => $products, "count" => $product_count, "limit" => $limit));
                
                break;
            
            case "sale":
                
                // if customer filter per brand
                if(isset($_GET['brands'])){

                    $brandsName = explode('--', $_GET['brands']);

                    $page = $_GET['page'];

                    $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;

                    // if customer filter per gender
                    if(isset($_GET['gender'])){

                        // if customer filter per watches type
                        if(isset($_GET['type'])){

                            $data = array();

                            $genders = explode('--', $_GET['gender']);
                            $types = explode('--', $_GET['type']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;
                            foreach($genders as $gender){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $gender])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            foreach($types as $type){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $type])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

    //                        print_r($data); die();

                            $products = \backend\models\Product::getProductSaleByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterFeature($data, $brandsName, $category, $prices);

                        } 
                        else {

                            $data = array();

                            $genders = explode('--', $_GET['gender']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;
                            foreach($genders as $gender){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $gender])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductSaleByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterFeature($data, $brandsName, $category, $prices);

                        }

                    } 

                    else {
                    
                        // if customer filter per watches type
                        if(isset($_GET['type'])){

                            $data = array();

                            $types = explode('--', $_GET['type']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($types as $type){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $type])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductSaleByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['movement'])) {

                            $data = array();

                            $movements = explode('--', $_GET['movement']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($movements as $movement){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $movement])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductSaleByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['water'])){

                            $data = array();

                            $waters = explode('--', $_GET['water']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($waters as $water){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_name' => str_replace("-", " ", strtoupper($water))])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductSaleByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['bandwidth'])){

                            $data = array();

                            $bandwidths = explode('--', $_GET['bandwidth']);

                            $j = 0;

                            foreach($bandwidths as $bandwidth){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_name' => $bandwidth])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductSaleByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterFeature($data, $brandsName, $category, $prices);
                        }
                        else if(isset($_GET['size'])){

                            $data = array();

                            $sizes = explode('--', $_GET['size']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            $featureValue = \backend\models\ProductFeatureValue::find()
                                    ->where(['feature_id' => 5])
                                    ->andWhere(['between', 'feature_value_value', $sizes[0], $sizes[1]])
                                    ->all();

                            foreach($featureValue as $feature){
                                $data[$j] = $feature->feature_value_id;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductSaleByFilterBrands($brandsName, $category, $start, $limit, $prices, $data);

                            $count = \backend\models\Product::getTotalProductSaleByFilterBrands($brandsName, $category, $prices, $data);

                        }
                        else {

                            $prices = explode('--', $_GET['price']);

                            $products = \backend\models\Product::getProductSaleByFilterBrands($brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterBrands($brandsName, $category, $prices);

                        }
                        
                    }

                } 
                else {

                    $page = $_GET['page'];

                    $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;

                    $products = \backend\models\Product::getProductSaleByFilter($category, $start, $limit);

                    $count = \backend\models\Product::getTotalProductSaleByFilter($category);
                    
                }
                
                $product_count = count($count);  
				
				/*
				\Yii::$app->view->registerJs('var scr = document.createElement("script");
				scr.type = "text/javascript";
				scr.async = true;
				scr.src =  "//ssp.adskom.com/tags/third-party-async/ZDk1NTY1YjktZWE1ZC00MGZmLWFlZjQtZjljYTMwZWNmMjI3";
				document.body.appendChild(scr);');
                */
				
                return $this->render('sale', array("category" => "watches", "products" => $products, "count" => $product_count, "limit" => $limit));
                
                break;
            
            case "best-seller":
			
				$page = $_GET['page'];

				$page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
				
				$products = \backend\models\Product::getAllProductBestSeller($category, $start, $limit);
				
                $count = \backend\models\Product::find()
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
                ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
				->andWhere('product_bestseller.product_bestseller_start_date <= "'. $now . '"')
				->andWhere('product_bestseller.product_bestseller_end_date > "'. $now . '"')
                //->andWhere(['<>', 'product_bestseller.product_bestseller_start_date', ''])
                //->andWhere(['<>', 'product_bestseller.product_bestseller_end_date', ''])
                ->orderBy('product.product_id DESC')
                ->all();
                
                $product_count = count($count);
				
				/*
				\Yii::$app->view->registerJs('var scr = document.createElement("script");
				scr.type = "text/javascript";
				scr.async = true;
				scr.src =  "//ssp.adskom.com/tags/third-party-async/YWZlMmE5YjgtOWQ5Ny00ZTVmLWEwZDEtMmM0Y2JmMDNlY2Jl";
				document.body.appendChild(scr);');
                */
				
                return $this->render('best-seller', array("category" => "watches", "products" => $products, "count" => $product_count, "limit" => $limit));
                
                break;
        }
        
    }
    
    public function actionStraps($actionName)
    {
		
		$this->title = 'Straps';
		
        $start = 0;
        $limit = 20;
            
        $this->breadcrumb[] = "straps";
        $this->breadcrumb[] = "explore";
        $this->breadcrumb[] = $actionName;
        
        $category = \backend\models\ProductCategory::find()
                    ->where(["product_category_name" => "straps"])
                    ->one();
        
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
        
        if(isset($_GET['page'])) {
            
            $page = $_GET['page'];
            
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
            
            if($actionName == 'new-arrival'){
                $products = \backend\models\Product::find()
                    ->offset($start)
                    ->limit($limit)
                    ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection",
                        "productNewArrival",
                        "specificPrice",
                        "productImage" => function ($query) {
                            $query->andWhere(['cover' => 1]);
                        }
                    ])
                    ->where([
                        'product.product_category_id' => $category->product_category_id, 
                        'product.active' => 1
                    ])
                    ->andWhere(['<>', 'product_newarrival.product_newarrival_start_date', ''])
                    ->andWhere(['<>', 'product_newarrival.product_newarrival_end_date', ''])
                    ->orderBy('product.product_id DESC')
                    ->all();
                
            } 
            elseif($actionName == 'all-product'){
                $products = \backend\models\Product::find()
                    ->offset($start)
                    ->limit($limit)
                    ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection",
                        "specificPrice",
//                        "productStock",
                        "productImage" => function ($query) {
                            $query->andWhere(['cover' => 1]);
                        }
                    ])
                    ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                    ->orderBy('brands.brand_name ASC')
                    ->all();
                    
            } 
            elseif($actionName == 'sale') {
                $products = \backend\models\Product::find()
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
                    ->where([
                        'product.product_category_id' => $category->product_category_id, 
                        'product.active' => 1
                    ])
                    ->andWhere('product.product_id = specific_price.product_id')
                    ->orderBy('product.product_id DESC')
                    ->all();
            }
            elseif($actionName == 'best-seller') {
                $products = \backend\models\Product::find()
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
                    ->where([
                        'product.product_category_id' => $category->product_category_id, 
                        'product.active' => 1
                    ])
                    ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                    ->andWhere(['<>', 'product_bestseller.product_bestseller_start_date', ''])
                    ->andWhere(['<>', 'product_bestseller.product_bestseller_end_date', ''])
                    ->orderBy('product.product_id DESC')
                    ->all();
            }
            
        } else {
            
            if($actionName == 'new-arrival'){
                $products = \backend\models\Product::find()
                ->offset($start)
                ->limit($limit)
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "productNewArrival",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                ->andWhere(['<>', 'product_newarrival.product_newarrival_start_date', ''])
                ->andWhere(['<>', 'product_newarrival.product_newarrival_end_date', ''])
                ->orderBy('product.product_id DESC')
                ->all();
                
            } 
            elseif($actionName == 'all-product'){
                $products = \backend\models\Product::find()
                ->offset($start)
                ->limit($limit)
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                ->orderBy('brands.brand_name ASC')
                ->all();
            } 
            elseif($actionName == 'sale'){
                $now = date("Y-m-d H:i:s");
                $products = \backend\models\Product::find()
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
                ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                ->andWhere('product.product_id = specific_price.product_id')
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->orderBy('product.product_id DESC')
                ->all();
            }
            elseif($actionName == 'best-seller'){
                $now = date("Y-m-d H:i:s");
                $products = \backend\models\Product::find()
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
                ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                ->andWhere(['<>', 'product_bestseller.product_bestseller_start_date', ''])
                ->andWhere(['<>', 'product_bestseller.product_bestseller_end_date', ''])
                ->orderBy('product.product_id DESC')
                ->all();
            }
        }
        
        switch ($actionName){
            
            case "all-product":
                
                // if customer filter per brand
                if(isset($_GET['brands'])){

                    $brandsName = explode('--', $_GET['brands']);

                    $page = $_GET['page'];

                    $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;

                    // if customer filter per gender
                    if(isset($_GET['gender'])){

                        // if customer filter per watches type
                        if(isset($_GET['type'])){

                            $data = array();

                            $genders = explode('--', $_GET['gender']);
                            $types = explode('--', $_GET['type']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;
                            foreach($genders as $gender){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $gender])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            foreach($types as $type){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $type])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

    //                        print_r($data); die();

                            $products = \backend\models\Product::getProductByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterFeature($data, $brandsName, $category, $prices);

                        } 
                        else {

                            $data = array();

                            $genders = explode('--', $_GET['gender']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;
                            foreach($genders as $gender){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $gender])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterFeature($data, $brandsName, $category, $prices);

                        }

                    } 

                    else {
                    
                        // if customer filter per watches type
                        if(isset($_GET['type'])){

                            $data = array();

                            $types = explode('--', $_GET['type']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($types as $type){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $type])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['movement'])) {

                            $data = array();

                            $movements = explode('--', $_GET['movement']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($movements as $movement){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $movement])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['water'])){

                            $data = array();

                            $waters = explode('--', $_GET['water']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($waters as $water){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_name' => str_replace("-", " ", strtoupper($water))])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['bandwidth'])){

                            $data = array();

                            $bandwidths = explode('--', $_GET['bandwidth']);

                            $j = 0;

                            foreach($bandwidths as $bandwidth){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_name' => $bandwidth])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterFeature($data, $brandsName, $category, $prices);
                        }
                        else if(isset($_GET['size'])){

                            $data = array();

                            $sizes = explode('--', $_GET['size']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            $featureValue = \backend\models\ProductFeatureValue::find()
                                    ->where(['feature_id' => 5])
                                    ->andWhere(['between', 'feature_value_value', $sizes[0], $sizes[1]])
                                    ->all();

                            foreach($featureValue as $feature){
                                $data[$j] = $feature->feature_value_id;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductByFilterBrands($brandsName, $category, $start, $limit, $prices, $data);

                            $count = \backend\models\Product::getTotalProductByFilterBrands($brandsName, $category, $prices, $data);

                        }
                        else {

                            $prices = explode('--', $_GET['price']);

                            $products = \backend\models\Product::getProductByFilterBrands($brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductByFilterBrands($brandsName, $category, $prices);

                        }
                        
                    }

                } 
                else {

                    $page = $_GET['page'];

                    $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;

                    $products = \backend\models\Product::getProductByFilter($category, $start, $limit);

                    $count = \backend\models\Product::getTotalProductByFilter($category);
                }
                
                $product_count = count($count);  
				
				/*
				\Yii::$app->view->registerJs('var scr = document.createElement("script");
				scr.type = "text/javascript";
				scr.async = true;
				scr.src =  "//ssp.adskom.com/tags/third-party-async/M2Q1ZWVhNWEtNDY4Ni00NWM0LTgwMTgtY2FhYTM2ZGVmN2Fh";
				document.body.appendChild(scr);');
                */
				
				\Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Sesuaikan Strap Jam Tangan Kamu Dengan Suasana Hatimu. Beli Sekarang!']);
				
                return $this->render('index', array("category" => "watches", "products" => $products, "count" => $product_count, "limit" => $limit));
                
                break;
            
            case "new-arrival":
                
                // if customer filter per brand
                if(isset($_GET['brands'])){

                    $brandsName = explode('--', $_GET['brands']);

                    $page = $_GET['page'];

                    $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;

                    // if customer filter per gender
                    if(isset($_GET['gender'])){

                        // if customer filter per watches type
                        if(isset($_GET['type'])){

                            $data = array();

                            $genders = explode('--', $_GET['gender']);
                            $types = explode('--', $_GET['type']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;
                            foreach($genders as $gender){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $gender])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            foreach($types as $type){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $type])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterFeature($data, $brandsName, $category, $prices);

                        } 
                        else {

                            $data = array();

                            $genders = explode('--', $_GET['gender']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;
                            foreach($genders as $gender){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $gender])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterFeature($data, $brandsName, $category, $prices);

                        }

                    } 

                    else {
                    
                        // if customer filter per watches type
                        if(isset($_GET['type'])){

                            $data = array();

                            $types = explode('--', $_GET['type']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($types as $type){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $type])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['movement'])) {

                            $data = array();

                            $movements = explode('--', $_GET['movement']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($movements as $movement){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $movement])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['water'])){

                            $data = array();

                            $waters = explode('--', $_GET['water']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($waters as $water){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_name' => str_replace("-", " ", strtoupper($water))])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['bandwidth'])){

                            $data = array();

                            $bandwidths = explode('--', $_GET['bandwidth']);

                            $j = 0;

                            foreach($bandwidths as $bandwidth){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_name' => $bandwidth])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterFeature($data, $brandsName, $category, $prices);
                        }
                        else if(isset($_GET['size'])){

                            $data = array();

                            $sizes = explode('--', $_GET['size']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            $featureValue = \backend\models\ProductFeatureValue::find()
                                    ->where(['feature_id' => 5])
                                    ->andWhere(['between', 'feature_value_value', $sizes[0], $sizes[1]])
                                    ->all();

                            foreach($featureValue as $feature){
                                $data[$j] = $feature->feature_value_id;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductNewArrivalByFilterBrands($brandsName, $category, $start, $limit, $prices, $data);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterBrands($brandsName, $category, $prices, $data);

                        }
                        else {

                            $prices = explode('--', $_GET['price']);

                            $products = \backend\models\Product::getProductNewArrivalByFilterBrands($brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductNewArrivalByFilterBrands($brandsName, $category, $prices);

                        }
                        
                    }

                } 
                else {

                    $page = $_GET['page'];

                    $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;

                    $products = \backend\models\Product::getProductNewArrivalByFilter($category, $start, $limit);

                    $count = \backend\models\Product::getTotalProductNewArrivalByFilter($category);
                }
                
                $product_count = count($count); 
                
				/*
				\Yii::$app->view->registerJs('var scr = document.createElement("script");
				scr.type = "text/javascript";
				scr.async = true;
				scr.src =  "//ssp.adskom.com/tags/third-party-async/NDQ4NWJjMTUtYTg2MS00ZTY0LWE5NzUtYTYxNzNhODY5NDll";
				document.body.appendChild(scr);');
				*/
				
                return $this->render('new-arrival', array("category" => "watches", "products" => $products, "count" => $product_count, "limit" => $limit));
                
                break;
            
            case "sale":
                
                // if customer filter per brand
                if(isset($_GET['brands'])){

                    $brandsName = explode('--', $_GET['brands']);

                    $page = $_GET['page'];

                    $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;

                    // if customer filter per gender
                    if(isset($_GET['gender'])){

                        // if customer filter per watches type
                        if(isset($_GET['type'])){

                            $data = array();

                            $genders = explode('--', $_GET['gender']);
                            $types = explode('--', $_GET['type']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;
                            foreach($genders as $gender){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $gender])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            foreach($types as $type){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $type])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

    //                        print_r($data); die();

                            $products = \backend\models\Product::getProductSaleByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterFeature($data, $brandsName, $category, $prices);

                        } 
                        else {

                            $data = array();

                            $genders = explode('--', $_GET['gender']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;
                            foreach($genders as $gender){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $gender])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductSaleByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterFeature($data, $brandsName, $category, $prices);

                        }

                    } 

                    else {
                    
                        // if customer filter per watches type
                        if(isset($_GET['type'])){

                            $data = array();

                            $types = explode('--', $_GET['type']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($types as $type){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $type])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductSaleByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['movement'])) {

                            $data = array();

                            $movements = explode('--', $_GET['movement']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($movements as $movement){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_value' => $movement])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductSaleByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['water'])){

                            $data = array();

                            $waters = explode('--', $_GET['water']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            foreach($waters as $water){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_name' => str_replace("-", " ", strtoupper($water))])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductSaleByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterFeature($data, $brandsName, $category, $prices);

                        }
                        else if(isset($_GET['bandwidth'])){

                            $data = array();

                            $bandwidths = explode('--', $_GET['bandwidth']);

                            $j = 0;

                            foreach($bandwidths as $bandwidth){
                                $featureValue = \backend\models\ProductFeatureValue::findOne(['feature_value_name' => $bandwidth])->feature_value_id;
                                $data[$j] = $featureValue;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductSaleByFilterFeature($data, $brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterFeature($data, $brandsName, $category, $prices);
                        }
                        else if(isset($_GET['size'])){

                            $data = array();

                            $sizes = explode('--', $_GET['size']);
                            $prices = explode('--', $_GET['price']);

                            $j = 0;

                            $featureValue = \backend\models\ProductFeatureValue::find()
                                    ->where(['feature_id' => 5])
                                    ->andWhere(['between', 'feature_value_value', $sizes[0], $sizes[1]])
                                    ->all();

                            foreach($featureValue as $feature){
                                $data[$j] = $feature->feature_value_id;
                                $j++;
                            }

                            $products = \backend\models\Product::getProductSaleByFilterBrands($brandsName, $category, $start, $limit, $prices, $data);

                            $count = \backend\models\Product::getTotalProductSaleByFilterBrands($brandsName, $category, $prices, $data);

                        }
                        else {

                            $prices = explode('--', $_GET['price']);

                            $products = \backend\models\Product::getProductSaleByFilterBrands($brandsName, $category, $start, $limit, $prices);

                            $count = \backend\models\Product::getTotalProductSaleByFilterBrands($brandsName, $category, $prices);

                        }
                        
                    }

                } 
                else {

                    $page = $_GET['page'];

                    $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;

                    $products = \backend\models\Product::getProductSaleByFilter($category, $start, $limit);

                    $count = \backend\models\Product::getTotalProductSaleByFilter($category);
                    
                }
                
                $product_count = count($count);  
				
				/*
				\Yii::$app->view->registerJs('var scr = document.createElement("script");
				scr.type = "text/javascript";
				scr.async = true;
				scr.src =  "//ssp.adskom.com/tags/third-party-async/Yzc4NTQxYzQtMzIyMy00OGQyLWJiNjUtOTRhYmI0MmUxNjg5";
				document.body.appendChild(scr);');
				*/
                
                return $this->render('sale', array("category" => "watches", "products" => $products, "count" => $product_count, "limit" => $limit));
                
                break;
            
            case "best-seller":
                
                $count = \backend\models\Product::find()
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
                ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                ->andWhere(['<>', 'product_bestseller.product_bestseller_start_date', ''])
                ->andWhere(['<>', 'product_bestseller.product_bestseller_end_date', ''])
                ->orderBy('product.product_id DESC')
                ->all();
                
                $product_count = count($count);
				
				/* 
				\Yii::$app->view->registerJs('var scr = document.createElement("script");
				scr.type = "text/javascript";
				scr.async = true;
				scr.src =  "//ssp.adskom.com/tags/third-party-async/MzRlYjk1NjMtOGZmYS00YTcwLTlhMzgtZGFjZDZkYjIyYjZm";
				document.body.appendChild(scr);'); 
				*/
                
                return $this->render('sale', array("category" => "watches", "products" => $products, "count" => $product_count, "limit" => $limit));
                
                break;
        }
    }
    
    public function actionFilter($sort = NULL, $price = NULL, $brands = NULL, $category = NULL, $size = NULL){
                
        $this->breadcrumb[] = "category";
        $this->breadcrumb[] = "product";
        $this->breadcrumb[] = "filter";
        
        $start = 0;
        $limit = 20;
        
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
        
        // if customer filter per brand
        if(isset($brands)){
            
            $brandsName = explode('--', $brands);
            
            $page = $_GET['page'];
            
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
            
            $products = \backend\models\Product::find()
                ->offset($start)
                ->limit($limit)
                ->joinWith([
                    "brands",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(["in", "brands.link_rewrite", $brandsName])
                ->orderBy('brands.brand_name ASC')
                ->all();
            
        } else {
            
            $page = $_GET['page'];
            
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
            
            $products = \backend\models\Product::find()
                ->offset($start)
                ->limit($limit)
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->orderBy('brands.brand_name ASC')
                ->all();
        }
        
        $i = 0;
        
        foreach($products as $row){
            $product_id[$i] = $row->product_id;
            $i++;
        }
        
        $i = 0;
        $category_selected = [];
        
        // check category selected
        
        while($element = current($_GET)){
            if(key($_GET) != "brands" && key($_GET) != "sort" && key($_GET) != "price" && key($_GET) != "size" && key($_GET) != "page" && key($_GET) != "limit"){
                $selected = \backend\models\Feature::find()->select('feature_id')->where(["like", "feature_name", key($_GET)])->one();
                $category_selected[$i] = key($_GET);
                $i++;
            }
            next($_GET);
        }
        
        // get product_id category selected
        
        for($i = 0; $i < count($category_selected); $i++){
            $genders = explode('--', $_GET[$category_selected[$i]]);
            
            for($j = 0; $j < count($genders); $j++){
                $genders[$j] = str_replace("-", " ", $genders[$j]);
            }
            
            $feature_value_id = \backend\models\ProductFeatureValue::find()->select('feature_value_id')->where(['in', 'feature_value_name', $genders])->all();
            $j = 0;
            foreach($feature_value_id as $row){
                $feature_value[$j] = $row->feature_value_id;
                $j++;
            }

            $selected = \backend\models\Feature::find()->where(["like", "feature_name", $category_selected[$i]])->one();
            $gender = \backend\models\ProductFeature::find()
                    ->where(["feature_id" => $selected['feature_id']])
                    ->andWhere(["in", "product_id", $product_id])
                    ->andWhere(['in', 'feature_value_id', $feature_value])
                    ->all();
            
            $product_id = [];
            $j = 0;
            
            foreach($gender as $row){
                $product_id[$j] = $row->product_id;
                $j++;
            }
        }
        
        if(isset($_GET['sort'])){
            $sort = $_GET['sort'];
            $now = date('Y-m-d H:i:s');
            
            // if sort by new arrival
            if($sort == 'new-arrival'){
                
                if(isset($brands)){
            
                    $brandsName = explode('--', $brands);
                    
                    $productNewArrival = \backend\models\Product::find()
                        ->joinWith(["productNewArrival", "brands"])
                        ->where(["in", "brands.link_rewrite", $brandsName])
                        ->andWhere(["<=", "product_newarrival_start_date", $now])
                        ->andWhere([">=", "product_newarrival_end_date", $now])
                        ->all();

                    $product_id = [];
                    $j = 0;
                    
                } else {
                    $productNewArrival = \backend\models\Product::find()
                        ->joinWith(["productNewArrival"])
                        ->where(["<=", "product_newarrival_start_date", $now])
                        ->andWhere([">=", "product_newarrival_end_date", $now])
                        ->all();

                    $product_id = [];
                    $j = 0;
                }
                foreach($productNewArrival as $row){
                    $product_id[$j] = $row->product_id;
                    $j++;
                }
                
            } elseif($sort == 'all-product'){
                
            }
        }
        
        if(isset($_GET['price'])){
            
            $prices = explode('--', $_GET['price']);
            
            $page = $_GET['page'];
            
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
            
            $price = \backend\models\Product::find()
                    ->offset($start)
                    ->limit($limit)
                    ->where(["in", "product_id", $product_id])
                    ->andWhere(['between', 'price', str_replace('.', '', $prices[0]), str_replace('.', '', $prices[1])])
                    ->all();
            
            $product_id = [];
            $j = 0;
            
            foreach($price as $row){
                $product_id[$j] = $row->product_id;
                $j++;
            }
            
            if(isset($_GET['brands'])){
                $count = \backend\models\Product::find()
                    ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection",
                        "productImage" => function ($query) {
                            $query->andWhere(['cover' => 1]);
                        }
                    ])
                    ->where(["in", "brands.link_rewrite", $brandsName])
//                    ->andWhere(["in", "product.product_id", $product_id])
                    ->andWhere(['between', 'price', str_replace('.', '', $prices[0]), str_replace('.', '', $prices[1])])
                    ->orderBy('product.product_id DESC')
                    ->all();
            } else {
                $category = \backend\models\ProductCategory::find()
                            ->where(["product_category_name" => "watches"])
                            ->one();
            
                $count = \backend\models\Product::find()
                        ->joinWith([
                            "brands",
                            "productDetail",
                            "brandsCollection",
                            "productImage" => function ($query) {
                                $query->andWhere(['cover' => 1]);
                            }
                        ])
                        ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                        ->andWhere(['between', 'price', str_replace('.', '', $prices[0]), str_replace('.', '', $prices[1])])
                        ->orderBy('product.product_id DESC')
                        ->all();
            } 
            
            
                    
        }
        
        if(isset($_GET['size'])){
            $sizes = explode('--', $_GET['size']);
            
            $productBySize = \backend\models\ProductFeature::find()->select('product_id')->joinWith(["productFeatureValue"])->where(['product_feature_value.feature_id' => 5])->andWhere(["between", "product_feature_value.feature_value_value", $sizes[0], $sizes[1]])->all();
            
            $product_size = [];
            $j = 0;
            
            foreach($productBySize as $row){
                $product_size[$j] = $row->product_id;
                $j++;
            }
            
            $size = \backend\models\Product::find()
                    ->where(["in", "product_id", $product_id])
                    ->andWhere(["in", "product_id", $product_size])
                    ->all();
            
            $product_id = [];
            $j = 0;
            
            foreach($size as $row){
                $product_id[$j] = $row->product_id;
                $j++;
            }
        }
        
        if(isset($_GET['page'])) {
            
            $page = $_GET['page'];
            
            if($page == 1){
        

                $category = \backend\models\ProductCategory::find()
                            ->where(["product_category_name" => "watches"])
                            ->one();
                

            } else {
                $category = \backend\models\ProductCategory::find()
                            ->where(["product_category_name" => "watches"])
                            ->one();

//                $count = \backend\models\Product::find()
//                    ->joinWith([
//                        "brands",
//                        "productDetail",
//                        "brandsCollection",
//                        "productImage" => function ($query) {
//                            $query->andWhere(['cover' => 1]);
//                        }
//                    ])
//                    ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
//                    ->orderBy('product.product_id DESC')
//                    ->all()
            }
        }

        $product_count = count($count); 
        
        return $this->render('filter', array("products" => $products, "count" => $product_count, "limit" => $limit));
    }
    
    public function actionSearch($q){
        
        $this->breadcrumb[] = "category";
        $this->breadcrumb[] = "explore";
        $this->breadcrumb[] = "search";
        
        $start = 0;
        $limit = 20;
        
        $searchReference = false;
        
        if(isset($q)){
            
            if(isset($_GET['limit'])){
                $limit = $_GET['limit'];
            }
            
            if(isset($_GET['page'])) {
            
            $page = $_GET['page'];
            
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
            
            $products = \backend\models\Product::find()
                ->offset($start)
                ->limit($limit)
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection" => function ($query) {
                        $query->andWhere(['brands_collection_status' => 1]);
                    },
                    "productTag",
//                    "tags",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where([
                    'LIKE', 'product_detail.name', '%'.$q.'%', false, 
//                    'OR', 'tags.tag_name', 'LIKE', '%'.$q.'%', false, 
//                    'product.active' => 1
                ])
                ->orWhere([
                    'LIKE', 'brands.brand_name', '%'.$q.'%', false, 
                ])
                ->orWhere([
                    'LIKE', 'brands_collection.brands_collection_name', '%'.$q.'%', false, 
                ])        
                ->orderBy('product.product_id DESC')
                ->all();
            
            $count = \backend\models\Product::find()
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection" => function ($query) {
                        $query->andWhere(['brands_collection_status' => 1]);
                    },
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where([
                    'LIKE', 'product_detail.name', '%'.$q.'%', false, 
//                    'OR', 'tags.tag_name', 'LIKE', '%'.$q.'%', false, 
//                    'product.active' => 1
                ])
                ->orWhere([
                    'LIKE', 'brands.brand_name', '%'.$q.'%', false, 
                ])
                ->orWhere([
                    'LIKE', 'brands_collection.brands_collection_name', '%'.$q.'%', false, 
                ])   
                ->orderBy('product.product_id DESC')
                ->all();
            } else {
                $products = \backend\models\Product::find()
                ->offset($start)
                ->limit($limit)
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection" => function ($query) {
                        $query->andWhere(['brands_collection_status' => 1]);
                    },
                    "productTag",
//                    "tags",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where([
                    'LIKE', 'product_detail.name', '%'.$q.'%', false, 
//                    'OR', 'tags.tag_name', 'LIKE', '%'.$q.'%', false, 
//                    'product.active' => 1
                ])
                ->orWhere([
                    'LIKE', 'brands.brand_name', '%'.$q.'%', false, 
                ])
                ->orWhere([
                    'LIKE', 'brands_collection.brands_collection_name', '%'.$q.'%', false, 
                ])        
                ->andWhere(['product.active' => 1])
                ->orderBy('product.product_id DESC')
                ->all();
            
            $count = \backend\models\Product::find()
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection" => function ($query) {
                        $query->andWhere(['brands_collection_status' => 1]);
                    },
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
//                    ->where(['product.active' => 1])
                ->where([
                    'LIKE', 'product_detail.name', '%'.$q.'%', false, 
//                    'OR', 'tags.tag_name', 'LIKE', '%'.$q.'%', false, 
//                    'product.active' => 1
                ])
                ->orWhere([
                    'LIKE', 'brands.brand_name', '%'.$q.'%', false, 
                ])
                ->orWhere([
                    'LIKE', 'brands_collection.brands_collection_name', '%'.$q.'%', false, 
                ])  
                        ->andWhere(['product.active' => 1])
                ->orderBy('product.product_id DESC')
                ->all();
            }

            $product_count = count($count); 
            
            $searchReference = $product_count == 0 ? true : false;
                
            return $this->render('search', array("products" => $products, "count" => $product_count, "limit" => $limit, "searchReference" => $searchReference));
        }
    }
}
