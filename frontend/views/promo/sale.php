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
<section class="ptop1" style="padding-bottom:5px;">
    <div class="container">
        <div class="row">
           
            <?php 
                $current_date = date('Y-m-d H:i:s');
                $now = $current_date;
    // 			if($_SESSION['customerInfo']['customer_id'] == 7614){
    // 				$current_date = '2018-11-10 00:00:00';
    // 			}
                if($current_date >= '2018-12-07 00:00:00' && $current_date <= '2018-12-31 23:59:59'){
            ?>
            <section id="category" class="p0">
                <div class="container">
                     <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright">
                            <?php //if($_SESSION['customerInfo']['customer_id'] == 7614){ ?>
                             <header id="myCarousel" class="carousel slide carousel-fade">
                                   <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        
                                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                            <li data-target="#myCarousel" data-slide-to="1" class="mright0"></li>
                                          
                                    </ol>

                                <!-- Wrapper for Slides -->
                                <!--<div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1 carousel-inner clearleft clearright">-->
                                <div class="carousel-inner clearleft clearright">
                                       
                                        <div class="item active">
                                            <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/endsale/2018/homebanner-desktop-01-01.jpg?auto=compress%2Cformat&fm=pjpg" class="img-responsive hidden-xs">
                                            <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/endsale/2018/homebanner-mobile-02.jpg" class="img-responsive hidden-lg hidden-md hidden-sm">  
                                        </div>
                                        <div class="item">
                                            <img src="<?php echo Yii::$app->params['imgixUrl'] ?>homebanner/20180924_736db3016245172b274b2ae18857160d.jpg?auto=compress%2Cformat&fm=pjpg" class="img-responsive hidden-xs">
                                            <img src="<?php echo Yii::$app->params['imgixUrl'] ?>homebanner/20180924_e80a2f3c487de95503c47a6f61230845m.jpg" class="img-responsive hidden-lg hidden-md hidden-sm">   
                                        </div>
                            			
                                </div>
                            	
                            	
                                
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                    <img class="carousel-control-homeban mleft50" src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/icons/prev_slide_gold.png" width="40" style="margin-top:200px;">
                                </a>
                                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                    <img class="carousel-control-homeban mright50" src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/icons/next_slide_gold.png" width="40" style="margin-top:200px;">
                                </a>
                            </header>

                            <?php //} ?>
                        </div>
                         
            		</div>
            	</div>
            </section>
			
			<section id="category" class="p0">
                <div class="container">
                     <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shop-title caption blue-bg-red">PROMO SPESIAL</div>
                        <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearleft clearright clearleft-mobile clearright-mobile">
                            <div class="col-lg-3 col-md-3 col-sm-3 pright5p clearleft clearleft-mobile">
                                <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/endyear-sale?type=115">
                                    <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/endsale/2018/Category-Casual-Banner-Desktop.jpg" class="img-responsive">
                                </a>
                                
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pright5p pleft5p">
                                <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/endyear-sale?type=116">
                                    <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/endsale/2018/Category-Aktif-Banner-Desktop.jpg" class="img-responsive">
                                </a>
                                
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pright5p pleft5p">
                                <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/endyear-sale?type=117">
                                    <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/endsale/2018/Category-Aksesoris-Banner-Desktop.jpg" class="img-responsive">
                                </a>
                                
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pleft5p clearright clearright-mobile">
                                <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/endyear-sale?type=12">
                                    <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/endsale/2018/Category-Klasik-Banner-Desktop.jpg" class="img-responsive">
                                </a>
                                
                            </div>
                        </div>
                        <div class="hidden-lg hidden-md hidden-sm col-xs-12">
                            <div class="col-xs-12 clearleft clearleft-mobile clearright clearright-mobile">
                                <div class="col-xs-6 pright5p clearleft clearleft-mobile">
                                    <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/endyear-sale?type=115">
                                        <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/endsale/2018/Main-Category-Banner-Casual-Mobile.jpg" class="img-responsive">
                                    </a>
                                    
                                </div>
                                <div class="col-xs-6 pleft5p clearright clearright-mobile">
                                    <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/endyear-sale?type=116">
                                        <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/endsale/2018/Main-Category-Banner-Aktif-Mobile.jpg" class="img-responsive">
                                    </a>
                                    
                                </div>
                            </div>
                            <div class="col-xs-12 clearleft clearleft-mobile clearright clearright-mobile ptop15">
                                <div class="col-xs-6 pright5p clearleft clearleft-mobile">
                                    <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/endyear-sale?type=117">
                                        <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/endsale/2018/Main-Category-Banner-Aksesoris-Mobile.jpg" class="img-responsive">
                                    </a>
                                    
                                </div>
                                <div class="col-xs-6 pleft5p clearright clearright-mobile">
                                    <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/endyear-sale?type=12">
                                        <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/endsale/2018/Main-Category-Banner-Klasik-Mobile.jpg" class="img-responsive">
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
                                    <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1111/casual_parent_desktop.PNG" class="img-responsive">
                                </a>
                                
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pright5p pleft5p">
                                <a>
                                    <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1111/aktif_parent_desktop.PNG" class="img-responsive">
                                </a>
                                
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pright5p pleft5p">
                                <a>
                                    <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1111/aksesoris_parent_desktop.PNG" class="img-responsive">
                                </a>
                                
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pleft5p clearright clearright-mobile">
                                <a>
                                    <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1111/classic_parent_desktop.PNG" class="img-responsive">
                                </a>
                                
                            </div>
                        </div>       
                     </div>
                 </div>
                        
            </section>

            <section id="featured-brands" class="p0">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shop-title caption blue-bg-red">KATEGORI</div>
            </section>
            
            <?php if (count($casual) > 0) { ?>
            <section id="featured-brands" class="p0">
                <div class="container">
                     <div class="row">
                         
            			<div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearleft clearright">
            				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/endsale/2018/Main-Category-Casual-Header-Desktop.jpg" class="img-responsive">
            			</div>
            			<div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft clearright">
            				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/endsale/2018/Main-Category-Header-Casual-Mobile.jpg" class="img-responsive">
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
        							 <!--   <div class="tag" style="right: 0; left: 15px; top: 15px;">-->
        								<!--	<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">-->
        								<!--</div>-->
        								<div class="tag">
                                            <?php
                                            $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->all();
                                            if ($spesificPriceAll != null) {
                                              foreach ($spesificPriceAll as $specificPrice) {
                                                ?>
                                                  <?php
                                                      if ($specificPrice->from <= $now && $specificPrice->to > $now) {
                                                          ?>
                                                          <div class='pull-right'>
                                                              <div class='<?php echo $specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                                  <span class='text-discount' style=''>
                                                                      <?php
                                                                      // if custom value label
                                                                        if($specificPrice->label_type == "custom_value"){
                                                                          echo $specificPrice->label;
                                                                        } else {
                                                                          if ($specificPrice->reduction_type == 'amount') {
                                                                            echo floor($specificPrice->reduction / $product->price * 100);
                                                                          } else {
                                                                            echo $specificPrice->reduction;
                                                                          }
                                                                          echo '%';
                                                                        }
                                                                      ?>
                                                                  </span>
                                                              </div>
                                                          </div>
                                                          <?php
                                                      }
                                            
                                                  ?>
                                                <?php
                                              }
                                            }
    
                                            ?>
                                              
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
                            <?php if (count($casual) > 3) { ?>
                            <div class="col-sm-2 col-lg-2 col-md-2 space-product hidden-xs mbottom-3-mobile pleft75 clearright clearright-mobile" style="width:20%;">
                                <div class="col-lg-12 clearleft clearright clearleft-mobile clearright-mobile bgcolorprimary bradius5 width100 lebih-lanjut-block" style="display:table;">
                                    <div class="gotham-light lebih-lanjut">
                                        <a class="border fcolorfff" target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/endyear-sale?type=115">Lebih Lanjut</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            
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
                							 <!--   <div class="tag" style="right: 0; left: 15px; top: 15px;">-->
                								<!--	<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">-->
                								<!--</div>-->
                								<div class="tag">
                                                    <?php
                                                    $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->all();
                                                    if ($spesificPriceAll != null) {
                                                      foreach ($spesificPriceAll as $specificPrice) {
                                                        ?>
                                                          <?php
                                                              if ($specificPrice->from <= $now && $specificPrice->to > $now) {
                                                                  ?>
                                                                  <div class='pull-right'>
                                                                      <div class='<?php echo $specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                                          <span class='text-discount' style=''>
                                                                              <?php
                                                                              // if custom value label
                                                                                if($specificPrice->label_type == "custom_value"){
                                                                                  echo $specificPrice->label;
                                                                                } else {
                                                                                  if ($specificPrice->reduction_type == 'amount') {
                                                                                    echo floor($specificPrice->reduction / $product->price * 100);
                                                                                  } else {
                                                                                    echo $specificPrice->reduction;
                                                                                  }
                                                                                  echo '%';
                                                                                }
                                                                              ?>
                                                                          </span>
                                                                      </div>
                                                                  </div>
                                                                  <?php
                                                              }
                                                    
                                                          ?>
                                                        <?php
                                                      }
                                                    }
            
                                                    ?>
                                                      
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
                                                <a class="border fcolorfff" target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/endyear-sale?type=115">Lebih Lanjut</a>
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
            <?php } ?>
            
            <section id="featured-brands" class="p0 mbottom50">
            </section>
            
            <?php if (count($aktif) > 0) { ?>
            <section id="featured-brands" class="p0">
                <div class="container">
                     <div class="row">
            			<div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearleft clearright">
            				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/endsale/2018/Main-Category-Aktif-Header-Desktop.jpg" class="img-responsive">
            			</div>
            			<div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft clearright">
            				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/endsale/2018/Main-Category-Header-Aktif-Mobile.jpg" class="img-responsive">
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
        							 <!--   <div class="tag" style="right: 0; left: 15px; top: 15px;">-->
        								<!--	<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">-->
        								<!--</div>-->
        								<div class="tag">
                                            <?php
                                            $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->all();
                                            if ($spesificPriceAll != null) {
                                              foreach ($spesificPriceAll as $specificPrice) {
                                                ?>
                                                  <?php
                                                      if ($specificPrice->from <= $now && $specificPrice->to > $now) {
                                                          ?>
                                                          <div class='pull-right'>
                                                              <div class='<?php echo $specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                                  <span class='text-discount' style=''>
                                                                      <?php
                                                                      // if custom value label
                                                                        if($specificPrice->label_type == "custom_value"){
                                                                          echo $specificPrice->label;
                                                                        } else {
                                                                          if ($specificPrice->reduction_type == 'amount') {
                                                                            echo floor($specificPrice->reduction / $product->price * 100);
                                                                          } else {
                                                                            echo $specificPrice->reduction;
                                                                          }
                                                                          echo '%';
                                                                        }
                                                                      ?>
                                                                  </span>
                                                              </div>
                                                          </div>
                                                          <?php
                                                      }
                                            
                                                  ?>
                                                <?php
                                              }
                                            }
    
                                            ?>
                                              
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
                            
                            <?php if (count($aktif) > 3) { ?>
                            <div class="col-sm-2 col-lg-2 col-md-2 space-product hidden-xs mbottom-3-mobile pleft75 clearright clearright-mobile" style="width:20%;">
                                <div class="col-lg-12 clearleft clearright clearleft-mobile clearright-mobile bgcolorprimary bradius5 width100 lebih-lanjut-block" style="display:table;">
                                    <div class="gotham-light lebih-lanjut">
                                        <a class="border fcolorfff" target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/endyear-sale?type=116">Lebih Lanjut</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            
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
                							 <!--   <div class="tag" style="right: 0; left: 15px; top: 15px;">-->
                								<!--	<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">-->
                								<!--</div>-->
                								
                								<div class="tag">
                                                    <?php
                                                    $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->all();
                                                    if ($spesificPriceAll != null) {
                                                      foreach ($spesificPriceAll as $specificPrice) {
                                                        ?>
                                                          <?php
                                                              if ($specificPrice->from <= $now && $specificPrice->to > $now) {
                                                                  ?>
                                                                  <div class='pull-right'>
                                                                      <div class='<?php echo $specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                                          <span class='text-discount' style=''>
                                                                              <?php
                                                                              // if custom value label
                                                                                if($specificPrice->label_type == "custom_value"){
                                                                                  echo $specificPrice->label;
                                                                                } else {
                                                                                  if ($specificPrice->reduction_type == 'amount') {
                                                                                    echo floor($specificPrice->reduction / $product->price * 100);
                                                                                  } else {
                                                                                    echo $specificPrice->reduction;
                                                                                  }
                                                                                  echo '%';
                                                                                }
                                                                              ?>
                                                                          </span>
                                                                      </div>
                                                                  </div>
                                                                  <?php
                                                              }
                                                    
                                                          ?>
                                                        <?php
                                                      }
                                                    }
            
                                                    ?>
                                                      
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
                                                <a class="border fcolorfff" target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/endyear-sale?type=116">Lebih Lanjut</a>
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
            <?php } ?>
            
            <section id="featured-brands" class="p0 mbottom50">
            </section>
            
            <?php if (count($aksesoris) > 0) { ?>
            <section id="featured-brands" class="p0">
                <div class="container">
                     <div class="row">
            			<div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearleft clearright">
            				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/endsale/2018/Main-Category-Aksesoris-Header-Desktop.jpg" class="img-responsive">
            			</div>
            			<div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft clearright">
            				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/endsale/2018/Main-Category-Header-Aksesoris-Mobile.jpg" class="img-responsive">
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
        							 <!--   <div class="tag" style="right: 0; left: 15px; top: 15px;">-->
        								<!--	<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">-->
        								<!--</div>-->
        								
        								<div class="tag">
                                            <?php
                                            $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->all();
                                            if ($spesificPriceAll != null) {
                                              foreach ($spesificPriceAll as $specificPrice) {
                                                ?>
                                                  <?php
                                                      if ($specificPrice->from <= $now && $specificPrice->to > $now) {
                                                          ?>
                                                          <div class='pull-right'>
                                                              <div class='<?php echo $specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                                  <span class='text-discount' style=''>
                                                                      <?php
                                                                      // if custom value label
                                                                        if($specificPrice->label_type == "custom_value"){
                                                                          echo $specificPrice->label;
                                                                        } else {
                                                                          if ($specificPrice->reduction_type == 'amount') {
                                                                            echo floor($specificPrice->reduction / $product->price * 100);
                                                                          } else {
                                                                            echo $specificPrice->reduction;
                                                                          }
                                                                          echo '%';
                                                                        }
                                                                      ?>
                                                                  </span>
                                                              </div>
                                                          </div>
                                                          <?php
                                                      }
                                            
                                                  ?>
                                                <?php
                                              }
                                            }
    
                                            ?>
                                              
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
                            <?php if (count($aksesoris) > 3) { ?>
                            <div class="col-sm-2 col-lg-2 col-md-2 space-product hidden-xs mbottom-3-mobile pleft75 clearright clearright-mobile" style="width:20%;">
                                <div class="col-lg-12 clearleft clearright clearleft-mobile clearright-mobile bgcolorprimary bradius5 width100 lebih-lanjut-block" style="display:table;">
                                    <div class="gotham-light lebih-lanjut">
                                        <a class="border fcolorfff" target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/endyear-sale?type=117">Lebih Lanjut</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            
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
                							 <!--   <div class="tag" style="right: 0; left: 15px; top: 15px;">-->
                								<!--	<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">-->
                								<!--</div>-->
                								
                								<div class="tag">
                                                    <?php
                                                    $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->all();
                                                    if ($spesificPriceAll != null) {
                                                      foreach ($spesificPriceAll as $specificPrice) {
                                                        ?>
                                                          <?php
                                                              if ($specificPrice->from <= $now && $specificPrice->to > $now) {
                                                                  ?>
                                                                  <div class='pull-right'>
                                                                      <div class='<?php echo $specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                                          <span class='text-discount' style=''>
                                                                              <?php
                                                                              // if custom value label
                                                                                if($specificPrice->label_type == "custom_value"){
                                                                                  echo $specificPrice->label;
                                                                                } else {
                                                                                  if ($specificPrice->reduction_type == 'amount') {
                                                                                    echo floor($specificPrice->reduction / $product->price * 100);
                                                                                  } else {
                                                                                    echo $specificPrice->reduction;
                                                                                  }
                                                                                  echo '%';
                                                                                }
                                                                              ?>
                                                                          </span>
                                                                      </div>
                                                                  </div>
                                                                  <?php
                                                              }
                                                    
                                                          ?>
                                                        <?php
                                                      }
                                                    }
            
                                                    ?>
                                                      
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
                                                <a class="border fcolorfff" target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/endyear-sale?type=117">Lebih Lanjut</a>
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
            <?php } ?>
            
            <section id="featured-brands" class="p0 mbottom50">
            </section>
            
            <?php if (count($classic) > 0) { ?>
            <section id="featured-brands" class="p0">
                <div class="container">
                     <div class="row">
                         
            			<div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearleft clearright">
            				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/endsale/2018/Main-Category-Klasik-Header-Desktop.jpg" class="img-responsive">
            			</div>
            			<div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft clearright">
            				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/endsale/2018/Main-Category-Header-Klasik-Mobile.jpg" class="img-responsive">
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
        							 <!--   <div class="tag" style="right: 0; left: 15px; top: 15px;">-->
        								<!--	<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">-->
        								<!--</div>-->
        								
        								<div class="tag">
                                            <?php
                                            $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->all();
                                            if ($spesificPriceAll != null) {
                                              foreach ($spesificPriceAll as $specificPrice) {
                                                ?>
                                                  <?php
                                                      if ($specificPrice->from <= $now && $specificPrice->to > $now) {
                                                          ?>
                                                          <div class='pull-right'>
                                                              <div class='<?php echo $specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                                  <span class='text-discount' style=''>
                                                                      <?php
                                                                      // if custom value label
                                                                        if($specificPrice->label_type == "custom_value"){
                                                                          echo $specificPrice->label;
                                                                        } else {
                                                                          if ($specificPrice->reduction_type == 'amount') {
                                                                            echo floor($specificPrice->reduction / $product->price * 100);
                                                                          } else {
                                                                            echo $specificPrice->reduction;
                                                                          }
                                                                          echo '%';
                                                                        }
                                                                      ?>
                                                                  </span>
                                                              </div>
                                                          </div>
                                                          <?php
                                                      }
                                            
                                                  ?>
                                                <?php
                                              }
                                            }
    
                                            ?>
                                              
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
                            
                            <?php if (count($classic) > 3) { ?>
                            <div class="col-sm-2 col-lg-2 col-md-2 space-product hidden-xs mbottom-3-mobile pleft75 clearright clearright-mobile" style="width:20%;">
                                <div class="col-lg-12 clearleft clearright clearleft-mobile clearright-mobile bgcolorprimary bradius5 width100 lebih-lanjut-block" style="display:table;">
                                    <div class="gotham-light lebih-lanjut">
                                        <a class="border fcolorfff" target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/endyear-sale?type=12">Lebih Lanjut</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            
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
                							 <!--   <div class="tag" style="right: 0; left: 15px; top: 15px;">-->
                								<!--	<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">-->
                								<!--</div>-->
                								
                								<div class="tag">
                                                    <?php
                                                    $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->all();
                                                    if ($spesificPriceAll != null) {
                                                      foreach ($spesificPriceAll as $specificPrice) {
                                                        ?>
                                                          <?php
                                                              if ($specificPrice->from <= $now && $specificPrice->to > $now) {
                                                                  ?>
                                                                  <div class='pull-right'>
                                                                      <div class='<?php echo $specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                                          <span class='text-discount' style=''>
                                                                              <?php
                                                                              // if custom value label
                                                                                if($specificPrice->label_type == "custom_value"){
                                                                                  echo $specificPrice->label;
                                                                                } else {
                                                                                  if ($specificPrice->reduction_type == 'amount') {
                                                                                    echo floor($specificPrice->reduction / $product->price * 100);
                                                                                  } else {
                                                                                    echo $specificPrice->reduction;
                                                                                  }
                                                                                  echo '%';
                                                                                }
                                                                              ?>
                                                                          </span>
                                                                      </div>
                                                                  </div>
                                                                  <?php
                                                              }
                                                    
                                                          ?>
                                                        <?php
                                                      }
                                                    }
            
                                                    ?>
                                                      
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
                                                <a class="border fcolorfff" target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/endyear-sale?type=12">Lebih Lanjut</a>
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
            <?php } ?>
            
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
        							 <!--   <div class="tag" style="right: 0; left: 15px; top: 15px;">-->
        								<!--	<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">-->
        								<!--</div>-->
        								
        								<div class="tag">
                                            <?php
                                            $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->all();
                                            if ($spesificPriceAll != null) {
                                              foreach ($spesificPriceAll as $specificPrice) {
                                                ?>
                                                  <?php
                                                      if ($specificPrice->from <= $now && $specificPrice->to > $now) {
                                                          ?>
                                                          <div class='pull-right'>
                                                              <div class='<?php echo $specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                                  <span class='text-discount' style=''>
                                                                      <?php
                                                                      // if custom value label
                                                                        if($specificPrice->label_type == "custom_value"){
                                                                          echo $specificPrice->label;
                                                                        } else {
                                                                          if ($specificPrice->reduction_type == 'amount') {
                                                                            echo floor($specificPrice->reduction / $product->price * 100);
                                                                          } else {
                                                                            echo $specificPrice->reduction;
                                                                          }
                                                                          echo '%';
                                                                        }
                                                                      ?>
                                                                  </span>
                                                              </div>
                                                          </div>
                                                          <?php
                                                      }
                                            
                                                  ?>
                                                <?php
                                              }
                                            }
    
                                            ?>
                                              
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
        							 <!--   <div class="tag" style="right: 0; left: 15px; top: 15px;">-->
        								<!--	<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">-->
        								<!--</div>-->
        								
        								<div class="tag">
                                            <?php
                                            $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->all();
                                            if ($spesificPriceAll != null) {
                                              foreach ($spesificPriceAll as $specificPrice) {
                                                ?>
                                                  <?php
                                                      if ($specificPrice->from <= $now && $specificPrice->to > $now) {
                                                          ?>
                                                          <div class='pull-right'>
                                                              <div class='<?php echo $specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                                  <span class='text-discount' style=''>
                                                                      <?php
                                                                      // if custom value label
                                                                        if($specificPrice->label_type == "custom_value"){
                                                                          echo $specificPrice->label;
                                                                        } else {
                                                                          if ($specificPrice->reduction_type == 'amount') {
                                                                            echo floor($specificPrice->reduction / $product->price * 100);
                                                                          } else {
                                                                            echo $specificPrice->reduction;
                                                                          }
                                                                          echo '%';
                                                                        }
                                                                      ?>
                                                                  </span>
                                                              </div>
                                                          </div>
                                                          <?php
                                                      }
                                            
                                                  ?>
                                                <?php
                                              }
                                            }
    
                                            ?>
                                              
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
            			    <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/endyear-sale" class="blue-round default">Lainnya</a>
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
<!--SEO Pages-->
<section style=" padding: 0px 0;z-index;1;padding-top:90px;">
    <div class="col-lg-12 col-md-12 col-sm-12" style="background-color: #fff;z-index: 1;
    margin-top: -70px;">    
        <div class="container clearleft">
                                <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs clearleft" style="padding-top: 30px; padding-bottom: 30px; text-align: justify;">
                        
                            <p class="seodesc"><strong>Diskon Jam Tangan Original&nbsp;</strong></p>

<p class="seodesc">Untuk menggunakan jam tangan original kini tidak lagi harus mahal, karena kami menawarkan banyak sekali program promo dan juga program cicilan untuk jam tangan branded. Diskon jam tangan branded akan selalu kami berikan di setiap bulannya sehingga kamu akan bangga menggunakan jam tangan original favoritmu tanpa takut menguras dompet. Jual jam tangan original online, mulai dari jam tangan original Daniel Wellington, Olivia Burton, Timex, Tsovet, Hypergrand, dan Aark Collective akan tersedia dengan harga murah di The Watch Co.&nbsp;</p>

<p class="seodesc"><strong>Promo Jam Tangan Wanita Murah</strong></p>

<p class="seodesc">Jam tangan branded merupakan salah satu aksesoris fashion yang penting bagi wanita. Bagi para wanita yang mau membeli jam tangan branded murah, tersedia program promo untuk jam tangan wanita branded seperti Daniel Wellington, Olivia Burton, Aark Collective, Timex, dan lain-lain. Diskon bagi jam tangan branded tersebut akan selalu tersedia sepanjang tahun di The Watch Co. Jadi bagi para wanita yang ingin menggunakan jam tangan original dengan harga murah, bisa mengunjunggi store The Watch Co. atau website www.thewatch.co untuk beli jam tangan online.</p>
                       
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs" style="padding-top: 30px; padding-bottom: 30px; text-align: justify;">
                            
                                <p class="seodesc"><strong>Promo Jam Tangan Pria Murah</strong></p>

<p class="seodesc">Jam tangan original merupakan satu-satunya perhiasan yang dikenakan oleh pria. Maka dari itu, akan semankin bangga jika menggunakan jam tangan original. Tapi, kamu jangan khawatir dengan harga yang mahal, karena The Watch Co. mempunyai program promo sehingga kamu bisa memiliki jam tangan branded seperti Timex, Daniel Wellington, Hypergrand, Aark Collective, William L, dan lain-lain dengan harga murah. Jadi tunggu apa lagi, segera beli jam tangan original murah di store The Watch Co. dan juga website www.thewatch.co untuk beli jam tangan secara online.</p>

<p class="seodesc"><strong>Penawaran Promo Aksesoris Murah&nbsp;</strong></p>

<p class="seodesc">Selain jam tangan original, The Watch Co juga menjual beberapa aksesoris branded original seperti Eastpak, Rains Journal, Y Studio, Cereal Magz, Hypebeast, Kinfolk, Orbit Key, dan lain-lain. Berbagai macam aksesoris branded origianal tersebut tersedia dengan harga murah karena kami mempunyai program diskon bagi aksesoris branded tersebut. Jadi, kamu bisa bergaya dengan aksesoris original branded tersebut tanpa harus menguras dompet. Ayo beli aksesoris branded origianl dengan harga murah di store The Watch Co. atau di website www.thewatch.co untuk beli jam tangan secara online.</p>
                            
                    </div>
                    <!--mobile version-->
                    <div class="hidden-lg hidden-md hidden-sm" id="readmore" style="padding-top: 11px; padding-bottom: 1px; text-align: justify;">
                        <p class="show-read-more">
                            </p><p class="seodesc"><strong>Diskon Jam Tangan Original&nbsp;</strong></p>

<p class="seodesc">Untuk menggunakan jam tangan original kini tidak lagi harus mahal, karena kami menawarkan banyak sekali program promo dan juga program cicilan untuk jam tangan branded...<br><br><a>(Baca Selengkapnya)</a>                        </p>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm" id="left" style="padding-top: 11px; padding-bottom: 1px; text-align: justify; display: none;">
                        <p class="show-read-more">
                            </p><p class="seodesc"><strong>Diskon Jam Tangan Original&nbsp;</strong></p>

<p class="seodesc">Untuk menggunakan jam tangan original kini tidak lagi harus mahal, karena kami menawarkan banyak sekali program promo dan juga program cicilan untuk jam tangan branded. Diskon jam tangan branded akan selalu kami berikan di setiap bulannya sehingga kamu akan bangga menggunakan jam tangan original favoritmu tanpa takut menguras dompet. Jual jam tangan original online, mulai dari jam tangan original Daniel Wellington, Olivia Burton, Timex, Tsovet, Hypergrand, dan Aark Collective akan tersedia dengan harga murah di The Watch Co. &nbsp;</p>

<p class="seodesc"><strong>Promo Jam Tangan Wanita Murah</strong></p>

<p class="seodesc">Jam tangan branded merupakan salah satu aksesoris fashion yang penting bagi wanita. Bagi para wanita yang mau membeli jam tangan branded murah, tersedia program promo untuk jam tangan wanita branded seperti Daniel Wellington, Olivia Burton, Aark Collective, Timex, dan lain-lain. Diskon bagi jam tangan branded tersebut akan selalu tersedia sepanjang tahun di The Watch Co. Jadi bagi para wanita yang ingin menggunakan jam tangan original dengan harga murah, bisa mengunjunggi store The Watch Co. atau website www.thewatch.co untuk beli jam tangan online.</p>
                        <p></p>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm" id="right" style="padding-top: 11px; padding-bottom: 1px; text-align: justify; display: none;">
                        <p class="show-read-more">
                            </p><p class="seodesc"><strong>Promo Jam Tangan Pria Murah</strong></p>

<p class="seodesc">Jam tangan original merupakan satu-satunya perhiasan yang dikenakan oleh pria. Maka dari itu, akan semankin bangga jika menggunakan jam tangan original. Tapi, kamu jangan khawatir dengan harga yang mahal, karena The Watch Co. mempunyai program promo sehingga kamu bisa memiliki jam tangan branded seperti Timex, Daniel Wellington, Hypergrand, Aark Collective, William L, dan lain-lain dengan harga murah. Jadi tunggu apa lagi, segera beli jam tangan original murah di store The Watch Co. dan juga website www.thewatch.co untuk beli jam tangan secara online.</p>

<p class="seodesc"><strong>Penawaran Promo Aksesoris Murah&nbsp;</strong></p>

<p class="seodesc">Selain jam tangan original, The Watch Co juga menjual beberapa aksesoris branded original seperti Eastpak, Rains Journal, Y Studio, Cereal Magz, Hypebeast, Kinfolk, Orbit Key, dan lain-lain. Berbagai macam aksesoris branded origianal tersebut tersedia dengan harga murah karena kami mempunyai program diskon bagi aksesoris branded tersebut. Jadi, kamu bisa bergaya dengan aksesoris original branded tersebut tanpa harus menguras dompet. Ayo beli aksesoris branded origianl dengan harga murah di store The Watch Co. atau di website www.thewatch.co untuk beli jam tangan secara online.</p>

                    </div>
                    </div>
    </div>
</section>

<style>
@media only screen and (max-width : 767px) {
	.mtop3-mobile { margin-top: 3%; }
	.mtop8-em-mobile { margin-top: 8em; }
}
p.seodesc{font-size: 0.7em; line-height: 1.3em; font-family: gotham-light;}
    .show-read-more .more-text{
        display: none;
    }
</style>