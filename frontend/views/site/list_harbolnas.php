<?php
use yii\db\Expression;

$page = 0;
$limit = 4;
//$brand_id = '';
$brand_id = [1,4,10,12,17,27,33,19,24,5,6,2,9,59,58,31,8,26,44,71,48,49,79,72];
$now = date("Y-m-d H:i:s");
$products = \backend\models\Product::find()
    ->offset($page)
    ->limit(15)
    ->joinWith([
        "brands",
        "specificPrice",
        "productImage" => function ($query) {
            $query->andWhere(['cover' => 1]);
        }
    ])
    ->andWhere(['brands.brand_id'=>$brand_id])
    ->andWhere('specific_price.from <= "'. $now . '"')
    ->andWhere('specific_price.to > "'. $now . '"')
    ->orderBy(new Expression('rand()'))
    ->all();

?>

<section id="featured-brands" class="p0">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shop-title caption blue-bg-red">HARBOLNAS</div>
</section>

<?php
if($now >= '2018-12-10 00:00:00' && $now <= '2018-12-15 23:59:59'){
?>
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