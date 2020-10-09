<?php



use yii\web\Session;



$sessionOrder = new Session();

$customerInfo = $sessionOrder->get("customerInfo");

$cart = $sessionOrder->get("cart");



$grandTotal = 0;



$items = $cart['items'];



if (count($items) > 0) {

    foreach ($items as $item) {

        $grandTotal += $item['total_price'];

    }

}



$weight = \common\components\Helpers::generateWeightOrder($items);



$totalItems = count($cart['items']);



//print_r($_SESSION); 

if(isset($_SESSION['voucherInfo'])){

                    unset($_SESSION['voucherInfo']);

                }

if(isset($_SESSION['customerInfo']['shippingMethod'])){

                    unset($_SESSION['customerInfo']['shippingMethod']);

                }

?>





<!--<script async="true" src="//ssp.adskom.com/tags/third-party-async/OTQwMDUxOTQtMTNhZi00ODY3LThmZGMtNjJhM2FkNTQzOGM5"></script>-->



<script>

var dataLayer = [],

    items = [];



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

            "step": 2

          },

          "products": items,

        }

      }

    });

}

</script>

<section id="">

    <div class="container">

        

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag clearleft clearright">

                <div class="col-xs-12 remove-padding padding-top-2 padding-bottom-2 clearleft clearright">

                    <div class="hidden-xs col-lg-2 col-md-2 col-sm-2 gotham-light shopping-bag clearleft ">

                        PRODUK

                    </div>

                    <div class="hidden-xs col-lg-4 col-md-4 col-sm-4 col-xs-4 gotham-light shopping-bag remove-padding ">

                        DESKRIPSI PRODUK

                    </div>

                    <div class="hidden-xs col-lg-2 col-md-2 col-sm-2 col-xs-4 gotham-light shopping-bag remove-padding quantity ">

                        JUMLAH

                    </div>

                    <div class="hidden-xs col-lg-2 col-md-2 col-sm-2 col-xs-4 gotham-light shopping-bag unit-price remove-padding unit-price ">

                        HARGA PRODUK

                    </div>

                    <div class="hidden-xs col-lg-2 col-md-2 col-sm-2 col-xs-4 gotham-light shopping-bag unit-price remove-padding unit-price ">

                        HAPUS

                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-12 col-xs-12 hidden-md hidden-sm shopping-bag product separator clearleft clearright" style="padding-top: 1%;"></div>

        </div>

        <?php if($sessionOrder->get("cart") == null){ ?>

         <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag clearleft clearright" style="text-align: center;padding-top: 20px;padding-bottom: 20px;">

                

                        KERANJA BELANJA KOSONG

            

            </div>

        </div>

        <div class="row">

            <div class="col-lg-12 col-xs-12 hidden-md hidden-sm shopping-bag product separator clearleft clearright" style="padding-top: 1%;"></div>

        </div>

        <div class="row">

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 shopping-bag clearleft clearright" style="text-align: center;padding-top: 20px;padding-bottom: 20px;">

                

                        <a href="<?php echo \yii\helpers\Url::base(); ?>" class="shipping-information lanjut position-left" style="width:100%;text-align: center;">LANJUT BELANJA</a>

            

            </div>

        </div>

        <?php } ?>

        <?php if ($cart == NULL || empty($cart) || $cart == '') { ?>



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

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag clearleft clearright margin-top-5 padding-bottom-5 remove-padding">

                                <div id="overload-quantity-<?php echo $count; ?>" class="text-center" style="<?php echo $check_stock['quantity'] < $item['quantity'] ? "" : "display: none;" ?> width: 100%; background-color: #e0e0e0; padding-top: 1%; padding-bottom: 1%">We apologize the selected item doesnt have enough stock, please update the item quantity.</div>

                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 shopping-bag img-shopping-bag shopping-bag-padding clearleft">

                                    <img src="<?php echo $item['image']['url']; ?>" class="img-responsive">

                                    <!-- <div class="hidden-lg hidden-md hidden-sm text-gotham-medium margin-top-10 font-size-8">

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

                                    </div> -->

                                </div>





                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-7 shopping-bag shopping-bag-margin">

                                    <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 gotham-light lspace2 shopping-bag product-name clearleft shopping-bag-padding" style="font-family: 'gotham-light';color:#a6aaad;">

                                        <?php echo strtoupper($item['brand_name']); ?>

                                    </div>

                                    <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 gotham-light shopping-bag brand-name clearleft shopping-bag-padding">

                                        <?php echo $item['name']; ?>

                                    </div>

                                    <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 shopping-bag separator clearleft shopping-bag-padding"></div>

                                    <div class="col-xs-12 hidden-md hidden-sm hidden-lg shopping-bag separator clearleft shopping-bag-padding" style="margin-top: 10px;"></div>

                                    <div class="col-xs-12 hidden-lg hidden-sm hidden-md shopping-bag spesification clearleft shopping-bag-padding">

                                        IDR <?php echo common\components\Helpers::getPriceFormat($item['unit_price']); ?>

                                    </div>

                             

                                    <div class="col-xs-12 hidden-md hidden-sm hidden-lg shopping-bag separator clearleft shopping-bag-padding" style="margin-top: 10px;"></div>

                                    <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 shopping-bag spesification clearleft shopping-bag-padding">

                                        <?php echo $item['color'] !== '' ? 'Warna : ' . $item['color'] . '<br>' : ''; ?>

                                    </div>

                                    <div class="hidden-md hidden-sm hidden-lg col-xs-12 shopping-bag spesification clearleft shopping-bag-padding">

                                        <?php echo $item['color'] !== '' ? '' . $item['color'] . ' / ' : ''; ?><?php echo 'Qty '; ?><span id="item-quantity-mob-<?php echo $count ?>" style=""><?php echo $item['quantity']; ?></span>

                                    </div>

                                    <div class="col-xs-12 hidden-md hidden-sm hidden-lg shopping-bag separator clearleft shopping-bag-padding" style="margin-top: 10px;"></div>

                                    <div class="hidden-lg hidden-md hidden-sm col-xs-12 shopping-bag remove-padding shopping-bag-margin">

                                        <div id="item-quantity-<?php echo $count ?>" class="col-lg-12 col-md-12 col-sm-12 col-xs-6 shopping-bag product-qty remove-padding clearleft clearright">

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

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6 shopping-bag remove-padding clearleft clearright" style="float:right;margin-top: 15%;text-align: right;">

                                            <a href="#" data-id="<?php echo $item['id']; ?>" id="removeCartItemMobile" attributeId="<?php echo $item['product_attribute_id']; ?>">

                                               <span style="text-decoration: underline;">Remove</span>

                                            </a>

                                        </div>

                                    </div>

                                    



                                </div>



                                <div class="hidden-xs col-lg-2 col-md-2 col-sm-2 shopping-bag remove-padding shopping-bag-margin">

                                    <div id="item-quantity-<?php echo $count ?>" class="col-lg-12 col-md-12 col-sm-12 col-xs-4 shopping-bag product-qty remove-padding clearleft clearright" style="text-align: left;">

                                        <a style="cursor: pointer" onclick="edit_quantity(<?php echo $count . ", 'minus'"; ?>)">-</a>

                                        &nbsp; <span id="item-quantity-<?php echo $count ?>" style="border:solid 1px;padding:10px;"><?php echo $item['quantity']; ?></span> &nbsp;

                                        <a style="cursor: pointer" onclick="edit_quantity(<?php echo $count . ", 'plus'"; ?>)">+</a> 

                                    </div>

<!--                                    <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 shopping-bag product-qty">

                                         / 

                                    </div>-->

                                </div>



                                



                                <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs shopping-bag clearright remove-padding shopping-bag-margin">

                                    <div id="item-price-<?php echo $count ?>" class="col-lg-8 col-md-8 col-sm-8 remove-padding lspace2 shopping-bag total-price product-price-cart clearright text-gotham-medium clearleft clearright" style="text-align: center;">

                                        <?php echo common\components\Helpers::getPriceFormat($item['unit_price']); ?>

                                    </div>

                                    

                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 shopping-bag clearright remove-padding shopping-bag-margin">

                                    

                                    <div class="hidden-xs col-lg-4 col-md-4 col-sm-4 remove-product clearright clearleft clearright" style="text-align: center;">

                                        <a href="#" data-id="<?php echo $item['id']; ?>" id="removeCartItem" attributeId="<?php echo $item['product_attribute_id']; ?>">

                                           <span style="text-decoration: underline;">Remove</span>

                                        </a>

                                    </div>

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

            <div class="row order-total delivery-list-padding hidden-lg hidden-sm hidden-md" style="background-color: #f5f5f5;margin-bottom: 10px;">

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 clearleft ">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-medium clearleft" style="padding-top: 5px;">

                       Sub Total

                    </div>

                </div>



                  

                 <div class="col-lg-9 col-md-9 col-sm-9 col-xs-6">       

                     <div id="item-total1" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-medium clearleft" style="padding-top: 5px; text-align: right;">

                     <?php

                            $items = $cart['items'];

                            if (count($items) > 0) {

                                $grandTotal = 0;

                                foreach ($items as $item) {

                                    $grandTotal += $item['total_price'];

                                }

                                ?>

                               

                                <?php echo 'IDR ' . \common\components\Helpers::getPriceFormat($grandTotal); ?>

                              

<?php } ?>

                        

                    </div>

                </div>              

            </div>

            <div class="row order-total delivery-list-padding hidden-lg hidden-sm hidden-md" style="background-color: #f5f5f5;margin-bottom: 10px;">

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 clearleft clearright-mobile">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-medium clearleft" style="padding-top: 10px;">

                       <img class="img-bulkhead freeshiping img-top" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/free1.jpg" style="width: 35px;">

                    </div>

                </div>



                  

                 <div class="col-lg-9 col-md-9 col-sm-9 col-xs-10" style="color:#206167;"> 

                    <div id="item-total1" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-medium clearleft" style="padding-top: 10px;font-size: 12px;">

                     FREE SHIPPING

                    </div>      

                     <div id="item-total1" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-light clearleft" style="padding-top: 10px;font-size: 10px;">

                     We offer free shipping to every city in Indonesia.

                    </div>

                    <div id="item-total1" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 free-shipping remove-padding gotham-light clearleft" style="padding-top: 10px;font-size: 10px;text-decoration: underline;">

                     More info

                    </div>

                </div>              

            </div>

            <div class="row order-total delivery-list-padding hidden-lg hidden-sm hidden-md" style="background-color: #f5f5f5;margin-bottom: 10px;">

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 clearleft clearright-mobile">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-medium clearleft" style="padding-top: 10px;">

                       <img class="img-bulkhead freeshiping img-top" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/free.jpg" style="width: 35px;">

                    </div>

                </div>



                  

                 <div class="col-lg-9 col-md-9 col-sm-9 col-xs-10" style="color:#206167;"> 

                    <div id="item-total1" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-medium clearleft" style="padding-top: 10px;font-size: 12px;">

                     LIFETIME BATTERY

                    </div>      

                     <div id="item-total1" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-light clearleft" style="padding-top: 10px;font-size: 10px;">

                     You are entitled to a lifetime battery warranty when you purchase our watch.

                    </div>

                    <div id="item-total1" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 lifetime-bateray remove-padding gotham-light clearleft" style="padding-top: 10px;font-size: 10px;text-decoration: underline;">

                     More info

                    </div>

                </div>              

            </div>

            <div class="row order-total delivery-list-padding hidden-lg hidden-sm hidden-md" style="background-color: #f5f5f5;margin-bottom: 10px;">

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 clearleft clearright-mobile">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-medium clearleft" style="padding-top: 10px;">

                       <img class="img-bulkhead freeshiping img-top" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/insta.jpg" style="width: 35px;">

                    </div>

                </div>



                  

                 <div class="col-lg-9 col-md-9 col-sm-9 col-xs-10" style="color:#206167;"> 

                    <div id="item-total1" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-medium clearleft" style="padding-top: 10px;font-size: 12px;">

                     0% INSTALLMENT

                    </div>      

                     <div id="item-total1" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-light clearleft" style="padding-top: 10px;font-size: 10px;">

                     Enjoy 0% installment payment when you shop with us.

                    </div>

                    <div id="item-total1" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 installments remove-padding gotham-light clearleft" style="padding-top: 10px;font-size: 10px;text-decoration: underline;">

                     More info

                    </div>

                </div>              

            </div>

            <div class="col-xs-12 hidden-md hidden-sm hidden-lg border-bottom-1" style="padding-top: 10px;"></div>

            <div class="row order-total delivery-list-padding" style="">

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 clearleft">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item-total remove-padding gotham-light clearleft" style="padding-top: 10px;">

                        Kode Voucher

                    </div>

                </div>



                    <div class="col-xs-12 hidden-md hidden-sm hidden-lg shopping-bag separator clearleft shopping-bag-padding" style="margin-top: 10px;"></div>

                    <div class="col-xs-12 hidden-md hidden-sm hidden-lg shopping-bag separator clearleft shopping-bag-padding" style="margin-top: 10px;"></div>

                 <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">       

                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12 right clearleft clearright">

                            <input class="email" type="text" name="code" style="text-transform:uppercase;height: 36px;border: solid 1px #c2b9b4;" placeholder="Masukan Kode Promo">

                        </div>

                        <div class="col-xs-12 hidden-md hidden-sm hidden-lg shopping-bag separator clearleft shopping-bag-padding" style="margin-top: 10px;"></div>

                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12 clearright">

                            <a href="#" onclick="edit_voucher()" id="apply-code" class="ipad add-shipping col-xs-12 clearright" style="">GUNAKAN</a>

                            <!--<input type="submit" class="apply" value="APPLY">-->

                        </div>

                </div>

                <div class="hidden-lg hidden-sm hidden-md col-xs-6 mtop2">

                                <span class="voucher-message gotham-light" style="color: red;"></span>

                            </div>

                <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearleft clearright remove-padding margin-top-3 margin-bottom-5 padding-bottom-5 ipad">

                            

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6 mtop2 clearleft clearright remove-padding">

                                <span class="voucher-message gotham-light" style="color: red;"></span>

                            </div>

                        </div>

                        <div class="col-lg-12 hidden-xs hidden-sm clearleft clearright remove-padding">

                            <span class="gotham-light fsize-0-95 italic">Jika Tidak Ada Kode Promo, Lewatkan Tahap Ini</span>

                        </div>

            

               

            </div>

            <div class="col-xs-12 hidden-md hidden-sm hidden-lg border-bottom-1"></div>

            

            <div class="row">

                <div class="col-lg-12 col-xs-12 hidden-md hidden-sm shopping-bag product separator clearleft clearright" style="padding-top: 1%;"></div>

            </div>

            <div class="row order-total margin-top-5 delivery-list-padding" style="">

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 clearleft">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item-total remove-padding gotham-light clearleft">

                        Informasi Pengiriman

                    </div>

                    

                </div>

                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">

                    <?php if (count($shippingInformation) > 0) { ?>

                <?php $i = 0; ?>

                <?php $shippingSelectedId = 0; ?>

                    <?php foreach ($shippingInformation as $shipping) { ?>

                        <?php 

                            // if user not never select shipping address

                            if($i == 0 && !isset($customerInfo['shippingMethod'])) {  

                                $shippingSelectedId = $shipping['customer_address_id'];

                            }

                            

                            // if user has already selected shipping address

                            if(isset($customerInfo['shippingMethod']['customer_address_id']) && $customerInfo['shippingMethod']['customer_address_id'] == $shipping['customer_address_id']){

                                $shippingSelectedId = $shipping['customer_address_id'];

                            }

                            

                        ?>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 step-purchase shipping box clearleft remove-padding text-gotham-light" style="padding-top: 0px;padding-bottom: 40px;">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase shipping clearleft clearright remove-padding">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase shipping customer-name clearleft">

                                    <div class="radio-btn">

                                        <input type="radio" <?php if($i == 0 && !isset($customerInfo['shippingMethod'])) { echo 'checked="checked"'; } ?> <?php echo isset($customerInfo['shippingMethod']['customer_address_id']) && $customerInfo['shippingMethod']['customer_address_id'] == $shipping['customer_address_id'] ? "checked='checked'" : ""; ?> value="<?php echo $shipping['customer_address_id']; ?>" id="<?php echo $shipping['customer_address_id']; ?>" name="shipping">

                                        <label for="<?php echo $shipping['customer_address_id']; ?>" class="black-style" onclick="" style="color: #000;font-size: 12px;line-height: 20px;padding-left: 14px;">

                                            <?php echo $shipping['fname'] . ' ' . $shipping['lname']; ?> <br>

                                            <?php echo $shipping['address']; ?> <br>

                                            <?php echo $shipping['phone']; ?> <br>

                                            <?php echo isset($shipping['email']) ? $shipping['email'] : ''; ?>

                                        </label>

                                    </div>

                                </div>

<!--                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft remove-padding-left">

                                    <input type="radio" name="shipping" value="<?php // echo $shipping['customer_address_id']; ?>">

                                </div>

                                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 step-purchase shipping customer-name">

                                    <?php // echo $shipping['fname'] . ' ' . $shipping['lname']; ?> <br>

                                    <?php // echo $shipping['address']; ?> <br>

                                    <?php // echo $shipping['phone']; ?> <br>

                                    <?php // echo isset($shipping['email']) ? $shipping['email'] : ''; ?>

                                </div>-->

                            </div>

                        

                            <div class="col-xs-1 hidden-lg hidden-md hidden-sm"></div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 col-lg-offset-1 col-md-offset-2 col-sm-offset-2 clearleft" style="font-size: 12px;">

                                <a class="underline text-underline" href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/editaddress/<?php echo $shipping['customer_address_id'] ?>">Edit</a>

                            </div>

                            <?php if(count($shippingInformation) != 1){ ?>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 center" style="font-size: 12px;">

                                <a class="underline text-underline" href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/deleteaddress/<?php echo $shipping['customer_address_id'] ?>">Remove</a>

                            </div>

                            <?php } ?>

<!--                            <div class="hidden-xs col-lg-7 col-md-7 col-sm-7 center">

                                <a class="underline" href="<?php // echo \yii\helpers\Url::base(); ?>/cart/checkout/step/deliveryform">TAMBAH ALAMAT BARU</a>

                            </div>-->

                        </div>

                        <?php $i++; ?>

                    <?php } ?>

                <?php } ?>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase shipping box clearleft clearright remove-padding" style="padding-top: 10px;">

                        <a href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/step/deliveryform" class="shipping-information ipad add-shipping position-left col-lg-4 col-md-5 col-sm-5 col-xs-4" style="text-align: center;">TAMBAH ALAMAT BARU</a>

                    </div>

                </div>

            </div>

            <div class="col-xs-12 hidden-md hidden-sm hidden-lg border-bottom-1"></div>

            

            <?php if ($shippingMethodName == '') { ?>

                    <div class="row">

                        <div class="col-lg-12 col-xs-12 hidden-md hidden-sm shopping-bag product separator clearleft clearright" style="padding-top: 1%;"></div>

                    </div>

                    <div class="row order-total delivery-list-padding" style="">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase shipping customer-name clearleft clearright remove-padding  text-gotham-light padding-bottom-3 margin-bottom-5 ipad-1024">

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 clearleft step-purchase shipping customer-name" style="line-height: 40px;">

                                Metode Pengiriman

                            </div>

                     

                            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 clearright step-purchase shipping-method">

                                <select class="shipping" id="shipping-method" name="shipping" onchange="shipping_method();" style="height:40px;border:solid 1px #c2b9b4;background-color: #f5f5f5;">

                                    <option value="0" selected="selected">Pilih Metode Pengiriman</option>

                                    <?php 

                                    

                                    $district = \backend\models\CustomerAddress::findOne(['customer_address_id' => $shippingSelectedId]);

                                    $carriers = \backend\models\CarrierCost::findAll(['active' => 1, "district_id" => $district->district_id]);

                                    

                                    ?>

                                    <?php if(count($carriers) > 0) { ?>

                                    <?php foreach ($carriers as $carrier) { ?>

                                    <?php //if((int)$carrier->price !== 0) { ?>

                                   

                                       <?php if($carrier->carrierPackageDetail->carrierPackage->carrier_package_name == 'REGULER'){

                                    ?>

                                        <option value="<?php echo $carrier->carrier_cost_id; ?>"><?php echo $carrier->carrier->name . ' - ' . $carrier->carrierPackageDetail->carrierPackage->carrier_package_name . ' - (' . $carrier->day . ' days)'; ?></option>

                                        <?php 

                                        // flat price if customer upgrade shipping service

                                        } elseif($carrier->carrierPackageDetail->carrierPackage->carrier_package_name == 'YES'){ 

                                            $provinceId = backend\models\CustomerAddress::findOne(['customer_address_id' => $customerAddressId])->province_id;

                                            $flatPrice = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 3])->price;

                                        ?>

                                        <option value="<?php echo $carrier->carrier_cost_id; ?>"><?php echo $carrier->carrier->name . ' - ' . $carrier->carrierPackageDetail->carrierPackage->carrier_package_name . ' - (' . $carrier->day . ' days)'; ?></option>

                                        <?php } else { } ?>

                                        

                                        

                                 

                                   

                                    <?php //} ?>

                                    <?php } ?>

                                    <?php } ?>

                                </select>

                            </div>

                        </div>

                    </div>

                <?php } ?>

                

            

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft-mobile clearleft signup-error" style="display: none;">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft-mobile clearleft">

                        <span id="signup-error">* Please Select Shipping Method</span>

                    </div>

                </div>

                <div class="col-xs-12 hidden-md hidden-sm hidden-lg border-bottom-1"></div>

            <div class="row">

                <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12 shopping-bag product separator clearleft clearright" style="padding-top: 1%;"></div>

            </div>



            

            



            <div class="row order-total margin-top-5">

                <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 clearright clearleft">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item-total remove-padding gotham-light clearleft" style="padding-top: 10px;">

                        Detail Pembayaran

                    </div>

                        

               

                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 clearright">

                    

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearright-mobile clearleft-mobile" style="padding-top: 10px;">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-medium clearright-mobile clearleft-mobile">

                            Sub Total

                        </div>

                        <div id="item-total" class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright clearright-mobile clearleft-mobile" style="text-align: right;">

                            <?php

                            $items = $cart['items'];

                            if (count($items) > 0) {

                                $grandTotal = 0;

                                foreach ($items as $item) {

                                    $grandTotal += $item['total_price'];

                                }

                                ?>

                                <?php echo 'IDR ' . \common\components\Helpers::getPriceFormat($grandTotal); ?>

<?php } ?>

                        </div>

                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearright-mobile clearleft-mobile" style="padding-top: 10px;">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-medium clearright-mobile clearleft-mobile">

                            Diskon

                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright clearright-mobile clearleft-mobile" style="text-align: right;">

                            <span id="discount">

                                <?php echo $discount == 0 ? '-' : common\components\Helpers::getPriceFormat($discount); ?>

                            </span>

                        </div>



                    </div>

                    

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearright-mobile clearleft-mobile" style="padding-top: 10px;">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-medium clearright-mobile clearleft-mobile">

                            Ongkir

                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright clearright-mobile clearleft-mobile" style="text-align: right;">

                            <span id="ongkir">

                            <?php $grandTotal = $grandTotal - $discount; ?>

                                <?php 

                                    $customerInfo = $sessionOrder->get("customerInfo");



                                    if (isset($customerInfo['shippingMethod'])) {

                                        $info = \backend\models\CustomerAddress::findOne(['customer_address_id' => $customerInfo['shippingMethod']['customer_address_id']]);

                                        $shippingCost = \backend\models\CarrierCost::findOne(['carrier_cost_id' => $_SESSION['customerInfo']['shippingMethod']['shipping_method']]);

                                        

                                        $weight = \common\components\Helpers::generateWeightOrder($items);



                                        $shippingPrice = 0;

                                        // if shopping total condition more than 3 milion IDR

                                        // get free all shipping method service

                                        if($grandTotal >= 3000000) { 

                                            echo 'FREE';

                                        } elseif($grandTotal >= 1000000 && $grandTotal < 3000000) { 

                                            // free shipping for regular shipping service

                                            if($shipment->carrierPackageDetail->carrierPackage->carrier_package_name == 'REGULER'){

                                                echo 'FREE';

                                            } elseif($shipment->carrierPackageDetail->carrierPackage->carrier_package_name == 'YES'){ 

                                                $provinceId = backend\models\CustomerAddress::findOne(['customer_address_id' => $customerInfo['shippingMethod']['customer_address_id']])->province_id;

                                                $flatPrice = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 3])->price;

                                                echo \common\components\Helpers::getPriceFormat($flatPrice * $weight); 

                                                $shippingPrice = $flatPrice * $weight;

                                            } else {

                                                echo \common\components\Helpers::getPriceFormat($shippingCost['price'] * $weight); 

                                                $shippingPrice = $shippingCost['price'] * $weight;

                                            }

                                        } elseif($grandTotal < 1000000){

                                            if($shipment->carrierPackageDetail->carrierPackage->carrier_package_name == 'REGULER'){

                                                $provinceId = backend\models\CustomerAddress::findOne(['customer_address_id' => $customerInfo['shippingMethod']['customer_address_id']])->province_id;

                                                $flatPrice = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 1])->price;

                                                echo \common\components\Helpers::getPriceFormat($flatPrice * $weight); 

                                                $shippingPrice = $flatPrice * $weight;

                                            } elseif($shipment->carrierPackageDetail->carrierPackage->carrier_package_name == 'YES'){ 

                                                $provinceId = backend\models\CustomerAddress::findOne(['customer_address_id' => $customerInfo['shippingMethod']['customer_address_id']])->province_id;

                                                $flatPrice = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 3])->price;

                                                echo \common\components\Helpers::getPriceFormat($flatPrice * $weight); 

                                                $shippingPrice = $flatPrice * $weight;

                                            } else {

                                                echo \common\components\Helpers::getPriceFormat($shippingCost['price'] * $weight); 

                                                $shippingPrice = $shippingCost['price'] * $weight;

                                            }

                                        }else {

                                            echo \common\components\Helpers::getPriceFormat($shippingCost['price'] * $weight);

                                            $shippingPrice = $shippingCost['price'] * $weight;

                                        }

                                    }else{

                                        echo '-';

                                    }

                                    

                                ?>

                            </span>

                        </div>

                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright" style="border-bottom: solid 1px #545454;padding-bottom: 10px;">

                      

                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearright-mobile clearleft-mobile" style="padding-top: 10px;">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-medium clearright-mobile clearleft-mobile">

                            Grand Total

                        </div>

                        <div id="total-purchase" class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright gotham-medium clearright-mobile clearleft-mobile" style="text-align: right;">

                            IDR <?php echo \common\components\Helpers::getPriceFormat($grandTotal - $discount + $shippingPrice); ?>

                        </div>

                    </div>

                    

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase shipping box clearleft clearright remove-padding padding-top-5 margin-top-3">

                       

                        <a href="#" id="delivery-list" onclick="delivery_list()" class="editpay ipad" style="width: 100%;text-align: center;">KONFIRMASI PESANAN</a>

                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase shipping box clearleft clearright remove-padding padding-top-2 margin-top-1">

                        <a href="<?php echo \yii\helpers\Url::base(); ?>" class="shipping-information lanjut position-left" style="width:100%;text-align: center;">LANJUT BELANJA</a>

                    

                    </div>

            </div>

            </div>

           

        <?php } ?>

        <div class="row">

            

        </div>

        

    </div>

</section>

<style type="text/css">

    a.shipping-information.lanjut{

        background:#c2b9b4;

        color:#fff;

    }

    a.shipping-information.lanjut:hover{

        background:#fff;

        color:#c2b9b4;

    }

</style>

<script>



    function edit_quantity(id, action) {

        $.ajax({

            type: "POST",

            url: baseUrl + '/cart/checkout/editquantity',

            data: {

                'count_id': id,

                'action': action

            },

            dataType: "json",

            success: function (data) {

                if (data[3] == 'overload_minus') {

                    $('span#item-quantity-' + id).empty();

                    $('span#item-quantity-mob-' + id).empty();

//                    $('#item-price-' + id).empty();

                    $('#item-total').empty();

                    $('#item-total1').empty();

                    $('#total-purchase').empty();

                    $('span#ongkir').empty();



                    $("span#item-quantity-" + id).text(data[0]);

                    $("span#item-quantity-mob-" + id).text(data[0]);

//                    $("#item-price-" + id).text(data[1]);

                    $("#item-total").text('IDR '+data[2]);

                    $("#item-total1").text(data[2]);

                    $("#total-purchase").text('IDR '+data[2]);

                    $('span#ongkir').text('IDR ' + data[4]);

                }

                else if (data[0] != 'minus' && data[0] != 'overload') {

                    $('span#item-quantity-' + id).empty();

                    $('span#item-quantity-mob-' + id).empty();

//                    $('#item-price-' + id).empty();

                    $('#item-total').empty();

                    $('#item-total1').empty();

                    $('#total-purchase').empty();

                    $('span#ongkir').empty();



                    $('#overload-quantity-' + id).fadeOut();



                    $("span#item-quantity-" + id).text(data[0]);

                    $("span#item-quantity-mob-" + id).text(data[0]);

//                    $("#item-price-" + id).text(data[1]);

                    $("#item-total").text('IDR '+data[2]);

                    $("#item-total1").text(data[2]);

                    $("#total-purchase").text('IDR '+data[2]);

                    $('span#ongkir').text('IDR ' + data[4]);

                }

            }

        });

    }

    function edit_voucher() {



    // e.preventDefault();



    var code = $('input[name=code]').val();

    var total = $('#total-purchase');



    $.ajax({

        type: "POST",

        dataType: "json",

        url: baseUrl + '/cart/voucher/check',

        data: {"code": code},

        beforeSend: function () {



        },

        success: function (data) {

//            console.log(data);

            var d = data;

            if (d.valid) {

                $('span#discount').html(d.currency + ' ' + d.discount);

                $('#total-purchase').html(d.currency + ' ' + d.total);



                grossamount = d.total;

                grossamount = d.total.split('.').join("");

            } else {

                $('span.voucher-message').html(d.message);

            }

        }

    });



};



    function delivery_list() {



    if ($('input:radio:checked').length > 0 && $('select#shipping-method option:selected').val() != 0) {

        var customer_address_id = $('input:radio:checked')[0].value;



        $('div.signup-error').hide();



        $.ajax({

            type: "POST",

            url: baseUrl + '/cart/checkout/shipping-submit',

            data: {"customer_address_id": customer_address_id, "shipping_method": $('select#shipping-method').length ? $('select#shipping-method option:selected').val() : 0},

            beforeSend: function () {

                $('#loadingScreen').modal('show');

            },

            success: function (data) {

                $('#loadingScreen').modal('hide');

                window.location.href = baseUrl + '/cart/checkout/step/paymentinformation';

            }

        });



        return;



    } else {

        $('div.signup-error').show();

    }







};



    function shipping_method() {



    var selectBox = document.getElementById("shipping-method");

    var selectedValue = selectBox.options[selectBox.selectedIndex].value;

    // var item_total = $('#item-total').html;

    // var total = $('#total-purchase').html;

    // var discount = $('#discount').html;

    if ($('input:radio:checked').length > 0 && $('select#shipping-method option:selected').val() != 0) {

        var customer_address_id = $('input:radio:checked')[0].value;

    $.ajax({

        type: "POST",

        dataType: "json",

        url: baseUrl + '/cart/checkout/shippingmethod',

        data: {"id_select": selectedValue, "customer_address_id": customer_address_id, "shipping_method": $('select#shipping-method').length ? $('select#shipping-method option:selected').val() : 0},

        beforeSend: function () {



        },

        success: function (data) {

//            console.log(data);

            var d = data;

            if (d.valid) {

                $('span#ongkir').html(d.currency + ' ' + d.shipping_price);

                $('#total-purchase').html(d.currency + ' ' + d.total);



                // grossamount = d.total;

                // grossamount = d.total.split('.').join("");

                // alert(d.shipping_price);

            } else {

                // $('span.voucher-message').html(d.message);

            }

        }

    });

    }else{

        $('div.signup-error').show();

    }



};



</script>



<script>

    $('a#removeCartItem').on('click', function (e) {



        e.preventDefault();



        var id = $(this).attr("data-id"),

                attributeId = $(this).attr("attributeId");



        $.ajax({

            type: "POST",

            url: baseUrl + '/cart/checkout/remove-cart-item',

            data: {"id": id, "attributeId": attributeId},

            beforeSend: function () {



            },

            success: function (data) {

                $("section#shopping-bag").html(data);

            }

        });



        $.ajax({

            type: "POST",

            url: baseUrl + '/cart/checkout/remove-item',

            data: {"id": id, "attributeId": attributeId},

            beforeSend: function () {



            },

            success: function (data) {

                $("div#box-cart").html(data);

            }

        });

    });

</script>