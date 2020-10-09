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
        "list": "Landing Page Promo Ramadhan"
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


<div class="hidden-lg hidden-xs"></div>
<section class="ptop1" style="padding-top:0px;padding-bottom:0;">
    <!--<div class="container">-->
    <!--    <div class="row">-->
        <div style="position: relative;">
        
            <img src="<?php echo Yii::$app->params['imgixUrl'] ?>landing/promogopay/promogopay-banner-080818.jpg" class="img-responsive hidden-xs" style="display: block;margin: auto;">
            <img src="<?php echo Yii::$app->params['imgixUrl'] ?>landing/promogopay/promogopay-banner-mobile.jpg" class="img-responsive hidden-lg hidden-md hidden-sm" style="display: block;margin: auto;">

        </div>
            
    <!--    </div>-->
    <!--</div>-->
    
</section>
<section class="ptop1" style="padding-bottom:0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-center gotham-medium title-gopay">
                Syarat dan ketentuan promo Go Pay
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs new-line"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright-mobile clearleft-mobile clearleft clearright">
                <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs"></div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 clearright-mobile clearleft-mobile gotham-light clearleft clearright">
                    <ol style="padding-left:0;">
                        <li>Program berlaku setiap hari dari tanggal 10 - 17 Agustus 2018.</li>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                        <li>Hanya berlaku untuk pembayaran online menggunakan GO-PAY.</li>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                        <li><span class="gotham-medium">Program</span> ini memberlakukan minimum transaksi, yaitu Rp 45,000</li>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                        <li><span class="gotham-medium">Program</span> ini memberlakukan maksimum diskon, yaitu Rp 17,000.</li>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                        <li><span class="gotham-medium">Hanya berlaku</span> untuk 100 pelanggan setiap harinya yang berhak mendapatkan diskon selama periode <span class="gotham-medium">Program</span>.</li>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                        <li>1 pelanggan hanya dapat mendapatkan diskon 1x dalam 1 hari selama periode <span class="gotham-medium">Progam</span>.</li>
                    </ol>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs"></div>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs new-line"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-center gotham-medium title-gopay">
                Lihat cara pembayaran di sini
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright-mobile clearleft-mobile clearleft clearright">
                <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs"></div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    
                    <div class="container-video">
                        <iframe src="//www.youtube.com/embed/fdOQeeckfSY" frameborder="0" allowfullscreen class="video"></iframe>
                    </div>

                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs"></div>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright-mobile clearleft-mobile clearleft clearright">
                <div class="col-lg-5 col-md-4 col-sm-4 col-xs-2"></div>
                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-8">
                    
                    <a href="https://www.thewatch.co/watches/all-product" class="sky-round default">Lanjut Berbelanja</a>

                </div>
                <div class="col-lg-5 col-md-4 col-sm-4 col-xs-2"></div>
            </div>
        </div>
    </div>
</section>

<section style="padding-top:0;padding-bottom:0;">
    <div class="container">
        <div class="row">
            
            
            
        </div>
    </div>
</section>

<section class="" style="padding-top:88px;"></section>
<!--SEO Pages-->


<style>
@media only screen and (max-width : 767px) {
	.mtop3-mobile { margin-top: 3%; }
	.mtop8-em-mobile { margin-top: 8em; }
}
p.seodesc{font-size: 0.7em; line-height: 1.3em; font-family: gotham-light;}
    .show-read-more .more-text{
        display: none;
    }


    .container-video {
    position: relative;
    width: 100%;
    height: 0;
    padding-bottom: 56.25%;
}
.video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
.title-gopay{
    font-size:24px;
}
@media only screen and (max-width : 767px) {
	.title-gopay{
        font-size:20px;
    }
}
</style>

