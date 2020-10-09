<?php
$exURL 		   = explode("?cat=", $_SERVER['REQUEST_URI']);
$countUrl 	   = count($exURL);
$this->title   = $journal->journalDetail->journal_detail_title . ' - The Watch Co.';
$journal_image = \backend\models\JournalImageSlider::find()->where(['journal_id'=>$journal->journal_id])->andWhere(['<>','journal_image_slider_image', 'slide_'])->all();
?>

<section id="journal-detail">
	<div class="container mid-container">
	
	<div class="journal-detail">
	
		<div class="journal-detail-content">
			<?php if (count($journal) > 0) { ?>
				<div class="journal-detail-title">
						<?php echo $journal->journalDetail->journal_detail_title; ?>
					</div>
				<div class="left-side">
					
					
					<!--<?php echo(date_format(date_create($journal->journal_created_date), "j F Y")) ?>-->
					<!--</br>-->
					<!--<?php echo $journal->journalDetail->journal_short_description; ?>-->
					<!--<div class="by-detail">
					<?php
					if ($journal->journalAuthor->journal_author_name != '-') {
						?>
						by <a href="<?php echo \yii\helpers\Url::base() . '/journal/author/' . $journal->journalAuthor->link_rewrite; ?>"><?php echo $journal->journalAuthor->journal_author_name; ?></a>   
					<?php } ?>
					</div>-->
				</div>
				<div class="right-side show-desktop">
					<!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 share-btn clearleft ptop-8-mobile" style="color:#a8a9ad;">
						Share this journal
					</div>-->
					<div class="col-lg-1 col-md-2 col-sm-2 col-xs-2 share-btn clearleft ptop-8-mobile">
						<a target="popup" onclick="
								window.open('https://www.facebook.com/dialog/feed?app_id=1466455300249678&display=popup&caption=thewatch.co%20|%20by%20<?php echo $journal->journalAuthor->journal_author_name; ?>&description=<?php echo $journal->journalDetail->journal_detail_title; ?>&link=http://thewatch.co&name=<?php echo $journal->journalDetail->journal_detail_title; ?>&redirect_uri=http://thewatch.co/journal/detail/<?php echo $journal->journalDetail->link_rewrite; ?>&picture=http://thewatch.co/img/journal/<?php echo $journal->journal_id . '/small_cover_' . $journal->journalImage->journal_image_id . '.jpg'; ?>', 'name', 'width=600,height=400')">
																<img width="18" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/fb-nobg.png">
						</a>
					</div>
					<div class="col-lg-1 col-md-2 col-sm-2 col-xs-2 share-btn clearleft ptop-8-mobile">
						<a target="popup" onclick="window.open('http://twitter.com/share?source=sharethiscom&amp;text=<?php echo $journal->journalDetail->journal_detail_title . ' by ' . $journal->journalAuthor->journal_author_name; ?>&amp;url=<?php echo 'http://thewatch.co/journal/detail/' . $journal->journalDetail->link_rewrite; ?>', 'name', 'width=600,height=400')">
							<img width="18" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/twitter-nobg.png">
						</a>
					</div>
					<div class="col-lg-1 col-md-2 col-sm-2 col-xs-2 share-btn clearleft ptop-8-mobile">
						<a target="popup" onclick="window.open('https://pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.thewatch.co%2Fmoment&media=http://thewatch.co/img/journal/<?php echo $journal->journal_id . '/big_cover_' . $journal->journalImage->journal_image_id . '.jpg'; ?>&description=<?php echo substr($journal->journalDetail->journal_detail_description, 0, 100); ?>', 'name', 'width=600,height=400')">
							<img width="18" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/pinterest-nobg.png">
						</a>
					</div>
				</div>
				
				<header id="myCarousel" class="carousel slide carousel-fade">
					<?php if(count($journal_image) > 0) { ?>

						<!-- Indicators -->
						<?php if(count($journal_image) != 1) { ?>
						<ol class="carousel-indicators">
							<?php 
								$i=0;
								foreach($journal_image as $row) { 
							?>
								<li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $i == 0 ? 'active' : ''; ?>"></li>
								<?php $i++; ?>
							<?php } ?>
						</ol>
						<?php } ?>

					<?php } ?>
					
					<div class="carousel-inner clearleft clearright">
						<?php if(count($journal_image) > 0) { ?>
							<?php 
								$i=1;
								foreach($journal_image as $row) { 
							?>
						   
							<div class="item <?php echo $i == 1 ? 'active' : ''; ?>">
								<img src="<?php echo \yii\helpers\Url::base(); ?>/img/journal/<?php echo $journal->journal_id . '/' . $row->journal_image_slider_image; ?>" class="img-responsive journal detail picture">
								<!--<div class="fill img-responsive" style="background-image:url('<?php // echo \yii\helpers\Url::base(); ?>/img/homebanner/<?php // echo $row->homebanner_images; ?>');"></div>-->
							</div>
							<?php $i++; ?>
							<?php } ?>
						<?php } ?>
					</div>
					
					
					<?php if(count($journal_image) != 1 && count($journal_image) != 0) { ?>
					<a class="left carousel-control" href="#myCarousel" data-slide="prev">
						<span class="icon-prev"></span>
					</a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next">
						<span class="icon-next"></span>
					</a>
					<?php } ?>
				</header>
				
				
				<div class="journal-detail-desc">
					<?php echo $journal->journalDetail->journal_detail_content1; ?>
				</div>
				
				<?php if($journal->journalDetail->journal_video_source != ''){ ?>
				<div class="journal-detail-desc">
					<iframe width="100%" height="558" src="<?php echo $journal->journalDetail->journal_video_source; ?>" frameborder="0" allowfullscreen></iframe>
				</div>
				<?php } ?>

			<?php } ?>
			
			
			
			<!-- 
			Related product			
			-->
			
			<?php
				session_start();
				// if($_SESSION['customerInfo']['customer_id'] == 7614){
					if($journal->journalDetail->show_product == 1){
						$journal_detail_products = \backend\models\JournalDetailProduct::find()->where(['journal_detail_id'=>$journal->journalDetail->journal_detail_id])->all();
						$product_id = [];$i = 0;
						foreach($journal_detail_products as $journal_detail_product){
							$product_id[$i] = $journal_detail_product->product_id;
							$i++;
						}
						$products = \backend\models\Product::find()
							->joinWith([
								"productImage" => function ($query) {
									$query->andWhere(['cover' => 1]);
								}
							])
							->where(['product.product_id'=>$product_id])->all();
					    
						
			?>      
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shop-title caption" style="font-family:gotham-medium;">
				<?php echo $journal->journalDetail->product_collection_title; ?>
			</div>
		
			<div class="col-lg-12 col-md-12 col-sm-12 clearright clearleft">
			   <?php 
				$i = 1;
				if (count($products) > 0) { 
					foreach($products as $product){ 
						if($i == 1){ $i_text = 'clearleft-mobile pleft75 pright75';}
						elseif($i == 2){ $i_text = 'clearright-mobile pleft75 pright75';}
						else{ $i_text = 'pleft75 pright75';}
				?>
				<div class="col-sm-4 col-lg-4 col-md-4 col-xs-6 <?php echo $i_text; ?> mbottom-3-mobile">
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
								<?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now && date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>

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
					if($i == 3){
						echo '<div class="col-lg-12 col-md-12 col-sm-12 hidden-xs new-line"></div>';
						$i = 0;
					}
					$i++;
					}
				?>
			   
					<?php  } ?>
			</div>
				<?php } ?>
                   
			<?php
			echo Yii::$app->view->renderFile('@app/modules/journal/views/default/related.php', array("related" => $related));
			?>		
		</div>
		<div class="journal-detail-sidebar show-desktop">
			<div class="sidebar-title">Hot</div>	
			<div class="wrap-category">			
				<a href="<?php echo \yii\helpers\Url::base() . ''.$exURL[0];?>" class="journal-menu-item">
					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/journal-icons/all.png" alt="journal menu icon">
					Semua
					
					<?php if($countUrl == 1){ ?>
					<img class="selected-category" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/selected-mobile.png"/>
					<?php } ?>
			   </a>
				<?php
				$len = count($journalCategory);
				
				if (count($journalCategory) > 0) { 
					foreach ($journalCategory as $category) { ?>
					
						<a href="<?php echo \yii\helpers\Url::base() . ''.$exURL[0]. '?cat='. $category->journal_category_name; ?>" class="journal-menu-item">
							<img src="<?php echo \yii\helpers\Url::base(); ?>/img/journal-icons/<?php echo $category->journal_category_img; ?>" alt="journal menu icon">
							<?php echo ucfirst($category->journal_category_name); ?>
							
							<?php if($countUrl > 1 && ($exURL[1] == $category->journal_category_name)){ ?>
								<img class="selected-category" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/selected-mobile.png"/>
							<?php } ?>
						</a> 
						
				<?php 
					} 
				}
				?>
			</div>	
			<div class="sidebar-hot-items">
				<?php 
				foreach($journalList as $journal){
				?>
				<a href="<?php echo \yii\helpers\Url::base(); ?>/journal/detail/<?php echo $journal->journalDetail->link_rewrite; ?>">
					<div class="sidebar-hot-item">
						<img src="<?php echo \yii\helpers\Url::base(); ?>/img/journal/<?php echo $journal->journal_id . '/small_cover_' . $journal->journalImage->journal_image_id . '.jpg'; ?>" alt="hot image" />
						
						<div class="hot-title">
							<?php echo strtoupper($journal->journalDetail->journal_detail_title); ?> 
						</div>
					</div>
				</a>
				<?php
				}
				?>
			</div>
		</div>
	</div>
   

	</div>
</section>
<style>
    p a {
        color:#4c757b;
        text-decoration:underline;
    }
    iframe{
        position:relative!important;
    }
</style>

