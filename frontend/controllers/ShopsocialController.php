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

class ShopsocialController extends controller\FrontendController {
    
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
		
		$this->redirect('https://thewatch.co');
		
        $this->breadcrumb[] = "explore";
        $this->breadcrumb[] = "all";
        
        return $this->render('index');
    }
    
    public function actionRelatedItem($imageId){
        
        $instagram = \backend\models\Instagram::findOne(["image_id" => $imageId]);
        
        if($instagram != NULL) {
            $products = \backend\models\InstagramDetail::find()
                ->joinWith([
                    "productDetail",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    },
                    "product"
                ])
                ->where(["instagram_id" => $instagram->instagram_id])
                ->all();
        } else {
            return json_encode(array(
                'product' => []
            ));
        }
        
        $productList = array();
        foreach ($products as $product){
            $productList[] = array(
                "link_rewrite" => \yii\helpers\Url::base() . '/product/' . $product->productDetail->link_rewrite,
                "price" => \common\components\Helpers::getPriceFormat($product->product->price),
                "image_url" => \yii\helpers\Url::base() . '/img/product/' . $product->productImage->product_image_id . '/' . $product->productImage->product_image_id .'.jpg',
                "product_name" => $product->productDetail->name,
                "brand_name" => $product->productDetail->product->brands->brand_name
            );
        }
        
        echo json_encode(array("product" => $productList));
    }
    
    public function actionNext($maxId){
        
        $media = file_get_contents("https://api.instagram.com/v1/users/22192614/media/recent/?access_token=22192614.51f0cd2.663a32f23dd54f7aa57d1afbc70c20d1&max_id=" . $maxId);
        
        $response = json_decode($media);
        
        $images = array();
        
        foreach ($response->data as $data) {
            $imageId[] = $data->id;
            $images[] = $data->images->standard_resolution->url;
            $links[] = $data->link;
            $caption[] = $data->caption->text;
            $likes[] = $data->likes->count;
            $comments[] = $data->comments->count;
        }
        
        echo json_encode(array(
            'next_id' => $response->pagination->next_max_id,
            'images'  => $images,
            'links' => $links,
            'caption' => $caption,
            'imageId' => $imageId,
            'likes' => $likes,
            'comments' => $comments,
            'baseUrl' => \yii\helpers\Url::base()
        ));
    }
    
    public function actionDetail($brandName)
    {
        $this->breadcrumb[] = "explore";
        $this->breadcrumb[] = "all";
        
        $brand_detail = \backend\models\Brands::getBrandDetail(["brands.brand_name" => strtolower(str_replace('-', ' ', $brandName))]);
        
        $query = BrandsBannerDetail::find()
                ->joinWith(['brands']);
         
        $brandBanner = $query
                ->select(['brands_banner_detail.brands_banner_detail_slide_image'])
                ->where(["brands_banner_detail.brands_brand_id" => $brand_detail->brand_id])
                ->orderBy('brands.brand_name')
                ->all();
        
        $products = \backend\models\Product::getProductsDetails(
            ["product.brands_brand_id" => $brand_detail->brand_id]
        );
        
        $this->title = " - " . ucwords(strtolower($brand_detail->brand_name));
        
        return $this->render('detail', array(
            "brandBanner" => $brandBanner, 
            "brand_detail" => $brand_detail,
            "products" => $products
        ));
    }
    
}
