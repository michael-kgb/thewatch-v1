<?php

use app\assets\ProductDetailAsset;

ProductDetailAsset::register($this);

?>

<?php 
$petite = ['1581','1582','1583','1584'];
$productRelated = \backend\models\Product::find()
->joinWith([
    "productDetail",
    "productImage" => function ($query) {
        $query->andWhere(['cover' => 1]);
    }
])
->limit(10)
->where(["product.product_id" => $petite])
->all(); 
?>

<script>
var currentCategory = '<?php echo $breadcrumbs[0]; ?>';
var currentAction = '<?php echo $breadcrumbs[2]; ?>';

var dataLayer = [],
	items = [];
	
	<?php $i = 1; ?>
	<?php if (count($productRelated) > 0) { ?>
	<?php foreach ($productRelated as $product) { ?>
	
	items.push({
		"id": "<?php echo $product->product_id; ?>",
		"name": "<?php echo $product->productDetail->name; ?>",
		"price": "<?php echo $product->price; ?>",
		"brand": "<?php echo $product->brands->brand_name; ?>",
		"category": "<?php echo $product->productCategory->product_category_name; ?>",
		"position": <?php echo $i; ?>,
		"list": "Landing Page Pre Order Daniel Wellington Classic Petite"
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

<div class="row brand-banner-dwpetite">
    <header id="myCarousel" class="carousel slide-dwpetite">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1" class=""></li>
			<li data-target="#myCarousel" data-slide-to="2" class=""></li>
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner clearleft clearright dwpetite">
            <div class="item active">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/dwpetite/1.jpg" class="img-responsive" style="width: 1800px">
                <!--<div class="fill" style="background-image: url(img/brand_banner//);"></div>-->
            </div>
            <div class="item">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/dwpetite/2.jpg" class="img-responsive" style="width: 1800px">
                <!--<div class="fill" style="background-image: url(img/brand_banner//);"></div>-->
            </div>
			<div class="item">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/dwpetite/3.jpg" class="img-responsive" style="width: 1800px">
                <!--<div class="fill" style="background-image: url(img/brand_banner//);"></div>-->
            </div>
        </div>
        
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
        
    </header>
</div>

<section id="brand-description-dwpetite" class="brand-desc-detail">
    <div class="container clearright">
        <div class="row">
            <div class="col-lg-2 col-md-12 col-sm-12 brand-logo">
                <img src="https://d3vq5glb73pll6.cloudfront.net/img/brands/black/1456299393.png">
            </div>
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 clearright pleft-5-dwpetite">
                <div class="brand-name-full" style="font-family: gotham-light;">
                    Syarat dan Ketentuan
                </div>
                <div class="brand-description">
                    1. Pre-order dimulai dari tanggal 29 Maret sampai 16 April 2017 <br>
					2. Pembayaran penuh harus dilakukan pada saat pre-order dilakukan <br>
					3. Produk Daniel Wellington Classic Petite akan dikirimkan ke alamat tujuan pada bulan April 2017 <br>
					4. Gratis ongkos kirim untuk pengiriman produk pre-order Daniel Wellington Classic Petite
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container product-box clearleft">
    <div id="demo">
        <div class="container">
            <div class="row hidden-xs">
                <div class="span12">
                    <div id="owl-petite" class="owl-carousel">
                        <?php if (count($productRelated) > 0) { ?>
                            <?php $i = 1; ?>
                            <?php foreach ($productRelated as $related) { ?>
                                <div class="item">
                                    <a class="productClickRelated" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $related->productDetail->link_rewrite; ?>">
                                        <img alt="<?php echo $related->brands->brand_name . $related->productDetail->name; ?>" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $related->productImage->product_image_id . '/' . $related->productImage->product_image_id; ?>.jpg" class="img-responsive">
                                        <input type="hidden" name="productId" value="<?php echo $related->product_id; ?>">
                                        <input type="hidden" name="productName" value="<?php echo $related->productDetail->name; ?>">
                                        <input type="hidden" name="productPrice" value="<?php echo $related->price; ?>">
                                        <input type="hidden" name="productCategory" value="<?php echo $related->productCategory->product_category_name; ?>">
                                        <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                        <input type="hidden" name="brandName" value="<?php echo $related->brands->brand_name; ?>">
                                        <div class="col-lg-12 col-md-12 col-sm-12 product gotham-medium brand-title clearleft clearright"><?php echo $related->brands->brand_name; ?></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-name clearleft clearright"><?php echo $related->productDetail->name; ?></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-price clearleft clearright">IDR <?php echo \common\components\Helpers::getPriceFormat($related->price); ?></div>
                                        <div class="col-lg-8 col-md-8 col-sm-8 gotham-light preorder-btn">Pre-Order Now</div>
                                    </a>
                                </div>
                                <?php $i++; ?>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
			<div class="row hidden-lg hidden-md hidden-sm">
				<?php if (count($productRelated) > 0) { ?>
					<?php $i = 0; ?>
					<?php foreach ($productRelated as $related) { ?>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 space related <?php echo $i % 2 == 0 ? 'left' : 'right' ?>">
							<a class="productClickRelated" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $related->productDetail->link_rewrite; ?>">
								<img alt="<?php echo $related->brands->brand_name . $related->productDetail->name; ?>" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $related->productImage->product_image_id . '/' . $related->productImage->product_image_id; ?>.jpg" class="img-responsive">
								<input type="hidden" name="productId" value="<?php echo $related->product_id; ?>">
								<input type="hidden" name="productName" value="<?php echo $related->productDetail->name; ?>">
								<input type="hidden" name="productPrice" value="<?php echo $related->price; ?>">
								<input type="hidden" name="productCategory" value="<?php echo $related->productCategory->product_category_name; ?>">
								<input type="hidden" name="productPosition" value="<?php echo $i; ?>">
								<input type="hidden" name="brandName" value="<?php echo $related->brands->brand_name; ?>">
								<div class="col-lg-12 col-md-12 col-sm-12 product gotham-medium brand-title clearleft clearright" style="text-align: left; padding-bottom: 10px; color: #adabab;"><?php echo $related->brands->brand_name; ?></div>
								<div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-name clearleft clearright" style="text-align: left; padding-bottom: 10px;"><?php echo $related->productDetail->name; ?></div>
								<div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-price clearleft clearright" style="text-align: left; padding-bottom: 10px;">IDR <?php echo \common\components\Helpers::getPriceFormat($related->price); ?></div>
								<div class="col-lg-8 col-md-8 col-sm-8 gotham-light preorder-btn" style="margin-bottom: 50px">Pre-Order Now</div>
							</a>
						</div>
						<?php 
							$i++; 
							if ($i % 2 == 0)
								echo '<div class="clearfix"></div>';
						?>
					<?php } ?>
				<?php } ?>
            </div>
        </div>
    </div>
</div>

<style>
@media only screen and (min-width : 768px) {
    .product.product-name {
        padding-bottom: 8%;
    }
    .product.product-price {
        padding-bottom: 2%;
    }
    .product.product-name,
    .product.product-price {
        font-family: "gotham-light";
        text-align: left;
        letter-spacing: 0.5px;
        font-size: 12px;
    }
    .product.brand-title {
        font-family: "gotham-light";
        letter-spacing: 1px;
        padding-top: 6%;
        padding-bottom: 2%;
        text-align: left;
        color: #adabab;
        font-size: 12px;
    }
    .preorder-btn {
        border: 1px solid; 
        border-radius: 5px;
        text-align: center;
        font-size: 12px;
        height: 30px;
        padding-top: 5px;
        margin-bottom: 20px;
        margin-top: 10px;
        background-color: #1d6269;
        color: #fff;
    }
    .pleft-5-dwpetite {padding-left: 7%;}
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
    .container.product-box {padding-top: 2%; padding-right: 0;margin-bottom: 4%;}
}    

#owl-petite .item{
    margin: 3px 3px 3px 3px;
}
#owl-petite .item img{
    display: block;
    width: 100%;
    height: auto;
}

.owl-carousel .owl-wrapper-outer {
    width: 99%;
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
    top: 155px; 
}

.owl-theme .owl-controls .owl-buttons .owl-next{
    right: -30px;
    top: 155px;
}

.owl-theme .owl-controls .owl-buttons div {
    background: transparent;
}

.owl-pagination{
    display: none;
}
</style>