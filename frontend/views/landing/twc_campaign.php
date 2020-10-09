<?php
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
        "list": "Landing Page Redefine Time"
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
    
    var width_window = window.innerWidth
|| document.documentElement.clientWidth
|| document.body.clientWidth;
    
    console.log(width_window);
</script>
<style>
    .vertical .carousel-inner {
  height: 100%;
}

.carousel.vertical .item {
  -webkit-transition: 0.6s ease-in-out top;
     -moz-transition: 0.6s ease-in-out top;
      -ms-transition: 0.6s ease-in-out top;
       -o-transition: 0.6s ease-in-out top;
          transition: 0.6s ease-in-out top;
}

.carousel.vertical .active {
  top: 0;
}

.carousel.vertical .next {
  top: 400px;
}

.carousel.vertical .prev {
  top: -400px;
}

.carousel.vertical .next.left,
.carousel.vertical .prev.right {
  top: 0;
}

.carousel.vertical .active.left {
  top: -400px;
}

.carousel.vertical .active.right {
  top: 400px;
}

.carousel.vertical .item {
    left: 0;
}
</style>

<section class="ptop0 section-top" style="position:relative;">  
    <div class="slider-1" id="slider-sl">
      <div class="slide-wheel-1" id="slide-wheel-1">
            <img src="https://thewatch.imgix.net/landing/campaign/desktop/banner_1.jpg?auto=compress%2Cformat&amp;fm=pjpg" class="img-responsive hidden-xs">
            <img src="https://thewatch.imgix.net/landing/campaign/mobile/banner_1.jpg?auto=compress%2Cformat&amp;fm=pjpg" class="img-responsive hidden-lg hidden-sm hidden-md"> 
      </div>
      <div class="slide-wheel-2"  id="slide-wheel-2">
            <img src="https://thewatch.imgix.net/landing/campaign/desktop/banner_2.jpg?auto=compress%2Cformat&amp;fm=pjpg" class="img-responsive hidden-xs">
            <img src="https://thewatch.imgix.net/landing/campaign/mobile/banner_2.jpg?auto=compress%2Cformat&amp;fm=pjpg" class="img-responsive hidden-lg hidden-sm hidden-md"> 
      </div>
      <div class="slide-wheel-3" id="slide-wheel-3">
            <img src="https://thewatch.imgix.net/landing/campaign/desktop/banner_3.jpg?auto=compress%2Cformat&amp;fm=pjpg" class="img-responsive hidden-xs">
            <img src="https://thewatch.imgix.net/landing/campaign/mobile/banner_3.jpg?auto=compress%2Cformat&amp;fm=pjpg" class="img-responsive hidden-lg hidden-sm hidden-md"> 
      </div>
    </div>
    
    <img src="https://thewatch.imgix.net/landing/campaign/desktop/0_banner.png?auto=compress" class="img-responsive hidden-xs" style="position: absolute;margin: auto;z-index:1;left:0;right:0;bottom:0;width: 1170px;">    
    <img src="https://thewatch.imgix.net/landing/campaign/mobile/0_banner.png?auto=compress" class="img-responsive hidden-lg hidden-sm hidden-md" style="position: absolute;margin: auto;z-index:1;left:0;right:0;top:12%;bottom:15px;width: 72%;">
   
</section>
<section class="ptop0" id="section-two">

      <div class="row" style="width:100%;margin:0;">
          <div class="col-lg-12 col-sm-12 col-md-12 hidden-xs clearleft clearright">
            <img src="https://thewatch.imgix.net/landing/campaign/desktop/1.png?auto=compress" class="img-responsive">
          </div>
          <div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft-mobile clearright-mobile" style="padding-bottom:20px;">
            <img src="https://thewatch.imgix.net/landing/campaign/mobile/1.png?auto=compress" class="img-responsive">
          </div>
      </div>

</section>
<section class="ptop0 section-top" style="position:relative;">
	<div class="slider-2" id="slider-sl2">
	  <div class="slide-sl-1" id="slide-sl-1">
			<img src="https://thewatch.imgix.net/landing/campaign/desktop/banner_sub_1.jpg?auto=compress%2Cformat&amp;fm=pjpg" class="img-responsive hidden-xs">
			<img src="https://thewatch.imgix.net/landing/campaign/mobile/banner_sub_1.jpg?auto=compress%2Cformat&amp;fm=pjpg" class="img-responsive hidden-lg hidden-sm hidden-md"> 
	  </div>
	  <div class="slide-sl-2" id="slide-sl-2">
			<img src="https://thewatch.imgix.net/landing/campaign/desktop/banner_sub_2.jpg?auto=compress%2Cformat&amp;fm=pjpg" class="img-responsive hidden-xs">
			<img src="https://thewatch.imgix.net/landing/campaign/mobile/banner_sub_2.jpg?auto=compress%2Cformat&amp;fm=pjpg" class="img-responsive hidden-lg hidden-sm hidden-md"> 
	  </div>
	</div>

</section>
<section class="ptop0">

      <div class="row" style="width:100%;margin:0;">
          <div class="col-lg-12 col-sm-12 col-md-12 hidden-xs clearleft clearright">
            <img src="https://thewatch.imgix.net/landing/campaign/desktop/3.png?auto=compress" class="img-responsive">
          </div>
          <div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft-mobile clearright-mobile" style="padding-bottom:20px;">
            <img src="https://thewatch.imgix.net/landing/campaign/mobile/3.png?auto=compress" class="img-responsive">
          </div>
      </div>

</section>
<style>
    #slideImg {
  margin: 0 auto;
  padding: 10px 20px;
  position: relative;
}

#slideImg ul { list-style: none; }

#slideImg li {
  float: left;
  margin: 0 12px;
}

img { vertical-align: bottom; }

.rotate-prev { position: absolute; }

.slick-dots {
      display: table;
    position: absolute;
    right: 10px;
    margin: auto;
    top: 50%;
  justify-content: center;
  margin: 0;
  padding: 1rem 0;
  list-style-type: none;
}
.slick-dots li {
  margin: 0 0.25rem;
      margin-bottom: 10px;
}
.slick-dots button {
  display: block;
  width: 1rem;
  height: 1rem;
  padding: 0;
  border: solid 1px white;
  border-radius: 100%;
  background-color: transparent;
  text-indent: -9999px;
}
.slick-dots li.slick-active button {
  background-color: white;
}

</style>
<section class="ptop0">
    <div id="slideImg">
        <div class="slideMain">
          <ul class="slide1">
            <li class="hidden-xs"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4a_1_n.png?auto=compress&h=309"/></li>
            <li class="hidden-xs"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_5_compress.gif?auto=compress&h=309" style="height:309px;"/></li>
            <li class="hidden-xs"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4a_2_n.png?auto=compress&h=309"/></li>
            <li class="hidden-xs"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_5_compress.gif?auto=compress&h=309" style="height:309px;"/></li>
            
            <li class="hidden-xs"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4b_1_n.png?auto=compress&h=309"/></li>
            <li class="hidden-xs"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_4_compress.gif?auto=compress&h=309" style="height:309px;"/></li>
            <li class="hidden-xs"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4b_2_n.png?auto=compress&h=309"/></li>
            <li class="hidden-xs"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_4_compress.gif?auto=compress&h=309" style="height:309px;"/></li>
            
            <li class="hidden-xs"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4c_1_n.png?auto=compress&h=309"/></li>
            <li class="hidden-xs"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_1_compress.gif?auto=compress&h=309" style="height:309px;"/></li>
            <li class="hidden-xs"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4c_2_n.png?auto=compress&h=309"/></li>
            <li class="hidden-xs"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_1_compress.gif?auto=compress&h=309" style="height:309px;"/></li>
            
            <li class="hidden-xs"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4d_1_n.png?auto=compress&h=309"/></li>
            <li class="hidden-xs"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_2_compress.gif?auto=compress&h=309" style="height:309px;"/></li>
            <li class="hidden-xs"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4d_2_n.png?auto=compress&h=309"/></li>
            <li class="hidden-xs"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_2_compress.gif?auto=compress&h=309" style="height:309px;"/></li>
            
            <li class="hidden-xs"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4e_1_n.png?auto=compress&h=309"/></li>
            <li class="hidden-xs"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_1_compress.gif?auto=compress&h=309" style="height:309px;"/></li>
            <li class="hidden-xs"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4e_2_n.png?auto=compress&h=309"/></li>
            <li class="hidden-xs"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_1_compress.gif?auto=compress&h=309" style="height:309px;"/></li>
            
            <li class="hidden-xs"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4f_1_n.png?auto=compress&h=309"/></li>
            <li class="hidden-xs"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_3_compress.gif?auto=compress&h=309" style="height:309px;"/></li>
            <li class="hidden-xs"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4f_2_n.png?auto=compress&h=309"/></li>
            <li class="hidden-xs"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_3_compress.gif?auto=compress&h=309" style="height:309px;"/></li>
            
            <li class="hidden-lg hidden-md hidden-sm"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4a_1_n.png?auto=compress&h=92"/></li>
            <li class="hidden-lg hidden-md hidden-sm"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_5_compress.gif?auto=compress&h=309" style="height:92px;"/></li>
            <li class="hidden-lg hidden-md hidden-sm"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4a_2_n.png?auto=compress&h=92"/></li>
            <li class="hidden-lg hidden-md hidden-sm"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_5_compress.gif?auto=compress&h=309" style="height:92px;"/></li>
            
            <li class="hidden-lg hidden-md hidden-sm"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4b_1_n.png?auto=compress&h=92"/></li>
            <li class="hidden-lg hidden-md hidden-sm"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_4_compress.gif?auto=compress&h=309" style="height:92px;"/></li>
            <li class="hidden-lg hidden-md hidden-sm"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4b_2_n.png?auto=compress&h=92"/></li>
            <li class="hidden-lg hidden-md hidden-sm"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_4_compress.gif?auto=compress&h=309" style="height:92px;"/></li>
            
            <li class="hidden-lg hidden-md hidden-sm"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4c_1_n.png?auto=compress&h=92"/></li>
            <li class="hidden-lg hidden-md hidden-sm"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_1_compress.gif?auto=compress&h=309" style="height:92px;"/></li>
            <li class="hidden-lg hidden-md hidden-sm"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4c_2_n.png?auto=compress&h=92"/></li>
            <li class="hidden-lg hidden-md hidden-sm"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_1_compress.gif?auto=compress&h=309" style="height:92px;"/></li>
            
            <li class="hidden-lg hidden-md hidden-sm"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4d_1_n.png?auto=compress&h=92"/></li>
            <li class="hidden-lg hidden-md hidden-sm"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_2_compress.gif?auto=compress&h=309" style="height:92px;"/></li>
            <li class="hidden-lg hidden-md hidden-sm"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4d_2_n.png?auto=compress&h=92"/></li>
            <li class="hidden-lg hidden-md hidden-sm"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_2_compress.gif?auto=compress&h=309" style="height:92px;"/></li>
            
            <li class="hidden-lg hidden-md hidden-sm"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4e_1_n.png?auto=compress&h=92"/></li>
            <li class="hidden-lg hidden-md hidden-sm"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_1_compress.gif?auto=compress&h=309" style="height:92px;"/></li>
            <li class="hidden-lg hidden-md hidden-sm"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4e_2_n.png?auto=compress&h=92"/></li>
            <li class="hidden-lg hidden-md hidden-sm"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_1_compress.gif?auto=compress&h=309" style="height:92px;"/></li>
            
            <li class="hidden-lg hidden-md hidden-sm"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4f_1_n.png?auto=compress&h=92"/></li>
            <li class="hidden-lg hidden-md hidden-sm"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_3_compress.gif?auto=compress&h=309" style="height:92px;"/></li>
            <li class="hidden-lg hidden-md hidden-sm"><img src="https://thewatch.imgix.net/landing/campaign/desktop/4f_2_n.png?auto=compress&h=92"/></li>
            <li class="hidden-lg hidden-md hidden-sm"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/campaign/desktop/TWC_3_compress.gif?auto=compress&h=309" style="height:92px;"/></li>
          </ul>
        </div>
    </div>
    
</section>

<section class="ptop0">

      <div class="row" style="width:100%;margin:0;">
          <div class="col-lg-12 col-sm-12 col-md-12 hidden-xs clearleft clearright">
            <img src="https://thewatch.imgix.net/landing/campaign/desktop/5.png?auto=compress" class="img-responsive" style="padding-left:10%;">
          </div>
          <div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft-mobile clearright-mobile" style="padding-bottom:20px;">
            <img src="https://thewatch.imgix.net/landing/campaign/mobile/5.png?auto=compress" class="img-responsive" style="padding-left:10%;">
          </div>
      </div>

</section>

<section class="ptop0">
    <div class="container">
        <div class="row">
          <div class="col-lg-12 clearleft clearright gotham-medium fsize-24 center talign-center">
                2019 Collection
          </div>
        </div>
    </div>
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
                                        <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg?auto=compress%2Cformat&amp;fm=pjpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive bradius5 <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                        <?php
                                            echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
                                        ?>
                                        <?php
                                        } else {
                                        ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg?auto=compress%2Cformat&amp;fm=pjpg" class="img-responsive bradius5">
        
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
										?>
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
        								<input type="hidden" name="productPrice" value="<?php echo $product->price; ?>">
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
                                        <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg?auto=compress%2Cformat&amp;fm=pjpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive bradius5 <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                        <?php
                                            echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
                                        ?>
                                        <?php
                                        } else {
                                        ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg?auto=compress%2Cformat&amp;fm=pjpg" class="img-responsive bradius5">
        
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
										?>
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
            			    <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/all-redefine-time" class="blue-round default">Lainnya</a>
            			</div>
            			<div class="col-lg-5 col-md-5 col-sm-4 col-xs-3"></div>
                    </div>
                </div>
            </section>
<section>
    
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
		ul.slide1>li>img{
		    height:309px;
		}
		section.section-top{
		    padding-bottom:107px;
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
		ul.slide1>li>img{
		    height:92px;
		}
		section.section-top{
		    padding-bottom:45px;
		}
	}
</style>