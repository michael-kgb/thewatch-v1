<?php
//echo Yii::$app->view->renderFile('@app/views/widget/breadcrumb.php');
$breadcrumbs = $this->context->breadcrumb;
?>
<!--<script async="true" src="//ssp.adskom.com/tags/third-party-async/YzhiNjcwNjQtNGFlZS00OGQ1LWE2ZTktM2U4MzhkN2RjNDU3"></script>-->
<script>
var items = [];
	
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
		"list": 'search result page'
	});
	
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
	
	fbq('track', 'Search');
</script>
<?php
// get name search
$q = $_GET['q'];

?>
<style>
@media only screen and (min-width: 768px){
    
    .tag-bellow {
    position: absolute;
    height: 32px;
    color: white;
    top: 333px;
    /* bottom: 0; */
    margin-right: 15px;
    width: 88.5%;
    }
}
    
</style>
<section id="breadcrumb">
    <div class="container breadcrumb-page">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 breadcrumb-page clearleft clearright">
                <?php 
                    $breadcrumbs = $this->context->breadcrumb;
                    if(count($breadcrumbs) > 0){
                        $i = 0;
                        $len = count($breadcrumbs);
                        foreach($breadcrumbs as $breadcrumb) {
                ?>
                <a href="#" <?php echo $i == 0 ? 'class="remove-padding"' : ''; ?>><?php echo strtoupper(str_replace('-', ' ', $breadcrumb)); ?></a>
                <?php if ($i != $len - 1) { ?>
                    <span>/</span>
                <?php } ?>
                <?php $i++; ?>
                        <?php } ?>
                    <?php } ?>
                <a href="#" class="filter hidden-xs hidden-sm hidden-md hidden-lg" id="filter">
                    <span class="text-filter">FILTER</span>
                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-white.png" id="down-white" style="display: inline;padding-right: 10%;float: right;padding-top: 6%;">
                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-black.png" id="down-black" style="display: none;padding-right: 10%;float: right;padding-top: 6%;">
                </a>
                    <br>
                <div class="arrow-filter-all-product" id="arrow-filter"></div>
                <div class="hidden-xs filter-box-all-product" id="box-filter">
                <div class="row box-parent">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-lg-4 filter-parent right">
                            <div class="radio-btn">
                                <input type="radio" value="all-product" id="rc1" name="sort" checked>
                                <label for="rc1" onclick="">ALL PRODUCTS</label>
                            </div>
                        </div>
                        <div class="col-lg-4 filter-parent center">
                            <div class="radio-btn">
                                <input type="radio" value="new-arrival" id="rc2" name="sort">
                                <label for="rc2" onclick="">NEW ARRIVAL</label>
                            </div>
                        </div>
                        <div class="col-lg-4 filter-parent left">
                            <div class="radio-btn">
                                <input type="radio" value="sale" id="rc3" name="sort">
                                <label for="rc3" onclick="">SALE</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="filter-brand title left brand">BRAND</div>
                            <div id="ex3" class="col-lg-12 filter-parent brand left scroll-custom" style="overflow:scroll;overflow-x: hidden;">
                                <?php
                                $brands = \backend\models\Brands::find()->where(['brand_status' => 'active'])->orderBy('brand_name')->all();
                                $no = 4;
                                foreach ($brands as $row) {
                                    ?>
                                    <div class="checkbox-btn lspace2">
                                        <input class="filter" type="checkbox" value="<?php echo $row->link_rewrite; ?>" id="rc<?php echo $no; ?>" name="brands">
                                        <label for="rc<?php echo $no; ?>" onclick=""><?php echo $row->brand_name; ?></label>
                                    </div>
                                    <?php
                                    $no++;
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="filter-brand title left brand">WATCH SIZE</div>
                            <div class="col-lg-12 filter-parent brand left">
                                <div class="col-lg-12 filter-parent">
                                    <div class="checkbox-btn lspace2">
                                        <input type="checkbox" value="26--30" id="26" name="filter_size">
                                        <label for="26" onclick="">26 - 30</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 filter-parent">
                                    <div class="checkbox-btn lspace2">
                                        <input type="checkbox" value="32--36" id="32" name="filter_size">
                                        <label for="32" onclick="">32 - 36</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 filter-parent">
                                    <div class="checkbox-btn lspace2">
                                        <input type="checkbox" value="38--40" id="38" name="filter_size">
                                        <label for="38" onclick="">38 - 40</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 filter-parent">
                                    <div class="checkbox-btn lspace2">
                                        <input type="checkbox" value="41--47" id="41" name="filter_size">
                                        <label for="41" onclick="">41 - 47</label>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="filter-brand title left brand">BANDWIDTH</div>
                            <div class="col-lg-12 filter-parent brand left">
                                <?php
                                $watches_size = backend\models\ProductFeatureValue::find()->where(['feature_id' => 6])->all();
                                foreach ($watches_size as $row) {
                                    ?>
                                    <div class="col-lg-12 filter-parent">
                                        <div class="checkbox-btn lspace2">
                                            <input type="checkbox" value="<?php echo $row->feature_value_value; ?>" id="<?php echo $row->feature_value_value; ?>" name="filter_bandwidth">
                                            <label for="<?php echo $row->feature_value_value; ?>" onclick=""><?php echo $row->feature_value_name; ?></label>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        $feature = \backend\models\Feature::find()->all();
                        foreach ($feature as $row) {
                            $product_feature_value = backend\models\ProductFeatureValue::find()->where(['feature_id' => $row->feature_id])->orderBy('feature_value_name ASC')->all();
                            if (strtoupper($row->feature_name) != 'SIZE' && strtoupper($row->feature_name) != 'BANDWIDTH' && strtoupper($row->feature_name) != 'WATER RESISTANT') {
                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="filter-brand title left brand"><?php echo strtoupper($row->feature_name); ?></div>
                                    <div class="col-lg-12 filter-parent brand left">
                                        <?php
                                        foreach ($product_feature_value as $roww) {
                                            ?>
                                            <div class="checkbox-btn lspace2">
                                                <input type="checkbox" data-id="<?php echo explode(' ', strtolower(trim($row->feature_name)))[0]; ?>" value="<?php echo strtolower(str_replace(' ', '-', $roww->feature_value_name)); ?>" id="rc<?php echo $no; ?>" name="category">
                                                <label for="rc<?php echo $no; ?>" onclick=""><?php echo $roww->feature_value_name; ?></label>
                                            </div>
                                            <?php
                                            $no++;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="filter-brand title left brand">WATER RESISTANT</div>
                            <div class="col-lg-12 filter-parent brand left">
                                <div class="checkbox-btn lspace2">
                                    <input type="checkbox" data-id="water" value="3-atm" id="rc29" name="category">
                                    <label for="rc29" onclick="">3 ATM</label>
                                </div>
                                <div class="checkbox-btn lspace2">
                                    <input type="checkbox" data-id="water" value="5-atm" id="rc31" name="category">
                                    <label for="rc31" onclick="">5 ATM</label>
                                </div>
                                <div class="checkbox-btn lspace2">
                                    <input type="checkbox" data-id="water" value="8-atm" id="rc32" name="category">
                                    <label for="rc32" onclick="">8 ATM</label>
                                </div>
                                <div class="checkbox-btn lspace2">
                                    <input type="checkbox" data-id="water" value="10-atm" id="rc33" name="category">
                                    <label for="rc33" onclick="">10 ATM</label>
                                </div>
                                <div class="checkbox-btn lspace2">
                                    <input type="checkbox" data-id="water" value="20-atm" id="rc30" name="category">
                                    <label for="rc30" onclick="">20 ATM</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="filter-brand title left brand">PRICE</div>
                            <div class="filter-brand title left brand" style="border-bottom: 0px; padding-top: 2%;">
                                <input id="foo" type="text" class="span2" value="" data-slider-handle="triangle" data-slider-min="300000" data-slider-max="15000000" data-slider-step="10000" data-slider-value="[300000,15000000]"/>
                                <div style="font-family: gotham-light; padding-top: 13%;">
                                    <div id="bar-left" class="pull-left">300.000</div>
                                    <div id="bar-right" class="pull-right">15.000.000</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row box-parent bottom">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-lg-6 col-md-6 col-sm-6 right">
                            <input class="btn-clear" type="reset" value="CLEAR ALL" name="clear" />
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 left">
                            <input class="btn-apply" type="submit" id="apply-filter" value="APPLY" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 breadcrumb-page search-header">
                <span class="gotham-medium fsize-2 search-result-title">SEARCH RESULT</span>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 breadcrumb-page ptop2">
                <span class="gotham-light">YOU SEARCH FOR</span> <span class="gotham-medium">"<?php echo isset($_GET['q']) ? htmlspecialchars(stripslashes(trim($_GET['q']))) : ""; ?>"</span>
            </div>
            <?php if ($searchReference) { ?>
<!--                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 breadcrumb-page ptop1">
                    <?php // echo \common\components\Helpers::generateSearchSuggestion("ark"); ?>
                </div>-->
            <?php } ?>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 breadcrumb-page ptop1">
                <span class="gotham-medium"><?php echo $count; ?> MATCHES FOUND</span>
            </div>
        </div>
    </div>
</section>

<?php if (count($products) > 0) { 
    $now = date("Y-m-d H:i:s");
    ?>
    <section class="hidden-sm" id="product">
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
                            $totalStock = 0;
                            foreach ($productStock as $attribute){
                                $productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
                                if($productattribute != NULL && $attribute->quantity != 0){
                                    $found = TRUE;
                                }
                                $totalStock = $totalStock + $attribute->quantity;
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
                                    if (!empty($product->specificPrice)) {
                                        if ($product->specificPrice->from <= $now && $product->specificPrice->to > $now) {
                                            if(in_array($product->product_id, [3423, 3424])){

                                            }else{
                                            ?>
                                            <div class='pull-right'>
                                                <div class='<?php echo $product->specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                    <span class='text-discount' style=''>
                                                        <?php
														// if custom value label
														if($product->specificPrice->label_type == "custom_value"){
															echo $product->specificPrice->label;
														} else {
															if ($product->specificPrice->reduction_type == 'amount') {
																echo floor($product->specificPrice->reduction / $product->price * 100);
															} else {
																echo $product->specificPrice->reduction;
															}
															echo '%';
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
                                    if (!empty($product->specificPrice)) {
                                        if ($product->specificPrice->from <= $now && $product->specificPrice->to > $now) {
											if($product->specificPrice->label_type == "flash_icon"){
												?>
												 <div class="tag-bellow" style='background-color: #a21d22;position: absolute;bottom: 0px;width: 100%;top:auto;'>
													<div class=''>
														<span class='text-bellow'>
														Flash Sale 
														</span>
													</div>
												</div>
												
												<?php
											}
                                        }
                                    }
                                    ?>
                                        <?php
                                            if($product->productNewArrival->product_newarrival_start_date <= $now && $product->productNewArrival->product_newarrival_end_date >= $now){
                                        ?>
                                            <div class="tag-bellow" style='background-color: #4c757b;position: absolute;bottom: 0px;width: 100%;top:auto;'>
                                                <div class=''>
                                                    <span class='text-bellow'>
                                                    New Arrival
                                                    </span>
                                                </div>
                                            </div>
                                          <?php
                                            
                                            }
                                          

                                          if(in_array($product->product_id, [])){
                                        ?>
                                             <div class="tag-bellow tag-bellow2" style='background-color: #4c757b;position: absolute;bottom: 0px;width: 100%;top:auto;'>
                                                <div class=''>
                                                    <span class='text-bellow'>
                                                    Coming Soon
                                                    </span>
                                                </div>
                                            </div>

                                          <?php
                                            }
                                          ?>
                                          <?php
                                            if(in_array($product->product_id, [3423, 3424])){
                                        ?>
                                             <div class="tag-bellow tag-bellow2" style='background-color: #965c64;position: absolute;bottom: 0px;width: 100%;top:auto;'>
                                                <div class=''>
                                                    <span class='text-bellow'>
                                                    Valentine Collection

                                                    </span>
                                                </div>
                                            </div>

                                          <?php
                                            }
                                          ?>
                                         
                                <?php  
                                if($stock != NULL){
                                ?>
                                <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>_big.jpg?auto=compress,format&fit=max&lossless=true" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                <?php
                                    echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : ''; 
                                ?>
                                <?php 
                                } else {
                                ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>_big.jpg?auto=compress,format&fit=max&lossless=true" class="img-responsive">
                                
                                <?php } ?>
                            </div>
							<input type="hidden" name="productId" value="<?php echo $product->product_id; ?>">
							<input type="hidden" name="productName" value="<?php echo $product->productDetail->name; ?>">
							<input type="hidden" name="productPrice" value="<?php echo $product->price; ?>">
							<input type="hidden" name="brandName" value="<?php echo $product->brands->brand_name; ?>">
							<input type="hidden" name="opt_list" value="<?php echo $breadcrumbs[0] . ' - ' . $breadcrumbs[2]; ?>">
							<input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
							<input type="hidden" name="productPosition" value="<?php echo $i; ?>"> 
                            <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                            <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace2"><?php echo strtoupper($product->productDetail->name); ?></span></div> 
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
                            <!--<div class="col-lg-12 col-md-12 col-sm-12 product product-price"><span class="lspace2">IDR <?php //echo \common\components\Helpers::getPriceFormat($product->price); ?></span></div> -->
                            <?php
                                if($totalStock == 0){
                                    ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
                                    Out of Stock
                                    </div>
                                    <?php
                                }else{
                                    if(($product->price - $discount) > 500000){
                                    ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment">
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
    </section>
    <section class="hidden-lg hidden-md hidden-xs" id="product">
        <?php $j = 1; ?>
        <?php foreach ($products as $product) { ?>
        <?php if ($j == 1 || $j == 4 || $j == 7 || 
                  $j == 10 || $j == 13 || $j == 16 || 
                  $j == 19 || $j == 22 || $j == 25 ||
                  $j == 28 || $j == 31 || $j == 34 ||
                  $j == 37 || $j == 40 || $j == 43 ||
                  $j == 46 || $j == 49 || $j == 52 ||
                  $j == 55 || $j == 58 || $j == 61 ||
                  $j == 64 || $j == 67 || $j == 70 ) { ?>
                <div class="hidden-lg hidden-md hidden-xs container product-box clearleft">
                    <div class="row">
            <?php } ?>
                    <div class="col-sm-4 <?php echo $j % 2 == 0 ? 'pleft75' : 'pright75'; ?>">
                        <?php  
                            $stock = backend\models\ProductStock::findOne(['product_id' => $product->product_id]);
                            $productStock = backend\models\ProductStock::findAll(['product_id' => $product->product_id]);
                            $found = FALSE;
                            $totalStock = 0;
                            foreach ($productStock as $attribute){
                                $productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
                                if($productattribute != NULL && $attribute->quantity != 0){
                                    $found = TRUE;
                                }
                                $totalStock = $totalStock + $attribute->quantity;
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
                                                  if(in_array($product->product_id, [3423, 3424])){

                                                  }else{
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
                                             <div class="tag-bellow" style='background-color: #4c757b;position: absolute;bottom: 0px;width: 100%;top:auto;'>
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
                                <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg?auto=compress,format&fit=max&lossless=true" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                <?php
                                    echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : ''; 
                                ?>
                                <?php 
                                } else {
                                ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg?auto=compress,format&fit=max&lossless=true" class="img-responsive">
                                
                                <?php } ?>
                            </div>
							<input type="hidden" name="productId" value="<?php echo $product->product_id; ?>">
							<input type="hidden" name="productName" value="<?php echo $product->productDetail->name; ?>">
							<input type="hidden" name="productPrice" value="<?php echo $product->price; ?>">
							<input type="hidden" name="brandName" value="<?php echo $product->brands->brand_name; ?>">
							<input type="hidden" name="opt_list" value="<?php echo $breadcrumbs[0] . ' - ' . $breadcrumbs[2]; ?>">
							<input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
							<input type="hidden" name="productPosition" value="<?php echo $i; ?>"> 
                            <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                            <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace2"><?php echo strtoupper($product->productDetail->name); ?></span></div>
                            <?php
                                // if product has discount
                                $spesificPrice = backend\models\SpecificPrice::findOne(['product_id' => $product->product_id]);
                                $discount = 0;
                                $now = date('Y-m-d H:i:s');
                                if ($spesificPrice != null) {
                                    ?>
                                    <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>

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
                                if($totalStock == 0){
                                    ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
                                    Out of Stock
                                    </div>
                                    <?php
                                }else{
                                    if(($product->price - $discount) > 500000){
                                    ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment">
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
                    if ($j % 3 == 0) {
                        echo '<div class="hidden-sm clearfix"></div>';
                    }
                    ?>
                    <?php if ($j == 3 || $j == 6 || $j == 9 || $j == 12 || 
                              $j == 15 || $j == 18 || $j == 21 || $j == 24 ||
                              $j == 27 || $j == 30 || $j == 33 || $j == 36 || $j == 39 ||
                              $j == 42 || $j == 45 || $j == 48 || $j == 51 || $j == 54 ||
                              $j == 57 || $j == 60 || $j == 63 || $j == 66 || $j == 69 ||
                              $j == 72 ) { ?>    
                    </div>
                </div>
            <?php } ?>
        <?php $j++; ?>
        <?php } ?>
    </section>
    <?php //if($count > 4) {  ?>
    <section id="all-product-footer">
        <div class="container product-box">
            <div class="row font-paging">
                <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs pagination"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright">
                    <div class="hidden-lg col-md-8 col-sm-8 col-xs-6 remove-padding clearleft pleftpagemobileshow">
                        <span class="gotham-light position-left">SHOW</span>
                        <span class="gotham-<?php echo!isset($_GET['limit']) || $_GET['limit'] == 20 ? 'medium' : 'light'; ?> padd-4 position-left">
                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params .'&q='.$q.'&page=1&limit=20'; ?>">20</a>
                        </span>
                        <span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 40 ? 'medium' : 'light'; ?> padd-4 position-left">
                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params .'&q='.$q.'&page=1&limit=40'; ?>">40</a>
                        </span>
                        <span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 60 ? 'medium' : 'light'; ?> padd-4 position-left">
                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params .'&q='.$q.'&page=1&limit=60'; ?>">60</a>
                        </span>
                        <span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 100 ? 'medium' : 'light'; ?> padd-4 position-left">
                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params .'&q='.$q.'&page=1&limit=100'; ?>">100</a>
                        </span>
                    </div>
                    <div class="col-lg-8 hidden-md hidden-sm hidden-xs remove-padding clearleft pleftpage-4">
                        <span class="gotham-light position-left">
                            <?php echo!isset($_GET['page']) || $_GET['page'] == 1 ? 1 : (($_GET['limit'] * $_GET['page']) - $_GET['limit']) + 1; ?>
                            - 
                            <?php echo!isset($_GET['limit']) ? 20 : ($_GET['limit'] * $_GET['page']); ?>
                            From <?php echo $count; ?> Products
                        </span>
                    </div>
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

                        if($total_page > 8){
                            if($current < 4){        
                            ?>
                            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
                                   
                                <?php

                                    for($i = 1;$i<=5;$i++){
                                        ?>
                                        <span class="gotham-medium pleft13-5 remove-padding">
                                            
                                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>"><?php echo $i; ?></a>
                                        </span>
                                        <?php
                                    }
                                ?>
                                <span class="gotham-light pleftmaxbotton remove-padding">
                                                            ....
                                                        </span>
                                                        <span class="gotham-medium pleft13-5 remove-padding">
                                            
                                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $total_page; ?>&amp;limit=<?php echo $limit; ?>"><?php echo $total_page; ?></a>
                                        </span>
                                         <span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
                                                            <a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>">NEXT</a>
                                                        </span>
                                                        <span class="hidden-lg hidden-mdgotham-light pleft8-5 pleft-mobile-4">
                                                            <a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
                                                        </span>
                                
                            </div>

                            <?php

                            } if(($current >= 4) && ($current < $total_page-3)){
                                ?>
                                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
                                    <span class="hidden-sm hidden-xs gotham-light pleft18 remove-padding">
                                                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>">PREV</a>
                                                        </span>
                                                        <span class="hidden-lg hidden-md gotham-light pleft18 remove-padding">
                                                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
                                                        </span>
                                                        <span class="hidden-sm hidden-xs gotham-light pleft18 remove-padding">
                                                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=1&amp;limit=<?php echo $limit; ?>">1</a>
                                                        </span>
                                                        <span class="gotham-light pleftmaxbotton remove-padding">
                                                            ....
                                                        </span>
                                <?php
                                
                                    for($i= $current - 1;$i<=$current + 1;$i++){
                                        ?>
                                        <span class="gotham-medium pleft13-5 remove-padding">
                                            
                                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>"><?php echo $i; ?></a>
                                        </span>
                                        <?php
                                    }
                                ?>
                                <span class="gotham-light pleftmaxbotton remove-padding">
                                                            ....
                                                        </span>
                                                        <span class="gotham-medium pleft13-5 remove-padding">
                                            
                                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $total_page; ?>&amp;limit=<?php echo $limit; ?>"><?php echo $total_page; ?></a>
                                        </span>
                                         <span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
                                                            <a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>">NEXT</a>
                                                        </span>
                                                        <span class="hidden-lg hidden-mdgotham-light pleft8-5 pleft-mobile-4">
                                                            <a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
                                                        </span>
                                
                            </div>
                                <?php
                             }if($current >= $total_page-3){
                                ?>
                                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
                                    <span class="hidden-sm hidden-xs gotham-light pleft18 remove-padding">
                                                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>">PREV</a>
                                                        </span>
                                                        <span class="hidden-lg hidden-md gotham-light pleft18 remove-padding">
                                                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
                                                        </span>
                                                        <span class="hidden-sm hidden-xs gotham-light pleft18 remove-padding">
                                                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=1&amp;limit=<?php echo $limit; ?>">1</a>
                                                        </span>
                                                        <span class="gotham-light pleftmaxbotton remove-padding">
                                                            ....
                                                        </span>
                                <?php
                                
                                    for($i= $total_page - 3;$i<=$total_page;$i++){
                                        ?>
                                        <span class="gotham-medium pleft13-5 remove-padding">
                                            
                                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>"><?php echo $i; ?></a>
                                        </span>
                                        <?php
                                    }
                                ?>
                                    </div>
                                <?php
                             }
                        }if($total_page <= 4){
                            ?>
                                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
                                <?php
                                for($i= 1;$i<=$total_page;$i++){
                                        ?>
                                        
                                            <span class="gotham-medium pleft13-5 remove-padding">
                                                
                                                <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>"><?php echo $i; ?></a>
                                            </span>
                                        
                                        <?php
                                    }
                                    ?>
                                    </div>
                           <?php

                        }if(($total_page > 4) && ($total_page <= 8)){
                            if($total_page == 5){
                                ?>
                                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
                                <?php
                                for($i= 1;$i<=$total_page;$i++){
                                        ?>
                                        
                                            <span class="gotham-medium pleft13-5 remove-padding">
                                                
                                                <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>"><?php echo $i; ?></a>
                                            </span>
                                        
                                        <?php
                                    }
                                    ?>
                                    </div>
                                    <?php
                            }else{

                            
                            if($current < 4){
                                ?>
                            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
                                   
                                <?php

                                    for($i = 1;$i<=5;$i++){
                                        ?>
                                        <span class="gotham-medium pleft13-5 remove-padding">
                                            
                                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>"><?php echo $i; ?></a>
                                        </span>
                                        <?php
                                    }
                                ?>
                                <span class="gotham-light pleftmaxbotton remove-padding">
                                                            ....
                                                        </span>
                                                        <span class="gotham-medium pleft13-5 remove-padding">
                                            
                                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $total_page; ?>&amp;limit=<?php echo $limit; ?>"><?php echo $total_page; ?></a>
                                        </span>
                                         <span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
                                                            <a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>">NEXT</a>
                                                        </span>
                                                        <span class="hidden-lg hidden-mdgotham-light pleft8-5 pleft-mobile-4">
                                                            <a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
                                                        </span>
                                
                            </div>

                            <?php
                            }else{

                                 ?>
                                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
                                    <span class="hidden-sm hidden-xs gotham-light pleft18 remove-padding">
                                                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>">PREV</a>
                                                        </span>
                                                        <span class="hidden-lg hidden-md gotham-light pleft18 remove-padding">
                                                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
                                                        </span>
                                                        <span class="hidden-sm hidden-xs gotham-light pleft18 remove-padding">
                                                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=1&amp;limit=<?php echo $limit; ?>">1</a>
                                                        </span>
                                                        <span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
                                                            ....
                                                        </span>
                                <?php
                                
                                    for($i= $total_page - 4;$i<=$total_page;$i++){
                                        ?>
                                        <span class="gotham-medium pleft13-5 remove-padding">
                                            
                                            <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&q=<?php echo $q;?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>"><?php echo $i; ?></a>
                                        </span>
                                        <?php
                                    }
                                ?>
                                    </div>
                                <?php

                            }
                         }
                        }
                    




                     ?>
                </div>
            </div>
        </div>
    </section>
    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icon_top.png" class="scrollup"></a>
<?php } ?>
<?php
//}    ?>