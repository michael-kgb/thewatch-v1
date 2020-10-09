<?php 
use yii\web\Session;

$sessionOrder = new Session();
$sessionOrder->open();
$cart = $sessionOrder->get("cart");
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<!-- <script src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.js"></script> -->
<script src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/js/jquery.mobile.custom.js"></script>
<script src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/js/bootstrap.min.js"></script>
<script src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/js/bootstrap-slider.js"></script>
<script src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/js/functions.js"></script>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 cart-title-box" style="margin-left: 0;text-align: center;padding-right: 0;padding-left: 0;width: 100%;">
        <span class="cart-title">VIEW CART</span>
    </div>
</div>
<?php if($cart == NULL) { ?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 clearright cart-empty-box">
        <span class="cart-empty">KERANJANG BELANJA KOSONG</span>
    </div>
    <div style="padding-top:100px;"></div>
</div>
<!--<div class="row checkout-btn-box">-->
    <!--<a href="<?php echo \yii\helpers\Url::base(); ?>/watches/all-product"><div class="mn-header btn-fill-cart">ISI KERANJANG BELANJA</div></a>-->
<!--</div>-->
<?php } else { ?>
<?php 
$items = $cart['items'];
if(count($items) > 0) {
    $grandTotal = 0;
    foreach($items as $item) {
        $grandTotal += $item['total_price'];
?>
<div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2 clearright cart-close-box">
        <a href="#" data-id="<?php echo $item['id']; ?>" id="removeItemEvent" attributeId="<?php echo $item['product_attribute_id']; ?>">
        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close.png" width="25px">
        </a>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 clearright cart-img-box">
        <img src="<?php echo $item['image']['url']; ?>" width="75px">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 clearright cart-product-box">
        <span><?php echo $item['brand_name']; ?> - <?php echo $item['name']; ?> <?php echo $item['color']; ?> </span>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 clearright cart-price-box">
        <span>IDR <?php echo common\components\Helpers::getPriceFormat($item['total_price']); ?></span>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 clearright cart-quantity-box">
        <span><?php echo $item['quantity']; ?> pcs</span>
    </div>
</div>
    <?php } ?>
<?php } ?>
<div class="row cart-total-box">
    <div class="col-lg-12 col-md-12 col-sm-12 clearleft clearright">
        <span class="cart-total">TOTAL</span>
        <span class="cart-amount-total">IDR <?php echo common\components\Helpers::getPriceFormat($grandTotal); ?></span>
    </div>
</div>
<?php } ?>


<script>
$('a#removeItemEvent').on('click', function(e) {
    
    e.preventDefault();
    
    var id = $(this).attr("data-id"),
        attributeId = $(this).attr("attributeId");
    
    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/remove-item-event',
        data: { "id" : id, "attributeId" : attributeId },
        beforeSend: function(){
            
        },
        success: function(data){
            $("div#box-event-open").html(data);
        }
    });
    
    if($("section#shopping-bag-event").length){
        $.ajax({
            type: "POST",
            url: baseUrl + '/cart/checkout/remove-cart-item',
            data: { "id" : id, "attributeId" : attributeId },
            beforeSend: function(){

            },
            success: function(data){
                $("section#shopping-bag-event").html(data);
            }
        });
    }
});
</script>