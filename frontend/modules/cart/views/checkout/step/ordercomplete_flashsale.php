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
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase title" style="font-size:16px;">Terima kasih telah berbelanja di The Watch Co.</div>
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase subtitle">Untuk melakukan pembayaran silahkan menunggu email konfirmasi dari tim kami.
Email akan dikirimkan paling lambat 30 menit setelah Anda melakukan pembelian.</div>
            
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase shipping box clearleft clearright remove-padding border-bottom-1 padding-bottom-5 ipad-1024">
                    <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs"></div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a href="<?php echo \yii\helpers\Url::base(); ?>/user/orders" class="blue-round default">Cek Status Order</a>
                        
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs"></div>
                    
                </div>
    
               
            </div>
        </div>


    </div>
</section>