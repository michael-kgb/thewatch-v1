<?php use yii\db\Expression; ?>
<?php

use yii\web\Session;
use backend\models\HomebannerJewelry;
use backend\models\ProductSubCategory;
use backend\models\Brands;
?>


<?php
    // Home Banner Jewelry
    $data = HomebannerJewelry::find()->limit(10)->orderBy('homebanner_sequence')->where(['homebanner_status' => 'active'])->all();
    // echo Yii::$app->view->renderFile('@app/views/jewelry/homebanner.php', array("data" => $data));
    echo Yii::$app->view->renderFile('@app/views/jewelry/homebanner.php', array("data" => $data));
    echo Yii::$app->view->renderFile('@app/views/jewelry/homebannermobile.php', array("data" => $data));
?>
<style type="text/css">
/*    #myCarousel4 {
  margin-left: 50px;
  margin-right: 50px;
}*/

.item img {
  margin-left: auto;
  margin-right: auto;
}

.selected img {
    opacity:0.5;
}

/*.carousel-caption {*/
/*    position: relative;*/
/*    left: auto;*/
/*    right: auto;*/
/*}*/

.carousel-control.left,
.carousel-control.right {
  background: none;
  border: none;
  color: black;
}

.carousel-control.left {
  margin-left: -25px;
}

.carousel-control.right {
  margin-right: -25px;
}

.carousel-control {
  width: 0%;
  z-index: 10000;
}

.glyphicon-chevron-left, .glyphicon-chevron-right {
  color: grey;
  font-size: 40px;
}
</style>

<?php $data = ProductSubCategory::find()->limit(10)->where(["product_sub_category_status" => "active", "product_category_id" => 12])->orderBy('product_sub_category_sequence')->all(); ?>

<?php if(count($data) > 0) { ?>
<section id="featured-brands" style="padding:0;">
    
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3 featured-brands"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shop-title caption">SHOP BY CATEGORIES</div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3 featured-brands"></div>
       
    </section>
    <?php } ?>
<section id="category">
    <div class="container category">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 featured-brands-homepage" style="">
                <div class="col-lg-12 col-md-12 hidden-sm hidden-xs category block">
                    <div id="myCarousel3" class="carousel slide carousel-fade" data-ride="carousel">
                      
                        <div class="carousel-inner clearleft clearright">
                            <?php $i = 1; ?>
                            <?php if (count($data) > 0) { ?>
                                <?php foreach ($data as $banner) { ?>

                                    <div class="item active">
                                        <?php if($banner->product_sub_category_name == "Ring"){?>
                                        <div class="col-lg-3 col-md-3 col-sm-12 hidden-xs category block" style="min-height:333px;color:white;">
                                            <a href="<?php echo \yii\helpers\Url::base() . '/jewelry/all-product?sub=1'; ?>">
                                                <img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/category/<?php echo $banner->product_sub_category_image;?>" class="" style="width: 97%;padding-right:0px;">
                                            </a>
                                           
                                         </div>

                                         <?php } ?>
                                        <?php if($banner->product_sub_category_name == "Earring"){?>
                                         <div class="col-lg-3 col-md-3 col-sm-12 hidden-xs category block" style="min-height:333px;color:white;">
                                            <a href="<?php echo \yii\helpers\Url::base() . '/jewelry/all-product?sub=2'; ?>">
                                                <img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/category/<?php echo $banner->product_sub_category_image;?>" class="" style="width: 97%;padding-right:0px;margin-left: 6px;">
                                            </a>
                                           
                                         </div>
                                        <?php } ?>
                                        <?php if($banner->product_sub_category_name == "Bracelet"){?>
                                         <div class="col-lg-3 col-md-3 col-sm-12 hidden-xs category block" style="min-height:333px;color:white;">
                                            <a href="<?php echo \yii\helpers\Url::base() . '/jewelry/all-product?sub=3'; ?>">
                                                <img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/category/<?php echo $banner->product_sub_category_image;?>" class="" style="width: 97%;padding-right:0px;margin-left: 6px;">
                                            </a>
                                           
                                         </div>
                                        <?php } ?>
                                        <?php if($banner->product_sub_category_name == "Necklace"){?>
                                         <div class="col-lg-3 col-md-3 col-sm-12 hidden-xs category block" style="min-height:333px;color:white;">
                                            <a href="<?php echo \yii\helpers\Url::base() . '/jewelry/all-product?sub=4'; ?>">
                                                <img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/category/<?php echo $banner->product_sub_category_image;?>" class="" style="width: 97%;padding-right:0px;float: right;">
                                            </a>
                                           
                                         </div>
                                         <?php } ?>
                                        
                                    </div>
                                    <?php $i++; ?>
                                <?php } ?>
                            <?php } ?>
                            
                        </div>
                        <?php if (count($data) > 0) { ?>
                        <!--<a class="left carousel-control" href="#myCarousel3" data-slide="prev">-->
                        <!--    <span class="icon-prev"></span>-->
                        <!--</a>-->
                        <!--<a class="right carousel-control" href="#myCarousel3" data-slide="next">-->
                        <!--    <span class="icon-next"></span>-->
                        <!--</a>-->
                        <?php } ?>

                    </div>
                </div>
                <div class="col-xs-12 hidden-lg hidden-sm hidden-md clearright-mobile clearleft-mobile">

                    <?php if (count($data) > 0) { ?>
                                <?php foreach ($data as $banner) { ?>
                      <?php if($banner->product_sub_category_name == "Ring"){?>
                                        <div class="col-xs-12 hidden-lg hidden-md hidden-sm category block clearright-mobile clearleft-mobile" style="min-height:333px;color:white;">
                                            <a href="<?php echo \yii\helpers\Url::base() . '/jewelry/all-product?sub=1'; ?>">
                                                <img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/category/<?php echo $banner->product_sub_category_image;?>" class="" style="width: 100%;padding-right:0px;">
                                            </a>
                                           
                                         </div>

                                         <?php } ?>
                                        <?php if($banner->product_sub_category_name == "Earring"){?>
                                         <div class="col-xs-12 hidden-lg hidden-md hidden-sm category block clearright-mobile clearleft-mobile" style="min-height:333px;color:white;">
                                            <a href="<?php echo \yii\helpers\Url::base() . '/jewelry/all-product?sub=2'; ?>">
                                                <img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/category/<?php echo $banner->product_sub_category_image;?>" class="" style="width: 100%;padding-right:0px;">
                                            </a>
                                           
                                         </div>
                                        <?php } ?>
                                        <?php if($banner->product_sub_category_name == "Bracelet"){?>
                                         <div class="col-xs-12 hidden-lg hidden-md hidden-sm category block clearright-mobile clearleft-mobile" style="min-height:333px;color:white;">
                                            <a href="<?php echo \yii\helpers\Url::base() . '/jewelry/all-product?sub=3'; ?>">
                                                <img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/category/<?php echo $banner->product_sub_category_image;?>" class="" style="width: 100%;padding-right:0px;">
                                            </a>
                                           
                                         </div>
                                        <?php } ?>
                                        <?php if($banner->product_sub_category_name == "Necklace"){?>
                                         <div class="col-xs-12 hidden-lg hidden-md hidden-sm category block clearright-mobile clearleft-mobile" style="min-height:333px;color:white;">
                                            <a href="<?php echo \yii\helpers\Url::base() . '/jewelry/all-product?sub=4'; ?>">
                                                <img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/category/<?php echo $banner->product_sub_category_image;?>" class="" style="width: 100%;padding-right:0px;">
                                            </a>
                                           
                                         </div>
                                        <?php } ?>
                      <?php }
                  }
                  ?>
                    </div>
                </div>



            </div>
        </div>
    </div>
</section>
<?php
    $brand_id = '';
    $brand_id_small = '';
    $brand_detail_small = '';
    $brand_featured_mobile = '';
    $connection = Yii::$app->getDb();
    $command = $connection->createCommand(" SELECT brands_banner.brand_banner_small_banner FROM brands, brands_banner 
                                        WHERE brands_banner.brands_brand_id = brands.brand_id AND brands.brand_homepage_jewelry = 1
                                        ");
    $brand_banner_small_banner = $command->queryAll();
    foreach ($brand_banner_small_banner as $brands) {
       $brand_detail_small = $brands['brand_banner_small_banner'];
    }
    $query = \backend\models\BrandsBannerDetail::find()
                ->joinWith(['brands']);
         
        $brand = $query
                ->select(['brands_banner_detail.brands_banner_detail_slide_image','brands_banner_detail.brands_brand_id'])
                ->where(["brands.brand_homepage_jewelry" => 1])
                ->andWhere(["brands_banner_detail.brands_banner_featured_brand" => 0,"brands_banner_detail.brands_banner_featured_mobile" => 0,"brands_banner_detail.brands_banner_featured_jewelry" => 1])
                ->andWhere(["brands.brand_status" => "active"])
                ->orderBy('brands.brand_name')
                ->all(); ?>

<?php if(count($brand) > 0) { ?>
<section id="featured-brands" style="padding:0;">
    
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3 featured-brands"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shop-title caption">FEATURED BRAND</div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3 featured-brands"></div>
       
    </section>
    <?php } ?>
<section id="category">
    <div class="container category">
       <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 featured-brands-homepage" style="">
                <div class="col-lg-8 col-md-8 hidden-sm hidden-xs category block">
                    <div id="myCarousel2" class="carousel slide carousel-fade" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php $i = 0; ?>
                            <?php if (count($brand) > 0) { ?>
                                <?php foreach ($brand as $banner) { ?>
                                    <li style="border: 1px solid white;" data-target="#myCarousel2" data-slide-to="<?php echo $i; ?>" class="brand-homepage-carousel <?php echo $i === 0 ? 'active' : ''; ?>"></li>
                                    <?php $i++; ?>
                                <?php } ?>
                            <?php } ?>
                        </ol>
                        <!-- Wrapper for Slides -->
                        <div class="carousel-inner clearleft clearright">
                            <?php $i = 1; ?>
                            <?php if (count($brand) > 0) { ?>
                                <?php foreach ($brand as $banner) { ?>
                                    <div class="item <?php echo $i === 1 ? 'active' : ''; ?>">
                                        <a href="<?php echo \yii\helpers\Url::base() . '/jewelry/brand/' . $banner->brands->link_rewrite; ?>">
                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/brand_banner/<?php echo $banner->brands_brand_id;?>/<?php echo $banner->brands_banner_detail_slide_image; ?>" class="img-responsive remove-padding" style="width: 97%">
                                        </a>
                                        <?php 
                                        if($i == 1){
                                            // $brand_id_small = $banner->brands_brand_id;
                                            //$brand_detail_small = $banner->brands_banner_detail_slide_image;
                                        }
                                        if($banner->brands_banner_featured_mobile == 1){
                                            $brand_featured_mobile = $banner->brands_banner_detail_slide_image;
                                        }
                                        $brand_id = $banner->brands_brand_id; ?>
                                        <!--<div class="fill" style="background-image: url(<?php // echo Yii::$app->params['cloudfrontDev'] ?>img/brand_banner/<?php // echo $brand_detail->brand_id; ?>/<?php // echo $banner->brands_banner_detail_slide_image; ?>);"></div>-->
                                    </div>
                                    <?php $i++; ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <?php if (count($brand) > 0) { ?>
                        <a class="left carousel-control" href="#myCarousel2" data-slide="prev" style="margin-left:35px;">
                            <span class="icon-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel2" data-slide="next" style="margin-right:35px;">
                            <span class="icon-next"></span>
                        </a>
                        <?php } ?>

                      </div>
                      

                </div>
                <?php
                    $brand2 = $query
                ->select(['brands_banner_detail.brands_banner_detail_slide_image','brands_banner_detail.brands_brand_id'])
                ->where(["brands.brand_homepage_jewelry" => 1])
                ->andWhere(["brands_banner_detail.brands_banner_featured_brand" => 0,"brands_banner_detail.brands_banner_featured_mobile" => 0,"brands_banner_detail.brands_banner_featured_jewelry" => 1])
                ->andWhere(["brands.brand_status" => "active"])
                ->orderBy('brands.brand_name')
                ->one();
                ?>
                <?php if (count($brand2) > 0) { ?>
                <div class="hidden-lg hidden-md col-sm-12" style="padding:0px">
                    
                        <a href="<?php echo \yii\helpers\Url::base() . '/jewelry/brand/' . $brand2->brands->link_rewrite; ?>">
                        <img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/brand_banner/<?php echo $brand2->brands_brand_id;?>/<?php echo $brand2->brands_banner_detail_slide_image; ?>" class="" style="width: 100%;padding-right:0px;">
                     </a>  
                       
                </div>
                <?php } ?>

                <?php $query = \backend\models\Brands::find()->where(['brand_id'=>$brand_id])->all()?>
                <?php if (count($query) > 0) { ?>
                                <?php foreach ($query as $ban) { ?>
                <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs category block box-category-text" style="background-color:#9f8562;color:white;">
                        <br>
                            <div class="col-lg-12 col-md-12 col-sm-12 about-featured-brand">About</div>
                            <div class="col-lg-12 col-md-12 col-sm-12 title-featured-brand"><?php echo $ban['brand_name']; ?></div>
                            <br><br><br>
                            <div class="col-lg-12 col-md-12 col-sm-12 brand-description-homepage"><?php 
                                $max_length = 425;

                                if (strlen($ban['brand_description']) > $max_length)
                                {
                                    $offset = ($max_length - 3) - strlen($ban['brand_description']);
                                    $ban['brand_description'] = substr($ban['brand_description'], 0, strrpos($ban['brand_description'], ' ', $offset)) . '...';
                                }

                                echo $ban['brand_description'];?></div>
                            
                        <br>
                        <br>
                         <div style="padding-top:3em;" class="col-lg-12 col-md-12 col-sm-12 right gotham-light brand-description-homepage"><a style="" class="blue-round" href="<?php echo \yii\helpers\Url::base() . '/brand/' . $ban->link_rewrite; ?>">See More</a></div>
                </div>
                <div class="hidden-lg hidden-md hidden-sm category block" style="background-color:#9f8562;min-height:268px;color:white;">
                        <br>
                            <div class="col-lg-12 col-md-12 col-sm-12 about-featured-brand">About</div>
                            <div class="col-lg-12 col-md-12 col-sm-12 title-featured-brand"><?php echo $ban['brand_name']; ?></div>
                            <br><br>
                            <div class="col-lg-12 col-md-12 col-sm-12 brand-description-homepage"><?php 
                                $max_length = 350;

                                if (strlen($ban['brand_description']) > $max_length)
                                {
                                    $offset = ($max_length - 3) - strlen($ban['brand_description']);
                                    $ban['brand_description'] = substr($ban['brand_description'], 0, strrpos($ban['brand_description'], ' ', $offset)) . '...';
                                }

                                echo $ban['brand_description'];?></div>
                            
                        <br><br>
                        
                         <div style="padding-bottom:10px;" class="col-lg-12 col-md-12 col-sm-12 right gotham-light brand-description-homepage"><a style="color:white;" href="<?php echo \yii\helpers\Url::base() . '/jewelry/brand/' . $ban->link_rewrite; ?>">All <?php echo $ban['brand_name'];?> <span class="glyphicon glyphicon-arrow-right"></span></a></div>
                </div>
                <?php }} ?>
            </div>
        </div>
        
    </div>


    <div class="container clearleft">
        <div id="demo">
            <div class="container" style="padding-left:0px;">
                <div class="row hidden-xs">
                    <div class="span12">
                        <?php $productRelated = \backend\models\Product::find()
                ->joinWith([
                    "brands",
                    // "productFeature",
                    "productDetail",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->limit(12)
                ->where(['product.active' => 1,'product.product_category_id'=>12])
                ->orderBy(new Expression('rand()'))
                ->all(); ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="col-lg-12 col-lg-12 col-sm-12 shop-title">SHOP ALL JEWELRY</div>
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
       
                    <?php if ($i == 1 || $i == 5 || $i == 9 || 
                  $i == 13 || $i == 17 || $i == 21 || 
                  $i == 25 || $i == 29 || $i == 33 ||
                  $i == 37 || $i == 41 || $i == 45 ||
                  $i == 49 || $i == 53 || $i == 57 ||
                  $i == 61) { ?>
                <div class="container product-box clearleft">
                    <div class="row">
            <?php } ?>
                        <div class="hidden-sm col-lg-3 col-md-3 col-xs-6 space-product <?php echo $i % 2 == 0 ? 'pleft75' : 'pright75'; ?> mbottom-3-mobile">
						  <?php
                        if($found){
                        $sessionOrder = new Session();
                        $sessionOrder->open();
                        $customerInfo = $sessionOrder->get("customerInfo"); 

                        if(isset($customerInfo)){
                  
                      ?>
                        
                          <div class="tag-product-wishlist addtowishlistCatalogue" data-product-id="<?=$related->product_id?>">
                                <div class="circle love" data-id="<?=$related->product_id?>">
                                </div>
                          </div>
                      <?php
                        }
                    }
					?>
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
                                             <div class="tag-bellow tag-sale" style='background-color: #ae4a3b;position: absolute;bottom: 0px;width: 100%;top:auto;'>
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
                                             <div class="tag-bellow tag-sale" style='background-color: #4c757b;position: absolute;bottom: 0px;width: 100%;top:auto;'>
                                                <div class=''>
                                                    <span class='text-bellow'>
                                                    New Arrival
                                                        
                                                    </span>
                                                </div>
                                            </div>
                                            
                                          <?php
                                            }
                                          ?>
                                                <img style="margin:0;padding:0px;" alt="<?php echo $related->brands->brand_name . ' ' . $related->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $related->productImage->product_image_id . '/' . $related->productImage->product_image_id; ?>_big.jpg" class="img-responsive">
                                                </div>
                                                <input type="hidden" name="productId" value="<?php echo $related->product_id; ?>">
                                                <input type="hidden" name="productName" value="<?php echo $related->productDetail->name; ?>">
                                                <input type="hidden" name="productPrice" value="<?php echo $related->price; ?>">
                                                <input type="hidden" name="productCategory" value="<?php echo $related->productCategory->product_category_name; ?>">
                                                <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                                <input type="hidden" name="brandName" value="<?php echo $related->brands->brand_name; ?>">
                                                <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($related->brands->brand_name); ?></div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace0-5"><?php echo ucwords($related->productDetail->name); ?></span></div>
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
        <?php $i++; 
        // if($i == 20){break;}?>
        <?php } 
                    

                    } ?>
                <!-- </div> -->

            <!-- </div> -->
        
    </div>
   <!--  </div> -->
   
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





<?php
                    $data = Brands::find()->limit(6)->where(array("brand_status" => "active", "brand_id" => [48,74,75,76,77,78]))->orderBy('brand_sequence')->all();
                    echo Yii::$app->view->renderFile('@app/views/jewelry/brands.php', array("data" => $data));
                    ?>

<style>
    .carousel-control.left {
    margin-left: 60px;
}
.carousel-control.right {
    margin-right: 60px;
}
.box-category-text{
    min-height:367px;
}
@media only screen and (max-width : 769px) {
    .box-category-text{
        min-height:220px;
    }
}
@media only screen and (max-width : 1025px) {
    .box-category-text{
        min-height:274px;
    }
}
@media only screen and (max-width : 1281px) {
    .box-category-text{
        min-height:330px;
    }
}
</style>