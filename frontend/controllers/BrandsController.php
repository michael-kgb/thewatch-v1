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

class BrandsController extends controller\FrontendController {
    
    public $breadcrumb = ["Brands"];
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
    
    public function actionIndex()
    {
        $this->breadcrumb[] = "explore";
        $this->breadcrumb[] = "all";
        $flag = 'all';
        
        $alphabet = [0=>['alpha'=>'A','brand'=>[]],1=>['alpha'=>'B','brand'=>[]],2=>['alpha'=>'C','brand'=>[]],3=>['alpha'=>'D','brand'=>[]],4=>['alpha'=>'E','brand'=>[]],5=>['alpha'=>'F','brand'=>[]],6=>['alpha'=>'G','brand'=>[]],7=>['alpha'=>'H','brand'=>[]],8=>['alpha'=>'I','brand'=>[]],9=>['alpha'=>'J','brand'=>[]],10=>['alpha'=>'K','brand'=>[]],11=>['alpha'=>'L','brand'=>[]],12=>['alpha'=>'M','brand'=>[]],13=>['alpha'=>'N','brand'=>[]],14=>['alpha'=>'O','brand'=>[]],15=>['alpha'=>'P','brand'=>[]],16=>['alpha'=>'Q','brand'=>[]],17=>['alpha'=>'R','brand'=>[]],18=>['alpha'=>'S','brand'=>[]],19=>['alpha'=>'T','brand'=>[]],20=>['alpha'=>'U','brand'=>[]],21=>['alpha'=>'V','brand'=>[]],22=>['alpha'=>'W','brand'=>[]],23=>['alpha'=>'X','brand'=>[]],24=>['alpha'=>'Y','brand'=>[]],25=>['alpha'=>'Z','brand'=>[]]];
        // $alphabet = ['A'=>[],'B'=>[],'C'=>[],'D'=>[],'E'=>[],'F'=>[],'G'=>[],'H'=>[],'I'=>[],'J'=>[],'K'=>[],'L'=>[],'M'=>[],'N'=>[],'O'=>[],'P'=>[],'Q'=>[],'R'=>[],'S'=>[],'T'=>[],'U'=>[],'V'=>[],'W'=>[],'X'=>[],'Y'=>[],'Z'=>[]];

       
        $query = BrandsBanner::find()
                ->joinWith(['brands']);
        
        $data = $query
                ->select(['brands_banner.brand_banner_small_banner', 'brands_banner.brands_brand_id'])
                //->where('`brands`.`brand_id` = `brands_banner`.`brands_brand_id`')
                ->where(['brands.brand_status' => 'active'])
                ->orderBy('brands.brand_name')
                ->all();

        $j = 0;
        foreach ($alphabet as $row) {
            
            $i = 0;
            foreach ($data as $row2) {
                # code...
                // print_r($row2);echo $row2[0];die();
                // echo $row2[$i][0];echo strtoupper($first);die();
                $first = substr($row2->brands->brand_name,0,1);
                if($row['alpha'] == strtoupper($first)){

                    $alphabet[$j]['brand'][$i] = $row2->brands->brand_name;
                    $i++;
                }else{
                    $i = 0;
                }

                    
            }

            $j++;
            // print_r($alphabet);die();
            # code...
        }
        // print_r($alphabet);die();
        
        return $this->render('index', array("data" => $data,"group"=>$alphabet, "flag"=>$flag));
    }
    
    public function actionCategory($category)
    {
        $this->breadcrumb[] = "explore";
        $this->breadcrumb[] = "all";
        
        $alphabet = [0=>['alpha'=>'A','brand'=>[]],1=>['alpha'=>'B','brand'=>[]],2=>['alpha'=>'C','brand'=>[]],3=>['alpha'=>'D','brand'=>[]],4=>['alpha'=>'E','brand'=>[]],5=>['alpha'=>'F','brand'=>[]],6=>['alpha'=>'G','brand'=>[]],7=>['alpha'=>'H','brand'=>[]],8=>['alpha'=>'I','brand'=>[]],9=>['alpha'=>'J','brand'=>[]],10=>['alpha'=>'K','brand'=>[]],11=>['alpha'=>'L','brand'=>[]],12=>['alpha'=>'M','brand'=>[]],13=>['alpha'=>'N','brand'=>[]],14=>['alpha'=>'O','brand'=>[]],15=>['alpha'=>'P','brand'=>[]],16=>['alpha'=>'Q','brand'=>[]],17=>['alpha'=>'R','brand'=>[]],18=>['alpha'=>'S','brand'=>[]],19=>['alpha'=>'T','brand'=>[]],20=>['alpha'=>'U','brand'=>[]],21=>['alpha'=>'V','brand'=>[]],22=>['alpha'=>'W','brand'=>[]],23=>['alpha'=>'X','brand'=>[]],24=>['alpha'=>'Y','brand'=>[]],25=>['alpha'=>'Z','brand'=>[]]];

        if($category != 'watches' || $category != 'straps' || $category != 'accessories'){
            $category_id = [5,6,7];
            $flag = 'all';
        }
        if($category == 'watches'){
            $category_id = 5;
            $flag = 'watches';
        }
        if($category == 'straps'){
            $category_id = 6;
            $flag = 'straps';
        }
        if($category == 'accessories'){
            $category_id = 7;
            $flag = 'accessories';
        }
        $brands = \backend\models\ProductCategoryBrands::find()->joinWith(['brands'])->where(['product_category_category_id' => $category_id])->orderBy('brands.brand_name')->all();
        
        $brand_array = array();
        foreach ($brands as $brand) {
            array_push($brand_array, $brand->brands->brand_id);
        }
        // print_r($brand_array);die();
        $query = BrandsBanner::find()
                ->joinWith(['brands']);
        
        $data = $query
                ->select(['brands_banner.brand_banner_small_banner', 'brands_banner.brands_brand_id'])
                //->where('`brands`.`brand_id` = `brands_banner`.`brands_brand_id`')
                ->where(['brands.brand_status' => 'active','brands.brand_id'=>$brand_array])
                ->orderBy('brands.brand_name')
                ->all();
        $j = 0;
        foreach ($alphabet as $row) {
            
            $i = 0;
            foreach ($data as $row2) {
                # code...
                // print_r($row2);echo $row2[0];die();
                // echo $row2[$i][0];echo strtoupper($first);die();
                $first = substr($row2->brands->brand_name,0,1);
                if($row['alpha'] == strtoupper($first)){

                    $alphabet[$j]['brand'][$i] = $row2->brands->brand_name;
                    $i++;
                }else{
                    $i = 0;
                }

                    
            }

            $j++;
            // print_r($alphabet);die();
            # code...
        }
        return $this->render('index', array("data" => $data,"group"=>$alphabet, "flag"=>$flag));
        
    }
    
    public function actionDetail($brandName)
    {
        // $this->breadcrumb[] = "explore";
        // $this->breadcrumb[] = "all";
        
        $brand_detail = \backend\models\Brands::getBrandDetail(["brands.brand_name" => strtolower(str_replace('-', ' ', $brandName))]);
        
        $query = BrandsBannerDetail::find()
                ->joinWith(['brands']);
         
        $brandBanner = $query
                ->select(['brands_banner_detail.brands_banner_detail_slide_image'])
                ->where(["brands_banner_detail.brands_brand_id" => $brand_detail->brand_id])
                ->andWhere(["brands_banner_detail.brands_banner_featured_brand" => 0])
                ->andWhere(["brands_banner_detail.brands_banner_featured_mobile" => 0])
                ->orderBy('brands.brand_name')
                ->all();
                
        $brandBannerOg = $query
			->select(['brands_banner_detail.brands_banner_detail_slide_image', 'brands_banner_detail.brands_brand_id'])
			->where(["brands_banner_detail.brands_brand_id" => $brand_detail->brand_id])
			->andWhere(["brands_banner_detail.brands_banner_featured_brand" => 0])
			->orderBy('brands.brand_name')
			->one();
        
		$ogImage = '';
		
		if($brandBannerOg != NULL){
			$ogImage = $brandBannerOg->brands_banner_detail_slide_image;
		}
        
        // query product and filter
        $query_product = $this->actionProductSort($brand_detail,$category);
        $products = $query_product[0];
        $total_products = $query_product[1];
        
        $this->title = ucwords(strtolower($brand_detail->brand_name));
		
		$category = new \stdClass();
		$category->product_category_name = 'brand';
		
		$seo = \backend\models\SeoPagesContentBrands::findOne(['brand_id' => $brand_detail->brand_id]);
		
		if($seo != NULL){
			\Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $seo->seoPagesContent->seo_pages_meta_description]);
			\Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $seo->seoPagesContent->seo_pages_meta_keywords]);
			\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => $seo->seoPagesContent->seo_pages_meta_title]);
			\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => $seo->seoPagesContent->seo_pages_meta_title]);
		}else{
		    \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => ucwords(strtolower($brand_detail->brand_name))]);
		    \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => ucwords(strtolower($brand_detail->brand_name))]);
		    \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $brand_detail->brand_description]);
		    \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $brand_detail->brand_name]);
		}
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => ucwords(strtolower($brand_detail->brand_name))]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'http://www.thewatch.co/watches/brand/' . $brandName]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'http://www.thewatch.co/img/brand_banner/' . $brand_detail->brand_id . '/' . $ogImage]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image:alt', 'content' => ucwords(strtolower($brand_detail->brand_name))]);
        
        return $this->render('detail', array(
            "brandBanner" => $brandBanner, 
            "brand_detail" => $brand_detail,
            "products" => $products,
			"category" => $category,
			"brandId" => $brand_detail->brand_id,
			"brandName" => $brandName,
            "total_products" => $total_products,
        ));
    }
    
    public function actionJewelry($brandName)
    {
        $this->breadcrumb[] = "jewelry";
        
        $brand_detail = \backend\models\Brands::getBrandDetail(["brands.brand_name" => strtolower(str_replace('-', ' ', $brandName))]);
        
        $query = BrandsBannerDetail::find()
                ->joinWith(['brands']);
         
        $brandBanner = $query
                ->select(['brands_banner_detail.brands_banner_detail_slide_image', 'brands_banner_detail.brands_brand_id'])
                ->where(["brands_banner_detail.brands_brand_id" => $brand_detail->brand_id])
                ->andWhere(["brands_banner_detail.brands_banner_featured_brand" => 0])
                ->andWhere(["brands_banner_detail.brands_banner_featured_mobile" => 0,"brands_banner_detail.brands_banner_featured_jewelry" => 1])
                ->orderBy('brands.brand_name')
                ->all();
        
        $category = \backend\models\ProductCategory::find()
                ->where(["product_category_name" => "jewelry"])
                ->one();
        
        $brandBannerOg = $query
			->select(['brands_banner_detail.brands_banner_detail_slide_image', 'brands_banner_detail.brands_brand_id'])
			->where(["brands_banner_detail.brands_brand_id" => $brand_detail->brand_id])
			->andWhere(["brands_banner_detail.brands_banner_featured_brand" => 0])
			->orderBy('brands.brand_name')
			->one();
        
		$ogImage = '';
		
		if($brandBannerOg != NULL){
			$ogImage = $brandBannerOg->brands_banner_detail_slide_image;
		}
        
        // query product and filter
        $query_product = $this->actionProductSort($brand_detail,$category);
        $products = $query_product[0];
        $total_products = $query_product[1];
       
        $this->title = "Jewelry - " . ucwords(strtolower($brand_detail->brand_name));
        
        $seo = \backend\models\SeoPagesContentBrands::findOne(['brand_id' => $brand_detail->brand_id]);
        
        if($seo != NULL){
            \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $seo->seoPagesContent->seo_pages_meta_description]);
            \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $seo->seoPagesContent->seo_pages_meta_keywords]);
            \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => $seo->seoPagesContent->seo_pages_meta_title]);
            \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => $seo->seoPagesContent->seo_pages_meta_title]);
          
        }else{
            \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => ucwords(strtolower($brand_detail->brand_name)) . ' Jewelry']);
            \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $brand_detail->brand_description]);
            \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $brand_detail->brand_name]);
        }
		
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => ucwords(strtolower($brand_detail->brand_name)) . ' Jewelry']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'http://www.thewatch.co/watches/brand/' . $brandName]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'http://www.thewatch.co/img/brand_banner/' . $brand_detail->brand_id . '/' . $ogImage]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image:alt', 'content' => ucwords(strtolower($brand_detail->brand_name))]);
               
        $AdskomTagging = \backend\models\ProductCategoryBrands::find()->where([
            'product_category_category_id' => 7, 
            'brands_brand_id' => $brand_detail->brand_id
        ])->one();
        
        \Yii::$app->view->registerJs('var scr = document.createElement("script");
        scr.type = "text/javascript";
        scr.async = true;
        scr.src =  "' . $AdskomTagging->adskom_tagging_script . '";
        document.body.appendChild(scr);');
        
        return $this->render('detail', array(
            "brandBanner" => $brandBanner, 
            "brand_detail" => $brand_detail,
            "products" => $products,
            "category" => $category,
            "brandId" => $brand_detail->brand_id,
            "brandName" => $brandName,
            "total_products" => $total_products,
        ));
    }
    
    public function actionAccessories($brandName)
    {
        $this->breadcrumb[] = "accessories";
        
        $brand_detail = \backend\models\Brands::getBrandDetail(["brands.brand_name" => strtolower(str_replace('-', ' ', $brandName))]);
        
        $query = BrandsBannerDetail::find()
                ->joinWith(['brands']);
         
        $brandBanner = $query
                ->select(['brands_banner_detail.brands_banner_detail_slide_image', 'brands_banner_detail.brands_brand_id'])
                ->where(["brands_banner_detail.brands_brand_id" => $brand_detail->brand_id])
                ->andWhere(["brands_banner_detail.brands_banner_featured_brand" => 0])
                ->andWhere(["brands_banner_detail.brands_banner_featured_mobile" => 0])
                ->orderBy('brands.brand_name')
                ->all();
        
        $category = \backend\models\ProductCategory::find()
                ->where(["product_category_name" => "accessories"])
                ->one();
        
        $brandBannerOg = $query
			->select(['brands_banner_detail.brands_banner_detail_slide_image', 'brands_banner_detail.brands_brand_id'])
			->where(["brands_banner_detail.brands_brand_id" => $brand_detail->brand_id])
			->andWhere(["brands_banner_detail.brands_banner_featured_brand" => 0])
			->orderBy('brands.brand_name')
			->one();
        
		$ogImage = '';
		
		if($brandBannerOg != NULL){
			$ogImage = $brandBannerOg->brands_banner_detail_slide_image;
		}
        
        // query product and filter
        $query_product = $this->actionProductSort($brand_detail,$category);
        $products = $query_product[0];
        $total_products = $query_product[1];
       
        $this->title = "Accessories - " . ucwords(strtolower($brand_detail->brand_name));
        
        if($seo != NULL){
			\Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $seo->seoPagesContent->seo_pages_meta_description]);
			\Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $seo->seoPagesContent->seo_pages_meta_keywords]);
			\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => $seo->seoPagesContent->seo_pages_meta_title]);
			\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => $seo->seoPagesContent->seo_pages_meta_title]);
			
		}else{
		    \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => ucwords(strtolower($brand_detail->brand_name)) . ' Accessories']);
		    \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $brand_detail->brand_description]);
		    \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $brand_detail->brand_name]);
		}
		
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
   
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => ucwords(strtolower($brand_detail->brand_name)) . ' Accessories']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'http://www.thewatch.co/watches/brand/' . $brandName]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'http://www.thewatch.co/img/brand_banner/' . $brand_detail->brand_id . '/' . $ogImage]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image:alt', 'content' => ucwords(strtolower($brand_detail->brand_name))]);
        
		$AdskomTagging = \backend\models\ProductCategoryBrands::find()->where([
            'product_category_category_id' => 7, 
            'brands_brand_id' => $brand_detail->brand_id
        ])->one();
		
		\Yii::$app->view->registerJs('var scr = document.createElement("script");
		scr.type = "text/javascript";
		scr.async = true;
		scr.src =  "' . $AdskomTagging->adskom_tagging_script . '";
		document.body.appendChild(scr);');
		
        return $this->render('detail', array(
            "brandBanner" => $brandBanner, 
            "brand_detail" => $brand_detail,
            "products" => $products,
            "category" => $category,
            "brandId" => $brand_detail->brand_id,
            "brandName" => $brandName,
            "total_products" => $total_products,
        ));
    }
    
    public function actionWatches($brandName)
    {
        $this->breadcrumb[] = "watches";
        
        $brand_detail = \backend\models\Brands::getBrandDetail(["brands.brand_name" => strtolower(str_replace('-', ' ', $brandName))]);
        
        $query = BrandsBannerDetail::find()
                ->joinWith(['brands']);
         
        $brandBanner = $query
                ->select(['brands_banner_detail.brands_banner_detail_slide_image', 'brands_banner_detail.brands_brand_id'])
                ->where(["brands_banner_detail.brands_brand_id" => $brand_detail->brand_id])
                ->andWhere(["brands_banner_detail.brands_banner_featured_brand" => 0])
                ->andWhere(["brands_banner_detail.brands_banner_featured_mobile" => 0])
				->andWhere(["brands_banner_detail.brands_banner_featured_jewelry" => 0])
                ->orderBy('brands.brand_name')
                ->all();
				
		$brandBannerOg = $query
			->select(['brands_banner_detail.brands_banner_detail_slide_image', 'brands_banner_detail.brands_brand_id'])
			->where(["brands_banner_detail.brands_brand_id" => $brand_detail->brand_id])
			->andWhere(["brands_banner_detail.brands_banner_featured_brand" => 0])
			->orderBy('brands.brand_name')
			->one();
        
        $category = \backend\models\ProductCategory::find()
                ->where(["product_category_name" => "watches"])
                ->one();
				
		$ogImage = '';
		
		if($brandBannerOg != NULL){
			$ogImage = $brandBannerOg->brands_banner_detail_slide_image;
		}
        
        // query product and filter
        $query_product = $this->actionProductSort($brand_detail,$category);
        $products = $query_product[0];
        $total_products = $query_product[1];
		
		$AdskomTagging = \backend\models\ProductCategoryBrands::find()->where([
            'product_category_category_id' => 5, 
            'brands_brand_id' => $brand_detail->brand_id
        ])->one();
       
        $this->title = "Watches - " . ucwords(strtolower($brand_detail->brand_name));
        
		$seo = \backend\models\SeoPagesContentBrands::findOne(['brand_id' => $brand_detail->brand_id]);
		
		if($seo != NULL){
			\Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $seo->seoPagesContent->seo_pages_meta_description]);
			\Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $seo->seoPagesContent->seo_pages_meta_keywords]);
			\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => $seo->seoPagesContent->seo_pages_meta_title]);
			\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => $seo->seoPagesContent->seo_pages_meta_title]);
			
		}else{
		    \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => ucwords(strtolower($brand_detail->brand_name)) . ' Watches']);
		    \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $brand_detail->brand_description]);
		    \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $brand_detail->brand_name]);
		}
		
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => ucwords(strtolower($brand_detail->brand_name)) . ' Watches']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'http://www.thewatch.co/watches/brand/' . $brandName]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'http://www.thewatch.co/img/brand_banner/' . $brand_detail->brand_id . '/' . $ogImage]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image:alt', 'content' => ucwords(strtolower($brand_detail->brand_name))]);
        
		\Yii::$app->view->registerJs('var scr = document.createElement("script");
		scr.type = "text/javascript";
		scr.async = true;
		scr.src =  "' . $AdskomTagging->adskom_tagging_script . '";
		document.body.appendChild(scr);');
		
		//echo "<h1>".$query_product->createCommand()->getRawSql()."</h1>";

		
        return $this->render('detail', array(
            "brandBanner" => $brandBanner, 
            "brand_detail" => $brand_detail,
            "products" => $products,
            "category" => $category,
			"brandId" => $brand_detail->brand_id,
			"brandName" => $brandName,
            "total_products" => $total_products,
        ));
    }
    
    public function actionStraps($brandName)
    {
        $this->breadcrumb[] = "straps";
        
        $brand_detail = \backend\models\Brands::getBrandDetail(["brands.brand_name" => strtolower(str_replace('-', ' ', $brandName))]);
        
        $query = BrandsBannerDetail::find()
                ->joinWith(['brands']);
         
        $brandBanner = $query
                ->select(['brands_banner_detail.brands_banner_detail_slide_image'])
                ->where(["brands_banner_detail.brands_brand_id" => $brand_detail->brand_id])
                ->andWhere(["brands_banner_detail.brands_banner_featured_brand" => 0])
                ->andWhere(["brands_banner_detail.brands_banner_featured_mobile" => 0])
                ->orderBy('brands.brand_name')
                ->all();
        
        $category = \backend\models\ProductCategory::find()
                ->where(["product_category_name" => "straps"])
                ->one();
                
        $brandBannerOg = $query
			->select(['brands_banner_detail.brands_banner_detail_slide_image', 'brands_banner_detail.brands_brand_id'])
			->where(["brands_banner_detail.brands_brand_id" => $brand_detail->brand_id])
			->andWhere(["brands_banner_detail.brands_banner_featured_brand" => 0])
			->orderBy('brands.brand_name')
			->one();
        
		$ogImage = '';
		
		if($brandBannerOg != NULL){
			$ogImage = $brandBannerOg->brands_banner_detail_slide_image;
		}
        
        $seo = \backend\models\SeoPagesContentBrands::findOne(['brand_id' => $brand_detail->brand_id]);
		
		if($seo != NULL){
			\Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $seo->seoPagesContent->seo_pages_meta_description]);
			\Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $seo->seoPagesContent->seo_pages_meta_keywords]);
			\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => $seo->seoPagesContent->seo_pages_meta_title]);
			\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => $seo->seoPagesContent->seo_pages_meta_title]);
		}else{
		    \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => ucwords(strtolower($brand_detail->brand_name))]);
		    \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $brand_detail->brand_description]);
		    \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $brand_detail->brand_name]);
		}
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => ucwords(strtolower($brand_detail->brand_name))]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'http://www.thewatch.co/watches/brand/' . $brandName]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'http://www.thewatch.co/img/brand_banner/' . $brand_detail->brand_id . '/' . $ogImage]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image:alt', 'content' => ucwords(strtolower($brand_detail->brand_name))]);
        
        // query product and filter
        $query_product = $this->actionProductSort($brand_detail,$category);
        $products = $query_product[0];
        $total_products = $query_product[1];
		
		$AdskomTagging = \backend\models\ProductCategoryBrands::find()->where([
            'product_category_category_id' => 6, 
            'brands_brand_id' => $brand_detail->brand_id
        ])->one();
		
		$this->title = "Straps - " . ucwords(strtolower($brand_detail->brand_name));
		
		\Yii::$app->view->registerJs('var scr = document.createElement("script");
		scr.type = "text/javascript";
		scr.async = true;
		scr.src =  "' . $AdskomTagging->adskom_tagging_script . '";
		document.body.appendChild(scr);');
       
        return $this->render('detail', array(
            "brandBanner" => $brandBanner, 
            "brand_detail" => $brand_detail,
            "products" => $products,
            "category" => $category,
            "brandName" => $brandName,
            "brandId" => $brand_detail->brand_id,
            "total_products" => $total_products,
        ));
    }
    
    // get product
    public function actionProduct($brand_detail,$category){
      // query product and filter
          $id_prod = [];
          $bellow_price = 0;
          $above_price = 50000000;
          $page = 1;
          $limit = 20;
          if(isset($_GET['page'])){
            $page = $_GET['page'];           
          }
          if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
          }
          $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
          $sort = 'none';
          if(isset($_GET['sortby'])){
            $sort = $_GET['sortby'];
          }

          if(isset($_GET['price'])){
            $price = explode('--', $_GET['price']);
            $bellow_price = $price[0];
            $above_price = $price[1];
          }
         

          if(isset($_GET['gender'])){
            $genders = explode('--', $_GET['gender']);

            $id_prod2 = [];
            $connection = Yii::$app->getDb();
              $command = $connection->createCommand(" SELECT product_id FROM product_feature WHERE feature_value_id IN (".implode(',',$genders).") ");
              $results = $command->queryAll();
              $p = 0;
              foreach($results as $result){
                $id_prod2[$p] = $result['product_id'];
                $p++;
              }
            if($id_prod != []){
              $id_prod = array_intersect($id_prod,$id_prod2);
            }
            else{
              $id_prod = $id_prod2;
            }



          }
          if(isset($_GET['type'])){
            $types = explode('--', $_GET['type']);

            $id_prod2 = [];
            $connection = Yii::$app->getDb();
              $command = $connection->createCommand(" SELECT product_id FROM product_feature WHERE feature_value_id IN (".implode(',',$types).") ");
              $results = $command->queryAll();
              $p = 0;
              foreach($results as $result){
                $id_prod2[$p] = $result['product_id'];
                $p++;
              }
            if($id_prod != []){
              $id_prod = array_intersect($id_prod,$id_prod2);
            }
            else{
              $id_prod = $id_prod2;
            }


          }
          if(isset($_GET['movement'])){
            $movements = explode('--', $_GET['movement']);

            $id_prod2 = [];
            $connection = Yii::$app->getDb();
              $command = $connection->createCommand(" SELECT product_id FROM product_feature WHERE feature_value_id IN (".implode(',',$movements).") ");
              $results = $command->queryAll();
              $p = 0;
              foreach($results as $result){
                $id_prod2[$p] = $result['product_id'];
                $p++;
              }
            if($id_prod != []){
              $id_prod = array_intersect($id_prod,$id_prod2);
            }
            else{
              $id_prod = $id_prod2;
            }
          //  print_r(count($id_prod));die();

          }
          if(isset($_GET['water'])){
            $waters = explode('--', $_GET['water']);
                        $id_prod2 = [];
                        $connection = Yii::$app->getDb();
                          $command = $connection->createCommand(" SELECT product_id FROM product_feature WHERE feature_value_id IN (".implode(',',$waters).") ");
                          $results = $command->queryAll();
                          $p = 0;
                          foreach($results as $result){
                            $id_prod2[$p] = $result['product_id'];
                            $p++;
                          }
                        if($id_prod != []){
                          $id_prod = array_intersect($id_prod,$id_prod2);
                        }
                        else{
                          $id_prod = $id_prod2;
                        }
                    //    print_r(count($id_prod));die();


          }
          if(isset($_GET['bandwidth'])){
            $bandwidths = explode('--', $_GET['bandwidth']);

                        $id_prod2 = [];
                        $connection = Yii::$app->getDb();
                          $command = $connection->createCommand(" SELECT product_id FROM product_feature WHERE feature_value_id IN (".implode(',',$bandwidths).") ");
                          $results = $command->queryAll();
                          $p = 0;
                          foreach($results as $result){
                            $id_prod2[$p] = $result['product_id'];
                            $p++;
                          }
                       //  print_r(count($id_prod2));die();
                        if($id_prod != []){
                          $id_prod = array_intersect($id_prod,$id_prod2);
                        }
                        else{
                          $id_prod = $id_prod2;
                        }

          }

          if(isset($_GET['size'])){
            $filters = explode('--', $_GET['size']);

              $id_prod2 = [];
              $connection = Yii::$app->getDb();
              $command = $connection->createCommand(" SELECT product_id FROM product_feature WHERE feature_value_id IN (".implode(',',$filters).") ");
              $results = $command->queryAll();

              $p = 0;
              foreach($results as $result){
              $id_prod2[$p] = $result['product_id'];
                  $p++;
              }

              if($id_prod != []){
                $id_prod = array_intersect($id_prod,$id_prod2);
              }
              else{
                $id_prod = $id_prod2;
              }

          }

          if(isset($_GET['collection'])){
                $filters = explode('--', $_GET['collection']);

              $id_prod2 = [];
              $connection = Yii::$app->getDb();
              $command = $connection->createCommand(" SELECT product_id FROM product WHERE brands_collection_id IN (".implode(',',$filters).") ");
              $results = $command->queryAll();

              $p = 0;
              foreach($results as $result){
              $id_prod2[$p] = $result['product_id'];
                  $p++;
              }

              if($id_prod != []){
                $id_prod = array_intersect($id_prod,$id_prod2);
              }
              else{
                $id_prod = $id_prod2;
              }
          }

          if($id_prod != []){
            if($category == ''){
              $products = \backend\models\Product::getProductByCategoryPrice(
                  [
                      "product.brands_brand_id" => $brand_detail->brand_id,
                      'product.active' => 1,
                      'product.product_id'=> $id_prod,
                  ],$bellow_price,$above_price,$limit,$start,$sort
              );
              $total_products = \backend\models\Product::getProductByCategoryPriceTotal(
                  [
                      "product.brands_brand_id" => $brand_detail->brand_id,
                      'product.active' => 1,
                      'product.product_id'=> $id_prod,
                  ],$bellow_price,$above_price
              );
            }else{
              $products = \backend\models\Product::getProductByCategoryPrice(
                  [
                      "product.brands_brand_id" => $brand_detail->brand_id,
                      'product.product_category_id' => $category->product_category_id,
                      'product.active' => 1,
                      'product.product_id'=> $id_prod,
                  ],$bellow_price,$above_price,$limit,$start,$sort
              );
              $total_products = \backend\models\Product::getProductByCategoryPriceTotal(
                  [
                      "product.brands_brand_id" => $brand_detail->brand_id,
                      'product.product_category_id' => $category->product_category_id,
                      'product.active' => 1,
                      'product.product_id'=> $id_prod,
                  ],$bellow_price,$above_price
              );
            }
          }

          if($id_prod == []){
            if($category == ''){
              $products = \backend\models\Product::getProductByCategoryPrice(
                  [
                      "product.brands_brand_id" => $brand_detail->brand_id,
                      'product.active' => 1,
                  ],$bellow_price,$above_price,$limit,$start,$sort
              );
              $total_products = \backend\models\Product::getProductByCategoryPriceTotal(
                  [
                      "product.brands_brand_id" => $brand_detail->brand_id,
                      'product.active' => 1,
                  ],$bellow_price,$above_price
              );
            }else{
              $products = \backend\models\Product::getProductByCategoryPrice(
                  [
                      "product.brands_brand_id" => $brand_detail->brand_id,
                      'product.product_category_id' => $category->product_category_id,
                      'product.active' => 1,
                  ],$bellow_price,$above_price,$limit,$start,$sort
              );
              $total_products = \backend\models\Product::getProductByCategoryPriceTotal(
                  [
                      "product.brands_brand_id" => $brand_detail->brand_id,
                      'product.product_category_id' => $category->product_category_id,
                      'product.active' => 1,
                  ],$bellow_price,$above_price
              );
            }

          }

          if(!isset($_GET['price'])){
            if($category == ''){
              $products = \backend\models\Product::getProductByCategory(
                  [
                      "product.brands_brand_id" => $brand_detail->brand_id,
                      'product.active' => 1
                  ],$limit,$start,$sort
              );
              $total_products = \backend\models\Product::getProductByCategoryTotal(
                  [
                      "product.brands_brand_id" => $brand_detail->brand_id,
                      'product.active' => 1
                  ]
              );
            }else{
              $products = \backend\models\Product::getProductByCategory(
                  [
                      "product.brands_brand_id" => $brand_detail->brand_id,
                      'product.product_category_id' => $category->product_category_id,
                      'product.active' => 1
                  ],$limit,$start,$sort
              );
              $total_products = \backend\models\Product::getProductByCategoryTotal(
                  [
                      "product.brands_brand_id" => $brand_detail->brand_id,
                      'product.product_category_id' => $category->product_category_id,
                      'product.active' => 1
                  ]
              );
            }

          }
          $hasil = [];
          $hasil[0] = $products;
          $hasil[1] = count($total_products);
          return $hasil;
    }

    public function actionProductSort($brand_detail,$category){
        // query product and filter
            $id_prod = [];
            $bellow_price = 0;
            $above_price = 50000000;
            $page = 1;
            $limit = 20;
            if(isset($_GET['page'])){
              $page = $_GET['page'];           
            }
            if(isset($_GET['limit'])){
              $limit = $_GET['limit'];
            }
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
            $sort = 'none';
            if(isset($_GET['sortby'])){
              $sort = $_GET['sortby'];
            }
  
            if(isset($_GET['price'])){
              $price = explode('--', $_GET['price']);
              $bellow_price = $price[0];
              $above_price = $price[1];
            }
           
  
            if(isset($_GET['gender'])){
              $genders = explode('--', $_GET['gender']);
  
              $id_prod2 = [];
              $connection = Yii::$app->getDb();
                $command = $connection->createCommand(" SELECT product_id FROM product_feature WHERE feature_value_id IN (".implode(',',$genders).") ");
                $results = $command->queryAll();
                $p = 0;
                foreach($results as $result){
                  $id_prod2[$p] = $result['product_id'];
                  $p++;
                }
              if($id_prod != []){
                $id_prod = array_intersect($id_prod,$id_prod2);
              }
              else{
                $id_prod = $id_prod2;
              }
  
  
  
            }
            if(isset($_GET['type'])){
              $types = explode('--', $_GET['type']);
  
              $id_prod2 = [];
              $connection = Yii::$app->getDb();
                $command = $connection->createCommand(" SELECT product_id FROM product_feature WHERE feature_value_id IN (".implode(',',$types).") ");
                $results = $command->queryAll();
                $p = 0;
                foreach($results as $result){
                  $id_prod2[$p] = $result['product_id'];
                  $p++;
                }
              if($id_prod != []){
                $id_prod = array_intersect($id_prod,$id_prod2);
              }
              else{
                $id_prod = $id_prod2;
              }
  
  
            }
            if(isset($_GET['movement'])){
              $movements = explode('--', $_GET['movement']);
  
              $id_prod2 = [];
              $connection = Yii::$app->getDb();
                $command = $connection->createCommand(" SELECT product_id FROM product_feature WHERE feature_value_id IN (".implode(',',$movements).") ");
                $results = $command->queryAll();
                $p = 0;
                foreach($results as $result){
                  $id_prod2[$p] = $result['product_id'];
                  $p++;
                }
              if($id_prod != []){
                $id_prod = array_intersect($id_prod,$id_prod2);
              }
              else{
                $id_prod = $id_prod2;
              }
            //  print_r(count($id_prod));die();
  
            }
            if(isset($_GET['water'])){
              $waters = explode('--', $_GET['water']);
                          $id_prod2 = [];
                          $connection = Yii::$app->getDb();
                            $command = $connection->createCommand(" SELECT product_id FROM product_feature WHERE feature_value_id IN (".implode(',',$waters).") ");
                            $results = $command->queryAll();
                            $p = 0;
                            foreach($results as $result){
                              $id_prod2[$p] = $result['product_id'];
                              $p++;
                            }
                          if($id_prod != []){
                            $id_prod = array_intersect($id_prod,$id_prod2);
                          }
                          else{
                            $id_prod = $id_prod2;
                          }
                      //    print_r(count($id_prod));die();
  
  
            }
            if(isset($_GET['bandwidth'])){
              $bandwidths = explode('--', $_GET['bandwidth']);
  
                          $id_prod2 = [];
                          $connection = Yii::$app->getDb();
                            $command = $connection->createCommand(" SELECT product_id FROM product_feature WHERE feature_value_id IN (".implode(',',$bandwidths).") ");
                            $results = $command->queryAll();
                            $p = 0;
                            foreach($results as $result){
                              $id_prod2[$p] = $result['product_id'];
                              $p++;
                            }
                         //  print_r(count($id_prod2));die();
                          if($id_prod != []){
                            $id_prod = array_intersect($id_prod,$id_prod2);
                          }
                          else{
                            $id_prod = $id_prod2;
                          }
  
            }
  
            if(isset($_GET['size'])){
              $filters = explode('--', $_GET['size']);
  
                $id_prod2 = [];
                $connection = Yii::$app->getDb();
                $command = $connection->createCommand(" SELECT product_id FROM product_feature WHERE feature_value_id IN (".implode(',',$filters).") ");
                $results = $command->queryAll();
  
                $p = 0;
                foreach($results as $result){
                $id_prod2[$p] = $result['product_id'];
                    $p++;
                }
  
                if($id_prod != []){
                  $id_prod = array_intersect($id_prod,$id_prod2);
                }
                else{
                  $id_prod = $id_prod2;
                }
  
            }
  
            if(isset($_GET['collection'])){
                  $filters = explode('--', $_GET['collection']);
  
                $id_prod2 = [];
                $connection = Yii::$app->getDb();
                $command = $connection->createCommand(" SELECT product_id FROM product WHERE brands_collection_id IN (".implode(',',$filters).") ");
                $results = $command->queryAll();
  
                $p = 0;
                foreach($results as $result){
                $id_prod2[$p] = $result['product_id'];
                    $p++;
                }
  
                if($id_prod != []){
                  $id_prod = array_intersect($id_prod,$id_prod2);
                }
                else{
                  $id_prod = $id_prod2;
                }
            }
           
  
            if($id_prod != []){
              if($category == ''){
                $products = \backend\models\Product::getProductByCategoryPrice(
                    [
                        "product.brands_brand_id" => $brand_detail->brand_id,
                        'product.active' => 1,
                        'product.product_id'=> $id_prod,
                    ],$bellow_price,$above_price,$limit,$start,$sort
                );
                $total_products = \backend\models\Product::getProductByCategoryPriceTotal(
                    [
                        "product.brands_brand_id" => $brand_detail->brand_id,
                        'product.active' => 1,
                        'product.product_id'=> $id_prod,
                    ],$bellow_price,$above_price
                );

              }else{
                
                $products = \backend\models\Product::getProductByCategoryPrice(
                    [
                        "product.brands_brand_id" => $brand_detail->brand_id,
                        'product.product_category_id' => $category->product_category_id,
                        'product.active' => 1,
                        'product.product_id'=> $id_prod,
                    ],$bellow_price,$above_price,$limit,$start,$sort
                );

                $total_products = \backend\models\Product::getProductByCategoryPriceTotal(
                    [
                        "product.brands_brand_id" => $brand_detail->brand_id,
                        'product.product_category_id' => $category->product_category_id,
                        'product.active' => 1,
                        'product.product_id'=> $id_prod,
                    ],$bellow_price,$above_price
                );

               
              }
            }
  
            if($id_prod == []){
                
              if($category == ''){
                 
                $products = \backend\models\Product::getProductByCategoryPrice(
                    [
                        "product.brands_brand_id" => $brand_detail->brand_id,
                        'product.active' => 1,
                    ],$bellow_price,$above_price,$limit,$start,$sort
                );
                $total_products = \backend\models\Product::getProductByCategoryPriceTotal(
                    [
                        "product.brands_brand_id" => $brand_detail->brand_id,
                        'product.active' => 1,
                    ],$bellow_price,$above_price
                );
              }else{
                $products = \backend\models\Product::getProductByCategoryPriceSort(
                    [
                        "product.brands_brand_id" => $brand_detail->brand_id,
                        'product.product_category_id' => $category->product_category_id,
                        'product.active' => 1,
                    ],$bellow_price,$above_price,$limit,$start,$sort
                );
                $total_products = \backend\models\Product::getProductByCategoryPriceTotal(
                    [
                        "product.brands_brand_id" => $brand_detail->brand_id,
                        'product.product_category_id' => $category->product_category_id,
                        'product.active' => 1,
                    ],$bellow_price,$above_price
                );
              }
  
            }
  
            if(!isset($_GET['price'])){
              if($category == ''){
                $products = \backend\models\Product::getProductByCategorySort(
                    [
                        "product.brands_brand_id" => $brand_detail->brand_id,
                        'product.active' => 1
                    ],$limit,$start,$sort
                );
                $total_products = \backend\models\Product::getProductByCategoryTotal(
                    [
                        "product.brands_brand_id" => $brand_detail->brand_id,
                        'product.active' => 1
                    ]
                );
              }else{
                $products = \backend\models\Product::getProductByCategorySort(
                    [
                        "product.brands_brand_id" => $brand_detail->brand_id,
                        'product.product_category_id' => $category->product_category_id,
                        'product.active' => 1
                    ],$limit,$start,$sort
                );
                $total_products = \backend\models\Product::getProductByCategoryTotal(
                    [
                        "product.brands_brand_id" => $brand_detail->brand_id,
                        'product.product_category_id' => $category->product_category_id,
                        'product.active' => 1
                    ]
                );
              }
  
            }
			

			//print_r($products);
            $hasil = [];
            $hasil[0] = $products;
            $hasil[1] = count($total_products);
            return $hasil;
      }
}
