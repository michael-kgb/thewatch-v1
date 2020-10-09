<?php

use yii\web\Session;

$sessionOrder = new Session();
$sessionOrder->open();
$cart = $sessionOrder->get("cart");
$totalItems = count($cart['items']);
?>

<!--<script async="true" src="//ssp.adskom.com/tags/third-party-async/MDdjYWEwMTItNjc2OC00YjNlLTgwYzQtZjRiNGFmZmEzYzRj"></script>-->


<script>
var items = [];

var totalCart = <?php echo $totalItems; ?>;

if(totalCart > 0){
	<?php $i = 1; ?>
	<?php foreach ($cart['items'] as $item) { ?>
	<?php $product = \backend\models\Product::findOne(['product_id' => $item['id']]); ?>
	items.push({
		"id": <?php echo $item['id']; ?>,
		"name": "<?php echo $item['name']; ?>",
		"price": "<?php echo $item['total_price']; ?>",
		"brand": "<?php echo $item['brand_name']; ?>",
		"category": "<?php echo $product->productCategory->product_category_name; ?>",
		"position": <?php echo $i; ?>,
		"quantity": <?php echo $item['quantity']; ?>
	});
	<?php $i++; ?>
	<?php } ?>

	dataLayer.push({
	  "event": "checkout",
	  "ecommerce": {
		"checkout": {
		  "actionField": {
			"step": 1
		  },
		  "products": items,
		}
	  }
	});
}

fbq('track', 'InitiateCheckout');
</script>

<section id="shopping-bag">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag title my-cart-title">
                <div class="border-bottom-1 padding-bottom-3">KERANJANG BELANJA</div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag header box">
                <div class="col-xs-12 border-bottom-1 remove-padding padding-top-2 padding-bottom-2">
                    <div class="hidden-xs col-lg-2 col-md-2 col-sm-2 gotham-medium shopping-bag header">
                        PRODUK
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4 gotham-medium shopping-bag header remove-padding">
                        DESKRIPSI PRODUK
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 gotham-medium shopping-bag header remove-padding quantity">
                        JUMLAH
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 gotham-medium shopping-bag header unit-price remove-padding unit-price">
                        HARGA PRODUK
                    </div>
                </div>
            </div>
        </div>
        <?php if ($cart == NULL) { ?>

        <?php } else { ?>
            <?php
            $items = $cart['items'];

            if (count($items) > 0) {
                $grandTotal = 0;
                $count = 0;
                foreach ($items as $item) {
                    $check_stock = \backend\models\ProductStock::find()->where(['product_id' => $item['id'], 'product_attribute_id' => $item['product_attribute_id']])->one();
                    $grandTotal += $item['total_price'];
                    ?>
                    <div class="row">
                        <div class="col-xs-12 clearleft clearright">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag clearleft clearright margin-top-5 padding-bottom-5 border-bottom-1 remove-padding">
                                <div id="overload-quantity-<?php echo $count; ?>" class="text-center" style="<?php echo $check_stock['quantity'] < $item['quantity'] ? "" : "display: none;" ?> width: 100%; background-color: #e0e0e0; padding-top: 1%; padding-bottom: 1%">We apologize the selected item doesnt have enough stock, please update the item quantity.</div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 shopping-bag img-shopping-bag">
                                    <img src="<?php echo $item['image']['url']; ?>" class="img-responsive">
                                    <div class="hidden-lg hidden-md hidden-sm text-gotham-medium margin-top-10 font-size-8">
                                        <?php echo $item['name']; ?>
                                    </div>
                                    <div class="hidden-lg hidden-md hidden-sm text-gotham-light font-size-8">
                                        <?php echo $item['brand_name']; ?>
                                    </div>
                                    <div class="hidden-lg hidden-md hidden-sm text-gotham-light font-size-8">
                                        -
                                    </div>
                                    <div class="hidden-lg hidden-md hidden-sm text-gotham-light font-size-8">
                                        Warna : <?php echo $item['color'] !== '' ? $item['color'] : '-'; ?>
                                    </div>
                                    <div class="hidden-lg hidden-md hidden-sm text-gotham-light font-size-8">
                                        Ukuran : -
                                    </div>
                                    <div class="hidden-lg hidden-md hidden-sm text-gotham-light font-size-8">
                                        Berat : <?php echo $item['weight'] !== '' ? $item['weight'] / 1000 . ' kg' : '-'; ?>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8 shopping-bag">
                                    <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 gotham-medium lspace2 shopping-bag product-name clearleft">
                                        <?php echo $item['name']; ?>
                                    </div>
                                    <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 gotham-light shopping-bag brand-name clearleft">
                                        <?php echo strtoupper($item['brand_name']); ?>
                                    </div>
                                    <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 shopping-bag separator clearleft"></div>
                                    <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 shopping-bag spesification clearleft">
                                        <?php echo $item['color'] !== '' ? 'Warna : ' . $item['color'] . '<br>' : ''; ?>
                                    </div>
                                </div>

                                <div class="hidden-xs col-lg-2 col-md-2 col-sm-2 shopping-bag remove-padding">
                                    <div id="item-quantity-<?php echo $count ?>" class="col-lg-12 col-md-12 col-sm-12 col-xs-4 shopping-bag product-qty remove-padding">
                                        <a style="cursor: pointer" onclick="edit_quantity(<?php echo $count . ", 'minus'"; ?>)">-</a>
                                        &nbsp; <span id="item-quantity-<?php echo $count ?>"><?php echo $item['quantity']; ?></span> &nbsp;
                                        <a style="cursor: pointer" onclick="edit_quantity(<?php echo $count . ", 'plus'"; ?>)">+</a> 
                                    </div>
<!--                                    <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 shopping-bag product-qty">
                                         / 
                                    </div>-->
                                </div>

                                <div class="hidden-lg hidden-md hidden-sm col-lg-2 col-md-2 col-sm-4 shopping-bag remove-padding">
                                    <div id="item-quantity-<?php echo $count ?>" class="col-lg-12 col-md-12 col-sm-12 col-xs-4 shopping-bag product-qty remove-padding">
                                        <select class="qty-mobile" id="quantity-<?php echo $item['id'] . '-' . $item['product_attribute_id']; ?>" onchange="changeQuantity(<?php echo $count . ',' . $item['id'] . ',' . $item['product_attribute_id']; ?>)" style="max-width: 70px;">
                                            <?php
                                            $productstock = \backend\models\ProductStock::findOne(['product_id' => $item['id'], 'product_attribute_id' => $item['product_attribute_id']]);
                                            if (!empty($productstock) && $productstock['quantity'] > 0) {
                                                for ($i = 1; $i <= $productstock['quantity']; $i++) {
                                                    if($item['quantity'] == $i){
                                                        echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                                    }
                                                    else{
                                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 shopping-bag clearright remove-padding">
                                    <div id="item-price-<?php echo $count ?>" class="col-lg-8 col-md-8 col-sm-8 remove-padding lspace2 shopping-bag total-price product-price-cart clearright text-gotham-medium">
                                        <?php echo common\components\Helpers::getPriceFormat($item['unit_price']); ?>
                                    </div>
                                    <div class="hidden-xs col-lg-4 col-md-4 col-sm-4 remove-product clearright">
                                        <a href="#" data-id="<?php echo $item['id']; ?>" id="removeCartItem" attributeId="<?php echo $item['product_attribute_id']; ?>">
                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close.png" class="close-btn">
                                        </a>
                                    </div>
                                </div>
								<div class="hidden-lg hidden-md hidden-sm col-xs-4 remove-product clearright" style="padding-right: 0px; padding-left: 0px; left: 90px; bottom: 80px;">
                                        <a href="#" data-id="<?php echo $item['id']; ?>" id="removeCartItemMobile" attributeId="<?php echo $item['product_attribute_id']; ?>">
                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close.png" class="close-btn" style="width: 25px;">
                                        </a>
								</div>
                            </div>
                            <div class="col-lg-12 hidden-md hidden-sm shopping-bag product separator clearleft clearright"></div>
                        </div>
                    </div>
                    <?php
                    $count++;
                }
                ?>
            <?php } ?>
            <div class="row order-total margin-top-5">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-6 col-md-offset-6 col-sm-offset-6">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 shopping-bag item-total remove-padding text-gotham-light">
                        TOTAL
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 shopping-bag item-total currency remove-padding text-gotham-light">
                        IDR
                    </div>
                    <div id="item-total" class="col-lg-5 col-md-5 col-sm-5 col-xs-4 lspace2 shopping-bag item-total value clearright remove-padding text-gotham-light">
                        <?php echo common\components\Helpers::getPriceFormat($grandTotal); ?>
                    </div>
                </div>
            </div>
            <div class="row margin-top-3">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-6 col-md-offset-6 col-sm-offset-6">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 shopping-bag shipping remove-padding text-gotham-light">
                        BIAYA PENGIRIMAN
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 shopping-bag item-total currency remove-padding text-gotham-light">
                        IDR
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-4 shopping-bag item-total value right clearright remove-padding text-gotham-light">
                        0
                    </div>
                </div>
            </div>
            <div class="row margin-top-10">
                <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12 col-lg-offset-6 col-md-offset-6 col-sm-offset-5">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 shopping-bag grand-total remove-padding text-gotham-medium">
                        TOTAL PEMBELIAN
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-2 col-xs-3 shopping-bag grand-total currency remove-padding text-gotham-medium">
                        IDR
                    </div>
                    <div id="total-purchase" class="col-lg-5 col-md-5 col-sm-4 col-xs-4 shopping-bag grand-total purchase clearright remove-padding text-gotham-medium">
                        <?php echo common\components\Helpers::getPriceFormat($grandTotal); ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-12 col-xs-12 hidden-md hidden-sm shopping-bag product separator clearleft clearright"></div>
        </div>
        <div class="row shopping-bag footer">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag footer clearleft clearright remove-padding">
                <a href="http://thewatch.co" class="continue">LANJUT BELANJA</a>
                <a href="<?php echo \yii\helpers\Url::base() . '/cart/checkout/sign-in' ?>" class="checkout">LANJUT KE PEMBAYARAN</a>
            </div>
        </div>
    </div>
</section>

<script>

    function edit_quantity(id, action) {
        $.ajax({
            type: "POST",
            url: 'checkout/editquantity',
            data: {
                'count_id': id,
                'action': action
            },
            dataType: "json",
            success: function (data) {
                if (data[3] == 'overload_minus') {
                    $('span#item-quantity-' + id).empty();
//                    $('#item-price-' + id).empty();
                    $('#item-total').empty();
                    $('#total-purchase').empty();

                    $("span#item-quantity-" + id).text(data[0]);
//                    $("#item-price-" + id).text(data[1]);
                    $("#item-total").text(data[2]);
                    $("#total-purchase").text(data[2]);
                }
                else if (data[0] != 'minus' && data[0] != 'overload') {
                    $('span#item-quantity-' + id).empty();
//                    $('#item-price-' + id).empty();
                    $('#item-total').empty();
                    $('#total-purchase').empty();

                    $('#overload-quantity-' + id).fadeOut();

                    $("span#item-quantity-" + id).text(data[0]);
//                    $("#item-price-" + id).text(data[1]);
                    $("#item-total").text(data[2]);
                    $("#total-purchase").text(data[2]);
                }
            }
        });
    }

</script>