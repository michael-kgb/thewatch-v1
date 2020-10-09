<?php
$breadcrumbs = $this->context->breadcrumb;
if(!isset($_GET['limit'])){
                        $limit = 20;
                        
                    }else{
                        $limit = $_GET['limit'];
                    }

                  
                    
                    if(!isset($_GET['page'])){
                        $current = 1;
                    }else{
                        $current = $_GET['page'];
                    }

                    $sortby = 'none';
                    if(isset($_GET['sortby'])){ 
                        $sort_name = str_replace('-', ' ', $_GET['sortby']);
                        $sort_name = strtoupper($sort_name);
                        $sortby = $_GET['sortby'];
                    }else{ 
                        $sort_name = 'NONE';
                    }

?>
<script>
var dataLayer = [],
    items = [];
	
    <?php $i = 1; ?>
    <?php if (count($products) > 0) { ?>
    <?php foreach ($products as $product) { ?>

    items.push({
        "id": "<?php echo $product->product_id; ?>",
        "name": "<?php echo $product->productDetail->name; ?>",
        "price": "<?php echo $product->price; ?>",
        "brand": "<?php echo $product->brands->brand_name; ?>",
        "category": "<?php echo $product->productCategory->product_category_name; ?>",
        "position": <?php echo $i; ?>,
        "list": "Landing Page Promo Surprise Sale"
    })

    <?php $i++; ?>
    <?php } ?>
    <?php } ?>

    dataLayer.push({
        "event" : "productImpressions",
        "ecommerce": {
            "currencyCode": "IDR",
            "impressions": items
        }
    });
</script>
<!--<section id="breadcrumb-bundling">
    <div class="container">
        <div class="row">
        </div>
    </div>
</section>-->
<section class="ptop1">
    <div class="container">
        <div class="row">
            <!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright pbottom5 salebrandbannerview">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ptop2 remove-padding clearleft clearright ">
                    <div class='col-lg-6 col-md-6 col-sm-6 ptop2 col-xs-6 remove-padding-right padding-left-1-5'>
                        <a href="<?php echo \yii\helpers\Url::base(); ?>/watchsale">
                            <img src='<?php echo \yii\helpers\Url::base(); ?>/img/promo/endsale/Watches (Jembatan).jpg' class="img-responsive">
                        </a>
                    </div>
                    <div class='col-lg-6 col-md-6 col-sm-6 ptop2 col-xs-6 remove-padding-right padding-left-1-5'>
                        <a href="<?php echo \yii\helpers\Url::base(); ?>/accessoriesale">
                            <img src='<?php echo \yii\helpers\Url::base(); ?>/img/promo/endsale/Essentials (Jembatan).jpg' class="img-responsive">
                        </a>
                    </div>
                </div>
            </div>-->
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 clearleft clearright mbottom3">
				<img src="https://thewatch.co/img/promo/surprise-sale/surprise_sale_3.jpg" class="img-responsive">
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 hidden-xs clearright pleft-5-dwpetite">
                            
				<div class="brand-name-full" style="font-family: gotham-light;">
					The Watch Co. Surprise Sale! 
				</div>
				<div class="brand-description">
					Dapatkan diskon sebesar 25% untuk produk Aark Collective, Hypergrand, Timex, William L, dan Casio khusus pembelian secara online. Promo ini berlaku mulai dari 13 - 30 September 2017.
                                        <br><br>
                                        Dapatkan jam tangan favoritmu sekarang, STOK TERBATAS!
				</div>
			</div>
			<div class="hidden-lg hidden-md hidden-sm col-xs-12 clearright pleft-5-dwpetite">
				<div class="brand-name-full" style="font-family: gotham-light;">
					The Watch Co. Surprise Sale! 
				</div>
				<div class="brand-description" style="text-align: left;">
					Dapatkan diskon sebesar 25% untuk produk Aark Collective, Hypergrand, Timex, William L, dan Casio khusus pembelian secara online. Promo ini berlaku mulai dari 13 - 30 September 2017.
                                        <br><br>
                                        Dapatkan jam tangan favoritmu sekarang, STOK TERBATAS!
				</div>
			</div>
			<section id="breadcrumb">
                <div class="container breadcrumb-page">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-9 breadcrumb-page clearleft clearright">
                            <div class="fleft clearleft pright2 hidden-xs hidden-sm hidden-md">SHOW</div>
                            <a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?page=1&limit=20'; ?>&sortby=<?php echo $sortby;?>" class="fleft pright2 hidden-xs hidden-sm hidden-md"><span class="gotham-<?php echo!isset($_GET['limit']) || $_GET['limit'] == 20 ? 'medium' : 'light'; ?>">20</span></a>
                            <a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?page=1&limit=40'; ?>&sortby=<?php echo $sortby;?>" class="fleft pright2 hidden-xs hidden-sm hidden-md"><span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 40 ? 'medium' : 'light'; ?>">40</span></a>
                            <a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?page=1&limit=60'; ?>&sortby=<?php echo $sortby;?>" class="fleft pright2 hidden-xs hidden-sm hidden-md"><span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 60 ? 'medium' : 'light'; ?>">60</span></a>
						</div>
                        <div class="col-lg-3 show-number clearright clearleft" style="text-align: left;width: 21%;float: right;    line-height: 32px;">
                            <div class="clearleft clearright hidden-xs hidden-sm hidden-md hidden-lg-4" style="display: inline;letter-spacing: 0.5px;padding-right: 10px;">SORT BY: 
                            </div>
                            <div class="clearleft clearright hidden-xs hidden-sm hidden-md hidden-lg-4" style="display: inline;">
                                <a href="#" class="hidden-xs hidden-sm hidden-md" id="sorting" style="">
                                    <span class="text-sorting blue-font"><?php if($sort_name == 'NONE'){ echo 'BRANDS NAME';}else{ echo $sort_name; }  ?><span class="glyphicon glyphicon-menu-down" style="    padding-left: 5px;display: inline;"></span></span>
                                    
                                </a>

                                <div class="" id="arrow-sorting"></div>
                                <div class="hidden-xs sorting-box" id="box-sorting">
                                    <a class="sorting-list top" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?page='.$current.'&limit='.$limit.'&sortby=none'; ?>">BRANDS NAME</a>
                                    <a class="sorting-list" id="sorting-none" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?page='.$current.'&limit='.$limit.'&sortby=price-low-to-high'; ?>">PRICE LOW TO HIGH</a>
                                    <a class="sorting-list bottom" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?page='.$current.'&limit='.$limit.'&sortby=price-high-to-low'; ?>">PRICE HIGH TO LOW</a>
                                </div>
                            </div>
                            <style type="text/css">
                                
                            </style>
                            
                        </div>
                        <div class="row hidden-lg hidden-md" style="padding-bottom: 20px;">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 breadcrumb-page">
                                <a href="#" id="sorting-mobile" class="filter">
                                    <span class="text-filter">SORT BY</span>
                                </a>
                            </div>
                        </div>
                        <div class="hidden-lg hidden-md col-xs-12 remove-padding" style="display: none; position: fixed; width: 100%; height: 100%; left: 0; top: 0px; background: #f6f6f6; z-index: 10; overflow: auto" id="sorting-content">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-5 text-gotham-medium" style="height: 45px;">
                                <span class="pull-left" style="letter-spacing:3px;text-align:center;">SORT BY</span>
                                <span class="pull-right">
                                    <a href="#" id="close-sorting-mobile">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-black.png" class="close-forgot" style="margin-bottom: 7px; width: 20%">
                                    </a>
                                </span>
                                <div class="clearfix"></div>
                                <div class="border-bottom-1"></div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?page='.$current.'&limit='.$limit.'&sortby=none'; ?>">
                                    <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                                        <span class="pull-left" style="letter-spacing:3px;">BRANDS NAME</span>
                                        <span class="pull-right radio-btn">
                                            <div class="ardown"><img class="arrow-down-watches" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-spec.png"></div>
                                        </span>
                                    </div>
                                </a>
                                <a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?page='.$current.'&limit='.$limit.'&sortby=price-low-to-high'; ?>">
                                    <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                                        <span class="pull-left" style="letter-spacing:3px;">PRICE LOW TO HIGH</span>
                                        <span class="pull-right radio-btn">
                                            <div class="ardown"><img class="arrow-down-watches" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-spec.png"></div>
                                        </span>
                                    </div>
                                </a>
                                <a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?page='.$current.'&limit='.$limit.'&sortby=price-high-to-low'; ?>">
                                    <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                                        <span class="pull-left" style="letter-spacing:3px;">PRICE HIGH TO LOW</span>
                                        <span class="pull-right radio-btn">
                                            <div class="ardown"><img class="arrow-down-watches" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-spec.png"></div>
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </div>
					</div>
                </div>
            </section>
            
            <?php
            $current_date = date('Y-m-d H:i:s');
            if($current_date >= '2017-09-13 00:00:00' && $current_date <= '2017-09-30 23:59:59'){
                
            if (count($products) > 0) {
                $now = date("Y-m-d H:i:s");
                ?>
                <section id="all-product">
                    <?php $i = 1; ?>
                    <?php foreach ($products as $product) { ?>
                    <?php if ($i == 1 || $i == 5 || $i == 9 || 
                              $i == 13 || $i == 17 || $i == 21 || 
                              $i == 25 || $i == 29 || $i == 33 ||
                              $i == 37 || $i == 41 || $i == 45 ||
                              $i == 49 || $i == 53 || $i == 57 ||
                              $i == 61) { ?>
                            <div class="hidden-sm container product-box clearleft">
                                <div class="row">
                    <?php } ?>
                                <div class="hidden-sm col-lg-3 col-md-3 col-xs-6 <?php echo $i % 2 == 0 ? 'pleft75' : 'pright75'; ?>">
                                    <?php  
                                        $stock = backend\models\ProductStock::findOne(['product_id' => $product->product_id]);
                                        $productStock = backend\models\ProductStock::findAll(['product_id' => $product->product_id]);
                                        $found = FALSE;
                                        $totalStock = 0;
                                        foreach ($productStock as $attribute){
                                            $productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
                                            if($productattribute != NULL && $attribute->quantity != 0){
                                                $found = TRUE;
                                            }
                                            $totalStock = $totalStock + $attribute->quantity;
                                        }

                                        if($stock != NULL && !$found){
                                    ?>
                                    <a <?php echo $stock->quantity == 0 ? 'id="out-of-stock" data-id="'.$product->product_id.'"' : ''; ?> href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                        <?php } else { ?>
                                        <a href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                        <?php } ?>
                                        <div>
                                            <div class="tag">
                                                <?php
                                                if (!empty($product->specificPrice)) {
                                                    if ($product->specificPrice->from <= $now && $product->specificPrice->to > $now) {
                                                        ?>
                                                        <div class='pull-right'>
                                                            <div class='<?php echo $product->specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                                <span class='text-discount' style=''>
                                                                    <?php
																	// if custom value label
																	if($product->specificPrice->label_type == "custom_value"){
																		echo $product->specificPrice->label;
																	} else {
																		if ($product->specificPrice->reduction_type == 'amount') {
																			echo round($product->specificPrice->reduction / 1000, 2);
																		} else {
																			echo $product->specificPrice->reduction;
																		}
																		echo $product->specificPrice->reduction_type == 'percent' ? '%' : 'k';
																	}
																	?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <?php
                                    if (!empty($product->specificPrice)) {
                                        if ($product->specificPrice->from <= $now && $product->specificPrice->to > $now) {
                                            ?>
                                             <div class="tag-bellow" style='background-color: #ae4a3b;'>
                                                <div class=''>
                                                    <span class='text-bellow'>
                                                    Sale 
                                                        <?php
                                                        // if custom value label
                                                        if($product->specificPrice->label_type == "custom_value"){
                                                            echo $product->specificPrice->label;
                                                        } else {
                                                            if ($product->specificPrice->reduction_type == 'amount') {
                                                                echo round($product->specificPrice->reduction / 1000, 2);
                                                            } else {
                                                                echo $product->specificPrice->reduction;
                                                            }
                                                            echo $product->specificPrice->reduction_type == 'percent' ? '%' : 'k';
                                                        }
                                                        ?> Off
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <?php
                                        }
                                    }
                                    ?>
                                        <?php
                                            if($product->productNewArrival->product_newarrival_start_date <= $now && $product->productNewArrival->product_newarrival_end_date >= $now){
                                        ?>
                                             <div class="tag-bellow" style='background-color: #4c757b;'>
                                                <div class=''>
                                                    <span class='text-bellow'>
                                                    New Arrival
                                                        
                                                    </span>
                                                </div>
                                            </div>
                                            
                                          <?php
                                            }
                                          ?>
                                            <?php  
                                            if($stock != NULL){
                                            ?>
                                            <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                            <?php
                                                echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : ''; 
                                            ?>
                                            <?php 
                                            } else {
                                            ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive">

                                            <?php } ?>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace2"><?php echo strtoupper($product->productDetail->name); ?></span></div>
                                        <?php
                                // if product has discount
                                $spesificPrice = backend\models\SpecificPrice::findOne(['product_id' => $product->product_id]);
                                $discount = 0;
                                $now = date('Y-m-d H:i:s');
                                if ($spesificPrice != null) {
                                    ?>
                                    <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview">
                                            <?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
                                            IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?>
                                            <input type="hidden" class="price" name="price" value="<?php echo $product->price; ?>">
                                            <?php } else { ?>
                                            USD <?php echo $product->price_usd; ?>
                                            <input type="hidden" class="price" name="price" value="<?php echo $product->price_usd; ?>">
                                            <?php } ?>
                                            <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                            <?php
                                            if ($spesificPrice->reduction_type == 'percent') {
                                                $discount = (($spesificPrice->reduction / 100) * $product->price);
                                            } elseif ($spesificPrice->reduction_type == 'amount') {
                                                $discount = $spesificPrice->reduction;
                                            }
                                            ?>
                                            <?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
                                            <span class="discount-price mleft2 discountview2">
											IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?>
											</span>
                                            <input type="hidden" class="price" name="price" value="<?php echo $product->price - $discount; ?>">
                                            <?php } else { ?>
                                            USD <?php echo $product->price_usd - $discount; ?>
                                            <input type="hidden" class="price" name="price" value="<?php echo $product->price_usd - $discount; ?>">
                                            <?php } ?>
                                            

                                            <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                                        
											<?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
											<span class="mleft2 discountview2">
												<span class="discount-price-real">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price - $discount); ?></span>
											</span>
											<?php } ?>
										</div>


                                    <?php } ?>
                                <?php } else { ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview">
                                        <?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
                                        IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?>
                                        <input type="hidden" class="price" name="price" value="<?php echo $product->price; ?>">
                                        <?php } else { ?>
                                        USD <?php echo $product->price_usd; ?>
                                        <input type="hidden" class="price" name="price" value="<?php echo $product->price_usd; ?>">
                                        <?php } ?>

                                        <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                                    </div>
                                <?php } ?>
                                        <!--<div class="col-lg-12 col-md-12 col-sm-12 product product-price"><span class="lspace2">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?></span></div> -->
                                    <?php
                                if($totalStock == 0){
                                    ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
                                    Out of Stock
                                    </div>
                                    <?php
                                }else{
                                    if(($product->price - $discount) > 500000){
                                    ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment">
                                            <?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
                                            IDR <?php echo \common\components\Helpers::getPriceFormat(($product->price - $discount) / 12); ?> / bulan
                                           
                                            <?php } else { ?>
                                            USD <?php echo ($product->price_usd - $discount)/12; ?> / bulan
                                            
                                            <?php } ?>
                                        </div>
                                    <?php
                                     }
                                }
                            ?>
                                    </a>
                                </div>

                                <?php
                                if ($i % 4 == 0) {
                                    echo '<div class="hidden-xs clearfix"></div>';
                                }

                                if ($i % 2 == 0){
                                    echo '<div class="hidden-lg hidden-md hidden-sm clearfix"></div>';
                                }
                                ?>
                                <?php if ($i == 4 || $i == 8 || $i == 12 || $i == 16 || 
                                          $i == 20 || $i == 24 || $i == 28 || $i == 32 ||
                                          $i == 36 || $i == 40 || $i == 44 || $i == 48 || $i == 52 ||
                                          $i == 56 || $i == 60) { ?>    
                                </div>
                            </div>
                        <?php } ?>


                        <?php $i++; ?>
                    <?php } ?>

                    <?php $i = 1; ?>
                    <?php foreach ($products as $product) { ?>
                    <?php if ($i == 1 || $i == 4 || $i == 7 || 
                              $i == 10 || $i == 13 || $i == 16 || 
                              $i == 19 || $i == 22 || $i == 25 ||
                              $i == 28 || $i == 31 || $i == 34 ||
                              $i == 37 || $i == 40 || $i == 43 ||
                              $i == 46 || $i == 49 || $i == 52 ||
                              $i == 55 || $i == 58 || $i == 61 ||
                              $i == 64 || $i == 67 || $i == 70 ) { ?>
                            <div class="hidden-lg hidden-md hidden-xs container product-box clearleft">
                                <div class="row">
                        <?php } ?>
                                <div class="col-sm-4 <?php echo $i % 2 == 0 ? 'pleft75' : 'pright75'; ?>">
                                    <?php  
                                        $stock = backend\models\ProductStock::findOne(['product_id' => $product->product_id]);
                                        $productStock = backend\models\ProductStock::findAll(['product_id' => $product->product_id]);
                                        $found = FALSE;
                                        $totalStock = 0;
                                        foreach ($productStock as $attribute){
                                            $productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
                                            if($productattribute != NULL && $attribute->quantity != 0){
                                                $found = TRUE;
                                            }
                                            $totalStock = $totalStock + $attribute->quantity;
                                        }

                                        if($stock != NULL && !$found){
                                    ?>
                                    <a <?php echo $stock->quantity == 0 ? 'id="out-of-stock" data-id="'.$product->product_id.'"' : ''; ?> href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                        <?php } else { ?>
                                        <a href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                        <?php } ?>
                                        <div>
                                            <div class="tag">
                                                <?php
                                                if (!empty($product->specificPrice)) {
                                                    if ($product->specificPrice->from <= $now && $product->specificPrice->to > $now) {
                                                        ?>
                                                        <div class='pull-right'>
                                                            <div class='<?php echo $product->specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                                <span class='text-discount' style=''>
                                                                    <?php
																	// if custom value label
																	if($product->specificPrice->label_type == "custom_value"){
																		echo $product->specificPrice->label;
																	} else {
																		if ($product->specificPrice->reduction_type == 'amount') {
																			echo round($product->specificPrice->reduction / 1000, 2);
																		} else {
																			echo $product->specificPrice->reduction;
																		}
																		echo $product->specificPrice->reduction_type == 'percent' ? '%' : 'k';
																	}
																	?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <?php
                                    if (!empty($product->specificPrice)) {
                                        if ($product->specificPrice->from <= $now && $product->specificPrice->to > $now) {
                                            ?>
                                             <div class="tag-bellow" style='background-color: #ae4a3b;'>
                                                <div class=''>
                                                    <span class='text-bellow'>
                                                    Sale 
                                                        <?php
                                                        // if custom value label
                                                        if($product->specificPrice->label_type == "custom_value"){
                                                            echo $product->specificPrice->label;
                                                        } else {
                                                            if ($product->specificPrice->reduction_type == 'amount') {
                                                                echo round($product->specificPrice->reduction / 1000, 2);
                                                            } else {
                                                                echo $product->specificPrice->reduction;
                                                            }
                                                            echo $product->specificPrice->reduction_type == 'percent' ? '%' : 'k';
                                                        }
                                                        ?> Off
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <?php
                                        }
                                    }
                                    ?>
                                        <?php
                                            if($product->productNewArrival->product_newarrival_start_date <= $now && $product->productNewArrival->product_newarrival_end_date >= $now){
                                        ?>
                                             <div class="tag-bellow" style='background-color: #4c757b;'>
                                                <div class=''>
                                                    <span class='text-bellow'>
                                                    New Arrival
                                                        
                                                    </span>
                                                </div>
                                            </div>
                                            
                                          <?php
                                            }
                                          ?>
                                            <?php  
                                            if($stock != NULL){
                                            ?>
                                            <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                            <?php
                                                echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : ''; 
                                            ?>
                                            <?php 
                                            } else {
                                            ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive">

                                            <?php } ?>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace2"><?php echo strtoupper($product->productDetail->name); ?></span></div>
                                        <?php
                                // if product has discount
                                $spesificPrice = backend\models\SpecificPrice::findOne(['product_id' => $product->product_id]);
                                $discount = 0;
                                $now = date('Y-m-d H:i:s');
                                if ($spesificPrice != null) {
                                    ?>
                                    <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview">
                                            <?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
                                            IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?>
                                            <input type="hidden" class="price" name="price" value="<?php echo $product->price; ?>">
                                            <?php } else { ?>
                                            USD <?php echo $product->price_usd; ?>
                                            <input type="hidden" class="price" name="price" value="<?php echo $product->price_usd; ?>">
                                            <?php } ?>
                                            <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                            <?php
                                            if ($spesificPrice->reduction_type == 'percent') {
                                                $discount = (($spesificPrice->reduction / 100) * $product->price);
                                            } elseif ($spesificPrice->reduction_type == 'amount') {
                                                $discount = $spesificPrice->reduction;
                                            }
                                            ?>
                                            <?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
                                            <span class="discount-price mleft2 discountview2">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?></span>
                                            <span class="discount-price-real">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price - $discount); ?></span>
                                            <input type="hidden" class="price" name="price" value="<?php echo $product->price - $discount; ?>">
                                            <?php } else { ?>
                                            USD <?php echo $product->price_usd - $discount; ?>
                                            <input type="hidden" class="price" name="price" value="<?php echo $product->price_usd - $discount; ?>">
                                            <?php } ?>
                                            

                                            <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                                        </div>



                                    <?php } ?>
                                <?php } else { ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview">
                                        <?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
                                        IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?>
                                        <input type="hidden" class="price" name="price" value="<?php echo $product->price; ?>">
                                        <?php } else { ?>
                                        USD <?php echo $product->price_usd; ?>
                                        <input type="hidden" class="price" name="price" value="<?php echo $product->price_usd; ?>">
                                        <?php } ?>

                                        <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                                    </div>
                                <?php } ?>
								<input type="hidden" name="productPrice" value="<?php echo $product->price - $discount; ?>">
                            <!--<div class="col-lg-12 col-md-12 col-sm-12 product product-price"><span class="lspace2">IDR <?php //echo \common\components\Helpers::getPriceFormat($product->price); ?></span></div> -->
                            <?php
                                if($totalStock == 0){
                                    ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
                                    Out of Stock
                                    </div>
                                    <?php
                                }else{
                                    if(($product->price - $discount) > 500000){
                                    ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment">
                                            <?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
                                            IDR <?php echo \common\components\Helpers::getPriceFormat(($product->price - $discount) / 12); ?> / bulan
                                           
                                            <?php } else { ?>
                                            USD <?php echo ($product->price_usd - $discount)/12; ?> / bulan
                                            
                                            <?php } ?>
                                        </div>
                                    <?php
                                     }
                                }
                            ?>
                                    </a>
                                </div>

                                <?php
                                if ($i % 3 == 0) {
                                    echo '<div class="hidden-sm clearfix"></div>';
                                }
                                ?>
                                <?php if ($i == 3 || $i == 6 || $i == 9 || $i == 12 || 
                                          $i == 15 || $i == 18 || $i == 21 || $i == 24 ||
                                          $i == 27 || $i == 30 || $i == 33 || $i == 36 || $i == 39 ||
                                          $i == 42 || $i == 45 || $i == 48 || $i == 51 || $i == 54 ||
                                          $i == 57 || $i == 60 || $i == 63 || $i == 66 || $i == 69 ||
                                          $i == 72 ) { ?>    
                                </div>
                            </div>
                        <?php } ?>
                    <?php $i++; ?>
                    <?php } ?>
                </section>
                <?php //if($count > 4) {  ?>
                <section id="all-product-footer">
        <div class="container product-box">
            <div class="row font-paging">
                <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs pagination"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright">
                    <div class="hidden-lg col-md-8 col-sm-8 col-xs-6 remove-padding clearleft pleftpagemobilepag2">
                        <span class="gotham-light position-left">SHOW</span>
                        <span class="gotham-<?php echo!isset($_GET['limit']) || $_GET['limit'] == 20 ? 'medium' : 'light'; ?> padd-4 position-left">
                            <a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?page=1&limit=20'; ?>&sortby=<?php echo $sortby;?>">20</a>
                        </span>
                        <span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 40 ? 'medium' : 'light'; ?> padd-4 position-left">
                            <a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?page=1&limit=40'; ?>&sortby=<?php echo $sortby;?>">40</a>
                        </span>
                        <span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 60 ? 'medium' : 'light'; ?> padd-4 position-left">
                            <a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?page=1&limit=60'; ?>&sortby=<?php echo $sortby;?>">60</a>
                        </span>
                    </div>
                    <div class="col-lg-8 hidden-md hidden-sm hidden-xs remove-padding clearleft pleftpage-4">
                        <span class="gotham-light position-left">
                            <?php echo!isset($_GET['page']) || $_GET['page'] == 1 ? 1 : (($_GET['limit'] * $_GET['page']) - $_GET['limit']) + 1; ?>
                            - 
                            <?php echo!isset($_GET['limit']) ? 20 : ($_GET['limit'] * $_GET['page']); ?>
                            From <?php echo $count; ?> Products
                        </span>
                    </div>
                    <?php
                    $total_page = ceil($count / $limit);
					
					if(ceil($count/$limit)==1){
						if (!isset($_GET['page'])|| $_GET['page'] == 1){
							
						}
					/*jika jumlah halamannya 2*/
					
					}elseif(ceil($count/$limit)==2){					
					?>
						<?php
						if (!isset($_GET['page']) && !isset($_GET['limit'])) {
						?>
							<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
								<span class="gotham-medium pleft13-5 remove-padding">
									<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=1&amp;limit=20&sortby=<?php echo $sortby;?>">1</a>
								</span>
								<span class="gotham-light pleft13-5 pleft-mobile-4">
									<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=20&sortby=<?php echo $sortby;?>">2</a>
								</span>
								<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
									<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=20&sortby=<?php echo $sortby;?>">NEXT</a>
								</span>
								<span class="hidden-lg hidden-mdgotham-light pleft13-5 pleft-mobile-4 nexticonpagin">
									<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=20&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
								</span>
							</div>
						<?php 
						} elseif (!isset($_GET['page']) || $_GET['page'] == 1) { 
						?>
							<?php 
							// if user filter something
							if(isset($_GET['brands']) && isset($_GET['sort'])){ 
							?>
								<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright">

									<span class="gotham-medium pleft13-5 remove-padding">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=1&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">1</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">2</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
									</span>
								</div>
							<?php 
							} else { 
							?>
								<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

									<span class="gotham-medium pleft13-5 remove-padding">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">1</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">2</a>
									</span>
									<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
									</span>
									<span class="hidden-lg hidden-md gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
									</span>
								</div>
							<?php 
							} 
							?>
						<?php 
						} else { 
						?>
							<?php
							$current = $_GET['page'];
							?>
							<?php 
							if ($current != $total_page) { 
							?>
								<?php 
								// if user filter something
								if(isset($_GET['brands']) && isset($_GET['sort'])){ 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright">
										<span class="gotham-light pleft18 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
										</span>
									</div>
								<?php 
								}
								?>
							<?php 
							} else { 
							?>
								<?php 
								// if user filter something
								if(isset($_GET['brands']) && isset($_GET['sort'])){ 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright">
										<span class="gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
										</span>
									</div>    
								<?php 
								} else { 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
										<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
										</span>
										<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
										</span>
									</div>  
								<?php 
								} 
								?>
							<?php 
							} 
							?>
						<?php 
						} 
						?>
					<?php
					}elseif(ceil($count/$limit)==3){
					?>
						<?php
						if (!isset($_GET['page']) && !isset($_GET['limit'])) {
						?>
							<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

								<span class="gotham-medium pleft13-5 remove-padding">
									<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=1&amp;limit=20&sortby=<?php echo $sortby;?>">1</a>
								</span>
								<span class="gotham-light pleft13-5 pleft-mobile-4">
									<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=20&sortby=<?php echo $sortby;?>">2</a>
								</span>
								<span class="gotham-light pleft13-5 pleft-mobile-4">
									<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=3&amp;limit=20&sortby=<?php echo $sortby;?>">3</a>
								</span>
								<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
									<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=20&sortby=<?php echo $sortby;?>">NEXT</a>
								</span>
								<span class="hidden-lg hidden-mdgotham-light pleft13-5 pleft-mobile-4 nexticonpagin">
									<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=20&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
								</span>
							</div>
						<?php 
						} elseif (!isset($_GET['page']) || $_GET['page'] == 1) { 
						?>
							<?php 
							// if user filter something
							if(isset($_GET['brands']) && isset($_GET['sort'])){ 
							?>
								<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright">

									<span class="gotham-medium pleft13-5 remove-padding">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=1&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">1</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">2</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=3&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">3</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
									</span>
								</div>
							<?php 
							} else { 
							?>
								<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

									<span class="gotham-medium pleft13-5 remove-padding">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">1</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">2</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=3&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">3</a>
									</span>
									<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
									</span>
									<span class="hidden-lg hidden-md gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
									</span>
								</div>
							<?php 
							} 
							?>
						<?php 
						} else { 
						?>
							<?php
							$current = $_GET['page'];
							?>
							<?php 
							if ($current != $total_page) { 
							?>
								<?php 
								// if user filter something
								if(isset($_GET['brands']) && isset($_GET['sort'])){ 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright">
										<span class="gotham-light pleft18 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 1; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
										</span>
									</div>
								<?php 
								} else { 
								?>
									
										<?php 
										if($_GET['page'] == 2){ 
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
												<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
												</span>
											</div>
										<?php 
										}
										?>
								<?php 
								} 
								?>
							<?php 
							} else { 
							?>
								<?php 
								// if user filter something
								if(isset($_GET['brands']) && isset($_GET['sort'])){ 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright">
										<span class="gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 2; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
										</span>
									</div>    
								<?php 
								} else { 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
										<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
										</span>
										<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 2; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
										</span>
									</div>  
								<?php 
								} 
								?>
							<?php 
							} 
							?>
						<?php 
						} 
						?>
					<?php
					}elseif(ceil($count/$limit)==4){
					?>
						<?php
						if (!isset($_GET['page']) && !isset($_GET['limit'])) {
						?>
							<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

								<span class="gotham-medium pleft13-5 remove-padding">
									<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=1&amp;limit=20&sortby=<?php echo $sortby;?>">1</a>
								</span>
								<span class="gotham-light pleft13-5 pleft-mobile-4">
									<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=20&sortby=<?php echo $sortby;?>">2</a>
								</span>
								<span class="gotham-light pleft13-5 pleft-mobile-4">
									<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=3&amp;limit=20&sortby=<?php echo $sortby;?>">3</a>
								</span>
								<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
									<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=4&amp;limit=20&sortby=<?php echo $sortby;?>">4</a>
								</span>
								<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
									<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=20&sortby=<?php echo $sortby;?>">NEXT</a>
								</span>
								<span class="hidden-lg hidden-mdgotham-light pleft13-5 pleft-mobile-4 nexticonpagin">
									<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=20&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
								</span>
							</div>
						<?php 
						} elseif (!isset($_GET['page']) || $_GET['page'] == 1) { 
						?>
							<?php 
							// if user filter something
							if(isset($_GET['brands']) && isset($_GET['sort'])){ 
							?>
								<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright">

									<span class="gotham-medium pleft13-5 remove-padding">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=1&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">1</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">2</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=3&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">3</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=3&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">4</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
									</span>
								</div>
							<?php 
							} else { 
							?>
								<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
									<span class="gotham-medium pleft13-5 remove-padding">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">1</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">2</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=3&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">3</a>
									</span>
									<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=4&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">4</a>
									</span>
									<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
									</span>
									<span class="hidden-lg hidden-md gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
									</span>
								</div>
							<?php 
							} 
							?>
						<?php 
						} else { 
						?>
							<?php
							$current = $_GET['page'];
							?>
							<?php 
							if ($current != $total_page) { 
							?>
								<?php 
								// if user filter something
								if(isset($_GET['brands']) && isset($_GET['sort'])){ 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright">
										<span class="gotham-light pleft18 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 1; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 2; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
										</span>
									</div>
								<?php 
								} else { 
								?>
									
										<?php 
										if($_GET['page'] == 2){ 
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
												<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 2; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
												</span>
											</div>
										<?php 
										}elseif($_GET['page'] == 3) { 
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
												<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>             
												<span class="hidden-lg hidden-md gotham-light pleft13-5 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">1</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
													..
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo ($current - 2); ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 2; ?></a>
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
												</span>
											</div>
										<?php 
										}
										?>
								<?php 
								} 
								?>
							<?php 
							} else { 
							?>
								<?php 
								// if user filter something
								if(isset($_GET['brands']) && isset($_GET['sort'])){ 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright">
										<span class="gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current - 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 3; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 2; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
										</span>
									</div>    
								<?php 
								} else { 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
										<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
										</span>
										<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current - 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 3; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 2; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
										</span>
									</div>  
								<?php 
								} 
								?>
							<?php 
							} 
							?>
						<?php 
						} 
						?>
					<?php
					}else{
					?>
						<?php
						if (!isset($_GET['page']) && !isset($_GET['limit'])) {
						?>
							<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

								<span class="gotham-medium pleft13-5 remove-padding">
									<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=1&amp;limit=20&sortby=<?php echo $sortby;?>">1</a>
								</span>
								<span class="gotham-light pleft13-5 pleft-mobile-4">
									<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=20&sortby=<?php echo $sortby;?>">2</a>
								</span>
								<span class="gotham-light pleft13-5 pleft-mobile-4">
									<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=3&amp;limit=20&sortby=<?php echo $sortby;?>">3</a>
								</span>
								<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
									<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=4&amp;limit=20&sortby=<?php echo $sortby;?>">4</a>
								</span>
								<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
									<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=5&amp;limit=20&sortby=<?php echo $sortby;?>">5</a>
								</span>
								<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
									..
								</span>
								<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
									....
								</span>
								<span class="hidden-sm hidden-xs gotham-light pleft13-5 remove-padding">
									<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $total_page;?>&amp;limit=20&sortby=<?php echo $sortby;?>"><?php echo $total_page;?></a>
								</span>
								
								<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
									<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=20&sortby=<?php echo $sortby;?>">NEXT</a>
								</span>
								<span class="hidden-lg hidden-mdgotham-light pleft13-5 pleft-mobile-4 nexticonpagin">
									<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=20&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
								</span>
							</div>
						<?php 
						} elseif (!isset($_GET['page']) || $_GET['page'] == 1) { 
						?>
							<?php 
							// if user filter something
							if(isset($_GET['brands']) && isset($_GET['sort'])){ 
							?>
								<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright">

									<span class="gotham-medium pleft13-5 remove-padding">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=1&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">1</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">2</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=3&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">3</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
									</span>
								</div>
							<?php 
							} else { 
							?>
								<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

									<span class="gotham-medium pleft13-5 remove-padding">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">1</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">2</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=3&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">3</a>
									</span>
									<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=4&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">4</a>
									</span>
									<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=5&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">5</a>
									</span>
									<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
										..
									</span>
									<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
										....
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $total_page;?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $total_page;?></a>
									</span>
									<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
									</span>
									<span class="hidden-lg hidden-md gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
									</span>
								</div>
							<?php 
							} 
							?>
						<?php 
						} else { 
						?>
							<?php
							$current = $_GET['page'];
							?>
							<?php 
							if ($current != $total_page) { 
							?>
								<?php 
								// if user filter something
								if(isset($_GET['brands']) && isset($_GET['sort'])){ 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright">
										<span class="gotham-light pleft18 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 1; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
										</span>
									</div>
								<?php 
								} else { 
								?>
									
										<?php 
										if($_GET['page'] == 2){ 
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
												<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 2; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current + 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 3; ?></a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
													..
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
													....
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $total_page; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $total_page; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
												</span>
											</div>
										<?php 
										}elseif($_GET['page'] == 3) { 
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
												<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>             
												<span class="hidden-lg hidden-md gotham-light pleft13-5 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
													..
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo ($current - 2); ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 2; ?></a>
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 2; ?></a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
													..
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
													....
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $total_page; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $total_page; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
												</span>
											</div>
										<?php 
										}elseif($_GET['page'] == ($total_page-1)){ 
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
												<span class="hidden-sm hidden-xs gotham-light pleft18 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft18 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>
												<span class="gotham-light pleft13-5 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">1</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
													..
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
													....
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $total_page - 4; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $total_page - 4; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $total_page - 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $total_page - 3; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $total_page - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $total_page - 2; ?></a>
												</span>
												<span class="gotham-medium pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
												</span>
											</div>
										<?php 
										}elseif($_GET['page'] == ($total_page-2)){
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
												<span class="hidden-sm hidden-xs gotham-light pleft18 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft18 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>
												<span class="gotham-light pleft13-5 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">1</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
													..
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
													....
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $total_page - 4; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $total_page - 4; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $total_page - 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $total_page - 3; ?></a>
												</span>
												<span class="gotham-medium pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 2; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
												</span>
											</div>
										<?php 
										}elseif($_GET['page'] == ($total_page-3)){
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
												<span class="hidden-sm hidden-xs gotham-light pleft18 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft18 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>
												<span class="gotham-light pleft13-5 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">1</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
													..
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
													....
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $total_page - 4; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $total_page - 4; ?></a>
												</span>
												<span class="gotham-medium pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 2; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current + 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 3; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
												</span>
											</div>   
										<?php 
										}else{ 
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage-3 pleftpagemobilepag3">
												<span class="hidden-sm hidden-xs gotham-light pleft18 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft18 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>
												<span class="gotham-light pleft13-5 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">1</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
													..
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
													....
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo ($current - 2); ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 2; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current + 2; ?></a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
													..
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
													....
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $total_page; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $total_page; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
												</span>
											</div>
										<?php 
										} 
										?>
								<?php 
								} 
								?>
							<?php 
							} else { 
							?>
								<?php 
								// if user filter something
								if(isset($_GET['brands']) && isset($_GET['sort'])){ 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright">
										<span class="gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 2; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
										</span>
									</div>    
								<?php 
								} else { 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
										<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">PREV</a>
										</span>
										<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
										</span>
										<span class="gotham-light pleft13-5 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>">1</a>
										</span>
										<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
											..
										</span>
										<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
											....
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current - 4; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 4; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current - 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 3; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 2; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/surprise-sale'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>&sortby=<?php echo $sortby;?>"><?php echo $current; ?></a>
										</span>
									</div>  
								<?php 
								} 
								?>
							<?php 
							} 
							?>
						<?php 
						} 
						?>
					<?php
					}
					?>
					
					
                </div>
            </div>
        </div>
    </section>
    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icon_top.png" class="scrollup"></a>
            <?php } else { ?>
            <section id="product">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 ptop5 pbottom3">
                        <center><span class="gotham-light fsize-1" style="font-size: 25px;">COMING SOON</span></center>
                    </div>
                </div>
            </section>
            <?php } ?>
            <?php } else { ?>
            <section id="product">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 ptop5 pbottom3">
                        <center><span class="gotham-light fsize-1" style="font-size: 25px;">COMING SOON</span></center>
                    </div>
                </div>
            </section>                 
            <?php } ?>
        </div>
    </div>
</section>
<style>
	@media only screen and (min-width : 768px) {
		.pleft-5-dwpetite {padding-left: 5%; }
		.carousel.slide-dwpetite {width: 90%; margin-left: 4%; }
		.row.brand-banner-dwpetite header {margin-top: 0;}
		section#brand-description-dwpetite {padding-top: 4em; padding-bottom: 10px;}
		.brand-name-full {font-family: "gotham-light"; font-size: 16px; letter-spacing: 1px;}
		.brand-description {
			margin-top: 1%;
			padding-top: 1%;
			font-family: "gotham-light";
			letter-spacing: 1.5px;
			border: none;
			font-size: 12px;
		}
	}
	
	@media only screen and (max-width : 767px) {
		.brand-description {
			margin-top: 1%;
			padding-top: 1%;
			font-family: "gotham-light";
			letter-spacing: 1.5px;
			border: none;
			font-size: 12px;
		}
		.brand-name-full {font-family: "gotham-light"; font-size: 16px; letter-spacing: 1px; border: none; }
		.mtop-8em-mobile { margin-top: 8em; }
	}
</style>