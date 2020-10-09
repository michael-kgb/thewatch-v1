<?php

use yii\web\Session;

$sessionOrder = new Session();
$sessionOrder->open();
$cart = $sessionOrder->get("cart");
?>
<div class="col-xs-12 remove-padding view-cart-title">
    VIEW CART
</div>
<?php if ($cart == NULL || empty($cart) || $cart == '') { ?>
    <div class='col-xs-12 text-center cart-empty'>
        KERANJANG BELANJA KOSONG
    </div>
<?php } else { ?>
    <?php
    $items = $cart['items'];
    if (count($items) > 0) {
        $grandTotal = 0;
        foreach ($items as $item) {
            $grandTotal += $item['total_price'];
			if( $item['out_of_stock'] === 1 ){
			?>
				<div class='col-xs-12 col-sm-12 text-center remove-padding box-cart-list bg-inactive-cart <?php if ($item == end($items)) echo 'border-bottom-1'; ?>'>
					<img class="col-xs-4 col-sm-4 pull-left remove-padding" src="<?php echo $item['image']['url']; ?>" width="75px">
					<div class="col-xs-8 col-sm-8 remove-padding-right">
						<div class="col-xs-12 col-sm-12 remove-padding">
							<a href="#" data-id="<?php echo $item['id']; ?>" id="removeItem-mobile" attributeId="<?php echo $item['product_attribute_id']; ?>">
								<img class="pull-right" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close.png" width="15px">
							</a>
							<div class='clearfix'></div>
							<div class="text-gotham-medium text-left">
								<?php echo $item['brand_name'] . ' - ' . ucwords(strtolower($item['name'])) .' '. '<span class="text-small text-danger font-italic">'.$item['cart_msg'].'</span>'; ?>
								<br/>
								<?php echo $item['color']; ?>
							</div>
							<div class="text-gotham-light text-left">
								<?php echo 'IDR ' . common\components\Helpers::getPriceFormat($item['total_price']); ?>
							</div>
							<div class="text-gotham-light text-left">
								<?php echo $item['quantity'] . ' Pcs'; ?>
							</div>
						</div>
					</div>
				</div>
			<?php
			}else{
			?>
				<div class='col-xs-12 col-sm-12 text-center remove-padding box-cart-list <?php if ($item == end($items)) echo 'border-bottom-1'; ?>'>
					<img class="col-xs-4 col-sm-4 pull-left remove-padding" src="<?php echo $item['image']['url']; ?>" width="75px">
					<div class="col-xs-8 col-sm-8 remove-padding-right">
						<div class="col-xs-12 col-sm-12 remove-padding">
							<a href="#" data-id="<?php echo $item['id']; ?>" id="removeItem-mobile" attributeId="<?php echo $item['product_attribute_id']; ?>">
								<img class="pull-right" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close.png" width="15px">
							</a>
							<div class='clearfix'></div>
							<div class="text-gotham-medium text-left">
								<?php echo $item['brand_name'] . ' - ' . ucwords(strtolower($item['name'])); ?>
								<br/>
								<?php echo $item['color']; ?>
							</div>
							<div class="text-gotham-light text-left">
								<?php echo 'IDR ' . common\components\Helpers::getPriceFormat($item['total_price']); ?>
							</div>
							<div class="text-gotham-light text-left">
								<?php echo $item['quantity'] . ' Pcs'; ?>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
        }
    }
}
?>
<?php
if ($cart == NULL || empty($cart) || $cart == '') {
    ?>
    <div class="col-xs-7 col-xs-offset-5 remove-padding margin-top-5">
        <div class="bg-black-text-white text-center padding-top-3 padding-bottom-3">ISI KERANJANG BELANJA</div>
    </div>
    <?php
} else {
    ?>
    <div class="col-xs-12 remove-padding margin-top-5 text-gotham-medium">
        <div class="col-xs-5 text-left remove-padding">TOTAL</div>
        <div class="col-xs-7 text-right remove-padding">IDR <?php echo common\components\Helpers::getPriceFormat($grandTotal); ?></div>
    </div>
    <div class="col-xs-12 remove-padding margin-top-5 border-top-button padding-top-3">
        <a href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/sign-in"><div class="col-xs-10 pull-right bg-black-text-white text-center padding-top-3 padding-bottom-3">LANJUTKAN KE PEMBAYARAN</div></a>
        
        <!--<a id="ied-modal-checkout-2" style="cursor:pointer;"><div class="col-xs-10 pull-right bg-black-text-white text-center padding-top-3 padding-bottom-3">LANJUTKAN KE PEMBAYARAN</div></a>-->
    </div>
    <?php
}
?>

<script>
    
    $('a#ied-modal-checkout-2').click(function(){
      $('#ied-modal-bag').modal('show');
});

    $('a#removeItem-mobile').on('click', function (e) {

        e.preventDefault();

        var id = $(this).attr("data-id"),
                attributeId = $(this).attr("attributeId");

        $.ajax({
            type: "POST",
            url: baseUrl + '/cart/checkout/remove-item',
            data: {"id": id, "attributeId": attributeId},
            beforeSend: function () {

            },
            success: function (data) {
                location.reload();
            }
        });

    });
</script>