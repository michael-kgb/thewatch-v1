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
        "list": "Landing Page Promo Ramadhan"
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
<?php
    $now = date('Y-m-d H:i:s'); 
    $to = date($end_date);
    $flashMicrotime = \common\components\Helpers::getDifferentMicrotime($now, $to);
?>
<script>
   var flashtime = new Date().getTime() + <?php echo $flashMicrotime; ?>;
   </script>
<div class="hidden-lg hidden-xs"></div>
<section class="ptop1" style="padding-top:0px;padding-bottom:0;">
    <!--<div class="container">-->
    <!--    <div class="row">-->
        <div style="position: relative;">
          <a data-toggle="modal" data-target="#flashModal">
            <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/flash/main-banner-ob-desktop-01.jpg?auto=compress%2Cformat&fm=pjpg" class="img-responsive hidden-xs" style="display: block;margin: auto;">
            <img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/flash/main-banner-ob-mobile-01.jpg?auto=compress%2Cformat&fm=pjpg" class="img-responsive hidden-lg hidden-md hidden-sm" style="display: block;margin: auto;">
            <span class='text-flash-sale'>
                <span class="gotham-light flash-sisa">Sisa Waktu</span><br><span class="gotham-medium flash-title">FLASH SALE</span><br>
                    <span id="countdown-product"></span>
                </span>
            </a>
        </div>
            
    <!--    </div>-->
    <!--</div>-->
    
</section>
<section class="ptop1" style="padding-bottom:0;">
    <div class="container">
        <div class="row">
            
        </div>
    </div>
</section>

<section style="padding-top:0;padding-bottom:0;">
    <div class="container">
        <div class="row">
            <section id="breadcrumb">
                

            </section>
            
            <?php
            $current_date = date('Y-m-d H:i:s');
            if($current_date >= $start_date && $current_date <= $end_date){
                // var_dump($count);exit();
            if (count($products) > 0) {
    $now = date("Y-m-d H:i:s");
    ?>
    <section id="all-product">
      <div class="container product-box clearleft" style="padding-top:20px;">

        <div class="row">
          <!-- Filter Desktop -->
          <style type="text/css">
            
            @media only screen and (min-width: 415px) {
              .flashing.col-lg-2{
                width: 20%;
              }
            }
          </style>
        <?php $i = 1; ?>
       <div class="col-lg-12 col-md-12 product-box space-cont-product">
        <?php foreach ($products as $product) { ?>
          <?php if ($i == 1) { ?>
                  <div class="col-lg-12 col-md-12 product-box clearleft clearright clearleft-mobile clearright-mobile">
                      <div class="row">
          <?php } ?>

        <?php if ($i == 6 || $i == 11 ||
                  $i == 16 || $i == 21 || $i == 16 ||
                  $i == 31 || $i == 36 || $i == 41 ||
                  $i == 46 ) { ?>
                <div class="hidden-sm col-lg-12 col-md-12 cont product-box clearleft clearright clearleft-mobile clearright-mobile">
                    <div class="row">
        <?php } ?>
                    <div class="hidden-sm flashing col-lg-2 col-md-3 space-product col-xs-6 <?php echo $i % 2 == 0 ? 'pleft75' : 'pright75'; ?> mbottom-3-mobile">
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
                                                      <div class='<?php echo $specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?><?php echo $specificPrice->label_type === "flash_icon" ? " flash" : ""; ?>'>
                                                          <span class='text-discount' style=''>
                                                              <?php
                                                              // if custom value label
                                                                if($specificPrice->label_type == "custom_value"){
                                                                  echo $specificPrice->label;
                                                                }elseif($specificPrice->label_type == "flash_icon"){

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
                                            if($product->productNewArrival->product_newarrival_start_date <= $now && $product->productNewArrival->product_newarrival_end_date >= $now){
                                        ?>
                                             <div class="tag-bellow tag-bellow2" style='background-color: #4c757b;position: absolute;width: 100%;bottom: 0;top: auto;'>
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
                                <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                <?php
                                    echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
                                ?>
                                <?php
                                } else {
                                ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive">

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
                                $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->all();
                                $discount = 0;
                                $now = date('Y-m-d H:i:s');
                                $check_discount = 0;
                                if ($spesificPriceAll != null) {
                                    ?>
                                    <?php
                                      foreach ($spesificPriceAll as $spesificPrice) {
                                        ?>
                                            <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>
                                              <?php $check_discount = 1; ?>
                                          
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


                                          <?php $check_discount = 0;break; ?>
                                      <?php } ?>
                                        <?php
                                      }
                                    ?>
                                      <?php if($check_discount == 1){ ?>
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
                    if ($i % 5 == 0) {
                        echo '<div class="hidden-xs clearfix"></div>';
                    }

                    if ($i % 2 == 0){
                        echo '<div class="hidden-lg hidden-md hidden-sm clearfix"></div>';
                    }
                    ?>
                    <?php if ($i == 5 || $i == 10 || $i == 15 || $i == 20 ||
                              $i == 25 || $i == 30 || $i == 35 || $i == 40 ||
                              $i == 45 || $i == 50 || $i == 55 || $i == 48 || $i == 52 ||
                              $i == 56 || $i == 60 || $i == 64 || $i == 68 || $i == 72 || $i == 76 || $i == 80 ||
                              $i == 84 || $i == 88 || $i == 92 || $i == 96 ||
                              $i == 100 || $i == 104) { ?>
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
                  $i == 64 || $i == 67 || $i == 70 ||
                  $i == 73 || $i == 76 || $i == 79 ||
                  $i == 82 || $i == 85 || $i == 88 ||
                  $i == 91 || $i == 94 || $i == 97 || $i == 100) { ?>
                <div class="hidden-lg hidden-md hidden-xs col-sm-12 container product-box clearleft">
                    <div class="row">
            <?php } ?>
                    <div class="col-sm-4 <?php echo $i % 2 == 0 ? 'pleft75' : 'pright75'; ?>">
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
                                                      <div class='<?php echo $specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?><?php echo $specificPrice->label_type === "flash_icon" ? " flash" : ""; ?>'>
                                                          <span class='text-discount' style=''>
                                                              <?php
                                                              // if custom value label
                                                                if($specificPrice->label_type == "custom_value"){
                                                                  echo $specificPrice->label;
                                                                }elseif($specificPrice->label_type == "flash_icon"){

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
                                            if($product->productNewArrival->product_newarrival_start_date <= $now && $product->productNewArrival->product_newarrival_end_date >= $now){
                                        ?>
                                             <div class="tag-bellow" style='background-color: #4c757b;position: absolute;width: 100%;bottom: 0;top: auto;'>
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
                                <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                <?php
                                    echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
                                ?>
                                <?php
                                } else {
                                ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive">

                                <?php } ?>
                            </div>
                            <input type="hidden" name="productId" value="<?php echo $product->product_id; ?>">
                            <input type="hidden" name="productName" value="<?php echo $product->productDetail->name; ?>">
                            <input type="hidden" name="productPrice" value="<?php echo $product->price - $discount; ?>">
                            <input type="hidden" name="brandName" value="<?php echo $product->brands->brand_name; ?>">
                            <input type="hidden" name="opt_list" value="<?php echo $breadcrumbs[0] . ' - ' . $breadcrumbs[2]; ?>">
                            <input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
                            <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                            <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                            <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace0-5"><?php echo ucwords($product->productDetail->name); ?></span></div>
                            <?php
                                // if product has discount
                                $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->all();
                                $discount = 0;
                                $now = date('Y-m-d H:i:s');
                                $check_discount = 0;
                                if ($spesificPriceAll != null) {
                                    ?>
                                    <?php
                                      foreach ($spesificPriceAll as $spesificPrice) {
                                        ?>
                                            <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>
                                              <?php $check_discount = 1; ?>
                                          
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


                                          <?php $check_discount = 0;break; ?>
                                      <?php } ?>
                                        <?php
                                      }
                                    ?>
                                      <?php if($check_discount == 1){ ?>
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
                    if ($i % 3 == 0) {
                        echo '<div class="hidden-sm clearfix"></div>';
                    }
                    ?>
                    <?php if ($i == 3 || $i == 6 || $i == 9 || $i == 12 ||
                              $i == 15 || $i == 18 || $i == 21 || $i == 24 ||
                              $i == 27 || $i == 30 || $i == 33 || $i == 36 || $i == 39 ||
                              $i == 42 || $i == 45 || $i == 48 || $i == 51 || $i == 54 ||
                              $i == 57 || $i == 60 || $i == 63 || $i == 66 || $i == 69 ||
                              $i == 72 || $i == 75 || $i == 78 || $i == 81 || $i == 84 ||
                              $i == 87 || $i == 90 || $i == 93 || $i == 96 || $i == 99 ||
                              $i == 102 ) { ?>
                    </div>
                </div>
            <?php } ?>
        <?php $i++; ?>
        <?php } ?>
        </div>
      </div>
    </section>
    <?php //if($count > 4) {  ?>
    <section id="all-product-footer">
        <div class="container product-box">
            <div class="row font-paging">
                <?php
                    if(!isset($_GET['limit'])){
                        $limit = 20;
                        $total_page = ceil($count / $limit);
                    }else{
                        $total_page = ceil($count / $limit);
                    }



                    if(!isset($_GET['page'])){
                        $current = 1;
                    }else{
                        $current = $_GET['page'];
                    }
                 ?>

                 <?php
                     echo Yii::$app->view->renderFile('@app/views/promo/page_number.php', array(
                         "current" => $current,
                         "breadcrumbs" => $breadcrumbs,
                         "total_page" => $total_page,
                         "limit" => $limit,
                         "params"=> $params,
                         "sortby"=> $sortby,

                     ));
                 ?>
            </div>

        </div>
        
        <div class="col-lg-12 col-md-12 col-sm-12 clearleft clearright" style="text-align: center;">
          
        </div>
    </section>
    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icon_top.png" class="scrollup"></a>
          <?php  } ?>

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

<section class="" style="padding-top:88px;"></section>
<!--SEO Pages-->
<section style=" padding: 0px 0;z-index;1;">
    <div class="col-lg-12 col-md-12 col-sm-12" style="background-color: #fff;z-index: 1;
    margin-top: -70px;">  
        <div class="container clearleft">
                                <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs clearleft" style="padding-top: 30px; padding-bottom: 30px; text-align: justify;">
                        
                            <p class="seodesc"><strong>Flash Sale The Watch Co.&nbsp;</strong></p>

<p class="seodesc">Flash sale adalah penjualan suatu produk oleh perusahaan atau toko dalam waktu tertentu. Biasanya waktunya sangat singkat dan terbatas. Di luar negeri, istilah flash sale biasa disebut “deal of the day”. Apapun itu istilahnya, flash sale merupakan promo yang sering dinanti bagi yang hobi belanja.&nbsp;</p>

<p class="seodesc">Di Indonesia, seiring perkembangan e-commerce yang pesat,  flash sale sudah menjadi momen yang paling ditunggu-tunggu oleh banyak orang. Mereka biasanya menanti untuk mendapatkan barang/produk dengan harga yang super murah. </p>

<p class="seodesc">Kini The Watch Co. menghadirkan flash sale bagi para pecinta fashion untuk mendapatkan produk favoritnya. Kamu bisa memiliki aksesoris berupa jam tangan, strap, tas, jaket, dan lain sebagainya dengan harga terbaik. </p>
                       
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs" style="padding-top: 30px; padding-bottom: 30px; text-align: justify;">
                            
                                <p class="seodesc"><strong>Pilih Produk Favoritmu di Flash Sale Sekarang</strong></p>

<p class="seodesc">Tak perlu berpikir panjang untuk mengikuti flash sale ini. Kenapa? Karena waktunya sangat terbatas dan singkat. Selain itu, stok produk yang tersedia pun cukup terbatas. Oleh karena itu, sebaiknya kamu memanfaatkan waktu dengan sebaik mungkin untuk mendapatkan produknya.</p>

<p class="seodesc">Fakta flash sale yang terjadi di Indonesia adalah berapapun produk yang disediakan oleh perusahaan/toko biasanya habis hanya dalam hitungan menit saja. Jadi, banyak sekali orang-orang yang antusias dalam mengikuti acara ini.</p>

<p class="seodesc">Cara terbaik untuk mendapatkan produk pilihanmu, kamu harus standby sebelum waktu flash sale di mulai. Ketika waktu flash sale mulai, kamu langsung pilih produk yang kamu inginkan, lalu langsung check out. Setelah itu langsung dibayarkan agar produk pilihanmu tidak diambil orang lain.  </p>
                            
                    </div>
                    <!--mobile version-->
                    <div class="hidden-lg hidden-md hidden-sm" id="readmore" style="padding-top: 11px; padding-bottom: 1px; text-align: justify;">
                        <p class="show-read-more">
                            </p><p class="seodesc"><strong>Flash Sale The Watch Co.&nbsp;</strong></p>

<p class="seodesc">Flash sale adalah penjualan suatu produk oleh perusahaan atau toko dalam waktu tertentu. Biasanya waktunya sangat singkat dan terbatas. Di luar negeri, istilah flash sale biasa disebut “deal of the day”. Apapun itu istilahnya, flash sale merupakan promo yang sering dinanti bagi yang hobi belanja...<br><br><a>(Baca Selengkapnya)</a>                        </p>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm" id="left" style="padding-top: 11px; padding-bottom: 1px; text-align: justify; display: none;">
                        <p class="show-read-more">
                            </p><p class="seodesc"><strong>Flash Sale The Watch Co.&nbsp;</strong></p>

<p class="seodesc">Flash sale adalah penjualan suatu produk oleh perusahaan atau toko dalam waktu tertentu. Biasanya waktunya sangat singkat dan terbatas. Di luar negeri, istilah flash sale biasa disebut “deal of the day”. Apapun itu istilahnya, flash sale merupakan promo yang sering dinanti bagi yang hobi belanja.&nbsp;</p>

<p class="seodesc">Di Indonesia, seiring perkembangan e-commerce yang pesat,  flash sale sudah menjadi momen yang paling ditunggu-tunggu oleh banyak orang. Mereka biasanya menanti untuk mendapatkan barang/produk dengan harga yang super murah. </p>

<p class="seodesc">Kini The Watch Co. menghadirkan flash sale bagi para pecinta fashion untuk mendapatkan produk favoritnya. Kamu bisa memiliki aksesoris berupa jam tangan, strap, tas, jaket, dan lain sebagainya dengan harga terbaik. </p>
                        <p></p>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm" id="right" style="padding-top: 11px; padding-bottom: 1px; text-align: justify; display: none;">
                        <p class="show-read-more">
                            </p><p class="seodesc"><strong>Pilih Produk Favoritmu di Flash Sale Sekarang</strong></p>

<p class="seodesc">Tak perlu berpikir panjang untuk mengikuti flash sale ini. Kenapa? Karena waktunya sangat terbatas dan singkat. Selain itu, stok produk yang tersedia pun cukup terbatas. Oleh karena itu, sebaiknya kamu memanfaatkan waktu dengan sebaik mungkin untuk mendapatkan produknya.</p>

<p class="seodesc">Fakta flash sale yang terjadi di Indonesia adalah berapapun produk yang disediakan oleh perusahaan/toko biasanya habis hanya dalam hitungan menit saja. Jadi, banyak sekali orang-orang yang antusias dalam mengikuti acara ini.</p>

<p class="seodesc">Cara terbaik untuk mendapatkan produk pilihanmu, kamu harus standby sebelum waktu flash sale di mulai. Ketika waktu flash sale mulai, kamu langsung pilih produk yang kamu inginkan, lalu langsung check out. Setelah itu langsung dibayarkan agar produk pilihanmu tidak diambil orang lain.  </p>

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

<div id="flashModal" class="modal warranty fade" role="dialog">
  <div class="modal-dialog warranty" style="vertical-align: middle;margin-top: 10%;margin-bottom: 10%;">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 10px;background-color: rgb(218,216,217);">
      <div class="modal-body" style="padding-top: 15px;">
        <!-- <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/x-black-24.png" style="width: 17px;"> </button> -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile talign-center">
                          
                          <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
                            Info Promo
                          </span>
                          
                        </div>
                        
      </div>
      <div class="modal-body title-warranty" style="padding-left:0;padding-right:0;margin-top:10px;padding-top:5px;height:240px;">
        
        <hr style="margin-top: 0px;margin-bottom: 5px;margin-left:15px;margin-right:15px;border-top:1px solid rgb(69,69,69);">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile talign-center">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile talign-center" style="padding-top: 10px;">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/watch.png" style="width: 35px;">
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 5px;">
                Periode Promo
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                16 Juni 2018 - 18 Juni 2018
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile talign-center" style="padding-top: 15px;">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/cost.png" style="width: 50px;">
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 10px;">
                Minimum Transaksi
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                Rp. 0
              </div>
            </div>

        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile talign-center" style="padding-bottom: 50px;">
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile talign-center">
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 clearleft clearright clearleft-mobile clearright-mobile talign-center">
          <a style="width: 100%;
    text-align: center;
    border: 1px solid rgb(158,131,97);
    cursor: pointer;
    border-radius: 20px;
    padding: 10px;
    padding-left: 8px;
    padding-right: 8px;
    letter-spacing: 1.5px;
    background: rgb(158,131,97);
    color: #fff;
    float: left;
    font-size: 11px;" data-dismiss="modal">
              Lanjut Belanja
          </a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile talign-center">
        </div>
      </div>
    </div>
    
  </div>
</div>