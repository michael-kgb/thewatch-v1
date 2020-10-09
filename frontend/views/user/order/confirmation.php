<?php

use yii\web\Session;

$sessionOrder = new Session();
$sessionOrder->open();

$customerInfo = $sessionOrder->get("customerInfo");

//print_r($_SESSION);
?>
<script>
<?php 
	$orderConfirmation = backend\models\OrderConfirmation::findOne(["orders_id" => $orders->orders_id]);
	if (count($orderConfirmation) > 0) {
?>
var isOrderConfirmed = true;
	<?php } else { ?>
var isOrderConfirmed = false;
	<?php } ?>
</script>
<script type="text/javascript">
    function slideDetail(event) {
     
    if (event != null) {
        if ($('#detail-hide-1').hasClass("non-active")) {
            $('#detail-hide-1').slideDown();
            $('#detail-hide-1').removeClass("non-active");
            $('#detail-hide-1').addClass("active");
            document.getElementById("see-detail").innerHTML = " (HIDE DETAILS)";
            // $('.arrow-down-' + event).replaceWith('<img class="arrow-down-' + event + '" src="/img/icons/top-spec.png">');
        }
        else {
            $('#detail-hide-1').slideUp();
            $('#detail-hide-1').removeClass("active");
            $('#detail-hide-1').addClass("non-active");
            document.getElementById("see-detail").innerHTML = " (SEE DETAILS)";
            // $('.arrow-down-' + event).replaceWith('<img class="arrow-down-' + event + '" src="/img/icons/down-spec.png">');
        }
    }
}
</script>
<section id="shopping-bag" style="padding-top: 0px;">
    <div class="container">
        <div class="row">
          
            <?php 
            echo Yii::$app->view->renderFile('@app/shared/sidebar_profile.php', array(
                "currentPage" => "my_order",
            ));
            ?>

            <!-- <div class="hidden-lg hidden-md hidden-sm col-xs-12">
                <div class="col-xs-12 text-center select-menu-profile">
                    <select id="profile-menu" class="qty-dropdown" onchange="profile_menu()">
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/profile">MY PROFILE</option>
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/orders" selected>MY ORDER</option>
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/shipping">SHIPPING INFORMATION</option>
                    </select>
                </div>
            </div> -->
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 myprofile">
                 <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 my-profile title clearleft">Confirm Payment</div>
                 <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 clearleft" style="border-bottom: solid 1px #a8a9ad;margin-bottom: 10px;"></div>
                


                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 myprofile order-info active clearleft clearright">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding text-gotham-medium">
                                Order Number
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 myprofile order-info active clearleft clearright">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding text-gotham-medium">
                                <?php echo $order['reference']; ?><a href="#" id="see-detail" style="color:#9e8463;" onclick="slideDetail(<?php echo '1';?>)"> (SEE DETAILS)</a>
                            </div>
                        </div>
                <div class="col-xs-12 hidden-lg hidden-md hidden-sm clearleft" style="border-bottom: solid 1px #a8a9ad;margin-bottom: 10px;margin-top: 10px;"></div>

                        <div id="detail-hide-1" class="non-active">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 myprofile order-info active clearleft clearright" style="padding-top: 0px;">
                            
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding text-gotham-light" style="padding-top: 5px;">
                                DATE
                            
                            <div style="padding-top: 5px;">
                                STATUS</div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 myprofile order-info active clearleft clearright" style="padding-top: 0px;">
                            
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 clearleft remove-padding text-gotham-light" style="padding-top: 5px;">
                                <?php echo date('d F Y', strtotime($order['date_add'])); ?>
                            
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
                                if($status->orderStateLang->text == 'WAITING FOR PAYMENT'){
                                    $stat_col = '#9e8463';
                                }
                                // echo $status->orderStateLang->text . ' ';
                                
                                ?>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft" style="padding-top: 5px;color:<?php echo $stat_col;?>"><?php echo $status->orderStateLang->text . ' '; ?></div>
                                
                            </div>
                            
                            
                        </div>

                        <!-- Details -->

                        
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
                        if (count($orderDetail)) {
                            $i = 1;
                            $grandTotal = 0;
                            ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myitem box clearleft clearright remove-padding ipad margin-bottom-5 ipad">
                                <?php foreach ($orderDetail as $ordered) { ?>
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
                                            <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive col-lg-6 col-sm-6 col-md-6 col-xs-4 clearleft remove-padding">
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
                                    <?php $grandTotal += $ordered->original_product_price * $ordered->product_quantity;
                                    $i++; ?>
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
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header value">
                                Shipping Insurance
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header price value">
                                IDR 
                                <?php
                                echo common\components\Helpers::getPriceFormat($order->total_shipping_insurance);
                                ?>
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
                                    IDR <?php echo common\components\Helpers::getPriceFormat(($order->total_shipping + $grandTotal + $order->unique_code + $order->total_shipping_insurance)); ?>
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
                               Once you have made your payment, please confirm at our webstore in the next 48 hours, and once we've verified your payment, we'll ship your package within the next two business days.
                            </div>
                            
                         
                        </div>
              

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
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header value">
                                Shipment Insurance
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header price value">
                                IDR 
                                <?php
                                echo common\components\Helpers::getPriceFormat($order->total_shipping_insurance);
                                ?>
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
                                IDR <?php echo common\components\Helpers::getPriceFormat(($order->total_shipping + $grandTotal + $order->unique_code + $order->total_shipping_insurance)); ?>
                            </div>
                            <div class="col-xs-12" style="border:1px solid;"></div>
                        </div>
                        
                        <div class="col-lg-12" style="padding-bottom: 20px;"></div>
                        </div>

                        <div class="col-lg-12 hidden-md hidden-sm myprofile customer-info separator last clearleft clearright" style="padding-top:0px;margin-bottom: 20px;"></div>

              





                <?php if($status->order_state_lang_id == 19){ ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info clearleft clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                        Nama Pemesan
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                        <input class="email myprofile" type="text myprofile" name="customer_name" placeholder="Name">

                        <input class="email myprofile" type="hidden" name="orders_id" placeholder="Name" value="<?php echo $_GET['id'];?>">
                    </div>
                    
                    
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info clearleft clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright remove-padding">
                        Nama Pemilik Rekening
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright remove-padding" style="">
                        <input class="email myprofile" type="text" name="account_name">
                    </div>
                </div>
               
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info clearleft clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                        Nominal Pembayaran
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding" style="">
                        <input class="email myprofile" type="text" name="amount">
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info clearleft clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright remove-padding">
                        Rekening Anda
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright remove-padding">
                        <input class="email myprofile" type="text" name="account_number">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info clearleft clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                        Bank Anda
                    </div>
                    <?php
                    ?>
                 
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                       <input class="email myprofile" type="text" name="bank_anda">
                    </div>
                 
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info clearleft clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright remove-padding">
                        Metode Pembayaran
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright remove-padding" style="">
                        <input class="email myprofile" type="text" name="transfer_method" value="BANK TRANSFER" >
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info clearleft clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                        Catatan
                    </div>
                                  
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                       <input class="email myprofile" type="text" name="comments">
                    </div>
                 
                </div>

                <?php if(isset($_SESSION['_flash'])){ ?>
                <?php if($_SESSION['_flash'] == 'success'){ ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info clearleft clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright remove-padding" style="color:green;">
                        Thank You! Your data has been recorded.
                    </div>                               
                </div>
                <?php } }
                    unset($_SESSION['_flash']);
                 ?>
               
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info clearleft clearright" style="padding-top: 30px;">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearright btn-edit-profile" style="float: right;text-align: center;">
                        <a href="#" class="continue edit shipping" style="float:left;" id="submit-confirm">SUBMIT</a>
                    </div>
                <div class="col-lg-12 col-md-12 col-sm-12 myprofile customer-info separator last clearleft clearright"></div>
                <?php }else{ ?>
                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright remove-padding" style="color:green;">
                       <?php if(isset($_SESSION['_flash'])){ ?>
                        <?php if($_SESSION['_flash'] == 'success'){ ?>
                            Thank You!
                        <?php }}?>
                        Your confirmation data has been recorded.
                        <?php unset($_SESSION['_flash']); ?>
                    </div>
                <?php } ?>
            </div>
            
        </div>
    </div>
</section>


    

<script>
    var ordersId = '<?php echo $orders->orders_id; ?>';
</script>
<style type="text/css">
    .non-active{
        display: none;
    }
    .active{
        display: block;
    }
</style>
