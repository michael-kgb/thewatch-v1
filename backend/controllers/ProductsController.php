<?php

namespace backend\controllers;

use Yii;
use backend\models\Product;
use backend\models\BrandsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\components\Helpers;

/**
 * BrandsController implements the CRUD actions for Brands model.
 */
class ProductsController extends \backend\core\controller\BackendController {

    public function behaviors() {
		
		if(!Yii::$app->session->get('userInfo')){
			return $this->redirect(Yii::$app->params['backendLoginUrl']);
		}
		
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        if ($permissions['view_access'] != '1') {
            return $this->redirect(Yii::$app->params['backendPermissionDeniedUrl']);
        }

        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'create' => ['post'],
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Brands models.
     * @return mixed
     */
    public function actionIndex() {
        $data = \backend\models\Product::getAllProducts();

        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        return $this->render('index', [
                    'data' => $data, 'add_access' => $permissions['add_access'], 'update_access' => $permissions['update_access'], 'delete_access' => $permissions['delete_access']
        ]);
    }

    /**
     * Displays a single Brands model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }
	
	public function actionGeneratereport($type){
		$type = $_GET['type'];
// 		$type = json_decode($type);
        // echo $type;
		$type = explode(" ",$type);
// 		print_r($type);die();
		$connection = Yii::$app->getDb();
				$command = $connection->createCommand("
					SELECT 
						product.price,
						product.active,
						product_detail.sku_number,
						product_detail.description,
						product_detail.link_rewrite,
						product.product_id,
						product_detail.name,
						brands.brand_name,
						product_image.product_image_id,
						GROUP_CONCAT(product_feature_value.feature_value_name SEPARATOR ', ') AS gender
					FROM product 
					LEFT JOIN brands ON product.brands_brand_id = brands.brand_id
					LEFT JOIN product_detail ON product.product_id = product_detail.product_id
					LEFT JOIN product_image ON product.product_id = product_image.product_id
					LEFT JOIN product_feature ON product.product_id = product_feature.product_id
					LEFT JOIN product_feature_value ON product_feature_value.feature_value_id = product_feature.feature_value_id
					WHERE (product_image.cover = 1 OR product_image.product_image_id is NULL) AND product.product_category_id = $type[1] AND (product_feature.feature_id = 1 OR product_feature.feature_id is NULL) OR brands.brand_id is NULL
					GROUP BY product.product_id
					ORDER BY product.product_id DESC
				
				");
				
				$data = $command->queryAll();
		if($type[0] == 'excel'){
		    if($type[2] != 0 && $type[1] != 0){
		        $command = $connection->createCommand("
					SELECT 
						product.price,
						product.active,
						product_detail.sku_number,
						product_detail.description,
						product_detail.link_rewrite,
						product.product_id,
						product_detail.name,
						brands.brand_name,
						product_image.product_image_id,
						GROUP_CONCAT(product_feature_value.feature_value_name SEPARATOR ', ') AS gender
					FROM product 
					LEFT JOIN brands ON product.brands_brand_id = brands.brand_id
					LEFT JOIN product_detail ON product.product_id = product_detail.product_id
					LEFT JOIN product_image ON product.product_id = product_image.product_id
					LEFT JOIN product_feature ON product.product_id = product_feature.product_id
					LEFT JOIN product_feature_value ON product_feature_value.feature_value_id = product_feature.feature_value_id
					WHERE (product_image.cover = 1 OR product_image.product_image_id is NULL) AND product.product_category_id = $type[1] AND (product_feature.feature_id = 1 OR product_feature.feature_id is NULL) AND brands.brand_id = $type[2]
					GROUP BY product.product_id
					ORDER BY product.product_id DESC
				
				");
				$data = $command->queryAll();
		    }
			\common\components\PHPExcel_Helper::generateProduct('Excel',$data);
			// die(var_dump($data));
		}
	}

    /**
     * Creates a new Brands model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Product();

        if (Yii::$app->request->post()) {

            $productDetail = new \backend\models\ProductDetail();

            $model->attributes = $_POST['Product'];
            if($model->product_sub_category_id == null){
                $model->product_sub_category_id = 0;
            }
            
            try {
                $model->width = 0;
                $model->weight = 0;
                $model->height = 0;
                $model->date_created = date("Y-m-d H:i:s");
                $model->save();
            } catch (Exception $ex) {
                print_r($model->getErrors());
                die();
            }

            $productDetail->product_id = $model->product_id;
            $productDetail->name = $_POST['ProductDetail']['name'];
            $productDetail->sku_number = $_POST['ProductDetail']['sku_number'];
            $productDetail->spesification = $_POST['ProductDetail']['spesification'];
            $productDetail->description = $_POST['ProductDetail']['description'];
            $productDetail->product_size_info = $_POST['ProductDetail']['product_size_info'];
            $productDetail->product_care = $_POST['ProductDetail']['product_care'];
            $productDetail->meta_title = $_POST['ProductDetail']['meta_title'];
            $productDetail->meta_keywords = $_POST['ProductDetail']['meta_keywords'];

            if (strlen($_POST['ProductDetail']['meta_description']) <= 150) {
                $productDetail->meta_description = $_POST['ProductDetail']['meta_description'];
            } else {
                $productDetail->meta_description = substr($_POST['ProductDetail']['meta_description'], 0, 149);
            }
			
			$linkRewrite = str_replace(' ', '-', $_POST['ProductDetail']['name']); // Replaces all spaces with hyphens.

			$productUrl = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $linkRewrite));

            $productDetail->link_rewrite = $_POST['ProductDetail']['link_rewrite'] === NULL ? $productUrl : $productUrl;

            $productStock = new \backend\models\ProductStock();
            $productStock->product_attribute_id = 0;
            $productStock->quantity = 0;
            $productStock->product_id = $model->product_id;
            $productStock->save();

            if (!empty($_POST['ProductNewArrival'])) {
                $newarrival = new \backend\models\ProductNewarrival();
                $newarrival->product_id = $model->product_id;
                $newarrival->product_newarrival_start_date = $_POST['ProductNewArrival']['new_arrival_from'];
                $newarrival->product_newarrival_end_date = $_POST['ProductNewArrival']['new_arrival_to'];
                try {
                    $newarrival->save();
                } catch (Exception $ex) {
                    print_r($newarrival->getErrors());
                    die();
                }
            }

            try {
                $productDetail->save();
            } catch (Exception $ex) {
                print_r($productDetail->getErrors());
                die();
            }

            return $this->redirect('index');
        } else {
            $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
            $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

            if ($permissions['add_access'] != '1') {
                return $this->redirect('../permissionscheck');
            }

            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Brands model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    private function wishlistEmailNewStock($id, $key){
        $customerWishlist = \backend\models\CustomerWishlistDetail::find()->where(['product_id'=>$id, 'product_attribute_id'=>$key])->with('customerWishlist.customer')->asArray()->all();
        $productWishlist = \backend\models\Product::find()->where(['product_id'=>$id])->with('productDetail')->asArray()->all();
		$productImage = \backend\models\ProductImage::find()->where(["product_id" => $id, "cover"=> 1])->asArray()->all();
       
       if (!empty($customerWishlist)) {
           foreach($customerWishlist as $keyWishlist => $valueWishlist){
               \common\components\Helpers::sendEmailMandrillUrlAPI(
                   $this->renderFile('@app/views/template/mail/wishlist/new_stock.php', array(
                       "product_id" => $productWishlist[0]['product_id'],
                       "link_rewrite" => $productWishlist[0]['productDetail']['link_rewrite'],
                       "product_name" => $productWishlist[0]['productDetail']['name'],
					   "product_image"=>$productImage[0]['product_image_id']
                   )), 
                   'The Watch Co - New Stock - '.$productWishlist[0]['productDetail']['name'], 
                   Yii::$app->params['adminEmail'], 
                   $valueWishlist['customerWishlist']['customer']['email'], 
                   '' 
               );
           }
       }
    }

    private function wishlistEmailDiscount($id, $type, $amount, $label_type, $label, $is_flashsale){
        
        $customerWishlist = \backend\models\CustomerWishlistDetail::find()->where(['product_id'=>$id])->with('customerWishlist.customer')->asArray()->all();
        $productWishlist = \backend\models\Product::find()->where(['product_id'=>$id])->with('productDetail')->asArray()->all();
		$productImage = \backend\models\ProductImage::find()->where(["product_id" => $id, "cover"=> 1])->asArray()->all();
       
       if (!empty($customerWishlist)) {
           foreach($customerWishlist as $keyWishlist => $valueWishlist){
               \common\components\Helpers::sendEmailMandrillUrlAPI(
                   $this->renderFile('@app/views/template/mail/wishlist/discount.php', array(
                       "product_id" => $productWishlist[0]['product_id'],
                       "link_rewrite" => $productWishlist[0]['productDetail']['link_rewrite'],
                       "product_name" => $productWishlist[0]['productDetail']['name'],
					   "product_image"=>$productImage[0]['product_image_id'],
                       "type"=>$type,
                       "amount"=> $amount,
                       "label_type"=>$label_type,
                       "label"=> $label,
                       "is_flashsale"=>$is_flashsale
                   )), 
                   'The Watch Co - Discount - '.$productWishlist[0]['productDetail']['name'], 
                   Yii::$app->params['adminEmail'], 
                   $valueWishlist['customerWishlist']['customer']['email'], 
                   '' 
               );
           }
       }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $productDetail = \backend\models\ProductDetail::findOne($id);
        $productImage = \backend\models\ProductImage::find()
                ->where(["product_id" => $id])
                ->orderBy("position")
                ->all();

        $productRelated = \backend\models\ProductRelated::find()
                ->joinWith([
                    "productDetail",
                    "product"
                ])
                ->where(["product_parent_id" => $id])
                ->all();

        $productsRelated = \backend\models\ProductRelated::find()
                ->select('product_id')
                ->where(["product_parent_id" => $id]);

        $products = Product::find()
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "productImage",
                    "productCategory",
                    "productRelated"
                ])
                ->where(["not in", "product.product_id", $productsRelated])
                ->orderBy("brands.brand_name ASC")
                ->all();

        $productAttributeCombination = \backend\models\ProductAttributeCombination::find()
                ->joinWith([
                    "productAttribute",
                    "attributes",
                    "attributeValue",
                    "productStock"
                ])
                ->where(["product_attribute.product_id" => $id])
                ->all();

        if ($model->load(Yii::$app->request->post())) {


//            print_r($_POST);
//            die();
            // product stock
            if (isset($_POST['ProductStock'])) {
                if (count($_POST['ProductStock']) > 0) {

                    // delete all product stock
                    // \backend\models\ProductStock::deleteAll('product_id = :product_id', [":product_id" => $id]);

                    foreach ($_POST['ProductStock'] as $key => $value) {
                        
                        
                        
                        
                        $product = \backend\models\ProductStock::findOne(["product_attribute_id" => $key, "product_id" => $id]);
                        $currentQuantity = $product->quantity;

                        if($currentQuantity == 0){
                           $this->wishlistEmailNewStock($id, $key);
                        }
                        

                        if (!empty($product)) {
                            $product->quantity = $value == NULL ? 0 : $value;
                            $product->save();
							
							$productHasAttribute = FALSE;
							
							$productAttribute = \backend\models\ProductAttributeCombination::findOne(['product_attribute_id' => $key]);
							
							if($productAttribute != NULL){
								$productHasAttribute = TRUE;
							}
							
							// create activity log for current quantity
							$log = new \backend\models\Log();
							$log->fullname = Yii::$app->session->get('userInfo')['fullname'];
							$log->module = Yii::$app->controller->id;
							$log->action = 'update';
							if($productHasAttribute){
								$log->action_text = 'user '. $log->fullname . ' update Quantity [' . $productAttribute->attributeValue->value . '] FROM ' . $currentQuantity . ' TO ' . $value;
							} else {
								$log->action_text = 'user '. $log->fullname . ' update Quantity FROM ' . $currentQuantity . ' TO ' . $value;
							}
							$log->date_time = date("Y-m-d H:i:s");
							$log->id_onChanged = $id;
							$log->save();
							
                        } else {
                            $productStock = new \backend\models\ProductStock();
                            $productStock->product_attribute_id = $key;
                            $productStock->product_id = $id;
                            $productStock->quantity = $value == NULL ? 0 : $value;
                            $productStock->save();
                        }
                        
                    }

                    

                    

                }
            }

            $model->attributes = $_POST['Product'];
            if($model->product_sub_category_id == null){
                $model->product_sub_category_id = 0;
            }
            
            if (isset($_POST['Product']['active'])) {
                $model->active = 1;
            } else {
                $model->active = 0;
            }
            
            if (isset($_POST['Product']['disable_click'])) {
                $model->disable_click = 1;
            } else {
                $model->disable_click = 0;
            }
            // new arrival
            if ($_POST['ProductNewArrival']['new_arrival_from'] != '' && $_POST['ProductNewArrival']['new_arrival_to'] != '') {
                \backend\models\ProductNewarrival::deleteAll(['product_id' => $model->product_id]);
                $newarrival = new \backend\models\ProductNewarrival();
                $newarrival->product_id = $model->product_id;
                $newarrival->product_newarrival_start_date = $_POST['ProductNewArrival']['new_arrival_from'];
                $newarrival->product_newarrival_end_date = $_POST['ProductNewArrival']['new_arrival_to'];
                try {
                    $newarrival->save();
                } catch (Exception $ex) {
                    print_r($newarrival->getErrors());
                    die();
                }
                
            } else {
                $newarrival = \backend\models\ProductNewarrival::find()->where(['product_id' => $id])->one();
                if($newarrival != NULL){
                    $newarrival->delete();
                }
            }

            //best sellers
            if ($_POST['ProductBestseller']['bestseller_from'] != '' && $_POST['ProductBestseller']['bestseller_to'] != '') {
                
                $bestseller = new \backend\models\ProductBestseller();
                $bestseller->product_id = $model->product_id;
                $bestseller->product_bestseller_start_date = $_POST['ProductBestseller']['bestseller_from'];
                $bestseller->product_bestseller_end_date = $_POST['ProductBestseller']['bestseller_to'];
                $bestseller->product_bestseller_sequence = $_POST['ProductBestseller']['bestseller_sequence'];
                try {
                    $bestseller->save();
                } catch (Exception $ex) {
                    print_r($bestseller->getErrors());
                    die();
                }
                
            } else {
                $bestseller = \backend\models\ProductBestseller::find()->where(['product_id' => $id])->one();
                if($bestseller != NULL){
                    $bestseller->delete();
                }
            }
			
			//preorder
            if($_POST['preorderFrom'] !='' && $_POST['preorderTo'] !=''){
//                echo $_POST['preorderFrom'];
//                echo $_POST['preorderTo'];
//                die();
                $productPreorder = \backend\models\ProductPreOrder::findOne(['product_id' => $id]);
                if($productPreorder == NULL){
                    $preorder = new \backend\models\ProductPreOrder();
                    $preorder->product_id = $id;
                    $preorder->product_pre_order_start_date = $_POST['preorderFrom'];
                    $preorder->product_pre_order_end_date = $_POST['preorderTo'];   
                    $preorder->save();
                }else{
                    $productPreorder->product_id = $id;
                    $productPreorder->product_pre_order_start_date = $_POST['preorderFrom'];
                    $productPreorder->product_pre_order_end_date = $_POST['preorderTo'];   
                    $productPreorder->save();
                }
                
            }
            
            // warranty
            if(isset($_POST['ProductWarranty']['warranty_name']) && isset($_POST['ProductWarranty']['warranty_year'])){
                $productWarranty = \backend\models\ProductWarranty::findOne(['product_id' => $id]);
                if($productWarranty == NULL){
                    $createWaranty = new \backend\models\ProductWarranty();
                    $createWaranty->product_id = $id;
                    $createWaranty->warranty_type_id = $_POST['ProductWarranty']['warranty_name'];
                    $createWaranty->product_warranty_year = $_POST['ProductWarranty']['warranty_year'];
                    $createWaranty->save();
                } else {
                    $productWarranty->product_id = $id;
                    $productWarranty->warranty_type_id = $_POST['ProductWarranty']['warranty_name'];
                    $productWarranty->product_warranty_year = $_POST['ProductWarranty']['warranty_year'];
                    $productWarranty->save();
                }
            }
            
            /*$bestseller = \backend\models\ProductBestseller::find()->where(['product_id' => $id])->one();
            if(!empty($bestseller)){
                $bestseller->delete();
            }*/

            // product tags
//            if (isset($_POST['ProductTags']['tags'])) {
//                $tag = explode(',', $_POST['ProductTags']['tags']);
//                $tags = array_unique($tag);

//                foreach($tags as $row){
//                    echo $row . '<br/>';
//                }
//                die();

//                \backend\models\ProductTag::deleteAll('product_id = :product_id', [":product_id" => $id]);
//
//                foreach ($tags as $row) {
//                    $string = ltrim($row);
//                    ;
//                    $check_tag = \backend\models\Tags::find()->where(['like', 'tag_name', $string])->one();
//
//                    $product_tag = new \backend\models\ProductTag();
//                    if (empty($check_tag)) {
//                        $save_tag = new \backend\models\Tags();
//                        $save_tag->tag_name = strtolower($string);
//                        $save_tag->apps_language_id = 1;
//                        $save_tag->save();
//
//                        $product_tag->tag_id = $save_tag->tag_id;
//                    } else {
//                        $product_tag->tag_id = $check_tag->tag_id;
//                    }
//                    $product_tag->product_id = $model->product_id;
//                    $product_tag->apps_language_id = 1;
//                    $product_tag->save();
//                }
//            } else {
//                \backend\models\ProductTag::deleteAll('product_id = :product_id', [":product_id" => $id]);
//            }

            if ($_POST['SpesificPrice']['value'] == 'percent' || $_POST['SpesificPrice']['value'] == 'amount' || $_POST['SpesificPrice']['value'] == 'flat') {
                
                // if flat price, calculate same like amount
                if($_POST['SpesificPrice']['value'] == 'flat'){
                    $product_ori_price = \backend\models\Product::findOne(['product_id' => $id])->price;
                    $_POST['SpesificPrice']['amount'] = $product_ori_price - $_POST['SpesificPrice']['amount'];
                    $_POST['SpesificPrice']['value'] = 'amount';
                }
                
                // check if data exist
                $checkDiscount = \backend\models\SpecificPrice::findOne(['product_id' => $id]);
                // echo $checkDiscount;echo '+';echo $_POST['SpesificPrice']['value'];die();
                if ($checkDiscount == NULL && $_POST['SpesificPrice']['value'] != 0) {
                   
                    // if product is flash sale
                    if($_POST['SpesificPrice']['is_flash_sale'] == 'on'){
                        
                        $fromPeriode = $_POST['SpesificPrice']['fromflash'];
                        $i = 0;
                        
                        if(count($fromPeriode) > 0){
                            foreach($fromPeriode as $periode){
                                $spesificPrice = new \backend\models\SpecificPrice();
                                $spesificPrice->currency_id = 1;
                                $spesificPrice->product_id = $id;
                                $spesificPrice->reduction_type = $_POST['SpesificPrice']['value'];
                                $spesificPrice->reduction = $_POST['SpesificPrice']['amount'];
                                $spesificPrice->from = $_POST['SpesificPrice']['fromflash'][$i];
                                $spesificPrice->to = $_POST['SpesificPrice']['toflash'][$i];
                                $spesificPrice->label_type = $_POST['SpesificPrice']['label_type'];
                                $spesificPrice->label = $_POST['SpesificPrice']['label'];
                                $spesificPrice->flash_sale_qty = $_POST['SpesificPrice']['flash_sale_qty'];
                                $spesificPrice->is_flash_sale = 1;
                                $this->wishlistEmailDiscount($id, $_POST['SpesificPrice']['value'], $_POST['SpesificPrice']['amount'], $_POST['SpesificPrice']['label_type'], $_POST['SpesificPrice']['label'], 1);
                                $spesificPrice->save();
                                
                                $i++;
                            }
                        }
                        
                    } else {
                        
                        $spesificPrice = new \backend\models\SpecificPrice();
                        $spesificPrice->currency_id = 1;
                        $spesificPrice->product_id = $id;
                        $spesificPrice->reduction_type = $_POST['SpesificPrice']['value'];
                        $spesificPrice->reduction = $_POST['SpesificPrice']['amount'];
                        $spesificPrice->from = $_POST['SpesificPrice']['from'];
                        $spesificPrice->to = $_POST['SpesificPrice']['to'];
                        $spesificPrice->label_type = $_POST['SpesificPrice']['label_type'];
                        $spesificPrice->label = $_POST['SpesificPrice']['label'];
                        $spesificPrice->is_flash_sale = 0;
                        $this->wishlistEmailDiscount($id, $_POST['SpesificPrice']['value'], $_POST['SpesificPrice']['amount'], $_POST['SpesificPrice']['label_type'], $_POST['SpesificPrice']['label'], 0);
                        $spesificPrice->save();
                    }
                    	
                    // create activity log for current discount
                    $log = new \backend\models\Log();
                    $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
                    $log->module = Yii::$app->controller->id;
                    $log->action = 'update';
                    $log->action_text = 'user '. $log->fullname . ' set Discount ' . $_POST['SpesificPrice']['amount'] . ' ' . $_POST['SpesificPrice']['value'] . ' Periode ' . $_POST['SpesificPrice']['from'] . ' - ' . $_POST['SpesificPrice']['to'];
                    $log->date_time = date("Y-m-d H:i:s");
                    $log->id_onChanged = $id;
                    $log->save();
					
					
                } else {
                    
                    if (empty($checkDiscount)) {
                    //   echo 'a';die();   
                        // if product is flash sale
                        if($_POST['SpesificPrice']['is_flash_sale'] == 'on'){
                            
                            $checkDiscount = \backend\models\SpecificPrice::deleteAll(['product_id' => $id]);
                            
                            $fromPeriode = $_POST['SpesificPrice']['fromflash'];
                            $i = 0;

                            if(count($fromPeriode) > 0){
                                foreach($fromPeriode as $periode){
                                    if($_POST['SpesificPrice']['fromflash'][$i] != NULL){
                                        $checkDiscount = new \backend\models\SpecificPrice();
                                        $checkDiscount->currency_id = 1;
                                        $checkDiscount->product_id = $id;
                                        $checkDiscount->reduction_type = $_POST['SpesificPrice']['value'];
                                        $checkDiscount->reduction = $_POST['SpesificPrice']['amount'];
                                        $checkDiscount->from = $_POST['SpesificPrice']['fromflash'][$i];
                                        $checkDiscount->to = $_POST['SpesificPrice']['toflash'][$i];
                                        $checkDiscount->label_type = $_POST['SpesificPrice']['label_type'];
                                        $checkDiscount->label = $_POST['SpesificPrice']['label'];
                                        $checkDiscount->flash_sale_qty = $_POST['SpesificPrice']['flash_sale_qty'];
                                        $checkDiscount->is_flash_sale = 1;
                                        $this->wishlistEmailDiscount($id, $_POST['SpesificPrice']['value'], $_POST['SpesificPrice']['amount'], $_POST['SpesificPrice']['label_type'], $_POST['SpesificPrice']['label'], 1);
                                        $checkDiscount->save();
                                    }
                                    $i++;
                                }
                            }
                            
                        } else {
                            
                            \backend\models\SpecificPrice::deleteAll(['product_id' => $id]);
                            
                            $checkDiscount = new \backend\models\SpecificPrice();
                            $checkDiscount->currency_id = 1;
                            $checkDiscount->product_id = $id;
                            $checkDiscount->reduction_type = $_POST['SpesificPrice']['value'];
                            $checkDiscount->reduction = $_POST['SpesificPrice']['amount'];
                            $checkDiscount->from = $_POST['SpesificPrice']['from'];
                            $checkDiscount->to = $_POST['SpesificPrice']['to'];
                            $checkDiscount->label_type = $_POST['SpesificPrice']['label_type'];
                            $checkDiscount->label = $_POST['SpesificPrice']['label'];
                            $checkDiscount->is_flash_sale = 0;
                            $this->wishlistEmailDiscount($id, $_POST['SpesificPrice']['value'], $_POST['SpesificPrice']['amount'], $_POST['SpesificPrice']['label_type'], $_POST['SpesificPrice']['label'], 0);
                            $checkDiscount->save();
                        }
						
                        // create activity log for current discount
                        $log = new \backend\models\Log();
                        $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
                        $log->module = Yii::$app->controller->id;
                        $log->action = 'update';
                        $log->action_text = 'user '. $log->fullname . ' set Discount ' . $_POST['SpesificPrice']['amount'] . ' ' . $_POST['SpesificPrice']['value'] . ' Periode ' . $_POST['SpesificPrice']['from'] . ' - ' . $_POST['SpesificPrice']['to'];
                        $log->date_time = date("Y-m-d H:i:s");
                        $log->id_onChanged = $id;
                        $log->save();
                    } else {
                        
                        // if product is flash sale
                        if($_POST['SpesificPrice']['is_flash_sale'] == 'on'){
                            
                            $checkDiscount = \backend\models\SpecificPrice::deleteAll(['product_id' => $id]);
                            
                            $fromPeriode = $_POST['SpesificPrice']['fromflash'];
                            $i = 0;

                            if(count($fromPeriode) > 0){
                                foreach($fromPeriode as $periode){
                                    if($_POST['SpesificPrice']['fromflash'][$i] != NULL){
                                        $checkDiscount = new \backend\models\SpecificPrice();
                                        $checkDiscount->currency_id = 1;
                                        $checkDiscount->product_id = $id;
                                        $checkDiscount->reduction_type = $_POST['SpesificPrice']['value'];
                                        $checkDiscount->reduction = $_POST['SpesificPrice']['amount'];
                                        $checkDiscount->from = $_POST['SpesificPrice']['fromflash'][$i];
                                        $checkDiscount->to = $_POST['SpesificPrice']['toflash'][$i];
                                        $checkDiscount->label_type = $_POST['SpesificPrice']['label_type'];
                                        $checkDiscount->label = $_POST['SpesificPrice']['label'];
                                        $checkDiscount->flash_sale_qty = $_POST['SpesificPrice']['flash_sale_qty'];
                                        $checkDiscount->is_flash_sale = 1;
                                        $this->wishlistEmailDiscount($id, $_POST['SpesificPrice']['value'], $_POST['SpesificPrice']['amount'], $_POST['SpesificPrice']['label_type'], $_POST['SpesificPrice']['label'], 1);
                                        $checkDiscount->save();
                                    }
                                    $i++;
                                }
                            }
                            
                        } else {
                            // echo 'c';die(); 
                            \backend\models\SpecificPrice::deleteAll(['product_id' => $id]);
                            if($_POST['SpesificPrice']['from'] != NULL){
                                $checkDiscount = new \backend\models\SpecificPrice();
                                $checkDiscount->currency_id = 1;
                                $checkDiscount->product_id = $id;
                                $checkDiscount->reduction = $_POST['SpesificPrice']['amount'];
                                $checkDiscount->reduction_type = $_POST['SpesificPrice']['value'];
                                $checkDiscount->from = $_POST['SpesificPrice']['from'];
                                $checkDiscount->to = $_POST['SpesificPrice']['to'];
                                $checkDiscount->label_type = $_POST['SpesificPrice']['label_type'];
                                $checkDiscount->label = $_POST['SpesificPrice']['label'];
                                $checkDiscount->is_flash_sale = 0;
                                $this->wishlistEmailDiscount($id, $_POST['SpesificPrice']['value'], $_POST['SpesificPrice']['amount'], $_POST['SpesificPrice']['label_type'], $_POST['SpesificPrice']['label'], 0);
                                $checkDiscount->save();
                            } else {
                                \backend\models\SpecificPrice::deleteAll(['product_id' => $id]);
                            }
                            
                        }
						
                        // create activity log for current discount
                        $log = new \backend\models\Log();
                        $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
                        $log->module = Yii::$app->controller->id;
                        $log->action = 'update';
                        $log->action_text = 'user '. $log->fullname . ' set Discount ' . $_POST['SpesificPrice']['amount'] . ' ' . $_POST['SpesificPrice']['value'] . ' Periode ' . $_POST['SpesificPrice']['from'] . ' - ' . $_POST['SpesificPrice']['to'];
                        $log->date_time = date("Y-m-d H:i:s");
                        $log->id_onChanged = $id;
                        $log->save();
                    }
                }
                if ($_POST['SpesificPrice']['value'] == 'none') {
                    $checkDiscount = \backend\models\SpecificPrice::findOne(['product_id' => $id]);
                    if (!empty($checkDiscount)) {
                        $checkDiscount->deleteAll();
                    }
                }
            }else{
                \backend\models\SpecificPrice::deleteAll(['product_id' => $id]);
            }
			
			if(isset($_POST['ProductLocation']['value'])){
                $checkProductLocation = \backend\models\ProductDetail::findOne(['product_id' => $id]);
                if($checkProductLocation != NULL){
                    $checkProductLocation->shipping_availability_location_id = $_POST['ProductLocation']['value'];
                    $checkProductLocation->save();
                }
            }

            $productDetail->product_id = $model->product_id;
            $productDetail->name = $_POST['ProductDetail']['name'];
            $productDetail->sku_number = $_POST['ProductDetail']['sku_number'];
            $productDetail->spesification = $_POST['ProductDetail']['spesification'];
            $productDetail->description = $_POST['ProductDetail']['description'];
            $productDetail->product_size_info = $_POST['ProductDetail']['product_size_info'];
            $productDetail->product_care = $_POST['ProductDetail']['product_care'];
            $productDetail->meta_title = $_POST['ProductDetail']['meta_title'];
            $productDetail->meta_keywords = $_POST['ProductDetail']['meta_keywords'];
            if (strlen($_POST['ProductDetail']['meta_description']) <= 150) {
                $productDetail->meta_description = $_POST['ProductDetail']['meta_description'];
            } else {
                $productDetail->meta_description = substr($_POST['ProductDetail']['meta_description'], 0, 149);
            }
            $productDetail->link_rewrite = $_POST['ProductDetail']['link_rewrite'];

            $imageCoverOld = \backend\models\ProductImage::findOne(["cover" => 1, "product_id" => $id]);
            if (count($imageCoverOld) > 0) {
                $imageCoverOld->cover = NULL;
                $imageCoverOld->update();
            }

            // related product 
            if (isset($_POST['relatedItems'])) {
                if (count($_POST['relatedItems']) > 0) {

                    // delete all related product
                    \backend\models\ProductRelated::deleteAll(['product_parent_id' => $id]);

                    foreach ($_POST['relatedItems'] as $item) {
                        $relatedItems = new \backend\models\ProductRelated();
                        $relatedItems->product_parent_id = $id;
                        $relatedItems->product_id = $item;
                        $relatedItems->save();
                    }
                }
            } else {
                \backend\models\ProductRelated::deleteAll('product_parent_id = :product_id', [":product_id" => $id]);
            }



            // carrier shipping 
            if (isset($_POST['carrierShipping'])) {
                if (count($_POST['carrierShipping']) > 0) {

                    // delete all carrier shipping
                    \backend\models\ProductCarrier::deleteAll('product_id = :product_id', [":product_id" => $id]);

                    foreach ($_POST['carrierShipping'] as $row) {
                        $product_carrier = new \backend\models\ProductCarrier();
                        $product_carrier->product_id = $id;
                        $product_carrier->carrier_id = $row;
                        $product_carrier->save();
                    }
                }
            } else {
                // delete all carrier shipping
                \backend\models\ProductCarrier::deleteAll('product_id = :product_id', [":product_id" => $id]);
            }

            if (isset($_POST['ProductImage']['cover'])) {
                $imageCover = \backend\models\ProductImage::findOne(["product_image_id" => $_POST['ProductImage']['cover']]);
                $imageCover->product_image_id = $_POST['ProductImage']['cover'];
                $imageCover->cover = 1;
                $imageCover->update();
            }

            try {
                $productDetail->update();
            } catch (Exception $ex) {
                print_r($productDetail->getErrors());
                die();
            }
            
            try {
                $model->date_updated = date("Y-m-d H:i:s");
                $model->price_usd = $_POST['Product']['price_usd'];
                $model->save();
            } catch (Exception $ex) {
                print_r($model->getErrors());
                die();
            }

            //if (is_uploaded_file($_FILES['ProductImage']['tmp_name']['imageProducts'][0])) {
            // insert new images
            // $this->upload($id);
            //}
			
			// $getProductMC = Helpers::getProductMailchimp($model->product_id);
            
            // // if product is exist in mailchimp
            // if($getProductMC->title == 'Resource Not Found'){
            //     // create new product
            //     Helpers::createProductMailchimp($model->product_id);
            // } else {
            //     // update existing product in mailchimp
            //     Helpers::updateProductMailchimp($model->product_id);
            // }

            return $this->redirect(Yii::$app->urlManager->getBaseUrl() . '/products/index');
        } 
        else {
            $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
            $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

            if ($permissions['update_access'] != '1') {
                return $this->redirect('../../permissionscheck');
            }
            return $this->render('update', [
                        'model' => $model,
                        'productDetail' => $productDetail,
                        'productImage' => $productImage,
                        'products' => $products,
                        'id' => $id,
                        "productRelated" => $productRelated,
                        "productAttributeCombination" => $productAttributeCombination,
            ]);
        }
    }

    /**
     * Deletes an existing Brands model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        if (isset($_POST)) {
            try {
                $model = $this->findModel($id);
//                $filename = $model->brand_logo;

                if ($model->delete()) {
                    $productDetail = \backend\models\ProductDetail::find()->where(['product_id' => $id])->one();
                    $productDetail->delete();

                    $this->deleteFiles($id);
                    \backend\models\ProductImage::deleteAll(["product_id" => $id]);

                    $productAttribute = \backend\models\ProductAttribute::find()->where(['product_id' => $id])->all();

                    foreach ($productAttribute as $row) {
                        $productAttributeCombination = \backend\models\ProductAttributeCombination::deleteAll(['product_attribute_id' => $row->product_attribute_id]);
                        $productAttributeImage = \backend\models\ProductAttributeImage::deleteAll(['id_product_attribute' => $row->product_attribute_id]);
                    }

                    $productCarrier = \backend\models\ProductCarrier::deleteAll(['product_id' => $id]);
                    $productFeature = \backend\models\ProductFeature::deleteAll(['product_id' => $id]);
                    $productRelated = \backend\models\ProductRelated::deleteAll(['product_id' => $id]);
                    $productStock = \backend\models\ProductStock::deleteAll(['product_id' => $id]);
                    $productTag = \backend\models\ProductTag::deleteAll(['product_id' => $id]);

                    $newarrival = \backend\models\ProductNewarrival::find()->where(['product_id' => $id])->one();
                    if (!empty($newarrival)) {
                        $newarrival->delete();
                    }

                    \backend\models\ProductAttribute::deleteAll(['product_id' => $id]);
                }

                $product = Product::find()->all();

                $html = '';
                $no = 1;
                foreach ($product as $row) {
                    $active = $row->active === 1 ? "Active" : "Deactive";
                    $productId = count($row->productImage) > 0 ? $row->productImage->product_image_id : '';
                    $html .= '<tr>'
                            . '<td>' . $no . '</td>'
                            . '<td width="10%"><img src="' . Yii::$app->urlManagerFrontEnd->baseUrl . '/img/product/' . $productId . '/' . $productId . '.jpg" class="img-responsive"></td>'
                            . '<td width="25%">' . $row->productDetail->name . '</td>'
                            . '<td>' . $row->productCategory->product_category_name . '</td>'
                            . '<td>' . Helpers::getPriceFormat($row->price) . '</td>'
                            . '<td>' . $row->quantity . '</td>'
                            . '<td>' . $active . '</td>'
                            . '<td>'
                            . '<div class="btn-group">'
                            . '<button onclick="updateRecords(' . $row->product_id . ', products)"  type="button" class="btn btn-default"><i class="fa fa-fw fa-pencil"></i> Edit</button>'
                            . '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>'
                            . '<ul class="dropdown-menu" role="menu">
                                    <li><a href="#"><i class="fa fa-fw fa-eye"></i> Preview</a></li>
                                    <li><a href="#"><i class="fa fa-fw fa-copy"></i> Dupliacate</a></li>
                                    <li class="divider"></li>'
                            . '<li><a href="#" onclick="deleteRecord(' . $row->product_id . ', products);">
                                    <i class="fa fa-fw fa-trash"></i> Delete</a></li></ul></div>'
                            . '</td>'
                            . '</tr>';
                    $no++;
                }

                return json_encode(array("data" => $html));
            } catch (Exception $ex) {
                echo $ex;
                die();
            }
        }
    }
	
	/**
     * Duplicate an existing Product model.
     * If duplicate is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDuplicate($id) {
        $getProduct = $this->findModel($id);
        $getProductDetail = \backend\models\ProductDetail::findOne($id);
        $getProductImage = \backend\models\ProductImage::find()
                ->where(["product_id" => $id])
                ->all();
		$getProductStock = \backend\models\ProductStock::find()
				->where(["product_id" => $id])
				->all();
		$getProductFeature = \backend\models\ProductFeature::find()
				->where(["product_id" => $id])
				->all();
		$getProductNewArrival = \backend\models\ProductNewarrival::find()
				->where(["product_id" => $id])
				->all();
        $getProductRelated = \backend\models\ProductRelated::find()
                ->where(["product_parent_id" => $id])
                ->all();
        $getProductWarranty = \backend\models\ProductWarranty::find()
                ->where(["product_id" => $id])
                ->all();
        $getSpecificPrice = \backend\models\SpecificPrice::find()
                ->where(["product_id" => $id])
                ->all();
		
		$modelProduct = new \backend\models\Product();
		$modelProductDetail = new \backend\models\ProductDetail();
		
		/* Duplicate Product */
		$modelProduct->product_category_id = $getProduct->product_category_id;
		$modelProduct->product_sub_category_id = $getProduct->product_sub_category_id;
		$modelProduct->suppliers_supplier_id = $getProduct->suppliers_supplier_id;
		$modelProduct->category_id = $getProduct->category_id;
		$modelProduct->brands_brand_id = $getProduct->brands_brand_id;
		$modelProduct->brands_collection_id = $getProduct->brands_collection_id;
		$modelProduct->quantity = $getProduct->quantity;
		$modelProduct->minimal_quantity = $getProduct->minimal_quantity;
		$modelProduct->price = $getProduct->price;
		$modelProduct->price_usd = $getProduct->price_usd;
		$modelProduct->width = $getProduct->width;
		$modelProduct->height = $getProduct->height;
		$modelProduct->depth = $getProduct->depth;
		$modelProduct->weight = $getProduct->weight;
		$modelProduct->active = $getProduct->active;
		$modelProduct->available_for_order = $getProduct->available_for_order;
		$modelProduct->available_date = $getProduct->available_date;
		$modelProduct->show_price = $getProduct->show_price;
		$modelProduct->visibility = $getProduct->visibility;
		$modelProduct->product_sort = $getProduct->product_sort;
		$modelProduct->date_created = $getProduct->date_created;
        $modelProduct->date_updated = $getProduct->date_updated;
        $modelProduct->disable_click = $getProduct->disable_click;
		$modelProduct->save();
		
        $countProductDetail = \backend\models\ProductDetail::find()
				->where(["link_rewrite" => $getProductDetail->link_rewrite])
				->count();
		
		/* Duplicate Product Detail */
		$modelProductDetail->product_id = $modelProduct->product_id;
		$modelProductDetail->sku_number = "CHANGE_SKU_NUMBER";
		$modelProductDetail->apps_language_id = $getProductDetail->apps_language_id;
		$modelProductDetail->description = $getProductDetail->description;
		$modelProductDetail->spesification = $getProductDetail->spesification;
		$modelProductDetail->product_size_info = $getProductDetail->product_size_info;
		$modelProductDetail->product_care = $getProductDetail->product_care;
		$modelProductDetail->meta_description = $getProductDetail->meta_description;
		$modelProductDetail->meta_keywords = $getProductDetail->meta_keywords;
		$modelProductDetail->meta_title = $getProductDetail->meta_title;
		$modelProductDetail->available_now = $getProductDetail->available_now;
		$modelProductDetail->available_later = $getProductDetail->available_later;
		$modelProductDetail->shipping_availability_location_id = $getProductDetail->shipping_availability_location_id;
		$i = (int)$countProductDetail;
		if($i > 0){
			$n = $i + 1;
			$modelProductDetail->link_rewrite = $getProductDetail->link_rewrite."-".$n;
			$modelProductDetail->name = $getProductDetail->name." ".$n;
		}
		$modelProductDetail->save();
		
		/* Duplicate Product Image */
		// cannot be implemented yet
		/*
		$rows_d = array();
		foreach($getProductImage as $gpi){
			// $modelProductImage = new \backend\models\ProductImage();
			// $modelProductImage->product_id = $modelProduct->product_id;
			// $modelProductImage->position = $getProductImage->position == null ? 0:$getProductImage->position;
			// $modelProductImage->cover = $getProductImage->cover == null ? 0:$getProductImage->cover;
			// $modelProductImage->save();
		}
		*/
		
		/* Duplicate Product Stock */
		if(count($getProductStock) > 0){
			foreach($getProductStock as $gps){
				$modelProductStock = new \backend\models\ProductStock();
				$modelProductStock->product_id = $modelProduct->product_id;
				$modelProductStock->product_attribute_id = $gps->product_attribute_id;
				$modelProductStock->quantity = $gps->quantity;
				$modelProductStock->save();
			}
		}
		
		/* Duplicate Product Feature */
		if(count($getProductFeature) > 0){
			foreach($getProductFeature as $gpf){
				$modelProductFeature = new \backend\models\ProductFeature();
				$modelProductFeature->product_id = $modelProduct->product_id;
				$modelProductFeature->feature_id = $gpf->feature_id;
				$modelProductFeature->feature_value_id = $gpf->feature_value_id;
				$modelProductFeature->save();
			}
		}
		
		/* Duplicate Product New Arrival */
		if(count($getProductNewArrival) > 0){
			foreach($getProductNewArrival as $gpna){
				$modelProductNewArrival = new \backend\models\ProductNewarrival();
				$modelProductNewArrival->product_id = $modelProduct->product_id;
				$modelProductNewArrival->product_newarrival_start_date = $gpna->product_newarrival_start_date;
				$modelProductNewArrival->product_newarrival_end_date = $gpna->product_newarrival_end_date;
				$modelProductNewArrival->save(); 
			}
		}
		
		/* Duplicate Product Related */
		if(count($getProductRelated) > 0){
			foreach($getProductRelated as $gpr){
				$modelProductRelated = new \backend\models\ProductRelated();
				$modelProductRelated->product_id = $modelProduct->product_id;
				$modelProductRelated->product_parent_id = $gpr->product_parent_id;
				$modelProductRelated->save();
			}
		}
		
		/* Duplicate Product Warranty */
		if(count($getProductWarranty) > 0){
			foreach($getProductWarranty as $gpw){
				$modelProductWarranty = new \backend\models\ProductWarranty();
				$modelProductWarranty->product_id = $modelProduct->product_id;
				$modelProductWarranty->warranty_type_id = $gpw->warranty_type_id == null ? 0:$gpw->warranty_type_id;
				$modelProductWarranty->product_warranty_year = $gpw->product_warranty_year == null? "":$gpw->product_warranty_year;
				$modelProductWarranty->save();
			}
		}
		
		/* Duplicate Product SpecificPrice */
		if(count($getSpecificPrice) > 0){
			foreach($getSpecificPrice as $gsp){
				$modelSpecificPrice = new \backend\models\SpecificPrice();
				$modelSpecificPrice->product_id = $modelProduct->product_id;
				$modelSpecificPrice->currency_id = $gsp->currency_id;
				$modelSpecificPrice->customer_id = $gsp->customer_id;
				$modelSpecificPrice->product_attribute_id = $gsp->product_attribute_id;
				$modelSpecificPrice->from_quantity = $gsp->from_quantity;
				$modelSpecificPrice->reduction = $gsp->reduction;
				$modelSpecificPrice->reduction_extra = $gsp->reduction_extra;
				$modelSpecificPrice->reduction_plus_extra = $gsp->reduction_plus_extra;
				$modelSpecificPrice->reduction_type = $gsp->reduction_type;
				$modelSpecificPrice->label_type = $gsp->label_type;
				$modelSpecificPrice->label = $gsp->label;
				$modelSpecificPrice->description = $gsp->description;
				$modelSpecificPrice->from = $gsp->from;
				$modelSpecificPrice->to = $gsp->to;
				$modelSpecificPrice->is_flash_sale = $gsp->is_flash_sale;
				$modelSpecificPrice->flash_sale_qty = $gsp->flash_sale_qty;
				$modelSpecificPrice->save();
			}
		}
		
		return $this->redirect(Yii::$app->urlManager->getBaseUrl() . '/products/update/'.$modelProduct->product_id);
	}

    /**
     * Finds the Brands model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Brands the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function upload($productId) {
        $num_files = count($_FILES['ProductImage']['tmp_name']['imageProducts']);

        for ($i = 0; $i < $num_files; $i++) {
            $productImage = new \backend\models\ProductImage();
            $productImage->product_id = $productId;
//            $productImage->position = 1;
            $productImage->save();

            $imagePath = \Yii::getAlias("@frontend" . '/web/img/product/' . $productImage->product_image_id);

            // create directory
            mkdir($imagePath);

            $temp = explode(".", $_FILES["ProductImage"]["name"]['imageProducts'][$i]);

            // rename file
            $newfilename = $productImage->product_image_id . '.' . end($temp);
            $newfilename1 = $productImage->product_image_id . '_big.' . end($temp);
            $newfilename2 = $productImage->product_image_id . '_small.' . end($temp);

            $uploadedfile = $_FILES['ProductImage']['tmp_name']['imageProducts'][$i];
            $src = imagecreatefromjpeg($uploadedfile);

            list($width, $height) = getimagesize($uploadedfile);

            $newwidth = 500;
            $newheight = ($height / $width) * $newwidth;
            $tmp = imagecreatetruecolor($newwidth, $newheight);

            $newwidth1 = 900;
            $newheight1 = ($height / $width) * $newwidth1;
            $tmp1 = imagecreatetruecolor($newwidth1, $newheight1);

            $newwidth2 = 75;
            $newheight2 = ($height / $width) * $newwidth2;
            $tmp2 = imagecreatetruecolor($newwidth2, $newheight2);

            imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

            imagecopyresampled($tmp1, $src, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);

            imagecopyresampled($tmp2, $src, 0, 0, 0, 0, $newwidth2, $newheight2, $width, $height);

            $filename = $imagePath . "/" . $newfilename;

            $filename1 = $imagePath . "/" . $newfilename1;

            $filename2 = $imagePath . "/" . $newfilename2;

            imagejpeg($tmp, $filename, 100);

            imagejpeg($tmp1, $filename1, 100);

            imagejpeg($tmp2, $filename2, 100);

            imagedestroy($src);
            imagedestroy($tmp);
            imagedestroy($tmp1);
            imagedestroy($tmp2);
        }
    }

    private function deleteFiles($productId) {

        $imageFiles = \backend\models\ProductImage::find()->where(["product_id" => $productId])->all();

        if (count($imageFiles) > 0) {
            foreach ($imageFiles as $image) {
                $imagePath = \Yii::getAlias("@frontend" . '/web/img/product/' . $image->product_image_id);
                unlink($imagePath . '/' . $image->product_image_id . '.jpg');
                unlink($imagePath . '/' . $image->product_image_id . '_small.jpg');
                unlink($imagePath . '/' . $image->product_image_id . '_big.jpg');
                rmdir($imagePath);
            }
        }
    }

    public function actionSavecombination() {
        $product_id = $_POST['product_id'];
        $attribute_id = $_POST['attribute_id'];
        $attribute_value_id = $_POST['attribute_value_id'];

        for ($i = 0; $i < count($attribute_id); $i++) {
            $productattribute = new \backend\models\ProductAttribute();
            $productattribute->product_id = $product_id;
            $productattribute->save();

            if( strpos( $attribute_id[$i], "+" ) !== false ) {
                $att_list = explode("+",$attribute_id[$i]);
                $att_value_list = explode("+",$attribute_value_id[$i]);
                
                $productattribute_combination = new \backend\models\ProductAttributeCombination();
                $productattribute_combination->attribute_id = $att_list[0];
                $productattribute_combination->attribute_value_id = $att_value_list[0];
                $productattribute_combination->attribute_id_2 = $att_list[1];
                $productattribute_combination->attribute_value_id_2 = $att_value_list[1];
                $productattribute_combination->product_attribute_id = $productattribute->product_attribute_id;
                $productattribute_combination->save();

            }else{
                $productattribute_combination = new \backend\models\ProductAttributeCombination();
                $productattribute_combination->attribute_id = $attribute_id[$i];
                $productattribute_combination->attribute_value_id = $attribute_value_id[$i];
                $productattribute_combination->product_attribute_id = $productattribute->product_attribute_id;
                $productattribute_combination->save();

                
            }
                $product_stock = new \backend\models\ProductStock();
                $product_stock->product_id = $product_id;
                $product_stock->product_attribute_id = $productattribute->product_attribute_id;
                $product_stock->quantity = 0;
                $product_stock->save();
        }

        $no = 1;
        $table = "";

        $productAttributeCombination = \backend\models\ProductAttributeCombination::find()
                ->joinWith([
                    "productAttribute",
                    "attributes",
                    "attributeValue",
                    "productStock"
                ])
                ->where(["product_attribute.product_id" => $_POST['product_id']])
                ->all();

        foreach ($productAttributeCombination as $row) {
            $product_image_attribute = \backend\models\ProductAttributeImage::find()->where(['id_product_attribute' => $row->product_attribute_id])->one();
            if (count($product_image_attribute) != 0) {
                $set = "Set";
            } else {
                $set = "Not set";
            }

            $table = $table . '<tr><td>' . $no . '</td><td>' . $row->attributes->name . ' - ' . $row->attributeValue->value . ' , '. $row->attributes2->name . ' - ' . $row->attributeValue2->value . '</td><td>' . $set
                    . '</td><td><div class="btn-group">'
                    . '<button onclick="editCombination(' . $row->product_attribute_id . ",'" . $row->attributes->name . ' : ' . $row->attributeValue->value . "'" . ');" type="button" class="btn btn-default"><i class="fa fa-fw fa-pencil"></i> Edit</button>'
                    . '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button><ul class="dropdown-menu" role="menu">'
                    . '<li><a href="#" onclick="deleteCombination(' . $row->product_attribute_id . ');"><i class="fa fa-fw fa-trash"></i> Delete</a></li>'
                    . '</ul></div></td></tr>';
        }

        $productAttributeCombination = \backend\models\ProductAttributeCombination::find()
                ->joinWith([
                    "productAttribute",
                    "attributes",
                    "attributeValue",
                    "productStock"
                ])
                ->where(["product_attribute.product_id" => $product_id])
                ->all();

        $table2 = "";
        if (count($productAttributeCombination) > 0) {
            foreach ($productAttributeCombination as $row) {
                $table2 = $table2 . '<div class="col-sm-10 col-sm-offset-2" style="padding-top: 1%;">'
                        . '<div class="col-sm-4 col-sm-offset-1">'
                        . '<input type="number" value="' . $row->productStock->quantity . '" name="ProductStock[' . $row->product_attribute_id . ']" class="form-control" id="inputEmail3"></div>'
                        . '<div class="col-sm-7">' . $row->attributes->name . ' - ' . $row->attributeValue->value  .' , '. $row->attributes2->name . ' - ' . $row->attributeValue2->value . '</div></div>"';
            }
        } else {
            $table2 = $table2 . '<div class="col-sm-10 col-sm-offset-2" style="padding-top: 1%;">';
            $productStock = backend\models\ProductStock::findOne(["product_id" => $id]);
            $table2 = $table2 . '<div class="col-sm-4 col-sm-offset-1">'
                    . '<input type="number" value="' . $productStock->quantity . '" name="ProductStock[0]" class="form-control" id="inputEmail3"></div>'
                    . '<div class="col-sm-7"></div>';
        }

        $table_array = array($table, $table2);
        return json_encode($table_array);
    }

    public function actionEditimagecombination() {
        $image_id = $_POST['image_id'];
        $product_attribute_id = $_POST['product_attribute_id'];
        $last_image = \backend\models\ProductAttributeImage::deleteAll(['id_product_attribute' => $product_attribute_id]);

        for ($i = 0; $i < count($image_id); $i++) {
            $product_attribute_image = new \backend\models\ProductAttributeImage();
            $product_attribute_image->id_product_attribute = $product_attribute_id;
            $product_attribute_image->product_image_id = $image_id[$i];
            $product_attribute_image->save();
        }

        $no = 1;
        $table = "";

        $productAttributeCombination = \backend\models\ProductAttributeCombination::find()
                ->joinWith([
                    "productAttribute",
                    "attributes",
                    "attributeValue",
                    "productStock"
                ])
                ->where(["product_attribute.product_id" => $_POST['product_id']])
                ->all();

        foreach ($productAttributeCombination as $row) {
            $product_image_attribute = \backend\models\ProductAttributeImage::find()->where(['id_product_attribute' => $row->product_attribute_id])->one();
            if (count($product_image_attribute) != 0) {
                $set = "Set";
            } else {
                $set = "Not set";
            }

             $table = $table . '<tr><td>' . $no . '</td><td>' . $row->attributes->name . ' - ' . $row->attributeValue->value .' , '. $row->attributes2->name . ' - ' . $row->attributeValue2->value . '</td><td>' . $set
                    . '</td>'
                    . '<td>'
                    . '<div class="btn-group">'
                    . '<button onclick="editCombination(' . $row->product_attribute_id . ",'" . $row->attributes->name . ' : ' . $row->attributeValue->value . "'" . ');" type="button" class="btn btn-default"><i class="fa fa-fw fa-pencil"></i> Edit</button>'
                    . '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">'
                    . '<span class="caret"></span>'
                    . '<span class="sr-only">Toggle Dropdown</span>'
                    . '</button>'
                    . '<ul class="dropdown-menu" role="menu">'
                    . '<li><a href="#" onclick="deleteCombination(' . $row->product_attribute_id . ');"><i class="fa fa-fw fa-trash"></i> Delete</a></li>'
                    . '</ul>'
                    . '</div>'
                    . '</td>'
                    . '</tr>';
        }

        return $table;
    }

    public function actionGetstatusimage() {
        $id_product_attribute = $_POST['id_product_attribute'];
        $product_id = $_POST['product_id'];
        $i = 0;
        $status_image = array();

        $productImage = \backend\models\ProductImage::find()->where(['product_id' => $product_id])->all();
        $total = count($productImage);

        foreach ($productImage as $row) {
            $product_image_attribute = \backend\models\ProductAttributeImage::find()->where(['id_product_attribute' => $id_product_attribute, 'product_image_id' => $row->product_image_id])->one();
            if (count($product_image_attribute) != 0) {
                $status_image[$i] = 1;
            } else {
                $status_image[$i] = 0;
            }
            $i++;
        }
        return json_encode($status_image);
    }

    public function actionDeleteattributecombination() {
        $product_attribute_id = $_POST['product_attribute_id'];

        $product_attribute = \backend\models\ProductAttribute::deleteAll(['product_attribute_id' => $product_attribute_id]);
        $product_attribute_combination = \backend\models\ProductAttributeCombination::deleteAll(['product_attribute_id' => $product_attribute_id]);
        $product_attribute_image = \backend\models\ProductAttributeImage::deleteAll(['product_image_id' => $product_attribute_id]);

        $no = 1;
        $table = "";

        $productAttributeCombination = \backend\models\ProductAttributeCombination::find()
                ->joinWith([
                    "productAttribute",
                    "attributes",
                    "attributeValue",
                    "productStock"
                ])
                ->where(["product_attribute.product_id" => $_POST['product_id']])
                ->all();

        foreach ($productAttributeCombination as $row) {
            $product_image_attribute = \backend\models\ProductAttributeImage::find()->where(['id_product_attribute' => $row->product_attribute_id])->one();
            if (count($product_image_attribute) != 0) {
                $set = "Set";
            } else {
                $set = "Not set";
            }

            $table = $table . '<tr><td>' . $no . '</td><td>' . $row->attributes->name . ' - ' . $row->attributeValue->value .' , '. $row->attributes2->name . ' - ' . $row->attributeValue2->value . '</td><td>' . $set
                    . '</td>'
                    . '<td>'
                    . '<div class="btn-group">'
                    . '<button onclick="editCombination(' . $row->product_attribute_id . ",'" . $row->attributes->name . ' : ' . $row->attributeValue->value . "'" . ');" type="button" class="btn btn-default"><i class="fa fa-fw fa-pencil"></i> Edit</button>'
                    . '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">'
                    . '<span class="caret"></span>'
                    . '<span class="sr-only">Toggle Dropdown</span>'
                    . '</button>'
                    . '<ul class="dropdown-menu" role="menu">'
                    . '<li><a href="#" onclick="deleteCombination(' . $row->product_attribute_id . ');"><i class="fa fa-fw fa-trash"></i> Delete</a></li>'
                    . '</ul>'
                    . '</div>'
                    . '</td>'
                    . '</tr>';
        }

        return $table;
    }

    public function actionSaveproductfeature() {
        $product_id = $_POST['product_id'];
        $feature_id = $_POST['feature_id'];
        $feature_value_id = $_POST['feature_value_id'];
        $custom_feature_id = $_POST['custom_feature_id'];
        $custom_feature_name = $_POST['custom_feature_name'];
        $custom_feature_value = $_POST['custom_feature_value'];

        if ($feature_id[0] != "empty" && $feature_value_id[0] != "empty") {
            for ($i = 0; $i < count($feature_id); $i++) {
                $product_feature = New \backend\models\ProductFeature();
                $product_feature->product_id = $product_id;
                $product_feature->feature_id = $feature_id[$i];
                $product_feature->feature_value_id = $feature_value_id[$i];
                $product_feature->save();
            }
        }

        if ($custom_feature_id[0] != "empty" && $custom_feature_name[0] != "empty" && $custom_feature_value[0] != "empty") {
            for ($i = 0; $i < count($custom_feature_id); $i++) {
                $product_feature_value = New \backend\models\ProductFeatureValue();
                $product_feature_value->feature_id = $custom_feature_id[$i];
                $product_feature_value->feature_value_name = $custom_feature_name[$i];
                $product_feature_value->feature_value_value = $custom_feature_value[$i];
                $product_feature_value->save();

                $product_feature = New \backend\models\ProductFeature();
                $product_feature->product_id = $product_id;
                $product_feature->feature_id = $custom_feature_id[$i];
                $product_feature->feature_value_id = $product_feature_value->feature_value_id;
                $product_feature->save();
            }
        }

        $feature = \backend\models\ProductFeature::find()->where(['product_id' => $product_id])->all();
        $table = "";
        foreach ($feature as $row) {
            $title = \backend\models\Feature::findOne($row->feature_id);
            $value = \backend\models\ProductFeatureValue::findOne($row->feature_value_id);
            $table = $table . '<tr><td>'
                    . $title->feature_name
                    . '</td><td>'
                    . '<input type="text" class="form-control" value="'
                    . $value->feature_value_name
                    . '" disabled/></td><td><a onclick="deleteFeature('
                    . $row->product_feature_id
                    . ')" class="btn btn-default text-center"><i class="fa fa-close"></i> Delete</a></td></tr>';
        }

        $table2 = "";

        $feature = \backend\models\Feature::find()->all();
        foreach ($feature as $row) {
            $table2 = $table2
                    . '<tr><td>'
                    . $row->feature_name
                    . '</td><td><select id="feature_id'
                    . $row->feature_id
                    . '" class="form-control" name="product_feature[][]"><option>Please Select</option>';

            $value = \backend\models\ProductFeatureValue::find()->where(['feature_id' => $row->feature_id])->orderBy('feature_value_name ASC')->all();
            foreach ($value as $val) {
                $table2 = $table2
                        . '<option value = "'
                        . $val->feature_value_id
                        . '">'
                        . $val->feature_value_name
                        . '</option>';
            }

            $table2 = $table2
                    . '</select></td><td><input id="custom_value_name'
                    . $row->feature_id
                    . '" type="text" name="product_feature_custom[][]" class="form-control"/></td><td><input id="custom_value_value'
                    . $row->feature_id
                    . '" type="text" name="product_feature_value_custom[][]" class="form-control"/></td>'
                    . '<td><a onclick="duplicate('
                    . $row->feature_id
                    . ", '"
                    . $row->feature_name
                    . "'"
                    . ')" class="btn btn-default text-center"><i class="fa fa-copy"></i> Duplicate</a></td></tr>';
        }

        $table_array = array($table, $table2);
        return json_encode($table_array);
    }

    public function actionDeletefeature() {
        $product_feature_id = $_POST['product_feature_id'];
        $product_id = $_POST['product_id'];

        $productfeature = \backend\models\ProductFeature::findOne($product_feature_id);
        $productfeature->delete();

        $feature = \backend\models\ProductFeature::find()->where(['product_id' => $product_id])->all();
        $table = "";
        foreach ($feature as $row) {
            $title = \backend\models\Feature::findOne($row->feature_id);
            $value = \backend\models\ProductFeatureValue::findOne($row->feature_value_id);
            $table = $table . '<tr><td>'
                    . $title->feature_name
                    . '</td><td>'
                    . '<input type="text" class="form-control" value="'
                    . $value->feature_value_name
                    . '" disabled/></td><td><a onclick="deleteFeature('
                    . $row->product_feature_id
                    . ')" class="btn btn-default text-center"><i class="fa fa-close"></i> Delete</a></td></tr>';
        }
        return $table;
    }

    public function actionUpload() {

        for ($i = 0; $i < $_POST['total_image']; $i++) {
            $productImage = new \backend\models\ProductImage();
            $productImage->product_id = $_POST['product_id'];
            $productImage->save();

            $imagePath = \Yii::getAlias("@frontend" . '/web/img/product/' . $productImage->product_image_id);

            mkdir($imagePath);

            $temp = explode(".", $_FILES["image_upload" . $i]["name"]);

            $newfilename = $productImage->product_image_id . '.' . end($temp);
            $newfilename1 = $productImage->product_image_id . '_big.' . end($temp);
            $newfilename2 = $productImage->product_image_id . '_small.' . end($temp);
            $newfilename3 = $productImage->product_image_id . '_medium.' . end($temp);

            $uploadedfile = $_FILES['image_upload' . $i]['tmp_name'];
            $src = imagecreatefromjpeg($uploadedfile);

            list($width, $height) = getimagesize($uploadedfile);

            $newwidth = 266;
            $newheight = ($height / $width) * $newwidth;
            $tmp = imagecreatetruecolor($newwidth, $newheight);

            $newwidth1 = 900;
            $newheight1 = ($height / $width) * $newwidth1;
            $tmp1 = imagecreatetruecolor($newwidth1, $newheight1);

            $newwidth2 = 75;
            $newheight2 = ($height / $width) * $newwidth2;
            $tmp2 = imagecreatetruecolor($newwidth2, $newheight2);

            $newwidth3 = 500;
            $newheight3 = ($height / $width) * $newwidth3;
            $tmp3 = imagecreatetruecolor($newwidth3, $newheight3);

            imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

            imagecopyresampled($tmp1, $src, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);

            imagecopyresampled($tmp2, $src, 0, 0, 0, 0, $newwidth2, $newheight2, $width, $height);

            imagecopyresampled($tmp3, $src, 0, 0, 0, 0, $newwidth3, $newheight3, $width, $height);

            $filename = $imagePath . "/" . $newfilename;

            $filename1 = $imagePath . "/" . $newfilename1;

            $filename2 = $imagePath . "/" . $newfilename2;

            $filename3 = $imagePath . "/" . $newfilename3;

            imagejpeg($tmp, $filename, 90);

            imagejpeg($tmp1, $filename1, 90);

            imagejpeg($tmp2, $filename2, 90);

            imagejpeg($tmp3, $filename3, 90);

            imagedestroy($src);
            imagedestroy($tmp);
            imagedestroy($tmp1);
            imagedestroy($tmp2);
            imagedestroy($tmp3);
        }

        $productImage2 = \backend\models\ProductImage::find()->where(['product_id' => $_POST['product_id']])->all();
        $image = array();
        $i = 0;
        foreach ($productImage2 as $row) {
            if ($row->cover == 1) {
                $checked = "checked";
            } else {
                $checked = "";
            }

            $image[$i] = '<div class="col-sm-2" style="text-align: center;">'
                    . '<img width="75%" src="' . Yii::$app->urlManagerFrontEnd->baseUrl . '/img/product/' . $row->product_image_id . '/' . $row->product_image_id . '.jpg" />'
                    . '<br><br> <input type="radio" value="' . $row->product_image_id . '"' . $checked . ' name="ProductImage[cover]"><br><label>Set As Cover</label><br/><a onclick="deleteProductImage(' . $row->product_image_id . ')" class="btn btn-default"><i class="fa fa-trash"></i></a></div>';
            $i++;
        }

        $productImage = \backend\models\ProductImage::find()->where(['product_id' => $productImage->product_id])->all();
        $i = 0;
        $j = 0;

        foreach ($productImage as $row) {
            $i++;
            $imageCombination[$j] = '<div class="col-sm-3">'
                    . '<input id="checkbox' . $i . '" type="checkbox" name="product_image_combination[]" value="' . $row->product_image_id . '">'
                    . '<img src="/twcnew/frontend/web/img/product/' . $row->product_image_id . '/' . $row->product_image_id . '.jpg" style="width: 100%;">'
                    . '</div>';
            $j++;
        }


        $table = array($image, $imageCombination);
        return json_encode($table);
    }

    public function actionDeleteproductimage() {
        $productimageid = $_POST['product_image_id'];
        $product_id = $_POST['product_id'];
        $productimage = \backend\models\ProductImage::deleteAll(['product_image_id' => $productimageid]);
        $imagePath = \Yii::getAlias("@frontend" . '/web/img/product/' . $productimageid);
        if (file_exists($imagePath . '/' . $productimageid . '.jpg')) {
            unlink($imagePath . '/' . $productimageid . '.jpg');
        }
        if (file_exists($imagePath . '/' . $productimageid . '_small.jpg')) {
            unlink($imagePath . '/' . $productimageid . '_small.jpg');
        }
        if (file_exists($imagePath . '/' . $productimageid . '_big.jpg')) {
            unlink($imagePath . '/' . $productimageid . '_big.jpg');
        }
        if (file_exists($imagePath . '/' . $productimageid . '_big.jpg')) {
            unlink($imagePath . '/' . $productimageid . '_big.jpg');
        }
        if (file_exists($imagePath . '/' . $productimageid . '_medium.jpg')) {
            unlink($imagePath . '/' . $productimageid . '_medium.jpg');
        }
        if (file_exists($imagePath)) {
            rmdir($imagePath);
        }

        $productImage = \backend\models\ProductImage::find()->where(['product_id' => $product_id])->all();
        $image = array();
        $i = 0;
        foreach ($productImage as $row) {
            if ($row->cover == 1) {
                $checked = "checked";
            } else {
                $checked = "";
            }

            $image[$i] = '<div class="col-sm-2" style="text-align: center;">'
                    . '<img width="75%" src="' . Yii::$app->urlManagerFrontEnd->baseUrl . '/img/product/' . $row->product_image_id . '/' . $row->product_image_id . '.jpg" />'
                    . '<br><br> <input type="radio" value="' . $row->product_image_id . '"' . $checked . ' name="ProductImage[cover]"><br><label>Set As Cover</label><br/><a onclick="deleteProductImage(' . $row->product_image_id . ')" class="btn btn-default"><i class="fa fa-trash"></i></a></div>';
            $i++;
        }
        return json_encode($image);
    }

    public function actionCheckcollection($id) {
        $collection = \backend\models\BrandsCollection::find()->where(['brands_brand_id' => $id])->all();

        $text = "";

        if (!empty($collection)) {
            foreach ($collection as $row) {
                $text = $text . '<option value="' . $row->brands_collection_id . '">' . $row->brands_collection_name . '</option>';
            }
        } else {
            $text = '<option value="">Please select</option>';
        }

        return $text;
    }

    public function actionGetallproducts($draw) {
        $total_products = \backend\models\Product::find()->all();
        
        $queryTotalFind = \backend\models\Product::find()
            ->joinWith(['productDetail', 'brands', 'productCategory', 'brandsCollection', 'specificPrice']);
        
        $userFilter = FALSE;
        $userSearch = $_GET['search']['value'];
        
        $productCategoryId = $_GET['columns'][8]['search']['value'];
        $brandId = $_GET['columns'][4]['search']['value'];
        $brandsCollectionId = $_GET['columns'][6]['search']['value'];
        $filterDiscount = $_GET['columns'][10]['search']['value'];
        $fromDateDiscount = $_GET['columns'][11]['search']['value'];
        $toDateDiscount = $_GET['columns'][12]['search']['value'];
        $filterPriceFrom = $_GET['columns'][13]['search']['value'];
        $filterPriceTo = $_GET['columns'][14]['search']['value'];
        $filterParams = array();
        $searchParams = array();
        
        $queryProduct = \backend\models\Product::find()
            ->joinWith(['productDetail', 'brands', 'productCategory', 'brandsCollection', 'specificPrice']);
        
        $table = array('product_id', 'product_id', 'product_detail.sku_number', 'product_detail.name', 'brands.brand_name', 'brands_collection.brands_collection_name', 'product_category.product_category_name', 'price', 'product_id', 'active', 'product_id');
        $order = $table[$_GET['order'][0]['column']] . ' ' . $_GET['order'][0]['dir'];
        
        if($productCategoryId != ''){
            $userFilter = TRUE;
            $filterParams[] = ['=', 'product.product_category_id', $productCategoryId];
        }
        
        if($brandId != ''){
            $userFilter = TRUE;
            $filterParams[] = ['=', 'brands.brand_id', $brandId];
        }
        
        if($brandsCollectionId != 0){
            $userFilter = TRUE;
            $filterParams[] = ['=', 'brands_collection.brands_collection_id', $brandsCollectionId];
        }
        
        if($filterPriceFrom != 0 && $filterPriceTo != 0){
            $userFilter = TRUE;
            $filterParams[] = ['between', 'product.price', $filterPriceFrom, $filterPriceTo];
        }
        
        if($filterDiscount != ''){
            
            if($fromDateDiscount == ''){
                $fromDateDiscount = date("Y-m-d H:i:s");
                $toDateDiscount = date("Y-m-d H:i:s", strtotime("+7 days"));
            }
            
            // if user filter all discount type
            if($filterDiscount == 'all'){
                $filterParams[] = ['<=', 'specific_price.from', $fromDateDiscount];
                $filterParams[] = ['>', 'specific_price.to', $toDateDiscount];
            }
            
            $userFilter = TRUE;
            
            $discountTypePercent = strpos($filterDiscount, "percent=");
            
            // if discount value is percent
            if($discountTypePercent !== FALSE){
                $discountPercentValue = str_replace("percent=","", $filterDiscount);
                $filterParams[] = ['=', 'specific_price.reduction_type', 'percent'];
                $filterParams[] = ['=', 'specific_price.reduction', $discountPercentValue];
            }
            
            $discountTypeAmount = strpos($filterDiscount, "amount=");
            
            // if discount value is fixed amount
            if($discountTypeAmount !== FALSE){
                $discountAmountValue = str_replace("amount=","", $filterDiscount);
                $filterParams[] = ['=', 'specific_price.reduction_type', 'amount'];
                $filterParams[] = ['=', 'specific_price.reduction', $discountAmountValue];
            }
            
        }
        
        if($userFilter){
            
            foreach($filterParams as $filter){
                $queryTotalFind
                    ->andFilterWhere($filter);
                
                $queryProduct
                    ->andFilterWhere($filter);
            }
            
            if($userSearch != ''){
                $queryTotalFind
                    ->where(['like', 'product_detail.name', $_GET['search']['value']])
                    ->orWhere(['like', 'brands_collection.brands_collection_name', $_GET['search']['value']])
                    ->orWhere(['like', 'brands.brand_name', $_GET['search']['value']])
                    ->orWhere(['like', 'price', $_GET['search']['value']]);
                
                $queryProduct
                    ->where(['like', 'product_detail.name', $_GET['search']['value']])
                    ->orWhere(['like', 'brands_collection.brands_collection_name', $_GET['search']['value']])
                    ->orWhere(['like', 'brands.brand_name', $_GET['search']['value']])
                    ->orWhere(['like', 'price', $_GET['search']['value']]);
            }
                
        } else {
            
            if($userSearch != ''){
                
                $queryTotalFind
                    ->where(['like', 'product_detail.name', $_GET['search']['value']])
                    ->orWhere(['like', 'brands_collection.brands_collection_name', $_GET['search']['value']])
                    ->orWhere(['like', 'brands.brand_name', $_GET['search']['value']])
                    ->orWhere(['like', 'price', $_GET['search']['value']]);
                
                $queryProduct
                    ->where(['like', 'product_detail.name', $_GET['search']['value']])
                    ->orWhere(['like', 'brands_collection.brands_collection_name', $_GET['search']['value']])
                    ->orWhere(['like', 'brands.brand_name', $_GET['search']['value']])
                    ->orWhere(['like', 'price', $_GET['search']['value']]);
            }
            
        }
        
        $total_find = $queryTotalFind->all();
        $products = $queryProduct
                ->orderBy($order)->offset($_GET['start'])
                ->limit($_GET['length'])
                ->all();
        
        $data = '{
            "draw": ' . $_GET['draw'] . ',
            "recordsTotal": ' . count($total_products) . ',
            "recordsFiltered": ' . count($total_find) . ',
            "data": ';

        $columns = array();
        $numbering = $_GET['start'];

        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        if (!empty($products)) {
            foreach ($products as $row) {
                if ($row->price != '-') {
                    $price = \common\components\Helpers::getPriceFormat($row->price);
                } else {
                    $price = '-';
                }

                $product_image = \backend\models\ProductImage::find()->where(['product_id' => $row->product_id, 'cover' => 1])->orderBy('cover ASC')->one();
                if (count($product_image) != 0) {
                    $product_image_id = $product_image->product_image_id;
                } else {
                    $product_image_id = 0;
                }

                $active = $row->active == 1 ? 'Active' : 'Inactive';

                $productStock = \backend\models\ProductStock::findAll(["product_id" => $row->product_id]);
                $total_stock = 0;
                if (count($productStock) > 0) {
                    foreach ($productStock as $stock) {
                        $total_stock += $stock->quantity;
                    }
                }

                $button = "";

                $numbering++;
                $button = '<div class="btn-group">'
                        . '<a href="' . \yii\helpers\Url::base() . '/products/update/' . $row->product_id . '" class="btn btn-default"><i class="fa fa-fw fa-pencil"></i> Edit</a>
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                            <li><a href="#"><i class="fa fa-fw fa-eye"></i> Preview</a></li>
                            <li><a href="' . \yii\helpers\Url::base() . '/products/duplicate/' . $row->product_id . '" target="_blank"><i class="fa fa-fw fa-copy"></i> Duplicate</a></li>';

                if ($permissions['delete_access'] == 1) {
                    $button = $button . '<li class="divider"></li><li><a href="#" onclick="deleteRecord(' . $row->product_id . ', &#39;products&#39;);"><i class="fa fa-fw fa-trash"></i> Delete</a></li>';
                }

                $button = $button . '</ul></div>';

				$img_base = \Yii::$app->urlManagerFrontEnd->baseUrl;
                $image = '<img src="' . $img_base . '/img/product/' . $product_image_id . '/' . $product_image_id . '.jpg" class="img-responsive">';

                $product_array = array(
                    "No" => $numbering, 
                    "Image" => $image, 
                    "sku_number" => $row->productDetail->sku_number,
                    "product_name" => $row->productDetail->name,
                    "brand_name" => $row->brands->brand_name,
                    "brand_id" => $row->brands->brand_id,
                    "collection_name" => $row->brandsCollection->brands_collection_name,
                    "brands_collection_id" => $row->brandsCollection->brands_collection_id,
                    "category_name" => $row->productCategory->product_category_name, 
                    "product_category_id" => $row->productCategory->product_category_id,
                    "product_price" => $price, 
                    "filter_discount" => '',
                    "from_date_discount" => '',
                    "to_date_discount" => '',
                    "filter_price_from" => '',
                    "filter_price_to" => '',
                    "total_stock" => $total_stock, 
                    "active" => $active, 
                    "action" => $button
                );
                array_push($columns, $product_array);
            }
        }

        $data = $data . json_encode($columns) . '}';
        return $data;
    }

}
