<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\core\controller;
use backend\models\BrandsBanner;
use yii\db\Expression;
use backend\models\BrandsBannerDetail;

class ProductController extends controller\FrontendController {

//    public $breadcrumb = ["product"];

    public $title = "";
    
    /**
     * @inheritdoc
     */
    public function behaviors() {
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
    public function actions() {
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

    public function actionIndex() {
        $this->breadcrumb[] = "explore";
        $this->breadcrumb[] = "all";

        $query = BrandsBanner::find()
                ->joinWith(['brands']);

        $data = $query
                ->select(['brands_banner.brand_banner_small_banner', 'brands_banner.brands_brand_id'])
                //->where('`brands`.`brand_id` = `brands_banner`.`brands_brand_id`')
                ->orderBy('brands.brand_name')
                ->all();

        return $this->render('index', array("data" => $data));
    }
    
    public function actionStock() {
//        $productAttribute = \backend\models\ProductAttributeCombination::find()->where(array("attribute_value_id" => $_POST['attribute_value_id']))->one();
        $quantity = \backend\models\ProductStock::findOne(["product_attribute_id" => $_POST['attribute_value_id']]);
        return $this->renderFile('@app/views/product/quantity.php', array("quantity" => $quantity));
    }

        public function actionStockcolor() {
//        $productAttribute = \backend\models\ProductAttributeCombination::find()->where(array("attribute_value_id" => $_POST['attribute_value_id']))->one();
        $product_attribute = explode("+", $_POST['attribute_value_id']);
         $att_com = \backend\models\ProductAttributeCombination::find()->where(["product_attribute_id" => $product_attribute,"attribute_value_id"=>$_POST['attribute_value'],"attribute_value_id_2"=>$_POST['attribute_value_2']])->one();
        $quantity = \backend\models\ProductStock::findOne(["product_attribute_id" => $att_com->product_attribute_id]);
        return $this->renderFile('@app/views/product/quantity.php', array("quantity" => $quantity));
    }
    public function actionStocksize() {
//        $productAttribute = \backend\models\ProductAttributeCombination::find()->where(array("attribute_value_id" => $_POST['attribute_value_id']))->one();
        $product_attribute = explode("+", $_POST['attribute_value_id']);
         $att_com = \backend\models\ProductAttributeCombination::find()->where(["product_attribute_id" => $product_attribute,"attribute_value_id"=>$_POST['attribute_value'],"attribute_value_id_2"=>$_POST['attribute_value_2']])->one();
        $quantity = \backend\models\ProductStock::findOne(["product_attribute_id" => $att_com->product_attribute_id]);
        return $this->renderFile('@app/views/product/quantity.php', array("quantity" => $quantity));
    }
    public function actionViewsize() {
        $product_attribute = explode("+", $_POST['attribute_value_id']);
       $quantity = \backend\models\ProductAttributeCombination::find()->where(array("product_attribute_id" => $product_attribute, "attribute_value_id"=>$_POST['attribute_value']))->all();
        // $quantity = \backend\models\ProductStock::findOne(["product_attribute_id" => $_POST['attribute_value_id']]);
        return $this->renderFile('@app/views/product/viewsize.php', array("quantity" => $quantity));
    }

    public function actionPrice() {
        return $this->renderFile('@app/views/product/price.php', array("quantity" => $_POST['quantity'], "price" => $_POST['price']));
    }
    
    public function actionPreorder($productName) {
        $product = \backend\models\ProductDetail::find()
                ->where(["product_detail.link_rewrite" => $productName])
                ->one();
        
        $productDetail = \backend\models\Product::getProductDetails(
			[
				"product.product_id" => $product->product_id,
			]
        );
        
		$brands_id = $productDetail->brandsCollection->brands_collection_id;
		
	
        
        $productWarranty = \backend\models\ProductWarranty::findOne(['product_id' => $product->product_id]);
        $brandCategoryId = [80,73];
        $duapuluhmm = \backend\models\Product::find()
                ->joinWith([
                    "productDetail",
                    "brandsCollection",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(["brands_collection.brands_collection_id" => 74])
                ->orderBy(new Expression('rand()'))
                ->all();
        $duaduamm = \backend\models\Product::find()
                ->joinWith([
                    "productDetail",
                    "brandsCollection",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(["brands_collection.brands_collection_id" => $brandCategoryId])
                ->orderBy(new Expression('rand()'))
                ->all();
		
	
        
        $productWarranty = \backend\models\ProductWarranty::findOne(['product_id' => $product->product_id]);

        
        $productFeature = \backend\models\ProductFeature::find()->where(['product_id'=>$product->product_id, 'feature_id'=> 3])->all();
        $productCategory = \backend\models\Product::find()->where(['product_id'=>$product->product_id])->one();
        $feature_val_id = array();
                        
        $p = 0;
        foreach($productFeature as $result){
                          
            $feature_val_id[$p] = $result['feature_value_id'];
            $p++;
        }
        
        if(sizeof($feature_val_id) == 0){
            $productRelated = \backend\models\Product::find()
                ->joinWith([
                    "productFeature",
                    "productDetail",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->limit(12)
                ->where(["product.brands_brand_id" => $product->product->brands_brand_id, 'product.active' => 1])
 
                ->orderBy(new Expression('rand()'))
                ->all();
        }else{
            $productRelated = \backend\models\Product::find()
                ->joinWith([
                    "productFeature",
                    "productDetail",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->limit(12)
                ->where(['product.product_category_id' => $productCategory->product_category_id, 'product.active' => 1])
                ->orderBy(new Expression('rand()'))
                ->all();
        }
        

        $productImages = \backend\models\ProductImage::find()
                ->where(["product_id" => $product->product_id])
                ->orderBy("cover desc")
                ->all();

        $productAttributeCombination = \backend\models\ProductAttributeCombination::find()
                ->joinWith([
                    "productAttribute",
                    "attributes",
                    "attributeValue",
                    "productStock"
                ])
                ->where(["product_attribute.product_id" => $product->product_id])
                ->all();
        
        
        $this->breadcrumb[] = $productDetail->productCategory->product_category_name;
        $this->breadcrumb[] = $productDetail->brands->brand_name;
        $this->breadcrumb[] = $product->name;

        $brand = \backend\models\Brands::findOne($productDetail->brands_brand_id);
        $this->title = ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name));
    
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $productDetail->productDetail->meta_description]);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $productDetail->productDetail->meta_keywords]);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name))]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Product Detail']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/products/' . $productDetail->productDetail->link_rewrite ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/product/' . $productDetail->productImage->product_image_id . '/' . $productDetail->productImage->product_image_id . '.jpg' ]);
        
		//\Yii::$app->view->registerJs('var scr = document.createElement("script");
		//scr.type = "text/javascript";
		//scr.async = true;
		//scr.src =  "//ssp.adskom.com/tags/third-party-async/MzNiZmUyZjUtN2MxYi00ZjU0LWFkMjMtMGQxOWIwZjMxZWZk";
		//document.body.appendChild(scr);');
		
        return $this->render('preorder', array(
                    "productImages" => $productImages,
                    "product" => $productDetail,
                    "productRelated" => $productRelated,
                    "productAttributeCombination" => $productAttributeCombination,
                    "id" => $product->product_id,
                    "productWarranty" => $productWarranty,
                    "brands_id" =>$brands_id,
                    "duapuluhmm" =>$duapuluhmm,
                    "duaduamm" =>$duaduamm
        ));
    }
    
    public function actionDetail($productName) {
        $product = \backend\models\ProductDetail::find()
                ->where(["product_detail.link_rewrite" => $productName])
                ->one();

        $productFeatures = \backend\models\ProductFeature::getProductFeatureBy((int) $product->product_id);

        $productDetail = \backend\models\Product::getProductDetails(
			[
				"product.product_id" => $product->product_id,
				"product.active" => 1
			]
        );
		$brands_id = $productDetail->brandsCollection->brands_collection_id;
		
		if($productDetail == NULL){
            $this->redirect(\yii\helpers\Url::base() . '/brand/' . strtolower($product->product->brands->brand_name));
        }
        
        $productWarranty = \backend\models\ProductWarranty::findOne(['product_id' => $product->product_id]);
        $brandCategoryId = [80,73];
        $duapuluhmm = \backend\models\Product::find()
                ->joinWith([
                    "productDetail",
                    "brandsCollection",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(["brands_collection.brands_collection_id" => 74])
                ->orderBy(new Expression('rand()'))
                ->all();
        $duaduamm = \backend\models\Product::find()
                ->joinWith([
                    "productDetail",
                    "brandsCollection",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(["brands_collection.brands_collection_id" => $brandCategoryId])
                ->orderBy(new Expression('rand()'))
                ->all();
		
		if($productDetail == NULL){
            $this->redirect(\yii\helpers\Url::base() . '/brand/' . strtolower($product->product->brands->brand_name));
        }
        
        $productWarranty = \backend\models\ProductWarranty::findOne(['product_id' => $product->product_id]);

        
        $productFeature = \backend\models\ProductFeature::find()->where(['product_id'=>$product->product_id, 'feature_id'=> 3])->all();
        $productCategory = \backend\models\Product::find()->where(['product_id'=>$product->product_id])->one();
        $feature_val_id = array();
                        
        $p = 0;
        foreach($productFeature as $result){
                          
            $feature_val_id[$p] = $result['feature_value_id'];
            $p++;
        }
        
        if(sizeof($feature_val_id) == 0){
            $productRelated = \backend\models\Product::find()
                ->joinWith([
                    "productFeature",
                    "productDetail",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->limit(12)
                ->where(["product.brands_brand_id" => $product->product->brands_brand_id, 'product.active' => 1])
 
                ->orderBy(new Expression('rand()'))
                ->all();
        }else{
            $productRelated = \backend\models\Product::find()
                ->joinWith([
                    "productFeature",
                    "productDetail",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->limit(12)
                ->where(['product.product_category_id' => $productCategory->product_category_id, 'product.active' => 1])
                ->orderBy(new Expression('rand()'))
                ->all();
        }
        

        $productImages = \backend\models\ProductImage::find()
                ->where(["product_id" => $product->product_id])
                ->orderBy("cover desc, product_image_id desc")
                ->all();

        $productAttributeCombination = \backend\models\ProductAttributeCombination::find()
                ->joinWith([
                    "productAttribute",
                    "attributes",
                    "attributeValue",
                    "productStock"
                ])
                ->where(["product_attribute.product_id" => $product->product_id])
                ->all();

        $this->breadcrumb[] = $productDetail->productCategory->product_category_name;
        $this->breadcrumb[] = $productDetail->brands->brand_name;
        $this->breadcrumb[] = $product->name;

        $brand = \backend\models\Brands::findOne($productDetail->brands_brand_id);
        $this->title = ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name));

        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $productDetail->productDetail->meta_description]);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $productDetail->productDetail->meta_keywords]);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name))]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Product Detail']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/products/' . $productDetail->productDetail->link_rewrite ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/product/' . $productDetail->productImage->product_image_id . '/' . $productDetail->productImage->product_image_id . '.jpg' ]);
        
		//\Yii::$app->view->registerJs('var scr = document.createElement("script");
		//scr.type = "text/javascript";
		//scr.async = true;
		//scr.src =  "//ssp.adskom.com/tags/third-party-async/MzNiZmUyZjUtN2MxYi00ZjU0LWFkMjMtMGQxOWIwZjMxZWZk";
		//document.body.appendChild(scr);');
		
        return $this->render('detail', array(
                    "productImages" => $productImages,
                    "product" => $productDetail,
                    "productFeatures" => $productFeatures, // get result array
                    "productRelated" => $productRelated,
                    "productAttributeCombination" => $productAttributeCombination,
                    "id" => $product->product_id,
                    "productWarranty" => $productWarranty,
                    "brands_id" =>$brands_id,
                    "duapuluhmm" =>$duapuluhmm,
                    "duaduamm" =>$duaduamm
        ));
    }
    
    public function actionFlash($productName) {
        $product = \backend\models\ProductDetail::find()
                ->where(["product_detail.link_rewrite" => $productName])
                ->one();

        $productDetail = \backend\models\Product::getProductDetails(
			[
				"product.product_id" => $product->product_id,
				"product.active" => 1
			]
        );
		$brands_id = $productDetail->brandsCollection->brands_collection_id;
		
		if($productDetail == NULL){
            $this->redirect(\yii\helpers\Url::base() . '/brand/' . strtolower($product->product->brands->brand_name));
        }
        
        $productWarranty = \backend\models\ProductWarranty::findOne(['product_id' => $product->product_id]);
        $brandCategoryId = [80,73];
        $duapuluhmm = \backend\models\Product::find()
                ->joinWith([
                    "productDetail",
                    "brandsCollection",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(["brands_collection.brands_collection_id" => 74])
                ->orderBy(new Expression('rand()'))
                ->all();
        $duaduamm = \backend\models\Product::find()
                ->joinWith([
                    "productDetail",
                    "brandsCollection",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(["brands_collection.brands_collection_id" => $brandCategoryId])
                ->orderBy(new Expression('rand()'))
                ->all();
		
		if($productDetail == NULL){
            $this->redirect(\yii\helpers\Url::base() . '/brand/' . strtolower($product->product->brands->brand_name));
        }
        
        $productWarranty = \backend\models\ProductWarranty::findOne(['product_id' => $product->product_id]);

        
        $productFeature = \backend\models\ProductFeature::find()->where(['product_id'=>$product->product_id, 'feature_id'=> 3])->all();
        $productCategory = \backend\models\Product::find()->where(['product_id'=>$product->product_id])->one();
        $feature_val_id = array();
                        
        $p = 0;
        foreach($productFeature as $result){
                          
            $feature_val_id[$p] = $result['feature_value_id'];
            $p++;
        }
        
        if(sizeof($feature_val_id) == 0){
            $productRelated = \backend\models\Product::find()
                ->joinWith([
                    "productFeature",
                    "productDetail",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    } 
                ])
                ->limit(12)
                ->where(["product.brands_brand_id" => $product->product->brands_brand_id, 'product.active' => 1])
 
                ->orderBy(new Expression('rand()'))
                ->all();
        }else{
            $productRelated = \backend\models\Product::find()
                ->joinWith([
                    "productFeature",
                    "productDetail",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->limit(12)
                ->where(['product.product_category_id' => $productCategory->product_category_id, 'product.active' => 1])
                ->orderBy(new Expression('rand()'))
                ->all();
        }
        

        $productImages = \backend\models\ProductImage::find()
                ->where(["product_id" => $product->product_id])
                ->orderBy("cover desc")
                ->all();

        $productAttributeCombination = \backend\models\ProductAttributeCombination::find()
                ->joinWith([
                    "productAttribute",
                    "attributes",
                    "attributeValue",
                    "productStock"
                ])
                ->where(["product_attribute.product_id" => $product->product_id])
                ->all();

        $this->breadcrumb[] = $productDetail->productCategory->product_category_name;
        $this->breadcrumb[] = $productDetail->brands->brand_name;
        $this->breadcrumb[] = $product->name;

        $brand = \backend\models\Brands::findOne($productDetail->brands_brand_id);
        $this->title = ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name));

        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $productDetail->productDetail->meta_description]);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $productDetail->productDetail->meta_keywords]);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name))]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Product Detail']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/products/' . $productDetail->productDetail->link_rewrite ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/product/' . $productDetail->productImage->product_image_id . '/' . $productDetail->productImage->product_image_id . '.jpg' ]);
        
		//\Yii::$app->view->registerJs('var scr = document.createElement("script");
		//scr.type = "text/javascript";
		//scr.async = true;
		//scr.src =  "//ssp.adskom.com/tags/third-party-async/MzNiZmUyZjUtN2MxYi00ZjU0LWFkMjMtMGQxOWIwZjMxZWZk";
		//document.body.appendChild(scr);');
		
        return $this->render('flash', array(
                    "productImages" => $productImages,
                    "product" => $productDetail,
                    "productRelated" => $productRelated,
                    "productAttributeCombination" => $productAttributeCombination,
                    "id" => $product->product_id,
                    "productWarranty" => $productWarranty,
                    "brands_id" =>$brands_id,
                    "duapuluhmm" =>$duapuluhmm,
                    "duaduamm" =>$duaduamm
        ));
    }

    public function actionFlashGo($productName) {
        $product = \backend\models\ProductDetail::find()
                ->where(["product_detail.link_rewrite" => $productName])
                ->one();

        $productDetail = \backend\models\Product::getProductDetails(
			[
				"product.product_id" => $product->product_id,
				"product.active" => 1
			]
        );
		$brands_id = $productDetail->brandsCollection->brands_collection_id;
		
		if($productDetail == NULL){
            $this->redirect(\yii\helpers\Url::base() . '/brand/' . strtolower($product->product->brands->brand_name));
        }
        
        $productWarranty = \backend\models\ProductWarranty::findOne(['product_id' => $product->product_id]);
        $brandCategoryId = [80,73];
        $duapuluhmm = \backend\models\Product::find()
                ->joinWith([
                    "productDetail",
                    "brandsCollection",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(["brands_collection.brands_collection_id" => 74])
                ->orderBy(new Expression('rand()'))
                ->all();
        $duaduamm = \backend\models\Product::find()
                ->joinWith([
                    "productDetail",
                    "brandsCollection",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(["brands_collection.brands_collection_id" => $brandCategoryId])
                ->orderBy(new Expression('rand()'))
                ->all();
		
		if($productDetail == NULL){
            $this->redirect(\yii\helpers\Url::base() . '/brand/' . strtolower($product->product->brands->brand_name));
        }
        
        $productWarranty = \backend\models\ProductWarranty::findOne(['product_id' => $product->product_id]);

        
        $productFeature = \backend\models\ProductFeature::find()->where(['product_id'=>$product->product_id, 'feature_id'=> 3])->all();
        $productCategory = \backend\models\Product::find()->where(['product_id'=>$product->product_id])->one();
        $feature_val_id = array();
                        
        $p = 0;
        foreach($productFeature as $result){
                          
            $feature_val_id[$p] = $result['feature_value_id'];
            $p++;
        }
        
        if(sizeof($feature_val_id) == 0){
            $productRelated = \backend\models\Product::find()
                ->joinWith([
                    "productFeature",
                    "productDetail",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    } 
                ])
                ->limit(12)
                ->where(["product.brands_brand_id" => $product->product->brands_brand_id, 'product.active' => 1])
 
                ->orderBy(new Expression('rand()'))
                ->all();
        }else{
            $productRelated = \backend\models\Product::find()
                ->joinWith([
                    "productFeature",
                    "productDetail",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->limit(12)
                ->where(['product.product_category_id' => $productCategory->product_category_id, 'product.active' => 1])
                ->orderBy(new Expression('rand()'))
                ->all();
        }
        

        $productImages = \backend\models\ProductImage::find()
                ->where(["product_id" => $product->product_id])
                ->orderBy("cover desc")
                ->all();

        $productAttributeCombination = \backend\models\ProductAttributeCombination::find()
                ->joinWith([
                    "productAttribute",
                    "attributes",
                    "attributeValue",
                    "productStock"
                ])
                ->where(["product_attribute.product_id" => $product->product_id])
                ->all();

        $this->breadcrumb[] = $productDetail->productCategory->product_category_name;
        $this->breadcrumb[] = $productDetail->brands->brand_name;
        $this->breadcrumb[] = $product->name;

        $brand = \backend\models\Brands::findOne($productDetail->brands_brand_id);
        $this->title = ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name));

        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $productDetail->productDetail->meta_description]);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $productDetail->productDetail->meta_keywords]);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name))]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Product Detail']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/products/' . $productDetail->productDetail->link_rewrite ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/product/' . $productDetail->productImage->product_image_id . '/' . $productDetail->productImage->product_image_id . '.jpg' ]);
        
		//\Yii::$app->view->registerJs('var scr = document.createElement("script");
		//scr.type = "text/javascript";
		//scr.async = true;
		//scr.src =  "//ssp.adskom.com/tags/third-party-async/MzNiZmUyZjUtN2MxYi00ZjU0LWFkMjMtMGQxOWIwZjMxZWZk";
		//document.body.appendChild(scr);');
		
        return $this->render('flash-go', array(
                    "productImages" => $productImages,
                    "product" => $productDetail,
                    "productRelated" => $productRelated,
                    "productAttributeCombination" => $productAttributeCombination,
                    "id" => $product->product_id,
                    "productWarranty" => $productWarranty,
                    "brands_id" =>$brands_id,
                    "duapuluhmm" =>$duapuluhmm,
                    "duaduamm" =>$duaduamm
        ));
    }

    public function actionDetailevent($productName) {
        $product = \backend\models\ProductDetail::find()
                ->where(["product_detail.link_rewrite" => $productName])
                ->one();

        $productDetail = \backend\models\Product::getProductDetails(
			[
				"product.product_id" => $product->product_id,
				"product.active" => 1
			]
        );
		$brands_id = $productDetail->brandsCollection->brands_collection_id;
		
		if($productDetail == NULL){
            $this->redirect(\yii\helpers\Url::base() . '/brand/' . strtolower($product->product->brands->brand_name));
        }
        
        $productWarranty = \backend\models\ProductWarranty::findOne(['product_id' => $product->product_id]);
        $brandCategoryId = [80,73];
        $duapuluhmm = \backend\models\Product::find()
                ->joinWith([
                    "productDetail",
                    "brandsCollection",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(["brands_collection.brands_collection_id" => 74])
                ->orderBy(new Expression('rand()'))
                ->all();
        $duaduamm = \backend\models\Product::find()
                ->joinWith([
                    "productDetail",
                    "brandsCollection",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(["brands_collection.brands_collection_id" => $brandCategoryId])
                ->orderBy(new Expression('rand()'))
                ->all();
		
		if($productDetail == NULL){
            $this->redirect(\yii\helpers\Url::base() . '/brand/' . strtolower($product->product->brands->brand_name));
        }
        
        $productWarranty = \backend\models\ProductWarranty::findOne(['product_id' => $product->product_id]);

        
        $productFeature = \backend\models\ProductFeature::find()->where(['product_id'=>$product->product_id, 'feature_id'=> 3])->all();
        $productCategory = \backend\models\Product::find()->where(['product_id'=>$product->product_id])->one();
        $feature_val_id = array();
                        
        $p = 0;
        foreach($productFeature as $result){
                          
            $feature_val_id[$p] = $result['feature_value_id'];
            $p++;
        }
        
        if(sizeof($feature_val_id) == 0){
            $productRelated = \backend\models\Product::find()
                ->joinWith([
                    "productFeature",
                    "productDetail",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->limit(12)
                ->where(["product.brands_brand_id" => $product->product->brands_brand_id, 'product.active' => 1])
 
                ->orderBy(new Expression('rand()'))
                ->all();
        }else{
            $productRelated = \backend\models\Product::find()
                ->joinWith([
                    "productFeature",
                    "productDetail",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->limit(12)
                ->where(['product.product_category_id' => $productCategory->product_category_id, 'product.active' => 1])
                ->orderBy(new Expression('rand()'))
                ->all();
        }
        

        $productImages = \backend\models\ProductImage::find()
                ->where(["product_id" => $product->product_id])
                ->orderBy("cover desc")
                ->all();

        $productAttributeCombination = \backend\models\ProductAttributeCombination::find()
                ->joinWith([
                    "productAttribute",
                    "attributes",
                    "attributeValue",
                    "productStock"
                ])
                ->where(["product_attribute.product_id" => $product->product_id])
                ->all();

        $this->breadcrumb[] = $productDetail->productCategory->product_category_name;
        $this->breadcrumb[] = $productDetail->brands->brand_name;
        $this->breadcrumb[] = $product->name;

        $brand = \backend\models\Brands::findOne($productDetail->brands_brand_id);
        $this->title = ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name));

        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $productDetail->productDetail->meta_description]);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $productDetail->productDetail->meta_keywords]);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name))]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Product Detail']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/products/' . $productDetail->productDetail->link_rewrite ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/product/' . $productDetail->productImage->product_image_id . '/' . $productDetail->productImage->product_image_id . '.jpg' ]);
        
		//\Yii::$app->view->registerJs('var scr = document.createElement("script");
		//scr.type = "text/javascript";
		//scr.async = true;
		//scr.src =  "//ssp.adskom.com/tags/third-party-async/MzNiZmUyZjUtN2MxYi00ZjU0LWFkMjMtMGQxOWIwZjMxZWZk";
		//document.body.appendChild(scr);');
		
        return $this->render('detailevent', array(
                    "productImages" => $productImages,
                    "product" => $productDetail,
                    "productRelated" => $productRelated,
                    "productAttributeCombination" => $productAttributeCombination,
                    "id" => $product->product_id,
                    "productWarranty" => $productWarranty,
                    "brands_id" =>$brands_id,
                    "duapuluhmm" =>$duapuluhmm,
                    "duaduamm" =>$duaduamm
        ));
    }
	
	public function actionHarbolnas($productName) {
        $product = \backend\models\ProductDetail::find()
                ->where(["product_detail.link_rewrite" => $productName])
                ->one();

        $productDetail = \backend\models\Product::getProductDetails(
			[
				"product.product_id" => $product->product_id,
				"product.active" => 1
			]
        );
		$brands_id = $productDetail->brandsCollection->brands_collection_id;
		
		if($productDetail == NULL){
            $this->redirect(\yii\helpers\Url::base() . '/brand/' . strtolower($product->product->brands->brand_name));
        }
        
        $productWarranty = \backend\models\ProductWarranty::findOne(['product_id' => $product->product_id]);
        $brandCategoryId = [80,73];
        $duapuluhmm = \backend\models\Product::find()
                ->joinWith([
                    "productDetail",
                    "brandsCollection",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(["brands_collection.brands_collection_id" => 74])
                ->orderBy(new Expression('rand()'))
                ->all();
        $duaduamm = \backend\models\Product::find()
                ->joinWith([
                    "productDetail",
                    "brandsCollection",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(["brands_collection.brands_collection_id" => $brandCategoryId])
                ->orderBy(new Expression('rand()'))
                ->all();
		
		if($productDetail == NULL){
            $this->redirect(\yii\helpers\Url::base() . '/brand/' . strtolower($product->product->brands->brand_name));
        }
        
        $productWarranty = \backend\models\ProductWarranty::findOne(['product_id' => $product->product_id]);

        
        $productFeature = \backend\models\ProductFeature::find()->where(['product_id'=>$product->product_id, 'feature_id'=> 3])->all();
        $productCategory = \backend\models\Product::find()->where(['product_id'=>$product->product_id])->one();
        $feature_val_id = array();
                        
        $p = 0;
        foreach($productFeature as $result){
                          
            $feature_val_id[$p] = $result['feature_value_id'];
            $p++;
        }
        
        if(sizeof($feature_val_id) == 0){
            $productRelated = \backend\models\Product::find()
                ->joinWith([
                    "productFeature",
                    "productDetail",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    } 
                ])
                ->limit(12)
                ->where(["product.brands_brand_id" => $product->product->brands_brand_id, 'product.active' => 1])
 
                ->orderBy(new Expression('rand()'))
                ->all();
        }else{
            $productRelated = \backend\models\Product::find()
                ->joinWith([
                    "productFeature",
                    "productDetail",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->limit(12)
                ->where(['product.product_category_id' => $productCategory->product_category_id, 'product.active' => 1])
                ->orderBy(new Expression('rand()'))
                ->all();
        }
        

        $productImages = \backend\models\ProductImage::find()
                ->where(["product_id" => $product->product_id])
                ->orderBy("cover desc")
                ->all();

        $productAttributeCombination = \backend\models\ProductAttributeCombination::find()
                ->joinWith([
                    "productAttribute",
                    "attributes",
                    "attributeValue",
                    "productStock"
                ])
                ->where(["product_attribute.product_id" => $product->product_id])
                ->all();

        $this->breadcrumb[] = $productDetail->productCategory->product_category_name;
        $this->breadcrumb[] = $productDetail->brands->brand_name;
        $this->breadcrumb[] = $product->name;

        $brand = \backend\models\Brands::findOne($productDetail->brands_brand_id);
        $this->title = ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name));

        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $productDetail->productDetail->meta_description]);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $productDetail->productDetail->meta_keywords]);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name))]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Product Detail']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/products/' . $productDetail->productDetail->link_rewrite ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/product/' . $productDetail->productImage->product_image_id . '/' . $productDetail->productImage->product_image_id . '.jpg' ]);
        
		//\Yii::$app->view->registerJs('var scr = document.createElement("script");
		//scr.type = "text/javascript";
		//scr.async = true;
		//scr.src =  "//ssp.adskom.com/tags/third-party-async/MzNiZmUyZjUtN2MxYi00ZjU0LWFkMjMtMGQxOWIwZjMxZWZk";
		//document.body.appendChild(scr);');
		
        return $this->render('flash-okt', array(
                    "productImages" => $productImages,
                    "product" => $productDetail,
                    "productRelated" => $productRelated,
                    "productAttributeCombination" => $productAttributeCombination,
                    "id" => $product->product_id,
                    "productWarranty" => $productWarranty,
                    "brands_id" =>$brands_id,
                    "duapuluhmm" =>$duapuluhmm,
                    "duaduamm" =>$duaduamm
        ));
    }

}
