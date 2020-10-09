<?php
$breadcrumbs = $this->context->breadcrumb;

$url = explode("/",$_SERVER['REQUEST_URI']);

$urls = explode("?",$url[1]);
// echo $urls[0];

if(isset($_GET['sort'])){
	$params = 'sort=' . $_GET['sort'];
}

if(isset($_GET['brands'])){
	$params = $params . '&brands=' . $_GET['brands'];
    $brands_selection = explode('--', $_GET['brands']);
}

if(isset($_GET['price'])){
    $params = $params . '&price=' . $_GET['price'];
    $price_selection = explode('--', $_GET['price']);
}

if(isset($_GET['gender'])){
    $params = $params . '&gender=' . $_GET['gender'];
    $genders_selection = explode('--', $_GET['gender']);
}

if(isset($_GET['category'])){
    $params = $params . '&category=' . $_GET['category'];
}

if(isset($_GET['type'])){
    $params = $params . '&type=' . $_GET['type'];
    $types_selection = explode('--', $_GET['type']);
}

if(isset($_GET['movement'])){
    $params = $params . '&movement=' . $_GET['movement'];
    $movements_selection = explode('--', $_GET['movement']);
}

if(isset($_GET['bandwidth'])){
    $params = $params . '&bandwidth=' . $_GET['bandwidth'];
    $bandwidth_selection = explode('--', $_GET['bandwidth']);
}

if(isset($_GET['water'])){
    $params = $params . '&water=' . $_GET['water'];
    $waters_selection = explode('--', $_GET['water']);
}
if(isset($_GET['size'])){
    $params = $params . '&size=' . $_GET['size'];
    $size_selection = explode('--', $_GET['size']);
}

if(!isset($_GET['limit'])){
	$limit = 20;
}else{
	$limit = $_GET['limit'];
}
if(!isset($_GET['page'])){
	$current = 1;
}else{
	$current = $_GET['page'];
}

$sortby = 'none';
if(isset($_GET['sortby'])){
	$sort_name = str_replace('-', ' ', $_GET['sortby']);
	$sort_name = strtoupper($sort_name);
	$sortby = $_GET['sortby'];
}else{
	$sort_name = 'NONE';
}

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
        "list": "Flash Sale"
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
<?php
    $now = $current_date; 
    $to = date($batch_to);
    
	$batch_date = $now;
	
    $flashMicrotime = \common\components\Helpers::getDifferentMicrotime($now, $to);
    session_start();
	
	$pre_time_active = 0;
	$time_active = 0;
	$countdown_display = "";
	$countdown_day_display = "";
	
    $button1 = 0; $button2 = 0; $button3 = 0; $button4 = 0; $button5 = 0; $button6 = 0;
	if(count($arr_batch) > 2){
		list($batch1_start, $batch1_end, $batch2_start, $batch2_end) = $arr_batch;
	}else{
		list($batch1_start, $batch1_end) = $arr_batch;
	}
	
	$days = 0;
	if(!empty($arr_wave)){
		$num_diff = 0;
		list($wave1, $wave1_1, $wave2, $wave2_1) = $arr_wave;
		
		$currdate = date("Y-m-d H:i:s");
		$dateToCompare = $wave1." ".$batch1_start;
		
		if( $currdate > date($wave1." ".$batch1_end) ){
			$dateToCompare = $wave1." ".$batch2_start;
		}
		
		if( $currdate > date($wave1." ".$batch2_end) ){
			$dateToCompare = date("Y-m-d")." ".$batch1_start;
		}
		
		if( $currdate > date($wave1_1." ".$batch1_end) ){
			$dateToCompare = $wave2." ".$batch1_start;
		}
		
		if( $currdate > date($wave2." ".$batch1_end) ){
			$dateToCompare = $wave2." ".$batch2_start;
		}
		
		if( $currdate > date($wave2." ".$batch2_end) ){
			$dateToCompare = date("Y-m-d")." ".$batch1_start;
		}

		$diff = abs(strtotime($dateToCompare) - strtotime($currdate));

		$years = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

		if( $days >= 0 && $days <= 6 ){
			$countdown_day_display = date("D M j Y H:i:s", strtotime( date($dateToCompare) ));
		}
	}
	
    if(isset($_GET['sortby'])){
        if($_GET['sortby'] == "today"){
			$day = date($dateToCompare);
			
			if(isset($_GET['batch'])){
				if($_GET['batch'] == "batch-1"){
					$button1 = 1; $button2 = 0; $button3 = 0; $button4 = 0; $button5 = 0; $button6 = 0;
					if(($now >= date("Y-m-d ".$batch1_start)) && ($now <= date("Y-m-d ".$batch1_end))){
						$time_active = 1;
						$countdown_display = date("D M j Y ".$batch1_end);
					}else{
						$time_active = 0;
						if( $days >= 0 && $days <= 6 ){
							$countdown_day_display = date("D M j Y H:i:s", strtotime( date("Y-m-d ".$batch1_start) ));
						}
					}
				}
				elseif($_GET['batch'] == "batch-2"){
					$button1 = 0; $button2 = 1; $button3 = 0; $button4 = 0; $button5 = 0; $button6 = 0;
					if(($now >= date("Y-m-d ".$batch2_start)) && ($now <= date("Y-m-d ".$batch2_end))){
						$time_active = 1;
						$countdown_display = date("D M j Y ".$batch2_end);
					}else{
						$time_active = 0;
						if( $days >= 0 && $days <= 6 ){
							$countdown_day_display = date("D M j Y H:i:s", strtotime( date("Y-m-d ".$batch2_start) ));
						}
					}
				}
			}else{					
				$button1 = 1; $button2 = 0; $button3 = 0;
				if(($now >= date("Y-m-d ".$batch1_start)) && ($now <= date("Y-m-d ".$batch1_end))){
					$time_active = 1;
					$countdown_display = date("D M j Y ".$batch1_end);
				}else{
					$time_active = 0;
					if( $days >= 0 && $days <= 6 ){
						$countdown_day_display = date("D M j Y H:i:s", strtotime( date($dateToCompare) ));
					}
				}
			}
        }
        if($_GET['sortby'] == "tomorrow"){
			$day = date($dateToCompare);
			
			if(isset($_GET['batch'])){
				if($_GET['batch'] == "batch-1"){
					$button1 = 0; $button2 = 0; $button3 = 1; $button4 = 0; $button5 = 0; $button6 = 0;
					if( $days >= 0 && $days <= 6 ){
						$countdown_day_display = date("D M j Y H:i:s", strtotime( $day." - 1 days") );
					}
				}
				elseif($_GET['batch'] == "batch-2"){
					$button1 = 0; $button2 = 0; $button3 = 0; $button4 = 1; $button5 = 0; $button6 = 0;
					if( $days >= 0 && $days <= 6 ){
						$countdown_day_display = date("D M j Y H:i:s", strtotime( $day." - 1 days") );
					}
				}
			}else{
				$button1 = 0; $button2 = 1; $button3 = 0;
				$time_active = 0;
				if( $days >= 0 && $days <= 6 ){
					$countdown_day_display = date("D M j Y H:i:s", strtotime( $day." - 1 days") );
				}
			}
        }
        if($_GET['sortby'] == "nextday"){
			$day = date($dateToCompare);
			
			if(isset($_GET['batch'])){
				if($_GET['batch'] == "batch-1"){
					$button1 = 0; $button2 = 0; $button3 = 0; $button4 = 0; $button5 = 1; $button6 = 0;
					if( $days >= 0 && $days <= 6 ){
						$countdown_day_display = date("D M j Y H:i:s", strtotime( $day." - 2 days") );
					}
				}
				elseif($_GET['batch'] == "batch-2"){
					$button1 = 0; $button2 = 0; $button3 = 0; $button4 = 0; $button5 = 0; $button6 = 1;
					if( $days >= 0 && $days <= 6 ){
						$countdown_day_display = date("D M j Y H:i:s", strtotime( $day." - 2 days") );
					}
				}
			}else{
				$button1 = 0; $button2 = 0; $button3 = 1;
				$time_active = 0;
				if( $days >= 0 && $days <= 6 ){
					$countdown_day_display = date("D M j Y H:i:s", strtotime( $day." - 2 days") );
				}
			}
        }
    }else{
		$time_active = 0;
		if(($now >= date("Y-m-d ".$batch1_start)) && ($now <= date("Y-m-d ".$batch1_end))){
			$button1 = 1; $button2 = 0; $button3 = 0; $button4 = 0; $button5 = 0; $button6 = 0;
			$time_active = 1;
			$countdown_display = date("D M j Y ".$batch1_end);
		}
		elseif(($now >= date("Y-m-d ".$batch2_start)) && ($now <= date("Y-m-d ".$batch2_end))){
			$button1 = 0; $button2 = 1; $button3 = 0; $button4 = 0; $button5 = 0; $button6 = 0;
			$time_active = 1;
			$countdown_display = date("D M j Y ".$batch2_end);
		}
	}
?>
<script>
   var flashtime = new Date().getTime() + <?php echo $flashMicrotime; ?>;
   // var timeflash = "<?= date("D M j Y 16:00:00"); ?>";
   var timeflash = "<?= $countdown_display; ?>";
   var pretimeflash = "<?= $countdown_day_display; ?>";
</script>

<style>
	.flash-button{
		width:100%;
		text-align:center;
		border: 1px solid #1d6068;
		cursor: pointer;
		border-radius: 20px;
		padding: 10px;
		padding-left: 8px;
		padding-right: 8px;
		letter-spacing: 1.5px;
		background: #fff;
		color: #1d6068;
		float:left;
		font-size:11px;
	}
	.flash-button:hover,.flash-button.active{
		background: #1d6068;
		color: #fff; 
		border: 1px solid #1d6068;
	}
	@media only screen and (max-width: 415px) {
		.flash-button{
			font-size:10px;
			padding-left: 0px;
			padding-right: 0px;
		}
	}
</style>
<?php 
	// $this->registerJs('
			// $(function () { 
				// alert("Hi");
			// });
		// ', View::POS_END); 
	$this->registerJs(
		'$("document").ready(function(){
			var note = "COBA";
			// alert(note); 
		});'
	);
?>
<div class="hidden-lg hidden-xs"></div>
<section class="ptop1" style="padding-top:0px;padding-bottom:0;">
    <div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright mbottom3">
				<div class="thumbnail-flash-sale">
					<a data-toggle="modal" data-target="#flashModal" style="cursor: pointer;">
					<?php  //if($wave_state == "wave-1"){ ?>
						<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/flash/header-desktop-13072018.jpg?auto=compress%2Cformat&amp;fm=pjpg" data-was-processed="true" class="img-responsive hidden-xs" style="display: block;margin: auto;">
						<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/flash/header-mobile-13072018.jpg?auto=compress%2Cformat&amp;fm=pjpg" data-was-processed="true" class="img-responsive hidden-lg hidden-md hidden-sm" style="display: block;margin: auto;">
					<?php //} ?>
						<span class="caption-flash-sale <?php echo $time_active == 0 ? 'visible':'hidden';?>">
							<!-- <span class="gotham-light flash-sisa">Sisa Waktu</span><br><span class="gotham-medium flash-title">FLASH SALE</span><br> -->
							<!-- <span id="countdown-product"></span> -->
							<span id="countdown-pre-flash-sale"></span>
						</span>
						
						<span class="caption-flash-sale <?php echo $time_active == 0 ? 'hidden':'visible';?>">
							<span class="gotham-light flash-sisa">Sisa Waktu</span><br><span class="gotham-medium flash-title">FLASH SALE</span><br>
							<!-- <span id="countdown-product"></span> -->
							<span id="countdown-flash-sale"></span>
						</span>
					</a>
				</div>
			</div>
			<!--
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 clearright pleft-5-dwpetite" style="padding-top:0px;">		
				<div class="brand-name-full" style="font-family: gotham-light;">
					<h1 class="fsize-13 gotham-medium mtop0">Olivia Burton Flash Sale</h1>
				</div>
				<div class="brand-description" style="text-align:left;">

						The Watch Co. mempersembahkan promo koleksi jam tangan Olivia Burton. Sekarang, kamu bisa memiliki koleksinya dengan harga spesial. <br>
						<br>
						Syarat dan ketentuan: <br>
						<ol>
							<li>Dapatkan harga spesial untuk produk Olivia Burton yang tersedia di halaman ini</li>
							<li>Nikmati cicilan 0% untuk pembayaran minimal Rp. 500.000,- dengan tenor 3, 6, dan 12 bulan</li>
							<li>Gratis ongkir bisa didapatkan dengan pembelanjaan minimum Rp. 1.000.000,-</li>
							<li>Extra diskon dapat digunakan memasukan kode voucher:  <span class="gotham-medium">OBEXTRA10</span></li>
							<li>Olivia Burton Flash Sale ini hanya bisa dinikmati hanya tanggal 31 Oktober 2018, jam 10.00 – 14.00 wib</li>
						</ol>
				</div>
			</div>
			-->
		</div>
    </div>
</section>
<section class="ptop1" style="padding-bottom:0;">
    <div class="container">
        <div class="row">
        </div>
    </div>
</section>

<section style="padding-top:0;padding-bottom:0;">
    <div class="container">
        <div class="row">
            <?php 
                // Setting Button Time				
				if(count($arr_batch) < 3){
					$next_day = date("d/m/Y", strtotime("+2 days"));
					
					$batch1_start_s = substr($batch1_start, 0, 5);
					$batch1_end_s = substr($batch1_end, 0, 5);
					$btn_today = "Hari Ini ".$batch1_start_s." - ".$batch1_end_s;
					$btn_tomorrow = "Besok ".$batch1_start_s." - ".$batch1_end_s;
					$btn_nextday = $next_day." ".$batch1_start_s." - ".$batch1_end_s;
			?>
					<section id="breadcrumb" style="padding-top:20px;padding-bottom:20px;">
						<div class="col-lg-12 col-md-12 hidden-xs col-sm-12 clearleft clearright" style=padding-bottom:20px;>
							<div class="col-lg-4 clearleft pright75"><a href="<?php echo \yii\helpers\Url::base(); ?>/flash-sale?sortby=today" class="flash-button <?php echo $button1 == 1 ? 'active':'' ?>"><?php echo $btn_today; ?></a></div>
							<div class="col-lg-4 clearleft pright75"><a href="<?php echo \yii\helpers\Url::base(); ?>/flash-sale?sortby=tomorrow" class="flash-button <?php echo $button2 == 1 ? 'active':'' ?>"><?php echo $btn_tomorrow; ?></a></div>
							<div class="col-lg-4 clearleft pright75"><a href="<?php echo \yii\helpers\Url::base(); ?>/flash-sale?sortby=nextday" class="flash-button <?php echo $button3 == 1 ? 'active':'' ?>"><?php echo $btn_nextday; ?></a></div>
							
							<!-- khusus 1 button saja -->
							<!-- <div class="col-lg-2 clearleft pright75"><a class="flash-button active"><?php echo $batch_all; ?></a></div> -->
						</div>
						<div class="swiper-flash-menu-mobile col-xs-12 hidden-lg hidden-md hidden-sm" style="padding-bottom:20px;overflow-y:hidden;">
							<div class="swiper-wrapper">
								<div class="col-lg-4 clearleft pright75"><a href="<?php echo \yii\helpers\Url::base(); ?>/flash-sale?sortby=today" class="flash-button <?php echo $button1 == 1 ? 'active':'' ?> text-small"><?php echo $btn_today; ?></a></div>
								<div class="col-lg-4 clearleft pright75"><a href="<?php echo \yii\helpers\Url::base(); ?>/flash-sale?sortby=tomorrow" class="flash-button <?php echo $button2 == 1 ? 'active':'' ?> text-small"><?php echo $btn_tomorrow; ?></a></div>
								<div class="col-lg-4 clearleft pright75"><a href="<?php echo \yii\helpers\Url::base(); ?>/flash-sale?sortby=nextday" class="flash-button <?php echo $button3 == 1 ? 'active':'' ?> text-small"><?php echo $btn_nextday; ?></a></div>
							  
							  <!-- <div class="swiper-slide"><a class="flash-button active"><?php echo $batch_all; ?></a></div> -->
				
							</div>
						</div>
					</section>
			<?php
				}else{
					$next_day = date("d/m/Y", strtotime("+2 days"));
					
					$batch1_start_s = substr($batch1_start, 0, 5);
					$batch1_end_s = substr($batch1_end, 0, 5);
					$batch2_start_s = substr($batch2_start, 0, 5);
					$batch2_end_s = substr($batch2_end, 0, 5);
					
					$btn_today = "Hari Ini ".$batch1_start_s." - ".$batch1_end_s;
					$btn_today_2 = "Hari Ini ".$batch2_start_s." - ".$batch2_end_s;
					$btn_tomorrow = "Besok ".$batch1_start_s." - ".$batch1_end_s;
					$btn_tomorrow_2 = "Besok ".$batch2_start_s." - ".$batch2_end_s;
					$btn_nextday = $next_day." ".$batch1_start_s." - ".$batch1_end_s;
					$btn_nextday_2 = $next_day." ".$batch2_start_s." - ".$batch2_end_s;
			?>
					<section id="breadcrumb" style="padding-top:20px;padding-bottom:20px;">
						<div class="col-lg-12 col-md-12 hidden-xs col-sm-12 clearleft clearright" style="padding-bottom:20px;">
							<div class="col-lg-2 clearleft pright75"><a href="<?php echo \yii\helpers\Url::base(); ?>/flash-sale?sortby=today&batch=batch-1" class="flash-button <?php echo $button1 == 1 ? 'active':'' ?>"><?php echo $btn_today; ?></a></div>
							<div class="col-lg-2 clearleft pright75"><a href="<?php echo \yii\helpers\Url::base(); ?>/flash-sale?sortby=today&batch=batch-2" class="flash-button <?php echo $button2 == 1 ? 'active':'' ?>"><?php echo $btn_today_2; ?></a></div>
							<div class="col-lg-2 clearleft pright75"><a href="<?php echo \yii\helpers\Url::base(); ?>/flash-sale?sortby=tomorrow&batch=batch-1" class="flash-button <?php echo $button3 == 1 ? 'active':'' ?>"><?php echo $btn_tomorrow; ?></a></div>
							<div class="col-lg-2 clearleft pright75"><a href="<?php echo \yii\helpers\Url::base(); ?>/flash-sale?sortby=tomorrow&batch=batch-2" class="flash-button <?php echo $button4 == 1 ? 'active':'' ?>"><?php echo $btn_tomorrow_2; ?></a></div>
							<div class="col-lg-2 clearleft pright75"><a href="<?php echo \yii\helpers\Url::base(); ?>/flash-sale?sortby=nextday&batch=batch-1" class="flash-button <?php echo $button5 == 1 ? 'active':'' ?>"><?php echo $btn_nextday; ?></a></div>
							<div class="col-lg-2 clearleft pright75"><a href="<?php echo \yii\helpers\Url::base(); ?>/flash-sale?sortby=nextday&batch=batch-2" class="flash-button <?php echo $button6 == 1 ? 'active':'' ?>"><?php echo $btn_nextday_2; ?></a></div>
							
							<!-- khusus 1 button saja -->
							<!-- <div class="col-lg-2 clearleft pright75"><a class="flash-button active"><?php echo $batch_all; ?></a></div> -->
						</div>
						<div class="swiper-flash-menu-mobile col-xs-12 hidden-lg hidden-md hidden-sm" style="padding-bottom:20px;overflow-y:hidden;">
							<div class="swiper-wrapper"><a href="<?php echo \yii\helpers\Url::base(); ?>/flash-sale?sortby=today&batch=batch-1" class="flash-button <?php echo $button1 == 1 ? 'active':'' ?> text-small"><?php echo $btn_today; ?></a></div>
							<div class="swiper-wrapper"><a href="<?php echo \yii\helpers\Url::base(); ?>/flash-sale?sortby=today&batch=batch-2" class="flash-button <?php echo $button2 == 1 ? 'active':'' ?> text-small"><?php echo $btn_today_2; ?></a></div>
							<div class="swiper-wrapper"><a href="<?php echo \yii\helpers\Url::base(); ?>/flash-sale?sortby=tomorrow&batch=batch-1" class="flash-button <?php echo $button3 == 1 ? 'active':'' ?> text-small"><?php echo $btn_tomorrow; ?></a></div>
							<div class="swiper-wrapper"><a href="<?php echo \yii\helpers\Url::base(); ?>/flash-sale?sortby=tomorrow&batch=batch-2" class="flash-button <?php echo $button4 == 1 ? 'active':'' ?> text-small"><?php echo $btn_tomorrow_2; ?></a></div>
							<div class="swiper-wrapper"><a href="<?php echo \yii\helpers\Url::base(); ?>/flash-sale?sortby=nextday&batch=batch-1" class="flash-button <?php echo $button5 == 1 ? 'active':'' ?> text-small"><?php echo $btn_nextday; ?></a></div>
							<div class="swiper-wrapper"><a href="<?php echo \yii\helpers\Url::base(); ?>/flash-sale?sortby=nextday&batch=batch-2" class="flash-button <?php echo $button6 == 1 ? 'active':'' ?> text-small"><?php echo $btn_nextday_2; ?></a></div>
						</div>
					</section>
			<?php
				}
            ?>
            
            <?php
            if (count($products) > 0) {
			?>
				<section id="all-product">
				  <div class="container product-box clearleft" style="padding-top:20px;">
					<div class="row">
					  <!-- Filter Desktop -->
					  <style type="text/css">
						@media only screen and (min-width: 415px) {
						  .flashing.col-lg-2{
							width: 20%;
						  }
						}
					  </style>
					<?php $i = 1; ?>
				   <div class="col-lg-12 col-md-12 product-box space-cont-product">
					<?php 
					// var_dump($products);exit();
					foreach ($products as $product) {
						if ($i == 1) {
					?>
						<div class="col-lg-12 col-md-12 product-box clearleft clearright clearleft-mobile clearright-mobile">
							<div class="row">
					<?php } 
					
							if ($i == 6 || $i == 11 || 
								$i == 16 || $i == 21 || $i == 16 || 
								$i == 31 || $i == 36 || $i == 41 ||
								$i == 46 || $i == 51 || $i == 56 || $i == 61 ||
								$i == 66 || $i == 71 || $i == 76 || $i == 81 ||
								$i == 86 || $i == 91 || $i == 96 || $i == 101) 
							{ 
					?>
							<div class="hidden-sm hidden-xs col-lg-12 col-md-12 cont product-box clearleft clearright clearleft-mobile clearright-mobile">
								<div class="row">
					<?php 	} ?>
								<div class="hidden-sm flashing col-lg-2 col-md-3 space-product hidden-xs <?php echo $i % 2 == 0 ? 'pleft75' : 'pright75'; ?> mbottom-3-mobile">
									<?php
										$stock_spec = 0;
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
									<a class="productClick" <?php echo $stock->quantity == 0 ? 'id="out-of-stock" data-id="'.$product->product_id.'"' : ''; ?> href="<?php echo \yii\helpers\Url::base(); ?>/flash/<?php echo $product->productDetail->link_rewrite; ?>">
										<?php } else { ?>
										<a class="productClick" href="<?php echo \yii\helpers\Url::base(); ?>/flash/<?php echo $product->productDetail->link_rewrite; ?>">
										<?php } ?>
										<div style="position:relative;">
											<div class="tag">
												<?php
												$spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->andWhere(['is_flash_sale'=>1])->all();
												if ($spesificPriceAll != null) {
													foreach ($spesificPriceAll as $specificPrice) {
														if($specificPrice->from <= $batch_date && $specificPrice->to > $batch_date) {
															$stock_spec = $specificPrice->flash_sale_qty;
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
												}
												?>
											</div>
											<?php
												if($product->productNewArrival->product_newarrival_start_date <= $now && $product->productNewArrival->product_newarrival_end_date >= $now){
											?>
												 <div class="tag-bellow" style='background-color: #4c757b;position: absolute;width: 100%;bottom: 0;top: auto;'>
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
												<img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive <?php echo $stock->quantity == 0 && $time_active == 1 ? 'out-of-stock' : ''; ?>">
											<?php
												echo $stock->quantity == 0 && $time_active == 1 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
											?>
											<?php
											} else {
											?>
												<img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive">
											<?php } ?>
										</div>
										<?php
											$stock_bar = 100 - ($stock->quantity / $stock_spec * 100);
										?>
										<div class="col-lg-12 col-md-12 col-sm-12 clearright-mobile clearleft-mobile flash-bar full">
											<div class="stock" style="width:<?php echo $stock->quantity == 0 && $time_active == 0 ? '0': $stock_bar; ?>%"></div>
										</div>
										<input type="hidden" name="productId" value="<?php echo $product->product_id; ?>">
										<input type="hidden" name="productName" value="<?php echo $product->productDetail->name; ?>">
										<input type="hidden" name="brandName" value="<?php echo $product->brands->brand_name; ?>">
										<input type="hidden" name="opt_list" value="<?php echo $breadcrumbs[0] . ' - ' . $breadcrumbs[2]; ?>">
										<input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
										<input type="hidden" name="productPosition" value="<?php echo $i; ?>">
										<div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
										<div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace0-5"><?php echo ucwords($product->productDetail->name); ?></span></div>
										<?php if( $time_active == 1){ ?>
											<?php
												// if product has discount
												$spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->andWhere(['is_flash_sale'=>1])->all();
												$discount = 0;
										  
												$check_discount = 0;
												if ($spesificPriceAll != null) {
													?>
													<?php
													  foreach ($spesificPriceAll as $spesificPrice) {
														?>
															<?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $batch_date || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $batch_date) { ?>
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
										<?php }else{ ?>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
												Coming Soon
											</div
										<?php } ?>
									</a>
								</div>

								<?php
								if ($i % 5 == 0) {
									echo '<div class="hidden-xs hidden-sm clearfix"></div>';
								}

								if ($i % 2 == 0){
									echo '<div class="hidden-lg hidden-md hidden-sm clearfix"></div>';
								}
								?>
								<?php if ($i == 5 || $i == 10 || $i == 15 || $i == 20 ||
										  $i == 25 || $i == 30 || $i == 35 || $i == 40 ||
										  $i == 45 || $i == 50 || $i == 55 || $i == 60 || $i == 65 ||
										  $i == 70 || $i == 75 || $i == 80 || $i == 85 || $i == 90 || $i == 95 ||
										 
										  $i == 100) { ?>
										  
								</div>
							</div>
						<?php } ?>


						<?php $i++; ?>
					<?php } ?>
					</div>
					</div>
					<?php $i = 1; ?>
					<?php if ($i == 1) { ?>
							  <div class="col-sm-12 col-xs-12 hidden-lg hidden-md product-box clearleft clearright clearleft-mobile clearright-mobile">
								  <div class="row">
					  <?php } ?>
					<?php foreach ($products as $product) { ?>
					<?php if ($i == 5 || $i == 9 ||
							  $i == 13 || $i == 17 || $i == 21 ||
							  $i == 25 || $i == 29 || $i == 33 ||
							  $i == 37 || $i == 41 || $i == 45 ||
							  $i == 49 || $i == 53 || $i == 57 ||
							  $i == 61 || $i == 65 || $i == 69 || 
							  $i == 73 || $i == 77 || $i == 81 || 
							  $i == 85 || $i == 89 || $i == 93 || 
							  $i == 97 || $i == 101) { ?>
							<div class="hidden-lg hidden-md col-xs-12 col-sm-12 container product-box clearleft clearleft-mobile clearright-mobile">
								<div class="row">
						<?php } ?>
								<div class="col-sm-3 col-xs-6 <?php echo $i % 2 == 0 ? 'pleft75' : 'pright75'; ?>">
									<?php
										$stock_spec = 0;
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
									<a class="productClick" <?php echo $stock->quantity == 0 ? 'id="out-of-stock" data-id="'.$product->product_id.'"' : ''; ?> href="<?php echo \yii\helpers\Url::base(); ?>/flash/<?php echo $product->productDetail->link_rewrite; ?>">
										<?php } else { ?>
										<a class="productClick" href="<?php echo \yii\helpers\Url::base(); ?>/flash/<?php echo $product->productDetail->link_rewrite; ?>">
										<?php } ?>
										<div style="position:relative;">
											<div class="tag">
												
												<?php
												$spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->andWhere(['is_flash_sale'=>1])->all();
												if ($spesificPriceAll != null) {
												  foreach ($spesificPriceAll as $specificPrice) {
													?>
													  <?php
														  if ($specificPrice->from <= $batch_date && $specificPrice->to > $batch_date) {
															  $stock_spec = $specificPrice->flash_sale_qty;
															  ?>
															  <?php if($batch_from <= $current_date && $batch_to >= $current_date){ ?>
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
															  <?php } ?>
															  <?php
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
												 <div class="tag-bellow" style='background-color: #4c757b;position: absolute;width: 100%;bottom: 0;top: auto;'>
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
											<img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive <?php echo $stock->quantity == 0 && $time_active == 1 ? 'out-of-stock' : ''; ?>">
											<?php
												echo $stock->quantity == 0 && $time_active == 1 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
											?>
											<?php
											} else {
											?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive">

											<?php } ?>
										</div>
										<?php
											$stock_bar = 100 - ($stock->quantity / $stock_spec * 100);
										?>
										<div class="col-lg-12 col-md-12 col-sm-12 clearright-mobile clearleft-mobile flash-bar full">
											<div class="stock" style="width:<?php echo $stock->quantity == 0 && $time_active == 0 ? '0': $stock_bar; ?>%"></div>
										</div>
										<input type="hidden" name="productId" value="<?php echo $product->product_id; ?>">
										<input type="hidden" name="productName" value="<?php echo $product->productDetail->name; ?>">
										<input type="hidden" name="productPrice" value="<?php echo $product->price - $discount; ?>">
										<input type="hidden" name="brandName" value="<?php echo $product->brands->brand_name; ?>">
										<input type="hidden" name="opt_list" value="<?php echo $breadcrumbs[0] . ' - ' . $breadcrumbs[2]; ?>">
										<input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
										<input type="hidden" name="productPosition" value="<?php echo $i; ?>">
										<div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
										<div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace0-5"><?php echo ucwords($product->productDetail->name); ?></span></div>
										<?php if( $time_active == 1){ ?>
											<?php
												// if product has discount
												$spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->andWhere(['is_flash_sale'=>1])->all();
												$discount = 0;
										 
												$check_discount = 0;
												if ($spesificPriceAll != null) {
													?>
													<?php
													  foreach ($spesificPriceAll as $spesificPrice) {
														?>
															<?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $batch_date || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $batch_date) { ?>
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
										<?php }else{ ?>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
												Coming Soon
												</div
										<?php } ?>
									</a>
								</div>

								<?php
								if ($i % 4 == 0) {
									echo '<div class="hidden-xs hidden-lg hidden-md clearfix"></div>';
								}

								if ($i % 2 == 0){
									echo '<div class="hidden-lg hidden-md hidden-sm clearfix"></div>';
								}
								?>
								<?php if ($i == 4 || $i == 8 || $i == 12 || $i == 16 ||
										  $i == 20 || $i == 24 || $i == 28 || $i == 32 ||
										  $i == 36 || $i == 40 || $i == 44 || $i == 48 || $i == 52 ||
										  $i == 56 || $i == 60 || $i == 64 || $i == 68 || $i == 72 || $i == 76 || $i == 80 ||
										  $i == 84 || $i == 88 || $i == 92 || $i == 96 ||
										  $i == 100 || $i == 104) { ?>
								</div>
							</div>
						<?php } ?>
					<?php $i++; ?>
					<?php } ?>
					</div>
				  </div>
				</section>
    <?php //if($count > 4) {  ?>
			<section id="all-product-footer">
				<div class="container product-box">
					<div class="row font-paging">
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
						 ?>

						 <?php
							 echo Yii::$app->view->renderFile('@app/views/promo/page_number.php', array(
								 "current" => $current,
								 "breadcrumbs" => $breadcrumbs,
								 "total_page" => $total_page,
								 "limit" => $limit,
								 "params"=> $params,
								 "sortby"=> $sortby,

							 ));
						 ?>
					</div>

				</div>
				
				<div class="col-lg-12 col-md-12 col-sm-12 clearleft clearright" style="text-align: center;">
				  
				</div>
			</section>
			<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icon_top.png" class="scrollup"></a>
    <!-- Ini --> <?php  //} ?>
<?php } else { ?>
			<section id="product">
			<div class="hidden-sm container product-box clearleft">
				<div class="row">
					<!-- Filter Desktop -->
					<div class="col-lg-12 col-md-12 col-sm-12 ptop5 pbottom3">
						<center><span class="gotham-light fsize-1" style="font-size: 25px;">COMING SOON</span></center>
					</div>
				</div>
			</div>
			</section>
<?php } ?>
        </div>
    </div>
</section>

<section class="" style="padding-top:88px;"></section>
<!--SEO Pages-->
<section style=" padding: 0px 0;z-index;1;">
    <div class="col-lg-12 col-md-12 col-sm-12" style="background-color: #fff;z-index: 1;
    margin-top: -70px;">  
        <div class="container clearleft">
                                <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs clearleft" style="padding-top: 30px; padding-bottom: 30px; text-align: justify;">
                        
                            <p class="seodesc"><strong>Flash Sale The Watch Co.&nbsp;</strong></p>

<p class="seodesc">Flash sale adalah penjualan suatu produk oleh perusahaan atau toko dalam waktu tertentu. Biasanya waktunya sangat singkat dan terbatas. Di luar negeri, istilah flash sale biasa disebut “deal of the day”. Apapun itu istilahnya, flash sale merupakan promo yang sering dinanti bagi yang hobi belanja.&nbsp;</p>

<p class="seodesc">Di Indonesia, seiring perkembangan e-commerce yang pesat,  flash sale sudah menjadi momen yang paling ditunggu-tunggu oleh banyak orang. Mereka biasanya menanti untuk mendapatkan barang/produk dengan harga yang super murah. </p>

<p class="seodesc">Kini The Watch Co. menghadirkan flash sale bagi para pecinta fashion untuk mendapatkan produk favoritnya. Kamu bisa memiliki aksesoris berupa jam tangan, strap, tas, jaket, dan lain sebagainya dengan harga terbaik. </p>
                       
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs" style="padding-top: 30px; padding-bottom: 30px; text-align: justify;">
                            
                                <p class="seodesc"><strong>Pilih Produk Favoritmu di Flash Sale Sekarang</strong></p>

<p class="seodesc">Tak perlu berpikir panjang untuk mengikuti flash sale ini. Kenapa? Karena waktunya sangat terbatas dan singkat. Selain itu, stok produk yang tersedia pun cukup terbatas. Oleh karena itu, sebaiknya kamu memanfaatkan waktu dengan sebaik mungkin untuk mendapatkan produknya.</p>

<p class="seodesc">Fakta flash sale yang terjadi di Indonesia adalah berapapun produk yang disediakan oleh perusahaan/toko biasanya habis hanya dalam hitungan menit saja. Jadi, banyak sekali orang-orang yang antusias dalam mengikuti acara ini.</p>

<p class="seodesc">Cara terbaik untuk mendapatkan produk pilihanmu, kamu harus standby sebelum waktu flash sale di mulai. Ketika waktu flash sale mulai, kamu langsung pilih produk yang kamu inginkan, lalu langsung check out. Setelah itu langsung dibayarkan agar produk pilihanmu tidak diambil orang lain.  </p>
                            
                    </div>
                    <!--mobile version-->
                    <div class="hidden-lg hidden-md hidden-sm" id="readmore" style="padding-top: 11px; padding-bottom: 1px; text-align: justify;">
                        <p class="show-read-more">
                            </p><p class="seodesc"><strong>Flash Sale The Watch Co.&nbsp;</strong></p>

<p class="seodesc">Flash sale adalah penjualan suatu produk oleh perusahaan atau toko dalam waktu tertentu. Biasanya waktunya sangat singkat dan terbatas. Di luar negeri, istilah flash sale biasa disebut “deal of the day”. Apapun itu istilahnya, flash sale merupakan promo yang sering dinanti bagi yang hobi belanja...<br><br><a>(Baca Selengkapnya)</a>                        </p>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm" id="left" style="padding-top: 11px; padding-bottom: 1px; text-align: justify; display: none;">
                        <p class="show-read-more">
                            </p><p class="seodesc"><strong>Flash Sale The Watch Co.&nbsp;</strong></p>

<p class="seodesc">Flash sale adalah penjualan suatu produk oleh perusahaan atau toko dalam waktu tertentu. Biasanya waktunya sangat singkat dan terbatas. Di luar negeri, istilah flash sale biasa disebut “deal of the day”. Apapun itu istilahnya, flash sale merupakan promo yang sering dinanti bagi yang hobi belanja.&nbsp;</p>

<p class="seodesc">Di Indonesia, seiring perkembangan e-commerce yang pesat,  flash sale sudah menjadi momen yang paling ditunggu-tunggu oleh banyak orang. Mereka biasanya menanti untuk mendapatkan barang/produk dengan harga yang super murah. </p>

<p class="seodesc">Kini The Watch Co. menghadirkan flash sale bagi para pecinta fashion untuk mendapatkan produk favoritnya. Kamu bisa memiliki aksesoris berupa jam tangan, strap, tas, jaket, dan lain sebagainya dengan harga terbaik. </p>
                        <p></p>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm" id="right" style="padding-top: 11px; padding-bottom: 1px; text-align: justify; display: none;">
                        <p class="show-read-more">
                            </p><p class="seodesc"><strong>Pilih Produk Favoritmu di Flash Sale Sekarang</strong></p>

<p class="seodesc">Tak perlu berpikir panjang untuk mengikuti flash sale ini. Kenapa? Karena waktunya sangat terbatas dan singkat. Selain itu, stok produk yang tersedia pun cukup terbatas. Oleh karena itu, sebaiknya kamu memanfaatkan waktu dengan sebaik mungkin untuk mendapatkan produknya.</p>

<p class="seodesc">Fakta flash sale yang terjadi di Indonesia adalah berapapun produk yang disediakan oleh perusahaan/toko biasanya habis hanya dalam hitungan menit saja. Jadi, banyak sekali orang-orang yang antusias dalam mengikuti acara ini.</p>

<p class="seodesc">Cara terbaik untuk mendapatkan produk pilihanmu, kamu harus standby sebelum waktu flash sale di mulai. Ketika waktu flash sale mulai, kamu langsung pilih produk yang kamu inginkan, lalu langsung check out. Setelah itu langsung dibayarkan agar produk pilihanmu tidak diambil orang lain.  </p>

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

<div id="flashModal" class="modal warranty fade" role="dialog">
  <div class="modal-dialog warranty" style="vertical-align: middle;margin-top: 10%;margin-bottom: 10%;">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 10px;background-color: rgb(218,216,217);display: inline-block;">
      <div class="modal-body" style="padding-top: 15px;">
        <!-- <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/x-black-24.png" style="width: 17px;"> </button> -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile talign-left">              
			<span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
				Info Promo
			</span>
		</div>
                        
      </div>
      <div class="modal-body title-warranty" style="padding-left:0;padding-right:0;margin-top:10px;padding-top:5px;height:240px;">
        
        <hr style="margin-top: 0px;margin-bottom: 5px;margin-left:15px;margin-right:15px;border-top:1px solid rgb(69,69,69);">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile talign-left gotham-light">
            <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile talign-center" style="padding-top: 10px;">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/watch.png" style="width: 35px;">
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 5px;">
                Periode Promo
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                16 Juni 2018 - 18 Juni 2018
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile talign-center" style="padding-top: 15px;">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/cost.png" style="width: 50px;">
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 10px;">
                Minimum Transaksi
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                Rp. 0
              </div>
            </div> -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-medium">
                Flash Sale Timex Agustus 2018 mulai dari 300ribuan!
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                Nikmati promo spesial dalam menyambut Hari Ulang Tahun Kermerdekaan Republik Indonesia, The Watch Co. memberikan harga diskon jam tangan Timex.
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                Syarat dan ketentuan:
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                <ol>
                    <li>Promo berjalan pada tanggal 15 dan 16 Agustus 2018 tiap jam 11.00 – 14.00 WIB.</li>
                    <li>Promo berlaku hanya produk yang terdapat pada halaman flash sale pada website The Watch Co.</li>
                    <li>Satu akun hanya dapat membeli produk maksimal dua buah tiap periodenya.</li>
                    <li>Pengiriman produk flash sale mulai diproses pada hari senin, 20 Agustus 2018</li>
                </ol>

            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile talign-center" style="padding-bottom: 50px;">
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile talign-center">
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 clearleft clearright clearleft-mobile clearright-mobile talign-center">
          <a style="width: 100%;
    text-align: center;
    border: 1px solid rgb(158,131,97);
    cursor: pointer;
    border-radius: 20px;
    padding: 10px;
    padding-left: 8px;
    padding-right: 8px;
    letter-spacing: 1.5px;
    background: rgb(158,131,97);
    color: #fff;
    float: left;
    font-size: 11px;" data-dismiss="modal">
              Lanjut Belanja
          </a>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile talign-center">
        </div>
      </div>
    </div>
    
  </div>
</div>