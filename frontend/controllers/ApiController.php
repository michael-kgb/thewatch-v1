<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Orders;
use backend\models\OrderDetail;
use frontend\core\controller;
use backend\models\BrandsBanner;
use backend\models\BrandsBannerDetail;
use backend\models\SpecificPrice;
use backend\models\ProductAttribute;
use backend\models\ProductAttributeCombination;
use backend\models\AttributeValue;
use backend\models\ServiceClaimManual;
use backend\models\VaLog;
use yii\web\Session;

class ApiController extends controller\FrontendController {
    
    public $breadcrumb = ["About"];
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
	
	public function actionCheckclaimservicemanual(){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		
		$orderDateFrom = date('Y-m-d');
		$orderDateTo = date('Y-m-d');
		
		$excludeStatus = ['Valid', 'Invalid'];
		
		$serviceClaimManualModel = ServiceClaimManual::find()
			->andFilterWhere(['between','service_claim_manual.service_claim_manual_date_add', $orderDateFrom . ' 00:00:00 ', $orderDateTo . ' 23:59:00'])
			->andFilterWhere(['NOT IN','service_claim_manual.service_claim_manual_status', $excludeStatus])
			->all();
		
		$data = array(
			"success" => TRUE,
			"total" => count($serviceClaimManualModel)
		);
		
		return $data;
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
	
	private function isWeekend($date) {
		$weekDay = date('w', strtotime($date));
		return ($weekDay == 0 || $weekDay == 5); // vospay weekend is from friday to sunday
	}
	
	public function actionCheckout($action = NULL){
		
		header('Content-Type: application/json');
		$raw_body = 'php://input';
		$raw_body = file_get_contents($raw_body);

		$decode = json_decode($raw_body);
		$current_date = date('Y-m-d H:i:s');
		
		switch($action){
			
			case "confirmorder":
				
				$now = date("Y-m-d H:i:s");
		
				$sessionOrder = new Session();
				$sessionOrder->open();

				$cart = $sessionOrder->get("cart");
				$items = isset($cart['items']) ? $cart['items'] : '';
				
				$customerInfo = $sessionOrder->get("customerInfo");
				$shippingMethod = $customerInfo['shippingMethod'];
				$voucherInfo = $sessionOrder->get('voucherInfo');

				// check product quantity if equal zero
                    // no longer can be order if product has reach zero quantity
				foreach ($items as $item) {
					$productStock = \common\components\Helpers::updateProductStock($item['id'],$item['product_attribute_id'],$item['quantity']); 
                        // if($productStock != 'berhasil'){
                        //     return $this->redirect('https://www.thewatch.co');
                        // }

                        // $productStock = \common\components\Helpers::getProductStock($item['id'],$item['product_attribute_id'],$item['quantity']);

                        // if quantity equal zero
					if($productStock == 'gagal' || $productStock == 'null'){ 

                            // cancel order, empty current shopping cart and redirect customer into homepage
						unset($_SESSION['cart']);
						if(isset($voucherInfo)){
							unset($_SESSION['voucherInfo']);
						}
						if(isset($customerInfo['paymentMethod'])){
							unset($customerInfo['paymentMethod']);
						}
						if(isset($customerInfo['unique_code'])){
							unset($customerInfo['unique_code']);
						}

						// rollback product stock
						$id_prod_stock = $item['id'];
						$id_attr_stock = $item['product_attribute_id'];
						foreach ($items as $item_return) {

							if(($item_return['id'] == $id_prod_stock) && ($item_return['product_attribute_id'] == $id_attr_stock)){
								return json_encode(array(
									"redirect" => "https://www.thewatch.co",
									"success" => FALSE
								));
							}else{
								$productStock2 = \common\components\Helpers::returnProductStock($item_return['id'],$item_return['product_attribute_id'],$item_return['quantity']);
							}
						} 

					}
				}
				
				$weight = \common\components\Helpers::generateWeightOrder($items);
				// echo $weight;die();
				
				$total_cart_quantity = 0;
				$total_product_price = 0;
				$total_product_original_price = 0;
				$total_cart_item = 0;
				$flash_sale_flag = 0;
				foreach ($items as $item) {
					$total_cart_quantity += $item['quantity'];
					$total_product_price += $item['total_price'];
					$total_product_original_price += $item['original_total_price'];
					$total_cart_item += 1;
					
					if($item['flash_sale'] == 1){
                        $flash_sale_flag = 1;
                    }
				}
				
				if($total_cart_item == 0){
					return json_encode(array(
						"redirect" => "https://www.thewatch.co",
						"success" => FALSE
					));
				}

				$order_number = \common\components\Helpers::generateOrderNumber();
				
				$orders = new \backend\models\Orders();
				
				$totalPurchase = $this->getTotalPurchase();
				
				$discountAmount = 0;
				$total_shipping = 0;

				if(isset($voucherInfo)){
					$discountAmount = $voucherInfo['reduction_percent'] == 0 ? $voucherInfo['reduction_amount'] : (($voucherInfo['reduction_percent'] / 100) * $totalPurchase);
					
					if($voucherInfo['extra_reduction_amount'] != 0 || $voucherInfo['extra_reduction_percent'] != 0){
					
						$totalPurchase -= $discountAmount;
						$extraDiscountAmount = $voucherInfo['extra_reduction_percent'] == 0 ? $voucherInfo['extra_reduction_amount'] : (($voucherInfo['extra_reduction_percent'] / 100) * $totalPurchase);

						$discountAmount += $extraDiscountAmount;
					}
					
					if(isset($voucherInfo['discount'])){
						$discountAmount = $voucherInfo['discount'];
					}
				}
				$unique_code = 0;
				
				$carrier = \backend\models\CarrierCost::findOne($_SESSION['customerInfo']['shippingMethod']['shipping_method']);
				if($total_product_price - $discountAmount + $unique_code >= 3000000) { 
					$orders->total_shipping = $total_shipping;
		   
				} elseif($total_product_price - $discountAmount + $unique_code >= 1000000 && $total_product_price - $discountAmount + $unique_code < 3000000) { 
					// free shipping for regular shipping service
					if($carrier->carrierPackageDetail->carrierPackage->carrier_package_name == 'REGULER'){
						$orders->total_shipping = $total_shipping;
		   
					} elseif($carrier->carrierPackageDetail->carrierPackage->carrier_package_name == 'YES'){ 
						$provinceId = \backend\models\CustomerAddress::findOne(['customer_address_id' => $customerInfo['shippingMethod']['customer_address_id']])->province_id;
						$flatPrice = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 3])->price;
						$orders->total_shipping = $flatPrice * $weight;
						$total_shipping = $flatPrice * $weight;
				 
					} else {
						$orders->total_shipping = \backend\models\CarrierCost::findOne(["carrier_cost_id" => $shippingMethod['shipping_method']])->price * $weight;
			  
					}
					
				} else {
					if($carrier->carrierPackageDetail->carrierPackage->carrier_package_name == 'REGULER'){
						$provinceId = \backend\models\CustomerAddress::findOne(['customer_address_id' => $_SESSION['customerInfo']['shippingMethod']['customer_address_id']])->province_id;
						$flatPrice = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 1])->price;
						
						$orders->total_shipping = $flatPrice * $weight;
						$total_shipping = $flatPrice * $weight;
				   
					} elseif($carrier->carrierPackageDetail->carrierPackage->carrier_package_name == 'YES'){ 
						$provinceId = \backend\models\CustomerAddress::findOne(['customer_address_id' => $_SESSION['customerInfo']['shippingMethod']['customer_address_id']])->province_id;
						$flatPrice = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 3])->price;
						
						$orders->total_shipping = $flatPrice * $weight;
						$total_shipping = $flatPrice * $weight;
				  
					} else {
						$orders->total_shipping = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 1])->price * $weight;
						$total_shipping = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 1])->price * $weight;
				
					}
				}
				
				$promo_amount = 0;
                $special_promo_id = 0;
				$excludes = [[73,5], [75,12], [81,5], [82,5], [87,5], [14,5], [86,5], [88,5]];



                //BCA 10% MERDEKA NORMAL ITEM NON JEWELRY 3 && 6
                if($_SESSION['customerInfo']['paymentMethod']['payment_method_id'] == 3 && $_SESSION['customerInfo']['paymentMethod']['payment_id'] == 6){
                    $special_promo_id = 13;
                    if($special_promo_id==13){
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

                                $promo_amount = $discountDiscountedItem;


                                
                            }
                        }
                    }
                }

                //MANDIRI 10% MERDEKA NORMAL ITEM NON JEWELRY 3 && 7
                if($_SESSION['customerInfo']['paymentMethod']['payment_method_id'] == 3 && $_SESSION['customerInfo']['paymentMethod']['payment_id'] == 7){
                    $special_promo_id = 14;
                    if($special_promo_id==14){
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
                                $promo_amount = $discountDiscountedItem;


                                
                            }
                        }
                    }
                }

                //VOSPAY 30% MERDEKA MAX 500000 ALL ITEM 8 && 25
                if($_SESSION['customerInfo']['paymentMethod']['payment_method_id'] == 8 && $_SESSION['customerInfo']['paymentMethod']['payment_id'] == 25){
                    $special_promo_id = 15;
                    if($special_promo_id==15){
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
                                $promo_amount = $discountDiscountedItem;
                                                                
                            }
                        }
                    }
                }

                //AKULAKU 50% MERDEKA MAX 50000 ALL ITEM 5 & 20
                if($_SESSION['customerInfo']['paymentMethod']['payment_method_id'] == 5 && $_SESSION['customerInfo']['paymentMethod']['payment_id'] == 20){
                    $special_promo_id = 16;
                    if($special_promo_id==16){
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
                                $promo_amount = $discountDiscountedItem;
                                
                            }
                        }
                    }
                }

				
				
				
				
				// if customer select gift for current orders
				if(isset($customerInfo['send_as_gift']['is_a_gift']) && $customerInfo['send_as_gift']['is_a_gift'] == 1){
					$orders->gift = 1;
					$orders->gift_message = $customerInfo['send_as_gift']['gift_message'];
				}
				
				$orders->total_cart_item = $total_cart_item;
				$totalShippingInsurance = 0;
				//if($shippingMethod['shipping_insurance']){
					$totalShippingInsurance = $total_product_price - $discountAmount;
					$totalShippingInsurance = (($total_product_original_price * 0.5) / 100);
					$orders->total_shipping_insurance = $totalShippingInsurance;
				//}

				$orders->total_cart_item_quantity = $total_cart_quantity;
				$orders->total_product_price = $total_product_price;
				$orders->date_add = date("Y-m-d H:i:s");
				$orders->invoice_date = date("Y-m-d H:i:s");
				$orders->invoice_reminder_date = date('Y-m-d H:i:s', strtotime($orders->invoice_date . ' +1 day'));
				$orders->apps_language_id = 2;
				$orders->carrier_cost_id = $shippingMethod['shipping_method'];
				
				$orders->flash_sale = $flash_sale_flag;
				$orders->total_special_promo = $promo_amount;
                $orders->special_promo_id = $special_promo_id;
				$orders->customer_id = $customerInfo["customer_id"];
				$orders->reference = $order_number;
				$orders->secure_key = Yii::$app->request->csrfToken;
				$orders->customer_address_id = $shippingMethod['customer_address_id'];
				$orders->payment_method_detail_id = 25; // vospay
				$orders->unique_code = 0;

				$orders->save();
				
				$orderReminder = new \backend\models\OrdersReminder();
				$orderReminder->orders_id = $orders->orders_id;
				$orderReminder->orders_reminder_date = date('Y-m-d H:i:s', strtotime($orders->invoice_date . ' +1 day'));
				$orderReminder->orders_canceled_date = date('Y-m-d H:i:s', strtotime($orders->invoice_date . ' +2 day'));
				$orderReminder->orders_reminder_status = 1;
				$orderReminder->orders_canceled_status = 1;
				$orderReminder->save();
				
				$order_state_lang_id = 0;
				
				$paymentMethodId = \backend\models\PaymentMethodDetail::findOne(["payment_method_detail_id" => $orders->payment_method_detail_id])->payment_method_id;
				
				$order_state_lang_id = \backend\models\OrderStateLang::findOne(["template" => "awaiting", "payment_method_id" => $paymentMethodId, "apps_language_id" => 1])->order_state_lang_id;

				$extraDiscountStartDate = '2018-10-10 00:00:00';
				$extraDiscountEndDate = '2018-10-10 23:59:59';
				if($_SESSION['customerInfo']['customer_id'] == 570){
					$now = '2018-10-10 00:00:00';
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
					
					$specificPrice = \backend\models\SpecificPrice::findOne(['product_id' => $item['id']]);
					if($specificPrice != NULL){
						$type = $specificPrice->reduction_type;
						
						if($type == 'percent'){
							if($specificPrice->from <= $now && $specificPrice->to > $now){
								
								if($specificPrice->description == "cybersale1010"){
									
									if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
										$orders_detail->reduction_percent_extra = '10';
									}
								}
								
								$orders_detail->reduction_percent = $specificPrice->reduction;
							}
						} elseif($type == 'amount'){
							if($specificPrice->from <= $now && $specificPrice->to > $now){
								
								if($specificPrice->description == "cybersale1010"){
									
									if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
										$orders_detail->reduction_percent_extra = '10';
									}
								}
								
								$orders_detail->reduction_amount = $specificPrice->reduction;
							}
						}
						
						$orders_detail->product_price = \backend\models\Product::findOne(["product_id" => $item['id']])->price;
					} else {
						$orders_detail->product_price = $item['unit_price'];
					}

					$orders_detail->save();

					// update product stock

				// 	$productStock = \backend\models\ProductStock::findOne(["product_id" => $item['id'], "product_attribute_id" => $item['product_attribute_id']]);
				// 	$productStock->quantity = ($productStock->quantity - $item['quantity']);

				// 	$productStock->update();
					
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
				
				// $shippingCost = \backend\models\CarrierCost::findOne(['carrier_cost_id' => $_SESSION['customerInfo']['shippingMethod']['shipping_method']]);
				$shippingCost = $total_shipping;
				$shipping_method = $_SESSION['customerInfo']['shippingMethod']['shipping_method'];
				
				try {
					\common\components\Helpers::sendEmailMandrillUrlAPI(
						$this->renderFile('@app/views/template/mail/order_placed_new.php', array(
							"customerInfo" => $customerInfo,
							"orderNumber" => $order_number,
							"items" => $items,
							"shippingCost" => $shippingCost,
							"shippingInsurance" => $totalShippingInsurance,
							"shippingMethod" => $shipping_method,
							"weight" => $weight,
							"discount" => $discountAmount,
							"ordersId" => $orders->orders_id,
							"model"=> $orders,
						)), \Yii::$app->params['orderPlacedSubjectEmail'], \Yii::$app->params['adminEmail'], $customerInfo["email"], ''
					);
				} catch (Exception $ex) {
					
				}

				// create last order number history session

				$_SESSION['lastOrder'] = array(
					"order_number" => $order_number
				);
				
				if(isset($voucherInfo)){
					
					// save voucher history
					$order_cart_rule = new \backend\models\OrderCartRule();
					$order_cart_rule->orders_id = $orders->orders_id;
					$order_cart_rule->cart_rule_id = $voucherInfo['cart_rule_id'];
					$order_cart_rule->name = $voucherInfo['code'];
					$order_cart_rule->value = $discountAmount;
					$order_cart_rule->save();
					
					// update quantity voucher code
					$cart_rule = \backend\models\CartRule::findOne(["cart_rule_id" => $voucherInfo['cart_rule_id']]);
					$cart_rule->quantity -= 1;
					$cart_rule->save();
					
				}
				
				unset($_SESSION['cart']);
				
				if(isset($voucherInfo)){
					unset($_SESSION['voucherInfo']);
				}
				
				if(isset($customerInfo['paymentMethod'])){
					unset($customerInfo['paymentMethod']);
				}
				
				if(isset($customerInfo['unique_code'])){
					unset($customerInfo['unique_code']);
				}
				
				$existingCartsMC = \common\components\Helpers::getMailchimpExistingCarts();
				$carts = $existingCartsMC->carts;
				
				if(count($carts) > 0){
					foreach($carts as $cart){
						if($cart->customer->email_address == $_SESSION['customerInfo']['email']){
							$cartMC = $cart->lines;
							
							$cartId = $cart->id;
							\common\components\Helpers::deleteCartMailchimp($cartId);
						}
					}
					
					\common\components\Helpers::createOrdersMailchimp($order_number, $_SESSION['customerInfo']['customer_id'], $cartMC);
					
				}
				
				return json_encode(array(
					"success" => true,
					"vospayOrderId" => $order_number
				));
				
			break;
			
		}
		
	}
	
	public function actionOrders($action = NULL){
		
		header('Content-Type: application/json');
		$raw_body = 'php://input';
		$raw_body = file_get_contents($raw_body);

		$decode = json_decode($raw_body);
		
		switch($action){
			
			case "check":
			
				$orders = \backend\models\Orders::findOne(['reference' => $decode->orderId]);
				$products = array();
				
				if($orders != NULL){
					
					$orderDetailModel = \backend\models\OrderDetail::findAll(["orders_id" => $orders->orders_id]);
					
					foreach($orderDetailModel as $row){
						$products[] = array(
							"id" => $row->product_id . "",
							"name" => $row->product_name,
							"quantity" => $row->product_quantity,
							"price" => $row->original_product_price
						);
					}
					
					$discount = \backend\models\OrderCartRule::findOne(["orders_id" => $orders->orders_id]);
					
					if($discount != NULL){
						$products[] = array(
							"id" => "0",
							"name" => "discount voucher",
							"quantity" => 1,
							"price" => -($discount->value)
						);
					}
					
					if($orders->total_special_promo != 0){
						$special_promo_id = (int)$orders->special_promo_id;
						$special_promo = \backend\models\SpecialPromo::find()->where(['special_promo_id'=>$special_promo_id])->one();
						$special_promo_name = "";
						if($special_promo != null){
							$special_promo_name = strtolower($special_promo->promo_name);
						}
						$products[] = array(
							"id" => "0",
							"name" => "discount ".$special_promo_name,
							"quantity" => 1,
							"price" => -($orders->total_special_promo)
						);
					}
					
					if($orders->total_shipping_insurance != 0){
						$products[] = array(
							"id" => "0",
							"name" => "shipping insurance",
							"quantity" => 1,
							"price" => $orders->total_shipping_insurance
						);
					}
					
					$customerDetails = array(
						"id" => $orders->customer_id . "",
						"name" => $orders->customer->firstname . ' ' . $orders->customer->lastname,
						"email" => $orders->customer->email,
						"phone" => $orders->customeraddress->phone,
						"shippingAddress" => trim(preg_replace('/\s+/', ' ', $orders->customeraddress->address1)),
						"billingAddress" => trim(preg_replace('/\s+/', ' ', $orders->customeraddress->address1))
					);
					
				}
				
				$data = array(
					"success" => TRUE,
					"data" => array(
						"vospayOrderId" => $decode->orderId,
						"products" => $products,
						"shipping" => ($orders->total_shipping + $total_shipping_insurance),
						"grossAmount" => ((($orders->total_product_price + $orders->total_shipping + $orders->total_shipping_insurance + $orders->unique_code) - $discount->value) - $orders->total_special_promo),
						"customerDetails" => $customerDetails
					)
				);
				
				print_r(json_encode($data));
			
            break;
		}
	}
	
	public function actionPayment(){
		
		header('Content-Type: application/json');
		$raw_body = 'php://input';
		$raw_body = file_get_contents($raw_body);

		$decode = json_decode($raw_body);
		
		$orders = \backend\models\Orders::findOne(['reference' => str_replace('WatchCo_VOSPAY_', '', $decode->orderID)]);
		
		if($decode->status == "Success"){
			
			if($orders != NULL){
				
				$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "payment_success", "payment_method_id" => 8, "apps_language_id" => 1])->order_state_lang_id;

				$orderHistory = \backend\models\OrderHistory::findOne(["orders_id" => $orders->orders_id]);
				$orderHistory->order_state_lang_id = $orderStateLangId;
				$orderHistory->save();
				
				$orderDetail = \backend\models\OrderDetail::find()->where(['orders_id' => $orders->orders_id])->all();
				
				foreach($orderDetail as $detail){
					
					// update order detail history status
					$orderDetailHistory = new \backend\models\OrderDetailHistory();
					$orderDetailHistory->orders_id = $orders->orders_id;
					$orderDetailHistory->order_detail_id = $detail->order_detail_id;
					$orderDetailHistory->order_state_lang_id = $orderStateLangId;
					$orderDetailHistory->date_add = date("Y-m-d H:i:s");
					$orderDetailHistory->order_detail_state_lang_id = 1;
					$orderDetailHistory->save();
				}
				
				$existingCartsMC = \common\components\Helpers::getMailchimpExistingCarts();
				$carts = $existingCartsMC->carts;
				
				if(count($carts) > 0){
					foreach($carts as $cart){
						if($cart->customer->email_address == $orders->customer->email){
							$cartMC = $cart->lines;
							
							$cartId = $cart->id;
							\common\components\Helpers::deleteCartMailchimp($cartId);
						}
					}
					
					\common\components\Helpers::createOrdersMailchimp($orders->orders_id, $orders->customer_id, $cartMC);
					
				}
				
				$ordersReminder = \backend\models\OrdersReminder::findOne(['orders_id' => $orders->orders_id]);
			
				// update order reminder status
				if($ordersReminder != NULL){
					$ordersReminder->orders_reminder_status = 0;
					$ordersReminder->orders_canceled_status = 0;
					$ordersReminder->save();
				}
				
			}
			
		}
		
		$vaLogModel = new VaLog();
		$vaLogModel->va_bank = "vospay";
		$vaLogModel->transaction_time = $decode->timestamp;
		$vaLogModel->transaction_status = $decode->status;
		$vaLogModel->payment_type = "multi_finance";
		$vaLogModel->order_id = str_replace('WatchCo_VOSPAY_', '', $decode->orderID);
		$vaLogModel->gross_amount = "";
		$vaLogModel->save();
		
		print_r(json_encode($decode));
	}
	
	public function actionGetwarrantynumber(){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		
		$search = $_GET['q'];
		$items = array();
		
		if(isset($search)){
			$warrantys = \backend\models\Warranty::find()
				->where([
					'LIKE', 'warranty.warranty_number', '%'.$search.'%', false
				])
				->orWhere([
					'LIKE', 'warranty.warranty_code', '%'.$search.'%', false
				])
				->orderBy('warranty.warranty_id DESC')
				->all();
				
			if(count($warrantys) > 0){
				foreach($warrantys as $warranty){
					$items[] = array(
						"id" => $warranty->warranty_id,
						"text" => $warranty->warranty_code,
						"status" => $warranty->warranty_status
					);					
				}
			}
		}
		
		$warrantys = array(
			"total_count" => count($warrantys),
			"incomplete_results" => false,
			"items" => $items
		);
		
		return $warrantys;
	}
	
	public function actionGetwarrantylist(){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		
		$search = $_GET['q'];
		$items = array();
		
		if(isset($search)){
			$warrantys = \backend\models\Warranty::find()
				->where([
					'LIKE', 'warranty.warranty_code', '%'.$search.'%', false
				])
				->andWhere([
					"warranty.warranty_status" => strtoupper($_GET['status'])
				])
				->orderBy('warranty.warranty_id DESC')
				->all();
				
			if(count($warrantys) > 0){
				foreach($warrantys as $warranty){
					$items[] = array(
						"id" => $warranty->warranty_id,
						"text" => $warranty->warranty_code
					);					
				}
			}
		}
		
		$warrantys = array(
			"total_count" => count($warrantys),
			"incomplete_results" => false,
			"items" => $items
		);
		
		return $warrantys;
	}
	
	public function actionCheckorders(){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		
		$search = $_POST['q'];
		$data = array();
		
		$ordersModel = Orders::find()
			->leftJoin("customer", "orders.customer_id=customer.customer_id")
			->where(['like', 'customer.phone_number', $search])
			->orWhere(['like', 'customer.email', $search])
			->all();
		
		if(count($ordersModel) > 0){
			
			foreach($ordersModel as $row){
				
				$orderDetail = array();
				
				$orderDetailModel = OrderDetail::findAll(["orders_id" => $row->orders_id]);
				
				if(count($orderDetailModel) > 0){
					foreach($orderDetailModel as $rowOrderDetail){
						$orderDetail[] = array(
							"productName" => $rowOrderDetail->product_name . ' ' . $rowOrderDetail->productAttributeCombination->attributeValue->value,
							"productPrice" => $rowOrderDetail->product_price,
							"productWarrantyCode" => $rowOrderDetail->orderDetailWarranty->warranty->warranty_code,
							"productWarrantyNumber" => $rowOrderDetail->orderDetailWarranty->warranty->warranty_number,
							"productWarrantyExpireDate" => date_format(date_create($rowOrderDetail->orderDetailWarranty->warranty->warranty_expired_date), 'j F Y h:i A')
						);
					}
				}
				
				$data[] = array(
					"orderDetail" => $orderDetail,
					"customerName" => $row->customer->firstname . ' ' . $row->customer->lastname,
					"customerPhone" => $row->customer->phone_number,
					"orderReference" => $row->reference
				);
			}
			
			$orders = array(
				"success" => TRUE,
				"data" => $data
			);
			
			return $orders;
		}
		
		$orders = array(
			"success" => FALSE,
			"data" => $data
		);
		
		return $orders;
	}
	
	public function actionGetproductlist(){
		
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		
		$search = $_GET['q'];
		$items = array();
		
		if(isset($search)){
			$products = \backend\models\Product::find()
				->joinWith([
					"brands",
					"productDetail",
					"brandsCollection" => function ($query) {
						$query->andWhere(['brands_collection_status' => 1]);
					},
					"productTag",
					"productImage" => function ($query) {
						$query->andWhere(['cover' => 1]);
					}
				])
				->where([
					'LIKE', 'product_detail.name', '%'.$search.'%', false
				])
				->andWhere([
					"product.active" => 1
				])
				->orWhere([
					'LIKE', 'brands.brand_name', '%'.$search.'%', false,
				])
				->orWhere([
					'LIKE', 'brands_collection.brands_collection_name', '%'.$search.'%', false,
				])
				->orderBy('product.product_id DESC')
				->all();
				
			if(count($products) > 0){
				foreach($products as $product){
					
					$attributes_id = ProductAttribute::find()->where(['product_id' => $product->product_id])->all();
					
					if(count($attributes_id) != 0){
						foreach ($attributes_id as $row_id) {
							$combination_id = ProductAttributeCombination::find()->where(['product_attribute_id' => $row_id['product_attribute_id'], 'attribute_id'=>6])->one();
							$color = AttributeValue::find()->where(['attribute_value_id'=>$combination_id->attribute_value_id])->one();
							
							$items[] = array(
								"id" => $product->product_id,
								"text" => $product->productDetail->name . ' ' . $color->value,
								"unit_price" => $product->price,
								"product_attribute_id" => $row_id['product_attribute_id']
							);
						}
					} else {
						$items[] = array(
							"id" => $product->product_id,
							"text" => $product->productDetail->name,
							"unit_price" => $product->price,
							"product_attribute_id" => 0
						);
					}
					
				}
			}
		}
		
		$products = array(
			"total_count" => count($products),
			"incomplete_results" => false,
			"items" => $items
		);
		
		return $products;
	}
	
	public function actionAkulakuinquiry(){
		$akulaku = new \common\components\Akulaku();
		$akulaku->setEnvironment('production');
		$akulaku->setCredentials("626809194", "qeJjLw49bZkMlCAersNan2g-Ji7cQ8utPAxDoPy3hS0");
		
		$inquiry = $akulaku->inquiryStatus('TR171012144343');
		print_r($inquiry);
	}
	
	public function actionAkulaku(){
		
		//header('Content-Type: application/json');
        //$raw_body = 'php://input';
        //$raw_body = file_get_contents($raw_body);

        //$decode = json_decode($raw_body);
		
		//print_r(json_encode($decode)); die();
		
		//$status = \common\components\Akulaku::getPaymentStatus($_POST['status']);
		
		if($_POST['status'] == 100){
			
			// update order status
			$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "payment_success", "payment_method_id" => 5])->order_state_lang_id;
			
			$orders = \backend\models\Orders::findOne(["reference" => $_POST['refNo']]);
			
			if($orders != NULL){
				$orderHistory = \backend\models\OrderHistory::findOne(['orders_id' => $orders->orders_id]);
				$orderHistory->order_state_lang_id = $orderStateLangId;
				$orderHistory->save();
				
				$orderDetail = \backend\models\OrderDetail::find()->where(['orders_id' => $orders->orders_id])->all();
				
				foreach($orderDetail as $detail){
					
					// update order detail history status
					$orderDetailHistory = new \backend\models\OrderDetailHistory();
					$orderDetailHistory->orders_id = $orders->orders_id;
					$orderDetailHistory->order_detail_id = $detail->order_detail_id;
					$orderDetailHistory->order_state_lang_id = $orderStateLangId;
					$orderDetailHistory->date_add = date("Y-m-d H:i:s");
					$orderDetailHistory->order_detail_state_lang_id = 1;
					$orderDetailHistory->save();
				}
			}
		}
		
		return json_encode(array("code" => 0));
	}
	
    public function actionNinja(){

	    $ninja = new \common\components\Ninja();
        $ninja->setCredentials('34e6cb40cb5c457db360818b818ef333','36be65dc7522412db775232d08b1289f');

	    $hmac_header = $_SERVER['X-NINJAVAN-HMAC-SHA256'];
	    $data = file_get_contents('php://input');  
	    $verified = $ninja->verify_webhook($data, $hmac_header);
	    error_log('Webhook verified: '.var_export($verified, true)); //check error.log to see result

	    $decode = json_decode($data);

	    $model = new \backend\models\NinjaLog();
	    $model->tracking_id = $decode->tracking_id;
	    $model->status = $decode->status;
	    $model->previous_status = $decode->previous_status;
	    $model->ref_no = $decode->shipper_order_ref_no;
	    $model->timestamp = $decode->timestamp;
	    $model->date_time_add = date('Y-m-d H:i:s');

	    if(isset($decode->comments)){
	    	$model->comments = $decode->comments;
	    }

	    $model->save();
	}
	
    /**
     * @inheritdoc
     */
    public function actionPrism()
    {
        // $raw_body = 'http://localhost/thewatchco1/tools/prismrequest';
        header('Content-Type: application/json');
        $raw_body = 'php://input';
        $raw_body = file_get_contents($raw_body);

        $decode = json_decode($raw_body);

        // echo json_encode($decode);die();
        // print_r($decode);die();
        $like = '';
        foreach ($decode->must as $row) {
            $like = $row->query_string->query;
        }
  

        $this->layout = false;

        $products = \backend\models\Product::find()

                ->offset($decode->from)

                ->limit($decode->size)

                ->joinWith([

                    "brands",

                    "productDetail",

                    "brandsCollection" => function ($query) {

                        $query->andWhere(['brands_collection_status' => 1]);

                    },

                    "productImage" => function ($query) {

                        $query->andWhere(['cover' => 1]);

                    }

                ])

                ->where([

                    'LIKE', 'product_detail.name', $like,

//                    'OR', 'tags.tag_name', 'LIKE', '%'.$q.'%', false,

                  

                ])

                ->orWhere([

                    'LIKE', 'brands.brand_name', $like,

                ])

                ->orWhere([

                    'LIKE', 'brands_collection.brands_collection_name', $like,

                ])
                ->andWhere(['product.active' => 1])

                ->orderBy('product.product_id DESC')

                ->all();
        // print_r($products);die();
         // echo count($products);die();
        $array_product = array();
        $array_product['status'] = 'success';
        $array_product['data']['total'] = $decode->size;

        $i = 0;
        foreach ($products as $row) {

            $attribut_id_prod = [];
            $attribut_id = \backend\models\ProductAttribute::find()->where(['product_id' => $row->product_id])->all();
            // echo count($attribut_id);die();

            if(count($attribut_id) != 0){
                foreach ($attribut_id as $row_id) {
                    // $attribut_id_prod[] = $row_id['product_attribute_id'];
                    $combination_id = \backend\models\ProductAttributeCombination::find()->where(['product_attribute_id' => $row_id['product_attribute_id'], 'attribute_id'=>6])->one();
                    $color = \backend\models\AttributeValue::find()->where(['attribute_value_id'=>$combination_id->attribute_value_id])->one();

                    $productStock = \backend\models\ProductStock::findOne(["product_id" => $row->product_id, 'product_attribute_id' => $row_id['product_attribute_id']]);

                    $product_image = \backend\models\ProductAttributeImage::findOne(['id_product_attribute' => $row_id['product_attribute_id']]);


                    $result = array();
                    $result['id'] = $row->product_id.'-'.$row_id['product_attribute_id'];
                    $result['name'] = $row->productDetail->name.' - '.$color->value;
                    $result['description'] = $row->brands->brand_name;

                    if($product_image->product_image_id != ''){
                        $result['image_urls'][] = Yii::$app->params['cloudfrontDev'].'img/product/'.$product_image->product_image_id . '/' . $product_image->product_image_id.'.jpg';
                    }else{
                        $result['image_urls'][] = Yii::$app->params['cloudfrontDev'].'img/product/'.$row->productImage->product_image_id . '/' . $row->productImage->product_image_id.'.jpg';
                    }
                    
                

                    $result['stock'] = $productStock->quantity;
              
               
                    $result['price'] = $row->price.'';

                    $result['currency_code'] = 'IDR';
              

                    $spesificPrice = SpecificPrice::findOne(["product_id" => $row->product_id]);
                                        $discount = 0;
                                        $discount_type = 'NOMINAL';
                                        $now = date('Y-m-d H:i:s');
                                        if ($spesificPrice != null) {
                                            if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) {

                                            }else{
                                                if ($spesificPrice->reduction_type == 'percent') {
                                                        $discount = (($spesificPrice->reduction));
                                                        $discount_type = 'PERCENTAGE';
                                                    } elseif ($spesificPrice->reduction_type == 'amount') {
                                                        $discount = $spesificPrice->reduction;
                                                    }
                                            }
                                        }else{

                                        }
                    if($discount != 0){
                        $result['discount']['discount_type'] = $discount_type;
                        $result['discount']['amount'] = $discount.'';
          
                    }
                    
                    $array_product['data']['results'][] = $result;
                    $i++;
                    
                    if($i == $decode->size){
                        break;
                    }

                }
            }else{
                $result = array();
                    $result['id'] = $row->product_id.'';
                    $result['name'] = $row->productDetail->name;
                    $result['description'] = $row->brands->brand_name;
                    $result['image_urls'][] = Yii::$app->params['cloudfrontDev'].'img/product/'.$row->productImage->product_image_id . '/' . $row->productImage->product_image_id.'.jpg';
                    
                    $productStock = \backend\models\ProductStock::findOne(["product_id" => $row->product_id]);

                    $result['stock'] = $productStock->quantity;
              
               
                    $result['price'] = $row->price.'';

                    $result['currency_code'] = 'IDR';
              

                    $spesificPrice = SpecificPrice::findOne(["product_id" => $row->product_id]);
                                        $discount = 0;
                                        $discount_type = 'NOMINAL';
                                        $now = date('Y-m-d H:i:s');
                                        if ($spesificPrice != null) {
                                            if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) {

                                            }else{
                                                if ($spesificPrice->reduction_type == 'percent') {
                                                        $discount = (($spesificPrice->reduction));
                                                        $discount_type = 'PERCENTAGE';
                                                    } elseif ($spesificPrice->reduction_type == 'amount') {
                                                        $discount = $spesificPrice->reduction;
                                                    }
                                            }
                                        }else{

                                        }
                    if($discount != 0){
                        $result['discount']['discount_type'] = $discount_type;
                        $result['discount']['amount'] = $discount.'';
          
                    }
                    
                    $array_product['data']['results'][] = $result;
                    $i++;

                    if($i == $decode->size){
                        break;
                    }
            }
            
            
            if($i == $decode->size){
                        break;
                    }
            
        }
        // echo count($array_product);die();
        if($i != $decode_size){
            $array_product['data']['total'] = $i;
        }
        
        echo (json_encode($array_product));
        // return $this->render('prism',array(
        //     'product'=>$product_json,
           
        // ));
        die();
    }

    public function actionPrismrequest()
    {
        $this->layout = false;
        $request = array();
        $request['from'] = 0;
        $request['size'] = 10;
        $request['must'][]['query_string']['query'] = 'oxford';

        $request = json_encode($request);
        return $this->render('prism_request',array(
            'request'=>$request,
           
        ));
    }

    public function actionArea($name)
    {
        $this->layout = false;
        header('Content-Type: application/json');
        // $raw_body = 'php://input';
        // $raw_body = file_get_contents($raw_body);

        // $decode = json_decode($raw_body);
        // echo json_encode($decode);die();
        // print_r($decode);die();
        
        $like = '';
        if(isset($_GET['name'])){
            $like = $name;
        }else{
            die();
        }
        $result = array();
        $response = array();

        $district = \backend\models\District::find()
                ->offset(0)

                ->limit(25)

                ->joinWith([

                    "state",

                ])

                ->where([

                    'LIKE', 'district.name',$like,
           

                ])

                ->orWhere([

                    'LIKE', 'state.name',$like,

                ])


                ->all();


        $response['status'] = 'success';

        foreach ($district as $row) {
            

            $province = \backend\models\Province::find()->where(['province_id'=>$row['state']['province_id']])->one();

            $result['label'] = $row['name'].', '.$row['state']['name'].', '.$province->name;
            $result['provider'] = 'custom';
            $result['custom']['country'] = 'IDN';
            $result['custom']['first_level'] = $province->name;
            $result['custom']['second_level'] = $row['state']['name'];
            $result['custom']['third_level'] = $row['name'];
            $response['data']['results'][] = $result;
        }
        echo json_encode($response);die();
    }

   public function actionShippingcost()
    {
        $this->layout = false;
        header('Content-Type: application/json');
        $raw_body = 'php://input';
        $raw_body = file_get_contents($raw_body);

        $decode = json_decode($raw_body);
        // echo json_encode($decode);die();
        // print_r($decode);die();
        
        $like = '';
        if(!$decode){
            die();
            $like = $decode->name;
        }
        $result = array();
        $response = array();
        
        $grand_total = 0;
        foreach ($decode->data->cart->line_items as $row) {
            $discount = 0;
            

            if (strpos($row->product->id, '-') !== false) {
                $id = explode("-",$row->product->id);
                $productStock = \backend\models\ProductStock::findOne(["product_id" => $id[0], 'product_attribute_id' => $id[1]]);
                $product['quantity'] = $productStock->quantity;
                $product['attribute'] = $id[1];
                if($productStock->quantity == 0 || $row->quantity == 0){
                    $response['status'] = 'FAILED';
                    $response['message'] = 'Product '.$row->product->name.' is out of stock';

                    echo (json_encode($response));
                    die();
                }

                $spesificPrice = SpecificPrice::findOne(["product_id" => $id[0]]);
                                        $discount = 0;
                                        $discount_type = 'NOMINAL';
                                        $now = date('Y-m-d H:i:s');
                                        if ($spesificPrice != null) {
                                            if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) {

                                            }else{
                                                if ($spesificPrice->reduction_type == 'percent') {
                                                        $discount = (($spesificPrice->reduction));
                                                        $discount_type = 'PERCENTAGE';
                                                    } elseif ($spesificPrice->reduction_type == 'amount') {
                                                        $discount = $spesificPrice->reduction;
                                                    }
                                            }
                                        }else{

                                        }

                
            }else{
                $productStock = \backend\models\ProductStock::findOne(["product_id" => $row->product->id]);
                $product['quantity'] = $productStock->quantity;
                    if($productStock->quantity == 0 || $row->quantity == 0){
                    $response['status'] = 'FAILED';
                    $response['message'] = 'Product '.$row->product->name.' is out of stock';

                    echo (json_encode($response));
                    die();
                }

                $spesificPrice = SpecificPrice::findOne(["product_id" => $row->product->id]);
                                        $discount = 0;
                                        $discount_type = 'NOMINAL';
                                        $now = date('Y-m-d H:i:s');
                                        if ($spesificPrice != null) {
                                            if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) {

                                            }else{
                                                if ($spesificPrice->reduction_type == 'percent') {
                                                        $discount = (($spesificPrice->reduction / 100) * $row->product->price);
                                                        $discount_type = 'PERCENTAGE';
                                                    } elseif ($spesificPrice->reduction_type == 'amount') {
                                                        $discount = $spesificPrice->reduction;
                                                    }
                                            }
                                        }else{

                                        }
            }

            // if($row->discount){
                // if($row->discount->type == 'percentage'){
                //     $discount = $row->product->price * $row->discount->percentage / 100;
                // }elseif($row->discount->type == 'price'){
                //     $discount = $row->discount->price;
                // }
            // }
            // $spesificPrice = SpecificPrice::findOne(["product_id" => $row->product_id]);
         //                                $discount = 0;
         //                                $discount_type = 'NOMINAL';
         //                                $now = date('Y-m-d H:i:s');
         //                                if ($spesificPrice != null) {
         //                                 if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) {

         //                                 }else{
         //                                     if ($spesificPrice->reduction_type == 'percent') {
         //                                                $discount = (($spesificPrice->reduction));
         //                                                $discount_type = 'PERCENTAGE';
         //                                            } elseif ($spesificPrice->reduction_type == 'amount') {
         //                                                $discount = $spesificPrice->reduction;
         //                                            }
         //                                 }
         //                                }else{

         //                                }

            $grand_total = $grand_total + ($row->quantity * ($row->product->price - $discount));
            // $line_items = $product;
        }

        $district = \backend\models\District::find()
                ->joinWith([

                    "state",

                ])

                ->where([

                    'LIKE', 'district.name',$decode->data->shipment_area->custom->third_level,
           

                ])

                ->andWhere([

                    'LIKE', 'state.name',$decode->data->shipment_area->custom->second_level,

                ])


                ->one();

        $province = \backend\models\Province::find()->where(['province_id'=>$district->state->province_id])->one();

            

            $carrier_cost = \backend\models\CarrierCost::find()->where(['carrier_cost.district_id'=>$district->district_id])->andWhere(['carrier_cost.active'=> 1])->all();

            foreach ($carrier_cost as $row) {

                $shipment_choices = array();

                $carrier_package_detail = \backend\models\CarrierPackageDetail::find()->where(['carrier_package_detail_id'=>$row->carrier_package_detail_id])->one();

                $day = $row->day;
                $carrier_name = \backend\models\Carrier::find()->where(['carrier_id'=>$carrier_package_detail->carrier_id])->one()->name;
                $package_name = \backend\models\CarrierPackage::find()->where(['carrier_package_id'=>$carrier_package_detail->carrier_package_id])->one()->carrier_package_name;

                $shipment_choices['id'] = ''.$row->carrier_cost_id;
                $shipment_choices['name'] = $carrier_name.' '.$package_name.' '.$day.' hari';
                $shipment_choices['cost']['currency_code'] = 'IDR';

                if($grand_total >= 3000000){
                    $shipment_choices['cost']['amount'] = '0';
                 }elseif($grand_total >= 1000000 && $grand_total < 3000000){
                    if($package_name == 'REGULER'){
                        $shipment_choices['cost']['amount'] = '0';
                    }elseif($package_name == 'YES'){
                        $flatPrice = \backend\models\CarrierCostFlatPrice::find()->where(['province_id'=>$district->state->province_id , 'carrier_package_id'=>$carrier_package_detail->carrier_package_id, 'active'=> 1])->one();
                        $shipment_choices['cost']['amount'] = $flatPrice->price;
                    }
                 }else{
                        $flatPrice = \backend\models\CarrierCostFlatPrice::find()->where(['province_id'=>$district->state->province_id , 'carrier_package_id'=>$carrier_package_detail->carrier_package_id, 'active'=> 1])->one();
                        $shipment_choices['cost']['amount'] = $flatPrice->price;
                 }


                if($carrier_package_detail->carrier_package_id == 1 || $carrier_package_detail->carrier_package_id == 3){
                    $response['data']['shipment_choices'][]= $shipment_choices;
                 }
            }
        $response['status'] = 'success';
        // $response['price'] = $grand_total;

        echo json_encode($response);die();
    }
    
    
    public function actionPrismaddtocart()
    {
        // $raw_body = 'http://localhost/thewatchco1/tools/prismrequest';
        header('Content-Type: application/json');
        $raw_body = 'php://input';
        $raw_body = file_get_contents($raw_body);

        $this->layout = false;

        $decode = json_decode($raw_body);
        // echo json_encode($decode);die();
        $like = '';
        $grand_total = 0;
        $quantity = 0;
        $item = 0;
        $productStock = 0;
        $shipment = array();
        $line_items = array();
        $response = array();


        foreach ($decode->data->order->line_items as $row) {
           $product = [];
            $product['product']['name'] = $row->product->name;
            $product['product']['id'] = $row->product->id;
            $product['product']['info'] = $row->product->info;
            $product['product_attribute'] = 0;
            
            $product['currency_code'] = 'IDR';

            if (strpos($row->product->id, '-') !== false) {
                $id = explode("-",$row->product->id);
                $productStock = \backend\models\ProductStock::findOne(["product_id" => $id[0], 'product_attribute_id' => $id[1]]);
                $product['quantity'] = $row->quantity;
                $product['product_attribute'] = $id[1];

                if($productStock->quantity == 0){
                    $response['status'] = 'FAILED';
                    $response['message'] = 'Product '.$row->product->name.' is out of stock';

                    echo (json_encode($response));
                    die();
                }
                if($productStock->quantity < $row->quantity){
                    $response['status'] = 'FAILED';
                    $response['message'] = 'Order product '.$row->product->name.' is over limit';

                    echo (json_encode($response));
                    die();
                }

                $spesificPrice = SpecificPrice::findOne(["product_id" => $id[0]]);
                                        $discount = 0;
                                        $discount_type = 'NOMINAL';
                                        $now = date('Y-m-d H:i:s');
                                        if ($spesificPrice != null) {
                                            if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) {

                                            }else{
                                                if ($spesificPrice->reduction_type == 'percent') {
                                                        $discount = (($spesificPrice->reduction / 100) * $row->product->price);
                                                        $discount_type = 'PERCENTAGE';
                                                    } elseif ($spesificPrice->reduction_type == 'amount') {
                                                        $discount = $spesificPrice->reduction;
                                                    }
                                            }
                                        }else{

                                        }

                
            }else{
                $productStock = \backend\models\ProductStock::findOne(["product_id" => $row->product->id]);
                $product['quantity'] = $row->quantity;
                $product['product_attribute'] = 0;
                    if($productStock->quantity == 0){
                    $response['status'] = 'FAILED';
                    $response['message'] = 'Product '.$row->product->name.' is out of stock';

                    echo (json_encode($response));
                    die();
                }
                if($productStock->quantity < $row->quantity){
                    $response['status'] = 'FAILED';
                    $response['message'] = 'Order product '.$row->product->name.' is over limit';

                    echo (json_encode($response));
                    die();
                }

                $spesificPrice = SpecificPrice::findOne(["product_id" => $row->product->id]);
                                        $discount = 0;
                                        $discount_type = 'NOMINAL';
                                        $now = date('Y-m-d H:i:s');
                                        if ($spesificPrice != null) {
                                            if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) {

                                            }else{
                                                if ($spesificPrice->reduction_type == 'percent') {
                                                        $discount = (($spesificPrice->reduction / 100) * $row->product->price);
                                                        $discount_type = 'PERCENTAGE';
                                                    } elseif ($spesificPrice->reduction_type == 'amount') {
                                                        $discount = $spesificPrice->reduction;
                                                    }
                                            }
                                        }else{

                                        }
            }

          
            $product['price'] = $row->product->price - $discount;
            $item++;
            $quantity = $quantity + $row->quantity;
            $grand_total = $grand_total + ($row->quantity * ($row->product->price - $discount));
            $line_items[] = $product;
        }
     
        $order_number = \common\components\Helpers::generateOrderNumber();
        $response = array();
        $response['status'] = 'success';
        $response['data']['invoice']['id'] = $order_number;
        $response['data']['invoice']['status'] = 'ISSUED';
       
        $response['data']['invoice']['grand_total']['currency_code'] = 'IDR';
        $type = $decode->data->payment->provider->type;
        if($type == 'transfer'){
            $type = 'Bank Transfer';
        }

        $unique_code = 0;
                    if($type == "Bank Transfer"){
                        $orders->unique_code = \common\components\Helpers::generateUniqueCode();
                        $unique_code = $orders->unique_code;
                    }

        $response['data']['invoice']['grand_total']['amount'] = $grand_total + $unique_code + $decode->data->shipment->choice->cost->amount."";
         $response['data']['invoice']['line_items'] = $decode->data->order->line_items;
        // $response['data']['invoice']['buyer'] = $decode->data->buyer;
        $response['data']['invoice']['shipment'] = $decode->data->shipment;
        $response['data']['invoice']['payment'] = $decode->data->payment;


        $district = \backend\models\District::find()->joinWith(["state",])->where(['LIKE', 'district.name',$decode->data->shipment->provider->custom->third_level])->andWhere(['LIKE', 'state.name',$decode->data->shipment->provider->custom->second_level])->one();

        $province = \backend\models\Province::find()->where(['province_id'=>$district->state->province_id])->one();
        
        $customer = $this->checkcustomer($decode->data->buyer->email,$decode->data->buyer->name,$decode->data->buyer->phone_number);

      

        $address = $this->address($district->state->province_id,$district->state->state_id,$district->district_id,$customer->customer_id, $decode->data->buyer->name,$decode->data->shipment->info->address,$decode->data->shipment->info->postalCode,$decode->data->buyer->phone_number);

        

        // foreach ($line_items as $item) {
        //      $response['customer_id'] = $item['product']['id'];
        // }

        // $response['customer_id'] = $line_items;


        $invoice = $this->invoice($customer->customer_id,$decode->data->payment->provider->transfer->bank_name,$decode->data->payment->provider->transfer->account_holder,$decode->data->payment->provider->transfer->account_number,$type,$grand_total,$decode->data->shipment->provider->custom->third_level,$decode->data->shipment->provider->custom->second_level,$decode->data->shipment->provider->custom->first_level,$district->state->province_id,$quantity,$item,$line_items,$address->customer_address_id,$decode->data->shipment->choice->id,$decode->data->shipment->choice->cost->amount,$unique_code,$order_number,$customer->firstname,$customer->phone_number,$customer->email,$decode->data->shipment->info->address,$decode->data->shipment->info->postalCode,$decode->data->shipment->choice->name);
        echo (json_encode($response));
        die();
        

        

    }
    public function checkcustomer($email,$name,$phone){
        $customer = \backend\models\Customer::find()->where(['email'=>$email])->one();

        if($customer != null){
            return $customer;
        }else{
            
            
            $signup = new \backend\models\Customer();
            $signup->email = $email;
            $signup->firstname = $name;
            $signup->phone_number = $phone;

            $md = substr(md5($name), 0, 6);

            $signup->passwd = md5($md);
            $signup->apps_language_id = 1;
            $signup->active = 1;
            $signup->prism_account = 1;
           
            
            try {
                
                $signup->save();
                
                \common\components\Helpers::sendEmailMandrillUrlAPI(
                    $this->renderFile('@app/views/template/mail/signup.php', array(
                        "username" => $email, 
                        "password" => $md
                    )), 
                    'Welcome To The Watch Co', 
                    Yii::$app->params['adminEmail'], 
                    $email, 
                    ''
                );
                
                
            } catch (Exception $ex) {

            }
                        
            return $signup;

        }
    }

    public function invoice($customer_id, $bank_name, $account_holder, $account_number, $type, $grand_total, $kecamatan, $kota, $province, $province_id, $quantity,$item,array $line_items , $customer_address_id, $choice_id, $choice_amount,$unique,$order_number,$firstname,$phone_number,$email,$address,$postalcode, $choice_name){
       
                    
                    $orders = new \backend\models\Orders();
                    $orders->carrier_cost_id = $choice_id;
                    $orders->customer_id = $customer_id;
                    $orders->reference = $order_number;
                    $orders->secure_key = md5($order_number);
                    $orders->customer_address_id = $customer_address_id;

                    $payment_method_id = \backend\models\PaymentMethod::findOne(["payment_method_name" => $type])->payment_method_id;
                    $payment_id = \backend\models\Payment::findOne(["name_bank" => $bank_name])->payment_id;

                    $orders->payment_method_detail_id = \backend\models\PaymentMethodDetail::findOne(["payment_method_id" => $payment_method_id, "payment_id" => $payment_id])->payment_method_detail_id;
                    if($payment_method_id == 3){
                        // if($paymentMethod['installment_plan'] == 'i3m'){
                        //     $installmentId = \backend\models\PaymentMethodInstallmentDetail::findOne(['payment_id' => $paymentMethod['payment_id'], 'payment_method_installment_id' => 1])->payment_method_installment_detail_id;
                        // } elseif ($paymentMethod['installment_plan'] == 'i6m'){
                        //     $installmentId = \backend\models\PaymentMethodInstallmentDetail::findOne(['payment_id' => $paymentMethod['payment_id'], 'payment_method_installment_id' => 2])->payment_method_installment_detail_id;
                        // } elseif ($paymentMethod['installment_plan'] == 'i12m'){
                        //     $installmentId = \backend\models\PaymentMethodInstallmentDetail::findOne(['payment_id' => $paymentMethod['payment_id'], 'payment_method_installment_id' => 3])->payment_method_installment_detail_id;
                        // }
                        
                        // $orders->payment_method_installment_detail_id = $installmentId;
                    }
                    
                    
                    
                    $orders->prism = 1;
                    $orders->unique_code = $unique;
                    $orders->total_cart_item = $item;
                    $orders->total_cart_item_quantity = $quantity;
                    $orders->total_product_price = $grand_total;
                    $orders->total_shipping = $choice_amount;
                    $orders->date_add = date("Y-m-d H:i:s");
                    $orders->invoice_date = date("Y-m-d H:i:s");
                    $orders->apps_language_id = 2;
                    // $orders->carrier_cost_id = 0;
                    // $orders->carrier_cost_flat = 0;

                    $orders->save();
                    // print_r($line_items);die();
                    $order_state_lang_id = 0;

                    if ($payment_method_id == 1) {
                        $order_state_lang_id = \backend\models\OrderStateLang::findOne(["template" => "awaiting"])->order_state_lang_id;
                    } elseif ($payment_method_id== 3) {
                        $order_state_lang_id = \backend\models\OrderStateLang::findOne(["template" => "awaiting", "payment_method_id" => 3])->order_state_lang_id;
                    } elseif ($payment_method_id == 4) {
                        $order_state_lang_id = \backend\models\OrderStateLang::findOne(["template" => "awaiting", "payment_method_id" => 4])->order_state_lang_id;
                    } else {
                        $order_state_lang_id = 1;
                    }

                    foreach ($line_items as $item) {
                        $orders_detail = new \backend\models\OrderDetail();
                        $orders_detail->orders_id = $orders->orders_id;
                        $orders_detail->product_id = $item['product']['id'];
                        $orders_detail->product_name = $item['product']['name'];
                        $orders_detail->product_quantity = $item['quantity'];
                        $orders_detail->product_attribute_id = $item['product_attribute'];
                        $orders_detail->original_product_price = $item['price'];
                        $orders_detail->product_weight = \backend\models\Product::findOne(["product_id" => $item['product']['id']])->weight;
                        
                        $specificPrice = \backend\models\SpecificPrice::findOne(['product_id' => $item['product']['id']]);
                        if($specificPrice != NULL){
                            $type = $specificPrice->reduction_type;
                            
                            if($type == 'percent'){
                                $orders_detail->reduction_percent = $specificPrice->reduction;
                            } elseif($type == 'amount'){
                                $orders_detail->reduction_amount = $specificPrice->reduction;
                            }
                            
                            $orders_detail->product_price = \backend\models\Product::findOne(["product_id" => $item['product']['id']])->price;
                        } else {
                            $orders_detail->product_price = $item['price'];
                        }

                        $orders_detail->save();

                        // update product stock

                        $productStock = \backend\models\ProductStock::findOne(["product_id" => $item['product']['id'], "product_attribute_id" => $item['product_attribute']]);
                        // print_r($productStock);die();
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
                    
                    // $shippingCost = \backend\models\CarrierCost::findOne(['carrier_cost_id' => $_SESSION['customerInfo']['shippingMethod']['shipping_method']]);
                    
                    $shippingCost = $choice_amount;
                    // $totalPurchase = $this->getTotalPurchase();
                    
                    $discountAmount = 0;

                    // if(isset($voucherInfo)){
                    //     $discountAmount = $voucherInfo['reduction_percent'] == 0 ? $voucherInfo['reduction_amount'] : (($voucherInfo['reduction_percent'] / 100) * $totalPurchase);
                    // }
                    
                    try {
                        \common\components\Helpers::sendEmailMandrillUrlAPI(
                                $this->renderFile('@app/views/template/mail/prism_order_placed.php', array(
                                    "firstname" => $firstname,
                                    "phone_number" => $phone_number,
                                    "email" => $email,
                                    "kecamatan" => $kecamatan,
                                    "kota" => $kota,
                                    "province" => $province,
                                    "address" => $address,
                                    "postalcode" => $postalcode,
                                    "payment_id"=> $payment_id,
                                    "payment_method_id"=> $payment_method_id,
                                    "orderNumber" => $order_number,
                                    "items" => $line_items,
                                    "shippingCost" => $shippingCost,
                                    "choice_name" => $choice_name,
                                    "choice_amount" => $choice_amount,
                                    "unique" => $unique,
                                    // "weight" => $weight,
                                    "discount" => $discountAmount,
                                    "ordersId" => $orders->orders_id
                                )), \Yii::$app->params['orderPlacedSubjectEmail'], \Yii::$app->params['adminEmail'], $email, ''
                        );
                    } catch (Exception $ex) {
                        
                    }

                    // create last order number history session

                    $_SESSION['lastOrder'] = array(
                        "order_number" => $order_number
                    );
                    
                    // if(isset($voucherInfo)){
                        
                    //     // save voucher history
                    //     $order_cart_rule = new \backend\models\OrderCartRule();
                    //     $order_cart_rule->orders_id = $orders->orders_id;
                    //     $order_cart_rule->cart_rule_id = $voucherInfo['cart_rule_id'];
                    //     $order_cart_rule->name = $voucherInfo['code'];
                    //     $order_cart_rule->value = $discountAmount;
                    //     $order_cart_rule->save();
                        
                    //     // update quantity voucher code
                    //     $cart_rule = \backend\models\CartRule::findOne(["cart_rule_id" => $voucherInfo['cart_rule_id']]);
                    //     $cart_rule->quantity -= 1;
                    //     $cart_rule->save();
                        
                    // }

                    // unset($_SESSION['cart']);
                    // if(isset($voucherInfo)){
                    //     unset($_SESSION['voucherInfo']);
                    // }

                    return $orders;
    }

    public function address($province_id, $state_id, $district_id, $customer_id, $name, $cust_address, $postcode, $phone){
        $address = new \backend\models\CustomerAddress();
        $address->country_id = 111;
        $address->province_id = $province_id;
        $address->state_id = $state_id;
        $address->district_id = $district_id;
        $address->customer_id = $customer_id;
        $address->firstname = $name;
        $address->address1 = $cust_address;
        $address->postcode = $postcode;
        $address->phone = $phone;
        $address->active = 0;
        $address->prism = 1;

        $address->save();

        return $address;
    }

    public function actionGenerate(){
        $url = explode("/",$_SERVER['REQUEST_URI']);
       // print_r($url);die();
         $urls = explode("?",$url[2]);
         echo $url[2];
         print_r($urls);
    }
}
