<?php

use yii\web\Session;
use app\assets\VeritransAsset;

VeritransAsset::register($this);

$sessionOrder = new Session();
$sessionOrder->open();

$customerInfo = $sessionOrder->get("customerInfo");

//print_r($_SESSION);
?>
<script type="text/javascript">
function slideDetail(event) {
     
    if (event != null) {
        if ($('#detail-hide-' + event).hasClass("non-active")) {
            $('#detail-hide-' + event).slideDown();
            $('#detail-hide-' + event).removeClass("non-active");
            $('#detail-hide-' + event).addClass("active");
            document.getElementById("see-detail-"+ event).innerHTML = " (HIDE DETAILS)";
            // $('.arrow-down-' + event).replaceWith('<img class="arrow-down-' + event + '" src="/img/icons/top-spec.png">');
        }
        else {
            $('#detail-hide-' + event).slideUp();
            $('#detail-hide-' + event).removeClass("active");
            $('#detail-hide-' + event).addClass("non-active");
            document.getElementById("see-detail-"+ event).innerHTML = " (SEE DETAILS)";
            // $('.arrow-down-' + event).replaceWith('<img class="arrow-down-' + event + '" src="/img/icons/down-spec.png">');
        }
    }
}

function payVosPay(orderId){
	
	$.ajax({
        type: "POST",
        url: baseUrl + '/api/orders/check',
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
        data: JSON.stringify({ orderId: orderId }),
        success: function (data) {
            var d = data;
			console.log(data);
            if (d.success) {
				
				vospayConfig = {
					merchantKey: 'fd79f79bbb53987e356b2c0c456c559f',
					transactionDetails: {
						orderID: d.data.vospayOrderId,
						orderDescription: 'The Watch Co. - Order Information',
						items: d.data.products,
						currency: 'IDR',
						shipping: d.data.shipping,
						grossAmount: d.data.grossAmount,
						customerDetails: d.data.customerDetails
					},
					onDone: (result) => {
						var status = result.status;
						
						//if(status == "Success"){
							window.location = 'https://www.thewatch.co/user/orders';
						//}
					},
					onError: (error) => {
						console.log('Payment error:', error);
					},
					logoURL: 'https://www.thewatch.co/img/logos/logo.png',
					notifyEndpoint: 'https://www.thewatch.co/api/payment/notification'
				}
				
                $('#loadingScreen').modal('hide');
				
				vospay.payNow(vospayConfig);
            } else {
				$('#loadingScreen').modal('hide');
				return;
            }
        }
    });
	
}

</script>
<section id="shopping-bag" style="padding-top: 0px;">
    <div class="container">
        <div class="row">
            <!-- <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 shopping-bag title">MY ORDER</div> -->
            <?php 
            echo Yii::$app->view->renderFile('@app/shared/sidebar_profile.php', array(
                "currentPage" => "my_order",
            ));
            ?>

         <!--    <div class="hidden-lg hidden-md hidden-sm col-xs-12">
                <div class="col-xs-12 text-center select-menu-profile">
                    <select id="profile-menu" class="qty-dropdown" onchange="profile_menu()">
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/profile">MY PROFILE</option>
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/orders" selected>MY ORDER</option>
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/shipping">SHIPPING INFORMATION</option>
                    </select>
                </div>
            </div> -->

<style type="text/css">
    table tr td div{
        padding:15px;
    }
</style>
            
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 myprofile">
                <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 my-profile title clearleft clearright">My Order</div>

               <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 clearleft" style="border-bottom: solid 1px #a8a9ad;"></div>
                <?php if (count($orders) > 0) { ?>
                    <?php $i = 1; ?>
                    <?php foreach ($orders as $order) { ?>

                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 myprofile order-info active clearleft clearright" style="width:5%;">
                        <?php echo $i.'.'; ?>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 myprofile order-info active clearleft clearright">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding text-gotham-light">
                                Order Number
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding text-gotham-light" style="padding-top: 20px;">
                                DATE
                                
                                <div style="padding-top: 5px;">
                                PAYMENT</div>
                                
								<div style="padding-top: 5px;">
									STATUS
								</div>
								<?php if($order->paymentmethoddetail->payment_method_id == 5){ ?>
								<div style="padding-top: 5px;">
									PAYMENT STATUS
								</div>	
								<?php } ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 myprofile order-info active clearleft clearright clearright-mobile">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding text-gotham-light">
								<input type="hidden" name="order_reference_<?php echo $order['orders_id']; ?>" value="<?php echo $order['reference']; ?>">
                                <?php echo $order['reference']; ?><a style="color:#9e8463;cursor:pointer;" onclick="slideDetail(<?php echo $i;?>)" id="see-detail-<?php echo $i;?>"> (SEE DETAILS)</a>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding text-gotham-light" style="padding-top: 20px;">
                                <?php echo date('d F Y', strtotime($order['date_add'])); ?>
                                
                                <?php 
                                    $payment_id = \backend\models\PaymentMethodDetail::findOne(["payment_method_detail_id" => $order->payment_method_detail_id])->payment_id;
                                    $payment_method_id = \backend\models\PaymentMethodDetail::findOne(["payment_method_detail_id" => $order->payment_method_detail_id])->payment_method_id;

                                    $payment_method_installment_id = \backend\models\PaymentMethodInstallmentDetail::findOne(["payment_method_installment_detail_id" => $order->payment_method_installment_detail_id])->payment_method_installment_id;

                                    $payment_method_installment_name = \backend\models\PaymentMethodInstallment::findOne(["payment_method_installment_id" => $payment_method_installment_id])->payment_method_installment_name;
                                    
                                    if($payment_id == 3 || $payment_id == 10 || $payment_id == 11){
                                        $name_bank = \backend\models\Payment::findOne(["payment_id" => $payment_id])->name_person;
                                    }else{
                                        $name_bank = \backend\models\Payment::findOne(["payment_id" => $payment_id])->name_bank;
                                    }
                                    $payment_method_name = \backend\models\PaymentMethod::findOne(["payment_method_id" => $payment_method_id])->payment_method_name;
                                    if($payment_method_name == "Akulaku" || $payment_method_name == "Kredivo" || $payment_method_name == "Installment"){
                                        $payment_method_name = '';
                                    }
                                ?>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding text-gotham-light" style="padding-top: 5px;"><?php echo $payment_method_name . ' '.$name_bank.' '.$payment_method_installment_name; ?></div>
                            
                                <?php
                                $stat_col = '#000000';
                                $status = \backend\models\OrderHistory::find()
                                        ->orderBy("order_history_id DESC")
                                        ->where(["orders_id" => $order->orders_id])
                                        ->one();
                                if($status->orderStateLang->text == 'SHIPPED'){
                                    $stat_col = '#206167';
                                }if($status->orderStateLang->text == 'ORDER CANCELED' || $status->orderStateLang->text == 'PAYMENT FAILED'){
                                    $stat_col = '#a21c23';
                                }
                                if($status->orderStateLang->text == 'WAITING FOR PAYMENT' || $status->orderStateLang->text == 'WAITING FOR CONFIRMATION'){
                                    $stat_col = '#9e8463';
                                }
                                // echo $status->orderStateLang->text . ' ';
                                
                                ?>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding text-gotham-light" style="padding-top: 5px;color:<?php echo $stat_col;?>"><?php echo $status->orderStateLang->text . ' '; ?></div>
                                
                            </div>
							<?php if($order->paymentmethoddetail->payment_method_id == 5){ ?>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding text-gotham-light" style="padding-top: 5px;">
								<?php 
								$akulaku = new \common\components\Akulaku();
								$akulaku->setEnvironment('production');
								$akulaku->setCredentials("626809194", "qeJjLw49bZkMlCAersNan2g-Ji7cQ8utPAxDoPy3hS0");
								
								$inquiry = $akulaku->inquiryStatus($order->reference);
								if($inquiry->success){
									$status = $akulaku->getPaymentStatus($inquiry->data->status);
									echo $status;
								}
								?>
							</div>
							<?php } ?>
							<?php if($order->paymentmethoddetail->payment_method_id == 8){ ?>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 clearleft remove-padding text-gotham-light" style="padding-top: 5px;">
								<?php if($status->orderStateLang->text == 'WAITING FOR PAYMENT'){ ?>
								<button onClick="payVosPay('<?php echo $order->reference; ?>')" id="vospay" type="button" class="editpay ipad col-xs-12" style="width: 100%;text-align: center;border-radius: 25px;">Bayar</button>
								<?php } ?>
							</div>
							<?php } ?>
                            <?php if ($status->orderStateLang->action_text != '' && $order->flash_sale == 0) { ?>
                                    <a href="#" class="col-lg-4 col-md-4 col-sm-4 col-xs-12 confirm" onclick="slideDetail(<?php echo $i;?>)" style="">CONFIRM PAYMENT</a>
                            <?php } ?>
                            
                            <?php if (($status->orderStateLang->template == 'awaiting' || $status->orderStateLang->template == 'payment_failed') && $order->flash_sale == 1 && $order->flash_sale_approved == 'APPROVED') { ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info active clearleft clearright remove-padding padding-top-5" style="font-size: 0.9em;">
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding">
                                   <a href="<?php echo \yii\helpers\Url::base(); ?>/user/payment/<?php echo $order->orders_id;?>" class="blue-round default">BAYAR SEKARANG</a>
                                </div>
                            </div>
                            <?php } ?>
                            
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
                        <!-- Details -->

                        <div id="detail-hide-<?php echo $i;?>" class="non-active">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding padding-top-2 padding-bottom-2 ipad ipad margin-bottom-3">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 gotham-light myorder detail item header remove-padding">
                                PRODUCT DETAILS
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs gotham-light myorder detail item header qty remove-padding">
                                QTY
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs gotham-light myorder detail item header price remove-padding">
                                PRICE
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs gotham-light myorder detail item header price remove-padding">
                                TOTAL PRICE
                            </div>
                        </div>
                     
                        <?php
                        $orderDetail = backend\models\OrderDetail::findAll(["orders_id" => $order->orders_id]);
						$j = 0;
                        if (count($orderDetail)) {
                           
                            $grandTotal = 0;
                            ?>
							
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myitem box clearleft clearright remove-padding ipad margin-bottom-5 ipad">
                                <?php foreach ($orderDetail as $ordered) { ?>
									<input type="hidden" name="order_detail_product_id_<?php echo $order['orders_id']; ?>_<?php echo $j; ?>" value="<?php echo $ordered->product_id; ?>">
									<input type="hidden" name="order_detail_product_name_<?php echo $order['orders_id']; ?>_<?php echo $j; ?>" value="<?php echo $ordered->product_name; ?>">
									<input type="hidden" name="order_detail_product_quantity_<?php echo $order['orders_id']; ?>_<?php echo $j; ?>" value="<?php echo $ordered->product_quantity; ?>">
									<input type="hidden" name="order_detail_product_price_<?php echo $order['orders_id']; ?>_<?php echo $j; ?>" value="<?php echo $ordered->product_price; ?>">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 myorder detail item header value">
                                        <?php 
                                            
                                            
                                            
                                            $products = \backend\models\Product::find()

                                        ->joinWith([

                                            "brands",

                                            "productDetail",

                 

                                            "productImage" => function ($query) {

                                                $query->andWhere(['cover' => 1]);

                                            }

                                        ])

                                        ->where(['product.product_id' => $ordered->product_id])

                                        ->orderBy('brands.brand_name ASC')

                                        ->all();
                                        ?> <?php foreach ($products as $product) { ?>
                                            <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive col-lg-6 col-sm-6 col-md-6 col-xs-4 clearleft remove-padding">
                                        <?php } ?>
                                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-8 clearleft">
                                            <span style="color:#a8a9ad;">
                                                <?php 
                                                    echo $product->brands->brand_name;
                                                    ?>
                                            </span>
                                        
                                            <br>
                                            <?php
                                            echo ucwords(strtolower($ordered->product_name)); 
                                            echo $ordered->product_attribute_id == 0 ? '' : $ordered->productAttributeCombination->attributeValue->value;
                                            
                                        ?>
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs myorder detail item header qty value">
                                        <?php echo $ordered->product_quantity; ?>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs myorder detail item header price value">
                                        IDR <?php echo common\components\Helpers::getPriceFormat($ordered->original_product_price); ?>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs myorder detail item header price value">
                                        IDR <?php echo common\components\Helpers::getPriceFormat($ordered->original_product_price * $ordered->product_quantity); ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <?php $grandTotal += $ordered->original_product_price * $ordered->product_quantity; ?>
									<?php $j++; ?>
                            <?php } ?>
                            </div>


                        <div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft clearright remove-padding ipad ipad">
                            <div class="hidden-lg hidden-md hidden-sm col-xs-5 gotham-light myorder detail item header qty remove-padding" style="padding:0;text-align: left;width: 30%;">
                                PRICE
                            </div>
                            <div class="hidden-lg hidden-md hidden-sm col-xs-4 gotham-light myorder detail item header price remove-padding" style="padding:0;text-align: left;width: 30%;">
                                QTY
                            </div>
                            <div class="hidden-lg hidden-md hidden-sm col-xs-5 gotham-light myorder detail item header price remove-padding" style="padding:0;text-align: right;width: 40%;">
                                TOTAL PRICE
                            </div>
                        </div>
                        <div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft clearright remove-padding ipad ipad margin-bottom-3" style="padding:0;">
                            <div class="hidden-lg hidden-md hidden-sm col-xs-5 gotham-light myorder myorder detail item header qty value remove-padding" style="text-align: left;width: 30%;">
                                IDR <?php echo common\components\Helpers::getPriceFormat($ordered->original_product_price); ?>
                            </div>
                            <div class="hidden-lg hidden-md hidden-sm col-xs-4 gotham-light myorder myorder detail item header price value remove-padding" style="text-align: left;width: 30%;">
                                <?php echo $ordered->product_quantity; ?>
                            </div>
                            <div class="hidden-lg hidden-md hidden-sm col-xs-5 gotham-light myorder myorder detail item header price value remove-padding" style="text-align: right;width: 40%;">
                                IDR <?php echo common\components\Helpers::getPriceFormat($ordered->original_product_price * $ordered->product_quantity); ?>
                            </div>
                        </div>

<?php } ?>              
                        


                        <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs myitem box clearleft clearright remove-padding margin-bottom-10 ipad">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header value">
                                Total
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header price value">
                                IDR <?php echo common\components\Helpers::getPriceFormat($grandTotal); ?>
                                <?php $totalGrand = $grandTotal; ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header value">
                                <?php $shippingCost = \backend\models\CarrierCost::findOne(['carrier_cost_id' => $order->carrier_cost_id]);
                                $packagedetail = \backend\models\CarrierPackageDetail::findOne(['carrier_package_detail_id' => $shippingCost->carrier_package_detail_id]); ?>
                                Shipment <?php echo \backend\models\CarrierPackage::findOne(['carrier_package_id' => $packagedetail->carrier_package_id])->carrier_package_name; ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header price value">
                                IDR 
                                <?php
                                $shippingCost = \backend\models\CarrierCost::findOne(['carrier_cost_id' => $order->carrier_cost_id]);
                                echo common\components\Helpers::getPriceFormat($order->total_shipping);
                                ?>
                            </div>
                            <div class="hidden-lg hidden-md hidden-sm clearfix"></div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header value">
								Asuransi Pengiriman
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header price value">
								IDR
								<?php echo common\components\Helpers::getPriceFormat($order->total_shipping_insurance); ?>
							</div>
							<div class="hidden-lg hidden-md hidden-sm clearfix"></div>
                            <?php
                            $discount = backend\models\OrderCartRule::findOne(['orders_id' => $order->orders_id]);
                            if (!empty($discount)) {
                                ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header value">
                                    Discount
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header price value">
                                    IDR <?php
                                    echo common\components\Helpers::getPriceFormat($discount['value']);
                                    $grandTotal = $grandTotal - $discount['value'];
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                            <?php
                            
                            if ($order->total_special_promo != 0) {
                                $special_promo = \backend\models\SpecialPromo::find()->where(['special_promo_id'=>$order->special_promo_id])->one();
                                ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header value">
                                    Special Promo <?php echo $special_promo->promo_name; ?>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header price value">
                                    IDR <?php
                                    echo common\components\Helpers::getPriceFormat($order->total_special_promo);
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                            <?php if(($order->payment_method_detail_id == 1 || $order->payment_method_detail_id == 2) && $order->unique_code != 0){ ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header value">
                                    Unique Code
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header price value">
                                    <?php echo $order->unique_code; ?>
                                </div>
                            <?php } ?>
                            <strong>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header value">
                                Grand Total
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header price value">
                                    IDR <?php echo common\components\Helpers::getPriceFormat(($order->total_shipping + $grandTotal + $order->unique_code + $order->total_shipping_insurance - $order->total_special_promo)); ?>
                                    <?php $grandTotal = $totalGrand; ?>
                                </div>
                            </strong>
                            
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info active clearleft clearright remove-padding" style="font-size: 0.9em;">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft remove-padding" style="color:#9e8463;padding-bottom: 15px;">
                                SHIPPING ADDRESS
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft remove-padding">
                                <?php
                                $customerAddress = backend\models\CustomerAddress::findOne(["customer_address_id" => $order->customer_address_id]);
                                echo $customerAddress->firstname.' '.$customerAddress->lastname; 
                                ?>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft remove-padding">
                                <?php echo $customerAddress->address1; ?>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft remove-padding">
                                <?php echo $customerAddress->postcode; ?>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft remove-padding">
                               <?php echo strtoupper(backend\models\Province::findOne(["province_id" => $customerAddress->province_id])->name); ?>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft remove-padding">
                               <?php echo strtoupper(backend\models\State::findOne(["state_id" => $customerAddress->state_id])->name); ?>
                            </div>
                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft remove-padding">
                               <?php echo strtoupper(\backend\models\District::findOne(["district_id" => $customerAddress->district_id])->name); ?>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft remove-padding">
                               <?php echo $customerAddress->phone; ?>
                            </div>
                        </div>
                        <?php if ($status->orderStateLang->action_text != '' && $order->flash_sale == 0) { ?>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info active clearleft clearright remove-padding padding-top-5 border-top-button" style="font-size: 0.9em;">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding" style="color:#9e8463;padding-bottom: 15px;">
                                PAYMENT METHOD
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding">
                                Please make your payment to:
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding">
                               
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding" style="padding-top: 15px;padding-bottom: 15px;">
                                <?php
                                $payment_id = \backend\models\PaymentMethodDetail::findOne(["payment_method_detail_id" => $order->payment_method_detail_id])->payment_id;
                                $payment = \backend\models\Payment::findOne(["payment_id" => $payment_id]);
                                echo $payment->name_bank . ' - ' . $payment->account_number;
                                if($payment->payment_id == 1 || $payment->payment_id == 2){
                                    echo ' - '.$payment->name_person;
                                }
                                ?>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding">
                               
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding">
                               Once you have made your payment, please confirm at our webstore in the next 48 hours, and once we've verified your payment, we'll ship your package within the next five business days.
                            </div>
                            
                            <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs gotham-light clearright remove-padding" style="padding-top: 20px;">
                               <a href="<?php echo \yii\helpers\Url::base(); ?>/user/order/confirmation/<?php echo $order->orders_id;?>" class="edit shipping">CONFIRM PAYMENT</a>
                            </div>
                        </div>
                        <?php } ?>
 
                        
                        <?php if($order->paymentmethoddetail->payment_method_id == 9){ ?>
                            <?php if($status->orderStateLang->template != 'order_canceled'){ ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info active clearleft clearright remove-padding padding-top-5 border-top-button" style="font-size: 0.9em;">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding">
                                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding talign-center" style="color:#9e8463;padding-bottom: 15px;">
                                    PEMBAYARAN GO-PAY
                                </div>
                                <?php
                                    $va_log = \backend\models\VaLog::find()->where(['order_id'=>$order->reference])->orderBy('va_id DESC')->one();
                                    $now = date('Y-m-d H:i:s'); 
                                    $to = date($va_log->transaction_time);
                                    $expire_count = \common\components\Helpers::getDifferentMicrotime($now, $to);
                                    if($now > $to){
                                      
                                        $expire_count = 0;
                                    }
                                ?>
                                <div class="col-xs-12 col-md-12 col-sm-12 hidden-lg clearleft clearright gotham-light talign-center" style="padding-bottom: 10px;">
                                    <a href="<?php echo $va_log->action_deeplink_redirect;?>" class="blue-round default" style="width: 100%;text-align: center;border-radius: 25px;">
                                        
                                        <span style="">Pay Now with <img id="gopay-img" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/gopay-white.png" class="img-responsive" style="display: inline;width: 35%;"></span>
                                    </a>
                                </div>
                                <div class="col-lg-12 hidden-sm hidden-md hidden-xs clearleft clearright gotham-light talign-center" style="padding-bottom: 10px;">
                                    Buka aplikasi <span class="gotham-medium">GO-JEK</span> di HP Anda dan scan kode QR di bawah. Selengkapnya cara membayar dengan Go-Pay Klik <a data-toggle="modal" href="#qr-gopay-modal">Disini</a>
                                </div>
                                <div class="col-lg-12 hidden-sm hidden-md hidden-xs clearleft clearright gotham-light" style="padding-bottom: 15px;">
                                    <img src="<?php echo $va_log->action_qr_code_url; ?>" class="img-responsive" style="width: 100px;margin: auto;">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-light talign-center" style="padding-bottom: 10px;">
                                    Mohon selesaikan pembayaran Anda sebelum <br>
                                    <?php
                                        $expire_time = strtotime('+15 minutes', strtotime($va_log->transaction_time));
                                    ?>
                                    <?php echo date('d F', $expire_time).' '.date('H:i', $expire_time); ?>
                                </div>    
                            </div>
                        </div>
                            <?php } ?>
                        <?php } ?>
                        <div class="hidden-lg hidden-sm hidden-md col-xs-12 myitem box clearleft clearright remove-padding margin-bottom-10 ipad padding-top-5">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header value">
                                Total
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header price value">
                                IDR <?php echo common\components\Helpers::getPriceFormat($grandTotal); ?>
                                
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header value">
                                <?php $shippingCost = \backend\models\CarrierCost::findOne(['carrier_cost_id' => $order->carrier_cost_id]);
                                $packagedetail = \backend\models\CarrierPackageDetail::findOne(['carrier_package_detail_id' => $shippingCost->carrier_package_detail_id]); ?>
                                Shipment <?php echo \backend\models\CarrierPackage::findOne(['carrier_package_id' => $packagedetail->carrier_package_id])->carrier_package_name; ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header price value">
                                IDR 
                                <?php
                                $shippingCost = \backend\models\CarrierCost::findOne(['carrier_cost_id' => $order->carrier_cost_id]);
                                echo common\components\Helpers::getPriceFormat($order->total_shipping);
                                ?>
                            </div>
							<div class="hidden-lg hidden-md hidden-sm clearfix"></div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header value">
								Asuransi Pengiriman
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header price value">
								IDR
								<?php echo common\components\Helpers::getPriceFormat($order->total_shipping_insurance); ?>
							</div>
                            <div class="hidden-lg hidden-md hidden-sm clearfix"></div>
                            <?php
                            $discount = backend\models\OrderCartRule::findOne(['orders_id' => $order->orders_id]);
                            if (!empty($discount)) {
                                ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header value">
                                    Discount
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header price value">
                                    IDR <?php
                                    echo common\components\Helpers::getPriceFormat($discount['value']);
                                    $grandTotal = $grandTotal - $discount['value'];
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                            <?php 
                                if ($order->total_special_promo != 0) {
                                $special_promo = \backend\models\SpecialPromo::find()->where(['special_promo_id'=>$order->special_promo_id])->one();
                            ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header value">
                                    Special Promo <?php echo $special_promo->promo_name; ?>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header price value">
                                    IDR <?php
                                    echo common\components\Helpers::getPriceFormat($order->total_special_promo);
                                    ?>
                                </div>
                            <?php } ?>
                            <?php if(($order->payment_method_detail_id == 1 || $order->payment_method_detail_id == 2) && $order->unique_code != 0){ ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header value">
                                    Unique Code
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header price value">
                                    <?php echo $order->unique_code; ?>
                                </div>
                            <?php } ?>
                            <div class="col-xs-12" style="border:1px solid;"></div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header value">
                                Grand Total
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header price value">
                                IDR <?php echo common\components\Helpers::getPriceFormat(($order->total_shipping + $grandTotal + $order->unique_code + $order->total_shipping_insurance - $order->total_special_promo)); ?>
                                
                            </div>
                            <div class="col-xs-12" style="border:1px solid;"></div>
                        </div>

                        <?php if ($status->orderStateLang->action_text != '') { ?>
                        <div class="hidden-lg hidden-sm hidden-md col-xs-12 gotham-light clearright remove-padding" style="text-align: center;">
                               <a href="<?php echo \yii\helpers\Url::base(); ?>/user/order/confirmation/<?php echo $order->orders_id;?>" class="edit shipping">CONFIRM PAYMENT</a>
                            </div>
                        <?php } ?>

                        <div class="col-lg-12" style="padding-bottom: 20px;"></div>
                        </div>

                    <!-- End Detail -->

                        <div class="col-lg-12 hidden-md hidden-sm myprofile customer-info separator last clearleft clearright" style="padding-top:0px;"></div>

                    <?php $i++; } ?>
                <?php } ?>

                 <?php if(count($orders) == 0){ ?>
                            <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12" style="color:#a8a9ad;text-align: center;padding-top: 15px;">You have no save any order informations</div>
                        <?php } ?>                           

                </div>
            
        </div>
    </div>
</section>
<style type="text/css">
    .non-active{
        display: none;
    }
    .active{
        display: block;
    }
</style>
