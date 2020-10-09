<?php
use yii\web\Session;
                        $sessionOrder = new Session();
                        $sessionOrder->open();
                        $cart = $sessionOrder->get("cart");
                        $total_cart = 0;
                        if ($cart == NULL) {

                        }else{
                            $items = $cart['items'];
                            $total_cart = count($items);
                        }
                        ?>
                        <div class="row cart-line">
                            <div class="col-lg-6 col-md-6 col-sm-6 clearleft cart-title-box">
                                <span class="cart-title fsize-18"><span class="gotham-medium fcolor69">Total Pesanan:</span> <span class="gotham-light"><?php echo $total_cart; ?> Item</span></span>
                            </div>
                        </div>
                        <div class="row" style="margin:0;border-bottom: 1px solid rgba(0, 0, 0, 0.2);color:#000;"></div>
                        
                        <?php if ($cart == NULL || empty($cart) || $cart == '') { ?>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 clearright cart-empty-box ptop3 pbottom3 left" style="height: 60px;">
                                    <span class="lspace3 gotham-light cart-empty">KERANJANG BELANJA KOSONG</span>
                                </div>
                            </div>
                            <div class="row" style="margin:0;border-bottom: 1px solid rgba(0, 0, 0, 0.2);color:#000;"></div>

                            <div class="col-lg-12 col-md-12 col-sm-12 clearright clearleft">
                                <div class="row checkout-btn-box">
                                    <a class="blue-round talign-center cart-pay gotham-light fsize-14" href="<?php echo \yii\helpers\Url::base(); ?>/watches/all-product">Isi Keranjang Belanja</a>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 clearright clearleft" style="max-height: 250px;overflow-y: scroll;overflow-x: hidden;box-shadow: inset -2px 0px 4px rgba(0, 0, 0, 0.5);-webkit-box-shadow: inset -2px 0px 4px rgba(0, 0, 0, 0.5);-moz-box-shadow: inset -2px 0px 4px rgba(0, 0, 0, 0.5);">
                            <?php
                            
                            if (count($items) > 0) {
                                $grandTotal = 0;
                                $count = 0;
                                foreach ($items as $item) {
                                    $grandTotal += $item['total_price'];
									if( $item['out_of_stock'] === 1 ){
                                    ?>
										<div class="row view-cart-product bg-inactive-cart">
											<div class="col-lg-2 col-md-2 col-sm-2 cart-close-box clearright">
												<a href="#" id="removeItem" data-id="<?php echo $item['id']; ?>" attributeId="<?php echo $item['product_attribute_id']; ?>">
													<input type="hidden" name="productName" value="<?php echo $item['name']; ?>">
													<input type="hidden" name="productPrice" value="<?php echo $item['unit_price']; ?>">
													<input type="hidden" name="brandName" value="<?php echo $item['brand_name']; ?>">
													<input type="hidden" name="variantName" value="<?php echo $item['color']; ?>">
													<input type="hidden" name="productPosition" value="<?php echo $i; ?>">
													<input type="hidden" name="productQuantity" value="<?php echo $item['quantity']; ?>">
													<input type="hidden" name="productCategory" value="<?php echo $item['quantity']; ?>">
													<img src="https://thewatch.imgix.net/icons/x-black-24.png?auto=compress&fit=max" width="17px" class="fright">
												</a>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-2 clearright clearleft cart-img-box">
												<img src="<?php echo $item['image']['url']; ?>" width="75px">
											</div>
											<div class="col-lg-7 col-md-7 col-sm-7 clearleft clearright">
												<div class="col-lg-12 col-md-12 col-sm-12 gotham-light clearright cart-price-box fcolor69 fsize-13">
													<span><?php echo $item['brand_name']; ?></span>
												</div>
												<div class="col-lg-12 col-md-12 col-sm-12 gotham-light clearright cart-price-box fcolor69 fsize-13">
													<span><?php echo ucwords(strtolower($item['name'])) .' '. '<span class="text-small text-danger font-italic">'.$item['cart_msg'].'</span>'; ?></span>
												</div>
												<div class="col-lg-12 col-md-12 col-sm-12 gotham-light clearright cart-price-box fcolor69 fsize-13">
													<span><?php echo $item['color']; ?></span>
												</div>
												<div class="col-lg-12 col-md-12 col-sm-12 gotham-light clearright cart-quantity-box fcolor69 fsize-13">
													<span>Qty: </span>
														<span class="mleft5">
															<?php 
																if($item['flash_sale'] == 0){
															?>
															<a class="cpointer" onclick="edit_quantity_cart(<?php echo $count . ", 'minus'"; ?>)">
																<img src="https://thewatch.imgix.net/icons/quantity_minus.png?auto=compress&fit=max" width="30px">
															</a>
															<?php } ?>
															<span class="round-span mleft10 mright10" id="item-quantity-<?php echo $count ?>"><?php echo $item['quantity']; ?> pcs</span>
														</span>
												</div>
												<div class="col-lg-12 col-md-12 col-sm-12 gotham-light clearright cart-price-box fcolor69 fsize-13">
													<span>IDR <span id="item-price-<?php echo $count ?>"><?php echo common\components\Helpers::getPriceFormat($item['total_price']); ?></span></span>
												</div>
											</div>
											
										</div>
									<?php
									}else{
									?>
										<div class="row view-cart-product">
											<div class="col-lg-2 col-md-2 col-sm-2 cart-close-box clearright">
												<a href="#" id="removeItem" data-id="<?php echo $item['id']; ?>" attributeId="<?php echo $item['product_attribute_id']; ?>">
													<input type="hidden" name="productName" value="<?php echo $item['name']; ?>">
													<input type="hidden" name="productPrice" value="<?php echo $item['unit_price']; ?>">
													<input type="hidden" name="brandName" value="<?php echo $item['brand_name']; ?>">
													<input type="hidden" name="variantName" value="<?php echo $item['color']; ?>">
													<input type="hidden" name="productPosition" value="<?php echo $i; ?>">
													<input type="hidden" name="productQuantity" value="<?php echo $item['quantity']; ?>">
													<input type="hidden" name="productCategory" value="<?php echo $item['quantity']; ?>">
													<img src="https://thewatch.imgix.net/icons/x-black-24.png?auto=compress&fit=max" width="17px" class="fright">
												</a>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-2 clearright clearleft cart-img-box">
												<img src="<?php echo $item['image']['url']; ?>" width="75px">
											</div>
											<div class="col-lg-7 col-md-7 col-sm-7 clearleft clearright">
												<div class="col-lg-12 col-md-12 col-sm-12 gotham-light clearright cart-price-box fcolor69 fsize-13">
													<span><?php echo $item['brand_name']; ?></span>
												</div>
												<div class="col-lg-12 col-md-12 col-sm-12 gotham-light clearright cart-price-box fcolor69 fsize-13">
													<span><?php echo ucwords(strtolower($item['name'])); ?></span>
												</div>
												<div class="col-lg-12 col-md-12 col-sm-12 gotham-light clearright cart-price-box fcolor69 fsize-13">
													<span><?php echo $item['color']; ?></span>
												</div>
												<div class="col-lg-12 col-md-12 col-sm-12 gotham-light clearright cart-quantity-box fcolor69 fsize-13">
													<span>Qty: </span>
														<span class="mleft5">
															<?php 
																if($item['flash_sale'] == 0){
															?>
															<a class="cpointer" onclick="edit_quantity_cart(<?php echo $count . ", 'minus'"; ?>)">
																<img src="https://thewatch.imgix.net/icons/quantity_minus.png?auto=compress&fit=max" width="30px">
															</a>
															<?php } ?>
																<span class="round-span mleft10 mright10" id="item-quantity-<?php echo $count ?>"><?php echo $item['quantity']; ?> pcs</span>
															<?php 
																if($item['flash_sale'] == 0){
															?>
															<a class="cpointer" onclick="edit_quantity_cart(<?php echo $count . ", 'plus'"; ?>)">
																<img src="https://thewatch.imgix.net/icons/quantity_plus.png?auto=compress&fit=max" width="30px">
															</a>
															<?php } ?>
														</span>
												</div>
												<div class="col-lg-12 col-md-12 col-sm-12 gotham-light clearright cart-price-box fcolor69 fsize-13">
													<span>IDR <span id="item-price-<?php echo $count ?>"><?php echo common\components\Helpers::getPriceFormat($item['total_price']); ?></span></span>
												</div>
											</div>
											
										</div>
									<?php
									}
									?>
                                    <div class="row cart-liner"></div>
                                <?php $count++;} ?>
                            <?php } ?>
                               
                            </div>
                            <div class="row" style="margin:0;border-bottom: 1px solid rgba(0, 0, 0, 0.2);color:#000;"></div>
                            <!-- <div class="row cart-total-box">
                                <div class="col-lg-12 col-md-12 col-sm-12 clearleft clearright">
                                    <span class="cart-total">TOTAL</span>
                                    <span class="cart-amount-total">IDR <?php echo common\components\Helpers::getPriceFormat($grandTotal); ?></span>
                                </div>
                            </div>
                            <div class="row" style="margin:0;border-bottom: 1px solid;color:#000;"></div> -->
                            <div class="row checkout-btn-box">
                                <a class="blue-round talign-center cart-pay gotham-light fsize-14" href="<?php echo rtrim(\yii\helpers\Url::home(true), '/'); ?>/cart/checkout/sign-in">Bayar</a>
                                
                                <!--<a id="ied-modal-checkout" style="cursor: pointer;"><div class="mn-header btn-checkout">LANJUTKAN KE PEMBAYARAN</div></a>-->
                            </div>
                        <?php } ?>
                        <script type="text/javascript">
                            function edit_quantity_cart(id, action) {
                                $.ajax({
                                    type: "POST",
                                    url: baseUrl + '/cart/checkout/editquantity',
                                    data: {
                                        'count_id': id,
                                        'action': action
                                    },
                                    dataType: "json",
                                    beforeSend: function(){
                                        $('#loadingScreen').modal('show');
                                    },
                                    success: function (data) {
                                        $('#loadingScreen').modal('hide');
                                        if (data[3] == 'overload_minus') {
                                            $('span#item-quantity-' + id).empty();
                                            $('span#item-quantity-mob-' + id).empty();
                        //                    $('#item-price-' + id).empty();
                                            // $('#item-total').empty();
                                           
                                            $("span#item-quantity-" + id).text(data[0]+' pcs');
                                            $("span#item-quantity-mob-" + id).text(data[0]+' pcs');
                                           $("#item-price-" + id).text(data[1]);
                                            // $("#item-total").text('IDR '+data[2]);
                                          
                                        }
                                        else if (data[0] != 'minus' && data[0] != 'overload') {
                                            $('span#item-quantity-' + id).empty();
                                            $('span#item-quantity-mob-' + id).empty();
                        //                    $('#item-price-' + id).empty();
                                            // $('#item-total').empty();
                                 

                                            $('#overload-quantity-' + id).fadeOut();

                                            $("span#item-quantity-" + id).text(data[0]+' pcs');
                                            $("span#item-quantity-mob-" + id).text(data[0]+' pcs');
                                           $("#item-price-" + id).text(data[1]);
                                            // $("#item-total").text('IDR '+data[2]);
                                        }
                                    }
                                });
                            }
                 

$('a#removeItem').on('click', function(e) {
    
    e.preventDefault();
    
    var id = $(this).attr("data-id"),
        attributeId = $(this).attr("attributeId");
    
    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/remove-item',
        data: { "id" : id, "attributeId" : attributeId },
        beforeSend: function(){
            
        },
        success: function(data){
            $("div#box-cart").html(data);
        }
    });
    
    if($("section#shopping-bag").length){
        $.ajax({
            type: "POST",
            url: baseUrl + '/cart/checkout/remove-cart-item',
            data: { "id" : id, "attributeId" : attributeId },
            beforeSend: function(){

            },
            success: function(data){
                $("section#shopping-bag").html(data);
            }
        });
    }
});
</script>