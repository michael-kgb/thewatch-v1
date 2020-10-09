<?php session_start(); use yii\db\Expression; die(var_dump('dsaf'));?>


<section id="category">
    <div class="container category">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 featured-brands-homepage" style="">
                <div class="col-lg-8 col-md-8 hidden-sm hidden-xs category block">
                    <div id="myCarousel3" class="carousel slide carousel-fade" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            
                                    <li style="border: 1px solid white;" data-target="#myCarousel2" data-slide-to="0" class="brand-homepage-carousel active"></li>
                                   
                        </ol>
                        <!-- Wrapper for Slides -->
                        <div class="carousel-inner clearleft clearright">
                           
                                    <div class="item active">
                                        <a style="color:white;" href="<?php echo \yii\helpers\Url::base() . '/harbolnas';?>">
                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/promo/harbolnas/harbolnas_featured_mobile.jpg" class="img-responsive remove-padding" style="width: 97%">
                                        </a>
                                        <!--<div class="fill" style="background-image: url(<?php // echo Yii::$app->params['cloudfrontDev'] ?>img/brand_banner/<?php // echo $brand_detail->brand_id; ?>/<?php // echo $banner->brands_banner_detail_slide_image; ?>);"></div>-->
                                    </div>
                                    
                        </div>
                       
                        <a class="left carousel-control" href="#myCarousel3" data-slide="prev">
                            <span class="icon-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel3" data-slide="next">
                            <span class="icon-next"></span>
                        </a>
                       

                      </div>
                      

                </div>
                
                <div class="hidden-lg hidden-md col-sm-12" style="padding:0px">
                        <a style="color:white;" href="<?php echo \yii\helpers\Url::base() . '/harbolnas';?>">S
                    <img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/promo/harbolnas/harbolnas_featured_desktop.jpg" class="" style="width: 100%;padding-right:0px;">
                    </a>
                </div>
                

                
                <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs category block" style="background-color:#9f8562;min-height:333px;color:white;">
                        <br>
                            <div class="col-lg-12 col-md-12 col-sm-12 about-featured-brand">Harbolnas!</div>
                            <!-- <div class="col-lg-12 col-md-12 col-sm-12 title-featured-brand"><?php echo $ban['brand_name']; ?></div> -->
                            <br><br><br>
                            <div class="col-lg-12 col-md-12 col-sm-12 brand-description-homepage">
                            The Watch Co. Harbolnas Special Sale! Dapatkan produk William L. 1985, Eastpak, Hypergrand, Corniche, Greyhours, Tom Hope, Nocs Atelier, Mockberg, Zinvo, dan Olivia Burton dengan diskon 10%+10% off dari 10 - 12 Oktober 2017. 
                            <br><br>
                            Selain itu ada juga Flash Sale 25% off hanya pada 10 Oktober 2017 dari jam 11.00 - 14.00 WIB dan jam 17.00 - 20.00 WIB. Dapatkan produk favorit mu sekarang juga!

                            </div>
                            
                        <br>
                        <br>
                         <div style="padding-top:3em;" class="col-lg-12 col-md-12 col-sm-12 right gotham-light brand-description-homepage"><a style="color:white;" href="<?php echo \yii\helpers\Url::base() . '/harbolnas';?>">Selengkapnya <span class="glyphicon glyphicon-arrow-right"></span></a></div>
                </div>
                <div class="hidden-lg hidden-md hidden-sm category block" style="background-color:#9f8562;min-height:268px;color:white;">
                        <br>
                            <div class="col-lg-12 col-md-12 col-sm-12 about-featured-brand">Harbolnas!</div>
                            <!-- <div class="col-lg-12 col-md-12 col-sm-12 title-featured-brand"><?php echo $ban['brand_name']; ?></div> -->
                            <br><br>
                            <div class="col-lg-12 col-md-12 col-sm-12 brand-description-homepage">
                            The Watch Co. Harbolnas Special Sale! Dapatkan produk William L. 1985, Eastpak, Hypergrand, Corniche, Greyhours, Tom Hope, Nocs Atelier, Mockberg, Zinvo, dan Olivia Burton dengan diskon 10%+10% off dari 10 - 12 Oktober 2017. 
                            <br>
                            Selain itu ada juga Flash Sale 25% off hanya pada 10 Oktober 2017 dari jam 11.00 - 14.00 WIB dan jam 17.00 - 20.00 WIB. Dapatkan produk favorit mu sekarang juga!
                            </div>
                            
                        <br><br>
                        
                         <div style="padding-bottom:10px;" class="col-lg-12 col-md-12 col-sm-12 right gotham-light brand-description-homepage"><a style="color:white;" href="<?php echo \yii\helpers\Url::base() . 'harbolnas'; ?>">Selengkapnya <span class="glyphicon glyphicon-arrow-right"></span></a></div>
                </div>
             
            </div>
        </div>
         <div class="container product-box clearleft mbottom7">
        <div id="demo">
            <div class="container" style="padding-left:0px;">
                <div class="row hidden-xs">
                    <div class="span12">
                        <?php 
                        $now = date("Y-m-d H:i:s");
                        $flashsale = \backend\models\SpecificPrice::find()
                            ->where(['is_flash_sale' => 1])
                            ->andWhere('specific_price.from <= "'. $now . '"')
                            ->andWhere('specific_price.to > "'. $now . '"')
                            ->all();
                        $productList = array();
                        $flashMicrotime = 0;
                        if(count($flashsale) > 0){
                            foreach($flashsale as $flash){
                                if ($flash->from <= $now && $flash->to > $now) {
                                    $flashMicrotime = \common\components\Helpers::getDifferentMicrotime($now, $flash->to);
                                    break;
                                }
                            }
                            
                            foreach($flashsale as $flash){
                                if ($flash->from <= $now && $flash->to > $now) {
                                    $productList[] = $flash->product_id;
                                }
                            }
                        }
                        
//                        echo $flashMicrotime; die();
//                        print_r($productList); die();
                        
                        if($_SESSION['customerInfo']['customer_id'] == 570)
                        {
                            $flashMicrotime = 50000;
                        }
                        
						if($_SESSION['customerInfo']['customer_id'] == 570)
                        {
							$productRelated = \backend\models\Product::find()
								->joinWith([
									"brands",
									"productDetail",
									"productImage" => function ($query) {
										$query->andWhere(['cover' => 1]);
									}
								])
							->limit(10)
							->where(['product.product_id' => [4,6,7,8,9], 'product.active' => 1])
							->orderBy(new Expression('rand()'))
							->all();
                        } else {
							$productRelated = \backend\models\Product::find()
								->joinWith([
									"brands",
									"productDetail",
									"productImage" => function ($query) {
										$query->andWhere(['cover' => 1]);
									}
								])
							->limit(10)
							->where(['product.product_id' => $productList, 'product.active' => 1])
							->orderBy(new Expression('rand()'))
							->all();
						}
                        ?>
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
                                <div class="tag-bellow tag-mobile-home" id="countdown-product-box" style='background-color: #ae4a3b;'>
                                    <div class=''>
                                        <span class='text-flash-sale' id="countdown-product">
                                            
                                        </span>
                                    </div>
                                </div>
                                            <img alt="<?php echo $related->brands->brand_name . ' ' . $related->productDetail->name; ?>" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $related->productImage->product_image_id . '/' . $related->productImage->product_image_id; ?>.jpg" class="img-responsive">
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


               <!--  <div class="hidden-lg hidden-md col-sm-12 col-xs-12" style="padding:0px;"> -->
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
                        <div class="hidden-lg hidden-md hidden-sm col-xs-6" style="<?php if(($i == 1) || ($i == 3)){ echo 'padding-left:0px;'; }else{ echo 'padding-right:0px;';} ?>">
                            <a class="productClickRelated" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $related->productDetail->link_rewrite; ?>">
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
								<div class="tag-bellow tag-mobile-home" id="countdown-product-box" style='background-color: #ae4a3b;'>
                                    <div class=''>
                                        <span class='text-flash-sale' id="countdown-product">
                                            
                                        </span>
                                    </div>
                                </div>
                                <?php
                                    if (!empty($related->specificPrice)) {
                                        if ($related->specificPrice->from <= $now && $related->specificPrice->to > $now) {
                                            ?>
                                             <div class="tag-bellow tag-mobile-home" style='background-color: #ae4a3b; display: none;'>
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
                                             <div class="tag-bellow tag-mobile-home" style='background-color: #4c757b;'>
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
                <!-- </div> -->

            <!-- </div> -->
        
    </div>
   <!--  </div> -->
   <script>
   var flashtime = new Date().getTime() + <?php echo $flashMicrotime; ?>;
   </script>
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
</style>

</section>