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
use backend\models\BrandsBanner;
use backend\models\BrandsBannerDetail;

class LandingController extends controller\FrontendController {
    
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
    
    public function actionCorporate(){
		$model = new \backend\models\CorporateOrder();
		
		if ($model->load(Yii::$app->request->post())) {
		  //  print_r($_POST['CorporateOrder']);die();
		  //  echo 'masuk';die();
            $model->fullname = $_POST['CorporateOrder']['fullname'];
            $model->company_name = $_POST['CorporateOrder']['company_name'];
            $model->phone_number = $_POST['CorporateOrder']['phone_number'];
            $model->email = $_POST['CorporateOrder']['email'];
            $model->message = $_POST['CorporateOrder']['message'];
            $model->created_at = date('Y-m-d H:i:s');
            $model->save();
            
            \Yii::$app->session->setFlash('success', "Terima Kasih. Data order Anda berhasil disimpan.");
            
            return $this->redirect(['corporate']);
        } else {
            $this->title = 'Corporate Order - The Watch Co.';
		
            \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'The Watch Co. menghadirkan kenyamanan untuk memilih dan membeli produk berkualitas untuk kebutuhan korporasi Anda']);
            \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'Corporate Order - The Watch Co.']);
            \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Corporate Order - The Watch Co.']);
            
            \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
            \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Corporate Order - The Watch Co.' ]);
            \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'The Watch Co. menghadirkan kenyamanan untuk memilih dan membeli produk berkualitas untuk kebutuhan korporasi Anda' ]);
            \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Corporate Order - The Watch Co.']);
            \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/corporate']);
            // \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/event/seo-share.jpg' ]);
    
            // $model = \backend\models\KontesSeoContent::find()->where(['id'=>1])->one();
            return $this->render('corporate',["model"=>$model]);
        }
         
        
	}
	
	public function actionCookies(){
			if (isset($_SERVER['HTTP_COOKIE'])) {
				$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
				foreach($cookies as $cookie) {
					echo $cookie;
					$parts = explode('=', $cookie);
					$name = trim($parts[0]);
					setcookie($name, '', time()-1000);
					setcookie($name, '', time()-1000, '/');
					
				}
			}
		setcookie('total-cart-amount', 'OKComputer', time()-1000, '/');
		echo "a";
		return null;
	}
	
	
	public function actionTwccampaign(){
	    $now = date("Y-m-d H:i:s");
	    $page = 0;
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
                // ->andWhere('specific_price.from <= "'. $now . '"')
                // ->andWhere('specific_price.to > "'. $now . '"')
                ->andWhere('product.product_id IN (2743,2716,2753,2034,1327,3001,2994,3201,3233,3232,3216,3247,3254,3256,2993)')
                ->andWhere(['product.active'=>1])
                // ->orderBy('product.date_created DESC')
                ->orderBy('product.price ASC')
                ->all();
                
	    $this->title = 'Redefine Time - The Watch Co.';
		
            \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'The Watch Co. menghadirkan kenyamanan untuk memilih dan membeli produk berkualitas untuk kebutuhan korporasi Anda']);
            \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'Redefine Time - The Watch Co.']);
            \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Redefine Time - The Watch Co.']);
            
            \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
            \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Redefine Time - The Watch Co.' ]);
            \Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'The Watch Co. menghadirkan kenyamanan untuk memilih dan membeli produk berkualitas untuk kebutuhan korporasi Anda' ]);
            \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Redefine Time - The Watch Co.']);
            \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/redefine-time']);
            // \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/event/seo-share.jpg' ]);
    
            // $model = \backend\models\KontesSeoContent::find()->where(['id'=>1])->one();
            return $this->render('twc_campaign',["model"=>$model,"products"=>$product]);
	}
	
	public function actionPreorder(){
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
        
        $brand_id = [85];
        $default_brand = $brand_id;
        
        $brand = \backend\models\Brands::find()->where(['brand_id'=>$brand_id])->one();
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
        $id_prod = $this->idProductPreOrder($brand_id,$id_prod);
            // query product and filter
        $products = $this->productPreOrder($id_prod,$brand_id,$page,$limit);
        $product_count = $this->countProductPreOrder($id_prod,$brand_id,$page,$limit);
         
        $this->title = 'Pre Order D1 Milano - The Watch Co.';
		
        //\Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dalam rangka menyambut HUT RI, The Watch Co. memberikan promo merdeka 17 Agustus yang sayang jika dilewatkan. Dapatkan promo jam tangan favoritmu sekarang!']);
        //\Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'Promo Merdeka 17 Agustus - The Watch Co.']);
        //\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Merdeka 17 Agustus - The Watch Co.']);
        
        //\Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        //\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo Merdeka 17 Agustus - The Watch Co.' ]);
        //\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Dalam rangka menyambut HUT RI, The Watch Co. memberikan promo kejutan 17 Agustus yang sayang jika dilewatkan. Dapatkan promo jam tangan favoritmu sekarang!' ]);
        //\Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Promo 17 Agustus']);
        //\Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/promo-merdeka-17-agustus']);
        // \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/event/seo-share.jpg' ]);

        // $model = \backend\models\KontesSeoContent::find()->where(['id'=>1])->one();
        return $this->render('preorder', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
	}
	
	public function actionMayday(){
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
        
        $brand_id = [1,10,4,67,33,9,79,71,27,44,8,49,48,14];
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

        
        $this->title = 'Promo Mayday Madness 2018 – The Watch Co.';
		\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo Mayday Madness 2018 – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Manfaatkan promo diskon Mayday Madness untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Manfaatkan promo diskon Mayday Madness untuk beli jam tangan pria dan wanita branded original hanya di The Watch Co. Beli Sekarang!']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Mayday Madness 2018 – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

        return $this->render('mayday', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
	
	}
	
	// get id product
    private function idProductPreOrder($id_brands,$id_prod_plus){
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
          
          if($id_prod != []){
              $id_inter = array_intersect($id_prod,$id_prod_plus);
            }else{
              $id_inter = $id_prod_plus;
            }
          
            // print_r($id_prod);die();

          $now = date("Y-m-d H:i:s");
              $id_prod3 = [];
          if($id_prod != []){
            $results = \backend\models\Product::find()
                ->joinWith([
                   "brands",
                    "productPreOrder",
        
                ])
                ->where(['product.product_id'=>$id_prod])
                ->andWhere(['brands.brand_id'=>$id_brands])
                ->andWhere('product_pre_order.product_pre_order_start_date <= "'. $now . '"')
                ->andWhere('product_pre_order.product_pre_order_end_date > "'. $now . '"')
    
                ->all();
          }else{
              $results = \backend\models\Product::find()
                ->joinWith([
                   "brands",
                    "productPreOrder",
        
                ])
                // ->where(['product.product_id'=>$id_prod])
                ->andWhere(['brands.brand_id'=>$id_brands])
                ->andWhere('product_pre_order.product_pre_order_start_date <= "'. $now . '"')
                ->andWhere('product_pre_order.product_pre_order_end_date > "'. $now . '"')
    
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
    

    public function actionIdproductOB($id_brands,$id_prod_plus){
       $id_prod = [];
       $connection = Yii::$app->getDb();

       if(isset($_GET['gender'])){
          $genders = explode('--', $_GET['gender']);
          $id_prod2 = [];
          $command = $connection->createCommand(" SELECT product_id FROM product_feature WHERE feature_value_id IN (".implode(',',$genders).") ");
          $results = $command->queryAll();
          $p = 0;

          foreach($results as $result){
            $id_prod2[$p] = (int) $result['product_id'];
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
        
           $command = $connection->createCommand(" SELECT product_id FROM product_feature WHERE feature_value_id IN (".implode(',',$types).") ");
           $results = $command->queryAll();
           $p = 0;
           foreach($results as $result){
             $id_prod2[$p] =  (int)$result['product_id'];
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
             $id_prod2[$p] = (int)$result['product_id'];
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
                         $id_prod2[$p] = (int)$result['product_id'];
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
                         $id_prod2[$p] = (int)$result['product_id'];
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
           $id_prod2[$p] = (int)$result['product_id'];
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
           $id_prod3 = [];
       if($id_prod != []){
         $results = \backend\models\Product::find()
             ->joinWith([
                "brands",
                 "specificPrice",
     
             ])
             //->where(['product.product_id'=>$id_prod])
             ->where(['brands.brand_id'=>$id_brands])
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
    public function actionProductSort($id_prod, $brand_id = array(),$page,$limit){
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
        $sortby = 'product_sort';
              if(isset($_GET['sortby'])){
                $sortby = $_GET['sortby'];
              }

        if($id_prod != []){
          
          if(!isset($_GET['price'])){
            $products = \backend\models\Product::getProductByCategoryPricePromoPageSort(
                [
                    "product.brands_brand_id" => $brand_id,
                    'product.active' => 1,
                    'product.product_id'=> $id_prod,
                    'product.product_category_id'=> [5,12,7],
                ],$bellow_price,$above_price,$start,$limit,$sortby
            );
          }else{
            $products = \backend\models\Product::getProductByCategoryPricePromoPageSortLimit(
              [
                  "product.brands_brand_id" => $brand_id,
                  'product.active' => 1,
                  'product.product_id'=> $id_prod,
                  'product.product_category_id'=> [5,12,7],
              ],$bellow_price,$above_price,$start,$limit,$sortby
          );
          }
            
        }

        if($id_prod == []){
         
            $products = \backend\models\Product::getProductByCategoryPricePromoPage(
                [
                    "product.brands_brand_id" => $brand_id,
                    'product.active' => 1,
                    'product.product_id'=> $id_prod,
                    'product.product_category_id'=> [5,12,7],
                ],$bellow_price,$above_price,$start,$limit,$sortby
            );
          

        }

        if(!isset($_GET['price'])){
         
            $products = \backend\models\Product::getProductByCategoryPromoPageSort(
                [
                    "product.brands_brand_id" => $brand_id,
                    'product.active' => 1,
                    'product.product_id'=> $id_prod,
                    'product.product_category_id'=> [5,12,7],
                ],$start,$limit,$sortby
            );
        
        }

        return $products;
  }

  public function actionProductSort2($id_prod, $brand_id = array(),$page,$limit){
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
        $sortby = 'product_sort';
              if(isset($_GET['sortby'])){
                $sortby = $_GET['sortby'];
              }

        if($id_prod != []){
          
          if(!isset($_GET['price'])){
            $products = \backend\models\Product::getProductByCategoryPricePromoPageSort(
                [
                    "product.brands_brand_id" => $brand_id,
                    'product.active' => 1,
                    'product.product_id'=> $id_prod,
                    'product.product_category_id'=> [5,6,7,11,12],
                ],$bellow_price,$above_price,$start,$limit,$sortby
            );
          }else{
            $products = \backend\models\Product::getProductByCategoryPricePromoPageSortLimit(
              [
                  "product.brands_brand_id" => $brand_id,
                  'product.active' => 1,
                  'product.product_id'=> $id_prod,
                  'product.product_category_id'=> [5,6,7,11,12],
              ],$bellow_price,$above_price,$start,$limit,$sortby
          );
          }
            
        }

        if($id_prod == []){
         
            $products = \backend\models\Product::getProductByCategoryPricePromoPage(
                [
                  "product.brands_brand_id" => $brand_id,
                  'product.active' => 1,
                  'product.product_id'=> $id_prod,
                  'product.product_category_id'=> [5,6,7,11,12],
                ],$bellow_price,$above_price,$start,$limit,$sortby
            );
          

        }

        if(!isset($_GET['price'])){
         
            $products = \backend\models\Product::getProductByCategoryPromoPageSort(
                [
                    "product.brands_brand_id" => $brand_id,
                    'product.active' => 1,
                    'product.product_id'=> $id_prod,
                    'product.product_category_id'=> [5,6,7,11,12],
                ],$start,$limit,$sortby
            );
        
        }

        return $products;
  }

    // get id product
    public function actionIdproduct($id_brands,$id_prod_plus){
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
          
          if($id_prod != []){
              $id_inter = array_intersect($id_prod,$id_prod_plus);
            }else{
              $id_inter = $id_prod_plus;
            }
          
            // print_r($id_prod);die();

          $now = date("Y-m-d H:i:s");
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
	
	// get product
    private function productPreOrder($id_prod, $brand_id = array(),$page,$limit){
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
                      //'product.active' => 1,
                      'product.product_id'=> $id_prod,
                  ],$bellow_price,$above_price,$start,$limit,$sortby
              );
            
          }

          if($id_prod == []){
           
              $products = \backend\models\Product::getProductByCategoryPricePromoPage(
                  [
                      "product.brands_brand_id" => $brand_id,
                      //'product.active' => 1,
                      'product.product_id'=> $id_prod,
                  ],$bellow_price,$above_price,$start,$limit,$sortby
              );
            

          }

          if(!isset($_GET['price'])){
           
              $products = \backend\models\Product::getProductByCategoryPromoPage(
                  [
                      "product.brands_brand_id" => $brand_id,
                      //'product.active' => 1,
                      'product.product_id'=> $id_prod,
                  ],$start,$limit,$sortby
              );
          
          }
          return $products;
    }

	// get product
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
	
	private function countProductPreOrder($id_prod, $brand_id = array(),$page,$limit){
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
                      //'product.active' => 1,
                      'product.product_id'=> $id_prod,
                  ],$bellow_price,$above_price
              );
            
          }

          if($id_prod == []){
           
              $products = \backend\models\Product::getProductByCategoryPricePromo(
                  [
                      "product.brands_brand_id" => $brand_id,
                      //'product.active' => 1,
                      'product.product_id'=> $id_prod,
                  ],$bellow_price,$above_price
              );
            

          }

          if(!isset($_GET['price'])){
           
              $products = \backend\models\Product::getProductByCategoryPromo(
                  [
                      "product.brands_brand_id" => $brand_id,
                      //'product.active' => 1,
                      'product.product_id'=> $id_prod,
                  ]
              );
          
          }
          return count($products);
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
    
     // get product
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
                      'product.active' => 1,
                      'product.product_id'=> $id_prod,
                  ],$bellow_price,$above_price,$start,$limit,$sortby
              );
            
          }

          if($id_prod == []){
           
              $products = \backend\models\Product::getProductByCategoryPricePromoPageNoSpecPrice(
                  [
                      "product.brands_brand_id" => $brand_id,
                      'product.active' => 1,
                  ],$bellow_price,$above_price,$start,$limit,$sortby
              );
            

          }

          if(!isset($_GET['price'])){
           
              $products = \backend\models\Product::getProductByCategoryPromoPageNoSpecPrice(
                  [
                      "product.brands_brand_id" => $brand_id,
                      'product.active' => 1
                  ],$start,$limit,$sortby
              );
          
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
                      'product.active' => 1,
                      'product.product_id'=> $id_prod,
                  ],$bellow_price,$above_price
              );
            
          }

          if($id_prod == []){
           
              $products = \backend\models\Product::getProductByCategoryPricePromoNoSpecPrice(
                  [
                      "product.brands_brand_id" => $brand_id,
                      'product.active' => 1,
                  ],$bellow_price,$above_price
              );
            

          }

          if(!isset($_GET['price'])){
           
              $products = \backend\models\Product::getProductByCategoryPromoNoSpecPrice(
                  [
                      "product.brands_brand_id" => $brand_id,
                      'product.active' => 1
                  ]
              );
          
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

    public function actionCustom() {
      return 'ayee';
    }

    
    public function actionEventall(){
        
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
        
        $brand_id = [1,2,4,5,6,7,8,9,10,12,14,16,17,19,21,22,23,24,26,27,28,31,32,33,35,36,37,44,48,49,50,58,59,63,65,67,68,69,70,71,72,73];
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
        $products = $this->actionProductnospecprice($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproductnospecprice($id_prod,$brand_id,$page,$limit);

        
        // \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Promo diskon akhir tahun 2017 di The Watch Co. Manfaatkan potongan harga sampai 60% untuk produk jam tangan dan aksesoris pria & wanita. Beli sekarang!']);
        // \Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Diskon Akhir Tahun 2017 – The Watch Co.']);
        // \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo pilkada, pilkada dki jakarta, pilkada dki 2017, promo pilgub, promo pilgub dki jakarta, pilgub dki 2017, diskon pilkada, diskon pilkada dki 2017, diskon hari ini, promo hari ini']);
        
        // $products = [];

        return $this->render('eventall', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
    }
    
    public function actionRaffle($page=FALSE){
        $this->title = 'Q Timex 1979 Reissue – The Watch Co.';
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Q Timex is now available for raffle at thewatch.co on 21 June - 5 July 2019 with limited quota, so you better be fast!']);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo hari ini, promo timex']);

        return $this->render('timexraffle', array(
						"event_quota" => 30,
					)
		);
    }


    public function actionRaffleverifikator(){
        return $this->render('raffleadmin'); 
    }

    public function actionRaffleverifikatorlogin(){
        return $this->render('raffleloginadmin'); 
    }
	
	
	
	
	public function actionBeams2(){
		
      //$productName = 'timex-x-beams-x-engineered-garments'; 
	  $productName = 'mk1-engineered-garments-x-beams---tw2r56500';
	  
        $product = \backend\models\ProductDetail::find()
                ->where(["product_detail.link_rewrite" => $productName])
                ->one();
				

        $productDetail = \backend\models\Product::getProductDetails([
				"product.product_id" => $product->product_id,
				"product.active" => 1
			]);
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
				$productStock = \backend\models\ProductStock::findOne(["product_id" => $product->product_id]);
		
        $this->breadcrumb[] = $productDetail->productCategory->product_category_name;
        $this->breadcrumb[] = $productDetail->brands->brand_name;
        $this->breadcrumb[] = $product->name;

        $brand = \backend\models\Brands::findOne($productDetail->brands_brand_id);
        // $this->title = ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name));
        $this->title = ucwords(strtolower("Timex")) . " - " . ucwords(strtolower("Timex X Beams x Engineered Garments"));

        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $productDetail->productDetail->meta_description]);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $productDetail->productDetail->meta_keywords]);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name))]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Product Detail']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/products/' . $productDetail->productDetail->link_rewrite ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/product/' . $productDetail->productImage->product_image_id . '/' . $productDetail->productImage->product_image_id . '.jpg' ]);
//		die(var_dump($_SESSION));
        return $this->render('beams2', array(
                    "productImages" => $productImages,
                    "product" => $productDetail,
					"stock" => $productStock->quantity,
                    "productRelated" => $productRelated,
                    "productAttributeCombination" => $productAttributeCombination,
                    "brands_id" =>$brands_id,
        ));
    }

    public function actionQtimex()
    {
        $productName = 'q-timex-reissue-tw2t80700';
        $product = \backend\models\ProductDetail::find()
                ->where(["product_detail.link_rewrite" => $productName])
                ->one();
				
        $productDetail = \backend\models\Product::getProductDetails([
          "product.product_id" => $product->product_id,
          // "product.active" => 1
        ]);

        // die(var_dump($productDetail));
		    $brands_id = $productDetail->brandsCollection->brands_collection_id;
		
        if($productDetail == NULL){
          $this->redirect(\yii\helpers\Url::base() . '/brand/' . strtolower($product->product->brands->brand_name));
        }
        
        $productWarranty = \backend\models\ProductWarranty::findOne(['product_id' => $product->product_id]);
        $brandCategoryId = [688];
        $duapuluhmm = \backend\models\Product::find()
                ->joinWith([
                    "productDetail",
                    "brandsCollection",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(["brands_collection.brands_collection_id" => 688])
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
				$productStock = \backend\models\ProductStock::findOne(["product_id" => $product->product_id]);
		
        $this->breadcrumb[] = $productDetail->productCategory->product_category_name;
        $this->breadcrumb[] = $productDetail->brands->brand_name;
        $this->breadcrumb[] = $product->name;

        $brand = \backend\models\Brands::findOne($productDetail->brands_brand_id);
        // $this->title = ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name));
        $this->title = ucwords(strtolower("Timex")) . " - " . ucwords(strtolower("Q Timex 1979 Reissue – The Watch Co."));

        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $productDetail->productDetail->meta_description]);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $productDetail->productDetail->meta_keywords]);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name))]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Product Detail']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/products/' . $productDetail->productDetail->link_rewrite ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/product/' . $productDetail->productImage->product_image_id . '/' . $productDetail->productImage->product_image_id . '.jpg' ]);
        return $this->render('qtimex', array(
                    "productImages" => $productImages,
                    "product" => $productDetail,
					"stock" => $productStock->quantity,
                    "productRelated" => $productRelated,
                    "productAttributeCombination" => $productAttributeCombination,
                    "brands_id" =>$brands_id,
        ));
    }
	
	public function actionTimexFooturama()
    {
        $productName = 'timex-x-footurama---tw2r37300';
        $product = \backend\models\ProductDetail::find()
                ->where(["product_detail.link_rewrite" => $productName])
                ->one();
				
        $productDetail = \backend\models\Product::getProductDetails([
          "product.product_id" => $product->product_id,
          // "product.active" => 1
        ]);

        // die(var_dump($productDetail));
		    $brands_id = $productDetail->brandsCollection->brands_collection_id;
		
        if($productDetail == NULL){
          $this->redirect(\yii\helpers\Url::base() . '/brand/' . strtolower($product->product->brands->brand_name));
        }
        
        $productWarranty = \backend\models\ProductWarranty::findOne(['product_id' => $product->product_id]);
        $brandCategoryId = [688];
        $duapuluhmm = \backend\models\Product::find()
                ->joinWith([
                    "productDetail",
                    "brandsCollection",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(["brands_collection.brands_collection_id" => 688])
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
				$productStock = \backend\models\ProductStock::findOne(["product_id" => $product->product_id]);
		
        $this->breadcrumb[] = $productDetail->productCategory->product_category_name;
        $this->breadcrumb[] = $productDetail->brands->brand_name;
        $this->breadcrumb[] = $product->name;

        $brand = \backend\models\Brands::findOne($productDetail->brands_brand_id);
        // $this->title = ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name));
        $this->title = ucwords(strtolower("Timex")) . " - " . ucwords(strtolower("Footurama X Timex – The Watch Co."));

        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $productDetail->productDetail->meta_description]);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $productDetail->productDetail->meta_keywords]);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name))]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Product Detail']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/products/' . $productDetail->productDetail->link_rewrite ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/product/' . $productDetail->productImage->product_image_id . '/' . $productDetail->productImage->product_image_id . '.jpg' ]);
        return $this->render('timex_footurama', array(
                    "productImages" => $productImages,
                    "product" => $productDetail,
					"stock" => $productStock->quantity,
                    "productRelated" => $productRelated,
                    "productAttributeCombination" => $productAttributeCombination,
                    "brands_id" =>$brands_id,
        ));
    }

    public function actionMakna(){
		
      $productName = 'timex-the-waterburry---tw2t36600';
        $product = \backend\models\ProductDetail::find()
                ->where(["product_detail.link_rewrite" => $productName])
                ->one();
				

        $productDetail = \backend\models\Product::getProductDetails([
				"product.product_id" => $product->product_id,
				"product.active" => 1
			]);
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
				$productStock = \backend\models\ProductStock::findOne(["product_id" => $product->product_id]);
		
        $this->breadcrumb[] = $productDetail->productCategory->product_category_name;
        $this->breadcrumb[] = $productDetail->brands->brand_name;
        $this->breadcrumb[] = $product->name;

        $brand = \backend\models\Brands::findOne($productDetail->brands_brand_id);
        // $this->title = ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name));
        $this->title = ucwords(strtolower("Timex")) . " - " . ucwords(strtolower("Timex X Makna"));

        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $productDetail->productDetail->meta_description]);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $productDetail->productDetail->meta_keywords]);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name))]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Product Detail']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/products/' . $productDetail->productDetail->link_rewrite ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/product/' . $productDetail->productImage->product_image_id . '/' . $productDetail->productImage->product_image_id . '.jpg' ]);
//		die(var_dump($_SESSION));
        return $this->render('timexmakna', array(
                    "productImages" => $productImages,
                    "product" => $productDetail,
					"stock" => $productStock->quantity,
                    "productRelated" => $productRelated,
                    "productAttributeCombination" => $productAttributeCombination,
                    "brands_id" =>$brands_id,
        ));
    }
	
	
    public function actionFooturama(){
		
      $productName = 'timex-x-beams-x-engineered-garments';
        $product = \backend\models\ProductDetail::find()
                ->where(["product_detail.link_rewrite" => $productName])
                ->one();
				

        $productDetail = \backend\models\Product::getProductDetails([
				"product.product_id" => $product->product_id,
				"product.active" => 1
			]);
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
				$productStock = \backend\models\ProductStock::findOne(["product_id" => $product->product_id]);
		
        $this->breadcrumb[] = $productDetail->productCategory->product_category_name;
        $this->breadcrumb[] = $productDetail->brands->brand_name;
        $this->breadcrumb[] = $product->name;

        $brand = \backend\models\Brands::findOne($productDetail->brands_brand_id);
        // $this->title = ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name));
        $this->title = ucwords(strtolower("Timex")) . " - " . ucwords(strtolower("Timex X Beams x Engineered Garments"));

        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $productDetail->productDetail->meta_description]);
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $productDetail->productDetail->meta_keywords]);
        
        \Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => ucwords(strtolower($brand->brand_name)) . " - " . ucwords(strtolower($productDetail->productDetail->name))]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'Product Detail']);
        \Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://www.thewatch.co/products/' . $productDetail->productDetail->link_rewrite ]);
        \Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://www.thewatch.co/img/product/' . $productDetail->productImage->product_image_id . '/' . $productDetail->productImage->product_image_id . '.jpg' ]);
        return $this->render('timexfooturama', array(
                    "productImages" => $productImages,
                    "product" => $productDetail,
					"stock" => $productStock->quantity,
                    "productRelated" => $productRelated,
                    "productAttributeCombination" => $productAttributeCombination,
                    "brands_id" =>$brands_id,
        ));
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
    
    public function actionPromogopay()
    {
        $this->title = 'Promo Gopay - The Watch Co.';
		
        return $this->render('promogopay');
    }
	
	public function actionBacktowork() {
		$now = date('Y-m-d H:i:s');
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
      
      $brand_id = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14, 15, 16, 17, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 35, 36, 37, 44, 48, 49, 50, 58, 59, 63, 65, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 86, 87, 88, 89, 90, 91, 94, 95];
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
        $limit = (int)$_GET['limit'];
      }

      if(isset($_GET['price'])){
        $price = explode('--', $_GET['price']);
        $bellow_price = $price[0];
        $above_price = $price[1];
      }

     // $sort = new Sort(['product_sort' => SORT_ASC]);

    $getAllProduct = \backend\models\Product::find([
      'active' => 1])
      ->joinWith('productNewArrival')
	  ->joinWith([
        "productNewArrival",
        "specificPrice"
      ])
	  ->where('product.brands_brand_id != 85')
      ->where('specific_price.from <= "'. $now . '"')
      ->andWhere('specific_price.to > "'. $now . '"')
      ->orderBy(['product_newarrival.product_newarrival_end_date' => SORT_DESC])
      ->all();

		if(count($getAllProduct) > 0){
			foreach($getAllProduct as $product)
			{
				$id_prod[] = $product->product_id;
			}
    }
    
  
      // get all id product
      $id_prod = $this->actionIdproductOB($brand_id,$id_prod);

      
  // 		if(isset($_GET['brands'])){
  // 		    if($_GET['brands'] == 58){
  //                 $id_prod = array_intersect($id_prod,[1067,1068]);
  //               }
  // 		}
      // query product and filter
      $products = $this->actionProductSort($id_prod,$brand_id,$page,$limit);
      $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);

      $data = [
        '',
        '',
        'https://thewatch.co/img/landing/backtowork/bannerdesktop.jpg'
    ];

      return $this->render('backtowork', array(
        "products" => $products, 
        "count" => $product_count, 
        "limit" => $limit, 
        "data" => $data,
        "page"=>$page,
        "brands"=>$default_brand
      ));
      
}


	
	
	



public function actionSummersale() {
		$now = date('Y-m-d H:i:s');
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
      
      $brand_id = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14, 15, 16, 17, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 35, 36, 37, 44, 48, 49, 50, 58, 59, 63, 65, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 86, 87, 88, 89, 90, 91, 94, 95];
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
        $limit = (int)$_GET['limit'];
      }

      if(isset($_GET['price'])){
        $price = explode('--', $_GET['price']);
        $bellow_price = $price[0];
        $above_price = $price[1];
      }

     // $sort = new Sort(['product_sort' => SORT_ASC]);

    $getAllProduct = \backend\models\Product::find([
      'active' => 1])
      ->joinWith('productNewArrival')
	  ->joinWith([
        "productNewArrival",
        "specificPrice"
      ])
	  ->where('product.brands_brand_id != 85')
      ->where('specific_price.from <= "'. $now . '"')
      ->andWhere('specific_price.to > "'. $now . '"')
      ->orderBy(['product_newarrival.product_newarrival_end_date' => SORT_DESC])
      ->all();

		if(count($getAllProduct) > 0){
			foreach($getAllProduct as $product)
			{
				$id_prod[] = $product->product_id;
			}
    }
    
  
      // get all id product
      $id_prod = $this->actionIdproductOB($brand_id,$id_prod);

      
  // 		if(isset($_GET['brands'])){
  // 		    if($_GET['brands'] == 58){
  //                 $id_prod = array_intersect($id_prod,[1067,1068]);
  //               }
  // 		}
      // query product and filter
      $products = $this->actionProductSort($id_prod,$brand_id,$page,$limit);
      $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);

      $data = [
        '',
        '',
        'https://www.thewatch.co/img/landing/summersale/Summer Sale_Sale Banner Desktop.jpg'
    ];

      return $this->render('summersale', array(
        "products" => $products, 
        "count" => $product_count, 
        "limit" => $limit, 
        "data" => $data,
        "page"=>$page,
        "brands"=>$default_brand
      ));
      
}

	
public function actionD1fathersday() {
		$now = date('Y-m-d H:i:s');
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
      
      $brand_id = [85];
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
        $limit = (int)$_GET['limit'];
      }

      if(isset($_GET['price'])){
        $price = explode('--', $_GET['price']);
        $bellow_price = $price[0];
        $above_price = $price[1];
      }

     // $sort = new Sort(['product_sort' => SORT_ASC]);

    $getAllProduct = \backend\models\Product::find([
      'active' => 1, 
      'brands_brand_id' => 85])
      ->joinWith('productNewArrival')
	  ->joinWith([
        "productNewArrival",
        "specificPrice"
      ])
      ->where('specific_price.from <= "'. $now . '"')
      ->andWhere('specific_price.to > "'. $now . '"')
      ->orderBy(['product_newarrival.product_newarrival_end_date' => SORT_DESC])
      ->all();

		if(count($getAllProduct) > 0){
			foreach($getAllProduct as $product)
			{
				$id_prod[] = $product->product_id;
			}
    }
    
  
      // get all id product
      $id_prod = $this->actionIdproductOB($brand_id,$id_prod);

      
  // 		if(isset($_GET['brands'])){
  // 		    if($_GET['brands'] == 58){
  //                 $id_prod = array_intersect($id_prod,[1067,1068]);
  //               }
  // 		}
      // query product and filter
      $products = $this->actionProductSort($id_prod,$brand_id,$page,$limit);
      $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);

      $data = [
        '',
        '',
        'https://thewatch.co/img/landing/d1fathersday/brandbanner2.jpg'
    ];

      return $this->render('d1fathersday', array(
        "products" => $products, 
        "count" => $product_count, 
        "limit" => $limit, 
        "data" => $data,
        "page"=>$page,
        "brands"=>$default_brand
      ));
      
}
    
    public function actionObvalentine() {
      
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
        $limit = (int)$_GET['limit'];
      }

      if(isset($_GET['price'])){
        $price = explode('--', $_GET['price']);
        $bellow_price = $price[0];
        $above_price = $price[1];
      }

     // $sort = new Sort(['product_sort' => SORT_ASC]);

    $getAllProduct = \backend\models\Product::find([
      'active' => 1, 
      'brands_brand_id' => 48, 
      'product_category_id' => [5,12]])
      ->joinWith('productNewArrival')
      ->orderBy(['product_newarrival.product_newarrival_end_date' => SORT_DESC])
      ->all();

		if(count($getAllProduct) > 0){
			foreach($getAllProduct as $product)
			{
				$id_prod[] = $product->product_id;
			}
    }
    
  
      // get all id product
      $id_prod = $this->actionIdproductOB($brand_id,$id_prod);

      
  // 		if(isset($_GET['brands'])){
  // 		    if($_GET['brands'] == 58){
  //                 $id_prod = array_intersect($id_prod,[1067,1068]);
  //               }
  // 		}
      // query product and filter
      $products = $this->actionProductSort($id_prod,$brand_id,$page,$limit);
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

      return $this->render('obvalentine', array(
        "products" => $products, 
        "count" => $product_count, 
        "limit" => $limit, 
        "data" => $data,
        "page"=>$page,
        "brands"=>$default_brand
      ));
    }

    public function actionSweetDeals() {
      $now = date('Y-m-d H:i:s');
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
      
      $brand_id = [1,
2,
4,
5,
6,
7,
8,
9,
10,
11,
12,
13,
14,
16,
17,
19,
21,
22,
23,
24,
25,
26,
27,
28,
31,
32,
33,
35,
36,
37,
42,
43,
44,
48,
49,
50,
58,
59,
63,
65,
66,
67,
68,
69,
70,
71,
72,
73,
74,
75,
76,
77,
78,
79,
80,
81,
82,
83,
84,
85,
86,
87,
88,
89,
90,
91];
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
        $limit = (int)$_GET['limit'];
      }

      if(isset($_GET['price'])){
        $price = explode('--', $_GET['price']);
        $bellow_price = $price[0];
        $above_price = $price[1];
      }

     // $sort = new Sort(['product_sort' => SORT_ASC]);

    $getAllProduct = \backend\models\Product::find([
      'active' => 1, 
      'brands_brand_id' => $brand_id, 
      'product_category_id' => [5,6,7,11,12]])
      ->joinWith([
        "productNewArrival",
        "specificPrice"
      ])
      ->where('specific_price.from <= "'. $now . '"')
      ->andWhere('specific_price.to > "'. $now . '"')
      ->orderBy(['product_newarrival.product_newarrival_end_date' => SORT_DESC])
      ->all();

      // var_dump($getAllProduct);exit();

		if(count($getAllProduct) > 0){
			foreach($getAllProduct as $product)
			{
				$id_prod[] = $product->product_id;
			}
    }
      // var_dump($id_prod);exit();
    
  
      // get all id product
      $id_prod = $this->actionIdproductOB($brand_id,$id_prod);
      // query product and filter
      $products = $this->actionProductSort2($id_prod,$brand_id,$page,$limit);
      $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);

      $data = [
        'Sweet Deals - Promo Diskon Spesial Bulan Februari 2019',
        'Untuk menghangatkan bulan kasih sayang, The Watch Co. memberikan diskon sampai dengan 40% untuk produk pilihan. Berlaku sampai dengan 28 February 2019. Yuk, tunggu apa lagi, beli sekarang juga! <br/><br/>
        Syarat dan ketentuan:<br/>

        1.Promo berlaku untuk brand jam tangan yang tertera dihalaman ini<br/>

        2.Promo bisa dinikmati dengan pembayaran bank transfer, virtual account, kartu kredit (full payment & cicilan), akulaku, vospay, kredivo, dan go-pay<br/>

        3.Cicilan 0% kartu kredit berlaku untuk minimum pembelian Rp. 500.000,- dengan tenor 3, 6, dan 12 bulan<br/>

        4.Gratis ongkir ke seluruh Indonesia bisa didapatkan dengan minimum pembelian Rp. 1.000.000,-<br/>
        5.Promo ini bisa digabungkan dengan promo lainnya seperti vospay.<br/>
        6.Setiap pembelian produk dikenakan biaya asuransi pengiriman sebagai tambahan agar produk yang anda pesan lebih aman sampai tujuan<br/>
        7.Produk yang sudah dipesan tidak dapat dibatalkan dengan alasan apapun, kecuali terjadi kerusakan dari pabrikan<br/>
        8.Jika transaksi dibatalkan oleh pihak The Watch Co. karena suatu hal (stok habis atau lainnya), dana Anda akan dikembalikan 100% <br/>
        9.Dengan mengikuti promo ini, pengguna dianggap mengerti dan menyetujui semua syarat dan ketentuan yang berlaku',
        'https://thewatch.imgix.net/landing/sweetdeals/banner_sweet_deals_d.jpg',
        'https://thewatch.imgix.net/landing/sweetdeals/banner_sweet_deals_m.jpg'
    ];

      return $this->render('sweet_deals', array(
        "products" => $products, 
        "count" => $product_count, 
        "limit" => $limit, 
        "data" => $data,
        "page"=>$page,
        "brands"=>$default_brand
      ));
    }


	public function actionObxhouz()
    {
		
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
        
        $id_prod = [];
        $id_prod = [
			835, 847, 855, 868, 869, 959, 1100, 1101, 1102, 1104, 1107, 1111, 1114, 1115, 1117, 1119, 1120, 1122, 1123, 1124,
			1135, 1141, 1167, 1398, 1403, 1404, 1406, 1407, 1412, 1415, 1416, 1417, 1423, 1430, 1431, 1464, 1467, 1468, 1471,
			1474, 1476, 1479, 1483, 1580, 1633, 1634, 1635, 1637, 1639, 1640, 1643, 1645, 1647, 1650, 1651, 1652, 1653, 1654,
			1659, 1660, 1664, 1685, 1686, 1687, 1694, 1695, 1697, 1698, 1699, 1700, 1701, 1703, 1704, 1706, 1707, 1709, 1710,
			1711, 1714, 1759, 1760, 1761, 1763, 1764, 1766, 1767, 1768, 1769, 1770, 1771, 1772, 1773, 1774, 1776, 1777, 1778,
			1779, 1780, 1781, 1782, 1783, 1784, 1785, 1795, 1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999, 2000, 2001,
			2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019, 2020,
			2021, 2022, 2023, 2024, 2025
		];
    
		// get all id product
		$id_prod = $this->actionIdproduct($brand_id,$id_prod);
	
// 		if(isset($_GET['brands'])){
// 		    if($_GET['brands'] == 58){
//                 $id_prod = array_intersect($id_prod,[1067,1068]);
//               }
// 		}
		// query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
		
    $this->title = 'The Perfect Mothers Day Gift - The Watch Co.';
    
		
        return $this->render('obxhouzcall', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
    }
	
	public function actionAkulaku(){
		
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
        
        $brand_id = [];
		
		$getAllBrands = \backend\models\Brands::findAll(['brand_status' => 'active']);
		
		if(count($getAllBrands) > 0){
			foreach($getAllBrands as $brand){
				$brand_id[] = $brand->brand_id;
			}
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
        
        $id_prod = [];
		
		$getAllProduct = \backend\models\Product::findAll(['active' => 1]);
		
		if(count($getAllProduct) > 0){
			foreach($getAllProduct as $product)
			{
				$id_prod[] = $product->product_id;
			}
		}
		
		// get all id product
		$id_prod = $this->actionIdproduct($brand_id,$id_prod);
	
// 		if(isset($_GET['brands'])){
// 		    if($_GET['brands'] == 58){
//                 $id_prod = array_intersect($id_prod,[1067,1068]);
//               }
// 		}
		// query product and filter
        $products = $this->actionProduct($id_prod,$brand_id,$page,$limit);
        $product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);
		
		$this->title = 'Promo Akulaku - The Watch Co.';
		
		return $this->render('akulaku', array("products" => $products, "count" => $product_count, "limit" => $limit, "page"=>$page,"brands"=>$default_brand));
	}
	
	public function actionPemenangblog(){
		
	
		$this->title = 'Pemenang Blog Competition - The Watch Co.';
		
		return $this->render('pemenang-blog');
	}
	
	public function actionCart()
    {
        $now = date("Y-m-d H:i:s");
		$products = \backend\models\Product::find()

                    ->offset($start)

                    ->limit($limit)

                    ->joinWith([

                        // "brands",

                        "productDetail",

                        // "brandsCollection",

                        // "productNewArrival",

                        // "specificPrice",

                        "productImage" => function ($query) {

                            $query->andWhere(['cover' => 1]);

                        }

                    ])

                    // ->where([

                    //     'product.active' => 1

                    // ])
                    // ->andWhere(['brands.brand_id'=>[79]])
                    ->where(['in','product.product_id',[2130,2132,2134,2136,2140,2141,2143,2144,2145,2148,2149,2151,2152,2158,2159,2161,2162,2163,2164,2165,2167,2206,2207,2208,2209,2210,2211,2212,2214,2216,2217,2220,2221,2224,2226,2227,2231,2232,2233,2234,2235,2236,2237,2238,2239,2240,2241,2242,2243,2244,2245,2246,2247,2248,2249,2251,2252,2253,2378,2379,2380,2381,2382,2383,2384,2385,2386,2389,2394,2396,2397,2398,2445,2446,2447,2449,2450,2452,2453,2454,2455,2457,2458,2459,2460,2461,2462,2591,2592,2593,2594,2595,2596,2597,2598,2599,2600,2602,2603,2604,2605,2606,2608,2609,2610,2611,2612,2613,2614,2615,2629]])
                    // ->andWhere(['brands_collection.brands_collection_id'=>[423]])
                //     ->andWhere('product.product_id = specific_price.product_id')

                // ->andWhere('specific_price.from <= "'. $now . '"')

                // ->andWhere('specific_price.to > "'. $now . '"')
                    // ->orderBy('product_newarrival.product_newarrival_id DESC')

                    ->all();
                    
        foreach($products as $product){
            // echo $product->productDetail->name.',';
            echo $product->product_id.'<br>';
            // $cart_rule_product = new \backend\models\CartRuleProduct();
            // $cart_rule_product->product_id = $product->product_id;
            // $cart_rule_product->cart_rule_id = 15012;
            // $cart_rule_product->save();
        }
        die();
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

                        //same product found
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
	
	public function actionObDeals()
	{
		$current_date = date('Y-m-d H:i:s');
		$start = 0;
		$limit = 20;
      
		$sort = 'none';
		if(isset($_GET['sortby'])){
			$sort = $_GET['sortby'];
		}
		$sortby = 'brands.brand_name ASC';
		if($sort == 'price-high-to-low'){
			$sortby = 'priority DESC';
		}
		if($sort == 'price-low-to-high'){
			$sortby = 'priority ASC';
		}
		if($sort == 'none'){
			$sortby = 'brands.brand_name ASC';
		}
      
		$brand_id = [48];
		$default_brand = $brand_id;
		if(isset($_GET['brands'])){
			$brand_id = explode('--', $_GET['brands']);
		}

		$page = 1;
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}
		if(isset($_GET['limit'])){
			$limit = (int)$_GET['limit'];
		}

		if(isset($_GET['price'])){
			$price = explode('--', $_GET['price']);
			$bellow_price = $price[0];
			$above_price = $price[1];
		}

		// $getAllProduct = \backend\models\Product::find([
			// 'active' => 1, 
			// 'brands_brand_id' => 48, 
			// 'product_category_id' => [5,12]]
			// )
			// ->joinWith('productNewArrival')
			// ->orderBy(['product_newarrival.product_newarrival_end_date' => SORT_DESC])
			// ->all();

		// die(var_dump($getAllProduct));
		// if(count($getAllProduct) > 0){
			// foreach($getAllProduct as $product)
			// {
				// $id_prod[] = $product->product_id;
			// }
		// }
  
		// get all id product
		// $id_prod = $this->actionIdproductOB($brand_id,$id_prod);

		if( $current_date >= '2019-05-05 00:00:00' && $current_date <= '2019-05-13 00:00:00' ){
			$id_prod = array(1633, 1137, 833, 1102, 862, 1782, 1117, 847, 1471, 1421, 1483, 1122, 1164, 1139, 1476, 1166, 1167, 
						869, 1101, 1169, 861, 947, 1685, 1686, 1468, 1140, 959, 958, 1650, 1119, 1709, 1992, 2016, 1639, 1640, 
						1698, 1643, 1714, 1699, 1700, 1761, 2479, 1768, 2412, 2256, 2421, 2638, 1107, 1108, 1417, 1635, 2877, 
						2278, 2431, 2317, 2263, 2416, 2654, 2878, 1634, 2004, 2882, 1998);
		}		
		if( $current_date >= '2019-05-13 00:00:00' && $current_date <= '2019-05-20 00:00:00' ){
			$id_prod = array(855, 1474, 836, 1103, 1104, 1477, 1120, 889, 1687, 1403, 2414, 1775, 2017, 2019, 1774, 1795, 1475, 
						1426, 1464, 1662, 2665, 2885, 1701, 2260, 2415, 1654, 2643, 2655, 2879, 1659, 2286, 2433, 2432, 2280, 
						2264, 1656, 1652, 2002, 2003, 2279, 2645, 1663, 2856, 2011, 2012, 2024, 1660, 1661, 1398, 1785, 1636, 
						1637, 1645, 1696, 1697, 1759, 1707, 1769, 2009, 2636, 2276, 2013, 1783, 2014);
		}
		if( $current_date >= '2019-05-20 00:00:00' && $current_date <= '2019-05-27 00:00:00' ){
			$id_prod = array(1479, 835, 953, 1406, 1141, 1407, 1123, 1422, 1408, 1995, 1760, 1642, 1779, 1467, 1462, 1463, 
						1470, 2018, 1424, 1780, 2025, 1781, 2666, 1776, 2023, 1766, 1777, 1762, 2265, 1644, 1713, 1999, 
						2000, 2001, 2020, 2021, 2864, 2865, 2272, 2273, 2854, 1704, 2007, 2008, 2268, 2646, 2647, 1767, 
						2659, 2660, 1695, 1647, 1694, 1771, 1764, 1996, 2411, 2874, 1431, 1772, 1784, 1610, 1111, 1608);
		}
		if( $current_date >= '2019-05-27 00:00:00' && $current_date <= '2019-06-01 00:00:00' ){
			$id_prod = array(855, 1633, 1137, 1479, 835, 833, 1102, 862, 1782, 1117, 847, 1471, 1474, 836, 1103, 1104, 
						1421, 1483, 1122, 1164, 1139, 1476, 1166, 1167, 1477, 869, 1101, 1169, 1120, 889, 861, 947, 
						1685, 1686, 953, 1687, 1468, 1403, 1140, 959, 958, 1650, 1119, 1406, 1141, 1407, 1123, 1422, 
						1408, 1709, 1992, 1995, 1760, 2016, 1639, 1640, 1698, 1642, 1643, 1714, 1699, 1700, 1779, 1761, 
						2479, 1768, 2412, 2256, 2421, 2638, 1107, 1108, 1417, 1467, 1462, 1635, 1463, 1470, 2414, 2877, 
						1775, 2017, 2018, 2019, 1774, 1795, 1475, 1424, 1426, 1464, 1662, 1780, 2025, 1781, 2665, 2885, 
						2278, 2431, 2317, 2263, 2416, 2654, 2878, 1701, 2666, 2260, 2415, 1776, 2023, 1766, 1777, 1654, 
						2643, 2655, 2879, 1659, 1762, 2286, 2433, 2265, 2432, 2280, 2264, 1644, 1656, 1713, 1652, 1999, 
						2000, 2001, 2020, 2002, 2021, 2003, 2279, 2645, 1634, 1663, 2004, 2864, 2865, 2272, 2273, 2854, 
						2856, 1704, 2007, 2008, 2268, 2646, 2647, 2011, 2012, 1767, 2024, 2882, 1660, 1661, 2659, 2660, 
						1398, 1695, 1785, 1636, 1637, 1645, 1696, 1647, 1697, 1759, 1707, 1769, 2009, 2636, 1694, 1771, 
						1764, 1998, 1996, 2411, 2276, 2874, 2013, 1431, 1783, 1772, 2014, 1784, 1610, 1111, 1608);
		}

		// query product and filter
		$products = $this->actionProductSort($id_prod,$brand_id,$page,$limit);
		$product_count = $this->actionCountproduct($id_prod,$brand_id,$page,$limit);

		$data = [
			'Olivia Burton - Ramadhan Deals',
			'Dalam rangka menyambut bulan Ramadhan, The Watch Co. memberikan Ramadhan Deals untuk kamu di setiap pembelian produk Olivia Burton. 
			Syarat dan ketentuan sebagai berikut: <br/><br/>

			1.            Promo Olivia Burton hanya berlaku di halaman ini dengan menggunakan kode voucher: <strong>OBREDEALS</strong><br/>
			2.            Berlaku untuk semua metode pembayaran termasuk bank transfer, Virtual Account, kartu kredit (full payment dan cicilan), akulaku, vospay, kredivo, dan go-pay<br/>
			3.            Cicilan 0% kartu kredit berlaku untuk minimum pembelian Rp. 500.000,- dengan tenor 3, 6, dan 12 bulan<br/>
			4.            Gratis ongkir ke seluruh Indonesia bisa didapatkan dengan minimum pembelian Rp. 1.000.000,-<br/>
			5.            Setiap pembelian produk dikenakan biaya asuransi pengiriman sebagai tambahan agar produk yang anda pesan lebih aman sampai tujuan<br/>
			6.            Promo ini tidak bisa digabungkan dengan promo lainnya<br/>
			7.            Produk yang sudah dipesan tidak dapat dibatalkan dengan alasan apapun, kecuali terjadi kerusakan dari pabrikan<br/>
			8.            Jika transaksi dibatalkan oleh pihak The Watch Co. karena suatu hal (stok habis atau lainnya), dana Anda akan dikembalikan 100%<br/>
			9.            Dengan mengikuti promo ini, pengguna dianggap mengerti dan menyetujui semua syarat dan ketentuan yang berlaku',
			'https://thewatch.co/img/landing/obdeals/detail-banner-ob-deals.jpg'
		];
		
        $this->title = 'OB Ramadhan Deals 2019 – The Watch Co.';
		\Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'OB Ramadhan Deals 2019 – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Dalam rangka menyambut bulan Ramadhan, The Watch Co. memberikan Ramadhan Deals untuk kamu di setiap pembelian produk Olivia Burton. Beli Sekarang!']);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dalam rangka menyambut bulan Ramadhan, The Watch Co. memberikan Ramadhan Deals untuk kamu di setiap pembelian produk Olivia Burton. Beli Sekarang!']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'OB Ramadhan Deals 2019 – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo ramadhan, promo ramadhan 2019']);
		\Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

		return $this->render('obdeals', array(
			"products" => $products, 
			"count" => $product_count, 
			"limit" => $limit, 
			"data" => $data,
			"page"=>$page,
			"brands"=>$default_brand
		));
	}
	
	
	public function actionPromoBank()
	{        
    $this->title = 'Promo Bank 2019 – The Watch Co.';
		\Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo Bank 2019 – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Dalam rangka menyambut bulan Kemerdekaan, The Watch Co. memberikan Promo Bank untuk kamu di setiap pembelian produk jam tangan di website kami. Beli Sekarang!']);
    \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dalam rangka menyambut bulan Kemerdekaan, The Watch Co. memberikan Promo Bank untuk kamu di setiap pembelian produk jam tangan di website kami. Beli Sekarang!']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Bank 2019 – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo jam tangan, promo bank, promo bank 2019']);
		\Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

    $data = array();
		return $this->render('promo_bank', array(
      "data" => $data
		));
  }
  
    public function actionOfflineCatalog()
	{        
    $this->title = 'Offline Catalog – The Watch Co.';
		\Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'Promo Bank 2019 – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => 'Dalam rangka menyambut bulan Kemerdekaan, The Watch Co. memberikan Promo Bank untuk kamu di setiap pembelian produk jam tangan di website kami. Beli Sekarang!']);
    \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Dalam rangka menyambut bulan Kemerdekaan, The Watch Co. memberikan Promo Bank untuk kamu di setiap pembelian produk jam tangan di website kami. Beli Sekarang!']);
		\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => 'Promo Bank 2019 – The Watch Co.']);
		\Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => 'promo jam tangan, promo bank, promo bank 2019']);
		\Yii::$app->view->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);

    $data = array();
		return $this->render('offline-catalog', array(
      "data" => $data
		));
  }

}
