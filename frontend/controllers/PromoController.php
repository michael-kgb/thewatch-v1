<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Session;
use yii\db\Expression;

use yii\data\ActiveDataProvider;
// use yii\data\Pagination;

use frontend\core\controller;
use backend\models\BrandsBanner;
use backend\models\BrandsBannerDetail;
use backend\models\ProductCategory;
use backend\models\Product;

class PromoController extends controller\FrontendController {
    
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
    
    // get id product (merge with $id_prod_plus)
    public function actionIdproduct($id_brands,$id_prod_plus){
         $id_prod = [];
         session_start(); 

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
                       // print_r(count($id_prod));die();


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
                        // print_r(count($id_prod2));die();
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
          
          if($id_prod != []){
              $id_inter = array_intersect($id_prod,$id_prod_plus);
            }else{
              $id_inter = $id_prod_plus;
            }
          
            // print_r($id_prod);die();

          $now = date("Y-m-d H:i:s");
          // if($_SESSION['customerInfo']['customer_id'] == 7614){
				// $now = '2018-11-10 00:00:00';
			// }
			
              $id_prod3 = [];
          if($id_prod != []){
            $results = \backend\models\Product::find()
                ->joinWith([
                   "brands",
                    "specificPrice",
        
                ])
                ->where(['product.product_id'=>$id_prod])
                ->andWhere(['brands.brand_id'=>$id_brands])
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
    
                ->all();
          }else{
              $results = \backend\models\Product::find()
                ->joinWith([
                   "brands",
                    "specificPrice",
        
                ])
                // ->where(['product.product_id'=>$id_prod])
                ->andWhere(['brands.brand_id'=>$id_brands])
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
    
                ->all();
          }
          

           
              $p = 0;
              foreach($results as $result){
              $id_prod3[$p] = $result->product_id;
                  $p++;
              }
              
              $id_prod = $id_prod3;



              $id_prod = array_merge($id_prod,$id_inter);

          return $id_prod;
    }
    
    // get id product (intersect with $id_prod_plus)
    public function actionIdproductintersect($id_brands,$id_prod_plus){
         $id_prod = [];
          

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
           // print_r(count($id_prod));die();

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
                       // print_r(count($id_prod));die();


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
                        // print_r(count($id_prod2));die();
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
          
          if($id_prod != []){
              $id_inter = array_intersect($id_prod,$id_prod_plus);
            }else{
              $id_inter = $id_prod_plus;
            }
          
            // print_r($id_prod);die();

          // $now = date("Y-m-d H:i:s");
              // $id_prod3 = [];
          // if($id_prod != []){
            // $results = \backend\models\Product::find()
                // ->joinWith([
                  // "brands",
                    // "specificPrice",
        
                // ])
                // ->where(['product.product_id'=>$id_prod])
                // ->andWhere(['brands.brand_id'=>$id_brands])
                // ->andWhere('specific_price.from <= "'. $now . '"')
                // ->andWhere('specific_price.to > "'. $now . '"')
    
                // ->all();
          // }else{
              // $results = \backend\models\Product::find()
                // ->joinWith([
                  // "brands",
                    // "specificPrice",
        
                // ])
                //->where(['product.product_id'=>$id_prod])
                // ->andWhere(['brands.brand_id'=>$id_brands])
                // ->andWhere('specific_price.from <= "'. $now . '"')
                // ->andWhere('specific_price.to > "'. $now . '"')
    
                // ->all();
          // }
          

           
              // $p = 0;
              // foreach($results as $result){
              // $id_prod3[$p] = $result->product_id;
                  // $p++;
              // }
              
              // $id_prod = $id_prod3;



              // $id_prod = array_merge($id_prod,$id_inter);

          return $id_inter;
    }
    
	// get product with discount
    public function actionProduct($id_prod, $brand_id = array(),$page,$limit){
        $start = 0;
        
        $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
      // query product and filter
         $bellow_price = 0;
          $above_price = 50000000;
          if(isset($_GET['price'])){
            $price = explode('--', $_GET['price']);
            $bellow_price = $price[0];
            $above_price = $price[1];
          }
		  
			$sortby = 'none';
		  
			if(isset($_GET['sortby'])){
			  $sortby = $_GET['sortby'];
			}

			
			
			
          if($id_prod != []){
              $products = \backend\models\Product::getProductByCategoryPricePromoPage(
                  [
                      "product.brands_brand_id" => $brand_id,
                      'product.active' => 1,
                      'product.product_id'=> $id_prod,
                  ],$bellow_price,$above_price,$start,$limit,$sortby
              );
            
          }

          if($id_prod == []){
              $products = \backend\models\Product::getProductByCategoryPricePromoPage(
                  [
                      "product.brands_brand_id" => $brand_id,
                      'product.active' => 1,
                      'product.product_id'=> $id_prod,
                  ],$bellow_price,$above_price,$start,$limit,$sortby
              );
            

          }

          if(!isset($_GET['price'])){
              $products = \backend\models\Product::getProductByCategoryPromoPage(
                  [
                      "product.brands_brand_id" => $brand_id,
                      'product.active' => 1,
                      'product.product_id'=> $id_prod,
                  ],$start,$limit,$sortby
              );
          
          }
		  
		
          return $products;
    }
	
	public function actionSummerrains(){
        
        $start = 0;
        $limit = 20;
        
        $sort = 'none';
		if(isset($_GET['sortby'])){
			$sort = $_GET['sortby'];
		}
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
			$sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
			$sortby = 'priority ASC';
        }if($sort == 'none'){
			$sortby = 'priority ASC';
        }
        
        $brand_id = [5, 6];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
		$limit = 20;
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
            
		$id_prod = [];
            
		// get all id product
		$id_prod = $this->actionIdproduct($brand_id,$id_prod);
		// query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);

        
        $this->title = 'Promo Summer Sale – The Watch Co.';
		\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo Summer Sale – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Manfaatkan promo diskon Summer Sale untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Manfaatkan promo diskon Summer Sale untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Summer Sale – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

        return $this->render('summersale', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
    }

    public function actionCountproduct($id_prod, $brand_id = array(),$page,$limit){
        $start = 0;
        
        $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
        
      // query product and filter
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
    
     // get product without and with discount
    public function actionProductnospecprice($id_prod, $brand_id = array(),$page,$limit){
      // query product and filter
      
      $start = 0;
        
        $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
        
         $bellow_price = 0;
          $above_price = 50000000;
          if(isset($_GET['price'])){
            $price = explode('--', $_GET['price']);
            $bellow_price = $price[0];
            $above_price = $price[1];
          }
          $sortby = 'none';
                if(isset($_GET['sortby'])){
                  $sortby = $_GET['sortby'];
                }

          if($id_prod != []){
           
              $products = \backend\models\Product::getProductByCategoryPricePromoPageNoSpecPrice(
                  [
                      "product.brands_brand_id" => $brand_id,
                      "product.product_category_id" => 5, // promo only for watches (01 - 31 Oct 2019)
                      'product.active' => 1,
                      'product.product_id'=> $id_prod,
                  ],$bellow_price,$above_price,$start,$limit,$sortby
              );
            
          }

          if($id_prod == []){
           
              $products = \backend\models\Product::getProductByCategoryPricePromoPageNoSpecPrice(
                  [
                      "product.brands_brand_id" => $brand_id,
                      "product.product_category_id" => 5, // promo only for watches (01 - 31 Oct 2019)
                      'product.active' => 1,
                  ],$bellow_price,$above_price,$start,$limit,$sortby
              );
              
              
            

          }

          if(!isset($_GET['price'])){
              
               if($id_prod != []){
                   $products = \backend\models\Product::getProductByCategoryPromoPageNoSpecPrice(
                      [
                          "product.brands_brand_id" => $brand_id,
                          "product.product_category_id" => 5, // promo only for watches (01 - 31 Oct 2019)
                          'product.active' => 1,
                          'product.product_id'=> $id_prod,
                      ],$start,$limit,$sortby
                  );
               }
               
               if($id_prod == []){
           
                  $products = \backend\models\Product::getProductByCategoryPromoPageNoSpecPrice(
                      [
                          "product.brands_brand_id" => $brand_id,
                          "product.product_category_id" => 5, // promo only for watches (01 - 31 Oct 2019)
                          'product.active' => 1
                      ],$start,$limit,$sortby
                  );
              
              
               }
          
          }
          return $products;
    }

    public function actionCountproductnospecprice($id_prod, $brand_id = array(),$page,$limit){
      // query product and filter
         $bellow_price = 0;
          $above_price = 50000000;
          if(isset($_GET['price'])){
            $price = explode('--', $_GET['price']);
            $bellow_price = $price[0];
            $above_price = $price[1];
          }

          if($id_prod != []){
           
              $products = \backend\models\Product::getProductByCategoryPricePromoNoSpecPrice(
                  [
                      "product.brands_brand_id" => $brand_id,
                      "product.product_category_id" => 5, // promo only for watches (01 - 31 Oct 2019)
                      'product.active' => 1,
                      'product.product_id'=> $id_prod,
                  ],$bellow_price,$above_price
              );
            
          }

          if($id_prod == []){
           
              $products = \backend\models\Product::getProductByCategoryPricePromoNoSpecPrice(
                  [
                      "product.brands_brand_id" => $brand_id,
                      "product.product_category_id" => 5, // promo only for watches (01 - 31 Oct 2019)
                      'product.active' => 1,
                  ],$bellow_price,$above_price
              );
            

          }

          if(!isset($_GET['price'])){
              if($id_prod != []){
                  $products = \backend\models\Product::getProductByCategoryPromoNoSpecPrice(
                  [
                      "product.brands_brand_id" => $brand_id,
                      "product.product_category_id" => 5, // promo only for watches (01 - 31 Oct 2019)
                      'product.active' => 1,
                      'product.product_id'=> $id_prod,
                  ]
                );
              }
              
              if($id_prod == []){
                  $products = \backend\models\Product::getProductByCategoryPromoNoSpecPrice(
                  [
                      "product.brands_brand_id" => $brand_id,
                      "product.product_category_id" => 5, // promo only for watches (01 - 31 Oct 2019)
                      'product.active' => 1
                  ]
              );
              }
           
              
          
          }
          return count($products);
    }
    
     public function actionOrderevent() {

        $sessionOrder = new Session();
        $sessionOrder->open();

        $cart = $sessionOrder->get("cart");
        $items = isset($cart['items']) ? $cart['items'] : '';

        $data = 'awal';
        if($_POST){
            // $this->redirect(\yii\helpers\Url::base());
            foreach ($items as $item) {
                // $model = new \backend\models\OrderEvent();
                // $model->order_event_name = $data['ename'];
                // $model->order_event_email = $data['eemail'];
                // $model->order_event_phone = $data['ephone'];
                // $model->order_event_birth = $data['ebirth'];
                // $model->order_event_address = $data['eaddress'];
            
                // $model->order_event_product_name = $item['name'];
                // $model->order_event_product_quantity = $item['quantity'];
                // $model->order_event_product_attribute_id = $item['product_attribute_id'];
                // $model->order_event_product_attribute = $item['color'].' '.$item['size'];
                // $model->order_event_original_price = $item['unit_price'];
                // $model->order_event_price = $item['total_price'];
                // $model->order_event_created_date = $now = date("Y-m-d H:i:s");
                // $model->save();
                $data = 'oke';
                $model = new \backend\models\OrderEvent();
                $model->order_event_name = $_POST['ename'];
                $model->order_event_email = $_POST['eemail'];
                $model->order_event_phone = $_POST['etelp'];
                $model->order_event_birth = $_POST['ebirth'];
                $model->order_event_gender = $_POST['egender'];
                $model->order_event_address = $_POST['eaddress'];
            
                $model->order_event_product_name = $item['name'];
                $model->order_event_quantity = $item['quantity'];
                $model->order_event_product_id = $item['id'];
                $model->order_event_product_attribute_id = $item['product_attribute_id'];
                $model->order_event_product_attribute = $item['color'].' '.$item['size'];
                $model->order_event_original_price = $item['unit_price'];
                $model->order_event_price = $item['total_price'];
                $model->order_event_create_date = date("Y-m-d H:i:s");
                $model->save();
            }
        }

        if(isset($_SESSION['cart'])){
                    unset($_SESSION['cart']);
                }
                
        return $data;
        // echo $data;die();
        

        // return $this->renderFile('@app/views/product/price.php', array("quantity" => $_POST['quantity'], "price" => $_POST['price']));
    }
    public function actionBeemine(){
        
        $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
        
        $brand_id = [48];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
            
        
        $product = \backend\models\Product::find()->where(['brands_collection_id'=>194])->all();
        $p = 0;
        $id_prod = [];
        foreach($product as $prod){
            $id_prod[$p] = $prod->product_id;
            $p++;
        }
        
              // print_r($id_prod);die();
              // $id_prod = [2,3,4,5,6,7,8,9,10,2054];
              
          // get all id product
          $id_prod = $this->actionIdproductintersect($brand_id,$id_prod);
        // print_r($id_prod);die();
                // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
        
        
        // \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Promo diskon akhir tahun 2017 di The Watch Co. Manfaatkan potongan harga sampai 60% untuk produk jam tangan dan aksesoris pria & wanita. Beli sekarang!']);
        // \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Diskon Akhir Tahun 2017 – The Watch Co.']);
        // \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo pilkada, pilkada dki jakarta, pilkada dki 2017, promo pilgub, promo pilgub dki jakarta, pilgub dki 2017, diskon pilkada, diskon pilkada dki 2017, diskon hari ini, promo hari ini']);
        
       // $products = [];
    
        return $this->render('beemine', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
    }
    public function actionLiunic(){
        
        $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
        
        $brand_id = [44,48];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
            
        $id_prod = [];
          $spec_price = \backend\models\SpecificPrice::find()
            ->where('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->all();
          $p = 0;
          $id_prod2 = [];
            foreach($spec_price as $spec_prices){
              $id_prod2[$p] = $spec_prices->product_id;
                  $p++;
            }
             // print_r($id_prod2);die();
          $results = \backend\models\Product::find()->where(['brands_brand_id'=>[44,48]])->all();
          $p = 0;
            foreach($results as $result){
              $id_prod[$p] = $result->product_id;
                  $p++;
            }
            
         
              // print_r($id_prod);die();
              // $id_prod = [2,3,4,5,6,7,8,9,10,2054];
              
          // get all id product
          $id_prod = $this->actionIdproductintersect($brand_id,$id_prod);
        // print_r($id_prod);die();
                // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
        
        
        // \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Promo diskon akhir tahun 2017 di The Watch Co. Manfaatkan potongan harga sampai 60% untuk produk jam tangan dan aksesoris pria & wanita. Beli sekarang!']);
        // \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Diskon Akhir Tahun 2017 – The Watch Co.']);
        // \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo pilkada, pilkada dki jakarta, pilkada dki 2017, promo pilgub, promo pilgub dki jakarta, pilgub dki 2017, diskon pilkada, diskon pilkada dki 2017, diskon hari ini, promo hari ini']);
        
       // $products = [];

        return $this->render('liunic', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
    }
    public function actionValentinebundle(){
        
        $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
        
        $brand_id = [1,2,4,9,10,59,79,71,58,44,31,72,49];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
            
        $id_prod = [];
          $spec_price = \backend\models\SpecificPrice::find()
            ->where('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->all();
          $p = 0;
          $id_prod2 = [];
            foreach($spec_price as $spec_prices){
              $id_prod2[$p] = $spec_prices->product_id;
                  $p++;
            }
             // print_r($id_prod2);die();
          $results = \backend\models\Product::find()->where(['product_category_id'=>5])->andWhere(['brands_brand_id'=>[1,2,4,9,10,59,79,71,58,31,72,49]])->all();
          $p = 0;
            foreach($results as $result){
              $id_prod[$p] = $result->product_id;
                  $p++;
            }
            
            $timex_product = \backend\models\Product::find()->where(['product_id'=>[1791,2096,2097,2098,1792,2099,1793,1787,1788,2090,2170,2092,2093,2094,2048,2049,2102,2103,2104,1809,1803,2168,2106,2107,2109,2110,2111,2112,2113,2114,2115,2116,1738,2169,2100,2101,1731,1732,2171,2091,1801,1802,1786,1794,1796,1797,1798,1799,1800,1736,1737,1743,1744,1746,1748,1749,1750,1751,2172,2173,1806,1807,1808]])->all();
            $p = 0;
            $id_prod3 = [];
            foreach($timex_product as $timex){
              $id_prod3[$p] = $timex->product_id;
                  $p++;
            }
            $id_prod = array_merge($id_prod,$id_prod3);
            $id_prod = array_diff($id_prod,$id_prod2);
              // print_r($id_prod);die();
              // $id_prod = [2,3,4,5,6,7,8,9,10,2054];
              
          // get all id product
          $id_prod = $this->actionIdproductintersect($brand_id,$id_prod);
        // print_r($id_prod);die();
                // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
        
        
        // \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Promo diskon akhir tahun 2017 di The Watch Co. Manfaatkan potongan harga sampai 60% untuk produk jam tangan dan aksesoris pria & wanita. Beli sekarang!']);
        // \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Diskon Akhir Tahun 2017 – The Watch Co.']);
        // \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo pilkada, pilkada dki jakarta, pilkada dki 2017, promo pilgub, promo pilgub dki jakarta, pilgub dki 2017, diskon pilkada, diskon pilkada dki 2017, diskon hari ini, promo hari ini']);
        
       // $products = [];

        return $this->render('valentinebundle', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
    }
    
    public function actionMandiri(){
        
        $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
        
        $brand_id = [44,2,79,6,5,67,82,81,73,14,80];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
            
        // $promoMandiriKomono = [
			// 2226, 2224, 2130, 2136, 2137, 2140, 2141, 2227, 2143, 2144, 2145, 2146, 2147, 2387,
			// 2389, 2148, 2149, 2151, 2152, 2153, 2154, 2158, 2160, 2161, 2162, 2163, 2164, 2165,
			// 2166, 2167, 2392, 2398, 2201, 2202, 2204, 2205, 2206, 2207, 2208, 2209, 2210, 2211,
			// 2212, 2213, 2214, 2215, 2216, 2217, 2218, 2219, 2220, 2221, 2445, 2446, 2447, 2231,
			// 2232, 2233, 2234, 2235, 2236, 2237, 2238, 2239, 2240, 2241, 2242, 2243, 2244, 2245,
			// 2246, 2247, 2248, 2249, 2250, 2251, 2252, 2253, 2378, 2379, 2380, 2381, 2382, 2383,
			// 2384, 2385, 2386, 2449, 2450, 2451, 2452, 2453, 2454, 2455, 2456, 2457, 2458, 2459,
			// 2460, 2461, 2462, 2463 
		// ];
		
		$promoMandiriOb = [
			1995, 1782, 1660, 2479, 1639
		];
		
		// $promoMandiriTimex = [
			// 2048, 2049, 1788, 2090, 2097, 2098, 1792, 2099, 1793, 2111, 2112, 2113, 2114, 2115, 
			// 2116, 2092, 2094, 2102, 2104, 1803, 2168, 2107, 2109, 2110, 2254, 2169, 1736, 1737, 
			// 2171, 2091, 1802, 1743, 1746, 1748, 1749, 1750, 1751, 2100, 2101, 1731, 1732, 1786, 
			// 1794, 2172, 2173
		// ];
        // $product_no_discounts = \backend\models\Product::find()->joinWith(['specificPrice'])->where(['brands_brand_id'=>$brand_id])->all();
        // $p = 0;
        $id_prod = [];
        // foreach($product_no_discounts as $product_no_discount){
            // $id_prod[$p] = $product_no_discount->product_id;
            // $p++;
        // }
		
        // $id_prod = array_merge($promoMandiriKomono,$promoMandiriTimex);
                   
          // get all id product
          $id_prod = $this->actionIdproductintersect($brand_id,$id_prod);
        // print_r($id_prod);die();
                // query product and filter
        $products = $this->actionProductnospecprice($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproductnospecprice($id_prod,$brand_id,$page,$limit);
        
        $this->title = 'Promo Bank Mandiri – The Watch Co.';
		\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo Bank Mandiri – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Manfaatkan promo Bank Mandiri untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Manfaatkan promo Bank Mandiri untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Bank Mandiri – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

        return $this->render('mandiri', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
    }
    
    public function actionCyber(){
        
        $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
        
        $brand_id = [44,2,79,1,4,10,71,58,31,9,26,49,8,48,5,6];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
            
        // $promoMandiriKomono = [
			// 2226, 2224, 2130, 2136, 2137, 2140, 2141, 2227, 2143, 2144, 2145, 2146, 2147, 2387,
			// 2389, 2148, 2149, 2151, 2152, 2153, 2154, 2158, 2160, 2161, 2162, 2163, 2164, 2165,
			// 2166, 2167, 2392, 2398, 2201, 2202, 2204, 2205, 2206, 2207, 2208, 2209, 2210, 2211,
			// 2212, 2213, 2214, 2215, 2216, 2217, 2218, 2219, 2220, 2221, 2445, 2446, 2447, 2231,
			// 2232, 2233, 2234, 2235, 2236, 2237, 2238, 2239, 2240, 2241, 2242, 2243, 2244, 2245,
			// 2246, 2247, 2248, 2249, 2250, 2251, 2252, 2253, 2378, 2379, 2380, 2381, 2382, 2383,
			// 2384, 2385, 2386, 2449, 2450, 2451, 2452, 2453, 2454, 2455, 2456, 2457, 2458, 2459,
			// 2460, 2461, 2462, 2463 
		// ];
		
		$promoMandiriOb = [
			1995, 1782, 1660, 2479, 1639
		];
		
		// $promoMandiriTimex = [
			// 2048, 2049, 1788, 2090, 2097, 2098, 1792, 2099, 1793, 2111, 2112, 2113, 2114, 2115, 
			// 2116, 2092, 2094, 2102, 2104, 1803, 2168, 2107, 2109, 2110, 2254, 2169, 1736, 1737, 
			// 2171, 2091, 1802, 1743, 1746, 1748, 1749, 1750, 1751, 2100, 2101, 1731, 1732, 1786, 
			// 1794, 2172, 2173
		// ];
        // $product_no_discounts = \backend\models\Product::find()->joinWith(['specificPrice'])->where(['brands_brand_id'=>$brand_id])->all();
        // $p = 0;
        // $id_prod = [1664,1704,1770,1779,1660,1769,1783,1782,1100,1698,1467,1774,1795,2262,1659,2418,2283,1637,1697,1759,1707,2014,
			// 300,299,193,192,306,6,7,8,9,1811,1810,1815,2695,146,213,217,220,225,227,228,229,232,534,535,537,538,539,787,788,789,793,
			// 796,797,1070,71,72,75,77,1669,999,1002,1006,1007,992,995,975,984,2134,2226,2387,2144,2146,2154,1752,319,320,85,53,323,
			// 325,326,327,358,359,360,361,362,363,354,355,356,357
		// ];
		$id_prod = [];
        // foreach($product_no_discounts as $product_no_discount){
            // $id_prod[$p] = $product_no_discount->product_id;
            // $p++;
        // }
		
        // $id_prod = array_merge($promoMandiriKomono,$promoMandiriTimex);
                   
          // get all id product
          $id_prod = $this->actionIdproduct($brand_id,$id_prod);
          
          // $id_prod = $this->actionIdproductintersect($brand_id,$id_prod);
        // print_r($id_prod);die();
                // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
        $this->title = 'Cyber Sale: Promo 10-10-2018';
		\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Cyber Sale: Promo 10-10-2018']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Nikmati Promo 10-10 di tahun 2018 ini setiap pembelian produk pilihan dengan harga special. Manfaatkan promonya sekarang juga.']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Nikmati Promo 10-10 di tahun 2018 ini setiap pembelian produk pilihan dengan harga special. Manfaatkan promonya sekarang juga.']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Cyber Sale: Promo 10-10-2018']);
		\Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

        return $this->render('cybersale', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
    }
    
    public function actionHalloween(){
        
        $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
        
        $brand_id = [70,81,84,88,94,99];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
            
        // $promoMandiriKomono = [
			// 2226, 2224, 2130, 2136, 2137, 2140, 2141, 2227, 2143, 2144, 2145, 2146, 2147, 2387,
			// 2389, 2148, 2149, 2151, 2152, 2153, 2154, 2158, 2160, 2161, 2162, 2163, 2164, 2165,
			// 2166, 2167, 2392, 2398, 2201, 2202, 2204, 2205, 2206, 2207, 2208, 2209, 2210, 2211,
			// 2212, 2213, 2214, 2215, 2216, 2217, 2218, 2219, 2220, 2221, 2445, 2446, 2447, 2231,
			// 2232, 2233, 2234, 2235, 2236, 2237, 2238, 2239, 2240, 2241, 2242, 2243, 2244, 2245,
			// 2246, 2247, 2248, 2249, 2250, 2251, 2252, 2253, 2378, 2379, 2380, 2381, 2382, 2383,
			// 2384, 2385, 2386, 2449, 2450, 2451, 2452, 2453, 2454, 2455, 2456, 2457, 2458, 2459,
			// 2460, 2461, 2462, 2463 
		// ];
		
		$promoMandiriOb = [
			1995, 1782, 1660, 2479, 1639
		];
		
		// $promoMandiriTimex = [
			// 2048, 2049, 1788, 2090, 2097, 2098, 1792, 2099, 1793, 2111, 2112, 2113, 2114, 2115, 
			// 2116, 2092, 2094, 2102, 2104, 1803, 2168, 2107, 2109, 2110, 2254, 2169, 1736, 1737, 
			// 2171, 2091, 1802, 1743, 1746, 1748, 1749, 1750, 1751, 2100, 2101, 1731, 1732, 1786, 
			// 1794, 2172, 2173
		// ];
        // $product_no_discounts = \backend\models\Product::find()->joinWith(['specificPrice'])->where(['brands_brand_id'=>$brand_id])->all();
        // $p = 0;
        $id_prod = [1587, 1588, 1589, 1590, 1591, 1592, 1593, 1594, 1595, 1596, 1597, 1598, 1599, 2288, 2289, 2290, 2291, 2292, 2293, 2294, 2295, 2296, 2297, 2298, 2299, 2300, 2301, 2302, 2304, 2305, 2306, 2307, 2308, 2309, 2310, 2311, 2312, 2313, 2314, 2315, 2316, 2667, 2668, 2669, 2670, 2671, 2672, 2673, 2674, 2675, 2676, 2677, 2678, 2679, 2680, 2681, 2936, 2937, 2938, 2939, 2940, 2941, 2942, 2943, 2944, 2945, 2946, 2947, 2948, 2949, 2950, 2951, 2952, 2953, 2954, 2955, 2993, 3505, 3506, 3507, 3508, 3694, 3695, 3696, 3697, 3741, 3742, 3743, 3745, 3748, 3749, 3750, 3751, 3752, 3753, 3754, 3755, 3756, 3757, 3758, 3759, 3761, 3762, 3763, 3764, 3765, 3766, 3767, 3769, 3771, 3772, 3773, 3774, 3775, 3776, 3778, 3780, 3781, 3782, 3783, 3785, 3787, 3788, 3789, 3791, 3792, 3794, 3795, 3796, 3798, 3799, 3800, 3801, 3802, 3803, 3804, 3805, 3806, 3807, 3808, 3809, 3810, 3811, 3812, 3813, 3814, 3815, 3816, 3817, 3818, 3819, 3820, 3821, 3822, 3823, 3824, 3825, 3826, 3926, 3927, 3928, 3929, 3930, 3931, 3932, 3933, 3934, 3935, 3983, 3984, 3985, 3986, 3987, 3988, 3989, 3990, 3991, 3992, 3993, 3994, 3995, 3996, 3997, 3998, 3999, 4000, 4001, 4002, 4003, 4004, 4005, 4006, 4007, 4008, 4009, 4010, 4011, 4012, 4013, 4014, 4015, 4016, 4017, 4018, 4019, 4020, 4021, 4045, 4046, 4047];
        // foreach($product_no_discounts as $product_no_discount){
            // $id_prod[$p] = $product_no_discount->product_id;
            // $p++;
        // }
		
        // $id_prod = array_merge($promoMandiriKomono,$promoMandiriTimex);
                   
          // get all id product
          $id_prod = $this->actionIdproduct($brand_id,$id_prod);
        // print_r($id_prod);die();
                // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
        $this->title = 'Promo Oktober 2019, Hallowen';
		\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo Oktober 2019, Hallowen']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Nikmati Promo Oktober 2019 ini untuk setiap pembelian produk pilihan dengan harga spesial. Dapatkan promonya sekarang juga.']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Nikmati Promo Oktober 2019 ini untuk setiap pembelian produk pilihan dengan harga spesial. Dapatkan promonya sekarang juga.']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Oktober 2019, Tick or Treat']);
		\Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

        return $this->render('halloween', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
    }
    
    public function actionFurtherreduction(){
        
        $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
        
        $brand_id = [1,2,4,5,6,7,8,9,10,12,14,16,17,19,21,22,23,24,26,27,28,31,32,33,35,36,37,48,49,50,58,59,63,65,67,68,69,70,71,72,73,79];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
            
            $id_prod = [];
          // get all id product
          $id_prod = $this->actionIdproduct($brand_id,$id_prod);
                // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
        
        
        // \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Promo diskon akhir tahun 2017 di The Watch Co. Manfaatkan potongan harga sampai 60% untuk produk jam tangan dan aksesoris pria & wanita. Beli sekarang!']);
        // \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Diskon Akhir Tahun 2017 – The Watch Co.']);
        // \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo pilkada, pilkada dki jakarta, pilkada dki 2017, promo pilgub, promo pilgub dki jakarta, pilgub dki 2017, diskon pilkada, diskon pilkada dki 2017, diskon hari ini, promo hari ini']);
        
       // $products = [];

        return $this->render('furtherreduction', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
    }
	
	
    public function actionVospay(){
        $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'priority ASC'; // default sort by Low Price
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $brand_id = [1,2,4,5,6,7,8,9,10,12,14,16,17,19,21,22,23,24,26,27,28,31,32,33,35,36,37,44,48,49,50,58,59,63,65,67,68,69,70,71,72,73,74,75,76,77,78,79,84,81,82,83,84];
        // $brand_id = [1,2,3];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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

        $id_prod = [];
        $id_prod = $this->actionIdproduct($brand_id, $id_prod);
        
        // query product and filter
        $products = $this->actionProductnospecprice($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproductnospecprice($id_prod,$brand_id,$page,$limit);
        // $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        // $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
        $this->title = 'Promo Diskon Vospay – The Watch Co.';
		\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo Diskon Vospay – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Bagi pengguna Vospay, saatnya nikmati promo spesial bulan Oktober 2019 dengan dikon 30% setiap pembelian semua produk di The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Bagi pengguna Vospay, saatnya nikmati promo spesial bulan Oktober 2019 dengan dikon 30% setiap pembelian semua produk di The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Diskon Vospay – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

        return $this->render('eventall', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
    }
	
	public function actionSummersaleallproduct(){
        
        $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
        
        $brand_id = [1,2,4,5,6,7,8,9,10,12,14,16,17,19,21,22,23,24,26,27,28,31,32,33,35,36,37,44,48,49,50,58,59,63,65,67,68,69,70,71,72,73,74,75,76,77,78,79,84,81,82,83,84];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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

          // get all id product
          $id_prod = $this->actionIdproduct();
                // query product and filter
		$products = \backend\models\Product::getProductSaleAll($page, $limit, $sortby, 0);
        #$products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = \backend\models\Product::getCountProductSaleAll($page, $limit, $sortby, 0);
        
        
        
        $this->title = 'Promo Diskon Summer Sale – The Watch Co.';
		\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo Diskon Sale – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Bagi pengguna Vospay, saatnya nikmati promo spesial bulan Juli 2019 dengan dikon 30% setiap pembelian semua produk di The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Bagi pengguna Vospay, saatnya nikmati promo spesial bulan Juli 2019 dengan dikon 30% setiap pembelian semua produk di The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Diskon Vospay – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

        return $this->render('summersale', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
    }

    
    public function actionLimasale(){
        
        $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $brand_id = [14];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
            $id_prod = [];
          // get all id product
          $id_prod = $this->actionIdproduct($brand_id,$id_prod);
                // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);

        // \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dapatkan voucher Rp. 200.000 untuk pembelian jam tangan original di The Watch Co.khusus warga Jakarta yang telah berpartisipasi dalam PILKADA DKI Jakarta 2017']);
        // \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo PILKADA DKI Jakarta 2017']);
        // \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo pilkada, pilkada dki jakarta, pilkada dki 2017, promo pilgub, promo pilgub dki jakarta, pilgub dki 2017, diskon pilkada, diskon pilkada dki 2017, diskon hari ini, promo hari ini']);
        
       // $products = [];

        return $this->render('limasale', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
    }
    
    public function actionFlash(){
        
        $start = 0;
        $limit = 20;
        $now = date("Y-m-d H:i:s");
        $sort = 'none';
        if(isset($_GET['sortby'])){
            $sort = $_GET['sortby'];
        }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $brand_id = [5];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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

          $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
          
          if(isset($_GET['batch'])){
            if($_GET['batch'] == 1){
              $now = date("2019-01-25 16:00:00");
              $start_date = date("2019-01-25 16:00:00");
              $end_date = date("2019-01-25 18:00:00");
            }
            if($_GET['batch'] == 2){
              $now = date("2019-01-25 18:00:00");
              $start_date = date("2019-01-26 11:00:00");
              $end_date = date("2019-01-26 14:00:00");
            }
            if($_GET['batch'] == 3){
              $now = date("2019-01-26 11:00:00");
            }
            if($_GET['batch'] == 4){
              $now = date("2019-01-26 14:00:00");
            }
            // if($_GET['batch'] == 5){
              // $now = date("2018-07-18 12:00:00");
            // }
            // if($_GET['batch'] == 6){
              // $now = date("2018-07-18 18:00:00");
            // }
          }else{
            $start_date = date("2019-01-25 14:00:00");
            $end_date = date("2019-01-25 18:00:00");
          }

                $products = \backend\models\Product::find()
                        ->joinWith([
                            "brands",
                            "productFeature",
                            "productDetail",
                            "specificPrice",
                            "productImage" => function ($query) {
                                $query->andWhere(['cover' => 1]);
                            }
                        ])
                        // ->offset($start)
                        // ->limit($limit)
                        ->where('specific_price.from BETWEEN "'.$start_date.'" AND "'.$end_date.'"')
                        ->andWhere('specific_price.to BETWEEN "'.$start_date.'" AND "'.$end_date.'"')
                        // ->where(['<=','specific_price.from',$now])
                        // ->andWhere(['>=','specific_price.to',$now])
                        ->andWhere(['specific_price.is_flash_sale'=>1])
                        ->andWhere(['product.active' => 1,'brands.brand_id'=>48])
                        ->orderBy(new Expression('rand()'))
                        // ->orderBy('specific_price.flash_sale_qty DESC')
                        ->all();

                $productCount = \backend\models\Product::find()
                        ->joinWith([
                            "brands",
                            "productFeature",
                            "productDetail",
                            "specificPrice",
                            "productImage" => function ($query) {
                                $query->andWhere(['cover' => 1]);
                            }
                        ])
                        ->where('specific_price.from BETWEEN "'.$start_date.'" AND "'.$end_date.'"')
                        ->andWhere('specific_price.to BETWEEN "'.$start_date.'" AND "'.$end_date.'"')
                        // ->where(['<=','specific_price.from',$now])
                        // ->andWhere(['>=','specific_price.to',$now])
                        ->andWhere(['specific_price.is_flash_sale'=>1])
                        ->andWhere(['product.active' => 1,'brands.brand_id'=>48])
                        // ->orderBy(new Expression('rand()'))
                        ->orderBy('brands.brand_name ASC, specific_price.flash_sale_qty DESC')
                        ->all();
                // query product and filter
        
        $product_count = count($products);

        // var_dump($product_count);exit();
        
        $this->title = 'Flash Sale – The Watch Co.';
    \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo Awesome April – The Watch Co.']);
    \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Manfaatkan promo flash sale untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Manfaatkan promo flash sale untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
    \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Flash Sale – The Watch Co.']);
    \Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

        return $this->render('flash', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page, 
        "brands"=>$default_brand, "start_date"=>$start_date, "end_date"=>$end_date));
    }
    
    public function actionFlashGo()
    {
        $event_name         = 'Flash Sale';
        $start              = 0;
        $limit              = 20;
        $current_date       = date('Y-m-d H:i:s');
        $only_date          = date('Y-m-d');
        $start_date         = '2019-03-29';
        $end_date           = '2019-04-29';
        $start_batch        = ['11:00:00', '11:00:00'];
        $end_batch          = ['15:00:00', '15:00:00'];
        $start_date_batch_1 = $start_date.' '.$start_batch[0];
        $end_date_batch_1   = $start_date.' '.$end_batch[0];
		$start_date_batch_2 = $end_date.' '.$start_batch[1];
        $end_date_batch_2   = $end_date.' '.$end_batch[1];

		   $banner_desktop     = 'promo/flash/flash-sale-march-2019-desktop12.jpg?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;max-w=3840';
        $banner_mobile      = 'promo/flash/flash-sale-march-2019-mobile12.jpg?auto=compress%2Cformat&fm=pjpg';
        $time_actived       = 0;
        $total_sale         = 0;
        $brands             = array();
        $category           = array();
        $products           = array();
        $product            = array();
        $days               = 0;
        $countdown_sale     = '';
        $countdown_pre_sale = '';

        $sortby = 'none';
        if(isset($_GET['sortby'])){
            $sortby = $_GET['sortby'];
        }else{
            $sortby = 'none'; 
        }

        $page = 1;
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

        $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
        $start_time = $start_date_batch_1;
        $end_time   = $end_date_batch_1;
		
		

        if( ($current_date >= $start_date_batch_1) && ($current_date <= $end_date_batch_1)){
          
          $start_time     = $start_date_batch_1;
          $end_time       = $end_date_batch_1;
          $banner_desktop = 'promo/flash/flash-sale-march-2019-desktop12.jpg?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;max-w=3840';
          $banner_mobile  = 'promo/flash/flash-sale-march-2019-mobile12.jpg?auto=compress%2Cformat&fm=pjpg';
    
        }elseif( ($current_date >= $start_date_batch_2) && ($current_date <= $end_date_batch_2)){
          
          $start_time     = $start_date_batch_2;
          $end_time       = $end_date_batch_2;
          $banner_desktop = 'promo/flash/flash-sale-march-2019-desktop12.jpg?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;max-w=3840';
          $banner_mobile  = 'promo/flash/flash-sale-march-2019-mobile12.jpg?auto=compress%2Cformat&fm=pjpg';
        }

        if(isset($_GET['batch']) && $_GET['batch'] == 1) {

          $start_time     = $start_date_batch_1;
          $end_time       = $end_date_batch_1;

        }else if(isset($_GET['batch']) && $_GET['batch'] == 2) {

          $start_time     = $start_date_batch_2;
          $end_time       = $end_date_batch_2;
		  
		  
		 
        }

        // $products       = Product::getProductFlashSaleNew($brands, $category, $start_time, $end_time, $product, $start, $limit, $sortby);
        // $products_count = Product::getCountProductFlashSale($brands, $category, $start_time, $end_time, $product);
		
		
        if( ($current_date <= $start_time) ){
            $diff = abs(strtotime($start_date) - strtotime($current_date));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            if( $days >= 0 && $days <= 6 ){
                $countdown_pre_sale = date("D M j Y H:i:s", strtotime( date($start_time) ));
                $products = Product::getProductFlashSaleNew($brands, $category, $start_time, $end_time, $product, $start, $limit, $sortby);
                $products_count = Product::getCountProductFlashSale($brands, $category, $start_time, $end_time, $product);
            }
        }
		
       // if( ($current_date >= $start_time) && ($current_date <= $end_time) 
			

		
		// die(var_dump($start_time, $end_time));
            $time_actived = 1;
            $countdown_sale = date("D M j Y H:i:s", strtotime( date($end_time)) );
			
            $products = Product::getProductFlashSaleNew($brands, $category, $start_time, $end_time, $product, $start, $limit, $sortby);
            $products_count = Product::getCountProductFlashSale($brands, $category, $start_time, $end_time, $product);
		
		if(isset($_GET['batch']) && $_GET['batch'] == 2) {

          // die(var_dump($product, $start_time, $end_time));
		  
		  
		 
        }
		
        // }
        // die(var_dump($products));

        $this->title = $event_name.' – The Watch Co.';
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => $this->title]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Manfaatkan promo flash sale untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Manfaatkan promo flash sale untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => $this->title]);
        \Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

        return $this->render('flash-go', array( 
          "products" => $products, 
          "count" => (int)$products_count, 
          "limit" => $limit, 
          "page"=>$page, 
          "brands"=>$brands, 
          "current_date"=>$current_date, 
          "start_date"=>$start_date, 
          "end_date"=>$end_date, 
          "start_batch"=>$start_batch, 
          "end_batch"=>$end_batch, 
          "countdown_sale"=>$countdown_pre_sale, 
          "countdown_pre_sale"=>$countdown_pre_sale, 
          "banner_desktop"=>$banner_desktop, 
          "banner_mobile"=>$banner_mobile, 
          "time_active"=>$time_actived, 
          "pagination"=> $pagination 
        ));
    }
    
    // for flash sale experiments
	public function actionFlashDev(){
        $start = 0;
        $page = 1;
		$limit = 200;
		
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
        
        $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
		
		$arr_events = array (
			0 => 
			array (
				'event_id' => 1,
				'event_name' => 'Olivia Burton Flash Sale',
				'event_brands' => array('olivia-burton'),
				'banner_desktop' => 'promo/flash/main-banner-ob-desktop-01.jpg?auto=compress%2Cformat&fm=pjpg',
				'banner_mobile' => 'promo/flash/main-banner-ob-mobile-01.jpg?auto=compress%2Cformat&fm=pjpg',
				'start_date' => '2019-01-25',
				'end_date' => '2019-01-25',
				'batch' => array('11:00:00','16:00:00','17:00:00','21:00:00'),
			),
			// 1 => 
			// array (
				// 'event_id' => 2,
				// 'event_name' => 'Festival Sale',
				// 'event_brands' => array(),
				// 'banner_desktop' => 'promo/flash/header-desktop-13072018.jpg?auto=compress%2Cformat&amp;fm=pjpg',
				// 'banner_mobile' => 'promo/flash/header-mobile-13072018.jpg?auto=compress%2Cformat&fm=pjpg',
				// 'start_date' => '2019-01-29',
				// 'end_date' => '2019-01-31',
				// 'batch' => array('11:00:00','14:00:00','17:00:00','20:00:00'),
			// ),
        );
        
		$current_date = date('Y-m-d');
		$match_date = date('Y-m-d H:i:s');
		$arr_batchs = array('11:00:00','14:00:00');
		$time_actived = 0;
		$total_sale = 0;
		$brands = array();
        $category = array();
        $products = array();
		$product = array();
		$banner_desktop = "";
		$banner_mobile = "";
		
		$days = 0;
		$flashMicrotime = 0;
		$batch_start = "";
		$batch_end = "";
		$countdown_day_display = array();
		
		
		foreach($arr_events as $evt => $value){
			if( ($current_date >= $value['start_date']) && ($current_date <= $value['end_date']) ){
				
				$product = array();
                $brands = count($value['event_brands']) > 0 ? $value['event_brands'] : array();
                
				if(count($value['batch']) > 2){
					$arr_batchs = $value['batch'];
					$batch_start = $current_date." ".$value['batch'][0];
					$batch_end = $current_date." ".$value['batch'][1];
					$batch_start2 = $current_date." ".$value['batch'][2];
					$batch_end2 = $current_date." ".$value['batch'][3];
					
					if( ($match_date < date($batch_start)) ){
						$time_actived = 0;
						array_push($countdown_day_display, date("D M j Y H:i:s", strtotime( date($batch_start) )) );
					}
					if( ($match_date < date($batch_start2)) ){
						$time_actived = 0;
						array_push($countdown_day_display, date("D M j Y H:i:s", strtotime( date($batch_start2) )) );
					}
					if( ($match_date >= date($batch_start)) && ($match_date <= date($batch_end))){
						$countdown_display = date("D M j Y ".$value['batch'][1]);
						$time_actived = 1;
                        $products = Product::getProductFlashSaleNew($brands, $category, $batch_start, $batch_end, $product, $start, $limit, "");
					}
					if( ($match_date >= date($batch_start2)) && ($match_date <= date($batch_end2))){
						$countdown_display = date("D M j Y ".$value['batch'][3]);
						$time_actived = 1;
                        $products = Product::getProductFlashSaleNew($brands, $category, $batch_start2, $batch_end2, $product, $start, $limit, "");
					}
				}else{
					$arr_batchs = $value['batch'];
					$batch_start = $current_date." ".$value['batch'][0];
					$batch_end = $current_date." ".$value['batch'][1];
					
					if( ($match_date < date($batch_start)) ){
						$time_actived = 0;
						array_push($countdown_day_display, date("D M j Y H:i:s", strtotime( date($batch_start) )) );
					}
					if( ($match_date >= date($batch_start)) && ($match_date <= date($batch_end))){
						$countdown_display = date("D M j Y ".$value['batch'][1]);
						$time_actived = 1;
                        $products = Product::getProductFlashSaleNew($brands, $category, $batch_start, $batch_end, $product, $start, $limit, "");
					}
				}
				
				$banner_desktop = $value['banner_desktop'];
				$banner_mobile = $value['banner_mobile'];
				// $total_sale = Product::getCountProductFlashSale($brands, $category, $match_date, $product);
				
			}else{
				if($current_date < $value['start_date']){
					$dateToCompare = "";
					if(count($value['batch']) > 2){
						$batch_start = $value['start_date']." ".$value['batch'][0];
						$batch_end = $value['end_date']." ".$value['batch'][1];
						$batch_start2 = $value['start_date']." ".$value['batch'][2];
						$batch_end2 = $value['end_date']." ".$value['batch'][3];
						if( $match_date < date($batch_start) ){
							$dateToCompare = $batch_start;
						}
						if( $match_date < date($batch_start2) ){
							$dateToCompare = $batch_start2;
						}
					}else{
						$batch_start = $value['start_date']." ".$value['batch'][0];
						$batch_end = $value['end_date']." ".$value['batch'][1];
						if( $match_date < date($batch_start) ){
							$dateToCompare = $batch_start;
						}
					}
					// echo $batch_start;exit();
					$diff = abs(strtotime($dateToCompare) - strtotime($match_date));

					$years = floor($diff / (365*60*60*24));
					$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
					$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

					if( $days >= 0 && $days <= 6 ){
                        array_push($countdown_day_display, date("D M j Y H:i:s", strtotime( date($dateToCompare) )) );
                        $brands = count($value['event_brands']) > 0 ? $value['event_brands'] : array();
					}
				}
                $banner_desktop = 'promo/flash/header-desktop-timex-27012019.jpg?auto=compress%2Cformat&amp;fm=pjpg';
                $banner_mobile = 'promo/flash/header-mobile-timex-27012019.jpg?auto=compress%2Cformat&fm=pjpg';
			}
        }
		$total_sale = Product::getCountProductFlashSale($brands, $category, $match_date, $product);
        $products = Product::getProductFlashSaleNew($brands, $category, $batch_start, $batch_end, $product, $start, $limit, "");
		
        $this->title = 'Flash Sale – The Watch Co.';
		\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo Flash Sale – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Manfaatkan promo flash sale untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Manfaatkan promo flash sale untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Flash Sale – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);
		
        return $this->render('flash-dev', array("category" => $category, "limit" => $limit, "page"=>$page, "brands"=>$brands, 
			"time_actived" => $time_actived, "products" => $products, "count" => count($products), "current_date"=>$current_date, 
			"banner_desktop" => $banner_desktop, "banner_mobile" => $banner_mobile, 
			"arr_batch" => $arr_batchs, "countdown_display" => $countdown_display, "countdown_day_display"=>$countdown_day_display));
	}
    
    public function actionFlashSale(){
		
        $event_name = 'FLASH SALE';
        $start = 0;
        $limit = 20;
        $current_date = date('Y-m-d H:i:s');
        // $arr_batch = array('11:00:00', '14:00:00', '17:00:00', '20:00:00');
		$day_1 = '2019-05-25';
		$day_2 = '2019-05-25';
        $arr_batch = array('11:00:00', '14:00:00');
        $start_date = $day_1.' '.$arr_batch[0];
        $end_date = $day_1.' '.$arr_batch[1];

        $banner_desktop = 'promo/flash/flash_sale_may_2019_d_extra.jpg?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;max-w=3840';
        $banner_mobile = 'promo/flash/flash_sale_may_2019_m_extra.jpg?auto=compress%2Cformat&fm=pjpg';
		/*
		if( ($current_date > '2019-01-29 20:00:00') && ($current_date <= '2019-01-30 14:00:00') ){
			$arr_batch = array('11:00:00', '14:00:00');
			$start_date = '2019-01-30 '.$arr_batch[0];
			$end_date = '2019-01-30 '.$arr_batch[1];
		}elseif( ($current_date > '2019-01-31 20:00:00') && ($current_date <= '2019-02-01 17:00:00') ){
			$arr_batch = array('17:00:00', '21:00:00');
			$start_date = '2019-02-01 '.$arr_batch[0];
			$end_date = '2019-02-01 '.$arr_batch[1];
            $banner_desktop = 'promo/flash/flash-sale-march-2019-desktop11.jpg?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;max-w=3840';
            $banner_mobile = 'promo/flash/flash-sale-march-2019-mobile11.jpg?auto=compress%2Cformat&fm=pjpg';
		}elseif( ($current_date > '2019-02-01 17:00:00') && ($current_date <= '2019-02-01 21:00:00') ){
			$arr_batch = array('17:00:00', '21:00:00');
			$start_date = '2019-02-01 '.$arr_batch[0];
			$end_date = '2019-02-01 '.$arr_batch[1];
            $banner_desktop = 'promo/flash/flash-sale-march-2019-desktop11.jpg?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;max-w=3840';
            $banner_mobile = 'promo/flash/flash-sale-march-2019-mobile11.jpg?auto=compress%2Cformat&fm=pjpg';
        }
		*/
		
        /*
        elseif( ($current_date > '2019-02-01 21:00:00') && ($current_date <= '2019-02-02 17:00:00') ){
			$arr_batch = array('17:00:00', '21:00:00');
			$start_date = '2019-02-02 '.$arr_batch[0];
			$end_date = '2019-02-02 '.$arr_batch[1];
            $banner_desktop = 'promo/flash/head-banner-landing-page-desktop-020219.jpg?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;max-w=3840';
            $banner_mobile = 'promo/flash/head-banner-landing-page-mobile-020219.jpg?auto=compress%2Cformat&fm=pjpg';
		}elseif( ($current_date > '2019-02-02 17:00:00') && ($current_date <= '2019-02-02 21:00:00') ){
			$arr_batch = array('17:00:00', '21:00:00');
			$start_date = '2019-02-02 '.$arr_batch[0];
			$end_date = '2019-02-02 '.$arr_batch[1];
            $banner_desktop = 'promo/flash/head-banner-landing-page-desktop-020219.jpg?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;max-w=3840';
            $banner_mobile = 'promo/flash/head-banner-landing-page-mobile-020219.jpg?auto=compress%2Cformat&fm=pjpg';
        }
        */
		$time_actived = 0;
		$total_sale = 0;
		// $brands = array('aark-collective','braun','eastpak','rains','hypergrand','william-l.-1985','olivia-burton','timex');
		$brands = array();
        $category = array();
        $products = array();
		$product = array();
		$days = 0;
        $countdown_sale = '';
        $countdown_pre_sale = '';

        $sortby = 'none';
        if(isset($_GET['sortby'])){
            $sortby = $_GET['sortby'];
        }else{
            $sortby = 'none'; 
        }

        $page = 1;
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

        $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
        
        if( ($current_date >= $start_date) && ($current_date <= $end_date) ){
            $time_actived = 1;
            $countdown_sale = date("D M j Y H:i:s", strtotime( date($end_date)) );
            $products = Product::getProductFlashSaleNew($brands, $category, $start_date, $end_date, $product, $start, $limit, $sortby);
            $products_count = Product::getCountProductFlashSale($brands, $category, $start_date, $end_date, $product);
        }
        if( ($current_date < $start_date) ){
            $diff = abs(strtotime($start_date) - strtotime($current_date));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            if( $days >= 0 && $days <= 6 ){
                $countdown_pre_sale = date("D M j Y H:i:s", strtotime( date($start_date) ));
                $products = Product::getProductFlashSaleNew($brands, $category, $start_date, $end_date, $product, $start, $limit, $sortby);
                $products_count = Product::getCountProductFlashSale($brands, $category, $start_date, $end_date, $product);
            }
        }
          
        if(isset($_GET['batch'])){
            if($_GET['batch'] == 1){
                $start_date = date($day_1.' '.$arr_batch[0]);
                $end_date = date($day_1.' '.$arr_batch[1]);
                $products = Product::getProductFlashSaleNew($brands, $category, $start_date, $end_date, $product, $start, $limit, $sortby);
                $products_count = Product::getCountProductFlashSale($brands, $category, $start_date, $end_date, $product);
            }
            if($_GET['batch'] == 2){
                $start_date = date($day_1.' '.$arr_batch[2]);
                $end_date = date($day_1.' '.$arr_batch[3]);
                $products = Product::getProductFlashSaleNew($brands, $category, $start_date, $end_date, $product, $start, $limit, $sortby);
                $products_count = Product::getCountProductFlashSale($brands, $category, $start_date, $end_date, $product);
            }
            if($_GET['batch'] == 3){
                $start_date = date($day_1.' '.$arr_batch[0]);
                $end_date = date($day_1.' '.$arr_batch[1]);
                $products = Product::getProductFlashSaleNew($brands, $category, $start_date, $end_date, $product, $start, $limit, $sortby);
                $products_count = Product::getCountProductFlashSale($brands, $category, $start_date, $end_date, $product);
            }
            if($_GET['batch'] == 4){
                $start_date = date($day_1.' '.$arr_batch[2]);
                $end_date = date($day_1.' '.$arr_batch[3]);
                $products = Product::getProductFlashSaleNew($brands, $category, $start_date, $end_date, $product, $start, $limit, $sortby);
                $products_count = Product::getCountProductFlashSale($brands, $category, $start_date, $end_date, $product);
            }
        }
        // var_dump($products);exit();
        // var_dump(count($products));exit();
        // var_dump($countdown_sale);exit();

        $this->title = $event_name.' – The Watch Co.';
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => $this->title]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Manfaatkan promo flash sale untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Manfaatkan promo flash sale untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => $this->title]);
        \Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);
        
        return $this->render('flash-view', array("products" => $products, "count" => (int)$products_count, "limit" => $limit, "page"=>$page, 
            "brands"=>$brands, "current_date"=>$current_date, "start_date"=>$start_date, "end_date"=>$end_date, "arr_batch"=>$arr_batch, 
            "countdown_sale"=>$countdown_sale, "countdown_pre_sale"=>$countdown_pre_sale, "banner_desktop"=>$banner_desktop, "banner_mobile"=>$banner_mobile, 
            "time_active"=>$time_actived));
    }
    
    public function actionFlashSaleOb(){
        $event_name = 'Olivia Burton Flash Sale';
        $start = 0;
        $limit = 100;
        $current_date = date('Y-m-d H:i:s');
		// $current_date = '2020-01-27 15:00:00';
		
		
        // $arr_batch = array('11:00:00', '16:00:00', '11:00:00', '16:00:00');
        $arr_batch = array('00:00:00', '23:59:00');
        $start_date = '2020-01-27 '.$arr_batch[0];
        $end_date = '2020-01-29 '.$arr_batch[1];
		$time_actived = 0;
		$total_sale = 0;
		$brands = array('olivia-burton');
        $category = array();
        $products = array();
		
		$product27 = array(
			//Watches 27
			868, 869, 1421, 1579, 2859, 2896, 4124, 2413, 2256, 1697, 2421, 2637, 2858, 1771, 1774, 1778, 2877, 3700, 4141, 2018, 1999, 2001, 2665, 2430, 3306, 2851, 2022, 2853, 4201, 2278, 2257, 2317, 2260, 3233, 2264, 2265, 2666, 2273, 3227, 3304, 3301, 2280, 2283, 2284, 2879, 3498, 3702, 3308, 2423, 2425
			,
			//Jewellry 27
			2707, 2708, 2709, 2769, 2770, 2771, 2772, 2773, 2774, 2775, 2776, 2779, 2780, 2781, 2784, 2785, 2788, 2789, 2790, 2791, 2793, 2797, 2798, 2799, 2800, 2801, 2802, 2803, 2805, 2806, 2807, 2810, 2811, 2812, 2813, 2814, 2815, 2819, 2820, 2821, 2828, 2829, 2830, 2832, 2840, 2841, 2842, 2843, 2844, 2845
		
		
		);
		
		$product28 = array(
      //Watches 27
			868, 869, 1421, 1579, 2859, 2896, 4124, 2413, 2256, 1697, 2421, 2637, 2858, 1771, 1774, 1778, 2877, 3700, 4141, 2018, 1999, 2001, 2665, 2430, 3306, 2851, 2022, 2853, 4201, 2278, 2257, 2317, 2260, 3233, 2264, 2265, 2666, 2273, 3227, 3304, 3301, 2280, 2283, 2284, 2879, 3498, 3702, 3308, 2423, 2425
      ,
      //Watches 28
			2436, 2439, 4202, 2651, 2653, 4203, 3704, 4132, 4125, 2659, 4127, 2660, 4131, 2865, 3709, 3713, 3653, 3714, 2855, 2857, 2866, 2873, 3650, 2892, 3228, 3229, 3305, 4134, 4135, 4136, 4137, 3706, 3655, 4199, 3651, 4198, 3705, 3710, 3711, 4138, 4142, 4139, 3971, 3980, 3973, 3974, 4197, 3502, 3716, 4154, 4155
			,
			//Jewellry 27
      2707, 2708, 2709, 2769, 2770, 2771, 2772, 2773, 2774, 2775, 2776, 2779, 2780, 2781, 2784, 2785, 2788, 2789, 2790, 2791, 2793, 2797, 2798, 2799, 2800, 2801, 2802, 2803, 2805, 2806, 2807, 2810, 2811, 2812, 2813, 2814, 2815, 2819, 2820, 2821, 2828, 2829, 2830, 2832, 2840, 2841, 2842, 2843, 2844, 2845
      ,
			//Jewellry 28
			2984, 3216, 3218, 3219, 3220, 3221, 3224, 3235, 3236, 3239, 3311, 3312, 3313, 3314, 3315, 3729, 3730, 3731, 3732, 3733, 3734, 3735, 3736, 3737, 3738, 3739, 3740, 3744, 4022, 4023, 4024, 4027, 4031, 4032, 4033, 4035, 4036, 4037, 4038, 4039, 4041, 4043, 4044, 4156, 4157, 4158, 4159, 4160, 4161, 4162, 4163, 4164, 4165
		
		);
    
    
		$product29 = array(
			//Watches 27
			868, 869, 1421, 1579, 2859, 2896, 4124, 2413, 2256, 1697, 2421, 2637, 2858, 1771, 1774, 1778, 2877, 3700, 4141, 2018, 1999, 2001, 2665, 2430, 3306, 2851, 2022, 2853, 4201, 2278, 2257, 2317, 2260, 3233, 2264, 2265, 2666, 2273, 3227, 3304, 3301, 2280, 2283, 2284, 2879, 3498, 3702, 3308, 2423, 2425
			,
			//Watches 28
			2436, 2439, 4202, 2651, 2653, 4203, 3704, 4132, 4125, 2659, 4127, 2660, 4131, 2865, 3709, 3713, 3653, 3714, 2855, 2857, 2866, 2873, 3650, 2892, 3228, 3229, 3305, 4134, 4135, 4136, 4137, 3706, 3655, 4199, 3651, 4198, 3705, 3710, 3711, 4138, 4142, 4139, 3971, 3980, 3973, 3974, 4197, 3502, 3716, 4154, 4155
			,
			//Jewellry 27
			2707, 2708, 2709, 2769, 2770, 2771, 2772, 2773, 2774, 2775, 2776, 2779, 2780, 2781, 2784, 2785, 2788, 2789, 2790, 2791, 2793, 2797, 2798, 2799, 2800, 2801, 2802, 2803, 2805, 2806, 2807, 2810, 2811, 2812, 2813, 2814, 2815, 2819, 2820, 2821, 2828, 2829, 2830, 2832, 2840, 2841, 2842, 2843, 2844, 2845
			,
			//Jewellry 28
			2984, 3216, 3218, 3219, 3220, 3221, 3224, 3235, 3236, 3239, 3311, 3312, 3313, 3314, 3315, 3729, 3730, 3731, 3732, 3733, 3734, 3735, 3736, 3737, 3738, 3739, 3740, 3744, 4022, 4023, 4024, 4027, 4031, 4032, 4033, 4035, 4036, 4037, 4038, 4039, 4041, 4043, 4044, 4156, 4157, 4158, 4159, 4160, 4161, 4162, 4163, 4164, 4165
		
		);
		
    
    


    
		
		if(date("Y-m-d", strtotime($current_date)) == "2020-01-27"){
			$start_date_product = '2020-01-27 '.$arr_batch[0];
			$end_date_product = '2020-01-27 '.$arr_batch[1];
			$product = $product27;
		}else if(date("Y-m-d", strtotime($current_date)) == "2020-01-28"){
			$start_date_product = '2020-01-28 '.$arr_batch[0];
			$end_date_product = '2020-01-28 '.$arr_batch[1];
			$product = $product28;
		}else if(date("Y-m-d", strtotime($current_date)) == "2020-01-29"){
			$start_date_product = '2020-01-29 '.$arr_batch[0];
			$end_date_product = '2020-01-29 '.$arr_batch[1];
			$product = $product29;
		}else{
			$start_date_product = '';
			$end_date_product = '';
			$product = array();
		}
		
		$banner_desktop = 'promo/flash/Flash Sale OB Jan_Home Banner_Desktop?auto=compress%2Cformat&fm=pjpg';
        $banner_mobile = 'promo/flash/Flash Sale OB Jan_Home Banner_Mobile?auto=compress%2Cformat&fm=pjpg';
		$days = 0;
        $countdown_sale = '';
        $countdown_pre_sale = '';

        $sort = 'none';
        if(isset($_GET['sortby'])){
            $sort = $_GET['sortby'];
        }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
            $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
            $sortby = 'priority ASC';
        }if($sort == 'none'){
            $sortby = 'priority ASC';
        }

        $page = 1;
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

        $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
        
        if( ($current_date >= $start_date) && ($current_date <= $end_date) ){
            $time_actived = 1;
            $countdown_sale = date("D M j Y H:i:s", strtotime( date($end_date)) );
            $products = Product::getProductFlashSaleNew($brands, $category, $start_date_product, $end_date_product, $product, $start, $limit, "");
        }
		
        if( ($current_date < $start_date) ){
            $diff = abs(strtotime($start_date) - strtotime($current_date));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            if( $days >= 0 && $days <= 6 ){
                $countdown_pre_sale = date("D M j Y H:i:s", strtotime( date($start_date) ));
                $products = Product::getProductFlashSaleNew($brands, $category, $start_date_product, $end_date_product, $product, $start, $limit, "");
            }
        }
          

        $this->title = $event_name.' – The Watch Co.';
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => $this->title]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Manfaatkan promo flash sale untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Manfaatkan promo flash sale untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => $this->title]);
        \Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

        return $this->render('flash-view-ob', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page, 
            "brands"=>$brands, "current_date"=>$current_date, "start_date"=>$start_date, "end_date"=>$end_date, "arr_batch"=>$arr_batch, 
            "countdown_sale"=>$countdown_sale, "countdown_pre_sale"=>$countdown_pre_sale, "banner_desktop"=>$banner_desktop, "banner_mobile"=>$banner_mobile, 
            "time_active"=>$time_actived));
    }
    
    public function actionAwesomeapril(){
        
        $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $brand_id = [1,10,4,67,33,9,79,71,27,44,8,49,48];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
            $id_prod = [];
          // get all id product
          $id_prod = $this->actionIdproduct($brand_id,$id_prod);
                // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);

        
        $this->title = 'Promo Awesome April – The Watch Co.';
		\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo Awesome April – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Manfaatkan promo diskon bulan April untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Manfaatkan promo diskon bulan April untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Awesome April – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

        return $this->render('awesome-april', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
    }

    public function actionEndyearsale(){
        
        $start = 0;
        $limit = 20;
 
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $brand_id = [5,6,44,79,2];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
            $id_prod = [];
          // get all id product
          $id_prod = $this->actionIdproduct($brand_id,$id_prod);
          
         
                // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
	    $this->title = 'End Year Sale 2018 | The Watch Co.';

        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Promo diskon akhir tahun 2018 di The Watch Co. Manfaatkan potongan harga sampai 60% untuk produk jam tangan dan aksesoris pria & wanita. Beli sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Diskon Akhir Tahun 2018 – The Watch Co.']);
        // \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo pilkada, pilkada dki jakarta, pilkada dki 2017, promo pilgub, promo pilgub dki jakarta, pilgub dki 2017, diskon pilkada, diskon pilkada dki 2017, diskon hari ini, promo hari ini']);
        
       // $products = [];

        return $this->render('endsale', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
    }
    
    public function actionGiveaway(){ 

        $this->title = 'Giveaway - The Watch Co.';
		
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Valentine Special Deals ']);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'Valentine Special Deals  - The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Valentine Special Deals  - The Watch Co.']);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Valentine Special Deals  - The Watch Co.' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Valentine Special Deals ' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Valentine Special Deals  - The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/valentine']);
        // \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/event/seo-share.jpg' ]);

        // $model = \backend\models\KontesSeoContent::find()->where(['id'=>1])->one();
        return $this->render('giveaway');
	}

    
    public function actionTaketimetimex(){
        
        $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $brand_id = [44];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
            
            $id_prod = [];
            
          // get all id product
          $id_prod = $this->actionIdproduct($brand_id,$id_prod);
                // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);

        
        $this->title = 'Promo Timex – The Watch Co.';
		\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo Timex – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Manfaatkan promo diskon Timex untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Manfaatkan promo diskon Timex untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Timex – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

        return $this->render('taketime', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
    }

    public function actionWeeksale(){
		
		$start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
        
        $brand_id = [79];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
            
        
        
        $id_prod = [];
        
        
              // print_r($id_prod);die();
              // $id_prod = [2,3,4,5,6,7,8,9,10,2054];
              
          // get all id product
          // $id_prod = $this->actionIdproductintersect($brand_id,$id_prod);
        print_r($id_prod);die();
                // query product and filter
        // $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        // $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
		/*
		$start = 0;
        $limit = 20;
        $now = date("Y-m-d H:i:s");
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
        
        $brand_id = [44];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
            
            $id_prod = [
				1790, 1791, 2096, 2097, 2098, 1792, 2099, 1793, 1787, 1788, 2090, 2170, 2092, 2094,
				2048, 2049, 2102, 2103, 2104, 1809, 1803, 2168, 2106, 2107, 2109, 2110, 2111, 2112,
				2113, 2114, 2115, 2116, 1738, 2254, 2169, 2100, 2101, 1731, 1732, 2171, 2091, 1801,
				1802, 1786, 1794, 1796, 1797, 1798, 1736, 1737, 1743, 1744, 1746, 1748, 1749, 1750,
				1751, 2172, 2173, 1806, 1807, 1808
			];
        */    
          // get all id product
          $id_prod = $this->actionIdproduct($brand_id,$id_prod);
                // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
		
        
        // \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Promo diskon akhir tahun 2017 di The Watch Co. Manfaatkan potongan harga sampai 60% untuk produk jam tangan dan aksesoris pria & wanita. Beli sekarang!']);
        // \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Diskon Akhir Tahun 2017 – The Watch Co.']);
        // \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo pilkada, pilkada dki jakarta, pilkada dki 2017, promo pilgub, promo pilgub dki jakarta, pilgub dki 2017, diskon pilkada, diskon pilkada dki 2017, diskon hari ini, promo hari ini']);
        
       // $products = [];

        return $this->render('weeksale', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
		
	
	}
	
	public function actionPermata(){
		
		$start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
        
        // $brands = \backend\models\Brands::find()->where(['brands.brand_status'=>'active'])->all();
        // $p = 0;
         $brand_id = [1,4,67,9,79,49,48,71,10,8,33,44];
        // foreach($brands as $brand){
              // $brand_id[$p] = $brand->brand_id;
              // $p++;
        // }
       
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
        
        $id_prod = [];
        
        // OB id product only
        $id_prod_2 = [1468,1685];
       
        // Query all brand except OB
        $product_3 = \backend\models\Product::find()->where(['brands_brand_id'=>[1,4,67,9,79,49,71,10,8,33,44]])->all();
        $p = 0;
        $id_prod_3 = [];
        foreach($product_3 as $prod){
            $id_prod_3[$p] = $prod->product_id;
            $p++;
        }
        
        // merge all
        $id_prod = array_merge($id_prod_2,$id_prod_3);
        $now = date("Y-m-d H:i:s");
        $spec_price = \backend\models\SpecificPrice::find()
            ->where('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->all();
          $p = 0;
          $id_prod2 = [];
            foreach($spec_price as $spec_prices){
              $id_prod2[$p] = $spec_prices->product_id;
                  $p++;
            }
        // print_r($id_prod2);die();
        
        $id_prod = array_intersect($id_prod,$id_prod2);   
          // get all id product
          $id_prod = $this->actionIdproductintersect($brand_id,$id_prod);
                // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
		
        
        $this->title = 'Promo Permata Bank – The Watch Co.';
		\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo Permata Bank – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Beli jam tangan hemat hingga 40% dengan diskon tambahan 5% khusus untuk perngguna kartu kredit Permata Bank hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Beli jam tangan hemat hingga 40% dengan diskon tambahan 5% khusus untuk perngguna kartu kredit Permata Bank hanya di The Watch Co. Beli Sekarang!']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Permata Bank – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

        return $this->render('permata', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
		
	
	}

    public function actionForthefans(){
		$start = 0;
        $limit = 20;
        $now = date("Y-m-d H:i:s");
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
        
        $brand_id = [1,2,4,9,10,44,48,49,71,72,79];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
            
          $id_prod = [];
          $spec_price = \backend\models\SpecificPrice::find()
            ->where('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->all();
          $p = 0;
          $id_prod2 = [];
            foreach($spec_price as $spec_prices){
              $id_prod2[$p] = $spec_prices->product_id;
                  $p++;
            }
             // print_r($id_prod2);die();
          $results = \backend\models\Product::find()->where(['product_category_id'=>5])->all();
          $p = 0;
              foreach($results as $result){
              $id_prod[$p] = $result->product_id;
                  $p++;
              }
            $id_prod = array_diff($id_prod,$id_prod2);
              // print_r($id_prod);die();
              // $id_prod = [2,3,4,5,6,7,8,9,10,2054];
              
          // get all id product
          $id_prod = $this->actionIdproductintersect($brand_id,$id_prod);
        // print_r($id_prod);die();
                // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
        
        
        // \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Promo diskon akhir tahun 2017 di The Watch Co. Manfaatkan potongan harga sampai 60% untuk produk jam tangan dan aksesoris pria & wanita. Beli sekarang!']);
        // \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Diskon Akhir Tahun 2017 – The Watch Co.']);
        // \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo pilkada, pilkada dki jakarta, pilkada dki 2017, promo pilgub, promo pilgub dki jakarta, pilgub dki 2017, diskon pilkada, diskon pilkada dki 2017, diskon hari ini, promo hari ini']);
        
       // $products = [];

        return $this->render('forthefans', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
		
	
	}


	public function actionClearancesale(){
        
        $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }

        
        $now = date("Y-m-d H:i:s");
        
        $count = \backend\models\Product::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection" => function ($query) {
                        $query->andWhere(['brands_collection_status' => 1]);
                    },
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
                
            ])
            ->where([ 
				'product.active' => 1
			])
            ->andWhere(['product.brands_brand_id' => [4,16,26,7,8,22,44,85,59,79,72]])
			->andWhere(['product_category_id' => 5])
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->all();
        
        
        $product_count = count($count);        
        
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
		
        if(isset($_GET['page'])) {
            
            $page = $_GET['page'];
            
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
			
            if(isset($_GET['brands'])){

                $brandsName = explode('--', $_GET['brands']);

                $page = $_GET['page'];

                $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit; 

                $prices = explode('--', $_GET['price']);

                $products = \backend\models\Product::getProductByFilterBrands($brandsName, "", $start, $limit, $prices);

                $count = \backend\models\Product::getTotalProductByFilterBrands($brandsName, "", $prices); 

                $product_count = count($count);

            } else {

                $products = \backend\models\Product::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->offset($start)
                ->limit($limit)
                ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection" => function ($query) {
                                        $query->andWhere(['brands_collection_status' => 1]);
                                },
                        "specificPrice",
                        "productImage" => function ($query) {
                                $query->andWhere(['cover' => 1]);
                        }
                ])
                ->where([ 
                    'product.active' => 1
                ])
                ->andWhere(['product.brands_brand_id' => [4,16,26,7,8,22,44,85,59,79,72]])
				->andWhere(['product_category_id' => 5])
                ->orderBy($sortby)
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->all();
            }        
            
            
        } else {
			
            $products = \backend\models\Product::find()
            ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection" => function ($query) {
                        $query->andWhere(['brands_collection_status' => 1]);
                    },
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where([ 
				'product.active' => 1
			])
            ->andWhere(['product.brands_brand_id' => [4,16,26,7,8,22,44,85,59,79,72]])
			->andWhere(['product_category_id' => 5])
            ->orderBy($sortby)
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->all();
            
        }
        
        // \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dapatkan voucher Rp. 200.000 untuk pembelian jam tangan original di The Watch Co.khusus warga Jakarta yang telah berpartisipasi dalam PILKADA DKI Jakarta 2017']);
        // \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo PILKADA DKI Jakarta 2017']);
        // \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo pilkada, pilkada dki jakarta, pilkada dki 2017, promo pilgub, promo pilgub dki jakarta, pilgub dki 2017, diskon pilkada, diskon pilkada dki 2017, diskon hari ini, promo hari ini']);
        
       // $products = [];

        return $this->render('clearancesale1119', array("products" => $products, "count" => $product_count, "limit" => $limit, "brands"=>[4,16,26,7,8,22,44,85,59,79,72]));
    }

	
	public function actionSurprisesale(){
        
        $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }

        
        $now = date("Y-m-d H:i:s");
        
        $count = \backend\models\Product::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection" => function ($query) {
                        $query->andWhere(['brands_collection_status' => 1]);
                    },
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
                
            ])
            ->where([ 
				'product.active' => 1
			])
            ->andWhere(['product.brands_brand_id' => [9, 49, 67, 1, 44]])
			->andWhere(['product_category_id' => 5])
            // ->andWhere('specific_price.from <= "'. $now . '"')
            // ->andWhere('specific_price.to > "'. $now . '"')
            ->all();
        
        
        $product_count = count($count);        
        
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
		
        if(isset($_GET['page'])) {
            
            $page = $_GET['page'];
            
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
			
            if(isset($_GET['brands'])){

                $brandsName = explode('--', $_GET['brands']);

                $page = $_GET['page'];

                $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit; 

                $prices = explode('--', $_GET['price']);

                $products = \backend\models\Product::getProductByFilterBrands($brandsName, "", $start, $limit, $prices);

                $count = \backend\models\Product::getTotalProductByFilterBrands($brandsName, "", $prices); 

                $product_count = count($count);

            } else {

                $products = \backend\models\Product::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->offset($start)
                ->limit($limit)
                ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection" => function ($query) {
                                        $query->andWhere(['brands_collection_status' => 1]);
                                },
                        "specificPrice",
                        "productImage" => function ($query) {
                                $query->andWhere(['cover' => 1]);
                        }
                ])
                ->where([ 
                    'product.active' => 1
                ])
                ->andWhere(['product.brands_brand_id' => [9, 49, 67, 1, 44]])
				->andWhere(['product_category_id' => 5])
                ->orderBy($sortby)
                // ->andWhere('specific_price.from <= "'. $now . '"')
                // ->andWhere('specific_price.to > "'. $now . '"')
                ->all();
            }        
            
            
        } else {
			
            $products = \backend\models\Product::find()
            ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection" => function ($query) {
                        $query->andWhere(['brands_collection_status' => 1]);
                    },
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where([ 
				'product.active' => 1
			])
            ->andWhere(['product.brands_brand_id' => [9, 49, 67, 1, 44]])
			->andWhere(['product_category_id' => 5])
            ->orderBy($sortby)
            // ->andWhere('specific_price.from <= "'. $now . '"')
            // ->andWhere('specific_price.to > "'. $now . '"')
            ->all();
            
        }
        
        // \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dapatkan voucher Rp. 200.000 untuk pembelian jam tangan original di The Watch Co.khusus warga Jakarta yang telah berpartisipasi dalam PILKADA DKI Jakarta 2017']);
        // \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo PILKADA DKI Jakarta 2017']);
        // \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo pilkada, pilkada dki jakarta, pilkada dki 2017, promo pilgub, promo pilgub dki jakarta, pilgub dki 2017, diskon pilkada, diskon pilkada dki 2017, diskon hari ini, promo hari ini']);

        return $this->render('surprisesale', array("products" => $products, "count" => $product_count, "limit" => $limit));
    }
	
	public function actionWeekendstyle(){
        
        $start = 0;
        $limit = 20;
        
        $now = date("Y-m-d H:i:s");
        
        $count = \backend\models\Product::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection" => function ($query) {
                        $query->andWhere(['brands_collection_status' => 1]);
                    },
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
                
            ])
            ->where([ 
				'product.active' => 1
			])
            ->andWhere(['product.product_category_id' => 7])
            // ->andWhere('specific_price.from <= "'. $now . '"')
            // ->andWhere('specific_price.to > "'. $now . '"')
            ->all();
        
        
        $product_count = count($count);        
        
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
		
        if(isset($_GET['page'])) {
            
            $page = $_GET['page'];
            
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
			
            if(isset($_GET['brands'])){

                $brandsName = explode('--', $_GET['brands']);

                $page = $_GET['page'];

                $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit; 

                $prices = explode('--', $_GET['price']);

                $products = \backend\models\Product::getProductByFilterBrands($brandsName, "", $start, $limit, $prices);

                $count = \backend\models\Product::getTotalProductByFilterBrands($brandsName, "", $prices); 

                $product_count = count($count);

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
                        "specificPrice",
                        "productImage" => function ($query) {
                                $query->andWhere(['cover' => 1]);
                        }
                ])
                ->where([ 
                    'product.active' => 1
                ])
                ->andWhere(['product.product_category_id' => 7])
                ->orderBy('product.price ASC')
                // ->andWhere('specific_price.from <= "'. $now . '"')
                // ->andWhere('specific_price.to > "'. $now . '"')
                ->all();
            }        
            
            
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
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where([ 
				'product.active' => 1
			])
            ->andWhere(['product.product_category_id' => 7])
            ->orderBy('product.price ASC')
            // ->andWhere('specific_price.from <= "'. $now . '"')
            // ->andWhere('specific_price.to > "'. $now . '"')
            ->all();
            
        }
        
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dapatkan voucher Rp. 200.000 untuk pembelian jam tangan original di The Watch Co.khusus warga Jakarta yang telah berpartisipasi dalam PILKADA DKI Jakarta 2017']);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo PILKADA DKI Jakarta 2017']);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo pilkada, pilkada dki jakarta, pilkada dki 2017, promo pilgub, promo pilgub dki jakarta, pilgub dki 2017, diskon pilkada, diskon pilkada dki 2017, diskon hari ini, promo hari ini']);

        return $this->render('weekendstyle', array("products" => $products, "count" => $product_count, "limit" => $limit));
    }
	
	public function actionPilkadatwc(){
		
		\Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dapatkan voucher Rp. 200.000 untuk pembelian jam tangan original di The Watch Co.khusus warga Jakarta yang telah berpartisipasi dalam PILKADA DKI Jakarta 2017']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo PILKADA DKI Jakarta 2017']);
		\Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo pilkada, pilkada dki jakarta, pilkada dki 2017, promo pilgub, promo pilgub dki jakarta, pilgub dki 2017, diskon pilkada, diskon pilkada dki 2017, diskon hari ini, promo hari ini']);
		
		return $this->render('pilkadatwc');
	}
	
	public function actionShopback(){
		
		$start = 0;
        $limit = 20;
		
		$sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $current_date = date('Y-m-d H:i:s');
        
       // if($current_date >= '2018-08-17 00:00:01' && $current_date <= '2018-08-17 23:59:59'){
            $brand_id = [44,2,79,6,48,5];
        // }else{
            // $brand_id = [44,2,79,6,5];
        // }
        
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
		
		// if($current_date >= '2018-08-17 00:00:01' && $current_date <= '2018-08-17 23:59:59'){
             $id_rains_eastpak = [1529,1538,1531,898,926,1203,1240,1256,1283,619,906,968,1210,1244,1259,701,914,1195,1235,1252,1262,1615,899,941,1204,1242,1257,1284,633,907,1010,1214,1245,1260,702,918,1197,1239,1255,1279,905,963,1209,1243,1258,1285,700,908,1012,1232,1246,1261];
        
            $id_dw = [95,97,98,99,102,103,104,105,106,107,108,109,110,114,115,117,118,119,120,121,122,123,124,125,128,365,367,378,382,438,439,440,441,442,443,444,445,446,447,448,449,450,451,452,454,455,456,457,458,460,463,464,465,466,467,468,469,470,471,472,1032,1034,1327,1328,1329,1330,1332,1333,1334,1335,1337,1338,1339,1340,1341,1342,1457,1458,1459,1460,1581,1582,1583,1584,1683,1684,1692,1693,1816,1819,1820,1821,1822,1823,1824,1825,1826,1827,2026,2028,2029,2030,2031,2032,2033,2034,2035,2036,2037,2038,2039,2040,2041,2480,2481,2482,2483,2484,2485,2486,2693,2694,2697,2698];
            
            // $id_nam = [2196,2197,2198,2199,2200];
            // $id_casio = [2406,2079,2081,2477,2409,2443,2089,2403,2084,2472,2057,2061,2086,2087,2475,2474,2478];
            
            $id_ob = [1102,1138,862,1782,1117,1104,1421,1164,1167,1477,1169,1120,1406,1118,1407,1422,1992,1773,1995,1760,1639,1698,1643,1779,2479,1107,1467,1463,1426,1464,2262,1654,1659,2418,1656,1702,1652,1653,2283,2010,1660,1398,1785,1645,1647,1697,1707,1694,2014,1784,2435,2426,1608,2427,2428];
            
            $id_timex = [2547,2548,2549,2550,2551,2552,2553,2554,2555,2556,2544,2545,2559,2560,2546,2621,2622,2628,2520,2521,2522,2699,2623,2624,2625,2627,2557,2558,2626,2702,2524,2525,2526,2527,2528,2529,2542,2543,2530,2531,2532,2617,2533,2534,2535,2536,2537,2538,2539,2618,2540,2541,2619,2620,2700,2701,2523,2616,2704,2705,2706];
            
            $id_komono = [2130,2132,2134,2136,2140,2141,2143,2144,2145,2148,2149,2151,2152,2158,2159,2161,2162,2163,2164,2165,2167,2206,2207,2208,2209,2210,2211,2212,2214,2216,2217,2220,2221,2224,2226,2227,2231,2232,2233,2234,2235,2236,2237,2238,2239,2240,2241,2242,2243,2244,2245,2246,2247,2248,2249,2251,2252,2253,2378,2379,2380,2381,2382,2383,2384,2385,2386,2389,2394,2396,2397,2398,2445,2446,2447,2449,2450,2452,2453,2454,2455,2457,2458,2459,2460,2461,2462,2591,2592,2593,2594,2595,2596,2597,2598,2599,2600,2602,2603,2604,2605,2606,2608,2609,2610,2611,2612,2613,2614,2615,2629];
    		
            $id_prod = array_merge($id_rains_eastpak,$id_dw,$id_ob,$id_timex,$id_komono);
            
            $id_prod = $this->actionIdproductintersect($brand_id,$id_prod);
        // }else{
            // $id_prod = [];
            // $id_prod = $this->actionIdproduct($brand_id,$id_prod);
        // }
        
        
            // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
        $this->title = 'Promo Shopback - The Watch Co.';
		
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dalam rangka menyambut HUT RI, The Watch Co. memberikan promo merdeka 17 Agustus yang sayang jika dilewatkan. Dapatkan promo jam tangan favoritmu sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'Promo Shopback - The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Shopback - The Watch Co.']);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo Shopback - The Watch Co.' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Dalam rangka menyambut HUT RI, The Watch Co. memberikan promo kejutan 17 Agustus yang sayang jika dilewatkan. Dapatkan promo jam tangan favoritmu sekarang!' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Promo Shopback']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/shopback']);
        // \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/event/seo-share.jpg' ]);

        // $model = \backend\models\KontesSeoContent::find()->where(['id'=>1])->one();
        return $this->render('shopback', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
    }
	
	public function actionGopay(){
		
		$start = 0;
        $limit = 20;
		
		$sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $current_date = date('Y-m-d H:i:s');
        
        $brand_id = [2,9,24,19,17,80,5,6,77,74,78,75,76];
        
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
		
		$special_promo_products = \backend\models\SpecialPromoProduct::find()->where(['special_promo_id'=>3])->all();
		$id_prod = [];
		$p = 0;
		foreach($special_promo_products as $special_promo_product){
		    
            $id_prod[$p] = $special_promo_product->product_id;
            $p++;
        
		}
	          
        $id_prod = $this->actionIdproductintersect($brand_id,$id_prod);
        
        
            // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
        $this->title = 'Promo Everyday is Payday with GO-PAY - The Watch Co.';
		
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'The Watch Co. memberikan promo Everyday is Payday with GO-PAY yang sayang jika dilewatkan. Dapatkan promo untuk produk favoritmu sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'Promo Everyday is Payday with GO-PAY - The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Everyday is Payday with GO-PAY - The Watch Co.']);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo Everyday is Payday with GO-PAY - The Watch Co.' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'The Watch Co. memberikan promo Everyday is Payday with GO-PAY yang sayang jika dilewatkan. Dapatkan promo untuk produk favoritmu sekarang!' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Promo Everyday is Payday with GO-PAY']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/promogopay']);
        // \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/event/seo-share.jpg' ]);

        // $model = \backend\models\KontesSeoContent::find()->where(['id'=>1])->one();
        return $this->render('gopay', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
    }
    
	public function actionAgustus(){
		
		$start = 0;
        $limit = 20;
		
		$sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $current_date = date('Y-m-d H:i:s');
        
        if($current_date >= '2019-08-08 00:00:00' && $current_date <= '2019-08-18 00:00:00'){
            $brand_id = [44, 79, 9, 5, 6, 49, 73, 75, 81, 82, 87, 14, 84, 48, 94, 85, 86, 88];
            // $brand_id_2 = [73, 75, 81, 82, 87];
            // $brand_id_3 = [14, 84, 48, 94, 85, 86, 88];
        }else if($current_date >= '2019-08-08 00:00:00' && $current_date <= '2019-08-31 23:59:59'){
            $brand_id = [9, 79, 44, 6, 5];
        }
		
        
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
		
        if($current_date >= '2019-08-08 00:00:00' && $current_date <= '2019-08-18 00:00:00'){
            $id_rains_eastpak = [574, 575, 576, 577, 578, 579, 590, 592, 594, 608, 619, 620, 621, 622, 623, 624, 625, 626, 627, 628, 629, 630, 631, 632, 633, 634, 635, 636, 637, 638, 639, 641, 642, 643, 644, 645, 646, 647, 648, 649, 650, 651, 652, 653, 654, 655, 656, 657, 658, 659, 660, 661, 662, 663, 664, 665, 666, 667, 668, 669, 671, 672, 673, 676, 677, 678, 680, 689, 690, 691, 692, 693, 696, 697, 698, 699, 700, 701, 702, 887, 890, 892, 893, 894, 895, 896, 897, 898, 899, 900, 901, 902, 903, 904, 905, 906, 907, 908, 909, 910, 911, 912, 913, 914, 915, 916, 917, 918, 919, 920, 921, 922, 923, 924, 925, 926, 927, 928, 929, 930, 931, 933, 934, 937, 938, 939, 941, 942, 944, 945, 946, 949, 950, 951, 952, 955, 957, 960, 962, 963, 964, 965, 966, 967, 968, 969, 970, 1010, 1011, 1012, 1013, 1014, 1015, 1016, 1017, 1018, 1019, 1020, 1021, 1183, 1184, 1185, 1187, 1188, 1189, 1190, 1191, 1192, 1193, 1194, 1195, 1196, 1197, 1198, 1199, 1200, 1201, 1202, 1203, 1204, 1205, 1206, 1207, 1208, 1209, 1210, 1211, 1212, 1213, 1214, 1215, 1216, 1217, 1218, 1219, 1220, 1221, 1222, 1223, 1224, 1225, 1226, 1227, 1228, 1229, 1230, 1231, 1232, 1233, 1234, 1235, 1236, 1237, 1238, 1239, 1240, 1241, 1242, 1243, 1244, 1245, 1246, 1247, 1248, 1249, 1250, 1251, 1252, 1253, 1254, 1255, 1256, 1257, 1258, 1259, 1260, 1261, 1262, 1263, 1264, 1265, 1266, 1267, 1268, 1269, 1270, 1271, 1272, 1273, 1274, 1275, 1276, 1277, 1278, 1279, 1280, 1281, 1282, 1283, 1284, 1285, 1286, 1393, 1394, 1395, 1396, 1524, 1525, 1526, 1528, 1529, 1530, 1531, 1532, 1533, 1534, 1535, 1536, 1537, 1538, 1539, 1540, 1541, 1560, 1561, 1563, 1564, 1565, 1566, 1567, 1568, 1569, 1570, 1571, 1572, 1573, 1574, 1575, 1576, 1577, 1613, 1614, 1615, 1616, 1617, 1618, 1619, 1620, 1621, 1622, 1623, 1624, 1625, 1626, 1627, 1628, 1629, 1631, 1632, 1690, 1691, 3250, 3401, 3402, 3403, 3404, 3405, 3407, 3408, 3409, 3509, 3510, 3511, 3512, 3513, 3514, 3515, 3516, 3517, 3518, 3519, 3520, 3521, 3522, 3523, 3524, 3525];
            $id_hypergrand = [22, 23, 24, 25, 26, 27, 28, 29, 32, 33, 34, 35, 36, 37, 38, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 66, 67, 69, 70, 73, 74, 76, 79, 82, 83, 84, 85, 86, 87, 111, 112, 113, 116, 132, 134, 135, 136, 141, 142, 143, 144, 146, 147, 149, 151, 153, 205, 206, 213, 215, 216, 217, 220, 224, 225, 226, 227, 228, 229, 230, 231, 232, 233, 234, 235, 236, 237, 238, 239, 240, 241, 242, 243, 244, 245, 246, 247, 248, 249, 250, 251, 252, 288, 316, 317, 318, 319, 320, 321, 322, 323, 325, 326, 327, 328, 329, 330, 331, 332, 333, 334, 335, 336, 337, 338, 339, 340, 341, 342, 343, 344, 345, 346, 347, 348, 349, 350, 351, 352, 353, 354, 355, 356, 357, 358, 359, 360, 361, 362, 363, 364, 366, 368, 369, 370, 371, 372, 373, 374, 375, 376, 377, 379, 380, 381, 534, 535, 536, 537, 538, 539, 540, 770, 771, 772, 773, 774, 775, 776, 777, 778, 779, 780, 781, 782, 783, 784, 785, 786, 787, 788, 789, 791, 792, 793, 794, 795, 796, 797, 798, 799, 800, 801, 802, 1050, 1051, 1052, 1093, 1094, 1095, 1096, 1097, 1098, 1099];
            $id_timex = [804, 805, 808, 809, 810, 811, 812, 813, 814, 815, 816, 817, 818, 819, 820, 821, 822, 823, 824, 825, 826, 827, 828, 830, 831, 832, 834, 840, 842, 845, 852, 853, 854, 856, 870, 871, 872, 873, 874, 875, 876, 877, 879, 880, 881, 884, 1060, 1061, 1062, 1063, 1064, 1125, 1126, 1127, 1128, 1129, 1320, 1323, 1484, 1485, 1486, 1487, 1488, 1489, 1490, 1491, 1492, 1493, 1494, 1495, 1496, 1497, 1498, 1499, 1500, 1501, 1502, 1503, 1505, 1506, 1507, 1508, 1509, 1688, 1689, 1731, 1732, 1734, 1735, 1736, 1737, 1741, 1742, 1743, 1744, 1745, 1746, 1747, 1748, 1749, 1750, 1751, 1786, 1787, 1788, 1789, 1790, 1791, 1792, 1793, 1794, 1796, 1797, 1798, 1799, 1800, 1801, 1802, 1803, 1804, 1805, 1806, 1807, 1808, 1809, 2048, 2049, 2090, 2091, 2092, 2093, 2094, 2095, 2096, 2097, 2098, 2099, 2100, 2101, 2102, 2103, 2104, 2105, 2106, 2107, 2108, 2109, 2110, 2111, 2112, 2113, 2114, 2115, 2116, 2168, 2170, 2171, 2172, 2173, 2520, 2521, 2522, 2523, 2524, 2525, 2526, 2527, 2528, 2529, 2530, 2531, 2532, 2533, 2534, 2535, 2536, 2537, 2538, 2539, 2540, 2541, 2542, 2543, 2544, 2545, 2546, 2547, 2548, 2549, 2550, 2551, 2552, 2553, 2554, 2555, 2556, 2557, 2558, 2559, 2560, 2616, 2617, 2618, 2619, 2620, 2621, 2622, 2623, 2624, 2625, 2626, 2627, 2699, 2700, 2701, 2702, 2703, 2704, 2705, 2706, 2849, 2985, 2986, 2987, 2988, 2989, 2992, 2994, 2995, 2996, 2997, 2998, 2999, 3000, 3001, 3005, 3006, 3007, 3008, 3123, 3124, 3125, 3126, 3127, 3128, 3130, 3131, 3132, 3133, 3134, 3135, 3136, 3137, 3138, 3139, 3141, 3142, 3143, 3144, 3145, 3146, 3147, 3148, 3149, 3150, 3151, 3152, 3153, 3154, 3155, 3156, 3157, 3158, 3159, 3160, 3161, 3162, 3167, 3168, 3169, 3170, 3171, 3172, 3173, 3174, 3177, 3201, 3202, 3203, 3211, 3212, 3213, 3214, 3215, 3287, 3288, 3289, 3290, 3295, 3296, 3297, 3298, 3299, 3937, 3938, 3939, 3940, 3941, 3942, 3943, 3944, 3945, 3946, 3947, 3948, 3949, 3950, 3951, 3952, 3953, 3954, 3955, 3957, 3958, 3959, 3960, 3961, 3962, 3965, 3967];
            $id_komono = [2118, 2119, 2120, 2121, 2122, 2123, 2124, 2125, 2126, 2127, 2128, 2129, 2130, 2131, 2132, 2133, 2134, 2135, 2136, 2137, 2138, 2139, 2140, 2141, 2143, 2144, 2145, 2146, 2147, 2148, 2149, 2150, 2151, 2152, 2153, 2154, 2155, 2156, 2157, 2158, 2159, 2160, 2161, 2162, 2163, 2164, 2165, 2166, 2167, 2201, 2202, 2203, 2204, 2205, 2206, 2207, 2208, 2209, 2210, 2211, 2212, 2213, 2214, 2215, 2216, 2217, 2218, 2219, 2220, 2221, 2222, 2223, 2224, 2225, 2226, 2227, 2228, 2229, 2230, 2231, 2232, 2233, 2234, 2235, 2236, 2237, 2238, 2239, 2240, 2241, 2242, 2243, 2244, 2245, 2246, 2247, 2248, 2249, 2250, 2251, 2252, 2253, 2378, 2379, 2380, 2381, 2382, 2383, 2384, 2385, 2386, 2387, 2388, 2389, 2390, 2391, 2392, 2393, 2394, 2395, 2396, 2397, 2398, 2445, 2446, 2447, 2449, 2450, 2451, 2452, 2453, 2454, 2455, 2456, 2457, 2458, 2459, 2460, 2461, 2462, 2463, 2591, 2592, 2593, 2594, 2595, 2596, 2597, 2598, 2599, 2600, 2601, 2602, 2603, 2604, 2605, 2606, 2607, 2608, 2609, 2610, 2611, 2612, 2613, 2614, 2615, 2629, 3121, 3122, 3192, 3195, 3196, 3197, 3199, 3241, 3242, 3243, 3244, 3245, 3246, 3247, 3248, 3249, 3253, 3254, 3255, 3256, 3257];
            $id_william_l = [971, 972, 973, 974, 975, 976, 977, 978, 979, 980, 981, 982, 983, 984, 985, 986, 987, 988, 989, 990, 991, 992, 993, 994, 995, 996, 997, 998, 999, 1000, 1001, 1002, 1003, 1004, 1005, 1006, 1007, 1008, 1009, 1046, 1047, 1048, 1049];

            $id_nam_watches = [2197, 2198, 2199, 2200];
            $id_vitaly = [1935, 1936, 1937, 1942, 1944, 1945, 1948, 1949, 1951, 1952, 1953, 1954, 1958, 1964, 1965, 2319, 2323, 2325, 2326, 2329, 2331, 2332, 2336, 2338, 2339, 2340, 2342, 2345, 2346, 2347, 2348];
            $id_welder = [2294, 2295, 2297, 2299, 2307, 2308, 2309, 2311, 2315, 3505, 3506, 3507, 4045, 4046, 4047];
            $id_citizen = [3120, 3098, 2630, 2518, 2517, 2513, 2506, 2504, 2503, 2502, 2500, 2499, 2498, 2497, 2495, 2492, 2490, 2489, 2488, 2469, 2466, 2464, 2367, 2631, 2465, 2510, 2512, 2519, 2356, 2516, 2507, 2358, 2364, 2365, 2368, 2370, 2371, 2372, 2373, 2376, 2377, 2467, 2468, 2470, 2561, 2567, 2570, 2686, 2687, 2689, 2690, 2691, 3090, 3091, 3092, 3095, 3097, 3100, 3113, 3114, 3115, 3116, 3117, 3118, 3119, 2349, 2350, 2351, 2352, 2354, 2355, 2357, 2359, 2360, 2361, 2362, 2363, 2366, 2369, 2374, 2375, 2491, 2494, 2496, 2501, 2509, 2511, 2514, 2515, 2562, 2563, 2564, 2565, 2566, 2568, 2569, 2571, 2633, 2634, 2635, 2682, 2683, 2684, 2685, 2688, 2692, 3089, 3093, 3094, 3096, 3099, 3102, 3103, 3104, 3105, 3106, 3107, 3108, 3109, 3110, 3111, 3112, 2353, 3527, 2632, 2508, 3101];
            $id_nostal = [2886, 2887, 2888];

            $id_fitbit = [3800, 3697, 3696, 2949, 2948, 2943, 2942, 2941, 2940, 2939, 2938, 2937, 2936, 2946, 2947, 2945, 2944, 3799];
            $id_lima = [311, 291, 292, 277, 276, 1522, 295, 309, 2047, 290, 1717, 1523, 298, 293, 294, 1716, 297, 310, 296];
            $id_mr_jones = [2667, 2668, 2669, 2670, 2671, 2672, 2673, 2674, 2675, 2676, 2677, 2678, 2679, 2680, 2681, 2993];
            $id_adidas = [3741, 3742, 3743, 3745, 3748, 3749, 3750, 3751, 3752, 3753, 3754, 3755, 3756, 3757, 3758, 3759, 3761, 3762, 3763, 3764, 3765, 3766, 3767, 3769, 3771, 3772, 3773, 3774, 3775, 3776, 3780, 3781, 3782, 3783, 3785, 3787, 3789, 3794, 3795, 3798];
            $id_vault = [2846, 2847, 2848];
            $id_olivia_burton = [868, 869, 1100, 1101, 1102, 1114, 1119, 1120, 1124, 1135, 1403, 1407, 1412, 1421, 1423, 1430, 1467, 1468, 1477, 1483, 1634, 1635, 1637, 1645, 1647, 1653, 1654, 1657, 1659, 1660, 1697, 1698, 1701, 1703, 1707, 1709, 1710, 1759, 1768, 1774, 1778, 1779, 1781, 1785, 1795, 1993, 1994, 1999, 2000, 2002, 2014, 2018, 2019, 2020, 2021, 2022, 2256, 2257, 2259, 2262, 2263, 2264, 2268, 2270, 2272, 2273, 2275, 2278, 2280, 2282, 2284, 2286, 2317, 2412, 2413, 2415, 2416, 2417, 2419, 2421, 2423, 2425, 2431, 2436, 2438, 2439, 2639, 2641, 2652, 2658, 2659, 2660, 2851, 2852, 2853, 2854, 2855, 2856, 2858, 2859, 2860, 2864, 2865, 2866, 2867, 2870, 2872, 2873, 2875, 2876, 2877, 2878, 2880, 2883, 2889, 2890, 2892, 2893, 2894, 2895, 2896, 2900, 3227, 3228, 3229, 3232, 3233, 3234, 3285, 3300, 3301, 3302, 3304, 3305, 3306, 3497, 3498, 3499, 3500, 3502, 3503, 3650, 3651, 3652, 3653, 3654, 3655, 3656, 3698, 3700, 3702, 3703, 3704, 3705, 3706, 3709, 3710, 3711, 3713, 3714, 3715, 3716, 3717, 3718, 3966, 3968, 3969, 3970, 3971, 3972, 3973, 3974, 3975, 3976, 3977, 3979, 3980, 3981, 3982];
            $id_d1_milano = [2711, 2712, 2713, 2714, 2715, 2716, 2717, 2718, 2720, 2721, 2723, 2727, 2728, 2729, 2730, 2731, 2734, 2735, 2738, 2740, 2742, 2743, 2744, 2747, 2748, 2749, 2750, 2751, 2752, 2753, 2754, 2755, 2756, 2757, 2758, 2759, 2760, 2761, 2762, 2763, 2766, 2767, 2768, 3200, 3251, 3873, 3874, 3875, 3876, 3878, 3879, 3880, 3881, 3882, 3884, 3885, 3886, 3887, 3888, 3889, 3891, 3892, 3893, 3894, 3895];

            $id_prod = array_merge(
              $id_rains_eastpak, $id_hypergrand, $id_timex, $id_komono, $id_william_l,
              $id_nam_watches, $id_vitaly, $id_welder, $id_citizen, $id_nostal,
              $id_fitbit, $id_lima, $id_mr_jones, $id_adidas, $id_vault,
              $id_olivia_burton, $id_d1_milano
            );
            
            $id_prod = $this->actionIdproductintersect($brand_id,$id_prod);
        }else if($current_date >= '2019-08-08 00:00:00' && $current_date <= '2019-08-31 23:59:59'){
			$id_prod = [2520, 2521, 2522, 2525, 2526, 2532, 2534, 2537, 2539, 2541, 2542, 2543, 2547, 2548, 2549, 2550, 2551, 2552, 2553, 2554, 2555, 2556, 2557, 2558, 2560, 2616, 2621, 2622, 2623, 2624, 2625, 2700, 2702, 2703, 2704, 2706, 2849, 2985, 2995, 2998, 3006, 3007, 3008, 805, 808, 809, 810, 811, 812, 813, 814, 815, 816, 817, 818, 819, 820, 821, 822, 823, 824, 825, 827, 830, 831, 832, 834, 840, 842, 845, 852, 854, 856, 870, 871, 872, 873, 874, 875, 876, 877, 879, 880, 881, 884, 1060, 1061, 1062, 1063, 1064, 1125, 1126, 1127, 1128, 1129, 1484, 1485, 1486, 1487, 1488, 1489, 1490, 1491, 1492, 1493, 1495, 1496, 1497, 1498, 1500, 1501, 1502, 1503, 1505, 1506, 1507, 1508, 1509, 1688, 1689, 1731, 1732, 1734, 1735, 1736, 1737, 1741, 1742, 1743, 1744, 1745, 1746, 1747, 1748, 1749, 1751, 1786, 1787, 1788, 1789, 1791, 1792, 1793, 1794, 1796, 1797, 1798, 1799, 1800, 1801, 1802, 1803, 1804, 1805, 1806, 1807, 1808, 1809, 2090, 2091, 2093, 2095, 2096, 2097, 2098, 2099, 2100, 2101, 2102, 2103, 2104, 2105, 2106, 2108, 2109, 2110, 2111, 2112, 2113, 2114, 2115, 2116, 2168, 2170, 2171, 2172, 2173, 3123, 3132, 1323, 3124, 3125, 3126, 3127, 3128, 3130, 3131, 3133, 3135, 3136, 3137, 3138, 3139, 3141, 3142, 3143, 3144, 3145, 3147, 3148, 2118, 2120, 2121, 2122, 2123, 2124, 2125, 2126, 2130, 2133, 2135, 2136, 2141, 2225, 2226, 2227, 2597, 2598, 2599, 2119, 2160, 2163, 2164, 2208, 2209, 2210, 2212, 2216, 2217, 2218, 2219, 2220, 2230, 2233, 2234, 2235, 2236, 2237, 2238, 2239, 2240, 2241, 2242, 2244, 2245, 2246, 2247, 2248, 2249, 2250, 2251, 2252, 2385, 2386, 2445, 2449, 2459, 2591, 2592, 2593, 2594, 2595, 2596, 2600, 2601, 2602, 2603, 2604, 2605, 2606, 2607, 2608, 2609, 2610, 2611, 2612, 2613, 2614, 2615, 2629, 2128, 2131, 2138, 2139, 2140, 2143, 2144, 2145, 2146, 2147, 2161, 2162, 2165, 2166, 2167, 2211, 2221, 2222, 2231, 2232, 2243, 2253, 2378, 2379, 2380, 2381, 2382, 2383, 2384, 2387, 2389, 2390, 2446, 2447, 2450, 2452, 2453, 2455, 2458, 2460, 2461, 2127, 2129, 2132, 2134, 2137, 2148, 2149, 2150, 2151, 2152, 2153, 2154, 2155, 2156, 2157, 2158, 2159, 2201, 2204, 2206, 2207, 2213, 2214, 2215, 2223, 2224, 2228, 2229, 2388, 2391, 2392, 2393, 2394, 2395, 2396, 2397, 2398, 2451, 2454, 2456, 2457, 2462, 2463, 3122, 2048, 2049, 2107, 2094, 2544, 2092, 3134, 3146, 2202, 2203, 2205, 3121, 804, 2996, 2559, 853, 636, 637, 638, 639, 641, 642, 643, 644, 645, 646, 647, 648, 649, 650, 651, 652, 653, 654, 655, 656, 657, 658, 659, 660, 661, 662, 663, 664, 665, 666, 667, 668, 669, 671, 672, 673, 676, 677, 678, 680, 689, 690, 691, 692, 693, 696, 697, 698, 699, 700, 701, 702, 887, 890, 892, 893, 894, 895, 896, 897, 898, 899, 900, 901, 902, 903, 904, 905, 906, 907, 908, 909, 910, 911, 912, 913, 914, 915, 916, 917, 918, 919, 920, 921, 922, 923, 924, 925, 926, 927, 928, 929, 930, 931, 933, 934, 937, 938, 939, 941, 942, 944, 945, 946, 949, 950, 951, 952, 955, 957, 960, 962, 963, 964, 965, 966, 967, 968, 969, 970, 1393, 1394, 1395, 1396, 1524, 1525, 1526, 1528, 1529, 1530, 1531, 1532, 1533, 1534, 1535, 1536, 1537, 1538, 1539, 1540, 1541, 1613, 1690, 1691, 574, 575, 576, 577, 578, 579, 590, 592, 594, 608, 619, 620, 621, 622, 623, 624, 625, 626, 627, 628, 629, 630, 631, 632, 633, 634, 635, 1010, 1011, 1012, 1013, 1014, 1015, 1016, 1017, 1018, 1019, 1020, 1021, 1183, 1184, 1185, 1187, 1188, 1189, 1190, 1191, 1192, 1193, 1194, 1195, 1196, 1197, 1198, 1199, 1200, 1201, 1202, 1203, 1204, 1205, 1206, 1207, 1208, 1209, 1210, 1211, 1212, 1213, 1214, 1215, 1216, 1217, 1218, 1219, 1220, 1221, 1222, 1223, 1224, 1225, 1226, 1227, 1228, 1229, 1230, 1231, 1232, 1233, 1234, 1235, 1236, 1237, 1238, 1239, 1240, 1241, 1242, 1243, 1244, 1245, 1246, 1247, 1248, 1249, 1250, 1251, 1252, 1253, 1254, 1255, 1256, 1257, 1258, 1259, 1260, 1261, 1262, 1263, 1264, 1265, 1266, 1267, 1268, 1269, 1270, 1271, 1272, 1273, 1274, 1275, 1276, 1277, 1278, 1279, 1280, 1281, 1282, 1283, 1284, 1285, 1560, 1561, 1563, 1564, 1565, 1566, 1567, 1568, 1569, 1570, 1571, 1572, 1573, 1574, 1575, 1576, 1577, 1614, 1615, 1616, 1617, 1618, 1619, 1620, 1621, 1622, 1623, 1624, 1625, 1626, 1627, 1628, 1629, 1631, 1632, 22, 23, 24, 25, 26, 27, 28, 29, 32, 33, 34, 35, 36, 37, 38, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 66, 67, 69, 70, 73, 74, 76, 79, 82, 83, 84, 85, 86, 87, 111, 112, 113, 116, 132, 134, 135, 136, 141, 142, 143, 144, 146, 147, 149, 151, 153, 205, 206, 213, 215, 216, 217, 220, 224, 225, 226, 227, 228, 229, 230, 231, 232, 233, 234, 235, 236, 237, 238, 239, 240, 241, 242, 243, 244, 245, 246, 247, 248, 249, 250, 251, 252, 534, 535, 536, 537, 538, 539, 540, 770, 771, 772, 773, 774, 787, 788, 789, 791, 792, 793, 794, 795, 796, 797, 798, 799, 800, 801, 802, 1050, 1051, 1052, 1093, 1094, 1095, 1096, 1097, 1098, 1099, 288, 316, 317, 318, 319, 320, 321, 322, 323, 325, 326, 327, 328, 329, 330, 331, 332, 333, 334, 335, 336, 337, 338, 339, 340, 341, 342, 343, 344, 345, 346, 347, 348, 349, 350, 351, 364, 366, 368, 369, 370, 371, 372, 373, 374, 375, 376, 377, 379, 380, 381, 775, 776, 777, 778, 779, 780, 781, 782, 783, 784, 785, 786, 352, 353, 354, 355, 356, 357, 358, 359, 360, 361, 362, 363, 2523, 826, 828, 1790, 1494, 1750, 1499, 1286];
			$id_prod = $this->actionIdproduct($brand_id,$id_prod);
		}else{
            $id_prod = [];
            $id_prod = $this->actionIdproduct($brand_id,$id_prod);
        }

        /*
        if($current_date >= '2019-08-17 00:00:00' && $current_date <= '2019-08-18 00:00:00'){
            $id_fitbit = [3800, 3697, 3696, 2949, 2948, 2943, 2942, 2941, 2940, 2939, 2938, 2937, 2936, 2946, 2947, 2945, 2944, 3799];
            $id_lima = [311, 291, 292, 277, 276, 1522, 295, 309, 2047, 290, 1717, 1523, 298, 293, 294, 1716, 297, 310, 296];
            $id_mr_jones = [2667, 2668, 2669, 2670, 2671, 2672, 2673, 2674, 2675, 2676, 2677, 2678, 2679, 2680, 2681, 2993];

            $id_prod = array_merge(
              $id_fitbit,$id_lima,$id_mr_jones
            );

            $id_prod = $this->actionIdproductintersect($brand_id,$id_prod);
        }
        */
        
        
        // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
		
		$data = [
			'Promo Merdeka Agustus 2019',
			'Dalam rangka merayakan Hari Ulang Tahun Republik Indonesia yang ke 74 tahun, The Watch Co. memberikan promo diskon spesial untuk produk berikut. <br/><br/>

			1.	Promo berlaku sampai tanggal 31 Agustus 2019<br>
			2.	Nikmati diskon hingga 60% untuk semua produk yang ada di halaman ini<br>
			3.	Nikmati ekstra diskon untuk:<br> 
				-	Pengguna Vospay sebesar 30%, maksimal Rp. 500.000,- <br>
				-	Pengguna Akulaku sebesar 50%, maksimal Rp. 50.000,- untuk akun baru<br>
			4.	Cicilan 0% kartu kredit berlaku untuk minimum pembelian Rp. 500.000,- dengan tenor 3, 6, dan 12 bulan<br>
			5.	Gratis ongkir ke seluruh Indonesia bisa didapatkan dengan minimum pembelian Rp. 1.000.000,-<br>
			6.	Setiap pembelian produk dikenakan biaya asuransi pengiriman sebagai tambahan agar produk yang anda pesan lebih aman sampai tujuan<br>
			7.	Produk yang sudah dipesan tidak dapat dibatalkan dengan alasan apapun, kecuali terjadi kerusakan dari pabrikan<br>
			8.	Jika transaksi dibatalkan oleh pihak The Watch Co. karena suatu hal (stok habis atau lainnya), dana Anda akan dikembalikan 100% <br>
			9.	Dengan mengikuti promo ini, pengguna dianggap mengerti dan menyetujui semua syarat dan ketentuan yang berlaku'
		];
        
        $this->title = 'Promo Merdeka 17 Agustus - The Watch Co.';
		
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dalam rangka menyambut HUT RI, The Watch Co. memberikan promo merdeka 17 Agustus yang sayang jika dilewatkan. Dapatkan promo jam tangan favoritmu sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'Promo Merdeka 17 Agustus - The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Merdeka 17 Agustus - The Watch Co.']);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo Merdeka 17 Agustus - The Watch Co.' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Dalam rangka menyambut HUT RI, The Watch Co. memberikan promo kejutan 17 Agustus yang sayang jika dilewatkan. Dapatkan promo jam tangan favoritmu sekarang!' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Promo 17 Agustus']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/promo-merdeka-17-agustus']);
        // \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/event/seo-share.jpg' ]);

        // $model = \backend\models\KontesSeoContent::find()->where(['id'=>1])->one();
        return $this->render('agustus', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand, "data" => $data ));
    }
    
    public function actionAsiangames(){
		
		$start = 0;
        $limit = 20;
		
		$sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $brand_id = [44,2,79,6,5];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
        
        
        $id_prod = [];
        $id_prod = $this->actionIdproduct($brand_id,$id_prod);
            // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
        $this->title = 'Promo Asian Games 2018 - The Watch Co.';
		
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dalam rangka menyambut Asian Games 2018, The Watch Co. memberikan promo yang sayang jika dilewatkan. Dapatkan promo jam tangan favoritmu sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'Promo Asian Games 2018 - The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Asian Games 2018 - The Watch Co.']);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo Asian Games 2018 - The Watch Co.' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Dalam rangka menyambut HUT RI, The Watch Co. memberikan promo yang sayang jika dilewatkan. Dapatkan promo jam tangan favoritmu sekarang!' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Promo Asian Games 2018']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/promo-asian-games-2018']);
        // \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/event/seo-share.jpg' ]);

        // $model = \backend\models\KontesSeoContent::find()->where(['id'=>1])->one();
        return $this->render('agustus', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
    }
	
	public function actionKontesseo(){
	            \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Yuk ikutan kontes SEO Terbaru dari The Watch Co. dan dapatkan hadiah menarik bagi 50 pendaftar pertama & pemenang kontes. Daftar sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'Kontes SEO The Watch Co.']);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Kontes SEO Terbaru The Watch Co.' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Yuk ikutan kontes SEO Terbaru dari The Watch Co. dan dapatkan hadiah menarik bagi 50 pendaftar pertama & pemenang kontes. Daftar sekarang!' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Kontes SEO']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/kontes-seo']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/event/seo-share.jpg' ]);
        
        $model = \backend\models\KontesSeoContent::find()->where(['id'=>1])->one();
        return $this->render('kontesseo',['model'=>$model]);
    }
	
	public function actionBlogcompetition(){
		\Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Saatnya unjuk gigi dalam Blog Competition Terbaru The Watch Co. Buktikan bahwa kamu yang terbaik dan menangkan hadiah jam tangan branded original, uang tunai, dan voucher belanja. Daftar sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'Ayok Ikutan Blog Competition Terbaru 2018']);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Ayok Ikutan Blog Competition Terbaru 2018' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Saatnya unjuk gigi dalam Blog Competition Terbaru The Watch Co. Buktikan bahwa kamu yang terbaik dan menangkan hadiah jam tangan branded original, uang tunai, dan voucher belanja. Daftar sekarang!' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Kontes SEO']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/blog-competition']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/event/facebook.jpg' ]);
        
        $model = \backend\models\KontesSeoContent::find()->where(['id'=>2])->one();
        return $this->render('blog-competition',['model'=>$model]);
    }
	
	public function actionPemenangseo(){
        
        return $this->render('pemenangseo');
    }
	
	public function actionBlogcompetitionthankyou(){
		return $this->render('blog-competition-daftar-thankyou', array(
			"message" => "PENDAFTARAN BERHASIL"
		));
	}
	
	public function actionBlogcompetitiondaftar(){
		if($_POST){
			
			$existKontesseo = \backend\models\BlogCompetition::findOne(['kontes_seo_email' => $_POST['email']]);
            
            $baseUrl = \yii\helpers\Url::base();
            
            if($existKontesseo == NULL){
                
                $kontesseo = new \backend\models\BlogCompetition();
                $kontesseo->kontes_seo_name = $_POST['nama'];
                $kontesseo->kontes_seo_hp = $_POST['nohp'];
				$kontesseo->kontes_seo_email = $_POST['email'];
				$kontesseo->kontes_seo_address = $_POST['alamat'];
				$kontesseo->kontes_seo_url = $_POST['urlkontes'];
				$kontesseo->kontes_seo_fb = $_POST['facebook'];
				$kontesseo->kontes_seo_ig = $_POST['instagram'];
				
                try {
                    $kontesseo->save();
					
					$this->redirect('https://thewatch.co/blog-competition/daftar/thankyou');
                    
                } catch (Exception $ex) {
                    return $this->render('blog-competition-daftar', array(
						"message" => "PENDAFTARAN GAGAL"
					));
                }
                
            } else {
                
                return $this->render('blog-competition-daftar', array(
					"message" => "EMAIL SUDAH TERDAFTAR"
				));
            }
		} else {
			return $this->render('blog-competition-daftar');
		}
	}
	
	public function actionKontesseodaftar(){
		if($_POST){
			
			$existKontesseo = \backend\models\Kontesseodaftar::findOne(['kontes_seo_email' => $_POST['email']]);
            
            $baseUrl = \yii\helpers\Url::base();
            
            if($existKontesseo == NULL){
                
                $kontesseo = new \backend\models\Kontesseodaftar();
                $kontesseo->kontes_seo_name = $_POST['nama'];
                $kontesseo->kontes_seo_hp = $_POST['nohp'];
				$kontesseo->kontes_seo_email = $_POST['email'];
				$kontesseo->kontes_seo_address = $_POST['alamat'];
				$kontesseo->kontes_seo_url = $_POST['urlkontes'];
				$kontesseo->kontes_seo_fb = $_POST['facebook'];
				$kontesseo->kontes_seo_ig = $_POST['instagram'];
				
                try {
                    $kontesseo->save();
                    
                    return $this->render('kontesseodaftar', array(
						"message" => "PENDAFTARAN BERHASIL"
					));
                    
                } catch (Exception $ex) {
                    return $this->render('kontesseodaftar', array(
						"message" => "PENDAFTARAN GAGAL"
					));
                }
                
            } else {
                
                return $this->render('kontesseodaftar', array(
					"message" => "EMAIL SUDAH TERDAFTAR"
				));
            }
		} else {
			return $this->render('kontesseodaftar');
		}
	}
	
	
	public function actionPromolebaran(){
		$start = 0;
		$limit = 20;
	
		$now = date("Y-m-d H:i:s");
		
		$brandsId = [4, 7, 8, 22, 26, 16];
	
		$count = \backend\models\Product::find()
		->joinWith([
			"brands",
			"productDetail",
			"brandsCollection" => function ($query) {
					$query->andWhere(['brands_collection_status' => 1]);
				},
			"specificPrice",
			"productImage" => function ($query) {
				$query->andWhere(['cover' => 1]);
			}
			
		])
		->where([ 
			'product.active' => 1
		])
		->andWhere(['brands.brand_id' => $brandsId])
		->andWhere('specific_price.from <= "'. $now . '"')
		->andWhere('specific_price.to > "'. $now . '"')
		->all();
	
		$product_count = count($count);        

		if(isset($_GET['limit'])){
			$limit = $_GET['limit'];
		}
	
		if(isset($_GET['page'])) {

			$page = $_GET['page'];

			$page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;

			if(isset($_GET['brands'])){

				$brandsName = explode('--', $_GET['brands']);

				$page = $_GET['page'];

				$page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit; 

				$prices = explode('--', $_GET['price']);

				$products = \backend\models\Product::getProductByFilterBrands($brandsName, "", $start, $limit, $prices);

				$count = \backend\models\Product::getTotalProductByFilterBrands($brandsName, "", $prices); 

				$product_count = count($count);

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
					"specificPrice",
					"productImage" => function ($query) {
						$query->andWhere(['cover' => 1]);
					}
				])
				->where([ 
					'product.active' => 1
				])
				->andWhere(['brands.brand_id' => $brandsId])
				->andWhere('specific_price.from <= "'. $now . '"')
				->andWhere('specific_price.to > "'. $now . '"')
				->orderBy('product.price ASC')
				->all();
			}        


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
				"specificPrice",
				"productImage" => function ($query) {
					$query->andWhere(['cover' => 1]);
				}
			])
			->where([ 
				'product.active' => 1
			])
			->andWhere(['brands.brand_id' => $brandsId])
			->andWhere('specific_price.from <= "'. $now . '"')
			->andWhere('specific_price.to > "'. $now . '"')
			->orderBy('product.price ASC')
			->all();

		}
	
		// \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dapatkan Tas Eastpak Original Indonesia Dengan Promo Menarik Weekdays Remedy Diskon 40% + 20%. Beli Sekarang Juga!']);
		// \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Tas Eastpak Terbesar 2017']);
		// \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo tas eastpak, tas eastpak, jual tas eastpak murah, tas eastpak original, eastpak indonesia']);

		return $this->render('promolebaran', array("products" => $products, "count" => $product_count, "limit" => $limit));
	}
	
	public function actionLastcallaark(){
		$start = 0;
        $limit = 20;
        
        $now = date("Y-m-d H:i:s");
        
        $count = \backend\models\Product::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection" => function ($query) {
                        $query->andWhere(['brands_collection_status' => 1]);
                    },
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
                
            ])
            ->where([ 
				'product.active' => 1
			])
            ->andWhere(['brands.brand_id' => 1])
            // ->andWhere('specific_price.from <= "'. $now . '"')
            // ->andWhere('specific_price.to > "'. $now . '"')
            
            ->all();
        
        
        $product_count = count($count);        
        
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
		
		// $products = \backend\models\Product::getProductSaleByFilter($category, $start, $limit);
        
        if(isset($_GET['page'])) {
            
            $page = $_GET['page'];
            
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
			
			if(isset($_GET['brands'])){
				
				$brandsName = explode('--', $_GET['brands']);

				$page = $_GET['page'];

				$page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit; 

				$prices = explode('--', $_GET['price']);

				$products = \backend\models\Product::getProductByFilterBrands($brandsName, "", $start, $limit, $prices);

				$count = \backend\models\Product::getTotalProductByFilterBrands($brandsName, "", $prices); 
				
				$product_count = count($count);

			} else {
            
				$products = \backend\models\Product::find()
				->select('*, (product.price - (specific_price.reduction / 100) * product.price) as priority')
				->offset($start)
				->limit($limit)
				->joinWith([
					"brands",
					"productDetail",
					"brandsCollection" => function ($query) {
							$query->andWhere(['brands_collection_status' => 1]);
						},
					"specificPrice",
					"productImage" => function ($query) {
						$query->andWhere(['cover' => 1]);
					}
				])
				->where([ 
					'product.active' => 1
				])
				->andWhere(['brands.brand_id' => 1])
				->andWhere('specific_price.from <= "'. $now . '"')
				->andWhere('specific_price.to > "'. $now . '"')
				->orderBy('priority ASC')
				->all();
            }        
            
            
        } else {
			
            $products = \backend\models\Product::find()
            ->select('*, (product.price - (specific_price.reduction / 100) * product.price) as priority')
            ->offset($start)
            ->limit($limit)
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection" => function ($query) {
                        $query->andWhere(['brands_collection_status' => 1]);
                    },
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where([ 
				'product.active' => 1
			])
            ->andWhere(['brands.brand_id' => 1])
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->orderBy('priority ASC')
            ->all();
            
        }
		
		// \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dapatkan Tas Eastpak Original Indonesia Dengan Promo Menarik Weekdays Remedy Diskon 40% + 20%. Beli Sekarang Juga!']);
		// \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Tas Eastpak Terbesar 2017']);
		// \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo tas eastpak, tas eastpak, jual tas eastpak murah, tas eastpak original, eastpak indonesia']);
		
		return $this->render('lastcallaark', array("products" => $products, "count" => $product_count, "limit" => $limit));
	}
	
	public function actionRamadhanob(){
		$start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $brand_id = [48];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
            
            $id_prod = [1687,1686,1685,1468,1404,1403];
            
          // get all id product
          $id_prod = $this->actionIdproduct($brand_id,$id_prod);
                // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);

        
        // \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dapatkan voucher Rp. 200.000 untuk pembelian jam tangan original di The Watch Co.khusus warga Jakarta yang telah berpartisipasi dalam PILKADA DKI Jakarta 2017']);
        // \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo PILKADA DKI Jakarta 2017']);
        // \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo pilkada, pilkada dki jakarta, pilkada dki 2017, promo pilgub, promo pilgub dki jakarta, pilgub dki 2017, diskon pilkada, diskon pilkada dki 2017, diskon hari ini, promo hari ini']);
        
       // $products = [];

        return $this->render('ramadhanob', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
		
	}
	
	public function actionRamadhanaccessories(){
		$start = 0;
        $limit = 20;
        
        $now = date("Y-m-d H:i:s");
        
        $count = \backend\models\Product::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection" => function ($query) {
                        $query->andWhere(['brands_collection_status' => 1]);
                    },
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
                
            ])
            ->where([ 
				'product.active' => 1
			])
            ->andWhere(['brands.brand_id' => [5, 6]])
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->all();
        
        
        $product_count = count($count);        
        
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
		
		// $products = \backend\models\Product::getProductSaleByFilter($category, $start, $limit);
        
        if(isset($_GET['page'])) {
            
            $page = $_GET['page'];
            
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
			
			if(isset($_GET['brands'])){
				
				$brandsName = explode('--', $_GET['brands']);

				$page = $_GET['page'];

				$page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit; 

				$prices = explode('--', $_GET['price']);

				$products = \backend\models\Product::getProductByFilterBrands($brandsName, "", $start, $limit, $prices);

				$count = \backend\models\Product::getTotalProductByFilterBrands($brandsName, "", $prices); 
				
				$product_count = count($count);

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
					"specificPrice",
					"productImage" => function ($query) {
						$query->andWhere(['cover' => 1]);
					}
				])
				->where([ 
					'product.active' => 1
				])
				->andWhere(['brands.brand_id' => [5, 6]])
				->andWhere('specific_price.from <= "'. $now . '"')
				->andWhere('specific_price.to > "'. $now . '"')
				->orderBy('product.price ASC')
				->all();
            }        
            
            
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
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where([ 
				'product.active' => 1
			])
            ->andWhere(['brands.brand_id' => [5, 6]])
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->orderBy('product.price ASC')
            ->all();
            
        }
		
		// \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dapatkan Tas Eastpak Original Indonesia Dengan Promo Menarik Weekdays Remedy Diskon 40% + 20%. Beli Sekarang Juga!']);
		// \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Tas Eastpak Terbesar 2017']);
		// \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo tas eastpak, tas eastpak, jual tas eastpak murah, tas eastpak original, eastpak indonesia']);
		
		return $this->render('ramadhanaccessories', array("products" => $products, "count" => $product_count, "limit" => $limit));
	}
	
	public function actionRamadhanlima(){
		$start = 0;
        $limit = 20;
        
        $now = date("Y-m-d H:i:s");
        
        $count = \backend\models\Product::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection" => function ($query) {
                        $query->andWhere(['brands_collection_status' => 1]);
                    },
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
                
            ])
            ->where([ 
				'product.active' => 1
			])
            ->andWhere(['brands.brand_id' => 14])
            // ->andWhere('specific_price.from <= "'. $now . '"')
            // ->andWhere('specific_price.to > "'. $now . '"')
            ->all();
        
        
        $product_count = count($count);        
        
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
		
		// $products = \backend\models\Product::getProductSaleByFilter($category, $start, $limit);
        
        if(isset($_GET['page'])) {
            
            $page = $_GET['page'];
            
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
			
			if(isset($_GET['brands'])){
				
				$brandsName = explode('--', $_GET['brands']);

				$page = $_GET['page'];

				$page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit; 

				$prices = explode('--', $_GET['price']);

				$products = \backend\models\Product::getProductByFilterBrands($brandsName, "", $start, $limit, $prices);

				$count = \backend\models\Product::getTotalProductByFilterBrands($brandsName, "", $prices); 
				
				$product_count = count($count);

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
					"specificPrice",
					"productImage" => function ($query) {
						$query->andWhere(['cover' => 1]);
					}
				])
				->where([ 
					'product.active' => 1
				])
				->andWhere(['brands.brand_id' => 14])
				// ->andWhere('specific_price.from <= "'. $now . '"')
				// ->andWhere('specific_price.to > "'. $now . '"')
				->orderBy('product.product_id ASC')
				->all();
            }        
            
            
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
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where([ 
				'product.active' => 1
			])
            ->andWhere(['brands.brand_id' => 14])
            // ->andWhere('specific_price.from <= "'. $now . '"')
            // ->andWhere('specific_price.to > "'. $now . '"')
            ->orderBy('product.product_id ASC')
            ->all();
            
        }
		
		// \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dapatkan Tas Eastpak Original Indonesia Dengan Promo Menarik Weekdays Remedy Diskon 40% + 20%. Beli Sekarang Juga!']);
		// \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Tas Eastpak Terbesar 2017']);
		// \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo tas eastpak, tas eastpak, jual tas eastpak murah, tas eastpak original, eastpak indonesia']);
		
		return $this->render('ramadhanlima', array("products" => $products, "count" => $product_count, "limit" => $limit));
	}
	
	public function actionLastcallhgsignature(){
		$start = 0;
        $limit = 20;
        
        $now = date("Y-m-d H:i:s");
		
		$hgsignature = [18, 74, 22];
        
        $count = \backend\models\Product::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection" => function ($query) {
                        $query->andWhere(['brands_collection_status' => 1]);
                    },
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
                
            ])
            ->where([ 
				'product.active' => 1
			])
            ->andWhere(['brands_collection.brands_collection_id' => $hgsignature])
            // ->andWhere('specific_price.from <= "'. $now . '"')
            // ->andWhere('specific_price.to > "'. $now . '"')
            ->all();
        
        
        $product_count = count($count);        
        
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
		
		// $products = \backend\models\Product::getProductSaleByFilter($category, $start, $limit);
        
        if(isset($_GET['page'])) {
            
            $page = $_GET['page'];
            
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
			
			if(isset($_GET['brands'])){
				
				$brandsName = explode('--', $_GET['brands']);

				$page = $_GET['page'];

				$page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit; 

				$prices = explode('--', $_GET['price']);

				$products = \backend\models\Product::getProductByFilterBrands($brandsName, "", $start, $limit, $prices);

				$count = \backend\models\Product::getTotalProductByFilterBrands($brandsName, "", $prices); 
				
				$product_count = count($count);

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
					"specificPrice",
					"productImage" => function ($query) {
						$query->andWhere(['cover' => 1]);
					}
				])
				->where([ 
					'product.active' => 1
				])
				->andWhere(['brands_collection.brands_collection_id' => $hgsignature])
				// ->andWhere('specific_price.from <= "'. $now . '"')
				// ->andWhere('specific_price.to > "'. $now . '"')
				->orderBy('brands_collection.brands_collection_id ASC')
				->all();
            }        
            
            
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
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where([ 
				'product.active' => 1
			])
            ->andWhere(['brands_collection.brands_collection_id' => $hgsignature])
            // ->andWhere('specific_price.from <= "'. $now . '"')
            // ->andWhere('specific_price.to > "'. $now . '"')
            ->orderBy('brands_collection.brands_collection_id ASC')
            ->all();
            
        }
		
		// \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dapatkan Tas Eastpak Original Indonesia Dengan Promo Menarik Weekdays Remedy Diskon 40% + 20%. Beli Sekarang Juga!']);
		// \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Tas Eastpak Terbesar 2017']);
		// \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo tas eastpak, tas eastpak, jual tas eastpak murah, tas eastpak original, eastpak indonesia']);
		
		return $this->render('lastcallhgsignature', array("products" => $products, "count" => $product_count, "limit" => $limit));
	}
	
	public function actionLastcallhgstraps(){
		$start = 0;
        $limit = 20;
        
        $now = date("Y-m-d H:i:s");
		
		$strapshg = [22, 74, 23];
        
        $count = \backend\models\Product::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection" => function ($query) {
                        $query->andWhere(['brands_collection_status' => 1]);
                    },
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
                
            ])
            ->where([ 
				'product.active' => 1
			])
            ->andWhere(['brands_collection.brands_collection_id' => $strapshg])
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->all();
        
        
        $product_count = count($count);        
        
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
		
		// $products = \backend\models\Product::getProductSaleByFilter($category, $start, $limit);
        
        if(isset($_GET['page'])) {
            
            $page = $_GET['page'];
            
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
			
			if(isset($_GET['brands'])){
				
				$brandsName = explode('--', $_GET['brands']);

				$page = $_GET['page'];

				$page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit; 

				$prices = explode('--', $_GET['price']);

				$products = \backend\models\Product::getProductByFilterBrands($brandsName, "", $start, $limit, $prices);

				$count = \backend\models\Product::getTotalProductByFilterBrands($brandsName, "", $prices); 
				
				$product_count = count($count);

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
					"specificPrice",
					"productImage" => function ($query) {
						$query->andWhere(['cover' => 1]);
					}
				])
				->where([ 
					'product.active' => 1
				])
				->andWhere(['brands_collection.brands_collection_id' => $strapshg])
				->andWhere('specific_price.from <= "'. $now . '"')
				->andWhere('specific_price.to > "'. $now . '"')
				->orderBy('brands_collection.brands_collection_id ASC')
				->all();
            }        
            
            
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
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where([ 
				'product.active' => 1
			])
            ->andWhere(['brands_collection.brands_collection_id' => $strapshg])
            ->andWhere('specific_price.from <= "'. $now . '"')
            ->andWhere('specific_price.to > "'. $now . '"')
            ->orderBy('brands_collection.brands_collection_id ASC')
            ->all();
            
        }
		
		// \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dapatkan Tas Eastpak Original Indonesia Dengan Promo Menarik Weekdays Remedy Diskon 40% + 20%. Beli Sekarang Juga!']);
		// \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Tas Eastpak Terbesar 2017']);
		// \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo tas eastpak, tas eastpak, jual tas eastpak murah, tas eastpak original, eastpak indonesia']);
		
		return $this->render('lastcallhgstraps', array("products" => $products, "count" => $product_count, "limit" => $limit));
	}
	
	public function actionLastcallgrace(){
		$start = 0;
        $limit = 20;
		
		$listdwgrace = [102, 103, 104, 105, 460, 461, 462, 463];
        
        $now = date("Y-m-d H:i:s");
        
        $count = \backend\models\Product::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection" => function ($query) {
                        $query->andWhere(['brands_collection_status' => 1]);
                    },
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
                
            ])
            ->where([ 
				'product.active' => 1
			])
            ->andWhere(['product.product_id' => $listdwgrace])
            // ->andWhere('specific_price.from <= "'. $now . '"')
            // ->andWhere('specific_price.to > "'. $now . '"')
            ->all();
        
        
        $product_count = count($count);        
        
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
		
		// $products = \backend\models\Product::getProductSaleByFilter($category, $start, $limit);
        
        if(isset($_GET['page'])) {
            
            $page = $_GET['page'];
            
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
			
			if(isset($_GET['brands'])){
				
				$brandsName = explode('--', $_GET['brands']);

				$page = $_GET['page'];

				$page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit; 

				$prices = explode('--', $_GET['price']);

				$products = \backend\models\Product::getProductByFilterBrands($brandsName, "", $start, $limit, $prices);

				$count = \backend\models\Product::getTotalProductByFilterBrands($brandsName, "", $prices); 
				
				$product_count = count($count);

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
					"specificPrice",
					"productImage" => function ($query) {
						$query->andWhere(['cover' => 1]);
					}
				])
				->where([ 
					'product.active' => 1
				])
				->andWhere(['product.product_id' => $listdwgrace])
				// ->andWhere('specific_price.from <= "'. $now . '"')
				// ->andWhere('specific_price.to > "'. $now . '"')
				->orderBy('product.product_id ASC')
				->all();
            }        
            
            
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
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where([ 
				'product.active' => 1
			])
            ->andWhere(['product.product_id' => $listdwgrace])
            // ->andWhere('specific_price.from <= "'. $now . '"')
            // ->andWhere('specific_price.to > "'. $now . '"')
            ->orderBy('product.product_id ASC')
            ->all();
            
        }
		
		// \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dapatkan Tas Eastpak Original Indonesia Dengan Promo Menarik Weekdays Remedy Diskon 40% + 20%. Beli Sekarang Juga!']);
		// \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Tas Eastpak Terbesar 2017']);
		// \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo tas eastpak, tas eastpak, jual tas eastpak murah, tas eastpak original, eastpak indonesia']);
		
		return $this->render('lastcallgrace', array("products" => $products, "count" => $product_count, "limit" => $limit));
	}
	
	public function actionTesting(){

		$start = 0;
        $limit = 20;
		
		$sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        // $brand_id = [44,2,79,6,5];
		
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
			$brand_id = $brand_id[0];
        }

        $page = 1;
          $limit = 20;
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
        
		
        
        
        $id_prod = [2118, 2119, 2120, 2121, 2122, 2123, 2124, 2125, 2126, 2127, 2128, 2129, 2130, 2131, 2132, 2133, 2134, 2135, 2136, 2137, 2138, 2139, 2140, 2141, 2143, 2144, 2145, 2146, 2147, 2148, 2149, 2150, 2151, 2152, 2153, 2154, 2155, 2156, 2157, 2158, 2159, 2160, 2161, 2162, 2163, 2164, 2165, 2166, 2167, 2201, 2202, 2203, 2204, 2205, 2206, 2207, 2208, 2209, 2210, 2211, 2212, 2213, 2214, 2215, 2216, 2217, 2218, 2219, 2220, 2221, 2222, 2223, 2224, 2225, 2226, 2227, 2228, 2229, 2230, 2231, 2232, 2233, 2234, 2235, 2236, 2237, 2238, 2239, 2240, 2241, 2242, 2243, 2244, 2245, 2246, 2247, 2248, 2249, 2250, 2251, 2252, 2253, 2378, 2379, 2380, 2381, 2382, 2383, 2384, 2385, 2386, 2387, 2388, 2389, 2390, 2391, 2392, 2393, 2394, 2395, 2396, 2397, 2398, 2445, 2446, 2447, 2449, 2450, 2451, 2452, 2453, 2454, 2455, 2456, 2457, 2458, 2459, 2460, 2461, 2462, 2463, 2591, 2592, 2593, 2594, 2595, 2596, 2597, 2598, 2599, 2600, 2601, 2602, 2603, 2604, 2605, 2606, 2607, 2608, 2609, 2610, 2611, 2612, 2613, 2614, 2615, 2629, 3121, 3122, 3192, 3195, 3196, 3197, 3199, 3241, 3242, 3243, 3244, 3245, 3246, 3247, 3248, 3249, 3253, 3254, 3255, 3256, 3257];
        $id_prod = $this->actionIdproduct($brand_id,$id_prod);
            // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
		
		die(var_dump($products));
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
        $this->title = 'Promo September 2019 - The Watch Co.';
		
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Nikmati promo spesial bulan September 2019 untuk produk pilihan.']);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'Promo September 2019 - The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo September 2019 - The Watch Co.']);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo September 2019 - The Watch Co.' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Nikmati promo spesial bulan September 2019 untuk produk pilihan.' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Promo September 2019']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/september-special']);
        // \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/event/seo-share.jpg' ]);

        // $model = \backend\models\KontesSeoContent::find()->where(['id'=>1])->one();
        return $this->render('september', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
	}
	
	    
	public function actionSeptember(){
		$start = 0;
        $limit = 20;
		
		$sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $brand_id = [44,2,79,6,5];
		
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
        
		
        
        
        $id_prod = [2118, 2119, 2120, 2121, 2122, 2123, 2124, 2125, 2126, 2127, 2128, 2129, 2130, 2131, 2132, 2133, 2134, 2135, 2136, 2137, 2138, 2139, 2140, 2141, 2143, 2144, 2145, 2146, 2147, 2148, 2149, 2150, 2151, 2152, 2153, 2154, 2155, 2156, 2157, 2158, 2159, 2160, 2161, 2162, 2163, 2164, 2165, 2166, 2167, 2201, 2202, 2203, 2204, 2205, 2206, 2207, 2208, 2209, 2210, 2211, 2212, 2213, 2214, 2215, 2216, 2217, 2218, 2219, 2220, 2221, 2222, 2223, 2224, 2225, 2226, 2227, 2228, 2229, 2230, 2231, 2232, 2233, 2234, 2235, 2236, 2237, 2238, 2239, 2240, 2241, 2242, 2243, 2244, 2245, 2246, 2247, 2248, 2249, 2250, 2251, 2252, 2253, 2378, 2379, 2380, 2381, 2382, 2383, 2384, 2385, 2386, 2387, 2388, 2389, 2390, 2391, 2392, 2393, 2394, 2395, 2396, 2397, 2398, 2445, 2446, 2447, 2449, 2450, 2451, 2452, 2453, 2454, 2455, 2456, 2457, 2458, 2459, 2460, 2461, 2462, 2463, 2591, 2592, 2593, 2594, 2595, 2596, 2597, 2598, 2599, 2600, 2601, 2602, 2603, 2604, 2605, 2606, 2607, 2608, 2609, 2610, 2611, 2612, 2613, 2614, 2615, 2629, 3121, 3122, 3192, 3195, 3196, 3197, 3199, 3241, 3242, 3243, 3244, 3245, 3246, 3247, 3248, 3249, 3253, 3254, 3255, 3256, 3257];
        $id_prod = $this->actionIdproduct($brand_id,$id_prod);
            // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
        $this->title = 'Promo September 2019 - The Watch Co.';
		
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Nikmati promo spesial bulan September 2019 untuk produk pilihan.']);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'Promo September 2019 - The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo September 2019 - The Watch Co.']);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo September 2019 - The Watch Co.' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Nikmati promo spesial bulan September 2019 untuk produk pilihan.' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Promo September 2019']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/september-special']);
        // \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/event/seo-share.jpg' ]);

        // $model = \backend\models\KontesSeoContent::find()->where(['id'=>1])->one();
        return $this->render('september', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
	}
	
	public function actionTwcxrsd(){
		if($_POST){
			
			$existNewsletter = \backend\models\NewsletterSignup::findOne(['newsletter_signup_email' => $_POST['email']]);
            
            $baseUrl = \yii\helpers\Url::base();
            
            if($existNewsletter == NULL){
                
                $newsletter = new \backend\models\NewsletterSignup();
                $newsletter->newsletter_signup_firstname = $_POST['fullname'];
                $newsletter->newsletter_signup_email = $_POST['email'];
                $newsletter->newsletter_signup_date_add = date("Y-m-d H:i:s");
				$newsletter->newsletter_signup_gender = $_POST['gender'];
				$newsletter->newsletter_signup_source = "twcxrsd";
				$newsletter->newsletter_signup_phone = $_POST['phone_number'];

                try {
                    $newsletter->save();
                    
                    return $this->render('subscribe_result', array(
						"message" => "SUBSCRIBE SUCCESSFULLY"
					));
                    
                } catch (Exception $ex) {
                    return $this->render('subscribe_result', array(
						"message" => "SUBSCRIBE FAILED"
					));
                }
                
            } else {
                
                return $this->render('subscribe_result', array(
					"message" => "EMAIL ALREADY REGISTERED IN OUR WEBSITE"
				));
            }
		} else {
			return $this->render('twcxrsd');
		}
	}
	
	public function actionDwpetite(){
        return $this->render('dwpetite');
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
    

    public function actionDwlanding(){
        $this->breadcrumb[] = "explore";
        $this->breadcrumb[] = "all";
        
        return $this->render('dwsummer_landing');
    }
    
    public function actionSale()
    {
        session_start();
        // $brand_id = [1,4,10,12,17,27,33,19,24,5,6,2,9,59,58,31,8,26,44,71,48,49,79,72];
        $now = date("Y-m-d H:i:s");
        // if($_SESSION['customerInfo']['customer_id'] == 7614){
    		// $now = '2018-11-10 00:00:00';
    	// }
        $page = 0;
        $limit = 4;
        $casual = \backend\models\Product::find()
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productFeature",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product_feature.feature_value_id'=>115])
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->andWhere(['product.active'=>1])
                ->orderBy(new Expression('rand()'))
                ->all();
        
        $aktif = \backend\models\Product::find()
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productFeature",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product_feature.feature_value_id'=>116])
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->andWhere(['product.active'=>1])
                ->orderBy(new Expression('rand()'))
                ->all();
                
        $aksesoris = \backend\models\Product::find()
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productFeature",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product_feature.feature_value_id'=>117])
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->andWhere(['product.active'=>1])
                ->orderBy(new Expression('rand()'))
                ->all();
        
        
        $classic = \backend\models\Product::find()
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productFeature",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product_feature.feature_value_id'=>12])
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->andWhere(['product.active'=>1])
                ->orderBy(new Expression('rand()'))
                ->all();
        
        $product = \backend\models\Product::find()
                ->offset($page)
                ->limit(15)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->andWhere(['product.active'=>1])
                ->orderBy(new Expression('rand()'))
                ->all();
                
        // echo count($results);die();

	    $this->title = 'Sales | The Watch Co.';
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Nikmat promo diskon menarik untuk pembelian jam tangan & aksesoris original: ✓ Cicilan 0% ✓ Gratis Ongkir. Beli sekarang sebelum kehabisan!']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Diskon Jam Tangan & Aksesoris Original – The Watch Co.']);
		
        return $this->render('sale', array("products" => $product, "casual" => $casual, "aktif" => $aktif, "aksesoris" => $aksesoris, "classic" => $classic, "limit" => $limit, "page"=>$page,"brands"=>$brand_id));
    }
	
	public function actionSaleMain()
    {
        session_start();
        // $brand_id = [1,4,10,12,17,27,33,19,24,5,6,2,9,59,58,31,8,26,44,71,48,49,79,72];
		
		$start_time = '2000-01-01 00:00:00';
		$end_time = '2100-01-31 23:59:59';
        $curr_time = date("Y-m-d H:i:s");
		$has_slider = false;
		$has_slider_static = false;

        $page = 0;
        $limit = 4;
		
		// $category = ProductCategory::find()->where(array("product_category_status" => "active", "product_category_featured" => "1"))->orderBy('product_category_sequence')->all();
		
		$activated = false;		
		$brands = array();
		$category = array();
		$product = array();
		
		$total_sale = Product::getCountProductSale($brands, $category, $curr_time, $product);

		$new_year_sale = array();
		if((int)$total_sale > 0){
			$activated = true;
			// Start New Year Sale 2019
			$start_time = '2019-01-01 00:00:00';
			$end_time = '2019-01-31 23:59:59';
			
			if( ($curr_time >= $start_time) && ($curr_time <= $end_time) ){
				$new_year_sale = Product::getProductSale($brands, $category, $start_time, $end_time, $product, $limit, "");
			}
			// End New Year Sale 2019
		}

	    $this->title = 'SALE | The Watch Co.';
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Nikmat promo diskon 2019 menarik untuk pembelian jam tangan & aksesoris original: ✓ Cicilan 0% ✓ Gratis Ongkir. Beli sekarang sebelum kehabisan!']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Diskon Jam Tangan & Aksesoris Original 2019 – The Watch Co.']);
		
		/*
		if( ($curr_time >= $start_time) && ($curr_time <= $end_time) ){
			$activated = true;
		}
		*/
		
        return $this->render('sale-main', array("category" => $category, "limit" => $limit, "page"=>$page, "brands"=>$brand_id, 
			"curr_time" => $curr_time, "start_time" => $start_time, "end_time" => $end_time, "activated" => $activated, 
			"has_slider" => $has_slider, "has_slider_static" => $has_slider_static, "new_year_sale" => $new_year_sale ));
    }
	
	public function actionSaleDetail()
	{
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
        $query_product = $this->actionProductFilter($brand_detail,$category);
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
        
        return $this->render('sale-detail', array(
            "brandBanner" => $brandBanner, 
            "brand_detail" => $brand_detail,
            "products" => $products,
			      "category" => $category,
			      "brandId" => $brand_detail->brand_id,
			      "brandName" => $brandName,
            "total_products" => $total_products,
        ));
	}

	public function actionSalePage()
  {
      $this->title = 'SALE | The Watch Co.';
      
      \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Nikmat promo diskon 2019 menarik untuk pembelian jam tangan & aksesoris original: ✓ Cicilan 0% ✓ Gratis Ongkir. Beli sekarang sebelum kehabisan!']);
      \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Diskon Jam Tangan & Aksesoris Original 2019 – The Watch Co.']);

      return $this->render('sale-page', array(
        "now" =>  date("Y-m-d H:i:s"))
      );
  }

	public function actionProductFilter($brand_detail,$category){
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
           // print_r(count($id_prod));die();

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
                       // print_r(count($id_prod));die();


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
                        // print_r(count($id_prod2));die();
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
	
	public function actionSaleExp()
    {
        session_start();
        // $brand_id = [1,4,10,12,17,27,33,19,24,5,6,2,9,59,58,31,8,26,44,71,48,49,79,72];
		
		$start_time = '2019-01-01 00:00:00';
		$end_time = '2019-01-31 23:59:59';
        $curr_time = date("Y-m-d H:i:s");

        $page = 0;
        $limit = 4;
        $casual = \backend\models\Product::find()
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productFeature",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product_feature.feature_value_id'=>115])
                ->andWhere('specific_price.from >= "'. $start_time . '"')
                ->andWhere('specific_price.to <= "'. $end_time . '"')
                ->andWhere(['product.active'=>1])
                ->orderBy(new Expression('rand()'))
                ->all();
        
        $aktif = \backend\models\Product::find()
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productFeature",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product_feature.feature_value_id'=>116])
                ->andWhere('specific_price.from >= "'. $start_time . '"')
                ->andWhere('specific_price.to <= "'. $end_time . '"')
                ->andWhere(['product.active'=>1])
                ->orderBy(new Expression('rand()'))
                ->all();
                
        $aksesoris = \backend\models\Product::find()
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productFeature",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product_feature.feature_value_id'=>117])
                ->andWhere('specific_price.from >= "'. $start_time . '"')
                ->andWhere('specific_price.to <= "'. $end_time . '"')
                ->andWhere(['product.active'=>1])
                ->orderBy(new Expression('rand()'))
                ->all();
        
        
        $classic = \backend\models\Product::find()
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productFeature",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product_feature.feature_value_id'=>12])
                ->andWhere('specific_price.from >= "'. $start_time . '"')
                ->andWhere('specific_price.to <= "'. $end_time . '"')
                ->andWhere(['product.active'=>1])
                ->orderBy(new Expression('rand()'))
                ->all();
        
        $product = \backend\models\Product::find()
                ->offset($page)
                ->limit(15)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->andWhere('specific_price.from >= "'. $start_time . '"')
                ->andWhere('specific_price.to <= "'. $end_time . '"')
                ->andWhere(['product.active'=>1])
                ->orderBy(new Expression('rand()'))
                ->all();

	    $this->title = 'New Year 2019 SALE | The Watch Co.';
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Nikmat promo diskon 2019 menarik untuk pembelian jam tangan & aksesoris original: ✓ Cicilan 0% ✓ Gratis Ongkir. Beli sekarang sebelum kehabisan!']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Diskon Jam Tangan & Aksesoris Original 2019 – The Watch Co.']);
		
		$activated = false;
		if( ($curr_time >= $start_time) && ($curr_time <= $end_time) ){
			$activated = true;
		}
		
        return $this->render('sale_exp', array("products" => $product, "casual" => $casual, "aktif" => $aktif, 
			"aksesoris" => $aksesoris, "classic" => $classic, "limit" => $limit, "page"=>$page, "brands"=>$brand_id, 
			"curr_time" => $curr_time, "start_time" => $start_time, "end_time" => $end_time, "activated" => $activated));
    }
	
	public function actionHarbolnas()
    {
		session_start();
        $brand_id = [1,4,10,12,17,27,33,19,24,5,6,2,9,59,58,31,8,26,44,71,48,49,79,72];
        $now = date("Y-m-d H:i:s");
        // if($_SESSION['customerInfo']['customer_id'] == 7614){
    		// $now = '2018-11-10 00:00:00';
    	// }
        $page = 0;
        $limit = 4;
        $casual = \backend\models\Product::find()
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productFeature",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product_feature.feature_value_id'=>115])
                ->andWhere(['brands.brand_id'=>$brand_id])
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->orderBy(new Expression('rand()'))
                ->all();
        
        $aktif = \backend\models\Product::find()
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productFeature",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product_feature.feature_value_id'=>116])
                ->andWhere(['brands.brand_id'=>$brand_id])
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->orderBy(new Expression('rand()'))
                ->all();
                
        $aksesoris = \backend\models\Product::find()
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productFeature",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product_feature.feature_value_id'=>117])
                ->andWhere(['brands.brand_id'=>$brand_id])
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->orderBy(new Expression('rand()'))
                ->all();
        
        $classic = \backend\models\Product::find()
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productFeature",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product_feature.feature_value_id'=>12])
                ->andWhere(['brands.brand_id'=>$brand_id])
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->orderBy(new Expression('rand()'))
                ->all();
        
        $classic = \backend\models\Product::find()
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productFeature",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product_feature.feature_value_id'=>12])
                ->andWhere(['brands.brand_id'=>$brand_id])
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->orderBy(new Expression('rand()'))
                ->all();
        
        $product = \backend\models\Product::find()
                ->offset($page)
                ->limit(15)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->andWhere(['brands.brand_id'=>$brand_id])
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->orderBy(new Expression('rand()'))
                ->all();
		
		$this->title = 'Promo Harbolnas: Hari Belanja Online Nasional – The Watch Co.';
		\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo Harbolnas: Hari Belanja Online Nasional – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Manfaatkan promo diskon besar-besaran akhir tahun untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Manfaatkan promo diskon besar-besaran akhir tahun untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Harbolnas: Hari Belanja Online Nasional – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);
		
        return $this->render('harbolnas1', array("products" => $product, "casual" => $casual, "aktif" => $aktif, "aksesoris" => $aksesoris, "classic" => $classic, "limit" => $limit, "page"=>$page,"brands"=>$brand_id));
    }
    
    public function actionHarbolnasdetail(){
	    $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $brand_id = [1,4,10,12,17,27,33,19,24,5,6,2,9,59,58,31,8,26,44,71,48,49,79,72];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
            $id_prod = [];
          // get all id product
          $id_prod = $this->actionIdproduct($brand_id,$id_prod);
          
         
                // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
	    $this->title = 'Pesta Belanja 11-11 | The Watch Co.';
		\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Pesta Belanja 12-12 | thewatch.co']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Nikmati promo diskon Pesta Belanja 12-12 Bersama The Watch Co. Dapatkan jam tangan pria dan wanita branded original beserta aksesoris lainnya dengan harga menarik. Beli sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Nikmati promo diskon Pesta Belanja 12-12 Bersama The Watch Co. Dapatkan jam tangan pria dan wanita branded original beserta aksesoris lainnya dengan harga menarik. Beli sekarang!']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Pesta Belanja 12-12 | thewatch.co']);
		\Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

        return $this->render('harbolnasdetail', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
	}
    
    private static function addCartItems($data){
        $sessionOrder = new Session();
        $cart = $sessionOrder->get("cart");
        
        if ($cart == NULL) {
            $order = new \frontend\models\OrdersForm();
            $order->create($data);
        } else {
            $order = new \frontend\models\OrdersForm();
            $sessionOrder->open();

            $items = $cart['items'];

            if (count($items) > 0) {
                $i = 0;
                $len = count($items);
                $found = FALSE;
                foreach ($items as $item) {
                    // update if existing item found
                    if ($item['id'] == $data['cart']['items'][0]['id'] && $item['product_attribute_id'] == $data['cart']['items'][0]['product_attribute_id']) {

                        // update quantity
                        $newquantity = $data['cart']['items'][0]['quantity'];
                        $oldquantity = $item['quantity'];

                        $unitprice = $item['unit_price'];

                        $_SESSION['cart']['items'][$i]['quantity'] = ($oldquantity + $newquantity);
                        $_SESSION['cart']['items'][$i]['total_price'] = ( ($oldquantity + $newquantity) * $unitprice);

                        // same product found
                        $found = TRUE;
                    } else {

                        // insert new item if in last items
                        if ($i == $len - 1 && $found == FALSE) {
                            foreach ($data['cart']['items'] as $value) {
                                $_SESSION['cart']['items'][] = $value;
                            }
                        }
                    }
                    $i++;
                }
            }
        }
    }
    

	public function actionSalee(){
	    
	    $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $brand_id = [1,12,4,5,67,9,79,49,48,71,10,8,33,44,6,81,82,87,90];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
            $id_prod = [];
          // get all id product
          $id_prod = $this->actionIdproduct($brand_id,$id_prod);
                // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
		
        $this->title = 'Waktunya Silahturahmi - Promo diskon Ramadhan 2019 | The Watch Co.';
		\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo Diskon Ramadhan 2019 | thewatch.co']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Nikmati promo diskon Ramadhan Bersama The Watch Co. Dapatkan jam tangan pria dan wanita branded original beserta aksesoris lainnya dengan harga menarik. Beli sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Nikmati promo diskon Ramadhan Bersama The Watch Co. Dapatkan jam tangan pria dan wanita branded original beserta aksesoris lainnya dengan harga menarik. Beli sekarang!']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Diskon Ramadhan 2019 | thewatch.co']);
		\Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

        return $this->render('ramadhan-sale', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));

	}
	
	public function actionHarbolnas11(){
	    session_start();
        $brand_id = [1,4,10,12,17,27,33,19,24,5,6,2,9,59,58,31,8,26,44,71,48,49,79,72];
        $now = date("Y-m-d H:i:s");
        // if($_SESSION['customerInfo']['customer_id'] == 7614){
    		// $now = '2018-11-10 00:00:00';
    	// }
        $page = 0;
        $limit = 4;
        $casual = \backend\models\Product::find()
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productFeature",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product_feature.feature_value_id'=>115])
                ->andWhere(['brands.brand_id'=>$brand_id])
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->orderBy(new Expression('rand()'))
                ->all();
        
        $aktif = \backend\models\Product::find()
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productFeature",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product_feature.feature_value_id'=>116])
                ->andWhere(['brands.brand_id'=>$brand_id])
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->orderBy(new Expression('rand()'))
                ->all();
                
        $aksesoris = \backend\models\Product::find()
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productFeature",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product_feature.feature_value_id'=>117])
                ->andWhere(['brands.brand_id'=>$brand_id])
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->orderBy(new Expression('rand()'))
                ->all();
        
        $classic = \backend\models\Product::find()
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productFeature",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product_feature.feature_value_id'=>12])
                ->andWhere(['brands.brand_id'=>$brand_id])
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->orderBy(new Expression('rand()'))
                ->all();
        
        $classic = \backend\models\Product::find()
                ->offset($page)
                ->limit($limit)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productFeature",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product_feature.feature_value_id'=>12])
                ->andWhere(['brands.brand_id'=>$brand_id])
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->orderBy(new Expression('rand()'))
                ->all();
        
        $product = \backend\models\Product::find()
                ->offset($page)
                ->limit(15)
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->andWhere(['brands.brand_id'=>$brand_id])
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->orderBy(new Expression('rand()'))
                ->all();
                
        // echo count($results);die();

	    $this->title = 'Pesta Belanja 11-11 | The Watch Co.';
		\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Pesta Belanja 11-11 | thewatch.co']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Nikmati promo diskon Pesta Belanja 11-11 Bersama The Watch Co. Dapatkan jam tangan pria dan wanita branded original beserta aksesoris lainnya dengan harga menarik. Beli sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Nikmati promo diskon Pesta Belanja 11-11 Bersama The Watch Co. Dapatkan jam tangan pria dan wanita branded original beserta aksesoris lainnya dengan harga menarik. Beli sekarang!']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Pesta Belanja 11-11 | thewatch.co']);
		\Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

        return $this->render('harbolnas11', array("products" => $product, "casual" => $casual, "aktif" => $aktif, "aksesoris" => $aksesoris, "classic" => $classic, "limit" => $limit, "page"=>$page,"brands"=>$brand_id));
	}
	
	public function actionHarbolnas11detail(){
	    $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $brand_id = [1,4,10,12,17,27,33,19,24,5,6,2,9,59,58,31,8,26,44,71,48,49,79,72];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
            $id_prod = [];
          // get all id product
          $id_prod = $this->actionIdproduct($brand_id,$id_prod);
          
         
                // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
	    $this->title = 'Pesta Belanja 11-11 | The Watch Co.';
		\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Pesta Belanja 12-12 | thewatch.co']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Nikmati promo diskon Pesta Belanja 12-12 Bersama The Watch Co. Dapatkan jam tangan pria dan wanita branded original beserta aksesoris lainnya dengan harga menarik. Beli sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Nikmati promo diskon Pesta Belanja 12-12 Bersama The Watch Co. Dapatkan jam tangan pria dan wanita branded original beserta aksesoris lainnya dengan harga menarik. Beli sekarang!']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Pesta Belanja 12-12 | thewatch.co']);
		\Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

        return $this->render('harbolnas11detail', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
	}
	
	
	public function actionFlashOkt()
    {
        $event_name         = 'Flash Sale';
        $start              = 0;
        $limit              = 20;
        $current_date       = date('Y-m-d H:i:s');
        $only_date          = date('Y-m-d');
        $start_date         = '2019-10-08';
        $mid_date           = '2019-10-09';
        $end_date           = '2019-10-10';
        $start_batch        = ['10:10:00', '10:10:00', '10:10:00'];
        $end_batch          = ['14:00:00', '14:00:00', '14:00:00'];
        $start_date_batch_1 = $start_date.' '.$start_batch[0];
        $end_date_batch_1   = $start_date.' '.$end_batch[0];
		    $start_date_batch_2 = $mid_date.' '.$start_batch[1];
        $end_date_batch_2   = $mid_date.' '.$end_batch[1];
        $start_date_batch_3 = $end_date.' '.$start_batch[2];
        $end_date_batch_3   = $end_date.' '.$end_batch[2];

		    $banner_desktop     = 'promo/flash/sale-banner-d-10.10.jpg?auto=compress,format&fit=max&fm=pjpg&max-w=3840';
        $banner_mobile      = 'promo/flash/sale-banner-m-10.10.jpg?auto=compress,format&fm=pjpg';
        $time_actived       = 1;
        $total_sale         = 0;
        $brands             = array();
        $category           = array();
        $products           = array();
        $product            = array();
        $days               = 0;
        $countdown_sale     = '';
        $countdown_pre_sale = '';

        $sortby = 'none';
        if(isset($_GET['sortby'])){
            $sortby = $_GET['sortby'];
        }else{
            $sortby = 'none'; 
        }

        $page = 1;
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

        $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
        $start_time = $start_date_batch_1;
        $end_time   = $end_date_batch_1;

        if( ($current_date >= $start_date_batch_1) && ($current_date <= $end_date_batch_1)){
          
          $start_time     = $start_date_batch_1;
          $end_time       = $end_date_batch_1;
          $banner_desktop = 'promo/flash/sale-banner-d-10.10.jpg?auto=compress,format&fit=max&fm=pjpg&max-w=3840';
          $banner_mobile  = 'promo/flash/sale-banner-m-10.10.jpg?auto=compress,format&fm=pjpg';
    
        }elseif( ($current_date >= $start_date_batch_2) && ($current_date <= $end_date_batch_2)){
          
          $start_time     = $start_date_batch_2;
          $end_time       = $end_date_batch_2;
          $banner_desktop = 'promo/flash/sale-banner-d-10.10.jpg?auto=compress,format&fit=max&fm=pjpg&max-w=3840';
          $banner_mobile  = 'promo/flash/sale-banner-m-10.10.jpg?auto=compress,format&fm=pjpg';
        }elseif( ($current_date >= $start_date_batch_3) && ($current_date <= $end_date_batch_3)){
          
          $start_time     = $start_date_batch_3;
          $end_time       = $end_date_batch_3;
          $banner_desktop = 'promo/flash/sale-banner-d-10.10.jpg?auto=compress,format&fit=max&fm=pjpg&max-w=3840';
          $banner_mobile  = 'promo/flash/sale-banner-m-10.10.jpg?auto=compress,format&fm=pjpg';
        }

        if(isset($_GET['batch']) && $_GET['batch'] == 1) {

          $start_time     = $start_date_batch_1;
          $end_time       = $end_date_batch_1;

        }else if(isset($_GET['batch']) && $_GET['batch'] == 2) {

          $start_time     = $start_date_batch_2;
          $end_time       = $end_date_batch_2;

        }else if(isset($_GET['batch']) && $_GET['batch'] == 3) {

          $start_time     = $start_date_batch_3;
          $end_time       = $end_date_batch_3;

        }else{
			 if(substr($current_date,0,10)==$start_date){

            $start_time     = $start_date_batch_1;
            $end_time       = $end_date_batch_1;
            
          }else if(substr($current_date,0,10)==$mid_date){

            $start_time     = $start_date_batch_2;
            $end_time       = $end_date_batch_2;

          }else if(substr($current_date,0,10)==$end_date){
            $start_time     = $start_date_batch_3;
            $end_time       = $end_date_batch_3;
          }
		}

         $products       = Product::getProductFlashSaleNew($brands, $category, $start_time, $end_time, $product, $start, $limit, $sortby);
         // print_r($products);
         // die();
         $products_count = Product::getCountProductFlashSale($brands, $category, $start_time, $end_time, $product);
		
		
        if( ($current_date <= $start_time) ){
            $diff = abs(strtotime($start_date) - strtotime($current_date));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            if( $days >= 0 && $days <= 6 ){
                $countdown_pre_sale = date("D M j Y H:i:s", strtotime( date($start_time) ));
                $products = Product::getProductFlashSaleNew($brands, $category, $start_time, $end_time, $product, $start, $limit, $sortby);
                $products_count = Product::getCountProductFlashSale($brands, $category, $start_time, $end_time, $product);
            }
        }

            $time_actived = 1;
            $countdown_sale = date("D M j Y H:i:s", strtotime( date($end_time)) );
			
            $products = Product::getProductFlashSaleNew($brands, $category, $start_time, $end_time, $product, $start, $limit, $sortby);
            $products_count = Product::getCountProductFlashSale($brands, $category, $start_time, $end_time, $product);
		
		    if(isset($_GET['batch']) && $_GET['batch'] == 2) {

        }

        $this->title = $event_name.' – The Watch Co.';
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => $this->title]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Manfaatkan promo flash sale untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Manfaatkan promo flash sale untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => $this->title]);
        \Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

        return $this->render('flash-okt', array( 
          "products" => $products, 
          "count" => (int)$products_count, 
          "limit" => $limit, 
          "page"=>$page, 
          "brands"=>$brands, 
          "current_date"=>$current_date, 
          "start_date"=>$start_date, 
          "mid_date"=>$mid_date, 
          "end_date"=>$end_date, 
          "start_batch"=>$start_batch, 
          "end_batch"=>$end_batch, 
          "countdown_sale"=>$countdown_pre_sale, 
          "countdown_pre_sale"=>$countdown_pre_sale, 
          "banner_desktop"=>$banner_desktop, 
          "banner_mobile"=>$banner_mobile, 
          "time_active"=>$time_actived, 
          "pagination"=> $pagination 
        ));
    }
  
    public function actionFlashDes(){
		 
      $start = 0;
          $limit = 20;
      
      $sort = 'none';
      if(isset($_GET['sortby'])){
        $sort = $_GET['sortby'];
      }
      
          $sortby = 'priority ASC';
      
          if($sort == 'price-high-to-low'){
            $sortby = 'priority DESC';
          }if($sort == 'price-low-to-high'){
            $sortby = 'priority ASC';
          }if($sort == 'none'){
            $sortby = 'priority ASC';
          }
          
          $brand_id = [90, 73, 48, 91, 6, 5, 44,72,85,4, 88];   
      
          $default_brand = $brand_id;
          if(isset($_GET['brands'])){
              $brand_id = explode('--', $_GET['brands']);
          }
  
          $page = 1;
            
  
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
          
      
          
          
    $id_prod11 = [
        3360, 3361, 3362, 3363, 3364, 3365, 2196, 2197, 2199, 2198, 2200, 1421, 869, 1412, 2859, 2889, 1697, 1779, 1707, 1768, 2413, 1770, 2256, 1771, 2421, 1772, 2858, 1774, 2877, 2707, 2708, 2709, 2710, 2793, 2769, 2795, 2770, 2831, 2771, 2826, 2772, 2827, 2773, 3310, 2774, 3237, 2775, 3216, 2776, 2777, 2778, 2780, 2781, 2796, 2782, 3240, 2783, 2798,
		
		/*YANG GA DISKON TAPI MASUK FLASH SALE*/
		
		/*OB*/
		4136, 4137, 4138, 4139, 4140, 4141, 4142, 4154, 4197, 4198, 4199, 4200, 4201, 4203,
		
		/*CHPO*/
		4052, 4053, 4054, 4055, 4056, 4057, 4058, 4059, 4060, 4150,
		
		/*RAINS*/
		1632, 1204, 1631, 1243, 1576, 1255, 1561, 1256, 1563, 1259, 1565,
		
		/*EASTPAK*/
		1691
        
	]; 
      
      $id_prod12 = [
        3366, 3367, 3368, 3369, 3370, 3371, 3381, 3382, 4192, 4070, 4071, 3700, 1999, 2018, 2001, 3306, 2431, 2264, 3233, 2273, 3304, 2274, 2280, 3308, 2282, 2284, 2423, 2784, 2785, 2786, 2787, 2788, 2828, 2789, 2829, 2790, 2799, 2791, 2800, 2792, 3219, 3220, 3238, 2801, 2830, 2802, 2984, 2803, 2833, 2804, 2805, 2806, 3217, 2807, 2808, 2809, 3234, 2263,
		/*TIMEX*/
        /* 3445, 3446, 3448, 3450, 3451, 3452, 3453, 3455, 3456, 3457, 3460, 3461, 3462, 3463, 3464, 3465, 3466, 3467, 3468, 3471, 3472, 3473, 3476, 3477, 3478, 3480, 3482, 3483, 3485, 3488, 3489, 3490, 3491, 3492, 3493, 3495, 3496, 3939, 3940, 4188, 4189, */
		/* TID WAtch*/
		/* 1754,1756,1757, */
		/* d1 MILANO */
		/* 2711, 2712, 2713, 2714, 2715, 2716, 2717, 2718, 2720, 2723, 2734, 2735, 2738, 2742, 2743, 2759, 2761, 2762, 2763, 2764, 2766, 2767, 2768, */
		/* BRAUN */
		/* 42,177,178,222,1810,1811, */
		
		/*YANG GA DISKON TAPI MASUK FLASH SALE*/
		
		/*OB*/
		1778, 2646, 2853, 2866, 2892, 3503, 3651, 3652, 3653, 3704, 3705, 3713, 3714, 3716, 3717, 
		
		/*CHPO*/
		3414, 3415, 3418, 3426, 3427, 3430, 3431, 3432,
		
		/*RAINS*/
		1260, 1577, 1279, 1567, 1282, 1569, 1283, 1570, 1284, 1571, 1572,
		
		/*EASTPAK*/
		898, 903, 916
		

      ]; 
      
      $id_prod13 = [
        3372, 3373, 3374, 3375, 3377, 3379, 3474, 3475, 4073, 4072, 4074, 4075, 4076, 2425, 2865, 2436, 2855, 2439, 2873, 2894, 2900, 3229, 3305, 3285, 3706, 3654, 3656, 3710, 3711, 4155, 3218, 2810, 2811, 2812, 2813, 2814, 2815, 2816, 2817, 2818, 2819, 2820, 2821, 2822, 2823, 2835, 2836, 2837, 2838, 2839, 2840, 2841, 2842, 3221, 2843, 3222, 2844, 3311, 2845, 3224, 3315, 3982, 3968,
		/*TIMEX*/
        3445, 3446, 3448, 3450, 3451, 3452, 3453, 3455, 3456, 3457, 3460, 3461, 3462, 3463, 3464, 3465, 3466, 3467, 3468, 3471, 3472, 3473, 3476, 3477, 3478, 3480, 3482, 3483, 3485, 3488, 3489, 3490, 3491, 3492, 3493, 3495, 3496, 3939, 3940, 4188, 4189,
		/* TID WAtch*/
		1754,1756,1757,
		/* d1 MILANO */
		2711, 2712, 2713, 2714, 2715, 2716, 2717, 2718, 2720, 2723, 2734, 2735, 2738, 2742, 2743, 2759, 2761, 2762, 2763, 2764, 2766, 2767, 2768,
		/* BRAUN */
		42,177,178,222,1810,1811,
		/* fitbit */
		2941 ,2942 ,2943 ,2938 ,2944 ,2939 ,2940 ,3931 ,3696 ,3932 ,3933 ,3799 ,3934 ,3800 ,3927 ,3928 ,3929 ,3930, 
		
		/*YANG GA DISKON TAPI MASUK FLASH SALE*/
		
		/*OB*/
		3966, 3971, 3973, 3974, 3979, 3980, 4124, 4125, 4127, 4128, 4129, 4131, 4132, 4134, 4135,
		
		/*CHPO*/
		3433, 3435, 3438, 3439, 3440, 3444, 4049, 4050,
		
		/*RAINS*/
		1573, 1564, 1574, 1618, 1619, 1620, 1622, 1623, 1624, 1626, 1627,
		
		/*EASTPAK*/
		903, 916
      ]; 
      
      $now = date("Y-m-d H:i:s");
      
      $id_prod = [];
      
      if ($now > "2019-12-10 00:00:00" && $now < "2019-12-10 23:59:59") {
        $id_prod = $id_prod11; 
      }
      
      if ($now > "2019-12-11 00:00:00" && $now < "2019-12-11 23:59:59") {
        $id_prod = $id_prod12; 
      }
      
      if ($now > "2019-12-12 00:00:00" && $now < "2019-12-12 23:59:59") {
        $id_prod = $id_prod13; 
      }
      
      
      
      
          // $id_prod = $this->actionIdproduct($brand_id,$id_prod);
              // query product and filter
          $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
          $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
       
      // var_dump($products);
      // exit;
          
          $this->title = 'Flash Sale – The Watch Co.';
      
          \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Manfaatkan promo diskon besar-besaran akhir tahun untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
          \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'Manfaatkan promo diskon besar-besaran akhir tahun untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
          \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Flash Sale – The Watch Co.']);
          
          // \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
          // \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Waktunya Flash Sale 11.11 - The Watch Co.' ]);
          // \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Waktunya Flash Sale 11.11' ]);
          // \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Waktunya Flash Sale 11.11 - The Watch Co.']);
          // \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/flash-sale']);
          // \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/event/seo-share.jpg' ]);
  
          // $model = \backend\models\KontesSeoContent::find()->where(['id'=>1])->one();
          return $this->render('flash-des', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
    } 


	public function actionFallwinter(){
		$start = 0;
        $limit = 20;
		
		$sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $brand_id = [14, 48, 6, 95, 69];
		
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
        
		
        
        
        $id_prod = [276, 277, 290, 291, 292, 293, 294, 295, 296, 297, 298, 309, 310, 311, 574, 575, 576, 577, 578, 579, 590, 592, 594, 608, 619, 620, 621, 622, 623, 624, 625, 626, 627, 628, 629, 630, 631, 632, 633, 634, 635, 833, 835, 836, 837, 838, 839, 841, 843, 844, 846, 847, 855, 857, 858, 859, 860, 861, 862, 863, 864, 865, 866, 867, 868, 869, 886, 888, 889, 891, 935, 936, 940, 943, 947, 948, 953, 954, 958, 959, 961, 1010, 1011, 1012, 1013, 1014, 1015, 1016, 1017, 1018, 1019, 1020, 1021, 1100, 1101, 1102, 1103, 1104, 1105, 1106, 1107, 1108, 1110, 1111, 1114, 1115, 1117, 1118, 1119, 1120, 1122, 1123, 1124, 1132, 1133, 1135, 1137, 1138, 1139, 1140, 1141, 1159, 1160, 1161, 1162, 1163, 1164, 1166, 1167, 1168, 1169, 1172, 1183, 1184, 1185, 1187, 1188, 1189, 1190, 1191, 1192, 1193, 1194, 1195, 1196, 1197, 1198, 1199, 1200, 1201, 1202, 1203, 1204, 1205, 1206, 1207, 1208, 1209, 1210, 1211, 1212, 1213, 1214, 1215, 1216, 1217, 1218, 1219, 1220, 1221, 1222, 1223, 1224, 1225, 1226, 1227, 1228, 1229, 1230, 1231, 1232, 1233, 1234, 1235, 1236, 1237, 1238, 1239, 1240, 1241, 1242, 1243, 1244, 1245, 1246, 1247, 1248, 1249, 1250, 1251, 1252, 1253, 1254, 1255, 1256, 1257, 1258, 1259, 1260, 1261, 1262, 1263, 1264, 1265, 1266, 1267, 1268, 1269, 1270, 1271, 1272, 1273, 1274, 1275, 1276, 1277, 1278, 1279, 1280, 1281, 1282, 1283, 1284, 1285, 1286, 1313, 1314, 1397, 1398, 1399, 1400, 1401, 1402, 1403, 1404, 1405, 1406, 1407, 1408, 1409, 1410, 1411, 1412, 1413, 1414, 1415, 1416, 1417, 1418, 1419, 1420, 1421, 1422, 1423, 1424, 1425, 1426, 1427, 1428, 1429, 1430, 1431, 1462, 1463, 1464, 1465, 1466, 1467, 1468, 1469, 1470, 1471, 1472, 1473, 1474, 1475, 1476, 1477, 1478, 1479, 1480, 1481, 1482, 1483, 1522, 1523, 1549, 1550, 1551, 1552, 1553, 1554, 1555, 1556, 1560, 1561, 1563, 1564, 1565, 1566, 1567, 1568, 1569, 1570, 1571, 1572, 1573, 1574, 1575, 1576, 1577, 1579, 1580, 1585, 1608, 1609, 1610, 1614, 1615, 1616, 1617, 1618, 1619, 1620, 1621, 1622, 1623, 1624, 1625, 1626, 1627, 1628, 1629, 1631, 1632, 1633, 1634, 1635, 1636, 1637, 1638, 1639, 1640, 1641, 1642, 1643, 1644, 1645, 1646, 1647, 1648, 1649, 1650, 1651, 1652, 1653, 1654, 1655, 1656, 1657, 1659, 1660, 1661, 1662, 1663, 1664, 1665, 1685, 1686, 1687, 1694, 1695, 1696, 1697, 1698, 1699, 1700, 1701, 1702, 1703, 1704, 1705, 1706, 1707, 1708, 1709, 1710, 1711, 1712, 1713, 1714, 1715, 1716, 1717, 1759, 1760, 1761, 1762, 1763, 1764, 1765, 1766, 1767, 1768, 1769, 1770, 1771, 1772, 1773, 1774, 1775, 1776, 1777, 1778, 1779, 1780, 1781, 1782, 1783, 1784, 1785, 1795, 1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999, 2000, 2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2047, 2255, 2256, 2257, 2258, 2259, 2260, 2261, 2262, 2263, 2264, 2265, 2266, 2267, 2268, 2269, 2270, 2271, 2272, 2273, 2274, 2275, 2276, 2277, 2278, 2279, 2280, 2281, 2282, 2283, 2284, 2285, 2286, 2287, 2317, 2318, 2411, 2412, 2413, 2414, 2415, 2416, 2417, 2418, 2419, 2420, 2421, 2422, 2423, 2424, 2425, 2426, 2427, 2428, 2429, 2430, 2431, 2432, 2433, 2434, 2435, 2436, 2437, 2438, 2439, 2440, 2479, 2636, 2637, 2638, 2639, 2640, 2641, 2642, 2643, 2644, 2645, 2646, 2647, 2648, 2649, 2650, 2651, 2652, 2653, 2654, 2655, 2656, 2657, 2658, 2659, 2660, 2661, 2663, 2664, 2665, 2666, 2707, 2708, 2709, 2710, 2769, 2770, 2771, 2772, 2773, 2774, 2775, 2776, 2777, 2778, 2779, 2780, 2781, 2782, 2783, 2784, 2785, 2786, 2787, 2788, 2789, 2790, 2791, 2792, 2793, 2794, 2795, 2796, 2797, 2798, 2799, 2800, 2801, 2802, 2803, 2804, 2805, 2806, 2807, 2808, 2809, 2810, 2811, 2812, 2813, 2814, 2815, 2816, 2817, 2818, 2819, 2820, 2821, 2822, 2823, 2824, 2826, 2827, 2828, 2829, 2830, 2831, 2832, 2833, 2834, 2835, 2836, 2837, 2838, 2839, 2840, 2841, 2842, 2843, 2844, 2845, 2851, 2852, 2853, 2854, 2855, 2856, 2857, 2858, 2859, 2860, 2861, 2862, 2863, 2864, 2865, 2866, 2867, 2868, 2869, 2870, 2872, 2873, 2874, 2875, 2876, 2877, 2878, 2879, 2880, 2881, 2882, 2883, 2884, 2885, 2889, 2890, 2891, 2892, 2893, 2894, 2895, 2896, 2897, 2898, 2899, 2900, 2984, 3216, 3217, 3218, 3219, 3220, 3221, 3222, 3223, 3224, 3225, 3226, 3227, 3228, 3229, 3230, 3231, 3232, 3233, 3234, 3235, 3236, 3237, 3238, 3239, 3240, 3285, 3286, 3300, 3301, 3302, 3303, 3304, 3305, 3306, 3307, 3308, 3309, 3310, 3311, 3312, 3313, 3314, 3315, 3401, 3402, 3403, 3404, 3405, 3407, 3408, 3409, 3454, 3497, 3498, 3499, 3500, 3501, 3502, 3503, 3509, 3510, 3511, 3512, 3513, 3514, 3515, 3516, 3517, 3518, 3519, 3520, 3521, 3522, 3523, 3524, 3525, 3650, 3651, 3652, 3653, 3654, 3655, 3656, 3698, 3699, 3700, 3701, 3702, 3703, 3704, 3705, 3706, 3707, 3708, 3709, 3710, 3711, 3712, 3713, 3714, 3715, 3716, 3717, 3718, 3729, 3730, 3731, 3732, 3733, 3734, 3735, 3736, 3737, 3738, 3739, 3740, 3744, 3897, 3898, 3899, 3900, 3901, 3902, 3966, 3968, 3969, 3970, 3971, 3972, 3973, 3974, 3975, 3976, 3977, 3978, 3979, 3980, 3981, 3982, 4022, 4023, 4024, 4025, 4026, 4027, 4028, 4029, 4030, 4031, 4032, 4033, 4034, 4035, 4036, 4037, 4038, 4039, 4040, 4041, 4042, 4043, 4044, 4061, 4062, 4063, 4064, 4124, 4125, 4127, 4128, 4129, 4130, 4131, 4132, 4133, 4134, 4135, 4136, 4137, 4138, 4139, 4140, 4141, 4142, 4154, 4155, 4156, 4157, 4158, 4159, 4160, 4161, 4162, 4163, 4164, 4165, 4166, 4167];
        $id_prod = $this->actionIdproduct($brand_id,$id_prod);
            // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
        $this->title = 'Fall Winter Update - The Watch Co.';
		
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Let’s be prepared to keep you in style through the season']);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'Fall Winter Update - The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Fall Winter Update - The Watch Co.']);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Fall Winter Update - The Watch Co.' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Let’s be prepared to keep you in style through the season' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Fall Winter Update']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/fall-winter']);
        // \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/event/seo-share.jpg' ]);

        // $model = \backend\models\KontesSeoContent::find()->where(['id'=>1])->one();
        return $this->render('fallwinter', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
	}
	
	
	public function actionFlashSep()
    {
		
        $event_name         = 'Flash Sale';
        $start              = 0;
        $limit              = 20;
        $current_date       = date('Y-m-d H:i:s');
        $only_date          = date('Y-m-d');
        $start_date         = '2019-10-11';
        $mid_date           = '2019-11-12';
        $end_date           = '2019-11-13';
        $start_batch        = ['10:10:00', '10:10:00', '10:10:00'];
        $end_batch          = ['14:00:00', '14:00:00', '14:00:00'];
        $start_date_batch_1 = $start_date.' '.$start_batch[0];
        $end_date_batch_1   = $start_date.' '.$end_batch[0];
		$start_date_batch_2 = $mid_date.' '.$start_batch[1];
        $end_date_batch_2   = $mid_date.' '.$end_batch[1];
        $start_date_batch_3 = $end_date.' '.$start_batch[2];
        $end_date_batch_3   = $end_date.' '.$end_batch[2];

		$banner_desktop = 'promo/flash/11_11_19/11.11_Sale Banner_Desktop.jpg?auto=compress,format&fit=max&fm=pjpg&max-w=3840';
		$banner_mobile  = 'promo/flash/11_11_19/11.11_Sale Banner_Mobile.jpg?auto=compress,format&fm=pjpg';
        $time_actived       = 1;
        $total_sale         = 0;
        $brands             = array();
        $category           = array();
        $products           = array();
        $product            = array();
        $days               = 0;
        $countdown_sale     = '';
        $countdown_pre_sale = '';

        $sortby = 'none';
        if(isset($_GET['sortby'])){
            $sortby = $_GET['sortby'];
        }else{
            $sortby = 'none'; 
        }

        $page = 1;
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

        $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
        $start_time = $start_date_batch_1;
        $end_time   = $end_date_batch_1;

        if( ($current_date >= $start_date_batch_1) && ($current_date <= $end_date_batch_1)){
          
          $start_time     = $start_date_batch_1;
          $end_time       = $end_date_batch_1;
          $banner_desktop = 'promo/flash/11_11_19/11.11_Sale Banner_Desktop.jpg?auto=compress,format&fit=max&fm=pjpg&max-w=3840';
          $banner_mobile  = 'promo/flash/11_11_19/11.11_Sale Banner_Mobile.jpg?auto=compress,format&fm=pjpg';
    
        }elseif( ($current_date >= $start_date_batch_2) && ($current_date <= $end_date_batch_2)){
          
          $start_time     = $start_date_batch_2;
          $end_time       = $end_date_batch_2;
          $banner_desktop = 'promo/flash/11_11_19/11.11_Sale Banner_Desktop.jpg?auto=compress,format&fit=max&fm=pjpg&max-w=3840';
          $banner_mobile  = 'promo/flash/11_11_19/11.11_Sale Banner_Mobile.jpg?auto=compress,format&fm=pjpg';
        }elseif( ($current_date >= $start_date_batch_3) && ($current_date <= $end_date_batch_3)){
          
          $start_time     = $start_date_batch_3;
          $end_time       = $end_date_batch_3;
          $banner_desktop = 'promo/flash/11_11_19/11.11_Sale Banner_Desktop.jpg?auto=compress,format&fit=max&fm=pjpg&max-w=3840';
          $banner_mobile  = 'promo/flash/11_11_19/11.11_Sale Banner_Mobile.jpg?auto=compress,format&fm=pjpg';
        }

        if(isset($_GET['batch']) && $_GET['batch'] == 1) {

          $start_time     = $start_date_batch_1;
          $end_time       = $end_date_batch_1;

        }else if(isset($_GET['batch']) && $_GET['batch'] == 2) {

          $start_time     = $start_date_batch_2;
          $end_time       = $end_date_batch_2;

        }else if(isset($_GET['batch']) && $_GET['batch'] == 3) {

          $start_time     = $start_date_batch_3;
          $end_time       = $end_date_batch_3;

        }else{
			 if(substr($current_date,0,10)==$start_date){

            $start_time     = $start_date_batch_1;
            $end_time       = $end_date_batch_1;
            
          }else if(substr($current_date,0,10)==$mid_date){

            $start_time     = $start_date_batch_2;
            $end_time       = $end_date_batch_2;

          }else if(substr($current_date,0,10)==$end_date){
            $start_time     = $start_date_batch_3;
            $end_time       = $end_date_batch_3;
          }
		}

         $products       = Product::getProductFlashSaleNew($brands, $category, $start_time, $end_time, $product, $start, $limit, $sortby);
         // print_r($products);
         // die();
         $products_count = Product::getCountProductFlashSale($brands, $category, $start_time, $end_time, $product);
		
		
        if( ($current_date <= $start_time) ){
            $diff = abs(strtotime($start_date) - strtotime($current_date));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            if( $days >= 0 && $days <= 6 ){
                $countdown_pre_sale = date("D M j Y H:i:s", strtotime( date($start_time) ));
                $products = Product::getProductFlashSaleNew($brands, $category, $start_time, $end_time, $product, $start, $limit, $sortby);
                $products_count = Product::getCountProductFlashSale($brands, $category, $start_time, $end_time, $product);
            }
        }

            $time_actived = 1;
            $countdown_sale = date("D M j Y H:i:s", strtotime( date($end_time)) );
			
            $products = Product::getProductFlashSaleNew($brands, $category, $start_time, $end_time, $product, $start, $limit, $sortby);
            $products_count = Product::getCountProductFlashSale($brands, $category, $start_time, $end_time, $product);
		
		    if(isset($_GET['batch']) && $_GET['batch'] == 2) {

        }

        $this->title = $event_name.' – The Watch Co.';
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => $this->title]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Manfaatkan promo flash sale untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Manfaatkan promo flash sale untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => $this->title]);
        \Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

        return $this->render('flash-sep', array( 
          "products" => $products, 
          "count" => (int)$products_count, 
          "limit" => $limit, 
          "page"=>$page, 
          "brands"=>$brands, 
          "current_date"=>$current_date, 
          "start_date"=>$start_date, 
          "mid_date"=>$mid_date, 
          "end_date"=>$end_date, 
          "start_batch"=>$start_batch, 
          "end_batch"=>$end_batch, 
          "countdown_sale"=>$countdown_pre_sale, 
          "countdown_pre_sale"=>$countdown_pre_sale, 
          "banner_desktop"=>$banner_desktop, 
          "banner_mobile"=>$banner_mobile, 
          "time_active"=>$time_actived, 
          "pagination"=> $pagination 
        ));
    }
	
	public function actionBerbagiwaktu(){ 
		$start = 0;
        $limit = 20;
		
		$sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $brand_id = [44,48]; 
		
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
        
		
        
        
        $id_prod = [803, 804, 805, 806, 807, 808, 809, 810, 811, 812, 813, 814, 815, 816, 817, 818, 819, 820, 821, 822, 823, 824, 825, 826, 827, 828, 830, 831, 832, 833, 834, 835, 836, 837, 838, 839, 840, 841, 842, 843, 844, 845, 846, 847, 848, 849, 850, 851, 852, 853, 854, 855, 856, 857, 858, 859, 860, 861, 862, 863, 864, 865, 866, 867, 868, 869, 870, 871, 872, 873, 874, 875, 876, 877, 879, 880, 881, 883, 884, 885, 886, 888, 889, 891, 935, 936, 940, 943, 947, 948, 953, 954, 958, 959, 961, 1022, 1060, 1061, 1062, 1063, 1064, 1065, 1066, 1100, 1101, 1102, 1103, 1104, 1105, 1106, 1107, 1108, 1110, 1111, 1115, 1117, 1118, 1119, 1120, 1122, 1123, 1124, 1125, 1126, 1127, 1128, 1129, 1130, 1132, 1133, 1137, 1138, 1139, 1140, 1141, 1159, 1160, 1161, 1162, 1163, 1164, 1166, 1167, 1168, 1169, 1172, 1313, 1314, 1315, 1316, 1317, 1318, 1319, 1320, 1321, 1322, 1323, 1324, 1325, 1326, 1397, 1398, 1399, 1400, 1401, 1402, 1403, 1404, 1405, 1406, 1407, 1408, 1409, 1410, 1411, 1412, 1413, 1414, 1415, 1416, 1417, 1418, 1419, 1420, 1421, 1422, 1423, 1424, 1425, 1426, 1427, 1428, 1429, 1431, 1462, 1463, 1464, 1465, 1466, 1467, 1468, 1469, 1470, 1471, 1472, 1473, 1474, 1475, 1476, 1477, 1478, 1479, 1480, 1481, 1482, 1483, 1484, 1485, 1486, 1487, 1488, 1489, 1490, 1491, 1492, 1493, 1494, 1495, 1496, 1497, 1498, 1499, 1500, 1501, 1502, 1503, 1505, 1506, 1507, 1508, 1509, 1579, 1580, 1585, 1608, 1609, 1610, 1633, 1634, 1635, 1636, 1637, 1638, 1639, 1640, 1641, 1642, 1643, 1644, 1645, 1646, 1647, 1648, 1649, 1650, 1651, 1652, 1653, 1654, 1655, 1656, 1657, 1659, 1660, 1661, 1662, 1663, 1664, 1665, 1685, 1686, 1687, 1688, 1689, 1694, 1695, 1696, 1697, 1698, 1699, 1700, 1701, 1702, 1703, 1704, 1705, 1706, 1707, 1708, 1709, 1711, 1712, 1713, 1714, 1715, 1731, 1732, 1733, 1734, 1735, 1736, 1737, 1741, 1742, 1743, 1744, 1745, 1746, 1747, 1748, 1749, 1750, 1751, 1759, 1760, 1761, 1762, 1763, 1764, 1765, 1766, 1767, 1768, 1769, 1770, 1771, 1772, 1773, 1774, 1775, 1776, 1777, 1778, 1779, 1780, 1781, 1782, 1783, 1784, 1785, 1786, 1787, 1788, 1789, 1790, 1791, 1792, 1793, 1794, 1795, 1796, 1797, 1799, 1800, 1801, 1802, 1803, 1804, 1805, 1806, 1807, 1808, 1809, 1991, 1992, 1995, 1996, 1997, 1998, 1999, 2000, 2001, 2002, 2003, 2004, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2042, 2043, 2044, 2045, 2046, 2048, 2090, 2091, 2092, 2093, 2094, 2095, 2096, 2097, 2098, 2099, 2100, 2101, 2102, 2103, 2104, 2105, 2106, 2107, 2108, 2109, 2110, 2111, 2112, 2113, 2114, 2115, 2116, 2168, 2169, 2170, 2171, 2172, 2173, 2195, 2254, 2255, 2256, 2257, 2258, 2259, 2260, 2261, 2262, 2263, 2264, 2265, 2266, 2268, 2269, 2270, 2271, 2272, 2273, 2274, 2275, 2276, 2277, 2278, 2279, 2280, 2281, 2282, 2283, 2284, 2285, 2286, 2287, 2317, 2318, 2411, 2412, 2413, 2414, 2415, 2416, 2417, 2418, 2419, 2420, 2421, 2423, 2424, 2425, 2426, 2427, 2428, 2429, 2430, 2431, 2432, 2433, 2434, 2435, 2436, 2437, 2438, 2439, 2440, 2479, 2520, 2521, 2522, 2523, 2525, 2526, 2532, 2537, 2538, 2539, 2541, 2542, 2543, 2544, 2545, 2546, 2547, 2548, 2549, 2550, 2551, 2552, 2554, 2555, 2556, 2558, 2559, 2560, 2616, 2617, 2618, 2621, 2622, 2623, 2624, 2625, 2627, 2636, 2638, 2639, 2640, 2641, 2642, 2643, 2644, 2645, 2646, 2647, 2648, 2649, 2651, 2652, 2653, 2654, 2655, 2656, 2657, 2658, 2659, 2660, 2663, 2664, 2665, 2666, 2700, 2701, 2702, 2703, 2704, 2706, 2707, 2708, 2709, 2710, 2769, 2770, 2771, 2772, 2773, 2774, 2775, 2776, 2777, 2778, 2779, 2780, 2781, 2782, 2783, 2784, 2785, 2786, 2787, 2788, 2789, 2790, 2791, 2792, 2793, 2794, 2795, 2796, 2797, 2798, 2799, 2800, 2801, 2802, 2803, 2804, 2805, 2806, 2807, 2808, 2809, 2810, 2811, 2812, 2813, 2814, 2815, 2816, 2817, 2818, 2819, 2820, 2821, 2822, 2823, 2824, 2826, 2827, 2828, 2829, 2830, 2831, 2832, 2833, 2834, 2835, 2836, 2837, 2838, 2839, 2840, 2841, 2842, 2843, 2844, 2845, 2849, 2851, 2852, 2853, 2854, 2855, 2856, 2857, 2858, 2859, 2860, 2861, 2862, 2863, 2864, 2865, 2867, 2868, 2869, 2870, 2872, 2873, 2874, 2875, 2876, 2877, 2878, 2879, 2880, 2881, 2882, 2883, 2884, 2885, 2889, 2890, 2891, 2892, 2893, 2894, 2895, 2896, 2897, 2899, 2900, 2984, 2985, 2988, 2990, 2991, 2992, 2994, 2995, 2996, 2997, 2998, 3001, 3002, 3003, 3004, 3006, 3007, 3008, 3123, 3124, 3125, 3126, 3127, 3128, 3129, 3130, 3131, 3132, 3133, 3134, 3135, 3136, 3137, 3138, 3139, 3140, 3141, 3142, 3143, 3144, 3145, 3146, 3147, 3148, 3149, 3150, 3151, 3152, 3153, 3154, 3155, 3156, 3157, 3158, 3159, 3160, 3161, 3162, 3167, 3168, 3169, 3170, 3171, 3172, 3173, 3174, 3175, 3176, 3177, 3204, 3205, 3206, 3207, 3208, 3209, 3210, 3211, 3212, 3213, 3214, 3216, 3217, 3218, 3219, 3220, 3221, 3222, 3223, 3224, 3225, 3226, 3227, 3228, 3229, 3230, 3231, 3232, 3233, 3234, 3235, 3236, 3237, 3238, 3239, 3240, 3285, 3286, 3290, 3291, 3292, 3295, 3296, 3301, 3304, 3305, 3306, 3308, 3309, 3310, 3311, 3312, 3313, 3314, 3315, 3423, 3424, 3447, 3449, 3454, 3470, 3479, 3481, 3484, 3487, 3494, 3497, 3498, 3499, 3500, 3501, 3502, 3503, 3650, 3651, 3652, 3653, 3654, 3655, 3656, 3699, 3700, 3701, 3702, 3704, 3705, 3706, 3707, 3708, 3709, 3710, 3711, 3716, 3717, 3729, 3730, 3731, 3732, 3733, 3734, 3735, 3736, 3737, 3738, 3739, 3740, 3744, 3938, 3941, 3942, 3946, 3947, 3949, 3951, 3953, 3956, 3957, 3959, 3960, 3961, 3962, 3965, 3966, 3967, 3968, 3971, 3973, 3974, 3976, 3979, 3980, 3982, 4022, 4023, 4024, 4025, 4026, 4027, 4028, 4029]; 
        // $id_prod = $this->actionIdproduct($brand_id,$id_prod);
            // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
        $this->title = 'Berbagi Waktu - The Watch Co.';
		
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Promo Berbagi Waktu']);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'Berbagi Waktu - The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Berbagi Waktu - The Watch Co.']);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Berbagi Waktu - The Watch Co.' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Promo Berbagi Waktu' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Berbagi Waktu - The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/berbagiwaktu']);
        // \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/event/seo-share.jpg' ]);

        // $model = \backend\models\KontesSeoContent::find()->where(['id'=>1])->one();
        return $this->render('berbagiwaktu', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
	}
	
	public function actionFlashNovCek(){
		
		$start = 0;
        $limit = 20;
		
		$sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){ 
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $brand_id = [91, 88, 90, 73, 48, 44];  
		
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
        
		
        
        
        $id_prod = [
		3414, 3415, 3418, 3426, 3427, 3430, 3431, 3432, 3433, 3435, 3438, 3439, 3440, 3444, 4049, 4050, 4052, 4053, 4054, 4055, 4056, 4057, 4058, 4059, 4060, 4150, /*CHPO*/
		2941, 2936, 2942, 2937, 2943, 2938, 2944, 2939, 2940, 3931, 3696, 3932, 3697, 3933, 3799, 3934, 3800, 3935, 3926, 3927, 3928, 3929, /*Fitbit*/
		3360, 3361, 3362, 3363, 3364, 3365, 3366, 3367, 3368, 3369, 3370, 3371, 3372, 3373, 3374, 3375, 3377, 3379, 3474, 3475, /*Beu*/
		835, 841, 861, 862, 867, 868, 869, 953, 959, 1100, 1101, 1102, 1108, 1118, 1119, 1120, 1122, 1139, 1141, 1166, 1167, 1403, 1406, 1407, 1417, 1419, 1421, 1422, 1423, 1462, 1464, 1467, 1468, 1470, 1471, 1475, 1477, 1483, 1610, 1634, 1635, 1639, 1642, 1645, 1647, 1652, 1654, 1659, 1660, 1662, 1687, 1694, 1695, 1697, 1698, 1701, 1704, 1707, 1709, 1759, 1760, 1761, 1762, 1768, 1769, 1771, 1772, 1773, 1774, 1779, 1780, 1781, 1782, 1783, 1784, 1785, 1795, 1991, 1995, 1996, 1997, 1998, 1999, 2000, 2001, 2002, 2003, 2004, 2007, 2008, 2009, 2012, 2016, 2017, 2018, 2019, 2020, 2021, 2023, 2025, 2256, 2258, 2259, 2260, 2261, 2262, 2263, 2264, 2265, 2268, 2270, 2271, 2272, 2273, 2277, 2278, 2279, 2280, 2281, 2282, 2283, 2286, 2287, 2317, 2412, 2414, 2415, 2416, 2417, 2418, 2421, 2427, 2428, 2429, 2430, 2431, 2432, 2433, 2434, 2435, 2436, 2438, 2479, 2636, 2638, 2639, 2642, 2643, 2644, 2645, 2647, 2648, 2654, 2655, 2656, 2659, 2660, 2661, 2665, 2666, 2854, 2855, 2856, 2859, 2860, 2861, 2862, 2864, 2865, 2867, 2870, 2875, 2876, 2877, 2878, 2879, 2880, 2882, 2885, 2889, 2890, 2892, 2894, 2896, 2899, 3228, 3229, 3231, 3232, 3233, 3498, 3500, 3502, 3654, 3655, 3656, 3709, /*OB*/
		2707, 2708, 2709, 2710, 2793, 2769, 2795, 2770, 2831, 2771, 2826, 2772, 2827, 2773, 3239, 2774, 3310, 2775, 2832, 2776, 3237, 2777, 3216, 2778, 2779, 2780, 2781, 2782, 2796, 2783, 3240, 2784, 2798, 2785, 4022, 2786, 4023, 2787, 2788, 2789, 2790, 2791, 2828, 2792, 2829, 2799, 2800, 3219, 3220, 2801, 3238, 2802, 2803, 2804, 2805, 2830, 2806, 2984, 2807, 2833, 2808, 2809, 2810, 3217, 2811, 2812, 2813, 3218, 2814, 2815, 2816, 2817, 2818, 2819, 2820, 2821, 2822, 2823, 2835, 2836, 2837, 2838, 2839, 2840, 2841, 2842, 2843, 2844, 2845, 3221, 3222, 3311, 3224, 3315, 4036, 4031, 4034, 4032, 4035, 4033, 4039, 4037, 4038, /*OB Jewel*/
		804, 805, 812, 813, 814, 815, 816, 818, 819, 820, 821, 822, 823, 824, 825, 826, 827, 828, 830, 831, 832, 834, 840, 842, 845, 853, 854, 856, 870, 871, 872, 873, 874, 875, 876, 877, 879, 880, 881, 884, 1060, 1061, 1062, 1063, 1064, 1125, 1126, 1127, 1128, 1129, 1315, 1316, 1317, 1318, 1319, 1320, 1321, 1322, 1323, 1324, 1325, 1326, 1484, 1485, 1486, 1487, 1488, 1489, 1491, 1492, 1493, 1495, 1496, 1497, 1498, 1500, 1501, 1502, 1503, 1505, 1506, 1507, 1508, 1509, 1688, 1689, 1731, 1732, 1734, 1735, 1736, 1737, 1741, 1742, 1743, 1744, 1745, 1746, 1747, 1748, 1749, 1750, 1751, 1786, 1787, 1788, 1789, 1790, 1791, 1792, 1793, 1794, 1796, 1797, 1798, 1799, 1801, 1802, 1803, 1804, 1805, 1806, 1807, 1808, 1809, 2048, 2049, 2090, 2091, 2092, 2093, 2095, 2096, 2097, 2098, 2099, 2100, 2101, 2102, 2103, 2104, 2105, 2106, 2107, 2108, 2109, 2110, 2111, 2112, 2113, 2114, 2115, 2116, 2168, 2170, 2171, 2172, 2173, 2520, 2521, 2522, 2523, 2524, 2525, 2526, 2527, 2528, 2529, 2530, 2531, 2533, 2534, 2535, 2536, 2538, 2539, 2540, 2541, 2542, 2543, 2544, 2545, 2546, 2547, 2548, 2549, 2550, 2551, 2552, 2553, 2554, 2555, 2556, 2557, 2558, 2559, 2560, 2616, 2617, 2618, 2619, 2620, 2621, 2622, 2623, 2624, 2625, 2626, 2627, 2699, 2700, 2701, 2702, 2703, 2704, 2705, 2706, 2849, 2985, 2986, 2987, 2988, 2989, 2992, 2994, 2995, 2996, 2997, 2998, 2999, 3000, 3001, 3005, 3006, 3007, 3008, 3123, 3124, 3125, 3126, 3127, 3128, 3129, 3130, 3131, 3132, 3133, 3134, 3135, 3136, 3137, 3138, 3139, 3141, 3142, 3143, 3144, 3145, 3146, 3147, 3148, 3149, 3150, 3151, 3152, 3153, 3154, 3155, 3156, 3157, 3158, 3159, 3160, 3161, 3162, 3167, 3168, 3169, 3170, 3171, 3172, 3173, 3174, 3176, 3177, 3201, 3202, 3203, 3211, 3213, 3214, 3215, 3287, 3288, 3289, 3290, 3295, 3296, 3297, 3298, 3299, 3937, 3938, 3939, 3940, 3941, 3942, 3943, 3944, 3945, 3946, 3947, 3948, 3949, 3950, 3951, 3952, 3953, 3954, 3955, 3957, 3958, 3959, 3960, 3961, 3962, 3965, 3967 /*TIMEX*/
		]; 
        // $id_prod = $this->actionIdproduct($brand_id,$id_prod);
            // query product and filter
        // $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
		
		
		 $products = \backend\models\Product::getProductCustomForFlashSale(
                  [
                      "product.brands_brand_id" => $brand_id,
                      'product.active' => 1,
                      'product.product_id'=> $id_prod,
                  ],$page,$limit,$sortby
              );
			  
			  
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
        $this->title = 'Berbagi Waktu - The Watch Co.';
		
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Promo Berbagi Waktu']);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'Berbagi Waktu - The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Berbagi Waktu - The Watch Co.']);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Berbagi Waktu - The Watch Co.' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Promo Berbagi Waktu' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Berbagi Waktu - The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/berbagiwaktu']);
        // \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/event/seo-share.jpg' ]);

        // $model = \backend\models\KontesSeoContent::find()->where(['id'=>1])->one();
        return $this->render('flash-nov-cek', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
	}
	
	public function actionFlashNov(){
		 
		$start = 0;
        $limit = 20;
		
		$sort = 'none';
		if(isset($_GET['sortby'])){
		  $sort = $_GET['sortby'];
		}
		
        $sortby = 'priority ASC';
		
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $brand_id = [91, 88, 90, 73, 48, 44, 9, 26, 8, 79, 59, 4, 1, 5, 6, 31, 72];   
		
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          

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
        
		
        
        
        $id_prod11 = [
			
			
		]; 
		
		$id_prod12 = [
			
			
		]; 
		
		$id_prod13 = [
			3438, 3439, 3440, 3427, 3414, 3415, 3418, 4150, 3697, 3799, 3926, 3927, 3928, 3929, 3374, 3375, 3377, 3379, 3474, 3475, 4071, 4072, 4073, 4074, 4075, 1610, 1634, 1645, 1647, 1652, 1660, 1694, 1695, 1697, 1704, 1707, 1759, 1769, 1771, 1772, 1783, 1784, 1785, 1996, 1998, 1999, 2000, 2001, 2002, 2003, 2004, 2007, 2008, 2009, 2012, 2020, 2021, 2264, 2265, 2268, 2272, 2273, 2279, 2280, 2281, 2282, 2283, 2287, 2417, 2427, 2428, 2432, 2433, 2434, 2435, 2436, 2438, 2636, 2645, 2647, 2648, 2656, 2659, 2660, 2854, 2855, 2856, 2864, 2865, 2867, 2880, 2882, 2892, 2894, 3228, 3229, 3231, 3232, 3502, 3654, 3655, 3656, 3709, 2808, 2809, 2810, 2811, 2812, 2813, 2814, 2815, 2816, 2817, 2818, 2819, 2820, 2821, 2822, 2823, 2835, 2836, 2837, 2838, 2839, 2840, 2841, 2842, 2843, 2844, 2845, 3221, 3222, 3311, 3224, 3315, 4036, 4031, 4034, 4032, 4035, 4033, 4039, 4037, 4038, 2520, 2521, 2522, 2523, 2524, 2525, 2526, 2527, 2528, 2529, 2530, 2531, 2533, 2534, 2535, 2536, 2538, 2539, 2540, 2541, 2542, 2543, 2544, 2545, 2546, 2547, 2548, 2549, 2550, 2551, 2552, 2553, 2554, 2555, 2556, 2557, 2558, 2559, 2560, 2616, 2617, 2618, 2619, 2620, 2621, 2622, 2623, 2624, 2625, 2626, 2627, 2699, 2700, 2701, 2702, 2703, 2704, 2705, 2706, 2849, 2985, 2986, 2987, 2988, 2989, 2992, 2994, 2995, 2996, 2997, 2998, 2999, 3000, 3001, 3005, 3006, 3007, 3008, 3201, 3202, 3203, 3211, 3213, 3214, 3215, 3287, 3288, 3289, 3290, 3295, 3296, 3297, 3298, 3299, 3939, 3940, 3941, 3942, 3943, 3945, 3946, 3947, 3948, 3949, 3950, 3953, 3954, 3955 /*FLASH SALE 13*/
			,4054, 4055, 4056, 4057, 4058, 4059, 4060, 3426, 3431, 2940, 3931, 3696, 3932, 3933, 3934, 3800, 3935, 3367, 3368, 3369, 3370, 3371, 3372, 3373, 3381, 3382, 4068, 4070, 1108, 1417, 1423, 1462, 1464, 1467, 1470, 1475, 1635, 1654, 1659, 1662, 1701, 1762, 1774, 1780, 1781, 1795, 1997, 2017, 2018, 2019, 2023, 2025, 2259, 2260, 2261, 2262, 2263, 2278, 2286, 2317, 2414, 2415, 2416, 2418, 2430, 2431, 2642, 2643, 2644, 2654, 2655, 2665, 2666, 2860, 2861, 2862, 2870, 2875, 2876, 2877, 2878, 2879, 2885, 2890, 2899, 3233, 3498, 3500, 2776, 2777, 2778, 2779, 2780, 2782, 2783, 2784, 2785, 2786, 2787, 2788, 2789, 2790, 2791, 2792, 3219, 3220, 2801, 3238, 2802, 2803, 2804, 2805, 2830, 2806, 2984, 2807, 2833, 3217, 3218, 804, 830, 831, 832, 834, 840, 842, 845, 876, 877, 1125, 1126, 1127, 1484, 1485, 1486, 1503, 1505, 1506, 1507, 1508, 1689, 1731, 1732, 1734, 1735, 1736, 1737, 1741, 1742, 1743, 1744, 1745, 1746, 1747, 1748, 1749, 1750, 1751, 1786, 1787, 1788, 1789, 1790, 1791, 1792, 1793, 1794, 1796, 1797, 1798, 1799, 1801, 1802, 1803, 1804, 1805, 1806, 1807, 1808, 1809, 2090, 2091, 2092, 2093, 2095, 2096, 2097, 2098, 2099, 2100, 2101, 2102, 2103, 2104, 2105, 2106, 2107, 2108, 2109, 2110, 2111, 2112, 2113, 2114, 2115, 2116, 2168, 2170, 2171, 2172, 2173, 3123, 3132, 3167, 3168, 3169, 3170, 3171, 3951, 3952, 3957, 3958, 3959, 3960, 3961, 3962, 3965 /*FLAH SALE 12*/
			,4049, 4050, 4052, 4053, 3432, 3433, 3435, 3444, 3430, 2941, 2936, 2942, 2937, 2943, 2938, 2944, 2939, 3360, 3361, 3362, 3363, 3364, 3365, 3366, 2197, 2198, 2199, 2200, 3380, 835, 841, 861, 862, 867, 868, 869, 953, 959, 1100, 1101, 1102, 1118, 1119, 1120, 1122, 1139, 1141, 1166, 1167, 1403, 1406, 1407, 1419, 1421, 1422, 1468, 1471, 1477, 1483, 1639, 1642, 1687, 1698, 1709, 1760, 1761, 1768, 1773, 1779, 1782, 1991, 1995, 2016, 2256, 2258, 2270, 2271, 2277, 2412, 2421, 2429, 2479, 2638, 2639, 2661, 2859, 2889, 2896, 2707, 2708, 2709, 2710, 2793, 2769, 2795, 2770, 2831, 2771, 2826, 2772, 2827, 2773, 3239, 2774, 3310, 2775, 2832, 3237, 3216, 2781, 2796, 3240, 2798, 4022, 4023, 2828, 2829, 2799, 2800, 805, 812, 813, 814, 815, 816, 818, 819, 820, 821, 822, 823, 824, 825, 826, 827, 828, 853, 854, 856, 870, 871, 872, 873, 874, 875, 879, 880, 881, 884, 1060, 1061, 1062, 1063, 1064, 1128, 1129, 1315, 1316, 1317, 1318, 1319, 1320, 1321, 1322, 1323, 1324, 1325, 1326, 1487, 1488, 1489, 1491, 1492, 1493, 1495, 1496, 1497, 1498, 1500, 1501, 1502, 1509, 1688, 2048, 2049, 3124, 3125, 3126, 3127, 3128, 3129, 3130, 3131, 3133, 3134, 3135, 3136, 3137, 3138, 3139, 3141, 3142, 3143, 3144, 3145, 3146, 3147, 3148, 3149, 3150, 3151, 3152, 3153, 3154, 3155, 3156, 3157, 3158, 3159, 3160, 3161, 3162, 3172, 3173, 3174, 3176, 3177, 3938, 3944, 3967 /*FLASH SALE 11*/
			,360, 340, 331, 330, 323, 317, 358, 537, 245, 241, 231, 252, 251, 205, 227, 226, 787, 796, 141, 135, 146, 316, 346, 352, 354 /*HYPERGRAND*/
			,418, 419, 407, 394, 401, 408 /*Uniform Wares*/
			,1155, 1177, 264, 1154, 271, 266, 267, 273, 1158, 1153, 1143 /*Void*/
			,3256, 3257, 2613, 2615, 2629, 2606, 2608, 2609, 2611, 2458, 2451, 2610, 2453, 2455, 2381, 2213, 2382, 2231, 2243, 2253, 2210, 2212, 2221, 2222, 2202, 2203, 2205, 3121, 3192, 3195, 3197, 3199, 3253, 3255, 3254, 3249, 2141, 2227, 2387, 2144, 3245 /*KOMONO*/
			,1070 /*GREYHOURS*/
			,177, 178, 207, 1811, 42, 1810, 203, 222, 223, 181, 1815, 212, 182 /*BRAUN*/
			,299, 193, 300 /*AARK*/
			,1691, 903, 916, 901 /*EASTPAK*/
			,1564, 1618, 1619, 1620, 1622, 1623, 1624, 1626, 1627, 1243, 1255, 1256, 1259, 1279, 1260, 1282, 1283, 1241, 1576, 1561, 633, 1204, 1228, 1239, 1631, 1632, 1563, 1565, 1577, 1567, 1569, 1570, 1571, 1572, 1573, 1574, 1240 /*RAINS*/
			,78, 80, 71, 81, 75, 72, 77 /*SQUARESTREET*/
			,1752, 1753, 1754, 1756, 1757, 1758, 1755 /*TID Watches*/
			
		]; 
		
		$now = date("Y-m-d H:i:s");
		
		$id_prod = [];
		
		if ($now > "2019-11-11 00:00:00" && $now < "2019-11-11 15:00:00") {
			$id_prod = $id_prod11; 
		}
		
		if ($now > "2019-11-11 15:00:00" && $now < "2019-11-12 15:00:00") {
			$id_prod = $id_prod12; 
		}
		
		if ($now > "2019-11-12 15:00:00" && $now < "2019-11-13 15:00:00") {
			$id_prod = $id_prod13; 
		}
		
		
		
		
        // $id_prod = $this->actionIdproduct($brand_id,$id_prod);
            // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
		 
		// var_dump($products);
		// exit;
        
        $this->title = 'Waktunya Flash Sale 11.11 - The Watch Co.';
		
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Waktunya Flash Sale 11.11']);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'Waktunya Flash Sale 11.11 - The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Waktunya Flash Sale 11.11 - The Watch Co.']);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Waktunya Flash Sale 11.11 - The Watch Co.' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Waktunya Flash Sale 11.11' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Waktunya Flash Sale 11.11 - The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/flash-sale']);
        // \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/event/seo-share.jpg' ]);

        // $model = \backend\models\KontesSeoContent::find()->where(['id'=>1])->one();
        return $this->render('flash-nov', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
	}
	
	public function actionNewyearsale(){
        
        $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }

        
        $now = date("Y-m-d H:i:s");
        
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
		
        if(isset($_GET['page'])) {
            
            $page = $_GET['page'];
            
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
 
			
            if(isset($_GET['brands'])){
				 

                $brandsName = explode('--', $_GET['brands']);

                 $queryProduct = \backend\models\Product::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection" => function ($query) {
                                        $query->andWhere(['brands_collection_status' => 1]);
                                },
                        "specificPrice",
                        "productImage" => function ($query) {
                                $query->andWhere(['cover' => 1]);
                        }
                ])
                ->where([ 
                    'product.active' => 1
                ])
                ->andWhere(['product.brands_brand_id' => $brandsName])
				// ->andWhere(['product_category_id' => 5])
                ->orderBy($sortby)
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"');
				
                
                $product_count = count($queryProduct->all());
                $products = $queryProduct->offset($start)->limit($limit)->all();
                
            } else {

                $queryProduct = \backend\models\Product::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection" => function ($query) {
                                        $query->andWhere(['brands_collection_status' => 1]);
                                },
                        "specificPrice",
                        "productImage" => function ($query) {
                                $query->andWhere(['cover' => 1]);
                        }
                ])
                ->where([ 
                    'product.active' => 1
                ])
                ->andWhere(['product.brands_brand_id' => [4,16,26,7,8,22,44,85,59,79,72,94,71,5,6]])
				// ->andWhere(['product_category_id' => 5])
                ->orderBy($sortby)
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"');
                
                $product_count = count($queryProduct->all());
                $products = $queryProduct->offset($start)->limit($limit)->all();
            }        
            
            
        } else {
			
            
                $queryProduct = \backend\models\Product::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection" => function ($query) {
                                        $query->andWhere(['brands_collection_status' => 1]);
                                },
                        "specificPrice",
                        "productImage" => function ($query) {
                                $query->andWhere(['cover' => 1]);
                        }
                ])
                ->where([ 
                    'product.active' => 1
                ])
                ->andWhere(['product.brands_brand_id' => [4,16,26,7,8,22,44,85,59,79,72,94,71,5,6]])
				// ->andWhere(['product_category_id' => 5])
                ->orderBy($sortby)
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"');
                
                $product_count = count($queryProduct->all());
                $products = $queryProduct->offset($start)->limit($limit)->all();
        }
        
        // \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dapatkan voucher Rp. 200.000 untuk pembelian jam tangan original di The Watch Co.khusus warga Jakarta yang telah berpartisipasi dalam PILKADA DKI Jakarta 2017']);
        // \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo PILKADA DKI Jakarta 2017']);
        // \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo pilkada, pilkada dki jakarta, pilkada dki 2017, promo pilgub, promo pilgub dki jakarta, pilgub dki 2017, diskon pilkada, diskon pilkada dki 2017, diskon hari ini, promo hari ini']);
        
       // $products = [];
       

        return $this->render('newyear', array("products" => $products, "count" => $product_count, "limit" => $limit, "brands"=>[4,16,26,7,8,22,44,85,59,79,72,94,71,5,6]));
    }
    public function actionMadForLove(){
        
        $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }

        
        $now = date("Y-m-d H:i:s");
        
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
		
        if(isset($_GET['page'])) {
            
            $page = $_GET['page'];
            
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
 
			
            if(isset($_GET['brands'])){
				 

                $brandsName = explode('--', $_GET['brands']);

                 $queryProduct = \backend\models\Product::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection" => function ($query) {
                                        $query->andWhere(['brands_collection_status' => 1]);
                                },
                        "specificPrice",
                        "productImage" => function ($query) {
                                $query->andWhere(['cover' => 1]);
                        }
                ])
                ->where([ 
                    'product.active' => 1
                ])
                ->andWhere(['product.brands_brand_id' => $brandsName])
				// ->andWhere(['product_category_id' => 5])
                ->orderBy($sortby)
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"');
				
                
                $product_count = count($queryProduct->all());
                $products = $queryProduct->offset($start)->limit($limit)->all();
                
            } else {

                $queryProduct = \backend\models\Product::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection" => function ($query) {
                                        $query->andWhere(['brands_collection_status' => 1]);
                                },
                        "specificPrice",
                        "productImage" => function ($query) {
                                $query->andWhere(['cover' => 1]);
                        }
                ])
                ->where([ 
                    'product.active' => 1
                ])
                ->andWhere(['product.brands_brand_id' => [4,16,26,7,8,22,44,85,59,79,72,94,71,5,6]])
				// ->andWhere(['product_category_id' => 5])
                ->orderBy($sortby)
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"');
                
                $product_count = count($queryProduct->all());
                $products = $queryProduct->offset($start)->limit($limit)->all();
            }        
            
            
        } else {
			
            
                $queryProduct = \backend\models\Product::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection" => function ($query) {
                                        $query->andWhere(['brands_collection_status' => 1]);
                                },
                        "specificPrice",
                        "productImage" => function ($query) {
                                $query->andWhere(['cover' => 1]);
                        }
                ])
                ->where([ 
                    'product.active' => 1
                ])
                ->andWhere(['product.brands_brand_id' => [4,16,26,7,8,22,44,85,59,79,72,94,71,5,6]])
				// ->andWhere(['product_category_id' => 5])
                ->orderBy($sortby)
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"');
                
                $product_count = count($queryProduct->all());
                $products = $queryProduct->offset($start)->limit($limit)->all();
        }
        
        // \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dapatkan voucher Rp. 200.000 untuk pembelian jam tangan original di The Watch Co.khusus warga Jakarta yang telah berpartisipasi dalam PILKADA DKI Jakarta 2017']);
        // \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo PILKADA DKI Jakarta 2017']);
        // \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo pilkada, pilkada dki jakarta, pilkada dki 2017, promo pilgub, promo pilgub dki jakarta, pilgub dki 2017, diskon pilkada, diskon pilkada dki 2017, diskon hari ini, promo hari ini']);
        
       // $products = [];
       

        return $this->render('mad-for-love', array("products" => $products, "count" => $product_count, "limit" => $limit, "brands"=>[4,16,26,7,8,22,44,85,59,79,72,94,71,5,6]));
    }
    
	 public function actionValentine(){ 
		// $start = 0;
    //     $limit = 20;
        
    //     $sort = 'none';
    //             if(isset($_GET['sortby'])){
    //               $sort = $_GET['sortby'];
    //             }
    //     $sortby = 'brands.brand_name ASC';
    //     if($sort == 'price-high-to-low'){
    //       $sortby = 'priority DESC';
    //     }if($sort == 'price-low-to-high'){
    //       $sortby = 'priority ASC';
    //     }if($sort == 'none'){
    //       $sortby = 'brands.brand_name ASC';
    //     }

        
    //     $now = date("Y-m-d H:i:s");
        
    //     if(isset($_GET['limit'])){
    //         $limit = $_GET['limit'];
    //     }
		
    //     if(isset($_GET['page'])) {
            
    //         $page = $_GET['page'];
            
    //         $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
 
      
    //         if(isset($_GET['gender'])){

    //         }
            
    //         if(isset($_GET['brands'])){
				 

    //             $brandsName = explode('--', $_GET['brands']);

    //              $queryProduct = \backend\models\Product::find()
    //             ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
    //             ->joinWith([
    //                     "brands",
    //                     "productDetail",
    //                     "brandsCollection" => function ($query) {
    //                                     $query->andWhere(['brands_collection_status' => 1]);
    //                             },
    //                     "specificPrice",
    //                     "productImage" => function ($query) {
    //                             $query->andWhere(['cover' => 1]);
    //                     }
    //             ])
    //             ->where([ 
    //                 'product.active' => 1
    //             ])
    //             ->andWhere(['product.brands_brand_id' => $brandsName])
		// 		// ->andWhere(['product_category_id' => 5])
    //             ->orderBy($sortby)
    //             ->andWhere('specific_price.from <= "'. $now . '"')
    //             ->andWhere('specific_price.to > "'. $now . '"');
                
    //               var_dump($queryProduct->all());
    //               die();
                
    //             $product_count = count($queryProduct->all());
    //             $products = $queryProduct->offset($start)->limit($limit)->all();
                
    //         } else {

    //             $queryProduct = \backend\models\Product::find()
    //             ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
    //             ->joinWith([
    //                     "brands",
    //                     "productDetail",
    //                     "brandsCollection" => function ($query) {
    //                                     $query->andWhere(['brands_collection_status' => 1]);
    //                             },
    //                     "specificPrice",
    //                     "productImage" => function ($query) {
    //                             $query->andWhere(['cover' => 1]);
    //                     }
    //             ])
    //             ->where([ 
    //                 'product.active' => 1
    //             ])
    //             ->andWhere(['product.brands_brand_id' => [4,16,26,7,8,22,44,85,59,72,94,71,48]])
		// 		// ->andWhere(['product_category_id' => 5])
    //             ->orderBy($sortby)
    //             ->andWhere('specific_price.from <= "'. $now . '"')
    //             ->andWhere('specific_price.to > "'. $now . '"');
    //             $product_count = count($queryProduct->all());
    //             $products = $queryProduct->offset($start)->limit($limit)->all();
    //         }        
            
            
    //     } else {
			
            
    //             $queryProduct = \backend\models\Product::find()
    //             ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
    //             ->joinWith([
    //                     "brands",
    //                     "productDetail",
    //                     "brandsCollection" => function ($query) {
    //                                     $query->andWhere(['brands_collection_status' => 1]);
    //                             },
    //                     "specificPrice",
    //                     "productImage" => function ($query) {
    //                             $query->andWhere(['cover' => 1]);
    //                     }
    //             ])
    //             ->where([ 
    //                 'product.active' => 1
    //             ])
    //             ->andWhere(['product.brands_brand_id' => [4,16,26,7,8,22,44,85,59,72,94,71,48]])
		// 		// ->andWhere(['product_category_id' => 5])
    //             ->orderBy($sortby)
    //             ->andWhere('specific_price.from <= "'. $now . '"')
    //             ->andWhere('specific_price.to > "'. $now . '"');
                
    //             $product_count = count($queryProduct->all());
    //             $products = $queryProduct->offset($start)->limit($limit)->all();
    //     }
        
    //     // \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dapatkan voucher Rp. 200.000 untuk pembelian jam tangan original di The Watch Co.khusus warga Jakarta yang telah berpartisipasi dalam PILKADA DKI Jakarta 2017']);
    //     // \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo PILKADA DKI Jakarta 2017']);
    //     // \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo pilkada, pilkada dki jakarta, pilkada dki 2017, promo pilgub, promo pilgub dki jakarta, pilgub dki 2017, diskon pilkada, diskon pilkada dki 2017, diskon hari ini, promo hari ini']);
        
    //    // $products = [];
       
    //     // $model = \backend\models\KontesSeoContent::find()->where(['id'=>1])->one();
    //     return $this->render('valentine', array("products" => $products, "count" => $product_count, "limit" => $limit, "brands"=>[48, 44, 85, 94, 99, 6]));

        $start = 0;
        $limit = 20;
        
        $now = date("Y-m-d H:i:s");
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }
        
        $brand_id = [48, 44, 85, 94, 99, 6];
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
            
        $id_prod = [];
          $spec_price = \backend\models\SpecificPrice::find()
          ->where('specific_price.from <= "'. $now . '"')
          ->andWhere('specific_price.to > "'. $now . '"')
            ->all();
          $p = 0;
          $id_prod2 = [];
            foreach($spec_price as $spec_prices){
              $id_prod2[$p] = $spec_prices->product_id;
                  $p++;
            }
             // print_r($id_prod2);die();
          $results = \backend\models\Product::find()->where(['brands_brand_id'=>[48, 44, 85, 94, 99, 6]])->all(); 

          $p = 0;
            foreach($results as $result){
              $id_prod[$p] = $result->product_id;
                  $p++;
            }
            
         
              // print_r($id_prod);die();
              // $id_prod = [2,3,4,5,6,7,8,9,10,2054];
              
          // get all id product
          $id_prod = $this->actionIdproductintersect($brand_id,$id_prod2);
        // print_r($id_prod);die();
                // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
        
        
        // \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Promo diskon akhir tahun 2017 di The Watch Co. Manfaatkan potongan harga sampai 60% untuk produk jam tangan dan aksesoris pria & wanita. Beli sekarang!']);
        // \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Diskon Akhir Tahun 2017 – The Watch Co.']);
        // \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo pilkada, pilkada dki jakarta, pilkada dki 2017, promo pilgub, promo pilgub dki jakarta, pilgub dki 2017, diskon pilkada, diskon pilkada dki 2017, diskon hari ini, promo hari ini']);
        
       // $products = [];

       return $this->render('valentine', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));

	}
	
	public function actionFlashBrand(){
	    
        $event_name = 'Flash Sale';
        $start = 0;
        $limit = 100;
        $current_date = date('Y-m-d H:i:s');
		// $current_date = '2020-01-27 15:00:00';
		
		
        // $arr_batch = array('11:00:00', '16:00:00', '11:00:00', '16:00:00');
        $arr_batch = array('00:00:00', '23:59:00');
        $start_date = '2020-05-11 '.$arr_batch[0];
        $end_date = '2020-05-11 '.$arr_batch[1];
		$time_actived = 0;
		$total_sale = 0;
		$brands = array(94, 48, 79, 44, 85);
        // $category = array(5,12);
        $products = array();
		
		$product5 = array(
		    803, 804, 805, 806, 807, 808, 809, 810, 811, 812, 813, 814, 815, 816, 817, 818, 819, 820, 821, 822, 823, 824, 825, 826, 827, 828, 830, 831, 832, 834, 835, 840, 
		    841, 842, 845, 847, 848, 849, 850, 851, 852, 853, 854, 855, 856, 859, 861, 862, 867, 868, 869, 870, 871, 872, 873, 874, 875, 876, 877, 879, 880, 881, 883, 884, 
		    885, 889, 953, 959, 1022, 1060, 1061, 1062, 1063, 1064, 1065, 1066, 1100, 1101, 1102, 1108, 1117, 1118, 1119, 1122, 1125, 1126, 1127, 1128, 1129, 1130, 1132, 
		    1138, 1139, 1141, 1164, 1166, 1167, 1315, 1316, 1317, 1318, 1319, 1320, 1321, 1322, 1323, 1324, 1325, 1326, 1407, 1412, 1417, 1419, 1421, 1422, 1423, 1424, 
		    1426, 1428, 1429, 1430, 1431, 1462, 1464, 1467, 1470, 1471, 1475, 1476, 1477, 1479, 1483, 1484, 1485, 1486, 1487, 1488, 1489, 1490, 1491, 1492, 1493, 1494, 
		    1495, 1496, 1497, 1498, 1499, 1500, 1501, 1502, 1503, 1505, 1506, 1507, 1508, 1509, 1579, 1608, 1610, 1634, 1639, 1642, 1645, 1647, 1652, 1654, 1656, 1659, 
		    1660, 1661, 1662, 1664, 1687, 1688, 1689, 1694, 1695, 1697, 1698, 1699, 1701, 1704, 1707, 1709, 1714, 1731, 1732, 1733, 1734, 1735, 1736, 1737, 1738, 1741, 
		    1742, 1743, 1744, 1745, 1746, 1747, 1748, 1749, 1750, 1751, 1759, 1760, 1762, 1768, 1769, 1771, 1772, 1773, 1774, 1779, 1780, 1781, 1782, 1783, 1785, 1786, 
		    1787, 1788, 1789, 1790, 1791, 1792, 1793, 1794, 1796, 1797, 1798, 1799, 1800, 1801, 1802, 1803, 1804, 1805, 1806, 1807, 1808, 1809, 1991, 1995, 1996, 1997, 
		    1998, 1999, 2000, 2001, 2002, 2004, 2007, 2008, 2009, 2011, 2012, 2013, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2025, 2042, 2043, 2044, 2045, 2046, 
		    2048, 2049, 2090, 2091, 2092, 2093, 2094, 2095, 2096, 2097, 2098, 2099, 2100, 2101, 2102, 2103, 2104, 2105, 2106, 2107, 2108, 2109, 2110, 2111, 2112, 2113, 
		    2114, 2115, 2116, 2168, 2169, 2170, 2171, 2172, 2173, 2195, 2254, 2256, 2258, 2259, 2260, 2261, 2262, 2263, 2264, 2265, 2268, 2269, 2271, 2272, 2273, 2274, 
		    2275, 2276, 2277, 2278, 2279, 2280, 2281, 2282, 2283, 2284, 2285, 2286, 2317, 2318, 2412, 2413, 2414, 2415, 2416, 2421, 2423, 2424, 2425, 2427, 2428, 2429, 
		    2430, 2431, 2432, 2433, 2434, 2436, 2438, 2439, 2479, 2493, 2520, 2521, 2522, 2523, 2524, 2525, 2526, 2527, 2528, 2529, 2530, 2531, 2532, 2533, 2534, 2535, 
		    2536, 2537, 2538, 2539, 2540, 2541, 2542, 2543, 2544, 2545, 2546, 2547, 2548, 2549, 2550, 2551, 2552, 2553, 2554, 2555, 2556, 2557, 2558, 2559, 2560, 2616, 
		    2617, 2618, 2619, 2620, 2621, 2622, 2623, 2624, 2625, 2626, 2627, 2636, 2637, 2638, 2639, 2640, 2641, 2642, 2643, 2644, 2645, 2647, 2648, 2651, 2653, 2654, 
		    2655, 2656, 2657, 2659, 2660, 2663, 2665, 2666, 2699, 2700, 2701, 2702, 2704, 2705, 2706, 2708, 2709, 2769, 2771, 2772, 2773, 2774, 2775, 2778, 2779, 2780, 
		    2781, 2784, 2785, 2790, 2791, 2792, 2797, 2798, 2799, 2800, 2802, 2803, 2805, 2807, 2810, 2811, 2812, 2813, 2814, 2815, 2817, 2819, 2820, 2821, 2828, 2829, 
		    2830, 2840, 2841, 2842, 2843, 2844, 2849, 2851, 2852, 2853, 2854, 2855, 2856, 2858, 2859, 2860, 2861, 2862, 2863, 2864, 2865, 2866, 2869, 2870, 2872, 2873, 
		    2874, 2875, 2876, 2877, 2878, 2879, 2880, 2881, 2882, 2883, 2885, 2889, 2890, 2894, 2895, 2896, 2899, 2985, 2986, 2987, 2988, 2989, 2990, 2991, 2992, 2994, 
		    2995, 2996, 2997, 2998, 2999, 3000, 3001, 3002, 3003, 3004, 3005, 3006, 3007, 3008, 3123, 3124, 3125, 3126, 3127, 3128, 3129, 3130, 3131, 3132, 3133, 3134, 
		    3135, 3136, 3137, 3138, 3139, 3140, 3141, 3142, 3143, 3144, 3145, 3146, 3147, 3148, 3149, 3150, 3151, 3152, 3153, 3154, 3155, 3156, 3157, 3158, 3159, 3160, 
		    3161, 3162, 3167, 3168, 3169, 3170, 3171, 3172, 3173, 3174, 3175, 3176, 3177, 3178, 3179, 3180, 3187, 3188, 3189, 3190, 3191, 3201, 3202, 3203, 3204, 3205, 
		    3206, 3207, 3208, 3209, 3210, 3211, 3212, 3213, 3214, 3215, 3220, 3221, 3225, 3226, 3227, 3228, 3229, 3230, 3231, 3232, 3233, 3234, 3235, 3236, 3238, 3285, 
		    3286, 3287, 3288, 3289, 3290, 3291, 3292, 3293, 3294, 3295, 3296, 3297, 3298, 3299, 3301, 3304, 3305, 3306, 3308, 3309, 3311, 3312, 3313, 3314, 3315, 3445, 
		    3446, 3447, 3448, 3449, 3450, 3451, 3452, 3453, 3454, 3455, 3456, 3457, 3460, 3461, 3462, 3463, 3464, 3465, 3466, 3467, 3468, 3469, 3470, 3471, 3472, 3473, 
		    3476, 3477, 3478, 3479, 3480, 3481, 3482, 3483, 3484, 3485, 3486, 3487, 3488, 3489, 3490, 3491, 3492, 3493, 3494, 3495, 3496, 3498, 3499, 3500, 3501, 3502, 
		    3503, 3504, 3572, 3650, 3651, 3652, 3653, 3654, 3655, 3656, 3700, 3702, 3704, 3705, 3706, 3708, 3709, 3710, 3711, 3712, 3713, 3714, 3716, 3717, 3718, 3729, 
		    3730, 3731, 3732, 3733, 3734, 3735, 3736, 3737, 3738, 3739, 3744, 3937, 3938, 3939, 3940, 3941, 3942, 3943, 3944, 3945, 3946, 3947, 3948, 3949, 3950, 3951, 
		    3952, 3953, 3954, 3955, 3957, 3958, 3959, 3960, 3961, 3962, 3965, 3966, 3967, 3968, 3970, 3971, 3973, 3974, 3977, 3980, 3982, 4022, 4023, 4024, 4027, 4031, 
		    4032, 4033, 4034, 4035, 4036, 4037, 4038, 4039, 4043, 4044, 4077, 4078, 4079, 4080, 4081, 4082, 4083, 4084, 4085, 4086, 4087, 4088, 4089, 4090, 4091, 4092, 
		    4093, 4094, 4095, 4096, 4097, 4098, 4099, 4100, 4102, 4103, 4104, 4105, 4106, 4107, 4108, 4109, 4110, 4111, 4112, 4113, 4114, 4115, 4116, 4117, 4118, 4119, 
		    4120, 4124, 4125, 4127, 4128, 4129, 4131, 4132, 4134, 4135, 4136, 4137, 4138, 4139, 4140, 4141, 4142, 4157, 4158, 4159, 4160, 4161, 4163, 4164, 4165, 4186, 
		    4188, 4189, 4190, 4191, 4195, 4196, 4197, 4198, 4199, 4201, 4202, 4203, 4205, 4206, 4207, 4210, 4227, 4231, 4232, 4239, 4241, 4242, 4243, 4244, 4245, 4246, 
		    4247, 4248, 4249, 4303, 4314, 4315, 4316, 4317, 4318, 4319, 4320, 4321, 4322, 4324, 4325, 4326, 4327, 4328, 4331,
		    
		    4253, 383, 2406, 1512, 4252, 1520, 2079, 2063, 2082, 2065, 4255, 2067, 4256, 2068, 3830, 2071, 4257, 2072, 2085, 4258, 4259, 4273, 2080, 4274, 4275, 2084, 4276, 
		    2477, 2405, 4280, 4302, 2408, 3829, 2442, 2473, 4281, 2574, 2576, 2577, 4283, 3831, 4284, 3832, 3834, 4153, 3835, 3836, 3837, 3838, 3839, 3840, 4251, 4285, 4286, 
		    4287, 4260, 4261, 4263, 4264, 4288, 4265, 4266, 4267, 4272, 4268, 4300, 4269, 4270, 4271, 4277, 4299, 4298, 4290, 4291, 4292, 4293, 4294, 4295, 4296, 4297, 4279, 
		    4278, 2075, 2076
		);
    
		
		if(date("Y-m-d", strtotime($current_date)) == "2020-05-11"){
			$start_date_product = '2020-05-11 '.$arr_batch[0];
			$end_date_product = '2020-05-11 '.$arr_batch[1];
			$product = $product5;
		}else{
			$start_date_product = '';
			$end_date_product = '';
			$product = array();
		}
		
// 		$banner_desktop = 'promo/flash/Flash Sale OB Jan_Home Banner_Desktop?auto=compress%2Cformat&fm=pjpg';
//         $banner_mobile = 'promo/flash/Flash Sale OB Jan_Home Banner_Mobile?auto=compress%2Cformat&fm=pjpg';
		$days = 0;
        $countdown_sale = '';
        $countdown_pre_sale = '';

        $sort = 'none';
        if(isset($_GET['sortby'])){
            $sort = $_GET['sortby'];
        }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
            $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
            $sortby = 'priority ASC';
        }if($sort == 'none'){
            $sortby = 'priority ASC';
        }

        $page = 1;
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

        $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
        
        if( ($current_date >= $start_date) && ($current_date <= $end_date) ){
            
            $time_actived = 1;
            $countdown_sale = date("D M j Y H:i:s", strtotime( date($end_date)) );
            $products = Product::getProductFlashSaleNew($brands, $category, $start_date_product, $end_date_product, $product, $start, $limit, "");
            

        }
		
        if( ($current_date < $start_date) ){
            $diff = abs(strtotime($start_date) - strtotime($current_date));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            if( $days >= 0 && $days <= 6 ){
                $countdown_pre_sale = date("D M j Y H:i:s", strtotime( date($start_date) ));
                $products = Product::getProductFlashSaleNew($brands, $category, $start_date_product, $end_date_product, $product, $start, $limit, "");
            }
        }
          

        $this->title = $event_name.' – The Watch Co.';
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => $this->title]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Manfaatkan promo flash sale untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Manfaatkan promo flash sale untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => $this->title]);
        \Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);
        
        return $this->render('flash-brand', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page, 
            "brands"=>$brands, "current_date"=>$current_date, "start_date"=>$start_date, "end_date"=>$end_date, "arr_batch"=>$arr_batch, 
            "countdown_sale"=>$countdown_sale, "countdown_pre_sale"=>$countdown_pre_sale, "time_active"=>$time_actived));
    }
    
    public function actionApril(){
	    

    // 		    4155, 3256, 3257, 3197, 3199, 3192, 2629, 2615, 2613, 2610, 2609, 2458, 2455, 2453, 2382, 2243, 2205, 2202, 2221, 2213, 916, 1577, 1576, 1632, 1631, 1563, 1565, 1239, 1243, 1569, 1570, 1571, 1256, 1279, 1282, 1283, 1284, 1259, 1260, 1618, 1622, 1623, 1204, 2212, 3121, 1627, 2611, 1574, 2608, 2253, 1624, 1620, 1619, 2717, 2719, 3749, 3758, 3479, 3482, 3462, 3463, 3464, 3465, 3467, 3466, 3468, 3456, 3489, 3457, 3490, 3470, 3471, 3483, 3476, 3472, 3445, 3446, 3448, 3450, 3451, 4210, 3447, 3492, 3453, 3493, 3455, 2532, 2536, 2539, 4321, 4322, 3000, 2989, 3299, 3003, 3004, 3204, 3205, 3206, 2990, 3288, 3207, 3208, 3209, 4316, 4189, 4188, 3203, 2094, 1572, 1567, 1325, 3485, 4195, 2999, 2254, 2715, 2720, 2718, 1697, 3228, 3229, 3709, 3708, 2278, 2317, 2858, 1774, 2264, 2280, 2283, 2273, 4124, 2896, 3700, 3304, 3704, 2436, 2284, 2653, 3716, 4202, 4132, 3982, 3712, 4135, 4136, 4137, 3980, 1579, 2730, 2731, 2734, 2735, 3789, 3742, 3750, 3752, 3769, 3771, 3775, 3759, 2763, 2764, 2765, 2721, 4201, 4197, 3306, 3234, 2877, 2439, 2256, 2169, 869, 2421, 3473, 2768, 2779, 4125, 3210, 4141, 3301, 2991, 3977, 4129, 4231, 2637, 2853, 4239, 4199, 4241, 3295, 3289, 2528, 2529, 2530, 2531, 2554, 2708, 2709, 2769, 2770, 2771, 2772, 2773, 2780, 2778, 2776, 2760, 2761, 2762, 2711, 2713, 2712, 2759
            
        
        $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }

        
        $now = date("Y-m-d H:i:s");
        
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
		
        if(isset($_GET['page'])) {
            
            $page = $_GET['page'];
            
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
 
			
            if(isset($_GET['brands'])){
				 

                $brandsName = explode('--', $_GET['brands']);

                 $queryProduct = \backend\models\Product::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection" => function ($query) {
                                        $query->andWhere(['brands_collection_status' => 1]);
                                },
                        "specificPrice",
                        "productImage" => function ($query) {
                                $query->andWhere(['cover' => 1]);
                        }
                ])
                ->where([ 
                    'product.active' => 1
                ])
                ->andWhere(['product.brands_brand_id' => $brandsName])
				// ->andWhere(['product_category_id' => 5])
                ->orderBy($sortby)
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"');
				
                
                $product_count = count($queryProduct->all());
                $products = $queryProduct->offset($start)->limit($limit)->all();
                
            } else {

                $queryProduct = \backend\models\Product::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection" => function ($query) {
                                        $query->andWhere(['brands_collection_status' => 1]);
                                },
                        "specificPrice",
                        "productImage" => function ($query) {
                                $query->andWhere(['cover' => 1]);
                        }
                ])
                ->where([ 
                    'product.active' => 1
                ])
                ->andWhere(['product.brands_brand_id' => [4,16,26,7,8,22,44,85,59,79,72,94,71,5,6,48]])
				// ->andWhere(['product_category_id' => 5])
                ->orderBy($sortby)
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"');
                
                $product_count = count($queryProduct->all());
                $products = $queryProduct->offset($start)->limit($limit)->all();
            }        
            
            
        } else {
			
            
                $queryProduct = \backend\models\Product::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection" => function ($query) {
                                        $query->andWhere(['brands_collection_status' => 1]);
                                },
                        "specificPrice",
                        "productImage" => function ($query) {
                                $query->andWhere(['cover' => 1]);
                        }
                ])
                ->where([ 
                    'product.active' => 1
                ])
                ->andWhere(['product.brands_brand_id' => [4,16,26,7,8,22,44,85,59,79,72,94,71,5,6,48]])
				// ->andWhere(['product_category_id' => 5])
                ->orderBy($sortby)
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"');
                
                $product_count = count($queryProduct->all());
                $products = $queryProduct->offset($start)->limit($limit)->all();
        }
        
        // \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dapatkan voucher Rp. 200.000 untuk pembelian jam tangan original di The Watch Co.khusus warga Jakarta yang telah berpartisipasi dalam PILKADA DKI Jakarta 2017']);
        // \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo PILKADA DKI Jakarta 2017']);
        // \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo pilkada, pilkada dki jakarta, pilkada dki 2017, promo pilgub, promo pilgub dki jakarta, pilgub dki 2017, diskon pilkada, diskon pilkada dki 2017, diskon hari ini, promo hari ini']);
        
       // $products = [];
       

        return $this->render('april', array("products" => $products, "count" => $product_count, "limit" => $limit, "brands"=>[48, 5, 6, 44, 79, 85, 94]));
    }
    
        public function actionRamadhanSale(){
        
        $start = 0;
        $limit = 20;
        
        $sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'brands.brand_name ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'brands.brand_name ASC';
        }

        
        $now = date("Y-m-d H:i:s");
        
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
		
        if(isset($_GET['page'])) {
            
            $page = $_GET['page'];
            
            $page === '2' ? $start = $limit : $start = ((int)$page - 1) * $limit;
 
			
            if(isset($_GET['brands'])){
				 

                $brandsName = explode('--', $_GET['brands']);

                 $queryProduct = \backend\models\Product::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection" => function ($query) {
                                        $query->andWhere(['brands_collection_status' => 1]);
                                },
                        "specificPrice",
                        "productImage" => function ($query) {
                                $query->andWhere(['cover' => 1]);
                        }
                ])
                ->where([ 
                    'product.active' => 1
                ])
                ->andWhere(['product.brands_brand_id' => $brandsName])
				// ->andWhere(['product_category_id' => 5])
                ->orderBy($sortby)
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"');
				
                
                $product_count = count($queryProduct->all());
                $products = $queryProduct->offset($start)->limit($limit)->all();
                
            } else {

                $queryProduct = \backend\models\Product::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection" => function ($query) {
                                        $query->andWhere(['brands_collection_status' => 1]);
                                },
                        "specificPrice",
                        "productImage" => function ($query) {
                                $query->andWhere(['cover' => 1]);
                        }
                ])
                ->where([ 
                    'product.active' => 1
                ])
                ->andWhere(['product.brands_brand_id' => [4,16,26,7,8,22,44,85,59,79,72,94,71,5,6,48]])
				// ->andWhere(['product_category_id' => 5])
                ->orderBy($sortby)
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"');
                
                $product_count = count($queryProduct->all());
                $products = $queryProduct->offset($start)->limit($limit)->all();
            }        
            
            
        } else {
			
            
                $queryProduct = \backend\models\Product::find()
                ->select('*, IF(specific_price.from <= "'. $now . '" && specific_price.to > "'. $now . '", IF(specific_price.reduction<=100, product.price - (specific_price.reduction / 100) * product.price , (product.price - specific_price.reduction)), (product.price)) as priority')
                ->joinWith([
                        "brands",
                        "productDetail",
                        "brandsCollection" => function ($query) {
                                        $query->andWhere(['brands_collection_status' => 1]);
                                },
                        "specificPrice",
                        "productImage" => function ($query) {
                                $query->andWhere(['cover' => 1]);
                        }
                ])
                ->where([ 
                    'product.active' => 1
                ])
                ->andWhere(['product.brands_brand_id' => [4,16,26,7,8,22,44,85,59,79,72,94,71,5,6,48]])
				// ->andWhere(['product_category_id' => 5])
                ->orderBy($sortby)
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"');
                
                $product_count = count($queryProduct->all());
                $products = $queryProduct->offset($start)->limit($limit)->all();
        }
        
        // \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dapatkan voucher Rp. 200.000 untuk pembelian jam tangan original di The Watch Co.khusus warga Jakarta yang telah berpartisipasi dalam PILKADA DKI Jakarta 2017']);
        // \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo PILKADA DKI Jakarta 2017']);
        // \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo pilkada, pilkada dki jakarta, pilkada dki 2017, promo pilgub, promo pilgub dki jakarta, pilgub dki 2017, diskon pilkada, diskon pilkada dki 2017, diskon hari ini, promo hari ini']);
        
       // $products = [];
       

        return $this->render('ramadhan-sale', array("products" => $products, "count" => $product_count, "limit" => $limit, "brands"=>[48, 5, 6, 44, 79, 85, 94]));
    }
	
	public function actionPayday(){ 
		$start = 0;
        $limit = 20;
		
		$sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $brand_id = [94, 79, 44 ,48, 85, 99]; 
		
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
        
		
        
        
        $id_prod = [803, 804, 805, 806, 807, 808, 809, 810, 811, 812, 813, 814, 815, 816, 817, 818, 819, 820, 821, 822, 823, 824, 825, 826, 827, 828, 830, 831, 832, 833, 834, 835, 836, 837, 838, 839, 840, 841, 842, 843, 844, 845, 846, 847, 848, 849, 850, 851, 852, 853, 854, 855, 856, 857, 858, 859, 860, 861, 862, 863, 864, 865, 866, 867, 868, 869, 870, 871, 872, 873, 874, 876, 877, 879, 880, 881, 883, 884, 885, 886, 888, 889, 891, 935, 936, 940, 943, 947, 948, 953, 954, 958, 959, 961, 1022, 1060, 1061, 1062, 1063, 1064, 1065, 1066, 1100, 1101, 1102, 1103, 1104, 1105, 1106, 1107, 1108, 1110, 1111, 1114, 1115, 1117, 1118, 1119, 1120, 1122, 1123, 1124, 1125, 1126, 1127, 1128, 1129, 1130, 1132, 1133, 1135, 1137, 1138, 1139, 1140, 1141, 1159, 1160, 1161, 1162, 1163, 1164, 1166, 1167, 1168, 1169, 1172, 1313, 1314, 1315, 1316, 1317, 1318, 1319, 1320, 1321, 1322, 1323, 1324, 1325, 1326, 1397, 1398, 1399, 1400, 1401, 1402, 1403, 1404, 1405, 1406, 1407, 1408, 1409, 1410, 1411, 1412, 1413, 1414, 1415, 1416, 1417, 1418, 1419, 1420, 1421, 1422, 1423, 1424, 1425, 1426, 1427, 1428, 1429, 1430, 1431, 1462, 1463, 1464, 1465, 1466, 1467, 1468, 1469, 1470, 1471, 1472, 1473, 1474, 1475, 1476, 1477, 1478, 1479, 1480, 1481, 1482, 1483, 1484, 1485, 1486, 1487, 1488, 1489, 1490, 1491, 1492, 1493, 1494, 1495, 1496, 1497, 1498, 1499, 1500, 1501, 1502, 1503, 1505, 1506, 1507, 1508, 1509, 1579, 1580, 1585, 1608, 1609, 1610, 1633, 1634, 1635, 1636, 1637, 1638, 1639, 1640, 1641, 1642, 1643, 1644, 1645, 1646, 1647, 1648, 1649, 1650, 1651, 1652, 1653, 1654, 1655, 1656, 1657, 1659, 1660, 1661, 1662, 1663, 1664, 1665, 1685, 1686, 1687, 1688, 1689, 1694, 1695, 1696, 1697, 1698, 1699, 1700, 1701, 1702, 1703, 1704, 1705, 1706, 1707, 1708, 1709, 1710, 1711, 1712, 1713, 1714, 1715, 1733, 1734, 1735, 1736, 1737, 1738, 1741, 1742, 1743, 1744, 1745, 1746, 1747, 1748, 1749, 1759, 1760, 1761, 1762, 1763, 1764, 1765, 1766, 1767, 1768, 1769, 1770, 1771, 1772, 1773, 1774, 1775, 1776, 1777, 1778, 1779, 1780, 1781, 1782, 1783, 1784, 1785, 1786, 1788, 1795, 1797, 1799, 1800, 1801, 1802, 1804, 1805, 1806, 1807, 1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999, 2000, 2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2042, 2043, 2044, 2045, 2046, 2090, 2093, 2094, 2095, 2096, 2103, 2106, 2108, 2112, 2113, 2118, 2119, 2120, 2121, 2122, 2123, 2124, 2125, 2126, 2127, 2128, 2129, 2130, 2131, 2132, 2133, 2134, 2135, 2136, 2137, 2138, 2139, 2140, 2143, 2145, 2146, 2147, 2148, 2149, 2150, 2151, 2152, 2153, 2154, 2155, 2156, 2157, 2158, 2159, 2160, 2161, 2162, 2163, 2164, 2165, 2166, 2167, 2169, 2170, 2195, 2201, 2204, 2206, 2207, 2208, 2209, 2211, 2214, 2215, 2216, 2217, 2218, 2219, 2220, 2223, 2224, 2225, 2226, 2228, 2229, 2230, 2232, 2233, 2234, 2235, 2236, 2237, 2238, 2239, 2240, 2241, 2242, 2244, 2245, 2246, 2247, 2248, 2249, 2250, 2251, 2252, 2254, 2255, 2256, 2257, 2258, 2259, 2260, 2261, 2262, 2263, 2264, 2265, 2266, 2267, 2268, 2269, 2270, 2271, 2272, 2273, 2274, 2275, 2276, 2277, 2278, 2279, 2280, 2281, 2282, 2283, 2284, 2285, 2286, 2287, 2317, 2318, 2378, 2379, 2380, 2383, 2384, 2385, 2386, 2388, 2389, 2390, 2391, 2392, 2393, 2394, 2395, 2396, 2397, 2398, 2411, 2412, 2413, 2414, 2415, 2416, 2417, 2418, 2419, 2420, 2421, 2422, 2423, 2424, 2425, 2426, 2427, 2428, 2429, 2430, 2431, 2432, 2433, 2434, 2435, 2436, 2437, 2438, 2439, 2440, 2445, 2446, 2447, 2449, 2450, 2452, 2454, 2456, 2457, 2459, 2460, 2461, 2462, 2463, 2479, 2532, 2537, 2559, 2560, 2591, 2592, 2593, 2594, 2595, 2596, 2597, 2598, 2599, 2600, 2601, 2602, 2603, 2604, 2605, 2607, 2612, 2614, 2636, 2637, 2638, 2639, 2640, 2641, 2642, 2643, 2644, 2645, 2646, 2647, 2648, 2649, 2650, 2651, 2652, 2653, 2654, 2655, 2656, 2657, 2658, 2659, 2660, 2661, 2663, 2664, 2665, 2666, 2707, 2708, 2709, 2710, 2722, 2724, 2725, 2726, 2727, 2728, 2729, 2730, 2731, 2732, 2733, 2736, 2737, 2738, 2739, 2741, 2742, 2743, 2744, 2745, 2746, 2747, 2748, 2749, 2750, 2751, 2752, 2753, 2754, 2755, 2756, 2757, 2758, 2766, 2769, 2770, 2771, 2772, 2773, 2774, 2775, 2776, 2777, 2778, 2779, 2780, 2781, 2782, 2783, 2784, 2785, 2786, 2787, 2788, 2789, 2790, 2791, 2792, 2793, 2794, 2795, 2796, 2797, 2798, 2799, 2800, 2801, 2802, 2803, 2804, 2805, 2806, 2807, 2808, 2809, 2810, 2811, 2812, 2813, 2814, 2815, 2816, 2817, 2818, 2819, 2820, 2821, 2822, 2823, 2824, 2826, 2827, 2828, 2829, 2830, 2831, 2832, 2833, 2834, 2835, 2836, 2837, 2838, 2839, 2840, 2841, 2842, 2843, 2844, 2845, 2851, 2852, 2853, 2854, 2855, 2856, 2857, 2858, 2859, 2860, 2861, 2862, 2863, 2864, 2865, 2866, 2867, 2868, 2869, 2870, 2872, 2873, 2874, 2875, 2876, 2877, 2878, 2879, 2880, 2881, 2882, 2883, 2884, 2885, 2889, 2890, 2891, 2892, 2893, 2894, 2895, 2896, 2897, 2898, 2899, 2900, 2984, 2990, 2991, 3002, 3003, 3004, 3008, 3122, 3124, 3125, 3126, 3127, 3128, 3129, 3130, 3131, 3133, 3134, 3135, 3136, 3137, 3138, 3139, 3140, 3141, 3142, 3143, 3144, 3145, 3146, 3147, 3148, 3149, 3150, 3151, 3152, 3153, 3154, 3155, 3156, 3157, 3158, 3159, 3160, 3161, 3162, 3167, 3170, 3171, 3172, 3173, 3174, 3175, 3176, 3177, 3178, 3179, 3180, 3187, 3188, 3189, 3190, 3191, 3196, 3200, 3204, 3205, 3206, 3207, 3208, 3209, 3210, 3212, 3216, 3217, 3218, 3219, 3220, 3221, 3222, 3223, 3224, 3225, 3226, 3227, 3228, 3229, 3230, 3231, 3232, 3233, 3234, 3235, 3236, 3237, 3238, 3239, 3240, 3241, 3242, 3243, 3244, 3246, 3247, 3248, 3251, 3252, 3285, 3286, 3291, 3292, 3293, 3294, 3300, 3301, 3302, 3303, 3304, 3305, 3306, 3307, 3308, 3309, 3310, 3311, 3312, 3313, 3314, 3315, 3423, 3424, 3449, 3454, 3460, 3469, 3470, 3479, 3480, 3481, 3486, 3488, 3492, 3493, 3494, 3495, 3497, 3498, 3499, 3500, 3501, 3502, 3503, 3504, 3531, 3572, 3650, 3651, 3652, 3653, 3654, 3655, 3656, 3698, 3699, 3700, 3701, 3702, 3703, 3704, 3705, 3706, 3707, 3708, 3709, 3710, 3711, 3712, 3713, 3714, 3715, 3716, 3717, 3718, 3729, 3730, 3731, 3732, 3733, 3734, 3735, 3736, 3737, 3738, 3739, 3740, 3741, 3743, 3744, 3745, 3748, 3750, 3751, 3754, 3755, 3757, 3758, 3761, 3762, 3763, 3764, 3766, 3767, 3771, 3772, 3773, 3774, 3775, 3776, 3778, 3783, 3785, 3787, 3788, 3791, 3792, 3794, 3795, 3796, 3798, 3873, 3874, 3875, 3876, 3877, 3878, 3879, 3880, 3881, 3882, 3884, 3885, 3886, 3887, 3888, 3889, 3891, 3892, 3893, 3894, 3895, 3945, 3946, 3947, 3949, 3952, 3956, 3966, 3967, 3968, 3969, 3970, 3971, 3972, 3973, 3974, 3975, 3976, 3977, 3978, 3979, 3980, 3981, 3982, 3983, 3984, 3985, 3986, 3987, 3988, 3989, 3990, 3991, 3992, 3993, 3994, 3995, 3996, 3997, 3998, 3999, 4000, 4001, 4002, 4003, 4004, 4005, 4006, 4007, 4008, 4009, 4010, 4011, 4012, 4013, 4014, 4015, 4016, 4017, 4018, 4019, 4020, 4021, 4022, 4023, 4024, 4025, 4026, 4027, 4028, 4029, 4030, 4031, 4032, 4033, 4034, 4035, 4036, 4037, 4038, 4039, 4040, 4041, 4042, 4043, 4044, 4066, 4067, 4077, 4078, 4079, 4080, 4081, 4082, 4083, 4084, 4085, 4086, 4087, 4088, 4089, 4090, 4091, 4092, 4093, 4094, 4095, 4096, 4097, 4098, 4099, 4100, 4101, 4102, 4103, 4104, 4105, 4106, 4107, 4108, 4109, 4110, 4111, 4112, 4113, 4114, 4115, 4116, 4117, 4118, 4119, 4120, 4121, 4122, 4123, 4124, 4125, 4127, 4128, 4129, 4130, 4131, 4132, 4133, 4134, 4135, 4136, 4137, 4138, 4139, 4140, 4141, 4142, 4144, 4145, 4146, 4147, 4148, 4149, 4154, 4155, 4156, 4157, 4158, 4159, 4160, 4161, 4162, 4163, 4164, 4165, 4168, 4169, 4170, 4171, 4172, 4173, 4190, 4197, 4198, 4199, 4200, 4201, 4202, 4203, 4204, 4205, 4206, 4207, 4208, 4209, 4226, 4227, 4228, 4229, 4230, 4231, 4232, 4233, 4234, 4235, 4236, 4237, 4238, 4239, 4240, 4241, 4242, 4243, 4244, 4245, 4246, 4247, 4248, 4249]; 
        $products = $this->actionProductnospecprice($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproductnospecprice($id_prod,$brand_id,$page,$limit);
        
    
        
        
         $data = [
        '',
        '',
        'https://thewatch.co/img/landing/payday/bannerdesktop.jpg'
    ];

      return $this->render('payday', array(
        "products" => $products, 
        "count" => $product_count, 
        "limit" => $limit, 
        "data" => $data,
        "page"=>$page,
        "brands"=>$default_brand
      ));
	}
	
	
	public function actionOkeoce(){ 
		$start = 0;
        $limit = 20;
		
		$sort = 'none';
                if(isset($_GET['sortby'])){
                  $sort = $_GET['sortby'];
                }
        $sortby = 'priority ASC';
        if($sort == 'price-high-to-low'){
          $sortby = 'priority DESC';
        }if($sort == 'price-low-to-high'){
          $sortby = 'priority ASC';
        }if($sort == 'none'){
          $sortby = 'priority ASC';
        }
        
        $brand_id = [44,48]; 
		
        $default_brand = $brand_id;
        if(isset($_GET['brands'])){
            $brand_id = explode('--', $_GET['brands']);
        }

        $page = 1;
          $limit = 20;
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
        
		
        
        
        $id_prod = [803, 804, 805, 806, 807, 808, 809, 810, 811, 812, 813, 814, 815, 816, 817, 818, 819, 820, 821, 822, 823, 824, 825, 826, 827, 828, 830, 831, 832, 833, 834, 835, 836, 837, 838, 839, 840, 841, 842, 843, 844, 845, 846, 847, 848, 849, 850, 851, 852, 853, 854, 855, 856, 857, 858, 859, 860, 861, 862, 863, 864, 865, 866, 867, 868, 869, 870, 871, 872, 873, 874, 875, 876, 877, 879, 880, 881, 883, 884, 885, 886, 888, 889, 891, 935, 936, 940, 943, 947, 948, 953, 954, 958, 959, 961, 1022, 1060, 1061, 1062, 1063, 1064, 1065, 1066, 1100, 1101, 1102, 1103, 1104, 1105, 1106, 1107, 1108, 1110, 1111, 1115, 1117, 1118, 1119, 1120, 1122, 1123, 1124, 1125, 1126, 1127, 1128, 1129, 1130, 1132, 1133, 1137, 1138, 1139, 1140, 1141, 1159, 1160, 1161, 1162, 1163, 1164, 1166, 1167, 1168, 1169, 1172, 1313, 1314, 1315, 1316, 1317, 1318, 1319, 1320, 1321, 1322, 1323, 1324, 1325, 1326, 1397, 1398, 1399, 1400, 1401, 1402, 1403, 1404, 1405, 1406, 1407, 1408, 1409, 1410, 1411, 1412, 1413, 1414, 1415, 1416, 1417, 1418, 1419, 1420, 1421, 1422, 1423, 1424, 1425, 1426, 1427, 1428, 1429, 1431, 1462, 1463, 1464, 1465, 1466, 1467, 1468, 1469, 1470, 1471, 1472, 1473, 1474, 1475, 1476, 1477, 1478, 1479, 1480, 1481, 1482, 1483, 1484, 1485, 1486, 1487, 1488, 1489, 1490, 1491, 1492, 1493, 1494, 1495, 1496, 1497, 1498, 1499, 1500, 1501, 1502, 1503, 1505, 1506, 1507, 1508, 1509, 1579, 1580, 1585, 1608, 1609, 1610, 1633, 1634, 1635, 1636, 1637, 1638, 1639, 1640, 1641, 1642, 1643, 1644, 1645, 1646, 1647, 1648, 1649, 1650, 1651, 1652, 1653, 1654, 1655, 1656, 1657, 1659, 1660, 1661, 1662, 1663, 1664, 1665, 1685, 1686, 1687, 1688, 1689, 1694, 1695, 1696, 1697, 1698, 1699, 1700, 1701, 1702, 1703, 1704, 1705, 1706, 1707, 1708, 1709, 1711, 1712, 1713, 1714, 1715, 1731, 1732, 1733, 1734, 1735, 1736, 1737, 1741, 1742, 1743, 1744, 1745, 1746, 1747, 1748, 1749, 1750, 1751, 1759, 1760, 1761, 1762, 1763, 1764, 1765, 1766, 1767, 1768, 1769, 1770, 1771, 1772, 1773, 1774, 1775, 1776, 1777, 1778, 1779, 1780, 1781, 1782, 1783, 1784, 1785, 1786, 1787, 1788, 1789, 1790, 1791, 1792, 1793, 1794, 1795, 1796, 1797, 1799, 1800, 1801, 1802, 1803, 1804, 1805, 1806, 1807, 1808, 1809, 1991, 1992, 1995, 1996, 1997, 1998, 1999, 2000, 2001, 2002, 2003, 2004, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2042, 2043, 2044, 2045, 2046, 2048, 2090, 2091, 2092, 2093, 2094, 2095, 2096, 2097, 2098, 2099, 2100, 2101, 2102, 2103, 2104, 2105, 2106, 2107, 2108, 2109, 2110, 2111, 2112, 2113, 2114, 2115, 2116, 2168, 2169, 2170, 2171, 2172, 2173, 2195, 2254, 2255, 2256, 2257, 2258, 2259, 2260, 2261, 2262, 2263, 2264, 2265, 2266, 2268, 2269, 2270, 2271, 2272, 2273, 2274, 2275, 2276, 2277, 2278, 2279, 2280, 2281, 2282, 2283, 2284, 2285, 2286, 2287, 2317, 2318, 2411, 2412, 2413, 2414, 2415, 2416, 2417, 2418, 2419, 2420, 2421, 2423, 2424, 2425, 2426, 2427, 2428, 2429, 2430, 2431, 2432, 2433, 2434, 2435, 2436, 2437, 2438, 2439, 2440, 2479, 2520, 2521, 2522, 2523, 2525, 2526, 2532, 2537, 2538, 2539, 2541, 2542, 2543, 2544, 2545, 2546, 2547, 2548, 2549, 2550, 2551, 2552, 2554, 2555, 2556, 2558, 2559, 2560, 2616, 2617, 2618, 2621, 2622, 2623, 2624, 2625, 2627, 2636, 2638, 2639, 2640, 2641, 2642, 2643, 2644, 2645, 2646, 2647, 2648, 2649, 2651, 2652, 2653, 2654, 2655, 2656, 2657, 2658, 2659, 2660, 2663, 2664, 2665, 2666, 2700, 2701, 2702, 2703, 2704, 2706, 2707, 2708, 2709, 2710, 2769, 2770, 2771, 2772, 2773, 2774, 2775, 2776, 2777, 2778, 2779, 2780, 2781, 2782, 2783, 2784, 2785, 2786, 2787, 2788, 2789, 2790, 2791, 2792, 2793, 2794, 2795, 2796, 2797, 2798, 2799, 2800, 2801, 2802, 2803, 2804, 2805, 2806, 2807, 2808, 2809, 2810, 2811, 2812, 2813, 2814, 2815, 2816, 2817, 2818, 2819, 2820, 2821, 2822, 2823, 2824, 2826, 2827, 2828, 2829, 2830, 2831, 2832, 2833, 2834, 2835, 2836, 2837, 2838, 2839, 2840, 2841, 2842, 2843, 2844, 2845, 2849, 2851, 2852, 2853, 2854, 2855, 2856, 2857, 2858, 2859, 2860, 2861, 2862, 2863, 2864, 2865, 2867, 2868, 2869, 2870, 2872, 2873, 2874, 2875, 2876, 2877, 2878, 2879, 2880, 2881, 2882, 2883, 2884, 2885, 2889, 2890, 2891, 2892, 2893, 2894, 2895, 2896, 2897, 2899, 2900, 2984, 2985, 2988, 2990, 2991, 2992, 2994, 2995, 2996, 2997, 2998, 3001, 3002, 3003, 3004, 3006, 3007, 3008, 3123, 3124, 3125, 3126, 3127, 3128, 3129, 3130, 3131, 3132, 3133, 3134, 3135, 3136, 3137, 3138, 3139, 3140, 3141, 3142, 3143, 3144, 3145, 3146, 3147, 3148, 3149, 3150, 3151, 3152, 3153, 3154, 3155, 3156, 3157, 3158, 3159, 3160, 3161, 3162, 3167, 3168, 3169, 3170, 3171, 3172, 3173, 3174, 3175, 3176, 3177, 3204, 3205, 3206, 3207, 3208, 3209, 3210, 3211, 3212, 3213, 3214, 3216, 3217, 3218, 3219, 3220, 3221, 3222, 3223, 3224, 3225, 3226, 3227, 3228, 3229, 3230, 3231, 3232, 3233, 3234, 3235, 3236, 3237, 3238, 3239, 3240, 3285, 3286, 3290, 3291, 3292, 3295, 3296, 3301, 3304, 3305, 3306, 3308, 3309, 3310, 3311, 3312, 3313, 3314, 3315, 3423, 3424, 3447, 3449, 3454, 3470, 3479, 3481, 3484, 3487, 3494, 3497, 3498, 3499, 3500, 3501, 3502, 3503, 3650, 3651, 3652, 3653, 3654, 3655, 3656, 3699, 3700, 3701, 3702, 3704, 3705, 3706, 3707, 3708, 3709, 3710, 3711, 3716, 3717, 3729, 3730, 3731, 3732, 3733, 3734, 3735, 3736, 3737, 3738, 3739, 3740, 3744, 3938, 3941, 3942, 3946, 3947, 3949, 3951, 3953, 3956, 3957, 3959, 3960, 3961, 3962, 3965, 3966, 3967, 3968, 3971, 3973, 3974, 3976, 3979, 3980, 3982, 4022, 4023, 4024, 4025, 4026, 4027, 4028, 4029]; 
        // $id_prod = $this->actionIdproduct($brand_id,$id_prod);
            // query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
        
        $this->title = 'Berbagi Waktu - The Watch Co.';
		
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Promo Berbagi Waktu']);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'Berbagi Waktu - The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Berbagi Waktu - The Watch Co.']);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Berbagi Waktu - The Watch Co.' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Promo Berbagi Waktu' ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Berbagi Waktu - The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/berbagiwaktu']);
        // \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/event/seo-share.jpg' ]);

        // $model = \backend\models\KontesSeoContent::find()->where(['id'=>1])->one();
        return $this->render('testingokeoce', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
  }
	
}
