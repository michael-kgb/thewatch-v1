<section class="ptop1" style="padding-bottom: 20px;">
    <div class="container">
        
        <div class="row">
            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-5 col-sm-offset-5 gotham-light pbottom3 text-center about-title ptop2" style="font-size: 1.25em">
                FEATURED PRODUCTS
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright">
                     <div class="container product-box clearleft">   
                        <div id="demo">
                            <div class="container" style="padding-left:0px;">
                                <div class="row hidden-xs">
                                    <div class="span12">
                                    <?php use yii\db\Expression; ?>
                                        <?php $productRelated = \backend\models\Product::find()
                                ->joinWith([
                                    "brands",
                                    "productFeature",
                                    "productDetail",
                                    "productImage" => function ($query) {
                                        $query->andWhere(['cover' => 1]);
                                    }
                                ])
                                ->limit(10)
                                ->where(['product.active' => 1,'brands.brand_id'=>44])
                                ->orderBy(new Expression('rand()'))
                                ->all(); ?>
                                        <div id="owl-demo4">
                                            <?php if (count($productRelated) > 0) { ?>
                                            <?php $i = 1; ?>
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
                                                    <div class="item">
                                                        <a class="productClickRelated" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $related->productDetail->link_rewrite; ?>">
                                                            <div style="position:relative;">
                                                            <div class="tag">
                                                    <?php
                                                    if (!empty($related->specificPrice)) {
                                                        if ($related->specificPrice->from <= $now && $related->specificPrice->to > $now) {
                                                            ?>
                                                            <div class='pull-right'>
                                                                <div class='<?php echo $product->specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                                    <span class='text-discount' style=''>
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
                                                             <div class="tag-bellow tag-mobile-home" style='background-color: #ae4a3b;position: absolute;bottom: 0px;width: 100%;top:auto;'>
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
                                                        if($related->productNewArrival->product_newarrival_start_date != '' && $related->productNewArrival->product_newarrival_end_date != ''){
                                                            if($related->productNewArrival->product_newarrival_start_date <= $now && $related->productNewArrival->product_newarrival_end_date >= $now){
                                                        ?>
                                                             <div class="tag-bellow tag-mobile-home" style='background-color: #4c757b;position: absolute;bottom: 0px;width: 100%;top:auto;'>
                                                                <div class=''>
                                                                    <span class='text-bellow'>
                                                                    New Arrival
                                                                        
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            
                                                          <?php
                                                            }
                                                            }
                                                          ?>
                                                            <img alt="<?php echo $related->brands->brand_name . ' ' . $related->productDetail->name; ?>" src="<?php echo \yii\helpers\Url::base(); ?>/img/product/<?php echo $related->productImage->product_image_id . '/' . $related->productImage->product_image_id; ?>.jpg" class="img-responsive">
                                                            </div>
                                                            <input type="hidden" name="productId" value="<?php echo $related->product_id; ?>">
                                                            <input type="hidden" name="productName" value="<?php echo $related->productDetail->name; ?>">
                                                            <input type="hidden" name="productPrice" value="<?php echo $related->price; ?>">
                                                            <input type="hidden" name="productCategory" value="<?php echo $related->productCategory->product_category_name; ?>">
                                                            <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                                            <input type="hidden" name="brandName" value="<?php echo $related->brands->brand_name; ?>">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 product gotham-medium brand-title"><?php echo $related->brands->brand_name; ?></div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-name"><?php echo $related->productDetail->name; ?></div>
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
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment" style="text-align: left;">
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
                                                <?php $i++; ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>   

                     <?php if (count($productRelated) > 0) { ?>
                            <?php $i = 1; ?>
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
       
                    <?php if ($i == 1 || $i == 3 ) { ?>
                <div class="hidden-lg hidden-md hidden-sm container product-box clearleft">
                    <div class="row">
            <?php } ?>
                        <div class="hidden-lg hidden-md hidden-sm col-xs-6" style="<?php if(($i == 1) || ($i == 3)){ echo 'padding-left:0px;padding-right:5px;'; }else{ echo 'padding-right:0px;padding-left:5px;';} ?>">
                            <a class="productClickRelated" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $related->productDetail->link_rewrite; ?>">
                                <div style="position:relative;">
                            <div class="tag">
                                    <?php
                                    if (!empty($related->specificPrice)) {
                                        if ($related->specificPrice->from <= $now && $related->specificPrice->to > $now) {
                                            ?>
                                            <div class='pull-right'>
                                                <div class='<?php echo $product->specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                    <span class='text-discount' style=''>
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
                                             <div class="tag-bellow tag-mobile-home" style='background-color: #ae4a3b;position: absolute;bottom: 0px;width: 100%;top:auto;'>
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
                                             <div class="tag-bellow tag-mobile-home" style='background-color: #4c757b;position: absolute;bottom: 0px;width: 100%;top:auto;'>
                                                <div class=''>
                                                    <span class='text-bellow'>
                                                    New Arrival
                                                        
                                                    </span>
                                                </div>
                                            </div>
                                            
                                          <?php
                                            }
                                          ?>
                                                <img style="margin:0;padding:0px;" alt="<?php echo $related->brands->brand_name . ' ' . $related->productDetail->name; ?>" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $related->productImage->product_image_id . '/' . $related->productImage->product_image_id; ?>.jpg" class="img-responsive">
                                                </div>
                                                <input type="hidden" name="productId" value="<?php echo $related->product_id; ?>">
                                                <input type="hidden" name="productName" value="<?php echo $related->productDetail->name; ?>">
                                                <input type="hidden" name="productPrice" value="<?php echo $related->price; ?>">
                                                <input type="hidden" name="productCategory" value="<?php echo $related->productCategory->product_category_name; ?>">
                                                <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                                <input type="hidden" name="brandName" value="<?php echo $related->brands->brand_name; ?>">
                                                <div class="col-lg-12 col-md-12 col-sm-12 product gotham-medium brand-title" style="padding:0px;"><?php echo $related->brands->brand_name; ?></div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-name" style="padding:0px;"><?php echo $related->productDetail->name; ?></div>
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
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment" style="text-align: left;">
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
                    
                     <?php
                    if ($i == 2) {
                        echo '<div class="hidden-sm clearfix"></div>';
                    }
                    ?>
                    <?php if ($i == 2 || $i == 4 ) { ?>    
                    </div>
                </div>
            <?php } ?>
        <?php $i++; 
        if($i == 5){break;}?>
        <?php } 
                    

                    } ?>
            </div>


            
            <!-- <div class="hidden-lg hidden-md hidden-sm" style="height: 20px;"></div> -->
        </div>
    </div>
</section>
<section id="breadcrumb" style="padding:0;background-color: #a21d22;margin-top: 20px;" class="">
    <div class="row">
           
            <div class="col-md-6 col-sm-12 col-xs-12 padding-0">
                <img style="width:100%;height:auto;" src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/timex.jpg" />
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 gotham-light" style="color:#fff;padding-left:40px;padding-right: 15%;">
                <div class="col-lg-12 col-md-12 hidden-sm hidden-xs" style="padding-top: 40px;font-size: 36px;">
                     #TakeTime
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 padding-red" style="font-size: 50px;">
                     
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 timex-text-red-bg clearleft-mobile clearright-mobile" style="">
                     If you believe in the power of #TakeTime, show your moments on Instagram and stand a chance to win free Timex watch. All you need to do:<br>
                     
                    <ol style="margin-left: -20px;">
                        <li>Upload your version of #TakeTime</li>
                        <li>Mention @Timex and @TheWatchCo with hashtag #TakeTime</li>
                        
                    </ol>
   
                </div>
            </div>    
        </div> 
</section>
<section id="" style="padding:0;">
    <div class="container hidden">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 gotham-light pbottom3 text-center about-title ptop3" style="font-size: 1.25em">
                JOIN NOW
            </div>
        </div>
    </div>
    <div class="container brands hidden">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile">
                <img style="width:100%;height:auto;" src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/take1.jpg" />
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile">
                <img style="width:100%;height:auto;" src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/take2.jpg" />
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile">
                <img style="width:100%;height:auto;" src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/take3.jpg" />
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile">
                <img style="width:100%;height:auto;" src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/take4.jpg" />
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile">
                <img style="width:100%;height:auto;" src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/take1.jpg" />
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile">
                <img style="width:100%;height:auto;" src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/take2.jpg" />
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile">
                <img style="width:100%;height:auto;" src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/take3.jpg" />
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile">
                <img style="width:100%;height:auto;" src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/take4.jpg" />
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile">
                <img style="width:100%;height:auto;" src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/take1.jpg" />
            </div>
     
        </div>
        

    </div>
</section>
<section id="" style="padding:0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 gotham-light pbottom3 text-center about-title ptop2" style="padding-top:50px;font-size: 1.25em">
                OFFICIAL MEDIA PARTNERS
            </div>
        </div>
    </div>
    <div class="container brands">
        <div class="row hidden-xs hidden-sm">
            
                        <div class="col-lg-1 col-sm-1 col-xs-1"></div>
                       
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/heartbreakst_logo.png" class="img-" style="width: 15%;">
                        <!-- <div class="" style="width: 5px;"></div> -->
                   
                        
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/neighbourlist.png" class="img-" style="width: 16%;margin-left: 5%;
    padding-top: 16px;">
                      
                        <!-- <div class="" style="width: 5px;"></div> -->
                       
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/SUB-CULT_mediapartnership.jpg" class="img-" style="padding-top: 14px;width: 15%;margin-left: 5%;">
                        
                        <!-- <div class="" style="width: 2px;"></div> -->
                      
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/proud_logo.png" class="img-" style="width: 15%;margin-left: 5%;">
                       
                
                    
        </div>
        <div class="row hidden-lg hidden-md">
            
                        <div class="col-lg-1 col-sm-1 col-xs-1"></div>
                       
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/heartbreakst_logo.png" class="img-" style="width: 32%;">
                        <!-- <div class="" style="width: 5px;"></div> -->
                   
                        
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/neighbourlist.png" class="img-" style="width: 45%;margin-left: 5%;
    padding-top: 4px;">
                      
                        <!-- <div class="" style="width: 5px;"></div> -->
                       
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/SUB-CULT_mediapartnership.jpg" class="img-" style="padding-top: 14px;width: 34%;margin-left: 8%;">
                        
                        <!-- <div class="" style="width: 2px;"></div> -->
                      
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/proud_logo.png" class="img-" style="    width: 34%;
    margin-left: 9%;
    padding-top: 24px;">
                       
                
                    
        </div>
        
        <!-- <div class="hidden-lg hidden-md hidden-sm row">
            <?php $i = 1; ?>
            <?php if (count($data) > 0) { ?>
                <?php foreach ($data as $row) { ?>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 <?php if($i != 1){ echo 'col-lg-offset-1 col-md-offset-1 col-sm-offset-1'; } ?> brand">
                        <a href="<?php echo \yii\helpers\Url::base() . '/brand/' . $row->link_rewrite; ?>">
                            <img src="img/brands/black/<?php echo $row->brand_logo; ?>" class="img-brands">
                        </a>
                    </div>
                    <?php $i++; ?>
                <?php } ?>
           <?php } ?>
        </div> -->
        
        
    </div>
</section>
<section id="" style="padding:0;">
    <div class="container">
        <div class="row">
            <div class="hidden-lg hidden-md" style="padding:20px;"></div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 gotham-light pbottom3 text-center about-title ptop3" style="padding-top:50px;font-size: 1.25em">
                OFFICIAL RETAIL PARTNERS
            </div>
        </div>
    </div>
    <div class="container brands hidden-xs hidden-sm">
        <div class="row">
            
                   
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/the-watch-co.png" class="img- brand-retail-1" style="width: 12%;margin-left: 8px;
">
                        
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/the-goods-dept.png" class="img- brand-retail-1" style="width: 9%; margin-left: 20px;
    padding-top: 16px;">
                        
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/folksstore.jpg" class="img- brand-retail-1" style="padding-top: 14px;    margin-left: 25px;
    width: 9%;">
                        
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/aksara-1.png" class="img- brand-retail-1" style="width: 7%;margin-left: 32px;
    padding-top: 24px;">
                       
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/art-science.jpg" class="img- brand-retail-1" style="    margin-left: 34px;    width: 7%;
    padding-top: 20px;">
                        
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/Urban-life-logo.png" class="img- brand-retail-1" style="margin-left: 46px;
    padding-top: 16px;">
                        
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/ygoods.jpg" class="img- brand-retail-1" style="padding-top: 14px;margin-left: 20px;">
                       
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/707.jpg" class="img- brand-retail-1" style="">
                        
                    
        </div>
        <div class="row">
            
                   
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/the-cufflink-store.png" class="img- brand-retail-2" style="width: 13%;margin-left: 33px;

    padding-top: 37px;">
                       
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/wood.png" class="img- brand-retail-2" style="    margin-left: 40px;width:13%;
    padding-top: 16px;">
                        
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/treant-store.jpg" class="img- brand-retail-2" style="padding-top: 14px; width: 7%;    margin-left: 40px;
">
                       
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/legasy.png" class="img- brand-retail-2" style="    width: 7%;    margin-left: 40px;
    padding-top: 20px;">
                     
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/ore-store.png" class="img- brand-retail-2" style="    width: 7%;    margin-left: 40px;
    padding-top: 40px;
">
                     
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/widely-project.png" class="img- brand-retail-2" style="    margin-left: 40px;
    padding-top: 16px;">
                       
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/bobobobo.png" class="img- brand-retail-2" style="    width: 7%;    margin-left: 40px;
    padding-top: 15px;">
                        
                    
        </div>
        <div class="row">
            
                    
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/tendencies-logo-putih.jpg" class="img- brand-retail-2" style="width: 10%;margin-left: 33px;
">
                       
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/more-by-morello.jpg" class="img- brand-retail-2" style="width: 12%; margin-left: 22px;
    padding-top: 16px;">
                       
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/maris-store.png" class="img- brand-retail-2" style="    padding-top: 4px; margin-left: 22px;
    width: 7%;">
                     
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/gudang-jam.png" class="img- brand-retail-2" style="width: 13%; margin-left: 22px;">
              
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/pined-logo.png" class="img- brand-retail-2" style="width: 13%; margin-left: 22px;">
                 
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/tokopedia_logo.png" class="img- brand-retail-2" style="width: 12%; margin-left: 22px;
    padding-top: 0px;">
                 
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/Zalora-logo-black.png" class="img- brand-retail-2" style="">
                    
                    
        </div>
        
        <!-- <div class="hidden-lg hidden-md hidden-sm row">
            <?php $i = 1; ?>
            <?php if (count($data) > 0) { ?>
                <?php foreach ($data as $row) { ?>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 <?php if($i != 1){ echo 'col-lg-offset-1 col-md-offset-1 col-sm-offset-1'; } ?> brand">
                        <a href="<?php echo \yii\helpers\Url::base() . '/brand/' . $row->link_rewrite; ?>">
                            <img src="img/brands/black/<?php echo $row->brand_logo; ?>" class="img-brands">
                        </a>
                    </div>
                    <?php $i++; ?>
                <?php } ?>
           <?php } ?>
        </div> -->
        
        
    </div>

    <div class="container brands hidden-lg hidden-md">
        <div class="row">
            
                   
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/the-watch-co.png" class="img- brand-retail-1" style="width: 43%;margin-left: 6%;
">
                        
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/the-goods-dept.png" class="img- brand-retail-1" style="width: 34%; margin-left: 20px;
    padding-top: 16px;">
                        
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/folksstore.jpg" class="img- brand-retail-1" style="    
    margin-left: 10%;
    width: 32%;">
                        
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/aksara-1.png" class="img- brand-retail-1" style="width: 34%;margin-left: 40px;
    padding-top: 24px;">
                       
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/art-science.jpg" class="img- brand-retail-1" style="        margin-left: 15%;
    width: 24%;
    padding-top: 20px;">
                        
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/Urban-life-logo.png" class="img- brand-retail-1" style="margin-left: 50px;width: 34%;
    padding-top: 16px;">
                        
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/ygoods.jpg" class="img- brand-retail-1" style="padding-top: 14px;margin-left: 42px;width: 34%;">
                       
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/707.jpg" class="img- brand-retail-1" style="width: 34%;    margin-left: 10%;">
                        
                    
      
            
                   
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/the-cufflink-store.png" class="img- brand-retail-2" style="width: 34%;    margin-left: 15%;

    padding-top: 37px;">
                       
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/wood.png" class="img- brand-retail-2" style="    width: 34%;margin-left: 22px;
    padding-top: 16px;">
                        
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/treant-store.jpg" class="img- brand-retail-2" style=" padding-top: 40px;
    width: 26%;
    margin-left: 15%;

">
                       
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/legasy.png" class="img- brand-retail-2" style="    width: 25%;       margin-left: 58px;
    padding-top: 40px;">
                     
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/ore-store.png" class="img- brand-retail-2" style="width: 24%;
    margin-left: 16%;

    padding-top: 40px;
">
                     
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/widely-project.png" class="img- brand-retail-2" style="    width: 34%;margin-left: 11%;
    padding-top: 16px;">
                       
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/bobobobo.png" class="img- brand-retail-2" style="    width: 22%;
    margin-left: 16%;
    padding-top: 40px;">
                        
                    
       
            
                    
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/tendencies-logo-putih.jpg" class="img- brand-retail-2" style="width: 34%;margin-left: 13%;padding-top: 40px;
">
                       
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/more-by-morello.jpg" class="img- brand-retail-2" style="width: 27%; margin-left: 17%;
    padding-top: 40px;">
                       
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/maris-store.png" class="img- brand-retail-2" style="    padding-top: 40px; margin-left: 15%;
    width: 23%;">
                     
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/gudang-jam.png" class="img- brand-retail-2" style="width: 28%; margin-left: 16%;padding-top: 40px;">
              
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/pined-logo.png" class="img- brand-retail-2" style="width: 34%; margin-left: 9%;padding-top: 40px;">
                 
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/tokopedia_logo.png" class="img- brand-retail-2" style="width: 30%; margin-left: 14%;
    padding-top: 40px;">
                 
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/logos/Zalora-logo-black.png" class="img- brand-retail-2" style="padding-top: 40px;width: 34%;
    margin-left: 25px;">
                    
                    
        </div>
        
        <!-- <div class="hidden-lg hidden-md hidden-sm row">
            <?php $i = 1; ?>
            <?php if (count($data) > 0) { ?>
                <?php foreach ($data as $row) { ?>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 <?php if($i != 1){ echo 'col-lg-offset-1 col-md-offset-1 col-sm-offset-1'; } ?> brand">
                        <a href="<?php echo \yii\helpers\Url::base() . '/brand/' . $row->link_rewrite; ?>">
                            <img src="img/brands/black/<?php echo $row->brand_logo; ?>" class="img-brands">
                        </a>
                    </div>
                    <?php $i++; ?>
                <?php } ?>
           <?php } ?>
        </div> -->
        
        
    </div>
</section>

<section class="ptop3 pbottom5" style="">
    
        <div class="col-lg-12 col-md-12 col-sm-12 clearleft clearright ptop2" style="text-align: center; margin-bottom: 15px;">
            
            <a href="#" class="scrolls gotham-light">BACK TO TOP</a>
        </div>
        
</section>
    <style>
    

        #owl-demo4 .item{
        margin: 3px 20px 18px 3px;
    }
    #owl-demo4 .item img{
        display: block;
        width: 100%;
        height: auto;
    }

    .owl-theme .owl-controls .owl-buttons div {
        padding: 5px 9px;
    }

    .owl-theme .owl-buttons i{
        margin-top: 2px;
    }

    /*To move navigation buttons outside use these settings:*/

    .owl-theme .owl-controls .owl-buttons div {
        position: absolute;
    }

    .owl-theme .owl-controls .owl-buttons .owl-prev{
        left: -60px;
        top: 160px;
    }

    .owl-theme .owl-controls .owl-buttons .owl-next{
        right: -53px;
        top: 160px;
    }

    .owl-theme .owl-controls .owl-buttons div {
        background: transparent;
    }

    .owl-pagination{
        display: none;
    }
    .brand-retail-1{
        width: 11%;
    }
    .brand-retail-2{
        width: 14%;
    }
    
</style>
<style type="text/css">
.timex-text-red-bg {  
    padding-top: 40px;font-size: 1.2em;
}
.padding-red{
    padding-top: 14%;
}
/*nexus, iphone6plus*/
@media only screen and (min-width : 410px) and (max-width : 415px){
        .tag-mobile-home {
    width: 96.5%;
    top: 234px;
}
    }
/*iphone6*/
@media only screen and (min-width : 375px) and (max-width : 380px){
        .tag-mobile-home {
        width: 97%;
        top: 208px;
    }
}
@media only screen and (min-width : 360px) and (max-width : 374px){
        .tag-mobile-home {
        width: 97%;
        top: 198px;
    }
}
@media only screen and (min-width : 320px) and (max-width : 359px){
        .tag-mobile-home {
        width: 96.5%;
        top: 169px;
    }
}
@media all and (max-width: 767px) {
.timex-text-red-bg {  
    padding-top: 20px;font-size: 1.1em;
    margin-bottom: 40px;
    }
    ol li {
    /* padding: 2px; */
    margin-left: 17px;
    font-family: 'gotham-light';
    }
    ol{
        padding-top:0px;
    }

}
@media (max-width: 1199px) and (min-width: 768px){

}
@media only screen and (min-width : 1080px) and (max-width : 1600px){

    .timex-text-red-bg {
    padding-top: 0px;
    }

}

</style>