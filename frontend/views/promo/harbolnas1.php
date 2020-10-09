<?php
session_start();
$breadcrumbs = $this->context->breadcrumb;

  $url = explode("/",$_SERVER['REQUEST_URI']);

  $urls = explode("?",$url[1]);
  // echo $urls[0];

if(isset($_GET['sort'])){
    $params = 'sort=' . $_GET['sort'];
}

if(isset($_GET['brands'])){
    $params = $params . '&brands=' . $_GET['brands'];
    $brands_selection = explode('--', $_GET['brands']);
}

if(isset($_GET['price'])){
    $params = $params . '&price=' . $_GET['price'];
    $price_selection = explode('--', $_GET['price']);
}

if(isset($_GET['gender'])){
    $params = $params . '&gender=' . $_GET['gender'];
    $genders_selection = explode('--', $_GET['gender']);
}

if(isset($_GET['category'])){
    $params = $params . '&category=' . $_GET['category'];
}

if(isset($_GET['type'])){
    $params = $params . '&type=' . $_GET['type'];
    $types_selection = explode('--', $_GET['type']);
}

if(isset($_GET['movement'])){
    $params = $params . '&movement=' . $_GET['movement'];
    $movements_selection = explode('--', $_GET['movement']);
}

if(isset($_GET['bandwidth'])){
    $params = $params . '&bandwidth=' . $_GET['bandwidth'];
    $bandwidth_selection = explode('--', $_GET['bandwidth']);
}

if(isset($_GET['water'])){
    $params = $params . '&water=' . $_GET['water'];
    $waters_selection = explode('--', $_GET['water']);
}
if(isset($_GET['size'])){
    $params = $params . '&size=' . $_GET['size'];
    $size_selection = explode('--', $_GET['size']);
}

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
        "list": "Landing Page Promo Ramadhan Aark Collective"
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
<section class="ptop1" style="padding-bottom:5px;">
    <div class="container">
        <div class="row">
           
            
            <section id="category" class="p0">
                <div class="container">
                     <div class="row">
            			<div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearleft clearright">
            				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1212/Main-Home-Banner.jpg" class="img-responsive">
            			</div>
            			<div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft clearright">
            				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1212/mobile/Main-Home-Banner.jpg" class="img-responsive">
            			</div>
            		</div>
            	</div>
            </section>
			<?php 
                $current_date = date('Y-m-d H:i:s');
    // 			if($_SESSION['customerInfo']['customer_id'] == 7614){
    // 				$current_date = '2018-10-10 00:00:00';
    // 			}
                if($current_date >= '2018-12-10 00:00:00' && $current_date <= '2018-12-12 23:59:59'){
            ?>
            
			<section id="category" class="p0">
                <div class="container">
                     <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shop-title caption blue-bg-red">PROMO SPESIAL</div>
                        <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearleft clearright clearleft-mobile clearright-mobile">
                            <div class="col-lg-3 col-md-3 col-sm-3 pright5p clearleft clearleft-mobile">
                                <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/harbolnas-detail?type=115">
                                    <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1212/Main-Category-Casual-Banner.jpg" class="img-responsive">
                                </a>
                                
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pright5p pleft5p">
                                <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/harbolnas-detail?type=116">
                                    <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1212/Main-Category-Aktif-Banner.jpg" class="img-responsive">
                                </a>
                                
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pright5p pleft5p">
                                <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/harbolnas-detail?type=117">
                                    <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1212/Main-Category-Aksesoris-Banner.jpg" class="img-responsive">
                                </a>
                                
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pleft5p clearright clearright-mobile">
                                <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/harbolnas-detail?type=12">
                                    <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1212/Main-Category-Klasik-Banner.jpg" class="img-responsive">
                                </a>
                                
                            </div>
                        </div>
                        <div class="hidden-lg hidden-md hidden-sm col-xs-12">
                            <div class="col-xs-12 clearleft clearleft-mobile clearright clearright-mobile">
                                <div class="col-xs-6 pright5p clearleft clearleft-mobile">
                                    <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/harbolnas-detail?type=115">
                                        <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1212/mobile/Main-Category-Casual-Banner.jpg" class="img-responsive">
                                    </a>
                                    
                                </div>
                                <div class="col-xs-6 pleft5p clearright clearright-mobile">
                                    <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/harbolnas-detail?type=116">
                                        <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1212/mobile/Main-Category-Aktif-Banner.jpg" class="img-responsive">
                                    </a>
                                    
                                </div>
                            </div>
                            <div class="col-xs-12 clearleft clearleft-mobile clearright clearright-mobile ptop15">
                                <div class="col-xs-6 pright5p clearleft clearleft-mobile">
                                    <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/harbolnas-detail?type=117">
                                        <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1212/mobile/Main-Category-Aksesoris-Banner.jpg" class="img-responsive">
                                    </a>
                                    
                                </div>
                                <div class="col-xs-6 pleft5p clearright clearright-mobile">
                                    <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/harbolnas-detail?type=12">
                                        <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1212/mobile/Main-Category-Klasik-Banner.jpg" class="img-responsive">
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                     </div>
                 </div>
                        
            </section>
            
            <section id="category" class="p0 hidden-lg hidden-md hidden-sm hidden-xs">
                <div class="container">
                     <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shop-title caption fcolorblue blue-bg-red">VOUCHER</div>
                        <div class="col-lg-12 clearleft clearright clearleft-mobile clearright-mobile">
                            <div class="col-lg-3 col-md-3 col-sm-3 pright5p clearleft clearleft-mobile">
                                <a>
                                    <img src="https://thewatch.co/img/promo/harbolnas/1212/casual_parent_desktop.PNG" class="img-responsive">
                                </a>
                                
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pright5p pleft5p">
                                <a>
                                    <img src="https://thewatch.co/img/promo/harbolnas/1212/aktif_parent_desktop.PNG" class="img-responsive">
                                </a>
                                
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pright5p pleft5p">
                                <a>
                                    <img src="https://thewatch.co/img/promo/harbolnas/1212/aksesoris_parent_desktop.PNG" class="img-responsive">
                                </a>
                                
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pleft5p clearright clearright-mobile">
                                <a>
                                    <img src="https://thewatch.co/img/promo/harbolnas/1212/classic_parent_desktop.PNG" class="img-responsive">
                                </a>
                                
                            </div>
                        </div>       
                     </div>
                 </div>
                        
            </section>

            <section id="featured-brands" class="p0">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shop-title caption blue-bg-red">KATEGORI</div>
            </section>
            
            <section id="featured-brands" class="p0">
                <div class="container">
                     <div class="row">
            			<div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearleft clearright">
            				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1212/Main-Header-Casual-Banner.jpg" class="img-responsive">
            			</div>
            			<div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft clearright">
            				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1212/mobile/Main-Header-Casual-Banner.jpg" class="img-responsive">
            			</div>
            			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright ptop15">
            			    <?php 
            			    $i = 1;
            			    if (count($casual) > 0) { 
            			        foreach($casual as $product){    
            			    ?>
            			    <div class="col-sm-2 col-lg-2 col-md-2 space-product hidden-xs <?php echo $i == 1 ? 'clearleft clearleft-mobile pright75' : 'pright75 pleft75'; ?> mbottom-3-mobile" style="width:20%;">
                                <?php
                                    $stock = backend\models\ProductStock::findOne(['product_id' => $product->product_id]);
                                    $productStock = backend\models\ProductStock::findAll(['product_id' => $product->product_id]);
                                    $found = FALSE;
                                    $stockall = 0;
                                    foreach ($productStock as $attribute){
                                        $productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
                                        if($productattribute != NULL && $attribute->quantity != 0){
                                            $found = TRUE;
                                        }
                                        $stockall = $stockall + $attribute->quantity;
                                    }
        
                                    if($stock != NULL && !$found){
                                ?>
                                <a class="productClick" <?php echo $stock->quantity == 0 ? 'id="out-of-stock" data-id="'.$product->product_id.'"' : ''; ?> href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                    <?php } else { ?>
                                    <a class="productClick" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                    <?php } ?>
        							<div style="position:relative;">
        							    <div class="tag" style="right: 0; left: 15px; top: 15px;">
        									<!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">-->
        								</div>
        								<?php
                                        if($stock != NULL){
                                        ?>
                                        <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive bradius5 <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                        <?php
                                            echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
                                        ?>
                                        <?php
                                        } else {
                                        ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive bradius5">
        
                                        <?php } ?>
        							
                          
        							</div>
                                    <input type="hidden" name="productId" value="<?php echo $product->product_id; ?>">
                                    <input type="hidden" name="productName" value="<?php echo $product->productDetail->name; ?>">
                                    <input type="hidden" name="brandName" value="<?php echo $product->brands->brand_name; ?>">
                                    <input type="hidden" name="opt_list" value="<?php echo $breadcrumbs[0] . ' - ' . $breadcrumbs[2]; ?>">
                                    <input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
                                    <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                    <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace0-5"><?php echo ucwords($product->productDetail->name); ?></span></div>
                                    <?php
                                        // if product has discount
                                        $spesificPrice = backend\models\SpecificPrice::findOne(['product_id' => $product->product_id]);
                                        $discount = 0;
                                        $now = date('Y-m-d H:i:s');
        								$extraDiscount = 0;
        								$extraDiscountStartDate = '2018-10-10 00:00:00';
        								$extraDiscountEndDate = '2018-10-10 23:59:59';
        								if($_SESSION['customerInfo']['customer_id'] == 570){
        									$now = '2018-10-10 00:00:00';
        								}
                                        if ($spesificPrice != null) {
                                            ?>
                                            <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>
        	
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                                    <?php
                                                    if ($spesificPrice->reduction_type == 'percent') {
                                                        $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                    } elseif ($spesificPrice->reduction_type == 'amount') {
                                                        $discount = $spesificPrice->reduction;
                                                    }
        											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
        												$extraDiscount = (($product->price - $discount) * 0.1);
        												$discount += $extraDiscount;
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
                                            <?php } else { ?>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                                    <?php
                                                    if ($spesificPrice->reduction_type == 'percent') {
                                                        $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                    } elseif ($spesificPrice->reduction_type == 'amount') {
                                                        $discount = $spesificPrice->reduction;
                                                    }
        											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
        												$extraDiscount = (($product->price - $discount) * 0.1);
        												$discount += $extraDiscount;
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
                                    if($stockall == 0){
                                        ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
                                        Out of Stock
                                        </div>
                                        <?php
                                    }else{
                                        if(($product->price - $discount) > 500000){
                                        ?>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment" style="text-align: left;">
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
                                $i++;
            			        }
            			    
                            ?>
                            <div class="col-sm-2 col-lg-2 col-md-2 space-product hidden-xs mbottom-3-mobile pleft75 clearright clearright-mobile" style="width:20%;">
                                <div class="col-lg-12 clearleft clearright clearleft-mobile clearright-mobile bgcolorprimary bradius5 width100 lebih-lanjut-block" style="display:table;">
                                    <div class="gotham-light lebih-lanjut">
                                        <a class="border fcolorfff" target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/harbolnas-detail?type=115">Lebih Lanjut</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="" class="swiper-container-featured-brand-product hidden-lg hidden-md hidden-sm col-xs-12 clearleft-mobile clearright-mobile">
                                <div class="swiper-wrapper clearleft-mobile clearright-mobile">
                                    <?php
                                    foreach($casual as $product){    
                    			    ?>
                    			    <div class="swiper-slide clearleft-mobile clearright-mobile">
                                        <?php
                                            $stock = backend\models\ProductStock::findOne(['product_id' => $product->product_id]);
                                            $productStock = backend\models\ProductStock::findAll(['product_id' => $product->product_id]);
                                            $found = FALSE;
                                            $stockall = 0;
                                            foreach ($productStock as $attribute){
                                                $productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
                                                if($productattribute != NULL && $attribute->quantity != 0){
                                                    $found = TRUE;
                                                }
                                                $stockall = $stockall + $attribute->quantity;
                                            }
                
                                            if($stock != NULL && !$found){
                                        ?>
                                        <a class="productClick" <?php echo $stock->quantity == 0 ? 'id="out-of-stock" data-id="'.$product->product_id.'"' : ''; ?> href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                            <?php } else { ?>
                                            <a class="productClick" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                            <?php } ?>
                							<div style="position:relative;">
                							    <div class="tag" style="right: 0; left: 15px; top: 15px;">
                									<!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">-->
                								</div>
                								<?php
                                                if($stock != NULL){
                                                ?>
                                                <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive bradius5 <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                                <?php
                                                    echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
                                                ?>
                                                <?php
                                                } else {
                                                ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive bradius5">
                
                                                <?php } ?>
                							
                                  
                							</div>
                                            <input type="hidden" name="productId" value="<?php echo $product->product_id; ?>">
                                            <input type="hidden" name="productName" value="<?php echo $product->productDetail->name; ?>">
                                            <input type="hidden" name="brandName" value="<?php echo $product->brands->brand_name; ?>">
                                            <input type="hidden" name="opt_list" value="<?php echo $breadcrumbs[0] . ' - ' . $breadcrumbs[2]; ?>">
                                            <input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
                                            <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                            <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace0-5"><?php echo ucwords($product->productDetail->name); ?></span></div>
                                            <?php
                                                // if product has discount
                                                $spesificPrice = backend\models\SpecificPrice::findOne(['product_id' => $product->product_id]);
                                                $discount = 0;
                                                $now = date('Y-m-d H:i:s');
                								$extraDiscount = 0;
                								$extraDiscountStartDate = '2018-10-10 00:00:00';
                								$extraDiscountEndDate = '2018-10-10 23:59:59';
                								if($_SESSION['customerInfo']['customer_id'] == 570){
                									$now = '2018-10-10 00:00:00';
                								}
                                                if ($spesificPrice != null) {
                                                    ?>
                                                    <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>
                	
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                                            <?php
                                                            if ($spesificPrice->reduction_type == 'percent') {
                                                                $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                            } elseif ($spesificPrice->reduction_type == 'amount') {
                                                                $discount = $spesificPrice->reduction;
                                                            }
                											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
                												$extraDiscount = (($product->price - $discount) * 0.1);
                												$discount += $extraDiscount;
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
                                                    <?php } else { ?>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                                            <?php
                                                            if ($spesificPrice->reduction_type == 'percent') {
                                                                $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                            } elseif ($spesificPrice->reduction_type == 'amount') {
                                                                $discount = $spesificPrice->reduction;
                                                            }
                											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
                												$extraDiscount = (($product->price - $discount) * 0.1);
                												$discount += $extraDiscount;
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
                                            if($stockall == 0){
                                                ?>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
                                                Out of Stock
                                                </div>
                                                <?php
                                            }else{
                                                if(($product->price - $discount) > 500000){
                                                ?>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment" style="text-align: left;">
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
                                        $i++;
                    			        }
                    			        ?>
                                    <div class="swiper-slide clearleft-mobile clearright-mobile">
                                        <div class="col-lg-12 clearleft clearright clearleft-mobile clearright-mobile bgcolorred bradius5 width100 lebih-lanjut-block" style="display:table;">
                                            <div class="gotham-light lebih-lanjut">
                                                <a class="border fcolorfff" target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/harbolnas-detail?type=115">Lebih Lanjut</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
            			</div>
            			
            		</div>
            	</div>
            </section>
            <section id="featured-brands" class="p0 mbottom50">
            </section>
            
            <section id="featured-brands" class="p0">
                <div class="container">
                     <div class="row">
            			<div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearleft clearright">
            				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1212/Main-Header-Aktif-Banner.jpg" class="img-responsive">
            			</div>
            			<div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft clearright">
            				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1212/mobile/Main-Header-Aktif-Banner.jpg" class="img-responsive">
            			</div>
            			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright ptop15">
            			    <?php 
            			    $i = 1;
            			    if (count($aktif) > 0) { 
            			        foreach($aktif as $product){    
            			    ?>
            			    <div class="col-sm-2 col-lg-2 col-md-2 space-product hidden-xs <?php echo $i == 1 ? 'clearleft clearleft-mobile pright75' : 'pright75 pleft75'; ?> mbottom-3-mobile" style="width:20%;">
                                <?php
                                    $stock = backend\models\ProductStock::findOne(['product_id' => $product->product_id]);
                                    $productStock = backend\models\ProductStock::findAll(['product_id' => $product->product_id]);
                                    $found = FALSE;
                                    $stockall = 0;
                                    foreach ($productStock as $attribute){
                                        $productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
                                        if($productattribute != NULL && $attribute->quantity != 0){
                                            $found = TRUE;
                                        }
                                        $stockall = $stockall + $attribute->quantity;
                                    }
        
                                    if($stock != NULL && !$found){
                                ?>
                                <a class="productClick" <?php echo $stock->quantity == 0 ? 'id="out-of-stock" data-id="'.$product->product_id.'"' : ''; ?> href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                    <?php } else { ?>
                                    <a class="productClick" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                    <?php } ?>
        							<div style="position:relative;">
        							    <div class="tag" style="right: 0; left: 15px; top: 15px;">
        									<!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">-->
        								</div>
        								<?php
                                        if($stock != NULL){
                                        ?>
                                        <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive bradius5 <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                        <?php
                                            echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
                                        ?>
                                        <?php
                                        } else {
                                        ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive bradius5">
        
                                        <?php } ?>
        							
                          
        							</div>
                                    <input type="hidden" name="productId" value="<?php echo $product->product_id; ?>">
                                    <input type="hidden" name="productName" value="<?php echo $product->productDetail->name; ?>">
                                    <input type="hidden" name="brandName" value="<?php echo $product->brands->brand_name; ?>">
                                    <input type="hidden" name="opt_list" value="<?php echo $breadcrumbs[0] . ' - ' . $breadcrumbs[2]; ?>">
                                    <input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
                                    <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                    <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace0-5"><?php echo ucwords($product->productDetail->name); ?></span></div>
                                    <?php
                                        // if product has discount
                                        $spesificPrice = backend\models\SpecificPrice::findOne(['product_id' => $product->product_id]);
                                        $discount = 0;
                                        $now = date('Y-m-d H:i:s');
        								$extraDiscount = 0;
        								$extraDiscountStartDate = '2018-10-10 00:00:00';
        								$extraDiscountEndDate = '2018-10-10 23:59:59';
        								if($_SESSION['customerInfo']['customer_id'] == 570){
        									$now = '2018-10-10 00:00:00';
        								}
                                        if ($spesificPrice != null) {
                                            ?>
                                            <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>
        	
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                                    <?php
                                                    if ($spesificPrice->reduction_type == 'percent') {
                                                        $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                    } elseif ($spesificPrice->reduction_type == 'amount') {
                                                        $discount = $spesificPrice->reduction;
                                                    }
        											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
        												$extraDiscount = (($product->price - $discount) * 0.1);
        												$discount += $extraDiscount;
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
                                            <?php } else { ?>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                                    <?php
                                                    if ($spesificPrice->reduction_type == 'percent') {
                                                        $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                    } elseif ($spesificPrice->reduction_type == 'amount') {
                                                        $discount = $spesificPrice->reduction;
                                                    }
        											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
        												$extraDiscount = (($product->price - $discount) * 0.1);
        												$discount += $extraDiscount;
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
                                    if($stockall == 0){
                                        ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
                                        Out of Stock
                                        </div>
                                        <?php
                                    }else{
                                        if(($product->price - $discount) > 500000){
                                        ?>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment" style="text-align: left;">
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
                                $i++;
            			        }
                            ?>
                            <div class="col-sm-2 col-lg-2 col-md-2 space-product hidden-xs mbottom-3-mobile pleft75 clearright clearright-mobile" style="width:20%;">
                                <div class="col-lg-12 clearleft clearright clearleft-mobile clearright-mobile bgcolorprimary bradius5 width100 lebih-lanjut-block" style="display:table;">
                                    <div class="gotham-light lebih-lanjut">
                                        <a class="border fcolorfff" target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/harbolnas-detail?type=116">Lebih Lanjut</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="" class="swiper-container-featured-brand-product hidden-lg hidden-md hidden-sm col-xs-12 clearleft-mobile clearright-mobile">
                                <div class="swiper-wrapper clearleft-mobile clearright-mobile">
                                    <?php
                                    foreach($aktif as $product){    
                    			    ?>
                    			    <div class="swiper-slide clearleft-mobile clearright-mobile">
                                        <?php
                                            $stock = backend\models\ProductStock::findOne(['product_id' => $product->product_id]);
                                            $productStock = backend\models\ProductStock::findAll(['product_id' => $product->product_id]);
                                            $found = FALSE;
                                            $stockall = 0;
                                            foreach ($productStock as $attribute){
                                                $productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
                                                if($productattribute != NULL && $attribute->quantity != 0){
                                                    $found = TRUE;
                                                }
                                                $stockall = $stockall + $attribute->quantity;
                                            }
                
                                            if($stock != NULL && !$found){
                                        ?>
                                        <a class="productClick" <?php echo $stock->quantity == 0 ? 'id="out-of-stock" data-id="'.$product->product_id.'"' : ''; ?> href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                            <?php } else { ?>
                                            <a class="productClick" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                            <?php } ?>
                							<div style="position:relative;">
                							    <div class="tag" style="right: 0; left: 15px; top: 15px;">
                									<!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">-->
                								</div>
                								<?php
                                                if($stock != NULL){
                                                ?>
                                                <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive bradius5 <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                                <?php
                                                    echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
                                                ?>
                                                <?php
                                                } else {
                                                ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive bradius5">
                
                                                <?php } ?>
                							
                                  
                							</div>
                                            <input type="hidden" name="productId" value="<?php echo $product->product_id; ?>">
                                            <input type="hidden" name="productName" value="<?php echo $product->productDetail->name; ?>">
                                            <input type="hidden" name="brandName" value="<?php echo $product->brands->brand_name; ?>">
                                            <input type="hidden" name="opt_list" value="<?php echo $breadcrumbs[0] . ' - ' . $breadcrumbs[2]; ?>">
                                            <input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
                                            <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                            <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace0-5"><?php echo ucwords($product->productDetail->name); ?></span></div>
                                            <?php
                                                // if product has discount
                                                $spesificPrice = backend\models\SpecificPrice::findOne(['product_id' => $product->product_id]);
                                                $discount = 0;
                                                $now = date('Y-m-d H:i:s');
                								$extraDiscount = 0;
                								$extraDiscountStartDate = '2018-10-10 00:00:00';
                								$extraDiscountEndDate = '2018-10-10 23:59:59';
                								if($_SESSION['customerInfo']['customer_id'] == 570){
                									$now = '2018-10-10 00:00:00';
                								}
                                                if ($spesificPrice != null) {
                                                    ?>
                                                    <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>
                	
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                                            <?php
                                                            if ($spesificPrice->reduction_type == 'percent') {
                                                                $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                            } elseif ($spesificPrice->reduction_type == 'amount') {
                                                                $discount = $spesificPrice->reduction;
                                                            }
                											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
                												$extraDiscount = (($product->price - $discount) * 0.1);
                												$discount += $extraDiscount;
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
                                                    <?php } else { ?>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                                            <?php
                                                            if ($spesificPrice->reduction_type == 'percent') {
                                                                $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                            } elseif ($spesificPrice->reduction_type == 'amount') {
                                                                $discount = $spesificPrice->reduction;
                                                            }
                											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
                												$extraDiscount = (($product->price - $discount) * 0.1);
                												$discount += $extraDiscount;
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
                                            if($stockall == 0){
                                                ?>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
                                                Out of Stock
                                                </div>
                                                <?php
                                            }else{
                                                if(($product->price - $discount) > 500000){
                                                ?>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment" style="text-align: left;">
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
                                        $i++;
                    			        }
                    			        ?>
                                    <div class="swiper-slide clearleft-mobile clearright-mobile">
                                        <div class="col-lg-12 clearleft clearright clearleft-mobile clearright-mobile bgcolorred bradius5 width100 lebih-lanjut-block" style="display:table;">
                                            <div class="gotham-light lebih-lanjut">
                                                <a class="border fcolorfff" target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/harbolnas-detail?type=116">Lebih Lanjut</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
            			</div>
            			
            		</div>
            	</div>
            </section>
            <section id="featured-brands" class="p0 mbottom50">
            </section>
            
            <section id="featured-brands" class="p0">
                <div class="container">
                     <div class="row">
            			<div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearleft clearright">
            				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1212/Main-Header-Aksesoris-Banner.jpg" class="img-responsive">
            			</div>
            			<div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft clearright">
            				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1212/mobile/Main-Header-Aksesoris-Banner.jpg" class="img-responsive">
            			</div>
            			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright ptop15">
            			    <?php 
            			    $i = 1;
            			    if (count($aksesoris) > 0) { 
            			        foreach($aksesoris as $product){    
            			    ?>
            			    <div class="col-sm-2 col-lg-2 col-md-2 space-product hidden-xs <?php echo $i == 1 ? 'clearleft clearleft-mobile pright75' : 'pright75 pleft75'; ?> mbottom-3-mobile" style="width:20%;">
                                <?php
                                    $stock = backend\models\ProductStock::findOne(['product_id' => $product->product_id]);
                                    $productStock = backend\models\ProductStock::findAll(['product_id' => $product->product_id]);
                                    $found = FALSE;
                                    $stockall = 0;
                                    foreach ($productStock as $attribute){
                                        $productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
                                        if($productattribute != NULL && $attribute->quantity != 0){
                                            $found = TRUE;
                                        }
                                        $stockall = $stockall + $attribute->quantity;
                                    }
        
                                    if($stock != NULL && !$found){
                                ?>
                                <a class="productClick" <?php echo $stock->quantity == 0 ? 'id="out-of-stock" data-id="'.$product->product_id.'"' : ''; ?> href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                    <?php } else { ?>
                                    <a class="productClick" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                    <?php } ?>
        							<div style="position:relative;">
        							    <div class="tag" style="right: 0; left: 15px; top: 15px;">
        									<!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">-->
        								</div>
        								<?php
                                        if($stock != NULL){
                                        ?>
                                        <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive bradius5 <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                        <?php
                                            echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
                                        ?>
                                        <?php
                                        } else {
                                        ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive bradius5">
        
                                        <?php } ?>
        							
                          
        							</div>
                                    <input type="hidden" name="productId" value="<?php echo $product->product_id; ?>">
                                    <input type="hidden" name="productName" value="<?php echo $product->productDetail->name; ?>">
                                    <input type="hidden" name="brandName" value="<?php echo $product->brands->brand_name; ?>">
                                    <input type="hidden" name="opt_list" value="<?php echo $breadcrumbs[0] . ' - ' . $breadcrumbs[2]; ?>">
                                    <input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
                                    <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                    <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace0-5"><?php echo ucwords($product->productDetail->name); ?></span></div>
                                    <?php
                                        // if product has discount
                                        $spesificPrice = backend\models\SpecificPrice::findOne(['product_id' => $product->product_id]);
                                        $discount = 0;
                                        $now = date('Y-m-d H:i:s');
        								$extraDiscount = 0;
        								$extraDiscountStartDate = '2018-10-10 00:00:00';
        								$extraDiscountEndDate = '2018-10-10 23:59:59';
        								if($_SESSION['customerInfo']['customer_id'] == 570){
        									$now = '2018-10-10 00:00:00';
        								}
                                        if ($spesificPrice != null) {
                                            ?>
                                            <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>
        	
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                                    <?php
                                                    if ($spesificPrice->reduction_type == 'percent') {
                                                        $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                    } elseif ($spesificPrice->reduction_type == 'amount') {
                                                        $discount = $spesificPrice->reduction;
                                                    }
        											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
        												$extraDiscount = (($product->price - $discount) * 0.1);
        												$discount += $extraDiscount;
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
                                            <?php } else { ?>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                                    <?php
                                                    if ($spesificPrice->reduction_type == 'percent') {
                                                        $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                    } elseif ($spesificPrice->reduction_type == 'amount') {
                                                        $discount = $spesificPrice->reduction;
                                                    }
        											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
        												$extraDiscount = (($product->price - $discount) * 0.1);
        												$discount += $extraDiscount;
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
                                    if($stockall == 0){
                                        ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
                                        Out of Stock
                                        </div>
                                        <?php
                                    }else{
                                        if(($product->price - $discount) > 500000){
                                        ?>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment" style="text-align: left;">
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
                                $i++;
            			        }
                            ?>
                            <div class="col-sm-2 col-lg-2 col-md-2 space-product hidden-xs mbottom-3-mobile pleft75 clearright clearright-mobile" style="width:20%;">
                                <div class="col-lg-12 clearleft clearright clearleft-mobile clearright-mobile bgcolorprimary bradius5 width100 lebih-lanjut-block" style="display:table;">
                                    <div class="gotham-light lebih-lanjut">
                                        <a class="border fcolorfff" target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/harbolnas-detail?type=117">Lebih Lanjut</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="" class="swiper-container-featured-brand-product hidden-lg hidden-md hidden-sm col-xs-12 clearleft-mobile clearright-mobile">
                                <div class="swiper-wrapper clearleft-mobile clearright-mobile">
                                    <?php
                                    foreach($aksesoris as $product){    
                    			    ?>
                    			    <div class="swiper-slide clearleft-mobile clearright-mobile">
                                        <?php
                                            $stock = backend\models\ProductStock::findOne(['product_id' => $product->product_id]);
                                            $productStock = backend\models\ProductStock::findAll(['product_id' => $product->product_id]);
                                            $found = FALSE;
                                            $stockall = 0;
                                            foreach ($productStock as $attribute){
                                                $productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
                                                if($productattribute != NULL && $attribute->quantity != 0){
                                                    $found = TRUE;
                                                }
                                                $stockall = $stockall + $attribute->quantity;
                                            }
                
                                            if($stock != NULL && !$found){
                                        ?>
                                        <a class="productClick" <?php echo $stock->quantity == 0 ? 'id="out-of-stock" data-id="'.$product->product_id.'"' : ''; ?> href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                            <?php } else { ?>
                                            <a class="productClick" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                            <?php } ?>
                							<div style="position:relative;">
                							    <div class="tag" style="right: 0; left: 15px; top: 15px;">
                									<!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">-->
                								</div>
                								<?php
                                                if($stock != NULL){
                                                ?>
                                                <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive bradius5 <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                                <?php
                                                    echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
                                                ?>
                                                <?php
                                                } else {
                                                ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive bradius5">
                
                                                <?php } ?>
                							
                                  
                							</div>
                                            <input type="hidden" name="productId" value="<?php echo $product->product_id; ?>">
                                            <input type="hidden" name="productName" value="<?php echo $product->productDetail->name; ?>">
                                            <input type="hidden" name="brandName" value="<?php echo $product->brands->brand_name; ?>">
                                            <input type="hidden" name="opt_list" value="<?php echo $breadcrumbs[0] . ' - ' . $breadcrumbs[2]; ?>">
                                            <input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
                                            <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                            <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace0-5"><?php echo ucwords($product->productDetail->name); ?></span></div>
                                            <?php
                                                // if product has discount
                                                $spesificPrice = backend\models\SpecificPrice::findOne(['product_id' => $product->product_id]);
                                                $discount = 0;
                                                $now = date('Y-m-d H:i:s');
                								$extraDiscount = 0;
                								$extraDiscountStartDate = '2018-10-10 00:00:00';
                								$extraDiscountEndDate = '2018-10-10 23:59:59';
                								if($_SESSION['customerInfo']['customer_id'] == 570){
                									$now = '2018-10-10 00:00:00';
                								}
                                                if ($spesificPrice != null) {
                                                    ?>
                                                    <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>
                	
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                                            <?php
                                                            if ($spesificPrice->reduction_type == 'percent') {
                                                                $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                            } elseif ($spesificPrice->reduction_type == 'amount') {
                                                                $discount = $spesificPrice->reduction;
                                                            }
                											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
                												$extraDiscount = (($product->price - $discount) * 0.1);
                												$discount += $extraDiscount;
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
                                                    <?php } else { ?>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                                            <?php
                                                            if ($spesificPrice->reduction_type == 'percent') {
                                                                $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                            } elseif ($spesificPrice->reduction_type == 'amount') {
                                                                $discount = $spesificPrice->reduction;
                                                            }
                											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
                												$extraDiscount = (($product->price - $discount) * 0.1);
                												$discount += $extraDiscount;
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
                                            if($stockall == 0){
                                                ?>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
                                                Out of Stock
                                                </div>
                                                <?php
                                            }else{
                                                if(($product->price - $discount) > 500000){
                                                ?>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment" style="text-align: left;">
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
                                        $i++;
                    			        }
                    			        ?>
                                    <div class="swiper-slide clearleft-mobile clearright-mobile">
                                        <div class="col-lg-12 clearleft clearright clearleft-mobile clearright-mobile bgcolorred bradius5 width100 lebih-lanjut-block" style="display:table;">
                                            <div class="gotham-light lebih-lanjut">
                                                <a class="border fcolorfff" target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/harbolnas-detail?type=117">Lebih Lanjut</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
            			</div>
            			
            		</div>
            	</div>
            </section>
            <section id="featured-brands" class="p0 mbottom50">
            </section>
            
            <section id="featured-brands" class="p0">
                <div class="container">
                     <div class="row">
            			<div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearleft clearright">
            				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1212/Main-Header-Klasik-Banner.jpg" class="img-responsive">
            			</div>
            			<div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft clearright">
            				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1212/mobile/Main-Header-Klasik-Banner.jpg" class="img-responsive">
            			</div>
            			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright ptop15">
            			    <?php 
            			    $i = 1;
            			    if (count($classic) > 0) { 
            			        foreach($classic as $product){    
            			    ?>
            			    <div class="col-sm-2 col-lg-2 col-md-2 space-product hidden-xs <?php echo $i == 1 ? 'clearleft clearleft-mobile pright75' : 'pright75 pleft75'; ?> mbottom-3-mobile" style="width:20%;">
                                <?php
                                    $stock = backend\models\ProductStock::findOne(['product_id' => $product->product_id]);
                                    $productStock = backend\models\ProductStock::findAll(['product_id' => $product->product_id]);
                                    $found = FALSE;
                                    $stockall = 0;
                                    foreach ($productStock as $attribute){
                                        $productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
                                        if($productattribute != NULL && $attribute->quantity != 0){
                                            $found = TRUE;
                                        }
                                        $stockall = $stockall + $attribute->quantity;
                                    }
        
                                    if($stock != NULL && !$found){
                                ?>
                                <a class="productClick" <?php echo $stock->quantity == 0 ? 'id="out-of-stock" data-id="'.$product->product_id.'"' : ''; ?> href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                    <?php } else { ?>
                                    <a class="productClick" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                    <?php } ?>
        							<div style="position:relative;">
        							    <div class="tag" style="right: 0; left: 15px; top: 15px;">
        									<!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">-->
        								</div>
        								<?php
                                        if($stock != NULL){
                                        ?>
                                        <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive bradius5 <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                        <?php
                                            echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
                                        ?>
                                        <?php
                                        } else {
                                        ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive bradius5">
        
                                        <?php } ?>
        							
                          
        							</div>
                                    <input type="hidden" name="productId" value="<?php echo $product->product_id; ?>">
                                    <input type="hidden" name="productName" value="<?php echo $product->productDetail->name; ?>">
                                    <input type="hidden" name="brandName" value="<?php echo $product->brands->brand_name; ?>">
                                    <input type="hidden" name="opt_list" value="<?php echo $breadcrumbs[0] . ' - ' . $breadcrumbs[2]; ?>">
                                    <input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
                                    <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                    <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace0-5"><?php echo ucwords($product->productDetail->name); ?></span></div>
                                    <?php
                                        // if product has discount
                                        $spesificPrice = backend\models\SpecificPrice::findOne(['product_id' => $product->product_id]);
                                        $discount = 0;
                                        $now = date('Y-m-d H:i:s');
        								$extraDiscount = 0;
        								$extraDiscountStartDate = '2018-10-10 00:00:00';
        								$extraDiscountEndDate = '2018-10-10 23:59:59';
        								if($_SESSION['customerInfo']['customer_id'] == 570){
        									$now = '2018-10-10 00:00:00';
        								}
                                        if ($spesificPrice != null) {
                                            ?>
                                            <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>
        	
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                                    <?php
                                                    if ($spesificPrice->reduction_type == 'percent') {
                                                        $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                    } elseif ($spesificPrice->reduction_type == 'amount') {
                                                        $discount = $spesificPrice->reduction;
                                                    }
        											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
        												$extraDiscount = (($product->price - $discount) * 0.1);
        												$discount += $extraDiscount;
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
                                            <?php } else { ?>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                                    <?php
                                                    if ($spesificPrice->reduction_type == 'percent') {
                                                        $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                    } elseif ($spesificPrice->reduction_type == 'amount') {
                                                        $discount = $spesificPrice->reduction;
                                                    }
        											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
        												$extraDiscount = (($product->price - $discount) * 0.1);
        												$discount += $extraDiscount;
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
                                    if($stockall == 0){
                                        ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
                                        Out of Stock
                                        </div>
                                        <?php
                                    }else{
                                        if(($product->price - $discount) > 500000){
                                        ?>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment" style="text-align: left;">
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
                                $i++;
            			        }
                            ?>
                            <div class="col-sm-2 col-lg-2 col-md-2 space-product hidden-xs mbottom-3-mobile pleft75 clearright clearright-mobile" style="width:20%;">
                                <div class="col-lg-12 clearleft clearright clearleft-mobile clearright-mobile bgcolorprimary bradius5 width100 lebih-lanjut-block" style="display:table;">
                                    <div class="gotham-light lebih-lanjut">
                                        <a class="border fcolorfff" target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/harbolnas-detail?type=12">Lebih Lanjut</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="" class="swiper-container-featured-brand-product hidden-lg hidden-md hidden-sm col-xs-12 clearleft-mobile clearright-mobile">
                                <div class="swiper-wrapper clearleft-mobile clearright-mobile">
                                    <?php
                                    foreach($classic as $product){    
                    			    ?>
                    			    <div class="swiper-slide clearleft-mobile clearright-mobile">
                                        <?php
                                            $stock = backend\models\ProductStock::findOne(['product_id' => $product->product_id]);
                                            $productStock = backend\models\ProductStock::findAll(['product_id' => $product->product_id]);
                                            $found = FALSE;
                                            $stockall = 0;
                                            foreach ($productStock as $attribute){
                                                $productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
                                                if($productattribute != NULL && $attribute->quantity != 0){
                                                    $found = TRUE;
                                                }
                                                $stockall = $stockall + $attribute->quantity;
                                            }
                
                                            if($stock != NULL && !$found){
                                        ?>
                                        <a class="productClick" <?php echo $stock->quantity == 0 ? 'id="out-of-stock" data-id="'.$product->product_id.'"' : ''; ?> href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                            <?php } else { ?>
                                            <a class="productClick" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                            <?php } ?>
                							<div style="position:relative;">
                							    <div class="tag" style="right: 0; left: 15px; top: 15px;">
                									<!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">-->
                								</div>
                								<?php
                                                if($stock != NULL){
                                                ?>
                                                <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive bradius5 <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                                <?php
                                                    echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
                                                ?>
                                                <?php
                                                } else {
                                                ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive bradius5">
                
                                                <?php } ?>
                							
                                  
                							</div>
                                            <input type="hidden" name="productId" value="<?php echo $product->product_id; ?>">
                                            <input type="hidden" name="productName" value="<?php echo $product->productDetail->name; ?>">
                                            <input type="hidden" name="brandName" value="<?php echo $product->brands->brand_name; ?>">
                                            <input type="hidden" name="opt_list" value="<?php echo $breadcrumbs[0] . ' - ' . $breadcrumbs[2]; ?>">
                                            <input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
                                            <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                            <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace0-5"><?php echo ucwords($product->productDetail->name); ?></span></div>
                                            <?php
                                                // if product has discount
                                                $spesificPrice = backend\models\SpecificPrice::findOne(['product_id' => $product->product_id]);
                                                $discount = 0;
                                                $now = date('Y-m-d H:i:s');
                								$extraDiscount = 0;
                								$extraDiscountStartDate = '2018-10-10 00:00:00';
                								$extraDiscountEndDate = '2018-10-10 23:59:59';
                								if($_SESSION['customerInfo']['customer_id'] == 570){
                									$now = '2018-10-10 00:00:00';
                								}
                                                if ($spesificPrice != null) {
                                                    ?>
                                                    <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>
                	
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                                            <?php
                                                            if ($spesificPrice->reduction_type == 'percent') {
                                                                $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                            } elseif ($spesificPrice->reduction_type == 'amount') {
                                                                $discount = $spesificPrice->reduction;
                                                            }
                											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
                												$extraDiscount = (($product->price - $discount) * 0.1);
                												$discount += $extraDiscount;
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
                                                    <?php } else { ?>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                                            <?php
                                                            if ($spesificPrice->reduction_type == 'percent') {
                                                                $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                            } elseif ($spesificPrice->reduction_type == 'amount') {
                                                                $discount = $spesificPrice->reduction;
                                                            }
                											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
                												$extraDiscount = (($product->price - $discount) * 0.1);
                												$discount += $extraDiscount;
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
                                            if($stockall == 0){
                                                ?>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
                                                Out of Stock
                                                </div>
                                                <?php
                                            }else{
                                                if(($product->price - $discount) > 500000){
                                                ?>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment" style="text-align: left;">
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
                                        $i++;
                    			        }
                    			        ?>
                                    <div class="swiper-slide clearleft-mobile clearright-mobile">
                                        <div class="col-lg-12 clearleft clearright clearleft-mobile clearright-mobile bgcolorred bradius5 width100 lebih-lanjut-block" style="display:table;">
                                            <div class="gotham-light lebih-lanjut">
                                                <a class="border fcolorfff" target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/harbolnas-detail?type=12">Lebih Lanjut</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
            			</div>
            			
            		</div>
            	</div>
            </section>
            <section id="featured-brands" class="p0">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shop-title caption blue-bg-red">UNTUK ANDA</div>
            </section>
            
            <section id="featured-brands" class="p0">
                <div class="container">
                     <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearleft clearright ptop15">
            			    <?php 
            			    $i = 1;
            			    if (count($products) > 0) { 
            			        foreach($products as $product){
            			            if($i == 1){ $i_text = 'clearleft clearleft-mobile pright75';}
            			            elseif($i == 5){ $i_text = 'clearleft clearleft-mobile pright75';}
            			            else{ $i_text = 'pleft75 pright75';}
            			    ?>
            			    <div class="col-sm-2 col-lg-2 col-md-2 space-product col-xs-6 <?php echo $i_text; ?> mbottom-3-mobile" style="width:20%;">
                                <?php
                                    $stock = backend\models\ProductStock::findOne(['product_id' => $product->product_id]);
                                    $productStock = backend\models\ProductStock::findAll(['product_id' => $product->product_id]);
                                    $found = FALSE;
                                    $stockall = 0;
                                    foreach ($productStock as $attribute){
                                        $productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
                                        if($productattribute != NULL && $attribute->quantity != 0){
                                            $found = TRUE;
                                        }
                                        $stockall = $stockall + $attribute->quantity;
                                    }
        
                                    if($stock != NULL && !$found){
                                ?>
                                <a class="productClick" <?php echo $stock->quantity == 0 ? 'id="out-of-stock" data-id="'.$product->product_id.'"' : ''; ?> href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                    <?php } else { ?>
                                    <a class="productClick" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                    <?php } ?>
        							<div style="position:relative;">
        							    <div class="tag" style="right: 0; left: 15px; top: 15px;">
        									<!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">-->
        								</div>
        								<?php
                                        if($stock != NULL){
                                        ?>
                                        <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive bradius5 <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                        <?php
                                            echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
                                        ?>
                                        <?php
                                        } else {
                                        ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive bradius5">
        
                                        <?php } ?>
        							
                          
        							</div>
                                    <input type="hidden" name="productId" value="<?php echo $product->product_id; ?>">
                                    <input type="hidden" name="productName" value="<?php echo $product->productDetail->name; ?>">
                                    <input type="hidden" name="brandName" value="<?php echo $product->brands->brand_name; ?>">
                                    <input type="hidden" name="opt_list" value="<?php echo $breadcrumbs[0] . ' - ' . $breadcrumbs[2]; ?>">
                                    <input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
                                    <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                    <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace0-5"><?php echo ucwords($product->productDetail->name); ?></span></div>
                                    <?php
                                        // if product has discount
                                        $spesificPrice = backend\models\SpecificPrice::findOne(['product_id' => $product->product_id]);
                                        $discount = 0;
                                        $now = date('Y-m-d H:i:s');
        								$extraDiscount = 0;
        								$extraDiscountStartDate = '2018-10-10 00:00:00';
        								$extraDiscountEndDate = '2018-10-10 23:59:59';
        								if($_SESSION['customerInfo']['customer_id'] == 570){
        									$now = '2018-10-10 00:00:00';
        								}
                                        if ($spesificPrice != null) {
                                            ?>
                                            <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>
        	
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                                    <?php
                                                    if ($spesificPrice->reduction_type == 'percent') {
                                                        $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                    } elseif ($spesificPrice->reduction_type == 'amount') {
                                                        $discount = $spesificPrice->reduction;
                                                    }
        											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
        												$extraDiscount = (($product->price - $discount) * 0.1);
        												$discount += $extraDiscount;
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
                                            <?php } else { ?>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                                    <?php
                                                    if ($spesificPrice->reduction_type == 'percent') {
                                                        $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                    } elseif ($spesificPrice->reduction_type == 'amount') {
                                                        $discount = $spesificPrice->reduction;
                                                    }
        											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
        												$extraDiscount = (($product->price - $discount) * 0.1);
        												$discount += $extraDiscount;
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
                                    if($stockall == 0){
                                        ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
                                        Out of Stock
                                        </div>
                                        <?php
                                    }else{
                                        if(($product->price - $discount) > 500000){
                                        ?>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment" style="text-align: left;">
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
                                if($i == 5){
                                    echo '<div class="col-lg-12 new-line"></div>';
                                    $i = 0;
                                }
                                $i++;
            			        }
                            ?>
                           
                            <?php } ?>
            			</div>
            			
            			<div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft clearright ptop15">
            			    <?php 
            			    $i = 1;
            			    if (count($products) > 0) { 
            			        foreach($products as $product){
            			            if($i == 1){ $i_text = 'clearleft clearleft-mobile pright75';}
            			            elseif($i == 2){ $i_text = 'clearright clearright-mobile pleft75';}
            			            else{ $i_text = 'pleft75 pright75';}
            			    ?>
            			    <div class="hidden-lg hidden-md hidden-sm space-product col-xs-6 <?php echo $i_text; ?> mbottom-3-mobile">
                                <?php
                                    $stock = backend\models\ProductStock::findOne(['product_id' => $product->product_id]);
                                    $productStock = backend\models\ProductStock::findAll(['product_id' => $product->product_id]);
                                    $found = FALSE;
                                    $stockall = 0;
                                    foreach ($productStock as $attribute){
                                        $productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
                                        if($productattribute != NULL && $attribute->quantity != 0){
                                            $found = TRUE;
                                        }
                                        $stockall = $stockall + $attribute->quantity;
                                    }
        
                                    if($stock != NULL && !$found){
                                ?>
                                <a class="productClick" <?php echo $stock->quantity == 0 ? 'id="out-of-stock" data-id="'.$product->product_id.'"' : ''; ?> href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                    <?php } else { ?>
                                    <a class="productClick" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                    <?php } ?>
        							<div style="position:relative;">
        							    <div class="tag" style="right: 0; left: 15px; top: 15px;">
        									<!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">-->
        								</div>
        								<?php
                                        if($stock != NULL){
                                        ?>
                                        <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive bradius5 <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                        <?php
                                            echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
                                        ?>
                                        <?php
                                        } else {
                                        ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive bradius5">
        
                                        <?php } ?>
        							
                          
        							</div>
                                    <input type="hidden" name="productId" value="<?php echo $product->product_id; ?>">
                                    <input type="hidden" name="productName" value="<?php echo $product->productDetail->name; ?>">
                                    <input type="hidden" name="brandName" value="<?php echo $product->brands->brand_name; ?>">
                                    <input type="hidden" name="opt_list" value="<?php echo $breadcrumbs[0] . ' - ' . $breadcrumbs[2]; ?>">
                                    <input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
                                    <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                    <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace0-5"><?php echo ucwords($product->productDetail->name); ?></span></div>
                                    <?php
                                        // if product has discount
                                        $spesificPrice = backend\models\SpecificPrice::findOne(['product_id' => $product->product_id]);
                                        $discount = 0;
                                        $now = date('Y-m-d H:i:s');
        								$extraDiscount = 0;
        								$extraDiscountStartDate = '2018-10-10 00:00:00';
        								$extraDiscountEndDate = '2018-10-10 23:59:59';
        								if($_SESSION['customerInfo']['customer_id'] == 570){
        									$now = '2018-10-10 00:00:00';
        								}
                                        if ($spesificPrice != null) {
                                            ?>
                                            <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>
        	
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                                    <?php
                                                    if ($spesificPrice->reduction_type == 'percent') {
                                                        $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                    } elseif ($spesificPrice->reduction_type == 'amount') {
                                                        $discount = $spesificPrice->reduction;
                                                    }
        											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
        												$extraDiscount = (($product->price - $discount) * 0.1);
        												$discount += $extraDiscount;
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
                                            <?php } else { ?>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                                    <?php
                                                    if ($spesificPrice->reduction_type == 'percent') {
                                                        $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                    } elseif ($spesificPrice->reduction_type == 'amount') {
                                                        $discount = $spesificPrice->reduction;
                                                    }
        											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
        												$extraDiscount = (($product->price - $discount) * 0.1);
        												$discount += $extraDiscount;
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
                                    if($stockall == 0){
                                        ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
                                        Out of Stock
                                        </div>
                                        <?php
                                    }else{
                                        if(($product->price - $discount) > 500000){
                                        ?>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment" style="text-align: left;">
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
                                if($i == 2){
                                    echo '<div class="col-xs-12 new-line"></div>';
                                    $i = 0;
                                }
                                $i++;
            			        }
                            ?>
                           
                            <?php } ?>
            			</div>
            			
            			<div class="col-lg-5 col-md-5 col-sm-4 col-xs-3"></div>
            			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 clearleft clearright ptop15">
            			    <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/harbolnas-detail" class="blue-round default">Lainnya</a>
            			</div>
            			<div class="col-lg-5 col-md-5 col-sm-4 col-xs-3"></div>
                    </div>
                </div>
            </section>
            
            <section id="featured-brands">
                <div class="col-xs-12 hidden-lg hidden-md hidden-sm" style="padding-top:80px;"></div>
            </section>
            
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
<section style="margin-top: 10px;padding-bottom:0px;padding-top:0px;">
    <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" style="background-color: #fff;letter-spacing: 0.5px;padding-bottom:20px;margin-top: -69px;z-index:1;">    
        <div class="container clearleft" style="padding-left:0px;padding-right:0px;">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearleft">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft clearright" style="margin-top: 20px;font-size:0.7em;margin-bottom: 10px;padding-left:0px;padding-right:0px;">
                        <h2 class="m0 fsize-9">Hari Belanja Online Nasional (HARBOLNAS)</h2>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft clearright" style="text-align: justify;font-size:0.7em;padding-left:0px;padding-right:0px;">
                        Hari belanja online nasional atau sering disebut harbolnas merupakan acara yang setiap tahun diadakan oleh pelaku industri online guna mendukung pertumbuhan pasar Indonesia secara digital. Acara yang diadakan pertama kali pada tahun 2012 ini, sangat menarik bagi pelanggan yang terbiasa belanja online. Sejak acara harbolnas pada tahun 2012 dan diikuti tahun 2013, 2014, 2015, 2016, 2017 bisa dikatakan sukses. Dengan diikuti oleh berbagai marketplace, ecommerce, online travel agency, dan lainnya, berhasil mengambil hati masyarakat. Oleh karena itu, harbolnas merupakan hari yang paling ditunggu-tunggu oleh pecinta belanja online. Mari sambut harbolnas 2018 ini dengan semangat belanja.
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft clearright" style="margin-top: 20px;font-size:0.7em;margin-bottom: 10px;padding-left:0px;padding-right:0px;">
                       <h2 class="m0 fsize-9">Ayo Meriahkan Pesta Diskon Harbolnas</h2>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft clearright" style="text-align: justify;font-size:0.7em;padding-left:0px;padding-right:0px;">
                        Sudah tahu kan acaranya harbolnas kapan? Ya, acara harbolnas selalu diadakan pada tanggal 11 November atau disebut “harbolnas 11-11” dan tanggal 12 Desember ata di sebut “harbolnas 12-12” setiap tahunnya. Biasanya, orang-orang yang hobi beli online pasti menantikan momen tersebut. Setiap tanggal 11-11 dan 12-12 mengecek ada promo diskon besar-besaran apa saja di beberapa ecommerce, marketplace, online travel, atau lainnya. Apalagi yang suka dengan jam tangan, pasti menanti promo diskon jam tangan pria dan wanita branded original dari The Watch Co. karena The Watch Co selalu ikut berpartisipasi dalam acara harbolnas. Untuk mendapatkan info promonya, bisa kunjungi thewatch.co
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearleft">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft clearright" style="margin-top: 20px;font-size:0.7em;margin-bottom: 10px;padding-left:0px;padding-right:0px;">
                        <h2 class="m0 fsize-9">Beli Jam Tangan Original Di Harbolnas</h2>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft clearright" style="text-align: justify;font-size:0.7em;padding-left:0px;padding-right:0px;">
                        Sudah saatnya tampil makin kece dengan menggunakan aksesoris berupa jam tangan. Kenapa harus jam tangan? Karena jam tangan bisa di pakai untuk pria maupun wanita, tapi tergantung koleksinya yaitu bisa pilih jam tangan pria atau jam tangan wanita.Di harbolnas ini, kamu bisa mendapatkan harga jam tangan branded original dengan harga yang sangat murah, karena adanya promo diskon besar-besaran. Kapan lagi bisa punya jam tangan branded original dengan dengan harga murah? Cuma di kesempatan acara harbolnas inilah harganya bisa dapat lebih murah. Buat yang sangat menginginkan jam tangan branded original di harbolnas ini, tersedia ciicilan dengan bunga 0%. 
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft clearright" style="margin-top: 20px;font-size:0.7em;margin-bottom: 10px;padding-left:0px;padding-right:0px;">
                        <h2 class="m0 fsize-9">Diskon Besar-besaran di The Watch Co.</h2>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft clearright" style="text-align: justify;font-size:0.7em;padding-left:0px;padding-right:0px;">
                        Saatnya memanfaatkan momen spesial ini untuk mendapatkan harga jam tangan pria dan wainta branded original murah di The Watch Co. Selain mendapatkan harga murah, The Watch Co. memberikan ongkos kirim + asuransi pengiriman gratis, cicilan dengan bunga 0%, dan garansi baterai seumur hidup. Artinya suatu hari jam tangannya mati, bisa langsung dibawa ke service center untuk penggantian baterainya secara gratis. Beli jam tangan di mana lagi yang bisa memberikan after sales nya seperti di The Watch Co.? Ayo manfaatkan kesempatan acara harbolnas tahun ini untuk mendapatkan jam tangan faovritmu sekarang! 
                    </div>
                </div>
        </div>
    </div>
    
    <div class="hidden-lg hidden-md hidden-sm col-xs-12" id="readmore" style="padding-top: 11px; padding-bottom: 1px; text-align: justify;">
                        <p class="show-read-more">
                            </p><p class="seodesc"><strong>Hari Belanja Online Nasional (HARBOLNAS)</strong></p>

<p class="seodesc">Hari belanja online nasional atau sering disebut harbolnas merupakan acara yang setiap tahun diadakan oleh pelaku industri online guna mendukung pertumbuhan pasar Indonesia secara digital...<br><br><a>(Baca Selengkapnya)</a>                        </p>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm col-xs-12" id="left" style="padding-top: 11px; padding-bottom: 1px; text-align: justify; display: none;">
                        <p class="show-read-more">
                            </p><p class="seodesc"><strong>Hari Belanja Online Nasional (HARBOLNAS)</strong></p><br>

<p class="seodesc">Hari belanja online nasional atau sering disebut harbolnas merupakan acara yang setiap tahun diadakan oleh pelaku industri online guna mendukung pertumbuhan pasar Indonesia secara digital. Acara yang diadakan pertama kali pada tahun 2012 ini, sangat menarik bagi pelanggan yang terbiasa belanja online. Sejak acara harbolnas pada tahun 2012 dan diikuti tahun 2013, 2014, 2015, 2016, 2017 bisa dikatakan sukses. Dengan diikuti oleh berbagai marketplace, ecommerce, online travel agency, dan lainnya, berhasil mengambil hati masyarakat. Oleh karena itu, harbolnas merupakan hari yang paling ditunggu-tunggu oleh pecinta belanja online. Mari sambut harbolnas 2018 ini dengan semangat belanja.</p><br>

<p class="seodesc"><strong>Ayo Meriahkan Pesta Diskon Harbolnas</strong></p><br>

<p class="seodesc">Sudah tahu kan acaranya harbolnas kapan? Ya, acara harbolnas selalu diadakan pada tanggal 11 November atau disebut “harbolnas 11-11” dan tanggal 12 Desember ata di sebut “harbolnas 12-12” setiap tahunnya. Biasanya, orang-orang yang hobi beli online pasti menantikan momen tersebut. Setiap tanggal 11-11 dan 12-12 mengecek ada promo diskon besar-besaran apa saja di beberapa ecommerce, marketplace, online travel, atau lainnya. Apalagi yang suka dengan jam tangan, pasti menanti promo diskon jam tangan pria dan wanita branded original dari The Watch Co. karena The Watch Co selalu ikut berpartisipasi dalam acara harbolnas. Untuk mendapatkan info promonya, bisa kunjungi thewatch.co</p><br>
                        <p></p>
                        <p class="seodesc"><strong>Beli Jam Tangan Original Di Harbolnas</strong></p><br>

<p class="seodesc">Sudah saatnya tampil makin kece dengan menggunakan aksesoris berupa jam tangan. Kenapa harus jam tangan? Karena jam tangan bisa di pakai untuk pria maupun wanita, tapi tergantung koleksinya yaitu bisa pilih jam tangan pria atau jam tangan wanita.Di harbolnas ini, kamu bisa mendapatkan harga jam tangan branded original dengan harga yang sangat murah, karena adanya promo diskon besar-besaran. Kapan lagi bisa punya jam tangan branded original dengan dengan harga murah? Cuma di kesempatan acara harbolnas inilah harganya bisa dapat lebih murah. Buat yang sangat menginginkan jam tangan branded original di harbolnas ini, tersedia ciicilan dengan bunga 0%.</p><br>
                        <p></p>
                        <p class="seodesc"><strong>Diskon Besar-besaran di The Watch Co.</strong></p><br>

<p class="seodesc">Saatnya memanfaatkan momen spesial ini untuk mendapatkan harga jam tangan pria dan wainta branded original murah di The Watch Co. Selain mendapatkan harga murah, The Watch Co. memberikan ongkos kirim + asuransi pengiriman gratis, cicilan dengan bunga 0%, dan garansi baterai seumur hidup. Artinya suatu hari jam tangannya mati, bisa langsung dibawa ke service center untuk penggantian baterainya secara gratis. Beli jam tangan di mana lagi yang bisa memberikan after sales nya seperti di The Watch Co.? Ayo manfaatkan kesempatan acara harbolnas tahun ini untuk mendapatkan jam tangan faovritmu sekarang!</p><br>
                        <p></p>
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