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
class PaymentController extends Controller {

    public $layout = "main";

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

    public function actionGetTokenMidtrans(){

       
        
         //Set Your server key
         \Midtrans\Config::$serverKey = Yii::$app->params['midtrans_conf']['svr_key']; //SERVER KEY SANDBOX MIDTRANS

         if(APPLICATION_ENV=="development"){
            \Midtrans\Config::$isProduction = false;
         }else if(APPLICATION_ENV == "production"){
            \Midtrans\Config::$isProduction = true;
         }
 
         \Midtrans\Config::$isSanitized = true;
         \Midtrans\Config::$is3ds = true;

        $transaction = array(
        'transaction_details' => array(
            'order_id' => "BELIDONGBWANG1",
            'gross_amount' => 10000 // no decimal allowed
            ),
            'enabled_payments' => array('credit_card')
        );

        $snapToken = \Midtrans\Snap::getSnapToken($transaction);
        return $snapToken;
    }

    public function actionGetPaymentList($id) {

        if ($id != 3) {
            $paymentMethod = \backend\models\PaymentMethodDetail::findAll(['payment_method_id' => $id]);
            return $this->renderFile('@app/modules/cart/views/checkout/payment/paymentlist.php', array("paymentMethod" => $paymentMethod));
        } else {
            $paymentMethod = \backend\models\PaymentMethodInstallmentDetail::find()->where(['<>','payment_id', 13])->groupBy('payment_id')->all();
            return $this->renderFile('@app/modules/cart/views/checkout/payment/paymentlist_installment.php', array("paymentMethod" => $paymentMethod));
        }
    }
    
    public function actionGetPaymentDetail(){
        $sessionOrder = new \yii\web\Session();
        $sessionOrder->open();
        $current_date = date('Y-m-d H:i:s');
		$now = $current_date;

        $shippingCost = $_SESSION['customerInfo']['shippingMethod']['shipping_price'];
                    
        $voucherInfo = $sessionOrder->get('voucherInfo');
        $cart = $sessionOrder->get("cart");
		$grandTotal = 0;
  
        $items = $cart['items'];
            if (count($items) > 0) {
                $grandTotal = 0;
                $grandOriginalTotal = 0;
                foreach ($items as $item) {
                    $grandTotal += $item['total_price'];
                    $grandOriginalTotal += $item['original_total_price'];
                }      
        }
		
		/*
			Free Shipping
			3 - 10 Mei
			Berlaku untuk pembelian apapun dengan minimum payment Rp 1,000,000,-
			Semua free shipping dialihkan ke service YES
		*/
		if($grandTotal >= 1000000 && $grandTotal < 3000000){
			if($current_date >= '2019-05-03 00:00:00' && $current_date <= '2019-05-11 00:00:00'){
				$shippingCost = 0;
			}
		}
                    
        $discountAmount = 0;
                    
        if(isset($voucherInfo)){
            $discountAmount = $voucherInfo['reduction_percent'] == 0 ? $voucherInfo['reduction_amount'] : (($voucherInfo['reduction_percent'] / 100) * $grandTotal);
        }
        if(isset($voucherInfo['discount'])){
            $discountAmount = $voucherInfo['discount'];
        }

		$id = $_POST['id'];
        $method_id = $_POST['method_id']; 
        // $id = $_GET['id'];
        // $method_id = $_GET['method_id']; 
		
		
		$_SESSION['customerInfo']['paymentMethod']['payment_method_id'] = $method_id;
		$_SESSION['customerInfo']['paymentMethod']['payment_id'] = $id;
        
            $payment = \backend\models\Payment::findOne(['payment_id' => $id]);
            $paymentMethod = \backend\models\PaymentMethod::find()->where(['payment_method_id'=> $method_id])->one();
            return $this->renderFile('@app/modules/cart/views/checkout/payment/paymentdetail.php', array("payment" => $payment,"paymentMethod" => $paymentMethod, "shippingCost" => $shippingCost,
                        "discount" => $discountAmount, "grandTotal"=> $grandTotal, "grandOriginalTotal"=> $grandOriginalTotal));
    }
	
	private function isWeekend($date) {
		$weekDay = date('w', strtotime($date));
		return ($weekDay == 0 || $weekDay == 5); // vospay weekend is from friday to sunday
	}
	
	public function actionGetSessionSpecialPromo(){
        session_start();
        $value[0]=$_SESSION['customerInfo']['special_promo_reduction'];
        return json_encode($value);
    }
    
    public function actionGetSpecialPromo() {
        $sessionOrder = new \yii\web\Session();
        $sessionOrder->open();
        $cart = $sessionOrder->get("cart");
        $items = $cart['items'];
        if (count($items) > 0) {
            $grandTotal = 0;
            $grandOriginalTotal = 0;
            foreach ($items as $item) {
                $grandTotal += $item['total_price'];
                $grandOriginalTotal += $item['original_total_price'];
				
				if($item['id']=="4186"){
                    $value[0] = 'IDR ' . \common\components\Helpers::getPriceFormat(0);
                    $value[1] = 'IDR ' . \common\components\Helpers::getPriceFormat(0);
                    $value[2] = "-";
                    $value[3]= 0;

                    return json_decode($value);
				}
            }
			

        }

        $shippingInsurance = (($grandOriginalTotal * 0.5) / 100);

        $current_date = date('Y-m-d H:i:s');     
        $special_promo_id = $_POST['special_promo_id'];
        $method_id = $_POST['method_id'];

        $shippingCost = $_SESSION['customerInfo']['shippingMethod']['shipping_price'];
        $voucherInfo = $sessionOrder->get('voucherInfo');
                    
        $discountAmount = 0;

        if(isset($voucherInfo)){

            $voucherCartPaymentMethod = \backend\models\CartRulePaymentMethod::findOne(['cart_rule_id' => $voucherInfo['cart_rule_id']]);

            if($voucherCartPaymentMethod != NULL){
                $paymentMethod = \backend\models\PaymentMethod::findAll(['active' => 1, 'payment_method_id' => $voucherCartPaymentMethod->payment_method_id]);
            }

            $discountAmount = $voucherInfo['reduction_percent'] == 0 ? $voucherInfo['reduction_amount'] : (($voucherInfo['reduction_percent'] / 100) * $totalPurchase);

            if($voucherInfo['extra_reduction_amount'] != 0 || $voucherInfo['extra_reduction_percent'] != 0){

                $totalPurchase -= $discountAmount;
                $extraDiscountAmount = $voucherInfo['extra_reduction_percent'] == 0 ? $voucherInfo['extra_reduction_amount'] : (($voucherInfo['extra_reduction_percent'] / 100) * $totalPurchase);

                $discountAmount += $extraDiscountAmount;
            }
        }
        if(isset($voucherInfo['discount'])){
            $discountAmount = $voucherInfo['discount'];
        }
        
		//Setting promo Vospay
		if($special_promo_id == 8){
			$current_date = date('Y-m-d H:i:s');
			if($current_date >= '2019-10-01 00:00:00' && $current_date <= '2019-11-01 00:00:00'){
				$shippingCost = 0;
				if( $this->isWeekend($current_date) ){
					$special_promo_id = 2;
					$special_promo = \backend\models\SpecialPromo::find()->where(['special_promo_id'=>$special_promo_id])->one();
					$specialPromoAmount = 0;

					if($special_promo != null){
						if($current_date >= $special_promo->date_from && $current_date <= $special_promo->date_to){
							if(!isset($_SESSION['customerInfo'])){
								$this->redirect(\Yii::$app->params['frontendUrl']);
							}
							
							if($special_promo->reduction_type == "percent"){
								$specialPromoAmount = ((($grandTotal - $discountAmount) * $special_promo->promo_amount) / 100);
								
								if($specialPromoAmount >= $special_promo->max_discount_amount){
									$specialPromoAmount = $special_promo->max_discount_amount;
								}
							}
							
							if(($grandTotal - $discountAmount) >= $special_promo->promo_amount_minimum){
								$value[0] = 'IDR ' . \common\components\Helpers::getPriceFormat($specialPromoAmount);
								$grossAmount = round( (($grandTotal + $shippingCost + $shippingInsurance) - $discountAmount) - $specialPromoAmount);
								$value[1] = 'IDR ' . \common\components\Helpers::getPriceFormat($grossAmount);
								$value[2] = $special_promo->promo_name;
								// $value[2] = $special_promo_id;
							}
						}
					}
				}else{
					$special_promo_id = 9;
					$special_promo = \backend\models\SpecialPromo::find()->where(['special_promo_id'=>$special_promo_id])->one();
					$specialPromoAmount = 0;

					if($special_promo != null){
						if($current_date >= $special_promo->date_from && $current_date <= $special_promo->date_to){
							if(!isset($_SESSION['customerInfo'])){
								$this->redirect(\Yii::$app->params['frontendUrl']);
							}
							
							if($special_promo->reduction_type == "percent"){
								$specialPromoAmount = ((($grandTotal - $discountAmount) * $special_promo->promo_amount) / 100);
								
								if($specialPromoAmount >= $special_promo->max_discount_amount){
									$specialPromoAmount = $special_promo->max_discount_amount;
								}
							}
							
							if(($grandTotal - $discountAmount) >= $special_promo->promo_amount_minimum){
								$value[0] = 'IDR ' . \common\components\Helpers::getPriceFormat($specialPromoAmount);
								$grossAmount = round( (($grandTotal + $shippingCost + $shippingInsurance) - $discountAmount) - $specialPromoAmount);
								$value[1] = 'IDR ' . \common\components\Helpers::getPriceFormat($grossAmount);
								$value[2] = $special_promo->promo_name;
								$value[3]= $specialPromoAmount;
								// $value[2] = $special_promo_id;
							}
						}
					}
				}
			}else{
				$value = array();
			}
		}
		if($special_promo_id == 3){
			if($special_promo != null){
				if($current_date >= $special_promo->date_from && $current_date <= $special_promo->date_to){
					if(!isset($_SESSION['customerInfo'])){
						$this->redirect(\Yii::$app->params['frontendUrl']);
					}
				
					// check only one account per day
					$order_promo = \backend\models\Orders::find()->where(['<=','date_add',date('Y-m-d 23:59:59')])->andWhere(['>=','date_add',date('Y-m-d 00:00:00')])
					->andWhere(['customer_id'=>$_SESSION['customerInfo']['customer_id']])->all();
					
					// check total transaction with promo
					$total_order_promo = \backend\models\Orders::find()->where(['<=','date_add',date('Y-m-d 23:59:59')])->andWhere(['>=','date_add',date('Y-m-d 00:00:00')])
						->andWhere(['<>','total_special_promo',0])->all();
					
					$allow = 1;
					
					if($special_promo->product_restriction == 1){
						$found = 0;
						$special_promo_products = \backend\models\SpecialPromoProduct::find()->where(['special_promo_id'=>$special_promo_id])->all();
						foreach($items as $item){
							foreach($special_promo_products as $special_promo_product){
								if($item['id'] == $special_promo_product->product_id){
									$found += 1;
									break;
								}
							}
						}
						if(count($items) == $found){
							$allow = 1;
						}else{
							$allow = 0;
						}
					}
					
					// check restriction allowed
					if($allow == 1){
						// if customer never done transaction today
						if(count($order_promo) == 0){
							
							if($special_promo->max_transaction_per_day != 0){
								if(count($total_order_promo) <= $special_promo->max_transaction_per_day){
									// Check reduction type for discount
									if($special_promo->reduction_type == "percent"){
										$specialPromoAmount = ((($grandTotal - $discountAmount) * $special_promo->promo_amount) / 100);
										
										if($specialPromoAmount >= $special_promo->max_discount_amount){
											$specialPromoAmount = $special_promo->max_discount_amount;
										}
									}
									
									// Check minimum
									if(($grandTotal - $discountAmount) > $special_promo->promo_amount_minimum){
										$value[0] = 'IDR ' . \common\components\Helpers::getPriceFormat($specialPromoAmount);
										$grossAmount = round( (($grandTotal + $shippingCost + $shippingInsurance) - $discountAmount) - $specialPromoAmount);
										$value[1] = 'IDR ' . \common\components\Helpers::getPriceFormat($grossAmount);
										$value[2] = $special_promo->promo_name;
									}
								}
							}else{
								// Check reduction type for discount
									if($special_promo->reduction_type == "percent"){
										$specialPromoAmount = ((($grandTotal - $discountAmount) * $special_promo->promo_amount) / 100);
										
										if($specialPromoAmount >= $special_promo->max_discount_amount){
											$specialPromoAmount = $special_promo->max_discount_amount;
										}
									}
									
									// Check minimum
									if(($grandTotal - $discountAmount) > $special_promo->promo_amount_minimum){
										$value[0] = 'IDR ' . \common\components\Helpers::getPriceFormat($specialPromoAmount);
										$grossAmount = round( (($grandTotal + $shippingCost + $shippingInsurance) - $discountAmount) - $specialPromoAmount);
										$value[1] = 'IDR ' . \common\components\Helpers::getPriceFormat($grossAmount);
										$value[2] = $special_promo->promo_name;
										$value[3]= $specialPromoAmount;
									}
							}
							
						}
					}
									
					
				}
			}
		}
		
		
        $excludes = [[73,5], [75,12], [81,5], [82,5], [87,5], [14,5], [86,5], [88,5]];
         

        //BCA 10% MERDEKA NORMAL ITEM NON JEWELRY
        if($special_promo_id==13 && !isset($voucherInfo)){
            $special_promo = \backend\models\SpecialPromo::find()->where(['special_promo_id'=>$special_promo_id])->one();
            if($special_promo != null){
				if($current_date >= $special_promo->date_from && $current_date <= $special_promo->date_to){
					if(!isset($_SESSION['customerInfo'])){
						$this->redirect(\Yii::$app->params['frontendUrl']);
                    }

                    $discountDiscountedItem=0;
                    
                    foreach ($items as $product) {
                        if(!in_array([$product['brand_id'], $product['category_id']], $excludes)){
                            if ($product['isdiscount']==0 && $product['category_id']!=12) {
                                $discountItem = 0;
                                if(isset($product['after_voucher_merdeka_unit_price'])){
                                    $discountItem = (($special_promo->promo_amount / 100) * $product['after_voucher_merdeka_unit_price']);
                                }else{
                                    $discountItem = (($special_promo->promo_amount / 100) * $product['unit_price']);
                                }

                                $discountItem = $discountItem * $product['quantity'];
                                
                                $discountDiscountedItem = $discountDiscountedItem + $discountItem;
                            }      
                        }  
                    }

                    $specialPromoAmount = $discountDiscountedItem; 
                    $value[0] = 'IDR ' . \common\components\Helpers::getPriceFormat($specialPromoAmount);
                    $grossAmount = round( (($grandTotal + $shippingCost + $shippingInsurance) - $discountAmount) - $specialPromoAmount);
                    $value[1] = 'IDR ' . \common\components\Helpers::getPriceFormat($grossAmount);
                    $value[2] = $special_promo->promo_name;
                    $value[3]= $specialPromoAmount;       
                }
            }
        }

        //MANDIRI 10% MERDEKA NORMAL ITEM NON JEWELRY
        if($special_promo_id==14 && !isset($voucherInfo)){
            $special_promo = \backend\models\SpecialPromo::find()->where(['special_promo_id'=>$special_promo_id])->one();
            if($special_promo != null){
				if($current_date >= $special_promo->date_from && $current_date <= $special_promo->date_to){
					if(!isset($_SESSION['customerInfo'])){
						$this->redirect(\Yii::$app->params['frontendUrl']);
                    }

                    $discountDiscountedItem=0;
                    
                    foreach ($items as $product) {

                        if(!in_array([$product['brand_id'], $product['category_id']], $excludes)){
                            if ($product['isdiscount']==0 && $product['category_id']!=12) {
                                if(isset($product['after_voucher_merdeka_unit_price'])){
                                    $discountItem = (($special_promo->promo_amount / 100) * $product['after_voucher_merdeka_unit_price']);
                                }else{
                                    $discountItem = (($special_promo->promo_amount / 100) * $product['unit_price']);
                                }
                                $discountItem = $discountItem * $product['quantity'];
                                $discountDiscountedItem += $discountItem;
                            }  
                        }      
                    }
                    $specialPromoAmount = $discountDiscountedItem; 
                    $value[0] = 'IDR ' . \common\components\Helpers::getPriceFormat($specialPromoAmount);
                    $grossAmount = round( (($grandTotal + $shippingCost + $shippingInsurance) - $discountAmount) - $specialPromoAmount);
                    $value[1] = 'IDR ' . \common\components\Helpers::getPriceFormat($grossAmount);
                    $value[2] = $special_promo->promo_name;
                    $value[3]= $specialPromoAmount;


                    
                }
            }
        }

        //VOSPAY 30% MERDEKA MAX 500000 ALL ITEM
        if($special_promo_id==15 && !isset($voucherInfo)){
            $special_promo = \backend\models\SpecialPromo::find()->where(['special_promo_id'=>$special_promo_id])->one();
            if($special_promo != null){
				if($current_date >= $special_promo->date_from && $current_date <= $special_promo->date_to){
					if(!isset($_SESSION['customerInfo'])){
						$this->redirect(\Yii::$app->params['frontendUrl']);
                    }

                    $discountDiscountedItem=0;
                    
                    foreach ($items as $product) {
                        if(!in_array([$product['brand_id'], $product['category_id']], $excludes)){
                            if(isset($product['after_voucher_merdeka_unit_price'])){
                                $discountItem = (($special_promo->promo_amount / 100) * $product['after_voucher_merdeka_unit_price']);
                            }else{
                                $discountItem = (($special_promo->promo_amount / 100) * $product['unit_price']);
                            }

                            if($special_promo->max_discount_amount != 0 && $discountItem >= $special_promo->max_discount_amount){
                                $discountItem = $special_promo->max_discount_amount;
                            }
                            $discountItem = $discountItem * $product['quantity'];
                            $discountDiscountedItem += $discountItem;
                        }
                        
                    }
                    $specialPromoAmount = $discountDiscountedItem; 
                    $value[0] = 'IDR ' . \common\components\Helpers::getPriceFormat($specialPromoAmount);
                    $grossAmount = round( (($grandTotal + $shippingCost + $shippingInsurance) - $discountAmount) - $specialPromoAmount);
                    $value[1] = 'IDR ' . \common\components\Helpers::getPriceFormat($grossAmount);
                    $value[2] = $special_promo->promo_name;
                    $value[3]= $specialPromoAmount;
                    
                    $_SESSION['customerInfo']['special_promo_reduction'] = $specialPromoAmount;




                    
                }
            }
        }

        //AKULAKU 50% MERDEKA MAX 50000 ALL ITEM
        if($special_promo_id==16 && !isset($voucherInfo)){
            $special_promo = \backend\models\SpecialPromo::find()->where(['special_promo_id'=>$special_promo_id])->one();
            if($special_promo != null){
				if($current_date >= $special_promo->date_from && $current_date <= $special_promo->date_to){
					if(!isset($_SESSION['customerInfo'])){
						$this->redirect(\Yii::$app->params['frontendUrl']);
                    }

                    $discountDiscountedItem=0;
                    
                    foreach ($items as $product) {
                        if(!in_array([$product['brand_id'], $product['category_id']], $excludes)){
                                if(isset($product['after_voucher_merdeka_unit_price'])){
                                    $discountItem = (($special_promo->promo_amount / 100) * $product['after_voucher_merdeka_unit_price']);
                                }else{
                                    $discountItem = (($special_promo->promo_amount / 100) * $product['unit_price']);
                                }

                                if($special_promo->max_discount_amount != 0 && $discountItem >= $special_promo->max_discount_amount){
                                    $discountItem = $special_promo->max_discount_amount;
                                }
                                $discountItem = $discountItem * $product['quantity'];
                                $discountDiscountedItem += $discountItem;
                        }
                    }
                    $specialPromoAmount = $discountDiscountedItem; 
                    $value[0] = 'IDR ' . \common\components\Helpers::getPriceFormat($specialPromoAmount);
                    $grossAmount = round( (($grandTotal + $shippingCost + $shippingInsurance) - $discountAmount) - $specialPromoAmount);
                    $value[1] = 'IDR ' . \common\components\Helpers::getPriceFormat($grossAmount);
                    $value[2] = $special_promo->promo_name;
                    $value[3]= $specialPromoAmount;
                    
                }
            }
        }

		
        return json_encode($value);
    }

    public function actionGetPaymenttransfer($id) {
        $unique_code = 0;
        if ($id == 1 || $id == 2) {
            session_start();
            
                            
            $unique_code = \common\components\Helpers::generateUniqueCode();
            $_SESSION['customerInfo']['unique_code'] = $unique_code;

            
        } 
        return $unique_code;
    }


    public function actionCreditCard() {
		$current_date = date('Y-m-d H:i:s');
		$now = $current_date;
		
        $data = $_POST;

        if ($data) {

            $sessionOrder = new \yii\web\Session();
            $sessionOrder->open();

            $cart = $sessionOrder->get("cart");
            $items = $cart['items'];
            $weight = \common\components\Helpers::generateWeightOrder($items);

            $customerInfo = $sessionOrder->get("customerInfo");
            $shippingMethod = $customerInfo['shippingMethod'];

            $_SESSION['customerInfo']['paymentMethod']['payment_id'] = $data['payment_id'];
            $_SESSION['customerInfo']['paymentMethod']['payment_method_id'] = $data['payment_method_id'];

            $paymentMethod = $_SESSION['customerInfo']['paymentMethod'];

            $total_cart_quantity = 0;
            $total_product_price = 0;
            $total_cart_item = 0;
			
			$voucherInfo = $sessionOrder->get('voucherInfo');

            isset($cart) && count($items) > 0 ? '' : $this->redirect(\yii\helpers\Url::base());
			
			// check product quantity if equal zero
			// no longer can be order if product has reach zero quantity
			foreach ($items as $item) {
				$productStock = \backend\models\ProductStock::findOne(["product_id" => $item['id'], "product_attribute_id" => $item['product_attribute_id']]);
				
				// if quantity equal zero
				if($productStock->quantity == 0){
					
					// cancel order, empty current shopping cart and redirect customer into homepage
					unset($_SESSION['cart']);
					if(isset($voucherInfo)){
						unset($_SESSION['voucherInfo']);
					}
					
					$this->redirect('http://thewatch.co');
				}
			}

            require_once Yii::$app->getBasePath() . '/include/Veritrans.php';

//            include_once("include/Veritrans.php");
            // sandbox
//            \Veritrans_Config::$serverKey = 'VT-server-i5T3nTEdqaac5Rs-sOJhBCkj';
            //                        
            // production
            // \Veritrans_Config::$serverKey = 'VT-server-Nj6-jo8mSfy6IOwGBBUGa3LA';
            // \Veritrans_Config::$isProduction = true;

            \Veritrans_Config::$serverKey = Yii::$app->params['vtrans_conf']['svr_key'];
			\Veritrans_Config::$isProduction = Yii::$app->params['vtrans_conf']['is_production'];

            // Token ID from checkout page
            $token_id = $_POST['token_id'];

            foreach ($items as $item) {
                $total_cart_quantity += $item['quantity'];
                $total_product_price += $item['total_price'];
                $total_cart_item += 1;
            }

            $order_number = \common\components\Helpers::generateOrderNumber();

            $orders = new \backend\models\Orders();
            $orders->customer_id = $customerInfo["customer_id"];
            $orders->reference = $order_number;
            $orders->secure_key = $_POST['_csrf'];
            $orders->customer_address_id = $shippingMethod['customer_address_id'];
            $orders->payment_method_detail_id = \backend\models\PaymentMethodDetail::findOne(["payment_method_id" => $paymentMethod['payment_method_id'], "payment_id" => $paymentMethod["payment_id"]])->payment_method_detail_id;
            $orders->total_shipping = \backend\models\CarrierCost::findOne(["carrier_cost_id" => $shippingMethod['shipping_method']])->price * $weight;
            $orders->total_cart_item = $total_cart_item;
            $orders->total_cart_item_quantity = $total_cart_quantity;
            $orders->total_product_price = $total_product_price;
            $orders->date_add = date("Y-m-d H:i:s");
            $orders->invoice_date = date("Y-m-d H:i:s");
            $orders->apps_language_id = 2;
            $orders->carrier_cost_id = \backend\models\CarrierCost::findOne(["carrier_cost_id" => $shippingMethod['shipping_method']])->carrier_id;

            $orders->save();
			
			$order_state_lang_id = 0;

            if ($paymentMethod['payment_method_id'] == 2) {
                $order_state_lang_id = \backend\models\OrderStateLang::findOne(["template" => "awaiting", "payment_method_id" => 2])->order_state_lang_id;
            }

            foreach ($items as $item) {
                $orders_detail = new \backend\models\OrderDetail();
                $orders_detail->orders_id = $orders->orders_id;
                $orders_detail->product_id = $item['id'];
                $orders_detail->product_name = $item['name'];
                $orders_detail->product_quantity = $item['quantity'];
                $orders_detail->product_attribute_id = $item['product_attribute_id'];
                $orders_detail->original_product_price = $item['unit_price'];
                $orders_detail->product_weight = \backend\models\Product::findOne(["product_id" => $item['id']])->weight;
                $orders_detail->reduction_percent = 0;
				$orders_detail->reduction_percent_plus_extra = 0;
				
                $specificPrice = \backend\models\SpecificPrice::findOne(['product_id' => $item['id']]);
               
                if($specificPrice != NULL){
                    $type = $specificPrice->reduction_type;

                    if($type == 'percent'){
                        $orders_detail->reduction_percent = $specificPrice->reduction;
						if ($paymentMethod['payment_method_id'] == 2){ 
							
							if($orders_detail->reduction_percent != 0) {
								$orders_detail->reduction_percent_extra = 10;
							}else{
								$orders_detail->reduction_percent_extra = 5;
							}
						}
						
                    } elseif($type == 'amount'){
                        $orders_detail->reduction_amount = $specificPrice->reduction;
                    }
                    
                    $orders_detail->product_price = \backend\models\Product::findOne(["product_id" => $item['id']])->price;
                } else {
                    $orders_detail->product_price = $item['unit_price'];
                }

                $orders_detail->save();

                // update product stock

                $productStock = \backend\models\ProductStock::findOne(["product_id" => $item['id'], "product_attribute_id" => $item['product_attribute_id']]);
                $productStock->quantity = ($productStock->quantity - $item['quantity']);

                $productStock->update();
				
				// create order detail history
				$orderDetailHistory = new \backend\models\OrderDetailHistory();
				$orderDetailHistory->orders_id = $orders->orders_id;
				$orderDetailHistory->order_detail_id = $orders_detail->order_detail_id;
				$orderDetailHistory->order_state_lang_id = $order_state_lang_id;
				$orderDetailHistory->order_detail_state_lang_id = 1;
				$orderDetailHistory->date_add = date("Y-m-d H:i:s");
				$orderDetailHistory->save();
            }

            $orderState = new \backend\models\OrderState();
            $orderState->save();

            $orderHistory = new \backend\models\OrderHistory();
            $orderHistory->orders_id = $orders->orders_id;
            $orderHistory->order_state_id = $orderState->order_state_id;
            $orderHistory->order_state_lang_id = $order_state_lang_id;
            $orderHistory->date_add = date("Y-m-d H:i:s");

            $orderHistory->save();
            
            if (isset($_SESSION['customerInfo']['shippingMethod'])) {
				$shippingCost = \backend\models\CarrierCost::findOne(['carrier_cost_id' => $_SESSION['customerInfo']['shippingMethod']['shipping_method']]);
			}
			
			$totalPurchase = $this->getTotalPurchase();
			
			$shipment = \backend\models\CarrierCost::findOne($_SESSION['customerInfo']['shippingMethod']['shipping_method']);
			
			// if shopping total condition more than 3 milion IDR
			// get free all shipping method service
			if($totalPurchase >= 3000000) { 
				$shippingCost = 0;
			} elseif($totalPurchase >= 1000000 && $totalPurchase < 3000000) { 
				// free shipping for regular shipping service
				if($shipment->carrierPackageDetail->carrierPackage->carrier_package_name == 'REGULER'){
					$shippingCost = 0;
				} elseif($shipment->carrierPackageDetail->carrierPackage->carrier_package_name == 'YES'){ 
					$provinceId = \backend\models\CustomerAddress::findOne(['customer_address_id' => $customerInfo['shippingMethod']['customer_address_id']])->province_id;
					$flatPrice = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 3])->price;
					
					$shippingCost = $flatPrice * $weight;
				}
			}
            
//            \common\components\Helpers::sendEmailInvoiceOrders($customerInfo, $order_number, $items, $shippingCost);

            $_SESSION['lastOrder'] = array(
                "order_number" => $orders->reference
            );

            $customer = \backend\models\Customer::findOne(["customer_id" => $customerInfo['customer_id']]);
            $customerAddress = \backend\models\CustomerAddress::find()->orderBy("customer_id")->one();

            $j = 1;
            $itemsDetail = array();
            $grandtotal = 0;
            $id = 0;
            $attribute = '';
            foreach ($items as $item) {
                
				if (strlen($item['name']) > 50){
					$product_name = substr($item['name'], 0, 40) . '...';
				} else {
					$product_name = $item['name'];
				}
				
//                if($id == 0){
//                    $id = $item['id'];
//                }

                if ($id == 0) {
                    $id = $item['id'];
                }

                if ($item['product_attribute_id'] != '0') {
                    $productAttribute = \backend\models\ProductAttributeCombination::findOne(["product_attribute_id" => $item['product_attribute_id']]);
                    if ($productAttribute != NULL) {
                        $attribute = $productAttribute->attributeValue->value;
                    }
                }
				
				$itemsDetail[] = array(
					"id" => $item['id'],
					"price" => $item['unit_price'],
					"quantity" => $item['quantity'],
					"name" => $product_name . ' ' . $attribute
				);
				
				$grandtotal += $item['unit_price'] * $item['quantity'];

                $attribute = '';

                $j++;
            }
                    
            $discountAmount = 0;
            
            if(isset($voucherInfo)){
                
                $discountAmount = $voucherInfo['reduction_percent'] == 0 ? $voucherInfo['reduction_amount'] : $voucherInfo['reduction_percent'];
                
            }
			
			
            
            try {
               \common\components\Helpers::sendEmailMandrillUrlAPI(
                   $this->renderFile('@app/views/template/mail/order_placed.php', array(
                       "customerInfo" => $customerInfo,
                       "orderNumber" => $orders->reference,
                       "items" => $items,
                       "shippingCost" => $shippingCost,
                       "weight" => $weight,
                       "discount" => $discountAmount
                   )), \Yii::$app->params['orderPlacedSubjectEmail'], \Yii::$app->params['adminEmail'], $customerInfo["email"], ''
               );
            } catch (Exception $ex) {

            }
            
            if(isset($voucherInfo)){
                
                $itemsDetail[] = array(
                    "id" => $id,
                    "price" => -$discountAmount,
                    "quantity" => 1,
                    "name" => 'discount voucher'
                );
                
                $order_cart_rule = new \backend\models\OrderCartRule();
                $order_cart_rule->orders_id = $orders->orders_id;
                $order_cart_rule->cart_rule_id = $voucherInfo['cart_rule_id'];
                $order_cart_rule->name = $voucherInfo['code'];
                $order_cart_rule->value = $discountAmount;
                $order_cart_rule->save();
                
            }
            
            $itemsDetail[] = array(
                "id" => 0,
                "price" => $shippingCost * $weight,
                "quantity" => 1,
                "name" => $shipment->carrierPackageDetail->carrierPackage->carrier_package_name
            );

            $billing_address = array(
                'first_name' => $customer->firstname,
                'last_name' => $customer->lastname,
                'address' => \backend\models\CustomerAddress::findOne(["customer_id" => $customer->customer_id])->address1,
                'city' => \backend\models\State::findOne(["state_id" => $customerAddress->state_id])->name,
                'postal_code' => $customerAddress->postcode,
                'phone' => $customerAddress->phone,
                'country_code' => 'IDN'
            );

            $shipping_address = array(
                'first_name' => $customer->firstname,
                'last_name' => $customer->lastname,
                'address' => \backend\models\CustomerAddress::findOne(["customer_id" => $customer->customer_id])->address1,
                'city' => \backend\models\State::findOne(["state_id" => $customerAddress->state_id])->name,
                'postal_code' => $customerAddress->postcode,
                'phone' => $customerAddress->phone,
                'country_code' => 'IDN'
            );

            // Populate customer's info
            $customer_details = array(
                'first_name' => $customer->firstname,
                'last_name' => $customer->lastname,
                'email' => $customer->email,
                'phone' => $customerAddress->phone,
                'billing_address' => $billing_address,
                'shipping_address' => $shipping_address
            );
			
			$shippingPrice = $shippingCost * $weight;

            $grandtotal += $shippingPrice;

            $transaction_details = array(
                'order_id' => $orders->reference,
                'gross_amount' => $grandtotal - $discountAmount
            );
            
            if($_POST['installment_plan'] != 0){
                
                $plan = $_POST['installment_plan'];
                
                if($plan == '3'){
                    $plan = 3;
                } elseif($plan == '6'){
                    $plan = 6;
                } elseif($plan == '12'){
                    $plan = 12;
                }
                
                $transaction_data = array(
                    'payment_type' => 'credit_card',
                    'credit_card' => array(
                        'token_id' => $token_id,
                        'save_token_id' => isset($_POST['save_cc']),
                        'installment_term' => $plan
                    ),
                    'transaction_details' => $transaction_details,
                    'item_details' => $itemsDetail,
                    'customer_details' => $customer_details
                );
                
            } else {
                $transaction_data = array(
                    'payment_type' => 'credit_card',
                    'credit_card' => array(
                        'token_id' => $token_id,
                        'save_token_id' => isset($_POST['save_cc']),
                    ),
                    'transaction_details' => $transaction_details,
                    'item_details' => $itemsDetail,
                    'customer_details' => $customer_details
                );
            }
            if(isset($_COOKIE['voucher_name'])){
                        unset($_COOKIE['voucher_name']);
                        unset($_COOKIE['voucher_code']);
                        unset($_COOKIE['voucher_type']);
                        unset($_COOKIE['voucher_close']);
                        unset($_COOKIE['voucher_id']);
                        setcookie('voucher_name', null, -1, '/');
                        setcookie('voucher_code', null, -1, '/');
                        setcookie('voucher_type', null, -1, '/');
                        setcookie('voucher_close', null, -1, '/');
                        setcookie('voucher_id', null, -1, '/');
                    }
            //print_r($items);
            //echo $grandtotal;
            //die();
           //print_r($transaction_data);
           //die();
            unset($_SESSION['cart']);
            if(isset($voucherInfo)){
                unset($_SESSION['voucherInfo']);
            }
            //                        
            try {
                $response = \Veritrans_VtDirect::charge($transaction_data);
            } catch (Exception $e) {
                echo $e->getMessage();
                die();
//                return $this->render('@app/modules/cart/views/checkout/payment/complete.php', array("status" => $e->getMessage()));
                $this->redirect(\yii\helpers\Url::base());
            }

            // Success
            if ($response->transaction_status == 'capture') {

                $orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "payment_success", "payment_method_id" => 2])->order_state_lang_id;

                $orderHistory = \backend\models\OrderHistory::findOne(["orders_id" => $orders->orders_id]);
                $orderHistory->order_state_lang_id = $orderStateLangId;
                $orderHistory->save();

                $this->redirect(\yii\helpers\Url::base() . '/cart/checkout/step/ordercomplete');
            }

            // Deny
            elseif ($response->transaction_status == 'deny') {

                $orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "payment_failed", "payment_method_id" => 2])->order_state_lang_id;

                $orderHistory = \backend\models\OrderHistory::findOne(["orders_id" => $orders->orders_id]);
                $orderHistory->order_state_lang_id = $orderStateLangId;
                $orderHistory->save();

                // return product stock while payment failed
                $productList = \backend\models\OrderDetail::findAll(["orders_id" => $orders->orders_id]);
                if (count($productList) > 0) {
                    foreach ($productList as $product) {

                        // update product stock quantity
                        $productStock = \backend\models\ProductStock::findOne([
                                    "product_id" => $product->product_id,
                                    "product_attribute_id" => $product->product_attribute_id
                        ]);

                        $productStock->quantity += $product->product_quantity;
                        $productStock->save();
                    }
                }


                $this->redirect(\yii\helpers\Url::base() . '/cart/checkout/step/ordercomplete');
            }

            // Challenge
            elseif ($response->transaction_status == 'challenge') {

                $orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "payment_failed", "payment_method_id" => 2])->order_state_lang_id;

                $orderHistory = \backend\models\OrderHistory::findOne(["orders_id" => $orders->orders_id]);
                $orderHistory->order_state_lang_id = $orderStateLangId;
                $orderHistory->save();

                // return product stock while payment failed
                $productList = \backend\models\OrderDetail::findAll(["orders_id" => $orders->orders_id]);
                if (count($productList) > 0) {
                    foreach ($productList as $product) {

                        // update product stock quantity
                        $productStock = \backend\models\ProductStock::findOne([
                                    "product_id" => $product->product_id,
                                    "product_attribute_id" => $product->product_attribute_id
                        ]);

                        $productStock->quantity += $product->product_quantity;
                        $productStock->save();
                    }
                }

                $this->redirect(\yii\helpers\Url::base() . '/cart/checkout/step/ordercomplete');
            }
        }
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

}
