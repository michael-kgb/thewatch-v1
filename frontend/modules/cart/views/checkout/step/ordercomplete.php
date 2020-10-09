<?php 
use yii\web\Session;

$sessionOrder = new Session();
$sessionOrder->open();
$customerInfo = $sessionOrder->get("customerInfo");
$cart = $sessionOrder->get("cart");
$items = isset($cart['items']) ? $cart['items'] : '';

$order = \backend\models\Orders::findOne(['reference' => $_SESSION['lastOrder']['order_number']])->payment_method_detail_id;
$paymentMethod = \backend\models\PaymentMethodDetail::findOne(["payment_method_detail_id" => $order]);

//print_r($_SESSION);
?>

<!--<script async="true" src="//ssp.adskom.com/tags/third-party-async/YTkwMmQ2ZDYtOWIyMS00Yjk1LWI0OGYtYmY0MDYwYzEzNjcz"></script>-->

<script>
var items = [];

<?php $orders = \backend\models\Orders::findOne(['reference' => $_SESSION['lastOrder']['order_number']]); ?>
<?php $orderDetail = \backend\models\OrderDetail::findAll(['orders_id' => $orders->orders_id]); ?>
<?php $orderCoupon = \backend\models\OrderCartRule::find()->where(['orders_id' => $orders->orders_id])->one(); ?>

var totalCart = <?php echo count($orderDetail); ?>;

if(totalCart > 0){
	
	<?php $i = 1; ?>
	
	<?php $grandTotal; ?>
	<?php foreach ($orderDetail as $item) { ?>
	<?php 
	$productId = \backend\models\Product::findOne(["product_id" => $item['product_id']]); 
	$grandTotal += $item['original_product_price'] * $item['product_quantity'];
	$hasOfferBrandFound = FALSE;
	if($productId->brands_brand_id == 2){
		$hasOfferBrandFound = TRUE;
	}
	?>
	
	items.push({
		"id": <?php echo $item['product_id']; ?>,
		"name": "<?php echo $item['product_name']; ?>",
		"price": "<?php echo $item['original_product_price']; ?>",
		"brand": "<?php echo $productId->brands->brand_name; ?>",
		"category": "<?php echo $productId->productCategory->product_category_name; ?>",
		"position": <?php echo $i; ?>,
		"quantity": <?php echo $item['product_quantity']; ?>
	});
	<?php $i++; ?>
	<?php } ?>
	
	dataLayer.push({
	  "event": "checkout",
	  "ecommerce": {
		"checkout": {
		  "actionField": {
			"step": 3
		  },
		  "products": items
		}
	  }
	});
	
	dataLayer.push({
		"event": "transaction",
		"ecommerce": {
			"purchase": {
				"actionField": {
					"id": "<?php echo $_SESSION['lastOrder']['order_number']; ?>",
					"affiliation": "Online Store",
					"revenue": <?php echo $grandTotal; ?>,
					"tax": 0,
					"shipping": <?php echo $orders->total_shipping; ?>,
					"coupon": "<?php echo $orderCoupon != NULL ? $orderCoupon->name : ''; ?>"
				},
				"products": items
			}
		}
	});
}

fbq('track', 'Purchase', {value: <?php echo $grandTotal; ?>, currency: 'IDR'});
</script>

<!-- Offer Conversion: The Watch Co. -->
<img src="https://shopback.go2cloud.org/aff_l?offer_id=1367&adv_sub=<?php echo $_SESSION['lastOrder']['order_number']; ?>&amount=<?php echo $grandTotal; ?>" width="1" height="1" />
<!-- // End Offer Conversion -->

<?php if($hasOfferBrandFound){ ?>
<!-- Offer Conversion: The Watch Co. -->
<img src="https://thewatchco.go2cloud.org/aff_l?offer_id=7&adv_sub=<?php echo $_SESSION['lastOrder']['order_number']; ?>&amount=<?php echo $grandTotal; ?>" width="1" height="1" />
<!-- // End Offer Conversion -->
<?php } ?>


<section id="" style="padding-bottom: 0;padding-top: 20px;">
    <div class="container">
        
        <div class="row">
            <div class="col-lg-12 col-md-12 hidden-sm hidden-xs shopping-bag clearleft clearright">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/step/step-3.png" class="width100" style="padding-top: 0;">
            </div>
            <div class="hidden-lg hidden-md col-sm-12 col-xs-12 shopping-bag clearleft clearright">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/step/step-3-mobile.png" class="width100" style="padding-top: 0;">
            </div>
            
        </div>
    </div>
</section>
<section id="" style="padding-top: 20px;">
    <div class="container">
        
        <div class="row step-purchase">
            <div class="col-xs-12 clearleft clearright">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase title"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/order-complete.PNG" class="my-auto" style="width:35%;"></div> 
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase title">Terima Kasih!</div>
                

            <div class="hidden-lg hidden-md hidden-sm col-xs-12 new-line"></div>    
            <?php if($paymentMethod->paymentMethod->payment_method_alias == 'bt'){ ?>
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light ordercomplete text clearleft clearright remove-padding no-spacing margin-bottom-10">
                    Email konfirmasi untuk nomor order <span class="gotham-medium"><?php echo $_SESSION['lastOrder']['order_number']; ?></span> 
                    telah dikirimkan ke : <span class="gotham-medium no-spacing"><?php echo $customerInfo['email']; ?></span> <br><br>
                    
                    Setelah anda melakukan pembayaran, silahkan lakukan konfirmasi pembayaran melalui menu my order.
                    Kami akan proses pesanan Anda, setelah kami lakukan verifikasi pembayaran Anda.
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>    
            <?php }else{ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light ordercomplete text clearleft clearright remove-padding no-spacing margin-bottom-10">
                    Email konfirmasi untuk nomor order <span class="gotham-medium"><?php echo $_SESSION['lastOrder']['order_number']; ?></span> 
                    telah dikirimkan ke : <span class="gotham-medium no-spacing"><?php echo $customerInfo['email']; ?></span> <br><br>
                    Kami akan proses pesanan Anda setelah kami lakukan verifikasi pembayaran Anda.
                </div>
            <?php } ?>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 hidden-xs new-line"></div>
        <?php if($paymentMethod->paymentMethod->payment_method_alias == 'bt'){ ?>
            
            <?php $order = \backend\models\Orders::find()->where(['reference'=>$_SESSION['lastOrder']['order_number']])->one(); 
                    $paymentMethod = \backend\models\PaymentMethod::findOne(['payment_method_id' => $customerInfo['paymentMethod']['payment_method_id']])->payment_method_alias;
                    $payment = \backend\models\Payment::findOne(['payment_id' => $customerInfo['paymentMethod']['payment_id']]);

                    $grandtotal = 0;
                    $order_details = \backend\models\OrderDetail::find()->where(['orders_id'=>$order->orders_id])->all();
                    foreach ($order_details as $order_detail) {
                        $grandtotal += $order_detail->original_product_price * $order_detail->product_quantity;
                    }

                    $order_cart_rule = \backend\models\OrderCartRule::find()->where(['orders_id'=>$order->orders_id])->one();

                    $discountAmount = 0;
                    if($order_cart_rule != null){
                        $discountAmount = $order_cart_rule->value;
                    }
                    $grandtotal += $order->total_shipping;
                    $grandtotal += $order->total_shipping_insurance;
                    $grandtotal -= round($discountAmount);
                    $grandtotal -= $order->total_special_promo;
                    $grandtotal += $order->unique_code;

            ?>
            <?php
                $now = date('Y-m-d H:i:s'); 
                $to = date('Y-m-d H:i:s', strtotime($order->date_add. ' +1 days'));
                // $to = date('2018-08-22 16:35:00');
                // echo $now;
                $flashMicrotime = \common\components\Helpers::getDifferentMicrotime($now, $to);

            ?>
            <script>
                var payment_expired = new Date().getTime() + <?php echo $flashMicrotime; ?>;
        
            </script>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright clearleft clearright-mobile clearleft-mobile">
                <div class="col-lg-1 hidden-md hidden-sm hidden-xs" style="width: 12.5%;">
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 clearright-mobile clearleft-mobile">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 box1-ordercomplete" style="">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright clearleft clearright-mobile clearleft-mobile box-shadow bradius5" style="">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-center gotham-medium title-box-ordercomplete">
                                        <?php if($order->pre_order == 0){ ?>
                                            Lakukan Pembayaran Dalam Waktu
                                        <?php }else{ ?>
                                            Pembayaran Diterima Paling Lambat Tanggal 1 September 2018
                                        <?php } ?>
                                        
                                        
                                     </div>
                                     <?php if($order->pre_order == 0){ ?>
                                     <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                     <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                    
                                    <table align="center">
                                        <tr>
                                            <td style="width: 10px;"></td>
                                            
                                            <td class="time-ordercomplete">
                                                <div id="hour-expires" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile box-shadow-smooth talign-center time-remaining" style="background-color: #fff;border-radius: 5px 5px 0 0;">
                                                    24
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile bgcolorblue box-shadow-smooth talign-center fcolor255 time-name" style="background-color: rgb(32,97,103);border-radius: 0 0 5px 5px;">
                                                    Jam
                                                </div>
                                            </td>
                                            <td style="width: 10px;"></td>
                                            <td class="time-ordercomplete">
                                                <div id="minute-expires" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile box-shadow-smooth talign-center time-remaining" style="background-color: #fff;border-radius: 5px 5px 0 0;">
                                                                                    
                                                    00
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile bgcolorblue box-shadow-smooth talign-center fcolor255 time-name" style="background-color: rgb(32,97,103);border-radius: 0 0 5px 5px;">
                                                    Menit
                                                </div>
                                            </td>
                                            <td style="width: 10px;"></td>
                                            <td class="time-ordercomplete">
                                                <div id="second-expires" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile box-shadow-smooth talign-center time-remaining" style="background-color: #fff;border-radius: 5px 5px 0 0;">
                                                                                    
                                                    00
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile bgcolorblue box-shadow-smooth talign-center fcolor255 time-name" style="background-color: rgb(32,97,103);border-radius: 0 0 5px 5px;">
                                                    Detik
                                                </div>
                                            </td>
                                            <td style="width: 10px;"></td>
                                        </tr>
                                    </table>
                                    <?php } ?>
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                </div>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm col-xs-12 new-line"></div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 box2-ordercomplete" style="">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright clearleft clearright-mobile clearleft-mobile box-shadow bradius5" style="height: 236px;">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-center gotham-medium title-box-ordercomplete">
                                            Transfer ke Nomor Rekening
                                         </div>
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-center gotham-light description-box-ordercomplete">
                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/<?php echo $payment['filename']; ?>" class="img-responsive" style="width: 70px;margin: auto;">
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="padding-top: 5px;"></div>
                                            <span id="<?php echo $payment['account_number']; ?>"><?php echo $payment['account_number']; ?></span><br>
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="padding-top: 5px;"></div>
                                            Atas Nama<br>
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="padding-top: 5px;"></div>
                                            <img src="http://kgbgroup.co.id/img/logo/logo-signature1-02.png" class="img-responsive" style="margin:auto;width: 41px;">
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="padding-top: 5px;"></div>
                                            <?php echo $payment['name_person']; ?>
                                         </div>
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div id="copy-account-number" title="copy to clipboard"></div>
                                            <a class="yellow-round default button-box-ordercomplete" onclick="copyToClipboard('#<?php echo $payment['account_number']; ?>')">Salin Nomor Rekening</a>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                    </div>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm col-xs-12 new-line"></div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 box3-ordercomplete" style="">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright clearleft clearright-mobile clearleft-mobile box-shadow bradius5" style="height: 236px;">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-center gotham-medium title-box-ordercomplete">
                                            Jumlah yang harus dibayarkan
                                         </div>
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-center gotham-light description-box-ordercomplete">
                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/cost-yellow.png" class="img-responsive" style="width: 70px;margin: auto;">
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                            Rp. <?php echo \common\components\Helpers::getPriceFormat($grandtotal); ?>,-<br>
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                            Transfer hingga 3 digit terakhir
                                         </div>
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div id="<?php echo $grandtotal; ?>" style="display: none;"><?php echo $grandtotal; ?></div>
                                            <div id="copy-total" title="copy to clipboard"></div>
                                            <a class="yellow-round default button-box-ordercomplete" onclick="copyTotal('#<?php echo $grandtotal; ?>')">Salin Jumlah Nominal</a>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                    </div>
                    </div>
                </div>
                <div class="col-lg-1 hidden-md hidden-sm hidden-xs" style="width: 12.5%;">
                </div>
            </div>
        
                        
                        <!-- <a href="<?php echo \yii\helpers\Url::base(); ?>/user/order/confirmation/<?php echo $order->orders_id; ?>" class="blue-round default" id="confirm-order">Konfirmasi Pembayaran</a> -->
        <?php } ?>
    </div>
        <div class="row step-purchase">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div> 
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding border-bottom-1 padding-bottom-5 ipad-1024">
                    <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs"></div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a href="<?php echo \yii\helpers\Url::base(); ?>/user/orders" class="blue-round default">Cek Status Order</a>
                        
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs"></div>
                    
                </div>

        </div>
    </div>
</section>

<style>
    .time-remaining{
        font-size: 36px;
    }
    .time-name{
        font-size: 14px;
    }
    .title-box-ordercomplete,.description-box-ordercomplete,.button-box-ordercomplete{
        font-size: 14px;
    }
    @media only screen and (min-width: 1025px) {
        .box1-ordercomplete{
            padding-right: 10px;padding-left: 0;
        }
        .box2-ordercomplete{
            padding-right: 10px;padding-left: 0;
        }
        .box3-ordercomplete{
            padding-left:0;padding-right: 0;
        }
        .box1-ordercomplete>.box-shadow {
            height: 236px;
        }
    }
    @media only screen and (max-width: 1024px) and (min-width: 801px) {
        .box1-ordercomplete{
            padding-right: 10px;padding-left: 0;
        }
        .box2-ordercomplete{
            padding-right: 10px;padding-left: 0;
        }
        .box3-ordercomplete{
            padding-left:0;padding-right: 0;
        }
        .box1-ordercomplete>.box-shadow {
            height: 236px;
        }
    }   
    @media only screen and (max-width: 800px) and (min-width: 768px) {
        .title-box-ordercomplete,.description-box-ordercomplete,.button-box-ordercomplete{
            font-size: 10px;
        }
    /*    .time-remaining{
            font-size: 38px;
        }
        .time-name{
            font-size: 14px;
        }*/
        .box1-ordercomplete{
            padding-right: 10px;padding-left: 0;
        }
        .box2-ordercomplete{
            padding-right: 10px;padding-left: 0;
        }
        .box3-ordercomplete{
            padding-left:0;padding-right: 0;
        }
        .box1-ordercomplete>.box-shadow {
            height: 236px;
        }
    }
    @media only screen and (max-width: 767px) {
        
    }
</style>

<script>
// Set the date we're counting down to
var countDownDate = new Date();
countDownDate.setDate(countDownDate.getDate() + 1);
// Update the count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
console.log(hours)
  // Display the result in the element with id="demo"
  document.getElementById("hour-expires").innerHTML = hours;
  document.getElementById("minute-expires").innerHTML = minutes;
  document.getElementById("second-expires").innerHTML = seconds;

  // If the count down is finished, write some text 
  if (distance < 0) {
    clearInterval(x);
    
  }
}, 1000);
</script>