<?php
$breadcrumbs = $this->context->breadcrumb;
?>
<section id="breadcrumb-bundling">
    <div class="container">
        <div class="row">
        </div>
    </div>
</section>
<section class="ptop1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright pbottom5">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ptop2 remove-padding clearleft clearright">
                    <div class='col-lg-12 col-md-12 col-sm-12 ptop2 col-xs-12 remove-padding-left remove-padding-right clearleft clearright'>
                        <a href="<?php echo \yii\helpers\Url::base(); ?>/upto40">
                            <img src='<?php echo \yii\helpers\Url::base(); ?>/img/promo/endsale/banner_upto40.jpg' class="img-responsive">
                        </a>
                    </div>
                    <div class='col-lg-6 col-md-6 col-sm-6 ptop2 col-xs-6 remove-padding-right padding-left-1-5 clearleft'>
                        <a href="<?php echo \yii\helpers\Url::base(); ?>/hgbundling">
                            <img src='<?php echo \yii\helpers\Url::base(); ?>/img/promo/endsale/hgbundling.jpg' class="img-responsive">
                        </a>
                    </div>
                    <div class='col-lg-6 col-md-6 col-sm-6 ptop2 col-xs-6 remove-padding-right padding-left-1-5 clearright'>
                        <a href="<?php echo \yii\helpers\Url::base(); ?>/hgstraps">
                            <img src='<?php echo \yii\helpers\Url::base(); ?>/img/promo/endsale/hgstraps.jpg' class="img-responsive">
                        </a>
                    </div>
                </div>
            </div>
            <section id="breadcrumb">
                <div class="container breadcrumb-page">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 breadcrumb-page clearleft clearright">
                            <div class="fleft clearleft pright2 hidden-xs hidden-sm hidden-md">SHOW</div>
                            <a href="<?php echo \yii\helpers\Url::base() . '/upto40' . '?page=1&limit=20'; ?>" class="fleft pright2 hidden-xs hidden-sm hidden-md"><span class="gotham-<?php echo!isset($_GET['limit']) || $_GET['limit'] == 20 ? 'medium' : 'light'; ?>">20</span></a>
                            <a href="<?php echo \yii\helpers\Url::base() . '/upto40' . '?page=1&limit=40'; ?>" class="fleft pright2 hidden-xs hidden-sm hidden-md"><span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 40 ? 'medium' : 'light'; ?>">40</span></a>
                            <a href="<?php echo \yii\helpers\Url::base() . '/upto40' . '?page=1&limit=60'; ?>" class="fleft pright2 hidden-xs hidden-sm hidden-md"><span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 60 ? 'medium' : 'light'; ?>">60</span></a>
                            
                            <br>
                        </div>
                    </div>
                </div>
            </section>
            <?php
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
                                        foreach ($productStock as $attribute){
                                            $productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
                                            if($productattribute != NULL && $attribute->quantity != 0){
                                                $found = TRUE;
                                            }
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
                                                            <div class='circle'>
                                                                <span class='text-discount' style=''>
                                                                    <?php
                                                                    if ($product->specificPrice->reduction_type == 'amount') {
                                                                        echo round($product->specificPrice->reduction / 1000, 2);
                                                                    } else {
                                                                        echo $product->specificPrice->reduction;
                                                                    }
                                                                    echo $product->specificPrice->reduction_type == 'percent' ? '%' : 'k';
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
                                            if($stock != NULL){
                                            ?>
                                            <img src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                            <?php
                                                echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : ''; 
                                            ?>
                                            <?php 
                                            } else {
                                            ?><img src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive">

                                            <?php } ?>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace2"><?php echo strtoupper($product->productDetail->name); ?></span></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 product product-price"><span class="lspace2">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?></span></div>
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
                                        foreach ($productStock as $attribute){
                                            $productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
                                            if($productattribute != NULL && $attribute->quantity != 0){
                                                $found = TRUE;
                                            }
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
                                                            <div class='circle'>
                                                                <span class='text-discount' style=''>
                                                                    <?php
                                                                    if ($product->specificPrice->reduction_type == 'amount') {
                                                                        echo round($product->specificPrice->reduction / 1000, 2);
                                                                    } else {
                                                                        echo $product->specificPrice->reduction;
                                                                    }
                                                                    echo $product->specificPrice->reduction_type == 'percent' ? '%' : 'k';
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
                                            if($stock != NULL){
                                            ?>
                                            <img src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                            <?php
                                                echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : ''; 
                                            ?>
                                            <?php 
                                            } else {
                                            ?><img src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive">

                                            <?php } ?>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace2"><?php echo strtoupper($product->productDetail->name); ?></span></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 product product-price"><span class="lspace2">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?></span></div>
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
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pagination"></div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright">
                                <div class="hidden-lg col-md-8 col-sm-8 col-xs-6 remove-padding clearleft">
                                    <span class="gotham-light position-left">SHOW</span>
                                    <span class="gotham-<?php echo!isset($_GET['limit']) || $_GET['limit'] == 20 ? 'medium' : 'light'; ?> padd-4 position-left">
                                        <a href="<?php echo \yii\helpers\Url::base() . '/upto40' . '?page=1&limit=20'; ?>">20</a>
                                    </span>
                                    <span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 40 ? 'medium' : 'light'; ?> padd-4 position-left">
                                        <a href="<?php echo \yii\helpers\Url::base() . '/upto40' . $breadcrumbs[2] . '?page=1&limit=40'; ?>">40</a>
                                    </span>
                                    <span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 60 ? 'medium' : 'light'; ?> padd-4 position-left">
                                        <a href="<?php echo \yii\helpers\Url::base() . '/upto40' . '?page=1&limit=60'; ?>">60</a>
                                    </span>
                                </div>
                                <div class="col-lg-8 hidden-md hidden-sm hidden-xs remove-padding clearleft">
                                    <span class="gotham-light position-left">
                                        <?php echo!isset($_GET['page']) || $_GET['page'] == 1 ? 1 : (($_GET['limit'] * $_GET['page']) - $_GET['limit']) + 1; ?>
                                        - 
                                        <?php echo!isset($_GET['limit']) ? 20 : ($_GET['limit'] * $_GET['page']); ?>
                                        From <?php echo $count; ?> Products
                                    </span>
                                </div>
                                <?php
                                $total_page = ceil($count / $limit);

                                if (!isset($_GET['page']) && !isset($_GET['limit'])) {
                                    ?>
                                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright clearright">

                                        <span class="gotham-medium pleft13-5 remove-padding">
                                            <a href="<?php echo \yii\helpers\Url::base() . '/upto40'; ?>?page=1&amp;limit=20">1</a>
                                        </span>
                                        <span class="gotham-light pleft13-5 pleft-mobile-4">
                                            <a href="<?php echo \yii\helpers\Url::base() . '/upto40'; ?>?page=2&amp;limit=20">2</a>
                                        </span>
                                        <span class="gotham-light pleft13-5 pleft-mobile-4">
                                            <a href="<?php echo \yii\helpers\Url::base() . '/upto40'; ?>?page=3&amp;limit=20">3</a>
                                        </span>
                                        <span class="gotham-light pleft13-5 pleft-mobile-4">
                                            <a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/upto40'; ?>?page=2&amp;limit=20">NEXT</a>
                                        </span>
                                    </div>
                                <?php } elseif (!isset($_GET['page']) || $_GET['page'] == 1) { ?>
                                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright clearright">

                                        <span class="gotham-medium pleft13-5 remove-padding">
                                            <a href="<?php echo \yii\helpers\Url::base() . '/upto40'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
                                        </span>
                                        <span class="gotham-light pleft13-5 pleft-mobile-4">
                                            <a href="<?php echo \yii\helpers\Url::base() . '/upto40'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>">2</a>
                                        </span>
                                        <span class="gotham-light pleft13-5 pleft-mobile-4">
                                            <a href="<?php echo \yii\helpers\Url::base() . '/upto40'; ?>?page=3&amp;limit=<?php echo $_GET['limit']; ?>">3</a>
                                        </span>
                                        <span class="gotham-light pleft13-5 pleft-mobile-4">
                                            <a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/upto40'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
                                        </span>
                                    </div>
                                <?php } else { ?>
                                    <?php
                                    $current = $_GET['page'];
                                    ?>
                                    <?php if ($current != $total_page) { ?>
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright clearright">
                                            <span class="gotham-light pleft18 remove-padding">
                                                <a href="<?php echo \yii\helpers\Url::base() . '/upto40'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
                                            </span>
                                            <span class="gotham-light pleft8-5 pleft-mobile-4">
                                                <a href="<?php echo \yii\helpers\Url::base() . '/upto40'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
                                            </span>
                                            <span class="gotham-medium pleft8-5 pleft-mobile-4">
                                                <a href="<?php echo \yii\helpers\Url::base() . '/upto40'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
                                            </span>
                                            <span class="gotham-light pleft8-5 pleft-mobile-4">
                                                <a href="<?php echo \yii\helpers\Url::base() . '/upto40'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
                                            </span>
                                            <span class="gotham-light pleft8-5 pleft-mobile-4">
                                                <a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/upto40'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
                                            </span>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright clearright">
                                            <span class="gotham-light pleft43 remove-padding">
                                                <a href="<?php echo \yii\helpers\Url::base() . '/upto40'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
                                            </span>
                                            <span class="gotham-light pleft8-5 pleft-mobile-4">
                                                <a href="<?php echo \yii\helpers\Url::base() . '/upto40'; ?>?page=<?php echo $current - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 2; ?></a>
                                            </span>
                                            <span class="gotham-light pleft8-5 pleft-mobile-4">
                                                <a href="<?php echo \yii\helpers\Url::base() . '/upto40'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
                                            </span>
                                            <span class="gotham-medium pleft8-5 pleft-mobile-4">
                                                <a href="<?php echo \yii\helpers\Url::base() . '/upto40'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
                                            </span>
                                        </div>    
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } else { ?>
            <section id="product">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 ptop5 pbottom3">
                        <center><span class="gotham-light fsize-1">PRODUCT NOT FOUND</span></center>
                    </div>
                </div>
            </section>
            <?php } ?>
        </div>
    </div>
</section>