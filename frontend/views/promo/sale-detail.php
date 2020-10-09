<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php
$breadcrumbs = $this->context->breadcrumb;
$params = '';

// echo $breadcrumbs[1];
//
// echo $brandName;
if(isset($breadcrumbs[1])){
    $currentAc = $breadcrumbs[1] . '/brand/' . $brandName;
}else{
    $currentAc = '/thewatch.co/brand/' . $brandName;
}
if(isset($_GET['sort'])){
    $params = 'sort=' . $_GET['sort'];
}

if(isset($_GET['brands'])){
    $params = $params . '&brands=' . $_GET['brands'];
    $brands_selection = explode('--', $_GET['brands']);
}

if(isset($_GET['collection'])){
    $params = $params . '&collection=' . $_GET['collection'];
    $collection_selection = explode('--', $_GET['collection']);
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
                        $sort_name = ucwords($sort_name);
                        $sortby = $_GET['sortby'];
                    }else{
                        $sort_name = 'NONE';
                    }

                    $category = backend\models\ProductCategory::findOne(['product_category_name' => $category->product_category_name]);
                    $feature = \backend\models\Feature::find()->all();
?>
<script>
var currentCategory = '<?php echo $category->product_category_name; ?>';
var currentAction = '<?php //echo $breadcrumbs[2]; ?>';

var items = [];
	
    <?php $i = 1; ?>
    <?php if (count($products) > 0) { ?>
    <?php 
    foreach ($products as $product) { 
        // if product has discount
        $spesificPrice = backend\models\SpecificPrice::findOne(['product_id' => $product->product_id]);
        $discount = 0;
        $now = date('Y-m-d H:i:s');
        if ($spesificPrice != null) {
            if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) {

            } else {
                if ($spesificPrice->reduction_type == 'percent') {
                    $discount = (($spesificPrice->reduction / 100) * $product->price);
                } elseif ($spesificPrice->reduction_type == 'amount') {
                    $discount = $spesificPrice->reduction;
                }
            }
        }
    ?>

    items.push({
        "id": "<?php echo $product->product_id; ?>",
        "name": "<?php echo $product->productDetail->name; ?>",
        "price": "<?php echo $product->price - $discount; ?>",
        "brand": "<?php echo $product->brands->brand_name; ?>",
        "category": "<?php echo $product->productCategory->product_category_name; ?>",
        "position": <?php echo $i; ?>,
        "list": currentCategory + ' - ' + '<?php echo $brand_detail->brand_name; ?>'
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
<div class="hidden-lg hidden-xs" style="padding-top:160px;"></div>
<div class="container">
<div class="row">

    <header id="myCarousel" class="carousel slide col-lg-4 col-md-6 col-sm-6 col-xs-12 clearleft">
        <!-- Indicators -->
        <ol class="carousel-indicators" style="z-index:1;">
            <?php $i = 0; ?>
            <?php if (count($brandBanner) > 0) { ?>
                <?php foreach ($brandBanner as $banner) { ?>
                    <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $i === 0 ? 'active' : ''; ?>"></li>
                    <?php $i++; ?>
                <?php } ?>
            <?php } ?>
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner clearleft clearright">
            <?php $i = 1; ?>
            <?php if (count($brandBanner) > 0) { ?>
                <?php foreach ($brandBanner as $banner) { ?>
                    <div class="item <?php echo $i === 1 ? 'active' : ''; ?>">
                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/brand_banner/<?php echo $brand_detail->brand_id; ?>/<?php echo $banner->brands_banner_detail_slide_image; ?>" class="img-responsive" style="width: 1800px">
                        <!--<div class="fill" style="background-image: url(<?php // echo Yii::$app->params['imgixUrl'] ?>img/brand_banner/<?php // echo $brand_detail->brand_id; ?>/<?php // echo $banner->brands_banner_detail_slide_image; ?>);"></div>-->
                    </div>
                    <?php $i++; ?>
                <?php } ?>
            <?php } ?>
        </div>

        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>

    </header>
    <!-- <div class="col-lg-2 col-md-12 col-sm-12 brand-logo">
        <img src="<?php echo Yii::$app->params['imgixUrl'] ?>img/brands/black/<?php echo $brand_detail->brand_logo; ?>">
    </div> -->
    <div class="col-lg-8 col-md-6 col-sm-6 hidden-xs clearright">
        <div class="brand-name-full">
            <span class="brand-name"><?php echo strtoupper($brand_detail->brand_name); ?> <?php if(strtoupper($brand_detail->brand_name) == 'WELDER'){ }else{ echo '-';}?> </span><span class="brand-country"><?php echo strtoupper($brand_detail->brand_country); ?></span>
        </div>
        <div class="brand-description" style="text-align: left;">
            <?php
            $max_length = 750;
            $brand_desc = $brand_detail['brand_description'];
            if (strlen($brand_detail['brand_description']) > $max_length)
            {
                $offset = ($max_length - 3) - strlen($brand_detail['brand_description']);
                $brand_desc = substr($brand_detail['brand_description'], 0, strrpos($brand_detail['brand_description'], ' ', $offset)) . '...';
                ?>
                <p class="brand-hide"><?php echo $brand_desc.' '; ?><a href="#" class="" style="text-decoration:underline;color:rgb(158,132,97);" onclick="show_description_brand_desktop()">Selengkapnya </a></p>
                <p class="brand-show" style="display:none;"><?php echo $brand_detail['brand_description'].' '; ?><a href="#" class="" style="text-decoration:underline;color:rgb(158,132,97);" onclick="hide_description_brand_desktop()">Hide </a></p>
              <?php
            }else{ ?>
              <p class=""><?php echo $brand_desc.' '; ?></p>
              <?php
            }
          ?>
        </div>
    </div>
</div>
</div>

<section id="" class="brand-desc-detail hidden-lg hidden-md hidden-sm" style="padding-top: 25px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                <div class="brand-name-full" style="text-align: left;">
                    <span class="brand-name"><?php echo strtoupper($brand_detail->brand_name); ?> - </span><span class="brand-country"><?php echo strtoupper($brand_detail->brand_country); ?></span>
                </div>
                <div class="" id="brand-name">
                    <a style="color:#9f8562;" onclick="scroll_description_brand()" class="col-xs-12 clearright-mobile clearleft-mobile">
                        More Info<span class="glyphicon glyphicon-menu-down" style="color:white;background-color: #9f8562;border-radius:40px;padding: 4px;font-size: 9px;float: right;"></span>
                    </a>
                </div>

                <div class="brand-description" id="brand-brand-description" style="display: none;overflow: auto;padding-top: 0px;margin-bottom: 0px;">
                    <div class="col-lg-2 col-md-12 col-sm-12 brand-logo">
                        <img src="<?php echo Yii::$app->params['imgixUrl'] ?>brands/black/<?php echo $brand_detail->brand_logo; ?>">
                    </div>
                    <p class="fsize1-3rem" style="text-align: left;"><?php echo $brand_detail->brand_description; ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="brand-collection-buttonsss" style="padding:0px;">
</section>
<section id="brand-collection-button" class="brand-desc-detail hidden-lg hidden-md hidden-sm" style="padding-top: 25px;">
    
</section>

<script type="text/javascript">
    
</script>

<style>
    .brand-button{
        width: 16.2%;
    }
    @media only screen and (min-width : 768px) {
        .tnc-coldplay { font-family: "gotham-light";}
        .tnc-coldplay-separator { border-bottom: 1px solid;margin-left: 1.5%;width: 50px; }
    }
    
    @media only screen and (max-width : 767px) {
        .tnc-coldplay { font-family: "gotham-light";}
        .mtop5-mobile { margin-top: 5%; }
        .tnc-coldplay-separator { border-bottom: 1px solid;margin-left: 5%;width: 50px; margin-top: 5%; margin-bottom: 5%;}
        .brand-button{
             width: 47%;
        }
        a.yellow-round {
        /*float: right;*/
        border: 1px solid #9f8562;
        cursor: pointer;
        border-radius: 20px;
        padding: 10px;
        padding-left: 20px;
        padding-right: 20px;
        letter-spacing: 2px;
        background: #9f8562;
        color: #fff;
        /*width: 10%;*/
        }
        a.yellow-round:hover {
            /*float: right;*/
            border: 1px solid #9f8562;
            cursor: pointer;
            border-radius: 20px;
            padding: 10px;
            padding-left: 20px;
            padding-right: 20px;
            letter-spacing: 2px;
            background: #fff;
            color: #9f8562;
            /*width: 10%;*/
        }
    }
</style>

<?php
// if($category->product_category_name == 'watches' || $category->product_category_name == 'straps'){
//     echo Yii::$app->view->renderFile('@app/views/widget/filter.php', array('category' => $category, "breadcrumbs" => $breadcrumbs));
// } elseif($category->product_category_name == 'essentials') {
//     echo Yii::$app->view->renderFile('@app/views/widget/filter_essentials.php', array('category' => $category, "breadcrumbs" => $breadcrumbs));
// }
?>
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
                      <a <?php if($limit == 20){ echo ' class="circle-fill-sprites fcolorfff talign-center"';}else{ echo 'class="circle-sprites fcolorblue talign-center"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params . '&page=1&limit=20'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">20</span></a>

                      <a <?php if($limit == 40){ echo ' class="circle-fill-sprites fcolorfff talign-center"';}else{ echo 'class="circle-sprites fcolorblue talign-center"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params . '&page=1&limit=40'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">40</span></a>

                      <a <?php if($limit == 60){ echo ' class="circle-fill-sprites fcolorfff talign-center"';}else{ echo 'class="circle-sprites fcolorblue talign-center"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params . '&page=1&limit=60'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">60</span></a>

                      <a <?php if($limit == 100){ echo ' class="circle-fill-sprites fcolorfff talign-center"';}else{ echo 'class="circle-sprites fcolorblue talign-center"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params . '&page=1&limit=100'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">100</span></a> 
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
                              <a class="sorting-list top" href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params . '&page='.$current.'&limit='.$limit.'&sortby=none'; ?>">Brands Name</a>
                              <a class="sorting-list" id="sorting-none" href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params . '&page='.$current.'&limit='.$limit.'&sortby=price-low-to-high'; ?>">Price Low to High</a>
                              <a class="sorting-list bottom" href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params . '&page='.$current.'&limit='.$limit.'&sortby=price-high-to-low'; ?>">Price High to Low</a>
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
                          <a href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params . '&page='.$current.'&limit='. $limit; ?>&sortby=none">
                              <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                                  <span class="pull-left lspace3">BRANDS NAME</span>

                              </div>
                          </a>
                          <a href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params . '&page='.$current.'&limit='. $limit; ?>&sortby=price-low-to-high">
                              <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                                  <span class="pull-left lspace3">PRICE LOW TO HIGH</span>

                              </div>
                          </a>
                          <a href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params . '&page='.$current.'&limit='. $limit; ?>&sortby=price-high-to-low">
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
                              <a <?php if($limit == 20){ echo ' class="circle-fill-sprites25 fcolorfff talign-center fsize-12"';}else{ echo 'class="circle-sprites25 fcolorblue talign-center fsize-12"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params . '&page=1&limit=20'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">20</span></a>

                              <a <?php if($limit == 40){ echo ' class="circle-fill-sprites25 fcolorfff talign-center fsize-12"';}else{ echo 'class="circle-sprites25 fcolorblue talign-center fsize-12"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params . '&page=1&limit=40'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">40</span></a>

                              <a <?php if($limit == 60){ echo ' class="circle-fill-sprites25 fcolorfff talign-center fsize-12"';}else{ echo 'class="circle-sprites25 fcolorblue talign-center fsize-12"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params . '&page=1&limit=60'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">60</span></a>

                              <a <?php if($limit == 100){ echo ' class="circle-fill-sprites25 fcolorfff talign-center fsize-12"';}else{ echo 'class="circle-sprites25 fcolorblue talign-center fsize-12"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params . '&page=1&limit=100'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">100</span></a> 
                </div>
              </div>
        </div>
    </div>
</section>
<?php
if (count($products) > 0) {
    $now = date("Y-m-d H:i:s");
    ?>
    <section id="all-product">
      <div class="container product-box clearleft" style="padding-top:20px;">

        <div class="row">
          <!-- Filter Desktop -->
          <?php
          echo Yii::$app->view->renderFile('@app/views/brands/filter.php', array(
              "feature" => $feature,
              "products"=> $products,
              "types_selection" => $types_selection,
              "genders_selection" => $genders_selection,
              "collection_selection" => $collection_selection,
              "size_selection" => $size_selection,
              "bandwidth_selection" => $bandwidth_selection,
              "movements_selection" => $movements_selection,
              "waters_selection" => $waters_selection,
              "brandName" => $brandName,
              "breadcrumbs" => $breadcrumbs,
              "brandId"=> $brandId,
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
                <div class="hidden-sm col-lg-12 col-md-12 cont product-box clearleft clearright clearleft-mobile clearright-mobile">
                    <div class="row">
        <?php } ?>
                    <div class="hidden-sm col-lg-3 col-md-3 col-xs-6 space-product <?php echo $i % 2 == 0 ? 'pleft75' : 'pright75'; ?> mbottom-3-mobile">
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
                            <div style="position: relative;">
                               
                                <div class="tag">
                                    <?php
                                    $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->andWhere(['is_flash_sale'=>0])->all();
                                    $check_flash = 0;
                                    if ($spesificPriceAll != null) {
                                        foreach ($spesificPriceAll as $specificPrice) {
                                            if ($specificPrice->from <= $now && $specificPrice->to > $now) {
                                                if($specificPrice->is_flash_sale == 1){
                                                    $check_flash = 1;
                                                }
                                            }
                                        }
                                      foreach ($spesificPriceAll as $specificPrice) {
                                        ?>
                                          <?php
                                              if ($specificPrice->from <= $now && $specificPrice->to > $now) {
                                                  ?>
                                                  <?php
                                                    if($check_flash == 1){
                                                        if($specificPrice->is_flash_sale == 1){
                                                        ?>
                                                        <div class='pull-right'>
                                                      <div class='<?php echo $specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                          <span class='text-discount' style=''>
                                                              <?php
                                                              // if custom value label
                                                                if($specificPrice->label_type == "custom_value"){
                                                                  echo $specificPrice->label;
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
                                                    }else{
                                                        ?>
                                                        <div class='pull-right'>
                                                      <div class='<?php echo $specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                          <span class='text-discount' style=''>
                                                              <?php
                                                              // if custom value label
                                                                if($specificPrice->label_type == "custom_value"){
                                                                  echo $specificPrice->label;
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
                                                  ?>
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
                                             <div class="tag-bellow tag-bellow2" style='background-color: #4c757b;position: absolute;bottom: 0px;width: 100%;top:auto;'>
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
                                            if(in_array($product->product_id, [883, 1065,1066,2195])){
                                        ?>
                                             <div class="tag-bellow tag-bellow2" style='background-color: #4c757b;position: absolute;bottom: 0px;width: 100%;top:auto;'>
                                                <div class=''>
                                                    <span class='text-bellow'>
                                                    Collaboration Item

                                                    </span>
                                                </div>
                                            </div>

                                          <?php
                                            }
                                          ?>
                                          <?php
                                            if($product->product_id == 1738){
                                        ?>
                                             <div class="tag-bellow tag-bellow2" style='background-color: #4c757b;position: absolute;bottom: 0px;width: 100%;top:auto;'>
                                                <div class=''>
                                                    <span class='text-bellow'>
                                                    Special Collection

                                                    </span>
                                                </div>
                                            </div>

                                          <?php
                                            }
                                          ?>
                                          <?php
										  //temporary set coming soon
                                            if(in_array($product->product_id, [3285, 3286])){
                                        ?>
                                             <div class="tag-bellow tag-bellow2" style='background-color: #4c757b;position: absolute;bottom: 0px;width: 100%;top:auto;'>
                                                <div class=''>
                                                    <span class='text-bellow'>
                                                    Coming Soon

                                                    </span>
                                                </div>
                                            </div>

                                          <?php
                                            }
                                          ?>
                                        
                                        
                                          
                                         
                                <?php
                                if($stock != NULL){
                                ?>
                                <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg?fit=max&fm=pjpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                <?php
                                    echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
                                ?>
                                <?php
                                } else {
                                ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg?fit=max&fm=pjpg" class="img-responsive">

                                <?php } ?>
                            </div>
                            <?php 
                                $brand_id_n = backend\models\Product::find()->where(['product_id'=>$product->product_id])->one()->brands_brand_id;
                                $product->brands->brand_name = backend\models\Brands::find()->where(['brand_id'=>$brand_id_n])->one()->brand_name;
                            ?>
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
                                $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->andWhere(['is_flash_sale'=>0])->all();
                                $discount = 0;
                                $now = date('Y-m-d H:i:s');
                                $check_discount = 0;
                                $check_flash = 0;
                                if ($spesificPriceAll != null) {
                                    foreach ($spesificPriceAll as $specificPrice) {
                                            if ($specificPrice->from <= $now && $specificPrice->to > $now) {
                                                if($specificPrice->is_flash_sale == 1){
                                                    $check_flash = 1;
                                                }
                                            }
                                        }
                                    ?>
                                    <?php
                                      foreach ($spesificPriceAll as $spesificPrice) {
                                        ?>
                                            <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>
                                              <?php $check_discount = 1; ?>
                                          
                                      <?php } else { ?>
                                          
                                          <?php
                                                    if($check_flash == 1){
                                                        if($spesificPrice->is_flash_sale == 1){
                                                        ?>
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
                                                        <?php
                                                        }
                                                    }else{
                                                        ?>
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
                                                        <?php
                                                    }
                                                  ?>
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
                            <div style="position: relative;">
                                
                                <div class="tag">
                                    <?php
                                    $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->all();
                                    $check_flash = 0;
                                    if ($spesificPriceAll != null) {
                                        foreach ($spesificPriceAll as $specificPrice) {
                                            if ($specificPrice->from <= $now && $specificPrice->to > $now) {
                                                if($specificPrice->is_flash_sale == 1){
                                                    $check_flash = 1;
                                                }
                                            }
                                        }
                                      foreach ($spesificPriceAll as $specificPrice) {
                                        ?>
                                          <?php
                                              if ($specificPrice->from <= $now && $specificPrice->to > $now) {
                                                  ?>
                                                  <?php
                                                    if($check_flash == 1){
                                                        if($specificPrice->is_flash_sale == 1){
                                                        ?>
                                                        <div class='pull-right'>
                                                      <div class='<?php echo $specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                          <span class='text-discount' style=''>
                                                              <?php
                                                              // if custom value label
                                                                if($specificPrice->label_type == "custom_value"){
                                                                  echo $specificPrice->label;
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
                                                    }else{
                                                        ?>
                                                        <div class='pull-right'>
                                                      <div class='<?php echo $specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
                                                          <span class='text-discount' style=''>
                                                              <?php
                                                              // if custom value label
                                                                if($specificPrice->label_type == "custom_value"){
                                                                  echo $specificPrice->label;
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
                                                  ?>
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
                                             <div class="tag-bellow" style='background-color: #4c757b;position: absolute;bottom: 0px;width: 100%;top:auto;'>
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
                                            if(in_array($product->product_id, [883, 1065,1066,2195])){
                                        ?>
                                             <div class="tag-bellow tag-bellow2" style='background-color: #4c757b;position: absolute;bottom: 0px;width: 100%;top:auto;'>
                                                <div class=''>
                                                    <span class='text-bellow'>
                                                    Collaboration Item

                                                    </span>
                                                </div>
                                            </div>

                                          <?php
                                            }
                                          ?>
                                          <?php
                                            if($product->product_id == 1738){
                                        ?>
                                             <div class="tag-bellow tag-bellow2" style='background-color: #4c757b;position: absolute;bottom: 0px;width: 100%;top:auto;'>
                                                <div class=''>
                                                    <span class='text-bellow'>
                                                    Special Collection

                                                    </span>
                                                </div>
                                            </div>

                                          <?php
                                            }
                                          ?>
                                          <?php
										  //temporary set coming soon
                                            if(in_array($product->product_id, [3285, 3286])){
                                        ?>
                                             <div class="tag-bellow tag-bellow2" style='background-color: #4c757b;position: absolute;bottom: 0px;width: 100%;top:auto;'>
                                                <div class=''>
                                                    <span class='text-bellow'>
                                                    Coming Soon

                                                    </span>
                                                </div>
                                            </div>

                                          <?php
                                            }
                                          ?>
                                <?php
                                if($stock != NULL){
                                ?>
                                <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg?fit=max&fm=pjpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                <?php
                                    echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
                                ?>
                                <?php
                                } else {
                                ?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg?fit=max&fm=pjpg" class="img-responsive">

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
                                $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->all();
                                $discount = 0;
                                $now = date('Y-m-d H:i:s');
                                $check_discount = 0;
                                $check_flash = 0;
                                if ($spesificPriceAll != null) {
                                    foreach ($spesificPriceAll as $specificPrice) {
                                            if ($specificPrice->from <= $now && $specificPrice->to > $now) {
                                                if($specificPrice->is_flash_sale == 1){
                                                    $check_flash = 1;
                                                }
                                            }
                                        }
                                    ?>
                                    <?php
                                      foreach ($spesificPriceAll as $spesificPrice) {
                                        ?>
                                            <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>
                                              <?php $check_discount = 1; ?>
                                          
                                      <?php } else { ?>
                                          
                                          <?php
                                                    if($check_flash == 1){
                                                        if($spesificPrice->is_flash_sale == 1){
                                                        ?>
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
                                                        <?php
                                                        }
                                                    }else{
                                                        ?>
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
                                                        <?php
                                                    }
                                                  ?>
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
      </div>
    </section>
    <?php //if($count > 4) {  ?>
    <style>
        section#all-product-footer {
        padding: 0 0 2% 0;
    }
    </style>
    <section id="all-product-footer">
        <div class="container product-box">
            <div class="row font-paging">
                <?php

                    if(!isset($_GET['limit'])){
                        $limit = 20;
                        $total_page = ceil($total_products / $limit);
                    }else{
                        $total_page = ceil($total_products / $limit);
                    }



                    if(!isset($_GET['page'])){
                        $current = 1;
                    }else{
                        $current = $_GET['page'];
                    }
                 ?>

                 <?php
                     echo Yii::$app->view->renderFile('@app/views/brands/page_number.php', array(
                         "current" => $current,
                         "breadcrumbs" => $breadcrumbs,
                         "total_page" => $total_page,
                         "limit" => $limit,
                         "params"=> $params,
                         "sortby"=> $sortby,
                         "currentAc"=>$currentAc,

                     ));
                 ?>
                 <br><hr>
                 <!--SEO Pages-->
                    <?php 
                        $seo = \backend\models\SeoPagesContentBrands::findOne(['brand_id' => $brandId]);
                        echo Yii::$app->view->renderFile('@app/views/site/seo_pages_brand.php', array("seo"=>$seo));
                    ?>
            </div>
        </div>
        <hr>
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
          echo Yii::$app->view->renderFile('@app/views/brands/filter.php', array(
              "feature" => $feature,
              "products"=> $products,
              "types_selection" => $types_selection,
              "genders_selection" => $genders_selection,
              "size_selection" => $size_selection,
              "bandwidth_selection" => $bandwidth_selection,
              "collection_selection" => $collection_selection,
              "movements_selection" => $movements_selection,
              "waters_selection" => $waters_selection,
              "brandName" => $brandName,
              "breadcrumbs" => $breadcrumbs,
              "brandId"=> $brandId,
          ));
          ?>
        <div class="col-lg-10 col-md-10 col-sm-10 ptop5 pbottom3">
            <center><span class="gotham-light fsize-1">PRODUCT NOT FOUND</span></center>
        </div>
    </div>
  </div>
</section>
<?php } ?>
<script type="text/javascript">
    // Scroll in brand page

    function scroll_brand(event) {
    // window.location.href = "http://stackoverflow.com";
    $('#brand-category-master-click').text('');
    $('#brand-category-master-click').append(event+'<span class="glyphicon glyphicon-option-horizontal" style="float:right;"></span>');
    $('#brands-content').hide("slide", {direction: "right"}, 500);
    $('body').css('overflow', 'auto');
    $('#navbar-mobile').css('display', 'block');
    $('#brand-category-list').hide("slide", {direction: "down"}, 1);
    $('#brand-category-master').show();
    $('html, body').animate({
        scrollTop: $("#brand-"+event).offset().top - 10
    }, 500);
    $('body').css('overflow-x', 'hidden');
}
function scroll_brand_mobile(event) {
    // window.location.href = "http://stackoverflow.com";
    $('#brand-choose-mobile-text').text(event.toUpperCase());
    $('#brands-content').hide("slide", {direction: "right"}, 500);
    $('body').css('overflow', 'auto');
    $('#navbar-mobile').css('display', 'block');
    $('html, body').animate({
        scrollTop: $("#brand-"+event).offset().top - 100
    }, 500);
}
function scroll_brand_master(){

    $('#brand-category-master').hide();
    $('#brand-category-list').show("slide", {direction: "up"}, 500);
    // $('body').css('overflow', 'hidden');


}
function scroll_hide() {
    // window.location.href = "http://stackoverflow.com";


    $('body').css('overflow', 'auto');

    $('#brand-category-list').hide();
    $('#brand-category-master').show("slide", {direction: "down"}, 500);
    $('body').css('overflow-x', 'hidden');
}
function scroll_description_brand(){
    $('#brand-brand-description').css('display', 'inline-block');
    $('#brand-brand-description').show("slide", {direction: "down"}, 500);

    $('#brand-name').text('');
    $('#brand-name').append('<a class="col-xs-12 clearright-mobile clearleft-mobile" style="color:#9f8562;" onclick="hide_description_brand()">Hide Info<span class="glyphicon glyphicon-menu-up" style="color:white;background-color:#9f8562;border-radius:40px;padding: 4px;font-size: 9px;float: right;"></span></a>');
}
function hide_description_brand(){
    $('#brand-brand-description').css('display', 'none');
    $('#brand-brand-description').hide("slide", {direction: "down"}, 500);


    $('#brand-name').text('');
    $('#brand-name').append('<a class="col-xs-12 clearright-mobile clearleft-mobile" style="color:#9f8562;" onclick="scroll_description_brand()">More Info<span class="glyphicon glyphicon-menu-down" style="color:white;background-color:#9f8562;border-radius:40px;padding: 4px;font-size: 9px;float: right;"></span></a>');
}
function show_description_brand_desktop(){
    $('p.brand-hide').css('display', 'none');
    // $('p.brand-show').show("slide", {direction: "up"}, 500);
    $('p.brand-show').css('display', 'block');

}
function hide_description_brand_desktop(){
  $('p.brand-show').css('display', 'none');
  // $('p.brand-hide').show("slide", {direction: "up"}, 500);
  $('p.brand-hide').css('display', 'block');
}
</script>