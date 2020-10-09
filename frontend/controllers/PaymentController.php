<?php
namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Session;

use frontend\core\controller;

class PaymentController extends controller\FrontendController {
    
    public $breadcrumb = ["Gift"];
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
	
	public function actionCreditCard() {
		require_once Yii::$app->getBasePath() . '/include/Veritrans.php';
		
		\Veritrans_Config::$serverKey = Yii::$app->params['vtrans_conf']['svr_key'];
		\Veritrans_Config::$isProduction = Yii::$app->params['vtrans_conf']['is_production'];
		
		$acquiringBank = "mandiri"; // default
		$now = date("Y-m-d H:i:s");
		$current_date = $now;
		
		
        $data = $_POST;


        if ($data) {
            $sessionOrder = new \yii\web\Session();
            $sessionOrder->open();

            $cart = $sessionOrder->get("cart");
            $items = $cart['items'];

            isset($cart) && count($items) > 0 ? '' : $this->redirect(\Yii::$app->params['frontendUrl']);
			
            $weight = \common\components\Helpers::generateWeightOrder($items);

            $customerInfo = $sessionOrder->get("customerInfo");
            $shippingMethod = $customerInfo['shippingMethod'];

            $_SESSION['customerInfo']['paymentMethod']['payment_id'] = $data['payment_id'];
            $_SESSION['customerInfo']['paymentMethod']['payment_method_id'] = $data['payment_method_id'];

            $paymentMethod = $_SESSION['customerInfo']['paymentMethod'];

            $total_cart_quantity = 0;
            $total_product_price = 0;
            $total_cart_item = 0;
			$shippingCost = 0;
			
			$voucherInfo = $sessionOrder->get('voucherInfo');
			
			/*
			// check product quantity if equal zero
			// no longer can be order if product has reach zero quantity
			foreach ($items as $item) {
				$productStock = \backend\models\ProductStock::findOne(["product_id" => $item['id'], "product_attribute_id" => $item['product_attribute_id']]);
				
				// if quantity equal zero
				if($productStock->quantity <= 0){
					// cancel order, empty current shopping cart and redirect customer into homepage
					unset($_SESSION['cart']);
					if(isset($voucherInfo)){
						unset($_SESSION['voucherInfo']);
					}
					
					return $this->redirect(\Yii::$app->params['frontendUrl']);
				}
			}
			*/

            // Token ID from checkout page
            $token_id = $_POST['token_id'];

            foreach ($items as $item) {
                $total_cart_quantity += $item['quantity'];
                $total_product_price += $item['total_price'];
                $total_cart_item += 1;
            }
			
			if($total_cart_item == 0){
				$this->redirect(\Yii::$app->params['frontendUrl']);
            }
		
			$totalPurchase = (int) $this->getTotalPurchase();
			$totalOriginalPurchase = (int) $this->getOriginalTotalPurchase();
			
// 			echo $totalPurchase;
// 			exit;

			// prevent order only shipping values
			if($totalPurchase > 0){
				$this->redirect(\Yii::$app->params['frontendUrl']);
			
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
						$provinceId = \backend\models\CustomerAddress::findOne(['customer_address_id' => $_SESSION['customerInfo']['shippingMethod']['customer_address_id']])->province_id;
						$flatPrice = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 3])->price;
						
						if($now >= '2019-05-03 00:00:00' && $now <= '2019-05-11 00:00:00'){
							$shippingCost = 0;
						}else{
							$shippingCost = $flatPrice * $weight;
						}
					} else {
						if($shipment->carrier_id == 2){
							$shippingCost = 0;
						}
					}
				} else {
					if($shipment->carrierPackageDetail->carrierPackage->carrier_package_name == 'REGULER'){
						$provinceId = \backend\models\CustomerAddress::findOne(['customer_address_id' => $_SESSION['customerInfo']['shippingMethod']['customer_address_id']])->province_id;
						$flatPrice = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 1])->price;
						
						$shippingCost = $flatPrice * $weight;
					} elseif($shipment->carrierPackageDetail->carrierPackage->carrier_package_name == 'YES'){ 
						$provinceId = \backend\models\CustomerAddress::findOne(['customer_address_id' => $_SESSION['customerInfo']['shippingMethod']['customer_address_id']])->province_id;
						$flatPrice = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 3])->price;
						
						$shippingCost = $flatPrice * $weight;
					} else {
						$provinceId = \backend\models\CustomerAddress::findOne(['customer_address_id' => $_SESSION['customerInfo']['shippingMethod']['customer_address_id']])->province_id;
						$flatPrice = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 3])->price;
						
						$shippingCost = $flatPrice * $weight;
					}
				}
				
				$order_number = \common\components\Helpers::generateOrderNumber();
			
				$j = 1;
				$itemsDetail = array();
				$grandtotal = 0;
				$id = 0;
				$flash_sale_flag = 0;
				$attribute = '';
				$product_name = '';
				foreach ($items as $item) {
					if (strlen($item['name']) >= 50){
						$product_name = substr($item['name'], 0, 40) . '...';
					} else {
						$product_name = $item['name'];
					}

					if ($id == 0) {
						$id = $item['id'];
					}

					if ($item['product_attribute_id'] != '0') {
						$productAttribute = \backend\models\ProductAttributeCombination::findOne(["product_attribute_id" => $item['product_attribute_id']]);
						if ($productAttribute != NULL) {
							$attribute = $productAttribute->attributeValue->value;
						}
					}
					
					// $itemsDetail[] = array(
					// 	"id" => $item['id'],
					// 	"price" => $item['unit_price'],
					// 	"quantity" => $item['quantity'],
					// 	"name" => $product_name . ' ' . $attribute
					// );

					array_push($itemsDetail, array(
							"id" => $item['id'],
							"price" => $item['unit_price'],
							"quantity" => $item['quantity'],
							"name" => $product_name . ' ' . $attribute
						)
					);
					
					$grandtotal += $item['unit_price'] * $item['quantity'];

					$attribute = '';
					
					if($item['flash_sale'] == 1){
						$flash_sale_flag = 1;
					}

					$j++;
				}
						
				$discountAmount = 0;
            
				if(isset($voucherInfo)){
					$discountAmount = $voucherInfo['reduction_percent'] == 0 ? $voucherInfo['reduction_amount'] : (($voucherInfo['reduction_percent'] / 100) * $grandtotal);
					
					if($voucherInfo['extra_reduction_amount'] != 0 || $voucherInfo['extra_reduction_percent'] != 0){
						$totalPurchase -= $discountAmount;
						$extraDiscountAmount = $voucherInfo['extra_reduction_percent'] == 0 ? $voucherInfo['extra_reduction_amount'] : (($voucherInfo['extra_reduction_percent'] / 100) * $totalPurchase);
						$discountAmount += $extraDiscountAmount;
					}
					
					if(isset($voucherInfo['discount'])){
						$discountAmount = $voucherInfo['discount'];
					}
				}
			
				$orders = new \backend\models\Orders();
				$orders->flash_sale = $flash_sale_flag;
				$orders->customer_id = $customerInfo["customer_id"];
				$orders->reference = $order_number;
				$orders->secure_key = $_POST['_csrf'];
				$orders->customer_address_id = $shippingMethod['customer_address_id'];
				$orders->payment_method_detail_id = \backend\models\PaymentMethodDetail::findOne(["payment_method_id" => $paymentMethod['payment_method_id'], "payment_id" => $paymentMethod["payment_id"]])->payment_method_detail_id;
				$orders->total_shipping = $shippingCost;
				
				$totalShippingInsurance = 0;
				if($shippingMethod['shipping_insurance']){
				//	$totalShippingInsurance = $total_product_price - $discountAmount;
					$totalShippingInsurance = round((($totalOriginalPurchase * 0.5) / 100));
					$orders->total_shipping_insurance = $totalShippingInsurance;
				}
			
				$orders->total_cart_item = $total_cart_item;
				$orders->total_cart_item_quantity = $total_cart_quantity;
				$orders->total_product_price = $total_product_price;
				$orders->date_add = $now;
				$orders->invoice_date = $now;
				$orders->invoice_reminder_date = date('Y-m-d H:i:s', strtotime($orders->invoice_date . ' +1 day'));
				$orders->apps_language_id = 2;
				$orders->carrier_cost_id = $shippingMethod['shipping_method'];
			
				// if payment method is installment
				if($_POST['installment_plan'] != 0){
					$plan = $_POST['installment_plan'];
					
					if($plan == '3'){
						$installmentId = \backend\models\PaymentMethodInstallmentDetail::findOne(['payment_id' => $paymentMethod['payment_id'], 'payment_method_installment_id' => 1])->payment_method_installment_detail_id;
					} elseif($plan == '6'){
						$installmentId = \backend\models\PaymentMethodInstallmentDetail::findOne(['payment_id' => $paymentMethod['payment_id'], 'payment_method_installment_id' => 2])->payment_method_installment_detail_id;
					} elseif($plan == '12'){
						$installmentId = \backend\models\PaymentMethodInstallmentDetail::findOne(['payment_id' => $paymentMethod['payment_id'], 'payment_method_installment_id' => 3])->payment_method_installment_detail_id;
					}
					$orders->payment_method_installment_detail_id = $installmentId;
				}
				
				$orders->save(); // save data orders
			
				$orderReminder = new \backend\models\OrdersReminder();
				$orderReminder->orders_id = $orders->orders_id;
				$orderReminder->orders_reminder_date = date('Y-m-d H:i:s', strtotime($orders->invoice_date . ' +1 day'));
				$orderReminder->orders_canceled_date = date('Y-m-d H:i:s', strtotime($orders->invoice_date . ' +2 day'));
				$orderReminder->orders_reminder_status = 1;
				$orderReminder->save(); // save data orders reminder
				
				$order_state_lang_id = 0;

				$paymentMethodId = \backend\models\PaymentMethodDetail::findOne(["payment_method_detail_id" => $orders->payment_method_detail_id])->payment_method_id;
						
				$order_state_lang_id = \backend\models\OrderStateLang::findOne(["template" => "awaiting", "payment_method_id" => $paymentMethodId, "apps_language_id" => 1])->order_state_lang_id;

				/* periode 1 - 31 agustus */
				$permataBin = [
					'48938588', '46400588', '48938588', '471295', '46400577',
					'48938577', '48948577', '489385', '426254', '464005',
					'489385', '489385', '489385', '489385', '489385', 
					'426254323', '549846', '554302', '554302', '461785', 
					'544741', '518943', '518881', '520142', '520143', 
					'520153', '540889', '498853', '498853', '528872',
					'510505', '520366', '520370', '520371', '520383', 
					'543972', '542167', '454633', '454633', '498885', 
					'461753', '49885329', '49885327', '5408', '476334', 
					'453574'
				];
				
				$mandiriBin = [
					'490284', '490283', '437527', '437528', '437529', '450183', '450184', '450185',
					'400376', '489764', '400378', '415031', '415016', '415030', '415032', '415018',
					'415017', '416230', '416231', '416232', '400385', '400479', '400481', '479929',
					'479930', '479931', '421195', '427797', '421313', '445076', '445076', '445076', 
					'445076', '425945', '413719', '413718', '557338', '524325', '512676', '414931',
					'537793', '356350'
				];

				$citibankBin = [
					'454179', '454178', '414009', '552042', '540184', '542177', '461778', '425864', '529758', '559742', '559909', '508249'
				];

				$bcaBin = [
					'455633', '483545', '477377', '455632', '542643', '445377'
				];
			
				$isPermataCard = FALSE;
				$isMandiriCard = FALSE;
				$isCitiCard = FALSE;
				$isBCACard = FALSE;
				
				if($this->checkBinNumber($mandiriBin, $_POST['card-number'])){
					$isMandiriCard = TRUE;
				}
				
				if($this->checkBinNumber($permataBin, $_POST['card-number'])){
					$isPermataCard = TRUE;
				}

				if($this->checkBinNumber($citibankBin, $_POST['card-number'])){
					$isCitiCard = TRUE;
				}

				if($this->checkBinNumber($megaBin, $_POST['card-number'])){
					$isCitiCard = TRUE;
				}

				if($this->checkBinNumber($bcaBin, $_POST['card-number'])){
					$isBCACard = TRUE;
				}
			
				$hasPromoMandiriPermata = FALSE;
				$promoPermataMandiriAmount = 0;
				$haspromoBCA = FALSE;
				$promoBCAAmount = 0;
				
				foreach ($items as $item) {
					/* periode 1 - 31 agustus */
					
					// discount 10%
					$product_promos = \backend\models\Product::find()->where(['product.brands_brand_id'=>[48,44,79,2]])->all();
					$promoMandiriPermata = [];
					$i = 0;
					foreach ($product_promos as $product_promo) {
						$promoMandiriPermata[$i] = $product_promo->product_id;
						$i++;
					}
				
					// discount 5%
					$now = date('Y-m-d H:i:s');
					$product_promos_plus = \backend\models\Product::find()->joinWith(["specificPrice"])->where(['product.brands_brand_id'=>[48,44,79,2]])->andWhere('specific_price.from <= "'. $now . '"')
							->andWhere('specific_price.to > "'. $now . '"')->all();
					$promoMandiriPermataDiscount = [];
					$i = 0;
					foreach ($product_promos_plus as $product_promo) {
						$promoMandiriPermataDiscount[$i] = $product_promo->product_id;
						$i++;
					}
					
					if($now >= '2018-11-01 00:00:01' && $now <= '2019-01-31 23:59:59'){
						if(in_array($item['id'], $promoMandiriPermataDiscount)){ 
							$promoPermataMandiriAmount += ((0.05 * $item['unit_price']) * $item['quantity']); 
							$hasPromoMandiriPermata = TRUE; 
							$orders->total_special_promo = $promoPermataMandiriAmount;
							
							if($hasPromoMandiriPermata && $isPermataCard){
								$orders->special_promo_id = 5;
								$orders->update();
							}
							if($hasPromoMandiriPermata && $isMandiriCard){
								$orders->special_promo_id = 7;
								$orders->update();
							}
							
						}else{
							if(in_array($item['id'], $promoMandiriPermata)){ 
								$promoPermataMandiriAmount += ((0.10 * $item['unit_price']) * $item['quantity']); 
								$hasPromoMandiriPermata = TRUE; 
								$orders->total_special_promo = $promoPermataMandiriAmount;

								if($hasPromoMandiriPermata && $isPermataCard){
									$orders->special_promo_id = 4;
									$orders->update();
								}
								if($hasPromoMandiriPermata && $isMandiriCard){
									$orders->special_promo_id = 6;
									$orders->update();
								}
							}
						}
					}
			
					if ( $isBCACard ) {
						// special promo bank/payment bca credit card
						$promo_alias = 'bca-10-cc';
						$brands = array(48,44,79,85); // brands restrictions
						$is_discount_price = FALSE; // normal price
						$promo_bca_cc = \common\components\Helpers::getSpecialPromoProducts($promo_alias, $brands, $is_discount_price);
						if(in_array($item['id'], $promo_bca_cc['results'])){
							$promo_discount = ( (int)$promo_bca_cc['special_promo']['promo_amount']/100 );
							$promoBCAAmount += (($promo_discount * $item['unit_price']) * $item['quantity']);
							$haspromoBCA = TRUE; 
							$orders->total_special_promo = $promoBCAAmount;
							$orders->special_promo_id = (int)$promo_bca_cc['special_promo']['special_promo_id'];
							$orders->update();
						}
					}
					
					$orders_detail = new \backend\models\OrderDetail();
					$orders_detail->orders_id = $orders->orders_id;
					$orders_detail->product_id = $item['id'];
					$orders_detail->product_name = $item['name'];
					$orders_detail->product_quantity = $item['quantity'];
					$orders_detail->product_attribute_id = $item['product_attribute_id'];
					$orders_detail->original_product_price = $item['unit_price'];
					$orders_detail->product_weight = \backend\models\Product::findOne(["product_id" => $item['id']])->weight;
					
					$specificPriceAll = \backend\models\SpecificPrice::find()->where(['product_id' => $item['id']])->all();
					$check_discount = 0;
					$extraDiscountStartDate = '2018-10-10 00:00:00';
					$extraDiscountEndDate = '2018-10-10 23:59:59';
					
					if($specificPriceAll != NULL && count($specificPriceAll) != 0){
						foreach ($specificPriceAll as $specificPrice) {
							$type = $specificPrice->reduction_type;
						
							if($type == 'percent'){
								if($specificPrice->from <= $now && $specificPrice->to > $now){
									
									//if($specificPrice->description == "cybersale1010"){
										
										if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
											//$orders_detail->reduction_percent_extra = '10';
										}
									//}
											
									$orders_detail->reduction_percent = $specificPrice->reduction;
									if($orders_detail->reduction_percent != 0){
										
										// $orders_detail->reduction_percent_extra = 5; // temporary disable, need to implement this extra discount method to each related features
										$orders_detail->reduction_percent_extra = 0;
										
									}else{
										// $orders_detail->reduction_percent_extra = 10; // temporary disable, need to implement this extra discount method to each related features
										$orders_detail->reduction_percent_extra = 0; 
										$orders_detail->reduction_percent = 0;
									}
									$orders_detail->reduction_percent_plus_extra = 0;
									$check_discount = 1;break;
								}
							} elseif($type == 'amount'){
								if($specificPrice->from <= $now && $specificPrice->to > $now){
									
									//if($specificPrice->description == "cybersale1010"){
										
										if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
											$orders_detail->reduction_percent_extra = '10';
										}
									//}
									
									$orders_detail->reduction_amount = $specificPrice->reduction;
									$check_discount = 1;break;
								}
							}
						}
						
						$orders_detail->product_price = \backend\models\Product::findOne(["product_id" => $item['id']])->price;
					} else {
						if($orders_detail->reduction_percent != 0){
							// $orders_detail->reduction_percent_extra = 5; // temporary disable, need to implement this extra discount method to each related features
							$orders_detail->reduction_percent_extra = 0;
						}else{
							// $orders_detail->reduction_percent_extra = 10; // temporary disable, need to implement this extra discount method to each related features
							$orders_detail->reduction_percent_extra = 0;
							$orders_detail->reduction_percent = 0;
						}
						
						$orders_detail->reduction_percent_plus_extra = 0;
						$orders_detail->product_price = $item['unit_price'];
					}
					
					$orders_detail->save(); // save data orders detail

					// update product stock

					// $productStock = \backend\models\ProductStock::findOne(["product_id" => $item['id'], "product_attribute_id" => $item['product_attribute_id']]);
					// $productStock->quantity = ($productStock->quantity - $item['quantity']);

					// $productStock->update();
					
					// create order detail history
					$orderDetailHistory = new \backend\models\OrderDetailHistory();
					$orderDetailHistory->orders_id = $orders->orders_id;
					$orderDetailHistory->order_detail_id = $orders_detail->order_detail_id;
					$orderDetailHistory->order_state_lang_id = $order_state_lang_id;
					$orderDetailHistory->order_detail_state_lang_id = 1;
					$orderDetailHistory->date_add = date("Y-m-d H:i:s");
					$orderDetailHistory->save(); // save data orders detail history
				}
			
				$excludes = [[73,5], [75,12], [81,5], [82,5], [87,5], [14,5], [86,5], [88,5]];
				//BCA 10% MERDEKA NORMAL ITEM NON JEWELRY 3 && 6
				if($isBCACard){
			
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
								$special_promo_id = (int)$special_promo->special_promo_id;
								$orders->total_special_promo = $promo_amount;
								$orders->special_promo_id = $special_promo_id;
								$orders->update();
								$promoBCAAmount = $promo_amount;
								$haspromoBCA = TRUE;
								
								
							}
						}
					}
				}

				//MANDIRI 10% MERDEKA NORMAL ITEM NON JEWELRY 3 && 7
				if($isMandiriCard){
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
								$special_promo_id = (int)$special_promo->special_promo_id;
								$orders->total_special_promo = $promo_amount;
								$orders->special_promo_id = $special_promo_id;
								$orders->update();
								$promoPermataMandiriAmount = $promo_amount;
								$hasPromoMandiriPermata = TRUE;
							}
						}
					}
				}
				
			
				$orderState = new \backend\models\OrderState();
				$orderState->save(); // save data orders state

				$orderHistory = new \backend\models\OrderHistory();
				$orderHistory->orders_id = $orders->orders_id;
				$orderHistory->order_state_id = $orderState->order_state_id;
				$orderHistory->order_state_lang_id = $order_state_lang_id;
				$orderHistory->date_add = date("Y-m-d H:i:s");

				$orderHistory->save(); // save data orders history
				
				$_SESSION['lastOrder'] = array(
					"order_number" => $order_number
				);

				$customer = \backend\models\Customer::findOne(["customer_id" => $customerInfo['customer_id']]);
				$customerAddress = \backend\models\CustomerAddress::findOne(["customer_id" => $customer->customer_id]);

				if(isset($voucherInfo)){
					// $itemsDetail[] = array(
					//     "id" => $id,
					//     "price" => -round($discountAmount),
					//     "quantity" => 1,
					//     "name" => 'discount voucher'
					// );

					array_push($itemsDetail, array(
							"id" => $id,
							"price" => -round($discountAmount),
							"quantity" => 1,
							"name" => 'discount voucher'
						)
					);
					
					$order_cart_rule = new \backend\models\OrderCartRule();
					$order_cart_rule->orders_id = $orders->orders_id;
					$order_cart_rule->cart_rule_id = $voucherInfo['cart_rule_id'];
					$order_cart_rule->name = $voucherInfo['code'];
					$order_cart_rule->value = round($discountAmount);
					$order_cart_rule->save(); // save data order cart rule
					
					$cart_rule_id = $voucherInfo['cart_rule_id'];
					
				}
			
				if($totalShippingInsurance != 0){
					// $itemsDetail[] = array(
					// 	"id" => '0',
					// 	"price" => $shippingCost + $totalShippingInsurance,
					// 	"quantity" => '1',
					// 	"name" => 'SHIPPING ' . $shipment->carrierPackageDetail->carrierPackage->carrier_package_name . ' + INSURANCE'
					// );
					array_push($itemsDetail, array(
							"id" => '0',
							"price" => $shippingCost + $totalShippingInsurance,
							"quantity" => '1',
							"name" => 'SHIPPING ' . $shipment->carrierPackageDetail->carrierPackage->carrier_package_name . ' + INSURANCE'
						)
					);
				} else {
					// $itemsDetail[] = array(
					// 	"id" => '0',
					// 	"price" => $shippingCost,
					// 	"quantity" => '1',
					// 	"name" => 'SHIPPING ' . $shipment->carrierPackageDetail->carrierPackage->carrier_package_name
					// );
					array_push($itemsDetail, array(
							"id" => '0',
							"price" => $shippingCost,
							"quantity" => '1',
							"name" => 'SHIPPING ' . $shipment->carrierPackageDetail->carrierPackage->carrier_package_name
						)
					);
				}

				$billing_address = array(
					'first_name' => $customer->firstname,
					'last_name' => $customer->lastname,
					'email' => $customer->email,
					'address' => \backend\models\CustomerAddress::findOne(["customer_id" => $customer->customer_id])->address1,
					'city' => \backend\models\State::findOne(["state_id" => $customerAddress->state_id])->name,
					'postal_code' => $customerAddress->postcode,
					'phone' => $customerAddress->phone,
					'country_code' => 'IDN'
				);

				$shipping_address = array(
					'first_name' => $customer->firstname,
					'last_name' => $customer->lastname,
					'email' => $customer->email,
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

				$shippingPrice = $shippingCost;

				$grandtotal += $shippingPrice;
				$grandtotal += $totalShippingInsurance;
				$grandtotal -= round($discountAmount);
				
				if($hasPromoMandiriPermata && $isMandiriCard){
					// $itemsDetail[] = array(
					//     "id" => '0',
					//     "price" => -round($promoPermataMandiriAmount),
					//     "quantity" => 1,
					//     "name" => 'Promo Bank Mandiri'
					// );
					array_push($itemsDetail, array(
							"id" => '0',
							"price" => -round($promoPermataMandiriAmount),
							"quantity" => 1,
							"name" => 'Promo Bank Mandiri'
						)
					);
					
					$grandtotal -= round($promoPermataMandiriAmount);
				}
			
				if($hasPromoMandiriPermata && $isPermataCard){
					// $itemsDetail[] = array(
					//     "id" => '0',
					//     "price" => -round($promoPermataMandiriAmount),
					//     "quantity" => 1,
					//     "name" => 'Promo Bank Permata'
					// );	
					array_push($itemsDetail, array(
							"id" => '0',
							"price" => -round($promoPermataMandiriAmount),
							"quantity" => 1,
							"name" => 'Promo Bank Permata'
						)
					);
					
					$grandtotal -= round($promoPermataMandiriAmount);
				}
			
				if ($haspromoBCA && $isBCACard ) { // special promo bank/payment bca credit card
					// $itemsDetail[] = array(
					//     "id" => '0',
					//     "price" => -round($promoBCAAmount),
					//     "quantity" => 1,
					//     "name" => 'Promo Bank BCA'
					// );	
					array_push($itemsDetail, array(
							"id" => '0',
							"price" => -round($promoBCAAmount),
							"quantity" => 1,
							"name" => 'Promo Bank BCA'
						)
					);
					
					$grandtotal -= round($promoBCAAmount);
				}
			
			
				$transaction_details = array(
					'order_id' => $order_number,
					'gross_amount' => round($grandtotal)
				);
            
				$acquiringBank = isset($_POST['acquiring_bank']) && $_POST['acquiring_bank'] != '' ? $_POST['acquiring_bank'] : $acquiringBank;
				
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
						// 'bank_transfer' => array(
							// 'bank' => $acquiringBank
						// ),
						'credit_card' => array(
							'token_id' => $token_id,
							'bank' => $acquiringBank,
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
							// 'save_token_id' => isset($_POST['save_cc']),
							// 'bank' => $acquiringBank
						),
						'transaction_details' => $transaction_details,
						'item_details' => $itemsDetail,
						'customer_details' => $customer_details
					);
				}
			
				try {
					$hasVoucher = FALSE;
					
					unset($_SESSION['cart']);
					if(isset($voucherInfo)){
						$hasVoucher = TRUE;
						unset($_SESSION['voucherInfo']);
					}
					
					$decode = \Veritrans_VtDirect::charge($transaction_data);
					
				} catch (Exception $e) {
					// echo $e->getMessage();
					// die();
					// $this->redirect(\yii\helpers\Url::base());
					return $this->render('@app/modules/cart/views/checkout/payment/complete.php', array("status" => $e->getMessage()));
				}
			
				$orders = \backend\models\Orders::find()->where(['orders_id'=>$orders->orders_id])->one();
				if(YII_ENV === 'prod'){
					try {
						\common\components\Helpers::sendEmailMandrillUrlAPI(
							$this->renderFile('@app/views/template/mail/order_placed_new.php', array(
								"customerInfo" => $customerInfo,
								"orderNumber" => $order_number,
								"items" => $items,
								"shippingCost" => $shippingCost,
								"shippingInsurance" => $totalShippingInsurance,
								"weight" => $weight,
								"discount" => round($discountAmount),
								"model" => $orders
							)), \Yii::$app->params['orderPlacedSubjectEmail'], \Yii::$app->params['adminEmail'], $customerInfo["email"], ''
						);
					} catch (Exception $ex) {

					}

				}

				// Set Transaction Status
				// Success
				if ($decode->transaction_status == 'capture') {

					$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "payment_success", "payment_method_id" => 2])->order_state_lang_id;

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
					
					if($hasVoucher){
						// update quantity voucher code
						$cart_rule = \backend\models\CartRule::findOne(["cart_rule_id" => $cart_rule_id]);
						$cart_rule->quantity -= 1;
						$cart_rule->save();
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
					
					$ordersReminder = \backend\models\OrdersReminder::findOne(['orders_id' => $orders->orders_id]);
				
					// update order reminder status
					if($ordersReminder != NULL){
						$ordersReminder->orders_reminder_status = 0;
						$ordersReminder->orders_canceled_status = 0;
						$ordersReminder->save();
					}

					// $this->redirect(\yii\helpers\Url::base() . '/cart/checkout/step/ordercomplete');
				}

				// Deny
				elseif ($decode->transaction_status == 'deny') {

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


					// $this->redirect(\yii\helpers\Url::base() . '/cart/checkout/step/ordercomplete');
				}

				// Challenge
				elseif ($decode->transaction_status == 'challenge') {

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

					// $this->redirect(\yii\helpers\Url::base() . '/cart/checkout/step/ordercomplete');
				} 
				// End Set Transaction Status
				
				if ( $cust_email === 'dev@thewatch.co' ) {
					if($_POST['installment_plan'] != 0){
						$arr_output = array(
							'data' => $data,
							'transaction_data' => array(
								'payment_type' => 'credit_card',
								// 'bank_transfer' => array(
									// 'bank' => $acquiringBank
								// ),
								'credit_card' => array(
									'token_id' => $token_id,
									'bank' => $acquiringBank,
									'save_token_id' => isset($_POST['save_cc']),
									'installment_term' => $plan
								),
								'transaction_details' => $transaction_details,
								'item_details' => $itemsDetail,
								'customer_details' => $customer_details
							)
						);
					} else {
						$arr_output = array(
							'data' => $data,
							'transaction_data' => array(
								'payment_type' => 'credit_card',
								'credit_card' => array(
									'token_id' => $token_id,
									'save_token_id' => isset($_POST['save_cc']),
									'bank' => $acquiringBank
								),
								'transaction_details' => $transaction_details,
								'item_details' => $itemsDetail,
								'customer_details' => $customer_details
							),
							'decode' => $decode,
						);
					}
					\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
					return $arr_output;
					exit();
					// die(var_dump($arr_output));
					// exit();
				} else {
					$this->redirect(\yii\helpers\Url::base() . '/cart/checkout/step/ordercomplete');
				}
			}
			else {
				unset($_SESSION['cart']);
				if(isset($voucherInfo)){
					$hasVoucher = TRUE;
					unset($_SESSION['voucherInfo']);
				}
				$this->redirect(\yii\helpers\Url::base() . '/payment/cancelled');
			}
        }
    }
	
	public function actionCreditCardFlash() {
		
		$now = date("Y-m-d H:i:s");
		
        $data = $_POST;

        if ($data) {

            $sessionOrder = new \yii\web\Session();
            $sessionOrder->open();

           	$customerInfo = $sessionOrder->get("customerInfo");

            $total_cart_quantity = 0;
            $total_product_price = 0;
            $total_cart_item = 0;
			
			$voucherInfo = $sessionOrder->get('voucherInfo');

            $data['order_id'] == '' ? '' : $this->redirect(\yii\helpers\Url::base());
			
			
			// check product quantity if equal zero
			// no longer can be order if product has reach zero quantity
			

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

	        $order = \backend\models\Orders::find()->where(['orders_id'=>$data['order_id']])->one();
	        $order_details = \backend\models\OrderDetail::find()->where(['orders_id'=>$data['order_id']])->all();
				
			$j = 1;
            $itemsDetail = array();
            $grandtotal = 0;
            $id = 0;
            $attribute = '';
			$product_name = '';
            foreach ($order_details as $order_detail) {
				
				if (strlen($order_detail->product_name) >= 50){
					$product_name = substr($order_detail->product_name, 0, 40) . '...';
				} else {
					$product_name = $order_detail->product_name;
				}
				
//                if($id == 0){
//                    $id = $item['id'];
//                }

                if ($id == 0) {
                    $id = $order_detail->product_id;
                }

                if ($order_detail->product_attribute_id != '0') {
                    $productAttribute = \backend\models\ProductAttributeCombination::findOne(["product_attribute_id" => $order_detail->product_attribute_id]);
                    if ($productAttribute != NULL) {
                        $attribute = $productAttribute->attributeValue->value;
                    }
                }
				
				$itemsDetail[] = array(
					"id" => $order_detail->product_id,
					"price" => $order_detail->original_product_price,
					"quantity" => $order_detail->product_quantity,
					"name" => $product_name . ' ' . $attribute
				);
				
				$grandtotal += $order_detail->original_product_price * $order_detail->product_quantity;

                $attribute = '';

                $j++;
            }
            

			$permataBin = [
				'48938588', '46400588', '48938588', '471295', '46400577',
				'48938577', '48948577', '489385', '426254', '464005',
				'489385', '489385', '489385', '489385', '4893 85', '426254323',
				'549846', '554302', '554302', '461785', '544741', '518943', '518881',
				'520142', '520143', '520153', '540889', '498853', '498853', '528872',
				'510505', '520366', '520370', '520371', '520383', '543972', '542167',
				'454633', '454633', '498885', '461753', '49885329', '49885327', '5408'
			];
			
			$mandiriBin = [
				'490284', '490283', '437527', '437528', '437529', '450183', '450184', '450185',
				'400376', '489764', '400378', '415031', '415016', '415030', '415032', '415018',
				'415017', '416230', '416231', '416232', '400385', '400479', '400481', '479929',
				'479930', '479931', '421195', '427797', '421313', '445076', '445076', '445076', 
				'445076', '425945', '413719', '413718', '557338', '524325', '512676', '414931',
				'537793', '356350'
			];
			
			$isPermataCard = FALSE;
			$isMandiriCard = FALSE;
			
			if($this->checkBinNumber($permataBin, $_POST['card-number'])){
				$isPermataCard = TRUE;
			}
			
			if($this->checkBinNumber($mandiriBin, $_POST['card-number'])){
				$isMandiriCard = TRUE;
			}
			
			$promoPermata = [
				850, 851, 813, 814, 817, 818, 819, 872, 823, 824, 881, 873, 1064, 1063, 826,
				1060, 884, 828, 1688, 1495, 1494, 1493, 1491, 1488, 1487, 1499, 1500, 1484,
				1503, 876, 877, 832, 1125, 804, 1127, 840, 842, 845, 1507, 1315, 1316, 1317, 
				1318, 1319, 1320, 1321, 1322, 1323, 1324, 1325, 1326, 1685, 1687, 1468, 1403, 
				1404, 88, 89, 90, 91, 92, 93, 94, 95, 97, 98, 99, 100, 101, 102, 103, 104, 105,
				106, 107, 108, 109, 110, 114, 115, 117, 118, 119, 120, 121, 122, 123, 124, 125,
				126, 127, 128, 129, 130, 131, 133, 170, 172, 365, 367, 378, 382, 438, 439, 440,
				441, 442, 443, 444, 445, 446, 447, 448, 449, 450, 451, 452, 454, 455, 456, 457,
				458, 459, 460, 461, 462, 463, 464, 465, 466, 467, 468, 469, 470, 471, 472, 1024,
				1025, 1027, 1028, 1029, 1030, 1032, 1034, 1327, 1328, 1329, 1330, 1332, 1333, 1334,
				1335, 1337, 1338, 1339, 1340, 1341, 1342, 1457, 1458, 1459, 1460, 1581, 1582, 1583,
				1584, 1683, 1684, 1692, 1693, 1816, 1819, 1820, 1821, 1822, 1823, 1824, 1825, 1826,
				1827, 2026, 2028, 2029, 2030, 2031, 2032, 2033, 2034, 2035, 2036, 2037, 2038, 2039, 
				2040, 2041, 2130, 2132, 2134, 2136, 2137, 2139, 2140, 2141, 2143, 2144, 2145, 2146,
				2147, 2148, 2149, 2150, 2151, 2152, 2153, 2154, 2155, 2156, 2157, 2158, 2159, 2160,
				2161, 2162, 2163, 2164, 2165, 2166, 2167, 2201, 2202, 2203, 2204, 2205, 2206, 2207,
				2208, 2209, 2210, 2211, 2212, 2213, 2214, 2215, 2216, 2217, 2218, 2219, 2220, 2221,
				2222, 2223, 2224, 2225, 2226, 2227, 2228, 2229, 2230, 2231, 2232, 2233, 2234, 2235,
				2236, 2237, 2238, 2239, 2240, 2241, 2242, 2243, 2244, 2245, 2246, 2247, 2248, 2249,
				2250, 2251, 2252, 2253, 2378, 2379, 2380, 2381, 2382, 2383, 2384, 2385, 2386, 2387,
				2388, 2389, 2392, 2393, 2394, 2395, 2396, 2397, 2398, 2445, 2446, 2447, 2449, 2450, 
				2451, 2452, 2453, 2454, 2455, 2456, 2457, 2458, 2459, 2460, 2461, 2462, 2463, 194,
				193, 300, 302, 308, 7, 8, 1811, 1461, 6, 9, 312, 313, 314, 315, 555, 556, 1512, 1520,
				2057, 2058, 2059, 2061, 2062, 2063, 2064, 2065, 2067, 2068, 2070, 2073, 2074, 2075,
				2076, 2077, 2078, 2079, 2080, 2081, 2082, 2083, 2084, 2085, 2086, 2087, 2088, 2089,
				2403, 2405, 2406, 2407, 2408, 2409, 2410, 2441, 2442, 2443, 2444, 593, 596, 694, 695,
				113, 146, 153, 213, 217, 220, 225, 227, 228, 229, 232, 316, 317, 318, 319, 320, 321,
				322, 323, 325, 326, 327, 328, 329, 330, 331, 332, 334, 336, 338, 339, 340, 342, 343,
				344, 345, 346, 348, 349, 350, 351, 352, 353, 354, 355, 356, 357, 358, 359, 360, 361,
				362, 363, 364, 366, 368, 369, 370, 371, 374, 375, 376, 377, 379, 380, 381, 534, 535,
				537, 538, 539, 775, 776, 777, 778, 779, 780, 781, 782, 783, 784, 785, 787, 788, 789,
				793, 796, 797, 798, 801, 802, 2132, 2134, 2228, 2388, 2394, 2396, 2397, 1668, 1669,
				1670, 1671, 1672, 1673, 1676, 1677, 1154, 1177, 264, 1153, 981, 984, 985, 986, 990, 
				992, 995
			];
			
			$promoMandiriKomono = [
				2226, 2224, 2130, 2136, 2137, 2140, 2141, 2227, 2143, 2144, 2145, 2146, 2147, 2387,
				2389, 2148, 2149, 2151, 2152, 2153, 2154, 2158, 2160, 2161, 2162, 2163, 2164, 2165,
				2166, 2167, 2392, 2398, 2201, 2202, 2204, 2205, 2206, 2207, 2208, 2209, 2210, 2211,
				2212, 2213, 2214, 2215, 2216, 2217, 2218, 2219, 2220, 2221, 2445, 2446, 2447, 2231,
				2232, 2233, 2234, 2235, 2236, 2237, 2238, 2239, 2240, 2241, 2242, 2243, 2244, 2245,
				2246, 2247, 2248, 2249, 2250, 2251, 2252, 2253, 2378, 2379, 2380, 2381, 2382, 2383,
				2384, 2385, 2386, 2449, 2450, 2451, 2452, 2453, 2454, 2455, 2456, 2457, 2458, 2459,
				2460, 2461, 2462, 2463 
			];
			
			$promoMandiriTimex = [
				2048, 2049, 1788, 2090, 2097, 2098, 1792, 2099, 1793, 2111, 2112, 2113, 2114, 2115, 
				2116, 2092, 2094, 2102, 2104, 1803, 2168, 2107, 2109, 2110, 2254, 2169, 1736, 1737, 
				2171, 2091, 1802, 1743, 1746, 1748, 1749, 1750, 1751, 2100, 2101, 1731, 1732, 1786, 
				1794, 2172, 2173
			];
			
			$hasPromoPermata = FALSE;
			$hasPromoMandiri = FALSE;
			$promoPermataAmount = 0;
			$promoMandiriAmount = 0;
			
            foreach ($order_details as $order_detail) {
				
				if(in_array($order_detail->product_id, $promoPermata)){ 
					$hasPromoPermata = TRUE; 
				}
				
				if(in_array($order_detail->product_id, $promoMandiriKomono)){ 
					$promoMandiriAmount += round((0.20 * $order_detail->original_product_price) * $order_detail->product_quantity); 
					$hasPromoMandiri = TRUE;
				}
				
				if(in_array($order_detail->product_id, $promoMandiriTimex)){ 
					$promoMandiriAmount += round((0.20 * $order_detail->original_product_price) * $order_detail->product_quantity); 
					$hasPromoMandiri = TRUE;
				}
				
               
            }

            $order_cart_rule = \backend\models\OrderCartRule::find()->where(['orders_id'=>$data['order_id']])->one();

            $discountAmount = 0;
            if($order_cart_rule != null){
                
                $itemsDetail[] = array(
                    "id" => $id,
                    "price" => -round($order_cart_rule->value),
                    "quantity" => 1,
                    "name" => 'discount voucher'
                );
                
                $discountAmount = $order_cart_rule->value;
            }
			
			if($order->total_shipping_insurance != 0){
				$itemsDetail[] = array(
					"id" => '0',
					"price" => $order->total_shipping + $order->total_shipping_insurance,
					"quantity" => '1',
					"name" => 'SHIPPING ' . $order->carriercost->carrierPackageDetail->carrierPackage->carrier_package_name . ' + INSURANCE'
				);
			} else {
				$itemsDetail[] = array(
					"id" => '0',
					"price" => $order->total_shipping,
					"quantity" => '1',
					"name" => 'SHIPPING ' . $order->carriercost->carrierPackageDetail->carrierPackage->carrier_package_name
				);
			}

            $billing_address = array(
                'first_name' => $order->customeraddress->firstname,
                'last_name' => $order->customeraddress->lastname,
                'address' => $order->customeraddress->address1,
                'city' => \backend\models\State::findOne(["state_id" => $order->customeraddress->state_id])->name,
                'postal_code' => $order->customeraddress->postcode,
                'phone' => $order->customeraddress->phone,
                'country_code' => 'IDN'
            );

            $shipping_address = array(
                'first_name' => $order->customeraddress->firstname,
                'last_name' => $order->customeraddress->lastname,
                'address' => $order->customeraddress->address1,
                'city' => \backend\models\State::findOne(["state_id" => $order->customeraddress->state_id])->name,
                'postal_code' => $order->customeraddress->postcode,
                'phone' => $order->customeraddress->phone,
                'country_code' => 'IDN'
            );

            // Populate customer's info
            $customer_details = array(
                'first_name' => $order->customeraddress->firstname,
                'last_name' => $order->customeraddress->lastname,
                'email' => $order->customer->email,
                'phone' => $order->customeraddress->phone,
                'billing_address' => $billing_address,
                'shipping_address' => $shipping_address
            );

            $shippingPrice = $order->total_shipping;

            $grandtotal += $order->total_shipping;
			$grandtotal += $order->total_shipping_insurance;
			$grandtotal -= round($discountAmount);

			if($hasPromoPermata && $isPermataCard){
				$promoPermataAmount = $grandtotal * 0.05;
				$itemsDetail[] = array(
                    "id" => '0',
                    "price" => -round($promoPermataAmount),
                    "quantity" => 1,
                    "name" => 'Promo Bank Permata'
                );
			}
			
			if($hasPromoMandiri && $isMandiriCard){
				$itemsDetail[] = array(
                    "id" => '0',
                    "price" => -round($promoMandiriAmount),
                    "quantity" => 1,
                    "name" => 'Promo Bank Mandiri'
                );
				
				$grandtotal -= round($promoMandiriAmount);
			}
			
			$grandtotal -= round($promoPermataAmount);
			
			$transaction_details = array(
                'order_id' => $order->reference,
                'gross_amount' => round($grandtotal)
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
            
            //print_r($items);
            //echo $grandtotal;
            //die();
        //   print_r($transaction_data);
        //   die();
		    
            //                        
            try {
                $decode = \Veritrans_VtDirect::charge($transaction_data);
				
				$hasVoucher = FALSE;
				unset($_SESSION['cart']);
				if(isset($voucherInfo)){
					$hasVoucher = TRUE;
					unset($_SESSION['voucherInfo']);
				}
				
            } catch (Exception $e) {
                echo $e->getMessage();
              
                die();
//                return $this->render('@app/modules/cart/views/checkout/payment/complete.php', array("status" => $e->getMessage()));
                $this->redirect(\yii\helpers\Url::base());
            }
			
			$i = 0;
	        $weight = 0;
	        $items = [];

	        foreach ($order_details as $order_detail) {
	        	$items[$i]['id'] = $order_detail->product_id;
	        	$items[$i]['reference'] = $order->reference;
	        	$items[$i]['name'] = $order_detail->product_name;
	        	$items[$i]['weight'] = $order_detail->product_weight;
	        	$items[$i]['quantity'] = $order_detail->product_quantity;
	        	$items[$i]['unit_price'] = $order_detail->original_product_price;
	        	$items[$i]['total_price'] = $order_detail->product_quantity * $order_detail->original_product_price;

	        	$productAttribute = \backend\models\ProductAttributeCombination::findOne(["product_attribute_id" => $order_detail->product_attribute_id]);
                    if ($productAttribute != NULL) {
                        $items[$i]['color'] = $productAttribute->attributeValue->value;
                    }else{
                    	$items[$i]['color'] = '';
                    }

	            $weight = $weight + ($order_detail->product_weight * $order_detail->product_quantity);
	            $i++;
	        }

	        if ($weight < 1000) {
	            $weight = 1000;
	        }

	        $weight = round($weight / 1000, 0, PHP_ROUND_HALF_UP);


			try {
                \common\components\Helpers::sendEmailMandrillUrlAPI(
                    $this->renderFile('@app/views/template/mail/order_placed_midtrans.php', array(
                        "customerInfo" => $customerInfo,
                        "orderNumber" => $order->reference,
                        "items" => $items,
                        "shippingCost" => $order->total_shipping,
						"shippingInsurance" => $order->total_shipping_insurance,
                        "weight" => $weight,
                        "discount" => round($discountAmount)
                    )), \Yii::$app->params['orderPlacedSubjectEmail'], \Yii::$app->params['adminEmail'], $customerInfo["email"], ''
                );
            } catch (Exception $ex) {

            }
			
			$this->redirect(\yii\helpers\Url::base() . '/cart/checkout/step/ordercompleteflash');

            
        }
    }
	
	private function checkBinNumber($needles, $haystack)
	{
		if (is_array($needles) || is_object($needles)) {
			foreach($needles as $needle){
				if (strpos($haystack, $needle) !== false) {
					return true;
				}
			}
		}
		return false;
	}
	
	public function actionKredivoResult(){
		return $this->render('result', array(
			'result' => $_GET['tr_status']
		));
	}
	
	public function actionKredivoCheckout(){
        
        $totalAmountOrder = 0;
		$voucherAmount = 0;
        
        $sessionOrder = new Session();
        $sessionOrder->open();
        
        $transaction_id = \backend\models\Orders::find()->where(['reference' => $_SESSION['lastOrder']['order_number']])->one();
        $items = \backend\models\OrderDetail::find()->where(['orders_id' => $transaction_id['orders_id']])->all();
		$orderCartRule = \backend\models\OrderCartRule::find()->where(['orders_id' => $transaction_id['orders_id']])->one();
		
		if($orderCartRule != NULL){
			$voucherAmount = $orderCartRule->value;
		}
        
        foreach($items as $row){
            $item[0] = array('weight' => $row->product_weight, 'quantity' => $row->product_quantity);
            $weight = $weight + \common\components\Helpers::generateWeightOrder($item);
        }

        $products = array();
        foreach ($items as $item) {
            
            $productId = \backend\models\Product::findOne(["product_id" => $item['product_id']]);
            
            $products[] = array(
                'id' => $item['product_id'],
                'name' => $item['product_name'],
                'price' => $item['original_product_price'],
                'type' => $productId->productCategory->product_category_name,
                'url' => 'https://www.thewatch.co/product/' . $productId->productDetail->link_rewrite,
                'quantity' => $item['product_quantity']
            );
            
            $totalAmountOrder += $item['original_product_price'] * $item['product_quantity'];
        }
        
		if($transaction_id->total_shipping_insurance != 0){
			// shipping
			$products[] = array(
				'id' => 'shippingfee',
				'name' => 'SHIPPING ' . $transaction_id->carriercost->carrier->name . ' ' . $transaction_id->carriercost->carrierPackageDetail->carrierPackage->carrier_package_name . ' + INSURANCE',
				'price' => $transaction_id->total_shipping + $transaction_id->total_shipping_insurance,
				'quantity' => 1
			);
		} else {
			// shipping
			$products[] = array(
				'id' => 'shippingfee',
				'name' => 'SHIPPING ' . $transaction_id->carriercost->carrier->name . ' ' . $transaction_id->carriercost->carrierPackageDetail->carrierPackage->carrier_package_name,
				'price' => $transaction_id->total_shipping,
				'quantity' => 1
			);
		}
		
        $params_transaction_details = array(
            'order_id' => $_SESSION['lastOrder']['order_number'],
            'amount'   => ($totalAmountOrder + $transaction_id->total_shipping + $transaction_id->total_shipping_insurance) - $voucherAmount,
            'items'    => $products,
        );
        
        $params_billing_address = array(
            'first_name'   => $transaction_id->customeraddress->firstname,
            'last_name'    => $transaction_id->customeraddress->lastname,
            'address'      => $transaction_id->customeraddress->address1,
            'city'         => $transaction_id->customeraddress->state->name,
            'postal_code'  => $transaction_id->customeraddress->postcode,
            'phone'        => $transaction_id->customeraddress->phone,
            'country_code' => "IDN",
        );
        
        $params_shipping_address = array(
            'first_name'   => $transaction_id->customeraddress->firstname,
            'last_name'    => $transaction_id->customeraddress->lastname,
            'address'      => $transaction_id->customeraddress->address1,
            'city'         => $transaction_id->customeraddress->state->name,
            'postal_code'  => $transaction_id->customeraddress->postcode,
            'phone'        => $transaction_id->customeraddress->phone,
            'country_code' => "IDN",
        );
        
        $params_customer = array(
            'first_name' => $transaction_id->customer->firstname,
            'last_name'  => $transaction_id->customer->lastname,
            'email'      => $transaction_id->customer->email,
            'phone'      => $transaction_id->customeraddress->phone,
        );
        
        $params = array(
            'is_production'       => Yii::$app->params['kredivo_conf']['is_production'], // using param value to testing on different environment dynamically
            // 'is_production'       => true,
            // 'server_key'          => 'HMRFFg6e3WU5CjpNYqYN4ZygCyTa78',
            'server_key'          => Yii::$app->params['kredivo_conf']['svr_key'], // using param value to testing on different environment dynamically
            'payment_type'        => '30_days',
            'transaction_details' => $params_transaction_details,
            'customer_details'    => $params_customer,
            'billing_address'     => $params_billing_address,
            'shipping_address'    => $params_shipping_address,
            'push_uri'            => \yii\helpers\Url::home(true).'/payment/kredivo-response',
            'order_status_uri'    => \yii\helpers\Url::home(true).'/user/orders',
            'back_to_store_uri'   => \yii\helpers\Url::home(true).'/payment/kredivo-result',
        );
        
        $this->redirect(\common\components\Kredivo::checkout_url($params));
    }
    
	public function actionNotification(){


		
		$decode = new \Midtrans\Notification();
		
		// header('Content-Type: application/json');
		// $raw_body = 'php://input';
		// $raw_body = file_get_contents($raw_body);

		// $decode = json_decode($raw_body);

		$paymentType = $decode->payment_type;
		
		$orders = \backend\models\Orders::findOne(['reference' => $decode->order_id]);
		
		switch($paymentType){
			
			case "gopay":
				
				if ($decode->transaction_status == 'settlement') {
					
					if($orders != NULL){
						
						$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "payment_success", "payment_method_id" => 9, "apps_language_id" => 1])->order_state_lang_id;

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
						
						// save transaction log from midtrans
						$valog = \backend\models\VaLog::find()->where(['order_id' => $decode->order_id])->one();
						
						$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
						
						if($valog != NULL){
							$valog->va_number = "";
							$valog->va_bank = $bankName[0];
							$valog->transaction_time = $decode->transaction_time;
							$valog->transaction_status = $decode->transaction_status;
							$valog->payment_type = $decode->payment_type;
							$valog->order_id = $decode->order_id;
							$valog->gross_amount = $decode->gross_amount;
							$valog->payment_amounts_paid_at = '';
							$valog->payment_amounts_amount = '';
							$valog->save();
						} else {
							$valog = new \backend\models\VaLog();
							$valog->va_number = "";
							$valog->va_bank = $bankName[0];
							$valog->transaction_time = $decode->transaction_time;
							$valog->transaction_status = $decode->transaction_status;
							$valog->payment_type = $decode->payment_type;
							$valog->order_id = $decode->order_id;
							$valog->gross_amount = $decode->gross_amount;
							$valog->payment_amounts_paid_at = '';
							$valog->payment_amounts_amount = '';
							$valog->save();
						}
						
						$orderCartRule = \backend\models\OrderCartRule::findOne(['orders_id' => $orders->orders_id]);
						
						if($orderCartRule != NULL){
							// update quantity voucher code
							$cart_rule = \backend\models\CartRule::findOne(["cart_rule_id" => $orderCartRule->cart_rule_id]);
							$cart_rule->quantity -= 1;
							$cart_rule->save();
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
							
							\common\components\Helpers::createOrdersMailchimp($decode->order_id, $orders->customer_id, $cartMC);
							
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
				
				elseif ($decode->transaction_status == 'pending') {
					
					if($orders != NULL){
						
						$valog = \backend\models\VaLog::find()->where(['order_id' => $decode->order_id])->one();
						
						$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
						
						if($valog != NULL){
							$valog->va_number = "";
							$valog->va_bank = $bankName[0];
							$valog->transaction_time = $decode->transaction_time;
							$valog->transaction_status = $decode->transaction_status;
							$valog->payment_type = $decode->payment_type;
							$valog->order_id = $decode->order_id;
							$valog->gross_amount = $decode->gross_amount;
							$valog->payment_amounts_paid_at = '';
							$valog->payment_amounts_amount = '';
							$valog->save();
						} else {
							$valog = new \backend\models\VaLog();
							$valog->va_number = "";
							$valog->va_bank = $bankName[0];
							$valog->transaction_time = $decode->transaction_time;
							$valog->transaction_status = $decode->transaction_status;
							$valog->payment_type = $decode->payment_type;
							$valog->order_id = $decode->order_id;
							$valog->gross_amount = $decode->gross_amount;
							$valog->payment_amounts_paid_at = '';
							$valog->payment_amounts_amount = '';
							$valog->save();
						}
					}
					
				}
				
				elseif ($decode->transaction_status == 'expire') {
					
					if($orders != NULL){
						
						$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "order_canceled", "payment_method_id" => 9, "apps_language_id" => 1])->order_state_lang_id;

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
						
						// save transaction log from midtrans
						$valog = \backend\models\VaLog::find()->where(['order_id' => $decode->order_id])->one();
						
						$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
						
						if($valog != NULL){
							$valog->va_number = '';
							$valog->va_bank = $bankName[0];
							$valog->transaction_time = $decode->transaction_time;
							$valog->transaction_status = $decode->transaction_status;
							$valog->payment_type = $decode->payment_type;
							$valog->order_id = $decode->order_id;
							$valog->gross_amount = $decode->gross_amount;
							$valog->payment_amounts_paid_at = '';
							$valog->payment_amounts_amount = '';
							$valog->save();
						} else {
							$valog = new \backend\models\VaLog();
							$valog->va_number = "";
							$valog->va_bank = $bankName[0];
							$valog->transaction_time = $decode->transaction_time;
							$valog->transaction_status = $decode->transaction_status;
							$valog->payment_type = $decode->payment_type;
							$valog->order_id = $decode->order_id;
							$valog->gross_amount = $decode->gross_amount;
							$valog->payment_amounts_paid_at = '';
							$valog->payment_amounts_amount = '';
							$valog->save();
						}
					}
				}
				
			break;
			
			case "akulaku":
				
				if ($decode->transaction_status == 'settlement') {
					
					if($orders != NULL){
						
						$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "payment_success", "payment_method_id" => 5, "apps_language_id" => 2])->order_state_lang_id;

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
						
						// save transaction log from midtrans
						$valog = \backend\models\VaLog::find()->where(['order_id' => $decode->order_id])->one();
						
						$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
						
						if($valog != NULL){
							$valog->va_number = "";
							$valog->va_bank = $bankName[0];
							$valog->transaction_time = $decode->transaction_time;
							$valog->transaction_status = $decode->transaction_status;
							$valog->payment_type = $decode->payment_type;
							$valog->order_id = $decode->order_id;
							$valog->gross_amount = $decode->gross_amount;
							$valog->payment_amounts_paid_at = '';
							$valog->payment_amounts_amount = '';
							$valog->save();
						} else {
							$valog = new \backend\models\VaLog();
							$valog->va_number = "";
							$valog->va_bank = $bankName[0];
							$valog->transaction_time = $decode->transaction_time;
							$valog->transaction_status = $decode->transaction_status;
							$valog->payment_type = $decode->payment_type;
							$valog->order_id = $decode->order_id;
							$valog->gross_amount = $decode->gross_amount;
							$valog->payment_amounts_paid_at = '';
							$valog->payment_amounts_amount = '';
							$valog->save();
						}
						
						$orderCartRule = \backend\models\OrderCartRule::findOne(['orders_id' => $orders->orders_id]);
						
						if($orderCartRule != NULL){
							// update quantity voucher code
							$cart_rule = \backend\models\CartRule::findOne(["cart_rule_id" => $orderCartRule->cart_rule_id]);
							$cart_rule->quantity -= 1;
							$cart_rule->save();
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
							
							\common\components\Helpers::createOrdersMailchimp($decode->order_id, $orders->customer_id, $cartMC);
							
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
				
				elseif ($decode->transaction_status == 'pending') {
					
					if($orders != NULL){
						
						$valog = \backend\models\VaLog::find()->where(['order_id' => $decode->order_id])->one();
						
						$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
						
						if($valog != NULL){
							$valog->va_number = "";
							$valog->va_bank = $bankName[0];
							$valog->transaction_time = $decode->transaction_time;
							$valog->transaction_status = $decode->transaction_status;
							$valog->payment_type = $decode->payment_type;
							$valog->order_id = $decode->order_id;
							$valog->gross_amount = $decode->gross_amount;
							$valog->payment_amounts_paid_at = '';
							$valog->payment_amounts_amount = '';
							$valog->save();
						} else {
							$valog = new \backend\models\VaLog();
							$valog->va_number = "";
							$valog->va_bank = $bankName[0];
							$valog->transaction_time = $decode->transaction_time;
							$valog->transaction_status = $decode->transaction_status;
							$valog->payment_type = $decode->payment_type;
							$valog->order_id = $decode->order_id;
							$valog->gross_amount = $decode->gross_amount;
							$valog->payment_amounts_paid_at = '';
							$valog->payment_amounts_amount = '';
							$valog->save();
						}
					}
					
				}
				
				elseif ($decode->transaction_status == 'expire') {
					
					if($orders != NULL){
						
						$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "order_canceled", "payment_method_id" => 5, "apps_language_id" => 2])->order_state_lang_id;

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
						
						// save transaction log from midtrans
						$valog = \backend\models\VaLog::find()->where(['order_id' => $decode->order_id])->one();
						
						$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
						
						if($valog != NULL){
							$valog->va_number = '';
							$valog->va_bank = $bankName[0];
							$valog->transaction_time = $decode->transaction_time;
							$valog->transaction_status = $decode->transaction_status;
							$valog->payment_type = $decode->payment_type;
							$valog->order_id = $decode->order_id;
							$valog->gross_amount = $decode->gross_amount;
							$valog->payment_amounts_paid_at = '';
							$valog->payment_amounts_amount = '';
							$valog->save();
						} else {
							$valog = new \backend\models\VaLog();
							$valog->va_number = "";
							$valog->va_bank = $bankName[0];
							$valog->transaction_time = $decode->transaction_time;
							$valog->transaction_status = $decode->transaction_status;
							$valog->payment_type = $decode->payment_type;
							$valog->order_id = $decode->order_id;
							$valog->gross_amount = $decode->gross_amount;
							$valog->payment_amounts_paid_at = '';
							$valog->payment_amounts_amount = '';
							$valog->save();
						}
					}
				}
				
				elseif ($decode->transaction_status == 'deny') {
					
					if($orders != NULL){
						
						$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "order_canceled", "payment_method_id" => 5, "apps_language_id" => 2])->order_state_lang_id;

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
						
						// save transaction log from midtrans
						$valog = new \backend\models\VaLog();
						
						$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
						
						$valog->va_number = $decode->bill_key;
						$valog->va_bank = $bankName[0];
						$valog->transaction_time = $decode->transaction_time;
						$valog->transaction_status = $decode->transaction_status;
						$valog->payment_type = $decode->payment_type;
						$valog->order_id = $decode->order_id;
						$valog->gross_amount = $decode->gross_amount;
						$valog->payment_amounts_paid_at = '';
						$valog->payment_amounts_amount = '';
						$valog->save();
					}
				}
				
				elseif ($decode->transaction_status == 'cancel') {
					
					if($orders != NULL){
						
						$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "order_canceled", "payment_method_id" => 5, "apps_language_id" => 2])->order_state_lang_id;

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
						
						// save transaction log from midtrans
						$valog = new \backend\models\VaLog();
						
						$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
						
						$valog->va_number = '';
						$valog->va_bank = $bankName[0];
						$valog->transaction_time = $decode->transaction_time;
						$valog->transaction_status = $decode->transaction_status;
						$valog->payment_type = $decode->payment_type;
						$valog->order_id = $decode->order_id;
						$valog->gross_amount = $decode->gross_amount;
						$valog->payment_amounts_paid_at = '';
						$valog->payment_amounts_amount = '';
						$valog->save();
					}
				}
				
			break;
			
			case "echannel":
			
				if ($decode->transaction_status == 'settlement') {
					
					if($orders != NULL){
						$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "payment_success", "payment_method_id" => 6, "apps_language_id" => 1])->order_state_lang_id;

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
						
						// save transaction log from midtrans
						$valog = new \backend\models\VaLog();
						
						$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
						
						$valog->va_number = $decode->bill_key;
						$valog->va_bank = $bankName[0];
						$valog->transaction_time = $decode->transaction_time;
						$valog->transaction_status = $decode->transaction_status;
						$valog->payment_type = $decode->payment_type;
						$valog->order_id = $decode->order_id;
						$valog->gross_amount = $decode->gross_amount;
						$valog->payment_amounts_paid_at = '';
						$valog->payment_amounts_amount = '';
						$valog->save();
						
						$orderCartRule = \backend\models\OrderCartRule::findOne(['orders_id' => $orders->orders_id]);
						
						if($orderCartRule != NULL){
							// update quantity voucher code
							$cart_rule = \backend\models\CartRule::findOne(["cart_rule_id" => $orderCartRule->cart_rule_id]);
							$cart_rule->quantity -= 1;
							$cart_rule->save();
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
							
							\common\components\Helpers::createOrdersMailchimp($decode->order_id, $orders->customer_id, $cartMC);
							
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
				
				elseif ($decode->transaction_status == 'pending') {
					
					if($orders != NULL){
						// save transaction log from midtrans
						$valog = new \backend\models\VaLog();
						
						$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
						
						$valog->va_number = $decode->bill_key;
						$valog->va_bank = $bankName[0];
						$valog->transaction_time = $decode->transaction_time;
						$valog->transaction_status = $decode->transaction_status;
						$valog->payment_type = $decode->payment_type;
						$valog->order_id = $decode->order_id;
						$valog->gross_amount = $decode->gross_amount;
						$valog->payment_amounts_paid_at = '';
						$valog->payment_amounts_amount = '';
						$valog->save();
					}
					
				}
				
				elseif ($decode->transaction_status == 'deny') {
					
					if($orders != NULL){
						
						$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "order_canceled", "payment_method_id" => 6, "apps_language_id" => 1])->order_state_lang_id;

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
						
						// save transaction log from midtrans
						$valog = new \backend\models\VaLog();
						
						$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
						
						$valog->va_number = $decode->bill_key;
						$valog->va_bank = $bankName[0];
						$valog->transaction_time = $decode->transaction_time;
						$valog->transaction_status = $decode->transaction_status;
						$valog->payment_type = $decode->payment_type;
						$valog->order_id = $decode->order_id;
						$valog->gross_amount = $decode->gross_amount;
						$valog->payment_amounts_paid_at = '';
						$valog->payment_amounts_amount = '';
						$valog->save();
					}
				}
				
				elseif ($decode->transaction_status == 'cancel') {
					
					if($orders != NULL){
						
						$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "order_canceled", "payment_method_id" => 6, "apps_language_id" => 1])->order_state_lang_id;

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
						
						// save transaction log from midtrans
						$valog = new \backend\models\VaLog();
						
						$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
						
						$valog->va_number = $decode->bill_key;
						$valog->va_bank = $bankName[0];
						$valog->transaction_time = $decode->transaction_time;
						$valog->transaction_status = $decode->transaction_status;
						$valog->payment_type = $decode->payment_type;
						$valog->order_id = $decode->order_id;
						$valog->gross_amount = $decode->gross_amount;
						$valog->payment_amounts_paid_at = '';
						$valog->payment_amounts_amount = '';
						$valog->save();
					}
				}
				
				elseif ($decode->transaction_status == 'expire') {
					
					if($orders != NULL){
						
						$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "order_canceled", "payment_method_id" => 6, "apps_language_id" => 1])->order_state_lang_id;

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
						
						// save transaction log from midtrans
						$valog = new \backend\models\VaLog();
						
						$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
						
						$valog->va_number = $decode->bill_key;
						$valog->va_bank = $bankName[0];
						$valog->transaction_time = $decode->transaction_time;
						$valog->transaction_status = $decode->transaction_status;
						$valog->payment_type = $decode->payment_type;
						$valog->order_id = $decode->order_id;
						$valog->gross_amount = $decode->gross_amount;
						$valog->payment_amounts_paid_at = '';
						$valog->payment_amounts_amount = '';
						$valog->save();
					}
				}
			
			break;
			
			case "bank_transfer":
				// Success
				if ($decode->transaction_status == 'settlement') {

					// Still have problem with Virtual Account BNI
					// There is no problem with this scripts, but sometimes midtrans response cannot reach this function
					
					if($orders != NULL){

						$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "payment_success", "payment_method_id" => 6, "apps_language_id" => 1])->order_state_lang_id;

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
						
						// save transaction log from midtrans
						$valog = new \backend\models\VaLog();
						
						$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
						
						if(strtolower($bankName[0]) == "permata"){
							$valog->va_number = $decode->permata_va_number;
							$valog->payment_amounts_paid_at = '';
							$valog->payment_amounts_amount = '';
						} 
						elseif(strtolower($bankName[0]) == "bni") {
							$valog->va_number = $decode->va_numbers[0]->va_number;
							$valog->payment_amounts_paid_at = $decode->payment_amounts[0]->paid_at;
							$valog->payment_amounts_amount = $decode->payment_amounts[0]->amount;
						}
						
						$valog->va_bank = $bankName[0];
						$valog->transaction_time = $decode->transaction_time;
						$valog->transaction_status = $decode->transaction_status;
						$valog->payment_type = $decode->payment_type;
						$valog->order_id = $decode->order_id;
						$valog->gross_amount = $decode->gross_amount;
						$valog->save();
						
						$orderCartRule = \backend\models\OrderCartRule::findOne(['orders_id' => $orders->orders_id]);
						
						if($orderCartRule != NULL){
							// update quantity voucher code
							$cart_rule = \backend\models\CartRule::findOne(["cart_rule_id" => $orderCartRule->cart_rule_id]);
							$cart_rule->quantity -= 1;
							$cart_rule->save();
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
							
							\common\components\Helpers::createOrdersMailchimp($decode->order_id, $orders->customer_id, $cartMC);
							
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
				
				// cancel
				elseif ($decode->transaction_status == 'cancel') {
					
					if($orders != NULL){
						
						$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "order_canceled", "payment_method_id" => 6, "apps_language_id" => 1])->order_state_lang_id;

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
						
						// save transaction log from midtrans
						$valog = new \backend\models\VaLog();
						
						$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
						
						if(strtolower($bankName[0]) == "permata"){
							$valog->va_number = $decode->permata_va_number;
						} 
						elseif(strtolower($bankName[0]) == "bni") {
							$valog->va_number = $decode->va_numbers[0]->va_number;
						}
						
						$valog->va_bank = $bankName[0];
						$valog->transaction_time = $decode->transaction_time;
						$valog->transaction_status = $decode->transaction_status;
						$valog->payment_type = $decode->payment_type;
						$valog->order_id = $decode->order_id;
						$valog->gross_amount = $decode->gross_amount;
						$valog->payment_amounts_paid_at = '';
						$valog->payment_amounts_amount = '';
						$valog->save();
					}
				}
				
				// pending
				elseif ($decode->transaction_status == 'pending') {
					
					if($orders != NULL){
						
						// save transaction log from midtrans
						$valog = new \backend\models\VaLog();
						
						$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
						
						if(strtolower($bankName[0]) == "permata"){
							$valog->va_number = $decode->permata_va_number;
						} 
						elseif(strtolower($bankName[0]) == "bni") {
							$valog->va_number = $decode->va_numbers[0]->va_number;
						}
						
						$valog->va_bank = $bankName[0];
						$valog->transaction_time = $decode->transaction_time;
						$valog->transaction_status = $decode->transaction_status;
						$valog->payment_type = $decode->payment_type;
						$valog->order_id = $decode->order_id;
						$valog->gross_amount = $decode->gross_amount;
						$valog->payment_amounts_paid_at = '';
						$valog->payment_amounts_amount = '';
						$valog->save();
					}
				}

				// expire
				elseif ($decode->transaction_status == 'expire') {
					
					if($orders != NULL){
						
						$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "order_canceled", "payment_method_id" => 6, "apps_language_id" => 1])->order_state_lang_id;

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
						
						// save transaction log from midtrans
						$valog = new \backend\models\VaLog();
						
						$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
						
						if(strtolower($bankName[0]) == "permata"){
							$valog->va_number = $decode->permata_va_number;
						} 
						elseif(strtolower($bankName[0]) == "bni") {
							$valog->va_number = $decode->va_numbers[0]->va_number;
						}
						
						$valog->va_bank = $bankName[0];
						$valog->transaction_time = $decode->transaction_time;
						$valog->transaction_status = $decode->transaction_status;
						$valog->payment_type = $decode->payment_type;
						$valog->order_id = $decode->order_id;
						$valog->gross_amount = $decode->gross_amount;
						$valog->payment_amounts_paid_at = '';
						$valog->payment_amounts_amount = '';
						$valog->save();
					}
				}
				
			break;
			
			case "credit_card":
				
				// Success
				if ($decode->transaction_status == 'capture') {
					
					if($orders != NULL){

						$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "payment_success", "payment_method_id" => 2])->order_state_lang_id;

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
						
						// save transaction log from midtrans
						$valog = new \backend\models\VaLog();
						$valog->va_bank = $decode->bank;
						$valog->va_number = '';
						$valog->transaction_time = $decode->transaction_time;
						$valog->transaction_status = $decode->transaction_status;
						$valog->payment_type = $decode->payment_type;
						$valog->order_id = $decode->order_id;
						$valog->gross_amount = $decode->gross_amount;
						$valog->payment_amounts_paid_at = '';
						$valog->payment_amounts_amount = '';
						$valog->save();
						
						$orderCartRule = \backend\models\OrderCartRule::findOne(['orders_id' => $orders->orders_id]);
						
						if($orderCartRule != NULL){
							// update quantity voucher code
							$cart_rule = \backend\models\CartRule::findOne(["cart_rule_id" => $orderCartRule->cart_rule_id]);
							$cart_rule->quantity -= 1;
							$cart_rule->save();
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
							
							\common\components\Helpers::createOrdersMailchimp($decode->order_id, $orders->customer_id, $cartMC);
							
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

				// Deny
				elseif ($decode->transaction_status == 'deny') {
					
					if($orders != NULL){

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
						
						// save transaction log from midtrans
						$valog = new \backend\models\VaLog();
						$valog->va_bank = $decode->bank;
						$valog->va_number = '';
						$valog->transaction_time = $decode->transaction_time;
						$valog->transaction_status = $decode->transaction_status;
						$valog->payment_type = $decode->payment_type;
						$valog->order_id = $decode->order_id;
						$valog->gross_amount = $decode->gross_amount;
						$valog->payment_amounts_paid_at = '';
						$valog->payment_amounts_amount = '';
						$valog->save();
					}
				}

				// Challenge
				elseif ($decode->transaction_status == 'challenge') {

					if($orders != NULL){
						
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
						
						// save transaction log from midtrans
						$valog = new \backend\models\VaLog();
						$valog->va_bank = $decode->bank;
						$valog->va_number = '';
						$valog->transaction_time = $decode->transaction_time;
						$valog->transaction_status = $decode->transaction_status;
						$valog->payment_type = $decode->payment_type;
						$valog->order_id = $decode->order_id;
						$valog->gross_amount = $decode->gross_amount;
						$valog->payment_amounts_paid_at = '';
						$valog->payment_amounts_amount = '';
						$valog->save();
					}
				}

				// Cancel
				elseif ($decode->transaction_status == 'cancel') {
					
					if($orders != NULL){

						$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "order_canceled", "payment_method_id" => 2])->order_state_lang_id;

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
						
						// save transaction log from midtrans
						$valog = new \backend\models\VaLog();
						$valog->va_bank = $decode->bank;
						$valog->va_number = '';
						$valog->transaction_time = $decode->transaction_time;
						$valog->transaction_status = $decode->transaction_status;
						$valog->payment_type = $decode->payment_type;
						$valog->order_id = $decode->order_id;
						$valog->gross_amount = $decode->gross_amount;
						$valog->payment_amounts_paid_at = '';
						$valog->payment_amounts_amount = '';
						$valog->save();
					}
				}
				
			break;
		}
		
	}
	
    public function actionKredivoResponse(){
        
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
            \common\components\Kredivo::close_connection(\common\components\Kredivo::response());
            $input = new \common\components\Kredivo_Input();
			
            try {
                $confirmation = \common\components\Kredivo::confirm_order(array(
                    'transaction_id' => $input->transaction_id,
                    'signature_key'  => $input->signature_key,
                ));

                if (strtolower($confirmation->status) == 'ok') {
					
					$fraud_status = strtolower($confirmation->fraud_status);
                    if ($fraud_status == 'accept') {

                        $transaction_status = strtolower($confirmation->transaction_status);
						
						// save kredivo transaction history
						$kredivo = new \backend\models\KredivoNotify();
						$kredivo->kredivo_status = $confirmation->status;
						$kredivo->kredivo_message = $confirmation->message;
						$kredivo->kredivo_payment_type = $confirmation->payment_type;
						$kredivo->kredivo_transaction_id = $confirmation->transaction_id;
						$kredivo->kredivo_transaction_status = $confirmation->transaction_status;
						$kredivo->kredivo_transaction_time = $confirmation->transaction_time;
						$kredivo->kredivo_order_id = $confirmation->order_id;
						$kredivo->kredivo_amount = $confirmation->amount;
						$kredivo->kredivo_fraud_status = $confirmation->fraud_status;
						$kredivo->save();
						
                        switch ($transaction_status) {
                            case 'settlement':
								
								$order_state_lang_id = \backend\models\OrderStateLang::findOne(["template" => "payment_success", "payment_method_id" => 4])->order_state_lang_id;
								
								$orderState = new \backend\models\OrderState();
								$orderState->save();
								
								$kredivoHistory = new \backend\models\OrderHistory();
								$kredivoHistory->orders_id = \backend\models\Orders::findOne(['reference' => $confirmation->order_id])->orders_id;
								$kredivoHistory->order_state_id = $orderState->order_state_id;
								$kredivoHistory->order_state_lang_id = $order_state_lang_id;
								$kredivoHistory->date_add = date("Y-m-d H:i:s");
								$kredivoHistory->save();
								
								$orderDetail = \backend\models\OrderDetail::find()->where(['orders_id' => $kredivoHistory->orders_id])->all();
				
								foreach($orderDetail as $detail){
									
									// update order detail history status
									$orderDetailHistory = new \backend\models\OrderDetailHistory();
									$orderDetailHistory->orders_id = $kredivoHistory->orders_id;
									$orderDetailHistory->order_detail_id = $detail->order_detail_id;
									$orderDetailHistory->order_state_lang_id = $order_state_lang_id;
									$orderDetailHistory->date_add = date("Y-m-d H:i:s");
									$orderDetailHistory->order_detail_state_lang_id = 1;
									$orderDetailHistory->save();
								}
								
								break;
							case 'pending':
							
								$order_state_lang_id = \backend\models\OrderStateLang::findOne(["template" => "payment_success", "payment_method_id" => 4])->order_state_lang_id;
								
								$orderState = new \backend\models\OrderState();
								$orderState->save();
								
								$kredivoHistory = new \backend\models\OrderHistory();
								$kredivoHistory->orders_id = \backend\models\Orders::findOne(['reference' => $confirmation->order_id])->orders_id;
								$kredivoHistory->order_state_id = $orderState->order_state_id;
								$kredivoHistory->order_state_lang_id = $order_state_lang_id;
								$kredivoHistory->date_add = date("Y-m-d H:i:s");
								$kredivoHistory->save();
								
								$orderDetail = \backend\models\OrderDetail::find()->where(['orders_id' => $kredivoHistory->orders_id])->all();
				
								foreach($orderDetail as $detail){
									
									// update order detail history status
									$orderDetailHistory = new \backend\models\OrderDetailHistory();
									$orderDetailHistory->orders_id = $kredivoHistory->orders_id;
									$orderDetailHistory->order_detail_id = $detail->order_detail_id;
									$orderDetailHistory->order_state_lang_id = $order_state_lang_id;
									$orderDetailHistory->date_add = date("Y-m-d H:i:s");
									$orderDetailHistory->order_detail_state_lang_id = 1;
									$orderDetailHistory->save();
								}
							
								break;
							case 'deny':
							
								$order_state_lang_id = \backend\models\OrderStateLang::findOne(["template" => "payment_failed", "payment_method_id" => 4])->order_state_lang_id;
								
								$orderState = new \backend\models\OrderState();
								$orderState->save();
								
								$kredivoHistory = new \backend\models\OrderHistory();
								$kredivoHistory->orders_id = \backend\models\Orders::findOne(['reference' => $confirmation->order_id])->orders_id;
								$kredivoHistory->order_state_id = $orderState->order_state_id;
								$kredivoHistory->order_state_lang_id = $order_state_lang_id;
								$kredivoHistory->date_add = date("Y-m-d H:i:s");
								$kredivoHistory->save();
								
								$orderDetail = \backend\models\OrderDetail::find()->where(['orders_id' => $kredivoHistory->orders_id])->all();
				
								foreach($orderDetail as $detail){
									
									// update order detail history status
									$orderDetailHistory = new \backend\models\OrderDetailHistory();
									$orderDetailHistory->orders_id = $kredivoHistory->orders_id;
									$orderDetailHistory->order_detail_id = $detail->order_detail_id;
									$orderDetailHistory->order_state_lang_id = $order_state_lang_id;
									$orderDetailHistory->date_add = date("Y-m-d H:i:s");
									$orderDetailHistory->order_detail_state_lang_id = 1;
									$orderDetailHistory->save();
								}
							
                                break;
                            case 'cancel':
								
								$order_state_lang_id = \backend\models\OrderStateLang::findOne(["template" => "payment_failed", "payment_method_id" => 4])->order_state_lang_id;
								
								$orderState = new \backend\models\OrderState();
								$orderState->save();
								
								$kredivoHistory = new \backend\models\OrderHistory();
								$kredivoHistory->orders_id = \backend\models\Orders::findOne(['reference' => $confirmation->order_id])->orders_id;
								$kredivoHistory->order_state_id = $orderState->order_state_id;
								$kredivoHistory->order_state_lang_id = $order_state_lang_id;
								$kredivoHistory->date_add = date("Y-m-d H:i:s");
								$kredivoHistory->save();
								
								$orderDetail = \backend\models\OrderDetail::find()->where(['orders_id' => $kredivoHistory->orders_id])->all();
				
								foreach($orderDetail as $detail){
									
									// update order detail history status
									$orderDetailHistory = new \backend\models\OrderDetailHistory();
									$orderDetailHistory->orders_id = $kredivoHistory->orders_id;
									$orderDetailHistory->order_detail_id = $detail->order_detail_id;
									$orderDetailHistory->order_state_lang_id = $order_state_lang_id;
									$orderDetailHistory->date_add = date("Y-m-d H:i:s");
									$orderDetailHistory->order_detail_state_lang_id = 1;
									$orderDetailHistory->save();
								}
								
                                break;
						}
					}
                }
            } catch (Exception $e) {

            }
            //exit();
        }
			
    }
    
	public function actionCancelled() 
	{
		return $this->render('@app/modules/cart/views/checkout/payment/complete.php', array("status" => '<div class="alert alert-danger" role="alert">Mohon maaf proses tidak dapat dilanjutkan karena order Anda tidak valid.</div>'));
    }
    
}