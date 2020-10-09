<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Session;

use frontend\core\controller;
use backend\models\BrandsBanner;
use backend\models\BrandsBannerDetail;

class CampaignController extends controller\FrontendController {
    
    public $breadcrumb = ["Promo"];
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
    
	public function actionMychristmaswish(){
        $this->layout = false;
        return $this->render('mychristmastwish'); 
    }
	
    public function actionSecretdeal(){
        $this->layout = false;
        return $this->render('secretdeal'); 
    }
    public function actionAnz(){
        
        
        return $this->render('anz'); 
    }
	
	public function actionHariAyah(){
		
		$products = \backend\models\Product::find()
			->joinWith([
				"brands",
				"productDetail",
				"brandsCollection",
				"specificPrice",
				"productImage" => function ($query) {
					$query->andWhere(['cover' => 1]);
				}
			])
			->where(['product.active' => 1, 'product.product_id' => [684, 681, 7, 11, 974, 1001, 413, 407]])
			->orderBy('brands.brand_name ASC')
			->all();
		
		return $this->render('hari-ayah', array('products' => $products)); 
	}
	
	public function actionBundlingMagazine(){
        // $this->breadcrumb[] = "explore";
        // $this->breadcrumb[] = "all";
        
        // $productList = \backend\models\Product::getProductsDetails(
            // ['brands_collection_id' => [113, 151], 'product_category_id' => 7, 'active' => 1]
        // );
        
        // return $this->render('landingBundling', array(
            // "products" => $productList
        // ));
		
		return $this->redirect('http://thewatch.co');
    }
	
	public function actionHpnthank(){
        return $this->render('thankyou-hpn');
    }
    
    public function actionHpn(){
        $data = $_POST;
        
        if($data){
            
            $customer = \backend\models\Customer::find()
                    ->where(["email" => $data['customerInfo']['email']])
                    ->one();
            
            // if email already exist
            if($customer){
                echo 'FALSE';
                return;
            }
            
            $signup = new \backend\models\Customer();
            $signup->email = $data['customerInfo']['email'];
            $signup->firstname = $data['customerInfo']['fname'];
            $signup->lastname = $data['customerInfo']['lname'];
            $signup->passwd = md5($data['customerInfo']['password']);
            $signup->apps_language_id = 1;
            $signup->active = 1;
            $signup->newsletter = 1;
            $signup->birthday = $data['customerInfo']['birth'];
            $signup->gender_id = $data['customerInfo']['gender'];
            
            try {
                
                $signup->save();
                
                \common\components\Helpers::sendEmailMandrillUrlAPI(
                    $this->renderFile('@app/views/template/mail/signup.php', array(
                        "username" => $data['customerInfo']['email'], 
                        "password" => $data['customerInfo']['password']
                    )), 
                    'Welcome To The Watch Co', 
                    Yii::$app->params['adminEmail'], 
                    $data['customerInfo']['email'], 
                    ''
                );
                
                $newsletter = \backend\models\NewsletterSignup::findOne(['newsletter_signup_email' => $data['customerInfo']['email']]);
                
                // insert new if email not exist
                if($newsletter == NULL){
                    $newsletter = new \backend\models\NewsletterSignup();
                    $newsletter->newsletter_signup_email = $data['customerInfo']['email'];
                    $newsletter->newsletter_signup_firstname = $data['customerInfo']['fname'];
                    $newsletter->newsletter_signup_date_add = date("Y-m-d H:i:s");
                    $newsletter->save();
                }
                
                return 'TRUE';
                
            } catch (Exception $ex) {
//                print_r(\Yii::info());
//                die();
                return 'FALSE';
            }
            
            // bypass default subscribe newsletter
//            if($data['customerInfo']['newsletter'] == 1){
                
//            }
            
            $order = new CustomerForm();
            $order->create($data);
            
            return TRUE;
            
        } else {
            
            return $this->render('signup-hpn');
            
        }
    }
    
    public function actionDwsummer($variant){
        $this->breadcrumb[] = "explore";
        $this->breadcrumb[] = "all";
        
        $category = \backend\models\ProductCategory::find()
                    ->where(["product_category_name" => "watches"])
                    ->one();
        
        $category_straps = \backend\models\ProductCategory::find()
                    ->where(["product_category_name" => "straps"])
                    ->one();
        
        switch ($variant){
            
            case "dw40mm":
                
                $products = \backend\models\Product::find()
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1, 'product.brands_collection_id' => 36])
                ->orderBy('brands.brand_name ASC')
                ->all();
                
                $straps = \backend\models\Product::find()
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product.product_category_id' => $category_straps->product_category_id, 'product.active' => 1, 'product.brands_collection_id' => 36])
                ->orderBy('brands.brand_name ASC')
                ->all();
                
                return $this->render('dwsummer_40mm', array("products" => $products, "straps" => $straps));
                
                break;
            
            case "dw36mm":
                
                $products = \backend\models\Product::find()
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1, 'product.brands_collection_id' => 34])
                ->orderBy('brands.brand_name ASC')
                ->all();
                
                $straps = \backend\models\Product::find()
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product.product_category_id' => $category_straps->product_category_id, 'product.active' => 1, 'product.brands_collection_id' => 36])
                ->orderBy('brands.brand_name ASC')
                ->all();
                
                return $this->render('dwsummer_36mm', array("products" => $products, "straps" => $straps));
                
                break;
            
            case "dw34mm":
                
                $products = \backend\models\Product::find()
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1, 'product.brands_collection_id' => 35])
                ->orderBy('brands.brand_name ASC')
                ->all();
                
                $straps = \backend\models\Product::find()
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product.product_category_id' => $category_straps->product_category_id, 'product.active' => 1, 'product.brands_collection_id' => 36])
                ->orderBy('brands.brand_name ASC')
                ->all();
                
                return $this->render('dwsummer_34mm', array("products" => $products, "straps" => $straps));
                
                break;
            
            case "dw26mm":
                
                $products = \backend\models\Product::find()
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1, 'product.brands_collection_id' => 33])
                ->orderBy('brands.brand_name ASC')
                ->all();
                
                $straps = \backend\models\Product::find()
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product.product_category_id' => $category_straps->product_category_id, 'product.active' => 1, 'product.brands_collection_id' => 36])
                ->orderBy('brands.brand_name ASC')
                ->all();
                
                return $this->render('dwsummer_26mm', array("products" => $products, "straps" => $straps));
                
                break;
            
            case "dwgrace":
                
                $products = \backend\models\Product::find()
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1, 'product.brands_collection_id' => 37])
                ->orderBy('brands.brand_name ASC')
                ->all();
                
                $straps = \backend\models\Product::find()
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product.product_category_id' => $category_straps->product_category_id, 'product.active' => 1, 'product.brands_collection_id' => 36])
                ->orderBy('brands.brand_name ASC')
                ->all();
                
                return $this->render('dwsummer_grace', array("products" => $products, "straps" => $straps));
                
                break;
        }
        
    }
    
    public function actionLanding(){
        // $this->breadcrumb[] = "explore";
        // $this->breadcrumb[] = "all";
        
        //$productList = \backend\models\Product::getProductsDetails(
        //    ['brands_collection_id' => [33, 35, 34, 36, 37, 38], 'product_category_id' => 5, 'active' => 1]
        //);
		
		// $productList = \backend\models\Product::find()
			// ->with([
                    // "brands",
                    // "productDetail",
                    // "brandsCollection",
                    // "productImage" => function ($query) {
                        // $query->andWhere(['cover' => 1]);
                    // },
                // ])
                // ->where(['brands_collection_id' => [33, 35, 34, 36, 37, 38], 'product_category_id' => 5, 'active' => 1])
                // ->orderBy([new \yii\db\Expression('FIELD (product.brands_collection_id, ' . '33, 35, 34, 36, 37, 38' . ')')])
                // ->all();
        
        // return $this->render('landingPage', array(
            // "products" => $productList
        // ));
		
		$this->redirect('http://thewatch.co');
    }
    
    public function actionProduct($productName){
        
        $product = \backend\models\ProductDetail::find()
            ->where(["product_detail.link_rewrite" => $productName])
            ->one();

        $productDetail = \backend\models\Product::getProductDetails(
            ["product.product_id" => $product->product_id]
        );
        
        $productWarranty = \backend\models\ProductWarranty::findOne(['product_id' => $product->product_id]);
        
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

        $brand = \backend\models\Brands::findOne($productDetail->brands_brand_id);
        $this->title = " - " . ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name));

        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $productDetail->productDetail->meta_description]);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $productDetail->productDetail->meta_keywords]);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name))]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'product']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'http://www.thewatch.co/products/' . $productDetail->productDetail->link_rewrite ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'http://www.thewatch.co/img/product/' . $productDetail->product_id . '/' . $productDetail->product_id . '.jpg' ]);
        
        $productListCampaign = \backend\models\Product::getProductsDetails(
            ['product_id' => [457, 456, 455, 459, 458, 448, 465, 469, 443, 468, 446, 471, 444, 466, 447, 472, 442, 467, 445, 470], 'active' => 1]
        );
        
        return $this->render('productDetail', array(
            "productImages" => $productImages,
            "product" => $productDetail,
            "productAttributeCombination" => $productAttributeCombination,
            "id" => $product->product_id,
            "productWarranty" => $productWarranty,
            "productCampaign" => $productListCampaign
        ));
    }
    
}
