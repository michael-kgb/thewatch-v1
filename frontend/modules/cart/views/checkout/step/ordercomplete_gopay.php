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
            <div class="hidden-sm hidden-md hidden-xs col-lg-12">
            
            </div>
            <div class="col-xs-12 clearleft clearright">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase title"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/order-complete.PNG" class="my-auto" style="width:35%;"></div>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase title">Terima Kasih!</div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase subtitle">Pembayaran Anda telah diproses!</div>


            <?php $order = \backend\models\Orders::findOne(['reference' => $_SESSION['lastOrder']['order_number']]); ?>
            <?php
                $va_log = \backend\models\VaLog::find()->where(['order_id'=>$order->reference])->orderBy('va_id DESC')->one();
                $now = date('Y-m-d H:i:s'); 
                $to = date('Y-m-d H:i:s',strtotime('+15 minutes', strtotime($va_log->transaction_time)));
                $expire_count = \common\components\Helpers::getDifferentMicrotime($now, $to);
                if($now > $to){
                  
                    $expire_count = 0;
                }
            ?>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase shipping box clearleft clearright remove-padding border-bottom-1 padding-bottom-5 ipad-1024">
                <?php if($now <= $to){ ?>
                <span id="complete-order-gopay"></span>
                <div class="hidden-lg col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile talign-center fcolor69">
                    Klik <a href="<?php echo $va_log->action_deeplink_redirect;?>" style="color:#206167;">Disini</a> jika tidak teralihkan otomatis ke aplikasi Go-Jek
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                </div>
                <?php } ?>
                <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs"></div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/orders" class="blue-round default">Cek Status Pembayaran</a>
                    <?php if($paymentMethod->paymentMethod->payment_method_alias == 'bt'){ ?>
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                        <a href="<?php echo \yii\helpers\Url::base(); ?>/user/order/confirmation/<?php echo $order->orders_id; ?>" class="blue-round default" id="confirm-order">Konfirmasi Pembayaran</a>
                    <?php } ?>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs"></div>
                
            </div>

        </div>
    </div>
    </div>
</section>

<?php if($now <= $to){ ?>

<script type="text/javascript">
    var w_window = window.innerWidth;
    if(w_window <= 1024){
        var e = document.getElementById("complete-order-gopay");
        e.id = "complete-order-gopay-redirect";  
    }

</script>

<div id="qr-gopay-modal" class="modal fade" role="dialog">
  <div class="modal-dialog warranty fcolor69" style="vertical-align: middle;">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 10px;background-color: #fff;">
      <div class="modal-body" style="padding-top: 15px;">
        <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/x-black-24.png" style="width: 17px;"> </button>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
                          
                          <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-light title-warranty">
                            Scan QR Go-Pay
                          </span>
                          <span class="clearleft clearright clearright-mobile gotham-medium">
                           
                          </span>
                          
                        </div>
                        
      </div>
      <div class="modal-body title-warranty" style="height: 500px;margin-top:10px;padding-top:5px;overflow-y: scroll;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright">
            <hr style="margin-top: 0px;margin-bottom: 5px;border-top:1px solid rgb(69,69,69);">
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-light">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile">Order ID</div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile talign-right"><?php echo $va_log->order_id; ?></div>                        
            </div>
            <div class="vertical-line col-lg-12 col-sm-12 col-md-12 col-xs-12" style="margin-top: 5px;margin-bottom: 5px;"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-light" style="padding-bottom: 10px;">
                Buka aplikasi <span class="gotham-medium">GO-JEK</span> di HP Anda dan scan kode QR di bawah.
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-light" style="padding-bottom: 15px;">
                <img src="<?php echo $va_log->action_qr_code_url; ?>" class="img-responsive" style="width: 60%;margin: auto;">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-light talign-center" style="padding-bottom: 10px;">
                Mohon selesaikan pembayaran Anda sebelum <br>
                <?php
                    $expire_time = strtotime('+15 minutes', strtotime($va_log->transaction_time));
                ?>
                <?php echo date('d F', $expire_time).' '.date('H:i', $expire_time); ?>
            </div>    
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="font-size: 22px;text-align: center;margin-top: 3px;">
                <table align="center">
                    <tr>
                        <td style="width: 45px;">
                            <div id="minute-expire" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile box-shadow-smooth" style="background-color: #fff;border-radius: 5px 5px 0 0;">
                                00
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile fsize-11 bgcolorblue box-shadow-smooth fcolor255" style="background-color: rgb(32,97,103);border-radius: 0 0 5px 5px;">
                                Menit
                            </div>
                        </td>
                        <td style="width: 5px;"></td>
                        <td style="width: 45px;">
                            <div id="second-expire" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile box-shadow-smooth" style="background-color: #fff;border-radius: 5px 5px 0 0;">
                                                                
                                00
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile fsize-11 bgcolorblue box-shadow-smooth fcolor255" style="background-color: rgb(32,97,103);border-radius: 0 0 5px 5px;">
                                Detik
                            </div>
                        </td>
                    </tr>
                </table>

            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                <div class="vertical-line col-lg-12 col-sm-12 col-md-12 col-xs-12" style="margin-top: 5px;margin-bottom: 5px;"></div>
                <div class="col-lg-6 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium fsize-18">Total</div>
                </div>
                <div class="col-lg-6 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile gotham-medium talign-right fsize-18">
                    Rp. <?php echo \common\components\Helpers::getPriceFormat($va_log->gross_amount); ?>
                </div>
                <div class="vertical-line col-lg-12 col-sm-12 col-md-12 col-xs-12" style="margin-top: 5px;margin-bottom: 5px;"></div>
                <div class="col-lg-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">
                    Bagaimana cara membayarnya? <br>
                    Silahkan selesaikan pembayaran <span class="gotham-medium">GO-PAY</span> Anda menggunakan aplikasi <span class="gotham-medium">GO-JEK.</span>
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                <div class="col-lg-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">
                    <ol style="padding-left: 15px;">
                      <li style="margin-left: 0;">Klik <span class="gotham-medium">Pay Now with GO-PAY.</span></li>
                      <li style="margin-left: 0;">Buka aplikasi <span class="gotham-medium">GO-JEK</span> di handphone Anda.</li>
                      <li style="margin-left: 0;">
                        Klik <span class="gotham-medium">Scan QR.</span><br>
                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/qr-instruction-1.png" class="img-responsive" style="width: 60%;margin: auto;">
                        <span class="fsize-11 gotham-medium">Catatan:</span><br>
                        <span class="fsize-11">Tombol Scan QR tidak akan muncul jika saldo
                                GO-PAY Anda kurang dari Rp10,000.</span>
                      </li>
                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                      <li style="margin-left: 0;">
                        Arahkan kamera Anda ke <span class="gotham-medium">QR Code.</span><br>
                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/qr-instruction-2.png" class="img-responsive" style="width: 60%;margin: auto;">
                      </li>
                      <li style="margin-left: 0;">Cek detai pembayaran Anda di aplikasi <span class="gotham-medium">GO-JEK</span> lalu <span class="gotham-medium">klik Pay.</span></li>
                      <li style="margin-left: 0;">Transaksi Anda telah selesai.</li>
                    </ol>
                </div>
            </div>    
        </div>

        

      </div>
      <div class="modal-footer">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">
                    <a class="blue-round close title-warranty" data-dismiss="modal" style="width:30%;text-align: center;float: right;padding-top: 14px;padding-bottom: 11px;text-shadow: none;">Tutup</a>
        </div>
      </div>
      
    </div>

  </div>
</div>

<style type="text/css">
  .modal-backdrop.in {
      opacity: 0.7;
  }
  .close{
    opacity: 1;
  }
  .modal-dialog{
      width:415px;
      margin-left: auto;
      margin-right: auto;
  }
  .fa.fa-pencil{
    position: absolute;
    z-index: 1;
    top: 0;
    right: 0;
  }
  .modal {
  text-align: center;
  padding: 0!important;
}

.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}
  .@media only screen and (max-width : 768px) {
      
  }
</style>

<script type="text/javascript">
    var gopay_deeplink = "<?php echo $va_log->action_deeplink_redirect;?>";
    var expire_time = new Date().getTime() + <?php echo $expire_count; ?>;
</script>

<?php } ?>