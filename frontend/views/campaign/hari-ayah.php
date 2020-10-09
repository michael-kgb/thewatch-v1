<?php

use app\assets\PromoAsset;
use yii\widgets\ActiveForm;

PromoAsset::register($this);

?>

<section id="breadcrumb-hari-ayah">
    <div class="container">
        <div class="row">
        </div>
    </div>
</section>

<div class="container pbottom-6-mobile">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ptop2 remove-padding clearleft clearright">
				<div class='col-lg-12 col-md-12 col-sm-12 ptop2 col-xs-12 remove-padding-left remove-padding-right clearleft clearright'>
					<img src='<?php echo \yii\helpers\Url::base(); ?>/img/campaign/hari-ayah.jpg' class="img-responsive">
				</div>
			</div>
		</div>
	</div>
</div>

<?php if (count($products) > 0) {
    $now = date("Y-m-d H:i:s");
    ?>
    <section id="all-product mbottom5">
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
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price text-center">
							
								<?php
								if ($spesificPrice->reduction_type == 'percent') {
									$discount = (($spesificPrice->reduction / 100) * $product->price);
								} elseif ($spesificPrice->reduction_type == 'amount') {
									$discount = $spesificPrice->reduction;
								}
								?>
								<?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
								<span class="discount-price mleft2 discountview2">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?></span>
								<input type="hidden" class="price" name="price" value="<?php echo $product->price - $discount; ?>">
								<?php } else { ?>
								USD <?php echo $product->price_usd - $discount; ?>
								<input type="hidden" class="price" name="price" value="<?php echo $product->price_usd - $discount; ?>">
								<?php } ?>
								
								<input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price text-center">
							
								<?php
								if ($spesificPrice->reduction_type == 'percent') {
									$discount = (($spesificPrice->reduction / 100) * $product->price);
								} elseif ($spesificPrice->reduction_type == 'amount') {
									$discount = $spesificPrice->reduction;
								}
								?>
								<?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
								<span class="mleft2">
								IDR <?php echo \common\components\Helpers::getPriceFormat($product->price - $discount); ?>
								</span>
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
							<!--<div class="col-lg-12 col-md-12 col-sm-12 product product-price"><span class="lspace2">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?></span></div>-->
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
<?php } ?>

<style>
@media only screen and (min-width : 768px) {
	section#breadcrumb-hari-ayah { padding: 90px 0 0 0; }
}

@media only screen and (max-width : 767px) {
	section#breadcrumb-hari-ayah { padding: 90px 0 0 0; }
	.discountview { margin-left: 0; }
	.product-detail.product-name, .product-detail.product-price { text-align: center; }
}
</style>