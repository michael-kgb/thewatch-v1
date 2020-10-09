<?php
session_start();

$breadcrumbs = $this->context->breadcrumb;

$urls = explode("?",$_SERVER['REQUEST_URI']);
$url  = explode("/",$urls[0]);

if(stripos($_SERVER['SERVER_NAME'], 'localhost')==false){
    $page_url = $url[1];
}else{
    if(count($url) > 2){
        $page_url = $url[1].'/'.$url[2];
    }else{
        $page_url = $url[1];
    }
}




if(isset($_GET['sort'])){
	$params = 'sort=' . $_GET['sort'];
}

if(isset($_GET['batch'])){
	$params = '&batch=' . $_GET['batch'];
}else{
	
	

    if(substr($current_date,0,10)==$start_date){
		$_GET['batch'] = 1;
        $params = '&batch=1';
        
      }else if(substr($current_date,0,10)==$mid_date){
		$_GET['batch'] = 2;
        $params = '&batch=2';

      }else if(substr($current_date,0,10)==$end_date){
		  $_GET['batch'] = 3;
        $params = '&batch=3';
      }
	
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

$limit = 20;
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

    $link_btn1 = \yii\helpers\Url::base()."/".$page_url."?batch=1";
    $link_btn2 = \yii\helpers\Url::base()."/".$page_url."?batch=2";
    $link_btn3 = \yii\helpers\Url::base()."/".$page_url."?batch=3";
    $link_btn4 = \yii\helpers\Url::base()."/".$page_url."?batch=4";

    $button1 = 0; $button2 = 0; $button3 = 0; $button4 = 0;
	if(count($arr_batch) > 2){
		list($batch1_start, $batch1_end, $batch2_start, $batch2_end) = $arr_batch;
		
	}else{
		list($batch1_start, $batch1_end) = $arr_batch;
	}
    
    if(isset($_GET['batch'])){
        if(isset($_GET['batch']) && $_GET['batch'] == 1){
            $button1 = 1;
        }else if(isset($_GET['batch']) && $_GET['batch'] == 2){
            $button2 = 1;
        }else if(isset($_GET['batch']) && $_GET['batch'] == 3){
            $button3 = 1;
        }
    }else {
        if(substr($current_date,0,10)==$start_date){
            $button1 = 1;
          }else if(substr($current_date,0,10)==$mid_date){
            $button2 = 1;
          }else if(substr($current_date,0,10)==$end_date){
            $button3 = 1;
          }
        
    }

	$n_countdown_display = date("d F Y H:i:s", strtotime($countdown_sale));
	$n_countdown_day_display = date("d F Y H:i:s", strtotime($countdown_pre_sale));
?>
<script>
   var timeflash_mb = "<?= $n_countdown_display; ?>";
   var pretimeflash_mb = "<?= $n_countdown_day_display; ?>";
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
	$this->registerJs(
		'$("document").ready(function(){
			var note = "COBA";
			// alert(note); 
		});'
	);
?>
<div class="hidden-lg hidden-xs"></div>
<section class="ptop1" style="padding-top:0px;padding-bottom:0;">
    <!--
    <div class="container">
		<div class="row">
        -->
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright mbottom3">
				<div class="thumbnail-flash-sale" style="width:100%;">
					<a data-toggle="modal" data-target="#flashModal" style="cursor: pointer;">
						<img style="width:100%;" src="<?php echo Yii::$app->params['imgixUrl'].$banner_desktop; ?>" data-was-processed="true" class="img-responsive hidden-xs" style="display: block;margin: auto;">
						<img src="<?php echo Yii::$app->params['imgixUrl'].$banner_mobile; ?>" data-was-processed="true" class="img-responsive hidden-lg hidden-md hidden-sm" style="display: block;margin: auto;">
						<span class="caption-flash-sale <?php echo $time_active == 0 ? 'visible':'hidden';?>">
							<span id="countdown-pre-flash-sale"></span>
							<!--<span id="countdown"></span>-->
						</span>
						
						<span class="caption-flash-sale <?php echo $time_active == 0 ? 'hidden':'visible';?>">
							<!--<span class="gotham-light flash-sisa">Sisa Waktu</span><br><span class="gotham-medium flash-title">FLASH SALE</span><br>-->
							<span id="countdown-flash-sale"></span>
						</span>
					</a>
				</div>
			</div>
        <!--
		</div>
    </div>
    -->
</section>

<section style="padding-top:25;padding-bottom:25;">
    <div class="container">
        <div class="row">
		
		
        <?php 
		if(isset($_GET['batch'])){
			$batch = 'batch='.$_GET['batch'];
		}else{
            if(substr($current_date,0,10)==$start_date){

                $batch = 'batch=1';
                
              }else if(substr($current_date,0,10)==$mid_date){
        
                $batch = 'batch=2';
        
              }else if(substr($current_date,0,10)==$end_date){
                $batch = 'batch=3';
              }
		}
        $this_day = date('Y-m-d');
        $date_today_1 = $start_date." ".$start_batch[0]." - ".$end_batch[0];
        $date_today_2 = $mid_date." ".$start_batch[1]." - ".$end_batch[1];
        $date_today_3 = $end_date." ".$start_batch[2]." - ".$end_batch[2];
            // Setting Button Time			
			if(count($arr_batch) > 2){
				$batch1_start_s = substr($batch1_start, 0, 5);
				$batch1_end_s = substr($batch1_end, 0, 5);
				$batch2_start_s = substr($batch2_start, 0, 5);
				$batch2_end_s = substr($batch2_end, 0, 5);
				
				if($time_active === 1){
					$btn_today = "Hari Ini ".$batch1_start_s." - ".$batch1_end_s;
					$btn_today_2 = "Hari Ini ".$batch2_start_s." - ".$batch2_end_s;
					$btn_tomorrow = "Besok ".$batch1_start_s." - ".$batch1_end_s;
					$btn_tomorrow_2 = "Besok ".$batch2_start_s." - ".$batch2_end_s;
				}else{
                    $split_curr_date = substr($start_date, 0, 10);
                    $sale_date = date($split_curr_date);

                    
                    $tomorrow_day = date("d/m/Y", strtotime( $sale_date." +1 days"));

					
					$btn_tomorrow = $tomorrow_day." ".$batch1_start_s." - ".$batch1_end_s;
					$btn_tomorrow_2 = $tomorrow_day." ".$batch2_start_s." - ".$batch2_end_s;
				}
		?>
			<section style="padding-top:20px;padding-bottom:20px;">
				<div class="col-lg-12 col-md-12 hidden-xs hidden-sm clearleft clearright" style="padding-bottom:20px;">
					<div class="col-lg-3 clearleft pright75"><a href="<?php echo $link_btn1; ?>" class="flash-button <?php echo $button1 == 1 ? 'active':'' ?>"><?php echo $btn_today; ?></a></div>
				</div>
				<div class="swiper-flash-menu-mobile col-sm-12 col-xs-12 hidden-lg hidden-md">
					<div class="col-lg-3 swiper-wrapper"><a href="<?php echo $link_btn1; ?>" class="flash-button <?php echo $button1 == 1 ? 'active':'' ?> text-small"><?php echo $btn_today; ?></a></div>
					<div class="col-lg-3 swiper-wrapper"><a href="<?php echo $link_btn2; ?>" class="flash-button <?php echo $button2 == 1 ? 'active':'' ?> text-small"><?php echo $btn_today_2; ?></a></div>
					<div class="col-lg-3 swiper-wrapper"><a href="<?php echo $link_btn3; ?>" class="flash-button <?php echo $button3 == 1 ? 'active':'' ?> text-small"><?php echo $btn_tomorrow; ?></a></div>
					<div class="col-lg-3 swiper-wrapper"><a href="<?php echo $link_btn4; ?>" class="flash-button <?php echo $button4 == 1 ? 'active':'' ?> text-small"><?php echo $btn_tomorrow_2; ?></a></div>
				</div>
			</section>
		<?php
			}else{
				$batch1_start_s = substr($batch1_start, 0, 5);
                $batch1_end_s = substr($batch1_end, 0, 5);
				
				if($time_active === 1){
					$btn_today = "Hari Ini ".$batch1_start_s." - ".$batch1_end_s;
					$btn_tomorrow = "Besok ".$batch1_start_s." - ".$batch1_end_s;
				}else{
                    $split_curr_date = substr($start_date, 0, 10);
                    $sale_date = date($split_curr_date);
                    $this_day = date("d/m/Y", strtotime($sale_date));
                    $tomorrow_day = date("d/m/Y", strtotime($sale_date, "+1 days"));

					$btn_today = $this_day." ".$batch1_start_s." - ".$batch1_end_s;
					$btn_tomorrow = $tomorrow_day." ".$batch1_start_s." - ".$batch1_end_s;
				}
        ?>
            <!-- 
            This is time section below the product
            -->
			<section style="padding-top:20px;padding-bottom:20px;">
				<div class="col-lg-12 col-md-12 hidden-xs col-sm-12 clearleft clearright" style="padding-bottom:20px;">
					<div class="col-lg-4 clearleft pright75"><a href="<?php echo $link_btn1; ?>" class="flash-button <?php echo $button1 == 1 ? 'active':'' ?>"><?php echo $date_today_1; ?></a></div>
                    <div class="col-lg-4 clearleft pright75"><a href="<?php echo $link_btn2; ?>" class="flash-button <?php echo $button2 == 1 ? 'active':'' ?>"><?php echo $date_today_2; ?></a></div>
                    <div class="col-lg-4 clearleft pright75"><a href="<?php echo $link_btn3; ?>" class="flash-button <?php echo $button3 == 1 ? 'active':'' ?>"><?php echo $date_today_3; ?></a></div>
				</div>
				<div class="swiper-flash-menu-mobile col-xs-12 hidden-lg hidden-md hidden-sm" style="padding-bottom:20px;overflow-y:hidden;">
					<div class="swiper-wrapper">
						<div class="col-lg-4 clearleft pright75"><a href="<?php echo $link_btn1; ?>" class="flash-button <?php echo $button1 == 1 ? 'active':'' ?> text-small"><?php echo $date_today_1; ?></a></div>
                        <div class="col-lg-4 clearleft pright75"><a href="<?php echo $link_btn2; ?>" class="flash-button <?php echo $button2 == 1 ? 'active':'' ?> text-small"><?php echo $date_today_2; ?></a></div>
                        <div class="col-lg-4 clearleft pright75"><a href="<?php echo $link_btn3; ?>" class="flash-button <?php echo $button3 == 1 ? 'active':'' ?> text-small"><?php echo $date_today_3; ?></a></div>
					</div>
				</div>
			</section>

		<?php
            }
            // Check if Products not 0
			if (count($products) > 0) {
        ?>
            <!-- Show View Paging and Sorting -->
            <section id="breadcrumb" style="padding-top:20px;padding-bottom:20px;">
                <div class="container">
                    <div class="row">
                        <div class="hidden-xs hidden-lg hidden-md" style="padding-top:123px;"></div>
                        <div class="hidden-xs hidden-lg hidden-sm" style="padding-top:150px;"></div>
                        <div class="col-lg-12 col-md-12 hidden-sm hidden-xs mbottom-5-mobile gotham-white fsize-14">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <!--
                                <div class="col-lg-4 col-md-4 col-sm-4 clearleft clearright talign-left line-height40 fsize-14">
                                    <a style="line-height: 32px;" href="#" class="hidden-xs hidden-sm fcolorblue">Flash Sale</a>
                                </div>
                                -->
                                <div class="col-lg-6 col-md-8 col-sm-6 col-md-offset-6 col-sm-offset-6 col-lg-offset-6 clearleft clearright">
                                    <div class="col-lg-6 col-md-6 col-sm-6 clearleft clearright talign-right">
                                        <span class="fcolorblue">View : </span>
                                        <a <?php if($limit == 20){ echo ' class="circle-fill-sprites fcolorfff talign-center"';}else{ echo 'class="circle-sprites fcolorblue talign-center"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $page_url . '?' . $params . '&page=1&limit=20'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">20</span></a>

                                        <a <?php if($limit == 40){ echo ' class="circle-fill-sprites fcolorfff talign-center"';}else{ echo 'class="circle-sprites fcolorblue talign-center"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $page_url . '?' . $params . '&page=1&limit=40'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">40</span></a>

                                        <a <?php if($limit == 60){ echo ' class="circle-fill-sprites fcolorfff talign-center"';}else{ echo 'class="circle-sprites fcolorblue talign-center"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $page_url . '?' . $params . '&page=1&limit=60'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">60</span></a>

                                        <a <?php if($limit == 100){ echo ' class="circle-fill-sprites fcolorfff talign-center"';}else{ echo 'class="circle-sprites fcolorblue talign-center"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $page_url . '?' . $params . '&page=1&limit=100'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">100</span></a> 
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 clearleft clearright line-height40 talign-right">
                                        <div class="clearleft clearright hidden-xs hidden-sm hidden-lg-4 fcolorblue lspace0-5" style="display: inline;">Sort by:</div>
                                        <div class="clearleft clearright hidden-xs hidden-sm hidden-lg-4" style="display: inline;">
                                            <a href="#" class="hidden-xs hidden-sm bradius20 bgcolorprimary pleft15 pright15 ptop5p pbottom5p" id="sorting">
                                                <span class="text-sorting fcolorfff"><?php if($sort_name == 'NONE'){ echo 'Brands Name';}else{ echo $sort_name; }  ?><span class="glyphicon glyphicon-menu-down" style="padding-left: 5px;display: inline;"></span></span>
                                            </a>

                                            <div class="" id="arrow-sorting"></div>
                                            <div class="hidden-xs sorting-box talign-left" id="box-sorting">
                                                <a class="sorting-list top" href="<?php echo \yii\helpers\Url::base() . '/' . $page_url . '?' . $params . '&page='.$current.'&limit='.$limit.'&sortby=none'; ?>">Brands Name</a>
                                                <a class="sorting-list" id="sorting-none" href="<?php echo \yii\helpers\Url::base() . '/' . $page_url . '?' . $params . '&page='.$current.'&limit='.$limit.'&sortby=price-low-to-high'; ?>">Price Low to High</a>
                                                <a class="sorting-list bottom" href="<?php echo \yii\helpers\Url::base() . '/' . $page_url . '?' . $params . '&page='.$current.'&limit='.$limit.'&sortby=price-high-to-low'; ?>">Price High to Low</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>                     

                        </div>
                        <!--
                        <div class="hidden-sm col-xs-12 hidden-lg hidden-md talign-center fsize-12 ptop15 pbottom15">
                            <a style="line-height: 32px;" href="#" class="fcolorblue">Flash Sale</a>
                        </div>
                        <div class="hidden-xs col-sm-12 hidden-lg hidden-md talign-center fsize-14 ptop15 pbottom15">
                            <a style="line-height: 32px;" href="#" class="fcolorblue">Flash Sale</a>
                        </div>
                        -->
                        <div class="col-xs-12 col-sm-12">
                            <div class="hidden-lg hidden-md hidden-sm col-xs-5 remove-padding clearleft">
                            <?php
								
                                $page_item = ceil($count / $limit);
                                $prev = $current - 1;
                                $next = $current + 1;
                            ?>
                                <div class="col-xs-6 clearleft-mobile pright5p" style="width: 60px;">
                                <?php if($current <= 1){
                                    ?>
                                    <a class="grey-round default top-paging" style="padding:2px !important;">
                                    <span class="col-sm-4 col-xs-4 clearright-mobile talign-left" style="padding-left: 5px;display: grid;"><i class="left-white-sprite"></i></span>
                                    <span class="col-sm-8 col-xs-8 clearleft-mobile clearright-mobile fsize-12">Prev</span>
                                    </a>
                                    <?php
                                }else{
                                    ?>
                                
                                    <a class="blue-round default top-paging" style="padding:2px !important;" href="<?php echo \yii\helpers\Url::base() . '/' . $page_url . '?' . $batch . $params .'&page='.$prev.'&limit=20'; ?>&sortby=<?php echo $sortby;?>">
                                        <span class="col-sm-4 col-xs-4 clearright-mobile talign-left" style="padding-left: 5px;display: grid;"><i class="left-white-sprite"></i></span>
                                        <span class="col-sm-8 col-xs-8 clearleft-mobile clearright-mobile fsize-12">Prev</span>
                                    </a>
                        
                                    <?php
                                }
                                ?>
                                </div>
                                <div class="col-xs-6 clearright-mobile pleft5p" style="width: 60px;">
                                
                                <?php if($current == $page_item){
                                    ?>
                                    <a class="grey-round default top-paging" style="padding:2px !important;">
                                    <span class="col-sm-10 col-xs-10 clearleft-mobile clearright-mobile fsize-12" style="padding-left: 4px;">Next</span>
                                    <span class="col-sm-2 col-xs-2 clearleft-mobile talign-right" style="padding-right: 5px;display: grid;"><i class="right-white-sprite"></i></span>
                                    </a>
                                    <?php
                                }else{
                                    ?>
                                
                                    <a class="blue-round default top-paging" style="padding:2px !important;" href="<?php echo \yii\helpers\Url::base() . '/' . $page_url . '?'. $batch . $params .'&page='.$next.'&limit=20'; ?>&sortby=<?php echo $sortby;?>">
                                        <span class="col-sm-10 col-xs-10 clearleft-mobile clearright-mobile fsize-12" style="padding-left: 4px;">Next</span>
                                        <span class="col-sm-2 col-xs-2 clearleft-mobile talign-right" style="padding-right: 5px;display: grid;"><i class="right-white-sprite"></i></span>
                                    </a>
                        
                                    <?php
                                }
                                ?>
                                </div>

                            </div>
                            <div class="hidden-lg hidden-md col-sm-5 hidden-xs remove-padding clearleft">
                            <?php
                                $page_item = ceil($count / $limit);
                                $prev = $current - 1;
                                $next = $current + 1;
                            ?>
                                <div class="col-xs-6 clearleft-mobile clearleft pright5p" style="width: 85px;">
                                <?php if($current <= 1){
                                    ?>
                                    <a class="grey-round default top-paging" style="padding:2px !important;padding-top:3px !important;">
                                    
                                    <span class="col-sm-4 col-xs-4 clearright talign-left pleft5p"><i class="left-white-sprite"></i></span>
                                    <span class="col-sm-8 col-xs-8 clearleft clearright fsize-12">Prev</span>
                                    
                                    </a>
                                    <?php
                                }else{
                                    ?>
                                
                                    <a class="blue-round default top-paging" style="padding:2px !important;padding-top:3px !important;" href="<?php echo \yii\helpers\Url::base() . '/' . $page_url . '?' . $batch . $params .'&page='.$prev.'&limit=20'; ?>&sortby=<?php echo $sortby;?>">
                                        <span class="col-sm-4 col-xs-4 clearright talign-left pleft5p"><i class="left-white-sprite"></i></span>
                                        <span class="col-sm-8 col-xs-8 clearleft clearright fsize-12">Prev</span>
                                        
                                    </a>
                        
                                    <?php
                                }
                                ?>
                                </div>
                                <div class="col-xs-6 clearright-mobile clearright pleft5p" style="width: 85px;">
                                
                                <?php if($current == $page_item){
                                    ?>
                                    <a class="grey-round default top-paging" style="padding:2px !important;padding-top:3px !important;">
                                    <span class="col-sm-8 col-xs-8 clearleft clearright fsize-12">Next</span>
                                    <span class="col-sm-4 col-xs-4 clearleft talign-right pright5p"><i class="right-white-sprite"></i></span>
                                    </a>
                                    <?php
                                }else{
                                    ?>
                                
                                    <a class="blue-round default top-paging" style="padding:2px !important;padding-top:3px !important;" href="<?php echo \yii\helpers\Url::base() . '/' . $page_url . '?' . $batch . $params .'&page='.$next.'&limit=20'; ?>&sortby=<?php echo $sortby;?>">
                                        <span class="col-sm-8 col-xs-8 clearleft clearright fsize-12">Next</span>
                                        <span class="col-sm-4 col-xs-4 clearleft talign-right pright5p"><i class="right-white-sprite"></i></span>
                                    </a>
                        
                                    <?php
                                }
                                ?>
                                </div>
                            </div>

                            <div class="hidden-lg hidden-md col-sm-7 col-xs-7 remove-padding clearright" style="float:right;text-align:right;">
                                <span class="fcolorblue">View : </span>
                                        <a <?php if($limit == 20){ echo ' class="circle-fill-sprites25 fcolorfff talign-center fsize-12"';}else{ echo 'class="circle-sprites25 fcolorblue talign-center fsize-12"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $page_url . '?' . $batch . $params . '&page=1&limit=20'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">20</span></a>

                                        <a <?php if($limit == 40){ echo ' class="circle-fill-sprites25 fcolorfff talign-center fsize-12"';}else{ echo 'class="circle-sprites25 fcolorblue talign-center fsize-12"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $page_url . '?' . $batch . $params . '&page=1&limit=40'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">40</span></a>

                                        <a <?php if($limit == 60){ echo ' class="circle-fill-sprites25 fcolorfff talign-center fsize-12"';}else{ echo 'class="circle-sprites25 fcolorblue talign-center fsize-12"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $page_url . '?' . $batch . $params . '&page=1&limit=60'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">60</span></a>

                                        <a <?php if($limit == 100){ echo ' class="circle-fill-sprites25 fcolorfff talign-center fsize-12"';}else{ echo 'class="circle-sprites25 fcolorblue talign-center fsize-12"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $page_url . '?' . $batch . $params . '&page=1&limit=100'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">100</span></a> 
                            </div>
                        </div>
                    </div>
                </div>
            </section>

			<!-- Show Products -->
			<section id="all-product">
				<div class="container">
				<div class="row">
					<!-- Filter Desktop -->
					<style type="text/css">
						@media only screen and (min-width: 415px) {
						  .flashing.col-lg-2{
							width: 20%;
						  }
						}
					</style>
					<div class="col-lg-12 col-md-12 product-box space-cont-product">
					<?php
                        $i = 1;
						foreach ($products as $product) {
                            $stock_flash_sale = 0;
                            $total_price = 0;
                            $check_discount = 0;
                            $reduction = 0;
                            $discount = 0;
                            $discount_amount = 0;
                            $reduction_xtra = 0;
                            $disc_xtra = 0;
                            $discount_amount_extra = 0;
                            $reduction_plus_xtra = 0;
                            $disc_plus_xtra = 0;
                            $discount_amount_plus_extra = 0;
                            $now = date('Y-m-d H:i:s');
                            $disc_xtra_start = '2019-03-18 11:00:00';
                            $disc_xtra_end = '2019-03-20 17:00:00';
                            $disc_plus_xtra_start = '2019-03-12 11:00:00';
                            $disc_plus_xtra_end = '2019-03-13 17:00:00';
							$stock = backend\models\ProductStock::findOne(['product_id' => $product->product_id]);
                            $productStock = backend\models\ProductStock::findAll(['product_id' => $product->product_id]);
                            // $spesificPriceAll = backend\models\SpecificPrice::findAll(['product_id' => $product->product_id]);
                            $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->andWhere(['is_flash_sale'=>1])->all();
							$found = FALSE;
                            $stockall = 0;
                            $link_product = \yii\helpers\Url::base()."/harbolnas/".$product->productDetail->link_rewrite;
                            $alt_img = $product->brands->brand_name . ' ' . $product->productDetail->name;
                            $img_product = Yii::$app->params['imgixUrl']."product/".$product->productImage->product_image_id . "/" . $product->productImage->product_image_id.".jpg";
							
							foreach ($productStock as $ps){
								$productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $ps->product_attribute_id]);
								if($productattribute != NULL && $ps->quantity != 0){
									
									$found = TRUE;
								}
								$stockall = $stockall + $ps->quantity;
                            }
                            if($i === 1){
                                $offset_col = 'col-md-offset-1';
                            }
							
							
                    ?>
                    <!-- <div class="product-wrap col-lg-5ths col-md-5ths col-sm-6 col-xs-6"> -->
                    <div class="product-wrap-flash col-lg-3 col-md-6 col-sm-6 col-xs-6" style="">
                        <div class="product-grid">
                            <div class="product-image">
                                <?php
                                    if($stock != NULL && !$found){
                                        $attr_link = $stock->quantity == 0 ? 'id="out-of-stock" data-id="'.$product->product_id.'"' : '';
                                        $attr_id_img = 'out-of-stock-'.$product->product_id;
                                    }else{
                                        $attr_link = '';
                                        $attr_id_img = '';
                                    }
                                    /* 
                                    //not used for flash sale
                                    if($product->productNewArrival->product_newarrival_start_date <= $now && $product->productNewArrival->product_newarrival_end_date >= $now){
                                ?>
                                    <div class="tag-bellow tag-bellow2" style='background-color: #4c757b;position: absolute;width: 100%;bottom: 0;top: auto;'>
                                        <span class='text-bellow'>
                                            New Arrival
                                        </span>
                                    </div>
                                    <?php
                                    }
                                    */
                                ?>
                                <a <?php echo $attr_link; ?> href="<?php echo $link_product; ?>">
                                    <?php
                                        if($stock != NULL){
                                            echo '<img class="img-responsive" alt="'.$alt_img.'" src="'.$img_product.'" id="'.$attr_id_img.'">';
                                            echo $stock->quantity === 0 && $time_active === 1 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
                                        }
                                    ?>
                                </a>
                                <!-- <span class="product-new-label">New</span> -->
                                <?php
                                if ($spesificPriceAll != null) {
                                    foreach ($spesificPriceAll as $specificPrice) {
                                        $stock_flash_sale = $specificPrice->flash_sale_qty;
                                      ?>
                                        <?php
										
                                            // if ($specificPrice->from <= $now && $specificPrice->to > $now) {
                                                ?>
                                                <span class='product-discount-label <?php echo $specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?><?php echo $specificPrice->label_type === "flash_icon" ? " flash" : ""; ?>'>
                                                    <?php
                                                        // if custom value label
                                                        if($specificPrice->label_type == "custom_value"){
                                                            echo $specificPrice->label;
                                                        }elseif($specificPrice->label_type == "flash_icon"){
                                                            //only label
															
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
                                                <?php
                                            // }
                                            if( $time_active == 1){
                                                // $stock_bar = 100 - ( ($stock->quantity / $stock_flash_sale) * 100);	
                                                $stock_bar = ( 100 -  ($stockall / $stock_flash_sale) * 100);	
                                            }else{
                                                $stock_bar = 0;
                                            }
                                        
                                    }
									//var_dump('quantity '.$stock->quantity);
									
									//var_dump('flash sale qty '.$stock_flash_sale);
									?>
									
									  <?php
                                    if($_GET['batch']==1)
                                    {
                                        $sekarang = $start_date;
                                    }else if($_GET['batch']==2){
                                        $sekarang = $mid_date;
                                    }else if($_GET['batch']==3){
                                        $sekarang = $end_date;
                                    }else{
										$sekarang = $start_date;
									}

                                    if(substr($now,0,10) == $sekarang){
                                        ?>
									<div class="col-lg-12 col-md-12 col-sm-12 clearright-mobile clearleft-mobile flash-bar full">
									
                                                <!--<div class="stock" style="width:<?php echo $stockall == 0 ? '0': $stock_bar; ?>%"></div>-->
												<?php 
												
												if($stockall > $stock_flash_sale){ ?>
												 <span class="stock" style="width:0%"></span>
												<?php }else{ 
													
													?>
														<span class="<?php echo $stockall === 0 ? 'stock-out': 'stock'; ?>" style="width:<?php echo $stock_bar; ?>%"></span>
														
												<?php } ?>
											</div>
											
                                            
                                      <?php
									}
									  
                                }
                                ?>
                            </div>
                            <div class="product-content">
                                <input type="hidden" name="productId" value="<?php echo $product->product_id; ?>">
                                <input type="hidden" name="productName" value="<?php echo $product->productDetail->name; ?>">
								<input type="hidden" name="productCategoryID" value="<?php echo $product->productCategory->product_category_id; ?>">
                                <input type="hidden" name="brandName" value="<?php echo $product->brands->brand_name; ?>">
                                <input type="hidden" name="opt_list" value="<?php echo $breadcrumbs[0] . ' - ' . $breadcrumbs[2]; ?>">
                                <input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
                                <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                
								<div class="product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                                <div class="product product-name"><span ><?php echo ucwords($product->productDetail->name); ?></span></div>
                                <!--
                                    <h3 class="title"><a href="#">Product Name</a></h3>
                                    <div class="price">
                                        $63.50
                                        <span>$75.00</span>
                                    </div>
                                    <ul class="rating">
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star disable"></li>
                                        <li class="fa fa-star disable"></li>
                                    </ul>
                                -->
                                <?php
                                if($time_active === 0){
                                ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
                                        Coming Soon
                                    </div>
                                <?php
                                }else{
									$a = 0;
                                    if ($spesificPriceAll != null) {
                                        foreach ($spesificPriceAll as $spesificPrice) {
											$a++;
                                            if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $current_date || 
												date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $current_date) {
                                            //    $check_discount = 1;
                                            //    $check_discount = $time_active === 0 ? 1 : 0 ;
												
                                            } else { 
											
											
                                ?>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
                                <?php
                                                if ($spesificPrice->reduction_type == 'percent') {
                                                    // $discount = (($spesificPrice->reduction / 100) * $product->price);
                                                    if($disc_xtra_start <= $now && $disc_xtra_end > $now){
                                                        // set discount plus extra
                                                        // discount
                                                        $reduction = (int) $spesificPrice->reduction;
                                                        $discount = floor( ($reduction / 100) * $product->price );
                                                        $discount_amount = $product->price - $discount;
                                                        // discount extra 
                                                        $reduction_xtra = (int) $spesificPrice->reduction_extra;
                                                        $disc_xtra = floor( ($reduction_xtra / 100) * $discount_amount );
                                                        $discount_amount_extra = $discount_amount - $disc_xtra;
                                                        $total_price = $discount_amount_extra;
                                                    }
                                                    elseif($disc_plus_xtra_start <= $now && $disc_plus_xtra_end > $now){
                                                        // set discount plus extra
                                                        // discount
                                                        $reduction = (int) $spesificPrice->reduction;
                                                        $discount = floor( ($reduction / 100) * $product->price );
                                                        $discount_amount = $product->price - $discount;
                                                        // discount extra 
                                                        $reduction_xtra = (int) $spesificPrice->reduction_extra;
                                                        $disc_xtra = floor( ($reduction_xtra / 100) * $discount_amount );
                                                        $discount_amount_extra = $discount_amount - $disc_xtra;
                                                        // discount plus extra 
                                                        $reduction_plus_xtra = (int) $spesificPrice->reduction_plus_extra;
                                                        $disc_plus_xtra = floor( ($reduction_plus_xtra / 100) * $discount_amount_extra );
                                                        $discount_amount_plus_extra = $discount_amount_extra - $disc_plus_xtra;
                                                        $total_price = $discount_amount_plus_extra;
                                                    }
                                                    else{
                                                        $reduction = (int) $spesificPrice->reduction;
                                                        $discount = floor(($reduction / 100) * $product->price);
                                                        $total_price = $product->price - $discount;
                                                    }
                                                } elseif ($spesificPrice->reduction_type == 'amount') {
                                                    $discount = $spesificPrice->reduction;
                                                    $total_price = $product->price - $discount;
                                                }
                                                if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ 
												if($a === 1){
													?>
													 <span class="discount-price mleft2 discountview2">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?></span>
                                                    <span class="discount-price-real">IDR <?php echo \common\components\Helpers::getPriceFormat($total_price); ?></span>
                                                    <input type="hidden" class="price" name="price" value="<?php echo $total_price; ?>">
													<?php
												}
                                ?>
													
                                                   
                                <?php 
                                                } else {
													if($a === 1){
                                                    $total_price = $product->price_usd - $discount; 
                                ?>
                                                    USD <?php echo $total_price; ?>
                                                    <input type="hidden" class="price" name="price" value="<?php echo $total_price; ?>">
                                <?php 	  			}
                                                } 
                                ?>
                                                    <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                                            </div>

                                                <input type="hidden" name="productPrice" value="<?php echo $total_price; ?>">
                                <?php
								
                                                if($stockall == 0){
                                ?>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
                                                    Out of Stock
                                                    </div>
                                                    <?php
                                                }else{
												
										
									
                                                    if(($total_price) > 500000){
														if($a === 1){
                                                    ?>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment" style="text-align: left;">
                                                            <?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
                                                            IDR <?php echo \common\components\Helpers::getPriceFormat(($total_price) / 12); ?> / bulan

                                                            <?php } else { ?>
                                                            USD <?php echo ($total_price)/12; ?> / bulan

                                                            <?php } ?>
                                                        </div>
                                                    <?php
														}
                                                    }
                                                }
                                                ?>
                                        <?php   
                                                // $check_discount = 0;break;
                                            }
											
                                        }
										
                                        // die(var_dump($check_discount));
										
                                            if($check_discount == 1){ 
                                        ?>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
                                                    Coming Soon
                                                </div>
                                                <!--
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview">
                                                <?php
												
												if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
                                                IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?>
                                                <input type="hidden" class="price" name="price" value="<?php echo $product->price; ?>">
                                                <?php } else { ?>
                                                USD <?php echo $product->price_usd; ?>
                                                <input type="hidden" class="price" name="price" value="<?php echo $product->price_usd; ?>">
                                                <?php } ?>
                                                <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                                            </div>
                                            -->
                                        <?php 
									} 
                                        ?>
                                <?php 
                                    } else { 
                                ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
                                            Coming Soon
                                        </div>
                                <?php 
										
                                    } 
									
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <?php
                            $i++;
                        }
                    ?>
                    </div>
                </div>
                </div>
            </section>
			<section id="all-product-footer">
				<div class="container product-box">
					<div class="row font-paging">
                        <?php
                        // display pagination
                        /*
                        echo \yii\widgets\LinkPager::widget([
                            'pagination' => $pagination,
                        ]);
                        */
                        /*
                        echo \yii\widgets\LinkPager::widget([
                            'pagination'=>$dataProvider->pagination,
                        ]);
                        */
							if(!isset($_GET['limit'])){
								$total_page = ceil($count / $limit);
							}else{
								$total_page = ceil($count / $limit);
							}
							if(!isset($_GET['page'])){
								$current = 1;
							}else{
								$current = $_GET['page'];
							}
							 echo Yii::$app->view->renderFile('@app/views/promo/flash_page_number.php', array(
								 "current" => $current,
								 "page_url" => $page_url,
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
        <?php
            }else{
        ?>
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
        <?php
            }
		?>
        </div>
    </div>
</section>

<!--SEO Pages-->
<section style=" padding: 0px 0;z-index;1;">
    <div class="col-lg-12 col-md-12 col-sm-12" style="background-color: #fff;z-index: 1;
    margin-top: -70px;">  
        <div class="container clearleft">
                                <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs clearleft" style="padding-top: 30px; padding-bottom: 30px; text-align: justify;">
                        
                            <p class="seodesc"><strong>Flash Sale The Watch Co.&nbsp;</strong></p>

<p class="seodesc">Flash sale adalah penjualan suatu produk oleh perusahaan atau toko dalam waktu tertentu. Biasanya cscsacsa sangat singkat dan terbatas. Di luar negeri, istilah flash sale biasa disebut “deal of the day”. Apapun itu istilahnya, flash sale merupakan promo yang sering dinanti bagi yang hobi belanja.&nbsp;</p>

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
			  <?php
			  if( ($current_date >= '2019-01-25') && ($current_date <= '2019-01-26') ){
					echo '25 Januari 2019 - 26 Januari 2019';
			  }elseif( ($current_date >= '2019-01-29') && ($current_date <= '2019-01-31') ){
				echo '29 Januari 2019 - 31 Januari 2019';
		  	  }
			  ?>
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
				Waktunya Flash Sale 10.10
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                Syarat dan ketentuan:
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                <ol>
                    <li>Promo dimulai dari periode 8 hingga 10 Oktober 2019, pukul 10.10 – 14.00 WIB</li>
                    <li>Untuk menikmati promo Waktunya Flash Sale 10.10 hanya berlaku di halaman flash sale</li>
                    <li>Khusus promo flash sale ini hanya berlaku untuk metode pembayaran Virtual Account, kartu kredit (full payment dan cicilan), akulaku, vospay, kredivo, dan go-pay </li>
					<li>Cicilan 0% kartu kredit berlaku untuk minimum pembelian Rp. 500.000,- dengan tenor 3, 6, dan 12 bulan</li>
					<li>Gratis ongkir ke seluruh Indonesia bisa didapatkan dengan minimum pembelian Rp. 1.000.000,- setelah diskon</li>
					<li>Setiap pembelian produk dikenakan biaya asuransi pengiriman sebagai tambahan agar produk yang anda pesan lebih aman sampai tujuan</li>
					<li>Produk yang sudah dipesan tidak dapat dibatalkan dengan alasan apapun, kecuali terjadi kerusakan dari pabrikan</li>
					<li>Jika transaksi dibatalkan oleh pihak The Watch Co. karena suatu hal (stok habis atau lainnya), dana Anda akan dikembalikan 100%</li>
					<li>Dengan mengikuti promo ini, pengguna dianggap mengerti dan menyetujui semua syarat dan ketentuan yang berlaku</li>
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