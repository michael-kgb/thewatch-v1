<?php

namespace app\modules\cart\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Session;

/**
 * Site controller
 */
class VoucherController extends Controller {
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
    
	public function beforeAction($action)
	{            
		//if ($action->id == 'my-method') {
			$this->enableCsrfValidation = false;
		//}

		return parent::beforeAction($action);
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
    
    public function actionChineseNewYear(){
    	$now = date("Y-m-d H:i:s");
    	$data = [];
    	if(isset($_POST)){
    		$id = $_POST['id'];
    		$code = $_POST['code'];
    		$data[0] =  $code;
    		$data[1] =  $id;
    		$model = new \backend\models\CartRule();
    		$model->date_from = "2020-01-23 00:00:00";
    		$model->date_to = "2020-01-31 23:59:59";
    		$model->description = 'Chinese New Years Voucher';
    		$model->quantity = 1;
    		$model->priority = 1;
    		$model->partial_use = 1;
    		$model->code = $code;
    		$model->minimum_amount = 1000000;
    		$model->minimum_amount_currency = 1;
    		$model->reduction_currency = 1;
    		$model->highlight = 1;
    		$model->active = 1;
    		$model->date_add = $now;
    		$model->combined_with_other_promotion = 0;
    		if($id == 1){
    			$model->reduction_amount = 50000;
    		}else{
    			$model->reduction_amount = 100000;
    		}

    		if(isset($_SESSION['customerInfo']['customer_id'])){
    			$model->customer_id = $_SESSION['customerInfo']['customer_id'];
    		}
    		$model->save();
    		
    		$model2 = new \backend\models\CartRuleLang();
    		$model2->cart_rule_id = $model->cart_rule_id;
    		$model2->apps_language_id = 1;
    		$model2->name = 'Chinese New Year Voucher';
    		$model2->source = 'regular';
    		$model2->save();

    		setcookie('voucher_name', 'chinese_new_year', time() + (86400 * 30), "/");
    		setcookie('voucher_code', $code, time() + (86400 * 30), "/");
    		setcookie('voucher_type', $id, time() + (86400 * 30), "/");
    		setcookie('voucher_id', $model->cart_rule_id, time() + (86400 * 30), "/");
    		
    	}
    	return json_encode($data);
    }
    
    public function actionEasterEgg(){
    	$now = date("Y-m-d H:i:s");
    	$data = [];
    	if(isset($_POST)){
    		$id = $_POST['id'];
    		$code = $_POST['code'];
    		$data[0] =  $code;
    		$data[1] =  $id;
    		$model = new \backend\models\CartRule();
    		$model->date_from = "2020-04-01 00:00:00";
    		$model->date_to = "2020-04-12 23:59:59";
    		$model->description = 'Easter Egg';
    		$model->quantity = 1;
    		$model->priority = 1;
    		$model->partial_use = 1;
    		$model->code = $code;
    		$model->minimum_amount = 0;
    		$model->minimum_amount_currency = 1;
    		$model->reduction_currency = 1;
    		$model->highlight = 1;
    		$model->active = 1;
    		$model->brand_restriction = 1;
    		$model->date_add = $now;
    		$model->combined_with_other_promotion = 1;
    		if($id == 1){
    			$model->reduction_percent = 5;
    		}else if($id == 2){
    			$model->reduction_percent = 10;
    		}else{
    		    $model->reduction_percent = 15;
    		}

    		if(isset($_SESSION['customerInfo']['customer_id'])){
    			$model->customer_id = $_SESSION['customerInfo']['customer_id'];
    		}
    		$model->save();
    		
    		
    		
    		$model2 = new \backend\models\CartRuleLang();
    		$model2->cart_rule_id = $model->cart_rule_id;
    		$model2->apps_language_id = 1;
    		$model2->name = 'Easter Egg Voucher';
    		$model2->source = 'regular';
    		$model2->save();
    		
    		
    		$brand_restriction = [48, 85, 94, 44, 99];
    		foreach($brand_restriction as $key => $value){
    		    $model3 = new \backend\models\CartRuleBrand();
        		$model3->cart_rule_id=$model->cart_rule_id;
        		$model3->brand_id = $value;
        		$model3->save();
    		}
    		

    		setcookie('voucher_name', 'chinese_new_year', time() + (86400 * 30), "/");
    		setcookie('voucher_code', $code, time() + (86400 * 30), "/");
    		setcookie('voucher_type', $id, time() + (86400 * 30), "/");
    		setcookie('voucher_id', $model->cart_rule_id, time() + (86400 * 30), "/");
    		
    	}
    	return json_encode($data);
    }
    
    public function actionCheck(){
		$current_date = date('Y-m-d H:i:s');
		$sessionOrder = new Session();
        $sessionOrder->open();
		
		$customerInfo = $sessionOrder->get("customerInfo");
        
        if(isset($_POST)){
            
            $code = $_POST['code'];
            
            $voucher = \backend\models\CartRule::findOne(['code' => $code, 'active' => 1]);
			
			// check if voucher code is flash sale 
			if($voucher->is_flash_sale){
				
				// get flash sale periode for selected voucher code
				$flashSalePeriode = \backend\models\CartRuleFlashSalePeriode::find()->where(['cart_rule_id' => $voucher->cart_rule_id])->orderBy('cart_rule_flash_sale_periode_id ASC')->all();
				$validFlashSale = FALSE;
				$hasValidFlashSale = FALSE;
				
				foreach($flashSalePeriode as $salePeriode){				
					// if date range not valid
					if(!$this->checkDateValid($salePeriode->date_from, $salePeriode->date_to)){
						$validFlashSale = FALSE;
					} else {
						$validFlashSale = TRUE;
						$hasValidFlashSale = TRUE;
					}
				}
				
			}
			
			if($voucher == NULL){
                $response = json_encode(array(
                    'valid' => false,
					'message' => 'Invalid voucher code!'
                ));
                
                return $response;
            }
			
			// if date range not valid
			if(!$this->checkDateValid($voucher->date_from, $voucher->date_to)){

				$response = json_encode(array(
					'valid' => false,
					'message' => 'Voucher code expired'
				));
				
				return $response;
			}
			
			$sessionOrder = new Session();
			$cart = $sessionOrder->get("cart");
			
			$items = $cart['items'];
			
			$foundCampaign = FALSE;
			$foundFreeCampaign = FALSE;
			$foundBundlingCampaign = FALSE;
			$foundPromotion = FALSE;
			$foundFreeProductCampaignParent = FALSE;
			$foundFreeProductCampaignChild = FALSE;
			$freeProductAmount = 0;
			
			// check if has minimum quantity (case valentine)
			if($voucher->minimum_quantity > 0){
				return $this->getCheckBundle($items,$voucher);
			}
			
			if($voucher->code=="17AGUSTUS"){
				if($current_date >= $voucher->date_from && $current_date <= $voucher->date_to){
					return $this->promoMerdeka($voucher);
				}
			}
			
			if($voucher->code=="TWCBERBAGI"){
				if($current_date >= $voucher->date_from && $current_date <= $voucher->date_to){
					return $this->promoBerbagiWaktu($voucher);
				}
			}
			
            if (count($items) > 0) {
                $i = 0;
                $len = count($items);
                $found = FALSE;
				$progressiveDiscountAmount = 0;
				
				// check if voucher code is progressive discount
				if($voucher->is_progressive_discount == 1){
					
					$totalProgressiveProduct = 0;
				
					// count for finding selected product in current shopping cart
					foreach($items as $item){
					
						$cartRuleProduct = \backend\models\CartRuleProduct::findAll(['cart_rule_id' => $voucher->cart_rule_id]);
						
						if(count($cartRuleProduct) > 0){
							
							foreach($cartRuleProduct as $product){
								
								$productId = \backend\models\Product::findOne(['product_id' => $item['id']])->product_id;
						
								// if product rule is match with voucher code
								if($product->product_id == $productId){
									$totalProgressiveProduct += $item['quantity'];
								}
								
							}
						}
					}
										
				}
				
				// check if voucher code is progressive discount
				if($voucher->is_get_free_product == 1){
					
					$totalFreeParentProduct = 0;
					$totalFreeChildProduct = 0;
				
					// count for finding selected product in current shopping cart
					foreach($items as $item){
					
						$cartRuleProduct = \backend\models\CartRuleProduct::findAll(['cart_rule_id' => $voucher->cart_rule_id]);
						$cartRuleFreeProduct = \backend\models\CartRuleFreeProduct::findAll(['cart_rule_id' => $voucher->cart_rule_id]);
						
						if(count($cartRuleProduct) > 0){
							
							foreach($cartRuleProduct as $product){
								
								$productId = \backend\models\Product::findOne(['product_id' => $item['id']])->product_id;
						
								// if product rule is match with voucher code
								if($product->product_id == $productId){
									$totalFreeParentProduct += $item['quantity'];
								}
								
							}
						}
						
						if(count($cartRuleFreeProduct) > 0){
							
							foreach($cartRuleFreeProduct as $product){
								
								$productId = \backend\models\Product::findOne(['product_id' => $item['id']])->product_id;
								
								// if product rule is match with voucher code
								if($product->product_id == $productId){
									$totalFreeChildProduct += $item['quantity'];
								}
							}
						}
					}
										
				}
				
				/*
                 * check product campaign
                 */
                
                foreach ($items as $item) {
                    // check if product campaign found in current shopping cart
                    if($item['productCampaign']){
                        $foundCampaign = TRUE;
                    }
                    
                    //check if free product campaign found in current shopping cart
                    if($item['productFreeCampaign']){
                        $foundFreeCampaign = TRUE;
                    }
					
					//check if product bundling campaign found in current shopping cart
                    if($item['productBundlingCampaign']){
                        $foundBundlingCampaign = TRUE;
                    }
					
					// check if product has discount
					$specificPrice = \backend\models\SpecificPrice::findAll(['product_id' => $item['id']]);
					if(count($specificPrice) > 0){
						foreach($specificPrice as $discountProduct){
							// if date range valid
							if($this->checkDateValid($discountProduct->from, $discountProduct->to)){
								
								// if voucher code allow only with combined other promotion
								if($voucher->combined_with_other_promotion != 1){
									$foundPromotion = TRUE;
								}
							} else {
								// validate if customer used voucher with none promotion product only 
								if($voucher->combined_with_other_promotion_only == 1){
									$response = json_encode(array(
										'valid' => false,
										'message' => 'Voucher ini tidak berlaku untuk barang yang tidak diskon!'
									));
									
									return $response;
								}
							}
						}
					} else {
						// validate if customer used voucher with none promotion product only 
						if($voucher->combined_with_other_promotion_only == 1){
							$response = json_encode(array(
								'valid' => false,
								'message' => 'Voucher ini tidak berlaku untuk barang yang tidak diskon!'
							));
							
							return $response;
						}
					}
					
					// check if voucher restrict only in some product category
					if($voucher->product_category_restriction == 1){
						$cartRuleProductCategory = \backend\models\CartRuleProductCategory::findOne(['cart_rule_id' => $voucher->cart_rule_id]);
						if($cartRuleProductCategory != NULL){
							$productCategoryId = \backend\models\Product::findOne(['product_id' => $item['id']])->product_category_id;
							if($productCategoryId != $cartRuleProductCategory->product_category_id){
								$response = json_encode(array(
									'valid' => false,
									'message' => 'Kode ini hanya berlaku untuk ' . $cartRuleProductCategory->productCategory->product_category_name . '!'
								));
								return $response;
							}
							
						}
						
					}
					
					// check if voucher is valid for spesific product only
					if($voucher->product_restriction == 1){
						$cartRuleProduct = \backend\models\CartRuleProduct::findAll(['cart_rule_id' => $voucher->cart_rule_id]);
						$foundAllowedProduct = FALSE;
						
						if(count($cartRuleProduct) > 0){
							
							foreach($cartRuleProduct as $product){
								
								$productId = \backend\models\Product::findOne(['product_id' => $item['id']])->product_id;
								
								if($product->product_id == $productId){
									$foundAllowedProduct = TRUE;
								}
							}
							
							
						}
						
						if(!$foundAllowedProduct){
							
							$response = json_encode(array(
								'valid' => false,
								'message' => 'Voucher code tidak berlaku untuk product ini!'
							));
							 
							return $response;
						}
					}
					
					// check if voucher restrict only in some brand
					if($voucher->brand_restriction == 1){
						
						$cartRuleBrand = \backend\models\CartRuleBrand::findAll(['cart_rule_id' => $voucher->cart_rule_id]);
						$foundAllowedBrand = FALSE;
						
						if(count($cartRuleBrand) > 0){
							
							foreach($cartRuleBrand as $brand){
								
								$brandId = \backend\models\Product::findOne(['product_id' => $item['id']])->brands_brand_id;
								
								if($brand->brand_id == $brandId){
									$foundAllowedBrand = TRUE;
								}
							}
							
							
						}
						
						if(!$foundAllowedBrand){
							
							$response = json_encode(array(
								'valid' => false,
								'message' => 'Voucher code tidak berlaku untuk product ini!'
							));
							 
							return $response;
						}
					}
					
					// check if voucher code is progressive discount
					if($voucher->is_progressive_discount == 1){
						
						$cartRuleProduct = \backend\models\CartRuleProduct::findAll(['cart_rule_id' => $voucher->cart_rule_id]);
						
						if(count($cartRuleProduct) > 0){
							
							foreach($cartRuleProduct as $product){
								
								$productId = \backend\models\Product::findOne(['product_id' => $item['id']])->product_id;
						
								// if product rule is match with voucher code
								if($product->product_id == $productId){
									if($voucher->progressive_discount_minimum_product_count == $totalProgressiveProduct){
										$progressiveDiscountAmount += $this->calculateProgressiveDiscount($voucher, $item['total_price']);
									}
									
									if($totalProgressiveProduct > 3 && $voucher->progressive_discount_minimum_product_count == 3){
										$progressiveDiscountAmount += $this->calculateProgressiveDiscount($voucher, $item['total_price']);
									}
								}
								
							}
						}
						
					}
					
					// check if voucher code is get free selected product
					if($voucher->is_get_free_product == 1){
						
						$cartRuleProduct = \backend\models\CartRuleProduct::findAll(['cart_rule_id' => $voucher->cart_rule_id]);
						$cartRuleFreeProduct = \backend\models\CartRuleFreeProduct::findAll(['cart_rule_id' => $voucher->cart_rule_id]);
						
						if(count($cartRuleProduct) > 0){
							
							foreach($cartRuleProduct as $product){
								
								$productId = \backend\models\Product::findOne(['product_id' => $item['id']])->product_id;
								
								// if product rule is match with voucher code
								if($product->product_id == $productId){
									$foundFreeProductCampaignParent = TRUE;
								}
							}
						}
						
						if(count($cartRuleFreeProduct) > 0){
							
							foreach($cartRuleFreeProduct as $product){
								
								$productId = \backend\models\Product::findOne(['product_id' => $item['id']])->product_id;
								
								// if product rule is match with voucher code
								if($product->product_id == $productId){
									$foundFreeProductCampaignChild = TRUE;
									
									// collect amount free product for discount 100%
									$freeProductAmount = $item['unit_price'];
								}
							}
						}
					
					}
                }
                
                /*
                 * end of check product campaign
                 */
				
			}
			
			// check if voucher code is get free selected product
			if($voucher->is_get_free_product == 1){
				
				// check if voucher has parent and child free product
				if($foundFreeProductCampaignParent && $foundFreeProductCampaignChild){
					$totalPurchase = $this->getTotalPurchase();
					
					if($totalFreeParentProduct >= $totalFreeChildProduct){
						$totalFreeProductAmount = $freeProductAmount * $totalFreeChildProduct;
					}
					
					if($totalFreeParentProduct <= $totalFreeChildProduct){
						$totalFreeProductAmount = $freeProductAmount * $totalFreeParentProduct;
					}
					
					$total = \common\components\Helpers::getPriceFormat($totalPurchase - $totalFreeProductAmount);
					
					$data = array(
						"valid" => true,
						"discount" => \common\components\Helpers::getPriceFormat($totalFreeProductAmount),
						"total" => $total,
						"currency" => 'IDR'
					);

					$response = json_encode($data);
					
					// write voucher code session
					$sessionOrder = new Session();
					$sessionOrder->open();
					
					$_SESSION['voucherInfo']['cart_rule_id'] = $voucher->cart_rule_id;
					$_SESSION['voucherInfo']['code'] = $code;
					$_SESSION['voucherInfo']['reduction_amount'] = $totalFreeProductAmount;
					$_SESSION['voucherInfo']['reduction_percent'] = 0;
					
					return $response; 
				} else {
					$response = json_encode(array(
						'valid' => false,
						'message' => 'Voucher cannot be used, please check your shopping cart!'
					));
					
					return $response;
				}
			}
			
			// check if voucher code is progressive discount
			if($voucher->is_progressive_discount == 1){
				
				$totalPurchase = $this->getTotalPurchase();
				
				$total = \common\components\Helpers::getPriceFormat($totalPurchase - $progressiveDiscountAmount);
				
				$data = array(
					"valid" => true,
					"discount" => \common\components\Helpers::getPriceFormat($progressiveDiscountAmount),
					"total" => $total,
					"currency" => 'IDR'
				);

				$response = json_encode($data);
				
				// write voucher code session
				$sessionOrder = new Session();
				$sessionOrder->open();
				
				$_SESSION['voucherInfo']['cart_rule_id'] = $voucher->cart_rule_id;
				$_SESSION['voucherInfo']['code'] = $code;
				$_SESSION['voucherInfo']['reduction_amount'] = $progressiveDiscountAmount;
				$_SESSION['voucherInfo']['reduction_percent'] = 0;
				
				return $response; 
				
			}
			
			// check if customer has product bundling promotion or product discount in current shopping cart
			if($foundCampaign || $foundFreeCampaign || $foundBundlingCampaign || $foundPromotion){
				$response = json_encode(array(
                    'valid' => false,
                    'message' => 'Voucher code cannot be combine with other promotion!'
                ));
                
                return $response;
			}
			
			// check quantity per customer
			if($voucher->quantity_per_user == 1){
				
				// check if customer has already order with this voucher code
				// assume with same email in customer account
				
				$customer = \backend\models\Customer::find()->where(['email' => $customerInfo['email']])->one();
				
				$orders = \backend\models\Orders::find()->where(['customer_id' => $customer->customer_id])->all();

				if(count($orders) > 0){
					foreach($orders as $order){
						$orderCartRule = \backend\models\OrderCartRule::findOne(['name' => $code, 'orders_id' => $order->orders_id]);

						if($orderCartRule != NULL){
							$response = json_encode(array(
								'valid' => false,
								'message' => 'Voucher code cannot be used 2 times'
							));
							
							return $response;

							break;
						}
					}
				}else{
					/*
					$response = json_encode(array(
						'valid' => false,
						'message' => 'Vouchers can only be used by our loyal customers'
					));
					
					return $response;

					break;
					*/
				}
			}
			
			// if voucher code is not for flash sale
			if($voucher->is_flash_sale != 1){
				// if date range not valid
				if(!$this->checkDateValid($voucher->date_from, $voucher->date_to)){

					$response = json_encode(array(
						'valid' => false,
						'message' => 'Voucher code expired'
					));
					
					return $response;
				}
			} else {
				
				// if voucher code is for flash sale
				if(!$hasValidFlashSale){
					$response = json_encode(array(
						'valid' => false,
						'message' => 'Voucher code expired'
					));
					
					return $response;
				}
			}
            
			
            // if minimum puchase is not valid
            if(!$this->checkMinimumAmountValid($voucher->minimum_amount)){
                
                $response = json_encode(array(
                    'valid' => false,
                    'message' => 'Minimum purchase is not valid'
                ));
                
                return $response;
            }
            
            // if total available less than 0
            if($voucher->quantity < 1){
                $response = json_encode(array(
                    'valid' => false,
                    'message' => 'Out of stock'
                ));
                
                return $response;
            }
            
            $totalPurchase = $this->getTotalPurchase();
            $discount = 0;
            $discountAmount = 0;
            $total = 0;
            
            // if promo is reduction fixed amount
            if($voucher->reduction_amount != 0){
                $discount = \common\components\Helpers::getPriceFormat($voucher->reduction_amount);
                $discountAmount = $voucher->reduction_amount;
            }
            
            if($voucher->extra_reduction_amount != 0){
                $totalPurchase -= $discountAmount;
                $discount = \common\components\Helpers::getPriceFormat($voucher->extra_reduction_amount);
                $extraDiscountAmount = $voucher->extra_reduction_amount;
                $discountAmount += $extraDiscountAmount;
            }
            
            // if promo is reduction percent
            if($voucher->reduction_percent != 0){
				
				$discountPurchaseAmount = (($voucher->reduction_percent / 100) * $totalPurchase);
				
				if($voucher->max_discount_amount != 0 && $discountPurchaseAmount >= $voucher->max_discount_amount){
					$discount = \common\components\Helpers::getPriceFormat($voucher->max_discount_amount);
					$discountAmount = $voucher->max_discount_amount;
				} else {
					$discount = \common\components\Helpers::getPriceFormat(($voucher->reduction_percent / 100) * $totalPurchase);
					$discountAmount = (($voucher->reduction_percent / 100) * $totalPurchase);
				}
				
            }
            
            if($voucher->extra_reduction_percent != 0){
                $totalPurchase -= $discountAmount;
                $extraDiscountAmount = (($voucher->extra_reduction_percent / 100) * $totalPurchase);
                $discount = \common\components\Helpers::getPriceFormat(($voucher->extra_reduction_percent / 100) * $totalPurchase + $discountAmount);
                $discountAmount += $extraDiscountAmount;
            }
            
            
            $shipping_price = 0;
            if(isset($customerInfo['shippingMethod'])){
                    $shipping_price = $customerInfo['shippingMethod']['shipping_price'];
                }
            $shippingInsurance = (($this->getOriginalTotalPurchase()) * 0.5) / 100;
			/*
				Free Shipping
				3 - 10 Mei
				Berlaku untuk pembelian apapun dengan minimum payment Rp 1,000,000,-
				Semua free shipping dialihkan ke service YES
			*/
			if($current_date >= '2019-05-03 00:00:00' && $current_date <= '2019-05-11 00:00:00'){
				$shipping_price = 0;
			}
            $shipping_price = $voucher->free_shipping === 0 ? $shipping_price + $shippingInsurance : $shippingInsurance;
			$totalPurchase = $this->getTotalPurchase();
            $total = \common\components\Helpers::getPriceFormat($totalPurchase - $discountAmount + $shipping_price);
            $shipping_price = \common\components\Helpers::getPriceFormat($shipping_price);
            $data = array(
                "valid" => true,
                "discount" => $discount,
                "total" => $total,
                "shipping" => $shipping_price,
                "currency" => 'IDR'
            );

            $response = json_encode($data);
            
            // write voucher code session
            $sessionOrder = new Session();
            $sessionOrder->open();
			
			if($voucher->free_shipping == 1){
				$_SESSION['voucherInfo']['free_shipping'] = 1;
			}
            
            $_SESSION['voucherInfo']['cart_rule_id'] = $voucher->cart_rule_id;
            $_SESSION['voucherInfo']['code'] = $code;
			if($voucher->max_discount_amount != 0 && $discountPurchaseAmount >= $voucher->max_discount_amount){				
				$_SESSION['voucherInfo']['reduction_amount'] = $voucher->max_discount_amount;
				$_SESSION['voucherInfo']['extra_reduction_amount'] = $voucher->extra_reduction_amount;
				$_SESSION['voucherInfo']['reduction_percent'] = 0;
				$_SESSION['voucherInfo']['extra_reduction_percent'] = $voucher->extra_reduction_percent;
			} else {
				$_SESSION['voucherInfo']['reduction_amount'] = $voucher->reduction_amount;
				$_SESSION['voucherInfo']['extra_reduction_amount'] = $voucher->extra_reduction_amount;
				$_SESSION['voucherInfo']['reduction_percent'] = $voucher->reduction_percent;
				$_SESSION['voucherInfo']['extra_reduction_percent'] = $voucher->extra_reduction_percent;
			}
            
            return $response;
            
        }
    }
	
	private function promoBerbagiWaktu($voucher){
		$sessionOrder = new Session();
        $sessionOrder->open();
		
		$cart = $sessionOrder->get("cart");
		$excludes = [
		1738, 2493, 3178, 3179, 3180, 3187, 3188, 3189, 3190, 3191, 3293, 3294, 3504, 3572, 4077, 4078, 4079, 4080, 4081, 4082, 4083, 4084, 4085, 4086, 4087, 4088, 4089, 4090, 4091, 4092, 4093, 4094, 4095, 4096, 4097, 4098, 4099, 4100, 4102, 4103, 4104, 4105, 4106, 4107, 4108, 4109, 4110, 4111, 4112, 4113, 4114, 4115, 4116, 4117, 4118, 4119, 4120, /*TIMEX*/
		1114, 1135, 1430, 1710, 1993, 1994, 2005, 2006, 2267, 2422, 2637, 2650, 2661, 2866, 2898, 3300, 3302, 3303, 3307, 3698, 3703, 3712, 3713, 3714, 3715, 3718, 3969, 3970, 3972, 3975, 3977, 3978, 3981, 4124, 4125, 4127, 4128, 4129, 4130, 4131, 4132, 4133, 4134, 4135, 4136, 4137, 4138, 4139, 4140, 4141, 4142, 4154, 4155, 4168, 4169, 4170, 4171, 4172, 4173, /*Olivia Burton*/
		4186 /* QTIMEX */];
		$includeBrand = [44, 48];

		$totalpriceDiscountedItem = 0;
		$totalpriceFlatItem = 0;
		
		$totalJumlahBarang = 0;
		foreach($cart['items'] as $i => $product){
			$totalJumlahBarang += $product['quantity'];
		}


		$reduction = 0;
		if($totalJumlahBarang>=2){
			
			foreach($cart['items'] as $i => $product){
				if(in_array($product['brand_id'], $includeBrand)){
					if(!in_array($product['id'], $excludes)){
						if($product['isdiscount']){
							$response = json_encode(array(
								'valid' => false,
								'message' => 'Invalid term and conditions product discount'
							));
							
							return $response;
						}else{
							$barang[$product['id']] = $product['original_unit_price'];
						}
					}else{
						$response = json_encode(array(
							'valid' => false,
							'message' => 'Invalid term and conditions products'
						));
						
						return $response;
					}
				}else{
					$response = json_encode(array(
						'valid' => false,
						'message' => 'Invalid term and conditions brands'
					));
					
					return $response;
				}
			}
			

			$reduction = (($voucher->reduction_percent / 100) * min($barang));
			
		} else {
			foreach($cart['items'] as $i => $product){
				if ( $product['id'] === '4186') { /** QTimex */
					$response = json_encode(array(
						'valid' => false,
						'message' => 'Invalid term and conditions product'
					));
					
					return $response;
				}
			}
		}
		
		$totalDiscount = $reduction;
		$shipping = $this->getShipping($voucher);
		$total = ($this->getTotalPurchase() - $totalDiscount) + $shipping;

		// write voucher code session
		$sessionOrder = new Session();
		$sessionOrder->open();
		
		$_SESSION['voucherInfo']['cart_rule_id'] = $voucher->cart_rule_id;
		$_SESSION['voucherInfo']['code'] = $voucher->code;		
		$_SESSION['voucherInfo']['reduction_amount'] = $totalDiscount;
		$_SESSION['voucherInfo']['extra_reduction_amount'] = 0;
		$_SESSION['voucherInfo']['reduction_percent'] = 0;
		$_SESSION['voucherInfo']['extra_reduction_percent'] = 0;
		
		return $this->generateResponse($voucher, $totalDiscount);

	}
	
		private function promoMerdeka($voucher){
		$sessionOrder = new Session();
        $sessionOrder->open();
		
		$cart = $sessionOrder->get("cart");
		$excludes = [3926,3927,3928,3929,3930, /*FITBIT*/ 4061, 4062, 4063, 4064 /*LIMA ZENGA*/, 4186 /* QTIMEX */];

		$totalpriceDiscountedItem = 0;
		$totalpriceFlatItem = 0;
		foreach($cart['items'] as $i => $product){
			if(!in_array($product['id'], $excludes)){
				if ($product['isdiscount']==1) {
					$reductionDiscountedItem = (($voucher->reduction_percent / 100) * $product['unit_price']);
					
					if($voucher->max_discount_amount != 0 && $reductionDiscountedItem > $voucher->max_discount_amount){
						$reductionDiscountedItem = $voucher->max_discount_amount;
					}
					$afterVoucher = $product['unit_price'] - $reductionDiscountedItem;
					$_SESSION['cart']['items'][$i]['reduction_voucher'] = $reductionDiscountedItem;
					$_SESSION['cart']['items'][$i]['after_voucher_merdeka_unit_price'] = $afterVoucher;
					$_SESSION['cart']['items'][$i]['after_voucher_merdeka_total_price'] =   $afterVoucher*$product['quantity'];

					// $_SESSION['cart']['items'][$i]['unit_price'] =  $product['original_unit_price'] - $reductionFlatItem;
					// $_SESSION['cart']['items'][$i]['original_total_price'] =  $product['original_unit_price'] * $product['quantity'];
					// $_SESSION['cart']['items'][$i]['total_price'] =  $product['unit_price'] * $product['quantity'];
					$reductionDiscountedItem = $reductionDiscountedItem*$product['quantity'];
					
					$discountDiscountedItem += $reductionDiscountedItem;
				}else{
					$reductionFlatItem = (($voucher->reduction_percent / 100) * $product['unit_price']);
					$afterVoucher = $product['unit_price'] - $reductionFlatItem;
					$_SESSION['cart']['items'][$i]['reduction_voucher'] = $reductionFlatItem;
					$_SESSION['cart']['items'][$i]['after_voucher_merdeka_unit_price'] = $afterVoucher;
					$_SESSION['cart']['items'][$i]['after_voucher_merdeka_total_price'] =   $afterVoucher*$product['quantity'];
					// $_SESSION['cart']['items'][$i]['unit_price'] =  $product['original_unit_price'] - $reductionFlatItem;
					// $_SESSION['cart']['items'][$i]['original_total_price'] =  $product['original_unit_price'] * $product['quantity'];
					// $_SESSION['cart']['items'][$i]['total_price'] =  $product['unit_price'] * $product['quantity'];
					$reductionFlatItem = $reductionFlatItem*$product['quantity'];
					
					$discountFlatItem += $reductionFlatItem;
				}
			}

		}

		

		$totalDiscount = $discountFlatItem+$discountDiscountedItem;
		$shipping = $this->getShipping($voucher);
		$total = ($this->getTotalPurchase() - $totalDiscount) + $shipping;
 
		// $data = array(
		// 	"valid" => true,
		// 	"discount" => \common\components\Helpers::getPriceFormat($totalDiscount),
		// 	"total" => \common\components\Helpers::getPriceFormat($total),
		// 	 "shipping" => \common\components\Helpers::getPriceFormat($shipping),
		// 	"currency" => 'IDR'
		// );

		// write voucher code session
		$sessionOrder = new Session();
		$sessionOrder->open();
		
		$_SESSION['voucherInfo']['cart_rule_id'] = $voucher->cart_rule_id;
		$_SESSION['voucherInfo']['code'] = $voucher->code;		
		$_SESSION['voucherInfo']['reduction_amount'] = $totalDiscount;
		$_SESSION['voucherInfo']['extra_reduction_amount'] = $voucher->extra_reduction_amount;
		$_SESSION['voucherInfo']['reduction_percent'] = 0;
		$_SESSION['voucherInfo']['extra_reduction_percent'] = $voucher->extra_reduction_percent;
		
		return $this->generateResponse($voucher, $totalDiscount);
	}

	private function generateResponse($voucher, $discount){	
		$sessionOrder = new Session();
        $sessionOrder->open();
		$customerInfo = $sessionOrder->get("customerInfo");

		$shipping_price = $this->getShipping($voucher);
		$total = $this->getTotalPurchase() - $discount + $shipping_price;
		$data = array(
			"valid" => true,
			"discount" => \common\components\Helpers::getPriceFormat($discount),
			"total" => \common\components\Helpers::getPriceFormat($total),
			"shipping" => \common\components\Helpers::getPriceFormat($shipping_price),
			"currency" => 'IDR'
		);

		$response = json_encode($data);
		
		return $response;
	}

	private function setSessionvoucher($voucher,$discount){
			
			// write voucher code session
			$sessionOrder = new Session();
			$sessionOrder->open();
			
			$_SESSION['voucherInfo']['cart_rule_id'] = $voucher->cart_rule_id;
			$_SESSION['voucherInfo']['code'] = $voucher->code;
			if($voucher->max_discount_amount != 0 && $discount >= $voucher->max_discount_amount){				
				$_SESSION['voucherInfo']['reduction_amount'] = $voucher->max_discount_amount;
				$_SESSION['voucherInfo']['extra_reduction_amount'] = $voucher->extra_reduction_amount;
				$_SESSION['voucherInfo']['reduction_percent'] = 0;
				$_SESSION['voucherInfo']['extra_reduction_percent'] = $voucher->extra_reduction_percent;
			} else {
				$_SESSION['voucherInfo']['reduction_amount'] = $voucher->reduction_amount;
				$_SESSION['voucherInfo']['extra_reduction_amount'] = $voucher->extra_reduction_amount;
				$_SESSION['voucherInfo']['reduction_percent'] = $voucher->reduction_percent;
				$_SESSION['voucherInfo']['extra_reduction_percent'] = $voucher->extra_reduction_percent;
			}
	}
	
	private function getShipping($voucher){
		$sessionOrder = new Session();
        $sessionOrder->open();
		$customerInfo = $sessionOrder->get("customerInfo");

		$shipping_price = 0;

		if(isset($customerInfo['shippingMethod'])){
				$shipping_price = $customerInfo['shippingMethod']['shipping_price'];
			}
		$shippingInsurance = (($this->getOriginalTotalPurchase()) * 0.5) / 100;
		/*
			Promo Free Shipping from 1 - 31 June 2019
		*/
		if($current_date >= '2019-05-01 00:00:00' && $current_date <= '2019-07-01 00:00:00'){
			$shipping_price = 0;
		}

		$shipping_price = $voucher->free_shipping === 0 ? $shipping_price + $shippingInsurance : $shippingInsurance;
		return $shipping_price;
	}
	
	
	
	private function calculateProgressiveDiscount($voucher, $productPrice){
		
		$discount = 0;
		$discountAmount = 0;
		$total = 0;
		
		// if promo is reduction fixed amount
		if($voucher->reduction_amount != 0){
			$discount = \common\components\Helpers::getPriceFormat($voucher->reduction_amount);
			$discountAmount = $voucher->reduction_amount;
		}
		
		// if promo is reduction percent
		if($voucher->reduction_percent != 0){
			$discount = \common\components\Helpers::getPriceFormat(($voucher->reduction_percent / 100) * $productPrice);
			$discountAmount = (($voucher->reduction_percent / 100) * $productPrice);
		}
		
		$total = $discountAmount;
		
		return $total;
	}
    
    /*
     * @param $date_from date
     * @param $date_to date 
     * @return true if valid || false
     */
    private function checkDateValid($date_from, $date_to){
        
        $now = date('Y-m-d H:i:s');
        
        if($date_from <= $now && $date_to > $now){
            return true;
        } else {
			return false;
		}
    }
    
    /*
     * @param $amount integer
     * @return true if minimum purchase is match || false
     */
    private function checkMinimumAmountValid($amount){
        
        $totalPurchase = $this->getTotalPurchase();
        
        // if not match with minimum puchase
        if($totalPurchase < $amount){
            return false;
        }
        
        return true;
    }
    
    /*
     * @return integer total purchase
     */
    private function getTotalPurchase(){
        $sessionOrder = new Session();
        $sessionOrder->open();
        $cart = $sessionOrder->get("cart");
        
        $grandTotal = 0;
        $items = $cart['items'];
        if(count($items) > 0) {    
            foreach($items as $item) {
                $grandTotal += $item['total_price'];
            }
        }
        
        return $grandTotal;
    }
    
    /*
     * @return integer total original purchase
     */
    private function getOriginalTotalPurchase(){
        $sessionOrder = new Session();
        $sessionOrder->open();
        $cart = $sessionOrder->get("cart");
        
        $grandTotal = 0;
        $items = $cart['items'];
        if(count($items) > 0) {    
            foreach($items as $item) {
                $grandTotal += $item['original_total_price'];
            }
        }
        
        return $grandTotal;
    }
    
    private function getCheckBundle($items,$voucher){
    	$sessionOrder = new Session();
        $sessionOrder->open();
        $cart = $sessionOrder->get("cart");
        
        $quantity = 0;
        $items = $cart['items'];
        if(count($items) > 0) {    
            foreach($items as $item) {
                $quantity += $item['quantity'];
            }
        }

        if($quantity < 2){
        	$response = json_encode(array(
                    'valid' => false,
                    'message' => 'Minimum quantity is not valid'
                ));
                
                return $response;
        }
        
        /*
                 * check product campaign
                 */
                $total_found_brand = 0;
                $total_found_category = 0;
                // $total_found_product = 0;
                foreach ($items as $item) {
                    				
					
					// check if voucher restrict only in some product category
					if($voucher->product_category_restriction == 1){
						$cartRuleProductCategory = \backend\models\CartRuleProductCategory::findOne(['cart_rule_id' => $voucher->cart_rule_id]);
						if($cartRuleProductCategory != NULL){
							$productCategoryId = \backend\models\Product::findOne(['product_id' => $item['id']])->product_category_id;
							if($productCategoryId == $cartRuleProductCategory->product_category_id){
								$total_found_category = $total_found_category + 1;
							}
							
						}
						
					}
					
					// check if voucher is valid for spesific product only
					if($voucher->product_restriction == 1){
						$cartRuleProduct = \backend\models\CartRuleProduct::findAll(['cart_rule_id' => $voucher->cart_rule_id]);
						$foundAllowedProduct = FALSE;
						
						if(count($cartRuleProduct) > 0){
							
							foreach($cartRuleProduct as $product){
								
								$productId = \backend\models\Product::findOne(['product_id' => $item['id']])->product_id;
								
								if($product->product_id == $productId){
									$foundAllowedProduct = TRUE;
									$total_found_product = $total_found_product + 1;
								}
							}
							
							
						}
						
					
					}
					
					// check if voucher restrict only in some brand
					
					if($voucher->brand_restriction == 1){
						
						$cartRuleBrand = \backend\models\CartRuleBrand::findAll(['cart_rule_id' => $voucher->cart_rule_id]);
						$foundAllowedBrand = FALSE;
						
						if(count($cartRuleBrand) > 0){
							
							foreach($cartRuleBrand as $brand){
								
								$brandId = \backend\models\Product::findOne(['product_id' => $item['id']])->brands_brand_id;
								
								if($brand->brand_id == $brandId){
									$foundAllowedBrand = TRUE;
									$total_found_brand = $total_found_brand + 1;
									$total_found_product = $total_found_product + 1;
								}
							}
							
							
						}
						
						
					}
				
					
				
                }
                
                if($total_found_brand == 0){
							
							$response = json_encode(array(
								'valid' => false,
								'message' => 'Voucher code tidak berlaku untuk product ini!'
							));
							 
							return $response;
						}
						if($total_found_category == 0){
							
							$response = json_encode(array(
								'valid' => false,
								'message' => 'Voucher code tidak berlaku untuk product ini!'
							));
							 
							return $response;
						}
						if($total_found_product == 0){
							
							$response = json_encode(array(
								'valid' => false,
								'message' => 'Voucher code tidak berlaku untuk product ini!'
							));
							 
							return $response;
						}
                
                /*
                 * end of check product campaign
                 */

        // check quantity per customer
			if($voucher->quantity_per_user == 1){
				
				// check if customer has already order with this voucher code
				// assume with same email in customer account
				
				$customer = \backend\models\Customer::find()->where(['email' => $customerInfo['email']])->one();
				
				$orders = \backend\models\Orders::find()->where(['customer_id' => $customer->customer_id])->one();
				
				$orderCartRule = \backend\models\OrderCartRule::findOne(['name' => $code, 'orders_id' => $orders->orders_id]);
				
				if($orderCartRule != NULL){
					$response = json_encode(array(
						'valid' => false,
						'message' => 'Voucher code cannot be used 2 times'
					));
					
					return $response;
				}
			}
			
			// if voucher code is not for flash sale
			if($voucher->is_flash_sale != 1){
				// if date range not valid
				if(!$this->checkDateValid($voucher->date_from, $voucher->date_to)){

					$response = json_encode(array(
						'valid' => false,
						'message' => 'Voucher code expired'
					));
					
					return $response;
				}
			} else {
				
				// if voucher code is for flash sale
				if(!$hasValidFlashSale){
					$response = json_encode(array(
						'valid' => false,
						'message' => 'Voucher code expired'
					));
					
					return $response;
				}
			}
            
			
            // if minimum puchase is not valid
            if(!$this->checkMinimumAmountValid($voucher->minimum_amount)){
                
                $response = json_encode(array(
                    'valid' => false,
                    'message' => 'Minimum purchase is not valid'
                ));
                
                return $response;
            }
            
            // if total available less than 0
            if($voucher->quantity < 1){
                $response = json_encode(array(
                    'valid' => false,
                    'message' => 'Out of stock'
                ));
                
                return $response;
            }
            
            $totalPurchase = $this->getTotalPurchase();
            $totalPurchaseNotDiscount = $this->getTotalPurchaseWithoutOtherDiscount($voucher);
           	
           	// if($totalPurchaseNotDiscount == 0){
           	// 	$response = json_encode(array(
            //         'valid' => false,
            //         'message' => 'Voucher code only use for non discount product'
            //     ));
            //     return $response;
           	// }
            $discount = 0;
            $discountAmount = 0;
            $disc = 0;
            $total = 0;
            
            // if promo is reduction fixed amount
            if($voucher->reduction_amount != 0){
                $discount = \common\components\Helpers::getPriceFormat($voucher->reduction_amount);
                $discountAmount = $voucher->reduction_amount;
                $disc = $voucher->reduction_amount;
            }
            
            // if promo is reduction percent
            if($voucher->reduction_percent != 0){
                $discount = \common\components\Helpers::getPriceFormat(($voucher->reduction_percent / 100) * $totalPurchaseNotDiscount);
                $discountAmount = (($voucher->reduction_percent / 100) * $totalPurchase);
                $disc = (($voucher->reduction_percent / 100) * $totalPurchaseNotDiscount);
            }
            
            
            $shipping_price = 0;
            if(isset($customerInfo['shippingMethod'])){
                    $shipping_price = $customerInfo['shippingMethod']['shipping_price'];
                }
            $total = \common\components\Helpers::getPriceFormat($totalPurchase - $discountAmount + $shipping_price);
            $data = array(
                "valid" => true,
                "discount" => $discount,
                "total" => $total,
                "currency" => 'IDR'
            );

            $response = json_encode($data);
            
            // write voucher code session
            $sessionOrder = new Session();
            $sessionOrder->open();
            
            $_SESSION['voucherInfo']['cart_rule_id'] = $voucher->cart_rule_id;
            $_SESSION['voucherInfo']['code'] = $voucher->code;
            $_SESSION['voucherInfo']['reduction_amount'] = $voucher->reduction_amount;
			$_SESSION['voucherInfo']['extra_reduction_amount'] = $voucher->extra_reduction_amount;
            $_SESSION['voucherInfo']['reduction_percent'] = $voucher->reduction_percent;
			$_SESSION['voucherInfo']['extra_reduction_percent'] = $voucher->extra_reduction_percent;
            $_SESSION['voucherInfo']['discount'] = $disc;
            
            return $response;
      
    	// return $voucher->code.' '.$quantity;
    }

    private function getTotalPurchaseWithoutOtherDiscount($voucher){
        $sessionOrder = new Session();
        $sessionOrder->open();
        $cart = $sessionOrder->get("cart");
        
        $grandTotal = 0;
        $items = $cart['items'];
        if(count($items) > 0) {    
            foreach($items as $item) {
                if($voucher->brand_restriction == 1 && $voucher->product_category_restriction == 1){
						
						$cartRuleBrand = \backend\models\CartRuleBrand::findAll(['cart_rule_id' => $voucher->cart_rule_id]);
						$foundAllowedBrand = FALSE;
						
						if(count($cartRuleBrand) > 0){
							
							foreach($cartRuleBrand as $brand){
								
								$brandId = \backend\models\Product::findOne(['product_id' => $item['id']])->brands_brand_id;
								
								if($brand->brand_id == $brandId){
								    $cartRuleProductCategory = \backend\models\CartRuleProductCategory::findOne(['cart_rule_id' => $voucher->cart_rule_id]);
            						if($cartRuleProductCategory != NULL){
            							$productCategoryId = \backend\models\Product::findOne(['product_id' => $item['id']])->product_category_id;
            							if($productCategoryId == $cartRuleProductCategory->product_category_id){
            					
                    						
            								// check if product has discount
                        					$specificPrice = \backend\models\SpecificPrice::findAll(['product_id' => $item['id']]);
                        					if ($spesificPrice != null) {
                        					    if(count($specificPrice) > 0){
                            						foreach($specificPrice as $discountProduct){
                            							// if date range valid
                            							if($this->checkDateValid($discountProduct->from, $discountProduct->to)){
                            								
                            								
                            							} else {
                            								// validate if customer used voucher with none promotion product only 
                            								$grandTotal += $item['total_price'];
                            							}
                            						}
                            					}
                        					}else{
                        					    $grandTotal += $item['total_price'];
                        					}
            							}
            							
            						}
						
									
									
									
								}
							}
							
							
						}
						
						
					}
					if($voucher->product_restriction == 1){
					    
					
                    						$cartRuleProduct = \backend\models\CartRuleProduct::findAll(['cart_rule_id' => $voucher->cart_rule_id]);
                    						if(count($cartRuleProduct) > 0){
                    							
                    							foreach($cartRuleProduct as $product){
                    								
                    								$productId = \backend\models\Product::findOne(['product_id' => $item['id']])->product_id;
                    								
                    								if($product->product_id == $productId){
                    			
                    									// check if product has discount
                                    					$specificPrice = \backend\models\SpecificPrice::findAll(['product_id' => $item['id']]);
                                    					if ($spesificPrice != null) {
                                    					    if(count($specificPrice) > 0){
                                        						foreach($specificPrice as $discountProduct){
                                        							// if date range valid
                                        							if($this->checkDateValid($discountProduct->from, $discountProduct->to)){
                                        								
                                        								
                                        							} else {
                                        								// validate if customer used voucher with none promotion product only 
                                        								$grandTotal += $item['total_price'];
                                        							}
                                        						}
                                        					}
                                    					}else{
                                    					    $grandTotal += $item['total_price'];
                                    					}
                    								}
                    							}
                    							
                    							
                    						}
					    
					}
					
  
            	
            }
        }
        
        return $grandTotal;
    }
}