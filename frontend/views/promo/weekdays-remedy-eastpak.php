<?php
$breadcrumbs = $this->context->breadcrumb;
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
        "list": "Weekdays - Remedy Eastpak"
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
<!--<section id="breadcrumb-bundling">
    <div class="container">
        <div class="row">
        </div>
    </div>
</section>-->
<section class="ptop1">
    <div class="container">
        <div class="row">
            <!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright pbottom5 salebrandbannerview">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ptop2 remove-padding clearleft clearright ">
                    <div class='col-lg-6 col-md-6 col-sm-6 ptop2 col-xs-6 remove-padding-right padding-left-1-5'>
                        <a href="<?php echo \yii\helpers\Url::base(); ?>/watchsale">
                            <img src='<?php echo \yii\helpers\Url::base(); ?>/img/promo/endsale/Watches (Jembatan).jpg' class="img-responsive">
                        </a>
                    </div>
                    <div class='col-lg-6 col-md-6 col-sm-6 ptop2 col-xs-6 remove-padding-right padding-left-1-5'>
                        <a href="<?php echo \yii\helpers\Url::base(); ?>/accessoriesale">
                            <img src='<?php echo \yii\helpers\Url::base(); ?>/img/promo/endsale/Essentials (Jembatan).jpg' class="img-responsive">
                        </a>
                    </div>
                </div>
            </div>-->
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright mbottom3 mtop-8em-mobile">
				<img src="https://thewatch.co/img/promo/lastcallday/bundle-package-banner.jpg" class="img-responsive">
			</div>
			<div class="clearfix"></div>
			<div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearright clearleft pleft-5-dwpetite">
				<div class="brand-name-full" style="font-family: gotham-light;">
					Bundle Package
				</div>
				<div class="brand-description">
					Beli lebih banyak dan dapatkan diskon lebih besar! <br> <br>
					Beli 1 dan masukkan Kode Voucher <span style="font-weight: 700; font-family: gotham-medium;">TWCWR1</span> saat check out untuk mendapatkan Diskon 40% <br> <br>
					Beli 2 dan masukkan Kode Voucher <span style="font-weight: 700; font-family: gotham-medium;">TWCWR2</span> saat check out untuk mendapatkan Diskon 50% <br> <br>
					Beli 3 atau lebih dan masukkan Kode Voucher <span style="font-weight: 700; font-family: gotham-medium;">TWCWR3</span> saat check out untuk mendapatkan Diskon 60% <br> <br>
				</div>
			</div>
			<div class="hidden-lg hidden-md hidden-sm col-xs-12 clearright pleft-5-dwpetite">
				<div class="brand-name-full" style="font-family: gotham-light;">
					Bundle Package
				</div>
				<div class="brand-description" style="text-align: left;">
					Beli lebih banyak dan dapatkan diskon lebih besar! <br><br>
					Beli 1 dan masukkan Kode Voucher <span style="font-weight: 700; font-family: gotham-medium;">TWCWR1</span> saat check out untuk mendapatkan Diskon 40%. <br><br>
					Beli 2 dan masukkan Kode Voucher <span style="font-weight: 700; font-family: gotham-medium;">TWCWR2</span> saat check out untuk mendapatkan Diskon 50%. <br><br>
					Beli 3 atau lebih dan masukkan Kode Voucher <span style="font-weight: 700; font-family: gotham-medium;">TWCWR3</span> saat check out untuk mendapatkan Diskon 60%. <br>
				</div>
			</div>
            <section id="breadcrumb">
                <div class="container breadcrumb-page">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 breadcrumb-page clearleft clearright">
                            <div class="fleft clearleft pright2 hidden-xs hidden-sm hidden-md">SHOW</div>
                            <a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?page=1&limit=20'; ?>" class="fleft pright2 hidden-xs hidden-sm hidden-md"><span class="gotham-<?php echo!isset($_GET['limit']) || $_GET['limit'] == 20 ? 'medium' : 'light'; ?>">20</span></a>
                            <a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?page=1&limit=40'; ?>" class="fleft pright2 hidden-xs hidden-sm hidden-md"><span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 40 ? 'medium' : 'light'; ?>">40</span></a>
                            <a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?page=1&limit=60'; ?>" class="fleft pright2 hidden-xs hidden-sm hidden-md"><span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 60 ? 'medium' : 'light'; ?>">60</span></a>
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
                                                            <div class='<?php echo $product->specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                                <span class='text-discount' style=''>
                                                                    <?php
																	// if custom value label
																	if($product->specificPrice->label_type == "custom_value"){
																		echo $product->specificPrice->label;
																	} else {
																		if ($product->specificPrice->reduction_type == 'amount') {
																			echo round($product->specificPrice->reduction / 1000, 2);
																		} else {
																			echo $product->specificPrice->reduction;
																		}
																		echo $product->specificPrice->reduction_type == 'percent' ? '%' : 'k';
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
                                            if($stock != NULL){
                                            ?>
                                            <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                            <?php
                                                echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : ''; 
                                            ?>
                                            <?php 
                                            } else {
                                            ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive">

                                            <?php } ?>
                                        </div>
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
                                            <span class="discount-price mleft2 discountview2">
											IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?>
											</span>
                                            <input type="hidden" class="price" name="price" value="<?php echo $product->price - $discount; ?>">
                                            <?php } else { ?>
                                            USD <?php echo $product->price_usd - $discount; ?>
                                            <input type="hidden" class="price" name="price" value="<?php echo $product->price_usd - $discount; ?>">
                                            <?php } ?>
                                            

                                            <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                                        </div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
											<?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
											<span class="mleft2 discountview2">
												IDR <?php echo \common\components\Helpers::getPriceFormat($product->price - $discount); ?>
											</span>
											<?php } ?>
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
                                        <!--<div class="col-lg-12 col-md-12 col-sm-12 product product-price"><span class="lspace2">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?></span></div> -->
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
                                                            <div class='<?php echo $product->specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                                <span class='text-discount' style=''>
                                                                    <?php
																	// if custom value label
																	if($product->specificPrice->label_type == "custom_value"){
																		echo $product->specificPrice->label;
																	} else {
																		if ($product->specificPrice->reduction_type == 'amount') {
																			echo round($product->specificPrice->reduction / 1000, 2);
																		} else {
																			echo $product->specificPrice->reduction;
																		}
																		echo $product->specificPrice->reduction_type == 'percent' ? '%' : 'k';
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
                                            if($stock != NULL){
                                            ?>
                                            <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                            <?php
                                                echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : ''; 
                                            ?>
                                            <?php 
                                            } else {
                                            ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive">

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
                <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs pagination"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright">
                    <div class="hidden-lg col-md-8 col-sm-8 col-xs-6 remove-padding clearleft pleftpagemobilepag2">
                        <span class="gotham-light position-left">SHOW</span>
                        <span class="gotham-<?php echo!isset($_GET['limit']) || $_GET['limit'] == 20 ? 'medium' : 'light'; ?> padd-4 position-left">
                            <a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?page=1&limit=20'; ?>">20</a>
                        </span>
                        <span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 40 ? 'medium' : 'light'; ?> padd-4 position-left">
                            <a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?page=1&limit=40'; ?>">40</a>
                        </span>
                        <span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 60 ? 'medium' : 'light'; ?> padd-4 position-left">
                            <a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?page=1&limit=60'; ?>">60</a>
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
                    $total_page = ceil($count / $limit);
					
					if(ceil($count/$limit)==1){
						if (!isset($_GET['page'])|| $_GET['page'] == 1){
							
						}
					/*jika jumlah halamannya 2*/
					
					}elseif(ceil($count/$limit)==2){					
					?>
						<?php
						if (!isset($_GET['page']) && !isset($_GET['limit'])) {
						?>
							<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
								<span class="gotham-medium pleft13-5 remove-padding">
									<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=1&amp;limit=20">1</a>
								</span>
								<span class="gotham-light pleft13-5 pleft-mobile-4">
									<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=20">2</a>
								</span>
								<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
									<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=20">NEXT</a>
								</span>
								<span class="hidden-lg hidden-mdgotham-light pleft13-5 pleft-mobile-4 nexticonpagin">
									<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=20"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
								</span>
							</div>
						<?php 
						} elseif (!isset($_GET['page']) || $_GET['page'] == 1) { 
						?>
							<?php 
							// if user filter something
							if(isset($_GET['brands']) && isset($_GET['sort'])){ 
							?>
								<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright">

									<span class="gotham-medium pleft13-5 remove-padding">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>">2</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
									</span>
								</div>
							<?php 
							} else { 
							?>
								<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

									<span class="gotham-medium pleft13-5 remove-padding">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>">2</a>
									</span>
									<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
									</span>
									<span class="hidden-lg hidden-md gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
									</span>
								</div>
							<?php 
							} 
							?>
						<?php 
						} else { 
						?>
							<?php
							$current = $_GET['page'];
							?>
							<?php 
							if ($current != $total_page) { 
							?>
								<?php 
								// if user filter something
								if(isset($_GET['brands']) && isset($_GET['sort'])){ 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright">
										<span class="gotham-light pleft18 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
										</span>
									</div>
								<?php 
								}
								?>
							<?php 
							} else { 
							?>
								<?php 
								// if user filter something
								if(isset($_GET['brands']) && isset($_GET['sort'])){ 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright">
										<span class="gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
										</span>
									</div>    
								<?php 
								} else { 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
										<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
										</span>
										<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
										</span>
									</div>  
								<?php 
								} 
								?>
							<?php 
							} 
							?>
						<?php 
						} 
						?>
					<?php
					}elseif(ceil($count/$limit)==3){
					?>
						<?php
						if (!isset($_GET['page']) && !isset($_GET['limit'])) {
						?>
							<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

								<span class="gotham-medium pleft13-5 remove-padding">
									<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=1&amp;limit=20">1</a>
								</span>
								<span class="gotham-light pleft13-5 pleft-mobile-4">
									<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=20">2</a>
								</span>
								<span class="gotham-light pleft13-5 pleft-mobile-4">
									<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=3&amp;limit=20">3</a>
								</span>
								<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
									<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=20">NEXT</a>
								</span>
								<span class="hidden-lg hidden-mdgotham-light pleft13-5 pleft-mobile-4 nexticonpagin">
									<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=20"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
								</span>
							</div>
						<?php 
						} elseif (!isset($_GET['page']) || $_GET['page'] == 1) { 
						?>
							<?php 
							// if user filter something
							if(isset($_GET['brands']) && isset($_GET['sort'])){ 
							?>
								<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright">

									<span class="gotham-medium pleft13-5 remove-padding">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>">2</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=3&amp;limit=<?php echo $_GET['limit']; ?>">3</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
									</span>
								</div>
							<?php 
							} else { 
							?>
								<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

									<span class="gotham-medium pleft13-5 remove-padding">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>">2</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=3&amp;limit=<?php echo $_GET['limit']; ?>">3</a>
									</span>
									<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
									</span>
									<span class="hidden-lg hidden-md gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
									</span>
								</div>
							<?php 
							} 
							?>
						<?php 
						} else { 
						?>
							<?php
							$current = $_GET['page'];
							?>
							<?php 
							if ($current != $total_page) { 
							?>
								<?php 
								// if user filter something
								if(isset($_GET['brands']) && isset($_GET['sort'])){ 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright">
										<span class="gotham-light pleft18 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
										</span>
									</div>
								<?php 
								} else { 
								?>
									
										<?php 
										if($_GET['page'] == 2){ 
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
												<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
												</span>
											</div>
										<?php 
										}
										?>
								<?php 
								} 
								?>
							<?php 
							} else { 
							?>
								<?php 
								// if user filter something
								if(isset($_GET['brands']) && isset($_GET['sort'])){ 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright">
										<span class="gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 2; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
										</span>
									</div>    
								<?php 
								} else { 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
										<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
										</span>
										<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 2; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
										</span>
									</div>  
								<?php 
								} 
								?>
							<?php 
							} 
							?>
						<?php 
						} 
						?>
					<?php
					}elseif(ceil($count/$limit)==4){
					?>
						<?php
						if (!isset($_GET['page']) && !isset($_GET['limit'])) {
						?>
							<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

								<span class="gotham-medium pleft13-5 remove-padding">
									<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=1&amp;limit=20">1</a>
								</span>
								<span class="gotham-light pleft13-5 pleft-mobile-4">
									<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=20">2</a>
								</span>
								<span class="gotham-light pleft13-5 pleft-mobile-4">
									<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=3&amp;limit=20">3</a>
								</span>
								<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
									<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=4&amp;limit=20">4</a>
								</span>
								<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
									<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=20">NEXT</a>
								</span>
								<span class="hidden-lg hidden-mdgotham-light pleft13-5 pleft-mobile-4 nexticonpagin">
									<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=20"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
								</span>
							</div>
						<?php 
						} elseif (!isset($_GET['page']) || $_GET['page'] == 1) { 
						?>
							<?php 
							// if user filter something
							if(isset($_GET['brands']) && isset($_GET['sort'])){ 
							?>
								<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright">

									<span class="gotham-medium pleft13-5 remove-padding">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>">2</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=3&amp;limit=<?php echo $_GET['limit']; ?>">3</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=3&amp;limit=<?php echo $_GET['limit']; ?>">4</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
									</span>
								</div>
							<?php 
							} else { 
							?>
								<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
									<span class="gotham-medium pleft13-5 remove-padding">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>">2</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=3&amp;limit=<?php echo $_GET['limit']; ?>">3</a>
									</span>
									<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=4&amp;limit=<?php echo $_GET['limit']; ?>">4</a>
									</span>
									<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
									</span>
									<span class="hidden-lg hidden-md gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
									</span>
								</div>
							<?php 
							} 
							?>
						<?php 
						} else { 
						?>
							<?php
							$current = $_GET['page'];
							?>
							<?php 
							if ($current != $total_page) { 
							?>
								<?php 
								// if user filter something
								if(isset($_GET['brands']) && isset($_GET['sort'])){ 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright">
										<span class="gotham-light pleft18 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 2; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
										</span>
									</div>
								<?php 
								} else { 
								?>
									
										<?php 
										if($_GET['page'] == 2){ 
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
												<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 2; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
												</span>
											</div>
										<?php 
										}elseif($_GET['page'] == 3) { 
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
												<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>             
												<span class="hidden-lg hidden-md gotham-light pleft13-5 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
													..
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo ($current - 2); ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 2; ?></a>
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
												</span>
											</div>
										<?php 
										}
										?>
								<?php 
								} 
								?>
							<?php 
							} else { 
							?>
								<?php 
								// if user filter something
								if(isset($_GET['brands']) && isset($_GET['sort'])){ 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright">
										<span class="gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current - 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 3; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 2; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
										</span>
									</div>    
								<?php 
								} else { 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
										<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
										</span>
										<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current - 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 3; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 2; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
										</span>
									</div>  
								<?php 
								} 
								?>
							<?php 
							} 
							?>
						<?php 
						} 
						?>
					<?php
					}else{
					?>
						<?php
						if (!isset($_GET['page']) && !isset($_GET['limit'])) {
						?>
							<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

								<span class="gotham-medium pleft13-5 remove-padding">
									<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=1&amp;limit=20">1</a>
								</span>
								<span class="gotham-light pleft13-5 pleft-mobile-4">
									<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=20">2</a>
								</span>
								<span class="gotham-light pleft13-5 pleft-mobile-4">
									<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=3&amp;limit=20">3</a>
								</span>
								<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
									<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=4&amp;limit=20">4</a>
								</span>
								<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
									<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=5&amp;limit=20">5</a>
								</span>
								<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
									..
								</span>
								<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
									....
								</span>
								<span class="hidden-sm hidden-xs gotham-light pleft13-5 remove-padding">
									<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $total_page;?>&amp;limit=20"><?php echo $total_page;?></a>
								</span>
								
								<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
									<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=20">NEXT</a>
								</span>
								<span class="hidden-lg hidden-mdgotham-light pleft13-5 pleft-mobile-4 nexticonpagin">
									<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=20"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
								</span>
							</div>
						<?php 
						} elseif (!isset($_GET['page']) || $_GET['page'] == 1) { 
						?>
							<?php 
							// if user filter something
							if(isset($_GET['brands']) && isset($_GET['sort'])){ 
							?>
								<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright">

									<span class="gotham-medium pleft13-5 remove-padding">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>">2</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=3&amp;limit=<?php echo $_GET['limit']; ?>">3</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
									</span>
								</div>
							<?php 
							} else { 
							?>
								<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

									<span class="gotham-medium pleft13-5 remove-padding">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>">2</a>
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=3&amp;limit=<?php echo $_GET['limit']; ?>">3</a>
									</span>
									<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=4&amp;limit=<?php echo $_GET['limit']; ?>">4</a>
									</span>
									<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=5&amp;limit=<?php echo $_GET['limit']; ?>">5</a>
									</span>
									<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
										..
									</span>
									<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
										....
									</span>
									<span class="gotham-light pleft13-5 pleft-mobile-4">
										<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $total_page;?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $total_page;?></a>
									</span>
									<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
									</span>
									<span class="hidden-lg hidden-md gotham-light pleft13-5 pleft-mobile-4">
										<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
									</span>
								</div>
							<?php 
							} 
							?>
						<?php 
						} else { 
						?>
							<?php
							$current = $_GET['page'];
							?>
							<?php 
							if ($current != $total_page) { 
							?>
								<?php 
								// if user filter something
								if(isset($_GET['brands']) && isset($_GET['sort'])){ 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright">
										<span class="gotham-light pleft18 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
										</span>
									</div>
								<?php 
								} else { 
								?>
									
										<?php 
										if($_GET['page'] == 2){ 
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
												<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 2; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current + 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 3; ?></a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
													..
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
													....
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $total_page; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $total_page; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
												</span>
											</div>
										<?php 
										}elseif($_GET['page'] == 3) { 
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
												<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>             
												<span class="hidden-lg hidden-md gotham-light pleft13-5 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
													..
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo ($current - 2); ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 2; ?></a>
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 2; ?></a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
													..
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
													....
												</span>
												<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $total_page; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $total_page; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
												</span>
											</div>
										<?php 
										}elseif($_GET['page'] == ($total_page-1)){ 
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
												<span class="hidden-sm hidden-xs gotham-light pleft18 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft18 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>
												<span class="gotham-light pleft13-5 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
													..
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
													....
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $total_page - 4; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $total_page - 4; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $total_page - 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $total_page - 3; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $total_page - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $total_page - 2; ?></a>
												</span>
												<span class="gotham-medium pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
												</span>
											</div>
										<?php 
										}elseif($_GET['page'] == ($total_page-2)){
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
												<span class="hidden-sm hidden-xs gotham-light pleft18 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft18 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>
												<span class="gotham-light pleft13-5 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
													..
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
													....
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $total_page - 4; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $total_page - 4; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $total_page - 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $total_page - 3; ?></a>
												</span>
												<span class="gotham-medium pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 2; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
												</span>
											</div>
										<?php 
										}elseif($_GET['page'] == ($total_page-3)){
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
												<span class="hidden-sm hidden-xs gotham-light pleft18 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft18 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>
												<span class="gotham-light pleft13-5 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
													..
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
													....
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $total_page - 4; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $total_page - 4; ?></a>
												</span>
												<span class="gotham-medium pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 2; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current + 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 3; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
												</span>
											</div>   
										<?php 
										}else{ 
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage-3 pleftpagemobilepag3">
												<span class="hidden-sm hidden-xs gotham-light pleft18 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft18 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>
												<span class="gotham-light pleft13-5 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
													..
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
													....
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo ($current - 2); ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 2; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 2; ?></a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
													..
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
													....
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $total_page; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $total_page; ?></a>
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
												</span>
											</div>
										<?php 
										} 
										?>
								<?php 
								} 
								?>
							<?php 
							} else { 
							?>
								<?php 
								// if user filter something
								if(isset($_GET['brands']) && isset($_GET['sort'])){ 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright">
										<span class="gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 2; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
										</span>
									</div>    
								<?php 
								} else { 
								?>
									<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
										<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
										</span>
										<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
										</span>
										<span class="gotham-light pleft13-5 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
										</span>
										<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
											..
										</span>
										<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
											....
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current - 4; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 4; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current - 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 3; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 2; ?></a>
										</span>
										<span class="gotham-light pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
										</span>
										<span class="gotham-medium pleft8-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/weekdays-remedy'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
										</span>
									</div>  
								<?php 
								} 
								?>
							<?php 
							} 
							?>
						<?php 
						} 
						?>
					<?php
					}
					?>
					
					
                </div>
            </div>
        </div>
    </section>
    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icon_top.png" class="scrollup"></a>
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
<style>
	@media only screen and (min-width : 768px) {
		.pleft-5-dwpetite { padding-top: 2%; margin-bottom: 6%; }
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
	}
</style>