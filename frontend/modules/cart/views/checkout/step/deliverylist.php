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

// set free shipping here
$freeShipping = false;
$now = date('Y-m-d H:i:s');

/*
	Free Shipping
	3 - 10 Mei
	Berlaku untuk pembelian apapun dengan minimum payment Rp 1,000,000,-
	Semua free shipping dialihkan ke service YES
*/
if($grandTotal >= 1000000){
	if($now >= '2019-05-03 00:00:00' && $now <= '2019-05-11 00:00:00'){
		$freeShipping = true;
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
</script>
<section id="" style="padding-bottom: 0;padding-top: 20px;">
    <div class="container">
        
        <div class="row">
            <div class="col-lg-12 col-md-12 hidden-sm hidden-xs shopping-bag clearleft clearright">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/step/step-1.png" class="width100" style="padding-top: 0;">
            </div>
            <div class="hidden-lg hidden-md col-sm-12 col-xs-12 shopping-bag clearleft clearright">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/step/step-1-mobile.png" class="width100" style="padding-top: 0;">
            </div>
            
        </div>
    </div>
</section>
<section id="" style="padding-top: 20px;">
    <div class="container">
        
        <div class="row">
        <style type="text/css">
            
        </style>
        <?php $out_stock = false; ?>
            <div class="table-responsive hidden-xs hidden-sm">         
              <table class="table">
                <tbody>
                  <tr>
                    <td class="rgb243 bradius5 gotham-medium deliverylist-title-table fcolor69">Produk</td>
                    <td width="15"></td>
                    <td class="rgb243 bradius5 gotham-medium deliverylist-title-table fcolor69">Jenis Produk</td>
                    <td width="15"></td>
                    <td class="rgb243 bradius5 gotham-medium deliverylist-title-table fcolor69" width="194">Jumlah</td>
                    <td width="15"></td>
                    <td class="rgb243 bradius5 gotham-medium deliverylist-title-table fcolor69" width="194">Harga Produk</td>
                    <td width="15"></td>
                    <td class="rgb243 bradius5 gotham-medium deliverylist-title-table fcolor69" width="194">Pembatalan</td>
                   
                  </tr>
                  <tr height="15">
                    <!-- Space Line -->
                  </tr>

                <?php if ($cart == NULL) { ?>

                  <tr>
                    <td class="bradius5 gotham-medium deliverylist-title-table" colspan="9">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag clearleft clearright" style="text-align: center;padding-top: 20px;padding-bottom: 20px;">
                
                                    KERANJANG BELANJA KOSONG
                        
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag clearleft clearright" style="text-align: center;padding-top: 20px;padding-bottom: 20px;">
                
                                    <a href="http://www.thewatch.co" class="yellow-round gotham-light" style="width:100%;text-align: center;left: 0;right: 0;margin:auto;letter-spacing: 1px;">Lanjut Belanja</a>
                        
                        </div>
                    </td>
                    
                  </tr>
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
                            <tr style="<?php echo $check_stock['quantity'] < $item['quantity'] ? "" : "display: none;" ?>">
                                <td class="gotham-light" colspan="9" style="padding: 0;"><div id="overload-quantity-<?php echo $count; ?>" class="text-center" style="width: 100%; background-color: #e0e0e0; padding-top: 1%; padding-bottom: 1%">We apologize the selected item doesnt have enough stock, please update the item quantity.</div>
                                    <?php
                                        if($check_stock['quantity'] < $item['quantity']){
                                            $out_stock = true;
                                        }
                                    ?>
                                </td>

                            <tr>
                            <tr>
                                <td class="rgb243 bradius5 gotham-medium deliverylist-title-table deliverylist-img">
                                    <img src="<?php echo $item['image']['url']; ?>" class="img-responsive">
                                </td>
                                <td width="15"></td>
                                <td class="rgb243 bradius5 deliverylist-title-table deliverylist-brand-width fcolor69">
                                    <div class="deliverylist-brand">
                                        <div class="col-lg-12 gotham-light" style="padding-left: 30px;padding-right: 30px;">
                                            <?php echo strtoupper($item['brand_name']); ?>
                                        </div>
                                        <div class="col-lg-12 gotham-medium" style="padding-left: 30px;padding-right: 30px;">
                                            <?php echo strtoupper($item['name']); ?>
                                        </div>
                                        <div class="col-lg-12 gotham-light">
                                            <?php echo $item['color'] !== '' ? 'Warna : ' . $item['color'] : ''; ?>
                                        </div>
                                        <div class="col-lg-12 gotham-light">
                                            <?php echo $item['size'] !== '' ? 'Ukuran : ' . $item['size'] : ''; ?>
                                        </div>
                                    </div>
                                </td>
                                <td width="15"></td>
                                <td class="rgb243 bradius5 gotham-medium">
                                    <div id="item-quantity-<?php echo $count ?>" class="col-lg-12 col-md-12 col-sm-12 col-xs-4 shopping-bag product-qty remove-padding clearleft clearright deliverylist-quantity" style="text-align: left;padding-left: 12px;">
                                        <?php 
                                                            if($item['flash_sale'] == 0){
                                                        ?>
                                        <a style="cursor: pointer" onclick="edit_quantity(<?php echo $count . ", 'minus'"; ?>)">
                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/quantity_minus.png" class="" style="padding-top: 0;">
                                        </a>
                                        <?php }else{ ?>
                                        <span style="padding: 25px;"></span>
                                        <?php } ?>
                                        &nbsp; 
                                        <span id="item-quantity-<?php echo $count ?>" style="border:none;padding:10px;background-repeat:no-repeat;background-size:cover;background-image: url(<?php echo \yii\helpers\Url::base(); ?>/img/icons/quantity_circle.png);padding-top: 15px;padding-bottom: 15px;padding-left: 20px;padding-right: 20px;"><?php echo $item['quantity']; ?></span> 
                                        &nbsp;
                                        <?php 
                                                            if($item['flash_sale'] == 0){
                                                        ?>
                                        <a style="cursor: pointer" onclick="edit_quantity(<?php echo $count . ", 'plus'"; ?>)">
                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/quantity_plus.png" class="" style="padding-top: 0;">
                                        </a> 
                                        <?php }else{ ?>
                                        <span style="padding: 25px;"></span>
                                        <?php } ?>
                                    </div>
                                </td>
                                <td width="15"></td>
                                <td class="rgb243 bradius5 gotham-medium deliverylist-title-table fcolor69">
                                    <div class="deliverylist-price">
                                        <?php echo common\components\Helpers::getPriceFormat($item['unit_price']); ?>
                                    </div>
                                    
                                </td>
                                <td width="15"></td>
                                <td class="rgb243 bradius5 gotham-medium deliverylist-title-table fcolor69">
                                    <div class="deliverylist-remove">
                                        <a class="red-round gotham-light" style="letter-spacing: 1px;font-size: 14px;padding-left: 35px;padding-right: 35px;" href="#" data-id="<?php echo $item['id']; ?>" id="removeCartItemMobile" attributeId="<?php echo $item['product_attribute_id']; ?>">
                                               Hapus
                                            </a>
                                    </div>
                                    
                                </td>
                            </tr>
                            <tr height="15">
                                <!-- Space Line -->
                            </tr>
                        <?php
                            $count++;
                        }
                        ?>
                    <?php } ?>
                <?php } ?>
                  
                </tbody>
               
                
              </table>
            </div>
            <?php if ($cart == NULL) { ?>
            <div class="hidden-lg col-xs-12 col-sm-12">
                        <div class="col-xs-12 clearleft-mobile clearright-mobile">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag clearleft clearright" style="text-align: center;padding-top: 20px;padding-bottom: 20px;">
                
                                        KERANJANG BELANJA KOSONG
                            
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag clearleft clearright" style="text-align: center;padding-top: 20px;padding-bottom: 20px;">
                    
                                        <a href="http://www.thewatch.co" class="yellow-round gotham-light" style="width:100%;text-align: center;left: 0;right: 0;margin:auto;letter-spacing: 1px;">Lanjut Belanja</a>
                            
                            </div>
                        </div>
                    </div>
        <?php } else { ?>
            <?php
            $items = $cart['items'];
            $item_id = 0;
            if (count($items) > 0) {
                $grandTotal = 0;
                $count = 0;
                foreach ($items as $item) {
                    $item_id = $item['id'];
                    $check_stock = \backend\models\ProductStock::find()->where(['product_id' => $item['id'], 'product_attribute_id' => $item['product_attribute_id']])->one();
                    $grandTotal += $item['total_price'];
                    ?>
                    <div class="hidden-lg hidden-md col-xs-12 col-sm-12">
                        <div class="col-xs-12 clearleft-mobile clearright-mobile">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag clearleft clearright margin-top-5 padding-bottom-5 remove-padding">
                                <div id="overload-quantity-<?php echo $count; ?>" class="text-center" style="<?php echo $check_stock['quantity'] < $item['quantity'] ? "" : "display: none;" ?> width: 100%; background-color: #e0e0e0; padding-top: 1%; padding-bottom: 1%">We apologize the selected item doesnt have enough stock, please update the item quantity.</div>
                                <?php
                                    if($check_stock['quantity'] < $item['quantity']){
                                        $out_stock = true;
                                    }
                                ?>
                                <div class="hidden-lg col-md-2 col-sm-4 col-xs-5 shopping-bag img-shopping-bag shopping-bag-padding clearleft">
                                    <img src="<?php echo $item['image']['url']; ?>" class="img-responsive">
                                  
                                </div>


                                <div class="hidden-lg col-md-4 col-sm-5 col-xs-7 shopping-bag shopping-bag-margin clearright-mobile">
                                    <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 gotham-light lspace2 shopping-bag product-name clearleft shopping-bag-padding" style="font-family: 'gotham-light';color:#a6aaad;">
                                        <?php echo strtoupper($item['brand_name']); ?>
                                    </div>
                                    <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 gotham-light shopping-bag brand-name clearleft shopping-bag-padding">
                                        <?php echo $item['name']; ?>
                                    </div>
                                    <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 shopping-bag separator clearleft shopping-bag-padding"></div>
                                    <div class="col-xs-12 hidden-md hidden-sm hidden-lg shopping-bag separator clearleft shopping-bag-padding" style="margin-top: 10px;"></div>
                                    <div class="col-xs-12 hidden-lg col-sm-12 hidden-md shopping-bag spesification clearleft shopping-bag-padding">
                                        IDR <?php echo common\components\Helpers::getPriceFormat($item['unit_price']); ?>
                                    </div>
                             
                                    <div class="col-xs-12 hidden-md hidden-sm hidden-lg shopping-bag separator clearleft shopping-bag-padding" style="margin-top: 10px;"></div>
                                    
                                    <div class="hidden-md col-sm-12 hidden-lg col-xs-12 shopping-bag spesification clearleft shopping-bag-padding">
                                        <?php echo $item['color'] !== '' ? '' . $item['color'] . ' / ' : ''; ?><?php echo 'Qty '; ?><span id="item-quantity-mob-<?php echo $count ?>" style=""><?php echo $item['quantity']; ?></span>
                                    </div>
                                    <div class="col-xs-12 hidden-md hidden-sm hidden-lg shopping-bag separator clearleft shopping-bag-padding" style="margin-top: 10px;"></div>
                                    <div class="hidden-lg hidden-md col-sm-12 col-xs-12 shopping-bag remove-padding shopping-bag-margin">
                                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-6 shopping-bag remove-padding clearleft clearright" style="margin-top: 15px;text-align: right;">
                                            <a href="#" data-id="<?php echo $item['id']; ?>" class="red-round" id="removeCartItemMobile" attributeId="<?php echo $item['product_attribute_id']; ?>" style="float: left;">
                                               Hapus
                                            </a>
                                        </div>
                                        <div id="item-quantity-<?php echo $count ?>" class="col-lg-12 col-md-12 col-sm-6 col-xs-6 shopping-bag product-qty remove-padding clearleft clearright" style="margin-top: 15px;padding-top: 0;">
                                            <select class="qty-mobile" id="quantity-<?php echo $item['id'] . '-' . $item['product_attribute_id']; ?>" onchange="changeQuantity(<?php echo $count . ',' . $item['id'] . ',' . $item['product_attribute_id']; ?>)" style="max-width: 90px;height: 42px;border-radius: 25px;float: right;">
                                                <?php
                                                $productstock = \backend\models\ProductStock::findOne(['product_id' => $item['id'], 'product_attribute_id' => $item['product_attribute_id']]);
                                                if (!empty($productstock) && $productstock['quantity'] > 0) {
                                                    if($item['flash_sale'] == 1){
                                                        $productstock['quantity'] = 1;
                                                    }
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
                                    

                                </div>
                                
                            </div>
                           
                        </div>
                    </div>
                    <?php
                    $count++;
                }
                ?>
            

            <div class="col-lg-6 col-lg-push-6 col-md-6 col-md-push-6 col-sm-12 col-xs-12 fcolor69 shopping-bag deliverylist kode-voucher clearright pdl75" style="">
                <div class="col-xs-12 rgb243 bradius5 remove-padding padding-top-2 padding-bottom-2 clearleft clearright">
                    <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs clearright">
                            
                        <div class="col-lg-12 col-xs-12 gotham-medium fcolor69" style="font-size: 14px;padding-top: 12px;padding-bottom: 7px;">
                            Kode Voucher
                        </div>
                        <div class="col-lg-12 col-xs-12 gotham-light fcolor69" style="font-size: 14px;padding-top: 20px;">
                            <?php 
                                $cart_rule = \backend\models\CartRule::find()->where(['customer_id'=>$_SESSION['customerInfo']['customer_id']])->andWhere(['<>','quantity', 0])->all();
                                if(count($cart_rule) > 0){
                                    
                            ?>
                                <select class="shipping" id="voucher-select" name="voucher" onchange="voucher_select();" style="height:40px;border:solid 1px rgb(158,131,97);border-radius:25px;background-color:rgb(158,131,97);color:#fff;margin-bottom: 10px;padding-left: 10%;">
                                        <option value="" selected="selected">Pilih Voucher</option>
                                        <?php foreach($cart_rule as $cart_rule_row){ ?>
                                            <option value="<?php echo $cart_rule_row->code; ?>">
                                                <?php echo $cart_rule_row->description; ?>
                                            </option>
                                        <?php } ?>   
                                    </select>
                            <?php } ?>
                        </div>
                        <?php if(count($cart_rule) > 0){ ?>
                        <div class="col-lg-12 col-xs-12 gotham-light fcolor69 voucher-text-1" style="padding-top: 18px;">
                            *Gunakan voucher khusus di atas !
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearright">
                        <?php
                            $now = date('Y-m-d H:i:s');
                            
                            if($_SESSION['customerInfo']['customer_id'] == 6181){
                                $now = date('2018-11-11 12:00:00');
                            }
                            $cart_rule = \backend\models\CartRule::find()
                                                ->where(['<=', 'date_from',$now])
                                                ->andWhere(['>=', 'date_to',$now])
                                                ->andWhere(['code'=>'PESTA11'])->one();
                            $cart_rule_product = \backend\models\CartRuleProduct::find()
                                                ->where(['cart_rule_id'=>$cart_rule->cart_rule_id])
                                                ->andWhere(['product_id'=>$item_id])
                                                ->one();
                           
                        ?>
                        <div class="col-lg-12 hidden-xs gotham-light fcolor69 voucher-text-1" style="padding-top: 12px;padding-bottom: 7px;text-align: right;">
                            *lewati jika tidak menggunakan voucher
                            <span class="voucher-message gotham-light" style="color: red;height:17px;width: 100%;left: 0;text-align: center;top: 40px;"></span>
                        </div>
                        <div class="hidden-lg hidden-md hidden-sm col-xs-12 gotham-medium fcolor69 clearleft-mobile clearright-mobile" style="font-size: 14px;">
                            VOUCHER
                        </div>
                        <div class="col-lg-12 col-xs-12 gotham-light fcolor69 input-voucher clearleft-mobile clearright-mobile" style="font-size: 14px;">
                        
                            <input class="email voucher-code" type="text" name="code" style="text-transform:uppercase;height: 36px;border: solid 1px #c2b9b4;height: 40px;border-radius: 25px;border-color: black;text-align: center;" value="<?php echo ($cart_rule_product !=null) ? $cart_rule->code :''; ?>" placeholder="Masukan Kode Promo">
                        </div>
                        <div class="hidden-lg hidden-md hidden-sm col-xs-12 gotham-light fcolor69 clearleft-mobile clearright-mobile" style="font-size: 12px;padding-top: 5px;padding-bottom: 12px;text-align: left;font-style: italic;color: rgb(153,153,153);">
                            *lewati jika tidak menggunakan voucher <br>
                            <span class="voucher-message gotham-light" style="color: red;height:17px;width: 100%;left: 0;text-align: center;"></span>
                        </div>
                        <div class="hidden-lg hidden-md hidden-sm col-xs-12 gotham-light fcolor69 clearleft-mobile clearright-mobile" style="font-size: 14px;">
                            <?php 
                                $cart_rule = \backend\models\CartRule::find()->where(['customer_id'=>$_SESSION['customerInfo']['customer_id']])->andWhere(['<>','quantity', 0])->all();
                                if(count($cart_rule) > 0){
                                    
                            ?>
                                <select class="shipping" id="voucher-select-mobile" name="voucher" onchange="voucher_select_mobile();" style="height:40px;border:solid 1px rgb(158,131,97);border-radius:25px;background-color:rgb(158,131,97);color:#fff;padding-left: 10%;">
                                        <option value="" selected="selected">Pilih Voucher</option>
                                        <?php foreach($cart_rule as $cart_rule_row){ ?>
                                            <option value="<?php echo $cart_rule_row->code; ?>">
                                                <?php echo $cart_rule_row->description; ?>
                                            </option>
                                        <?php } ?>   
                                    </select>
                                    <span class="" style="font-size: 12px;padding-top: 5px;text-align: left;font-style: italic;color: rgb(153,153,153);">*Gunakan voucher khusus di atas !</span>
                            <?php } ?>
                        </div>
                        
                        <div class="col-lg-12 col-xs-12 gotham-light fcolor69 clearleft-mobile clearright-mobile" style="font-size: 14px;padding-top: 12px;">
                            <a onclick="edit_voucher()" id="apply-code" class="blue-round col-xs-12 clearright" style="text-align: center;">Gunakan</a>
                        </div>
                        <?php
                            if($cart_rule_product !=null){
                                ?>
                                <div class="click-voucher"></div>
                                <?php
                            }
                        ?>
                        <div class="hidden-xs col-lg-12 hidden-md col-sm-12 bellow-voucher" style=""></div>
                        <div class="hidden-lg col-md-12 hidden-sm hidden-sm" style="padding-top: 53px;"></div>
                        <div class="hidden-lg hidden-md col-sm-12 col-xs-12" style="padding-top: 10px;"></div>
                    </div>
                </div>

            </div>

            <div class="col-xs-12 hidden-lg hidden-md col-sm-12" style="padding-top: 15px;"></div>

            <div class="col-lg-6 col-lg-pull-6 col-md-6 col-md-pull-6 col-sm-12 col-xs-12 fcolor69 shopping-bag deliverylist clearleft pdr75" style="min-height: 198px;">
                <div class="col-xs-12 rgb243 bradius5 remove-padding padding-top-2 padding-bottom-2 clearleft clearright">
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 clearright clearleft-mobile clearright-mobile">
                        
                        <div class="col-lg-12 col-xs-12  gotham-medium fcolor69" style="font-size: 14px;padding-top: 12px;padding-bottom: 7px;">
                            Tujuan Pengiriman
                        </div>
                        <div class="col-lg-12 col-xs-12  gotham-light fcolor69" id="view-address" style="font-size: 14px">
                            <div class="col-lg-12 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile">
                            <?php
								$customer_address = \backend\models\CustomerAddress::find()->where(['customer_id'=>$customerInfo['customer_id']])->andWhere(['set_as_default'=>1])->one();
								$shippingSelectedId = 0;
								
                                if($customer_address == null){
                                    if(count($shippingInformation) > 0){
                                        echo $shippingInformation[0]['fname'] . ' ' . $shippingInformation[0]['lname'].'<br> ';
                                        echo $shippingInformation[0]['address'] . '<br> ';
                                        echo $shippingInformation[0]['phone'] . '<br> ';
                                        echo $shippingInformation[0]['email'] . '<br> ';
                                        $shippingSelectedId = $shippingInformation[0]['customer_address_id'];
                                    }else{
                                        echo 'Daftar Alamat Belum Tersedia';
                                    }
                                }else{
                                    echo $customer_address->firstname . ' ' . $customer_address->lastname.'<br> ';
                                        echo $customer_address->address1 . '<br> ';
                                        echo $customer_address->phone . '<br> ';
                                        echo $shippingInformation[0]['email'] . '<br> ';
                                        $shippingSelectedId = $customer_address->customer_address_id;
                                }
                            ?>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile">
                            <?php if(count($shippingInformation) > 0){?>
                                <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs clearleft clearleft-mobile clearright-mobile" style="font-size: 12px;padding-top: 10px;height:70px;">
                                    <a style="position: absolute;padding-top: 5px;padding-bottom: 5px;text-align: center;" class="yellow-round address-edit" href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/editaddress/<?php echo $shippingSelectedId; ?>">Edit</a>
                                </div>
                                <?php if(count($shippingInformation) != 1){ ?>
                                <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs center clearleft-mobile clearright-mobile" style="font-size: 12px;padding-top: 10px;height:70px;">
                                    <a style="position: absolute;padding-top: 5px;padding-bottom: 5px;text-align: center;" class="red-round address-remove" href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/deleteaddress/<?php echo $shippingSelectedId; ?>">Hapus</a>
                                </div>
                                <div class="hidden-lg hidden-md hidden-sm col-xs-12 center clearleft-mobile clearright-mobile" style="font-size: 12px;top: -26px;">
                                    <a style="position: absolute;padding-top: 7px;padding-bottom: 5px;width: 92px;text-align: center;height: 33px;" class="red-round address-remove" href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/deleteaddress/<?php echo $shippingSelectedId; ?>">Hapus</a>
                                </div>
                                <?php } ?>
                                <div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft clearleft-mobile clearright-mobile" style="font-size: 12px;margin-top: 20px;">
                                    <a style="position: absolute;padding-top: 7px;padding-bottom: 5px;width: 92px;text-align: center;height: 33px;" class="yellow-round address-edit" href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/editaddress/<?php echo $shippingSelectedId; ?>">Edit</a>
                                </div>
                            <?php } ?>

                            </div>
                            
                            
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12  clearleft">
                        <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" style="padding-top: 58px;">
                            
                        </div>
                        <input type="hidden" value="<?php echo $shippingSelectedId; ?>" id="customer-address" name="shipping">

                        <div class="hidden-lg hidden-md hidden-sm col-xs-6 step-purchase shipping box clearleft clearright remove-padding clearright-mobile clearleft-mobile" style="padding-top: 10px;padding-right: 7.5px;">
                                <a href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/step/deliveryform" class="blue-round add-address" style="text-align: center;width: 100%;">Tambah Alamat</a>
                        </div>

                        <?php if (count($shippingInformation) > 0) { 
						?>
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearleft clearright clearright-mobile clearleft-mobile">
                            <select class="shipping" id="address-select" name="address" onchange="address_select();" style="height: 40px;
    border: solid 1px rgb(158,131,97);
    border-radius: 25px;
    background-color: rgb(158,131,97);
    color: #fff;
    margin-bottom: 10px;    padding-left: 10%;">
                                    <option value="" selected="selected">Pilih Alamat Lain</option>
                                    <?php foreach($shippingInformation as $shipping){ ?>
                                        
                                            <option value="<?php echo $shipping['customer_address_id']; ?>">
                                                <?php echo $shipping['address']; ?>
                                            </option>
                                  
                                    <?php } ?>   
                                </select>
                        </div>
                        <div class="hidden-lg hidden-md hidden-sm col-xs-6 clearleft clearright clearright-mobile clearleft-mobile" style="padding-top: 10px;padding-left: 7.5px;">
                            <select class="shipping" id="address-select" name="address" onchange="address_select();" style="height: 40px;border: solid 1px rgb(158,131,97);
    border-radius: 25px;
    background-color: rgb(158,131,97);
    color: #fff;
    margin-bottom: 10px;    padding-left: 10%;">
                                    <option value="" selected="selected">Pilih Alamat Lain</option>
                                    <?php foreach($shippingInformation as $shipping){ ?>
                                        
                                            <option value="<?php echo $shipping['customer_address_id']; ?>">
                                                <?php echo $shipping['address']; ?>
                                            </option>
                                  
                                    <?php } ?>   
                                </select>
                        </div>
                          
                        <?php } ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs step-purchase shipping box clearleft clearright remove-padding clearright-mobile clearleft-mobile" style="padding-top: 10px;">
                                <a href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/step/deliveryform" class="blue-round add-address" style="text-align: center;width: 100%;">Tambah Alamat</a>
                            </div>
                    </div>
                    
                </div>
            </div>
            
            
            
            
            

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 fcolor69 shopping-bag deliverylist metode-pengiriman clearleft pdr75" style="">
                <div class="col-xs-12 rgb243 bradius5 remove-padding padding-top-2 padding-bottom-2 metode-pengiriman clearleft clearright" style="">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearleft-mobile clearright-mobile clearright">
                        
                        <div class="col-lg-12 gotham-medium fcolor69" style="font-size: 14px;padding-top: 12px;padding-bottom: 7px;">
                            Metode Pengiriman
                        </div>
                        <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12 margin-top-5 clearright step-purchase shipping-insurance" style="display:none;">
                                <input type="checkbox" name="shipping_insurance" value="1" checked id="shipping_insurance"> 
                                <label for="shipping_insurance">Asuransikan Pengiriman</label>
                            </div>
                        <div class="col-lg-12 gotham-light fcolor69" id="view-shipping" style="font-size: 14px">
                            <input type="hidden" value="0" id="shippingmet" name="shippingmet">
                            
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft-mobile clearleft signup-error" style="display: none;">
                                <span id="signup-error" style="color: red;">* Please Select Shipping Method</span>
                            </div>
                            <?php 
								$district = \backend\models\CustomerAddress::findOne(['customer_address_id' => $shippingSelectedId]);
								$carriers = \backend\models\CarrierCost::findAll(['carrier_id' => 1, 'active' => 1, "district_id" => $district->district_id]);
                                
								if(count($carriers) > 0) {
									$carrier_names = array();
									$carriers_header = array('carrier_cost_id','carrier_package_name','delivery_days');
									$carriers_values = array();
									$arr_carriers = array();
									foreach ($carriers as $carrier) {
										array_push($carrier_names, $carrier->carrierPackageDetail->carrierPackage->carrier_package_name);
										if($carrier->carrierPackageDetail->carrierPackage->carrier_package_name == 'REGULER'){
											if($freeShipping){
												$carriers_values = array($carrier->carrier_cost_id, $carrier->carrierPackageDetail->carrierPackage->carrier_package_name, $carrier->day);
												$arr_carriers = array_combine($carriers_header, $carriers_values);
											}else{
							?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                                            <div class="radio-btn" style="">
                                                <input type="radio" name="shipping_method" id="<?php echo $carrier->carrier_cost_id; ?>" value="<?php echo $carrier->carrier_cost_id; ?>" style="pointer-events: none;">
                                                <label for="<?php echo $carrier->carrier_cost_id; ?>" class="black-style" onclick="shipping_method(<?php echo $carrier->carrier_cost_id; ?>)" style="color: #000;">
                                                    <?php
                                                    //echo $carrier->carrier->name . ' - ' . $carrier->carrierPackageDetail->carrierPackage->carrier_package_name . ' - (' . $carrier->day . ' days)'; 
                                                    echo $carrier->carrierPackageDetail->carrierPackage->carrier_package_name . ' - (3 - 5 hari)';
                                                    ?>
                                                </label>
                                            </div>
                                        </div>
                                        <?php 
											}
                                        // flat price if customer upgrade shipping service
                                        } elseif($carrier->carrierPackageDetail->carrierPackage->carrier_package_name == 'YES'){ 
                                            $provinceId = backend\models\CustomerAddress::findOne(['customer_address_id' => $shippingSelectedId])->province_id;
                                            $flatPrice = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 3])->price;
                                            if($freeShipping){
												if($carrier->price == 0 || $carrier->price == '-'){
													if($flatPrice == null){
														list($c_cost_id, $c_package, $c_days) = $carriers_values;
										?>
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
															<div class="radio-btn" style="">
																<input type="radio" name="shipping_method" id="<?php echo $c_cost_id; ?>" value="<?php echo $c_cost_id; ?>" style="pointer-events: none;">
																<label for="<?php echo $c_cost_id; ?>" class="black-style" onclick="shipping_method(<?php echo $c_cost_id; ?>)" style="color: #000;">
																	<?php
																	//echo $carrier->carrier->name . ' - ' . $carrier->carrierPackageDetail->carrierPackage->carrier_package_name . ' - (' . $carrier->day . ' days)'; 
																	echo $c_package . ' - '. $c_days . ' hari';
																	?>
																</label>
															</div>
														</div>
										<?php
													}
												}else{
										?>
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
										
														<div class="radio-btn" style="">
															<input type="radio" name="shipping_method" id="<?php echo $carrier->carrier_cost_id; ?>" value="<?php echo $carrier->carrier_cost_id; ?>" style="pointer-events: none;">
															<label for="<?php echo $carrier->carrier_cost_id; ?>" class="black-style" onclick="shipping_method(<?php echo $carrier->carrier_cost_id; ?>)" style="color: #000;">
																<?php
																//echo $carrier->carrier->name . ' - ' . $carrier->carrierPackageDetail->carrierPackage->carrier_package_name . ' - (' . $carrier->day . ' days)'; 
																echo $carrier->carrierPackageDetail->carrierPackage->carrier_package_name . ' - (1 - 2 hari)';
																?>
															</label>
														</div>
													</div>
										<?php
												}
											}else{
												if($carrier->price != 0 || $carrier->price != '-'){
													if($flatPrice != null){
											?>
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
										
														<div class="radio-btn" style="">
															<input type="radio" name="shipping_method" id="<?php echo $carrier->carrier_cost_id; ?>" value="<?php echo $carrier->carrier_cost_id; ?>" style="pointer-events: none;">
															<label for="<?php echo $carrier->carrier_cost_id; ?>" class="black-style" onclick="shipping_method(<?php echo $carrier->carrier_cost_id; ?>)" style="color: #000;">
																<?php
																//echo $carrier->carrier->name . ' - ' . $carrier->carrierPackageDetail->carrierPackage->carrier_package_name . ' - (' . $carrier->day . ' days)'; 
																echo $carrier->carrierPackageDetail->carrierPackage->carrier_package_name . ' - (1 - 2 hari)';
																?>
															</label>
														</div>
													</div>
											<?php
													}
												}
											}
										}
									}
								} 
							?>

                        </div>
                    </div>
                    <div class="hidden-lg hidden-md col-sm-12 col-xs-12" style="padding-top: 10px;"></div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 fcolor69 shopping-bag deliverylist detail-pembayaran clearright pdl75" style="">
                <div class="col-xs-12 rgb243 bradius5 remove-padding padding-top-2 padding-bottom-2 detail-pembayaran clearleft clearright" style="">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft-mobile clearright-mobile">
                            
                        <div class="col-lg-12 gotham-medium fcolor69" style="font-size: 14px;padding-top: 12px;padding-bottom: 7px;">
                            Detail Pembayaran
                        </div>
                        <div class="col-lg-12 gotham-light fcolor69" style="font-size: 14px;">
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
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearright-mobile clearleft-mobile" style="">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-medium clearright-mobile clearleft-mobile">
                                    Diskon
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright clearright-mobile clearleft-mobile" style="text-align: right;">
                                    <span id="discount">
                                        <?php echo $discount == 0 ? '-' : common\components\Helpers::getPriceFormat($discount); ?>
                                    </span>
                                </div>

                            </div>
                    
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearright-mobile clearleft-mobile" style="">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-medium clearright-mobile clearleft-mobile">
                                    Ongkir + Asuransi
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
                            
                            
                        </div>
                        
                    </div>
                    <div class="hidden-lg hidden-md col-sm-12 col-xs-12" style="padding-top: 10px;"></div>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 fcolor69 shopping-bag deliverylist metode-pengiriman clearleft pdr75" style="margin: 18px 0">
                <div class="col-xs-12 rgb243 bradius5 remove-padding padding-top-2 padding-bottom-2 metode-pengiriman clearleft clearright" style="">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearleft-mobile clearright-mobile clearright">
                        
                        <div class="col-lg-12 gotham-medium fcolor69" style="font-size: 14px;padding-top: 12px;padding-bottom: 7px;">
                            Note:
                        </div>
                        
                        <div class="col-lg-12 gotham-medium fcolor69" style="font-size: 14px;padding-top: 12px;padding-bottom: 7px;">
                            
                            <textarea  name="note" placeholder="Note" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 clearleft clearright remove-padding margin-top-3">
                               
                                
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 clearright margin-top-3">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 step-purchase lanjut-belanja shipping box clearleft clearleft-mobile padding-top-2 margin-top-1">
                                    <a href="<?php echo \yii\helpers\Url::base(); ?>" class="yellow-round lanjut-belanja hidden-xs hidden-sm" style="width:100%;text-align: center;float: right;padding-top: 8px;padding-bottom: 9px;">Lanjut Belanja</a>
                                    <a href="<?php echo \yii\helpers\Url::base(); ?>" class="yellow-round lanjut-belanja hidden-lg hidden-md" style="padding-right:0;padding-left:0;width:100%;text-align: center;float: right;padding-top: 8px;padding-bottom: 9px;">Lanjut Belanja</a>
                                
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 step-purchase konfirmasi-peasanan shipping box clearright clearright-mobile padding-top-2 margin-top-1">
                                <?php if($out_stock == false){ ?>
                                    <a id="delivery-list" onclick="delivery_list()" class="blue-round konfirmasi-peasanan hidden-xs hidden-sm" style="width: 100%;text-align: center;font-size: 14px;">Konfirmasi Pesanan</a> 
                                    <a id="delivery-list" onclick="delivery_list()" class="blue-round konfirmasi-peasanan hidden-lg hidden-md" style="padding-right:0;padding-left:0;width: 100%;text-align: center;">Konfirmasi Pesanan</a>      
                                 <?php } ?>                          
                                </div>
                                
                            
                            </div>

            <?php } ?>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="buy1get1modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<style type="text/css">
    a.shipping-information.lanjut{
        background:#c2b9b4;
        color:#fff;
    }
    a.shipping-information.lanjut:hover{
        background:#fff;
        color:#c2b9b4;
    }
	@media only screen and (min-width : 768px) {
		.shipping-insurance { margin-top: 8px; }
	}
</style>
<script>

    function test(){
        $('#buy1get1modal').modal('show');    
    }
    
    
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
            console.log(data);
            var d = data;
            if (d.valid) {
                $('span#discount').html(d.currency + ' ' + d.discount);
                $('#total-purchase').html(d.currency + ' ' + d.total);
                $('span#ongkir').html(d.currency + ' ' + d.shipping);
                grossamount = d.total;
                grossamount = d.total.split('.').join("");
                $('span.voucher-message').html('Voucher aktif!');
                $('span.voucher-message').css('color','rgb(33,96,103)');
                $('input.voucher-code').css('border','solid 1px rgb(33,96,103)');
            } else {
                $('span.voucher-message').html(d.message);
                $('span.voucher-message').css('color','#e36969');
                $('input.voucher-code').css('border','solid 1px #e36969');
            }
        }
    });

};

    function delivery_list() {

    if ($('input[name=shippingmet]').val() != 0) {
        var customer_address_id = $('input[name=shipping]').val();

        $('div.signup-error').hide();

        $.ajax({
            type: "POST",
            url: baseUrl + '/cart/checkout/shipping-submit',
            data: {"customer_address_id": customer_address_id, "shipping_method": $('input[name=shippingmet]').val(), "note": $('textarea[name=note]').val()},
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


</script>
<style type="text/css">
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
                border-top:none;
                padding-top: 10px;
                padding-bottom: 10px;
            }
            .table>tbody+tbody{
                border-top:none;
                padding-top: 15px;
            }
            .deliverylist-title-table{
                font-size: 14px;
                text-align: center;
            }
            .deliverylist-img{
                width: 203px;
            }
            .deliverylist-brand{
                margin-top: 115px;
                
            }
            .deliverylist-brand-width{
                width: 397px;
            }
            .deliverylist-quantity{
                margin-top: 93px;
            }
            .deliverylist-price,.deliverylist-remove{
                margin-top: 121px;
            }
    select#voucher-select{
        background-color:#fff;
        color:rgb(158,131,97);
    }
    select#voucher-select:hover{
        background-color:rgb(158,131,97);
        color:#fff;
    }
    .voucher-message{
        position: absolute;
    }
    .add-address{
        position: absolute;
    }
    .deliverylist.metode-pengiriman,.deliverylist.detail-pembayaran{
        min-height: 198px;
        padding-top: 18px;
    }
    .deliverylist.kode-voucher{
        min-height: 198px;
    }
    .metode-pengiriman,.detail-pembayaran{
        height: 198px;
    }
    .input-voucher{
        padding-top: 23px;
    }  
    .voucher-text-1{
        font-size: 12px;
    }
     a.red-round.address-edit,a.red-round.address-remove{
            width: 92px;
        }
    @media only screen and (max-width : 1365px) and (min-width: 1280px) {
        .voucher-text-1{
            font-size: 11px;
        }
    }
    @media only screen and (max-width : 1279px) and (min-width: 1024px) {
        .deliverylist-img{
                width: auto;
            }
        .deliverylist-brand-width{
                width: auto;
            }
            .deliverylist-brand{
                margin-top: 40px;              
        }
        .deliverylist-quantity{
                margin-top: 43px;
        }
        .deliverylist-price,.deliverylist-remove{
                margin-top: 76px;
            }
            .deliverylist.pdr75{
                padding-right: 7.5px;
            }
            .deliverylist.pdl75{
                padding-left: 7.5px;
            }
            .voucher-text-1{
            font-size: 8px;
        }
        a.red-round.address-edit,a.red-round.address-remove{
            width: 75px;padding-left: 0;padding-right: 0;
        }

    }
    @media only screen and (max-width : 768px) {
        .deliverylist.pdr75{
            padding-right: 15px;
        }
        .deliverylist.pdl75{
            padding-left: 15px;
        }
        .voucher-message{
            position: relative;
        }
        .add-address{
            position: relative;
        }
        .address-edit{
            right: 0;
        }
        .address-remove{
            right: 0;
        }
        a.blue-round {
            float: right;
            border: 1px solid #1d6068;
            cursor: pointer;
            border-radius: 20px;
            padding: 10px;
            padding-left: 20px;
            padding-right: 20px;
            letter-spacing: 1.5px;
            font-size: 12px;
            background: #1d6068;
            color: #fff;
            /* width: 10%; */
        }
        a.red-round {
            /* float: right; */
            border: 1px solid rgb(160,29,34);
            cursor: pointer;
            border-radius: 20px;
            padding: 10px;
            padding-left: 20px;
            padding-right: 20px;
            letter-spacing: 2px;
            background: rgb(160,29,34);
            color: #fff;
            /* width: 10%; */
        }
        .step-purchase.lanjut-belanja{
            padding-right: 7.5px;
        }
        .step-purchase.konfirmasi-pesanan{
            padding-left: 7.5px;
        }
        .deliverylist.metode-pengiriman,.metode-pengiriman,.deliverylist.detail-pembayaran,.detail-pembayaran,.deliverylist.kode-voucher{
            min-height: auto;
            height: auto;
        }
        .deliverylist.metode-pengiriman,.deliverylist.detail-pembayaran{
       
            padding-top: 15px;
        }
        .input-voucher{
            padding-top: 16px;
        } 
    }
    @media only screen and (width : 768px) {
        .deliverylist.pdr75{
            padding-right: 0;
        }
        .deliverylist.pdl75{
            padding-left: 0;
        }
        
    }
    @media only screen and (max-width : 375px) {
        a.blue-round {
            float: right;
            border: 1px solid #1d6068;
            cursor: pointer;
            border-radius: 20px;
            padding: 10px;
            padding-left: 12px;
            padding-right: 12px;
            letter-spacing: 1.5px;
            font-size: 11px;
            background: #1d6068;
            color: #fff;
            /* width: 10%; */
        }
        a.red-round {
            /* float: right; */
            border: 1px solid rgb(160,29,34);
            cursor: pointer;
            border-radius: 20px;
            padding: 10px;
            padding-left: 12px;
            padding-right: 12px;
            letter-spacing: 2px;
            background: rgb(160,29,34);
            color: #fff;
            font-size: 11px;
            /* width: 10%; */
        }
        .yellow-round {
           
            padding-left: 12px;
            padding-right: 12px;
            
            font-size: 11px;
            /*width: 10%;*/
        }
        select.shipping{
            font-size: 11px;
        }
    }
    @media only screen and (min-width : 1280px) {
        .bellow-voucher{
            padding-top: 40px;
        }
    }
    @media only screen and (min-width : 1440px) {
        .bellow-voucher{
            padding-top: 40px;
        }
    }
</style>
<style type="text/css">
    .checkbox-btn.agreement-checkbox input[type="checkbox"]:checked+label::before,
    .checkbox-btn.agreement-checkbox input[type="radio"]:checked+label::before,
    .radio-btn.agreement-checkbox input[type="checkbox"]:checked+label::before,
    .radio-btn.agreement-checkbox input[type="radio"]:checked+label::before {
        opacity: 1;
        background-color: rgb(158,131,97);
        width: 11px;
        border-radius: 25px;
        height: 11px;
        top: 9px;
        left: 8px;
    }
    .checkbox-btn.agreement-checkbox input[type="checkbox"]:checked+label::after,
    .checkbox-btn.agreement-checkbox input[type="radio"]:checked+label::after,
    .radio-btn input[type="checkbox"]:checked+label::after,
    .radio-btn input[type="radio"]:checked+label::after {
        border: 1px solid rgb(158,131,97);
    }

    .checkbox-btn label.black-style::after {
        position: absolute;
        content: "";
        width: 15px;
        height: 15px;
        left: 0;
        top: 0;
        margin-left: -9px;
        margin-top: 6px;
        background-color: transparent;
        border: 1px solid rgb(158,131,97);
        border-radius: 25px;
        background-clip: padding-box;
        cursor: pointer
    }
    .radio-btn label.black-style::before {
        background: rgb(158,131,97);
        border: 1px solid rgb(158,131,97);
        width: 8px;
        height: 8px;
        top: 9px;
        left: 9px;
    }
    .radio-btn label.black-style::after {
    
        border: 1px solid rgb(158,131,97);
        width: 12px;
        height: 12px;
    }
    .checkbox-btn.agreement-checkbox{
        padding-left: 12px;
        padding-top: 0;
    }

</style>