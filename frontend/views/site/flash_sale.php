<?php use yii\db\Expression; ?>
<?php
    if ($_SESSION['customerInfo']['customer_id'] == 7614){
    
?>
    <section id="featured-brands" style="padding:0;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shop-title caption">FLASH SALE</div>
</section>
<?php
    $now = date('Y-m-d H:i:s'); 
    $current_date = $now;
    $to = date('2018-08-25 12:30:00');
    $time_active = 0;
    $batch_from = date("2018-08-19 11:00:00");
    $batch_to = date("2018-08-20 10:59:59");
          
    if(($now >= date("2018-08-15 11:00:00")) && ($now <= date("2018-08-15 13:59:59"))){
        $to = date("2018-08-15 13:59:59");
        $batch_from = date("2018-08-15 11:00:00");
                $batch_to = date("2018-08-15 13:59:59");
        $time_active = 1;
    }
    if(($now >= date("2018-08-16 11:00:00")) && ($now <= date("2018-08-16 13:59:59"))){
        $to = date("2018-08-16 13:59:59");
        $batch_from = date("2018-08-16 11:00:00");
                $batch_to = date("2018-08-16 13:59:59");
        $time_active = 1;
    }
    // if(($now >= date("2018-07-17 11:00:00")) && ($now <= date("2018-07-17 12:59:59"))){
    //     $to = date("2018-07-17 12:59:59");
    //     $batch_from = date("2018-07-17 11:00:00");
    //             $batch_to = date("2018-07-17 12:59:59");
    //     $time_active = 1;
    // }
    // if(($now >= date("2018-07-17 17:00:00")) && ($now <= date("2018-07-17 18:59:59"))){
    //     $to = date("2018-07-17 18:59:59");
    //     $batch_from = date("2018-07-17 17:00:00");
    //             $batch_to = date("2018-07-17 18:59:59");
    //     $time_active = 1;
    // }
    // if(($now >= date("2018-07-18 11:00:00")) && ($now <= date("2018-07-18 12:59:59"))){
    //     $to = date("2018-07-18 12:59:59");
    //     $batch_from = date("2018-07-18 11:00:00");
    //             $batch_to = date("2018-07-18 12:59:59");
    //     $time_active = 1;
    // }
    // if(($now >= date("2018-07-18 17:00:00")) && ($now <= date("2018-07-18 18:59:59"))){
    //     $to = date("2018-07-18 18:59:59");
    //     $batch_from = date("2018-07-18 17:00:00");
    //             $batch_to = date("2018-07-18 18:59:59");
    //     $time_active = 1;
    // }
    
    
    if(($current_date >= date("2018-08-14 11:00:00")) && ($current_date <= date("2018-08-15 13:59:59"))){
              $now = date("2018-08-15 12:00:00");
          }
          if(($current_date >= date("2018-08-15 14:00:00")) && ($current_date <= date("2018-08-16 13:59:59"))){
              $now = date("2018-08-16 12:00:00");
          }
        //   if(($current_date >= date("2018-07-16 19:00:00")) && ($current_date <= date("2018-07-17 12:59:59"))){
        //       $now = date("2018-07-17 12:00:00");
        //   }
        //   if(($current_date >= date("2018-07-17 13:00:00")) && ($current_date <= date("2018-07-17 18:59:59"))){
        //      $now = date("2018-07-17 18:00:00");
        //   }
        //   if(($current_date >= date("2018-07-17 19:00:00")) && ($current_date <= date("2018-07-18 12:59:59"))){
        //       $now = date("2018-07-18 12:00:00");
        //   }
        //   if(($current_date >= date("2018-07-18 13:00:00")) && ($current_date <= date("2018-07-18 18:59:59"))){
        //       $now = date("2018-07-18 18:00:00");
        //   }
    
    $batch_date = $now;
          
    $flashMicrotime = \common\components\Helpers::getDifferentMicrotime($now, $to);
?>
<script>
   var flashtime = new Date().getTime() + <?php echo $flashMicrotime; ?>;
   </script>
<section id="category" class="flash-background">
    <div class="container category">
            <div class="row">
                            <a target="_blank" href="<?php echo \yii\helpers\Url::base() . '/flash-sale'; ?>">
                                <div class="col-lg-12 clearleft" style="padding-right: 15px;">
                                    <img src="https://thewatch.imgix.net/promo/flash/campaign-desktop-150818.jpg?auto=compress%2Cformat&fit=max&fm=pjpg&w=1294" class="img-responsive img-full-width col-lg-12 hidden-xs clearleft clearright" style="border-radius: 5px;">
                                    <?php
                                       // if ($_SESSION['customerInfo']['customer_id'] == 7614){
                                        
                                    ?>
                                    <span class="text-flash-sale <?php echo $time_active == 0 ? 'hidden':'hidden';?>">
                                        <span class="gotham-light flash-sisa">Sisa Waktu</span><br><span class="gotham-medium flash-title">FLASH SALE</span><br>
                                        <span id="countdown-product"></span>
                                    </span>
                                    <?php
                                       // }
                                    ?>
                                </div>
                                <div class="col-xs-12 hidden-lg hidden-md hidden-sm" style="padding-right: 14px;padding-top: 0px;">
                                    <img src="https://thewatch.imgix.net/promo/flash/campaign-mobile-150818.jpg?auto=compress%2Cformat&fit=max&fm=pjpg&w=385" class="img-responsive img-full-width col-lg-12 hidden-lg hidden-md hidden-sm clearleft-mobile clearright-mobile" style="border-radius: 5px;">
                                    <?php
                                        //if ($_SESSION['customerInfo']['customer_id'] == 7614){
                                        
                                    ?>
                                    <span class="text-flash-sale <?php echo $time_active == 0 ? 'hidden':'hidden';?>">
                                        <span class="gotham-light flash-sisa">Sisa Waktu</span><br><span class="gotham-medium flash-title">FLASH SALE</span><br>
                                        <span id="countdown-product"></span> 
                                    </span>
                                    <?php 
                                       // }
                                    ?>
                                </div>
                            </a>
                <div class="col-lg-12 clearleft flash-sale">
                    
                
                    <?php 
                       
                        // $now = date('Y-m-d H:i:s'); 
                        $productRelated = \backend\models\Product::find()
                        ->joinWith([
                            "brands",
                            "productFeature",
                            "productDetail",
                            "specificPrice",
                            "productImage" => function ($query) {
                                $query->andWhere(['cover' => 1]);
                            }
                        ])
                        ->limit(10)
                        ->where(['<=','specific_price.from',$now])
                        ->andWhere(['>=','specific_price.to',$now])
                        ->andWhere(['specific_price.is_flash_sale'=>1])
                        ->andWhere(['brands.brand_id'=>44])
                        ->orderBy(new Expression('rand()'))
                        ->all(); 
                        
                     
                        ?>
                        <?php if (count($productRelated) > 0) { ?>
                            <?php $i = 1; ?>
                   
                            <div id="" class="swiper-container-flash-desktop hidden-xs col-lg-12 col-md-12 col-sm-12 clearleft clearright" style="overflow-x:hidden;position: relative;overflow-y: hidden;">
   
    
                                <div class="swiper-wrapper clearleft clearright" style="">
                            
                                        <?php foreach ($productRelated as $related) { ?>
                                                                <?php
                                                                $stock_spec = 0;
                                                                $stock = backend\models\ProductStock::findOne(['product_id' => $related->product_id]);
                                                                $productStock = backend\models\ProductStock::findAll(['product_id' => $related->product_id]);
                                                                $found = FALSE;
                                                                $totalStock = 0;
                                                                foreach ($productStock as $attribute){
                                                                    $productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
                                                                    if($productattribute != NULL && $attribute->quantity != 0){
                                                                        $found = TRUE;
                                                                    }
                                                                    $totalStock = $totalStock + $attribute->quantity;
                                                                }
                                                            ?>

                                            <!-- Set the first background image using inline CSS below. -->
                                <div class="swiper-slide clearleft-mobile clearright-mobile">
                                <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 clearleft clearright <?php if($i % 2 == 0){echo 'kanan';}else{echo 'kiri';}?>">
                                    <a class="productClickRelated" href="<?php echo \yii\helpers\Url::base(); ?>/flash/<?php echo $related->productDetail->link_rewrite; ?>">
                                    <div style="position: relative;">
                                        <div class="tag">
                                            <?php
                                            $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $related->product_id])->andWhere(['is_flash_sale'=>1])->all();
                                            if ($spesificPriceAll != null) {
                                              foreach ($spesificPriceAll as $specificPrice) {
                                                ?>
                                                  <?php
                                                      if ($specificPrice->from <= $batch_date && $specificPrice->to > $batch_date) {
                                                          $stock_spec = $specificPrice->flash_sale_qty;
                                                          ?>
                                                          <?php //if($batch_from <= $current_date && $batch_to >= $current_date){ ?>
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
                                                                            echo floor($specificPrice->reduction / $related->price * 100);
                                                                          } else {
                                                                            echo $specificPrice->reduction;
                                                                          }
                                                                          echo '%';
                                                                        }
                                                                      ?>
                                                                  </span>
                                                              </div>
                                                          </div>
                                                          <?php //} ?>
                                                          <?php
                                                      }
                                            
                                                  ?>
                                                <?php
                                              }
                                            }
                                            
                                            ?>
                                        </div>
                                    
                                                <?php
                                                    if($related->productNewArrival->product_newarrival_start_date <= $now && $related->productNewArrival->product_newarrival_end_date >= $now){
                                                ?>
                                                     <div class="tag-bellow tag-mobile-home" style='background-color: #4c757b;position: absolute;bottom: 0px;width: 100%;top:auto;border-radius: 0 0 5px 5px;'>
                                                        <div class=''>
                                                            <span class='text-bellow'>
                                                            New Arrival
                                                                
                                                            </span>
                                                        </div>
                                                    </div>
                                                    
                                                  <?php
                                                    }
                                                  ?>
                                                        <img style="margin:0;padding:0px;border-radius: 5px;" alt="<?php echo $related->brands->brand_name . ' ' . $related->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $related->productImage->product_image_id . '/' . $related->productImage->product_image_id; ?>.jpg" class="img-responsive">
                                        </div>
                                        <?php
                                            $stock_bar = 100 - ($stock->quantity / $stock_spec * 100);
                                        ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 clearright-mobile clearleft-mobile flash-bar full">
                                            <div class="stock" style="width:<?php echo $stock->quantity == 0 && $time_active == 0 ? '0': $stock_bar; ?>%"></div>
                                        </div>
                                                        <input type="hidden" name="productId" value="<?php echo $related->product_id; ?>">
                                                        <input type="hidden" name="productName" value="<?php echo $related->productDetail->name; ?>">
                                                        <input type="hidden" name="productPrice" value="<?php echo $related->price; ?>">
                                                        <input type="hidden" name="productCategory" value="<?php echo $related->productCategory->product_category_name; ?>">
                                                        <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                                        <input type="hidden" name="brandName" value="<?php echo $related->brands->brand_name; ?>">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 flash-home product gotham-medium brand-title" style="padding-top:16px;padding-bottom: 8px;"><?php echo $related->brands->brand_name; ?></div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 flash-home product gotham-light product-name" style="padding-bottom: 12px;"><?php echo $related->productDetail->name; ?></div>
                                            <?php if($batch_from <= $current_date && $batch_to >= $current_date){ ?>
                                                <?php
                                                    // if product has discount
                                                    $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $related->product_id])->andWhere(['is_flash_sale'=>1])->all();
                                                    $discount = 0;
                                              
                                                    $check_discount = 0;
                                                    if ($spesificPriceAll != null) {
                                                        ?>
                                                        <?php
                                                          foreach ($spesificPriceAll as $spesificPrice) {
                                                            ?>
                                                                <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $batch_date || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $batch_date) { ?>
                                                                  <?php $check_discount = 1; ?>
                                                              
                                                          <?php } else { ?>
                                                              
                                                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flash-home product-detail product-price discountview1">
                                                                  <?php
                                                                  if ($spesificPrice->reduction_type == 'percent') {
                                                                      $discount = (($spesificPrice->reduction / 100) * $related->price);
                                                                  } elseif ($spesificPrice->reduction_type == 'amount') {
                                                                      $discount = $spesificPrice->reduction;
                                                                  }
                                                                  ?>
                                                                  <?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
                                                                  <span class="discount-price mleft2 discountview2">IDR <?php echo \common\components\Helpers::getPriceFormat($related->price); ?></span>
                                                                  <span class="discount-price-real">IDR <?php echo \common\components\Helpers::getPriceFormat($related->price - $discount); ?></span>
                                                                  <input type="hidden" class="price" name="price" value="<?php echo $related->price - $discount; ?>">
                                                                  <?php } else { ?>
                                                                  USD <?php echo $related->price_usd - $discount; ?>
                                                                  <input type="hidden" class="price" name="price" value="<?php echo $related->price_usd - $discount; ?>">
                                                                  <?php } ?>
                    
                    
                                                                  <input type="hidden" class="weight" name="weight" value="<?php echo $related->weight; ?>">
                                                              </div>
                    
                    
                                                              <?php $check_discount = 0;break; ?>
                                                          <?php } ?>
                                                            <?php
                                                          }
                                                        ?>
                                                          <?php if($check_discount == 1){ ?>
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flash-home product-detail product-price discountview">
                                                                  <?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
                                                                  IDR <?php echo \common\components\Helpers::getPriceFormat($related->price); ?>
                                                                  <input type="hidden" class="price" name="price" value="<?php echo $related->price; ?>">
                                                                  <?php } else { ?>
                                                                  USD <?php echo $related->price_usd; ?>
                                                                  <input type="hidden" class="price" name="price" value="<?php echo $related->price_usd; ?>">
                                                                  <?php } ?>
                                                                  <input type="hidden" class="weight" name="weight" value="<?php echo $related->weight; ?>">
                                                              </div>
                                                            <?php } ?>
                                                    <?php } else { ?>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flash-home product-detail product-price discountview">
                                                            <?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
                                                            IDR <?php echo \common\components\Helpers::getPriceFormat($related->price); ?>
                                                            <input type="hidden" class="price" name="price" value="<?php echo $related->price; ?>">
                                                            <?php } else { ?>
                                                            USD <?php echo $related->price_usd; ?>
                                                            <input type="hidden" class="price" name="price" value="<?php echo $related->price_usd; ?>">
                                                            <?php } ?>
                    
                                                            <input type="hidden" class="weight" name="weight" value="<?php echo $related->weight; ?>">
                                                        </div>
                                                    <?php } ?>
                    								<input type="hidden" name="productPrice" value="<?php echo $related->price - $discount; ?>">
                                                <!--<div class="col-lg-12 col-md-12 col-sm-12 product product-price"><span class="lspace2">IDR <?php //echo \common\components\Helpers::getPriceFormat($product->price); ?></span></div> -->
                                                <?php
                                                if($totalStock == 0){
                                                    ?>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flash-home product-detail product-out">
                                                    Out of Stock
                                                    </div>
                                                    <?php
                                                }else{
                                                    if(($related->price - $discount) > 500000){
                                                    ?>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flash-home product-detail product-installment" style="text-align: left;">
                                                            <?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
                                                            IDR <?php echo \common\components\Helpers::getPriceFormat(($related->price - $discount) / 12); ?> / bulan
                    
                                                            <?php } else { ?>
                                                            USD <?php echo ($related->price_usd - $discount)/12; ?> / bulan
                    
                                                            <?php } ?>
                                                        </div>
                                                    <?php
                                                     }
                                                }
                                                ?>
                                            <?php }else{ ?>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flash-home product-detail product-out">
                                                    Coming Soon
                                                    </div
                                            <?php } ?>
                                    
                                                    </a>
                                </div>
                             </div>
                                            <!--<div class="fill img-responsive" style="background-image:url('<?php // echo \yii\helpers\Url::base(); ?>/img/homebanner/<?php // echo $row->homebanner_images; ?>');"></div>-->
                                        <?php if($i == 6){ ?>
                                            <div class="swiper-slide clearleft clearright" style="border-radius: 5px;">
                                                <div class="col-lg-12 featured-banner-see-more frame clearleft-mobile clearright-mobile">
                                                    <div class="featured-banner-see-more text">Lihat Selengkapnya <br> </div>
                                                    <a class="yellow-round featured-banner-see-more button" href="<?php echo \yii\helpers\Url::base() . '/flash-sale'; ?>">KLIK DISINI</a>
                                                </div>
                                            </div>
                                            <?php break; } ?>
                                        <?php $i++; ?>
                                        <?php } ?>
                              
                                </div>
                                <!-- <div class="swiper-pagination paging-desktop" style="height:35px;margin-top:10px;"></div> -->
                               
                                 
                                    <div class="swiper-button-next featured-desktop" style="background-image:none;right: 10px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/icons/next_slide_gold.png" style="width: 40px;"></div>
                                    <div class="swiper-button-prev featured-desktop" style="background-image:none;left: 0px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/icons/prev_slide_gold.png" style="width: 40px;"></div>
                                                                         
                                
                            </div>


                            <div class="hidden-lg hidden-md hidden-sm col-xs-12" style="padding-top:15px;"></div>
                        <?php if (count($productRelated) > 0) { ?>
                            <?php $i = 1; ?>

                            <div id="" class="swiper-container-flash-mobile hidden-lg hidden-md hidden-sm col-xs-12 clearleft-mobile clearright-mobile" style="overflow-x:hidden;position: relative;overflow-y: hidden;">
   
    
                                <div class="swiper-wrapper clearleft-mobile clearright-mobile" style="">
                            
                                        <?php foreach ($productRelated as $related) { ?>
                                                                <?php
                                                                $stock_spec = 0;
                                                                $stock = backend\models\ProductStock::findOne(['product_id' => $related->product_id]);
                                                                $productStock = backend\models\ProductStock::findAll(['product_id' => $related->product_id]);
                                                                $found = FALSE;
                                                                $totalStock = 0;
                                                                foreach ($productStock as $attribute){
                                                                    $productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
                                                                    if($productattribute != NULL && $attribute->quantity != 0){
                                                                        $found = TRUE;
                                                                    }
                                                                    $totalStock = $totalStock + $attribute->quantity;
                                                                }
                                                            ?>

                                            <!-- Set the first background image using inline CSS below. -->
                                            <div class="swiper-slide clearleft-mobile clearright-mobile">
                                        <div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft-mobile clearright-mobile <?php if($i % 2 == 0){echo 'kanan';}else{echo 'kiri';}?>">
                                            <a class="productClickRelated" href="<?php echo \yii\helpers\Url::base(); ?>/flash/<?php echo $related->productDetail->link_rewrite; ?>">
                                            <div style="position: relative;">
                                            <div class="tag">
                                                <?php
                                                    $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $related->product_id])->andWhere(['is_flash_sale'=>1])->all();
                                                    if ($spesificPriceAll != null) {
                                                      foreach ($spesificPriceAll as $specificPrice) {
                                                        ?>
                                                          <?php
                                                              if ($specificPrice->from <= $batch_date && $specificPrice->to > $batch_date) {
                                                                  $stock_spec = $specificPrice->flash_sale_qty;
                                                                  ?>
                                                                  <?php if($batch_from <= $current_date && $batch_to >= $current_date){ ?>
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
                                                                                    echo floor($specificPrice->reduction / $related->price * 100);
                                                                                  } else {
                                                                                    echo $specificPrice->reduction;
                                                                                  }
                                                                                  echo '%';
                                                                                }
                                                                              ?>
                                                                          </span>
                                                                      </div>
                                                                  </div>
                                                                  <?php } ?>
                                                                  <?php
                                                              }
                                                    
                                                          ?>
                                                        <?php
                                                      }
                                                    }
                                                    
                                                    ?>
                                                </div>
                                            
                                                        <?php
                                                            if($related->productNewArrival->product_newarrival_start_date <= $now && $related->productNewArrival->product_newarrival_end_date >= $now){
                                                        ?>
                                                             <div class="tag-bellow tag-mobile-home" style='background-color: #4c757b;position: absolute;bottom: 0px;width: 100%;top:auto;border-radius: 0 0 5px 5px;'>
                                                                <div class=''>
                                                                    <span class='text-bellow'>
                                                                    New Arrival
                                                                        
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            
                                                          <?php
                                                            }
                                                          ?>
                                                                <img style="margin:0;padding:0px;border-radius: 5px;" alt="<?php echo $related->brands->brand_name . ' ' . $related->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $related->productImage->product_image_id . '/' . $related->productImage->product_image_id; ?>.jpg" class="img-responsive">
                                                                </div>
                                                                <?php
                                                                    $stock_bar = 100 - ($stock->quantity / $stock_spec * 100);
                                                                ?>
                                                                <div class="col-lg-12 col-md-12 col-sm-12 clearright-mobile clearleft-mobile flash-bar full">
                                                                                <div class="stock" style="width:<?php echo $stock->quantity == 0 && $time_active == 0 ? '0': $stock_bar; ?>%"></div>
                                                                            </div>
                                                                <input type="hidden" name="productId" value="<?php echo $related->product_id; ?>">
                                                                <input type="hidden" name="productName" value="<?php echo $related->productDetail->name; ?>">
                                                                <input type="hidden" name="productPrice" value="<?php echo $related->price; ?>">
                                                                <input type="hidden" name="productCategory" value="<?php echo $related->productCategory->product_category_name; ?>">
                                                                <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                                                <input type="hidden" name="brandName" value="<?php echo $related->brands->brand_name; ?>">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 product gotham-medium flash-home brand-title" style="padding:0px;"><?php echo $related->brands->brand_name; ?></div>
                                                                <div class="col-lg-12 col-md-12 col-sm-12 product gotham-light flash-home product-name" style="padding:0px;"><?php echo $related->productDetail->name; ?></div>
                                                                <?php if($batch_from <= $current_date && $batch_to >= $current_date){ ?>
                                                                <?php
                                                                    // if product has discount
                                                                    $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $related->product_id])->andWhere(['is_flash_sale'=>1])->all();
                                                                    $discount = 0;
                                                              
                                                                    $check_discount = 0;
                                                                    if ($spesificPriceAll != null) {
                                                                        ?>
                                                                        <?php
                                                                          foreach ($spesificPriceAll as $spesificPrice) {
                                                                            ?>
                                                                                <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $batch_date || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $batch_date) { ?>
                                                                                  <?php $check_discount = 1; ?>
                                                                              
                                                                          <?php } else { ?>
                                                                              
                                                                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flash-home product-detail product-price discountview1">
                                                                                  <?php
                                                                                  if ($spesificPrice->reduction_type == 'percent') {
                                                                                      $discount = (($spesificPrice->reduction / 100) * $related->price);
                                                                                  } elseif ($spesificPrice->reduction_type == 'amount') {
                                                                                      $discount = $spesificPrice->reduction;
                                                                                  }
                                                                                  ?>
                                                                                  <?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
                                                                                  <span class="discount-price mleft2 discountview2">IDR <?php echo \common\components\Helpers::getPriceFormat($related->price); ?></span>
                                                                                  <span class="discount-price-real">IDR <?php echo \common\components\Helpers::getPriceFormat($related->price - $discount); ?></span>
                                                                                  <input type="hidden" class="price" name="price" value="<?php echo $related->price - $discount; ?>">
                                                                                  <?php } else { ?>
                                                                                  USD <?php echo $related->price_usd - $discount; ?>
                                                                                  <input type="hidden" class="price" name="price" value="<?php echo $related->price_usd - $discount; ?>">
                                                                                  <?php } ?>
                                    
                                    
                                                                                  <input type="hidden" class="weight" name="weight" value="<?php echo $related->weight; ?>">
                                                                              </div>
                                    
                                    
                                                                              <?php $check_discount = 0;break; ?>
                                                                          <?php } ?>
                                                                            <?php
                                                                          }
                                                                        ?>
                                                                          <?php if($check_discount == 1){ ?>
                                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flash-home product-detail product-price discountview">
                                                                                  <?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
                                                                                  IDR <?php echo \common\components\Helpers::getPriceFormat($related->price); ?>
                                                                                  <input type="hidden" class="price" name="price" value="<?php echo $related->price; ?>">
                                                                                  <?php } else { ?>
                                                                                  USD <?php echo $related->price_usd; ?>
                                                                                  <input type="hidden" class="price" name="price" value="<?php echo $product->price_usd; ?>">
                                                                                  <?php } ?>
                                                                                  <input type="hidden" class="weight" name="weight" value="<?php echo $related->weight; ?>">
                                                                              </div>
                                                                            <?php } ?>
                                                                    <?php } else { ?>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flash-home product-detail product-price discountview">
                                                                            <?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
                                                                            IDR <?php echo \common\components\Helpers::getPriceFormat($related->price); ?>
                                                                            <input type="hidden" class="price" name="price" value="<?php echo $related->price; ?>">
                                                                            <?php } else { ?>
                                                                            USD <?php echo $related->price_usd; ?>
                                                                            <input type="hidden" class="price" name="price" value="<?php echo $related->price_usd; ?>">
                                                                            <?php } ?>
                                    
                                                                            <input type="hidden" class="weight" name="weight" value="<?php echo $related->weight; ?>">
                                                                        </div>
                                                                    <?php } ?>
                                    								<input type="hidden" name="productPrice" value="<?php echo $related->price - $discount; ?>">
                                                                <!--<div class="col-lg-12 col-md-12 col-sm-12 product product-price"><span class="lspace2">IDR <?php //echo \common\components\Helpers::getPriceFormat($product->price); ?></span></div> -->
                                                                <?php
                                                                if($totalStock == 0){
                                                                    ?>
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flash-home product-detail product-out">
                                                                    Out of Stock
                                                                    </div>
                                                                    <?php
                                                                }else{
                                                                    if(($related->price - $discount) > 500000){
                                                                    ?>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flash-home product-detail product-installment" style="text-align: left;">
                                                                            <?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
                                                                            IDR <?php echo \common\components\Helpers::getPriceFormat(($related->price - $discount) / 12); ?> / bulan
                                    
                                                                            <?php } else { ?>
                                                                            USD <?php echo ($related->price_usd - $discount)/12; ?> / bulan
                                    
                                                                            <?php } ?>
                                                                        </div>
                                                                    <?php
                                                                     }
                                                                }
                                                                ?>
                                                            <?php }else{ ?>
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flash-home product-detail product-out">
                                                                    Coming Soon
                                                                    </div
                                                            <?php } ?>
                                                            </a>
                                        </div>
                                        </div>
                                                        <!--<div class="fill img-responsive" style="background-image:url('<?php // echo \yii\helpers\Url::base(); ?>/img/homebanner/<?php // echo $row->homebanner_images; ?>');"></div>-->
                                                    <?php if($i == 4){ ?>
                                                        <div class="swiper-slide clearleft-mobile clearright-mobile" style="border-radius: 5px;">
                                                            <div class="hidden-lg hidden-md hidden-sm col-xs-12 featured-banner-see-more frame clearleft-mobile clearright-mobile">
                                                                <div class="featured-banner-see-more text">Lihat Selengkapnya <br> </div>
                                                                <a class="yellow-round featured-banner-see-more button" href="<?php echo \yii\helpers\Url::base() . '/brand/' . $related->brands->link_rewrite;?>">KLIK DISINI</a>
                                                            </div>
                                                        </div>
                                                        <?php break; } ?>
                                                    <?php $i++; ?>
                                                    <?php } ?>
                                          
                                            </div>
                                            <!--<div class="swiper-pagination" style="height:35px;margin-top:10px;"></div>-->
                                            <!-- Add Arrows -->
                                             
                                                <div class="swiper-button-next product-swipe" style="background-image:none;right: 0px;display: none;top:35%;"><img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/icons/next_slide_gold.png" style="width: 25px;"></div>
                                                <div class="swiper-button-prev product-swipe" style="background-image:none;left: 0px;display: none;top:35%;"><img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/icons/prev_slide_gold.png" style="width: 25px;"></div>
                                                                                     
                                            
                                        </div>

                             <?php   } ?>
     
                    <?php   } ?>
                 </div>
            </div>
    </div>
</section>
<?php
    }
?>
