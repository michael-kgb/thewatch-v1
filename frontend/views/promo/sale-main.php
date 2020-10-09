<?php
session_start();

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
        "list": "SALE <?php echo date('Y');?>"
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
<section class="ptop1" style="padding-bottom:5px;">
    <div class="container">
        <div class="row">
           
<?php
	if($activated){
		if($has_slider){
			?>
            <section id="category" class="p0">
                <div class="container">
                     <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright">
						<?php
						if($has_slider_static){
							?>
								<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/newyear/2019/main-banner-sale-page-dekstop.jpg?auto=compress%2Cformat&fm=pjpg" class="img-responsive hidden-xs">
								<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/newyear/2019/main-banner-sale-page-mobile.jpg" class="img-responsive hidden-lg hidden-md hidden-sm">  
							<?php
						}else{
							?>
								 <header id="myCarousel" class="carousel slide carousel-fade">
									   <!-- Indicators -->
										<ol class="carousel-indicators">
											<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
											<li data-target="#myCarousel" data-slide-to="1" class="mright0"></li>
										</ol>

									<!-- Wrapper for Slides -->
									<!--<div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1 carousel-inner clearleft clearright">-->
									<div class="carousel-inner clearleft clearright">
											<div class="item active">
												<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/newyear/2019/main-banner-sale-page-dekstop.jpg?auto=compress%2Cformat&fm=pjpg" class="img-responsive hidden-xs">
												<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/newyear/2019/main-banner-sale-page-mobile.jpg" class="img-responsive hidden-lg hidden-md hidden-sm">  
											</div>
											
									</div>
									<a class="left carousel-control" href="#myCarousel" data-slide="prev">
										<img class="carousel-control-homeban mleft50" src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/icons/prev_slide_gold.png" width="40" style="margin-top:200px;">
									</a>
									<a class="right carousel-control" href="#myCarousel" data-slide="next">
										<img class="carousel-control-homeban mright50" src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/icons/next_slide_gold.png" width="40" style="margin-top:200px;">
									</a>
								</header>
							<?php
						}
						?>
                        </div>
                         
            		</div>
            	</div>
            </section>
			<?php
		}
?>
            <section id="featured-brands" class="p0">
                <div class="container">
                     <div class="row">
						<!-- desktop slider -->
						<div class="col-lg-5 col-md-5 col-sm-5 hidden-xs category block pright15">
							<div class="col-lg-12 clearright clearleft ptop20 pbottom15 fsize-14 gotham-light">
								<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/newyear/2019/sale-banner-desktop.jpg?auto=compress%2Cformat&fm=pjpg" class="img-responsive hidden-xs">
							</div>						  

							<div class="col-lg-12 clearright clearleft ptop20 pbottom15 fsize-14 gotham-light">
								Lihat Semua Koleksi <?php echo $brand_name;?>
							</div>
							<div class="col-lg-12 clearright clearleft">
								<a class="blue-round featured-banner-see-more button desktop" href="<?php echo \yii\helpers\Url::base() . '/brand/' . $brand_rewrite; ?>">KLIK DISINI</a>
							</div>

						</div>
						<?php 
							if (count($new_year_sale) > 0) { 
							$i = 1;
						?>
						<!-- content for desktop -->
						<div id="" class="swiper-container-featured-brand-product-desktop hidden-xs col-lg-7 col-md-7 col-sm-7 clearleft clearright">
							<div class="swiper-wrapper clearleft clearright">
								<?php 
								foreach ($new_year_sale as $prod_desktop) {
									$productStock = backend\models\ProductStock::findAll(['product_id' => $prod_desktop->product_id]);
									$found = FALSE;
									$totalStock = 0;
									foreach ($productStock as $attribute){
										$productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
										if($productattribute != NULL && $attribute->quantity != 0){
											$found = TRUE;
										}
										$totalStock = $totalStock + $attribute->quantity;
									}
									
									if (!empty($prod_desktop->specificPrice)) {
										// if($prod_desktop->specificPrice->reduction > 10 && $totalStock > 0){
										if($prod_desktop->specificPrice->reduction > 10){
								?>
									<!-- Set the first background image using inline CSS below. -->
									<div class="swiper-slide clearleft-mobile clearright-mobile">
										<div class="hidden-xs col-lg-12 col-md-12 col-sm-12 clearleft clearright <?php if($i % 2 == 0){echo 'kanan';}else{echo 'kiri';}?>">
											<a class="productClickRelated" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $prod_desktop->productDetail->link_rewrite; ?>">
											<div class="relative">
												<!--
												<div class="tag">
													<?php
														if($prod_desktop->specificPrice->is_flash_sale == 0){
														?>
														<div class='pull-right'>
															<div class='<?php echo $product->specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
																<span class='text-discount'>
																	<?php
																	// if custom value label
																	if($prod_desktop->specificPrice->label_type == "custom_value"){
																		echo $prod_desktop->specificPrice->label;
																	} else {
																		if ($prod_desktop->specificPrice->reduction_type == 'amount') {
																			echo round($prod_desktop->specificPrice->reduction / 1000, 2);
																		} else {
																			echo $prod_desktop->specificPrice->reduction;
																		}
																		echo $prod_desktop->specificPrice->reduction_type == 'percent' ? '%' : 'k';
																	}
																	?>
																</span>
															</div>
														</div>
														<?php
														}
													?>
												</div>
												-->
												<?php
												if($prod_desktop->specificPrice->is_flash_sale == 0){
												?>
													 <div class="tag-bellow tag-mobile-home popular-brand bgcolorae4a3b">
														<div class=''>
															<span class='text-bellow'>
															Sale 
																<?php
																// if custom value label
																if($prod_desktop->specificPrice->label_type == "custom_value"){
																	echo $prod_desktop->specificPrice->label;
																} else {
																	if ($prod_desktop->specificPrice->reduction_type == 'amount') {
																		echo round($prod_desktop->specificPrice->reduction / 1000, 2);
																	} else {
																		echo $prod_desktop->specificPrice->reduction;
																	}
																	echo $prod_desktop->specificPrice->reduction_type == 'percent' ? '%' : 'k';
																}
																?> Off
															</span>
														</div>
													</div>
												<?php
												}
												?>
												<img alt="<?php echo $prod_desktop->brands->brand_name . ' ' . $prod_desktop->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $prod_desktop->productImage->product_image_id . '/' . $prod_desktop->productImage->product_image_id; ?>.jpg?auto=compress%2Cformat&fit=max&fm=pjpg&w=1400" class="img-responsive m0 p0 bradius5">
											</div>
											<input type="hidden" name="productId" value="<?php echo $prod_desktop->product_id; ?>">
											<input type="hidden" name="productName" value="<?php echo $prod_desktop->productDetail->name; ?>">
											<input type="hidden" name="productPrice" value="<?php echo $prod_desktop->price; ?>">
											<input type="hidden" name="productCategory" value="<?php echo $prod_desktop->productCategory->product_category_name; ?>">
											<input type="hidden" name="productPosition" value="<?php echo $i; ?>">
											<input type="hidden" name="brandName" value="<?php echo $prod_desktop->brands->brand_name; ?>">
											<div class="col-lg-12 col-md-12 col-sm-12 product gotham-medium brand-title brand-popular"><?php echo $prod_desktop->brands->brand_name; ?></div>
											<div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-name brand-popular"><?php echo $prod_desktop->productDetail->name; ?></div>
											<?php
												// if product has discount
												$discount = 0;
											?>
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
													<?php
													if ($prod_desktop->specificPrice->reduction_type == 'percent') {
														$discount = (($prod_desktop->specificPrice->reduction / 100) * $prod_desktop->price);
													} elseif ($prod_desktop->specificPrice->reduction_type == 'amount') {
														$discount = $prod_desktop->specificPrice->reduction;
													}
													?>
													<?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
													<span class="discount-price mleft2 discountview2">IDR <?php echo \common\components\Helpers::getPriceFormat($prod_desktop->price); ?></span>
													<span class="discount-price-real">IDR <?php echo \common\components\Helpers::getPriceFormat($prod_desktop->price - $discount); ?></span>
													<input type="hidden" class="price" name="price" value="<?php echo $prod_desktop->price - $discount; ?>">
													<?php } else { ?>
													USD <?php echo $prod_desktop->price_usd - $discount; ?>
													<input type="hidden" class="price" name="price" value="<?php echo $prod_desktop->price_usd - $discount; ?>">
													<?php } ?>
													

													<input type="hidden" class="weight" name="weight" value="<?php echo $prod_desktop->weight; ?>">
												</div>
												<input type="hidden" name="productPrice" value="<?php echo $prod_desktop->price - $discount; ?>">
											<?php
												if(($prod_desktop->price - $discount) > 500000){
												?>
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment talign-left">
														<?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
														IDR <?php echo \common\components\Helpers::getPriceFormat(($prod_desktop->price - $discount) / 12); ?> / bulan
													   
														<?php } else { ?>
														USD <?php echo ($prod_desktop->price_usd - $discount)/12; ?> / bulan
														
														<?php } ?>
													</div>
												<?php
												}
											?>
											</a>
										</div>
									</div>
									<?php 
										}
									}
									?>
                                            <!--<div class="fill img-responsive" style="background-image:url('<?php // echo \yii\helpers\Url::base(); ?>/img/homebanner/<?php // echo $row->homebanner_images; ?>');"></div>-->
                                        <?php if($i == 4){ ?>
                                            <div class="swiper-slide clearleft clearright bradius5">
                                                <div class="col-lg-12 featured-banner-see-more frame clearleft-mobile clearright-mobile">
                                                    <div class="featured-banner-see-more text">Lihat Semua Koleksi <br> <?php echo $prod_desktop->brands->brand_name;?></div>
                                                    <a class="yellow-round featured-banner-see-more button" href="<?php echo \yii\helpers\Url::base() . '/brand/' . $prod_desktop->brands->link_rewrite; ?>">KLIK DISINI</a>
                                                </div>
                                            </div>
                                            <?php break; } ?>
                                        <?php $i++; ?>
						<?php 	} ?>
                              
                                </div>
                                <!-- <div class="swiper-pagination paging-desktop" style="height:35px;margin-top:10px;"></div> -->
                                 
                                    <div class="swiper-button-next featured-desktop popular-brand"><img src="https://thewatch.imgix.net/icons/next_slide_gold.png?auto=compress&fit=max" width="40"></div>
                                    <div class="swiper-button-prev featured-desktop popular-brand"><img src="https://thewatch.imgix.net/icons/prev_slide_gold.png?auto=compress&fit=max" width="40"></div>           
                            </div>
     
						<?php
							} 
						?>
						
						<!-- mobile slider -->
						<div class="hidden-lg hidden-md hidden-sm col-xs-12 p0">
							<div class="col-lg-12 clearright clearleft ptop20 pbottom15 fsize-14 gotham-light">
							<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/newyear/2019/sale-banner-mobile.jpg?auto=compress%2Cformat&fit=max&fm=pjpg" class="width100 pright0 bradius5">
							</div>
						</div>
						
						<div class="hidden-lg hidden-md hidden-sm col-xs-12 ptop15"></div>
						<?php 
							if (count($new_year_sale) > 0) { 
							$i = 1;
						?>
							<!-- content for mobile -->
                            <div id="" class="swiper-container-featured-brand-product hidden-lg hidden-md hidden-sm col-xs-12 clearleft-mobile clearright-mobile">
                                <div class="swiper-wrapper clearleft-mobile clearright-mobile">
								<?php 
									foreach ($new_year_sale as $related) {
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
												?>
												</div>
												<?php
													if (!empty($related->specificPrice)) {
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
												$discount = 0;
												if ($related->specificPrice != null) {
													?>
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
															<?php
															if ($related->specificPrice->reduction_type == 'percent') {
																$discount = (($related->specificPrice->reduction / 100) * $related->price);
															} elseif ($related->specificPrice->reduction_type == 'amount') {
																$discount = $related->specificPrice->reduction;
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
												<?php 
													}
												?>
												<input type="hidden" name="productPrice" value="<?php echo $related->price - $discount; ?>">
											<!--<div class="col-lg-12 col-md-12 col-sm-12 product product-price"><span class="lspace2">IDR <?php //echo \common\components\Helpers::getPriceFormat($product->price); ?></span></div> -->
											<?php
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
											?>
											</a>
										</div>
									</div>
									<!--<div class="fill img-responsive" style="background-image:url('<?php // echo \yii\helpers\Url::base(); ?>/img/homebanner/<?php // echo $row->homebanner_images; ?>');"></div>-->
									<?php if($i == 4){ ?>
										<div class="swiper-slide clearleft-mobile clearright-mobile bradius5">
											<div class="hidden-lg hidden-md hidden-sm col-xs-12 featured-banner-see-more frame clearleft-mobile clearright-mobile">
												<div class="featured-banner-see-more text">Lihat Semua Koleksi <br> <?php echo $related->brands->brand_name;?></div>
												<a class="yellow-round featured-banner-see-more button" href="<?php echo \yii\helpers\Url::base() . '/brand/' . $related->brands->link_rewrite;?>">KLIK DISINI</a>
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
                </div>
            </section>
            
            <section id="featured-brands">
                <div class="col-xs-12 hidden-lg hidden-md hidden-sm" style="padding-top:80px;"></div>
            </section>
            
	<?php 
	} else { 
	?>
			<section id="product">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 ptop5 pbottom3">
						<center><span class="gotham-light fsize-1" style="font-size: 25px;">COMING SOON <?php echo $count; ?></span></center>
					</div>
				</div>
			</section>                 
	<?php 
	} 
	?>
        </div>
    </div>
</section>

<!--SEO Pages-->
<section style=" padding: 0px 0;z-index;1;padding-top:90px;">
    <div class="col-lg-12 col-md-12 col-sm-12" style="background-color: #fff;z-index: 1; margin-top: -70px;">    
        <div class="container clearleft">
			<div class="col-lg-6 col-md-6 col-sm-6 hidden-xs clearleft" style="padding-top: 30px; padding-bottom: 30px; text-align: justify;">
				<p class="seodesc"><strong>Diskon Jam Tangan Original&nbsp;</strong></p>
				<p class="seodesc">Untuk menggunakan jam tangan original kini tidak lagi harus mahal, karena kami menawarkan banyak sekali program promo dan juga program cicilan untuk jam tangan branded. Diskon jam tangan branded akan selalu kami berikan di setiap bulannya sehingga kamu akan bangga menggunakan jam tangan original favoritmu tanpa takut menguras dompet. Jual jam tangan original online, mulai dari jam tangan original Daniel Wellington, Olivia Burton, Timex, Tsovet, Hypergrand, dan Aark Collective akan tersedia dengan harga murah di The Watch Co.&nbsp;</p>
				<p class="seodesc"><strong>Promo Jam Tangan Wanita Murah</strong></p>
				<p class="seodesc">Jam tangan branded merupakan salah satu aksesoris fashion yang penting bagi wanita. Bagi para wanita yang mau membeli jam tangan branded murah, tersedia program promo untuk jam tangan wanita branded seperti Daniel Wellington, Olivia Burton, Aark Collective, Timex, dan lain-lain. Diskon bagi jam tangan branded tersebut akan selalu tersedia sepanjang tahun di The Watch Co. Jadi bagi para wanita yang ingin menggunakan jam tangan original dengan harga murah, bisa mengunjunggi store The Watch Co. atau website www.thewatch.co untuk beli jam tangan online.</p>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 hidden-xs" style="padding-top: 30px; padding-bottom: 30px; text-align: justify;">
				<p class="seodesc"><strong>Promo Jam Tangan Pria Murah</strong></p>
				<p class="seodesc">Jam tangan original merupakan satu-satunya perhiasan yang dikenakan oleh pria. Maka dari itu, akan semankin bangga jika menggunakan jam tangan original. Tapi, kamu jangan khawatir dengan harga yang mahal, karena The Watch Co. mempunyai program promo sehingga kamu bisa memiliki jam tangan branded seperti Timex, Daniel Wellington, Hypergrand, Aark Collective, William L, dan lain-lain dengan harga murah. Jadi tunggu apa lagi, segera beli jam tangan original murah di store The Watch Co. dan juga website www.thewatch.co untuk beli jam tangan secara online.</p>
				<p class="seodesc"><strong>Penawaran Promo Aksesoris Murah&nbsp;</strong></p>
				<p class="seodesc">Selain jam tangan original, The Watch Co juga menjual beberapa aksesoris branded original seperti Eastpak, Rains Journal, Y Studio, Cereal Magz, Hypebeast, Kinfolk, Orbit Key, dan lain-lain. Berbagai macam aksesoris branded origianal tersebut tersedia dengan harga murah karena kami mempunyai program diskon bagi aksesoris branded tersebut. Jadi, kamu bisa bergaya dengan aksesoris original branded tersebut tanpa harus menguras dompet. Ayo beli aksesoris branded origianl dengan harga murah di store The Watch Co. atau di website www.thewatch.co untuk beli jam tangan secara online.</p>	
			</div>
					
			<!--mobile version-->
			<div class="hidden-lg hidden-md hidden-sm" id="readmore" style="padding-top: 11px; padding-bottom: 1px; text-align: justify;">
				<p class="show-read-more"></p>
				<p class="seodesc"><strong>Diskon Jam Tangan Original&nbsp;</strong></p>
				<p class="seodesc">Untuk menggunakan jam tangan original kini tidak lagi harus mahal, karena kami menawarkan banyak sekali program promo dan juga program cicilan untuk jam tangan branded...<br><br><a>(Baca Selengkapnya)</a>                        </p>
			</div>
			<div class="hidden-lg hidden-md hidden-sm" id="left" style="padding-top: 11px; padding-bottom: 1px; text-align: justify; display: none;">
				<p class="show-read-more"></p>
				<p class="seodesc"><strong>Diskon Jam Tangan Original&nbsp;</strong></p>
				<p class="seodesc">Untuk menggunakan jam tangan original kini tidak lagi harus mahal, karena kami menawarkan banyak sekali program promo dan juga program cicilan untuk jam tangan branded. Diskon jam tangan branded akan selalu kami berikan di setiap bulannya sehingga kamu akan bangga menggunakan jam tangan original favoritmu tanpa takut menguras dompet. Jual jam tangan original online, mulai dari jam tangan original Daniel Wellington, Olivia Burton, Timex, Tsovet, Hypergrand, dan Aark Collective akan tersedia dengan harga murah di The Watch Co. &nbsp;</p>
				<p class="seodesc"><strong>Promo Jam Tangan Wanita Murah</strong></p>
				<p class="seodesc">Jam tangan branded merupakan salah satu aksesoris fashion yang penting bagi wanita. Bagi para wanita yang mau membeli jam tangan branded murah, tersedia program promo untuk jam tangan wanita branded seperti Daniel Wellington, Olivia Burton, Aark Collective, Timex, dan lain-lain. Diskon bagi jam tangan branded tersebut akan selalu tersedia sepanjang tahun di The Watch Co. Jadi bagi para wanita yang ingin menggunakan jam tangan original dengan harga murah, bisa mengunjunggi store The Watch Co. atau website www.thewatch.co untuk beli jam tangan online.</p>
			</div>
			<div class="hidden-lg hidden-md hidden-sm" id="right" style="padding-top: 11px; padding-bottom: 1px; text-align: justify; display: none;">
				<p class="show-read-more"></p>
				<p class="seodesc"><strong>Promo Jam Tangan Pria Murah</strong></p>
				<p class="seodesc">Jam tangan original merupakan satu-satunya perhiasan yang dikenakan oleh pria. Maka dari itu, akan semankin bangga jika menggunakan jam tangan original. Tapi, kamu jangan khawatir dengan harga yang mahal, karena The Watch Co. mempunyai program promo sehingga kamu bisa memiliki jam tangan branded seperti Timex, Daniel Wellington, Hypergrand, Aark Collective, William L, dan lain-lain dengan harga murah. Jadi tunggu apa lagi, segera beli jam tangan original murah di store The Watch Co. dan juga website www.thewatch.co untuk beli jam tangan secara online.</p>
				<p class="seodesc"><strong>Penawaran Promo Aksesoris Murah&nbsp;</strong></p>
				<p class="seodesc">Selain jam tangan original, The Watch Co juga menjual beberapa aksesoris branded original seperti Eastpak, Rains Journal, Y Studio, Cereal Magz, Hypebeast, Kinfolk, Orbit Key, dan lain-lain. Berbagai macam aksesoris branded origianal tersebut tersedia dengan harga murah karena kami mempunyai program diskon bagi aksesoris branded tersebut. Jadi, kamu bisa bergaya dengan aksesoris original branded tersebut tanpa harus menguras dompet. Ayo beli aksesoris branded origianl dengan harga murah di store The Watch Co. atau di website www.thewatch.co untuk beli jam tangan secara online.</p>
			</div>
		</div>
    </div>
</section>

<style>
@media only screen and (max-width : 767px) {
	.mtop3-mobile { margin-top: 3%; }
	.mtop8-em-mobile { margin-top: 8em; }
}
p.seodesc{font-size: 0.7em; line-height: 1.3em; font-family: gotham-light;}
    .show-read-more .more-text{
        display: none;
    }
</style>