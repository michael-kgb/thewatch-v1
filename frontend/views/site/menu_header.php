<?php
use backend\models\ProductCategoryBrands;
use backend\models\Brands;
use yii\web\Session;

session_start();
$sessionOrder = new Session();
$sessionOrder->open();
?>
 

<?php 
    $top = 0;
    foreach($bulkhead as $bulk){
        if($bulk['marketing_bulkhead_type'] !='bottom'){
            $top++;
        }
} ?>
<?php if($top != 0){?>
    <div class="blank" id="blank-popup"></div>
<div class="col-xs-12 col-md-12 col-sm-12 hidden-lg bulkhead-height">
    <div class="bulkhead-mobile alert alert-success alert-dismissable fade in">
    <a href="#" class="close bulkhead-close" data-dismiss="alert" aria-label="close">&times;</a>
        <div id="this-carousel-id" class="col-lg-6 col-md-12 col-sm-12 bulkhead-ipad clearright">
      <div class="carousel-inner">
        <?php
        $t = 0; 
		
        foreach($bulkhead as $bulkheads){ ?>
        <?php if($bulkheads['marketing_bulkhead_type'] !='bottom'){?>
        <div class="item <?php if($t == 0){ echo 'active';} ?> items">
          <div class="carousel-caption carousel-bulkhead-mobile text-bulkhead-right carousel-bulkhead-top fcolorfff">
            <?php echo $bulkheads['marketing_bulkhead_text']; ?>
          </div>
          
        </div>
        <?php $t++; }} ?>
      </div>   
    </div>
  </div>
</div>
<?php }?>

<nav id="navbar-mobile" class="navbar navbar-default navbar-custom navbar-static-top navbar-default-scroll">
    <div class="col-lg-12 hidden-xs clearright clearleft clearright-mobile clearleft-mobile snow-header" id="snow-header" style="position: absolute;overflow: hidden;height: 90px;bottom:0;"></div>
<!-- revisibaru -->
    <div class="col-lg-12 hidden-md hidden-sm hidden-xs height40 bgcolorprimary">
        <div class="container">
            <div class="row">
                <div class="hidden-sm hidden-xs col-lg-12 col-md-12 col-sm-12 bulkhead clearleft clearright bgcolorprimary">
                    <div class="col-lg-6 col-md-6 col-sm-6 clearright clearleft" >
                        <div class="col-lg-3 col-md-3 col-sm-3 clearleft clearright coba free-shipping mright3 width30">
                            <a href="#" class="text-bulkhead fcolorfff">
                                <i class="box-bulkhead"></i>
                                <span class="fcolorfff">FREE SHIPPING</span>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 clearleft clearright coba lifetime-bateray mright3">
                            <a href="#" class="text-bulkhead fcolorfff">
                                <i class="watch-bulkhead"></i>
                                <span class="fcolorfff">LIFETIME BATTERY</span>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 clearleft clearright coba installments lifetime-width">
                            <a href="#" class="text-bulkhead fcolorfff">
                                <i class="card-bulkhead"></i>
                                <span class="fcolorfff">0% INSTALLMENT</span>
                            </a>
                        </div>    
                    </div>
                    <?php if(count($bulkhead) > 0){ ?>
                     <div id="this-carousel-id" class="col-lg-6 hidden-md hidden-sm clearright">
                          <div class="carousel-inner" id="runtext">
                            <?php
                            $t = 0; 
							
                            foreach($bulkhead as $bulkheads){ ?>
                            <?php if($bulkheads['marketing_bulkhead_type'] !='bottom'){?>
                            <div id="item_<?= $t; ?>" class="item <?php if($t == 0){ echo 'active';} ?> items">
                              <div class="carousel-caption carousel-bulkhead text-bulkhead-right carousel-bulkhead-top">
                                <?php echo $bulkheads['marketing_bulkhead_text']; ?>
                              </div>
                            </div>
                            <?php $t++; }} ?>
                          </div>   

                
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

    <div class="container height60" id="navbar-wrap">
    <div class="row">
    <!-- revisibaru -->
    <div class="col-lg-12 col-md-12 clearleft clearright height-menu2 scroll">
        <div class="col-xs-12 hidden-lg hidden-md hidden-sm ptop10"></div>
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll box-logo">
			<!--
            <div class="hidden-xs hidden-sm hidden-md hidden-lg hidden-md">
				<a href="<?php echo \yii\helpers\Url::home(true); ?>">
                    <img src="https://thewatch.imgix.net/christmas/logo-santa.png?auto=compress&fit=max" class="navbar-brand page-scroll default-logo" id="logotwc">
                </a>
            </div>
			-->
            <div class="hidden-xs hidden-sm hidden-md hidden-lg hidden-md">
				<a href="<?php echo \yii\helpers\Url::base(); ?>">
                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/navbar-logo.png" class="navbar-brand page-scroll default-logo navbarbrandbottom" style="display: none" id="logotwcco">
                </a>
            </div>
            <div class="hidden-lg">
                <div class="hidden-lg hidden-xs col-sm-12 col-md-12 ptop0"></div>
				<a href="/" class="col-sm-2 logo-small col-xs-2 menu-mobile menu-left pleft0">
                    
                    <!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/logo-new.png" alt="logo" />-->
                    <!--<img src="https://thewatch.imgix.net/graphics/m/ramadhan_2019_icon_m.png?auto=compress" alt="logo" style="margin-top: -30px;height: 90px;width: auto;margin-left: 121px;"/>-->
                    <img src="https://thewatch.imgix.net/logos/logo-thewatchco-mobile.png?auto=compress" class="hidden"alt="logo"/>
					<!-- <img src="https://thewatch.imgix.net/christmas/icon/mobile-logo.png?auto=compress" alt="logo"/> --> 
                    <img src="https://thewatch.imgix.net/logos/logo-thewatchco-mobile.png?auto=compress" alt="logo"/> 
                </a>
				<div class="col-sm-10 col-xs-10 menu-mobile custom-search menu-left pleft0 pright0">
                    
                    <input type="text" name="search" id="search-mobile-query" />
					<img onclick="search_mobile('/category/search?q=')" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/nav-home/icon-search.png" alt="img" />
                </div>
				<!-- 
                <div class="col-sm-4 col-xs-2 menu-mobile menu-left pleft0">
                    
                    <i class="menu-mobile burger" id="c-button--push-left"></i>
                </div>
               
                <div class="col-sm-4 col-xs-7 ptop10 pleft15 pright0">
                    <div class="text-center">
                        <a href="<?php echo \yii\helpers\Url::base(); ?>">

                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/logo.png" style="margin-top: 5px;width: 216px;" class="img-responsive menu-mobile logo-mobile">
                        </a>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-3 search-chart">
                  
						<i class="search-mobile" id="c-button--push-search"></i>
						<i class="menu-mobile pull-right cart-mobile" id="c-button--push-right"></i>
				</div>
				-->
            </div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <!-- revisibaru -->
        <div class="collapse navbar-collapse scroll" id="bs-example-navbar-collapse-1">
            <ul class="col-lg-2 col-md-2 clearleft box-logotwc">
                <div class="navbar-header page-scroll box-logo">
                    <div class="hidden-xs hidden-sm hidden-md">
                        <a href="<?php echo \yii\helpers\Url::home(true); ?>">
                        <!--<i class="logo-sprite" id="logotwc"></i>-->
                            <!-- <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/christmas2018/HatHeading.svg" style="position: absolute;top:12px;"> -->
                            <!-- <img src="<?php echo \yii\helpers\Url::base(); ?>/img/christmas/logo-santa.png" style="margin-top: -4px;" class="navbar-brand page-scroll default-logo" id="logotwc"> -->
                            <img src="https://thewatch.imgix.net/logos/logo-thewatchco-desktop.png?auto=compress" class="navbar-brand page-scroll default-logo" id="logotwc logo_desktop"> 
							<!-- <img src="https://thewatch.imgix.net/christmas/logo-santa.png?auto=compress" class="navbar-brand page-scroll default-logo" id="logotwc logo_desktop"> -->
                            
                        </a>
                    </div>
                    <div class="hidden-xs hidden-sm hidden-md">
                    
                        <!--<a href="http://thewatch.co">-->
                        <!--    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/logo.png" style="margin-top: -5px;" class="navbar-brand page-scroll default-logo" style="display: none" id="logotwcco">-->
                        <!--</a>-->
                    </div>
                </div>
            </ul>
            <ul class="col-lg-7 col-mg-7 col-centered hidden-xs hidden-sm hidden-md nav navbar-nav clearright">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <?php $i = 1; ?>
                <?php if (count($data) > 0) { ?>
                    <?php foreach ($data as $row) { ?>
                        <?php 
                        if($row->product_category_name == 'sale'){ 
                            continue;
                        }
                        ?>
                        <?php 
                        if($row->product_category_name == 'jewelry'){ 
                            continue;
                        }
                        if($row->product_category_name == 'accessories'){
                            ?>
                                 <li id="jewelry">
                                <a id="jewelry" class="page-scroll gotham-light fsize-14 <?php if ($i == 1) { echo 'pleft0';} ?>" href="<?php echo \yii\helpers\Url::base() . "/jewelry"; ?>">PERHIASAN</a>
                                </li>
                            <?php
                        }
                        ?>
                        <li id="<?php echo $row->product_category_name; ?>">
                            
                            <?php if($row->product_category_name == 'accessories') { ?>
                            <a id="<?php echo $row->product_category_name; ?>" class="page-scroll gotham-light fsize-14 <?php if ($i == 1) { echo 'pleft0';} ?>" href="<?php echo $row->has_child === 1 ? \yii\helpers\Url::base() . "/accessories/all-product" : \yii\helpers\Url::base() . '/' . $row->link_rewrite; ?>">AKSESORIS</a>
                            
                            <?php } elseif($row->product_category_name == 'straps') { ?>
                            <a id="<?php echo $row->product_category_name; ?>" class="page-scroll gotham-light fsize-14 <?php if ($i == 1) { echo 'pleft0';} ?>fsize-14 <?php if ($i == 1) { echo 'padding-left: 0;';} ?>" href="<?php echo $row->has_child === 1 ? \yii\helpers\Url::base() . "/straps/all-product" : \yii\helpers\Url::base() . '/' . $row->link_rewrite; ?>">STRAP</a>
                            
                            <?php } elseif($row->product_category_name == 'watches') { ?>
                            <a id="<?php echo $row->product_category_name; ?>" class="page-scroll gotham-light fsize-14 <?php if ($i == 1) { echo 'pleft0';} ?>" href="<?php echo $row->has_child === 1 ? \yii\helpers\Url::base() . "/watches/all-product" : \yii\helpers\Url::base() . '/' . $row->link_rewrite; ?>">JAM TANGAN</a>
                            
                            
                            
                            <?php } else { ?>
                            <a id="<?php echo $row->product_category_name; ?>" class="page-scroll gotham-light fsize-14 <?php if ($i == 1) { echo 'pleft0';} ?>" href="<?php echo $row->has_child === 1 ? "#" : \yii\helpers\Url::base() . '/' . $row->link_rewrite; ?>"><?php if($row->product_category_name == 'brands'){
                                            echo 'BRAND';
                                        }
                                    if($row->product_category_name == 'journal'){
                                            echo 'JURNAL';
                                        } ?></a>
                            <?php } ?>
                            
                    
                         
                        </li>
                        <?php $i++; ?>
                    <?php } ?>
                <?php } ?>
                <!--<li id="jurnal" class="page-scroll gotham-medium fsize-0-95"> <a href="<?php echo \yii\helpers\Url::base(); ?>/dwpetite">PRE-ORDER</a></li>-->
                
            
                <li id="jurnal" class="page-scroll gotham-light"> <a id="jurnal" href="<?php echo \yii\helpers\Url::base(); ?>/sale" class="fcolore36969 fsize-14">SALE</a></li>
                <!--<li id="jurnal" class="page-scroll gotham-light"> <a id="jurnal" href="<?php echo \yii\helpers\Url::base(); ?>/flash-sale" class="fcolore36969 fsize-14">FLASH SALE</a></li>-->

            </ul>
            <ul class="col-lg-4 col-md-4 pull-right hidden-xs hidden-sm hidden-md nav navbar-nav box-iconchart">
                <li class="icons">
                    <a id="search" class="page-scroll pright0" href="#">
                        <span id="img-search">
                            <img src="https://thewatch.imgix.net/icons/nav-home/icon-search2.png" width="18" >
                        </span>
                        <span id="search-hover">
                            <img src="https://thewatch.imgix.net/icons/nav-home/icon-search2.png" width="18" >
                        </span>
                    </a>
                    <div class="arrow-nav" id="arrow-search"></div>
                    <div class="mn-header submenu view-cart scroll" id="box-search">
                        
                            <div class="input-group searchform">
                                <!-- <span class="input-group-addon"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/search.png"></span> -->
                                <input id="search" type="text" class="search-desktop" placeholder="search">
                                <span class="input-group-addon submit-search glyphicon glyphicon-arrow-right"></span>
                            </div>
                       
                    </div>
                </li>
                <li class="icons">
                    <a id="cart" class="page-scroll" href="#">
                        <span id="img-cart">
                            <img src="https://thewatch.imgix.net/icons/nav-home/icon-shop2.png" width="18" > 
							<!-- <img src="https://thewatch.imgix.net/christmas/icon/icon-cart.png" width="18" > --> 
                        </span>
                        <span id="cart-hover">
                            <img src="https://thewatch.imgix.net/icons/nav-home/icon-shop2.png" width="18" > 
							<!-- <img src="https://thewatch.imgix.net/christmas/icon/icon-cart.png" width="18" > -->
                        </span>
                    </a>
                    <div class="arrow-nav" id="arrow-cart"></div>
                    <div class="mn-header submenu view-cart" id="box-cart">
                        <?php
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
                        <div class="row cart-liner"></div>
                        
                        <?php if ($cart == NULL) { ?>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 clearright cart-empty-box ptop3 pbottom3 left height60">
                                    <span class="lspace3 gotham-light cart-empty">KERANJANG BELANJA KOSONG</span>
                                </div>
                            </div>
                            <div class="row cart-liner"></div>

                            <div class="col-lg-12 col-md-12 col-sm-12 clearright clearleft">
                                <div class="row checkout-btn-box">
                                    <a class="blue-round talign-center cart-pay gotham-light fsize-14" href="<?php echo \yii\helpers\Url::base(); ?>/watches/all-product">Isi Keranjang Belanja</a>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 clearright clearleft cart-list-box">
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
                            <div class="row cart-liner"></div>
                            <div class="row checkout-btn-box">
                                <a class="blue-round talign-center cart-pay gotham-light fsize-14" href="<?php echo rtrim(\yii\helpers\Url::home(true), '/'); ?>/cart/checkout/sign-in">Bayar</a>
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
                        </script>
                    </div>
                </li>
                <li class="icons <?php echo isset($_SESSION['customerInfo']) ? 'user-profile' : ''; ?>">
                    <?php if (!isset($_SESSION['customerInfo'])) { ?>
                        <a id="login" class="page-scroll login" href="#">
                            <span id="img-login">
                                <img src="https://thewatch.imgix.net/icons/nav-home/icon-person2.png" width="18" > 
								<!-- <img src="https://thewatch.imgix.net/christmas/icon/icon-profile.png" width="18" > --> 
                            </span>
                            <span id="account-hover">
                                <img src="https://thewatch.imgix.net/icons/nav-home/icon-person2.png" width="18" > 
								<!-- <img src="https://thewatch.imgix.net/christmas/icon/icon-profile.png" width="18" > --> 
                            </span>
                            
                        </a>
                        <!-- <a id="login" class="page-scroll login2" href="#" style="display:none;">
                            
                            <img id="img-login2" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/login2.png">
                        </a> -->
                    <?php } else { ?>
                        <a href="<?php echo \yii\helpers\Url::base(); ?>/user/profile">
                            <?php echo isset($_SESSION['customerInfo']['fname']) ? 'Hi, ' . $_SESSION['customerInfo']['fname'] : ""; ?>
                        </a>
                    <?php } ?>
                    <div class="arrow-nav" id="arrow-login"></div>
                    <div class="mn-header submenu view-cart" id="box-login">
                    <div class="triangle"></div>
                        <div class="row">
                            
                            <div class="col-lg-6 col-md-6 col-sm-6 clear-min-right">
                                <div class="circle-button fill-button bordered-circle-button" id="signin">Masuk</div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 clear-min-left">
                                <div class="circle-button bordered-circle-button" id="signup">Daftar</div>
                            </div>
                            
                               <!--  <div class="row" id="mn-header-line" style="border-bottom: 1px solid;margin: 8% 10% 0 10%;">

                                </div> -->
                            
                        </div>
                        <div class="row" id="signin-form">
                            <div class="">
                                <div class="rounded-input-wrap">
                                    <input id="email-login" class="rounded-input" type="text" name="email" placeholder="Email" />
                                    <span id="email-signin-error" class="mleft30 dnone gotham-light">* Email Required</span>
                                </div>
                            </div>
                            <div class=" ">
                                <div class="rounded-input-wrap">
                                    <input id="password-login" class="rounded-input" type="password" name="password" placeholder="Kata Sandi" />
                                    <div class="password-eye" id="password-eye" onClick="toggleEyePassword(this)">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/eye-closed.png" width="15px">
                                    </div>
                                    <span id="signin-pwderror" class="mleft30 dnone gotham-light">* Password Required</span>
                                </div>
                            </div>
                            <div class="">
                                <div class="mn-header form-login flex-login">
                                    <div class="inner-flex-login">
                                        <label for="rc002" class="container-checkbox">Ingat Saya
                                            <input type="checkbox" id="rc002" name="rc002"  checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                       <!-- <input type="checkbox" id="rc001" name="rc001" class="remember">
                                        <label for="rc001" class="black-style" onclick>Ingat Saya</label>-->
                                    </div>
                                    <div class="inner-flex-login text-right">
                                        
                                        <a href="#" id="forgot-password" class="gotham-light green-text">Lupa kata sandi?</a>
                                    </div>
                                    <!--<input class="mn-header form-login remember" type="checkbox" name="remember" checked />-->

                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12  signin-top-error">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 login proceed custom-error-message">
                                    <span id="signintop-error" class="dnone">Wrong Email or Password</span>
                                </div>
                            </div>
                        </div>
                        <div class="row forgot-btn-box-open dnone" id="forgot-form-content">
                            <div class="col-lg-12 col-md-12 col-sm-12 clearright">
                                <div class="mn-header form-forgot center ptop5">
                                    INVALID EMAIL OR PASSWORD <br>
                                    Lupa Password Anda?<br>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-lg-offset-5 col-md-offset-5 col-sm-offset-5 forgot-separator"></div>
                                <br>
                                <div class="mn-header form-forgot center ptop5">
                                    Please enter your mail address below and we'll<br>
                                    send you to confirmation email
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 clearright clearleft">
                                <div class="mn-header form-forgot">
                                    <input class="mn-header form-forgot email-forgot" type="text" name="email_forgot" placeholder="Email Address" />
                                    <span id="email-forgot-top-error" class="talign-center ptop2 dnone gotham-light">* Email Required</span>
                                </div>
                            </div>
                        </div>
                        <div class="row dnone" id="signup-form">

                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                <div class="rounded-input-wrap">
                                    <input id="name-sign" class="rounded-input" type="text" name="fname" placeholder="Nama Depan" />
                                    <span id="firstname-error" class="dnone gotham-light">* First Name Required</span>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                <div class="rounded-input-wrap">
                                    <input id="name-sign" class="rounded-input" type="text" name="lname" placeholder="Nama Belakang" />
                                    <span id="lastname-error" class="dnone gotham-light">* Last Name Required</span>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                <div class="rounded-input-wrap">
                                    <input id="email-sign" class="rounded-input" type="text" name="signup_email" placeholder="Email" />
                                    <span id="email-error" class=" dnone gotham-light">* Email Required</span>
                                </div>
                            </div>
                 
                           
                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                <div class="rounded-input-wrap">
                                    <input id="telp-sign" class="rounded-input" type="text" name="phone" placeholder="Nomor ponsel" />
                                    <span id="phone-error" class="dnone gotham-light">* Phone Number Required</span>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                <div class="rounded-input-wrap">

                                    <select id="gender-sign" class="rounded-input" type="text" name="gender" placeholder="Jenis Kelamin">
                                        <option value="" selected disabled>Jenis Kelamin</option>
                                        <?php
                                        
                                            $gender = \backend\models\Gender::find()->all();
                                            
                                            foreach($gender as $key=>$value){
                                                echo '<option value="'.$value->gender_id.'">'.$value->name.'</option>';
                                            }
                                        ?>
                                    </select>
                                    
                                    <span id="gender-error" class="dnone gotham-light">* Gender Required</span>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                <div class="rounded-input-wrap">
                                    <input id="birthday-sign" class="rounded-input" type="date" name="birthday" placeholder="Tanggal Lahir" />
                                    <span id="birthday-error" class="dnone gotham-light">* Birthday Required</span>
                                </div>
                            </div>
                            
                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                <div class="rounded-input-wrap">
                                    <input id="password-sign" class="rounded-input" type="password" name="signup_password" placeholder="Kata Sandi" />
                                    <span id="signup-pwderror" class="dnone gotham-light">* Password Required</span>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                <div class="rounded-input-wrap">
                                    <input id="password-repeat" class="rounded-input" type="password" name="signup_password_repeat" placeholder="Konfirmasi kata sandi" />
                                    <span id="repassword-error" class="red-error dnone ">* Password not match</span>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                <!--
                                <div class="rounded-input-wrap">
                                    <div class="checkbox-btn login-remember">
                                        <input type="checkbox" id="rc002" name="rc002">
                                        <label for="rc002" class="black-style" onclick>Berlangganan Newsletter</label>
                                    </div>
                                    <input value="1" class="mn-header form-login remember" type="checkbox" name="newsletter" checked />
                                </div>-->
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 clearleft signup-error">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 login proceed clearleft">
                                    <span id="signuptop-error" style="margin-left:0;"  class="dnone gotham-light">Email Already Registered</span>
                                </div>
                            </div>
                        </div>
                        <div class="row forgot-submit-box dnone" id="forgot-btn-box">
                            <div class="col-lg-12 col-md-12 col-sm-12 mn-header form-login clearright">
                                <div class="mn-header btn-login" id="signin-btn">MASUK</div>
                                <div class="mn-header btn-login retrieve" id="retrieve-btn">RETRIEVE</div>
                            </div>
                        </div>
                        <div class="rounded-button-wrap" id="signin-box">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="rounded-button green-btn" id="signin-btn">MASUK</div>
                                <div class="foot-signin-box">
                                    Belum memiliki akun? <div class="signup-text" id="signup">daftar</div>
                                </div>
                            </div>
                        </div>
                        <div class="dnone rounded-button-wrap" id="signup-box">
                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                <div class="rounded-button green-btn" id="signup-btn">DAFTAR</div>
                                <div class="foot-signin-box">
                                Sudah memiliki akun?  <div class="signup-text" id="signin">masuk</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                            document.getElementById("email-login")
                                .addEventListener("keyup", function(event) {
                                event.preventDefault();
                                if (event.keyCode === 13) {
                                    document.getElementById("signin-btn").click();
                                }
                            });
                            document.getElementById("password-login")
                                .addEventListener("keyup", function(event) {
                                event.preventDefault();
                                if (event.keyCode === 13) {
                                    document.getElementById("signin-btn").click();
                                }
                            });

                            document.getElementById("email-sign")
                                .addEventListener("keyup", function(event) {
                                event.preventDefault();
                                if (event.keyCode === 13) {
                                    document.getElementById("signup-btn").click();
                                }
                            });
                            document.getElementById("name-sign")
                                .addEventListener("keyup", function(event) {
                                event.preventDefault();
                                if (event.keyCode === 13) {
                                    document.getElementById("signup-btn").click();
                                }
                            });
							document.getElementById("name-sign").onkeypress = function(e) {
								var chr = String.fromCharCode(e.which);
								if ("?></\"".indexOf(chr) >= 0)
									return false;
							};
							document.getElementById("telp-sign").onkeypress = function(e) {
								var chr = String.fromCharCode(e.which);
								if ("?></\"".indexOf(chr) >= 0)
									return false;
							};
                            document.getElementById("telp-sign")
                                .addEventListener("keyup", function(event) {
                                event.preventDefault();
                                if (event.keyCode === 13) {
                                    document.getElementById("signup-btn").click();
                                }
                            });
                            document.getElementById("password-sign")
                                .addEventListener("keyup", function(event) {
                                event.preventDefault();
                                if (event.keyCode === 13) {
                                    document.getElementById("signup-btn").click();
                                }
                            });

                        </script>
                </li>
            </ul>
        </div>



        <!-- /.navbar-collapse -->
    </div>
    </div>
    </div>
    <div id="menu-search-mobile">
        <div class="col-xs-12 col-sm-12">
                
                <div class="col-xs-11 col-sm-11" >
                </div>
                <div class="col-xs-1 col-sm-1 remove-padding font-menu">
                    <div class="pull-right ptop8" onclick="search_mobile('<?php echo \yii\helpers\Url::base(); ?>/category/search?q=')"><img class="arrow-down-watches" src="https://thewatch.imgix.net/icons/search-01.png?auto=compress&fit=max"></div>
                </div>
            </div>
    </div>
    <!-- revisibaru -->
    <div class="col-xs-12 hidden-lg hidden-md hidden-sm bulkhead-menu-mobile" id="navbar-main">
        <div id="bulkhead-flagship" class="container">
            <div class="row">
                <div class="hidden-lg col-xs-12 clearleft-mobile">
                    <div class="col-xs-4 free-shipping clearright-mobile">
                        <a href="#" class="text-bulkhead ">
                            <div class="box-bulkhead-top-mobile">
                                <i class="box-bulkhead-mobile"></i>
                                <span class="box-bulkhead-mobile-text">GRATIS <br> PENGIRIMAN</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-xs-4 lifetime-bateray ptop-1 clearright-mobile pleft10p">
                        <a href="#" class="text-bulkhead ">
                            <div class="box-bulkhead-top-mobile">
                                <i class="watch-bulkhead-mobile"></i>
                                <span class="box-bulkhead-mobile-text">GANTI BATERAI <br> SEUMUR HIDUP</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-xs-4 installments ptop-15 clearright-mobile pleft10p">
                        <a href="#" class="text-bulkhead ">
                            <div class="box-bulkhead-top-mobile">
                                <i class="card-bulkhead-mobile"></i>
                                <span class="box-bulkhead-mobile-text">NIKMATI <br> CICILAN 0%</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 hidden-xs hidden-lg col-md-12 bulkhead-menu-sm">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-4 free-shipping">
                        <a href="#" class="text-bulkhead ">
                            <i class="box-bulkhead"></i>
                            <span class="box-bulkhead-sm-text">FREE SHIPPING</span>
                        </a>
                    </div>
                    <div class="col-sm-4 lifetime-bateray ptop-1">
                        <a href="#" class="text-bulkhead ">
                            <i class="watch-bulkhead"></i>
                            <span class="box-bulkhead-sm-text">LIFETIME BATTERY</span>
                        </a>
                    </div>
                    <div class="col-sm-4 installments ptop-15">
                        <a href="#" class="text-bulkhead ">
                            <i class="card-bulkhead"></i>
                            <span class="box-bulkhead-sm-text">0% INSTALLMENT</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- menu list desktop -->
                           <?php $i = 1; ?>
                <?php if (count($data) > 0) { ?>
                    <?php foreach ($data as $row) { ?>
                        <?php 
                        if($row->product_category_name == 'sale'){ 
                            continue;
                        }
                        ?>

                    <div class="arrow-nav bgtransparent" id="arrow-<?php echo $row->product_category_name; ?>"></div>
                        <?php if($row->product_category_name != 'brands'){ ?>
                            <section class="mn-header submenu hidden-xs height375" id="box-<?php echo $row->product_category_name; ?>">
                                <div class="container conheader">
                                    <div class="row">
                                        <?php
                                            $images = \backend\models\CategoryMenuPicture::find()->where(['product_category_id'=>$row->product_category_id])->andWhere(['category_menu_picture_status' => 1])->all();
                                            $left = "col-lg-6";
                                            $right = "col-lg-6";
                                            $imgin = "col-lg-6";
                                            if(count($images) <= 1){
                                                $left = "col-lg-10";
                                                $right = "col-lg-2";
                                                $imgin = "col-lg-12";
                                            }
                                            ?>

                                        <div class="<?php echo $left; ?> pleft0 left">
                                            <div class="col-lg-2 col-md-3 col-sm-3 pleft0 fsize-13">
                                                <div class="brands caption">EXPLORE</div>
                                                <ul class="mn-header brands pleft0 mtop0">
                                                    
                                                    <li><a href="<?php echo \yii\helpers\Url::base() . '/' . $row->product_category_name . '/all-product'; ?>" class="gotham-light">All Products</a></li>
                                                    <li><a href="<?php echo \yii\helpers\Url::base() . '/' . $row->product_category_name . '/new-arrival'; ?>" class="gotham-light">New Arrival</a></li>
                                                    <li><a href="<?php echo \yii\helpers\Url::base() . '/' . $row->product_category_name . '/best-seller'; ?>" class="gotham-light">Best Sellers</a></li>
                                                    <?php if($row->product_category_name == 'watches'){
                                                    ?>
                                                        <!--<li><a href="<?php echo \yii\helpers\Url::base(); ?>/dwpetite" class="gotham-medium white">PRE-ORDER</a></li>-->
                                                    <?php }?>
                                                    
                                                    <li><a href="<?php echo \yii\helpers\Url::base() . '/' . $row->product_category_name . '/sale'; ?>" class="gotham-light fcolore36969">SALE</a></li>
                                                </ul>
                                                <div class="ptop20"></div>

                                                <?php
                                                    $kategori = \backend\models\CategoryMenu::find()->where(['product_category_id'=>$row->product_category_id])->all();
                                                    foreach ($kategori as $kat) {
                                                        ?>
                                                        <div class="brands caption fsize-0-95"><?php echo strtoupper($kat->category_menu_name); ?></div>
                                                        <?php

                                                        $mapping = \backend\models\CategoryMenuMapping::find()->where(['category_menu_id'=>$kat->category_menu_id])->all();
                                                        

                                                        ?>
                                                        <ul class="mn-header brands pleft0 mtop0">
                                                            <?php 
                                                            $mpi = 0;
                                                            foreach ($mapping as $map) {
                                                               $sub = \backend\models\CategoryMenuChild::find()->where(['category_menu_child_id'=>$map->category_menu_child_id])->one();
                                                            ?>
                                                            <li><a href="<?php echo $sub->category_menu_child_link; ?>" class="gotham-light fsize-0-8"><?php echo $sub->category_menu_child_name;?></a></li>
                                                            <?php 
                                                            $mpi++;
                                                                if($mpi == 5){
                                                                    break;
                                                                }
                                                            } ?>
                                                        </ul>
                                                        <?php
                                                    }
                                                    
                                                ?>
                                                
                                                
                                                    
                                                    
                                                                                                    


                                            </div>
                                            <?php
                                            $brands = ProductCategoryBrands::find()
                                                    ->select('product_category_brands.*')
                                                    ->leftJoin('brands', '`brands`.`brand_id` = `product_category_brands`.`brands_brand_id`')
                                                    ->where(['product_category_brands.product_category_category_id' => $row->product_category_id,
                                                             'brands.brand_status' => 'active'])
                                                    ->orderBy('brands.brand_name')
                                                    ->all();
                                            $tot_brands = count($brands);
                                            $half_tot = $tot_brands / 2;
                                            $lo = 1;
                                            if ($tot_brands > 0) {
                                                ?>
                                                <div class="col-lg-10 col-md-9 col-sm-9 pleft0 fsize-13">
                                                    <div class="brands caption">BRANDS</div>
                                                    <ul class="mn-header brands <?php if($row->product_category_name == 'accessories'){ echo 'col-lg-3 col-md-3 col-sm-3';}else{echo 'col-lg-3 col-md-3 col-sm-3';} ?> pleft0 mtop0">
                                                        <?php foreach ($brands as $brand) { ?>
                                                            <?php $brand_name = Brands::find()->where(array("brand_id" => $brand->brands_brand_id))->one(); ?>
                                                            <li>
                                                                <a class="gotham-light" href="<?php echo \yii\helpers\Url::base() . '/' . $row->product_category_name . '/brand/' . strtolower(str_replace(' ', '-', $brand_name->brand_name)); ?>">
                                                                    <?php echo $brand_name->brand_name; ?>
                                                                    <?php
                                                                    $brands_menu_type = [];
                                                                    if (strpos($brand_name->brands_menu_type, '-') !== false) {
                                                                        $brands_menu_type = explode("-",$brand_name->brands_menu_type);
                                                                        $brands_menu_type2 = "";
                                                                       
                                                                        // $model->brands_menu_type = $brands_menu_type[0];
                                                                    }
                                                                    $flag_w =  0;$flag_a =  0;$flag_s =  0;
                                                                    if(count($brands_menu_type) > 1){
                                                                        $menu_type = explode("+",$brands_menu_type[1]);
                                                                        for($i=0;$i<count($menu_type);$i++){
                                                                            if($menu_type[$i] == 'watches'){
                                                                                $flag_w =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'straps'){
                                                                                $flag_s =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'accessories'){
                                                                                $flag_a =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'jewelry'){
                                                                                $flag_a =  1;
                                                                            }
                                                                        }
                                                                    }
                        
                                                                    if(($flag_w == 1 && $row->product_category_id == 5) || ($flag_s == 1 && $row->product_category_id == 6) || ($flag_a == 1 && $row->product_category_id == 7) || ($flag_a == 1 && $row->product_category_id == 12)){
                                                                        if($brands_menu_type[0] == 'new'){
                                                                        ?>
                                                                            <span class="menu-super"> NEW</span>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if($brands_menu_type[0] == 'hot'){
                                                                            ?>
                                                                            <span class="menu-super"> HOT</span>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if($brands_menu_type[0] == 'sale'){
                                                                            ?>
                                                                            <span class="menu-super-sale"> SALE</span>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    
                                                                    ?>
                                                                </a>
                                                            </li>
                                                            <?php 
                                                            if($lo == 14){
                                                                
                                                                ?>
                                                                </ul>
                                                                <ul class="mn-header brands <?php if($row->product_category_name == 'accessories'){ echo 'col-lg-6 col-md-6 col-sm-6';}else{echo 'col-lg-3 col-md-3 col-sm-3';} ?> pleft0 mtop0">
                                                                <?php
                                                                $lo = 0;
                                                            }
                                                            ?>
                                                        <?php $lo++; } ?>
                                                    </ul>
                                                </div>
                                        <?php } ?>
                                        </div>
                                        <div class="<?php echo $right; ?> pleft0 pright0">
                                            
                                            <?php $imi = 0; ?>
                                            <?php foreach ($images as $img) {
                                               ?>
                                               <div class="<?php echo $imgin; ?> pleft0 pright0">
                                                   <img class="relative" src="<?php echo \yii\helpers\Url::base(); ?>/img/header/<?php echo $img->category_menu_picture_image;?>" class="col-lg-12 pleft0 pright0" />
                                                    <div class="col-lg-12 header-title overlay-text"><?php echo strtoupper($img->category_menu_picture_name);?></div>
                                                    <div class="col-lg-12 header-text overlay-text"><?php echo $img->category_menu_picture_text;?></div>
                                                    <div class="col-lg-12 shop overlay-text"><a class="fcolorfff" href="<?php echo $img->category_menu_picture_link;?>">SHOP NOW</a></div>
                                               </div>
                                               <?php
                                               $imi++;
                                               if($imi == 2){
                                                break;
                                               }
                                            }
                                            ?>
                                            
                                    
                                            <!-- <img src="<?php echo \yii\helpers\Url::base(); ?>/img/header/header-img2.jpg" class="col-lg-6 pleft0 pright0" /> -->
                                        </div>
                                    </div>
                                 </div>
                            </section>
                            <?php }?>
                            
                        <?php $i++; ?>
                    <?php } ?>
                <?php } ?>

                <section class="mn-header submenu hidden-xs height375" id="box-brands">
                                <div class="container conheader">
                                    <div class="row">
                                        
                                        
                                            
                                            <?php
                                            $brands_watch = ProductCategoryBrands::find()
                                                    ->select('product_category_brands.*')
                                                    ->leftJoin('brands', '`brands`.`brand_id` = `product_category_brands`.`brands_brand_id`')
                                                    ->where([
                                                             'brands.brand_status' => 'active'])
                                                    ->andWhere(['product_category_brands.product_category_category_id'=>5])
                                                    ->orderBy('brands.brand_name')
                                                    ->groupBy('brands.brand_name')
                                                    ->all();
                                            $brands_strap = ProductCategoryBrands::find()
                                                    ->select('product_category_brands.*')
                                                    ->leftJoin('brands', '`brands`.`brand_id` = `product_category_brands`.`brands_brand_id`')
                                                    ->where([
                                                             'brands.brand_status' => 'active'])
                                                    ->andWhere(['product_category_brands.product_category_category_id'=>6])
                                                    ->orderBy('brands.brand_name')
                                                    ->groupBy('brands.brand_name')
                                                    ->all();
                                            $brands_accessories = ProductCategoryBrands::find()
                                                    ->select('product_category_brands.*')
                                                    ->leftJoin('brands', '`brands`.`brand_id` = `product_category_brands`.`brands_brand_id`')
                                                    ->where([
                                                             'brands.brand_status' => 'active'])
                                                    ->andWhere(['product_category_brands.product_category_category_id'=>7])
                                                    ->orderBy('brands.brand_name')
                                                    ->groupBy('brands.brand_name')
                                                    ->all();
                                            $brands_jewelry = ProductCategoryBrands::find()
                                                    ->select('product_category_brands.*')
                                                    ->leftJoin('brands', '`brands`.`brand_id` = `product_category_brands`.`brands_brand_id`')
                                                    ->where([
                                                             'brands.brand_status' => 'active'])
                                                    ->andWhere(['product_category_brands.product_category_category_id'=>12])
                                                    ->orderBy('brands.brand_name')
                                                    ->groupBy('brands.brand_name')
                                                    ->all();
                                            $tot_brands = count($brands_watch);
                                            $half_tot = $tot_brands / 2;
                                            $lo = 1;
                                            if ($tot_brands > 0) {
                                                ?>
                                                <div class="col-lg-12 col-md-12 col-sm-12 pleft0 pbottom2">
                                                    <ul class="mn-header brands col-lg-2 col-md-2 col-sm-2 pleft0 pright0 mtop0">
                                                        <li class="brands caption title">JAM TANGAN</li>
                                                        <?php foreach ($brands_watch as $brand) { ?>
                                                            <?php $brand_name = Brands::find()->where(array("brand_id" => $brand->brands_brand_id))->one(); ?>
                                                            <li>
                                                                <a class="gotham-light" href="<?php echo \yii\helpers\Url::base() . '/brand/' . strtolower(str_replace(' ', '-', $brand_name->brand_name)); ?>">
                                                                    <?php echo $brand_name->brand_name; ?>
                                                                    <?php
                                                                    $brands_menu_type = [];
                                                                    if (strpos($brand_name->brands_menu_type, '-') !== false) {
                                                                        $brands_menu_type = explode("-",$brand_name->brands_menu_type);
                                                                        $brands_menu_type2 = "";
                                                                       
                                                                        // $model->brands_menu_type = $brands_menu_type[0];
                                                                    }
                                                                    $flag_w =  0;$flag_a =  0;$flag_s =  0;
                                                                    if(count($brands_menu_type) > 1){
                                                                        $menu_type = explode("+",$brands_menu_type[1]);
                                                                        for($i=0;$i<count($menu_type);$i++){
                                                                            if($menu_type[$i] == 'watches'){
                                                                                $flag_w =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'straps'){
                                                                                $flag_s =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'accessories'){
                                                                                $flag_a =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'jewelry'){
                                                                                $flag_a =  1;
                                                                            }
                                                                        }
                                                                    }
                        
																	if ( isset($brands_menu_type[0]) ) {
																		if($brands_menu_type[0] == 'new'){
																			?>
																			<span class="menu-super"> NEW</span>
																			<?php
																		}
																		if($brands_menu_type[0] == 'hot'){
																			?>
																			<span class="menu-super"> HOT</span>
																			<?php
																		}
																		if($brands_menu_type[0] == 'sale'){
																			?>
																			<span class="menu-super-sale"> SALE</span>
																			<?php
																		}
																	}
																			?>
                                                                </a>
                                                            </li>
                                                            <?php 
                                                            if($lo == 17){
                                                                
                                                                ?>
                                                                </ul>
                                                                <ul class="mn-header brands col-lg-2 col-md-2 col-sm-2 pleft0 pright0 mtop0">
                                                                    <li class="brands caption fsize-0-95 height25"></li>
                                                                <?php
                                                                $lo = 0;
                                                            }
                                                            ?>
                                                        <?php $lo++; } echo '</ul>'; ?>
                                                    </ul>
                                                    <?php $lo = 1; ?>
                                                    <ul class="mn-header brands col-lg-2 col-md-2 col-sm-2 pleft0 pright0 mtop0">
                                                        <li class="brands caption title">STRAP</li>
                                                        <?php foreach ($brands_strap as $brand) { ?>
                                                            <?php $brand_name = Brands::find()->where(array("brand_id" => $brand->brands_brand_id))->one(); ?>
                                                            <li>
                                                                <a class="gotham-light" href="<?php echo \yii\helpers\Url::base() . '/brand/' . strtolower(str_replace(' ', '-', $brand_name->brand_name)); ?>">
                                                                    <?php echo $brand_name->brand_name; ?>
                                                                    <?php
                                                                    $brands_menu_type = [];
                                                                    if (strpos($brand_name->brands_menu_type, '-') !== false) {
                                                                        $brands_menu_type = explode("-",$brand_name->brands_menu_type);
                                                                        $brands_menu_type2 = "";
                                                                       
                                                                        // $model->brands_menu_type = $brands_menu_type[0];
                                                                    }
                                                                    $flag_w =  0;$flag_a =  0;$flag_s =  0;
                                                                    if(count($brands_menu_type) > 1){
                                                                        $menu_type = explode("+",$brands_menu_type[1]);
                                                                        for($i=0;$i<count($menu_type);$i++){
                                                                            if($menu_type[$i] == 'watches'){
                                                                                $flag_w =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'straps'){
                                                                                $flag_s =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'accessories'){
                                                                                $flag_a =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'jewelry'){
                                                                                $flag_a =  1;
                                                                            }
                                                                        }
                                                                    }
                        
																	if ( isset($brands_menu_type[0]) ) {
																		if($brands_menu_type[0] == 'new'){
																			?>
																			<span class="menu-super"> NEW</span>
																			<?php
																		}
																		if($brands_menu_type[0] == 'hot'){
																			?>
																			<span class="menu-super"> HOT</span>
																			<?php
																		}
																		if($brands_menu_type[0] == 'sale'){
																			?>
																			<span class="menu-super-sale"> SALE</span>
																			<?php
																		}
																	}
																			?>
                                                                </a>
                                                            </li>
                                                            <?php 
                                                            if($lo == 17){
                                                                
                                                                ?>
                                                                </ul>
                                                                <ul class="mn-header brands col-lg-2 col-md-2 col-sm-2 pleft0 pright0 mtop0">
                                                                    <li class="brands caption fsize-0-95 height25"></li>
                                                                <?php
                                                                $lo = 0;
                                                            }
                                                            ?>
                                                        <?php $lo++; } echo '</ul>'; ?>
                                                    </ul>
                                                    <?php $lo = 1; ?>
                                                    <ul class="mn-header brands col-lg-2 col-md-2 col-sm-2 pleft0 pright0 mtop0">
                                                        <li class="brands caption title">PERHIASAN</li>
                                                        <?php foreach ($brands_jewelry as $brand) { ?>
                                                            <?php $brand_name = Brands::find()->where(array("brand_id" => $brand->brands_brand_id))->one(); ?>
                                                            <li>
                                                                <a class="gotham-light" href="<?php echo \yii\helpers\Url::base() . '/brand/' . strtolower(str_replace(' ', '-', $brand_name->brand_name)); ?>">
                                                                    <?php echo $brand_name->brand_name; ?>
                                                                    <?php
                                                                    $brands_menu_type = [];
                                                                    if (strpos($brand_name->brands_menu_type, '-') !== false) {
                                                                        $brands_menu_type = explode("-",$brand_name->brands_menu_type);
                                                                        $brands_menu_type2 = "";
                                                                       
                                                                        // $model->brands_menu_type = $brands_menu_type[0];
                                                                    }
                                                                    $flag_w =  0;$flag_a =  0;$flag_s =  0;
                                                                    if(count($brands_menu_type) > 1){
                                                                        $menu_type = explode("+",$brands_menu_type[1]);
                                                                        for($i=0;$i<count($menu_type);$i++){
                                                                            if($menu_type[$i] == 'watches'){
                                                                                $flag_w =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'straps'){
                                                                                $flag_s =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'accessories'){
                                                                                $flag_a =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'jewelry'){
                                                                                $flag_a =  1;
                                                                            }
                                                                        }
                                                                    }
																	
																	if ( isset($brands_menu_type[0]) ) {
																		if($brands_menu_type[0] == 'new'){
																			?>
																			<span class="menu-super"> NEW</span>
																			<?php
																		}
																		if($brands_menu_type[0] == 'hot'){
																			?>
																			<span class="menu-super"> HOT</span>
																			<?php
																		}
																		if($brands_menu_type[0] == 'sale'){
																			?>
																			<span class="menu-super-sale"> SALE</span>
																			<?php
																		}
																	}
																	?>
                                                                </a>
                                                            </li>
                                                            <?php 
                                                            if($lo == 17){
                                                                
                                                                ?>
                                                                </ul>
                                                                <ul class="mn-header brands col-lg-2 col-md-2 col-sm-2 pleft0 pright0 mtop0">
                                                                    <li class="brands caption fsize-0-95 height25"></li>
                                                                <?php
                                                                $lo = 0;
                                                            }
                                                            ?>
                                                        <?php $lo++; } echo '</ul>'; ?>
                                                    </ul>
                                                    <?php $lo = 1; ?>
                                                    <ul class="mn-header brands col-lg-2 col-md-2 col-sm-2 pleft0 pright0 mtop0">
                                                        <li class="brands caption title">AKSESORIS</li>
                                                        <?php foreach ($brands_accessories as $brand) { ?>
                                                            <?php $brand_name = Brands::find()->where(array("brand_id" => $brand->brands_brand_id))->one(); ?>
                                                            <li>
                                                                <a class="gotham-light" href="<?php echo \yii\helpers\Url::base() . '/brand/' . strtolower(str_replace(' ', '-', $brand_name->brand_name)); ?>">
                                                                    <?php echo $brand_name->brand_name; ?>
                                                                    <?php
                                                                    $brands_menu_type = [];
                                                                    if (strpos($brand_name->brands_menu_type, '-') !== false) {
                                                                        $brands_menu_type = explode("-",$brand_name->brands_menu_type);
                                                                        $brands_menu_type2 = "";
                                                                       
                                                                        // $model->brands_menu_type = $brands_menu_type[0];
                                                                    }
                                                                    $flag_w =  0;$flag_a =  0;$flag_s =  0;
                                                                    if(count($brands_menu_type) > 1){
                                                                        $menu_type = explode("+",$brands_menu_type[1]);
                                                                        for($i=0;$i<count($menu_type);$i++){
                                                                            if($menu_type[$i] == 'watches'){
                                                                                $flag_w =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'straps'){
                                                                                $flag_s =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'accessories'){
                                                                                $flag_a =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'jewelry'){
                                                                                $flag_a =  1;
                                                                            }
                                                                        }
                                                                    }
																	
																	if ( isset($brands_menu_type[0]) ) {
																		if($brands_menu_type[0] == 'new'){
																			?>
																			<span class="menu-super"> NEW</span>
																			<?php
																		}
																		if($brands_menu_type[0] == 'hot'){
																			?>
																			<span class="menu-super"> HOT</span>
																			<?php
																		}
																		if($brands_menu_type[0] == 'sale'){
																			?>
																			<span class="menu-super-sale"> SALE</span>
																			<?php
																		}
																	}
																			?>
                                                                </a>
                                                            </li>
                                                            <?php 
                                                            if($lo == 17){
                                                                
                                                                ?>
                                                                </ul>
                                                                <ul class="mn-header brands col-lg-2 col-md-2 col-sm-2 pleft0 pright0 mtop0">
                                                                    <li class="brands caption fsize-0-95 height25"></li>
                                                                <?php
                                                                $lo = 0;
                                                            }
                                                            ?>
                                                        <?php $lo++; } echo '</ul>'; ?>
                                                    </ul>
                                                </div>
                                        <?php } ?>
                                       
                                       
                                    </div>
                                 </div>
                            </section>
</nav>
<!-- close mobile menu -->
<nav id="c-menu--push-top" class="hidden-lg c-menu c-menu--push-top bgtransparent">
    <div id="c-menu-close-tab" class="hidden-xs">
        <img src="https://thewatch.imgix.net/close.png?auto=compress&fit=max" class="menu-close-tab">
    </div>
    <div id="c-menu-close-left" class="hidden-md hidden-sm">
        <img src="https://thewatch.imgix.net/close.png?auto=compress&fit=max" class="menu-close-left">
    </div>
    <!--<div id="c-menu-close-right" class="hidden-md hidden-sm hidden-xs" style="background-color: #9f8562;height:64px;border-bottom:solid 1px;width: 15%;float: right;">-->
    <!--    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/close.png" style="width: 20px;margin-top: 17px;z-index:240;">-->
    <!--</div>-->
</nav>
<!-- mobile menu -->

<nav id="c-menu--push-left" class="hidden-lg c-menu c-menu--push-left">
    <button id="btn-close-menu" class="c-menu__close"></button>
    <div id="main-menu" class="col-xs-12 col-sm-12 pleft0 pright0">
        <div class="col-xs-12 col-sm-12 col-md-12" style="padding-right:0; padding-left:0;">
            
                <!--
				<a href="<?php echo \yii\helpers\Url::base(); ?>">
                            <i class="logo-sprite mleft0" id="logotwc"></i>
                </a> -->
				
				<div class="menu-mobile-title">
					Menu
				</div>		

                <div id="c-menu-close-right">
                    <i class="close-black-sprites"></i>
                </div>

                <div class="clearfix"></div>
                <div class="col-xs-4  pright75-header">
                    <a href="<?php echo \yii\helpers\Url::base() . '/watches/all-product?&gender=male&price=0--50000000&sortby=none&page=1&limit=20'; ?>" class="blue-round width100 talign-center width100 line-height15">MEN</a>
                </div>
                <div class="col-xs-4  pright75-header">
                    <a href="<?php echo \yii\helpers\Url::base() . '/watches/all-product?&gender=unisex&price=0--50000000&sortby=none&page=1&limit=20'; ?>" class="blue-round width100 talign-center width100 line-height15">UNISEKS</a>
                </div>
                <div class="col-xs-4  pleft75-header">
                    <a href="<?php echo \yii\helpers\Url::base() . '/watches/all-product?&gender=female&price=0--50000000&sortby=none&page=1&limit=20'; ?>" class="blue-round width100 talign-center width100 line-height15">WOMEN</a>
                </div>
                <?php
				/*
                    if (!isset($_SESSION['customerInfo'])) {
                        ?>
                        <div onclick="login_signup_menu()" class="col-xs-12 clearleft-mobile ptop5p">
                           
                            <!--<i class="account-mobile"></i> -->
                            <i class="sign-up-mobile-sprites"></i>
                            <div class="sign-up-login-text layer1">
                                        
                                    Masuk / Daftar</div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="col-xs-12 clearleft-mobile clearleft ptop8">
                            <?php echo isset($_SESSION['customerInfo']['fname']) ? 'Hi, ' . $_SESSION['customerInfo']['fname'] : ""; ?>
                        </div>
                        <?php
                    }
					*/
                    ?>
            </div>
        </div>
        <div class="col-xs-12 clearright-mobile clearleft-mobile clearright clearleft">
                        <?php
                if (!isset($_SESSION['customerInfo'])) {
                    ?>
                  
                    <?php
                } else {
                    ?>
					<!--
                    <div id="account-mobile" class="col-xs-12 col-sm-12">
                        <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                            Akun Saya <div class="ardown"><img class="arrow-down-account" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-arrow-16.png"></div>
							-->
                         <!--    <div class="text-gotham-medium pull-left"><a href="<?php echo \yii\helpers\Url::base(); ?>/user/profile"><?php echo isset($_SESSION['customerInfo']['fname']) ? 'Hi, ' . $_SESSION['customerInfo']['fname'] : ""; ?></a></div>
                            <div class="text-gotham-light pull-right"><a href="<?php echo \yii\helpers\Url::base(); ?>/user/sign-out">(Sign Out)</a></div> -->
						<!--
						</div>
                    </div> -->
                    <div id="list-account" class="bgcolorfff col-xs-12 col-sm-12 dnone">
                               
                                <div class="col-xs-12 col-sm-12 slidedown-menu submenu clearleft-mobile clearright-mobile clearright clearleft">
                                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/profile">Profil Saya</a>
                                </div>
                                <div class="col-xs-12 col-sm-12 slidedown-menu submenu clearleft-mobile clearright-mobile clearright clearleft">
                                    <?php 
                                    $session_total_order = 0;
                                    if (isset($_SESSION['customerInfo']['total_orders'])){ 
                                        $session_total_order = $_SESSION['customerInfo']['total_orders'];
                                    }
                                    ?>
                                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/orders">Daftar Transaksi
                                    <?php if($session_total_order != 0){ ?>
                                        <span class="total-order-super"><?php echo $session_total_order; ?></span>
                                    <?php } ?>
                                    </a>
                                </div>
                                <div class="col-xs-12 col-sm-12 slidedown-menu submenu clearleft-mobile clearright-mobile clearright clearleft">
                                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/shipping">Shipping Information</a>
                                </div>
                                <!--<div class="col-xs-12 col-sm-12" style="padding-right: 0px; padding-top: 8%;">
                                    <a href="<?php echo \yii\helpers\Url::base(); ?>/dwpetite">Pre-Order</a>
                                </div>-->
                                <div class="col-xs-12 col-sm-12 slidedown-menu submenu clearleft-mobile clearright-mobile clearright clearleft">
                                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/sign-out">Sign Out</a>
                                </div>
                                
                           
                    </div>
                    <?php
                }
                ?>
            <div class="menu-mobile-wrap">
				<div class="menu-sidebar">
					<div id="watches-mobile-custom" class="menu-sidebar-item active">
						<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/nav-category/jam.png">
						Jam
					</div>
					<div id="straps-mobile-custom" class="menu-sidebar-item">
						<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/nav-category/strap.png">
						Strap
					</div>
					<div id="accessories-mobile-custom" class="menu-sidebar-item">
						<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/nav-category/accessories.png">
						Aksesoris
					</div>
                    <div id="jewelry-mobile-custom" class="menu-sidebar-item">
						<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/nav-category/perhiasan.png">
						Perhiasan
					</div>
					
					
					<div id="brands-mobile-custom" class="menu-sidebar-item">
						<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/nav-category/brand.png">
						Brand
					</div>
					<div id="jurnal-mobile-custom" class="menu-sidebar-item">
						<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/nav-category/jurnal.png">
						Jurnal
					</div>
					<div class="menu-sidebar-item" onclick="window.location = '/sale'">
						<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/nav-category/sale.png">
						Sale
					</div>
				</div>
				<div class="menu-child">
					<?php
        $watch = [];$strap = []; $accessori = [];
        $watch_na = [];$strap_na = []; $accessori_na = [];
        ?>
        <div id="list-watches-custom" class="-act list-watches list-custom" >
            <div class="col-xs-12 col-sm-12 ptop10">
                

                <div id="c-menu-close-tier-watch">
                   
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 ptop10">
                    <div id="close-watches" class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                            
                            <a>Jam Tangan</a>
                        </div>
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/watches/all-product">
                        <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                            All Products
                        </div>
                    </a>
                     <a href="<?php echo \yii\helpers\Url::base(); ?>/watches/new-arrival">
                        <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                           New Arrival
                        </div>
                    </a>
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/watches/best-seller">
                        <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                            Best Sellers
                        </div>
                    </a>
                    <!--<div class="col-xs-12 col-sm-12" style="padding-right: 0px; padding-top: 8%;">
                        <a href="<?php echo \yii\helpers\Url::base(); ?>/dwpetite">Pre-Order</a>
                    </div>-->
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/watches/sale">
                        <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft fcolore36969">
                            Sale
                        </div>
                    </a>
                    <?php
                        $kategori = \backend\models\CategoryMenu::find()->where(['product_category_id'=>5])->all();
                        $i = 0;
                        foreach ($kategori as $row) {
                           ?>
                           <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                                <div onclick="sliding('watches-<?php echo $row->category_menu_name;?>')"><?php echo strtoupper($row->category_menu_name); ?><div class="ardown"><i class="right-sprites-black-6"></i></div></div>
                            </div>
                           <?php
                           $watch[$i] = $row->category_menu_id;
                           $watch_na[$i] = $row->category_menu_name;
                           $i++;
                        }
                        ?>
                    <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                        <div id="watches-brands">Brands<div class="ardown"><i class="right-sprites-black-6"></i></div></div>
                    </div>
            </div>  
        </div>
        <div id="list-straps-custom" class="-act list-straps list-custom" >
            <div class="col-xs-12 col-sm-12 ptop10">
               

                <div id="c-menu-close-tier-strap">
                   
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 ptop10">
                   <div id="close-straps" class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                            
                            
                            <a>Strap</a>
                        </div>
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/straps/all-product">
                        <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                            All Products
                        </div>
                    </a>
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/straps/new-arrival">
                        <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                            New Arrival
                        </div>
                    </a>
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/straps/best-seller">
                        <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                            Best Sellers
                        </div>
                    </a>
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/straps/sale">
                        <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft fcolore36969">
                            Sale
                        </div>
                    </a>
                    <?php
                        $kategori = \backend\models\CategoryMenu::find()->where(['product_category_id'=>6])->all();
                        $i = 0;
                        foreach ($kategori as $row) {
                           ?>
                           <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                                <div onclick="sliding('straps-<?php echo $row->category_menu_name;?>')" class="fcolore36969"><?php echo strtoupper($row->category_menu_name); ?><div class="ardown"><i class="right-sprites-black-6"></i></div></div>
                            </div>
                           <?php
                           $strap[$i] = $row->category_menu_id;
                           $strap_na[$i] = $row->category_menu_name;
                           $i++;
                        }
                        ?>
                    <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                        <div id="straps-brands">Brands<div class="ardown"><i class="right-sprites-black-6"></i></div></div>
                    </div>
            </div>
        </div>
        <div id="list-accessories-custom" class="-act list-straps list-custom" >
            <div class="col-xs-12 col-sm-12 ptop10">
                

                <div id="c-menu-close-tier-accessories">
                    
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 ptop10">
                   <div id="close-accessories" class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                           
                            
                            <a>Aksesoris</a>
                        </div>
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/accessories/all-product">
                       <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                            All Products
                        </div>
                    </a>
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/accessories/new-arrival">
                        <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobil clearright clearleft">
                            New Arrival
                        </div>
                    </a>
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/accessories/best-seller">
                       <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                            Best Sellers
                        </div>
                    </a>
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/accessories/sale">
                       <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft fcolore36969">
                            Sale
                        </div>
                    </a>
                    <?php
                        $kategori = \backend\models\CategoryMenu::find()->where(['product_category_id'=>7])->all();
                         $i = 0;
                        foreach ($kategori as $row) {
                           ?>
                         <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                                <div onclick="sliding('accesssories-<?php echo $row->category_menu_name;?>')" class="fcolore36969"><?php echo strtoupper($row->category_menu_name); ?><div class="ardown"><i class="right-sprites-black-6"></i></div></div>
                            </div>
                           <?php
                           $accessori[$i] = $row->category_menu_id;
                           $accessori_na[$i] = $row->category_menu_name;
                           $i++;
                        }
                        ?>
                   <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                        <div id="accessories-brands">Brands<div class="ardown"><i class="right-sprites-black-6"></i></div></div>
                    </div>
            </div>  
        </div>

        <div id="list-jewelry-custom" class="-act list-jewelry list-custom" >
            <div class="col-xs-12 col-sm-12 ptop10">
                

                <div id="c-menu-close-tier-jewelry">
                    
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 ptop10">
                   <div id="close-jewelry" class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                           
                            
                            <a>Perhiasan</a> 
                        </div>
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/jewelry/all-product">
                       <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                            All Products
                        </div>
                    </a>
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/jewelry/new-arrival">
                        <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobil clearright clearleft">
                            New Arrival
                        </div>
                    </a>
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/jewelry/best-seller">
                       <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                            Best Sellers
                        </div>
                    </a>
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/jewelry/sale">
                       <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft fcolore36969">
                            Sale
                        </div>
                    </a>
                    <?php
                        $kategori = \backend\models\CategoryMenu::find()->where(['product_category_id'=>7])->all();
                         $i = 0;
                        foreach ($kategori as $row) {
                           ?>
                         <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                                <div onclick="sliding('accesssories-<?php echo $row->category_menu_name;?>')" class="fcolore36969"><?php echo strtoupper($row->category_menu_name); ?><div class="ardown"><i class="right-sprites-black-6"></i></div></div>
                            </div>
                           <?php
                           $accessori[$i] = $row->category_menu_id;
                           $accessori_na[$i] = $row->category_menu_name;
                           $i++;
                        }
                        ?>
                   <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                        <div id="jewelry-brands">Brands<div class="ardown"><i class="right-sprites-black-6"></i></div></div>
                    </div>
            </div> 
        </div>

        <div id="list-brands-custom" class="-act list-straps " >
            <div class="col-xs-12 col-sm-12 ptop10">
              

                <div id="c-menu-close-tier-brand"> 
                    
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 ptop10">
                <div id="close-list-brands" class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft width100">
                            
                            
                        <a href="<?php echo \yii\helpers\Url::base(); ?>/brands" onclick="location.href = '<?php echo \yii\helpers\Url::base(); ?>/brands';">Brands</a>
                        </div>
                       
            </div>
            <div class="col-xs-12 col-sm-12 brand-height">
                    <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                        <div id="all-brands">All Brands<div class="ardown"><i class="right-sprites-black-6"></i></div></div>
                    </div>
                    <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                        <div id="watches-brand-brands">Jam<div class="ardown"><i class="right-sprites-black-6"></i></div></div>
                    </div>
                    <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                        <div id="straps-brand-brands">Strap<div class="ardown"><i class="right-sprites-black-6"></i></div></div>
                    </div>
                    <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                        <div id="accessories-brand-brands">Aksesoris<div class="ardown"><i class="right-sprites-black-6"></i></div></div>
                    </div>
                    <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                        <div id="jewelry-brand-brands">Perhiasan<div class="ardown"><i class="right-sprites-black-6"></i></div></div>
                    </div>
            </div>
        </div> 
        
        <div id="list-jurnal-custom" class="-act list-straps " >
            <div class="col-xs-12 col-sm-12 ptop10">
              

                <div id="c-menu-close-tier-brand">
                     
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 ptop10">
                <div id="close-jurnal" class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft width100">
                            
                            
                            <a>Jurnal</a>
                        </div>
                       
            </div>
            <div class="col-xs-12 col-sm-12 brand-height">
                <a href="<?php echo \yii\helpers\Url::base() . '/journal'?>">
                    <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                        All Journal
                    </div>
                </a>
                    <?php
                    
                    $journalCategoryList = \backend\models\JournalCategory::findAll(["journal_category_status" => '1']);
                    foreach ($journalCategoryList as $row) {
                        ?>
                        <a href="<?php echo \yii\helpers\Url::base() . '/journal/category/' . strtolower(str_replace(' ', '-', $row->journal_category_name)); ?>">
                        <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                            <!--<a href="<?php //echo \yii\helpers\Url::base(); ?>/watches/brand/<?php //echo $row->brands->link_rewrite; ?>"><?php //echo $row->brands->brand_name; ?></a>-->
                            <?php echo ucwords(strtolower(($row->journal_category_name))); ?>
                            
                        </div>
                        </a>
                        <?php
                    }
                    ?>
            </div>
        </div>         


        
        <div id="list-watches-brands" class="-act list-watches-brands" >
            <div class="col-xs-12 col-sm-12 ptop10">
                
                <div id="c-menu-close-tier-watch-brand">
                   
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 ptop10">
                <div id="close-watches-brands" class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft width100">
                            <div class="ardown pull-left"><i class="left-sprites-black-6"></i></div>
                            
                            <a>Jam Tangan / Brands</a>
                        </div>
                        
            </div>
            <div class="col-xs-12 col-sm-12 brand-height">
                    <?php
                    $brands = \backend\models\ProductCategoryBrands::find()->joinWith(['brands'])->where(['product_category_category_id' => '5'])->andWhere(['brands.brand_status'=>'active'])->orderBy('brands.brand_name')->all();
                    foreach ($brands as $row) {
                        if($row->brands->brand_name != ''){
                        ?>
                        <a href="<?php echo \yii\helpers\Url::base() . '/watches/brand/' . strtolower(str_replace(' ', '-', $row->brands->brand_name)); ?>">
                        <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                            <!--<a href="<?php //echo \yii\helpers\Url::base(); ?>/watches/brand/<?php //echo $row->brands->link_rewrite; ?>"><?php //echo $row->brands->brand_name; ?></a>-->
                            <?php echo ucwords(strtolower(($row->brands->brand_name))); ?>
                                
                                <?php
                                        $brands_menu_type = [];
                                                                    if (strpos($row->brands->brands_menu_type, '-') !== false) {
                                                                        $brands_menu_type = explode("-",$row->brands->brands_menu_type);
                                                                        $brands_menu_type2 = "";
                                                                       
                                                                        // $model->brands_menu_type = $brands_menu_type[0];
                                                                    }
                                                                    $flag_w =  0;$flag_a =  0;$flag_s =  0;
                                                                    if(count($brands_menu_type) > 1){
                                                                        $menu_type = explode("+",$brands_menu_type[1]);
                                                                        for($i=0;$i<count($menu_type);$i++){
                                                                            if($menu_type[$i] == 'watches'){
                                                                                $flag_w =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'straps'){
                                                                                $flag_s =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'accessories'){
                                                                                $flag_a =  1;
                                                                            }
                                                                        }
                                                                    }
                                                                    if($flag_w == 1){
                                                                        if($brands_menu_type[0] == 'new'){
                                                                            ?>
                                                                            <span class="menu-super-mobile"> NEW</span>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if($brands_menu_type[0] == 'hot'){
                                                                            ?>
                                                                            <span class="menu-super-mobile"> HOT</span>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if($brands_menu_type[0] == 'sale'){
                                                                            ?>
                                                                            <span class="menu-super-sale-mobile"> SALE</span>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    
                                                                ?>
                                
                            
                        </div>
                        </a>
                        <?php
                        }
                    }
                    ?>
            </div>
        </div>

        <div id="list-straps-brands" class="-act list-straps-brands" >
            <div class="col-xs-12 col-sm-12 ptop10">
               

                <div id="c-menu-close-tier-strap-brand">
                   
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 ptop10">
                <div id="close-straps-brands" class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft width100">
                            <div class="ardown pull-left"><i class="left-sprites-black-6"></i></div>
                            
                            <a>Strap / Brands</a>
                        </div>
                        
            </div>
            <div class="col-xs-12 col-sm-12 brand-height">
                    <?php
                    $brands = \backend\models\ProductCategoryBrands::find()->joinWith(['brands'])->where(['product_category_category_id' => '6'])->andWhere(['brands.brand_status'=>'active'])->orderBy('brands.brand_name')->all();
                    foreach ($brands as $row) {
                        if($row->brands->brand_name != ''){
                        ?>
                        <a href="<?php echo \yii\helpers\Url::base() . '/straps/brand/' . strtolower(str_replace(' ', '-', $row->brands->brand_name)); ?>">
                        <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                            <!--<a href="<?php //echo \yii\helpers\Url::base(); ?>/watches/brand/<?php //echo $row->brands->link_rewrite; ?>"><?php //echo $row->brands->brand_name; ?></a>-->
                            <?php echo ucwords(strtolower(($row->brands->brand_name))); ?>
                                <?php
                                        $brands_menu_type = [];
                                                                    if (strpos($row->brands->brands_menu_type, '-') !== false) {
                                                                        $brands_menu_type = explode("-",$row->brands->brands_menu_type);
                                                                        $brands_menu_type2 = "";
                                                                       
                                                                        // $model->brands_menu_type = $brands_menu_type[0];
                                                                    }
                                                                    $flag_w =  0;$flag_a =  0;$flag_s =  0;
                                                                    if(count($brands_menu_type) > 1){
                                                                        $menu_type = explode("+",$brands_menu_type[1]);
                                                                        for($i=0;$i<count($menu_type);$i++){
                                                                            if($menu_type[$i] == 'watches'){
                                                                                $flag_w =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'straps'){
                                                                                $flag_s =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'accessories'){
                                                                                $flag_a =  1;
                                                                            }
                                                                        }
                                                                    }
                                                                    if($flag_s == 1){
                                                                        if($brands_menu_type[0] == 'new'){
                                                                            ?>
                                                                            <span class="menu-super-mobile"> NEW</span>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if($brands_menu_type[0] == 'hot'){
                                                                            ?>
                                                                            <span class="menu-super-mobile"> HOT</span>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if($brands_menu_type[0] == 'sale'){
                                                                            ?>
                                                                            <span class="menu-super-sale-mobile"> SALE</span>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    
                                                                ?>
                            
                        </div>
                        </a>
                        <?php
                        }
                    }
                    ?>
            </div>
        </div>

        <div id="list-accessories-brands" class="-act list-straps-brands" >
            <div class="col-xs-12 col-sm-12 ptop10">
                

                <div id="c-menu-close-tier-accessories-brand">
                   
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 ptop10">
                <div id="close-accessories-brands" class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft width100">
                            <div class="ardown pull-left"><i class="left-sprites-black-6"></i></div>
                            
                            <a>Aksesoris / Brands</a>
                        </div>
                       
            </div>
            <div class="col-xs-12 col-sm-12 brand-height">
                    <?php
                    $brands = \backend\models\ProductCategoryBrands::find()->joinWith(['brands'])->where(['product_category_category_id' => '7'])->andWhere(['brands.brand_status'=>'active'])->orderBy('brands.brand_name')->all();
                    foreach ($brands as $row) {
                        if($row->brands->brand_name != ''){
                        ?>
                        <a href="<?php echo \yii\helpers\Url::base() . '/accessories/brand/' . strtolower(str_replace(' ', '-', $row->brands->brand_name)); ?>">
                        <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                            <!--<a href="<?php //echo \yii\helpers\Url::base(); ?>/watches/brand/<?php //echo $row->brands->link_rewrite; ?>"><?php //echo $row->brands->brand_name; ?></a>-->
                            <?php echo ucwords(strtolower(($row->brands->brand_name))); ?>
                            
                                <?php
                                        $brands_menu_type = [];
                                                                    if (strpos($row->brands->brands_menu_type, '-') !== false) {
                                                                        $brands_menu_type = explode("-",$row->brands->brands_menu_type);
                                                                        $brands_menu_type2 = "";
                                                                       
                                                                        // $model->brands_menu_type = $brands_menu_type[0];
                                                                    }
                                                                    $flag_w =  0;$flag_a =  0;$flag_s =  0;
                                                                    if(count($brands_menu_type) > 1){
                                                                        $menu_type = explode("+",$brands_menu_type[1]);
                                                                        for($i=0;$i<count($menu_type);$i++){
                                                                            if($menu_type[$i] == 'watches'){
                                                                                $flag_w =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'straps'){
                                                                                $flag_s =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'accessories'){
                                                                                $flag_a =  1;
                                                                            }
                                                                        }
                                                                    }
                                                                    if($flag_a == 1){
                                                                        if($brands_menu_type[0] == 'new'){
                                                                            ?>
                                                                            <span class="menu-super-mobile"> NEW</span>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if($brands_menu_type[0] == 'hot'){
                                                                            ?>
                                                                            <span class="menu-super-mobile"> HOT</span>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if($brands_menu_type[0] == 'sale'){
                                                                            ?>
                                                                            <span class="menu-super-sale-mobile"> SALE</span>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    
                                                                ?>
                           
                        </div>
                         </a>
                        <?php
                        }
                    }
                    ?>
            </div>
        </div>

        <div id="list-jewelry-brands" class="-act list-straps-brands" >
            <div class="col-xs-12 col-sm-12 ptop10">
                

                <div id="c-menu-close-tier-accessories-brand">
                   
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 ptop10">
                <div id="close-jewelry-brands" class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft width100">
                            <div class="ardown pull-left"><i class="left-sprites-black-6"></i></div>
                            
                            <a>Perhiasan / Brands</a>
                        </div>
                       
            </div>
            <div class="col-xs-12 col-sm-12 brand-height"> 
                    <?php
                    $brands = \backend\models\ProductCategoryBrands::find()->joinWith(['brands'])->where(['product_category_category_id' => '12'])->andWhere(['brands.brand_status'=>'active'])->orderBy('brands.brand_name')->all();
                    foreach ($brands as $row) {
                        if($row->brands->brand_name != ''){
                        ?>
                        <a href="<?php echo \yii\helpers\Url::base() . '/jewelry/brand/' . strtolower(str_replace(' ', '-', $row->brands->brand_name)); ?>">
                        <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                            <!--<a href="<?php //echo \yii\helpers\Url::base(); ?>/watches/brand/<?php //echo $row->brands->link_rewrite; ?>"><?php //echo $row->brands->brand_name; ?></a>-->
                            <?php echo ucwords(strtolower(($row->brands->brand_name))); ?>
                            
                                <?php
                                        $brands_menu_type = [];
                                                                    if (strpos($row->brands->brands_menu_type, '-') !== false) {
                                                                        $brands_menu_type = explode("-",$row->brands->brands_menu_type);
                                                                        $brands_menu_type2 = "";
                                                                       
                                                                        // $model->brands_menu_type = $brands_menu_type[0];
                                                                    }
                                                                    $flag_w =  0;$flag_a =  0;$flag_s =  0;
                                                                    if(count($brands_menu_type) > 1){
                                                                        $menu_type = explode("+",$brands_menu_type[1]);
                                                                        for($i=0;$i<count($menu_type);$i++){
                                                                            if($menu_type[$i] == 'watches'){
                                                                                $flag_w =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'straps'){
                                                                                $flag_s =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'accessories'){
                                                                                $flag_a =  1;
                                                                            }
                                                                        }
                                                                    }
                                                                    if($flag_a == 1){
                                                                        if($brands_menu_type[0] == 'new'){
                                                                            ?>
                                                                            <span class="menu-super-mobile"> NEW</span>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if($brands_menu_type[0] == 'hot'){
                                                                            ?>
                                                                            <span class="menu-super-mobile"> HOT</span>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if($brands_menu_type[0] == 'sale'){
                                                                            ?>
                                                                            <span class="menu-super-sale-mobile"> SALE</span>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    
                                                                ?>
                           
                        </div>
                         </a>
                        <?php
                        }
                    }
                    ?>
            </div>
        </div>

        <div id="list-all-brands" class="-act list-straps-brands" >
            <div class="col-xs-12 col-sm-12 ptop10">
                

                <div id="c-menu-close-tier-accessories-brand">
                   
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 ptop10">
                <div id="close-all-brands" class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft width100">
                            <div class="ardown pull-left"><i class="left-sprites-black-6"></i></div>
                            
                            <a>All Brands</a>
                        </div>
                       
            </div>
            <div class="col-xs-12 col-sm-12 brand-height"> 
                    <?php
                    $brands = \backend\models\ProductCategoryBrands::find()->joinWith(['brands'])->where(['brands.brand_status'=>'active'])->orderBy('brands.brand_name')->all();
                    foreach ($brands as $row) {
                        if($row->brands->brand_name != ''){
                        ?>
                        <a href="<?php echo \yii\helpers\Url::base() . '/jewelry/brand/' . strtolower(str_replace(' ', '-', $row->brands->brand_name)); ?>">
                        <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                            <!--<a href="<?php //echo \yii\helpers\Url::base(); ?>/watches/brand/<?php //echo $row->brands->link_rewrite; ?>"><?php //echo $row->brands->brand_name; ?></a>-->
                            <?php echo ucwords(strtolower(($row->brands->brand_name))); ?>
                            
                                <?php
                                        $brands_menu_type = [];
                                                                    if (strpos($row->brands->brands_menu_type, '-') !== false) {
                                                                        $brands_menu_type = explode("-",$row->brands->brands_menu_type);
                                                                        $brands_menu_type2 = "";
                                                                       
                                                                        // $model->brands_menu_type = $brands_menu_type[0];
                                                                    }
                                                                    $flag_w =  0;$flag_a =  0;$flag_s =  0;
                                                                    if(count($brands_menu_type) > 1){
                                                                        $menu_type = explode("+",$brands_menu_type[1]);
                                                                        for($i=0;$i<count($menu_type);$i++){
                                                                            if($menu_type[$i] == 'watches'){
                                                                                $flag_w =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'straps'){
                                                                                $flag_s =  1;
                                                                            }
                                                                            if($menu_type[$i] == 'accessories'){
                                                                                $flag_a =  1;
                                                                            }
                                                                        }
                                                                    }
                                                                    if($flag_a == 1){
                                                                        if($brands_menu_type[0] == 'new'){
                                                                            ?>
                                                                            <span class="menu-super-mobile"> NEW</span>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if($brands_menu_type[0] == 'hot'){
                                                                            ?>
                                                                            <span class="menu-super-mobile"> HOT</span>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if($brands_menu_type[0] == 'sale'){
                                                                            ?>
                                                                            <span class="menu-super-sale-mobile"> SALE</span>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    
                                                                ?>
                           
                        </div>
                         </a>
                        <?php
                        }
                    }
                    ?>
            </div>
        </div>


        <?php
            for ($i = 0; $i < count($watch); $i++) {
               ?>
               <div id="list-watches-<?php echo $watch_na[$i];?>" class="-act list-watches-watch" >
                    <div onclick="close_sliding('watches-<?php echo $watch_na[$i];?>')" class="col-xs-12 col-sm-12 slidedown-menu p15 close-sliding">
                            <div class="ardown pull-left"><i class="left-sprites-black-6"></i></div>
                            <a>JAM TANGAN / <?php echo strtoupper($watch_na[$i]); ?></a>
                        </div>
            <?php
                    $map = \backend\models\CategoryMenuMapping::find()->where(['category_menu_id' => $watch[$i]])->all();

                    foreach ($map as $row) {
                        $child = \backend\models\CategoryMenuChild::find()->where(['category_menu_child_id' => $row->category_menu_child_id])->one();

                        ?>
                        <a href="<?php echo $child->category_menu_child_link; ?>">
                        <div class="col-xs-12 col-sm-12 slidedown-menu p15">
                            <!--<a href="<?php //echo \yii\helpers\Url::base(); ?>/watches/brand/<?php //echo $row->brands->link_rewrite; ?>"><?php //echo $row->brands->brand_name; ?></a>-->
                            <?php echo strtoupper($child->category_menu_child_name); ?>
                        </div>
                        </a>
                        <?php
                    }
                    ?>
        </div>
               <?php
            }
        ?>
        <?php
            for ($i = 0; $i < count($strap); $i++) {
               ?>
               <div id="list-straps-<?php echo $strap_na[$i];?>" class="-act list-watches-watch" >
                    <div onclick="close_sliding('straps-<?php echo $strap_na[$i];?>')" class="col-xs-12 col-sm-12 slidedown-menu p15 close-sliding">
                            <div class="ardown pull-left"><i class="left-sprites-black-6"></i></div>
                            <a>STRAP / <?php echo strtoupper($strap_na[$i]); ?></a>
                        </div>
            <?php
                    $map = \backend\models\CategoryMenuMapping::find()->where(['category_menu_id' => $strap[$i]])->all();

                    foreach ($map as $row) {
                        $child = \backend\models\CategoryMenuChild::find()->where(['category_menu_child_id' => $row->category_menu_child_id])->one();

                        ?>
                        <a href="<?php echo $child->category_menu_child_link; ?>">
                        <div class="col-xs-12 col-sm-12 slidedown-menu p15">
                            <!--<a href="<?php //echo \yii\helpers\Url::base(); ?>/watches/brand/<?php //echo $row->brands->link_rewrite; ?>"><?php //echo $row->brands->brand_name; ?></a>-->
                            <?php echo strtoupper($child->category_menu_child_name); ?>
                        </div>
                        </a>
                        <?php
                    }
                    ?>
        </div>
               <?php
            }
        ?>

        <?php
            for ($i = 0; $i < count($accessori); $i++) {
               ?>
               <div id="list-accessories-<?php echo $accessori_na[$i];?>" class="-act list-watches-watch" >
                    <div onclick="close_sliding('accessories-<?php echo $accessori_na[$i];?>')" class="col-xs-12 col-sm-12 slidedown-menu p15 close-sliding">
                            <div class="ardown pull-left"><i class="left-sprites-black-6"></i></div>
                            <a>AKSESORIS / <?php echo strtoupper($accessori_na[$i]); ?></a>
                        </div>
            <?php
                    $map = \backend\models\CategoryMenuMapping::find()->where(['category_menu_id' => $accessori[$i]])->all();

                    foreach ($map as $row) {
                        $child = \backend\models\CategoryMenuChild::find()->where(['category_menu_child_id' => $row->category_menu_child_id])->one();

                        ?>
                        <a href="<?php echo $child->category_menu_child_link; ?>">
                        <div class="col-xs-12 col-sm-12 slidedown-menu p15"> 
                            <!--<a href="<?php //echo \yii\helpers\Url::base(); ?>/watches/brand/<?php //echo $row->brands->link_rewrite; ?>"><?php //echo $row->brands->brand_name; ?></a>-->
                            <?php echo strtoupper($child->category_menu_child_name); ?>
                        </div>
                        </a>
                        <?php
                    }
                    ?>
        </div>
               <?php
            }
        ?>
				</div>
			</div>
			<!--
            <div class="col-xs-12 col-sm-12">
                <div id="watches-mobile" class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
                    Jam Tangan <div class="ardown">
					<img class="arrow-down-watches" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-arrow-16.png">
					</div>
                    
                </div>
            </div>
            <div class="col-xs-12 col-sm-12">
                <div id="straps-mobile" class="col-xs-12 col-sm-12 slidedown-menu after clearleft-mobile clearright-mobile clearright clearleft">
                    Strap <div class="ardown"><img class="arrow-down-straps" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-arrow-16.png"></div>
                    
                </div>
            </div>
            <a href="<?php echo \yii\helpers\Url::base(); ?>/jewelry">
                <div class="col-xs-12 col-sm-12">
                    <div class="col-xs-12 col-sm-12 slidedown-menu after clearleft-mobile clearright-mobile clearright clearleft">
                        Perhiasan
                    </div>
                </div>
            </a>
            <div class="col-xs-12 col-sm-12">
                <div id="accessories-mobile" class="col-xs-12 col-sm-12 slidedown-menu after clearleft-mobile clearright-mobile clearright clearleft">
                    Aksesoris <div class="ardown"><img class="arrow-down-accessories" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-arrow-16.png"></div>
                    
                </div>
            </div>
            <div class="col-xs-12 col-sm-12">
                <div id="brands-mobile" class="col-xs-12 col-sm-12 slidedown-menu after clearleft-mobile clearright-mobile clearright clearleft">
                    Brand <div class="ardown"><img class="arrow-down-accessories" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-arrow-16.png"></div>
                    
                </div>
            </div> -->
            <!--<div class="col-xs-12 col-sm-12 slidedown-menu after">
                <a href="<?php //echo \yii\helpers\Url::base(); ?>/shop-social">SHOP SOCIAL</a>
            </div>-->
			<!--
            <a href="<?php echo \yii\helpers\Url::base(); ?>/journal">
                <div class="col-xs-12 col-sm-12">
                    <div class="col-xs-12 col-sm-12 slidedown-menu after clearleft-mobile clearright-mobile clearright clearleft">
                        Jurnal
                    </div>
                </div>
            </a>-->
            <!-- <a href="<?php echo \yii\helpers\Url::base(); ?>/timextaketime">
            <div class="col-xs-12 col-sm-12 slidedown-menu after p15">
                TIMEX TAKE TIME
            </div>
            </a> -->
            <!--<div class="col-xs-12 col-sm-12 slidedown-menu after text-gotham-medium">
                <a href="<?php echo \yii\helpers\Url::base(); ?>/dwpetite">PRE-ORDER</a>
            </div>-->
			
			<!--
            <div class="col-xs-12 col-sm-12">
                <div class="col-xs-12 col-sm-12 slidedown-menu after text-gotham-medium clearleft-mobile clearright-mobile clearright clearleft">
                    
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/sale" class="fcolore36969">SALE</a>
                </div>
            </div
			-->
        

		<!--
       <div class="col-xs-12 col-sm-12 outside-menu after p15 ptop20"><a href="<?php echo \yii\helpers\Url::base(); ?>/about">TENTANG KAMI</a></div>
        <div class="col-xs-12 col-sm-12 outside-menu after p15"><a href="<?php echo \yii\helpers\Url::base(); ?>/store">LOKASI TOKO</a></div>
        <div class="col-xs-12 col-sm-12 outside-menu after p15"><a href="<?php echo \yii\helpers\Url::base(); ?>/contact">HUBUNGI KAMI</a></div>
        <div class="col-xs-12 col-sm-12 outside-menu after p15"><a href="<?php echo \yii\helpers\Url::base(); ?>/warranty">GARANSI & SERVIS</a></div>
        <div class="col-xs-12 col-sm-12 outside-menu after p15"><a href="<?php echo \yii\helpers\Url::base(); ?>/faq">FAQ</a></div>
        <div class="col-xs-12 col-sm-12 outside-menu after p15"><a href="<?php echo \yii\helpers\Url::base(); ?>/privacy">KEBIJAKAN PRIVASI</a></div>
        <div class="col-xs-12 col-sm-12 outside-menu after p15 pbottom10"><a href="<?php echo \yii\helpers\Url::base(); ?>/shipping-information">INFORMASI PENGIRIMAN</a></div>
                             
           
                    <div class="padding-img menu-mobile">
                    <a href="http://www.facebook.com/TheWatchCo" target="_blank">
                        <i class="fb-footer inline-block"></i>
                    </a>
                    <a href="http://twitter.com/thewatchco_id" target="_blank">
                        <i class="twitter-footer inline-block"></i>
                    </a>
                    <a href="https://www.instagram.com/thewatchco" target="_blank">
                        <i class="instagram-footer inline-block"></i>
                    </a>
                    <a href="https://pinterest.com/thewatchcompany" target="_blank">
                        <i class="pinterest-footer inline-block"></i>
                    </a>
                    <a href="http://line.me/ti/p/%40thewatchco" target="_blank">
                        <i class="line-footer inline-block"></i>
                    </a>
                </div>
                <br>
        </div>
		 -->     


    </div>

    <div id="login-signup-menu" class='sign-up-menu'>
       
        <div class="row">
            <div class="logo-mobile col-md-12">
				<a href="<?php echo \yii\helpers\Url::base(); ?>">
                    <i class="logo-sprite mleft0" id="logotwc"></i>
                </a>

                <div id="c-menu-close-right-custom" onclick="main_menu()">
                    <i class="close-black-sprites"></i>
                </div>
            </div>
            <div class="flex-mobile-sign col-md-12">
                <div class="circle-button fill-button bordered-circle-button" id="signin">Masuk</div>
                <div class="circle-button bordered-circle-button" id="signup">Daftar</div>
            </div>
        </div>

        <div class="row" id="signin-form">
            <div class="col-md-12">
                <div class="rounded-input-wrap">
                    <input id="email-login" class="rounded-input" type="text" name="email_login_mobile" placeholder="Email" />
                    <span id="email-signin-error-mobile" class=" dnone gotham-light">* Email Required</span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="rounded-input-wrap">
                    <input id="password-login" class="rounded-input password-login" type="password" name="password_login_mobile" placeholder="Kata Sandi" />
                    <div class="password-eye" id="password-eye" onClick="toggleEyePassword(this)">
                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/eye-closed.png" width="15px">
                    </div>
                    <span id="signin-pwderror-mobile" class=" dnone gotham-light">* Password Required</span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mn-header form-login flex-login">
                    <div class="inner-flex-login">
                        <label for="rc001" class="cont-checkbox">Ingat Saya
                            <input type="checkbox" id="rc001" name="rc001"  checked="checked">
                            <span class="checkmark"></span>
                        </label>
                        <!-- <input type="checkbox" id="rc001" name="rc001" class="remember">
                        <label for="rc001" class="black-style" onclick>Ingat Saya</label>-->
                    </div>
                    <div class="inner-flex-login text-right">
                        
                        <a href="#" id="forgot-password" class="gotham-light green-text">Lupa kata sandi?</a>
                    </div>
                    <!--<input class="mn-header form-login remember" type="checkbox" name="remember" checked />-->

                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12  signin-top-error">
                <div class="col-lg-8 col-md-8 col-sm-8 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 login proceed custom-error-message">
                    <span id="signintop-error" class="dnone">Wrong Email or Password</span>
                </div>
            </div>
        </div>
        <div class="row forgot-btn-box-open dnone" id="forgot-form-content">
            <div class="col-lg-12 col-md-12 col-sm-12 clearright">
                <div class="mn-header form-forgot center ptop5">
                    INVALID EMAIL OR PASSWORD <br>
                    Lupa Password Anda?<br>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-lg-offset-5 col-md-offset-5 col-sm-offset-5 forgot-separator"></div>
                <br>
                <div class="mn-header form-forgot center ptop5">
                    Please enter your mail address below and we'll<br>
                    send you to confirmation email
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 clearright clearleft">
                <div class="mn-header form-forgot">
                    <input class="mn-header form-forgot email-forgot" type="text" name="email_forgot" placeholder="Email Address" />
                    <span id="email-forgot-top-error" class="talign-center ptop2 dnone gotham-light">* Email Required</span>
                </div>
            </div>
        </div>
        <div class="row dnone" id="signup-form">

            <div class="col-lg-12 col-md-12 col-sm-12 ">
                <div class="rounded-input-wrap">
                    <input id="name-sign" class="rounded-input" type="text" name="fname_mobile" placeholder="Nama Lengkap" />
                    <span id="firstname-error" class="dnone gotham-light">* Name Required</span>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 ">
                <div class="rounded-input-wrap">
                    <input id="email-sign" class="rounded-input" type="text" name="signup_email_mobile" placeholder="Email" />
                    <span id="email-error" class=" dnone gotham-light">* Email Required</span>
                </div>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12 ">
                <div class="rounded-input-wrap">
                    <input id="telp-sign" class="rounded-input" type="text" name="phone_mobile" placeholder="Nomor Telepon" />
                    <span id="phone-error" class="dnone gotham-light">* Phone Number Required</span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 ">
                <div class="rounded-input-wrap">
                    <input id="password-sign" class="rounded-input" type="password" name="signup_password_mobile" placeholder="Kata sandi" />
                    <span id="signup-pwderror" class="dnone gotham-light">* Password Required</span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 ">
                <div class="rounded-input-wrap">
                    <input id="password-repeat" class="rounded-input" type="password" name="signup_password_repeat_mobile" placeholder="Konfirmasi kata sandi" />
                    <span id="repassword-error" class="dnone gotham-light">* Password not match</span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 ">
                <!--
                <div class="rounded-input-wrap">
                    <div class="checkbox-btn login-remember">
                        <input type="checkbox" id="rc002" name="rc002">
                        <label for="rc002" class="black-style" onclick>Berlangganan Newsletter</label>
                    </div>
                    <input value="1" class="mn-header form-login remember" type="checkbox" name="newsletter" checked />
                </div>-->
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 clearleft signup-error">
                <div class="col-lg-8 col-md-8 col-sm-8 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 login proceed clearleft">
                    <span id="signuptop-error" style="margin-left:0;" class="dnone gotham-light">Email Already Registered</span>
                </div>
            </div>
        </div>
        <div class="row forgot-submit-box dnone" id="forgot-btn-box">
            <div class="col-lg-12 col-md-12 col-sm-12 mn-header form-login clearright">
                <div class="mn-header btn-login" id="signin-btn-mobile">MASUK</div>
                <div class="mn-header btn-login retrieve" id="retrieve-btn">RETRIEVE</div>
            </div>
        </div>
        <div class="rounded-button-wrap" id="signin-box">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="rounded-button green-btn" id="signin-btn-mobile">MASUK</div>
                <div class="foot-signin-box">
                    Belum memiliki akun? <div class="signup-text" id="signup">daftar</div>
                </div>
            </div>
        </div>
        <div class="dnone rounded-button-wrap" id="signup-box">
            <div class="col-lg-12 col-md-12 col-sm-12 ">
                <div class="rounded-button green-btn" id="signup-btn-mobile">DAFTAR</div>
                <div class="foot-signin-box">
                Sudah memiliki akun?  <div class="signup-text" id="signin">masuk</div>
                </div>
            </div>
        </div>
    </div>
</nav><!-- /c-menu push-left -->


<nav id="c-account--push-left" class="hidden-lg c-menu c-menu--push-left">
    <button id="btn-close-menu" class="c-menu__close"></button>
    <div id="main-menu" class="col-xs-12 col-sm-12 pleft0 pright0">
        <div class="col-xs-12 col-sm-12 col-md-12" style="padding-right:0; padding-left:0;">
            
                <!--
				<a href="<?php echo \yii\helpers\Url::base(); ?>">
                            <i class="logo-sprite mleft0" id="logotwc"></i>
                </a> -->
				
				<div class="menu-mobile-title">
					Account
				</div>		

                <div id="c-menu-close-right" onclick="reccount()">
                    <i class="close-black-sprites"></i>
                </div>

                <div class="clearfix"></div>
				
				
				<div class="col-xs-12 col-sm-12 ptop10">
					
						<div onclick="openAccount('profile')">
						   <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
								My Profile <div class="ardown"><i class="right-sprites-black-6"></i></div>
							</div>
						</div>
						<div onclick="openAccount('order')">
							<div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
								My Order / Confirm Payment <div class="ardown"><i class="right-sprites-black-6"></i></div>
							</div>
						</div>
						<div onclick="openAccount('shipping')">
						   <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft">
								Shipping Information <div class="ardown"><i class="right-sprites-black-6"></i></div>
							</div>
						</div>
						<a href="/user/sign-out">
						   <div class="col-xs-12 col-sm-12 slidedown-menu clearleft-mobile clearright-mobile clearright clearleft fcolore36969">	
								Sign Out
							</div>
						</a>
						
				</div> 
				
				
			</div>
        </div>
    </div>
        
</nav><!-- /c-menu push-left -->

<nav id="my-profile" class="hidden-lg c-menu c-menu--push-right push-custom">
    <button id="btn-close-menu" class="c-menu__close"></button>
    <div id="main-menu" class="col-xs-12 col-sm-12 pleft0 pright0">
        <div class="col-xs-12 col-sm-12 col-md-12" style="padding-right:0; padding-left:0;">
            
                <!--
				<a href="<?php echo \yii\helpers\Url::base(); ?>">
					<i class="logo-sprite mleft0" id="logotwc"></i>
                </a> -->
				
				<div class="menu-mobile-title">
					My Profile
				</div>		

                <div id="c-menu-close-right" onclick="innerReccount()">
                    <i class="close-black-sprites"></i>
                </div>

                <div class="clearfix"></div>
				
				<div class="push-content">
					<div class="wrap-profile-info">
						<?php if (isset($_SESSION['customerInfo'])) { ?>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info profile active clearleft clearright">
								<div class="col-lg-9 col-md-9 col-sm-12 clearleft remove-padding">
									<div class="ic_small">
										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/profile/ic_personal.png" alt="icons" />
									</div>
									<?php
									$lname = '';
									if (isset($_SESSION['customerInfo']['lname'])) {
										$lname = $_SESSION['customerInfo']['lname'];
                                    }
                                    $customerInfo = $_SESSION['customerInfo'];
									echo $customerInfo['fname'] . ' ' . $lname;
									?>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-3 section-right">
									<a href="<?php echo \yii\helpers\Url::base(); ?>/user/edit-profile" class="round-btn-blue">Edit</a>
								</div>

							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info profile clearleft clearright">
								<div class="col-lg-8 col-md-8 col-sm-12  clearleft remove-padding">
									<div class="ic_small">
										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/profile/ic_email.png" alt="icons" />
									</div>
									<?php echo $customerInfo['email']; ?>
								</div>

							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info profile clearleft clearright">
								<div class="col-lg-8 col-md-8 col-sm-12  clearleft remove-padding">
									<div class="ic_small">
										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/profile/ic_phone.png" alt="icons" />
									</div>
									<?php echo isset($customerInfo['phone']) ? $customerInfo['phone'] : '-'; ?>
								</div>
								
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info profile clearleft clearright">
								<div class="col-lg-8 col-md-8 col-sm-12  clearleft remove-padding">
									<div class="ic_small">
										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/profile/ic_birthday.png" alt="icons" />
									</div>
									<?php echo isset($customerInfo['birthday']) ? $customerInfo['birthday'] : '-'; ?>
								</div>

							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info profile clearleft clearright">
								<div class="col-lg-8 col-md-8 col-sm-12  clearleft remove-padding">
									<div class="ic_small">
										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/profile/ic_gender.png" alt="icons" />
									</div>
									<?php echo isset($customerInfo['gender']) ? $customerInfo['gender'] : '-'; ?>
								</div>
	 
							</div>
							
						<?php } ?>
					</div>

					<div class="free-btn col-md-6 remove-padding">
						<a href="<?php echo \yii\helpers\Url::base(); ?>/user/change-password" class="round-btn-blue">
						Change Password
						</a>
					</div>
				</div>
			</div>
        </div>
    </div>
        
</nav><!-- /c-menu push-left -->

<div class="sub-menu-">    
        
		
		
</div>

<nav id="c-menu--push-right" class="hidden-lg c-menu c-menu--push-right">
    <button class="c-menu__close dnone-important">Close Menu &rarr;</button>
    <div class="col-xs-12 col-sm-12" id='menu-cart-mobile'>
        <div class="col-xs-12 col-sm-12 remove-padding view-cart-title">
            VIEW CART
        </div>
        <?php if ($cart == NULL) { ?>
            <div class='col-xs-12 col-sm-12 text-center cart-empty'>
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
        if ($cart == NULL) {
            ?>
            <div class="col-xs-9 col-sm-7 col-sm-offset-5 col-xs-offset-3 remove-padding margin-top-5 text-gotham-light lspace0-5">
                <a href="<?php echo \yii\helpers\Url::base(); ?>/watches/all-product"><div class="bg-black-text-white text-center padding-top-3 padding-bottom-3">ISI KERANJANG BELANJA</div></a>
            </div>
            <?php
        } else {
            ?>
            <div class="col-xs-12 col-sm-12 remove-padding margin-top-5 text-gotham-medium">
                <div class="col-xs-5 col-sm-5 text-left remove-padding">TOTAL</div>
                <div class="col-xs-7 col-sm-7 text-right remove-padding">IDR <?php echo common\components\Helpers::getPriceFormat($grandTotal); ?></div>
            </div>
            <div class="col-xs-12 col-sm-12 remove-padding margin-top-5 border-top-button padding-top-5">
                <a href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/sign-in">
                    <div class="col-xs-10 col-sm-10 pull-right bg-black-text-white text-center padding-top-3 padding-bottom-3 lspace0-5 fsize-13 gotham-light">LANJUTKAN KE PEMBAYARAN</div>
                </a>
                <!--<a id="ied-modal-checkout" style="cursor: pointer;"><div class="col-xs-10 col-sm-10 pull-right bg-black-text-white text-center padding-top-3 padding-bottom-3" style="font-size: 13px; font-family: gotham-light; letter-spacing: 0.05em;">LANJUTKAN KE PEMBAYARAN</div></a>-->
            </div>
            <?php
        }
        ?>
    </div>
</nav><!-- /c-menu push-right -->

<div id="c-mask" class="c-mask"></div><!-- /c-mask -->
<div class="modal fade top dnone" id="lifetime" aria-hidden="true">
                        <div class="modal-dialog" role="document">                            
                                <!--Carousel-->
                            <div id="carousel-example-generics" class="carousel bulkhead-homepage slide" data-ride="carousel">
                                <div class="modal-content">
                                    <a href="#" data-dismiss="modal">
                                        <img src="https://thewatch.imgix.net/icons/close-black.png?auto=compress" class="close-mobile-benefit">
                                    </a>
                                    <div class="carousel-inner">
                                        <div class="item active"> 
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-3">                                    
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 img-position ptop15">
                                                    <div class="hidden-lg hidden-md hidden-sm col-xs-12 ptop10"></div>
                                                    <i class="watches-bulkhead-popup"></i>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-heading gotham-medium fcolorgold ptop18">Lifetime Battery</div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-center ptop10 pbottom10p">
                                            	<a class="fcolorgold gotham-light">
                                            		You are entitled to a lifetime battery warranty when you purchase our watch.
                                            	</a>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-body edit">
                                                <div>
                                                    <p class="gotham-light paragrap-text-content modal-bulk">
                                                         To claim the battery warranty, please visit the nearest The Watch Co. store and bring the original The Watch Co. warranty card and receipt for warranty verification.
                                                    </p>
                                                </div>
                                                <div>
                                                    <hr class="line-content">
                                                </div>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content modal-bulk">
                                                        Garansi baterai berlaku seumur hidup sejak tanggal pembelian. Untuk mengajukan claim, silahkan kunjungi store The Watch Co. terdekat dengan membawa kartu garansi resmi dari The Watch Co. dan nota penjualan yang asli.<br>
                                                        Garansi tidak berlaku jika Anda tidak dapat menunjukkan kartu garansi resmi dari The Watch Co. dan nota penjualan yang asli, atau email bukti pembelian (untuk pembelian secara online).<br>                                              
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mbottom50 mtop50">
                                            	<a class="left carousel-control left-carousel btn-left" href="#carousel-example-generics" role="button" data-slide="prev">
                                                    <i class="left-sprites-black-8"></i>
                                                </a>
                                                <a class="right carousel-control right-carousel btn-right" href="#carousel-example-generics" role="button" data-slide="next">
                                                    <i class="right-sprites-black-8"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-3">                                    
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 img-position">
                                                    
                                                    <i class="card-bulkhead-popup"></i>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-heading gotham-medium fcolorgold">0% INSTALLMENT </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-center ptop10 pbottom10p">
                                            	<a class="fcolorgold gotham-light">
                                            		Enjoy 0% installment payment when you shop with us.
                                            	</a>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-body edit">
                                                <div>
                                                    <p class="gotham-light paragrap-text-content modal-bulk">
                                                        Terms &amp; Conditions:
                                                            <br>1. Available for BCA, Mandiri, Permata Bank, CIMB Niaga, Standard Chartered, HSBC, dan Danamon cardholders
                                                            <br>2. Available for 3-month, 6-month and 12-month
                                                            <br>3. Available for minimum purchase of IDR 500.000
                                                    </p>
                                                </div>
                                                <div>
                                                    <hr class="line-content">
                                                </div>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content modal-bulk">
                                                        Nikmati kemudahan pembayaran dengan fasilitas cicilan 0%.<br>
                                                        Terms &amp; Conditions:
                                                            <br>  1. Berlaku untuk pemegang kartu kredit BCA, Mandiri, Permata Bank, CIMB Niaga, Standard Chartered, HSBC, dan Danamon berlogo Visa atau MasterCard
                                                            <br>  2. Tersedia pilihan untuk cicilan 3, 6 dan 12 bulan
                                                            <br> 3. Berlaku untuk minimum pembelian senilai Rp 500.000,- <br>                                                
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mbottom50 mtop50">
                                            	<a class="left carousel-control left-carousel btn-left" href="#carousel-example-generics" role="button" data-slide="prev">
                                                    <i class="left-sprites-black-8"></i>
                                                </a>
                                                <a class="right carousel-control right-carousel btn-right" href="#carousel-example-generics" role="button" data-slide="next">
                                                    <i class="right-sprites-black-8"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="item">                                            
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-3">                                    
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 img-position">
                                                    <i class="box-bulkhead-popup"></i>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-heading gotham-medium ptop7 fcolorgold">FREE SHIPPING</div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-center ptop10 pbottom10p">
                                            	<a class="fcolorgold gotham-light">
                                            		We offer free shipping to every city in Indonesia.
                                            	</a>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-body edit">
                                                <div>
                                                    <p class="gotham-light paragrap-text-content modal-bulk">
                                                        
                                                        Spend above IDR 1.000.000 and enjoy free regular delivery service (JNE<br> Regular - 3 to 5 days)<br>
                                                        Spend above IDR 3.000.000 and enjoy free express delivery service (JNE<br> YES - 1 to 2 days)<br><br>                                          
                                                        Note:
                                                        For some cities, express delivery option is not available
                                                    </p>
                                                </div>
                                                <div>
                                                    <hr class="line-content">
                                                </div>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content modal-bulk">
                                                        Kami memberikan fasilitas gratis ongkos kirim ke seluruh kota di Indonesia.<br><br>
                                                        Pembelian di atas Rp 1.000.000,- gratis pengiriman regular (JNE REG, 3<br> sampai 5 hari)<br>
                                                        Pembelian di atas Rp 3.000.000,- gratis pengiriman kilat (JNE YES, 1 <br> sampai 2 hari)                                                
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mbottom50 mtop50">
                                                <a class="left carousel-control left-carousel btn-left" href="#carousel-example-generics" role="button" data-slide="prev">
                                                    <i class="left-sprites-black-8"></i>
                                                </a>
                                                <a class="right carousel-control right-carousel btn-right" href="#carousel-example-generics" role="button" data-slide="next">
                                                    <i class="right-sprites-black-8"></i>
                                                </a> 
                                            </div>
                                        </div>
                                                                                                                
                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
					
					<!-- /.modal -->
					
					<!-- Installment -->
                    <div class="modal fade top" id="installment">
                        <div class="modal-dialog" role="document">
                            
                                <!--Carousel-->
                            <div id="carousel-example-generic" class="carousel bulkhead-homepage slide" data-ride="carousel">
                                <div class="modal-content">
                                    <a href="#" data-dismiss="modal">
                                        <img src="https://thewatch.imgix.net/icons/close-black.png?auto=compress" class="close-mobile-benefit">
                                    </a>
                                    <div class="carousel-inner">
                                        <div class="item active"> 
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-3">                                    
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 img-position">
                                                    <div class="hidden-lg hidden-md hidden-sm col-xs-12 ptop"></div>
                                                    <i class="card-bulkhead-popup"></i>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-heading gotham-medium">0% INSTALLMENT </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-center ptop10 pbottom10p">
                                            	<a class="fcolorgold gotham-light">
                                            		Enjoy 0% installment payment when you shop with us.
                                            	</a>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-body edit">
                                                <div>
                                                    <p class="gotham-light paragrap-text-content modal-bulk">
                                                        Terms &amp; Conditions:
                                                            <br>1. Available for BCA, Mandiri, Permata Bank, CIMB Niaga, Standard Chartered, HSBC, dan Danamon cardholders
                                                            <br>2. Available for 3-month, 6-month and 12-month
                                                            <br>3. Available for minimum purchase of IDR 500.000
                                                    </p>
                                                </div>
                                                <div>
                                                    <hr class="line-content">
                                                </div>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content modal-bulk">
                                                        Nikmati kemudahan pembayaran dengan fasilitas cicilan 0%.<br>
                                                        Terms &amp; Conditions:
                                                            <br>  1. Berlaku untuk pemegang kartu kredit BCA, Mandiri, Permata Bank, CIMB Niaga, Standard Chartered, HSBC, dan Danamon berlogo Visa atau MasterCard
                                                            <br>  2. Tersedia pilihan untuk cicilan 3, 6 dan 12 bulan
                                                            <br> 3. Berlaku untuk minimum pembelian senilai Rp 500.000,- <br>                                                
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mbottom50 mtop50">
                                            	<a class="left carousel-control left-carousel btn-left" href="#carousel-example-generic" role="button" data-slide="prev">
                                                    <i class="left-sprites-black-8"></i>
                                                </a>
                                                <a class="right carousel-control right-carousel btn-right" href="#carousel-example-generic" role="button" data-slide="next">
                                                    <i class="right-sprites-black-8"></i>
                                                </a>
                                            </div> 
                                        </div>
                                        <div class="item">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-3">                                    
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 img-position">
                                                    <i class="box-bulkhead-popup"></i>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-heading gotham-medium">FREE SHIPPING</div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-center ptop10 pbottom10p">
                                            	<a class="fcolorgold gotham-light">
                                            		We offer free shipping to every city in Indonesia.
                                            	</a>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-body edit">
                                                <div>
                                                    <p class="gotham-light paragrap-text-content modal-bulk">
                                                        
                                                        Spend above IDR 1.000.000 and enjoy free regular delivery service (<br> Regular - 3 to 5 days)<br>
                                                        Spend above IDR 3.000.000 and enjoy free express delivery service (<br> YES - 1 to 2 days)<br><br>                                          
                                                        Note:
                                                        For some cities, express delivery option is not available
                                                    </p>
                                                </div>
                                                <div>
                                                    <hr class="line-content">
                                                </div>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content modal-bulk">
                                                        Kami memberikan fasilitas gratis ongkos kirim ke seluruh kota di Indonesia.<br><br>
                                                        Pembelian di atas Rp 1.000.000,- gratis pengiriman regular (REG, 3<br> sampai 5 hari)<br>
                                                        Pembelian di atas Rp 3.000.000,- gratis pengiriman kilat (YES, 1 <br> sampai 2 hari)                                                
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mbottom50 mtop50">
                                            	<a class="left carousel-control left-carousel btn-left" href="#carousel-example-generic" role="button" data-slide="prev">
                                                    <i class="left-sprites-black-8"></i>
                                                </a>
                                                <a class="right carousel-control right-carousel btn-right" href="#carousel-example-generic" role="button" data-slide="next">
                                                    <i class="right-sprites-black-8"></i>
                                                </a>
                                            </div> 
                                        </div>
                                        <div class="item">                                            
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-3">                                    
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 img-position">
                                                    <i class="watches-bulkhead-popup"></i>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-heading gotham-medium">Lifetime Battery</div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-center ptop10 pbottom10p">
                                            	<a class="fcolorgold gotham-light">
                                            		You are entitled to a lifetime battery warranty when you purchase our watch.
                                            	</a>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-body edit">
                                                <div>
                                                    <p class="gotham-light paragrap-text-content modal-bulk">
                                                         To claim the battery warranty, please visit the nearest The Watch Co. store and bring the original The Watch Co. warranty card and receipt for warranty verification.
                                                    </p>
                                                </div>
                                                <div>
                                                    <hr class="line-content">
                                                </div>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content modal-bulk">
                                                        Garansi baterai berlaku seumur hidup sejak tanggal pembelian. Untuk mengajukan claim, silahkan kunjungi store The Watch Co. terdekat dengan membawa kartu garansi resmi dari The Watch Co. dan nota penjualan yang asli.<br>
                                                        Garansi tidak berlaku jika Anda tidak dapat menunjukkan kartu garansi resmi dari The Watch Co. dan nota penjualan yang asli, atau email bukti pembelian (untuk pembelian secara online).<br>                                              
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mbottom50 mtop50">
                                                <a class="left carousel-control left-carousel btn-left" href="#carousel-example-generic" role="button" data-slide="prev">
                                                    <i class="left-sprites-black-8"></i>
                                                </a>
                                                <a class="right carousel-control right-carousel btn-right" href="#carousel-example-generic" role="button" data-slide="next">
                                                    <i class="right-sprites-black-8"></i>
                                                </a> 
                                            </div>
                                        </div>
                                                                                                                
                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
					
					<!-- ./modal -->
					
					<!-- Free Shipping -->
                    <div class="modal fade top" id="shipping">
                        <div class="modal-dialog" role="document">                            
                            <div id="carousel-example-genericss" class="carousel bulkhead-homepage slide" data-ride="carousel">
                                <div class="modal-content">
                                <a href="#" data-dismiss="modal">
                                    <img src="https://thewatch.imgix.net/icons/close-black.png?auto=compress" class="close-mobile-benefit">
                                </a>
                                    <div class="carousel-inner">
                                        <div class="item active"> 
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-3">                                    
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 img-position ptop5p">
                                                    <i class="box-bulkhead-popup"></i>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-heading freeshipping gotham-medium">FREE SHIPPING</div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-center ptop10 pbottom10p">
                                            	<a class="fcolorgold gotham-light">
                                            		We offer free shipping to every city in Indonesia.
                                            	</a>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-body edit">
                                                <div>
                                                    <p class="gotham-light paragrap-text-content modal-bulk">
                                                        
                                                        Spend above IDR 1.000.000 and enjoy free regular delivery service (<br>Regular - 3 to 5 days)<br>
                                                        Spend above IDR 3.000.000 and enjoy free express delivery service (<br> YES - 1 to 2 days)<br><br>                                          
                                                        Note:
                                                        For some cities, express delivery option is not available
                                                    </p>
                                                </div>
                                                <div>
                                                    <hr class="line-content">
                                                </div>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content modal-bulk">
                                                        Kami memberikan fasilitas gratis ongkos kirim ke seluruh kota di Indonesia.<br><br>
                                                        Pembelian di atas Rp 1.000.000,- gratis pengiriman regular (REG, 3<br> sampai 5 hari)<br>
                                                        Pembelian di atas Rp 3.000.000,- gratis pengiriman kilat (YES, 1 <br> sampai 2 hari)                                                
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mbottom50 mtop50">
                                                <a class="left carousel-control left-carousel btn-left" href="#carousel-example-genericss" role="button" data-slide="prev">
                                                    <i class="left-sprites-black-8"></i>
                                                </a>
                                                <a class="right carousel-control right-carousel btn-right" href="#carousel-example-genericss" role="button" data-slide="next">
                                                    <i class="right-sprites-black-8"></i>
                                                </a>
                                            </div>                                            
                                        </div>
                                        <div class="item">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-3">                                    
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 img-position">
                                                    <i class="card-bulkhead-popup"></i>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-heading gotham-medium">0% INSTALLMENT </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-center ptop10 pbottom10p">
                                            	<a class="fcolorgold gotham-light">
                                            		Enjoy 0% installment payment when you shop with us.
                                            	</a>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-body edit">
                                                <div>
                                                    <p class="gotham-light paragrap-text-content modal-bulk">
                                                        Terms &amp; Conditions:
                                                            <br>1. Available for BCA, Mandiri, Permata Bank, CIMB Niaga, Standard Chartered, HSBC, dan Danamon cardholders
                                                            <br>2. Available for 3-month, 6-month and 12-month
                                                            <br>3. Available for minimum purchase of IDR 500.000
                                                    </p>
                                                </div>
                                                <div>
                                                    <hr class="line-content">
                                                </div>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content modal-bulk">
                                                        Nikmati kemudahan pembayaran dengan fasilitas cicilan 0%.<br>
                                                        Terms &amp; Conditions:
                                                            <br>  1. Berlaku untuk pemegang kartu kredit BCA, Mandiri, Permata Bank, CIMB Niaga, Standard Chartered, HSBC, dan Danamon berlogo Visa atau MasterCard
                                                            <br>  2. Tersedia pilihan untuk cicilan 3, 6 dan 12 bulan
                                                            <br> 3. Berlaku untuk minimum pembelian senilai Rp 500.000,- <br>                                                
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mbottom50 mtop50">
                                            	<a class="left carousel-control left-carousel btn-left" href="#carousel-example-genericss" role="button" data-slide="prev">
                                                    <i class="left-sprites-black-8"></i>
                                                </a>
                                                <a class="right carousel-control right-carousel btn-right" href="#carousel-example-genericss" role="button" data-slide="next">
                                                    <i class="right-sprites-black-8"></i>
                                                </a>
                                            </div> 
                                        </div>
                                        <div class="item">                                            
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-3">                                    
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 img-position">
                                                    <i class="watches-bulkhead-popup"></i>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-heading gotham-medium fcolorgold">Lifetime Battery</div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-center ptop10 pbottom10p">
                                            	<a class="fcolorgold gotham-light">
                                            		You are entitled to a lifetime battery warranty when you purchase our watch.
                                            	</a>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-body edit">
                                                <div>
                                                    <p class="gotham-light paragrap-text-content modal-bulk">
                                                         To claim the battery warranty, please visit the nearest The Watch Co. store and bring the original The Watch Co. warranty card and receipt for warranty verification.
                                                    </p>
                                                </div>
                                                <div>
                                                    <hr class="line-content">
                                                </div>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content modal-bulk">
                                                        Garansi baterai berlaku seumur hidup sejak tanggal pembelian. Untuk mengajukan claim, silahkan kunjungi store The Watch Co. terdekat dengan membawa kartu garansi resmi dari The Watch Co. dan nota penjualan yang asli.<br>
                                                        Garansi tidak berlaku jika Anda tidak dapat menunjukkan kartu garansi resmi dari The Watch Co. dan nota penjualan yang asli, atau email bukti pembelian (untuk pembelian secara online).<br>                                              
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mbottom50 mtop50">
                                            	<a class="left carousel-control left-carousel btn-left" href="#carousel-example-genericss" role="button" data-slide="prev">
                                                    <i class="left-sprites-black-8"></i>
                                                </a>
                                                <a class="right carousel-control right-carousel btn-right" href="#carousel-example-genericss" role="button" data-slide="next">
                                                    <i class="right-sprites-black-8"></i>
                                                </a>
                                            </div> 
                                        </div>
                                        
                                                                                                                 
                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                    
          <div class="hidden-xs hidden-md hidden-sm ptop90"></div> 
<div class="hidden-lg menu-header-gap" id="nav-gap"></div>       

<!--<div id="ied-modal-bag" class="modal fade" role="dialog">-->
<!--                      <div class="modal-dialog ied" style="vertical-align: middle;margin-top: 10%;margin-bottom: 10%;">-->

                        <!-- Modal content-->
<!--                        <div class="modal-content" style="border-radius: 10px;background-color: rgb(255,255,255);">-->
<!--                          <div class="modal-body" style="padding-top: 15px;">-->
<!--                            <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/x-black-24.png" style="width: 17px;"> </button>-->
<!--                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">-->
                                              
<!--                                              <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">-->
<!--                                                Informasi Lebaran-->
<!--                                              </span>-->
<!--                                              <span class="clearleft clearright clearright-mobile gotham-medium">-->
                                                <!-- <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/term_n_condition.png" style="width: 24px;margin-left: 10px;"> -->
<!--                                              </span>-->
                                              
<!--                                            </div>-->
                                            
<!--                          </div>-->
<!--                          <div class="modal-body title-warranty" style="display:inline-block;margin-top:7px;padding-top:5px;">-->
                            
<!--                          <hr style="margin-top: 0px;margin-bottom: 20px;border-top:1px solid rgb(69,69,69);">-->
<!--                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light" style="padding-bottom: 20px;">-->
<!--                                <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearleft clearright clearleft-mobile clearright-mobile" style="text-align: center;">                                                                   -->
<!--                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/lebaran/Pop-Up-Home-Page-Desktop.jpg" style="border-radius: 5px;width: 100%;">                          -->
<!--                                </div>-->
<!--                                <div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="text-align: center;">                                                                   -->
<!--                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/lebaran/Pop-Up-Home-Page-Mobile.jpg" style="border-radius: 5px;width: 100%;">                           -->
<!--                                </div>                -->
<!--                            </div>-->
                                    
                            
<!--                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">-->
<!--                                <a class="red-round close fsize-14 fsize-i5-10" data-dismiss="modal" style="width:48%;text-align: center;float:left;padding-top: 14px;padding-bottom: 11px;text-shadow: none;">-->
<!--                                    Tidak Setuju-->
<!--                                </a>-->
<!--                                <a class="blue-round close fsize-14 fsize-i5-10" href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/sign-in" style="width:48%;text-align: center;float:right;padding-top: 14px;padding-bottom: 11px;text-shadow: none;">-->
<!--                                    Setuju-->
<!--                                </a>-->
<!--                            </div>-->

<!--                          </div>-->
                          
<!--                        </div>-->

<!--                      </div>-->
<!--                    </div>-->
<script>



window.onload = function(){
	
	 const catParent 		= document.getElementById('c-button--push-left');
	const closeParent 		= document.getElementById('c-menu-close-right');
	const watchMobile 		= document.getElementById('watches-mobile-custom');
	const strapsMobile 		= document.getElementById('straps-mobile-custom');
    const accessoriesMobile = document.getElementById('accessories-mobile-custom');
    const jewelryMobile     = document.getElementById('jewelry-mobile-custom');
    const brandsMobile		= document.getElementById('brands-mobile-custom');
    const jurnalMobile		= document.getElementById('jurnal-mobile-custom');
	
	const listWatch 		= document.getElementById('list-watches-custom');
	const listStrap 		= document.getElementById('list-straps-custom');
    const listAcc 			= document.getElementById('list-accessories-custom');
    const listJewel			= document.getElementById('list-jewelry-custom');
    const listBrands 		= document.getElementById('list-brands-custom');
    const listJurnal 		= document.getElementById('list-jurnal-custom');
	const menus 			= document.getElementsByClassName('menu-sidebar-item');
	const wrapMenu 			= document.getElementsByClassName('menu-mobile-wrap')[0];
	
	
	closeParent.onclick = function() {
		clear();
		wrapMenu.style.display = 'none';
	}
	
	catParent.onclick = function() {
		wrapMenu.style.display = 'flex';
		watchMobile.classList.add('active');
		setTimeout(function(){
			listWatch.style.display = 'block';
		}, 300)
    }
    
	
	watchMobile.onclick = function(){
		clear();
		watchMobile.classList.add('active');
		listWatch.style.display = 'block';
	}
	
	strapsMobile.onclick = function(){
		clear();
		strapsMobile.classList.add('active');
		listStrap.style.display = 'block';
    }

    jewelryMobile.onclick = function(){
		clear();
		jewelryMobile.classList.add('active');
		listJewel.style.display = 'block';
	}
		
	accessoriesMobile.onclick = function(){
		clear();
		accessoriesMobile.classList.add('active');
		listAcc.style.display = 'block';
	}
	
	brandsMobile.onclick = function(){
		clear();
		brandsMobile.classList.add('active');
		listBrands.style.display = 'block';
    }
    
    jurnalMobile.onclick = function(){
		clear();
		jurnalMobile.classList.add('active');
		listJurnal.style.display = 'block';
	}
	
	function clear() {
		listWatch.style.display = 'none';
		listStrap.style.display = 'none';
		listAcc.style.display = 'none';
        listBrands.style.display = 'none';
        listJewel.style.display = 'none';
        listJurnal.style.display = 'none';
        
		for(let i = 0; i<menus.length; i++){
			menus[i].classList.remove('active');
		}
	}
	
	const theURL = window.location.href.split('/')[3];
	
	
	// document.getElementById('watches-mobile').click();

	if($(window).width() < 640){
		if( theURL == 'product' || theURL == 'cart'){
			$('#navbar-wrap').css('display', 'none');
			$('#navbar-main').css('display', 'none');		
			$('#navbar-mobile').css('display', 'none');		
			$('#nav-gap').css('display', 'none');		 
		}else{
			window.onscroll = function() {
			
				if($(window).scrollTop() > 80)
				{
					$('#navbar-main').css('display', 'none');
				}else{
					$('#navbar-main').css('display', 'block');
				}
			};
		}
	}
	
	
	
	
	
	let a = document.getElementById('runtext');
    const achild = a.children;
	let aactive = 0;
	
	setInterval(function() {
		if(aactive == achild.length){
				aactive = 0;
			}
		for(let i = 0; i<achild.length; i++){
			
			
			let div = document.getElementById('item_'+i);
			
			if(i == aactive){
				div.classList.add('active')
			}else{
				div.classList.remove('active')
			}

			
		}
		aactive++;
	}, 3000)
	

};
 



</script>