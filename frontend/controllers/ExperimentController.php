<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Session;
use yii\db\Expression;

use frontend\core\controller;
use backend\models\Product;
use backend\models\BrandsBanner;
use backend\models\BrandsBannerDetail;

class ExperimentController extends controller\FrontendController {
    
    public $breadcrumb = ["Experiment"];
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

    public function actionListProducts(){
        $current_date = date('Y-m-d H:i:s');
        $start = 0;
        $page = 1;
        $limit = 20;
        $brands = array();
        $categories = array();
        $products = array();
        $is_discount = 0;
        $is_new_arrival = 0;
        $is_flash_sale = 0;
        $sort = 'none';
        
        if(isset($_GET['sortby'])){
            $sort = $_GET['sortby'];
        }
        if(isset($_GET['brands'])){
            $brands = explode('--', $_GET['brands']);
        }
        if(isset($_GET['cat'])){
            $categories = explode('--', $_GET['cat']);
        }
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
        if(isset($_GET['price'])){
            $price = explode('--', $_GET['price']);
            $bellow_price = $price[0];
            $above_price = $price[1];
        }
        // var_dump($current_date);exit();

        // $get_products = Product::getProductLists($brands, $categories, $products, $is_discount, $is_new_arrival, $is_flash_sale, $current_date, $page, $limit, $sort);

        $get_products = Product::getProductLists2($brands);

        // var_dump($get_products);exit();

    }
    
    public function actionBrand(){

        $now = date('Y-m-d H:i:s');
        $start = 0;
        $limit = 20;
        $page = 1;
        $limit = 20;
        $brand_id = array();
        $category_id = array(5,12);
        $sort = 'none';
        $sortby = 'brands.brand_name ASC';
        
        if(isset($_GET['sortby'])){
            $sort = $_GET['sortby'];
        }

        if($sort == 'price-high-to-low'){
            $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
            $sortby = 'priority ASC';
        }if($sort == 'none'){
            $sortby = 'brands.brand_name ASC';
        }
      
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
        if(isset($_GET['price'])){
            $price = explode('--', $_GET['price']);
            $bellow_price = $price[0];
            $above_price = $price[1];
        }

        $getAllProduct = \backend\models\Product::find(
            [
            'active' => 1
            ]
        )
        ->joinWith('productNewArrival')
        ->joinWith('specificPrice')
        ->andWhere('specific_price.from <= "'. $now . '"')
        ->andWhere('specific_price.to > "'. $now . '"');

        if(sizeof($brand_id) != 0){
			$getAllProduct->andWhere(["in", "brands_brand_id", $brand_id]);
        }
        if(sizeof($category_id) != 0){
			$getAllProduct->andWhere(["in", "product_category_id", $category_id]);
		}
        $getAllProduct->orderBy(['product_newarrival.product_newarrival_end_date' => SORT_DESC]);
        $resProducts = $getAllProduct->all();

		if(count($resProducts) > 0){
            foreach($resProducts as $product)
            {
                $id_prod[] = $product->product_id;
            }
        }
  
        $id_prod = $this->actionIdproductOB($brand_id,$id_prod);
        $products = $this->actionProductSort($id_prod,$brand_id,$category_id,$page,$limit);
        // var_dump($products);exit();
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);

        $data = [
            'Olivia Burton - Valentine’s Special Floral Wrap',
            'Dalam rangka menyambut hari Valentine, The Watch Co. memberikan Valentine’s Special Floral Wrap untuk kamu di setiap pembelian produk Olivia Burton. 
            Syarat dan ketentuan sebagai berikut: <br/><br/>

            1.            Special Floral Wrap bisa didapatkan secara gratis bagi 50 pembeli pertama<br/>

            2.            Berlaku untuk setiap pembelian produk jam tangan dan jewellery Olivia Burton<br/>

            3.            Special Floral Wrap berisi: <br/>

                            &nbsp; &nbsp; &nbsp; - Kotak jam tangan atau jewellery yang dihias dengan kertas kado dan pita<br/>

                            &nbsp; &nbsp; &nbsp; - Mini dried flower bouquet<br/>

                            &nbsp; &nbsp; &nbsp; - Kartu Ucapan<br/>

                            &nbsp; &nbsp; &nbsp; - Olivia Burton’s Tag<br/>

            4.            Special Floral Wrap ini berlaku pada 7 – 17 Februari 2019',
            'https://thewatch.co/img/landing/obvalentine/brandbanner.jpg'
        ];

        return $this->render('index', array(
            "products" => $products, 
            "count" => $product_count, 
            "limit" => $limit, 
            "data" => $data,
            "page"=>$page,
            "brands"=>$default_brand
        ));
    }
    
    public function actionIdproductOB($id_brands,$id_prod_plus){
        $id_prod = [];
        $connection = Yii::$app->getDb();
 
        if(isset($_GET['gender'])){

            $p = 0;
            $genders = explode('--', $_GET['gender']);
            $id_prod2 = [];
            $command = $connection->createCommand(" SELECT product_id FROM product_feature WHERE feature_value_id IN (".implode(',',$genders).") ");
            $results = $command->queryAll();

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

            $p = 0;
            $types = explode('--', $_GET['type']);
            $id_prod2 = [];
            $command = $connection->createCommand(" SELECT product_id FROM product_feature WHERE feature_value_id IN (".implode(',',$types).") ");
            $results = $command->queryAll();

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
        }

        if(isset($_GET['water'])){
            $waters = explode('--', $_GET['water']);
            $id_prod2 = [];
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
        }

        if(isset($_GET['bandwidth'])){
            
            $bandwidths = explode('--', $_GET['bandwidth']);

            $id_prod2 = [];
            $command = $connection->createCommand(" SELECT product_id FROM product_feature WHERE feature_value_id IN (".implode(',',$bandwidths).") ");
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
 
        if(isset($_GET['size'])){
            $filters = explode('--', $_GET['size']);
            $id_prod2 = [];
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
        
        if($id_prod != []){
            $id_inter = array_intersect($id_prod,$id_prod_plus);
        }else{
            $id_inter = $id_prod_plus;
        }
        
 
        $now = date("Y-m-d H:i:s");
        $id_prod3 = [];
          
        $query = \backend\models\Product::find()
            ->joinWith([
            "brands",
            "specificPrice",
            ])
            ->where('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"');
        
        if(sizeof($id_prod) != 0){
            $query->andWhere(["in", "product_id", $id_prod]);
        }
        if(sizeof($id_brands) != 0){
            $query->andWhere(["in", "brands.brand_id", $id_brands]);
        }
        $results1 = $query->all();
         
        $p = 0;
        foreach($results1 as $result){
            $id_prod3[$p] = $result->product_id;
            $p++;
        }
            
        $id_prod = $id_prod3;
        $id_prod = array_merge($id_prod,$id_inter);
 
        return $id_prod;
     }

     public function actionProductSort($id_prod = array(), $brand_id = array(), $category_id = array(), $page,$limit){

        $start = 0;
        $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
        $bellow_price = 0;
        $above_price = 50000000;
        $sortby = 'product_sort';

        if(isset($_GET['price'])){
            $price = explode('--', $_GET['price']);
            $bellow_price = $price[0];
            $above_price = $price[1];
        }

        if(isset($_GET['sortby'])){
            $sortby = $_GET['sortby'];
        }

        $products = \backend\models\Product::getProductByCategoryPricePromoPageSort($brand_id,$category_id,$id_prod,$bellow_price,$above_price,$start,$limit,$sortby
        );
  
        // if(!isset($_GET['price'])){
        
        //     $products = \backend\models\Product::getProductByCategoryPromoPageSort(
        //         [
        //             "product.brands_brand_id" => $brand_id,
        //             'product.active' => 1,
        //             'product.product_id'=> $id_prod,
        //             'product.product_category_id'=> $category_id,
        //         ],$start,$limit,$sortby
        //     );
        
        // }
        // var_dump($products);exit();
  
        return $products;
    }

    public function actionCountproduct($id_prod, $brand_id = array(),$page,$limit){

        $start = 0;
        $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
        $bellow_price = 0;
        $above_price = 50000000;

        if(isset($_GET['price'])){
            $price = explode('--', $_GET['price']);
            $bellow_price = $price[0];
            $above_price = $price[1];
        }

        if($id_prod != []){
        
            $products = \backend\models\Product::getProductByCategoryPricePromo(
                [
                    "product.brands_brand_id" => $brand_id,
                    'product.active' => 1,
                    'product.product_id'=> $id_prod,
                ],$bellow_price,$above_price
            );
        
        }

        if($id_prod == []){
        
            $products = \backend\models\Product::getProductByCategoryPricePromo(
                [
                    "product.brands_brand_id" => $brand_id,
                    'product.active' => 1,
                    'product.product_id'=> $id_prod,
                ],$bellow_price,$above_price
            );
        

        }

        if(!isset($_GET['price'])){
        
            $products = \backend\models\Product::getProductByCategoryPromo(
                [
                    "product.brands_brand_id" => $brand_id,
                    'product.active' => 1,
                    'product.product_id'=> $id_prod,
                ]
            );
        
        }
        
        return count($products);
    }
}
