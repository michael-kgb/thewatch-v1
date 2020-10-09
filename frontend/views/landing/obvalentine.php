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

$sortby = 'product_sort';
if(isset($_GET['sortby'])){
	$sort_name = str_replace('-', ' ', $_GET['sortby']);
	$sort_name = strtoupper($sort_name);
	$sortby = $_GET['sortby'];
}else{
	$sort_name = 'NONE';
}

$brandId = 48;
 $currentUrl = explode('?',$_SERVER[REQUEST_URI])[0];
 $currentAc = "//$_SERVER[HTTP_HOST]$currentUrl";
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
			<?php 
			$current_date = date('Y-m-d H:i:s');
			if(isset($_GET['isadmin'])){
				$current_date = '2017-12-12 00:00:00';
			}
			?>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 clearleft clearright mbottom3">
      
                    <img src="<?= $data[2]; ?>" class="img-responsive">
              
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 clearright pleft-5-dwpetite">
				<div class="brand-name-full" style="font-family: gotham-light;">
                <?= $data[0]; ?>
				</div>
				<div class="brand-description">
				<?= $data[1]; ?>
				</div>
			</div>
			
			<div style="clear:both">&nbsp;</div>
			
			<section id="breadcrumb" style="padding-top:20px;">
				<div class="container">
					<div class="row">

						<div class="col-lg-12 col-md-12 hidden-sm hidden-xs clearleft clearright mbottom-5-mobile gotham-white fsize-18">
							<div class="col-lg-12 col-md-12 col-sm-12 clearleft clearright">
							<div class="col-lg-2 hidden-md col-sm-2 clearleft clearright"></div>
							<div class="col-lg-4 col-md-4 col-sm-4 clearleft clearright talign-left line-height40 fsize-18">
								<?php
								if(count($breadcrumbs) > 0){
									?>
								
										<a style="line-height: 32px;" href="<?php echo \yii\helpers\Url::base(); ?>/brands" class="hidden-xs hidden-sm fcolorblue">
										Brands</a>
										<span class="hidden-xs hidden-sm fcolorblue">/</span>
										<a style="line-height: 32px;" class="hidden-xs hidden-sm fcolorblue">
										<?php echo ucwords(\backend\models\Brands::find()->where(['brand_id'=>$brandId])->one()->brand_name); ?></a>

										<?php if(isset($breadcrumbs[1])){?>
											<span class="hidden-xs hidden-sm fcolorblue">/</span>
											<a style="line-height: 32px;" class="hidden-xs hidden-sm fcolorblue">
											<?php echo ucwords($breadcrumbs[1]); ?></a>

										<?php } ?>                  
							
								<?php } ?>

								
							</div>
							<div class="col-lg-6 col-md-8 col-sm-6 clearleft clearright">
								<div class="col-lg-6 col-md-6 col-sm-6 clearleft clearright talign-right">
								<span class="fcolorblue">View : </span>
								<a <?php if($limit == 20){ echo ' class="circle-fill-sprites fcolorfff talign-center"';}else{ echo 'class="circle-sprites fcolorblue talign-center"';}?> href="<?php echo $currentAc . '?page=1&limit=20'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">20</span></a>

								<a <?php if($limit == 40){ echo ' class="circle-fill-sprites fcolorfff talign-center"';}else{ echo 'class="circle-sprites fcolorblue talign-center"';}?> href="<?php echo $currentAc . '?page=1&limit=40'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">40</span></a>

								<a <?php if($limit == 60){ echo ' class="circle-fill-sprites fcolorfff talign-center"';}else{ echo 'class="circle-sprites fcolorblue talign-center"';}?> href="<?php echo $currentAc . '?page=1&limit=60'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">60</span></a>

								<a <?php if($limit == 100){ echo ' class="circle-fill-sprites fcolorfff talign-center"';}else{ echo 'class="circle-sprites fcolorblue talign-center"';}?> href="<?php echo $currentAc . '?page=1&limit=100'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">100</span></a> 
								</div>

								<div class="col-lg-6 col-md-6 col-sm-6 clearleft clearright line-height40 talign-right">
								<div class="clearleft clearright hidden-xs hidden-sm hidden-lg-4 fcolorblue lspace0-5" style="display: inline;">Sort by:
								</div>
								<div class="clearleft clearright hidden-xs hidden-sm hidden-lg-4" style="display: inline;">
									<a href="#" class="hidden-xs hidden-sm bradius20 bgcolorprimary pleft15 pright15 ptop5p pbottom5p" id="sorting">
										<span class="text-sorting fcolorfff"><?php if($sort_name == 'NONE' || $sort_name == 'PRODUCT_SORT'){ echo 'None';}else{ echo $sort_name; }  ?><span class="glyphicon glyphicon-menu-down" style="    padding-left: 5px;display: inline;"></span></span>

									</a>

									<div class="" id="arrow-sorting"></div>
									<div class="hidden-xs sorting-box talign-left" id="box-sorting">
										<a class="sorting-list top" href="<?php echo $currentAc . '?page='.$current.'&limit='.$limit.'&sortby=none'; ?>">None</a>
										<a class="sorting-list" id="sorting-none" href="<?php echo $currentAc . '?page='.$current.'&limit='.$limit.'&sortby=price-low-to-high'; ?>">Price Low to High</a>
										<a class="sorting-list bottom" href="<?php echo $currentAc . '?page='.$current.'&limit='.$limit.'&sortby=price-high-to-low'; ?>">Price High to Low</a>
									</div>
								</div>
								</div>
							</div>
							</div>                     

						</div>
						<div class="hidden-lg hidden-md col-sm-12 col-xs-12 clearleft clearright font-paging">
							<div class="col-sm-12 col-xs-12 talign-center clearleft-mobile clearright-mobile">
							<div class="col-sm-4 col-xs-4 clearleft-mobile clearleft">
								<a class="blue-round default" id="brand-koleksi-mobile" style="padding-bottom: 2px !important;">
								<span class="col-sm-6 col-xs-6 clearleft-mobile clearright-mobile fsize-12 talign-left">Koleksi</span>
								<span class="col-sm-6 col-xs-6 clearleft-mobile clearright-mobile talign-right"><i class="collection-white-sprite"></i></span>
								</a>

								<div class="hidden-lg hidden-md col-xs-12 remove-padding" style="display: none; position: fixed; width: 100%; height: 50%; left: 0; top: 50%; background: #f6f6f6; z-index: 100; overflow: scroll;border-top:solid 1px #9f8562;" id="brands-collection-content">
									<a href="#" id="close-koleksi-mobile">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-5 text-gotham-medium" style="height: 35px;">
											<span class="" style="letter-spacing:3px;text-align:center;font-family: gotham-medium;">KOLEKSI</span>
											<span class="pull-right">
												
												<span class="glyphicon glyphicon-menu-down" style="color:white;background-color:#9f8562;border-radius:40px;padding: 4px;font-size: 12px;margin-top:-3px;float: right;"></span>
												
											</span>
											<div class="clearfix"></div>
											<div class="border-bottom-1" style="margin-top: 12px;"></div>

										</div>
									</a>
									<!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-5 text-gotham-medium" style="height: 45px;">
										<span class="pull-left" style="letter-spacing:3px;text-align:center;">KOLEKSI</span>
										<span class="pull-right">
											<a href="#" id="close-brands-mobile">
												<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-black.png" class="close-forgot" style="margin-bottom: 7px; width: 20%">
											</a>
										</span>
										<div class="clearfix"></div>
										<div class="border-bottom-1"></div>
									</div> -->
									<div class="hidden-lg hidden-md col-xs-12" style="padding-top: 12px;padding-bottom:40px;overflow-y: scroll;-webkit-overflow-scrolling: touch;">
										<?php
											$i = 1;
											if(isset($breadcrumbs[1])){
											$id_category = \backend\models\ProductCategory::find()->where(['product_category_name' => $breadcrumbs[1] ])->one()->product_category_id;
											$product_collection = \backend\models\Product::find()->where(['product_category_id' => $id_category , 'brands_brand_id'=> $brandId])->all();
											$brands_collection_id = [];
											foreach($product_collection as $prod_row){
												$brands_collection_id[] = $prod_row->brands_collection_id;
											}
											$brand_collection = \backend\models\BrandsCollection::find()->where(['brands_collection_id' => $brands_collection_id])->all();
											}else{
											$brand_collection = \backend\models\BrandsCollection::find()->where(['brands_brand_id' => $brandId])->all();
											}
											
											?>
											<?php foreach ($brand_collection as $product) { ?>
												
											<?php
												$checked = FALSE;
												foreach($collection_selection as $collection){
															if($product->brands_collection_id == $collection){
																$checked = TRUE;
															}
														}
												?>
												<label class="control control--checkbox border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;"><?php echo $product->brands_collection_name; ?>
													<input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $product->brands_collection_id; ?>" id="apply-filters-brand-mobile" name="collection-mobile">

													<div class="control__indicator" style="top:5px;"></div>
												</label>

											
										<?php } ?>
									
									</div>
									<div class="col-xs-12 margin-top-5 remove-padding" style="z-index:11;text-align: left;position: fixed;size: 10px;background-color: #fff;bottom: 0;height: 50px;width: 100%;">
									<!--  <span class="text-gotham-light col-xs-6 ptop4 clearleft-mobile clearright-mobile" style="padding-bottom:20px;text-align: center;background-color: #c2b9b4;color:#fff;">
										<a href="#" id="close-koleksi-mobile" style="color:white;letter-spacing: 1px;">
											CLOSE
										</a></span> -->
										<span class="text-gotham-light col-xs-12 ptop4" style="padding-bottom:20px;text-align: center;background-color: #9f8562;color:#fff;"><input style="background: transparent;border: none;color:white;letter-spacing: 1px;" class="" type="reset" value="CLEAR" name="clear" /></span>
									
									</div>

								</div>

							</div>
							<div class="col-sm-4 col-xs-4 clearleft-mobile clearleft">
								<a class="blue-round default" id="filter-mobile" style="padding-bottom: 2px !important;">
								<span class="col-sm-6 col-xs-6 clearleft-mobile clearright-mobile fsize-12 talign-left">Filter</span>
								<span class="col-sm-6 col-xs-6 clearleft-mobile clearright-mobile talign-right"><i class="filter-white-sprite"></i></span>
								</a>
							</div>
							<div class="col-sm-4 col-xs-4 clearleft-mobile clearleft">
								<a class="blue-round default" id="sorting-mobile" style="padding-bottom: 2px !important;">
								<span class="col-sm-6 col-xs-6 clearleft-mobile clearright-mobile fsize-12 talign-left">Urutkan</span>
								<span class="col-sm-6 col-xs-6 clearleft-mobile clearright-mobile talign-right"><i class="sort-white-sprite"></i></span>
								</a>
							</div>
								
								<div class="hidden-lg hidden-md col-xs-12 remove-padding" style="display: none; position: fixed; width: 100%; height: 100%; left: 0; top: 0px; background: #f6f6f6; z-index: 100; overflow: auto" id="sorting-content">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-5 text-gotham-medium" style="height: 45px;">
									<span class="pull-left talign-center lspace3">SORT BY</span>
									<span class="pull-right">
										<a href="#" id="close-sorting-mobile">
											<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-black.png" class="close-forgot" style="margin-bottom: 7px; width: 20%">
										</a>
									</span>
									<div class="clearfix"></div>
									<div class="border-bottom-1"></div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<a href="<?php echo $currentAc . '?page='.$current.'&limit='. $limit; ?>&sortby=none">
										<div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
											<span class="pull-left lspace3">BRANDS NAME</span>

										</div>
									</a>
									<a href="<?php echo $currentAc . '?page='.$current.'&limit='. $limit; ?>&sortby=price-low-to-high">
										<div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
											<span class="pull-left lspace3">PRICE LOW TO HIGH</span>

										</div>
									</a>
									<a href="<?php echo $currentAc . '?page='.$current.'&limit='. $limit; ?>&sortby=price-high-to-low">
										<div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
											<span class="pull-left lspace3">PRICE HIGH TO LOW</span>

										</div>
									</a>
								</div>
								</div>

								<?php

									echo Yii::$app->view->renderFile('@app/views/brands/filter_mobile.php', array(
									"feature" => $feature,
									"products"=> $products,
									"types_selection" => $types_selection,
									"collection_selection" => $collection_selection,
									"genders_selection" => $genders_selection,
									"size_selection" => $size_selection,
									"bandwidth_selection" => $bandwidth_selection,
									"movements_selection" => $movements_selection,
									"waters_selection" => $waters_selection,
									"brandName" => $brandName,
									"breadcrumbs" => $breadcrumbs,
									"brandId"=> $brandId,
								));
								?>
							</div>
						</div>
						<div class="hidden-sm col-xs-12 hidden-lg hidden-md talign-center fsize-12 ptop15 pbottom15">
							<?php
								if(count($breadcrumbs) > 0){
									?>
								
										<a style="line-height: 32px;" href="<?php echo \yii\helpers\Url::base(); ?>/brands" class="fcolorblue">
										Brands</a>
										<span class="fcolorblue">/</span>
										<a style="line-height: 32px;" class="fcolorblue">
										<?php echo ucwords(\backend\models\Brands::find()->where(['brand_id'=>$brandId])->one()->brand_name); ?></a>

										<?php if(isset($breadcrumbs[1])){?>
											<span class=" fcolorblue">/</span>
											<a style="line-height: 32px;" class="fcolorblue">
											<?php echo ucwords($breadcrumbs[1]); ?></a>

										<?php } ?>                  
							
								<?php } ?>

						</div>
						<div class="hidden-xs col-sm-12 hidden-lg hidden-md talign-center fsize-14 ptop15 pbottom15">
							<?php
								if(count($breadcrumbs) > 0){
									?>
								
										<a style="line-height: 32px;" href="<?php echo \yii\helpers\Url::base(); ?>/brands" class="fcolorblue">
										Brands</a>
										<span class="fcolorblue">/</span>
										<a style="line-height: 32px;" class="fcolorblue">
										<?php echo ucwords(\backend\models\Brands::find()->where(['brand_id'=>$brandId])->one()->brand_name); ?></a>

										<?php if(isset($breadcrumbs[1])){?>
											<span class=" fcolorblue">/</span>
											<a style="line-height: 32px;" class="fcolorblue">
											<?php echo ucwords($breadcrumbs[1]); ?></a>

										<?php } ?>                  
							
								<?php } ?>
						</div>
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
								
									<a class="blue-round default top-paging" style="padding:2px !important;" href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params .'&page='.$prev.'&limit=20'; ?>&sortby=<?php echo $sortby;?>">
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
								
									<a class="blue-round default top-paging" style="padding:2px !important;" href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params .'&page='.$next.'&limit=20'; ?>&sortby=<?php echo $sortby;?>">
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
								
									<a class="blue-round default top-paging" style="padding:2px !important;padding-top:3px !important;" href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params .'&page='.$prev.'&limit=20'; ?>&sortby=<?php echo $sortby;?>">
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
								
									<a class="blue-round default top-paging" style="padding:2px !important;padding-top:3px !important;" href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params .'&page='.$next.'&limit=20'; ?>&sortby=<?php echo $sortby;?>">
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
										<a <?php if($limit == 20){ echo ' class="circle-fill-sprites25 fcolorfff talign-center fsize-12"';}else{ echo 'class="circle-sprites25 fcolorblue talign-center fsize-12"';}?> href="<?php echo $currentAc . '?page=1&limit=20'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">20</span></a>

										<a <?php if($limit == 40){ echo ' class="circle-fill-sprites25 fcolorfff talign-center fsize-12"';}else{ echo 'class="circle-sprites25 fcolorblue talign-center fsize-12"';}?> href="<?php echo $currentAc . '?page=1&limit=40'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">40</span></a>

										<a <?php if($limit == 60){ echo ' class="circle-fill-sprites25 fcolorfff talign-center fsize-12"';}else{ echo 'class="circle-sprites25 fcolorblue talign-center fsize-12"';}?> href="<?php echo $currentAc . '?page=1&limit=60'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">60</span></a>

										<a <?php if($limit == 100){ echo ' class="circle-fill-sprites25 fcolorfff talign-center fsize-12"';}else{ echo 'class="circle-sprites25 fcolorblue talign-center fsize-12"';}?> href="<?php echo $currentAc . '?page=1&limit=100'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">100</span></a> 
							</div>
						</div>
					</div>
				</div>
			</section>
            <?php
            if($current_date >= '2019-02-07 00:00:00' && $current_date <= '2019-02-28 23:59:59'){
                

			if (count($products) > 0) {
				$now = date("Y-m-d H:i:s");
				?>
				<section id="all-product">
				  <div class="hidden-sm container product-box clearleft" style="padding-top:20px;">

					<div class="row">
					  <!-- Filter Desktop -->
					  <?php

						  echo Yii::$app->view->renderFile('@app/shared/shared_filter.php', array(
							  "feature" => $feature,
							  "brands" => $brands,
							  "brands_selection" => $brands_selection,
							  "types_selection" => $types_selection,
							  "genders_selection" => $genders_selection,
							  "size_selection" => $size_selection,
							  "bandwidth_selection" => $bandwidth_selection,
							  "movements_selection" => $movements_selection,
							  "waters_selection" => $waters_selection,
							  "limit"=>$limit,
                            "sortby"=>$sortby,
						  ));
					  ?>

					<?php $i = 1; ?>
					<div class="hidden-sm col-lg-10 product-box space-cont-product">
					<?php foreach ($products as $product) { ?>
					  <?php if ($i == 1) { ?>
							  <div class="hidden-sm col-lg-12 product-box clearleft clearright clearleft-mobile clearright-mobile">
								  <div class="row">
					  <?php } ?>

					<?php if ($i == 5 || $i == 9 ||
							  $i == 13 || $i == 17 || $i == 21 ||
							  $i == 25 || $i == 29 || $i == 33 ||
							  $i == 37 || $i == 41 || $i == 45 ||
							  $i == 49 || $i == 53 || $i == 57 ||
							  $i == 61) { ?>
							<div class="hidden-sm col-lg-12 cont product-box clearleft clearright clearleft-mobile clearright-mobile">
								<div class="row">
					<?php } ?>
								<div class="hidden-sm col-lg-3 col-md-3 space-product col-xs-6 <?php echo $i % 2 == 0 ? 'pleft75' : 'pright75'; ?> mbottom-3-mobile">
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
									<a class="productClick" <?php echo $stock->quantity == 0 ? 'id="out-of-stock" data-id="'.$product->product_id.'"' : ''; ?> href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
										<?php } else { ?>
										<a class="productClick" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
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
														 <div class="tag-bellow tag-bellow2" style='background-color: #ae4a3b;'>
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
											if($stock != NULL){
											?>
											<div class='figcaption-wrap'>
												<img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
												<?php
														if($product->productNewArrival->product_newarrival_start_date <= $now && $product->productNewArrival->product_newarrival_end_date >= $now){
													?>
														 <div class="tag-bellow-custom" style='background-color: #4c757b;'>
															<div class=''>
																<span class='text-bellow'>
																New Arrival

																</span>
															</div>
														</div>

													  <?php
														}
													  ?>
											</div>
											<?php
												echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
											?>
											<?php
											} else {
											?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive">

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
										if($stock->quantity == 0){
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
									<a class="productClick" <?php echo $stock->quantity == 0 ? 'id="out-of-stock" data-id="'.$product->product_id.'"' : ''; ?> href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
										<?php } else { ?>
										<a class="productClick" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
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
											<img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
											<?php
												echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
											?>
											<?php
											} else {
											?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive">

											<?php } ?>
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
											if($stock->quantity == 0){
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
								 echo Yii::$app->view->renderFile('@app/views/brands/page_number_custom.php', array(
									 "current" => $current,
									 "breadcrumbs" => $breadcrumbs,
									 "total_page" => $total_page,
									 "limit" => $limit,
									 "params"=> $params,
									 "sortby"=> $sortby,
									 "currentAc"=>$currentAc,
								 ));
							 ?>
						</div>

					</div>
					<hr>
					<div class="col-lg-12 col-md-12 col-sm-12 clearleft clearright" style="text-align: center;">
						<a href="#" class="scrolls" style="color:#a8a9ad;">TOP</a>
					</div>
				</section>
				<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icon_top.png" class="scrollup"></a>
			<?php } else { ?>
			<section id="product">
			  <div class="hidden-sm container product-box clearleft">
				<div class="row">
				  <!-- Filter Desktop -->
				  <?php
					  echo Yii::$app->view->renderFile('@app/views/promo/filter.php', array(
						"feature" => $feature,
						"brands" => $brands,
						"brands_selection" => $brands_selection,
						"types_selection" => $types_selection,
						"genders_selection" => $genders_selection,
						"size_selection" => $size_selection,
						"bandwidth_selection" => $bandwidth_selection,
						"movements_selection" => $movements_selection,
						"waters_selection" => $waters_selection,
						"limit"=>$limit,
                            "sortby"=>$sortby,
					  ));
				  ?>
					<div class="col-lg-10 col-md-10 col-sm-10 ptop5 pbottom3">
						<center><span class="gotham-light fsize-1">PRODUCT NOT FOUND</span></center>
					</div>
				</div>
			  </div>
			</section>
			<?php } ?>
            <?php } else { ?>
            <section id="product">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 ptop5 pbottom3">
                        <center><span class="gotham-light fsize-1" style="font-size: 25px;">COMING SOON</span></center>
                    </div>
                </div>
            </section>                 
            <?php } ?>
            	
        </div>
    </div>
</section>
<style>
	@media only screen and (min-width : 768px) {
		.pleft-5-dwpetite {padding-left: 5%; }
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