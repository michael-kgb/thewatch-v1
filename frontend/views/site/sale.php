<?php use yii\db\Expression; ?>
<?php
    $now = date('Y-m-d H:i:s');
    $id_brands = [5,6,44,79,2];
    $productRelated = \backend\models\Product::find()
                ->joinWith([
                   "brands",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    },
        
                ])
                // ->where(['product.product_id'=>$id_prod])
                ->where(['brands.brand_id'=>$id_brands])
                ->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')
                ->limit(10)
                ->all();
                
?>
<?php if(count($productRelated) > 0) { ?>
<section id="featured-brands" class="p0">
    

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shop-title caption">END OF YEAR SALE</div>

       
    </section>
    <?php } ?>

 <section id="category">
    <div class="container category">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 featured-brands-homepage">
                <div class="col-lg-5 col-md-5 col-sm-5 hidden-xs category block pright15">
                    <div id="myCarousel2" class="carousel slide carousel-fade" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
            
                                    <li data-target="#myCarousel2" data-slide-to="<?php echo $i; ?>" class="hidden-sm brand-homepage-carousel <?php echo $i === 0 ? 'active' : ''; ?>"></li>
                               
                        </ol>
                        <!-- Wrapper for Slides -->
                        <div class="carousel-inner clearleft clearright">
                            
                                    <div class="item active">
                                        <a href="<?php echo \yii\helpers\Url::base() . '/sale'; ?>">
                                            <img src="https://thewatch.imgix.net/promo/endsale/2018/Banner-Sale.jpg" class="img-responsive remove-padding width100 bradius5">
                                        </a>
                                    </div>
                       
                        </div>
              
                        <!--<a class="left carousel-control" href="#myCarousel2" data-slide="prev">-->
                        <!--    <img src="https://thewatch.imgix.net/icons/prev_slide_gold.png?compress=auto&fit=max" class="prev-brand-popular">-->
                        <!--</a>-->
                        <!--<a class="right carousel-control" href="#myCarousel2" data-slide="next">-->
                        <!--    <img src="https://thewatch.imgix.net/icons/next_slide_gold.png?compress=auto&fit=max" class="next-brand-popular">-->
                        <!--</a>-->
                      
                      </div>
                      

                    <div class="col-lg-12 clearright clearleft ptop20 pbottom15 fsize-14 gotham-light">
                        Lihat Semua Produk
                    </div>
                    <div class="col-lg-12 clearright clearleft">
                        <a class="blue-round featured-banner-see-more button desktop" href="<?php echo \yii\helpers\Url::base() . '/sale/'; ?>">KLIK DISINI</a>
                    </div>

                </div>
                
      
                <!-- mobile image slide -->
                <div class="hidden-lg hidden-md hidden-sm col-xs-12 p0">
    
                    <div id="" class="swiper-container-featured-brand">  
                        <div class="swiper-wrapper clearleft clearright">
                       
                                
                                <div class="swiper-slide">
                                    <a href="<?php echo \yii\helpers\Url::base() . '/sale'; ?>">
                                        <img src="https://thewatch.imgix.net/promo/endsale/2018/end-sale-home.jpg?auto=compress%2Cformat&fit=max&fm=pjpg" class="width100 pright0 bradius5">
                                     </a>  
                                </div>
                               
                       
                        </div>
                     
                        <div class="swiper-pagination popular-brand"></div>
                    <!-- Add Arrows -->
                        
                                                        <div class="swiper-button-next popular-brand"><img src="https://thewatch.imgix.net/icons/next_slide_transparant.png?auto=compress&fit=max" width="40"></div>
                                                        <div class="swiper-button-prev popular-brand"><img src="https://thewatch.imgix.net/icons/prev_slide_transparant.png?auto=compress&fit=max" width="40"></div>
                          


                                                     
                    </div>

                </div>
                
                <!-- desktop product slide -->
             
                <?php if (count($productRelated) > 0) { ?>
                            <?php $i = 1; ?>
                   
                            <div id="" class="swiper-container-featured-brand-product-desktop hidden-xs col-lg-7 col-md-7 col-sm-7 clearleft clearright">
   
    
                                <div class="swiper-wrapper clearleft clearright">
                            
                                        <?php foreach ($productRelated as $related) { ?>
                                                                <?php
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
                            <a class="productClickRelated" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $related->productDetail->link_rewrite; ?>">
                            <div class="relative">
                            <div class="tag">
                                    <?php
                                    if (!empty($related->specificPrice)) {
                                        if($related->specificPrice->is_flash_sale == 0){
                                            if ($related->specificPrice->from <= $now && $related->specificPrice->to > $now) {
                                                ?>
                                                <div class='pull-right'>
                                                    <div class='<?php echo $product->specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                        <span class='text-discount'>
                                                            <?php
                                                            // if custom value label
                                                            if($related->specificPrice->label_type == "custom_value"){
                                                                echo $related->specificPrice->label;
                                                            } else {
                                                                if ($related->specificPrice->reduction_type == 'amount') {
                                                                    echo round($related->specificPrice->reduction / 1000, 2);
                                                                } else {
                                                                    echo $related->specificPrice->reduction;
                                                                }
                                                                echo $related->specificPrice->reduction_type == 'percent' ? '%' : 'k';
                                                            }
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            }
                                        }
                                    ?>
                                </div>
                                <?php
                                    if (!empty($related->specificPrice)) {
                                        if($related->specificPrice->is_flash_sale == 0){
                                            if ($related->specificPrice->from <= $now && $related->specificPrice->to > $now) {
                                            ?>
                                             <div class="tag-bellow tag-mobile-home popular-brand bgcolorae4a3b">
                                                <div class=''>
                                                    <span class='text-bellow'>
                                                    Sale 
                                                        <?php
                                                        // if custom value label
                                                        if($related->specificPrice->label_type == "custom_value"){
                                                            echo $related->specificPrice->label;
                                                        } else {
                                                            if ($related->specificPrice->reduction_type == 'amount') {
                                                                echo round($related->specificPrice->reduction / 1000, 2);
                                                            } else {
                                                                echo $related->specificPrice->reduction;
                                                            }
                                                            echo $related->specificPrice->reduction_type == 'percent' ? '%' : 'k';
                                                        }
                                                        ?> Off
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <?php
                                        }
                                        }
                                    }
                                    ?>
                                        <?php
                                            if($related->productNewArrival->product_newarrival_start_date <= $now && $related->productNewArrival->product_newarrival_end_date >= $now){
                                        ?>
                                             <div class="tag-bellow tag-mobile-home popular-brand bgcolor4c757b">
                                                <div class=''>
                                                    <span class='text-bellow'>
                                                    New Arrival
                                                        
                                                    </span>
                                                </div>
                                            </div>
                                            
                                          <?php
                                            }
                                          ?>
                                                <img alt="<?php echo $related->brands->brand_name . ' ' . $related->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $related->productImage->product_image_id . '/' . $related->productImage->product_image_id; ?>.jpg?auto=compress%2Cformat&fit=max&fm=pjpg&w=1400" class="img-responsive m0 p0 bradius5">
                                </div>
                                                <input type="hidden" name="productId" value="<?php echo $related->product_id; ?>">
                                                <input type="hidden" name="productName" value="<?php echo $related->productDetail->name; ?>">
                                                <input type="hidden" name="productPrice" value="<?php echo $related->price; ?>">
                                                <input type="hidden" name="productCategory" value="<?php echo $related->productCategory->product_category_name; ?>">
                                                <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                                <input type="hidden" name="brandName" value="<?php echo $related->brands->brand_name; ?>">
                                                <div class="col-lg-12 col-md-12 col-sm-12 product gotham-medium brand-title brand-popular"><?php echo $related->brands->brand_name; ?></div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-name brand-popular"><?php echo $related->productDetail->name; ?></div>
                                                <?php
                                // if product has discount
                                $spesificPrice = backend\models\SpecificPrice::find()->where(['product_id' => $related->product_id])->andWhere(['is_flash_sale'=>0])->one();
                                $discount = 0;
                                $now = date('Y-m-d H:i:s');
                                if ($spesificPrice != null) {
                                    ?>
                                    <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview">
                                            <?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
                                            IDR <?php echo \common\components\Helpers::getPriceFormat($related->price); ?>
                                            <input type="hidden" class="price" name="price" value="<?php echo $related->price; ?>">
                                            <?php } else { ?>
                                            USD <?php echo $related->price_usd; ?>
                                            <input type="hidden" class="price" name="price" value="<?php echo $related->price_usd; ?>">
                                            <?php } ?>
                                            <input type="hidden" class="weight" name="weight" value="<?php echo $related->weight; ?>">
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
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



                                    <?php } ?>
                                <?php } else { ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview">
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
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
                                    Out of Stock
                                    </div>
                                    <?php
                                }else{
                                    if(($related->price - $discount) > 500000){
                                    ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment talign-left">
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
                                            </a>
                        </div>
                        </div>
                                            <!--<div class="fill img-responsive" style="background-image:url('<?php // echo \yii\helpers\Url::base(); ?>/img/homebanner/<?php // echo $row->homebanner_images; ?>');"></div>-->
                                        <?php if($i == 10){ ?>
                                            <div class="swiper-slide clearleft clearright bradius5">
                                                <div class="col-lg-12 featured-banner-see-more frame clearleft-mobile clearright-mobile">
                                                    <div class="featured-banner-see-more text">Lihat Semua Produk</div>
                                                    <a class="yellow-round featured-banner-see-more button" href="<?php echo \yii\helpers\Url::base() . '/sale'; ?>">KLIK DISINI</a>
                                                </div>
                                            </div>
                                            <?php break; } ?>
                                        <?php $i++; ?>
                                        <?php } ?>
                              
                                </div>
                                <!-- <div class="swiper-pagination paging-desktop" style="height:35px;margin-top:10px;"></div> -->
                               
                                 
                                    <div class="swiper-button-next featured-desktop popular-brand"><img src="https://thewatch.imgix.net/icons/next_slide_gold.png?auto=compress&fit=max" width="40"></div>
                                    <div class="swiper-button-prev featured-desktop popular-brand"><img src="https://thewatch.imgix.net/icons/prev_slide_gold.png?auto=compress&fit=max" width="40"></div>
                                                                         
                                
                            </div>
     
                 <?php   } ?>

                
            </div>
        </div>

                <!-- mobile product slide -->
                <div class="hidden-lg hidden-md hidden-sm col-xs-12 ptop15"></div>
                    <?php if (count($productRelated) > 0) { ?>
                            <?php $i = 1; ?>

                            <div id="" class="swiper-container-featured-brand-product hidden-lg hidden-md hidden-sm col-xs-12 clearleft-mobile clearright-mobile">
   
    
                                <div class="swiper-wrapper clearleft-mobile clearright-mobile">
                            
                                        <?php foreach ($productRelated as $related) { ?>
                                                                <?php
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
                            <a class="productClickRelated" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $related->productDetail->link_rewrite; ?>">
                            <div class="relative">
                            <div class="tag">
                                    <?php
                                    if (!empty($related->specificPrice)) {
                                        if ($related->specificPrice->from <= $now && $related->specificPrice->to > $now) {
                                            ?>
                                            <div class='pull-right'>
                                                <div class='<?php echo $product->specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                    <span class='text-discount'>
                                                        <?php
                                                        // if custom value label
                                                        if($related->specificPrice->label_type == "custom_value"){
                                                            echo $related->specificPrice->label;
                                                        } else {
                                                            if ($related->specificPrice->reduction_type == 'amount') {
                                                                echo round($related->specificPrice->reduction / 1000, 2);
                                                            } else {
                                                                echo $related->specificPrice->reduction;
                                                            }
                                                            echo $related->specificPrice->reduction_type == 'percent' ? '%' : 'k';
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
                                    if (!empty($related->specificPrice)) {
                                        if ($related->specificPrice->from <= $now && $related->specificPrice->to > $now) {
                                            ?>
                                             <div class="tag-bellow tag-mobile-home popular-brand bgcolorae4a3b">
                                                <div class=''>
                                                    <span class='text-bellow'>
                                                    Sale 
                                                        <?php
                                                        // if custom value label
                                                        if($related->specificPrice->label_type == "custom_value"){
                                                            echo $related->specificPrice->label;
                                                        } else {
                                                            if ($related->specificPrice->reduction_type == 'amount') {
                                                                echo round($related->specificPrice->reduction / 1000, 2);
                                                            } else {
                                                                echo $related->specificPrice->reduction;
                                                            }
                                                            echo $related->specificPrice->reduction_type == 'percent' ? '%' : 'k';
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
                                            if($related->productNewArrival->product_newarrival_start_date <= $now && $related->productNewArrival->product_newarrival_end_date >= $now){
                                        ?>
                                             <div class="tag-bellow tag-mobile-home popular-brand bgcolor4c757b">
                                                <div class=''>
                                                    <span class='text-bellow'>
                                                    New Arrival
                                                        
                                                    </span>
                                                </div>
                                            </div>
                                            
                                          <?php
                                            }
                                          ?>
                                                <img alt="<?php echo $related->brands->brand_name . ' ' . $related->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $related->productImage->product_image_id . '/' . $related->productImage->product_image_id; ?>.jpg?auto=compress%2Cformat&fit=max&fm=pjpg&w=1400" class="img-responsive m0 p0 bradius5">
                                                </div>
                                                <input type="hidden" name="productId" value="<?php echo $related->product_id; ?>">
                                                <input type="hidden" name="productName" value="<?php echo $related->productDetail->name; ?>">
                                                <input type="hidden" name="productPrice" value="<?php echo $related->price; ?>">
                                                <input type="hidden" name="productCategory" value="<?php echo $related->productCategory->product_category_name; ?>">
                                                <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                                <input type="hidden" name="brandName" value="<?php echo $related->brands->brand_name; ?>">
                                                <div class="col-lg-12 col-md-12 col-sm-12 product gotham-medium brand-title p0"><?php echo $related->brands->brand_name; ?></div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-name p0"><?php echo $related->productDetail->name; ?></div>
                                                <?php
                                // if product has discount
                                $spesificPrice = backend\models\SpecificPrice::findOne(['product_id' => $related->product_id]);
                                $discount = 0;
                                $now = date('Y-m-d H:i:s');
                                if ($spesificPrice != null) {
                                    ?>
                                    <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview">
                                            <?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
                                            IDR <?php echo \common\components\Helpers::getPriceFormat($related->price); ?>
                                            <input type="hidden" class="price" name="price" value="<?php echo $related->price; ?>">
                                            <?php } else { ?>
                                            USD <?php echo $related->price_usd; ?>
                                            <input type="hidden" class="price" name="price" value="<?php echo $related->price_usd; ?>">
                                            <?php } ?>
                                            <input type="hidden" class="weight" name="weight" value="<?php echo $related->weight; ?>">
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
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



                                    <?php } ?>
                                <?php } else { ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview">
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
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
                                    Out of Stock
                                    </div>
                                    <?php
                                }else{
                                    if(($related->price - $discount) > 500000){
                                    ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment talign-left">
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
                                            </a>
                        </div>
                        </div>
                                            <!--<div class="fill img-responsive" style="background-image:url('<?php // echo \yii\helpers\Url::base(); ?>/img/homebanner/<?php // echo $row->homebanner_images; ?>');"></div>-->
                                        <?php if($i == 10){ ?>
                                            <div class="swiper-slide clearleft-mobile clearright-mobile bradius5">
                                                <div class="hidden-lg hidden-md hidden-sm col-xs-12 featured-banner-see-more frame clearleft-mobile clearright-mobile">
                                                    <div class="featured-banner-see-more text">Lihat Semua Produk</div>
                                                    <a class="yellow-round featured-banner-see-more button" href="<?php echo \yii\helpers\Url::base() . '/sale';?>">KLIK DISINI</a>
                                                </div>
                                            </div>
                                            <?php break; } ?>
                                        <?php $i++; ?>
                                        <?php } ?>
                              
                                </div>
                                <!--<div class="swiper-pagination" style="height:35px;margin-top:10px;"></div>-->
                                <!-- Add Arrows -->
                                 
                                    <div class="swiper-button-next product-swipe popular-brand"><img src="https://thewatch.imgix.net/icons/next_slide_gold.png?auto=compress&fit=max" width="25"></div>
                                    <div class="swiper-button-prev product-swipe popular-brand"><img src="https://thewatch.imgix.net/icons/prev_slide_gold.png?auto=compress&fit=max" width="25"></div>
                                                                         
                                
                            </div>

                 <?php   } ?>
                <!-- </div> -->

            
                
        
    </div>
   <!--  </div> -->
</section>