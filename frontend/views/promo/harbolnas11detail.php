<?php
session_start();
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
        "list": "Landing Page Promo Ramadhan Aark Collective"
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
<section class="ptop1" style="padding:0px;">
    <div class="container">
        <div class="row">
           
            <?php 
                $current_date = date('Y-m-d H:i:s');
                $type_text = 'Casual';
                $type_button = 115;
                if($types_selection[0] == '115'){
                    $type_text = 'Casual';
                    $type_button = 115;
                }elseif($types_selection[0] == '116'){
                    $type_text = 'Aktif';
                    $type_button = 116;
                }elseif($types_selection[0] == '117'){
                    $type_text = 'Aksesoris';
                    $type_button = 117;
                }elseif($types_selection[0] == '12'){
                    $type_text = 'Klasik';
                    $type_button = 12;
                }
            ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright mbottom3">
			    <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearleft clearright clearleft-mobile clearright-mobile">
			        <img src='<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Desktop-Category-Page-<?php echo $type_text; ?>.png' class="img-responsive bradius5">
			    </div>
			    <div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
			        <img src='<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Mobile-Category-Page-<?php echo $type_text; ?>.png' class="img-responsive bradius5">
			    </div>
			    <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearleft clearright clearleft-mobile clearright-mobile ptop10">
			        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 clearleft clearleft-mobile pright5p">
			            <a href="<?php echo \yii\helpers\Url::base(); ?>/pesta-belanja-1111-detail?type=<?php echo $type_button == 116 ? 115 : 116; ?>">
			                <img src='<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Desktop-Category-Page-Thumbnail-<?php echo $type_text == 'Aktif' ? 'Casual':'Aktif'; ?>.png' class="img-responsive bradius5">
			            </a>
			            
			        </div>
			        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pright5p pleft5p">
			            <a href="<?php echo \yii\helpers\Url::base(); ?>/pesta-belanja-1111-detail?type=<?php echo $type_button == 117 ? 115 : 117; ?>">
			                <img src='<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Desktop-Category-Page-Thumbnail-<?php echo $type_text == 'Aksesoris' ? 'Casual':'Aksesoris'; ?>.png' class="img-responsive bradius5">
			            </a>
			            
			        </div>
			        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 clearright clearright-mobile pleft5p">
			            <a href="<?php echo \yii\helpers\Url::base(); ?>/pesta-belanja-1111-detail?type=<?php echo $type_button == 12 ? 115 : 12; ?>">
			                <img src='<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Desktop-Category-Page-Thumbnail-<?php echo $type_text == 'Klasik' ? 'Casual':'Klasik'; ?>.png' class="img-responsive bradius5">
			            </a>
			            
			        </div>
			    </div>
			    <div class="hidden-sm col-xs-12 hidden-lg hidden-md clearleft clearright clearleft-mobile clearright-mobile ptop10">
			        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearleft-mobile pright5p">
			            <a href="<?php echo \yii\helpers\Url::base(); ?>/pesta-belanja-1111-detail?type=<?php echo $type_button == 116 ? 115 : 116; ?>">
			                <img src='<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Mobile-Category-Page-Thumbnail-<?php echo $type_text == 'Aktif' ? 'Casual':'Aktif'; ?>.png' class="img-responsive bradius5">
			            </a>
			            
			        </div>
			        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pright5p pleft5p">
			            <a href="<?php echo \yii\helpers\Url::base(); ?>/pesta-belanja-1111-detail?type=<?php echo $type_button == 117 ? 115 : 117; ?>">
			                <img src='<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Mobile-Category-Page-Thumbnail-<?php echo $type_text == 'Aksesoris' ? 'Casual':'Aksesoris'; ?>.png' class="img-responsive bradius5">
			            </a>
			            
			        </div>
			        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearright clearright-mobile pleft5p">
			            <a href="<?php echo \yii\helpers\Url::base(); ?>/pesta-belanja-1111-detail?type=<?php echo $type_button == 12 ? 115 : 12; ?>">
			                <img src='<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Mobile-Category-Page-Thumbnail-<?php echo $type_text == 'Klasik' ? 'Casual':'Klasik'; ?>.png' class="img-responsive bradius5">
			            </a>
			            
			        </div>
			    </div>
			</div>
			<div class="hidden-lg hidden-md hidden-sm col-xs-12 new-line"></div>
			<section id="breadcrumb">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 hidden-sm hidden-xs clearleft clearright mbottom-5-mobile gotham-white fsize-18">
                            <div class="col-lg-12 col-md-12 col-sm-12 clearleft clearright">
                              <div class="col-lg-2 hidden-md col-sm-2 clearleft clearright"></div>
                              <div class="col-lg-4 col-md-4 col-sm-4 clearleft clearright talign-left line-height40 fsize-18">
                                <?php
                                $breadcrumbs = $this->context->breadcrumb;
                                $breadcrumbs[0] = 'pesta-belanja-1111-detail';
                                if(count($breadcrumbs) > 0){
                                    $i = 0;
                                    $len = count($breadcrumbs);
                                    foreach($breadcrumbs as $breadcrumb) {
                                      ?>
                                    <?php if(ucwords(str_replace('-', ' ', $breadcrumb)) != 'Explore') { ?>
                                        <!--<a style="line-height: 32px;" href="#" class="hidden-xs hidden-sm fcolorblue" <?php echo $i == 0 ? 'class="pleft7 remove-padding hidden-xs hidden-sm hidden-md fcolorblue" style="margin-left:8%;padding-left:22%;"' : ''; ?>><?php echo ucwords(str_replace('-', ' ', $breadcrumb)); ?></a>-->
                                        <?php if ($i != $len - 1) { ?>
                                            <!--<span class="hidden-xs hidden-sm fcolorblue">/</span>-->
                                        <?php } ?>
                                      <?php } ?>
                                <?php $i++; ?>
                                    <?php } ?>
                                <?php } ?>
                              </div>
                              <div class="col-lg-6 col-md-8 col-sm-6 clearleft clearright">
                                <div class="col-lg-6 col-md-6 col-sm-6 clearleft clearright talign-right">
                                  <span class="fcolorblue">View : </span>
                                  <a <?php if($limit == 20){ echo ' class="circle-fill-sprites fcolorfff talign-center"';}else{ echo 'class="circle-sprites fcolorblue talign-center"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '?' . $params . '&page=1&limit=20'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">20</span></a>
            
                                  <a <?php if($limit == 40){ echo ' class="circle-fill-sprites fcolorfff talign-center"';}else{ echo 'class="circle-sprites fcolorblue talign-center"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '?' . $params . '&page=1&limit=40'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">40</span></a>
            
                                  <a <?php if($limit == 60){ echo ' class="circle-fill-sprites fcolorfff talign-center"';}else{ echo 'class="circle-sprites fcolorblue talign-center"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '?' . $params . '&page=1&limit=60'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">60</span></a>
            
                                  <a <?php if($limit == 100){ echo ' class="circle-fill-sprites fcolorfff talign-center"';}else{ echo 'class="circle-sprites fcolorblue talign-center"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '?' . $params . '&page=1&limit=100'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">100</span></a> 
                                </div>
            
                                <div class="col-lg-6 col-md-6 col-sm-6 clearleft clearright line-height40 talign-right">
                                  <div class="clearleft clearright hidden-xs hidden-sm hidden-lg-4 fcolorblue lspace0-5" style="display: inline;">Sort by:
                                  </div>
                                  <div class="clearleft clearright hidden-xs hidden-sm hidden-lg-4" style="display: inline;">
                                      <a href="#" class="hidden-xs hidden-sm bradius20 bgcolorprimary pleft15 pright15 ptop5p pbottom5p" id="sorting">
                                          <span class="text-sorting fcolorfff"><?php if($sort_name == 'NONE'){ echo 'Brands Name';}else{ echo $sort_name; }  ?><span class="glyphicon glyphicon-menu-down" style="    padding-left: 5px;display: inline;"></span></span>
            
                                      </a>
            
                                      <div class="" id="arrow-sorting"></div>
                                      <div class="hidden-xs sorting-box talign-left" id="box-sorting">
                                          <a class="sorting-list top" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '?' . $params . '&page='.$current.'&limit='.$limit.'&sortby=none'; ?>">Brands Name</a>
                                          <a class="sorting-list" id="sorting-none" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '?' . $params . '&page='.$current.'&limit='.$limit.'&sortby=price-low-to-high'; ?>">Price Low to High</a>
                                          <a class="sorting-list bottom" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '?' . $params . '&page='.$current.'&limit='.$limit.'&sortby=price-high-to-low'; ?>">Price High to Low</a>
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </div>                     
            
                        </div>
                        
                        <div class="hidden-lg hidden-md col-xs-12 remove-padding" style="display: none; position: fixed; width: 100%; height: 100%; left: 0; top: 0px; background: #f6f6f6; z-index: 10; overflow: auto" id="sorting-content">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-5 text-gotham-medium" style="height: 45px;">
                                <span class="pull-left" style="letter-spacing:3px;text-align:center;">SORT BY</span>
                                <span class="pull-right">
                                    <a href="#" id="close-sorting-mobile">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-black.png" class="close-forgot" style="margin-bottom: 7px; width: 20%">
                                    </a>
                                </span>
                                <div class="clearfix"></div>
                                <div class="border-bottom-1"></div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <a href="<?php echo \yii\helpers\Url::base() . '/'. $urls[0] . '?' . $params . '&page='.$current.'&limit='.$limit.'&sortby=none'; ?>">
                                    <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                                        <span class="pull-left" style="letter-spacing:3px;">BRANDS NAME</span>
                                        <span class="pull-right radio-btn">
                                            <div class="ardown"><img class="arrow-down-watches" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-spec.png"></div>
                                        </span>
                                    </div>
                                </a>
                                <a href="<?php echo \yii\helpers\Url::base() . '/'. $urls[0] . '?' . $params . '&page='.$current.'&limit='.$limit.'&sortby=price-low-to-high'; ?>">
                                    <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                                        <span class="pull-left" style="letter-spacing:3px;">PRICE LOW TO HIGH</span>
                                        <span class="pull-right radio-btn">
                                            <div class="ardown"><img class="arrow-down-watches" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-spec.png"></div>
                                        </span>
                                    </div>
                                </a>
                                <a href="<?php echo \yii\helpers\Url::base() . '/'. $urls[0] . '?' . $params . '&page='.$current.'&limit='.$limit.'&sortby=price-high-to-low'; ?>">
                                    <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                                        <span class="pull-left" style="letter-spacing:3px;">PRICE HIGH TO LOW</span>
                                        <span class="pull-right radio-btn">
                                            <div class="ardown"><img class="arrow-down-watches" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-spec.png"></div>
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </div>
             
                          <div class="hidden-lg hidden-md col-sm-12 col-xs-12 clearleft clearright font-paging">
                            <div class="col-sm-12 col-xs-12 talign-center clearleft-mobile clearright-mobile">
                              <div class="col-sm-6 col-xs-6 clearleft-mobile clearleft">
                                <a class="blue-round default" id="filter-mobile" style="padding-bottom: 2px !important;">
                                  <span class="col-sm-6 col-xs-6 clearleft-mobile clearright-mobile fsize-12 talign-left">Filter</span>
                                  <span class="col-sm-6 col-xs-6 clearleft-mobile clearright-mobile talign-right"><i class="filter-white-sprite"></i></span>
                                </a>
                              </div>
                              <div class="col-sm-6 col-xs-6 clearright-mobile clearright">
                                <a class="blue-round default" id="sorting-mobile" style="padding-bottom: 2px !important;">
                                  <span class="col-sm-6 col-xs-6 clearleft-mobile clearright-mobile fsize-12 talign-left">Urutkan</span>
                                  <span class="col-sm-6 col-xs-6 clearleft-mobile clearright-mobile talign-right"><i class="sort-white-sprite"></i></span>
                                </a>
                              </div>
                                  
                                <div class="hidden-lg hidden-md col-xs-12 remove-padding" style="display: none; position: fixed; width: 100%; height: 100%; left: 0; top: 0px; background: #f6f6f6; z-index: 10; overflow: auto" id="sorting-content">
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
                                      <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params . '&page='.$current.'&limit='. $limit; ?>&sortby=none">
                                          <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                                              <span class="pull-left lspace3">BRANDS NAME</span>
            
                                          </div>
                                      </a>
                                      <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params . '&page='.$current.'&limit='. $limit; ?>&sortby=price-low-to-high">
                                          <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                                              <span class="pull-left lspace3">PRICE LOW TO HIGH</span>
            
                                          </div>
                                      </a>
                                      <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params . '&page='.$current.'&limit='. $limit; ?>&sortby=price-high-to-low">
                                          <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                                              <span class="pull-left lspace3">PRICE HIGH TO LOW</span>
            
                                          </div>
                                      </a>
                                  </div>
                                </div>
            
                                <?php
            
                                    echo Yii::$app->view->renderFile('@app/views/promo/filter_mobile.php', array(
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
                            </div>
                          </div>
                          <div class="hidden-sm col-xs-12 hidden-lg hidden-md talign-center fsize-12 ptop15 pbottom15">
                            <?php
                                      $breadcrumbs = $this->context->breadcrumb;
                                      if(count($breadcrumbs) > 0){
                                          $i = 0;
                                          $len = count($breadcrumbs);
                                          foreach($breadcrumbs as $breadcrumb) {
                                            ?>
                                          <?php if(ucwords(str_replace('-', ' ', $breadcrumb)) != 'Explore') { ?>
                                              <a style="line-height: 32px;" href="#" class="fcolorblue" <?php echo $i == 0 ? 'class="pleft7 remove-padding hidden-xs hidden-sm hidden-md fcolorblue" style="margin-left:8%;padding-left:22%;"' : ''; ?>><?php echo ucwords(str_replace('-', ' ', $breadcrumb)); ?></a>
                                              <?php if ($i != $len - 1) { ?>
                                                  <span class="fcolorblue">/</span>
                                              <?php } ?>
                                            <?php } ?>
                                      <?php $i++; ?>
                                          <?php } ?>
                                      <?php } ?>
                          </div>
                          <div class="hidden-xs col-sm-12 hidden-lg hidden-md talign-center fsize-14 ptop15 pbottom15">
                            <?php
                                      $breadcrumbs = $this->context->breadcrumb;
                                      if(count($breadcrumbs) > 0){
                                          $i = 0;
                                          $len = count($breadcrumbs);
                                          foreach($breadcrumbs as $breadcrumb) {
                                            ?>
                                          <?php if(ucwords(str_replace('-', ' ', $breadcrumb)) != 'Explore') { ?>
                                              <a style="line-height: 32px;" href="#" class="fcolorblue" <?php echo $i == 0 ? 'class="pleft7 remove-padding hidden-xs hidden-sm hidden-md fcolorblue" style="margin-left:8%;padding-left:22%;"' : ''; ?>><?php echo ucwords(str_replace('-', ' ', $breadcrumb)); ?></a>
                                              <?php if ($i != $len - 1) { ?>
                                                  <span class="fcolorblue">/</span>
                                              <?php } ?>
                                            <?php } ?>
                                      <?php $i++; ?>
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
                                  
                                      <a class="blue-round default top-paging" style="padding:2px !important;" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '?' . $params .'&page='.$prev.'&limit=20'; ?>&sortby=<?php echo $sortby;?>">
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
                                
                                      <a class="blue-round default top-paging" style="padding:2px !important;" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '?' . $params .'&page='.$next.'&limit=20'; ?>&sortby=<?php echo $sortby;?>">
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
                                  
                                      <a class="blue-round default top-paging" style="padding:2px !important;padding-top:3px !important;" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '?' . $params .'&page='.$prev.'&limit=20'; ?>&sortby=<?php echo $sortby;?>">
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
                                
                                      <a class="blue-round default top-paging" style="padding:2px !important;padding-top:3px !important;" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '?' . $params .'&page='.$next.'&limit=20'; ?>&sortby=<?php echo $sortby;?>">
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
                                          <a <?php if($limit == 20){ echo ' class="circle-fill-sprites25 fcolorfff talign-center fsize-12"';}else{ echo 'class="circle-sprites25 fcolorblue talign-center fsize-12"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '?' . $params . '&page=1&limit=20'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">20</span></a>
            
                                          <a <?php if($limit == 40){ echo ' class="circle-fill-sprites25 fcolorfff talign-center fsize-12"';}else{ echo 'class="circle-sprites25 fcolorblue talign-center fsize-12"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '?' . $params . '&page=1&limit=40'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">40</span></a>
            
                                          <a <?php if($limit == 60){ echo ' class="circle-fill-sprites25 fcolorfff talign-center fsize-12"';}else{ echo 'class="circle-sprites25 fcolorblue talign-center fsize-12"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '?' . $params . '&page=1&limit=60'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">60</span></a>
            
                                          <a <?php if($limit == 100){ echo ' class="circle-fill-sprites25 fcolorfff talign-center fsize-12"';}else{ echo 'class="circle-sprites25 fcolorblue talign-center fsize-12"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '?' . $params . '&page=1&limit=100'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">100</span></a> 
                            </div>
                          </div>
                      
                    </div>
                </div>
                
        </section>
			<?php
            $current_date = date('Y-m-d H:i:s');
            $now = date("Y-m-d H:i:s");
// 			if($_SESSION['customerInfo']['customer_id'] == 7614){
// 				$current_date = '2018-11-10 00:00:00';
// 				$now = '2018-11-10 00:00:00';
// 			}
            if($current_date >= '2018-11-09 00:00:00' && $current_date <= '2018-11-11 23:59:59'){

            if (count($products) > 0) {
            
        	
            ?>
            <section id="all-product">
              <div class="container product-box clearleft" style="padding-top:20px;">
        
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
        
                <?php $i = 1; ?>
               <div class="col-lg-10 col-md-10 product-box space-cont-product">
                <?php foreach ($products as $product) { ?>
                  <?php if ($i == 1) { ?>
                          <div class="col-lg-12 col-md-12 product-box clearleft clearright clearleft-mobile clearright-mobile">
                              <div class="row">
                  <?php } ?>
        
                <?php if ($i == 5 || $i == 9 ||
                          $i == 13 || $i == 17 || $i == 21 ||
                          $i == 25 || $i == 29 || $i == 33 ||
                          $i == 37 || $i == 41 || $i == 45 ||
                          $i == 49 || $i == 53 || $i == 57 ||
                          $i == 61 || $i == 65 || $i == 69 || 
                          $i == 73 || $i == 77 || $i == 81 || 
                          $i == 85 || $i == 89 || $i == 93 || 
                          $i == 97 || $i == 101) { ?>
                        <div class="hidden-sm col-lg-12 col-md-12 product-box clearleft clearright clearleft-mobile clearright-mobile">
                            <div class="row">
                <?php } ?>
                            <div class="hidden-sm col-lg-3 col-md-3 space-product col-xs-6 <?php echo $i % 2 == 0 ? 'pleft75' : 'pright75'; ?> mbottom-3-mobile">
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
        								<div class="tag" style="right: 0; left: 15px; top: 15px;">
        									<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">
        								</div>
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
        							    
                                        
                                            
                                                <?php
                                                    //if($product->specificPrice->description == "cybersale1010"){
                                                ?>
                                                     <!--<div class="tag-bellow tag-bellow2 width100" style='background-color: #a01d22;position: absolute;'>
                                                        <div class=''>
                                                            <span class='text-bellow'>
                                                            Ekstra Diskon 10%
        
                                                            </span>
                                                        </div>
                                                    </div>-->
        
                                                  <?php
                                                    //}
                                                  ?>
        										  <!--
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
        							-->
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
                                            <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>
        	
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
                            if ($i % 4 == 0) {
                                echo '<div class="hidden-xs col-lg-12 col-md-12 col-sm-12 clearfix"></div>';
                            }
        
                            if ($i % 2 == 0){
                                echo '<div class="hidden-lg hidden-md hidden-sm col-xs-12 clearfix"></div>';
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
        
                <?php $i = 1; ?>
                <?php foreach ($products as $product) { ?>
                <?php if ($i == 1 || $i == 4 || $i == 7 ||
                          $i == 10 || $i == 13 || $i == 16 ||
                          $i == 19 || $i == 22 || $i == 25 ||
                          $i == 28 || $i == 31 || $i == 34 ||
                          $i == 37 || $i == 40 || $i == 43 ||
                          $i == 46 || $i == 49 || $i == 52 ||
                          $i == 55 || $i == 58 || $i == 61 ||
                          $i == 64 || $i == 67 || $i == 70 ||
                          $i == 73 || $i == 76 || $i == 79 ||
                          $i == 82 || $i == 85 || $i == 88 ||
                          $i == 91 || $i == 94 || $i == 97 || $i == 100) { ?>
                        <div class="hidden-lg hidden-md hidden-xs col-sm-12 container product-box clearleft">
                            <div class="row">
                    <?php } ?>
                            <div class="col-sm-4 <?php echo $i % 2 == 0 ? 'pleft75' : 'pright75'; ?>">
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
        								<div class="tag" style="right: 0; left: 15px; top: 15px;">
        									<img src="<?php echo \yii\helpers\Url::base(); ?>/img/promo/harbolnas/1111/Logo-black.png">
        								</div>
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
        							
        							<!--
                                    <div style="position:relative;">
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
                                                     <div class="tag-bellow" style='background-color: #ae4a3b;position: absolute;width: 100%;bottom: 0;top: auto;'>
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
        									-->
                                                <?php
                                                    //if($product->specificPrice->description == "cybersale1010"){
                                                ?>
                                                     <!--<div class="hidden-xs tag-bellow tag-bellow2 width100" style='background-color: #a01d22;position: absolute;'>
                                                        <div class=''>
                                                            <span class='text-bellow'>
                                                            Ekstra Diskon 10%
        
                                                            </span>
                                                        </div>
                                                    </div>-->
        
                                                  <?php
                                                    //}
                                                  ?>
        										  <!--
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
        							-->
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
        								$extraDiscount = 0;
        								$extraDiscountStartDate = '2018-10-10 00:00:00';
        								$extraDiscountEndDate = '2018-10-10 23:59:59';
        								if($_SESSION['customerInfo']['customer_id'] == 570){
        									$now = '2018-10-10 00:00:00';
        								}
                                        if ($spesificPrice != null) {
                                            ?>
                                            <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>
        
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
                            if ($i % 3 == 0) {
                                echo '<div class="hidden-sm col-lg-12 col-md-12 col-xs-12 clearfix"></div>';
                            }
                            ?>
                            <?php if ($i == 3 || $i == 6 || $i == 9 || $i == 12 ||
                                      $i == 15 || $i == 18 || $i == 21 || $i == 24 ||
                                      $i == 27 || $i == 30 || $i == 33 || $i == 36 || $i == 39 ||
                                      $i == 42 || $i == 45 || $i == 48 || $i == 51 || $i == 54 ||
                                      $i == 57 || $i == 60 || $i == 63 || $i == 66 || $i == 69 ||
                                      $i == 72 || $i == 75 || $i == 78 || $i == 81 || $i == 84 ||
                                      $i == 87 || $i == 90 || $i == 93 || $i == 96 || $i == 99 ||
                                      $i == 102 ) { ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php $i++; ?>
                <?php } ?>
                </div>
              </div>
            </section>
            <?php //if($count > 4) {  ?>
            <section id="all-product-footer" style="padding-bottom: 70px;">
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

<section class="hidden-lg hidden-md- hidden-sm col-xs-12" style="padding-top:88px;"></section>
<!--SEO Pages-->
<section style=" padding: 0px 0;z-index;1;">
    <div class="col-lg-12 col-md-12 col-sm-12" style="background-color: #fff;z-index: 1;
    margin-top: -70px;">  
        <div class="container clearleft">
                    <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs clearleft seo-description-left">
                        
                            <h2 class="seodesc fsize-11"><strong>Filosofi 11-11</strong></h2>

                            <p class="seodesc">Tanggal 11 November merupakan tanggal yang biasa bagi banyak orang. Namun berbeda bagi warga China. Di tanggal tersebut, mereka biasanya menghabiskan uang dengan cara belanja online dengan nominal fantastis. Bahkan mereka bisa menghabiskan milyaran dollar pada hari itu. Bukan tanpa alasan untuk semua itu, melainkan mereka merayakan Single’s Day atau hari Jomblo. Bagi mereka yang jomblo merayakan kejombloannya bersama kawan-kawannya berbelanja, makan, karaoke, atau pergi ke suatu tempat untuk memanjakan dirinya. </p>
                            
                            <h2 class="seodesc fsize-11"><strong>Ide 11-11 Menjadi Hari Belanja Online</strong></h2>

                            <p class="seodesc">Salah satu perusahaan e-commerce raksasa di China  membuat sebuah tren untuk Single’s Day atau hari jomblo ini. Sebelumnya, tanggal 11-11 dirayakan untuk memanjakan diri bagi yang masih jomblo, kini dibuatlah lebih praktis untuk memanjakannya. Biasanya banyak toko yang memberikan harga promo diskon besar-besaran. Kini tren tersebut juga dibawa ke toko online dengan memberikan diskon besar-besaran pula dan hasilnya pun sukses. Setelah itu, tren tersebut diikuti oleh berbagai negara dan menjadikan tanggal 11-11 menjadi hari belanja online.</p>
                    
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs seo-description-right">
                            
                            <h2 class="seodesc fsize-11"><strong>Pesta Belanja Online</strong></h2>

                            <p class="seodesc">Ketika memasuki akhir tahun, sudah tak asing lagi bagi perusahaan yang jual produk atau jasa memberikan harga spesial. Biasanya  mengadakan diskon akhir tahun yang salah satu tujuannya untuk menghabiskan koleksi produk di tahun tersebut. Karena di tahun berikutnya pasti akan mengeluarkan koleksi terbaru. Jadi koleksi yang ada diupayakan bisa segera habis. Oleh karena itu, di bulan November bisa dikatakan sebagai pesta belanja online. Buat kamu yang suka belanja, saatnya persiapkan diri untuk memburu produk favoritmu.</p>
                            
                            <h2 class="seodesc fsize-11"><strong>Pesta Belanja 11-11 The Watch Co.</strong></h2>

                            <p class="seodesc">Pada momen kali ini, The Watch Co. pun turut serta meriahkan Single’s Day dengan tema Pesta Belanja Online 11-11. Berbagai brand tentunya memberikan diskon untuk produk jam tangan, strap, tas, jaket, majalah, dan aksesoris lainnya. Kamu bisa menikmati promo diskon ini dari tanggal 9-11 November 2018. Dan promo ini berlangsung selama 24 jam. Catat tanggal tersebut dan pastikan kamu cek produk yang tersedia di halaman ini. Diskon yang diberikan pun jarang bisa kamu dapatkan di momen lainnya. Tunggu apalagi, saatnya miliki koleksi produk pilihanmu hanya di sini.</p>
                            
                    </div>
                    <!--mobile version-->
                    <div class="hidden-lg hidden-md hidden-sm" id="readmore" style="padding-top: 11px; padding-bottom: 1px; text-align: justify;">
                        <p class="show-read-more">
                            <h2 class="seodesc fsize-11"><strong>Filosofi 11-11</strong></h2>

                            <p class="seodesc">Tanggal 11 November merupakan tanggal yang biasa bagi banyak orang. Namun berbeda bagi warga China. Di tanggal tersebut, mereka biasanya menghabiskan uang dengan cara belanja online dengan nominal fantastis...<br><br><a>(Baca Selengkapnya)</a>                        </p>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm" id="left" style="padding-top: 11px; padding-bottom: 1px; text-align: justify; display: none;">
                        <p class="show-read-more">
                             <h2 class="seodesc fsize-11"><strong>Filosofi 11-11</strong></h2>

                            <p class="seodesc">Tanggal 11 November merupakan tanggal yang biasa bagi banyak orang. Namun berbeda bagi warga China. Di tanggal tersebut, mereka biasanya menghabiskan uang dengan cara belanja online dengan nominal fantastis. Bahkan mereka bisa menghabiskan milyaran dollar pada hari itu. Bukan tanpa alasan untuk semua itu, melainkan mereka merayakan Single’s Day atau hari Jomblo. Bagi mereka yang jomblo merayakan kejombloannya bersama kawan-kawannya berbelanja, makan, karaoke, atau pergi ke suatu tempat untuk memanjakan dirinya. </p>
                            
                            <h2 class="seodesc fsize-11"><strong>Ide 11-11 Menjadi Hari Belanja Online</strong></h2>

                            <p class="seodesc">Salah satu perusahaan e-commerce raksasa di China  membuat sebuah tren untuk Single’s Day atau hari jomblo ini. Sebelumnya, tanggal 11-11 dirayakan untuk memanjakan diri bagi yang masih jomblo, kini dibuatlah lebih praktis untuk memanjakannya. Biasanya banyak toko yang memberikan harga promo diskon besar-besaran. Kini tren tersebut juga dibawa ke toko online dengan memberikan diskon besar-besaran pula dan hasilnya pun sukses. Setelah itu, tren tersebut diikuti oleh berbagai negara dan menjadikan tanggal 11-11 menjadi hari belanja online.</p>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm" id="right" style="padding-top: 11px; padding-bottom: 1px; text-align: justify; display: none;">
                        <p class="show-read-more"></p>
                            <h2 class="seodesc fsize-11"><strong>Pesta Belanja Online</strong></h2>

                            <p class="seodesc">Ketika memasuki akhir tahun, sudah tak asing lagi bagi perusahaan yang jual produk atau jasa memberikan harga spesial. Biasanya  mengadakan diskon akhir tahun yang salah satu tujuannya untuk menghabiskan koleksi produk di tahun tersebut. Karena di tahun berikutnya pasti akan mengeluarkan koleksi terbaru. Jadi koleksi yang ada diupayakan bisa segera habis. Oleh karena itu, di bulan November bisa dikatakan sebagai pesta belanja online. Buat kamu yang suka belanja, saatnya persiapkan diri untuk memburu produk favoritmu.</p>
                            
                            <h2 class="seodesc fsize-11"><strong>Pesta Belanja 11-11 The Watch Co.</strong></h2>

                            <p class="seodesc">Pada momen kali ini, The Watch Co. pun turut serta meriahkan Single’s Day dengan tema Pesta Belanja Online 11-11. Berbagai brand tentunya memberikan diskon untuk produk jam tangan, strap, tas, jaket, majalah, dan aksesoris lainnya. Kamu bisa menikmati promo diskon ini dari tanggal 9-11 November 2018. Dan promo ini berlangsung selama 24 jam. Catat tanggal tersebut dan pastikan kamu cek produk yang tersedia di halaman ini. Diskon yang diberikan pun jarang bisa kamu dapatkan di momen lainnya. Tunggu apalagi, saatnya miliki koleksi produk pilihanmu hanya di sini.</p>
                    </div>
            </div>
    </div>

</section>

<style>
@media only screen and (min-width : 768px) {
		.text-bellow { text-align: center; font-size: 14px; }
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
		.clearfix{
            padding-bottom: 25px;
        }
	}
	
	@media only screen and (max-width : 767px) {
		section#all-product-footer { margin-bottom: 80px; }
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
		.tag-bellow {
			position: absolute;
			height: 20px;
			color: white;
			
			/* bottom: 0; */
			margin-right: 15px;
			width: 89.5%;
			z-index: 1;
		}
		.text-bellow { text-align: center; font-size: 14px; }
	}
	@media only screen and (max-width : 767px) {
	.mtop3-mobile { margin-top: 3%; }
	.mtop8-em-mobile { margin-top: 8em; }
	
    }
    p.seodesc{font-size: 0.7em; line-height: 1.3em; font-family: gotham-light;}
    .show-read-more .more-text{
        display: none;
    }
    
    @media only screen and (min-width : 1281px) {
        .tag-bellow.tag-bellow2{
            top:323px;
        }
    }
    
    @media only screen and (min-width : 360px) and (max-width: 374px) {
        .tag-bellow.tag-bellow2{
            top:196px;
        }
    }
    
</style>



