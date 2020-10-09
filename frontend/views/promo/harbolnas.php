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
        "list": "Landing Page Promo Harbolnas"
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
<section class="ptop1" style="padding-bottom:5px;">
    <div class="container">
        <div class="row">
            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/harbolnas.jpg" class="img-responsive">
            </div>
    </div>
</section>
<section class="ptop1" style="padding-bottom:5px;">
    <div class="container">
        <div class="row">
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
								if (!empty($product->specificPrice)) {
									if ($product->specificPrice->from <= $now && $product->specificPrice->to > $now) {
										?>
										 <div class="tag-bellow" style='background-color: #ae4a3b;'>
											<div class=''>
												<span class='text-bellow'>
												Sale 
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
													?> Off
												</span>
											</div>
										</div>
										
										<?php
									}
								}
								?>
									<?php
										if($product->productNewArrival->product_newarrival_start_date <= $now && $product->productNewArrival->product_newarrival_end_date >= $now){
									?>
										 <div class="tag-bellow" style='background-color: #4c757b;'>
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
									
										<?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
										<span class="mleft2 discountview2">
											<span class="discount-price-real">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price - $discount); ?></span>
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
								if (!empty($product->specificPrice)) {
									if ($product->specificPrice->from <= $now && $product->specificPrice->to > $now) {
										?>
										 <div class="tag-bellow" style='background-color: #ae4a3b;'>
											<div class=''>
												<span class='text-bellow'>
												Sale 
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
													?> Off
												</span>
											</div>
										</div>
										
										<?php
									}
								}
								?>
									<?php
										if($product->productNewArrival->product_newarrival_start_date <= $now && $product->productNewArrival->product_newarrival_end_date >= $now){
									?>
										 <div class="tag-bellow" style='background-color: #4c757b;'>
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
			<section id="all-product-footer">
				<div class="container product-box">
					<div class="row font-paging">
						<div class="col-lg-12 col-md-12 col-sm-12 hidden-xs pagination"></div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright">
							<div class="hidden-lg col-md-8 col-sm-8 col-xs-6 remove-padding clearleft pleftpagemobilepag2">
								<span class="gotham-light position-left">SHOW</span>
								<span class="gotham-<?php echo!isset($_GET['limit']) || $_GET['limit'] == 20 ? 'medium' : 'light'; ?> padd-4 position-left">
									<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?page=1&limit=20'; ?>">20</a>
								</span>
								<span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 40 ? 'medium' : 'light'; ?> padd-4 position-left">
									<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?page=1&limit=40'; ?>">40</a>
								</span>
								<span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 60 ? 'medium' : 'light'; ?> padd-4 position-left">
									<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?page=1&limit=60'; ?>">60</a>
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
											<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=1&amp;limit=20">1</a>
										</span>
										<span class="gotham-light pleft13-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=20">2</a>
										</span>
										<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
											<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=20">NEXT</a>
										</span>
										<span class="hidden-lg hidden-mdgotham-light pleft13-5 pleft-mobile-4 nexticonpagin">
											<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=20"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
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
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
											</span>
											<span class="gotham-light pleft13-5 pleft-mobile-4">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>">2</a>
											</span>
											<span class="gotham-light pleft13-5 pleft-mobile-4">
												<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
											</span>
										</div>
									<?php 
									} else { 
									?>
										<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

											<span class="gotham-medium pleft13-5 remove-padding">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
											</span>
											<span class="gotham-light pleft13-5 pleft-mobile-4">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>">2</a>
											</span>
											<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
												<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
											</span>
											<span class="hidden-lg hidden-md gotham-light pleft13-5 pleft-mobile-4">
												<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
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
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
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
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
												</span>
											</div>    
										<?php 
										} else { 
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
												<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
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
											<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=1&amp;limit=20">1</a>
										</span>
										<span class="gotham-light pleft13-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=20">2</a>
										</span>
										<span class="gotham-light pleft13-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=3&amp;limit=20">3</a>
										</span>
										<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
											<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=20">NEXT</a>
										</span>
										<span class="hidden-lg hidden-mdgotham-light pleft13-5 pleft-mobile-4 nexticonpagin">
											<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=20"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
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
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
											</span>
											<span class="gotham-light pleft13-5 pleft-mobile-4">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>">2</a>
											</span>
											<span class="gotham-light pleft13-5 pleft-mobile-4">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=3&amp;limit=<?php echo $_GET['limit']; ?>">3</a>
											</span>
											<span class="gotham-light pleft13-5 pleft-mobile-4">
												<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
											</span>
										</div>
									<?php 
									} else { 
									?>
										<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

											<span class="gotham-medium pleft13-5 remove-padding">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
											</span>
											<span class="gotham-light pleft13-5 pleft-mobile-4">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>">2</a>
											</span>
											<span class="gotham-light pleft13-5 pleft-mobile-4">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=3&amp;limit=<?php echo $_GET['limit']; ?>">3</a>
											</span>
											<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
												<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
											</span>
											<span class="hidden-lg hidden-md gotham-light pleft13-5 pleft-mobile-4">
												<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
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
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
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
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
														</span>
														<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
														</span>
														<span class="gotham-medium pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
														</span>
														<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
															<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
															<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
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
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 2; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
												</span>
											</div>    
										<?php 
										} else { 
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
												<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 2; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
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
											<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=1&amp;limit=20">1</a>
										</span>
										<span class="gotham-light pleft13-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=20">2</a>
										</span>
										<span class="gotham-light pleft13-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=3&amp;limit=20">3</a>
										</span>
										<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=4&amp;limit=20">4</a>
										</span>
										<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
											<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=20">NEXT</a>
										</span>
										<span class="hidden-lg hidden-mdgotham-light pleft13-5 pleft-mobile-4 nexticonpagin">
											<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=20"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
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
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
											</span>
											<span class="gotham-light pleft13-5 pleft-mobile-4">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>">2</a>
											</span>
											<span class="gotham-light pleft13-5 pleft-mobile-4">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=3&amp;limit=<?php echo $_GET['limit']; ?>">3</a>
											</span>
											<span class="gotham-light pleft13-5 pleft-mobile-4">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=3&amp;limit=<?php echo $_GET['limit']; ?>">4</a>
											</span>
											<span class="gotham-light pleft13-5 pleft-mobile-4">
												<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
											</span>
										</div>
									<?php 
									} else { 
									?>
										<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
											<span class="gotham-medium pleft13-5 remove-padding">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
											</span>
											<span class="gotham-light pleft13-5 pleft-mobile-4">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>">2</a>
											</span>
											<span class="gotham-light pleft13-5 pleft-mobile-4">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=3&amp;limit=<?php echo $_GET['limit']; ?>">3</a>
											</span>
											<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=4&amp;limit=<?php echo $_GET['limit']; ?>">4</a>
											</span>
											<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
												<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
											</span>
											<span class="hidden-lg hidden-md gotham-light pleft13-5 pleft-mobile-4">
												<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
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
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 2; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
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
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
														</span>
														<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
														</span>
														<span class="gotham-medium pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
														</span>
														<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 2; ?></a>
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
															<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
															<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
														</span>
													</div>
												<?php 
												}elseif($_GET['page'] == 3) { 
												?>
													<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
														<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
														</span>             
														<span class="hidden-lg hidden-md gotham-light pleft13-5 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
															..
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo ($current - 2); ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 2; ?></a>
														</span>
														<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
														</span>
														<span class="gotham-medium pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
														</span>
														<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
															<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
															<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
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
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current - 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 3; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 2; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
												</span>
											</div>    
										<?php 
										} else { 
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
												<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current - 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 3; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 2; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
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
											<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=1&amp;limit=20">1</a>
										</span>
										<span class="gotham-light pleft13-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=20">2</a>
										</span>
										<span class="gotham-light pleft13-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=3&amp;limit=20">3</a>
										</span>
										<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=4&amp;limit=20">4</a>
										</span>
										<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
											<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=5&amp;limit=20">5</a>
										</span>
										<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
											..
										</span>
										<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
											....
										</span>
										<span class="hidden-sm hidden-xs gotham-light pleft13-5 remove-padding">
											<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $total_page;?>&amp;limit=20"><?php echo $total_page;?></a>
										</span>
										
										<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
											<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=20">NEXT</a>
										</span>
										<span class="hidden-lg hidden-mdgotham-light pleft13-5 pleft-mobile-4 nexticonpagin">
											<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=20"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
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
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
											</span>
											<span class="gotham-light pleft13-5 pleft-mobile-4">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>">2</a>
											</span>
											<span class="gotham-light pleft13-5 pleft-mobile-4">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=3&amp;limit=<?php echo $_GET['limit']; ?>">3</a>
											</span>
											<span class="gotham-light pleft13-5 pleft-mobile-4">
												<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=2&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
											</span>
										</div>
									<?php 
									} else { 
									?>
										<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-2 fright right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

											<span class="gotham-medium pleft13-5 remove-padding">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
											</span>
											<span class="gotham-light pleft13-5 pleft-mobile-4">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>">2</a>
											</span>
											<span class="gotham-light pleft13-5 pleft-mobile-4">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=3&amp;limit=<?php echo $_GET['limit']; ?>">3</a>
											</span>
											<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=4&amp;limit=<?php echo $_GET['limit']; ?>">4</a>
											</span>
											<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=5&amp;limit=<?php echo $_GET['limit']; ?>">5</a>
											</span>
											<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
												..
											</span>
											<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
												....
											</span>
											<span class="gotham-light pleft13-5 pleft-mobile-4">
												<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $total_page;?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $total_page;?></a>
											</span>
											<span class="hidden-sm hidden-xs gotham-light pleft13-5 pleft-mobile-4">
												<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
											</span>
											<span class="hidden-lg hidden-md gotham-light pleft13-5 pleft-mobile-4">
												<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=2&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
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
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
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
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
														</span>
														<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
														</span>
														<span class="gotham-medium pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
														</span>
														<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 2; ?></a>
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current + 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 3; ?></a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
															..
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
															....
														</span>
														<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $total_page; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $total_page; ?></a>
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
															<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
															<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
														</span>
													</div>
												<?php 
												}elseif($_GET['page'] == 3) { 
												?>
													<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
														<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
														</span>             
														<span class="hidden-lg hidden-md gotham-light pleft13-5 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
															..
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo ($current - 2); ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 2; ?></a>
														</span>
														<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
														</span>
														<span class="gotham-medium pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
														</span>
														<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 2; ?></a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
															..
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
															....
														</span>
														<span class="gotham-light pleft8-5ver2 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $total_page; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $total_page; ?></a>
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
															<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
															<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
														</span>
													</div>
												<?php 
												}elseif($_GET['page'] == ($total_page-1)){ 
												?>
													<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
														<span class="hidden-sm hidden-xs gotham-light pleft18 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleft18 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
														</span>
														<span class="gotham-light pleft13-5 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
															..
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
															....
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $total_page - 4; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $total_page - 4; ?></a>
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $total_page - 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $total_page - 3; ?></a>
														</span>
														<span class="gotham-light pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $total_page - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $total_page - 2; ?></a>
														</span>
														<span class="gotham-medium pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
														</span>
														<span class="gotham-light pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
															<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
															<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
														</span>
													</div>
												<?php 
												}elseif($_GET['page'] == ($total_page-2)){
												?>
													<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
														<span class="hidden-sm hidden-xs gotham-light pleft18 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleft18 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
														</span>
														<span class="gotham-light pleft13-5 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
															..
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
															....
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $total_page - 4; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $total_page - 4; ?></a>
														</span>
														<span class="gotham-light pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $total_page - 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $total_page - 3; ?></a>
														</span>
														<span class="gotham-medium pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
														</span>
														<span class="gotham-light pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 2; ?></a>
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
															<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
															<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
														</span>
													</div>
												<?php 
												}elseif($_GET['page'] == ($total_page-3)){
												?>
													<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
														<span class="hidden-sm hidden-xs gotham-light pleft18 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleft18 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
														</span>
														<span class="gotham-light pleft13-5 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
															..
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
															....
														</span>
														<span class="gotham-light pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $total_page - 4; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $total_page - 4; ?></a>
														</span>
														<span class="gotham-medium pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
														</span>
														<span class="gotham-light pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 2; ?></a>
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current + 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 3; ?></a>
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
															<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
															<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
														</span>
													</div>   
												<?php 
												}else{ 
												?>
													<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage-3 pleftpagemobilepag3">
														<span class="hidden-sm hidden-xs gotham-light pleft18 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleft18 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
														</span>
														<span class="gotham-light pleft13-5 remove-padding">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
															..
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
															....
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo ($current - 2); ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 2; ?></a>
														</span>
														<span class="gotham-light pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
														</span>
														<span class="gotham-medium pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
														</span>
														<span class="gotham-light pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 1; ?></a>
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current + 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current + 2; ?></a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
															..
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
															....
														</span>
														<span class="gotham-light pleft8-5 pleft-mobile-4">
															<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $total_page; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $total_page; ?></a>
														</span>
														<span class="hidden-sm hidden-xs gotham-light pleft8-5ver2 pleft-mobile-4">
															<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">NEXT</a>
														</span>
														<span class="hidden-lg hidden-md gotham-light pleft8-5ver2 pleft-mobile-4">
															<a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] + 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
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
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 2; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus' . '?' . $params; ?>&page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
												</span>
											</div>    
										<?php 
										} else { 
										?>
											<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 remove-padding text-to-right col-lg-offset-1 fright right-float clearright pleftpage2 pleftpagemobilepag1">
												<span class="hidden-sm hidden-xs gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>">PREV</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleft43 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $_GET['page'] - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
												</span>
												<span class="gotham-light pleft13-5 remove-padding">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=1&amp;limit=<?php echo $_GET['limit']; ?>">1</a>
												</span>
												<span class="hidden-lg hidden-md gotham-light pleftmaxbotton remove-padding">
													..
												</span>
												<span class="hidden-sm hidden-xs gotham-light pleftmaxbotton remove-padding">
													....
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current - 4; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 4; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current - 3; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 3; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current - 2; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 2; ?></a>
												</span>
												<span class="gotham-light pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current - 1; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current - 1; ?></a>
												</span>
												<span class="gotham-medium pleft8-5 pleft-mobile-4">
													<a href="<?php echo \yii\helpers\Url::base() . '/promo-merdeka-17-agustus'; ?>?page=<?php echo $current; ?>&amp;limit=<?php echo $_GET['limit']; ?>"><?php echo $current; ?></a>
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
			<?php } else { ?>
            <section style=" padding: 0px 0;">
                <div class="col-lg-12 col-md-12 col-sm-12" style="background-color: #fff;letter-spacing: 0.5px;">    
                    <div class="container clearleft">
                            <div class="row gotham-light hidden-xs" style="font-size: 45px;padding-top: 10%;">
                            <!--    COMING SOON-->
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/harbolnas/1.png" class="img-" style="width:8%;">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/harbolnas/2.png" class="img-" style="width:12%;margin-left:11%;">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/harbolnas/3.png" class="img-" style="width:13%;margin-left:10%;">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/harbolnas/4.png" class="img-" style="width:14%;margin-left:10%;">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/harbolnas/5.png" class="img-" style="width:9%;margin-left:9%;">

                             </div>
                             <div class="row gotham-light hidden-xs" style="font-size: 45px;padding-top: 10%;padding-bottom: 10%;">
                            <!--    COMING SOON-->
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/harbolnas/6.png" class="img-" style="width:11%;">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/harbolnas/7.png" class="img-" style="width:10%;margin-left:10%;">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/harbolnas/8.png" class="img-" style="width:11%;margin-left:10%;">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/harbolnas/9.png" class="img-" style="width:13%;margin-left:10%;">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/harbolnas/10.png" class="img-" style="width:11%;margin-left:10%;">

                             </div>
                             
                             <div class="row gotham-light hidden-lg hidden-sm hidden-md" style="font-size: 45px;padding-top: 10%;">
                            <!--    COMING SOON-->
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/harbolnas/1.png" class="img-" style="width:9%;">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/harbolnas/2.png" class="img-" style="width:17%;margin-left:3%;">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/harbolnas/3.png" class="img-" style="width:17%;margin-left:3%;">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/harbolnas/4.png" class="img-" style="width:18%;margin-left:2%;">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/harbolnas/5.png" class="img-" style="width:12%;margin-left:2%;">

                             </div>
                             <div class="row gotham-light hidden-lg hidden-sm hidden-md" style="font-size: 45px;padding-top: 10%;padding-bottom: 10%;">
                            <!--    COMING SOON-->
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/harbolnas/6.png" class="img-" style="width:13%;">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/harbolnas/7.png" class="img-" style="width:13%;margin-left:3%;">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/harbolnas/8.png" class="img-" style="width:15%;margin-left:3%;">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/harbolnas/9.png" class="img-" style="width:18%;margin-left:2%;">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/harbolnas/10.png" class="img-" style="width:14%;margin-left:2%;">

                             </div>
                       
                    </div>
                </div>
            </section>
			<?php } ?>
			<?php
            $data = backend\models\ProductCategory::find()->limit(6)->where(array("product_category_status" => "active", "product_category_featured" => "1"))->orderBy('product_category_sequence')->all();
            echo Yii::$app->view->renderFile('@app/views/promo/flash-sale.php', array("data" => $data));
            ?>
        </div>
    </div>
</section>
<section style="margin-top: 10px;padding-bottom:0px;padding-top:0px;">
    <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" style="background-color: #fff;letter-spacing: 0.5px;padding-bottom:20px;">    
        <div class="container clearleft" style="padding-left:0px;padding-right:0px;">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearleft">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft clearright" style="margin-top: 20px;font-size:0.7em;margin-bottom: 10px;padding-left:0px;padding-right:0px;">
                        <h2 class="m0 fsize-11">Hari Belanja Online Nasional (HARBOLNAS)</h2>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft clearright" style="text-align: justify;font-size:0.7em;padding-left:0px;padding-right:0px;">
                        Hari belanja online nasional atau sering disebut harbolnas merupakan acara yang setiap tahun diadakan oleh pelaku industri online guna mendukung pertumbuhan pasar Indonesia secara digital. Acara yang diadakan pertama kali pada tahun 2012 ini, sangat menarik bagi pelanggan yang terbiasa belanja online. Sejak acara harbolnas pada tahun 2012 dan diikuti tahun 2013, 2014, 2015, 2016, 2017 bisa dikatakan sukses. Dengan diikuti oleh berbagai marketplace, ecommerce, online travel agency, dan lainnya, berhasil mengambil hati masyarakat. Oleh karena itu, harbolnas merupakan hari yang paling ditunggu-tunggu oleh pecinta belanja online. Mari sambut harbolnas 2018 ini dengan semangat belanja.
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft clearright" style="margin-top: 20px;font-size:0.7em;margin-bottom: 10px;padding-left:0px;padding-right:0px;">
                       <h2 class="m0 fsize-11">Ayo Meriahkan Pesta Diskon Harbolnas</h2>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft clearright" style="text-align: justify;font-size:0.7em;padding-left:0px;padding-right:0px;">
                        Sudah tahu kan acaranya harbolnas kapan? Ya, acara harbolnas selalu diadakan pada tanggal 11 November atau disebut “harbolnas 11-11” dan tanggal 12 Desember ata di sebut “harbolnas 12-12” setiap tahunnya. Biasanya, orang-orang yang hobi beli online pasti menantikan momen tersebut. Setiap tanggal 11-11 dan 12-12 mengecek ada promo diskon besar-besaran apa saja di beberapa ecommerce, marketplace, online travel, atau lainnya. Apalagi yang suka dengan jam tangan, pasti menanti promo diskon jam tangan pria dan wanita branded original dari The Watch Co. karena The Watch Co selalu ikut berpartisipasi dalam acara harbolnas. Untuk mendapatkan info promonya, bisa kunjungi thewatch.co
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearleft">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft clearright" style="margin-top: 20px;font-size:0.7em;margin-bottom: 10px;padding-left:0px;padding-right:0px;">
                        <h2 class="m0 fsize-11">Beli Jam Tangan Original Di Harbolnas</h2>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft clearright" style="text-align: justify;font-size:0.7em;padding-left:0px;padding-right:0px;">
                        Sudah saatnya tampil makin kece dengan menggunakan aksesoris berupa jam tangan. Kenapa harus jam tangan? Karena jam tangan bisa di pakai untuk pria maupun wanita, tapi tergantung koleksinya yaitu bisa pilih jam tangan pria atau jam tangan wanita.Di harbolnas ini, kamu bisa mendapatkan harga jam tangan branded original dengan harga yang sangat murah, karena adanya promo diskon besar-besaran. Kapan lagi bisa punya jam tangan branded original dengan dengan harga murah? Cuma di kesempatan acara harbolnas inilah harganya bisa dapat lebih murah. Buat yang sangat menginginkan jam tangan branded original di harbolnas ini, tersedia ciicilan dengan bunga 0%. 
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft clearright" style="margin-top: 20px;font-size:0.7em;margin-bottom: 10px;padding-left:0px;padding-right:0px;">
                        <h2 class="m0 fsize-11">Diskon Besar-besaran di The Watch Co.</h2>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft clearright" style="text-align: justify;font-size:0.7em;padding-left:0px;padding-right:0px;">
                        Saatnya memanfaatkan momen spesial ini untuk mendapatkan harga jam tangan pria dan wainta branded original murah di The Watch Co. Selain mendapatkan harga murah, The Watch Co. memberikan ongkos kirim + asuransi pengiriman gratis, cicilan dengan bunga 0%, dan garansi baterai seumur hidup. Artinya suatu hari jam tangannya mati, bisa langsung dibawa ke service center untuk penggantian baterainya secara gratis. Beli jam tangan di mana lagi yang bisa memberikan after sales nya seperti di The Watch Co.? Ayo manfaatkan kesempatan acara harbolnas tahun ini untuk mendapatkan jam tangan faovritmu sekarang! 
                    </div>
                </div>
        </div>
    </div>
    
    <div class="hidden-lg hidden-md hidden-sm col-xs-12" id="readmore" style="padding-top: 11px; padding-bottom: 1px; text-align: justify;">
                        <p class="show-read-more">
                            </p><p class="seodesc"><strong>Hari Belanja Online Nasional (HARBOLNAS)</strong></p>

<p class="seodesc">Hari belanja online nasional atau sering disebut harbolnas merupakan acara yang setiap tahun diadakan oleh pelaku industri online guna mendukung pertumbuhan pasar Indonesia secara digital...<br><br><a>(Baca Selengkapnya)</a>                        </p>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm col-xs-12" id="left" style="padding-top: 11px; padding-bottom: 1px; text-align: justify; display: none;">
                        <p class="show-read-more">
                            </p><p class="seodesc"><strong>Hari Belanja Online Nasional (HARBOLNAS)</strong></p><br>

<p class="seodesc">Hari belanja online nasional atau sering disebut harbolnas merupakan acara yang setiap tahun diadakan oleh pelaku industri online guna mendukung pertumbuhan pasar Indonesia secara digital. Acara yang diadakan pertama kali pada tahun 2012 ini, sangat menarik bagi pelanggan yang terbiasa belanja online. Sejak acara harbolnas pada tahun 2012 dan diikuti tahun 2013, 2014, 2015, 2016, 2017 bisa dikatakan sukses. Dengan diikuti oleh berbagai marketplace, ecommerce, online travel agency, dan lainnya, berhasil mengambil hati masyarakat. Oleh karena itu, harbolnas merupakan hari yang paling ditunggu-tunggu oleh pecinta belanja online. Mari sambut harbolnas 2018 ini dengan semangat belanja.</p><br>

<p class="seodesc"><strong>Ayo Meriahkan Pesta Diskon Harbolnas</strong></p><br>

<p class="seodesc">Sudah tahu kan acaranya harbolnas kapan? Ya, acara harbolnas selalu diadakan pada tanggal 11 November atau disebut “harbolnas 11-11” dan tanggal 12 Desember ata di sebut “harbolnas 12-12” setiap tahunnya. Biasanya, orang-orang yang hobi beli online pasti menantikan momen tersebut. Setiap tanggal 11-11 dan 12-12 mengecek ada promo diskon besar-besaran apa saja di beberapa ecommerce, marketplace, online travel, atau lainnya. Apalagi yang suka dengan jam tangan, pasti menanti promo diskon jam tangan pria dan wanita branded original dari The Watch Co. karena The Watch Co selalu ikut berpartisipasi dalam acara harbolnas. Untuk mendapatkan info promonya, bisa kunjungi thewatch.co</p><br>
                        <p></p>
                        <p class="seodesc"><strong>Beli Jam Tangan Original Di Harbolnas</strong></p><br>

<p class="seodesc">Sudah saatnya tampil makin kece dengan menggunakan aksesoris berupa jam tangan. Kenapa harus jam tangan? Karena jam tangan bisa di pakai untuk pria maupun wanita, tapi tergantung koleksinya yaitu bisa pilih jam tangan pria atau jam tangan wanita.Di harbolnas ini, kamu bisa mendapatkan harga jam tangan branded original dengan harga yang sangat murah, karena adanya promo diskon besar-besaran. Kapan lagi bisa punya jam tangan branded original dengan dengan harga murah? Cuma di kesempatan acara harbolnas inilah harganya bisa dapat lebih murah. Buat yang sangat menginginkan jam tangan branded original di harbolnas ini, tersedia ciicilan dengan bunga 0%.</p><br>
                        <p></p>
                        <p class="seodesc"><strong>Diskon Besar-besaran di The Watch Co.</strong></p><br>

<p class="seodesc">Saatnya memanfaatkan momen spesial ini untuk mendapatkan harga jam tangan pria dan wainta branded original murah di The Watch Co. Selain mendapatkan harga murah, The Watch Co. memberikan ongkos kirim + asuransi pengiriman gratis, cicilan dengan bunga 0%, dan garansi baterai seumur hidup. Artinya suatu hari jam tangannya mati, bisa langsung dibawa ke service center untuk penggantian baterainya secara gratis. Beli jam tangan di mana lagi yang bisa memberikan after sales nya seperti di The Watch Co.? Ayo manfaatkan kesempatan acara harbolnas tahun ini untuk mendapatkan jam tangan faovritmu sekarang!</p><br>
                        <p></p>
                    </div>
</section>
<style>
    p{font-size: 0.7em; line-height: 1.3em; font-family: gotham-light;}
    show-read-more .more-text{
        display: none;
    }
</style>
<style>
	@media only screen and (min-width : 768px) {
		.pleft-5-dwpetite {padding-left: 5%; padding-top: 3%; }
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